<?php
include "./database/sql.php";
include "./components/side-bar.php";
include "./components/top-bar.php";
date_default_timezone_set('Asia/Kolkata');

$conn = OpenCon();
$client = pg_query($conn,"SELECT * FROM import_record where show='yes' ORDER BY id ASC");
$arr_sap = [];
if (pg_num_rows($client)>0) 
{
	$arr_sap = pg_fetch_all($client);
}
$type=$_COOKIE['type'];
$result = pg_query($conn,"SELECT * FROM permission where account_type='$type'");
if (pg_num_rows($result)>0) 
{
	while ($row = pg_fetch_assoc($result)) 
	{
		$deletepermission=$row['delete_check'] == '1';
		$importpermission=$row['import_check'] == '1';
		$exportpermission=$row['export_check'] == '1';
		$sap_permission=$row['sap_permission'];
	}
}
if($sap_permission!=1){
	echo "<script>window.location.href = './summary'</script>";
}
$revenue=0;
$revenueTotal=0;
$collection=0;
$collectionTotal=0;
$sql = pg_query($conn,"SELECT * FROM import_record");
if (pg_num_rows($sql)>0) 
{
	while ($row = pg_fetch_assoc($sql)) 
	{
		if($row['type']=='revenue'){
			$revenue+=1;
			
		}
		if($row['type']=='collection'){
			$collection+=1;
			
		}
	}
}
$sql = pg_query($conn,"SELECT * FROM import_record");
if (pg_num_rows($sql)>0) 
{
	while ($row = pg_fetch_assoc($sql)) 
	{
		if($row['type']=='revenue'){
			$revenueTotal+= $row['processed_records'];
		}
		if($row['type']=='collection'){
			$collectionTotal+= $row['processed_records'];
		}
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>SAP Dump</title>
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
		// $("#import-acfa").on("click", function(e) {
  //          // e.preventDefault();
  //      	// $("#doc").click();
  //      	console.log('hi');
  //      	// $("#doc").on("change", function() {
  //      	// 	$("#fileUploadFormButton").click();
  //      	// })
  //      });
        
	function openFileActuals() {
		$("#doc").click();
		$("#doc").on("change", function(e) {
				const file = e.target.files[0];
			$("#uploaded_actual_file_name").html(file.name);
		})
	}
	
	function openFileCollection() {
		$("#doccollection").click();
		$("#doccollection").on("change", function(e) {
				const file = e.target.files[0];
			$("#uploaded_collection_file_name").html(file.name);
		})
	}
	function openFileRevenue() { 
		$("#docrevenue").click();
		$("#docrevenue").on("change", function(e) {
			const file = e.target.files[0];
			$("#uploaded_file_name").html(file.name);
		})
	}			

	function openFileAbp() { 
		$("#doc_abp").click();
		$("#doc_abp").on("change", function(e) {
			const file = e.target.files[0];
			$("#uploaded_abp_file_name").html(file.name);
		})
	}	
	function deleteUser(id) {
		window.location = `./deletesapcollection?id=${id}`
	}
	$(document).ready(function() {
		$('#collection_field').on('change',function() {
		    var value = $('#collection_field').val();
		    if(value == 'upload_1'){
		    	$('#collection_sap_upload_form').removeClass('d-none');
		    	$('#collection_actual_upload_form').addClass('d-none');
		    }
		    else if(value == 'upload_2'){
		    	$('#collection_sap_upload_form').addClass('d-none');
		    	$('#collection_actual_upload_form').removeClass('d-none');
		    }
		});
		$('#revenue_field').on('change', function() {
			var fileName = document.getElementById('docrevenue').files[0].name;
			if($('#revenue_field')!= '' && fileName != ''){
				$('#saprevenuefileUploadFormButton').removeAttr("disabled"); 
			}
			else{
				$('#saprevenuefileUploadFormButton').attr("disabled", true);
			}
		});
		$('#docrevenue').on('change', function() {
			var fileName = document.getElementById('docrevenue').files[0].name;
			if($('#revenue_field')!= '' && fileName != ''){
				$('#saprevenuefileUploadFormButton').removeAttr("disabled"); 
			}
			else{
				$('#saprevenuefileUploadFormButton').attr("disabled", true); 
			}
			var fileExt = fileName.split('.').pop();
			if(fileExt == 'xls' || fileExt == 'csv' || fileExt == 'xlsx'){
				$('#saprevenuefileUploadFormButton').removeAttr("disabled");
				$('#uploaded_error').text('')
			}
			else{
				$('#uploaded_error').text('Incorrect File Format')
				$('#saprevenuefileUploadFormButton').attr("disabled", true);
			}
			
		});
		// abp file 
		$('#doc_abp').on('change', function() {
			var abpFileName = document.getElementById('doc_abp').files[0].name;
			if($('#abp_field')!= '' && abpFileName != ''){
				$('#abpfileUploadFormButton').removeAttr("disabled"); 
				$("#uploaded_abp_file_name").html(abpFileName);
			}
			else{
				$('#abpfileUploadFormButton').attr("disabled", true); 
			}
			var fileExt = fileName.split('.').pop();
			if(fileExt == 'xls' || fileExt == 'csv' || fileExt == 'xlsx'){
				$('#saprevenuefileUploadFormButton').removeAttr("disabled");
				$('#uploaded_error').text('')
			}
			else{
				$('#uploaded_error').text('Incorrect File Format')
				$('#saprevenuefileUploadFormButton').attr("disabled", true);
			}
			
		});
		$('#doccollection').on('change', function() {
			var fileName = document.getElementById('doccollection').files[0].name;
			var fileExt = fileName.split('.').pop();
			if(fileExt == 'xls' || fileExt == 'csv' || fileExt == 'xlsx'){
				$('#sapcollectionfileUploadFormButton').removeAttr("disabled");
				$('#uploaded_collection_error').text('')
				
			}
			else{
				$('#uploaded_collection_error').text('Incorrect File Format')
				$('#sapcollectionfileUploadFormButton').attr("disabled", true);
			}
			
		});
		$('#doc').on('change', function() {
			var fileName = document.getElementById('doc').files[0].name;
			var fileExt = fileName.split('.').pop();
			if(fileExt == 'xls' || fileExt == 'csv' || fileExt == 'xlsx'){
				$('#import-acfa').removeAttr("disabled");
				$('#uploaded_actual_error').text('')
				
			}
			else{
				$('#uploaded_actual_error').text('Incorrect File Format')
				$('#import-acfa').attr("disabled", true);
			}
			
		});
			$('#SAPTable').DataTable({
				"order": [[ 0, "desc" ]],
				"pageLength": 50,
				initComplete: function () 
				{
					this.api().columns([1]).every( function () {
					var column = this;
					 $(column.header() ).on('click', function() {
					 	select.css("display", "block")
					 });
					var select = $('<select style="display:none; margin-top: 10px;"></select>')
					.appendTo( $(column.header() ))
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
						);

						column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
						if(val == '')
						select.css("display", "none");
					} );
					select.append( '<option value="">None</option>' )
					column.data().unique().sort().each( function ( d, j ) 
					{
						select.append( '<option value="'+d+'">'+d+'</option>' )
					} );
					 $(column.header()).append('<i class="fas fa-filter" style="font-size: 9px; margin-left: 5px;" />')
				} );
			}
			});
		});
	</script>
	<?php
	$modleopen = $_GET['upload_revenue'];
	if($modleopen == 'yes'){
	echo"
		<script>
			$(document).ready(function() {
			$('#revenueuploadModal').show();
			})
		</script> ";
	}
	$abpModleopen = isset($_GET['abp']);
	if($abpModleopen == 'yes'){
	echo"
		<script>
			$(document).ready(function() {
			$('#abpuploadModal').show();
			})
		</script> ";
	}
	$modlecollectionopen = isset($_GET['upload_collection']);
	if($modlecollectionopen == 'yes'){
	echo"
		<script>
			$(document).ready(function() {
			$('#collectionuploadModel').show();
			})
		</script> ";
	}
	?>
