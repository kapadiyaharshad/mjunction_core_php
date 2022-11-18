<?php
// current time
if(isset($_POST['importsapcollection']))
{
	date_default_timezone_set('Asia/Kolkata');
	// modal popup for importing
	echo "<div class='modal modal-fade' style='background-color:rgba(0,0,0,0.5);' id='uploadModal' tabindex='-1' role='dialog' aria-labelledby='modalTitle' aria-hidden='true'>
	<div class='modal-dialog modal-dialog-centered ' role='document'>
	<div class='modal-content'>
	<div class='modal-header'>
	<h5 class='modal-title' id='modalTitle'>Data Uploaded</h5>
	<button type='button' id='modal-close-btn' class='close' data-dismiss='modal' aria-label='Close' onclick='$(\"#uploadModal\").hide();' style='display: none;'> <span aria-hidden='true'>&times;</span> </button>
	</div>
	<div class='modal-body'>
	<div class='progress'>
		<div id='upload-progress' class='progress-bar' role='progressbar' style='width: 0%' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100'> </div>
	</div>
	<div id='modal-result'></div>
	<div id='errorupload'></div>
	<a href='sap-dump.php'><button type='button' id='modal-close-ok-btn' class='btn btn-primary user-btn ml-2' data-dismiss='modal' aria-label='Close' style='display: none;float:right;'>ok</button></a>
	</div>
	</div>
	</div>
	</div>
	</div>";      
	echo "<script>
	function updateProgress(toAdd) {
		const width = $('#upload-progress').css('width');
		$('#upload-progress').css('width', parseFloat(width) + toAdd + '%');
	}
	</script>";    
	echo "<script>$('#uploadModal').show();</script>";
	spl_autoload_register(function ($class_name) 
	{
		$preg_match = preg_match('/^PhpOffice\\\PhpSpreadsheet\\\/', $class_name);
	
		if (1 === $preg_match) 
		{
			$class_name = preg_replace('/\\\/', '/', $class_name);
			$class_name = preg_replace('/^PhpOffice\\/PhpSpreadsheet\\//', '', $class_name);
			require_once(__DIR__ . '/PhpSpreadsheet/' . $class_name . '.php');
		}
	});
	// error_reporting(0);
	// database connection
	$conn = OpenCon();
	$sql = pg_query($conn,"SELECT * FROM collection_sap_dump");
	$id = 0;
    date_default_timezone_set('Asia/Kolkata');
	$file=$_FILES['doc']['tmp_name'];
	$filename=$_FILES['doc']['name'];
	$ext=pathinfo($_FILES['doc']['name'],PATHINFO_EXTENSION);
	if($ext=='xlsx' || $ext=='xls' || $ext=='csv' )
	{
		require_once("vendor/autoload.php"); 
		$obj = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
		$success = 0;
		$empty=0;
		$emptyemail = array();
		$successemail = array();
		$erroremail = array();
		$error = 0;
		$flag=0;
		$nomail=0;
		$tp=1;
		foreach($obj->getWorksheetIterator() as $sheet)
		{
			$getHighestRow=$sheet->getHighestDataRow();
			// echo "<script>console.log('Message here $getHighestRow')</script>";
			for($i=2;$i<=$getHighestRow;$i++,$tp++)
			{
				$progress = ($tp) / ($getHighestRow - 1) * 100;
				echo "<script>
				updateProgress(".$progress.");
				</script>"; 
						
				$acc_doc_no=			$sheet->getCellByColumnAndRow(1,$i)->getValue();
                $assignment_no=			$sheet->getCellByColumnAndRow(2,$i)->getValue();
                $profit_center=			$sheet->getCellByColumnAndRow(3,$i)->getValue();
                $account_cd=			$sheet->getCellByColumnAndRow(4,$i)->getValue();
                $sold_to_party=			$sheet->getCellByColumnAndRow(5,$i)->getValue();
                $sold_to_name=			$sheet->getCellByColumnAndRow(6,$i)->getValue();
                $billing_date=			$sheet->getCellByColumnAndRow(7,$i)->getFormattedValue();
                $credit_period=			$sheet->getCellByColumnAndRow(8,$i)->getValue();
                $currency=				$sheet->getCellByColumnAndRow(9,$i)->getValue();
                $total_outstanding=		$sheet->getCellByColumnAndRow(10,$i)->getValue();
                $total_invoice_value=	$sheet->getCellByColumnAndRow(11,$i)->getValue();
                $advance=				$sheet->getCellByColumnAndRow(12,$i)->getValue();
                $within_credit_period=	$sheet->getCellByColumnAndRow(13,$i)->getValue();
                $days_upto_30=			$sheet->getCellByColumnAndRow(14,$i)->getValue();
                $days_31_60=			$sheet->getCellByColumnAndRow(15,$i)->getValue();
                $days_61_90=			$sheet->getCellByColumnAndRow(16,$i)->getValue();
                $days_91_120=			$sheet->getCellByColumnAndRow(17,$i)->getValue();
                $days_121_150=			$sheet->getCellByColumnAndRow(18,$i)->getValue();
                $days_151_180=			$sheet->getCellByColumnAndRow(19,$i)->getValue();
                $days_181_365=			$sheet->getCellByColumnAndRow(20,$i)->getValue();
                $days_above_365=		$sheet->getCellByColumnAndRow(21,$i)->getValue();
                $due_days=				$sheet->getCellByColumnAndRow(22,$i)->getValue();
                $remarks=				$sheet->getCellByColumnAndRow(23,$i)->getValue();
                $invoice_or_odn_no=		$sheet->getCellByColumnAndRow(24,$i)->getValue();
                $sap_ref_no=			$sheet->getCellByColumnAndRow(25,$i)->getValue();
                    
                if(		'acc_doc_no'  ==$sheet->getCellByColumnAndRow(1,1)->getValue()
					&&  'assignment_no'  ==$sheet->getCellByColumnAndRow(2,1)->getValue()
					&&  'profit_center'  ==$sheet->getCellByColumnAndRow(3,1)->getValue()
					&&  'account_cd'  ==$sheet->getCellByColumnAndRow(4,1)->getValue()
					&&  'sold_to_party'  ==$sheet->getCellByColumnAndRow(5,1)->getValue()
					&&  'sold_to_name'  ==$sheet->getCellByColumnAndRow(6,1)->getValue()
					&&  'billing_date'  ==$sheet->getCellByColumnAndRow(7,1)->getValue()
					&&  'credit_period'  ==$sheet->getCellByColumnAndRow(8,1)->getValue()
					&&  'currency'  ==$sheet->getCellByColumnAndRow(9,1)->getValue()
					&&  'total_outstanding'  ==$sheet->getCellByColumnAndRow(10,1)->getValue()
					&&  'total_invoice_value'  ==$sheet->getCellByColumnAndRow(11,1)->getValue()
					&&  'advance'  ==$sheet->getCellByColumnAndRow(12,1)->getValue()
					&&  'within_credit_period'  ==$sheet->getCellByColumnAndRow(13,1)->getValue()
					&&  'days_upto_30'  ==$sheet->getCellByColumnAndRow(14,1)->getValue()
					&&  'days_31_60'  ==$sheet->getCellByColumnAndRow(15,1)->getValue()
					&&  'days_61_90'  ==$sheet->getCellByColumnAndRow(16,1)->getValue()
					&&  'days_91_120'  ==$sheet->getCellByColumnAndRow(17,1)->getValue()
					&&  'days_121_150'  ==$sheet->getCellByColumnAndRow(18,1)->getValue()
					&&  'days_151_180'  ==$sheet->getCellByColumnAndRow(19,1)->getValue()
					&&  'days_181_365'  ==$sheet->getCellByColumnAndRow(20,1)->getValue()
					&&  'days_above_365'  ==$sheet->getCellByColumnAndRow(21,1)->getValue()
					&&  'due_days'  ==$sheet->getCellByColumnAndRow(22,1)->getValue()
					&&  'remarks'  ==$sheet->getCellByColumnAndRow(23,1)->getValue()
					&&  'invoice_or_odn_no'  ==$sheet->getCellByColumnAndRow(24,1)->getValue()
					&&  'sap_ref_no'  ==$sheet->getCellByColumnAndRow(25,1)->getValue()
                    )
                {	
                	$sold_to_name	= strtolower($sold_to_name);
					$sqlclient = pg_query($conn,"SELECT * FROM clients WHERE LOWER(clientname)='$sold_to_name'");
					$row_check = pg_fetch_assoc($sqlclient);
					$check_clientname= $row_check['clientname'];
					if(!empty($check_clientname))
					{
	                   			 $credit_period=str_replace("'","/",$credit_period);
	                    			 $account_cd_check=strtolower($account_cd);
	                    			 //$account_cd_check = substr($account_cd_check, 3	);
	                    			 $verify=0;
						//  $result = pg_query($conn,"SELECT LOWER(account_type) as account_type FROM static_master_account_type where LOWER(account_type) like '%$account_cd_check%'");
                		// echo "<script>console.log('$account_cd_check')</script>";
						// if (pg_num_rows($result)>0) 
						// {
						// 	// echo "<script>console.log('Hi')</script>";
						// 	while ($row = pg_fetch_assoc($result)) 
						// 	{
						// 		if($account_cd_check==$row['account_type']){
						// 			$verify=1;
						// 		}
						// 	}
						// }
						// echo "<script>console.log('hi $verify')</script>";
						// if($verify==1)
						// {
							$query = "
							INSERT INTO collection_sap_dump
							(
							    acc_doc_no, assignment_no, profit_center, account_cd, sold_to_party, sold_to_name,	billing_date, credit_period, currency,
							    total_outstanding, total_invoice_value,advance,	within_credit_period, days_upto_30, days_31_60,	days_61_90,	days_91_120,
						    	days_121_150, days_151_180,	days_181_365, days_above_365, due_days,	remarks, invoice_or_odn_no, sap_ref_no
							)
							VALUES(
							'$acc_doc_no',
							'$assignment_no',
							'$profit_center',
							'$account_cd',
							'$sold_to_party',
							'$sold_to_name',
							'$billing_date',
							'$credit_period',
							'$currency',
							'$total_outstanding',
							'$total_invoice_value',
							'$advance',
							'$within_credit_period',
							'$days_upto_30',
							'$days_31_60',
							'$days_61_90',
							'$days_91_120',
							'$days_121_150',
							'$days_151_180',
							'$days_181_365',
							'$days_above_365',
							'$due_days',
							'$remarks',
							'$invoice_or_odn_no',
							'$sap_ref_no')";
							$res = pg_query($conn, $query);
							if($res) 
							{
							// echo "<script>console.log('hi');</script>";
								if($sold_to_name!='')
								{
									if($total_outstanding<0)
									{
										$bucket = "ADVANCE";
									}
									else
									{
										if($due_days<=30)
										{
											$bucket='000 - within credit';
										}
										else if($due_days<=60 &&$due_days>=31)
										{
											$bucket='031 - 060 days';
										}
										else if($due_days<=90 &&$due_days>=61)
										{
											$bucket='090 - 061 days';
										}
										else if($due_days<=120 &&$due_days>=91)
										{
											$bucket='120 - 091 days';
										}
										else if($due_days<=150 &&$due_days>=121)
										{
											$bucket='150 - 121 days';
										}
										else if($due_days<=180 &&$due_days>=151)
										{
											$bucket='180 - 151 days';
										}
										else if($due_days<=365 &&$due_days>=181)
										{
											$bucket='181 - 365 days';
										}
										else if($due_days>=365 )
										{
											$bucket='days above 365';
										}
									}
									
									$sold_to_name=strtolower($sold_to_name);
									$sqlclient = pg_query($conn,"SELECT * FROM clients WHERE LOWER(clientname)='$sold_to_name'");
									$row = pg_fetch_assoc($sqlclient);
									$bu= $row['business_unit'];
									$classification=$row['business_segment'];
									$account_manager=$row['account_manager'];
									$bu=trim($bu);
									$month = date("M-Y");
									$date = date("Y/m/d H:i:s");
									// $month=$billing_date;
									
									$original_estimate="";
									$revised_estimate="";
									$actual_collection_f_a="0";
									$am_estimate="";
									$assumptions="";
									
									$querycollection = "
									INSERT INTO collection(
									month,
									classification,
									account,
									bu,
									profit_center,
									payer_code,
									client_name,
									bucket,
									total_outstanding,
									original_estimate,
									revised_estimate,
									am_estimate,
									create_date,
									account_manager,
									assumptions,
									invoice_number,
									sap_ref_number)
									VALUES(
									'$month',
									'$classification',
									'$account_cd',
									'$bu',
									'$profit_center',
									'$sold_to_party',
									'$sold_to_name',
									'$bucket',
									'$total_outstanding',
									'$original_estimate',
									'$revised_estimate',
									'$am_estimate',
									'$date',
									'$account_manager',
									'$remarks',
									'$invoice_or_odn_no',
									'$sap_ref_no')";
									
									$rescollection = pg_query($conn, $querycollection);
									
									$success += 1;
									// echo $querycollection;
								}
							}
							else 
							{
								$error += 1;
							}
						// }
						// else 
						// {
						// 	$error += 1;
						// }
						
					}
					else if(empty($check_clientname) && !empty($sold_to_name)){
						$error +=1;
					}
                }
				else{
					echo "<script>
						updateProgress(0);
						</script>";
					echo "<script>$('#modal-close-btn').show();</script>";
					echo "<script>$('#modal-result').html('No data or invalid data in file.');</script>";
				}
			}
		}
		if($success!=0)
		{
			
			$import_date = date("d-H:i:s");
			$import_month = date("M-Y");
			$filename=date("Y-m-d_H:i:s")."-".$filename;
			$total_records=$success + $error;
			$query1="INSERT INTO import_record (import_date, import_month, file_name, type, processed_records, total_records) VALUES('$import_date','$import_month','$filename','collection',$success, $total_records)";
			$res1 = pg_query($conn, $query1);
			//require_once('collection_sheet_upload.php');
		}	
		if($success + $error > 0)
		{
			// <div style='color:red'>Row(s) not Inserted - ".$error."</div>
			echo "<script>$('#modal-result').html(`<div style='display: flex; justify-content: space-between'>
			<div style='color:green'>Row(s) Inserted - ".$success."</div>
			</div>
			";
			echo"
			<div>
			<div style='display: flex; justify-content: space-between;' >
			<div style='color:red'id='nomailimport'></div>
			</div>
			</div>
			`);</script>";

			// echo '<script>
			// function myFunction() {
			// 	var x = document.getElementById("mailshowhide");
			// 	if (x.style.display === "none") {
			// 		x.style.display = "block";
			// 		} else {
			// 			x.style.display = "none";
			// 		}
			// 	}
			// 	</script>';
		}
		else 
		{
				echo "<script>
						updateProgress(0);
						</script>";
					echo "<script>$('#modal-close-btn').show();</script>";
			echo "<script>$('#modal-result').html('Data mismatch in file.');</script>";
		}
		echo "<script>$('#modal-close-ok-btn').show();</script>";
	}
	else
	{
		echo "<script>$('#modal-close-btn').show();</script>";
		
		echo "<script>var div = document.getElementById('errorupload');
		div.innerHTML += 'Please upload csv/xls/xlsx file';</script>";
	}
}
else{
	echo "<script>window.location.href = './sap-dump.php'</script>";
}
?>

