<?php
include "./database/sql.php";
include "./components/side-bar.php";
include "./components/top-bar.php";
date_default_timezone_set('Asia/Kolkata');

$conn = OpenCon();
$voar_percentage = pg_query($conn,"SELECT * FROM voar_percentage order by id");
$arr_voar = [];
if (pg_num_rows($voar_percentage)>0) 
{
	$arr_voar = pg_fetch_all($voar_percentage);
}
$type=$_COOKIE['type'];
if($type != 'ADMIN'){
	echo "<script>window.location.href = './summary'</script>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>VOAR Percentage</title>
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
				window.location = `./deletevoar?id=${id}`
			}
			$(document).ready(function() {
			$('#VOARTable').DataTable({
				"order": [[ 0, "asc" ]],
				"pageLength": 50
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
					<div class="d-flex justify-content-center header-wrapper">
					    <div class="card-title" style='font-size:23px'>VOAR Percentage</div>
						</div>
					    	<div class="d-none copy-buttons">
					    	     <a href="voar_form"><button class="btn btn-primary user-btn ml-2">Add VOAR Percentage</button></a>
						    </div>
				        <table id="VOARTable">
							<thead class="mt-2">
								<th>ID</th>
								<th>Business Unit</th>
								<th>Services</th>
								<th>percentage</th>
								<th>Actions</th>
							</thead>
							<tbody>
								<?php 
								if(!empty($arr_voar )) 
								{ 
									foreach($arr_voar  as $voar) 
									{ ?>
										<tr style="background-color: rgb(194, 221, 230,0.2)">
											<td><?= $voar["id"]; ?></td>
											<td><?php echo $voar["bu"]; ?></td>
											<td><?php echo $voar["services"]; ?></td>
											<td class="text-right"><?php echo $voar['percentage']; ?></td>
											<td>
												<button type="button" class="btn btn-primary edit-btn" onclick="window.location ='./edit_voar?id=<?php echo $voar['id'] ?>';">
													<i class="far fa-edit"></i>
												</button>
												<button type="button" class="btn btn-danger delete-btn" onclick="$('#VOAR-delete-modal-<?php echo $voar['id'] ?>').show();">
													<i class="far fa-trash-alt"></i>
												</button>
											</td>
										</tr>                      
							<?php 	} 
								} ?>
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
	<script>
		setTimeout(function() {
			$('#VOARTable_filter').prepend('<div class="d-inline-flex justify-content-center mr-2">' + $(".copy-buttons").html() + '</div>');
		}, 100);
	</script>
	<?php foreach($arr_voar  as $voar) 
	{ ?>
		<div class="modal" style="background-color: rgba(0,0,0,0.5);" id="VOAR-delete-modal-<?php echo $voar['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="VOAR-delete-modal-title-<?php echo $voar['id'] ?>" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="VOAR-delete-modal-title-<?php echo $voar['id'] ?>">Delete VOAR Percentage of ID - <?php echo $voar["id"]; ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#VOAR-delete-modal-<?php echo $voar['id'] ?>').hide();">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" onclick="deleteVOAR(<?php echo $voar['id'] ?>)">Delete</button>
						<button type="button" class="btn btn-primary" onclick="$('#VOAR-delete-modal-<?php echo $voar['id'] ?>').hide();">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	<?php 
	} 
		// error_reporting(0);
		if(isset($_POST['importsapcollection'])){
			require_once("./importsapcollection.php");
		}
		if(isset($_POST['importsaprevenue'])){
			require_once("./importsaprevenue.php");
		}
	?>

</body>
</html>
