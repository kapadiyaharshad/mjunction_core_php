<?php  
$output = '';
if(isset($_POST["exportacfa"]))
{
  $output .= '
  <table class="table" bordered="1">  
  <tr>  
  <th>Business Unit</th>
  <th>Service</th>
  <th>Client Name</th>
  <th>Actual Collection F & A</th>
  </tr>
  ';
  $output .= '</table>';
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment; filename=ACFA-format.xls');
  echo $output;
}
?>