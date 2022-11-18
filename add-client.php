<?php
include "./database/sql.php";
include "./components/side-bar.php";
include "./components/top-bar.php";
date_default_timezone_set('Asia/Kolkata');
$type=$_COOKIE['type'];
$result = pg_query($conn,"SELECT * FROM permission where account_type='$type'");
if (pg_num_rows($result)>0) 
{
	while ($row = pg_fetch_assoc($result)) 
	{
		$importpermission=$row['import_check'] == '1';
		$exportpermission=$row['export_check'] == '1';
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
  	<title>Add Clients</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- CSS -->
	<link rel="stylesheet" href="./css/index.css">
	<link rel="stylesheet" href="./css/add-client.css">

	<!-- JS -->
	<script src="./js/main.js"></script>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

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
		nTopBar('clients');
		?>
		<div class="content">
			<!-- <div id="msgshowsuccess" style="display: none;">
				<div class="alert alert-dismissible alert-success">
					<button type="button" onclick="$('#msgshowsuccess').hide();" class="close" data-dismiss="alert">&times;</button>
					<strong>Successfull!</strong>Client <?php echo isset($_POST['fName']) ? $_POST['fName']:''?> has been added.
				</div>
			</div>
			<div id="msgshowerror" style="display: none;">
				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" onclick="$('#msgshowerror').hide();" data-dismiss="alert">&times;</button>
					<strong>Unsuccessfull!</strong> Client entries could not registered. Change a few things up and try submitting again.
				</div>
			</div> -->
			<div class="px-4">
				<div class="graph-card mx-2 mt-4 p-4">
				<div id="msgshowsuccess" style="display: none;">
				<div class="alert alert-dismissible alert-success">
					<button type="button" onclick="$('#msgshowsuccess').hide();" class="close" data-dismiss="alert">&times;</button>
					<strong>Successfully!</strong>Client <?php echo isset($_POST['fName']) ? $_POST['fName']:''?> has been added.
				</div>
			</div>
			<div id="msgshowerror" style="display: none;">
				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" onclick="$('#msgshowerror').hide();" data-dismiss="alert">&times;</button>
					<strong>Unsuccessfull!</strong> Client entries could not registered. Change a few things up and try submitting again.
				</div>
			</div>
			<div id="captchashowerror" style="display: none;">
				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" onclick="$('#captchashowerror').hide();" data-dismiss="alert">&times;</button>
					<strong></strong> Captcha invalid.
				</div>
			</div>
					<center><div class="card-title">Add Client</div></center>
					<div class="d-flex justify-content-between">
						<div><a href="clients"><button style="background-color: transparent;outline: none;border: none;font-size: 25px;"><i class="fa fa-angle-left"></i></button></a></div>
						
						<div class="d-flex">
							<form method="post" action="exportclient">
								<input type="submit" id="add-clients" name="export" class="btn btn-primary user-btn ml-2" value="Download Client Format" />
							</form>							
							<form method="post" action="" enctype="multipart/form-data">
								<input type="file" hidden name="doc" id="doc" />
								<input type="button" id='download-clients' value="Upload xls/csv" class="btn btn-primary user-btn ml-2"onclick="openFile()" />
								<input type="submit" name="import" id="fileUploadFormButton" hidden />
							</form>
						</div>
					</div>
					<div class="px-2">
						<form method="post">
							<!--<div class="form-group mb-3">-->
							<!--	<label for="fName">First Name:</label>-->
							<!--	<input type="text" id="fName" name="fName" class="form-control" placeholder="First Name"  value="<?php echo isset($_POST['fName']) ? $_POST['fName']: '';?>">-->
							<!--</div>-->
							<!--<div class="form-group mb-3">-->
							<!--	<label for="lName">Last Name:</label>-->
							<!--	<input type="text" id="lName" name="lName" class="form-control" placeholder="Last Name"  value="<?php echo isset($_POST['lName']) ? $_POST['lName']: '';?>">-->
							<!--</div>-->
							<div class="form-group mb-3">
									<label for="client_name">Client Name:</label>
									<input type="text" id="client_name" name="client_name" class="form-control"  required="" placeholder="Client Name"  value="<?php echo isset($_POST['client_name']) ? $_POST['client_name']: '';?>" onkeydown="return /[a-z]/i.test(event.key)" maxlength="70">
									<div style="color: red" id="errorcname"></div>
							</div>
							<div class="form-group mb-3">
								<label for="email">Email:</label>
								<input type="text" id="email" name="email" class="form-control" placeholder="Email"  value="<?php echo isset($_POST['email']) ? $_POST['email']: '';?>">
								<div style="color: red" id="error"></div>
							</div>
							<div class="form-group mb-3">
								<label for="number">Mobile Number:</label>
								<input type="number" id="number" name="number" class="form-control" placeholder="Mobile Number"  value="<?php echo isset($_POST['number']) ? $_POST['number']: '';?>">
								<div style="color: red" id="errorp"></div>
							</div>
							<div class="form-group mb-3">
								<?php
								$conn= OpenCon();
								$sql = pg_query($conn,"SELECT DISTINCT bu FROM static_master_bu");
								if (pg_num_rows($sql)>0) 
								{?>
									 <div class='form-group mb-3'><label for='bu'>Business Unit:</label><select id='bu' class='form-select' required='' name='bu'>
									 <option value='' selected disabled>Select Business Unit</option>
									<?php 
									 while ($row = pg_fetch_assoc($sql)) 
									{	
										$bu=$row['bu'];
									?>
										 <option value="<?= $bu?>" <?php if($bu==$_POST['bu']) echo 'selected="selected"'; ?> ><?= $bu ?></option>
								<?php	}  ?>
									</select></div>
							<?php	}?>
								<?php
								$conn= OpenCon();
								$sql = pg_query($conn,"SELECT DISTINCT services FROM static_master_services");
								if (pg_num_rows($sql)>0) 
								{ ?>
									<div class='form-group mb-3'><label for='services'>Services:</label><select id='services' class='form-select' required='' name='services'>
									<option value='' selected disabled>Select Services</option>
								<?php 	
									while ($row = pg_fetch_assoc($sql)) 
									{	
										$services=$row['services'];
									?>
										<option value="<?= $services ?>" <?php if($services==$_POST['services']) echo 'selected="selected"'; ?>><?= $services ?></option>
								<?php } ?>
									</select></div>
								<?php }
								$sql = pg_query($conn,"SELECT DISTINCT category FROM static_master_category");
								?>
								<div class='form-group mb-3'><label for='bu'>Category:</label><select id='category' class='form-select' required='' name='category'>
								<option value='' selected disabled>Select Category</option>
								<?php 
								if (pg_num_rows($sql)>0) 
								{
									while ($row = pg_fetch_assoc($sql)) 
									{	
										$category=$row['category'];
								?>
								<option value="<?= $category ?>" <?php if($category==$_POST['category']) echo 'selected="selected"'; ?>><?= $category ?></option>
								<?php	}
								} ?>
								</select></div>
								
								
								<!-- <div class="form-group mb-3">
									<label for="business_segment">Business Segment:</label>
									<input type="text" id="business_segment" name="business_segment" class="form-control"  required="" placeholder="Business Segment"  value="<?php echo isset($_POST['business_segment']) ? $_POST['business_segment']: '';?>">
								</div> -->
								<?php
								$sql_ec_nc = pg_query($conn,"SELECT ec_nc FROM static_master_ec_nc");
								if (pg_num_rows($sql)>0) 
								{
									?>
									<div class='form-group mb-3'><label for='business_segment'>Business Segment:</label><select id='business_segment' class='form-select' required='' name='business_segment'>
									<option value='' selected>Select Segment</option>
									<?php 
									while ($row_ec_nc = pg_fetch_assoc($sql_ec_nc)) 
									{	
										$ec_nc_name=$row_ec_nc['ec_nc'];
									?>
									<option value="<?= $ec_nc_name ?>" <?php if($ec_nc_name==$_POST['business_segment']) echo 'selected="selected"'; ?>><?= $ec_nc_name ?></option>
								<?php	} ?>
									</select></div>
								<?php }
								?>
								
								<?php
								$sql = pg_query($conn,"SELECT DISTINCT profit_center FROM static_master_profit_center ORDER BY profit_center");
								if (pg_num_rows($sql)>0) 
								{
									?>
									<div class='form-group mb-3'><label for='profit_center'>Profit Center:</label><select id='profit_center' class='form-select' required='' name='profit_center'>
									<option selected disabled>Select Profit Center</option>
									<option value='N/A' <?php if("N/A"==$_POST['profit_center']) echo 'selected="selected"'; ?>>N/A</option>
								<?php 
									while ($row = pg_fetch_assoc($sql)) 
									{	
										$profit_center=$row['profit_center'];
										if(!empty($profit_center)){
									?>
									<option value="<?= $profit_center ?>" <?php if($profit_center==$_POST['profit_center']) echo 'selected="selected"'; ?>><?= $profit_center ?></option>
									<?php	}
									} ?>
									</select></div>
							<?php	}
								?>
								<?php
								$payer_code_sql = pg_query($conn,"SELECT DISTINCT payer_code FROM static_master_payer_code ORDER BY payer_code");
								if (pg_num_rows($payer_code_sql)>0) 
								{
									?>
									<div class='form-group mb-3'><label for='payer_code'>Payer Code:</label><select id='payer_code' class='form-select' required='' name='payer_code'>
									<option value='' selected disabled>Select Payer Code</option>
									<option value='N/A' <?php if("N/A"==$_POST['payer_code']) echo 'selected="selected"'; ?>>N/A</option>
								<?php 
									while ($payer_code_row = pg_fetch_assoc($payer_code_sql)) 
									{	
										$payer_code=$payer_code_row['payer_code'];
								?>
										<option value="<?= $payer_code ?>" <?php if($payer_code==$_POST['payer_code']) echo 'selected="selected"'; ?>><?= $payer_code ?></option>
								<?php	} ?>
									</select></div>
							<?php	}
								?>
								<!-- <div class="form-group mb-3">
									<label for="payer_code">Payer Code:</label>
									<input type="text" id="payer_code" name="payer_code" class="form-control"  required="" placeholder="Payer Code"  value="<?php echo isset($_POST['payer_code']) ? $_POST['payer_code']: '';?>">
								</div> -->
								<?php
								$sql = pg_query($conn,"SELECT DISTINCT account_type FROM static_master_account_type");
								if (pg_num_rows($sql)>0) 
								{ ?>
									<div class='form-group mb-3'><label for='bu'>Account Type:</label><select id='account_type' class='form-select' name='account_type' required=''>
									<option value='' selected disabled>Select Account Type</option>
								<?php 
									while ($row = pg_fetch_assoc($sql)) 
									{	
										$account_type=$row['account_type'];
									?>
									<option value="<?= $account_type ?>" <?php if($account_type==$_POST['account_type']) echo 'selected="selected"'; ?>><?= $account_type ?></option>
								<?php	} ?>
									</select></div>
							<?php	} 
								// $sql = pg_query($conn,"SELECT * FROM user_account order by id ASC");
								// if (pg_num_rows($sql)>0) 
								// {
									echo "<div id='account-manager-wrapper' class='form-group mb-3' style='display: none;'><label for='region'>Account Manager:</label><select id='account_manager' class='form-select' required='' name='account_manager'>";
									// echo "<option value='' selected disabled>Select account manager</option>";
									// while ($row = pg_fetch_assoc($sql)) 
									// {	
									// 	$id=$row['id'];
									// 	$name = $row['fname'].' '.$row['lname'];
									// 	echo "<option value='$id'>".$id.' - '.$name."</option>";
									// }
									echo "</select></div>";
								// }
								?>
								
								<div class='form-group mb-3'><label for='status'>Status:</label>
									<select id='status' class='form-select' name='status'>
										<option value='active'>Active</option>
										<option value='deactive'>Deactive</option>
									</select>
								</div>
							</div>
							<input type="hidden" id="captcha_token" name="captcha_token">
							<div class="d-flex justify-content-center">
								<input type="submit" class="btn btn-success ml-2" name="Client" value="Add Client">
								<a href='clients'><div class='btn btn-danger delete-btn ml-4'>cancel</div></a>
							</div>
						</form>
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
						if(!preg_match('/^[0-9]{10,12}+$/', $_POST["number"]))
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
						$conn= OpenCon();
						// $fname =$_POST["fName"];
						// $lname =$_POST["lName"];
						$email =$_POST["email"];
						$bu =$_POST["bu"];
						$account_type =$_POST["account_type"];
						$profit_center=$_POST['profit_center'];
						$business_segment=$_POST['business_segment'];
						$services=$_POST['services'];
						$status=$_POST['status'];
						$account_manager =$_POST["account_manager"];
						$number =$_POST["number"];
						$category =$_POST["category"];
						$account_type=$_POST['account_type'];
						$date = date("Y/m/d H:i:s");
						$sql = pg_query($conn,"SELECT * FROM clients");
						$already = 0;
						$alreadycname = 0;
						$alreadyemail = 0;
						$client_name =$_POST['client_name'];
						$payer_code=$_POST['payer_code'];
						$key="AM-".$account_type."".$bu."".$payer_code."".$profit_center;
						if (pg_num_rows($sql)>0) 
						{
							while ($row = pg_fetch_assoc($sql)) 
							{
								if($_POST['client_name']==$row['clientname'])
								{
									$already = 1;
									$alreadycname = 1;
									
								}
								if($_POST['email']!='')
								{
									if($_POST['email']==$row['email'])
									{
										$already = 2;
										$alreadyemail = 1;
									}
								}
							}
						}
						if ($already==0) 
						{
							$query = "
							INSERT INTO clients(email,mobilenum,clientname,payercode,profit_center,account_manager,business_unit,created_date,key,services,business_segment,account_type,category,status)
							VALUES('$email',$number,'$client_name','$payer_code','$profit_center','$account_manager','$bu','$date','$key','$services','$business_segment','$account_type','$category','$status')";
							// echo $query; die;
							$result=pg_query($conn,$query);
							if ($result) {
								echo "<script>$('#msgshowsuccess').show();</script>";
								echo '<meta http-equiv="Refresh" content="3;url=add-client">';
							}
							else{
								echo "<script>$('#msgshowerror').show();</script>";
							}
							
						}
						else{
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
				// echo "<script> alert('Captcha Invalid') </script>";
				echo "<script>$('#captchashowerror').show();</script>";
				// echo '<meta http-equiv="Refresh" content="3;url=add-client">';
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
	<?php
	spl_autoload_register(function ($class_name) {
		$preg_match = preg_match('/^PhpOffice\\\PhpSpreadsheet\\\/', $class_name);

		if (1 === $preg_match) {
			$class_name = preg_replace('/\\\/', '/', $class_name);
			$class_name = preg_replace('/^PhpOffice\\/PhpSpreadsheet\\//', '', $class_name);
			require_once(__DIR__ . '/PhpSpreadsheet/' . $class_name . '.php');
		}
	});
	
	?>
	<?php
			if(!$exportpermission) {
				echo "<script>$('#add-clients').prop('disabled', true);</script>";
				echo "<script>$('#add-clients').parent().css('cursor', 'no-drop');</script>";
				echo "<script>$('#add-clients').parent().on('click', function() {alert('No permission')});</script>";
			}
			if(!$importpermission) {
				echo "<script>$('#download-clients').prop('disabled', true);</script>";
				echo "<script>$('#download-clients').parent().css('cursor', 'no-drop');</script>";
				echo "<script>$('#download-clients').parent().on('click', function() {alert('No permission')});</script>";
			}
		?>
	<?php
	require_once("./importclient.php");
	?>
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
		var select_option_element = document.querySelector('#profit_center');
		// dselect(select_option_element,{
		// 	search:true
		// });
		// $(document).ready(function () {
      	// $('#profit_center').selectize({
        //   	sortField: 'text'
      	// 	});
  		// });
  </script>

