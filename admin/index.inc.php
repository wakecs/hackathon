<?php

include '../mysql.inc.php';
include '../constants.inc.php';
include 'insertUsers.inc.php';
include 'updateUsers.inc.php';
include 'insertHacks.inc.php';

function generatePageBody() {
  if(isset($_GET['page']))
    $page = $_GET['page'];
  else if(isset($_POST['page']))
    $page = $_POST['page'];
  
  switch(strtolower(trim($page))) {
      case 'insertusers':
        generateInputForm();
        break;
      case 'updateusers':
        generateUpdateForm();
        break;
      case 'inserthacks':
        generateInsertHackForm();
        break;
      default:
        echo $page;
        break;
    }
}

function fieldsComplete() {
  foreach ($_POST as $key => $val) {
    if(is_array($val)) {
      foreach($val as $valKey => $valVal) {
        if(empty($valVal)) {
          echo '<p><span class="error">Must fill in all values.</span></p>';
          return false;
        }
      }
    }
    else if(empty($val)) {
      echo '<p><span class="error">Must fill in all values.</span></p>';
      return false;
    }
  }
  
  return true;
}

