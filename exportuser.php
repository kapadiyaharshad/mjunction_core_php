<?php
$output = '';
if(isset($_POST["export"]))
{
  $output .= '
  <table class="table" bordered="1">  
  <tr>  
  <th>First Name</th>
  <th>Last Name</th>
  <th>Email</th>
  <th>Password</th>
  <th>Mobile Number</th>
  <th>Desgnation</th>
  <th>Account Type</th>
  <th>Business Unit</th>
  <th>Status</th>
  </tr>
  ';
  $output .= '</table>';
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment; filename=User-format.xls');
  echo $output;
}
?>
