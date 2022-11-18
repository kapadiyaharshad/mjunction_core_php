<?php  
include "./database/sql.php";
function fetch_data()  
{  
  $output = '';  
  // $conn = mysqli_connect("localhost", "root", "", "tut");  
  // $sql = "SELECT * FROM pdf_export ORDER BY id ASC";  

  $conn = OpenCon();
  $sql = "SELECT * FROM user_account ORDER BY id ASC";

  $result = pg_query($conn, $sql);  
  while($row = pg_fetch_array($result))  
  {       
      $output .= '<tr>  
      <td>'.$row["id"].'</td>  
      <td>'.$row["fname"].'</td>  
      <td>'.$row["lname"].'</td>  
      <td>'.$row["email"].'</td>  
      <td>'.$row["username"].'</td>  
      <td>'.$row["mnumber"].'</td>  
      <td>'.$row["desgnation"].'</td>  
      <td>'.$row["accounttype"].'</td>  
      <td>'.$row["created_date"].'</td>  
      <td>'.$row["last_login"].'</td>  
      <td>'.$row["last_updated_date"].'</td>  
      <td>'.$row["import_type"].'</td>  
      <td>'.$row["permissions"].'</td>  
      <td>'.$row["status"].'</td>  
      </tr>  
      ';  
  }  
  return $output;  
}  
  
  require_once('./libs/tcpdf.php');  
  $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
  $obj_pdf->SetCreator(PDF_CREATOR);  
  $obj_pdf->SetTitle("User data table");  
  $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
  $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
  $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
  $obj_pdf->SetDefaultMonospacedFont('helvetica');  
  $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
  $obj_pdf->SetMargins('5', '10', '5');  
  $obj_pdf->setPrintHeader(false);  
  $obj_pdf->setPrintFooter(false);  
  $obj_pdf->SetAutoPageBreak(TRUE, 10);  
  $obj_pdf->SetFont('helvetica', '', 6);  
  $obj_pdf->AddPage();  
  $content = '';  
  $content .= '  
  <h1 align="center">User data table</h1><br /> 
  <table border="1" cellspacing="0" cellpadding="3">  
  <tr align="center" style="font-size:7px;font-weight:bold;">  
  <th width="4%">Id</th>  
  <th width="7%">first Name</th>  
  <th width="7%">last Name</th>  
  <th width="11%">Email</th>
  <th width="9%">Username</th>
  <th width="7%">Number</th>
  <th width="5%">Desgnation</th>
  <th width="10%">Account Type</th>
  <th width="7%">Created Date</th>
  <th width="7%">Last Login</th>
  <th width="7%">Last Updated Date</th>
  <th width="5%">Import Type</th>
  <th width="9%">Permissions</th>
  <th width="5%">Status</th>
  </tr>  
  ';  
  $content .= fetch_data();  
  $content .= '</table>';  
  $obj_pdf->writeHTML($content);  
  $obj_pdf->Output('User_data.pdf', 'I');  
 
?>  
