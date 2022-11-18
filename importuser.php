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
$sql = pg_query($conn,"SELECT * FROM user_account");
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
			echo $getHighestRow;
			for($i=2;$i<=$getHighestRow;$i++,$tp++)
			{	
				$checkemail='';
				// to check that the uploaded file is in correct format
				if (   $sheet->getCellByColumnAndRow(1,1)->getValue() == "First Name"
					&& $sheet->getCellByColumnAndRow(2,1)->getValue() == "Last Name"
					&& $sheet->getCellByColumnAndRow(3,1)->getValue() == "Email"
					&& $sheet->getCellByColumnAndRow(4,1)->getValue() == "Password"
					&& $sheet->getCellByColumnAndRow(5,1)->getValue() == "Mobile Number"
					&& $sheet->getCellByColumnAndRow(6,1)->getValue() == "Desgnation"
					&& $sheet->getCellByColumnAndRow(7,1)->getValue() == "Account Type"
					&& $sheet->getCellByColumnAndRow(8,1)->getValue() == "Business Unit" 
					&& $sheet->getCellByColumnAndRow(9,1)->getValue() == "Status") 
				{
					// echo "<script>alert('inside')</script>";
					$fname=		$sheet->getCellByColumnAndRow(1,$i)->getValue();
					$lname=		$sheet->getCellByColumnAndRow(2,$i)->getValue();
					$email=		$sheet->getCellByColumnAndRow(3,$i)->getValue();
					$password=	$sheet->getCellByColumnAndRow(4,$i)->getValue();
					$number=	$sheet->getCellByColumnAndRow(5,$i)->getValue();
					$desgnation=$sheet->getCellByColumnAndRow(6,$i)->getValue();
					$accounttype=$sheet->getCellByColumnAndRow(7,$i)->getValue();
					$bu=		$sheet->getCellByColumnAndRow(8,$i)->getValue();
					$status=	$sheet->getCellByColumnAndRow(9,$i)->getValue();
					$username=	$lname.".".$fname;
					$desgnation = strtoupper($desgnation);
					
					if($desgnation == 'ACCOUNT MANAGER' || $desgnation == 'ACCOUNTMANAGER' || $desgnation == 'AM'){
						$desgnation = 'AM';
					}
					else if($desgnation == 'REGIONAL ACCOUNT MANAGER' || $desgnation == 'REGIONAL ACCOUNTMANAGER' || $desgnation == 'REGIONALACCOUNT MANAGER' || $desgnation == 'REGIONAL MANAGER' || $desgnation == 'REGIONALMANAGER' || $desgnation == 'REGIONALACCOUNTMANAGER' || $desgnation == 'RM'){
						$desgnation = 'RM';
					}
					else if($desgnation == 'BUSINESS HEAD' || $desgnation == 'BUSINESS USER' || $desgnation == 'BUSINESSHEAD' || $desgnation == 'BUSINESSUSER' || $desgnation == 'BU' || $desgnation == 'BH'){
						$desgnation = 'BU';
					}
					else if($desgnation == 'CORPORATE USER' || $desgnation == 'CORPORATEUSER' || $desgnation == 'CU'){
						$desgnation = 'CU';
					}
					
					
					if($desgnation == "ADMIN" || $desgnation == "CU"){
						$accounttype = '';
						$bu = '';
					}
					else if($desgnation == "AM" || $desgnation == "RM"){
						$bu = '';
						$accounttype = explode(",", $accounttype);
						$len= count($accounttype);
						$arr= [];
						for($j=0;$j<$len;$j++){
							$accounttypenew = trim($accounttype[$j]);
							$checkAccountTypeQuery = "SELECT * from static_master_account_type";
							$checkAccountTypeResult = pg_query($conn, $checkAccountTypeQuery);
							$accountTypeExist = false;
							while ($row = pg_fetch_assoc($checkAccountTypeResult)) 
							{
								if(strtolower($row['account_type']) == strtolower($accounttypenew)){
									$accounttypenew = $row['account_type'];
									$accountTypeExist = true;
								}	
							}
							if(!$accountTypeExist){
								$insertIntoAccountType = "INSERT INTO static_master_account_type (account_type) VALUES('$accounttypenew')";
								$resultIntoAccountType = pg_query($conn, $insertIntoAccountType);
							}
							array_push($arr,$desgnation.'-'.$accounttypenew);
						}
						$accounttype = join(', ',$arr);
					}
					else if($desgnation == "BU"){
						$accounttype = '';
						$bu = explode(",", $bu);
						$len= count($bu);
						$arr_bu= [];
						for($k=0;$k<$len;$k++){
							$bunew = trim($bu[$k]);
							$checkBUQuery = "SELECT * from static_master_bu";
							$checkBUResult = pg_query($conn, $checkBUQuery);
							$BUExist = false;
							while ($row = pg_fetch_assoc($checkBUResult)) 
							{
								if(strtolower($row['bu']) == strtolower($bunew)){
									$BUExist = true;
									$bunew = $row['bu'];
								}	
							}
							if(!$BUExist){
								$insertIntoBU = "INSERT INTO static_master_bu (bu) VALUES('$bunew')";
								$resultIntoBU = pg_query($conn, $insertIntoBU);
							}
							array_push($arr_bu,$bunew);
						}
						$bu = join(', ',$arr_bu);
					}
					
					// $accounttype=$desgnation."-".$accounttype;
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
					else if(is_numeric($status) && $status==0){
						$status='deactive';
					}
					if(strlen($password)<8){
						$password='123456789';
					}
					$status=strtolower($status);
					$isnew=1;
					echo $fname;
					// to check that no feild is empty
					if($fname!='' && $email != '' && $lname!='' && 
						$number != '' && $desgnation!='' && strlen($password)>=8)
					{
						if (is_numeric($number) && strlen($number)==10) 
						{
							$email = test_input($email);
							$checkemail = filter_var($email, FILTER_VALIDATE_EMAIL);
							if ($checkemail!='') 
							{
								$date = date("Y/m/d H:m:s");
								$query = "
								INSERT INTO user_account(fname,lname,email,password,username,mnumber,accounttype,desgnation,isnew,created_date,import_type,status,view_check,bu)
								VALUES('$fname','$lname','$email','$password','$username',$number,'$accounttype','$desgnation',$isnew,'$date','Bulk','$status',1,'$bu')";
								$res = pg_query($conn, $query);
								if($res) 
								{
									$success += 1;
								// array_push($successemail, $email);
									// require "mail";
								}
								else 
								{
									// echo "<script>alert('$query')</script>";
									$error += 1;
									array_push($erroremail, $email);
								}
								
							}
							else{
								$error += 1;
								array_push($erroremail, $email);
							}
						}
						else{
							$error += 1;
							array_push($erroremail, $email);
						}
					}
					else{
						$empty+=1;
						array_push($emptyemail, $email);
					}
					$progress = ($tp) / ($getHighestRow - 1) * 100;
								echo "<script>
								updateProgress(".$progress.");
								</script>";
				}
				else{
					// echo "  hello  ";
					// echo " ".$sheet->getCellByColumnAndRow(1,2)->getValue()." " ;
				}
			}
		}
		if($success + $error + $empty > 0)
		{
			echo "<script>$('#modal-result').html(`<div style='display: flex; justify-content: space-between'>
			<div style='color:green'>Account Created - ".$success."</div>
			<div style='color:orange'>Data Missing - ".$empty."</div>
			<div style='color:red'>Account Not Created - ".$error."
			<div><button onclick='myFunction()' style='background-color:transparent;outline:none;border:none;'>Show </button></div>
			</div>
			</div>
			";
			echo "<div style='display:none;'id='mailshowhide'>";
			for($l=0;$l<sizeof($erroremail);$l++)
			{
				echo"
				<div >
				<div style='display: flex; justify-content: space-between;' >
				<div style='color:yellow'></div>
				<div style='color:red'>".$erroremail[$l]."</div>
				</div>
				";
			}
			// echo "</div>";
			// echo "<div style='display:none;'id='mailshowhide'>";
			for($m=0;$m<sizeof($emptyemail);$m++)
			{
				echo"
				<div >
				<div style='display: flex; justify-content: space-between;' >
				<div style='color:orange'>".$emptyemail[$m]."</div>
				<div style='color:red'></div>
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
				echo "<script>$('#modal-result').html('No data or invalid data in file.');</script>";
			}
			echo "<script>$('#modal-close-btn').show();</script>";

			// foreach($obj->getWorksheetIterator() as $sheet)
			// {
			// 	$getHighestRow=$sheet->getHighestRow();
			// 	for($i=2;$i<=$getHighestRow;$i++)
			// 	{
			// 		$fname=$sheet->getCellByColumnAndRow(1,$i)->getValue();
			// 		$lname=$sheet->getCellByColumnAndRow(2,$i)->getValue();
			// 		$email=$sheet->getCellByColumnAndRow(3,$i)->getValue();
			// 	echo $fname;
			// 	echo $lname;
			// 	echo '$getHighestRow';
			// 	echo $getHighestRow;
			// 	require "mail.php";
			// 	sleep(5);
			// 	}
			// }
		}else{
			echo "<script>$('#modal-close-btn').show();</script>";
			echo "<script>var div = document.getElementById('errorupload');

			div.innerHTML += 'Please upload csv/xls/xlsx file';</script>";
		}
	}
	 function test_input($data) 
	 {
	 	$data = trim($data);
	 	$data = stripslashes($data);
	 	$data = htmlspecialchars($data);
	 	return $data;
	 }
	?>

