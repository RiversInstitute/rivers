<?php
  echo $event->start_date()->toDate('F d, Y');
  if ($event->start_date()->isNotEmpty() && $event->start_time()->isNotEmpty()) {
    echo ' ';
  }
  echo $event->start_time()->toDate('g:i a');
  if ($event->end_date()->isNotEmpty() || $event->end_time()->isNotEmpty()) {
    echo '–';
  }
  echo $event->end_date()->toDate('F d, Y');
  if ($event->end_date()->isNotEmpty() && $event->end_time()->isNotEmpty()) {
    echo ' ';
  }
  echo $event->end_time()->toDate('g:i a');
?>
