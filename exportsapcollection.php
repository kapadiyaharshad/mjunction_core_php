<?php  
// include "./database/sql.php";
// $conn = OpenCon();
// $result = pg_query($conn,"SELECT * FROM sap_dump");
$output = '';
if(isset($_POST["exportsapcollection"]))
{
 // $query = "SELECT * FROM sap_dump";
 // $result = pg_query($conn, $query);
 // if(pg_num_rows($result) > 0)
 // {
  
  $output .= '
  <table class="table" bordered="1">  
  <tr>  
  <th>acc_doc_no</th>
  <th>assignment_no</th>
  <th>profit_center</th>
  <th>account_cd</th>
  <th>sold_to_party</th>
  <th>sold_to_name</th>
  <th>billing_date</th>
  <th>credit_period</th>
  <th>currency</th>
  <th>total_outstanding</th>
  <th>total_invoice_value</th>
  <th>advance</th>
  <th>within_credit_period</th>
  <th>days_upto_30</th>
  <th>days_31_60</th>
  <th>days_61_90</th>
  <th>days_91_120</th>
  <th>days_121_150</th>
  <th>days_151_180</th>
  <th>days_181_365</th>
  <th>days_above_365</th>
  <th>due_days</th>
  <th>remarks</th>
  <th>invoice_or_odn_no</th>
  <th>sap_ref_no</th>
  </tr>
  ';
  // while($row = pg_fetch_array($result))
  // {
  //  $output .= '
  //   <tr>  
  //       <td>'.$row["fname"].'</td>  
  //       <td>'.$row["lname"].'</td>  
  //       <td>'.$row["email"].'</td>  
  //       <td>'.$row["bu"].'</td>  
  //       <td>'.$row["mnumber"].'</td>
  //    </tr>
  //  ';
  // }
  $output .= '</table>';
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment; filename=sap_dump_collection.xls');
  echo $output;
// }
}
?>