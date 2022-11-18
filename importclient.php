<?php
// echo "<script>alert('hi')</script>";
// current time
// include "./database/sql.php";
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
//error_reporting(0);
// database connection
$conn = OpenCon();
$sql = pg_query($conn,"SELECT * FROM clients");
$id = 0;
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
			for($i=2;$i<=$getHighestRow;$i++,$tp++)
			{	
				$checkemail='';
				// to check that the uploaded file is in correct format
				if (   $sheet->getCellByColumnAndRow(1,1)->getValue() == "Client Name"
					&& $sheet->getCellByColumnAndRow(2,1)->getValue() == "Email"
					&& $sheet->getCellByColumnAndRow(3,1)->getValue() == "Mobile Number"
					&& $sheet->getCellByColumnAndRow(4,1)->getValue() == "Business Unit"
					&& $sheet->getCellByColumnAndRow(5,1)->getValue() == "Services"
					&& $sheet->getCellByColumnAndRow(6,1)->getValue() == "Category"
					&& $sheet->getCellByColumnAndRow(7,1)->getValue() == "Business Segment"
					&& $sheet->getCellByColumnAndRow(8,1)->getValue() == "Profit Center"
					&& $sheet->getCellByColumnAndRow(9,1)->getValue() == "Payer Code"
					&& $sheet->getCellByColumnAndRow(10,1)->getValue() == "Account Type"
					&& $sheet->getCellByColumnAndRow(11,1)->getValue() == "Account Manager"	
					&& $sheet->getCellByColumnAndRow(12,1)->getValue() == "Status"
				) 
				{
					$clientname=		$sheet->getCellByColumnAndRow(1,$i)->getValue();
					$email=				$sheet->getCellByColumnAndRow(2,$i)->getValue();
					$number=			$sheet->getCellByColumnAndRow(3,$i)->getValue();
					$business_unit=		$sheet->getCellByColumnAndRow(4,$i)->getValue();
					$services=			$sheet->getCellByColumnAndRow(5,$i)->getValue();
					$category=			$sheet->getCellByColumnAndRow(6,$i)->getValue();
					$business_segment=	$sheet->getCellByColumnAndRow(7,$i)->getValue();
					$profit_center=		$sheet->getCellByColumnAndRow(8,$i)->getValue();
					$payer_code=		$sheet->getCellByColumnAndRow(9,$i)->getValue();
					$account_type=		$sheet->getCellByColumnAndRow(10,$i)->getValue();
					$account_manager=	$sheet->getCellByColumnAndRow(11,$i)->getValue();
					$status=			$sheet->getCellByColumnAndRow(12,$i)->getValue();
					$key="AM-".trim($account_type)."".$business_unit."".$pc."".$client;
					// check number
					if(empty($number)){
						$number = 'null';
					}
					
					// check services
					$checkServicesQuery = "SELECT * from static_master_services";
					$checkServicesResult = pg_query($conn, $checkServicesQuery);
					$servicesExist = false;
					while ($row = pg_fetch_assoc($checkServicesResult)) 
					{
						if(strtolower($row['services']) == strtolower($services)){
							$services = $row['services'];
							$servicesExist = true;
						}	
					}
					if(!$servicesExist){
						$insertIntoServices = "INSERT INTO static_master_services (services) VALUES('$services')";
						$resultIntoServices = pg_query($conn, $insertIntoServices);
					}
					
					// check category
					$checkCategoryQuery = "SELECT * from static_master_category";
					$checkCategoryResult = pg_query($conn, $checkCategoryQuery);
					$CategoryExist = false;
					while ($row = pg_fetch_assoc($checkCategoryResult)) 
					{
						if(strtolower($row['category']) == strtolower($category)){
							$category = $row['category'];
							$CategoryExist = true;
						}	
					}
					if(!$CategoryExist){
						$insertIntocategory = "INSERT INTO static_master_category (category) VALUES('$category')";
						$resultIntocategory = pg_query($conn, $insertIntocategory);
					}
					
					// check profit_center
					$checkprofit_centerQuery = "SELECT * from static_master_profit_center";
					$checkprofit_centerResult = pg_query($conn, $checkprofit_centerQuery);
					$profit_centerExist = false;
					while ($row = pg_fetch_assoc($checkprofit_centerResult)) 
					{
						if(strtolower($row['profit_center']) == strtolower($profit_center)){
							$profit_center = $row['profit_center'];
							$profit_centerExist = true;
						}	
					}
					if(!$profit_centerExist){
						$insertIntoprofit_center = "INSERT INTO static_master_profit_center (profit_center) VALUES('$profit_center')";
						$resultIntoprofit_center = pg_query($conn, $insertIntoprofit_center);
					}
					
					
					$status=strtolower($status);
					if(empty($status)){
						$status = 'active';
					}
					if($status !='active' && $status !='deactive'){
						$status = 'active';
					}
					if(is_numeric($status) && $status==1){
						$status='active';
					}
					if(is_numeric($status) && $status==0){
						$status='deactive';
					}
					if($clientname!='' && $account_type != '' )
					{
						$sqlcheck = pg_query($conn,"SELECT * FROM clients");	
						$already=0;
						if (pg_num_rows($sqlcheck)>0) 
						{
							while ($row = pg_fetch_assoc($sqlcheck)) 
							{
								if(strtolower($clientname)==strtolower($row['clientname']))
								{
									$already = 1;
								// echo "<script>console.log('$account_type')</script>";
								}
							}
						}
						$sqlcheck2 = pg_query($conn,"SELECT * FROM static_master_account_type");
						$already2 = 1;
						if (pg_num_rows($sqlcheck2)>0) 
						{
							while ($row = pg_fetch_assoc($sqlcheck2)) 
							{
								$check = trim($row['account_type']);
								if(strtolower(trim($account_type))==strtolower($check))
								{
									$already2 = 0;
									$account_type = $row['account_type'];
								}
							}
						}
						$sqlcheck3 = pg_query($conn,"SELECT * FROM user_account where accounttype like'%$account_type%'");
						$already3 = 0;
						if (pg_num_rows($sqlcheck3)>0) 
						{
							$already3 = 1;
							while ($row = pg_fetch_assoc($sqlcheck3)) 
							{
								if(is_numeric($account_manager)){
									if($row['id'] == $account_manager){
										$already3 = 0;
									}
								}
								else{
									$name = $row['fname']." ".$row['lname'];
									if($name == $account_manager){
										$already3 = 0;
										$account_manager = $row['id'];
									}
								}
							}
						}
						if ($already == 1 || $already2 == 1 || $already3 == 1) 
						{
							$error += 1;
							array_push($erroremail, $clientname);
						}
						else
						{
							// if (is_numeric($number) && strlen($number)==10) 
							// {
								// function test_input($data) 
								// {
									// $data = trim($data);
									// $data = stripslashes($data);
									// $data = htmlspecialchars($data);
									// return $data;
								// }
								// $email = test_input($email);
								// $checkemail = filter_var($email, FILTER_VALIDATE_EMAIL);
								if ($clientname!='') 
								{
									$date = date("Y/m/d H:m:s");
									$query = "
									INSERT INTO clients(email,mobilenum,clientname,profit_center,payercode,account_manager,business_unit,key,services,business_segment,account_type,created_date,category,status)
									VALUES('$email',$number,'$clientname','$profit_center','$payer_code','$account_manager','$business_unit','$key','$services','$business_segment','$account_type','$date','$category','$status')";
									$res = pg_query($conn, $query);
									if($res) 
									{
										$success += 1;
									}
									else 
									{
										$error += 1;
										array_push($erroremail, $clientname);
									}
									
								// }
								// else
								// {
									// $error += 1;
									// array_push($erroremail, $clientname);
								// }
							}
							else
							{
								$error += 1;
								array_push($erroremail, $clientname);
							}
						}
					}
					else{
						$empty+=1;
					}
						$progress = ($tp) / ($getHighestRow - 1) * 100;

					echo "<script>	updateProgress(".$progress.");
					      </script>";
				}
				else{
				}
			}
		}
		if($success + $error + $empty > 0)
		{
			echo "<script>$('#modal-result').html(`<div style='display: flex; justify-content: space-between'>
			<div style='color:green'>Account Created - ".$success."</div>
			<div style='color:orange'>Data Missing - ".$empty."</div>
			<div style='color:red'>Error - ".$error."
			<div><button onclick='myFunction()' style='background-color:transparent;outline:none;border:none;'>Show </button></div>
			</div>
			</div>
			";
			echo "<div style='display:none;'id='mailshowhide'>";
			for($i=0;$i<sizeof($erroremail);$i++)
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
			}
			else {
				// echo "<script>$('#modal-result').show();</script>";
				echo "<script>$('#modal-result').html('No data or invalid data in file.');</script>";
			}
			echo "<script>$('#modal-close-btn').show();</script>";

		}else{
			echo "<script>$('#modal-close-btn').show();</script>";
			echo "<script>var div = document.getElementById('errorupload');

			div.innerHTML += 'Please upload csv/xls/xlsx file';</script>";
		}
	}
	
	?>

