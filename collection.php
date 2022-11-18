<?php

require('./PHPExcel/PHPExcel/IOFactory.php');
include "./database/sql.php";

$conn = OpenCon();

$type = $_COOKIE['type'];
$email = $_COOKIE['email'];
$where_condition = date('M-Y');

if ($type == 'ADMIN' || $type == 'CU') {
  $statement = "SELECT * FROM collection WHERE month ='" . $where_condition . "'";
  $query = pg_query($conn, $statement);
} else if ($type == 'AM') {
  $result = pg_query($conn, "SELECT * FROM user_account where email='$email'");
  if (pg_num_rows($result) > 0) {
    while ($row = pg_fetch_assoc($result)) {
      $uid = $row['id'];
    }
  }
  $result = pg_query($conn, "SELECT * FROM clients where account_manager ='$uid'");
  $clientname = array();
  if (pg_num_rows($result) > 0) {
    while ($row = pg_fetch_assoc($result)) {
      array_push($clientname, strtolower($row['clientname']));
    }
  }
  $j = json_encode($clientname);
  $j = str_replace('"', "'", $j);
  $statement =
    $query = pg_query($conn, "SELECT * FROM collection where lower(client_name) = any(array$j) AND month='$where_condition' order by id");
} else if ($type == 'RM') {
  $result = pg_query($conn, "SELECT * FROM user_account where email='$email'");
  $row = pg_fetch_all($result)[0];
  $arr = explode(", ", $row['accounttype']);
  function myfunction($v)
  {
    return strtolower(substr($v, 3));
  }
  $accounttype = join(", ", array_map("myfunction", $arr));
  $query = pg_query($conn, "SELECT * FROM collection WHERE lower(account) = ANY('" . "{" . $accounttype . "}" . "') AND month='$where_condition' ");
}
else if($type == 'BU')
    {
        $result = pg_query($conn,"SELECT * FROM user_account where email='$email'");
        if (pg_num_rows($result)>0) 
        {
        	while ($row = pg_fetch_assoc($result)) 
        	{
        		$bu=$row['bu'];
        	}
        }
        $query = pg_query($conn,"SELECT * FROM collection where bu = ANY('" . "{" . $bu . "}" . "'::text[]) AND month='$where_condition' order by id");
    }

if (pg_num_rows($query) == 0) {
  echo "<script type='text/javascript'>alert('No data available for download');</script>";
  echo '<meta http-equiv="Refresh" content="0;url=collection-table.php">';
  die;
}
if ($query) {
  $objPHPExcel = new PHPExcel();
  $objPHPExcel->setActiveSheetIndex(0);
  $rowCount = 1;
  //setting column headings
  $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, "Month");
  $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, "Classification");
  $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, "Account");
  $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, "Bu");
  $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, "Profit Center");
  $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, "Payer Code");
  $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, "Client Name");
  $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "Bucket");
  $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, "Total Outstanding");
  $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, "Original Estimate");
  $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, "Revised Estimate");
  $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, "Am Estimate");
  $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, "Account Manager");
  $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, "Actual Collection f_a");
  $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, "Assumptions");
  $rowCount++;
  while ($row = pg_fetch_array($query)) {
    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['month']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['classification']);
    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['account']);
    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['bu']);
    $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['profit_center']);
    $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['payer_code']);
    $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $row['client_name']);
    $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $row['bucket']);
    $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $row['total_outstanding'])->getStyle('I')->getNumberFormat()->setFormatCode('#,##0.00');
    $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $row['original_estimate'])->getStyle('J')->getNumberFormat()->setFormatCode('#,##0.00');
    $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $row['revised_estimate'])->getStyle('K')->getNumberFormat()->setFormatCode('#,##0.00');
    $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $row['am_estimate'])->getStyle('L')->getNumberFormat()->setFormatCode('#,##0.00');
    $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $row['account_manager']);
    $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $row['actual_collection_f_a']);
    $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $row['assumptions']);
    $rowCount++;
  }
  $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
  $file = "Collection_" . date('d-m-y h:i:s') . "_.xls";
  // $objWriter->save($file);

  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="' . $file);
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output');
  die;
}
