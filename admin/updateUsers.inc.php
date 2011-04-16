<?php

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

