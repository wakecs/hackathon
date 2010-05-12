<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" href="global.css.php" type="text/css" media="screen" />
  <script src="js/jquery-1.4.2.js" type="text/javascript"></script>        
  <script src="js/custom.js" type="text/javascript"></script>
  <title>Hack-a-Thon Playground - API Test Page</title>
</head>

<body>        
  <form name="input" action="api.php" method="post">
    <p>Method: 
    <select name="method">
      <option value="getUserScores">getUserScores</option>
      <option value="recordHack">recordHack</option>
    </select></p>
    <p>Params: 
    <input type="text" name="params" size="50" /></p>
    <input type="submit" name="submit" />
  </form>
</body>
</html>
