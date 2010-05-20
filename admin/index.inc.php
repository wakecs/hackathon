<?php

include '../mysql.inc.php';
include '../constants.inc.php';

function generatePageBody() {
  if(isset($_GET['page']))
    $page = $_GET['page'];
  else if(isset($_POST['page']))
    $page = $_POST['page'];
  
  switch(strtolower(trim($page))) {
      case 'insertusers':
        generateInputForm();
        break;
      case 'updateusers':
        generateUpdateForm();
        break;
      default:
        echo $page;
        break;
    }
}

function fieldsComplete() {
  foreach ($_POST as $key => $val) {
    if(is_array($val)) {
      foreach($val as $valKey => $valVal) {
        if(empty($valVal)) {
          echo '<p><span class="error">Must fill in all values.</span></p>';
          return false;
        }
      }
    }
    else if(empty($val)) {
      echo '<p><span class="error">Must fill in all values.</span></p>';
      return false;
    }
  }
  
  return true;
}

function generateInputForm() {
  echo '    <h3>Insert Users</h3>';
  if(isset($_POST['name']) && isset($_POST['ipaddress']) &&
     isset($_POST['passphrase']) && fieldsComplete())
  {
      insertUsers();
      return;
  }
  
  echo <<<END
    <span class="title">Name</span>
    <span class="title">IP Address</span>
    <span class="title">Passphrase</span><br />
    <form id="insert" action="index.php" method="post">
END;

  $count = isset($_POST['numusers']) ? $_POST['numusers'] : 1;
  for($i = 0; $i < $count; ++$i) {
      echo '      <input class="text" type="text" name="name[]" value="' . $_POST['name'][$i] .'" />';
      echo '      <input class="text" type="text" name="ipaddress[]" value="' . $_POST['ipaddress'][$i] . '" />';
      echo '      <input class="text" type="text" name="passphrase[]" value="' . $_POST['passphrase'][$i] . '"/><br />';
  }

  echo <<<END
      <input type="hidden" name="page" value="insertUsers" />
      <input type="submit" name="submit" />
    </form>
    <hr />
    <form id="numUsers" action="index.php" method="post">
      <input class="number" type="text" name="numusers" value="$count" /> User(s)
      <input type="hidden" name="page" value="insertUsers" />
      <input type="submit" name="submit" value="Update" />
    </form>
END;
}

function insertUsers() {
  try {
    // open a connection and query database for users
    global $DB_CONN_STRING, $DB_USER, $DB_PASS;
    $dbh = new PDO($DB_CONN_STRING, $DB_USER, $DB_PASS);
    $sql = "INSERT INTO Users (name, ipaddress, passphrase) VALUES (:name, :ipaddress, :passphrase)";
    $stmt = $dbh->prepare($sql);
    
    $success = 0;
    $postCount = count($_POST['name']);
    for ($i = 0; $i < $postCount; ++$i) {
      $passphrase = get_magic_quotes_gpc() ? stripslashes($_POST['passphrase'][$i]) : $_POST['passphrase'][$i];
      $stmt->bindParam(':name', $_POST['name'][$i]);
      $stmt->bindParam(':ipaddress', $_POST['ipaddress'][$i]);
      $stmt->bindParam(':passphrase', $passphrase);
      $count = $stmt->execute();
      if($count < 1) {
        echo 'Failed to insert: ' . $_POST['name'][$i] . ', ';
        echo $_POST['ipaddress'][$i] . ', ' . $_POST['passphrase'][$i] . '<br />';
      }
      else
        $success += 1;
    }
    
    echo "<p>Inserted $success record(s) successfully.</p>";
  }
  catch (PDOException $e) {
    print("<h3>Oops! Looks like the database gerbil took a break!</h3>\n");
    print('<span class="error">' . $e->getMessage() . '</span>');
    die();
  }
  
  // close the connection
  $dbh = null;
}

function generateUpdateForm() {
  echo '    <h3>Update/Delete Users</h3>';
  if((isset($_POST['update']) || isset($_POST['delete'])) && 
     fieldsComplete())
  {
      updateUsers();
      return;
  }
  
  try {
    // open a connection and query database for users
    global $DB_CONN_STRING, $DB_USER, $DB_PASS;
    $dbh = new PDO($DB_CONN_STRING, $DB_USER, $DB_PASS);
    $sql = "SELECT * FROM Users ORDER BY id";

    echo <<<END
<span class="checkTitle"><img alt="Update" src="images/update.png" /></span>
    <span class="checkTitle"><img alt="Delete" src="images/delete.png" /></span>
    <span class="title">Name</span>
    <span class="title">IP Address</span>
    <span class="title">Passphrase</span><br />
    <form id="update" action="index.php" method="post">

END;

    foreach ($dbh->query($sql) as $row) {
      $id = $row['id']; $name = $row['name'];
      $ipaddress = $row['ipaddress']; $passphrase = $row['passphrase'];
      
      echo "      <input class=\"checkbox\" type=\"checkbox\" name=\"update[]\" value=\"$id\" />";
      echo "<input class=\"checkbox\" type=\"checkbox\" name=\"delete[]\" value=\"$id\" />";
      echo "<input class=\"text\" type=\"text\" name=\"name$id\" value=\"$name\" />";
      echo "<input class=\"text\" type=\"text\" name=\"ipaddress$id\" value=\"$ipaddress\" />";
      echo "<input class=\"text\" type=\"text\" name=\"passphrase$id\" value=\"$passphrase\" /><br />";
    }
    
    echo <<<FOOTER
      <input type="hidden" name="page" value="updateUsers" />
      <input type="submit" name="submit" />
    </form>

FOOTER;

  }
  catch (PDOException $e) {
    print("<h3>Oops! Looks like the database gerbil took a break!</h3>\n");
    print('<span class="error">' . $e->getMessage() . '</span>');
    die();
  }
  
  // close the connection
  $dbh = null;
}

function updateUsers() {
    try {
    // open a connection and query database for users
    global $DB_CONN_STRING, $DB_USER, $DB_PASS;
    $dbh = new PDO($DB_CONN_STRING, $DB_USER, $DB_PASS);
    $sql = "UPDATE Users 
            SET Users.name = :name, Users.ipaddress = :ipaddress, Users.passphrase = :passphrase
            WHERE Users.id = :id";
    $update = $dbh->prepare($sql);
    
    $sql = "DELETE FROM Users WHERE Users.id = :id";
    $delete = $dbh->prepare($sql);
    
    $count = 0;
    $deleteCount = count($_POST['delete']);
    for($i = 0; $i < $deleteCount; ++$i) {
      $id = $_POST['delete'][$i];
      echo $i . ':' . $id . '<br />';
      $delete->bindParam(':id', $id);
      $count += $delete->execute();
    }
    
    $updateCount = count($_POST['update']);
    for($i = 0; $i < $updateCount; ++$i) {
      $id = $_POST['update'][$i];
      $passphrase = get_magic_quotes_gpc() ? stripslashes($_POST["passphrase$id"]) : $_POST["passphrase$id"];
      $update->bindParam(':id', $id);
      $update->bindParam(':name', $_POST["name$id"]);
      $update->bindParam(':ipaddress', $_POST["ipaddress$id"]);
      $update->bindParam(':passphrase', $passphrase);
      $count += $update->execute();
    }
    
    echo "<span class=\"success\">$count record(s) updated successfully!</span>";
  }
  catch (PDOException $e) {
    echo ERROR_DB . ';Database Error: ' . $e->getMessage();
    die();
  }
  
  // close the connection
  $dbh = null;
}
