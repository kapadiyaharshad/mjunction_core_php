<div class='modal modal-fade' style='background-color:rgba(0,0,0,0.5);' id='uploadModal' tabindex='-1' role='dialog' aria-labelledby='modalTitle' aria-hidden='true'>
	<div class='modal-dialog modal-dialog-centered ' role='document'>
		<div class='modal-content'>
			<div class='modal-header'>
				<h5 class='modal-title' id='modalTitle'>Data Uploadeddd</h5>
				<button type='button' id='modal-close-btn' class='close' data-dismiss='modal' aria-label='Close' onclick='$("#uploadModal").hide();' style='display: none;'> <span aria-hidden='true'>&times;</span> </button>
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
<?php
// current time
// include "./database/sql.php";
date_default_timezone_set('Asia/Kolkata');
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
$sql = pg_query($conn,"SELECT * FROM collection");
$id = 0;
if(isset($_POST['importcollection']))
{
					// echo "<script>alert('inside')</script>";

	$file=$_FILES['doc']['tmp_name'];
	echo "<script>$('#uploadModal').show();</script>";
	$ext=pathinfo($_FILES['doc']['name'],PATHINFO_EXTENSION);
	if($ext=='xlsx' || $ext=='xls' || $ext=='csv' )
	{
					// echo "<script>alert('inside')</script>";

		require_once("./vendor/autoload.php"); 
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
			for($i=2;$i<=$getHighestRow;$i++,$tp++)
			{	
					
				$month=$sheet->getCellByColumnAndRow(1,$i)->getValue();
				$classification=$sheet->getCellByColumnAndRow(2,$i)->getValue();
				$account=$sheet->getCellByColumnAndRow(3,$i)->getValue();
				$bu=$sheet->getCellByColumnAndRow(4,$i)->getValue();
				$profit_center=$sheet->getCellByColumnAndRow(5,$i)->getValue();
				$payer_code=$sheet->getCellByColumnAndRow(6,$i)->getValue();
				$client_name=$sheet->getCellByColumnAndRow(7,$i)->getValue();
				$bucket=$sheet->getCellByColumnAndRow(8,$i)->getValue();
				$total_outstanding=$sheet->getCellByColumnAndRow(9,$i)->getValue();
				$original_estimate=$sheet->getCellByColumnAndRow(10,$i)->getValue();
				$revised_estimate=$sheet->getCellByColumnAndRow(11,$i)->getValue();
				$actual_collection_f_a=$sheet->getCellByColumnAndRow(12,$i)->getValue();
				$am_estimate=$sheet->getCellByColumnAndRow(13,$i)->getValue();
				$assumptions=$sheet->getCellByColumnAndRow(14,$i)->getValue();
				$month=str_replace("'","/",$month);
					
				$query = "
				INSERT INTO collection(month,
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
				actual_collection_f_a,
				am_estimate,
				assumptions)
				VALUES(
				'$month',
				'$classification',
				'$account',
				'$bu',
				'$profit_center',
				'$payer_code',
				'$client_name',
				'$bucket',
				'$total_outstanding',
				'$original_estimate',
				'$revised_estimate',
				'$actual_collection_f_a',
				'$am_estimate',
				'$assumptions')";
				$res = pg_query($conn, $query);
				if($res) 
				{
					$success += 1;
				}
				else 
				{
					$error += 1;
				}
				$progress = ($success + $error + $empty) / ($getHighestRow - 1) * 100;

				echo "<script>
				updateProgress(".$progress.");
				</script>";
			}
		}
		if($success + $error + $empty > 0)
		{
			echo "<script>$('#modal-result').html(`<div style='display: flex; justify-content: space-between'>
			<div style='color:green'>Data Entered - ".$success."</div>
			
			<div style='color:red'>Error - ".$error."
			
			</div>
			</div>
			";
			echo "<div style='display:none;'id='mailshowhide'>";
			for($i=0;$i<=sizeof($erroremail);$i++)
			{
				echo"
				<div >
				<div style='display: flex; justify-content: space-between;' >
				<div style='color:red'> </div>
				<div style='color:red'> </div>
				<div style='color:red'>".$erroremail[$i]."</div>
				</div>
				";
			}
			echo "</div>";

			echo"
			<div>
			<div style='display: flex; justify-content: space-between;' >
			<div style='color:red'id='nomailimport'>h</div>
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
			echo "<script>var div = document.getElementById('errorupload');
			div.innerHTML += 'Please upload csv/xls/xlsx file';</script>";
		}
	}

	?>
