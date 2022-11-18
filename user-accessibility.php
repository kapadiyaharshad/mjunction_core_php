<?php
include "./database/sql.php";
include "./components/side-bar.php";
include "./components/top-bar.php";

// fetching data from user table
if($_COOKIE['type']!='ADMIN'){
	echo "<script>window.location.href = './summary'</script>";
}
$conn = OpenCon();
$result = pg_query($conn, "SELECT * FROM permission  ORDER BY id ASC");
$arr_users = [];
if (pg_num_rows($result) > 0) {
	$arr_users = pg_fetch_all($result);
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
	<title>Users Permission</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- CSS -->
	<link rel="stylesheet" href="./css/index.css">
	<link rel="stylesheet" href="./css/users-accessibility.css">

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
<script type="text/javascript">
		var AllUpdatedRows= {};
	</script>
<style type="text/css">
		.tableinput{
			border:none;
			outline: none;
			height: 100%;
			width: 50%;
			/*background-color: #f7f7f7;*/
		}
		.editInputFeild{
			width: 10%;
			
			/*background-color: #f7f7f7;*/
		}
		td{
			align-items: center;
		}
	</style>
</head>
<body>
	<div class="container-main">
		<!-- <?php 
		// SideBar('user'); 
		?> -->
		<?php TopBar('user'); ?>
		<div class="content">
			<!-- User's Section -->
			<div class="">
				<div style='background:white' class=" mx-2 mt-5 p-3">
					<div class="d-flex justify-content-around flex-wrap">
						<div class="d-flex justify-content-center align-items-center">
							<div class="stat-icon stat-blue">
								<h5 class='ml-2' style='color:#7569F0'> <i class="fas fa-user"></i>  Users Accessibility</h5>
							</div>
						</div>
						<div class="d-flex justify-content-center align-items-center stat-item">
							<div class="stat-icon stat-blue mr-3">
								<i class="fas fa-chart-line"></i>
							</div>
							<div>
								<div class="stat-name">Account Manager</div>
								<div class="stat-value"><?= $am?></div>
							</div>
						</div>
						<div class="d-flex justify-content-center align-items-center stat-item">
							<div class="stat-icon stat-blue mr-3">
								<i class="fas fa-chart-line"></i>
							</div>
							<div>
								<div class="stat-name">Regional Account Manager</div>
								<div class="stat-value"><?= $rm?></div>
							</div>
						</div>
						<div class="d-flex justify-content-center align-items-center stat-item">
							<div class="stat-icon stat-blue mr-3">
								<i class="fas fa-chart-line"></i>
							</div>
							<div>
								<div class="stat-name">Business User</div>
								<div class="stat-value"><?= $bu?></div>
							</div>
						</div>
						<div class="d-flex justify-content-center align-items-center stat-item">
							<div class="stat-icon stat-blue mr-3">
								<i class="fas fa-chart-line"></i>
							</div>
							<div>
								<div class="stat-name">Corporate User</div>
								<div class="stat-value"><?= $cu?></div>
							</div>
						</div>
					</div>
				</div>
				<div class="graph-card mx-2 mt-2 p-4">
					<div class="d-flex justify-content-between header-wrapper">
						<div class="d-flex justify-content-center">
						<!--<div class="card-title">User Accessibility</div>-->
						</div>
					</div>
					<div class="table-responsive">
						<table id="permissionTable" class="">
							<thead class="mt-2">
								<th>S.No.</th>
								<th>Account Type</th>
								<th>User Perrmission</th>
								<th>Client Perrmission</th>
								<th>Collection Perrmission</th>
								<th>Revenue Perrmission</th>
								<th>SAP dump Perrmission</th>
								<th>Basic Perrmissions</th>
							</thead>
							<tbody>
								<?php if(!empty($arr_users )) { ?>
									<?php foreach($arr_users  as $user) { ?>
										<tr>
											<td><?php echo $user["id"]?></td>
											<td><b><?php echo $user["full_name"]."  (".$user['account_type'].")";?></b></td>
											<td class="editInputFeild">
												<button 
													class="permission_button" 
													style="width:40px;height:40px;outline:none;border-radius:40px;border:none;background-color:<?php echo $user['user_permission'] == 1 ? 'lightgreen' : 'red';?>" 
													data-id="<?php echo $user['id'];?>" 
													data-permission="<?php echo $user['user_permission'];?>" 
													data-name="user_permission"
												>
													<i class="far fa-user" style="color:white"></i>
												</button>
											</td>
											<td class="editInputFeild">
												<button 
													class="permission_button" 
													style="width:40px;height:40px;outline:none;border-radius:40px;border:none;background-color:<?php echo $user['client_permission'] == 1 ? 'lightgreen' : 'red';?>" 
													data-id="<?php echo $user['id'];?>" 
													data-permission="<?php echo $user['client_permission'];?>" 
													data-name="client_permission"
												>
													<i class="far fa-user" style="color:white"></i>
												</button>
											</td>
											<td class="editInputFeild">
												<button 
													class="permission_button" 
													style="width:40px;height:40px;outline:none;border-radius:40px;border:none;background-color:<?php echo $user['collection_permission'] == 1 ? 'lightgreen' : 'red';?>" 
													data-id="<?php echo $user['id'];?>" 
													data-permission="<?php echo $user['collection_permission'];?>" 
													data-name="collection_permission"
												>
													<i class="far fa-user" style="color:white"></i>
												</button>
											</td>
											<td class="editInputFeild">
												<button 
													class="permission_button" 
													style="width:40px;height:40px;outline:none;border-radius:40px;border:none;background-color:<?php echo $user['revenue_permission'] == 1 ? 'lightgreen' : 'red';?>" 
													data-id="<?php echo $user['id'];?>" 
													data-permission="<?php echo $user['revenue_permission'];?>" 
													data-name="revenue_permission"
												>
													<i class="far fa-user" style="color:white"></i>
												</button>
											</td>
											<td class="editInputFeild">
												<button 
													class="permission_button" 
													style="width:40px;height:40px;outline:none;border-radius:40px;border:none;background-color:<?php echo $user['sap_permission'] == 1 ? 'lightgreen' : 'red';?>" 
													data-id="<?php echo $user['id'];?>" 
													data-permission="<?php echo $user['sap_permission'];?>" 
													data-name="sap_permission"
												>
													<i class="far fa-user" style="color:white"></i>
												</button>
											</td>
											<td>
												<div class="new">
													<div class="check_box" id="view-wrapper">
												      <input 
												      class="permission_check" 
												      type="checkbox" 
												      <?php if($user['account_type']=='ADMIN') echo 'disabled';?> 
												      data-id="<?php echo $user['id'];?>"
												      data-permission="<?php echo $user['view_check'];?>"
												      data-name="view_check"
												      id="view_check"
												      >
												      <label for="view_check">View</label>
												    </div>
												    <div id="edit-wrapper">
												      <input 
												    	class="permission_check" 
												    	type="checkbox"
												    	data-id="<?php echo $user['id'];?>"
												    	data-permission="<?php echo $user['edit_check'];?>"
												    	data-name="edit_check"
												    	id="edit_check"
												      >
												      <label for="edit_check">Edit</label>
												      </div>
												    <div id="delete-wrapper">
												       <input 
												    	class="permission_check" 
												    	type="checkbox"
												    	data-id="<?php echo $user['id'];?>"
												    	data-permission="<?php echo $user['delete_check'];?>"
												    	data-name="delete_check"
												    	id="delete_check"
												      >
												      <label for="delete_check">Delete</label>
												      </div>
												    <div id="import-wrapper">
												      <input 
												    	class="permission_check" 
												    	type="checkbox"
												    	data-id="<?php echo $user['id'];?>"
												    	data-permission="<?php echo $user['import_check'];?>"
												    	data-name="import_check"
												    	id="import_check"
												      >
												      <label for="import_check">Import</label>
												      </div>
												    <div id="export-wrapper">
												       <input 
												    	class="permission_check" 
												    	type="checkbox"
												    	data-id="<?php echo $user['id'];?>"
												    	data-permission="<?php echo $user['export_check'];?>"
												    	data-name="export_check"
												    	id="export_check"
												      >
												      <label for="export_check">Export</label>
												    </div>
												</div>
											</td>
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
			<div class="modal" style="background-color: rgba(0,0,0,0.5);" id="permission-modal" tabindex="-1" role="dialog" aria-labelledby="user-delete-modal-title-<?php echo $user['id'] ?>" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="permission-modal-title"></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#permission-modal').hide();">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" onclick="$('#permission-modal').hide();">Ok</button>
						</div>
					</div>
				</div>
			</div>
		
		<script type="text/javascript">
			function deleteUser(id) {
				window.location = `./deleteUser?id=${id}`
			}
		</script>
		<script>
			$(document).ready(function() {
				$('#permissionTable').DataTable({
					"paging": false,
					"searching":false,
					"info":false
				});
			});
			$(".permission_check").each(function() {
				if($(this).data("permission") == 1) {
					$(this).prop("checked", true);
				} else {
					$(this).removeProp("checked");
				}
			});
			$(".permission_check").on('change', function(e) {
				const id = $(this).data("id");
				const value = e.target.checked ? 1 : 0;
				const name = $(this).data("name");
				let body = {};
				body[id] = {};
				body[id][name] = value;
				const that = this;
				$.ajax({
					type: "POST",
					url: './update-checks.php',
					data: {rows: body},
					success:function(html) {
						if(value == 1) {
							$(this).prop("checked", true);
						} else {
							$(this).removeProp("checked");
						}
						const temp = value==0 ? "Permission Removed" : "Permission Granted"
						$('#permission-modal').show();
						$('#permission-modal-title').text(temp)
					}
	
				});
			});
			$(".permission_button").on('click', function(e) {
				const id = $(this).data("id");
				const value = $(this).data("permission") == 1 ? 0 : 1;
				const name = $(this).data("name");
				let body = {};
				body[id] = {};
				body[id][name] = value;
				const that = this;
				$.ajax({
					type: "POST",
					url: './update-permissions.php',
					data: {rows: body},
					success:function(html) {
						$(that).data("permission", value);
						$(that).css("background-color", value==0 ? "red" : "lightgreen")
						const temp = value==0 ? "Permission Removed" : "Permission Granted"
						$('#permission-modal').show();
						$('#permission-modal-title').text(temp)
					}
	
				});
			});
		</script>
	</body>
	</html>
