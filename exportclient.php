<?php  

$output = '';
if(isset($_POST["export"]))
{
  $output .= '
  <table class="table" bordered="1">  
  <tr>  
  <th>Client Name</th>
  <th>Email</th>
  <th>Mobile Number</th> 
  <th>Business Unit</th>
  <th>Services</th>
  <th>Category</th>
  <th>Business Segment</th>
  <th>Profit Center</th>
  <th>Payer Code</th>
  <th>Account Type</th>
  <th>Account Manager</th>
  <th>Status</th>
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
  header('Content-Disposition: attachment; filename=Client-format.xls');
  echo $output;
}
?>