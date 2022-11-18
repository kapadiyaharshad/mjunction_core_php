<?php
include "./database/sql.php";
include "./components/side-bar.php";
include "./components/top-bar.php";
date_default_timezone_set('Asia/Kolkata');
$type=$_COOKIE['type'];
if($type != 'ADMIN'){
	echo "<script>window.location.href = './summary'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add ABP Target</title>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


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
					<div id="successfull-msg"><strong>Successfull!</strong> Anual Business Plan Target is regestered.</div>
				</div>
			</div>
			<div id="msgshowerror" style="display: none;">
				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" onclick="$('#msgshowerror').hide();" data-dismiss="alert">&times;</button>
					<strong>Unsuccessfull!</strong> Anual Business Plan Target could not regestered. Change a few things up and try submitting again.
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
					<center><div class="card-title">Add Anual Business Plan Target</div></center>
					<div class="d-flex justify-content-between">
						<div><a href="abp"><button style="background-color: transparent;outline: none;border: none;font-size: 25px;"><i class="fa fa-angle-left"></i></button></a></div>
					</div>
					<div class="px-2">
						<form method="post">
							<div class="d-flex justify-content-around align-items-start">
								<div class="col-3">
										<div class="form-group mb-3">
											<label for="month">Financial Year:</label>
											<input type="text" id="month"  name="month" class="form-control"  required="" placeholder="YYYY">
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
												echo "<option value='$bu'>".$bu."</option>";
											}
											echo "</select></div>";
										}
										
										$sql = pg_query($conn,"SELECT DISTINCT profit_center FROM static_master_profit_center");
										echo "<div class='form-group mb-3'><label for='profit_center'>Profit Center:</label><select id='profit_center' class='form-select' required='' name='profit_center'>";
										echo "<option value='' selected disabled>Select Profit Center</option>";
										echo "</select></div>";
										
										$sql = pg_query($conn,"SELECT * FROM clients");
										echo "<div class='form-group mb-3'><label for='payercode'>Payer Code:</label><select id='payercode' class='form-select' required='' name='payercode'>";
										echo "<option value='' selected disabled>Select Payer Code</option>";
										
										echo "</select></div>";
										$sql = pg_query($conn,"SELECT * FROM clients");
										echo "<div class='form-group mb-3'><label for='clients'>Clients:</label><select id='clients' class='form-select' required='' name='clients'>";
										echo "<option value='' selected disabled>Select clients</option>";
										echo "</select></div>";
										?>
									</div>
									<div class="col-9 row">
									<div class="col-4 mb-3">
										<label for="apr" class="month-label">Apr:</label>
										<input type="text" name="Apr" placeholder="Target Amount" id="apr" class="form-control" required="">
									</div>
									<div class="col-4 mb-3">
										<label for="may" class="month-label">May:</label>
										<input type="text" name="May" placeholder="Target Amount" id="may" class="form-control" required="">
									</div>
									<div class="col-4 mb-3">
										<label for="month" class="month-label">Jun:</label>
										<input type="text"  name="Jun" placeholder="Target Amount" class="form-control"  required="">
									</div>
									<div class="col-4 mb-3">
										<label for="month" class="month-label">Jul:</label>
										<input type="text" name="Jul" placeholder="Target Amount" class="form-control"  required="">
									</div>
									<div class="col-4 mb-3">
										<label for="month" class="month-label">Aug:</label>
										<input type="text" name="Aug" placeholder="Target Amount" class="form-control"  required="">
									</div>
									<div class="col-4 mb-3">
										<label for="month" class="month-label">Sep:</label>
										<input type="text" name="Sep" placeholder="Target Amount" class="form-control"  required="">
									</div>
									<div class="col-4 mb-3">
										<label for="month" class="month-label">Oct:</label>
										<input type="text" name="Oct" placeholder="Target Amount" class="form-control"  required="">
									</div>
									<div class="col-4 mb-3">
										<label for="month" class="month-label">Nov:</label>
										<input type="text" name="Nov" placeholder="Target Amount" class="form-control"  required="">
									</div>
									<div class="col-4 mb-3">
										<label for="month" class="month-label">Dec:</label>
										<input type="text" name="Dec" placeholder="Target Amount" class="form-control"  required="">
									</div>
									<div class="col-4 mb-3">
										<label for="month" class="next-month-label">Jan:</label>
										<input type="text" name="Jan" placeholder="Target Amount" class="form-control"  required="">
									</div>
									<div class="col-4 mb-3">
										<label for="month" class="next-month-label">Feb:</label>
										<input type="text" name="Feb" placeholder="Target Amount" class="form-control"  required="">
									</div>
									<div class="col-4 mb-3">
										<label for="month" class="next-month-label">Mar:</label>
										<input type="text" name="Mar" placeholder="Target Amount" class="form-control"  required="">
									</div>
									<input type="hidden" id="captcha_token" name="captcha_token">

							<div class="d-flex justify-content-end mt-4" >
								<input type="submit" class="btn btn-success mr-4" style="height:38px"name="VOAR" value="Save">
								<a href="abp"><div class="btn btn-danger delete-btn">cancel</div></a>
							</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function updateValue(date) {
			const first = date.slice(0, 4);
			const last = parseInt(first) + 1;
			console.log(first, date, last)
			$(".month-label").each(function() {
				const month = $(this).text().slice(0, 3);
				$(this).html(`${month} - ${first}:`);
			});
			$(".next-month-label").each(function() {
				const month = $(this).text().slice(0, 3);
				$(this).html(`${month} - ${last}:`);
			});
		}
		
		const today = new Date();
		updateValue(`${today.getFullYear()}`)
		
		$("#month").val(`${today.getFullYear()}-${today.getFullYear() + 1}`);
		
		$("#month").on("change", function(e) { updateValue(e.target.value); });
		
		$('#month').datepicker({
		    format: "yyyy",
		    viewMode: "years", 
    		minViewMode: "years",
    		autoclose: true
		}).on("hide", function(e) {
			const date = e.date;
			$("#month").val(`${date.getFullYear()}-${date.getFullYear() + 1}`)
		});
		
		$("#bu").on("change", function(e) {
			const val = e.target.value;
			$.ajax("./abp_form_selector", {
				method: "POST",
				data: { value: val, type: "business_unit" },
				success: function(res) {
					const allData = JSON.parse(res);
                                        const data = [...new Set(allData)];
					let html = `<option value='' selected disabled>Select Profit Center</option>`;
					for(let i = 0;i < data.length; i++) {
						html += `<option value='${data[i]}'>${data[i]}</option>`;
					}
					if(data.length == 0) {
						$("#clients").html(`<option value='' selected disabled>No Clients</option>`);
						$("#payercode").html(`<option value='' selected disabled>No Payer Code</option>`);
						html = `<option value='' disabled selected>No Profit Centers</option>`
					} else {
						$("#clients").html(`<option value='' selected disabled>Select clients</option>`);
						$("#payercode").html(`<option value='' selected disabled>Select Payer Code</option>`);
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
					$year =$_POST["month"];
					$month_names = [ "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec","Jan", "Feb", "Mar"];
					$year = (int)(explode('-', $year)[0]);
					$profit_center=$_POST['profit_center'];
					// $target_amount=$_POST['target_amount'];
					$client_name=explode('-', $_POST['clients'])[0];
					$payer_code=$_POST['payercode'];
					$date = date("Y/m/d H:i:s");
					$count = 0;
					for($i = 1; $i <= 12; $i++)
					{
						$verify = true;
						$month = $month_names[$i - 1].'-'.$year;
						$month = date('M-Y', strtotime($month));
						if($i == 10)
						{
							$year+=1;
						}
						$check = pg_query($conn, "SELECT * FROM abp");
						while($row = pg_fetch_assoc($check))
						{
							if($row['month'] == $month  && $row['client_name'] == $client_name)
							{
								$verify = false;
							}
						}
						if($verify)
						{
							$target_amount = $_POST[$month_names[$i - 1]];
							$query = "INSERT INTO abp(month, bu, profit_center, client_name, payer_code, target_amount, created_date)VALUES('$month','$bu','$profit_center','$client_name','$payer_code','$target_amount','$date')";
							$result=pg_query($conn,$query);
							if ($result) {
							// echo "<script>$('#msgshowsuccess').show();</script>";
								// echo '<meta http-equiv="Refresh" content="3;url=abp_form">';
								$count+=1;
							}
							else{
								// echo "<script>$('#msgshowerror').show();</script>";
							}
						}
						else
						{
							// echo "<script>$('#msgshowduplicate').show();</script>";
						}
					}
					if ($count != 0) {
						// $total_submited = 12 - $error_count; 
						echo "<script>$('#msgshowsuccess').show();</script>";
						echo "<script>$('#successfull-msg').html('<strong>Successfull!</strong> $count Anual Business Plan Targets have been regestered.');</script>";
						
						echo '<meta http-equiv="Refresh" content="3;url=abp_form">';
					}
					else{
						
						echo "<script>$('#msgshowerror').show();</script>";
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

<?php
	include "./components/footer.php"
?>
