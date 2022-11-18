<?php  
$output = '';
if(isset($_POST["exportacfa"]))
{
  $output .= '
  <table class="table" bordered="1">  
  <tr>  
  <th>Business Unit</th>
  <th>Profit Center</th>
  <th>Payer Code</th>
  <th>Actual Collection F & A</th>
  <th>Client Name</th>
  <th>Amount Outstanding</th>
  <th>Bucket</th>
  <th>Invoice Number</th>
  <th>SAP Reference</th>
  </tr>
  ';
  $output .= '</table>';
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment; filename=ACFA-format.xls');
  echo $output;
}
?>