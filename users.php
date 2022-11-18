<?php
include "./database/sql.php";
include "./components/side-bar.php";
include "./components/top-bar.php";

// fetching data from user table
$conn = OpenCon();
$result = pg_query($conn, "SELECT * FROM user_account ORDER BY id ASC");
$arr_users = [];
if (pg_num_rows($result) > 0) {
	$arr_users = pg_fetch_all($result);
}
$type=$_COOKIE['type'];
$result = pg_query($conn,"SELECT * FROM permission where account_type='$type'");
if (pg_num_rows($result)>0) 
{
	while ($row = pg_fetch_assoc($result)) 
	{
		$editpermission=$row['edit_check'] == '1';
		$deletepermission=$row['delete_check'] == '1';
		$importpermission=$row['import_check'] == '1';
		$exportpermission=$row['export_check'] == '1';
		$user_permission=$row['user_permission'];
	}
}
if($user_permission!=1){
	echo "<script>window.location.href = './summary'</script>";
}
$am=0;
$rm=0;
$bu=0;
$cu=0;
$sql = pg_query($conn,"SELECT * FROM user_account");
if (pg_num_rows($sql)>0) 
{
	while ($row = pg_fetch_assoc($sql)) 
	{
		if($row['desgnation']=='AM'){
			$am+=1;
			
		}
		if($row['desgnation']=='RM'){
			$rm+=1;
			
		}
		if($row['desgnation']=='BU'){
			$bu+=1;
			
		}
		if($row['desgnation']=='CU'){
			$cu+=1;
			
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
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
	<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.uikit.min.css"> -->
	<style type="text/css">
	    tr {
	        background-color: rgba(153, 144, 244, 0.3) !important;
	    }
	    tbody tr:nth-child(even) {
	        background-color: rgba(153, 144, 244, 0.2) !important;
	    }
	     tbody tr:nth-child(odd) {
	        background-color: rgba(153, 144, 244, 0.1) !important;
	    }
	</style>
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
			<!-- User's Section -->
			<div class="">
				<div class="graph-card mt-5 p-3">
					<div class="d-flex justify-content-around flex-wrap">
						<div class="d-flex justify-content-center align-items-center">
							<div class="stat-icon stat-blue mr-3">
								<i class="fas fa-user"></i>
								<h5 class='ml-2'>Users</h5>
							</div>
						</div>
						<div class="d-flex justify-content-center align-items-center">
							<div class="stat-icon stat-blue mr-3">
								<i class="fas fa-chart-line"></i>
							</div>
							<div>
								<div class="stat-name">Account Manager</div>
								<div class="stat-value d-flex "><?= $am?></div>
							</div>
						</div>
						<div class="d-flex justify-content-center align-items-center">
							<div class="stat-icon stat-blue mr-3">
								<i class="fas fa-chart-line"></i>
							</div>
							<div>
								<div class="stat-name">Regional Account Manager</div>
								<div class="stat-value d-flex "><?= $rm?></div>
							</div>
						</div>
						<div class="d-flex justify-content-center align-items-center">
							<div class="stat-icon stat-blue mr-3">
								<i class="fas fa-chart-line"></i>
							</div>
							<div>
								<div class="stat-name">Business User</div>
								<div class="stat-value d-flex "><?= $bu?></div>
							</div>
						</div>
						<div class="d-flex justify-content-center align-items-center">
							<div class="stat-icon stat-blue mr-3">
								<i class="fas fa-chart-line"></i>
							</div>
							<div>
								<div class="stat-name">Corporate User</div>
								<div class="stat-value d-flex "><?= $cu?></div>
							</div>
						</div>
					</div>
				</div>
				<div class="graph-card mt-2 p-4">
					<div class="d-flex justify-content-center header-wrapper">
						<!--<div class="card-title"><h2>User Details</h2></div>-->
						<div class="d-none copy-buttons">
							<form method="post" action="exportuser">
								<input type="submit" id="add-users" name="export" class="btn btn-primary user-btn ml-2 add-users" value="Download User Format" />
							</form>
							<form method="post" action="pdfuser">
								<input type="submit" id='download-users' name="export" class="btn btn-primary user-btn ml-2 download-users" value="Download User Data 🠗" />
							</form>
						</div>
					</div>
					<div class="table-responsive">
						<table id="userTable" class="">
							<thead class="mt-2">
								<th>ID</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email</th>
								<th>Mobile Number</th>
								<th>User Type</th>
								<th>Account Type</th>
								<th>Business Unit</th>
								<th>Actions</th>
							</thead>
							<tbody>
								<?php if(!empty($arr_users )) { ?>
									<?php foreach($arr_users  as $user) { ?>
										<tr>
											<td><?php echo $user["id"]?></td>
											<td><?php echo $user["fname"]?></td>
											<td><?php echo $user["lname"]; ?></td>
											<td><?php echo $user['email']; ?></td>
											<td><?php echo $user['mnumber']; ?></td>
											<td><?php echo $user['desgnation']; ?></td>
											<td><?php 
													if($user['desgnation'] == 'AM' || $user['desgnation'] == 'RM')
													{
														$str = [];
														$arr = explode(", ", $user['accounttype']);
														for($i = 0; $i < count($arr); $i++) {
															$pos= substr($arr[$i], strpos($arr[$i],'-')+1, strlen($arr[$i]));
															array_push($str, $pos);
														}
														echo join(", ", $str); 
													}
													else{
														echo "<center>-</center>";
													}
												?>
											</td>
											<td><?php 
													if($user['desgnation'] == 'BU')
													{
														echo $user['bu'];
													}
													else{
														echo "<center>-</center>";
													}
												?>
											</td>
											<td>
											<button type="button" class="btn btn-primary edit-btn" onclick="window.location ='./edit-user?id=<?php echo $user['id'] ?>';">
													<i class="far fa-edit"></i>
												</button>
												<?php 
												if($_COOKIE['email'] != $user['email'])
												{?>
													<button type="button" class="btn btn-danger delete-btn" onclick="$('#user-delete-modal-<?php echo $user['id'] ?>').show();">
														<i class="far fa-trash-alt"></i>
													</button>
												<?php
												}?>
																	
											</td>
											</tr>
										<?php } ?>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<?php
	include "./components/footer.php"
?>
			</div>
		</div>
		<?php foreach($arr_users  as $user) { ?>
			<div class="modal" style="background-color: rgba(0,0,0,0.5);" id="user-delete-modal-<?php echo $user['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="user-delete-modal-title-<?php echo $user['id'] ?>" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="user-delete-modal-title-<?php echo $user['id'] ?>">Delete user <?php echo $user["fname"]." ".$user["lname"]; ?></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#user-delete-modal-<?php echo $user['id'] ?>').hide();">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" onclick="deleteUser(<?php echo $user['id'] ?>)">Delete</button>
							<button type="button" class="btn btn-primary" onclick="$('#user-delete-modal-<?php echo $user['id'] ?>').hide();">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		
		<script type="text/javascript">
			function deleteUser(id) {
				window.location = `./deleteUser?id=${id}`
			}
		</script>
		<script>
			$(document).ready(function() {
				$('#userTable').DataTable( {
					"pageLength": 50
				});
				$('#userTable_filter').prepend('<div class="d-inline-flex justify-content-center mr-2">' + $(".copy-buttons").html() + '</div>');
			} );

		</script>
		<?php
			if(!$exportpermission) {
				echo "<script>$('.add-users').prop('disabled', true);</script>";
				echo "<script>$('.add-users').parent().css('cursor', 'no-drop');</script>";
				echo "<script>$('.add-users').parent().on('click', function() {alert('No permission')});</script>";
			}
			if(!$exportpermission) {
				echo "<script>$('.download-users').prop('disabled', true);</script>";
				echo "<script>$('.download-users').parent().css('cursor', 'no-drop');</script>";
				echo "<script>$('.download-users').parent().on('click', function() {alert('No permission')});</script>";
			}
			if(!$editpermission) {
				echo "<script>$('.edit-btn').prop('disabled', true);</script>";
				echo "<script>$('.edit-btn').parent().css('cursor', 'no-drop');</script>";
				echo "<script>$('.edit-btn').parent().on('click', function() {alert('No permission')});</script>";
			}
			if(!$deletepermission) {
				echo "<script>$('.delete-btn').prop('disabled', true);</script>";
				echo "<script>$('.delete-btn').parent().css('cursor', 'no-drop');</script>";
				echo "<script>$('.delete-btn').parent().on('click', function() {alert('No permission')});</script>";
			}
		?>
	</body>
	</html>
