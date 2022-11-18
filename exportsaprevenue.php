<?php  
$output = '';
if(isset($_POST["exportsaprevenue"]))
{
  $output .= '
  <table class="table" bordered="1">  
  <tr>  
   <th>Assignment</th>
   <th>1</th>
   <th>Document Number</th>
   <th>Document Type</th>
   <th>Document Date</th>
   <th>Posting Key</th>
   <th>Amount in local currency</th>
   <th>Reference</th>
   <th>Text</th>
   <th>Cost Center</th>
   <th>Profit Center</th>
   <th>Sp.G/L trans type</th>
   <th>G/L Account</th>
   <th>Posting Date</th>
   <th>Name 1</th>
   <th>Purchasing Document</th>
   <th>Material</th>
   <th>Sales Document</th>
   <th>Clearing Document</th>
   <th>Customer</th>
   <th>Ec/NC</th>
  </tr>
  ';
  // <th>Created Date</th>
  //  <th>updated Date</th>
  //  <th>import By</th>
  //  <th>current Month</th>
  //  <th>upload Month</th>
  //  <th>dump Type</th>
  $output .= '</table>';
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment; filename=sap_dump_revenue.xls');
  echo $output;
// }
}
?>