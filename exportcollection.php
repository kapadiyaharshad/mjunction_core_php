<?php  
include "./database/sql.php";
$conn = OpenCon();
$result = pg_query($conn,"SELECT * FROM user_account");
$output = '';
if(isset($_POST["exportcollection"]))
{
  $query = "SELECT * FROM collection";
 $result = pg_query($conn, $query);
 if(pg_num_rows($result) > 0)
 {
  $output .= '
  <table class="table" bordered="1">  
  <tr>  
  <th>month</th>
  <th>classification</th>
  <th>account</th>
  <th>bu</th>
  <th>profit center</th>
  <th>payer_code</th>
  <th>client name</th>
  <th>bucket</th>
  <th>total_outstanding</th>
  <th>original_estimate</th>
  <th>revised_estimate</th>
  <th>actual_collection_f_a</th>
  <th>am_estimate</th>
  <th>assumptions</th>
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
  header('Content-Disposition: attachment; filename=collection.xls');
  echo $output;
}
}
?>