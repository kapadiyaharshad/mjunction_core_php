<?php
// include "./database/sql.php";
// current time
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
	<a href='sap-dump.php'><button type='button' id='modal-close-ok-btn' class='btn btn-primary user-btn ml-2' data-dismiss='modal' aria-label='Close' style='float:right;'>ok</button></a>
</div>
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
		require_once(__DIR__ . '/vendor/PhpSpreadsheet/' . $class_name . '.php');
	}
});
// error_reporting(0);
// database connection
$conn = OpenCon();

if (isset($_POST['importacfacollection'])) {
	echo "<script>console.log('hi')</script>";
	$file = $_FILES['doc']['tmp_name'];
	echo "<script>$('#uploadModal').show();</script>";
	$ext = pathinfo($_FILES['doc']['name'], PATHINFO_EXTENSION);
	if ($ext == 'xlsx' || $ext == 'xls' || $ext == 'csv') {
		require_once("./vendor/autoload.php");
		$obj = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
		// $obj=PHPExcel_IOFactory::load($file);
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
			echo $getHighestRow;
			for ($i = 2; $i <= $getHighestRow; $i++, $tp++) {
				$checkemail = '';
				// to check that the uploaded file is in correct format
				if (
					$sheet->getCellByColumnAndRow(1, 1)->getValue() == "Business Unit"
					&& $sheet->getCellByColumnAndRow(2, 1)->getValue() == "Profit Center"
					&& $sheet->getCellByColumnAndRow(3, 1)->getValue() == "Payer Code"
					&& $sheet->getCellByColumnAndRow(4, 1)->getValue() == "Actual Collection F & A"
					&& $sheet->getCellByColumnAndRow(5, 1)->getValue() == "Client Name"
					&& $sheet->getCellByColumnAndRow(6, 1)->getValue() == "Amount Outstanding"
					&& $sheet->getCellByColumnAndRow(7, 1)->getValue() == "Bucket"
					&& $sheet->getCellByColumnAndRow(8, 1)->getValue() == "Invoice Number"
					&& $sheet->getCellByColumnAndRow(9, 1)->getValue() == "SAP Reference"
				) {
					// echo "<script>alert('inside')</script>";
					$bu =		$sheet->getCellByColumnAndRow(1, $i)->getValue();
					$profit_center =		$sheet->getCellByColumnAndRow(2, $i)->getValue();
					$payer_code =		$sheet->getCellByColumnAndRow(3, $i)->getValue();
					$actual_collection_f_a =	$sheet->getCellByColumnAndRow(4, $i)->getValue();
					$client_name =	$sheet->getCellByColumnAndRow(5, $i)->getValue();
					$amount_outstanding =	$sheet->getCellByColumnAndRow(6, $i)->getValue();
					$bucket =	$sheet->getCellByColumnAndRow(7, $i)->getValue();
					$invoice_number =	$sheet->getCellByColumnAndRow(8, $i)->getValue();
					$sap_reference =	$sheet->getCellByColumnAndRow(9, $i)->getValue();
					$month = date('M-Y');
					// to check that no feild is empty
					if ($bu != '' && $profit_center != '' && $payer_code != '' && $actual_collection_f_a != '' && $client_name != '' && $amount_outstanding != '' && $bucket != '' && $invoice_number != '' && $sap_reference != '') {
						$sql = pg_query($conn, "SELECT * FROM collection WHERE month='$month'");
						if (pg_num_rows($sql) > 0) {
							while($data = pg_fetch_assoc($sql)){
							if ($bu == $data['bu'] && $profit_center == $data['profit_center'] && $payer_code == $data['payer_code']  && $client_name == $data['client_name'] && $amount_outstanding == $data['total_outstanding'] && $bucket == $data['bucket'] && $invoice_number == $data['invoice_number'] && $sap_reference == $data['sap_ref_number']) {
								
								if ($data['actual_collection_f_a'] == '' || $data['actual_collection_f_a'] == null) {
									$query = "
								UPDATE collection SET actual_collection_f_a = $actual_collection_f_a
								 where (bu like'%$bu%' AND profit_center = '$profit_center' AND payer_code = '$payer_code' AND client_name = '$client_name' AND total_outstanding = '$amount_outstanding' AND bucket = '$bucket' AND invoice_number = '$invoice_number' AND sap_ref_number = '$sap_reference')";
								
								 $res = pg_query($conn, $query);
									if ($res) {
										$success += 1;
										// array_push($successemail, $email);
									} else {
										$error += 1;
										// 	array_push($erroremail, $email);
									}
								}
							}
						}
					}
						// 		if (is_numeric($number) && strlen($number)==10) 
						// 		{
						// 			$email = test_input($email);
						// 			$checkemail = filter_var($email, FILTER_VALIDATE_EMAIL);
						// 			if ($checkemail!='') 
						// 			{
						// $date = date("Y/m/d H:m:s");

						// 			}
						// 			else{
						// 				$error += 1;
						// 				array_push($erroremail, $email);
						// 			}
						// 		}
						// 		else{
						// 			$error += 1;
						// 			array_push($erroremail, $email);
						// 		}
					} else {
						$empty += 1;
						array_push($emptyemail, $email);
					}
					$progress = ($tp) / ($getHighestRow - 1) * 100;
					echo "<script>
								updateProgress(" . $progress . ");
								</script>";
				} else {
					// echo "  hello  ";
					// echo " ".$sheet->getCellByColumnAndRow(1,2)->getValue()." " ;
				}
			}
		}
		if ($success + $error + $empty > 0) {
			echo "<script>$('#modal-result').html(`<div style='display: flex; justify-content: space-between'>
			<div style='color:green'>Rows Submited - " . $success . "</div>
			<div</div>
			<div></div>
			</div>
			";
			echo "<div style='display:none;'id='mailshowhide'>";
			for ($i = 0; $i < sizeof($erroremail); $i++) {
				echo "
				<div >
				<div style='display: flex; justify-content: space-between;' >
				<div style='color:yellow'></div>
				<div style='color:red'>" . $erroremail[$i] . "</div>
				</div>
				";
			}
			// echo "</div>";
			// echo "<div style='display:none;'id='mailshowhide'>";
			for ($i = 0; $i < sizeof($emptyemail); $i++) {
				echo "
				<div >
				<div style='display: flex; justify-content: space-between;' >
				<div style='color:orange'>" . $emptyemail[$i] . "</div>
				<div style='color:red'></div>
				</div>
				";
			}
			echo "</div>";

			echo "
    			<div>
    			<div style='display: flex; justify-content: space-between;' >
    			<div style='color:red'id='nomailimport'></div>
    			</div>
    			</div>
    			`);</script>";

			echo '<script>
    			function myFunction() {
    				var x = document.getElementById("mailshowhide");
    				if (x.style.display === "none") {
    					x.style.display = "block";
    					} else {
    						x.style.display = "none";
    					}
    				}
    				</script>';
		} else {
			echo "<script>$('#modal-result').html('No data or invalid data in file.');</script>";
		}
		echo "<script>$('#modal-close-btn').show();</script>";
	} else {
		echo "<script>$('#modal-close-btn').show();</script>";
		echo "<script>var div = document.getElementById('errorupload');
		div.innerHTML += 'Please upload csv/xls/xlsx file';</script>";
	}
}
