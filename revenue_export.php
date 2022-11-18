<?php
require('./PHPExcel/PHPExcel/IOFactory.php');
include "./database/sql.php";

$conn = OpenCon();

$type = $_COOKIE['type'];
$email = $_COOKIE['email'];
$month_year = date('M-Y');
$pre_month = date('M-Y', strtotime('-1 month'));
$pre_year = date("Y",strtotime("-1 year"));

if ($type == 'ADMIN' || $type == 'CU') {
    $query = pg_query($conn, "SELECT rt.*, a.target_amount as abp, a_v.target_amount as abp_vaor FROM revenue_table rt LEFT OUTER JOIN abp a ON rt.month = a.month AND LOWER(rt.client_name) = LOWER(a.client_name) LEFT OUTER JOIN abp_vaor a_v ON rt.month = a_v.month AND LOWER(rt.client_name) = LOWER(a_v.client_name) WHERE rt.month='$month_year' ORDER BY rt.id asc;");
}
else if($type == 'AM')
    {
        $result = pg_query($conn,"SELECT * FROM user_account where email='$email'");
        if (pg_num_rows($result)>0) 
        {
        	while ($row = pg_fetch_assoc($result)) 
        	{
        		$uid=$row['id'];
        	}
        }
        $result = pg_query($conn,"SELECT * FROM clients where account_manager ='$uid'");
        $clientname = array();
        if (pg_num_rows($result)>0) 
        {
        	while ($row = pg_fetch_assoc($result)) 
        	{
        		array_push($clientname, strtolower($row['clientname']));
        	}
        }
        $j = json_encode($clientname);
        $j = str_replace('"', "'", $j);
        $query = pg_query($conn,"SELECT rt.*, a.target_amount as abp, a_v.target_amount as abp_vaor FROM revenue_table rt LEFT OUTER JOIN abp a ON rt.month = a.month AND LOWER(rt.client_name) = LOWER(a.client_name) LEFT OUTER JOIN abp_vaor a_v ON rt.month = a_v.month AND LOWER(rt.client_name) = LOWER(a_v.client_name) where lower(rt.client_name) = any(array$j) AND rt.month='$month_year' ORDER BY id asc;");
    }
    else if($type == 'RM')
    {
        $result = pg_query($conn,"SELECT * FROM user_account where email='$email'");
        $row = pg_fetch_all($result)[0];
        $arr = explode(", ", $row['accounttype']);
        function myfunction($v) {
          return strtolower(substr($v, 3));
        }
        $accounttype = join(", ", array_map("myfunction", $arr));
        $query = pg_query($conn,"SELECT rt.*, a.target_amount as abp, a_v.target_amount as abp_vaor FROM revenue_table rt LEFT OUTER JOIN abp a ON rt.month = a.month AND LOWER(rt.client_name) = LOWER(a.client_name) LEFT OUTER JOIN abp_vaor a_v ON rt.month = a_v.month AND LOWER(rt.client_name) = LOWER(a_v.client_name) WHERE lower(rt.account_type) = ANY('"."{".$accounttype."}"."') AND rt.month='$month_year' ORDER BY id asc;");
        
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
        $query = pg_query($conn,"SELECT rt.*, a.target_amount as abp, a_v.target_amount as abp_vaor FROM revenue_table rt LEFT OUTER JOIN abp a ON rt.month = a.month AND LOWER(rt.client_name) = LOWER(a.client_name) LEFT OUTER JOIN abp_vaor a_v ON rt.month = a_v.month AND LOWER(rt.client_name) = LOWER(a_v.client_name) where rt.business = ANY('" . "{" . $bu . "}" . "'::text[]) AND rt.month='$month_year' ORDER BY id asc;");
    }

if(pg_num_rows($query) == 0){
    echo "<script type='text/javascript'>alert('No data available for download');</script>";
  echo '<meta http-equiv="Refresh" content="0;url=revenue.php">';
  die;
}
if (pg_num_rows($query) > 0) {
 
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->setActiveSheetIndex(0);
    $rowCount = 1;
    //setting column headings
    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, "Month");
    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, "ECNC");
    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, "Category");
    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, "Business");
    $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, "Service");
    $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, "Account Type");
    $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, "Client Name");
    $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "$pre_year Actual");
    $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, "$pre_month Actual");
    $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, "$month_year Actual");
    $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, "$month_year ABP");
    $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, "$month_year ABP VAOR");
    $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, "$month_year Original Estimate");
    $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, "$month_year Original Estimate VAOR");
    $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, "$month_year Revised Estimate");
    $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, "$month_year Revised Estimate VOAR");
    $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, "am_projection");
    $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, "rm_projection");
    $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, "bu_projection");
    $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, "Assumptions");
    // $objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, "Assumptions");
    // $objPHPExcel->getActiveSheet()->SetCellValue('V' . $rowCount, "Assumptions");
    
    $rowCount++;
    while ($row = pg_fetch_array($query)) {
      // echo "<pre>";
      // print_r($row);die;
      if($row['assumption_am'] || $row['assumption_rm'] || $row['assumption_bu']){
        $assumption = 'AM:'.str_replace ("\"","'",$row["assumption_am"]).","."RM:".str_replace ("\"","'",$row["assumption_rm"]).","."BU:".str_replace ("\"","'",$row["assumption_bu"]);
      }
      else {
        $assumption = '';
      }
      $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['month']);
      $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $row['ecnc']);
      $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['category']);
      $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['business']);
      $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['service']);
      $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $row['account_type']);
      $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $row['client_name']);
      $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $row['upload_1'])->getStyle('H')->getNumberFormat()->setFormatCode('#,##0.00');
      $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $row['upload_2'])->getStyle('I')->getNumberFormat()->setFormatCode('#,##0.00');
      $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $row['upload_3'])->getStyle('J')->getNumberFormat()->setFormatCode('#,##0.00');
      $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $row['abp'])->getStyle('K')->getNumberFormat()->setFormatCode('#,##0.00');
      $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $row['abp_vaor'])->getStyle('L')->getNumberFormat()->setFormatCode('#,##0.00');
      $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $row['original_estimate'])->getStyle('M')->getNumberFormat()->setFormatCode('#,##0.00');
      $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $row['original_estimate_voar'])->getStyle('N')->getNumberFormat()->setFormatCode('#,##0.00');
      $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $row['revised_estimate'])->getStyle('O')->getNumberFormat()->setFormatCode('#,##0.00');
      $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $row['revised_estimate_voar'])->getStyle('P')->getNumberFormat()->setFormatCode('#,##0.00');
      $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $row['am_projection'])->getStyle('Q')->getNumberFormat()->setFormatCode('#,##0.00');
      $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $row['rm_projection'])->getStyle('R')->getNumberFormat()->setFormatCode('#,##0.00');
      $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $row['bu_projection'])->getStyle('R')->getNumberFormat()->setFormatCode('#,##0.00');
      $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $assumption);
      
      
      $rowCount++;
    }
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    $file = "Revenue_" . date('d-m-y h:i:s') . "_.xls";
    // $objWriter->save($file);
  
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $file);
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    die;
  }