</head>
<body>
	<div class="container-main">
		<?php 
		$type = strtoupper($_COOKIE["type"]);
		if ("ADMIN" == $type) 
		TopBar('sap-dump'); 
		else
		nTopBar('sap-dump');
		?>
		<div class="content">
			<div class="">
				<div class='modal modal-fade' style='background-color:rgba(0,0,0,0.5);' id='revenueuploadModal' tabindex='-1' role='dialog' aria-labelledby='modalTitle' aria-hidden='true'>
					<div class='modal-dialog modal-lg' role='document'>
						<div class='modal-content'>
							<div class='modal-header'>
								<h5 class='modal-title' id='modalTitle'>Revenue SAP Dump</h5>
								<!--<button type='button' id='modal-close-btn' class='close' data-dismiss='modal' aria-label='Close' onclick='$("#revenueuploadModal").hide();'> <span aria-hidden='true'>&times;</span> </button>-->
							</div>
							<form method="post" action="" enctype="multipart/form-data">
								<div class='modal-body' style='display:flex; flex-direction: row; justify-content:center; align-items:right; width:100%;'>
									<input type="file" hidden name="doc" required id="docrevenue" />
									<div>
										<div class="d-flex mr-2 my-2">
											<label for="revenue_field" style="flex: 1">Upload Type : &nbsp;</label>
											<select class="form-select" required  style="flex: 3" name="upload_type" id="revenue_field">
												<option value='' selected disabled>Select upload type</option>
												<option value='upload_1'>Upload 1 - previous year of same month</option>
												<option value='upload_2'>Upload 2 - current year of previous month</option>
												<option value='upload_3'>Upload 3 - current month</option>
											</select>
										</div>
										<div class="d-flex mr-4 my-2">
											<label for="" style="flex: 1">Current Month : &nbsp;</label>
											<input class="form-control" style="flex: 3" type="text" name="current_month" id="current_month" disabled value='<?= date("m/Y")?>' />
										</div>
										<div class="d-flex mr-4 my-2">
											<label for="" style="flex: 1">Upload Month : &nbsp;</label>
											<input class="form-control" style="flex: 3" type="text" name="upload_month" id="upload_month" disabled value='--/----' />
										</div>
										<div class="d-flex justify-content-center mt-4 pt-4">
											<div class="dropbtn btn btn-primary user-btn mr-3" required id='upload_revenue_button' onclick='openFileRevenue()' style='color:white;'>Select File</div>
											<div id="uploaded_file_name">No file selected</div>
										</div>
											<center><div id="uploaded_error" style='color:red;'></div></center>
									</div>
								</div>
								<div class='modal-footer' ></div>
								<div style='display:flex; flex-direction: row; justify-content:space-evenly; align-items:right; width:100%;'>
									<div><button class='btn btn-primary user-btn ml-2' data-dismiss='modal' type="submit" name="importsaprevenue" id="saprevenuefileUploadFormButton" aria-label='Close' style='' disabled='disabled'>Upload</button></div>
									<?php
										if($modleopen == 'yes'){
									?>
									<div><a href='sap-dump'><button type='button' id='modal-close-btn-revenue' class='btn btn-danger delete-btn ml-2' data-dismiss='modal' aria-label='Close' style=''>Cancel</button></a></div>
									<?php
										}
										else{
									?>
									<div><button type='button' id='modal-close-btn-revenue-2' class='btn btn-danger delete-btn ml-2' data-dismiss='modal' onclick='$("#revenueuploadModal").hide();' aria-label='Close' style=''>Cancel</button></div>
									<?php
										}
									?>
								</div>
							</div>
						</form>
					</div>
				</div>

				<!-- abp popup -->
				<div class='modal modal-fade' style='background-color:rgba(0,0,0,0.5);' id='abpuploadModal' tabindex='-1' role='dialog' aria-labelledby='modalTitle' aria-hidden='true'>
					<div class='modal-dialog modal-lg' role='document'>
						<div class='modal-content'>
							<div class='modal-header'>
								<h5 class='modal-title' id='modalTitle'>ABP Dump</h5>
								<!--<button type='button' id='modal-close-btn' class='close' data-dismiss='modal' aria-label='Close' onclick='$("#revenueuploadModal").hide();'> <span aria-hidden='true'>&times;</span> </button>-->
							</div>
							<form method="post" action="" enctype="multipart/form-data">
								<div class='modal-body' style='display:flex; flex-direction: row; justify-content:center; align-items:right; width:100%;'>
									<input type="file" hidden name="doc_abp" required id="doc_abp" />
									<div>
										<div class="d-flex mr-2 my-2">
											<label for="abp_field" style="flex: 1">Upload Type : &nbsp;</label>
											<select class="form-select" required  style="flex: 3" name="abp_type" id="abp_field">
												<option value='' selected disabled>Select upload type</option>
												<option value='abp'>Upload 1 - ABP</option>
												<option value='abp_vaor'>Upload 2 - ABP VAOR</option>
											</select>
										</div>
										<div class="d-flex justify-content-center mt-4 pt-4">
											<div class="dropbtn btn btn-primary user-btn mr-3" required id='upload_abp_button' onclick='openFileAbp()' style='color:white;'>Select File</div>
											<div id="uploaded_abp_file_name">No file selected</div>
										</div>
											<center><div id="uploaded_error" style='color:red;'></div></center>
									</div>
								</div>
								<div class='modal-footer' ></div>
								<div style='display:flex; flex-direction: row; justify-content:space-evenly; align-items:right; width:100%;'>
									<div><button class='btn btn-primary user-btn ml-2' data-dismiss='modal' type="submit" name="importAbp" id="abpfileUploadFormButton" aria-label='Close' style='' disabled='disabled'>Upload</button></div>
									<?php
										if($abpModleopen == 'yes'){
									?>
									<div><a href='abp'><button type='button' id='modal-close-btn-revenue' class='btn btn-danger delete-btn ml-2' data-dismiss='modal' aria-label='Close' style=''>Cancel</button></a></div>
									<?php
										}
										else{
									?>
									<div><button type='button' id='modal-close-btn-revenue-2' class='btn btn-danger delete-btn ml-2' data-dismiss='modal' onclick='$("#revenueuploadModal").hide();' aria-label='Close' style=''>Cancel</button></div>
									<?php
										}
									?>
								</div>
							</div>
						</form>
					</div>
				</div>
			<!--</div>-->
				<div class='modal modal-fade' style='background-color:rgba(0,0,0,0.5);' id='collectionuploadModel' tabindex='-1' role='dialog' aria-labelledby='modalTitle' aria-hidden='true'>
					<div class='modal-dialog modal-lg' role='document'>
						<div class='modal-content'>
							<div class='modal-header'>
								<h5 class='modal-title' id='modalTitle'>Collection SAP Dump</h5>
								<button type='button' id='modal-close-btn-collection' class='close' data-dismiss='modal' aria-label='Close' onclick='$("#collectionuploadModel").hide();'> <span aria-hidden='true'>&times;</span> </button>
							</div>
							<div class='modal-body' style='display:flex; flex-direction: row; justify-content:center; align-items:right; width:100%;'>
								<div>
									<div class="d-flex mr-2 my-2">
										<label for="revenue_field" style="flex: 2">Upload Type : &nbsp;</label>
										<select class="form-select" required  style="flex: 3" name="upload_type_collection" id="collection_field">
											<option value='' selected disabled>Select upload type</option>
											<option value='upload_1'>Upload 1 - Collection SAP dump</option>
											<option value='upload_2'>Upload 2 - Actuals</option>
										</select>
									</div>
									<div class="d-flex mr-2 my-3">
										<label for="" style="flex: 2">Upload for : &nbsp;</label>
										<input class="form-control" style="flex: 3" type="text" name="current_month" id="current_month_collection" disabled value='<?= date("M/Y")?>' />
									</div>
									<!--collection-->
									<form id='collection_sap_upload_form' method="post" action="sap-dump" enctype="multipart/form-data">
										<input type="file" hidden name="doc" required id="doccollection" />
										<div class="d-flex justify-content-center mt-4 pt-4">
											<div class="dropbtn btn btn-primary user-btn mr-3" required onclick='openFileCollection()' style='color:white;'>Select File</div>
											<div id="uploaded_collection_file_name">No file selected</div>
										</div>
										<center><div id="uploaded_collection_error" style='color:red;'></div></center>
										<div class='modal-footer'></div>
										<div style='display:flex; flex-direction: row; justify-content:space-evenly; align-items:right; width:100%;'>
											<div><button  class='btn btn-primary user-btn ml-2' data-dismiss='modal' type="submit" name="importsapcollection" id="sapcollectionfileUploadFormButton" disabled='disabled' aria-label='Close' style=''>Upload SAP Collection</button></div>
											<?php 
												if($modlecollectionopen == 'yes')
												{
											?>
											<div><a href='sap-dump'><button type='button' id='modal-close-btn-collection-2' class='btn btn-danger delete-btn ml-2' data-dismiss='modal' aria-label='Close' style=''>Cancel</button></a></div>
											<?php
												}else{
											?>
											<div><button type='button' id='modal-close-btn-collection-3' class='btn btn-danger delete-btn ml-2' data-dismiss='modal' onclick='$("#collectionuploadModel").hide();' aria-label='Close' style=''>Cancel</button></div>
											<?php
												}
											?>
										</div>
									</form>
									<!--actuals-->
									<form method="post" id='collection_actual_upload_form'  class='d-none' action="sap-dump" enctype="multipart/form-data">
			        					<input type="file" hidden required name="doc" id="doc" />
			        					<div class="d-flex justify-content-center mt-4 pt-4">
											<div class="dropbtn btn btn-primary user-btn mr-3" required onclick='openFileActuals()' style='color:white;'>Select File</div>
											<div id="uploaded_actual_file_name">No file selected</div>
										</div>
										<center><div id="uploaded_actual_error" style='color:red;'></div></center>
										<div class='modal-footer'></div>
										<div style='display:flex; flex-direction: row; justify-content:space-evenly; align-items:right; width:100%;'>
			    							<div><button type="submit" class="btn btn-primary user-btn ml-2" name='importacfacollection' id="import-acfa" disabled data-toggle="modal" data-target="#exampleModalCenter">Upload Actuals</button></div>
			    					    	<?php 
												if($modlecollectionopen == 'yes')
												{
											?>
											<div><a href='sap-dump'><button type='button' id='modal-close-btn-collection-4' class='btn btn-danger delete-btn ml-2' data-dismiss='modal' aria-label='Close' style=''>Cancel</button></a></div>
											<?php
												}else{
											?>
											<div><button type='button' id='modal-close-btn-collection-5' class='btn btn-danger delete-btn ml-2' data-dismiss='modal' onclick='$("#collectionuploadModel").hide();' aria-label='Close' style=''>Cancel</button></div>
											<?php
												}
											?>
			    					    	<!--<input type="submit"  name="import" id="fileUploadFormButton" hidden />-->
			    			        	</div>
			    			        </form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--<div class="graph-card stats-card mx-2 mt-4 p-3 row align-items-center">-->
				<!--	<div class='col-md-12 col-sm-12 col-lg-12 row'>-->
				<!--		<div class="col-md-6 col-sm-6 col-lg-6">-->
				<!--			<center><h2>collection</h2></center>-->
				<!--			<div class="row">-->
				<!--				<div class="col-md-6 col-sm-6 col-lg-6">-->
				<!--					<center>-->
				<!--						<div class="d-flex justify-content-center align-items-center" style='padding-left:20px>-->
				<!--							<div class="stat-icon stat-blue mr-3">-->
				<!--								<i class="fas fa-chart-line"></i>-->
				<!--							</div>-->
				<!--							<div>-->
				<!--								<div class="stat-value"><?= $collection?></div>-->
				<!--								<div class="stat-name">Total Dump</div>-->
				<!--							</div>-->
				<!--						</div>-->
				<!--					</center>-->
				<!--				</div>-->
				<!--				<div class="col-md-6 col-sm-6 col-lg-6">-->
				<!--					<center>-->
				<!--						<div class="d-flex justify-content-center align-items-center" style='padding-left:20px>-->
				<!--							<div class="stat-icon stat-blue mr-3">-->
				<!--								<i class="fas fa-chart-line"></i>-->
				<!--							</div>-->
				<!--							<div>-->
				<!--								<div class="stat-value"><?= $collectionTotal?></div>-->
				<!--								<div class="stat-name">Total Records</div>-->
				<!--							</div>-->
				<!--						</div>-->
				<!--					</center>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--		</div>-->
				<!--		<div class="col-md-6 col-sm-6 col-lg-6">-->
				<!--			<center><h2>revenue</h2></center>-->
				<!--			<div class="row">-->
				<!--				<div class="col-md-6 col-sm-6 col-lg-6">-->
				<!--					<center>-->
				<!--						<div class="d-flex justify-content-center align-items-center" style='padding-left:20px>-->
				<!--							<div class="stat-icon stat-blue mr-3">-->
				<!--								<i class="fas fa-chart-line"></i>-->
				<!--							</div>-->
				<!--							<div>-->
				<!--								<div class="stat-value"><?= $revenue?></div>-->
				<!--								<div class="stat-name">Total Dump</div>-->
				<!--							</div>-->
				<!--						</div>-->
				<!--					</center>-->
				<!--				</div>-->
				<!--				<div class="col-md-6 col-sm-6 col-lg-6">-->
				<!--					<center>-->
				<!--						<div class="d-flex justify-content-center align-items-center" style='padding-left:20px>-->
				<!--							<div class="stat-icon stat-blue mr-3">-->
				<!--								<i class="fas fa-chart-line"></i>-->
				<!--							</div>-->
				<!--							<div>-->
				<!--								<div class="stat-value"><?= $revenueTotal?></div>-->
				<!--								<div class="stat-name">Total Records</div>-->
				<!--							</div>-->
				<!--						</div>-->
				<!--					</center>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--		</div>-->
				<!--	</div>-->
				<!--</div>-->
				<div style="background:white" class="mt-5 p-2 ">
					<div class="d-flex justify-content-around flex-wrap" style="color:#7367F0;font-size:20px;font-weight:bold">
						<div class="d-flex justify-content-center align-items-center" >
							<i class="fas fa-server"></i>
							<div class="stat-icon stat-blue mr-3">
								<div style="font-weight:bold;color:#7367F0;font-size:20px;" class="stat-name">Sap Dump :</div>
							</div>
						</div>
						<div class="d-flex justify-content-around align-items-center" >
							<div class="stat-icon stat-blue mr-3">
								<div style="color:lightgrey;font-weight:bold" class="stat-name">Collection :</div>
							</div>
							<div>
								<div style="font-size:15px;color:grey;font-weight:bold" class="stat-name">Total Dump</div>
								<div style="font-size:19px;color:grey;font-weight:bold;text-align:right;" class="stat-value"><?= $collection?></div>
							</div>
						<!--</div>-->
						<!--<div class="d-flex justify-content-center align-items-center" style='padding-left:20px>-->
						<!--	<div class="stat-icon stat-blue mr-3">-->
						<!--	</div>-->
							<div>
							    <div style="font-size:15px;color:grey;font-weight:bold;padding-left:10px" class="stat-name">Total Records</div>
							    <div style="font-weight:bold; font-size:19px;color:grey;text-align:right;" class="stat-value" id="original-filtered"><?= $collectionTotal?></div>
							</div>
						</div>
						<div class="d-flex justify-content-around align-items-center">
							<div class="stat-icon stat-blue mr-3">
								<div style="color:lightgrey;font-weight:bold" class="stat-name">Revenue :</div>
							</div>
							<div>
							    <div style="font-size:15px;color:grey;font-weight:bold" class="stat-name">Total Dump</div>
							    <div style="font-weight:bold; font-size:19px;color:grey;text-align:right;" class="stat-value" id="revised-filtered"><?= $revenue?></div>
							</div>
						<!--</div>-->
						<!--<div class="d-flex justify-content-center align-items-center" style='padding-left:20px>-->
						<!--	<div class="stat-icon stat-blue mr-3">-->
						<!--	</div>-->
							<div>
							    <div style="font-size:15px;color:grey;font-weight:bold;padding-left:10px" class="stat-name">Total Records</div>
							    <div style="font-weight:bold; font-size:19px;color:grey;text-align:right;" class="stat-value" id="actual-filtered"><?= $revenueTotal?></div>
							</div>
						</div>
					</div>
				</div>
				<div class="table-responsive mt-2 p-4" style="background: white">
					<div class="row d-flex justify-content-center">
						<div class="card-title col-md-8 d-flex justify-content-around">
							<h3>Upload</h3>
							<h3>Download</h3>
						</div>
						<div>
							<div class="d-none copy-buttons" style="margin-top:50px;margin-bottom:10px;">
								<!--<form method="post" action="" enctype="multipart/form-data">-->
								<!--	<input type="file" hidden name="doc" id="doccollection" />-->
								<!--	<input type="button" id='add-collection' value="Upload  Collection SAP Dump" class="btn btn-primary user-btn ml-2" onclick="openFileCollection()" />-->
								<!--	<input type="submit" name="importsapcollection" id="sapcollectionfileUploadFormButton" hidden />-->
								<!--</form>-->
								<!--<div class="dropdown">-->
								<div class='d-flex justify-content-between'style='width:100%'>
									<div class='d-flex justify-content-around mr-4'>
										<div class="dropbtn btn btn-primary user-btn ml-2" onclick='$("#collectionuploadModel").show();' style='color:white'>Upload Collection</div>
										<div class="dropbtn btn btn-primary user-btn ml-2" onclick='$("#revenueuploadModal").show();' style='color:white'>Upload Revenue</div>
									</div>
								<!--</div>-->
								
		    					
									<div class='d-flex justify-content-around'>
										<form method="post" action="exportacfa" style="display:inline">
				    					 <button type="submit" id="export-acfa" name="exportacfa" class="btn btn-primary user-btn ml-2">Download format actuals</button>
				    				    </form>
				    			        
				    			        
										<form method="post" action="exportsapcollection">
											<input type="submit" id='download-collection' name="exportsapcollection" class="btn btn-primary user-btn ml-2 download-collection" value="Download Collection" />
										</form>
										<form method="post" action="exportsaprevenue">
											<input type="submit" id='download-revenue' name="exportsaprevenue" class="btn btn-primary user-btn ml-2 download-revenue" value="Download Revenue" />
										</form>
									</div>
								</div>
							</div>
						</div>	
					</div>
				
				<table id="SAPTable">
						<thead class="mt-2">
							<th>ID</th>
							<th>Submission Month</th>
							<th>Submission Date</th>
							<th>File name</th>
							<th>Type</th>
							<th>Total Records</th>
							<th>Proccesed Records</th>
							<th>Actions</th>
						</thead>
						<tbody>
							<?php 
							
							$sno=0;
							if(!empty($arr_sap )) { ?>
								<?php foreach($arr_sap  as $SAP) { ?>
									<tr style="background-color: rgb(194, 221, 230,0.2)">
										<td><?= $SAP["id"]; ?></td>
										<td><?php echo $SAP["import_month"]; ?></td>
										<td><?php echo $SAP["import_date"]; ?></td>
										<td><?php echo $SAP["file_name"]; ?></td>
										<td><?php echo $SAP['type']; ?></td>
										<td class="text-right"><?php echo $SAP['total_records']; ?></td>
										<td class="text-right"><?php echo $SAP['processed_records']; ?></td>
										<td>
											<center><button type="button" class="btn btn-danger delete-btn" onclick="$('#sap-delete-modal-<?php echo $SAP['id'] ?>').show();">
												<i class="far fa-trash-alt"></i>
											</button></center>
										</td>
										</tr>                      
									</div>
								</div>
							<?php } ?>
						<?php } ?>
					</tbody>
				</table>
				</div>
			</div>
			<?php
	include "./components/footer.php"
