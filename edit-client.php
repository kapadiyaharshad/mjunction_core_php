<?php
include "./database/sql.php";
include "./components/side-bar.php";
include "./components/top-bar.php";
date_default_timezone_set('Asia/Kolkata');
$conn= OpenCon();
$id = $_GET["id"];
$sql = pg_query($conn,"SELECT * FROM clients WHERE id=".$id);
$row = pg_fetch_assoc($sql);
$client_name =$row['clientname'];
$client_email =$row['email'];
$client_number =$row['mobilenum'];
$client_business_unit =$row['business_unit'];
$client_services =$row['services'];
$client_profit_center =$row['profit_center'];
$client_account_manager =$row['account_manager'];
$client_account_type =$row['account_type'];
$client_status=strtolower($row['status']);
$payercode=$row['payercode'];
$client_category=$row['category'];
$business_segment=$row['business_segment'];
$type=$_COOKIE['type'];
$result = pg_query($conn,"SELECT * FROM permission where account_type='$type'");
if (pg_num_rows($result)>0) 
{
	while ($row = pg_fetch_assoc($result)) 
	{
		$client_permission=$row['client_permission'];
	}
}
if($client_permission!=1){
	echo "<script>window.location.href = './summary'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Client</title>
	<!-- CSS -->
	<link rel="stylesheet" href="./css/index.css">
	<link rel="stylesheet" href="./css/users.css">

	<!-- JS -->
	<script src="./js/main.js"></script>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

	<!-- Data Table  -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> 
	<script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>


	<!-- captcha -->
	<script src="https://www.google.com/recaptcha/api.js?render=6Le6my0hAAAAAKkeamNMFcXqpIhinxSLX7y1W2qO"></script>
</head>
<body>
	<div class="container-main">
		<?php 
		$type = strtoupper($_COOKIE["type"]);
		if ("ADMIN" == $type) 
		TopBar('clients'); 
		else
		nTopBar('clients'); ?>
		<div class="content">
			<!-- <div id="msgshowsuccess" style="display: none;">
				<div class="alert alert-dismissible alert-success">
					<!--<button type="button" onclick="$('#msgshowsuccess').hide();" class="close" data-dismiss="alert">&times;</button>
					<strong>Update Successfull!</strong> Client <strong><?php echo isset($_POST['fName']) ? $_POST['fName']:  $row['fname'];?></strong> have been updated.
				</div>
			</div>
			<div id="msgshowerror" style="display: none;">
				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" onclick="$('#msgshowerror').hide();" data-dismiss="alert">&times;</button>
					<strong>Unsuccessfull!</strong> Client entries could has not updated. Change a few things up and try submitting again.
				</div>
			</div> -->
			<div class="container add-user-container">
				<div class="px-4">
					<div class="graph-card mx-2 mt-4 p-4">
						<div id="msgshowsuccess" style="display: none;">
				<div class="alert alert-dismissible alert-success">
					<!--<button type="button" onclick="$('#msgshowsuccess').hide();" class="close" data-dismiss="alert">&times;</button>-->
					<strong>Update Successfull!</strong> Client <strong><?php echo isset($_POST['fName']) ? $_POST['fName']:  $row['fname'];?></strong> have been updated.
				</div>
			</div>
			<div id="msgshowerror" style="display: none;">
				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" onclick="$('#msgshowerror').hide();" data-dismiss="alert">&times;</button>
					<strong>Unsuccessfull!</strong> Client entries could has not updated. Change a few things up and try submitting again.
				</div>
			</div>
						<center><div class="card-title">Edit Client</div></center>
						<div><a href="clients"><button style="background-color: transparent;outline: none;border: none;font-size: 25px;"><i class="fa fa-angle-left"></i></button></a></div>
						
						<div class="mt-4">
							<form method="post">
								<!--<div class="form-group mb-3">-->
								<!--	<label for="fName">First Name:</label>-->
								<!--	<input type="text" id="fName" name="fName" class="form-control" placeholder="First Name"  value="<?php echo isset($_POST['fName']) ? $_POST['fName']:  $row['fname'];?>">-->
								<!--</div>-->
								<!--<div class="form-group mb-3">-->
								<!--	<label for="lName">Last Name:</label>-->
								<!--	<input type="text" id="lName" name="lName" class="form-control" placeholder="Last Name"  value="<?php echo isset($_POST['lName']) ? $_POST['lName']:  $row['lname'];?>">-->
								<!--</div>-->
								<div class="form-group mb-3">
									<label for="client_name">Client Name:</label>
									<input type="text" id="client_name" name="client_name" class="form-control"  required="" placeholder="Client Name"  value="<?php echo isset($_POST['client_name']) ? $_POST['client_name']: $client_name;?>">
									<div style="color: red" id="errorcname"></div>
								</div>
								<div class="form-group mb-3">
									<label for="email">Email:</label>
									<input type="text" id="email" name="email" class="form-control" placeholder="Email"  value="<?php echo  isset($_POST['email']) ? $_POST['email']: $client_email;?>">
									<div style="color: red" id="error"></div>
								</div>
								<div class="form-group mb-3">
									<label for="number">Mobile Number:</label>
									<input type="number" id="number" name="number" class="form-control" placeholder="Mobile Number"  value="<?php echo isset($_POST['number']) ? $_POST['number']:  $client_number;?>">
									<div style="color: red" id="errorp"></div>
								</div>
								<div class="form-group mb-3">
								<?php
								$conn= OpenCon();
								$sql = pg_query($conn,"SELECT DISTINCT bu FROM static_master_bu");
								if (pg_num_rows($sql)>0) 
								{
									echo "<div class='form-group mb-3'><label for='bu'>Business Unit</label><select id='bu' class='form-select' name='bu'>";
									while ($row = pg_fetch_assoc($sql)) 
									{	
										$bu=$row['bu'];
										if($bu==$client_business_unit){
											echo "<option value='$bu' selected>".$bu."</option>";
										}
										else
										echo "<option value='$bu'>".$bu."</option>";
									}
									echo "</select></div>";
								}
								$sql = pg_query($conn,"SELECT DISTINCT services FROM static_master_services");
								if (pg_num_rows($sql)>0) 
								{
									echo "<div class='form-group mb-3'><label for='bu'>Services:</label><select id='services' class='form-select' name='services'>";
									while ($row = pg_fetch_assoc($sql)) 
									{	
										$services=$row['services'];
										if($services==$client_services){
											echo "<option value='$services' selected>".$services."</option>";
										}
										else
										echo "<option value='$services'>".$services."</option>";
									}
									echo "</select></div>";
								}
								$sql = pg_query($conn,"SELECT DISTINCT category FROM static_master_category");
								echo "<div class='form-group mb-3'><label for='bu'>Category:</label><select id='category' class='form-select' required='' name='category'>";
								echo "<option value='' selected disabled>Select Category</option>";
								if (pg_num_rows($sql)>0) 
								{
									while ($row = pg_fetch_assoc($sql)) 
									{	
										$category=$row['category'];
										if($category==$client_category){
											echo "<option value='$category' selected>".$category."</option>";
										}
										else
											echo "<option value='$category'>".$category."</option>";
										
									}
								}
								echo "</select></div>";
								?>
								<!-- <div class="form-group mb-3">
									<label for="business_segment">Business Segment:</label>
									<input type="text" id="business_segment" name="business_segment" class="form-control"  required="" placeholder="Business Segment"  value="<?php echo isset($_POST['business_segment']) ? $_POST['business_segment']: $business_segment;?>">
									<div style="color: red" id="errorp"></div>
								</div> -->
								
								<?php
								$sql_ec_nc = pg_query($conn,"SELECT ec_nc FROM static_master_ec_nc");
								if (pg_num_rows($sql_ec_nc)>0) 
								{
									echo "<div class='form-group mb-3'><label for='business_segment'>Business Segment:</label><select id='business_segment' class='form-select' name='business_segment'>";
									while ($row_ec_nc = pg_fetch_assoc($sql_ec_nc)) 
									{	
										$edit_ec_nc=$row_ec_nc['ec_nc'];
										if($edit_ec_nc == $business_segment){
											echo "<option value='$edit_ec_nc' selected>".$edit_ec_nc."</option>";
										}
										else
										echo "<option value='$edit_ec_nc'>".$edit_ec_nc."</option>";
									}
									echo "</select></div>";
								}?>
								<?php
								$sql = pg_query($conn,"SELECT DISTINCT profit_center FROM static_master_profit_center");
								if (pg_num_rows($sql)>0) 
								{
									echo "<div class='form-group mb-3'><label for='region'>Profit Center</label><select id='profit_center' class='form-select' name='profit_center'>";
									if($client_profit_center == 'N/A'){
										echo "<option value='$client_profit_center' selected>".$client_profit_center."</option>";
									}
									while ($row = pg_fetch_assoc($sql)) 
									{	
										$profit_center=$row['profit_center'];
										
										if($profit_center==$client_profit_center){
											echo "<option value='$profit_center' selected>".$profit_center."</option>";
										}
										else
										echo "<option value='$profit_center'>".$profit_center."</option>";
									}
									echo "</select></div>";
								}?>

<?php
								$payer_code_sql = pg_query($conn,"SELECT DISTINCT payer_code FROM static_master_payer_code ORDER BY payer_code");
								if (pg_num_rows($payer_code_sql)>0) 
								{
									echo "<div class='form-group mb-3'><label for='payer_code'>Payer Code</label><select id='payer_code' class='form-select' name='payer_code'>";
									if($payercode == 'N/A'){
										echo "<option value='$payercode' selected>".$payercode."</option>";
									}
									while ($payer_code_row = pg_fetch_assoc($payer_code_sql)) 
									{	
										$payer_code_result=$payer_code_row['payer_code'];
										if($payer_code_result==$payercode){
											echo "<option value='$payer_code_result' selected>".$payer_code_result."</option>";
										}
										else
										echo "<option value='$payer_code_result'>".$payer_code_result."</option>";
									}
									echo "</select></div>";
								}?>
								
								<!-- <div class="form-group mb-3">
									<label for="payer_code">Payer Code:</label>
									<input type="text" id="payer_code" name="payer_code" class="form-control"  required="" placeholder="Payer Code"  value="<?php echo isset($_POST['payer_code']) ? $_POST['payer_code']: $payercode;?>">
								</div> -->
								<?php
								$sql = pg_query($conn,"SELECT DISTINCT account_type FROM static_master_account_type");
								if (pg_num_rows($sql)>0) 
								{
									echo "<div class='form-group mb-3'><label for='bu'>Account Type:</label><select id='account_type' class='form-select' name='account_type'>";
									while ($row = pg_fetch_assoc($sql)) 
									{	
										$account_type=$row['account_type'];
										if($account_type==$client_account_type){
											echo "<option value='$account_type' selected>".$account_type."</option>";
										}
										else
										echo "<option value='$account_type'>".$account_type."</option>";
									}
									echo "</select></div>";
								}
								echo "<div id='account-manager-wrapper' class='form-group mb-3'><label for='region'>Account Manager:</label><select id='account_manager' class='form-select' required='' name='account_manager'>";
								$am_query = "SELECT * FROM user_account where accountType like '%AM-$client_account_type%' AND desgnation='AM' order by id ASC";
								$am_sql = pg_query($conn, $am_query);
								while ($am_row = pg_fetch_assoc($am_sql)) 
								{	
									$am_id = $am_row['id'];
									$val = $am_row['fname'].' '.$am_row['lname'];
									if($am_id == $client_account_manager)
									echo "<option selected value='$am_id'>$val</option>";
									else
									echo "<option value='$am_id'>$val</option>";
								}
								echo "</select></div>";
								?>
								<div class='form-group mb-3'><label for='status'>Status</label>
									<select required id='status' class='form-select' name='status'>
										<?php if($client_status=='active'){
											echo "<option value='active' selected>Active</option>";
											echo "<option value='deactive'>Deactive</option>";
										 }
											else if($client_status=='deactive'){
											echo "<option value='active' >Active</option>";
											echo "<option value='deactive' selected>Deactive</option>";
										 }
										 else{
											echo "<option value='' selected disabled>Select Client Status</option>";
											echo "<option value='active' >Active</option>";
											echo "<option value='deactive'>Deactive</option>";
										 }
										 ?>
									</select>
								</div>
							</div>
							<input type="hidden" id="captcha_token" name="captcha_token">

								<div class="d-flex justify-content-center">
									<input type="submit" class="btn btn-success but" name="Client" value="Save Client">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
						<?php
				include "./components/footer.php"
			?>

		</div>
	</div>
	<?php
		if(isset($_POST['Client'])){
			$secret = "6Le6my0hAAAAAODDi8UgKvu3JQU1VfCIB78-NGwt";
			$response = $_POST['captcha_token'];
			$ip = $_SERVER['REMOTE_ADDR'];
			$url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response."&remoteip=".$ip;
	
			$request =  file_get_contents($url);
			$result = json_decode($request);
			if($result->success == true){
				if (array_key_exists("Client", $_POST)) 
				{ 

					function test_input($data) 
					{
						$data = trim($data);
						$data = stripslashes($data);
						$data = htmlspecialchars($data);
						return $data;
					}
					$error=0;
					if($_POST['email']!='')
					{
						$email = test_input($_POST["email"]);
						
						if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
						{
							echo "<script>var div = document.getElementById('error');
				
							div.innerHTML += 'Enter a valid email!';</script>";
							// die();
							$error=1;
						}
					}
					if($_POST["number"]!='')
					{
						if(!preg_match('/^[0-9]{10}+$/', $_POST["number"]))
						{
							echo "<script>var div = document.getElementById('errorp');
							div.innerHTML += 'Enter a valid Phone number!';</script>";
							$error=1;
							
						}
					}
					else {
						$_POST["number"]='null';
					}
					
					if($error==0)
					{
						// $fname =$_POST["fName"];
						// $lname =$_POST["lName"];
						$bu =$_POST["bu"];
						$account_type=$_POST['account_type'];
						$status=$_POST['status'];
						$account_manager =$_POST["account_manager"];
						$email =$_POST["email"];
						$number =$_POST["number"];
						$services =$_POST["services"];
						$profit_center=$_POST['profit_center'];
						$business_segment =$_POST["business_segment"];
						$client_name =$_POST['client_name'];
						$category =$_POST["category"];	
						$payer_code=$_POST['payer_code'];
						$key="AM-".$account_type."".$bu."".$payer_code."".$profit_center;
						$already = 0;
						$alreadycname = 0;
						$alreadyemail = 0;
						$date = date("Y/m/d H:i:s");
						$sql = pg_query($conn,"SELECT * FROM clients");
						$already = 0;
						if (pg_num_rows($sql)>0) 
						{
							while ($row = pg_fetch_assoc($sql)) 
							{
								if($row['id']!=$_GET['id'])
								{
									if($_POST['client_name']==$row['clientname'])
									{
										$already = 1;
										$alreadycname = 1;
										
									}
									if($_POST['email']!='')
									{
										if($_POST['email']==$row['email']){
										$already = 1;
										$alreadyemail = 1;}
									}
								}
							}
						}
						if ($already!=1) 
						{
							$query = "UPDATE clients SET category='$category', key='$key', clientname='$client_name',payercode='$payer_code',account_type='$account_type', profit_center='$profit_center', business_segment='$business_segment',services='$services', status='$status', account_manager='$account_manager',business_unit='$bu', email='$email',mobilenum=$number, last_modified='$date' WHERE id=".$id;
							$result=pg_query($conn,$query);
							if ($result) {
							# code...
							// $query1 = "UPDATE collection SET account_manager='$account_manager' where clientname='$client_name' ";
							// $result1=pg_query($conn,$query1);
							echo '<meta http-equiv="Refresh" content="3;url=edit-client?id='.$_GET['id'].'">';
							echo "<script>$('#msgshowsuccess').show();</script>";
							}
							else{
									echo "<script>$('#msgshowerror').show();</script>";
							}
						}
						else
						{
							echo "<script>$('#msgshowerror').show();</script>";
							if($alreadycname == 1)
							{
								echo "<script>var div = document.getElementById('errorcname');
								div.innerHTML += 'Client name already exist';</script>";
							}
							if($alreadyemail == 1)
							{
								echo "<script>var div = document.getElementById('error');
								div.innerHTML += 'Email already exist';</script>";
							}
						}
					}
				}
			}
			else{
				echo "<script> alert('Captcha Invalid') </script>";

			}
		}
	?>
	<script type="text/javascript">
		function openFile() {
			$("#doc").click();
			$("#doc").on("change", function() {
				$("#fileUploadFormButton").click();
			})
		}
		$("#account_type").on('change', function(e) {
			console.log(e.target.value);
			$.ajax("./client-account-manager", {
				method: "POST",
				data: {accountType: e.target.value},
				success: function(res) {
					const data = JSON.parse(res);
					let html = '';
					for(let i = 0;i < data.length; i++) {
						html += `<option value='${data[i][0]}'>${data[i][1]}</option>`;
					}
					if(data.length == 0)
					html = `<option value='' disabled selected>No account managers</option>`
					$("#account_manager").html(html);
					$("#account-manager-wrapper").show();
				}
			})
		})
	</script>
</body>
</html>
<script>
        grecaptcha.ready(function() {
          grecaptcha.execute('6Le6my0hAAAAAKkeamNMFcXqpIhinxSLX7y1W2qO', {action: 'Client'}).then(function(token) {
              // Add your logic to submit to your backend server here.
			  var response = document.getElementById('captcha_token');
			  response.value = token;
          });
        });
  </script>