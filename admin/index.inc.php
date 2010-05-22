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
      case 'inserthacks':
        generateInsertHackForm();
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
  echo "<h3>Insert Users</h3>\n";
  if(isset($_POST['name']) && isset($_POST['ipaddress']) &&
     isset($_POST['passphrase']) && fieldsComplete())
  {
      insertUsers();
      return;
  }
  
  echo <<<END
    <div id="inputContainer">
    <form id="insert" action="index.php" method="post">
      <table>
      <tr>
        <td class="title">Name</td>
        <td class="title">IP Address</td>
        <td class="title">Passphrase</td>
      </tr>
END;

  $count = isset($_POST['numusers']) ? $_POST['numusers'] : 1;
  for($i = 0; $i < $count; ++$i) {
      echo '      <tr><td><input class="text" type="text" name="name[]" value="' . $_POST['name'][$i] .'" /></td>';
      echo '<td><input class="text" type="text" name="ipaddress[]" value="' . $_POST['ipaddress'][$i] . '" /></td>';
      echo '<td><input class="text" type="text" name="passphrase[]" value="' . $_POST['passphrase'][$i] . '"/></td></tr>' . "\n";
  }

  echo <<<END
      </table>
      <input type="hidden" name="numusers" value="$count" />
      <input type="hidden" name="page" value="insertUsers" />
      <input type="submit" name="submit" />
    </form>
    <hr />
    <form id="numUsers" action="index.php" method="post">
      <input class="number" type="text" name="numusers" value="$count" /> User(s)
      <input type="hidden" name="page" value="insertUsers" />
      <input type="submit" name="submit" value="Update" />
    </form>
    </div>
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
      $count = $stmt->execute() ? $stmt->rowCount() : 0;
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
  echo "<h3>Update/Delete Users</h3>\n";
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
<form id="update" action="index.php" method="post">
      <table>
      <tr>
        <td class="radioTitle"><img alt="Update" src="images/update.png" /></td>
        <td class="radioTitle"><img alt="Delete" src="images/delete.png" /></td>
        <td class="title">Name</td>
        <td class="title">IP Address</td>
        <td class="title">Passphrase</td>
      </tr>

END;

    foreach ($dbh->query($sql) as $row) {
      $id = $row['id']; $name = $row['name'];
      $ipaddress = $row['ipaddress']; $passphrase = $row['passphrase'];
      
      echo "      <tr><td><input class=\"radio\" type=\"checkbox\" name=\"update[]\" value=\"$id\" /></td>";
      echo "<td><input class=\"radio\" type=\"checkbox\" name=\"delete[]\" value=\"$id\" /></td>";
      echo "<td><input class=\"text\" type=\"text\" name=\"name$id\" value=\"$name\" /></td>";
      echo "<td><input class=\"text\" type=\"text\" name=\"ipaddress$id\" value=\"$ipaddress\" /></td>";
      echo "<td><input class=\"text\" type=\"text\" name=\"passphrase$id\" value=\"$passphrase\" /></td></tr>\n";
    }
    
    echo <<<FOOTER
      </table>
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
    $updateCount = count($_POST['update']);
    for($i = 0; $i < $updateCount; ++$i) {
      $id = $_POST['update'][$i];
      $passphrase = get_magic_quotes_gpc() ? stripslashes($_POST["passphrase$id"]) : $_POST["passphrase$id"];
      $update->bindParam(':id', $id);
      $update->bindParam(':name', $_POST["name$id"]);
      $update->bindParam(':ipaddress', $_POST["ipaddress$id"]);
      $update->bindParam(':passphrase', $passphrase);
      $count += $update->execute() ? $update->rowCount() : 0;       
    }
    
    $deleteCount = count($_POST['delete']);
    for($i = 0; $i < $deleteCount; ++$i) {
      $id = $_POST['delete'][$i];
      $delete->bindParam(':id', $id);
      $count += $delete->execute() ? $delete->rowCount() : 0;
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

function generateInsertHackForm() {
  echo "<h3>Insert/Delete Hacks</h3>\n";
  if(isset($_POST['id']) && isset($_POST['numhacks']) && 
     isset($_POST['type']))
  {
    if(('insert' == $_POST['type'] && fieldsComplete()) ||
        'clean' == $_POST['type']) 
    {
      insertHacks();
      return;
    }
  }
  
  echo <<<END
    <form id="injectHacks" action="index.php" method="post">
    <table>
      <tr>
        <td class="radioTitle"><img alt="Insert" src="images/update.png" /></td>
        <td class="radioTitle"><img alt="Clean" src="images/delete.png" /></td>
        <td class="title">List of IDs</td>
        <td class="title"># Hacks</td>
      </tr>
      <tr>
        <td><input class="radio" type="radio" name="type" value="insert" /></td>
        <td><input class="radio" type="radio" name="type" value="clean" /></td>
        <td><input class="text" type="text" name="id" /></td>
        <td><input class="number" type="text" name="numhacks" /></td>
      </tr>
    </table>
    <input type="hidden" name="page" value="insertHacks" />
    <input type="submit" name="submit" />
    </form>
    <table id="injectedHackTable">
    <tr>
      <td class="title">ID</td>
      <td class="title">Name</td>
      <td class="title">IP Address</td>
      <td class="title">Injected Hacks</td>
    </tr>

END;

  try {
    // open a connection and query database for users
    global $DB_CONN_STRING, $DB_USER, $DB_PASS;
    $dbh = new PDO($DB_CONN_STRING, $DB_USER, $DB_PASS);
    $sql = "SELECT * FROM FakeHack ORDER BY id";

    foreach ($dbh->query($sql) as $row) {
      echo '    <tr><td>' . $row['id'] . '</td>';
      echo '<td>' . $row['name'] . '</td>';
      echo '<td>' . $row['ipaddress'] . '</td>';
      echo '<td>' . $row['count'] . "</td></tr>\n";
    }
    echo "    </table>\n";
  }
  catch (PDOException $e) {
    echo ERROR_DB . ';Database Error: ' . $e->getMessage();
    die();
  }
}

function insertHacks() {
  try {
    // open a connection and query database for users
    global $DB_CONN_STRING, $DB_USER, $DB_PASS;
    $dbh = new PDO($DB_CONN_STRING, $DB_USER, $DB_PASS);
    
    $id_array = explode(',',  $_POST['id']);
    if('insert' == $_POST['type']) {
      $sql = "INSERT INTO Hacks (id, hacked_id, hack, description)
              VALUES (-1, :id, 'admin', 'admin')";
      $numHacks = $_POST['numhacks'];
    }
    else {    
      $sql = "DELETE FROM Hacks WHERE id = -1 AND hacked_id = :id";
      $numHacks = 1;
    }
    $stmt = $dbh->prepare($sql);
    
    $count = 0;
    foreach($id_array as $id) {
      $stmt->bindParam(':id', $id);
      for($i = 0; $i < $numHacks; ++$i) {
        $count += $stmt->execute() ? $stmt->rowCount() : 0;
      }
    }
    
    echo "<span class=\"success\">$count record(s) updated successfully!</span>";
  }
  catch (PDOException $e) {
    echo ERROR_DB . ';Database Error: ' . $e->getMessage();
    die();
  }
}
