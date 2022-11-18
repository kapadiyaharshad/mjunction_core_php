<?php
include "./database/sql.php";
include "./components/side-bar.php";
include "./components/top-bar.php";

// fetching data from clients table
$conn = OpenCon();
$arr_client = [];
$client;
$type = $_COOKIE['type'];
$result = pg_query($conn, "SELECT * FROM permission where account_type='$type'");
if (pg_num_rows($result) > 0) {
	while ($row = pg_fetch_assoc($result)) {
		$editpermission = $row['edit_check'] == '1';
		$deletepermission = $row['delete_check'] == '1';
		$importpermission = $row['import_check'] == '1';
		$exportpermission = $row['export_check'] == '1';
		$client_permission = $row['client_permission'];
	}
}
// if ($client_permission != 1) {
// 	echo "<script>window.location.href = './summary'</script>";
// }
?>

<!DOCTYPE html>
<html lang=“en”>

<head>
	<title>Clients</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- CSS -->
	<link rel="stylesheet" href="./css/index.css">
	<link rel="stylesheet" href="./css/clients.css">

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
			TopBar('clients');
		else
			nTopBar('clients'); ?>
		<div class="content">
			<div class="">
				<div class="table-responsive graph-card mx-2 mt-4 p-4">
					<div class="d-flex justify-content-center header-wrapper">
						<div class="card-title">
							<h2 class="text-center">Client Details</h2>
						</div>
						<div class="d-none copy-buttons">
							<form method="post" action="exportclient">
								<input type="submit" id="add-clients" name="export" class="btn btn-primary user-btn ml-2 add-clients" value="Download Client Format" />
							</form>
							<form method="post" action="pdfclient">
								<input type="submit" id='download-clients' name="export" class="btn btn-primary user-btn ml-2 download-clients" value="Download Client Data 🠗" />
							</form>
						</div>
					</div>				
					<div style="float: right;margin-bottom: 1%;">
						<input type="text" id="mySearchText" style="height:37px" placeholder="Type here...">
						<button onclick="clientsearch()" id="mySearchButton" class="btn btn-primary"> <i class="fa fa-search-plus" aria-hidden="true"></i></button>
					</div>
					<table id="clientTable" class="table" style="width:100%">
						<thead>
							<tr>
								<th>ID</th>
								<th>Client Name</th>
								<th>Payer Code</th>
								<th>Account Type</th>
								<th>Business Segment</th>
								<th>Business Unit</th>
								<th>Services</th>
								<th>Category</th>
								<th>Profit Center</th>
								<th>Actions</th>
							</tr>
						</thead>
					</table>				
				</div>
				<?php
				include "./components/footer.php"
				?>
			</div>
		</div>
	
		<div class="modal" style="background-color: rgba(0,0,0,0.5);" id="client-delete-modal" tabindex="-1" role="dialog" aria-labelledby="client-delete-modal-title" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="client-delete-modal-title">Delete client</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#client-delete-modal').hide();">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" id="client-del" onclick="deleteClient()">Delete</button>
						<button type="button" class="btn btn-primary" onclick="$('#client-delete-modal').hide();">Cancel</button>
					</div>
				</div>
			</div>
		</div>
		<!-- script -->
		
		<script type="text/javascript">
			function deleteClient() {
				const id = $('#client-del').attr('data-id');
				window.location = `./deleteClient?id=${id}`
			}

			function editclient(id) {
				window.location = './edit-client?id=' + id;
			}

			function showmodaldel(id) {
				$('#client-delete-modal').show();
				$('#client-del').attr('data-id', id);
			}

			function clientsearch() {

				const search_val = $('#mySearchText').val();
				if (search_val.length > 0) {

					const JSONobj = {
						draw: 1,
						search_val: search_val,
						length: 10
					}
					const table = $('#clientTable').DataTable();
					table.destroy();
					$('#clientTable').empty();					
					$('#clientTable').DataTable({				

						'searching': false,						
						'pageLength': 10,
						'processing': true,
						'serverSide': true,
						'sort': false,
						'bLengthChange': false,						
						'ajax': {
							'url': 'client_processing.php',
							"data": function(d) {						
								// d.search.valueh = search_val; old code
								d.search.value = search_val;
								return $.extend({}, d, {
									"search_val": search_val
								});
							}
						},
						columns: [{
								title: 'ID',
								visible: false
							},
							{
								title: 'Client Name'
							},
							{
								title: 'Payer Code'
							},
							{
								title: 'Account Type'
							},
							{
								title: 'Business Segment'
							},
							{
								title: 'Business Unit'
							},
							{
								title: 'Services'
							},
							{
								title: 'Category'
							},
							{
								title: 'Profit Center'
							},
							{
								title: 'Actions',
								"data": null,								
								"render": function(data, type, row, meta) {

									return '<button type="button" class="btn btn-primary edit-btn" onclick="editclient(' + data[0] + ')"><i class="far fa-edit"></i></button><button type="button" class="btn btn-danger delete-btn" onclick="showmodaldel(' + data[0] + ')"><i class="far fa-trash-alt"></i></button>';
								}
							}
						]

					})

				} else {
					const table = $('#clientTable').DataTable();
					table.destroy();
					$('#clientTable').empty();					
					initialDataTableInit();
				}
			}

			function initialDataTableInit() {
				$('#clientTable').DataTable({
					"fnDrawCallback": function(oSettings) {
						console.log(this.api().page.info())
					},

					'searching': false,
					"drawCallback": function(settings) {
						console.log('DataTables has redrawn the table', settings);
					},
					'pageLength': 10,
					'processing': true,
					'serverSide': true,
					'bLengthChange': false,
					'sort': false,
					'serverMethod': 'post',
					'ajax': {
						'url': 'client_processing.php'
					},

					columns: [{
							title: 'ID',
							visible: false
						},
						{
							title: 'Client Name'
						},
						{
							title: 'Payer Code'
						},
						{
							title: 'Account Type'
						},
						{
							title: 'Business Segment'
						},
						{
							title: 'Business Unit'
						},
						{
							title: 'Services'
						},
						{
							title: 'Category'
						},
						{
							title: 'Profit Center'
						},
						{
							title: 'Actions',
							"data": null,
							"render": function(data, type, row, meta) {

								return '<button type="button" class="btn btn-primary edit-btn" onclick="editclient(' + data[0] + ')"><i class="far fa-edit"></i></button><button type="button" class="btn btn-danger delete-btn" onclick="showmodaldel(' + data[0] + ')"><i class="far fa-trash-alt"></i></button>';
							}
						}
					]

				})
			}


			$(document).ready(function() {
				initialDataTableInit();

			});
			setTimeout(function() {
				console.log($('#clientTable_filter'));
				$('#clientTable_filter').prepend('<div class="d-inline-flex justify-content-center mr-2">' + $(".copy-buttons").html() + '</div>');
			}, 100);
		</script>
		
		<?php
		if (!$exportpermission) {
			echo "<script>$('.add-clients').prop('disabled', true);</script>";
			echo "<script>$('.add-clients').parent().css('cursor', 'no-drop');</script>";
			echo "<script>$('.add-clients').parent().on('click', function() {alert('No permission')});</script>";
		}
		if (!$exportpermission) {
			echo "<script>$('.download-clients').prop('disabled', true);</script>";
			echo "<script>$('.download-clients').parent().css('cursor', 'no-drop');</script>";
			echo "<script>$('.download-clients').parent().on('click', function() {alert('No permission')});</script>";
		}
		if (!$editpermission) {
			echo "<script>$('.edit-btn').parent().css('cursor', 'no-drop');</script>";
			echo "<script>$('.edit-btn').parent().on('click', function() {alert('No permission')});</script>";
		}
		if (!$deletepermission) {
			echo "<script>$('.delete-btn').prop('disabled', true);</script>";
			echo "<script>$('.delete-btn').parent().css('cursor', 'no-drop');</script>";
			echo "<script>$('.delete-btn').parent().on('click', function() {alert('No permission')});</script>";
		}
		?>
</body>

</html>