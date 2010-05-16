<?php

include_once 'mysql.inc.php';
include_once 'api.inc.php';
include_once 'constants.inc.php';

if(!empty($_POST['method'])) {
  switch($_POST['method']) {
      case 'getUserScores':
        getUserScores();
        break;
      case 'getUserStats':
        getUserStats();
        break;
      case 'recordHack':
        recordHack();
        break;
      default:
        echo ERROR_INVALID_METHOD . ';Invalid Method: ' . $_POST['method'];
        break;
  }
}
else {
  echo ERROR_NO_METHOD . ';No Method Specified';
}
