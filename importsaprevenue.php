<?php
// current time
if (isset($_POST['importsaprevenue'])) {
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
	spl_autoload_register(function ($class_name) {
		$preg_match = preg_match('/^PhpOffice\\\PhpSpreadsheet\\\/', $class_name);

		if (1 === $preg_match) {
			$class_name = preg_replace('/\\\/', '/', $class_name);
			$class_name = preg_replace('/^PhpOffice\\/PhpSpreadsheet\\//', '', $class_name);
			require_once(__DIR__ . '/PhpSpreadsheet/' . $class_name . '.php');
		}
	});
	// error_reporting(0);
	// database connection
	$conn = OpenCon();
	$sql = pg_query($conn, "SELECT * FROM collection_sap_dump");
	$id = 0;
	date_default_timezone_set('Asia/Kolkata');
	$file = $_FILES['doc']['tmp_name'];
	$filename = $_FILES['doc']['name'];
	// echo '<script>console.log("'.$filename.'")</script>';
	echo "<script>$('#uploadModal').show();</script>";
	$ext = pathinfo($_FILES['doc']['name'], PATHINFO_EXTENSION);
	if ($ext == 'xlsx' || $ext == 'xls' || $ext == 'csv') {
		require_once("vendor/autoload.php");
		$obj = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
		$success = 0;
		$empty = 0;
		$emptyemail = array();
		$successemail = array();
		$erroremail = array();
		$error = 0;
		$flag = 0;
		$nomail = 0;
		$tp = 1;
		foreach ($obj->getWorksheetIterator() as $sheet) {
			$getHighestRow = $sheet->getHighestDataRow();
			// echo "<script>console.log('Message here $getHighestRow')</script>";
			for ($i = 2; $i <= $getHighestRow; $i++, $tp++) {
				$Assignment					= $sheet->getCellByColumnAndRow(1, $i)->getValue();
				$_1                     	= $sheet->getCellByColumnAndRow(2, $i)->getValue();
				$Document_Number 			= $sheet->getCellByColumnAndRow(3, $i)->getValue();
				$Document_Type				= $sheet->getCellByColumnAndRow(4, $i)->getValue();
				$Document_Date 				= $sheet->getCellByColumnAndRow(5, $i)->getValue();
				$Posting_Key  				= $sheet->getCellByColumnAndRow(6, $i)->getValue();
				$Amount_in_local_currency	= $sheet->getCellByColumnAndRow(7, $i)->getValue();
				$Reference 					= $sheet->getCellByColumnAndRow(8, $i)->getValue();
				$Text			  			= $sheet->getCellByColumnAndRow(9, $i)->getValue();
				$Cost_Center		 		= $sheet->getCellByColumnAndRow(10, $i)->getValue();
				$Profit_Center				= $sheet->getCellByColumnAndRow(11, $i)->getValue();
				$Sp_G_L_trans_type			= $sheet->getCellByColumnAndRow(12, $i)->getValue();
				$G_L_Account  				= $sheet->getCellByColumnAndRow(13, $i)->getValue();
				$Posting_Date  				= $sheet->getCellByColumnAndRow(14, $i)->getValue();
				$Name_1						= $sheet->getCellByColumnAndRow(15, $i)->getValue();
				$Purchasing_Document		= $sheet->getCellByColumnAndRow(16, $i)->getValue();
				$Material					= $sheet->getCellByColumnAndRow(17, $i)->getValue();
				$Sales_Document  			= $sheet->getCellByColumnAndRow(18, $i)->getValue();
				$Clearing_Document  		= $sheet->getCellByColumnAndRow(19, $i)->getValue();
				$Customer	  				= $sheet->getCellByColumnAndRow(20, $i)->getValue();
				$upload_type				= $_POST['upload_type'];

				if (
					'Assignment'				== $sheet->getCellByColumnAndRow(1, 1)->getValue()
					&&  '1'                     	== $sheet->getCellByColumnAndRow(2, 1)->getValue()
					&&  'Document Number' 			== $sheet->getCellByColumnAndRow(3, 1)->getValue()
					&&  'Document Type'				== $sheet->getCellByColumnAndRow(4, 1)->getValue()
					&&  'Document Date' 			== $sheet->getCellByColumnAndRow(5, 1)->getValue()
					&&  'Posting Key'  				== $sheet->getCellByColumnAndRow(6, 1)->getValue()
					&&  'Amount in local currency'	== $sheet->getCellByColumnAndRow(7, 1)->getValue()
					&&  'Reference' 				== $sheet->getCellByColumnAndRow(8, 1)->getValue()
					&&  'Text'			  			== $sheet->getCellByColumnAndRow(9, 1)->getValue()
					&&  'Cost Center'		 		== $sheet->getCellByColumnAndRow(10, 1)->getValue()
					&&  'Profit Center'				== $sheet->getCellByColumnAndRow(11, 1)->getValue()
					&&  'Sp.G/L trans type'			== $sheet->getCellByColumnAndRow(12, 1)->getValue()
					&&  'G/L Account'  				== $sheet->getCellByColumnAndRow(13, 1)->getValue()
					&&  'Posting Date'  			== $sheet->getCellByColumnAndRow(14, 1)->getValue()
					&&  'Name 1'					== $sheet->getCellByColumnAndRow(15, 1)->getValue()
					&&  'Purchasing Document'		== $sheet->getCellByColumnAndRow(16, 1)->getValue()
					&&  'Material'					== $sheet->getCellByColumnAndRow(17, 1)->getValue()
					&&  'Sales Document'  			== $sheet->getCellByColumnAndRow(18, 1)->getValue()
					&&  'Clearing Document'  		== $sheet->getCellByColumnAndRow(19, 1)->getValue()
					&&  'Customer'  				== $sheet->getCellByColumnAndRow(20, 1)->getValue()
				) {
					$check_client = 'SELECT * FROM clients';
					$result_check = pg_query($conn, $check_client);
					$checked = false;
					if (pg_num_rows($result_check) > 0) {
						while ($row = pg_fetch_assoc($result_check)) {
							$Customer = strtolower($Customer);
							$clientname = strtolower($row['clientname']);
							// echo '<script>console.log("'.$row['profit_center'].'")</script>';
							// if($Profit_Center==$row['profit_center'])
							// echo '<script>console.log("'.$clientname." ".$Customer.'")</script>';
							
							//old code
							// if ($Customer == $clientname && $Profit_Center == $row['profit_center']) {
							if ($Customer == $clientname) {	
								$checked = true;
								$client_name = strtolower($row['clientname']);
								$client_account_type = $row['account_type'];
								$client_bu = $row['business_unit'];
								$client_category = $row['category'];
								$client_service = $row['services'];
							}

							//get client name and insert ec nc entry in db
							if ($Customer == $clientname) {
								$ec_nc_name = $row['business_segment'];
							}
						}
					}
					// $abp_client = "SELECT * FROM abp where client_name='".$client_name."'";
					//           	$result_abp = pg_query($conn, $abp_client);
					//           	if (pg_num_rows($result_abp)>0) 
					// {
					// 	while ($row = pg_fetch_assoc($result_abp)) 
					// 	{
					// 		$abp = $row['target_amount'];
					// 	}
					// }
					if ($checked) {
						$query = "
						INSERT INTO revenue_sap_dump
						(
						   assignment, _1, document_number, document_type, document_date, posting_key,	amount_in_local_currency, reference, text,
						   cost_center, profit_center, sp_g_l_trans_type,	g_l_account, posting_date, name_1,	purchasing_document, material,
						 	sales_document, clearing_document,	customer, dump_type
						)
						VALUES(
							'$Assignment',
							'$_1',
							'$Document_Number',
							'$Document_Type',
							'$Document_Date',
							'$Posting_Key',
							'$Amount_in_local_currency',
							'$Reference',
							'$Text',
							'$Cost_Center',
							'$Profit_Center',
							'$Sp_G_L_trans_type',
							'$G_L_Account',
							'$Posting_Date',
							'$Name_1',
							'$Purchasing_Document',
							'$Material',
							'$Sales_Document',
							'$Clearing_Document',
							'$Customer',
							'$upload_type'
						)";
						$res = pg_query($conn, $query);
						if ($res) {
							$check_revenue = "SELECT * FROM revenue_table";
							// echo "<script>console.log($check_revenue)</script>";
							$cur_date = date('M-Y');
							$result_revenue_check = pg_query($conn, $check_revenue);
							if (pg_num_rows($result_revenue_check) > 0) {
								$flag = false;
								while ($row = pg_fetch_assoc($result_revenue_check)) {
									if ($row['client_name'] == $client_name && $row['month'] == $cur_date) {
										$flag = true;
										if (empty($row[$upload_type])) {
											$insert_revenue = "
												UPDATE revenue_table SET
												" . $upload_type . " = '$Amount_in_local_currency'
												WHERE client_name ='" . $client_name . "'";;
											pg_query($conn, $insert_revenue);
											$success += 1;
										}
										// else
										// 	$error += 1;
									}
									// else
									// 	$error += 1;
								}
								if (!$flag) {

									$month = date("M-Y");
									$insert_revenue = "
										INSERT INTO revenue_table 
										(month,ecnc,category, business, service, account_type, client_name," . $upload_type . ")
										VALUES('$month','$ec_nc_name','$client_category','$client_bu','$client_service','$client_account_type','$client_name','$Amount_in_local_currency')
									";

									pg_query($conn, $insert_revenue);
									$success += 1;
								} else
									$error += 1;
							} else {

								$month = date("M-Y");
								$insert_revenue = "
									INSERT INTO revenue_table 
									(month,ecnc,category, business, service, account_type, client_name," . $upload_type . ")
									VALUES('$month','$ec_nc_name','$client_category','$client_bu','$client_service','$client_account_type','$client_name','$Amount_in_local_currency')
								";

								pg_query($conn, $insert_revenue);
								$success += 1;
							}
							// echo "<script>console.log('$insert_revenue')</script>";
						} else {
							$error += 1;
							if ($error > 0) {
								$error_query = "SELECT * FROM errors_log WHERE customer_name = '$Customer' OR profit_center = '$Profit_Center' ";
							$result_error_check = pg_query($conn, $error_query);
							if (pg_num_rows($result_error_check) == 0) {
								$today_date = date('d-m-yy');
								$dicription = "Client name or Profict center is incorrect";
								$error_insert = "INSERT INTO errors_log(customer_name,profit_center,description,create_at) VALUES('$Customer','$Profit_Center','$dicription','$today_date')";
								pg_query($conn, $error_insert);
							}
							}
						}
						$progress = ($tp) / ($getHighestRow - 1) * 100;
						echo "<script>
						updateProgress(" . $progress . ");
						</script>";
					} else if (!$checked && (!empty($Customer))) {
						$error += 1;
						if ($error > 0) {
							$error_query = "SELECT * FROM errors_log WHERE customer_name = '$Customer' OR profit_center = '$Profit_Center' ";
							$result_error_check = pg_query($conn, $error_query);
							if (pg_num_rows($result_error_check) == 0) {
								$today_date = date('d-m-yy');
								$dicription = "Client name or Profict center is incorrect";
								$error_insert = "INSERT INTO errors_log(customer_name,profit_center,description,create_at) VALUES('$Customer','$Profit_Center','$dicription','$today_date')";
								pg_query($conn, $error_insert);
							}
						}
					}
				} else {
					echo "<script>
						updateProgress(0);
						</script>";
					echo "<script>$('#modal-close-ok-btn').show();</script>";
					echo "<script>$('#modal-result').html('Data mismatch in file.');</script>";
				}
			}
		}
		echo "<script>$('#modal-close-ok-btn').show();</script>";
		if ($success >= 1) {
			$import_date = date("d-H:i:s");
			$import_month = date("M-Y");
			$filename = date("Y-m-d_H:i:s") . "-" . $filename;
			$total_records = $getHighestRow - 1;
			$query1 = "INSERT INTO import_record (import_date, import_month, file_name, type, processed_records, total_records) VALUES('$import_date','$import_month','$filename','revenue',$success, $total_records)";
			// echo "<script>alert('".$query1."')</script>";
			$res1 = pg_query($conn, $query1);
			//require_once('revenue_sheet_upload.php');
		}

		if ($success + $error > 0) {
			echo "<script>$('#modal-close-ok-btn').show();</script>";
			// <div style='color:red'>Row(s) not Inserted - ".$error."</div>
			echo "<script>$('#modal-result').html(`<div style='display: flex; justify-content: space-between'>
			<div style='color:green'>Row(s) Inserted - " . $success . "</div>
			</div>
			";
			echo "
			<div>
			<div style='display: flex; justify-content: space-between;' >
			<div style='color:red'id='nomailimport'></div>
			</div>
			</div>
			`);</script>";
			// echo "<script>$('#modal-close-ok-btn').show();</script>";
		} else {
			echo "<script>
				updateProgress(0);
				</script>";
			echo "<script>$('#modal-close-ok-btn').show();</script>";
			echo "<script>$('#modal-result').html('no data or invalid data.');</script>";
		}
	} else {
		echo "<script>$('#modal-close-ok-btn').show();</script>";

		echo "<script>var div = document.getElementById('errorupload');
		div.innerHTML += 'Please upload csv/xls/xlsx file';</script>";
	}
} else {
	echo "<script>window.location.href = './sap-dump'</script>";
}
