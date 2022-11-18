<?php
include "./database/sql.php";
include "./components/side-bar.php";
include "./components/top-bar.php";
date_default_timezone_set('Asia/Kolkata');

$conn = OpenCon();
$abp_percentage = pg_query($conn,"SELECT * FROM abp order by id");
$arr_abp = [];
if (pg_num_rows($abp_percentage)>0) 
{
	$arr_abp = pg_fetch_all($abp_percentage);
}
$type=$_COOKIE['type'];
if($type != 'ADMIN'){
	echo "<script>window.location.href = './dashboard.php'</script>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>ABP Target</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- CSS -->
	<link rel="stylesheet" href="./css/index.css">
	<link rel="stylesheet" href="./css/sap-dump.css">

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
	<script src="https://sdk.amazonaws.com/js/aws-sdk-2.1.24.min.js"></script>
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
		<script>
	function deleteVOAR(id) {
		window.location = `./deletevoar.php?id=${id}`
	}
	$(document).ready(function() {
			$('#VOARTable').DataTable({
				"order": [[ 0, "asc" ]],
				"pageLength": 50
				// ,
				// initComplete: function () 
				// {
				// 	this.api().columns([1]).every( function () {
				// 	var column = this;
				// 	 $(column.header() ).on('click', function() {
				// 	 	select.css("display", "block")
				// 	 });
				// 	var select = $('<select style="display:none; margin-top: 10px;"></select>')
				// 	.appendTo( $(column.header() ))
				// 	.on( 'change', function () {
				// 		var val = $.fn.dataTable.util.escapeRegex(
				// 			$(this).val()
				// 		);

				// 		column
				// 		.search( val ? '^'+val+'$' : '', true, false )
				// 		.draw();
				// 		if(val == '')
				// 		select.css("display", "none");
				// 	} );
				// 	select.append( '<option value="">None</option>' )
				// 	column.data().unique().sort().each( function ( d, j ) 
				// 	{
				// 		select.append( '<option value="'+d+'">'+d+'</option>' )
				// 	} );
				// 	 $(column.header()).append('<i class="fas fa-filter" style="font-size: 9px; margin-left: 5px;" />')
				// 	} );
				// }
			});
		});
	</script>
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
			<div class="padded">
				<div class=" graph-card mx-2 mt-4 p-4">
					<div class="d-flex justify-content-between header-wrapper">
					    <div class="card-title">Annual Business Plan Target</div>
					    	<div class="d-flex justify-content-center">
					    	     <a href="abp_form.php"><button class="btn btn-primary user-btn ml-2">Add Target</button></a>
					    	     <!--<a href="abp_import.php"><button class="btn btn-primary user-btn ml-2">Import File</button></a>-->
								<form method="post" action="abp.php" enctype="multipart/form-data">
									<input type="file" hidden name="doc" id="doc" />
									<input type="button" id="download-users" data-toggle="modal" data-target="#exampleModalCenter" value="Import File" class="btn btn-primary user-btn ml-2" onclick="openFile()" />
									<input type="submit"  name="importabp" id="abpfileUploadFormButton" hidden />
								</form>
					    	     <form method="post" action="exportabp.php">
									<input type="submit" id="add-users" name="exportabp" class="btn btn-primary user-btn ml-2" value="Download ABP format 🠗" />
								</form>
						    </div>
						</div>
				        <table id="VOARTable">
							<thead class="mt-2">
								<th>ID</th>
								<th>Month</th>
								<th>Business Unit</th>
								<th>Profit Center</th>
								<th>Payer Code</th>
								<th>Client Name</th>
								<th>Target Amount</th>
								<th>Created Date</th>
								<th>Last Updated</th>
								<th>Actions</th>
							</thead>
							<tbody>
								<?php 
									if(!empty($arr_abp )) 
									{ 
										foreach($arr_abp  as $abp) 
										{ 
								?>
											<tr style="background-color: rgb(194, 221, 230,0.2)">
												<td><?= $abp["id"]; ?></td>
												<td><?= $abp["month"]; ?></td>
												<td><?= $abp["bu"]; ?></td>
												<td><?= $abp['profit_center']; ?></td>
												<td><?= $abp['payer_code']; ?></td>
												<td><?= $abp['client_name']; ?></td>
												<td><?= $abp['target_amount']; ?></td>
												<td><?= $abp['created_date']; ?></td>
												<td><?= $abp['last_updated']; ?></td>
												<td>
													<button type="button" class="btn btn-primary edit-btn" onclick="window.location ='./edit_abp.php?id=<?php echo $abp['id'] ?>';">
														<i class="far fa-edit"></i>
													</button>
												</td>
											</tr>                      
										<!--</div>-->
									<?php
									} 
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php foreach($arr_abp  as $abp) { ?>
			<div class="modal" style="background-color: rgba(0,0,0,0.5);" id="VOAR-delete-modal-<?php echo $abp['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="VOAR-delete-modal-title-<?php echo $abp['id'] ?>" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="VOAR-delete-modal-title-<?php echo $abp['id'] ?>">Delete VOAR Percentage of ID - <?php echo $abp["id"]; ?></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#VOAR-delete-modal-<?php echo $abp['id'] ?>').hide();">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" onclick="deleteVOAR(<?php echo $abp['id'] ?>)">Delete</button>
							<button type="button" class="btn btn-primary" onclick="$('#VOAR-delete-modal-<?php echo $abp['id'] ?>').hide();">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	<!-- script -->
	<script type="text/javascript">
		function openFile() {
			$("#doc").click();
			$("#doc").on("change", function() {
				$("#abpfileUploadFormButton").click();
			})
		}
	</script>
<?php
// error_reporting(0);
if(isset($_POST['importabp'])){
	require_once("./importabp.php");
}
?>

</body>
</html>