?>
		</div>
	</div>
	<?php foreach($arr_sap  as $SAP) { ?>
			<div class="modal" style="background-color: rgba(0,0,0,0.5);" id="sap-delete-modal-<?php echo $SAP['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="sap-delete-modal-title-<?php echo $SAP['id'] ?>" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="sap-delete-modal-title-<?php echo $SAP['id'] ?>">Delete user <?php echo $SAP["fname"]." ".$SAP["lname"]; ?></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#sap-delete-modal-<?php echo $SAP['id'] ?>').hide();">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" onclick="deleteUser(<?php echo $SAP['id'] ?>)">Delete</button>
							<button type="button" class="btn btn-primary" onclick="$('#sap-delete-modal-<?php echo $SAP['id'] ?>').hide();">Cancel</button>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$("#revenue_field").on("change", function(e) {
					const val = e.target.value;
					const date = new Date();
					const month = (date.getMonth() > 8 ? date.getMonth() + 1 : `0${date.getMonth() + 1}`);
					const prevMonth = (date.getMonth() > 9 ? date.getMonth() : `0${date.getMonth()}`);
					const year = date.getFullYear();
					const prevYear = date.getFullYear() - 1;
					if(val == "upload_1") {
						$("#upload_month").val(`${month}/${prevYear}`);
					}
					else if(val == "upload_2") {
						$("#upload_month").val(`${prevMonth}/${year}`);
					}
					else if(val == "upload_3") {
						$("#upload_month").val(`${month}/${year}`);
					} else {
						$("#upload_month").val(`--/----`);
					}
				})
			</script>
		<?php } ?>
	<!-- script -->
