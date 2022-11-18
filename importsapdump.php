<?php
// current time
// require_once("./database/sql.php");
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
$sql = pg_query($conn,"SELECT * FROM sap_dump");
$id = 0;
if(isset($_POST['importsap']))
{
	
	$file=$_FILES['doc']['tmp_name'];
	echo "<script>$('#uploadModal').show();</script>";
	$ext=pathinfo($_FILES['doc']['name'],PATHINFO_EXTENSION);
	if($ext=='xlsx' || $ext=='xls' || $ext=='csv' )
	{
		require_once("vendor/autoload.php"); 
				echo "<script>$('#modal-close-btn').show();</script>";
		$obj = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
		// $obj=PHPExcel_IOFactory::load($file);
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
			echo "<script>console.log(".$getHighestRow.");</script>";
			for($i=2;$i<=$getHighestRow;$i++,$tp++)
			{
					$acc_doc_no=$sheet->getCellByColumnAndRow(1,$i)->getValue();

					$assignment_no=$sheet->getCellByColumnAndRow(2,$i)->getValue();
					
					$profit_center=$sheet->getCellByColumnAndRow(3,$i)->getValue();

					$account_cd=$sheet->getCellByColumnAndRow(4,$i)->getValue();

					$sold_to_party=$sheet->getCellByColumnAndRow(5,$i)->getValue();

					$sold_to_name=$sheet->getCellByColumnAndRow(6,$i)->getValue();

					$billing_date=$sheet->getCellByColumnAndRow(7,$i)->getValue();

					$credit_period=$sheet->getCellByColumnAndRow(8,$i)->getValue();

					$currency=$sheet->getCellByColumnAndRow(9,$i)->getValue();

					$total_outstanding=$sheet->getCellByColumnAndRow(10,$i)->getValue();

					$total_invoice_value=$sheet->getCellByColumnAndRow(11,$i)->getValue();
					
					$advance=$sheet->getCellByColumnAndRow(12,$i)->getValue();

					$within_credit_period=$sheet->getCellByColumnAndRow(13,$i)->getValue();

					$days_upto_30=$sheet->getCellByColumnAndRow(14,$i)->getValue();

					$days_31_60=$sheet->getCellByColumnAndRow(15,$i)->getValue();

					$days_61_90=$sheet->getCellByColumnAndRow(16,$i)->getValue();

					$days_91_120=$sheet->getCellByColumnAndRow(17,$i)->getValue();

					$days_121_150=$sheet->getCellByColumnAndRow(18,$i)->getValue();

					$days_151_180=$sheet->getCellByColumnAndRow(19,$i)->getValue();

					$days_181_365=$sheet->getCellByColumnAndRow(20,$i)->getValue();

					$days_above_365=$sheet->getCellByColumnAndRow(21,$i)->getValue();

					$due_days=$sheet->getCellByColumnAndRow(22,$i)->getValue();

					$remarks=$sheet->getCellByColumnAndRow(23,$i)->getValue();

					$invoice_or_odn_no=$sheet->getCellByColumnAndRow(24,$i)->getValue();

					$sap_ref_no=$sheet->getCellByColumnAndRow(25,$i)->getValue();
					
					$credit_period=str_replace("'","/",$credit_period);
				
					

					$query = "
					INSERT INTO sap_dump
					
					(advance,
					
					acc_doc_no,

					assignment_no,

					account_cd,

					sold_to_party,

					sold_to_name,

					billing_date,

					credit_period,

					currency,

					total_outstanding,

					total_invoice_value,

					within_credit_period,

					days_upto_30,

					days_31_60,

					days_61_90,

					days_91_120,

					days_121_150,

					days_151_180,

					days_181_365,

					days_above_365,

					due_days,

					remarks,

					invoice_or_odn_no,

					sap_ref_no,

					profit_center)

					VALUES
					(
					'$advance',
					'$acc_doc_no',
					'$assignment_no',
					'$account_cd',
					'$sold_to_party',
					'$sold_to_name',
					'$billing_date',
					'$credit_period',
					'$currency',
					'$total_outstanding',
					'$total_invoice_value',
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
					'$sap_ref_no',
					'$profit_center')";
					$res = pg_query($conn, $query);
					// console.log("Message here");
						// echo "<script>console.log('".pg_error()."');</script>";
						// echo $query;
					if($res) 
					{
						$success += 1;
					}
					else 
					{
						// error_log("You messed up!");
						echo "<script>console.log('hi');</script>";
						$error += 1;
					}
					$progress = ($success + $error + $empty) / ($getHighestRow - 1) * 100;

					echo "<script>
					updateProgress(".$progress.");
					</script>";
			}
		}
			
		if($success + $error > 0)
		{
			echo "<script>$('#modal-result').html(`<div style='display: flex; justify-content: space-between'>
			<div style='color:green'>Row(s) Inserted - ".$success."</div>
			<div style='color:red'>Row(s) not Inserted - ".$error."
			</div>
			</div>
			";
			// echo "<div style='display:none;'id='mailshowhide'>";
			// for($i=0;$i<=sizeof($erroremail);$i++)
			// {
			// 	echo"
			// 	<div >
			// 	<div style='display: flex; justify-content: space-between;' >
			// 	<div style='color:red'> </div>
			// 	<div style='color:red'> </div>
			// 	<div style='color:red'>".$erroremail[$i]."</div>
			// 	</div>
			// 	";
			// }
			// echo "</div>";

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
				echo "<script>$('#modal-result').html('No data or invalid data in file.');</script>";
			}
			echo "<script>$('#modal-close-btn').show();</script>";
		}
		else
		{
			echo "<script>$('#modal-close-btn').show();</script>";
			
			// echo "<script>var div = document.getElementById('errorupload');
			// div.innerHTML += 'Please upload csv/xls/xlsx file';</script>";
		}
	}
	?>
