<?php
  echo $happening->start_date()->toDate('F d, Y');
  if ($happening->start_date()->isNotEmpty() && $happening->start_time()->isNotEmpty()) {
    echo ' ';
  }
  echo $happening->start_time()->toDate('g:i a');
  if ($happening->end_date()->isNotEmpty() || $happening->end_time()->isNotEmpty()) {
    echo '–';
  }
  echo $happening->end_date()->toDate('F d, Y');
  if ($happening->end_date()->isNotEmpty() && $happening->end_time()->isNotEmpty()) {
    echo ' ';
  }
  echo $happening->end_time()->toDate('g:i a');
?>
