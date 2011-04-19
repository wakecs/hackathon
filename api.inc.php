<?php

function getUserStats() {
  try {
    // open a connection and query database for users
    global $DB_CONN_STRING, $DB_USER, $DB_PASS;
    $dbh = new PDO($DB_CONN_STRING, $DB_USER, $DB_PASS);
    $sql = "SELECT * FROM UserScores ORDER BY id";
    $first = true;    
    foreach ($dbh->query($sql) as $row) {
      $score = SCORE_WEIGHT*(SCORE_BASE + $row['score']);
      if($score < 0)
        $avatar = 'http://unicornify.appspot.com/avatar/' . md5($row['ipaddress']) . '?s=128';
      else if(0 == $score)
        $avatar = 'http://www.gravatar.com/avatar/' . md5($row['ipaddress']) . '?d=identicon&s=128';
      else
        $avatar = 'http://www.gravatar.com/avatar/' . md5($row['ipaddress']) . '?d=monsterid&s=128';
      if($first) {
        echo SUCCESS . ';'; 
        $first = false;
      }
      else {
        echo ',';
      }
      echo $row['id'] . '|' . $row['score'] . '|' . $row['hacks'] . '|' . $row['hacked'] . '|';
      echo getElapsedTime(strtotime($row['last_hack'])) . '|'; 
      echo getElapsedTime(strtotime($row['last_hacked'])) . '|' . $avatar;
    }
  }
  catch (PDOException $e) {
    echo ERROR_DB . ';Database Error: ' . $e->getMessage();
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
    
    $params = explode(':', $_POST['params']);
    foreach($params as $param) {
      $val = explode('=', $param);
      switch(trim($val[0])) {
        case 'hack':
          $hack = trim($val[1]);
          break;
        case 'description':
          $description = trim($val[1]);
          break;
        case 'passphrase':
          $passphrase = trim($val[1]);
          break;
        case 'address':
          $address = trim($val[1]);
      }
    }
    
    // make sure all parameters given
    if(empty($hack) || empty($description) || empty($passphrase) || empty($address)) {
      echo ERROR_MISSING_PARAMS . ';Missing Parameters!:' . $_POST['params'];
      die();
    }
    
    $srcAddress = $_SERVER['REMOTE_ADDR'];
    
    // open a connection and for inserting hack
    global $DB_CONN_STRING, $DB_USER, $DB_PASS;
    $dbh = new PDO($DB_CONN_STRING, $DB_USER, $DB_PASS);
    
    // let's get the hacked id
    $stmt = $dbh->prepare("SELECT id, passphrase FROM Users WHERE ipaddress = :ipaddress");
    $stmt->bindParam(':ipaddress', $srcAddress);
    $stmt->execute();
    $row = $stmt->fetch();
    $hacked_id = $row['id'];
    $hacked_passphrase = md5(trim($row['passphrase']));
    
    if(empty($hacked_id)) {
      echo ERROR_METHOD_GENERAL . ";Run from '$srcAddress'. Must execute script on p0wned system.";
      die();
    }
    else if(strcmp($hacked_passphrase, $passphrase)) {
      echo ERROR_METHOD_GENERAL . ';Passphrase hash didn\'t match!';
      die();
    }
    
    // let's get the hacker id
    $stmt->bindParam(':ipaddress', $address);
    $stmt->execute();
    $row = $stmt->fetch();
    $id = $row['id'];
    
    if(empty($id)) {
      echo ERROR_METHOD_GENERAL . ";Bad IP! $address was not found in the database!";
      die();
    }
    
    // prepare SQL statement and insert hack into database
    $stmt = $dbh->prepare("INSERT INTO Hacks (id, hacked_id, hack, description) VALUES (:id, :hacked_id, :hack, :description)");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':hacked_id', $hacked_id);
    $stmt->bindParam(':hack', $hack);
    $stmt->bindParam(':description', $description);
    $count = $stmt->execute();
    
    if($count > 0) {
      echo SUCCESS . ';p0wnage complete!';
    }
    else {
      echo ERROR_DB . ';Database gerbil failed to record hack!';
    }
  }
  catch (PDOException $e) {
    echo ERROR_DB . ';Database gerbil failed to record hack!';
    die();
  }
  catch (Exception $e) {
    echo ERROR_METHOD_GENERAL . ';Something went horribly, horribly wrong! No hack for you!';
    die();
  }
  
  // close the connection
  $dbh = null;
}
