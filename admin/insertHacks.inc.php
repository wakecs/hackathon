<?php

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