<?php
			if(!$importpermission) {
				echo "<script>$('.add-collection').prop('disabled', true);</script>";
				echo "<script>$('.add-collection').parent().css('cursor', 'no-drop');</script>";
				echo "<script>$('.add-collection').parent().on('click', function() {alert('No permission')});</script>";
				
				echo "<script>$('.add-revenue').prop('disabled', true);</script>";
				echo "<script>$('.add-revenue').parent().css('cursor', 'no-drop');</script>";
				echo "<script>$('.add-revenue').parent().on('click', function() {alert('No permission')});</script>";
			}
			if(!$exportpermission) {
				echo "<script>$('.download-collection').prop('disabled', true);</script>";
				echo "<script>$('.download-collection').parent().css('cursor', 'no-drop');</script>";
				echo "<script>$('.download-collection').parent().on('click', function() {alert('No permission')});</script>";
				
				echo "<script>$('.download-revenue').prop('disabled', true);</script>";
				echo "<script>$('.download-revenue').parent().css('cursor', 'no-drop');</script>";
				echo "<script>$('.download-revenue').parent().on('click', function() {alert('No permission')});</script>";
			}
			if(!$deletepermission) {
				echo "<script>$('.delete-btn').prop('disabled', true);</script>";
				echo "<script>$('.delete-btn').parent().css('cursor', 'no-drop');</script>";
				echo "<script>$('.delete-btn').parent().on('click', function() {alert('No permission')});</script>";
			}
		?>
		
<script type="text/javascript">
		setTimeout(function() {
			$('#SAPTable_filter').prepend('<div class="d-inline-flex justify-content-center mr-2">' + $(".copy-buttons").html() + '</div>');
		}, 100);
</script>
<?php
// error_reporting(0);

if(isset($_POST['importsapcollection'])){
	require_once("./importsapcollection.php");
}
if(isset($_POST['importsaprevenue'])){
	require_once("./importsaprevenue.php");
}
if(isset($_POST['importAbp'])){
	require_once("./importabp.php");
}
if(isset($_POST['importacfacollection'])){
	echo "<script>console.log('ok')</script>";
	require_once("./importacfa.php");
}	
?>

</body>
</html>
