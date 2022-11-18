<?php
include "./database/sql.php";
include "./components/side-bar.php";
include "./components/top-bar.php";
$conn= OpenCon();
$id = $_GET["id"];
$sql = pg_query($conn,"SELECT * FROM user_account WHERE id=".$id);
$row = pg_fetch_assoc($sql);
$userStatus=$row['status'];
$userDesgnation=$row['desgnation'];
$bu=$row['bu'];
$useraccounttype=$row['accounttype'];
$userBUType=$row['bu'];
$viewChecked = $row['view_check'];
$editChecked = $row['edit_check'];
$deleteChecked = $row['delete_check'];
$importChecked = $row['import_check'];
$exportChecked = $row['export_check'];
date_default_timezone_set('Asia/Kolkata');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit User</title>
	<!-- CSS -->
	<link rel="stylesheet" href="./css/index.css">
	<link rel="stylesheet" href="./css/edit-user.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" type="text/css" />

	<!-- JS -->
	<script src="./js/main.js"></script>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
	
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
		TopBar('user'); 
		else
		nTopBar('user');
		?>
		<div class="content">
			<div id="noregister" class="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="background-color: rgba(241, 130, 141,0.2);">
				<div class="modal-dialog modal-lg">
					<div class="modal-content" >
						<div class="modal-header">
							<h5 class="modal-title">Saving Unsuccessful</h5>
							<button onmouseover="this.style.color='red'" onMouseOut="this.style.color='black'" style="background-color: transparent;outline: none;border: none;font-size: 25px" type="button" class="close" data-dismiss="noregister" aria-label="Close" onclick="$('#noregister').hide();">
								<b>x</b><!-- <span aria-hidden="true">&times;</span> -->
							</button>
						</div>
						<div class="modal-body" >
							<div id="nomailmsg">Email-ID or phone number already exist</div>
						</div>
					</div>
				</div>
			</div>
			<div id="msgshowsuccess" style="display: none;">
				<div class="alert  alert-success">
					<button type="button" onclick="$('#msgshowsuccess').hide();" class="close" data-dismiss="alert">&times;</button>
					<strong>Successfull!</strong> User <strong><?php echo isset($_POST['fName']) ? $_POST['fName']:''?></strong> has been updated.
				</div>
			</div>
			<div id="msgshowerror" style="display: none;">
				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" onclick="$('#msgshowerror').hide();" data-dismiss="alert">&times;</button>
					<strong>Unsuccessfull!</strong> Users entries could has not updated. Change a few things up and try submitting again.
				</div>
			</div>
			<div class="px-4">
				<div class="graph-card mx-2 mt-4 p-4">
					<center><div class="card-title">Edit User</div></center>
					<div><a href="users"><button style="background-color: transparent;outline: none;border: none;font-size: 25px;"><i class="fa fa-angle-left"></i></button></a></div>
					
					<div class="mt-4">
						<form method="post" name="myForm" id="myForm">
							<div class="form-group mb-3">
								<label for="fName">First Name:</label>
								<input type="text" value="<?php echo isset($_POST['fName']) ? $_POST['fName']: $row['fname'];?>" id="fName" name="fName" class="form-control" placeholder="First Name" required="">
							</div>
							<div class="form-group mb-3">
								<label for="lName">Last Name:</label>
								<input type="text" id="lName" value="<?php echo isset($_POST['lName']) ? $_POST['lName']: $row['lname'];?>" name="lName" class="form-control" placeholder="Last Name" required="">
							</div>
							<div class="form-group mb-3">
								<label for="email">Email:</label>
								<input type="email" value="<?php echo isset($_POST['email']) ? $_POST['email']: $row['email'];?>" id="email" name="email" class="form-control" placeholder="Email" required="">
								<div style="color: red" id="error"></div>
							</div>
							<div class="form-group mb-3">
								<label for="Password">Password:</label>
								<input type="password" value="<?php echo isset($_POST['password']) ? $_POST['password']: $row['password'];?>" name="password" id="password"  class="form-control"  placeholder="Enter Password">
								<div style="float: right;margin-top: -31px;margin-right: 10px;" title="Show/Hide"><i class="fa fa-eye cl" onMouseOver="this.style.color='orange'"
									onMouseOut="this.style.color='black'" onclick="myFunction()"></i>
								</div>
								<div style="color: red" id="errorpassword"></div>
							</div>
							<div class="form-group mb-3">
								<label for="number">Mobile Number:</label>
								<input type="number" value="<?php echo isset($_POST['number']) ? $_POST['number']: $row['mnumber'];?>" id="number" name="number" class="form-control"  required="" placeholder="Mobile Number">
								<div style="color: red" id="errorp"></div>
							</div>
							<div class="form-group mb-3">
								<?php
								if($userDesgnation == 'AM' || $userDesgnation == 'RM')
								{
									$sql = pg_query($conn,"SELECT * FROM static_master_account_type");
									if (pg_num_rows($sql)>0) 
									{
										echo "<div class='form-group mb-3'><label for='category'>Account Type:</label><select id='account_type' class='form-select chosen-select' multiple data-placeholder='Select Account Type' name='account_type[]'>";
										while ($row = pg_fetch_assoc($sql)) 
										{	
											$account_type=$row['account_type'];
											$check = $userDesgnation."-".$account_type;
											$arr = explode(", ", $useraccounttype);
											$flag = 0;
											for($i = 0; $i < count($arr);$i++) {
												if($check == $arr[$i]) {
													$flag = 1;
												}
											}
											if($flag == 1)
											{echo "<option value='$account_type' selected>".$account_type."</option>";}
											else
											echo "<option value='$account_type'>".$account_type."</option>";
										}
										echo "</select></div>";
									}
								}
								?>
								<?php
								if($userDesgnation == 'BU')
								{
									echo '<div class="form-group mb-3">';
									$sql = pg_query($conn,"SELECT DISTINCT bu FROM static_master_bu");
									if (pg_num_rows($sql)>0) 
									{
										echo "<div class='form-group mb-3'><label for='business_user'>Business Unit:</label><select id='business_user' class='form-select chosen-select' multiple data-placeholder='Select Business Unit' name='business_user[]'>";
										while ($row = pg_fetch_assoc($sql)) 
										{	
											// $business_user=$row['business_user'];
											$check = $row['bu'];
											$arr = explode(", ", $userBUType);
											$flag = 0;
											for($i = 0; $i < count($arr);$i++) {
											echo "<script>console.log('$arr[$i]')</script>";
												if($check == $arr[$i]) {
													$flag = 1;
												}
											}
											if($flag == 1)
											{echo "<option value='$check' selected>".$check."</option>";}
											else
											echo "<option value='$check'>".$check."</option>";
										}
										echo "</select></div>";
									}
									
									
									
									// if (pg_num_rows($sql)>0) 
									// {	echo '<div id="outsput"></div>';
									// 	echo "<div class='form-group mb-3'><label for='category'>Business Unit
									// 	:</label><select id='business_user' class='form-select ' name='business_user'  required=''>";
									// 	while ($row = pg_fetch_assoc($sql)) 
									// 	{	
									// 		$business_user=$row['bu'];
									// 		if($bu==$business_user)
									// 			echo "<option value='$business_user' selected >$business_user</option>";
									// 		else
									// 			echo "<option value='$business_user'>".$business_user."</option>";
									// 	}
									// 	echo "</select></div>";
									// }
								}
								?>
							</div>
							</div>
							<div class='form-group mb-3'>
									<label for='status'>Status:</label>
									<select id='status' class='form-select' name='status'>
										<?php if($userStatus=='active'){
											echo "<option value='active' selected>Active</option>";
											echo "<option value='deactive'>Deactive</option>";
										 }
											if($userStatus=='deactive'){
											echo "<option value='active' >Active</option>";
											echo "<option value='deactive' selected>Deactive</option>";
										 }
										 ?>
									</select>
								</div>
								<input type="hidden" id="captcha_token" name="captcha_token">

							<div class="d-flex justify-content-center">
								<input type="submit" class="btn btn-success" data-toggle="modal" name="user" id="submit" value="Save User" />
							</div>
						</form>
						<!-- form -->
					</div>
				</div>
					<?php
				include "./components/footer.php"
			?>
			</div>
		</div>

	</div>
