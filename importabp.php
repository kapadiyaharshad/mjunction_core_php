<?php
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

spl_autoload_register(function ($class_name) 
{
	$preg_match = preg_match('/^PhpOffice\\\PhpSpreadsheet\\\/', $class_name);

	if (1 === $preg_match) {
		$class_name = preg_replace('/\\\/', '/', $class_name);
		$class_name = preg_replace('/^PhpOffice\\/PhpSpreadsheet\\//', '', $class_name);
		require_once(__DIR__ . '/vendor/PhpSpreadsheet/' . $class_name . '.php');
	}
});
$conn = OpenCon();
if (isset($_POST['importAbp'])) 
{
	$file = $_FILES['doc_abp']['tmp_name'];
	echo "<script>$('#uploadModal').show();</script>";
	$ext = pathinfo($_FILES['doc_abp']['name'], PATHINFO_EXTENSION);
	if ($ext == 'xlsx' || $ext == 'xls' || $ext == 'csv') {
		require_once("./vendor/autoload.php");
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
			echo $getHighestRow;
			for ($i = 2; $i <= $getHighestRow; $i++, $tp++) {
				$checkemail = '';
				// to check that the uploaded file is in correct format
				if ($sheet->getCellByColumnAndRow(1, 1)->getValue() == "Financial Year"
				&& $sheet->getCellByColumnAndRow(2, 1)->getValue() == "Business Unit"
				&& $sheet->getCellByColumnAndRow(3, 1)->getValue() == "Profit Center"
				&& $sheet->getCellByColumnAndRow(4, 1)->getValue() == "Payer Code"
				&& $sheet->getCellByColumnAndRow(5, 1)->getValue() == "Client Name"
				&& $sheet->getCellByColumnAndRow(6, 1)->getValue() == "Apr"
				&& $sheet->getCellByColumnAndRow(7, 1)->getValue() == "May"
				&& $sheet->getCellByColumnAndRow(8, 1)->getValue() == "Jun"
				&& $sheet->getCellByColumnAndRow(9, 1)->getValue() == "Jul"
				&& $sheet->getCellByColumnAndRow(10, 1)->getValue() == "Aug"
				&& $sheet->getCellByColumnAndRow(11, 1)->getValue() == "Sep"
				&& $sheet->getCellByColumnAndRow(12, 1)->getValue() == "Oct"
				&& $sheet->getCellByColumnAndRow(13, 1)->getValue() == "Nov"
				&& $sheet->getCellByColumnAndRow(14, 1)->getValue() == "Dec"
				&& $sheet->getCellByColumnAndRow(15, 1)->getValue() == "Jan"
				&& $sheet->getCellByColumnAndRow(16, 1)->getValue() == "Feb"
				&& $sheet->getCellByColumnAndRow(17, 1)->getValue() == "Mar"
				) {
					$year = $sheet->getCellByColumnAndRow(1, $i)->getValue();
					$bu = $sheet->getCellByColumnAndRow(2, $i)->getValue();
					$profit_center = $sheet->getCellByColumnAndRow(3, $i)->getValue();
					$payer_code = $sheet->getCellByColumnAndRow(4, $i)->getValue();
					$client_name = $sheet->getCellByColumnAndRow(5, $i)->getValue();
					$Apr = $sheet->getCellByColumnAndRow(6, $i)->getValue();
					$May = $sheet->getCellByColumnAndRow(7, $i)->getValue();
					$Jun = $sheet->getCellByColumnAndRow(8, $i)->getValue();
					$Jul = $sheet->getCellByColumnAndRow(9, $i)->getValue();
					$Aug = $sheet->getCellByColumnAndRow(10, $i)->getValue();
					$Sep = $sheet->getCellByColumnAndRow(11, $i)->getValue();
					$Oct = $sheet->getCellByColumnAndRow(12, $i)->getValue();
					$Nov = $sheet->getCellByColumnAndRow(13, $i)->getValue();
					$Dec = $sheet->getCellByColumnAndRow(14, $i)->getValue();
					$Jan = $sheet->getCellByColumnAndRow(15, $i)->getValue();
					$Feb = $sheet->getCellByColumnAndRow(16, $i)->getValue();
					$Mar = $sheet->getCellByColumnAndRow(17, $i)->getValue();

					// $month = date("M/Y");
					$month_names = ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar"];
					$year = (int)(explode('-', $year)[0]);
					$date = date("y/m/d H:i:s");
					for ($j = 1; $j <= 12; $j++) {
						$checkabp = true;
						$validData = false;
						$valid = false;
						if ($j == 10) {
							$year += 1;
						}
						$month = $month_names[$j - 1] . '-' . $year;
						$month = date('M-Y', strtotime($month));
						$target_amount = $sheet->getCellByColumnAndRow($j + 5, $i)->getValue();
						// to check that no feild is empty
						
						if ($_POST['abp_type'] == 'abp') {
							if ($bu != '' && $profit_center != '' && $payer_code != '' && $client_name != '') {
								$sql = pg_query($conn, "SELECT * FROM abp");
								while ($row = pg_fetch_assoc($sql)) {
									if (strtolower($row['client_name']) == strtolower($client_name) && $month == $row['month']) {
										$checkabp = false;
									}
								}
								if ($checkabp) {
									$sql = pg_query($conn, "SELECT * FROM static_master_bu");
									while ($row = pg_fetch_assoc($sql)) {
										if (strtolower($row['bu']) == strtolower($bu)) {
											$valid = true;
											$bu = $row['bu'];
											break;
										}
									}
								}
								if ($valid) {
									$sql = pg_query($conn, "SELECT * FROM clients WHERE business_unit = '$bu'");
									while ($row = pg_fetch_assoc($sql)) {
										if ($row['payercode'] == $payer_code && strtolower($row['clientname']) == strtolower($client_name)) {
											$validData = true;
											$client_name = $row['clientname'];
											break;
										}
									}
								}
								if ($checkabp && $validData && is_numeric($target_amount)) {
										$query = "
									INSERT INTO abp(month, bu, profit_center, client_name, payer_code, target_amount, created_date)
									VALUES('$month','$bu','$profit_center','$client_name','$payer_code','$target_amount','$date')
								";
									$res = pg_query($conn, $query);
									if ($res) {
										$success += 1;
									}
									else {
										$error += 1;
									}
								}
								else {
									$error += 1;
								}
							}
						}

						else if ($_POST['abp_type'] == 'abp_vaor') {
							if ($bu != '' && $profit_center != '' && $payer_code != '' && $client_name != '') {
								$sql = pg_query($conn, "SELECT * FROM abp_vaor");
								while ($row = pg_fetch_assoc($sql)) {
									if (strtolower($row['client_name']) == strtolower($client_name) && $month == $row['month']) {
										$checkabp = false;
									}
								}
								if ($checkabp) {
									$sql = pg_query($conn, "SELECT * FROM static_master_bu");
									while ($row = pg_fetch_assoc($sql)) {
										if (strtolower($row['bu']) == strtolower($bu)) {
											$valid = true;
											$bu = $row['bu'];
											break;
										}
									}
								}
								if ($valid) {
									$sql = pg_query($conn, "SELECT * FROM clients WHERE business_unit = '$bu'");
									while ($row = pg_fetch_assoc($sql)) {
										if ($row['payercode'] == $payer_code && strtolower($row['clientname']) == strtolower($client_name)) {
											$validData = true;
											$client_name = $row['clientname'];
											break;
										}
									}
								}
								if ($checkabp && $validData && is_numeric($target_amount)) {
										$query = "
									INSERT INTO abp_vaor(month, bu, profit_center, client_name, payer_code, target_amount, created_date)
									VALUES('$month','$bu','$profit_center','$client_name','$payer_code','$target_amount','$date')
								";
									$res = pg_query($conn, $query);
									if ($res) {
										$success += 1;
									}
									else {
										$error += 1;
									}
								}
								else {
									$error += 1;
								}
							}
						}
						else {
							$empty += 1;
							array_push($emptyemail, $email);
						}
					}
					$progress = ($tp) / ($getHighestRow - 1) * 100;
					echo "<script>
						updateProgress(" . $progress . ");
						</script>"
						;
				}
			}
		}

		if ($success + $error + $empty > 0) {
			echo "<script>$('#modal-result').html(`
			<div style='display: flex; justify-content: space-between'>
				<div style='color:green'>Rows Submited - " . $success . "</div>
				<div></div>
				<div style='color:orange'>Not Submited Rows - " . $error . "</div>
			</div>
			";
			echo "
    			`);
    			</script>";
		}
		else {
			echo "<script>$('#modal-result').html('No data or invalid data in file.');</script>";
		}
		echo "<script>$('#modal-close-btn').show();</script>";
	}
	else {
		echo "<script>$('#modal-close-btn').show();</script>";
		echo "<script>var div = document.getElementById('errorupload');
		div.innerHTML += 'Please upload csv/xls/xlsx file';</script>";
	}
}
?>
