<?php

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

