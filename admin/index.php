<?php include 'index.inc.php' ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" href="admin.css" type="text/css" media="screen" />
  <script src="../js/jquery-1.4.2.js" type="text/javascript"></script>        
  <title>Hack-a-Thon Playground - Admin Panel</title>
</head>

<body>
  <h1 id="header">Admin Panel</h1>
  <div id="navPanel">
    <div id="userPanel">
      <h2>Users</h2>
      <ul>
        <li><a text="Insert Users" href="?page=insertUsers">Insert Users</a></li>
        <li><a text="Update/Delete Users" href="?page=updateUsers">Update/Delete Users</a></li>
      </ul>
    </div>
    <div id="hijinxPanel">
      <h2>Tomfoolery</h2>
      <ul>
        <li><a text="Insert Hacks" href="?page=insertHacks">Insert Hacks</a></li>
        <li><a text="Clean Hacks" href="?page=cleanHacks">Clean Hacks</a></li>
      </ul>
    </div>
    <div id="reportPanel">
      <h2>Reporting</h2>
      <ul>
        <li><a text="Export Data" href="?page=exportData">Export Data</a></li>
      </ul>
    </div>
  </div>
  <div id="container">
    <?php generatePageBody() ?>
  </div>
</body>
</html>
