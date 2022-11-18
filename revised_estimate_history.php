<?php
include "./database/sql.php";
include "./components/side-bar.php";
include "./components/top-bar.php";

// fetching data from user table
$conn = OpenCon();
$result = pg_query($conn, "SELECT * FROM revised_history ORDER BY id ASC");
$arr_users = [];
if (pg_num_rows($result) > 0) {
	$arr_users = pg_fetch_all($result);
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
	<link rel="stylesheet" href="./css/revised_history.css">

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
	<script src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/antd/4.15.2/antd.min.js"></script>
    <script src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/antd/4.15.2/antd.min.css" />
</head>
<body>
	<div class="container-main">
		<?php 
		$type = strtoupper($_COOKIE["type"]);
		if ("ADMIN" == $type) 
		TopBar('collections'); 
		else
		nTopBar('home');
		?>
		<div class="content">
			<!-- User's Section -->
			<div class="padded">
				<div class="graph-card mx-2 mt-4 p-4">
					<div class="d-flex justify-content-between header-wrapper">
						<div class="card-title">Revised Estimate History</div>
					</div>
					
					<div class="table-responsive">
						<table id="userTable" class="">
							<thead class="mt-2">
								<th>Collection ID</th>
								<th>Modified By</th>
								<th>Modified Date</th>
								<th>Previous Value</th>
								<th>Current Value</th>
								<!--<th>User Type</th>-->
								<!--<th>Account Type</th>-->
								<th>Actions</th>
							</thead>
							<tbody>
								<?php if(!empty($arr_users )) { ?>
									<?php foreach($arr_users  as $user) { ?>
										<tr>
										    <td><?php echo $user["meta_id"]?></td>
											<td><?php echo $user["modified_by"]?></td>
											<td><?php echo $user["modified_date"]; ?></td>
											<td><?php echo $user['previous_value']; ?></td>
											<td><?php echo $user['current_value']; ?></td>
											<td>
												<button type="button" class="btn btn-danger delete-btn" onclick="$('#user-delete-modal-<?php echo $user['id'] ?>').show();">
													Delete
												</button></td>
											</tr>
										<?php } ?>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
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
		
		<script>
			$(document).ready(function() {
				$('#userTable').DataTable( {
					"pageLength": 50,
					"order": [[ 2, "desc" ]]
				} )
			} );
			(function() {
	$("span.fa").on("click", function() {
		var $span = $(this),
			$parentTr = $span.closest("tr");

		//remove
		if ($span.hasClass("fa-rotate-90")) {
			$span.removeClass("fa-rotate-90");
			$parentTr
				
				.next()
				.children("td")
				.animate({ padding: 0 })
				.wrapInner("<div />")
				.children()
				.slideUp(function() {
					var $tr = $(this).closest("tr");

					// $tr
					// 	.prev("tr")
					// 	.find(".active")
					// 	.removeClass("active");
					$tr.remove();
				$parentTr.removeClass("tr-selected");
				});

			return;
		}

		//add
		$span.addClass("fa-rotate-90");
		if ($parentTr.next().hasClass("tr-detail")) return;
		$parentTr.addClass("tr-selected");
		// 	.eq(1)
		// 	.addClass("active");
		$("#tr-detail")
			.clone()
			.removeClass("hidden")
			.insertAfter($parentTr)
			.children("td")
			.animate()
			.wrapInner("<div style='display:none'/>")
			.children()
			.slideDown();
	});
	
// 	$("i.fa").on("click", function() {
// 		$(this).closest("tr").next().removeClass("hidden").find("div.collapse").collapse("toggle");
// 	});
	
// 	$("div.collapse").on("hidden.bs.collapse", function(){
// 		$(this).closest("tr").children("td").css("padding","0")
// 								$(this).closest("tr").addClass("hidden")
// 								});
})();

		</script>
	</body>
	</html>
