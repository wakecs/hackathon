<?php

include_once 'mysql.inc.php';
include 'constants.inc.php';

function generateUserCss() {
  try {
    // open a connection and query database for users
    global $DB_CONN_STRING, $DB_USER, $DB_PASS;
    $dbh = new PDO($DB_CONN_STRING, $DB_USER, $DB_PASS);
    $sql = "SELECT * FROM UserScores";
    foreach ($dbh->query($sql) as $row) {
      $height = HEIGHT_WEIGHT*(SCORE_BASE + $row['score']);
      echo '#user' . $row['id'] . " { \n";
      echo "  height: $height" . "px;\n";
      echo '  background-color: green;' . "\n";
      echo "} \n\n";
    }
  }
  catch (PDOException $e) {
    print("<h3>Oops! Looks like the database gerbil took a break!</h3>\n");
    print('<span class="error">' . $e->getMessage() . '</span>');
    die();
  }
  
  // close the connection
  $dbh = null;
}

