<?php
include "./database/sql.php";
include "./components/side-bar.php";
include "./components/top-bar.php";
$conn = OpenCon();
date_default_timezone_set('Asia/Kolkata');
$frezze = pg_query($conn,"SELECT * FROM revenue_freeze_history order by id");
$arr_frezze = [];
if (pg_num_rows($frezze)>0) 
{
	$arr_frezze = pg_fetch_all($frezze);
}
$type=$_COOKIE['type'];
$email=$_COOKIE['email'];
$user_query = pg_query($conn, "SELECT * FROM user_account where email='$email' LIMIT 1");
$user_id = pg_fetch_all($user_query)[0]['id'];

$isfreezed_query = pg_query($conn, "SELECT * FROM revenue_freeze LIMIT 1");
$freeze_data = pg_fetch_all($isfreezed_query)[0];
if($freeze_data["freeze_by"]) {
	$freeze_by = strtotime(date($freeze_data["freeze_by"]));
	$isfreezed = strtotime("now") > $freeze_by;
	$date =	strtotime($freeze_data["freeze_by"]);
	$freeze_date = date("Y-m-d", $date);
} else {
	$freeze_date = "";
}
$freeze_check = $freeze_data['freeze_or_not'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Revenue Review</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- CSS -->
	<link rel="stylesheet" href="./css/index.css">
	<link rel="stylesheet" href="./css/add-user.css">
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
</head>
<body>
	<div class="container-main">
		<?php 
			$type = strtoupper($_COOKIE["type"]);
			if ("ADMIN" == $type) 
			TopBar('revenue'); 
			else
			nTopBar('revenue');
			echo "<script>console.log('$freeze_date')</script>";
		?>
		<div class="content">
			<!-- main container -->
			<div class="px-4">
				<div class="graph-card mx-2 mt-4 p-4">
					<center><div class="card-title">Revenue review</div></center>
					<div class="d-flex justify-content-between">
						<div><a href="revenue"><button style="background-color: transparent;outline: none;border: none;font-size: 25px;"><i class="fa fa-angle-left"></i></button></a></div>
					</div>
					<div class="px-2">
						<form method="post" name="myForm" id="myForm">
							<div class="form-group mb-3">
								<label for="modified_by">Modified By:</label>
								<input type="text" readonly value="<?php echo $user_id.' - '.$_COOKIE["username"]?>" id="modified_by" name="modified_by" class="form-control" required="">
							</div>
							<div class="form-group mb-3">
								<label for="Month">Month</label>
								<input type="text" id="Month" readonly value="<?php echo date('M/Y');?>" name="Month" class="form-control" required="">
							</div>
							<div class="form-group mb-3">
								<label for="freeze_by">Freeze By:</label>
								<input type="date" max="<?php echo date('Y-m-t');?>" min="<?php echo date('Y-m-d');?>" value="<?php echo $freeze_date ?>" id="freeze_by" name="freeze_by" class="form-control" required="">
								<div style="color: red" id="error"></div>
							</div>
							<div class="form-group mb-3">
								<label for='freeze_status'>Freeze Status:</label>
								<select class="form-select" id='freeze_status' name="freeze_status" required=''>
										<?php
$test = "";
									if(!empty($freeze_check)){$test = "checkin";
										if($freeze_check == "yes")
										{?>
										<option value="yes" selected>Yes</option>
										<option value="no">No</option>
									<?php } else{?>
										<option value="yes" >Yes</option>
										<option value="no" selected>No</option>
									<?php }}
									else{?>
									<option value="" selected disabled >Select Freeze Status</option>
										<option value="yes" >Yes</option>
										<option value="no">No</option>
									<?php
									}
									?>
								</select>
<?php //echo $test; ?>
							</div>
							<div class="d-flex justify-content-center">
								<input type="submit" class="btn btn-success ml-2" data-toggle="modal" name="user" id="submit" value="Confirm Freeze Date" />
								<a href='revenue'><div class='btn btn-danger delete-btn ml-4'>cancel</div></a>
							</div>
						</form>
						<div style='color:darkblue; width:100%; display:flex; justify-content:flex-end'>
							<button	style='color:darkblue; background-color:transparent; border:none; outline:none' id='show_hide_display' onclick='show_hide()'>Show freeze history ↓</button>
						</div>
					</div>
				</div>
				<div class=" graph-card mx-2 mt-4 p-4 d-none" id='check'>
					<div class="d-flex justify-content-between header-wrapper">
					    <div class="card-title">Freeze history</div>
					</div>
				       <table id="frezze-table">
						<thead class="mt-2">
							<th>ID</th>
							<th>Modified By</th>
							<th>Modified On</th>
							<th>Freeze date</th>
							<th>Freeze Status</th>
						</thead>
						<tbody>
							<?php 
							if(!empty($arr_frezze )) 
							{ 
								foreach($arr_frezze  as $frezze_data) 
								{ ?>
									<tr style="background-color: rgb(194, 221, 230,0.2)">
										<td><?= $frezze_data["id"]; ?></td>
										<td><?php echo $frezze_data["modified_by"]; ?></td>
										<td><?php echo $frezze_data["modified_on"]; ?></td>
										<td><?php echo $frezze_data['freeze_date_set']; ?></td>
										<td><?php echo $frezze_data['freeze_status']; ?></td>
									</tr>                      
						<?php 	} 
							} ?>
						</tbody>
					</table>
				</div>
			</div>
			<?php
	include "./components/footer.php"
?>
		</div>
	</div>
	<?php
	
	if (array_key_exists("user", $_POST)) 
	{ 
		$modified_by =$_POST["modified_by"];
		$Month =$_POST["Month"];
		$freeze_final_time = date("H:i", time());
		$freeze_by=$_POST['freeze_by']."T".$freeze_final_time;
		$freeze_status = $_POST['freeze_status'];
		$date = date("Y/m/d H:i:s");
		$query = "
		UPDATE revenue_freeze SET 
		modified_by='$modified_by',month='$Month',freeze_by='$freeze_by',freeze_or_not='$freeze_status',freeze_date='$date'
		WHERE id=1";
		$result=pg_query($conn,$query);
		$query_history = "
		INSERT INTO revenue_freeze_history (modified_by, modified_on, freeze_date_set, freeze_status)
		VALUES ('$modified_by','$date','$freeze_by','$freeze_status')";
		$resul_historyt=pg_query($conn,$query_history);
		// echo $query;
		if ($result) 
		{
     			echo '<script>alert("Freeze date updated successfull")</script>';
     			echo '<meta http-equiv="Refresh" content="0;url=revenue_review">';
		}
		else
		{
			echo '<script>alert("Freeze date updated unsuccessfull")</script>';
		}
	}
	else
	{
// 		echo '<script>alert("Freeze date updated successfull")</script>';
	}
?>
	<script>
		$(document).ready(function() {
			$('#frezze-table').DataTable({
				"order": [[ 0, "asc" ]],
				"pageLength": 10
			});
		});
	</script>
	<script type="text/javascript">
		function show_hide(){
			var check = document.getElementById('check');
			if($('#check').hasClass('d-none')){
				$('#check').removeClass('d-none');
				$('#show_hide_display').text('Hide freeze history ↑')
			}
			else{
				$('#check').addClass('d-none');
				$('#show_hide_display').text('Show freeze history ↓')
			}	
			
		}
	</script>
</body>
</html>
