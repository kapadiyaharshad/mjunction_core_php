<?php  
$output = '';
if(isset($_POST["exportabp"]))
{
  $output .= '
  <table class="table" bordered="1">  
  <tr>  
  <th>Financial Year</th>
  <th>Business Unit</th>
  <th>Profit Center</th>
  <th>Payer Code</th>
  <th>Client Name</th>
  <th>Apr</th>
  <th>May</th>
  <th>Jun</th>
  <th>Jul</th>
  <th>Aug</th>
  <th>Sep</th>
  <th>Oct</th>
  <th>Nov</th>
  <th>Dec</th>
  <th>Jan</th>
  <th>Feb</th>
  <th>Mar</th>
  </tr>
  ';
  $output .= '</table>';
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment; filename=ABP-Target-format.xls');
  echo $output;
}
?>