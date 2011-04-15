<?php include 'index.inc.php' ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" href="global.css.php" type="text/css" media="screen" />
  <link href='http://fonts.googleapis.com/css?family=Neucha' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Cabin+Sketch:bold' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
  <script src="js/jquery-1.4.2.js" type="text/javascript"></script>        
  <script src="js/custom.js" type="text/javascript"></script>
  <title>Hack-a-Thon Playground</title>
</head>

<body>        
  <div id="titleContainer">
    <h1 id="title">Hack-a-Thon</h1>
  </div>
  <div id="userBox">
    <div id="userBoxTitle"><span>Machine</span></div>
    <?php generateUserIds(); ?>
    <div class="clear" />
  </div>
  <div id="graphBox">
    <?php generateGraphUsers(); ?>
  </div>
  <div id="scoreBox">
    <div id="userScoreTitle"><span>Score</span></div>
    <?php generateUserScores(); ?>
    <div class="clear" />
  </div>
  <div id="footer">
    <span>Update Interval:</span>
    <select id="timerDelay">
      <option value="off">Off</option>
      <option value="15" selected="selected">15 sec</option>
      <option value="30">30 sec</option>
      <option value="45">45 sec</option>
      <option value="60">60 sec</option>
    </select>
  </div>
  <div id="userStatsBox">
    <?php generateUserStats(); ?>
  </div>
</body>
</html>
