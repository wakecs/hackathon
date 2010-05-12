<?php

include_once 'mysql.inc.php';
include 'constants.inc.php';

function generateUserIds() {
  try {
    // open a connection and query database for users
    global $DB_CONN_STRING, $DB_USER, $DB_PASS;
    $dbh = new PDO($DB_CONN_STRING, $DB_USER, $DB_PASS);
    $sql = "SELECT * FROM Users ORDER BY id";
    $first = true;
    foreach ($dbh->query($sql) as $row) {
      if ($first) {
        print '<div class="user" id="name' . $row['id'] . '">' . $row['id'] . ' </div>' . "\n";
        $first = false;
      }
      else
        print '    <div class="user" id="name' . $row['id'] . '">' . $row['id'] . '</div>' . "\n";
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
