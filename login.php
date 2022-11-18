<?php

include "./database/sql.php";
include "ldap.php";
session_start();
date_default_timezone_set('Asia/Kolkata');
error_reporting(0);

$conn = OpenCon();
$result = pg_query($conn, "SELECT * FROM user_account ORDER BY id ASC");
$arr_users = [];
if (pg_num_rows($result) > 0) {
	$arr_users = pg_fetch_all($result);
}
// $qwq="1 - ".$_COOKIE["remember_me"];
// echo "<script>console.log('$qwq')</script>";
if ($_COOKIE["remember_me"] != 'remember_me' && $_COOKIE["login"] == 'login') {
	if ((time() - $_COOKIE["remember_me"]) > 3600) // 3600 = 60 * 60  
	{
		// echo "<script>window.location.href = './logout.php'</script>"; 
	} else {
		setcookie("remember_me", time());
		if (($_COOKIE["login"]) == 'login') {
			echo "<script>window.location.href = './index'</script>";
		}
	}
}
if ($_COOKIE["remember_me"] == 'remember_me' && $_COOKIE["login"] == 'login') {
	if (($_COOKIE["login"]) == 'login')
		echo "<script>window.location.href = './index'</script>";
}
?>
<?php
if (array_key_exists("login", $_POST)) {

	/* old code for login field for input
	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$email = test_input($_POST["email"]);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<script>var div = document.getElementById('error');

				div.innerHTML += 'Enter a valid email!';</script>";
	}
	else { */
	//ldap code here
	$ldap = new portal_ldap();
	$host = "172.16.2.5";
	$ldap->host_setter($host);

	$ldap->userpass_setter($_POST['username'], $_POST['password']);
	$res = $ldap->connect();
	if(empty($res)){
		header("location:504.php");
	}
	else if ($ldap->connect()) {
		$ad_email = $ldap->getUserArray();
		$e_password = md5($_POST['password']);
		$query = "SELECT * FROM user_account WHERE email = '" . $ad_email . "'";
		$result = pg_query($conn, $query);
		$registered = 0;
		$flag = 0;

		if (pg_num_rows($result) > 0) {
			while ($row = pg_fetch_assoc($result)) {
				$user = $row["username"];
				$pass = $row["password"];				
				if ($row["email"] == $ad_email) {
					$registered = 1;
					if ($row["status"] == 'active') {
						$flag = 1;
						$registered = 1;
						$_SESSION["type"] = $row["desgnation"];
						$_SESSION["username"] = $row["fname"] . " " . $row["lname"];
						$_SESSION['check'] = 'yes';
						setcookie('type', $row["desgnation"], time() + 10 * 24 * 60 * 60);
						setcookie('username', $row["fname"] . " " . $row["lname"], time() + 10 * 24 * 60 * 60);
						setcookie('check', 'yes', time() + 10 * 24 * 60 * 60);
						if (isset($_POST['remember_me'])) {
							$_SESSION['remember_me'] = 'remember_me';
							setcookie("remember_me", "remember_me"); // 1 day
							setcookie("login", "login"); // 10 day
						}
						if (!isset($_POST['remember_me'])) {
							setcookie("remember_me", time());
							setcookie("login", "login");
						}
						//remove redirect on reset password
						// if ($row['isnew'] == 1) {
						// 	$flag = 2;
						// }
					} else if ($row["status"] == 'deactive') {
						$flag = 3;
					}
					echo "<script>var div = document.getElementById('error');

							div.innerHTML += '';</script>";
				}
				if ($flag == 1) {
					$_SESSION["username"] = $_POST['username'];
					setcookie('username', $_POST['username'], time() + 10 * 24 * 60 * 60);
					setcookie('email', $ad_email, time() + 10 * 24 * 60 * 60);
					// setcookie('','',time() +  10 * 24 * 60 * 60);
					$date = date("Y/m/d H:i:s");
					$update_query = "UPDATE user_account SET last_login = '$date' WHERE email = '" . $ad_email . "'";
					$result = pg_query($conn, $update_query);
					if ($result) {
						echo "<script>window.location.href = './index'</script>";
						die();
					}
				}
				//remove redirect on reset password
				// if ($flag == 2) {
				// 	$_SESSION["username"] = $_POST['username'];
				// 	setcookie('username', $_POST['username'], time() + 10 * 24 * 60 * 60);
				// 	echo "<script>window.location.href = './reset'</script>";
				// 	die();
				// }
				if ($flag == 3) {
					echo '<script>window.onload = function(){$("#deactive").show();}</script>';
				}
				if ($registered != 1) {
					echo "<script> window.onload = function() {
								document.getElementById('error').innerHTML = 'Your username or password is wrong!'; }</script>";
				}
			}
		} else {
			if(!empty($ad_email)){
				$get_name = explode(".", $_POST['username']);
				$fname = $get_name[0];
				$lname = $get_name[1];
				$isnew = 1;
				$date = date("Y/m/d H:i:s");
				$status = "active";
				$phone = '1234560000';
				$phone = sprintf('%s%04d', substr($phone, 0, -4), rand(0, 9999));
				$mnumber = $phone;
				$desgnation = "CU";
				$accounttype = "";
				$username = $_POST['username'];
				$empty_password = '';
				$insert_query = "
					INSERT INTO user_account(email,password,username,fname,lname,isnew,created_date,import_type,status,mnumber,desgnation,accounttype)
					VALUES('$ad_email','$empty_password','$username','$fname','$lname',$isnew,'$date','Manual','$status','$mnumber','$desgnation','$accounttype')";
				$result = pg_query($conn, $insert_query);
				if ($result) {
					echo "<script> window.onload = function() {
							document.getElementById('success').innerHTML = 'You can login with your credential'; }</script>";
				}

			}else{
				echo "<script> window.onload = function() {
					document.getElementById('error').innerHTML = 'You are not authorize for login! Please use your domain credentials.'; }</script>";
			}
			
		}
		$ldap->close();
	} else {
		$ldap->close();
		echo "<script> window.onload = function() {
						document.getElementById('error').innerHTML = 'You are not authorize for login! Please use your domain credentials.'; }</script>";
	}


	/* $conn= OpenCon();
	$email=$_POST['email'];
	$password=$_POST['password'];	
	$e_password= md5($password);					
	$result = pg_query($conn,"SELECT * FROM user_account");
	$registered=0;
	$flag=0;
	if (pg_num_rows($result)>0) 
	{
		while ($row = pg_fetch_assoc($result)) 
		{
			$user=$row["email"];
			$pass=$row["password"];
			// for encrypted password check ,just remove or(||) condition.
			if ($row["email"]==$email && ($e_password==$row["password"] ||$password==$row["password"])) 
			{ 
				$registered=1;
				if($row["status"]=='active')
				{
					$flag=1;
					$registered=1;
					$_SESSION["type"] = $row["desgnation"];
					$_SESSION["username"] = $row["fname"]." ".$row["lname"];
					$_SESSION['check']='yes';
					setcookie('type',$row["desgnation"],time() +  10 * 24 * 60 * 60);
					setcookie('username',$row["fname"]." ".$row["lname"],time() +  10 * 24 * 60 * 60);
					setcookie('check','yes',time() +  10 * 24 * 60 * 60);
					if (isset($_POST['remember_me']))
					{
						$_SESSION['remember_me']='remember_me';
						setcookie ("remember_me","remember_me"); // 1 day
						setcookie ("login","login"); // 10 day
					}
					if (!isset($_POST['remember_me']))
					{
						setcookie ("remember_me",time());
						setcookie ("login","login");
					}
					if ($row['isnew']==1) {
						$flag = 2;
					}
				}
				else if($row["status"]=='deactive')
				{
					$flag = 3;	
				}
				echo "<script>var div = document.getElementById('error');

				div.innerHTML += '';</script>";
			}
			if ($flag==1) 
			{
				$_SESSION["email"] = $email;
				setcookie('email',$email,time() +  10 * 24 * 60 * 60);
				// setcookie('','',time() +  10 * 24 * 60 * 60);
				$date = date("Y/m/d H:i:s");
				$query = "UPDATE user_account SET last_login = '$date' WHERE email='$email'";
				$result=pg_query($conn,$query);
				echo "<script>window.location.href = './index'</script>";
				die();
			}

			if ($flag==2) 
			{	
				$_SESSION["email"] = $email;
				setcookie('email',$email,time() +  10 * 24 * 60 * 60);
				echo "<script>window.location.href = './reset'</script>";
				die();
			}
			if ($flag==3) 
			{	
				echo '<script>window.onload = function(){$("#deactive").show();}</script>';

			}
		}
	}
	if ($registered!=1) {

		echo "<script> window.onload = function() {
			document.getElementById('error').innerHTML = 'your email or password is wrong!'; }</script>";
	}
	} old code else condition */
}
?>
<!DOCTYPE html>
<html>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="./css/login.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
	<div class="container">
		<div id="deactive" class="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="backdrop-filter: blur(10px);background-color: rgba(0, 0, 0,0.5);">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Deactivated!</h5>
						<button onmouseover="this.style.color='red'" onMouseOut="this.style.color='black'" style="background-color: transparent;outline: none;border: none;font-size: 25px" type="button" class="close" data-dismiss="deactive" aria-label="Close" onclick="$('#deactive').hide();">
							<b>x</b><!-- <span aria-hidden="true">&times;</span> -->
						</button>
					</div>
					<div class="modal-body">
						<div id="mailmsg">Your account have been deactivated</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5 mx-auto">
				<div id="first">
					<div class="myform form ">
						<div class="logo mb-3">
							<div class="col-md-12 text-center">
								<h1>Login</h1>
							</div>
						</div>
						<form action="" method="post" name="login">
							<div class="form-group">
								<label for="exampleInputEmail1">Username</label>
								<input type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Username">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Password</label>
								<input type="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" name="password" id="password" class="form-control" aria-describedby="emailHelp" placeholder="Enter Password">
								<div style="float: right;margin-top: -31px;margin-right: 10px;" title="Show/Hide"><i class="fa fa-eye cl" onMouseOver="this.style.color='orange'" onMouseOut="this.style.color='black'" onclick="myFunction()"></i></div>
							</div>
							<div class="col-md-12 text-center ">
								<div style="float: left;margin-top: -10px;margin-bottom: 20px;">
									<input type="checkbox" name="remember_me" value="remember_me">
									<label> Remember Me</label>
								</div>
								<input type="submit" value="login" name="login" class=" btn btn-block mybtn btn-primary tx-tfm">
							</div>
							<!--<div class="form-group">-->
							<!--	<p class="text-center" style="font-size: 12px;margin-top: 5px;">By signing up you accept our <a href="#">Terms Of Use</a></p>-->
							<!--</div>-->
						</form>
						<center>
							<div style="color: red" id="success"></div>
						</center>
						<center>
							<div style="color: red" id="error"></div>
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
<script>
	function myFunction() {
		var x = document.getElementById("password");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}
</script>
<script type="text/javascript">
	$(function() {
		$("form[name='login']").validate({
			rules: {
				username: {
					required: true,
				},
				password: {
					required: true,

				}
			},
			messages: {
				username: {
					required: "Please enter username/email",
				},
				password: {
					required: "Please enter password",
				}

			},
			submitHandler: function(form) {
				$('#error').html('');
				const username = form.username.value;
				const ckUserName = username.includes('@');
				if (!ckUserName) {
					form.submit();
				} else {
					$('#error').html('Enter a valid username!');
				}

			}
		});
	});
</script>
<?php
// session_destroy();
?>

</html>