</div>



<?php
function generate_password($length = 20)
{
	$chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
	'0123456789`';

	$str = '';
	$max = strlen($chars) - 1;

	for ($i=0; $i < $length; $i++)
		$str .= $chars[random_int(0, $max)];

	return $str;
}
$password = generate_password();
if(isset($_POST['user'])){
	$secret = "6Le6my0hAAAAAODDi8UgKvu3JQU1VfCIB78-NGwt";
	$response = $_POST['captcha_token'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response."&remoteip=".$ip;

	$request =  file_get_contents($url);
	$result = json_decode($request);
	if($result->success == true){
		if (array_key_exists("user", $_POST)) 
		{ 

			function test_input($data) 
			{
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			$email = test_input($_POST["email"]);
			$flag=FALSE;
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
				{
					echo "<script>var div = document.getElementById('error');

					div.innerHTML += 'Enter a valid email!';</script>";
					$flag=TRUE;
						// die();
				}
				if(!preg_match('/^[0-9]{10}+$/', $_POST["number"]))
				{
					echo "<script>var div = document.getElementById('errorp');

					div.innerHTML += 'Enter a valid Phone number!';</script>";
					$flag=TRUE;
				}
				if ( strlen($_POST['password'])<8 ) 
				{
					echo "<script>var div = document.getElementById('errorpassword');

					div.innerHTML += 'Select a strong password(min. 8 character)';</script>";
					$flag=TRUE;
				
				}
				if($flag==FALSE)
				{
				$conn= OpenCon();
				
				$fname =$_POST["fName"];
				$lname =$_POST["lName"];
				$business_user = $_POST['business_user'];
				$email =$_POST["email"];
				$password=$_POST['password'];
				$e_password = md5($password);
				$number =$_POST["number"];
				$status=$_POST['status'];
				$len= count($_POST["account_type"]);
				if($_POST["account_type"] != null)
				{
					$len= count($_POST["account_type"]);
					$arr= [];
					for($i=0;$i<$len;$i++){
						array_push($arr,$userDesgnation.'-'.$_POST["account_type"][$i]);
					}
					$accountType = join(', ',$arr);
				}
				if($business_user != null)
				{
					$len= count($_POST["business_user"]);
					$arr_bu= [];
					$arr_ac=[];
					for($i=0;$i<$len;$i++){
						array_push($arr_ac,$userDesgnation.'-'.$_POST["business_user"][$i]);
						array_push($arr_bu,$_POST["business_user"][$i]);
					}
					$accountType = join(', ',$arr_ac);
					$business_user = join(', ',$arr_bu);
						// $accountType= $designation.'-'.$business_user;
				}
				$sql = pg_query($conn,"SELECT * FROM user_account");
				$already = 0;
				// if (pg_num_rows($sql)>0) 
				// {
				// 	while ($row_db = pg_fetch_assoc($sql)) 
				// 	{
				// 		// if (($row_db["email"] == $_POST["email"] || $row_db["mnumber"] == $_POST["number"]) && $id != $row_db["id"]) 
				// 		// {
				// 		// 	$already=1;
				// 		// }
				// 	}
				// }
				if ($already!=1) 
				{

					$date = date("Y/m/d H:m:s");
					$query = "
					UPDATE user_account SET bu='$business_user', password='$e_password', accounttype='$accountType', status='$status', email='$email',mnumber='$number',fname='$fname',lname='$lname', last_updated_date ='$date' WHERE id=".$id;
					$result=pg_query($conn,$query);
					// echo $query;
					if ($result) 
						{
							echo "<script>$('#msgshowsuccess').show();</script>";
						echo '<meta http-equiv="Refresh" content="0;url=edit-user?id='.$_GET['id'].'">';
								// $reload=1;
							// include_once "mail";
					// echo '';
				}
				else
				{
							// echo "<script>setTimeout(function() {
							// 	$('#nomailmodal').show();
							// }, 100);</script>";


					echo "<script>$('#msgshowerror').show();</script>";
							// echo "<script>var div = document.getElementById('nomailmsg');

							// div.innerHTML += 'user could not be added, try later';</script>";
					echo '';

				}
			}
			else
			{
				echo "<script>setTimeout(function() {
					$('#noregister').show();
				}, 100);</script>";
			}
			
		}
		}
		else{
			echo "<script> alert('Captcha Invalid') </script>";

		}
	}
}
?>
<script>
		function myFunction() {
			var x = document.getElementById("password");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
		$(".chosen-select").chosen();
	</script>
</body>
</html>
<script>
        grecaptcha.ready(function() {
          grecaptcha.execute('6Le6my0hAAAAAKkeamNMFcXqpIhinxSLX7y1W2qO', {action: 'user'}).then(function(token) {
              // Add your logic to submit to your backend server here.
			  var response = document.getElementById('captcha_token');
			  response.value = token;
          });
        });
  </script>