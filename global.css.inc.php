<?php

include_once 'mysql.inc.php';
include 'constants.inc.php';

function generateUserCss() {
  try {
    // open a connection and query database for users
    global $DB_CONN_STRING, $DB_USER, $DB_PASS;
    $dbh = new PDO($DB_CONN_STRING, $DB_USER, $DB_PASS);
    $sql = "SELECT * FROM UserScores ORDER BY id";
    $count = 0;
    foreach ($dbh->query($sql) as $row) {
      $height = abs(HEIGHT_WEIGHT*(SCORE_BASE + $row['score']));
      if(0 == $height)
        $height = HEIGHT_WEIGHT;
      echo '#user' . $row['id'] . " { \n";
      echo "  height: $height" . "px;\n";
      if($row['score'] > 0)
        echo '  background-color: green;' . "\n";
      else if($row['score'] < 0)
        echo '  background-color: red;' . "\n";
      else
        echo '  background-color: orange;' . "\n";
      echo "} \n\n";
      $count++;
    }
    
    if($count < 10)  $width = 610;
    else  $width = 61*$count;

    echo "div#userBox, div#scoreBox, div#footer, div#userStatsBox,\n";
    echo "div#graphBox, div#titleContainer {\n";
    echo '   width: ' . $width . "px;\n";
    echo "}\n";
  }
  catch (PDOException $e) {
    print("<h3>Oops! Looks like the database gerbil took a break!</h3>\n");
    print('<span class="error">' . $e->getMessage() . '</span>');
    die();
  }
  
  // close the connection
  $dbh = null;
}

