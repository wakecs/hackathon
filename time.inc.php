<?php

function getElapsedTime($start, $end = false) {
  $end = $end ? $end : time();  
  $elapsed = $end - $start;
  
  // year, week, days, hours, minutes
  $units = array('year' => 31449600, 'week' => 604800, 'day' => 86400,
                 'hour' => 3600, 'minute' => 60, 'second' => 1);
  
  foreach($units as $key => $value) {
    if(intval($elapsed / $value) > 0) {
      $elapsed = intval($elapsed / $value);
      $unit = $key;
      break;
    }
  }
  
  if($elapsed > 1)  
    $unit .= 's';
    
  return "$elapsed $unit ago";
}
