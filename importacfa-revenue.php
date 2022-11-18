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
		require_once(__DIR__ . '/vendor/PhpSpreadsheet/' . $class_name . '.php');
	}
});
// error_reporting(0);
// database connection
$conn = OpenCon();

if(isset($_POST['import']))
{
	$file=$_FILES['doc']['tmp_name'];
	echo "<script>$('#uploadModal').show();</script>";
	$ext=pathinfo($_FILES['doc']['name'],PATHINFO_EXTENSION);
	if($ext=='xlsx' || $ext=='xls' || $ext=='csv' )
	{
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
			echo $getHighestRow;
			for($i=2;$i<=$getHighestRow;$i++,$tp++)
			{	
				$checkemail='';
				// to check that the uploaded file is in correct format
				if (   $sheet->getCellByColumnAndRow(1,1)->getValue() == "Business Unit"
					&& $sheet->getCellByColumnAndRow(2,1)->getValue() == "Service"
					&& $sheet->getCellByColumnAndRow(3,1)->getValue() == "Client Name"
					&& $sheet->getCellByColumnAndRow(4,1)->getValue() == "Actual Collection F & A"
					) 
				{
					// echo "<script>alert('inside')</script>";
					$bu=		$sheet->getCellByColumnAndRow(1,$i)->getValue();
					$Service=		$sheet->getCellByColumnAndRow(2,$i)->getValue();
					$cn=		$sheet->getCellByColumnAndRow(3,$i)->getValue();
					$acfa=	$sheet->getCellByColumnAndRow(4,$i)->getValue();
					// $valid = false;
					$validData = false;
					// to check that no feild is empty
					if($bu!='' && $Service != '' && $cn!='' && $acfa != '')
					{
						$bu = strtolower($bu);
						$sql = pg_query($conn,"SELECT * FROM revenue_table WHERE LOWER(business) = '$bu'");
						while ($row = pg_fetch_assoc($sql)) 
						{
							if(strtolower($row['client_name']) == strtolower($cn) && strtolower($row['service']) == strtolower($Service)){
								$validData = true;
								break;
							}
							$cn = strtolower($row['service']);
								
						}
						if ($validData && is_numeric($acfa)) 
						{
							$query = "
								UPDATE revenue_table SET 
								actual = $acfa
								where (LOWER(business) = '$bu' AND LOWER(service) = '$Service' AND LOWER(client_name) = '$cn')";
							$res = pg_query($conn, $query);
							if($res) 
							{
								$success += 1;
							}
							else 
							{
								$error += 1;
							}
						}
						else{
							$error += 1;
						}
					}
					else{
						$empty+=1;
						array_push($emptyemail, $email);
					}
					$progress = ($tp) / ($getHighestRow - 1) * 100;
					echo "<script>
						updateProgress(".$progress.");
						</script>"
					;
				}
			}
		}
		if($success + $error + $empty > 0)
		{
			echo "<script>$('#modal-result').html(`
			<div style='display: flex; justify-content: space-between'>
				<div style='color:green'>Rows Submited - ".$success."</div>
				<div></div>
				<div></div>
			</div>
			";
    		echo"`);</script>";
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
