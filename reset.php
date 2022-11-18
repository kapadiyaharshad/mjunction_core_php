<?php 
include "./database/sql.php";
session_start();
if (!isset($_COOKIE['email'])) {
	echo "<script>window.location.href = './login'</script>";
}
$email=$_COOKIE['email'];
date_default_timezone_set('Asia/Kolkata');
$conn= OpenCon();
$result = pg_query($conn,"SELECT * FROM user_account where email='$email'");
if (pg_num_rows($result)>0) 
{
	while ($row = pg_fetch_assoc($result)) 
	{
		if ($row['isnew']==0) {
			echo "<script>window.location.href = './login'</script>";

		}
	}
}
?>
<!DOCTYPE html>
<html>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<head>
	<title>reset password</title>
	<!-- <link rel="stylesheet" type="text/css" href="resetpassword.css"> -->
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-5 mx-auto">
				<div id="first">
					<div class="myform form ">
						<div class="logo mb-3">
							<div class="col-md-12 text-center">
								<h1>Reset Password</h1>
							</div>
						</div>
						<form action="" method="post" name="resetpasswordform">
							<div class="form-group">
								<label for="exampleInputEmail1">Password</label>
								<input type="password" name="password" id="password"  class="form-control" value="<?php echo isset($_POST['password']) ? $_POST['password']: '';?>" aria-describedby="emailHelp" placeholder="Enter Password">
								<div style="float: right;margin-top: -31px;margin-right: 10px;" title="Show/Hide"><i class="fa fa-eye cl" onMouseOver="this.style.color='orange'"
									onMouseOut="this.style.color='black'" onclick="myFunction()"></i></div>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Confirm Password</label>
								<input type="password" name="confirmpassword"  class="form-control" id="confirmpassword" aria-describedby="emailHelp" placeholder="confirm password">
								<div style="float: right;margin-top: -31px;margin-right: 10px;" title="Show/Hide"><i class="fa fa-eye cl" onMouseOver="this.style.color='orange'"
									onMouseOut="this.style.color='black'" onclick="myFunction2()"></i></div>
								</div>
							</div>
							<div class="col-md-12 text-center ">
								<input type="submit" value="Reset Password" name="submit" class=" btn btn-block mybtn btn-primary tx-tfm">
							</div>
							<center><div id="resteshort" style="color: red;display: none">select a strong password(min. 8 character)</div></center>
							<center><div id="restesame" style="color: red;display: none">password and confirm password dose not match</div></center>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div> 
	<?php
	// echo "string";
	if (array_key_exists("submit", $_POST)) 
	{
		// echo 'in';

		$conn= OpenCon();
		$confirmpassword=$_POST['confirmpassword'];
		$password=$_POST['password'];								
		$result = pg_query($conn,"SELECT * FROM user_account");
		if (pg_num_rows($result)>0) 
		{
			while ($row = pg_fetch_assoc($result)) 
			{
				$user=$row["email"];
				$pass=$row["password"];
					// $_COOKIE["email"] = $email;
					// $_COOKIE["type"] = $row["desgnation"];
					// $_COOKIE["username"] = $row["fname"]." ".$row["lname"];
			}
		}
		$flag=0;
		echo 'in';
		if ( strlen($password)>=8 ) 
		{
			$flag=1;
			if ($password==$confirmpassword) 
			{
				$flag=2;
				$e_password = md5($password);
			}
			else{
			echo "<script>$('#restesame').show();</script>";
			}
		}
		else 
		{
				echo "<script>$('#resteshort').show();</script>";
		}
		if ($flag==2) 
		{
			$query1 = "UPDATE user_account SET isnew = '0' WHERE email='$email'";
			$result1=pg_query($conn,$query1);

			$query = "UPDATE user_account SET password = '$e_password' WHERE email='$email'";
			$result=pg_query($conn,$query);
			echo "<center>password reseted. redirecting...</center>";
			echo '<meta http-equiv="refresh" content="3;url=./login" />';
			die();
		}
	}
	?>
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
<script>
	function myFunction2() {
		var x = document.getElementById("confirmpassword");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}
</script>
<script type="text/javascript">
	$(function() {
		$("form[name='resetpasswordform']").validate({
			rules: {

				confirmpassword: {
					required: true
				},
				password: {
					required: true,

				}
			},
			messages: {
				confirmpassword: "Please enter confirm password",

				password: {
					required: "Please enter password",

				}

			},
			submitHandler: function(form) {
				form.submit();
			}
		});
	});
</script>
</html>