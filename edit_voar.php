<?php
include "./database/sql.php";
include "./components/side-bar.php";
include "./components/top-bar.php";
date_default_timezone_set('Asia/Kolkata');
$conn= OpenCon();
$id = $_GET["id"];
$sql = pg_query($conn,"SELECT * FROM voar_percentage WHERE id=".$id);
$row = pg_fetch_assoc($sql);
$VOAR_bu =$row['bu'];
$VOAR_services =$row['services'];
$VOAR_percentage =$row['percentage'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit VOAR</title>
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
		TopBar('revenue'); 
		else
		nTopBar('revenue'); ?>
		<div class="content">
			<div id="msgshowsuccess" style="display: none;">
				<div class="alert alert-dismissible alert-success">
					<button type="button" onclick="$('#msgshowsuccess').hide();" class="close" data-dismiss="alert">&times;</button>
					<strong>Successfull!</strong> VOAR Percentage is Updated.
				</div>
			</div>
			<div id="msgshowerror" style="display: none;">
				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" onclick="$('#msgshowerror').hide();" data-dismiss="alert">&times;</button>
					<strong>Unsuccessfull!</strong> VOAR Percentage could not Update. Change a few things up and try submitting again.
				</div>
			</div>
			<div id="msgshowduplicate" style="display: none;">
				<div class="alert alert-dismissible alert-warning">
					<button type="button" class="close" onclick="$('#msgshowduplicate').hide();" data-dismiss="alert">&times;</button>
					<strong>Unsuccessfull!</strong> VOAR Percentage could not regestered as it is already exist.
				</div>
			</div>
			<div class="px-4">
				<div class="graph-card mx-2 mt-4 p-4">
					<center><div class="card-title">Edit VOAR Percentage</div></center>
					<div class="d-flex justify-content-between">
						<div><a href="voar_percentage"><button style="background-color: transparent;outline: none;border: none;font-size: 25px;"><i class="fa fa-angle-left"></i></button></a></div>
					</div>
						<div class="mt-4">
							<form method="post">
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
										if($bu==$VOAR_bu){
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
										if($services==$VOAR_services){
											echo "<option value='$services' selected>".$services."</option>";
										}
										else
										echo "<option value='$services'>".$services."</option>";
									}
									echo "</select></div>";
								}
								?>
								<div class="form-group mb-3">
									<label for="Percentage">Percentage:</label>
									<input type="number" max='100' id="Percentage" name="Percentage" class="form-control"  required="" placeholder="Percentage"  value="<?php echo isset($_POST['Percentage']) ? $_POST['Percentage']: $VOAR_percentage;?>">
								</div>
								<input type="hidden" id="captcha_token" name="captcha_token">

								<div class="d-flex justify-content-center">
									<input type="submit" class="btn btn-success but" name="Client" value="Update VOAR">
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
					$bu =$_POST["bu"];
					$services =$_POST["services"];
					$Percentage=$_POST['Percentage'];
					$verify = true;
					$check = pg_query($conn, "SELECT * FROM voar_percentage");
					while($row = pg_fetch_assoc($check))
					{
						if($row['id'] != $_GET['id'])
						{
							if($row['bu'] == $bu && $row['services'] == $services){
								$verify = false;
								// echo "<script>console.log('hi')</script>";
							}
						}
					}
					if($verify)
					{
						$query = "UPDATE voar_percentage SET services='$services',bu='$bu', percentage='$Percentage' WHERE id=".$id;
						$result=pg_query($conn,$query);
						if ($result) {
							echo '<meta http-equiv="Refresh" content="3;url=edit_voar?id='.$_GET['id'].'">';
							echo "<script>$('#msgshowsuccess').show();</script>";
						}
						else{
							echo "<script>$('#msgshowerror').show();</script>";
						}
					}
					else
					{
						echo "<script>$('#msgshowduplicate').show();</script>";
					}
				}
			}
			else{
				echo "<script> alert('Captcha Invalid') </script>";

			}
		}
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
  </script>