<?php

include_once 'mysql.inc.php';
include 'constants.inc.php';
include 'time.inc.php';

function generateUserIds() {
  try {
    // open a connection and query database for users
    global $DB_CONN_STRING, $DB_USER, $DB_PASS;
    $dbh = new PDO($DB_CONN_STRING, $DB_USER, $DB_PASS);
    $sql = "SELECT * FROM Users ORDER BY id";
    $first = true;
    foreach ($dbh->query($sql) as $row) {
      $pos = strrpos($row['ipaddress'], '.');
      $ip = $pos ? substr($row['ipaddress'], $pos + 1) : $row['ipaddress'];
      if ($first) {
        print '<div class="user" id="name' . $row['id'] . '">' . $ip . ' </div>' . "\n";
        $first = false;
      }
      else
        print '    <div class="user" id="name' . $row['id'] . '">' . $ip . '</div>' . "\n";
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

function generateGraphUsers() {
  try {
    // open a connection and query database for users
    global $DB_CONN_STRING, $DB_USER, $DB_PASS;
    $dbh = new PDO($DB_CONN_STRING, $DB_USER, $DB_PASS);
    $sql = "SELECT * FROM Users ORDER BY id";
    $first = true;
    foreach ($dbh->query($sql) as $row) {
      if ($first) {
        print '<div class="bar" id="user' . $row['id'] . '"></div>' . "\n";
        $first = false;
      }
      else
        print '    <div class="bar" id="user' . $row['id'] . '"></div>' . "\n";
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

function generateUserScores() {
  try {
    // open a connection and query database for users
    global $DB_CONN_STRING, $DB_USER, $DB_PASS;
    $dbh = new PDO($DB_CONN_STRING, $DB_USER, $DB_PASS);
    $sql = "SELECT * FROM UserScores ORDER BY id";
    $first = true;
    foreach ($dbh->query($sql) as $row) {
      $score = SCORE_WEIGHT*(SCORE_BASE + $row['score']);
      if ($first) {
        print '<div class="score" id="score' . $row['id'] . '">' . $score . '</div>' . "\n";
        $first = false;
      }
      else
        print '    <div class="score" id="score' . $row['id'] . '">' . $score . '</div>' . "\n";
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

function generateUserStats() {
  try {
    // open a connection and query database for users
    global $DB_CONN_STRING, $DB_USER, $DB_PASS;
    $dbh = new PDO($DB_CONN_STRING, $DB_USER, $DB_PASS);
    $sql = "SELECT * FROM UserScores ORDER BY id";
    $first = true;
    foreach ($dbh->query($sql) as $row) {
      $score = SCORE_WEIGHT*(SCORE_BASE + $row['score']);
      $cssid = 'user' . $row['id'] . 'stats';
      if($score < 0)
        $avatar = 'http://unicornify.appspot.com/avatar/' . md5($row['ipaddress']) . '?s=128';
      else if(0 == $score)
        $avatar = 'http://www.gravatar.com/avatar/' . md5($row['ipaddress']) . '?d=identicon&s=128';
      else
        $avatar = 'http://www.gravatar.com/avatar/' . md5($row['ipaddress']) . '?d=monsterid&s=128';
      if ($first) {
        echo "<div class=\"userStats\" id=\"$cssid\">";
        $first = false;
      }
      else
        echo "    <div class=\"userStats\" id=\"$cssid\">";
                
      echo '<img class="avatar" alt="User Avatar" src="' . $avatar . '"/>';
      echo '<span class="name">' . $row['name'] . '</span><br />';
      echo 'Machine: <span class="machine">' . $row['ipaddress'] . '</span><br />';
      echo 'Hacks: <span class="hacks">' . $row['hacks'] . '</span><br />';
      echo 'Hacked: <span class="hacked">' . $row['hacked'] . '</span><br />';
      echo 'Last Hack: <span class="lasthack">' . getElapsedTime(strtotime($row['last_hack'])) . '</span><br />';
      echo 'Last Hacked: <span class="lasthacked">' . getElapsedTime(strtotime($row['last_hacked'])) . '</span><br />';
      echo "</div>\n";
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
