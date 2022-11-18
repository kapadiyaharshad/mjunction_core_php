<?php  
include "./database/sql.php";
function fetch_data()  
{  
  $output = '';  
  // $conn = mysqli_connect("localhost", "root", "", "tut");  
  // $sql = "SELECT * FROM pdf_export ORDER BY id ASC";  

  $conn = OpenCon();
  $sql = "SELECT * FROM clients ORDER BY id ASC";

  $result = pg_query($conn, $sql);  
  while($row = pg_fetch_array($result))  
  {       
      $output .= '<tr>  
      <td>'.$row["id"].'</td>  
      <td>'.$row["email"].'</td> 
      <td>'.$row["mobilenum"].'</td> 
      <td>'.$row["clientname"].'</td> 
      <td>'.$row["payercode"].'</td> 
      <td>'.$row["key"].'</td> 
      <td>'.$row["account_type"].'</td> 
      <td>'.$row["business_segment"].'</td> 
      <td>'.$row["business_unit"].'</td> 
      <td>'.$row["services"].'</td> 
      <td>'.$row["account_manager"].'</td> 
      <td>'.$row["created_date"].'</td> 
      <td>'.$row["last_modified"].'</td> 
      <td>'.$row["status"].'</td> 
      <td>'.$row["profit_center"].'</td> 
      </tr>  
      ';  
  }  
  return $output;  
}  
  
  require_once('./libs/tcpdf.php');  
  $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
  $obj_pdf->SetCreator(PDF_CREATOR);  
  $obj_pdf->SetTitle("Client table");  
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
  <h1 align="center">Client table</h1><br /> 
  <table border="1" cellspacing="0" cellpadding="3" id="client">  
  <tr align="center" style="font-size:7px;font-weight:bold;">  
  <th width="4%">Id</th>  
  <th width="10%">Email</th> 
  <th width="7%">Mobile Number</th> 
  <th width="7%">Client Name</th> 
  <th width="6%">Payer Code</th> 
  <th width="10%">Key</th> 
  <th width="7%">Account Type</th> 
  <th width="5%">Business Segment</th> 
  <th width="5%">Business Unit</th> 
  <th width="10%">Services</th> 
  <th width="5%">Account Manager</th> 
  <th width="7%">Created Date</th> 
  <th width="7%">Last Modified</th> 
  <th width="5%">Status</th> 
  <th width="5%">Profit Center</th> 
  </tr>  
  ';  
  $content .= fetch_data();  
  $content .= '</table>';  
  $obj_pdf->writeHTML($content);  
  $obj_pdf->Output('report.pdf', 'I');  
 
?>  
