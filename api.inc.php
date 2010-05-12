<?php

function getUserScores() {
  try {
    // open a connection and query database for users
    global $DB_CONN_STRING, $DB_USER, $DB_PASS;
    $dbh = new PDO($DB_CONN_STRING, $DB_USER, $DB_PASS);
    $sql = "SELECT * FROM UserScores";
    $first = true;    
    foreach ($dbh->query($sql) as $row) {
      if($first) {
        print('0;' . $row['id'] . ':' . $row['score']);
        $first = false;
      }
      else
        print ',' . $row['id'] . ':' . $row['score'];
    }
  }
  catch (PDOException $e) {
    print(ERROR_DB . ';Database Error: ' . $e->getMessage());
    die();
  }
  
  // close the connection
  $dbh = null;
}

function recordHack() {
  try {
    // make sure parameters passed in
    if(empty($_POST['params'])) {
      echo ERROR_NO_PARAMS . ':No parameters given!';
      die();
    }
    
    $params = explode(',', $_POST['params']);
    foreach($params as $param) {
      $val = explode('=', $param);
      switch(trim($val[0])) {
        case 'hack':
          $hack = $val[1];
          break;
        case 'description':
          $description = $val[1];
          break;
        case 'passphrase':
          $passphrase = $val[1];
          break;
      }
    }
    
    // make sure all parameters given
    if(empty($hack) || empty($description) || empty($passphrase)) {
      echo ERROR_MISSING_PARAMS . ';Missing Parameters!:' . $_POST['params'];
      die();
    }
    
    // open a connection and query database for users
    global $DB_CONN_STRING, $DB_USER, $DB_PASS;
    $dbh = new PDO($DB_CONN_STRING, $DB_USER, $DB_PASS);
    
    // TODO: Update Database based on IP Address
  }
  catch (PDOException $e) {
    print(ERROR_DB . ';Database Error: ' . $e->getMessage());
    die();
  }
  
  // close the connection
  $dbh = null;
}
