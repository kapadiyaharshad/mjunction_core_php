<?php
include "./database/sql.php";
include "./components/side-bar.php";
include "./components/top-bar.php";
date_default_timezone_set('Asia/Kolkata');
$type=$_COOKIE['type'];
if($type != 'ADMIN'){
	echo "<script>window.location.href = './summary'</script>";
}
$conn= OpenCon();
$id = $_GET["id"];
$sql = pg_query($conn,"SELECT * FROM abp WHERE id=".$id);
$row = pg_fetch_assoc($sql);
$ABP_bu =$row['bu'];
$parsed_date = date_parse(str_replace("/", "-", $row["month"]));
$ABP_month_1 = strtotime(date($parsed_date["year"]."-".$parsed_date["month"]));
$ABP_month=date("Y-m", $ABP_month_1);
$ABP_profit_center =$row['profit_center'];
$ABP_payer_code =$row['payer_code'];
$ABP_client_name =$row['client_name'];
$ABP_target_amount =$row['target_amount'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit ABP Target</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- CSS -->
	<link rel="stylesheet" href="./css/index.css">
	<link rel="stylesheet" href="./css/add-client.css">

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
		nTopBar('revenue');
		?>
		<div class="content">
			<div id="msgshowsuccess" style="display: none;">
				<div class="alert alert-dismissible alert-success">
					<button type="button" onclick="$('#msgshowsuccess').hide();" class="close" data-dismiss="alert">&times;</button>
					<strong>Successfull!</strong> Anual Business Plan Target is updated.
				</div>
			</div>
			<div id="msgshowerror" style="display: none;">
				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" onclick="$('#msgshowerror').hide();" data-dismiss="alert">&times;</button>
					<strong>Unsuccessfull!</strong> Anual Business Plan Target could not update. Change a few things up and try submitting again.
				</div>
			</div>
			<div id="msgshowduplicate" style="display: none;">
				<div class="alert alert-dismissible alert-warning">
					<button type="button" class="close" onclick="$('#msgshowduplicate').hide();" data-dismiss="alert">&times;</button>
					<strong>Unsuccessfull!</strong> Anual Business Plan Target could not regestered as it is already exist.
				</div>
			</div>
			<div class="px-4">
				<div class="graph-card mx-2 mt-4 p-4">
					<center><div class="card-title">Edit Anual Business Plan Target</div></center>
					<div class="d-flex justify-content-between">
						<div><a href="abp"><button style="background-color: transparent;outline: none;border: none;font-size: 25px;"><i class="fa fa-angle-left"></i></button></a></div>
					</div>
					<div class="px-2">
						<form method="post">
							<div class="form-group mb-3">
								<div class="form-group mb-3">
									<label for="month">Month:</label>
									<input type="Month" disabled id="month" name="month" value='<?= $ABP_month?>' format "YYYY-MM" class="form-control"  required="" placeholder="month">
									<span class='d-none'>Select Month</span>
								</div>	
								<?php
							
								$conn= OpenCon();
								$sql = pg_query($conn,"SELECT DISTINCT bu FROM static_master_bu");
								if (pg_num_rows($sql)>0) 
								{
									echo "<div class='form-group mb-3'><label for='bu'>Business Unit:</label><select id='bu' class='form-select' required='' name='bu'>";
									echo "<option value='' selected disabled>Select Business Unit</option>";
									while ($row = pg_fetch_assoc($sql)) 
									{	
										$bu=$row['bu'];
										if($bu == $ABP_bu)
											echo "<option selected value='$bu'>".$bu."</option>";
											
										else
											echo "<option value='$bu'>".$bu."</option>";
									}
									echo "</select></div>";
								}
								// echo $ABP_profit_center;
								$sql = pg_query($conn,"SELECT DISTINCT profit_center FROM clients WHERE business_unit='$ABP_bu'");
								echo "<div class='form-group mb-3'><label for='profit_center'>Profit Center:</label><select id='profit_center' class='form-select' required='' name='profit_center'>";
								echo "<option value='' selected disabled>Select Profit Center</option>";
								if (pg_num_rows($sql)>0) 
								{
									while ($row = pg_fetch_assoc($sql)) 
									{
										echo json_encode($row['profit_center'] ==$ABP_profit_center);
										$profit_center=$row['profit_center'];
										if($profit_center == $ABP_profit_center)
											echo "<option selected value='$profit_center'>".$profit_center."</option>";
											
										else
											echo "<option value='$profit_center'>".$profit_center."</option>";
									}
								}
								echo "</select></div>";
								
								$sql = pg_query($conn,"SELECT * FROM clients WHERE business_unit='$ABP_bu'");
								echo "<div class='form-group mb-3'><label for='payercode'>Payer Code:</label><select id='payercode' class='form-select' required='' name='payer_code'>";
								echo "<option value='' selected disabled>Select payer code</option>";
								if (pg_num_rows($sql)>0) 
								{
									while ($row = pg_fetch_assoc($sql)) 
									{	
										$payer_code=$row['payercode'];
										if($payer_code == $ABP_payer_code)
											echo "<option selected value='$payer_code'>".$payer_code."</option>";
										
										else
											echo "<option value='$payer_code'>".$payer_code."</option>";
									}
								}
								echo "</select></div>";
								$sql = pg_query($conn,"SELECT * FROM clients WHERE business_unit='$ABP_bu'");
								echo "<div class='form-group mb-3'><label for='clients'>Clients:</label><select id='clients' class='form-select' required='' name='clients'>";
								echo "<option value='' selected disabled>Select clients</option>";
								if (pg_num_rows($sql)>0) 
								{
									while ($row = pg_fetch_assoc($sql)) 
									{	
										$client_name=$row['clientname'];
										if($client_name == $ABP_client_name)
											echo "<option selected value='$client_name'>".$client_name."</option>";
										
										else
											echo "<option value='$client_name'>".$client_name."</option>";
									}
								}
								echo "</select></div>";
								?>
								<div class="form-group mb-3">
									<label for="target_amount">Target Amount:</label>
									<input type="number" id="target_amount" value='<?= $ABP_target_amount?>' name="target_amount" class="form-control"  required="" placeholder="Target Amount"  value="<?php echo isset($_POST['target_amount']) ? $_POST['target_amount']: '';?>">
								</div>
							</div>
							<input type="hidden" id="captcha_token" name="captcha_token">

							<div class="d-flex justify-content-center">
								<input type="submit" class="btn btn-success ml-2" name="VOAR" value="Save">
							</div>
						</form>
					</div>
				</div>
			</div>
						<?php
				include "./components/footer.php"
			?>

		</div>
		<script type="text/javascript">
		$("#bu").on("change", function(e) {
			const val = e.target.value;
			$.ajax("./abp_form_selector", {
				method: "POST",
				data: { value: val, type: "business_unit" },
				success: function(res) {
					const data = JSON.parse(res);
					let html = `<option value='' selected disabled>Select Profit Center</option>`;
					for(let i = 0;i < data.length; i++) {
						html += `<option value='${data[i]}'>${data[i]}</option>`;
					}
					$("#clients").html(`<option value='' selected disabled>Select clients</option>`);
					$("#payercode").html(`<option value='' selected disabled>Select Payer Code</option>`);
					if(data.length == 0) {
						$("#clients").html(`<option value='' selected disabled>No Clients</option>`);
						$("#payercode").html(`<option value='' selected disabled>No Payer Code</option>`);
						html = `<option value='' disabled selected>No Profit Centers</option>`
					}
					$("#profit_center").html(html);
				}
			})
		})
		$("#profit_center").on("change", function(e) {
			const val = e.target.value;
			$.ajax("./abp_form_selector", {
				method: "POST",
				data: { value: val, type: "profit_center", bu: $("#bu").val() },
				success: function(res) {
					const data = JSON.parse(res);
					let html = `<option value='' selected disabled>Select clients</option>`;
					for(let i = 0;i < data.length; i++) {
						html += `<option value='${data[i][0]}'>${data[i][0]}</option>`;
					}
					if(data.length == 0)
					html = `<option value='' disabled selected>No Clients</option>`
					$("#clients").html(html);
					html = `<option value='' selected disabled>Select Payer Code</option>`;
					for(let i = 0;i < data.length; i++) {
						html += `<option value='${data[i][1]}'>${data[i][1]}</option>`;
					}
					if(data.length == 0)
					html = `<option value='' disabled selected>No Payer Code</option>`
					$("#payercode").html(html);
				}
			})
		})
	</script>
	</div>
	<?php
		if(isset($_POST['VOAR'])){
			$secret = "6Le6my0hAAAAAODDi8UgKvu3JQU1VfCIB78-NGwt";
			$response = $_POST['captcha_token'];
			$ip = $_SERVER['REMOTE_ADDR'];
			$url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response."&remoteip=".$ip;
	
			$request =  file_get_contents($url);
			$result = json_decode($request);
			if($result->success == true){
				if (array_key_exists("VOAR", $_POST)) 
				{ 
					$conn= OpenCon();
					$bu =$_POST["bu"];
					$month =$_POST["month"];
					$month = date('M/Y', strtotime($month));
					$profit_center=$_POST['profit_center'];
					$target_amount=$_POST['target_amount'];
					// echo $_POST['clients'];
					// $client = ;
					$client_name=explode('-', $_POST['clients'])[0];
					$payer_code=$_POST['payer_code'];
					$date = date("Y/m/d H:i:s");
					$verify = true;
					$check = pg_query($conn, "SELECT * FROM abp");
					while($row = pg_fetch_assoc($check))
					{
						if($row['id'] != $id)
						{	if($row['month'] == $month && $row['bu'] == $bu && $row['profit_center'] == $profit_center && $row['client_name'] == $client_name && $row['payer_code'] == $payer_code){
								$verify = false;
							}
						}	
					}
					if($verify)	
					{
						$query = "UPDATE abp SET 
						bu= '$bu', profit_center= '$profit_center', client_name= '$client_name', payer_code= '$payer_code', target_amount= '$target_amount', last_updated= '$date'
						WHERE id = '".$id."'
						";
						echo $query;
						$result=pg_query($conn,$query);
						if ($result) 
						{
							echo "<script>$('#msgshowsuccess').show();</script>";
							echo '<meta http-equiv="Refresh" content="2;url=./edit_abp?id='.$id.'">';
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
          grecaptcha.execute('6Le6my0hAAAAAKkeamNMFcXqpIhinxSLX7y1W2qO', {action: 'VOAR'}).then(function(token) {
              // Add your logic to submit to your backend server here.
			  var response = document.getElementById('captcha_token');
			  response.value = token;
          });
        });
  </script>