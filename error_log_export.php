<?php 
ini_set('display_errors', '1');
try{
  require('./PHPExcel/PHPExcel/IOFactory.php');
}catch(\Exception $e){
  echo $e->getMessage();
  exit;
}
include "./database/sql.php";
$conn = OpenCon();

$statement = "SELECT * FROM errors_log";
$query = pg_query($conn, $statement);
if ($query) {
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->setActiveSheetIndex(0);
    $rowCount = 1;
    //setting column headings
    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, "Customer Name");
    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, "Profit Center");
    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, "Description");
    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, "Create At");
    
    $rowCount++;
    while ($row = pg_fetch_array($query)) {
      $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['customer_name']);
      $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['profit_center']);
      $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['description']);
      $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['create_at']);
      $rowCount++;
    }
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    $file = "error_logs_" . date('d-m-y h:i:s') . "_.xlsx";
    // $objWriter->save($file);
  
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $file);
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    die;
  }
  
?>