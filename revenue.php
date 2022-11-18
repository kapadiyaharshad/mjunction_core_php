<!DOCTYPE html>
<html>
    <head>
	<title>Revenue</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<script src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/antd/4.15.2/antd.min.js"></script>
    <script src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/antd/4.15.2/antd.min.css" />

	<!-- CSS -->
	<link rel="stylesheet" href="./css/index.css">
	<link rel="stylesheet" href="./css/collection-table.css">

	<!-- JS -->
	<script src="./js/main.js"></script>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />


    <style type="text/css">
        .user-btn {
        	background: #7367F0 !important;
        	border-color: #7367F0 !important;
        	/*border:none !important;*/
        	color: white;
        	margin-bottom: 1rem;
        }
        textarea.ant-input{
            margin-top: 5px !important;
            margin-bottom: 5px !important;
        }  
        .user-btn:hover {
            border-color: #7367F0 !important;
        	box-shadow: 0 8px 25px -8px #7367f0;
        }
        .edit_input{
            border: 1px solid black !important;
            padding: 0px 0px 0px 0px !important;
        }
        .edit_input {
            width: 100%;
            border: 1px solid lightgrey !important;
            background-color: white !important;
        }
        .edit_input:hover {
            border: 1px solid black !important;
        }
        .textarea{
            /*height: auto !important;*/
            resize: none;
            overflow: hidden;
            /*min-height: 50px;*/
            /*max-height: 100px;*/
        }
	    tbody tr {
	        background-color: rgba(153, 144, 244, 0.2) !important;
	    }
	    /*tbody tr:nth-child(odd) {*/
	    /*    background-color: rgba(153, 144, 244, 0.1) !important;*/
	    /*}*/
	    /*.xyz {*/
	        /*background-color: rgba(153, 144, 244, 0.1) !important;   */
	    /*}*/
	    .ant-table-body {
	        overflow-y: hidden !important;
	    }
	    .ant-table-thead th {
	        background-color: #D8D4F6 !important; 
	    }
	    .ant-table-filter-trigger-container {
	        background-color: #D8D4F6 !important; 
	    }
	   
	    .ant-table-tbody>tr>td {
	        border: none !important;
	    }
	    .ant-table-pagination-left .ant-pagination-options {
	        margin-top: -50px;
	    }
	    .ant-table-pagination-left .ant-pagination-total-text {
	        display: none;
	    }
	    .ant-table-pagination-left .ant-pagination-prev {
	        display: none;
	    }
	    .ant-table-pagination-left .ant-pagination-item {
	        display: none;
	    }
	    .ant-table-pagination-left .ant-pagination-next {
	        display: none;
	    }
	    .ant-table-pagination-right .ant-pagination-options {
	        display: none;
	    }
	    .ant-table-pagination.ant-pagination {
	        margin: 0px;
	    }
	    .ant-select-selector {
	        height: 40px !important;
	        align-items: center;
	    }
	    .ant-table-header {
	        margin-top: 10px;
	    }
	    tbody tr:nth-child(odd) {
	        background-color: rgba(153, 144, 244, 0.1) !important;
	    }
	    tbody tr:nth-child(even) {
	        background-color: rgba(153, 144, 244, 0.2) !important;
	    }
	    .ant-table-tbody>tr.ant-table-row:hover>td {
	        background-color: #D7D3F4 !important;
	    }
	    .ant-table-tbody>tr>td, .ant-table-thead>tr>th, .ant-table tfoot>tr>td, .ant-table tfoot>tr>th{
	        padding: 0px !important;
	        padding-left: 10px !important;
	    }
	    #custom-scrollbar {
	        position: fixed;
	        top: 64px;
	        right: 0;
	        height: 100px;
	        width: 12px;
	        background-color: #898989;
	        border:1px solid lightgrey;
	        z-index: 2000;
	        border-radius: 50px;
	    }
	    #custom-scrollbar:hover {
	        cursor: pointer;
	        background-color: grey;
	    }
	    #custom-scroll {
	        position: absolute;
	        width: 12px;
	        height: calc(100% - 64px);
	        top: 64px;
	        right: 0;
	        background-color: #dedede;
	        z-index: 1999;
	    }
    </style>
    <script type="text/javascript">
        function openFileRevenue() {
		$("#docrevenue").click();
		$("#docrevenue").on("change", function(e) {
			const file = e.target.files[0];
			$("#uploaded_file_name").html(file.name);
		})
	}
	$(document).ready(function() {
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
				
			}
			else{
				$('#uploaded_error').text('Incorrect File Format')
				$('#saprevenuefileUploadFormButton').attr("disabled", true);
			}
			
		});
	});
    </script>
</head>
  <body>

    <?php 
        include "./database/sql.php";
        include "./components/top-bar.php";
    ?>
    <div class="container-main">
		<?php 
		$type = strtoupper($_COOKIE["type"]);
		if ("ADMIN" == $type) 
		TopBar('revenue'); 
		else
		nTopBar('revenue');
		$voar_per_query = pg_query($conn, "SELECT * FROM voar_percentage");
        $voar_data = pg_fetch_all($voar_per_query);
        echo "<div class='d-none' id='voar-data'>".json_encode($voar_data)."</div>";

		?>
		<div class="content">
			<div class="padded">
			    <div id="custom-scroll">
    		        <div id="custom-scrollbar"></div>
		        </div>
			    <div class="graph-card mx-2 mt-5 p-3">
					<div class="d-flex justify-content-between flex-wrap px-5">
					    <div class="d-flex justify-content-center stat-item" style="color:#7367F0;font-size:20px;font-weight:bold">
							<div class="stat-icon stat-blue mr-3">
						    <i class="fas fa-coins">&nbsp;&nbsp;&nbsp;&nbsp;</i>
								<div style="font-weight:bold" class="stat-name" >Revenue Details</div>
							</div>
						</div>
                        <div class="d-flex justify-content-center stat-item" style="color:lightgrey;">
							<div class="stat-icon stat-blue mr-3">
						    <i class="fas fa-chart-line">&nbsp;&nbsp;&nbsp;&nbsp;</i>
								<div style="font-weight:bold" class="stat-name">Last Month Actuals :</div>
							</div>
							<div>
								<div style="font-weight:bold;color:grey; font-size:19px" class="stat-value" id="last-month-actuals">0.00</div>
							</div>
						</div>
						<div class="d-flex justify-content-center stat-item" style="color:lightgrey;">
							<div class="stat-icon stat-blue mr-3">
						    <i class="fas fa-chart-line">&nbsp;&nbsp;&nbsp;&nbsp;</i>
								<div style="font-weight:bold" class="stat-name">Total ABP :</div>
							</div>
							<div>
								<div style="font-weight:bold;color:grey; font-size:19px" class="stat-value" id="total-abp">0.00</div>
							</div>
						</div>
                        
                        <div class="d-flex justify-content-center stat-item" style="color:lightgrey;">
							<div class="stat-icon stat-blue mr-3">
						    <i class="fas fa-chart-line">&nbsp;&nbsp;&nbsp;&nbsp;</i>
								<div style="font-weight:bold" class="stat-name">Estimates :</div>
							</div>
							<div>
								<div style="font-weight:bold;color:grey; font-size:19px" class="stat-value" id="revised-estimate">0.00</div>
							</div>
						</div>
						<div class="d-flex justify-content-center stat-item" style="color:lightgrey;">
							<div class="stat-icon stat-blue mr-3">
						    <i class="fas fa-chart-line">&nbsp;&nbsp;&nbsp;&nbsp;</i>
								<div style="font-weight:bold" class="stat-name"> Current Month Actuals :</div>
							</div>
							<div>
							    <div style="font-weight:bold;color:grey; font-size:19px" class="stat-value" id="actuals">0.00</div>
							</div>
						</div>
                        
						<!-- <div class="d-flex justify-content-center stat-item" style="color:lightgrey;">
							<div class="stat-icon stat-blue mr-3">
						    <i class="fas fa-chart-line">&nbsp;&nbsp;&nbsp;&nbsp;</i>
								<div style="font-weight:bold" class="stat-name">Total AM Projection:</div>
							</div>
							<div>
							    <div style="font-weight:bold;color:grey; font-size:19px" class="stat-value" id="total-am-projection">0.00</div>
							</div>
						</div> -->
					</div>
				
                </div>
				<div class=" graph-card mx-2 mt-3 p-4">
				    <div class='modal modal-fade' id='revenueuploadModal' tabindex='-1' role='dialog' aria-labelledby='modalTitle' aria-hidden='true'>
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
    										<div class="d-flex justify-content-center mt-5 pt-4">
    											<div class="dropbtn btn btn-primary user-btn mr-3" required id='upload_revenue_button' onclick='openFileRevenue()' style='color:white;'>Select File</div>
    											<div id="uploaded_file_name">No file selected</div>
    										</div>
    											<center><div id="uploaded_error" style='color:red;'></div></center>
    									</div>
    								</div>
    								<div class='modal-footer' ></div>
    								<div style='display:flex; flex-direction: row; justify-content:space-evenly; align-items:right; width:100%;'>
    									<div><button class='btn btn-primary user-btn ml-2' data-dismiss='modal' type="submit" name="importsaprevenue" id="saprevenuefileUploadFormButton" aria-label='Close' style='' disabled='disabled'>Upload</button></div>
    									<div><button type='button' id='modal-close-btn' class='btn btn-danger delete-btn ml-2' data-dismiss='modal' onclick='$("#revenueuploadModal").hide();' aria-label='Close' style=''>Cancel</button></div>
    								</div>
    							</div>
    						</form>
    					</div>
    				</div>
					<div style="position:fixed; width:98.2%; " class="d-flex justify-content-center header-wrapper">
					    <!--<div class="card-title">-->
					        <!--<h2 style="margin-bottom:50px">Revenue Details</h2>-->
					    <!--</div>-->
					    	<div class="d-flex justify-content-center">
							    <?php 
					    	        if($_COOKIE['type'] == 'ADMIN')
					    	        {
					    	    ?>
					    	            <!--<a href="revenue_review.php"><button class="btn btn-primary user-btn ml-2">Revenue review</button></a>-->
					    	            <!--<a href="voar_percentage.php"><button class="btn btn-primary user-btn ml-2">VOAR Percentage</button></a>-->
				    	                <!--<a href="sap-dump.php?upload_revenue=yes"><button class="btn btn-primary user-btn ml-2">Upload revenue file</button></a>-->
							    <?php
							        }
							    ?>
					    	    <?php 
					    	        if($_COOKIE['type'] == 'RM' || $_COOKIE['type'] == 'AM')
					    	        {
					    	    ?>
    				<!--			<form method="post" action="exportsaprevenue.php">-->
								<!--	<input type="submit" id='download-revenue' name="exportsaprevenue" class="btn btn-primary user-btn ml-2" value="Download Revenue SAP Dump" />-->
								<!--</form>-->
    				<!--			 <div class="dropbtn btn btn-primary user-btn ml-2" onclick='$("#revenueuploadModal").show();' style='color:white'>Upload Revenue SAP Dump</div>-->
							    <?php
							        }
							    ?>
						    </div>
						</div>
                        <div id="mydiv"></div>
                    </div>
				</div>
            </div>
            <?php
	include "./components/footer.php"
?>
        </div>
    </div>
    <span id="role" data-role="<?= $_COOKIE['type'] ?>" />
    <script type="text/javascript">
		$("#revenue_field").on("change", function(e) {
    		const val = e.target.value;
			const date = new Date();
	    	const month = (date.getMonth() > 8 ? date.getMonth() + 1 : `0${date.getMonth() + 1}`);
			const prevMonth = (date.getMonth() > 9 ? date.getMonth() : `0${date.getMonth()}`);
			const year = date.getFullYear();
			const prevYear = date.getFullYear() - 1;
			if(val == "upload_3") {
				$("#upload_month").val(`${month}/${year}`);
			} else {
				$("#upload_month").val(`--/----`);
			}
		});
		$(document).ready(function() {
		    setTimeout(function() {
        		$(".textarea").on("input", function(e) {
        		    auto_grow(this);
        		});
		    }, 1000);
		    setTimeout(function() {
        		$(".textarea").each(function(e) {
        		    auto_grow($(".textarea")[e]);
        		});
		    }, 1000);
		});
	</script>
    <script type="text/babel">
    
        const DataTable = () => {
            const { Table, Input, Checkbox, Row, Dropdown, Menu, Button, Modal } = antd;
            const { useState, useEffect } = React;
            const [data, setData] = useState([]);
            const [editPermission, setEditPermission] = useState(false);
            const [historyPermission, setHistoryPermission] = useState(false);
            const [loading, setLoading] = useState(true);
            const [filteredData, setFilteredData] = useState([]);
            const [wholeData, setWholeData] = useState([]);
            const [columnToShow, setColumnsToShow] = useState('all');
            const [checkedRows, setCheckedRows] = useState([]);
            const [isFreezed, setIsFreezed] = useState(true);
            const [columnsToUpdate, setColumnsToUpdate] = useState({})
            const voarData = JSON.parse($("#voar-data").html());
            const role = $('#role').data('role');
            localStorage.setItem('column_names', columnToShow);
           
            useEffect(() => {
                $(window).unbind('beforeunload');
                $(window).bind('beforeunload', function () {
                    if(!_.isEmpty(columnsToUpdate))
                    return 'please save your setting before leaving the page.';
                });
            }, [columnsToUpdate]);
            
                
            const filterList = (column) => {
                return _.uniqBy(_.map(filteredData, item => ({text: item[column], value: item[column]})), "value")
            }
            
            const updateMultipleValueInDB=() => {
                $.ajax({
                    type: "POST",
            	    url: './update-multiple-revenue.php',
    			    data: { rows: columnsToUpdate },
    			    success:function(html) {
                    	console.log(html);
                        fetchData();
                	}
            	});
            }
            
            const updateValueInDB=(value, name, id, isCopied = false) => {
                const body = _.set({}, `${id}.${name}`, value);
                if(isCopied) {
                    $.ajax({
                        type: "POST",
                	    url: './update-multiple-revenue.php',
        			    data: { rows: body },
        			    success:function(html) {
                    	    console.log(html);
                            fetchData();
                	    }
            	    });
                } else {
                    Modal.confirm({
                        title: "Update Value?",
                        onOk: () => {
                            $.ajax({
                    		    type: "POST",
                        	    url: './update-multiple-revenue.php',
                			    data: { rows: body },
                			    success:function(html) {
                    			    console.log(html);
                                    fetchData();
                			    }
                		    });
                        }
                    })
                }
            }
            
            const currentDate = new Date();
            
            const MonthNames = [
                "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ];
            
            const columns = [
              {
                title: 'Month',
                dataIndex: 'month',
                sorter: (a, b) => (a.month || "").localeCompare(b.month || ""),
                // filters: filterList("month"),
                onFilter: (value, record) => record.month === value,
                defaultFilteredValue: [`${MonthNames[currentDate.getMonth()]}-${currentDate.getFullYear()}`],
                width: 100
              },
              {
                title: 'ECNC',
                dataIndex: 'ecnc',
                sorter: (a, b) => (a.ecnc || "").localeCompare(b.ecnc || ""),
                filters: filterList("ecnc"),
                onFilter: (value, record) => record.ecnc === value,
                width: 130
              },
              {
                title: 'Category',
                dataIndex: 'category',
                sorter: (a, b) => (a.category || "").localeCompare(b.category || ""),
                filters: filterList("category"),
                onFilter: (value, record) => record.category === value,
                width: 120
              },
              {
                title: 'BU',
                dataIndex: 'business',
                sorter: (a, b) => (a.business || "").localeCompare(b.business || ""),
                filters: filterList("business"),
                onFilter: (value, record) => record.business === value,
                width: 100
              },
              {
                title: 'Service',
                dataIndex: 'service',
                sorter: (a, b) => a.service - b.service,
                filters: filterList("service"),
                onFilter: (value, record) => record.service === value,
                width: 100
              },
              {
                title: 'Account Type',
                dataIndex: 'account_type',
                sorter: (a, b) => a.account_type - b.account_type,
                filters: filterList("account_type"),
                onFilter: (value, record) => record.account_type === value,
                width: 160
              },
              {
                title: 'Client Name',
                dataIndex: 'client_name',
                sorter: (a, b) => (a.client_name || "").localeCompare(b.client_name || ""),
                filters: filterList("client_name"),
                onFilter: (value, record) => record.client_name === value,
                width: 150
              },
              {
                title: `${MonthNames[currentDate.getMonth()]}-${currentDate.getFullYear() - 1} Actual`,
                dataIndex: 'upload_1',
                sorter: (a, b) => a.upload_1 - b.upload_1,
                width: 150,
                align: "right",
                render: text => text ? _.round(text, 2).toFixed(2) : <div style={{color: "#bababa"}}>0.00</div>
              },
              {
                title: `${currentDate.getMonth() == 0 ? "Dec" : MonthNames[currentDate.getMonth() - 1]}-${currentDate.getMonth() == 0 ? currentDate.getFullYear() - 1 : currentDate.getFullYear()} Actual`,
                dataIndex: 'upload_2',
                sorter: (a, b) => (a.upload_2 || "").localeCompare(b.upload_2 || ""),
                width: 160,
                align: "right",
                render: text => text ? _.round(text, 2).toFixed(2) : <div style={{color: "#bababa"}}>0.00</div>
              },
              {
                title: `${MonthNames[currentDate.getMonth()]}-${currentDate.getFullYear()} ABP`,
                dataIndex: 'target_amount',
                sorter: (a, b) => a.target_amount - b.target_amount,
                width: 150,
                align: "right",
                render: text => text ? _.round(text, 2).toFixed(2) : <div style={{color: "#bababa"}}>0.00</div>
              },
              {
                title: `${MonthNames[currentDate.getMonth()]}-${currentDate.getFullYear()} ABP VAOR`,
                // dataIndex: 'abp_voar',
                // sorter: (a, b) => a.abp - b.abp,
                dataIndex: 'a_v_target_amount',
                sorter: (a, b) => a.a_v_target_amount - b.a_v_target_amount,
                width: 180,
                align: "right",
                // render: (text, record) => {
                //     const voarPer = (_.find(voarData, x => x.bu == record.business && x.services == record.service) || {}).percentage || 0;
                //     return _.round(record.target_amount * voarPer / 100, 2).toFixed(2);
                // }
                render: text => text ? _.round(text, 2).toFixed(2) : <div style={{color: "#bababa"}}>0.00</div>
              },
              {
                title: `${MonthNames[currentDate.getMonth()]}-${currentDate.getFullYear()} Actual`,
                dataIndex: 'upload_3',
                sorter: (a, b) => a.upload_3 - b.upload_3,
                width: 150,
                align: "right",
                render: text => text ? _.round(text, 2).toFixed(2) : <div style={{color: "#bababa"}}>0.00</div>
              },
              {
                title: `${MonthNames[currentDate.getMonth()]}-${currentDate.getFullYear()} Original Estimate`,
                dataIndex: 'original_estimate',
                sorter: (a, b) => a.original_estimate - b.original_estimate,
                width: 220,
                align: "right",
                render: text => text ? _.round(text, 2).toFixed(2) : <div style={{color: "#bababa"}}>0.00</div>
              },
              {
                title: `${MonthNames[currentDate.getMonth()]}-${currentDate.getFullYear()} Original Estimate VOAR`,
                dataIndex: 'original_estimate_voar',
                sorter: (a, b) => a.original_estimate_voar - b.original_estimate_voar,
                width: 260,
                align: "right",
                render: text => text ? _.round(text, 2).toFixed(2) : <div style={{color: "#bababa"}}>0.00</div>
              },
              {
                title: `${MonthNames[currentDate.getMonth()]}-${currentDate.getFullYear()} Revised Estimate`,
                dataIndex: 'revised_estimate',
                sorter: (a, b) => a.revised_estimate - b.revised_estimate,
                width: 220,
                align: "right",
                render: text => text ? _.round(text, 2).toFixed(2) : <div style={{color: "#bababa"}}>0.00</div>
              },
              {
                title: `${MonthNames[currentDate.getMonth()]}-${currentDate.getFullYear()} Revised Estimate VOAR`,
                dataIndex: 'revised_estimate_voar',
                sorter: (a, b) => a.revised_estimate_voar - b.revised_estimate_voar,
                width: 270,
                align: "right",
                render: text => text ? _.round(text, 2).toFixed(2) : <div style={{color: "#bababa"}}>0.00</div>
              },
            /*   {
                title: () => {
                    return <div onClick={(e) => {
                            if(!editPermission) {
                                e.preventDefault();
                                alert("No Permission");
                            }
                        }}>
                            <Checkbox disabled={!editPermission} onChange={(e) => {
                                if(e.target.checked) {
                                    const filteredIds = _.map(filteredData, item => item.id)
                                    let newData = JSON.parse(JSON.stringify(data));
                                    let newColumnsToUpdate = JSON.parse(JSON.stringify(columnsToUpdate));
                                    _.each(filteredData, item => {
                                        let record = {
                                            ...item, 
                                            selected: true,
                                            am_estimate: item.total_outstanding, 
                                            revised_estimate: item.total_outstanding, 
                                            original_estimate: isFreezed ? item.original_estimate : item.total_outstanding 
                                        };
                                        const ind = _.findIndex(data, itm => itm.id == record.id);
                                        newData[ind] = record;
                                        _.set(newColumnsToUpdate, `${record.id}.am_estimate`, record.total_outstanding)
                                        _.set(newColumnsToUpdate, `${record.id}.revised_estimate`, record.total_outstanding)
                                        _.set(newColumnsToUpdate, `${record.id}.original_estimate`, isFreezed ? record.original_estimate : record.total_outstanding)
                                        setColumnsToUpdate(newColumnsToUpdate);
                                    })
                                    setData(newData);
                                } else {
                                    setData(data.map(item => ({...item, selected: false})))
                                }
                            }} 
                        />
                    </div>
                },
                dataIndex: 'id',
                width: 30,
                render: (text, record) => {
                    if(!record.prevMonth) return "";
                    return <div onClick={(e) => {
                                if(!editPermission) {
                                    e.preventDefault();
                                    alert("No Permission");
                                }
                            }}>
                            <Checkbox disabled={!editPermission} checked={record.selected} onChange={(e) => {
                                if(e.target.checked) {
                                    record = {
                                        ...record, 
                                        selected: true, 
                                        am_estimate: record.total_outstanding, 
                                        revised_estimate: record.total_outstanding, 
                                        original_estimate: isFreezed ? record.original_estimate : record.total_outstanding 
                                    };
                                    setData(data.map(item => item.id == record.id ? record : item))
                                    let newColumnsToUpdate = JSON.parse(JSON.stringify(columnsToUpdate));
                                    _.set(newColumnsToUpdate, `${record.id}.am_estimate`, record.total_outstanding)
                                    _.set(newColumnsToUpdate, `${record.id}.revised_estimate`, record.total_outstanding)
                                    _.set(newColumnsToUpdate, `${record.id}.original_estimate`, isFreezed ? record.original_estimate : record.total_outstanding)
                                    setColumnsToUpdate(newColumnsToUpdate);
                                }
                                else
                                    setData(data.map(item => item.id == record.id ? ({...item, selected: false}) : item))
                                }} 
                            />
                        </div>
                }
              }, */
              {
                title: 'AM projection',
                dataIndex: 'am_projection',
                sorter: (a, b) => a.am_projection - b.am_projection,
                width: 170,
                render: (text, record) => {
                    if(!record.prevMonth) return text;
                    return <div onClick={(e) => {
                                if(!editPermission) {
                                    e.preventDefault();
                                    alert("No Permission");
                                }
                            }}>
                        <Input 
                            className="edit_input am_estimate_input_box" 
                            type="number"
                            value={text} 
                            style={{ background: 'transparent', border: 'none', color: "black", textAlign: "right" }}
                            // disabled={!editPermission}
                            disabled={!editPermission || role == "RM" || role == "BU"}
                            placeholder="0.00"
                            onChange={e => {
                                const val = e.target.value;
                                if((val.split(".")[1] || "").length > 2) return;
                                const valToShow = _.maxBy([val, record.rm_projection, record.bu_projection], parseFloat);
                                const voarPer = (_.find(voarData, x => x.bu == record.business && x.services == record.service) || {}).percentage || 0;
                                record = { ...record, 
                                    am_projection: val, 
                                    revised_estimate: valToShow, 
                                    original_estimate: isFreezed ? record.original_estimate : valToShow,
                                    revised_estimate_voar: valToShow * voarPer / 100,
                                    original_estimate_voar: isFreezed ? record.original_estimate_voar : valToShow * voarPer / 100,
                                }
                                setData(data.map(item => item.id == record.id ? record : item));
                                let newColumnsToUpdate = JSON.parse(JSON.stringify(columnsToUpdate));
                                _.set(newColumnsToUpdate, `${record.id}.am_projection`, val)
                                _.set(newColumnsToUpdate, `${record.id}.revised_estimate`, valToShow)
                                _.set(newColumnsToUpdate, `${record.id}.original_estimate`, isFreezed ? record.original_estimate : valToShow)
                                _.set(newColumnsToUpdate, `${record.id}.revised_estimate_voar`,  valToShow * voarPer / 100)
                                _.set(newColumnsToUpdate, `${record.id}.original_estimate_voar`, isFreezed ? record.original_estimate :  valToShow * voarPer / 100)
                                setColumnsToUpdate(newColumnsToUpdate);
                            }}
                        />
                    </div>;
                }
              },
              {
                title: 'RM projection',
                dataIndex: 'rm_projection',
                sorter: (a, b) => a.rm_projection - b.rm_projection,
                width: 170,
                render: (text, record) => {
                    if(!record.prevMonth) return text;
                    return <div onClick={(e) => {
                                if(!editPermission) {
                                    e.preventDefault();
                                    alert("No Permission");
                                }
                            }}>
                        {(role == "RM" && !text && record.am_projection) && <div style={{position: "absolute", top: 0, left: 10, zIndex: 1000}} class="text-danger">*</div>}
                        <Input 
                            className="edit_input am_estimate_input_box" 
                            type="number"
                            value={role == "RM" ? (parseFloat(text) > 0 ? text : record.am_projection) : text}
                            style={{ background: 'transparent', border: 'none', color: "black", textAlign: "right" }}
                            // disabled={!editPermission}
                            disabled={!editPermission || role == "BU"}
                            placeholder="0.00"
                            onChange={e => {
                                const val = e.target.value;
                                if((val.split(".")[1] || "").length > 2) return;
                                const valToShow = _.maxBy([val, record.am_projection, record.bu_projection], parseFloat);
                                const voarPer = (_.find(voarData, x => x.bu == record.business && x.services == record.service) || {}).percentage || 0;
                                console.log(voarData, voarPer);
                                record = {
                                    ...record, 
                                    rm_projection: val, 
                                    revised_estimate: valToShow, 
                                    original_estimate: isFreezed ? record.original_estimate : valToShow,
                                    revised_estimate_voar: valToShow * voarPer / 100,
                                    original_estimate_voar: isFreezed ? record.original_estimate_voar : valToShow * voarPer / 100,
                                }
                                setData(data.map(item => item.id == record.id ? record : item));
                                let newColumnsToUpdate = JSON.parse(JSON.stringify(columnsToUpdate));
                                _.set(newColumnsToUpdate, `${record.id}.rm_projection`, val)
                                _.set(newColumnsToUpdate, `${record.id}.revised_estimate`, valToShow)
                                _.set(newColumnsToUpdate, `${record.id}.original_estimate`, isFreezed ? record.original_estimate : valToShow)
                                _.set(newColumnsToUpdate, `${record.id}.revised_estimate_voar`,  valToShow * voarPer / 100)
                                _.set(newColumnsToUpdate, `${record.id}.original_estimate_voar`, isFreezed ? record.original_estimate :  valToShow * voarPer / 100)
                                setColumnsToUpdate(newColumnsToUpdate);
                            }}
                        />
                    </div>;
                }
              },
              {
                title: 'BU projection',
                dataIndex: 'bu_projection',
                sorter: (a, b) => a.bu_projection - b.bu_projection,
                width: 170,
                render: (text, record) => {
                    if(!record.prevMonth) return text;
                    return <div onClick={(e) => {
                                if(!editPermission) {
                                    e.preventDefault();
                                    alert("No Permission");
                                }
                            }}>
                        {(role == "BU" && !text && record.rm_projection) && <div style={{position: "absolute", top: 0, left: 10, zIndex: 1000}} class="text-danger">*</div>}
                        <Input 
                            className="edit_input am_estimate_input_box" 
                            type="number"
                            value={role == "BU" ? (parseFloat(text) > 0 ? text : record.rm_projection) : text}
                            style={{ background: 'transparent', border: 'none', color: "black", textAlign: "right" }}
                            disabled={!editPermission}
                            placeholder="0.00"
                            onChange={e => {
                                const val = e.target.value;
                                if((val.split(".")[1] || "").length > 2) return;
                                const valToShow = _.maxBy([val, record.rm_projection, record.am_projection], parseFloat);
                                const voarPer = (_.find(voarData, x => x.bu == record.business && x.services == record.service) || {}).percentage || 0;
                                record = {
                                    ...record, 
                                    bu_projection: val, 
                                    revised_estimate: valToShow, 
                                    original_estimate: isFreezed ? record.original_estimate : valToShow,
                                    revised_estimate_voar: valToShow * voarPer / 100,
                                    original_estimate_voar: isFreezed ? record.original_estimate_voar : valToShow * voarPer / 100,
                                }
                                setData(data.map(item => item.id == record.id ? record : item));
                                let newColumnsToUpdate = JSON.parse(JSON.stringify(columnsToUpdate));
                                _.set(newColumnsToUpdate, `${record.id}.bu_projection`, val)
                                _.set(newColumnsToUpdate, `${record.id}.revised_estimate`, valToShow)
                                _.set(newColumnsToUpdate, `${record.id}.original_estimate`, isFreezed ? record.original_estimate : valToShow)
                                _.set(newColumnsToUpdate, `${record.id}.revised_estimate_voar`,  valToShow * voarPer / 100)
                                _.set(newColumnsToUpdate, `${record.id}.original_estimate_voar`, isFreezed ? record.original_estimate :  valToShow * voarPer / 100)
                                setColumnsToUpdate(newColumnsToUpdate);
                            }}
                        />
                    </div>;
                }
              },
              {
                title: 'Assumptions AM',
                dataIndex: 'assumption_am',
                sorter: (a, b) => (a.assumption_am || "").localeCompare(b.assumption_am || ""),
                width: 250,
                render: (text, record) => {
                    if(!record.prevMonth) return text;
                    return <div  onClick={(e) => {
                                if(!editPermission) {
                                    e.preventDefault();
                                    alert("No Permission");
                                }
                            }}>
                        <Input.TextArea
                            className="edit_input textarea"
                            // disabled={!editPermission || role != "AM"}
                            defaultValue={text} 
                            style={{ background: 'transparent', border: 'none',color: "black" }} 
                            onChange={(e) => {
                                const val = e.target.value;
                                let newColumnsToUpdate = JSON.parse(JSON.stringify(columnsToUpdate));
                                _.set(newColumnsToUpdate, `${record.id}.assumption_am`, val)
                                setColumnsToUpdate(newColumnsToUpdate);
                            }} />
                    </div>;
                }
              },
              role != "AM" ? {
                title: 'Assumptions RM',
                dataIndex: 'assumption_rm',
                sorter: (a, b) => (a.assumption_rm || "").localeCompare(b.assumption_rm || ""),
                width: 250,
                render: (text, record) => {
                    if(!record.prevMonth) return text;
                    return <div  onClick={(e) => {
                                if(!editPermission) {
                                    e.preventDefault();
                                    alert("No Permission");
                                }
                            }}>
                        <Input.TextArea 
                            className="edit_input textarea"
                            // disabled={!editPermission || role != "RM"}
                            defaultValue={text} 
                            style={{ background: 'transparent', border: 'none',color: "black" }} 
                            onChange={(e) => {
                                const val = e.target.value;
                                let newColumnsToUpdate = JSON.parse(JSON.stringify(columnsToUpdate));
                                _.set(newColumnsToUpdate, `${record.id}.assumption_rm`, val)
                                setColumnsToUpdate(newColumnsToUpdate);
                            }} />
                    </div>;
                }
              } : null,
              (role != "AM" && role != "RM") ? {
                title: 'Assumptions BU',
                dataIndex: 'assumption_bu',
                sorter: (a, b) => (a.assumption_bu || "").localeCompare(b.assumption_bu || ""),
                width: 250,
                render: (text, record) => {
                    if(!record.prevMonth) return text;
                    return <div  onClick={(e) => {
                                if(!editPermission) {
                                    e.preventDefault();
                                    alert("No Permission");
                                }
                            }}>
                        <Input.TextArea 
                            className="edit_input textarea"
                            // disabled={!editPermission || role != "BU"}
                            defaultValue={text} 
                            style={{ background: 'transparent', border: 'none',color: "black" }} 
                            onChange={(e) => {
                                const val = e.target.value;
                                let newColumnsToUpdate = JSON.parse(JSON.stringify(columnsToUpdate));
                                _.set(newColumnsToUpdate, `${record.id}.assumption_bu`, val)
                                setColumnsToUpdate(newColumnsToUpdate);
                            }} />
                    </div>;
                }
              } : null
            ].filter(Boolean);
            
            function onChange(pagination, filters, sorter, extra) {
                console.log('params', pagination, filters, sorter, extra);
                console.log(extra.currentDataSource);
                setFilteredData(extra.currentDataSource);
                $("#total-abp").text(_.round(_.sumBy(extra.currentDataSource, x => parseFloat(x.target_amount || "0")), 2).toFixed(2));
                $("#actuals").text(_.round(_.sumBy(extra.currentDataSource, x => parseFloat(x.actual || "0")), 2).toFixed(2));
                $("#revised-estimate").text(_.round(_.sumBy(extra.currentDataSource, x => parseFloat(x.revised_estimate || "0")), 2).toFixed(2));
                $("#last-month-actuals").text(_.round(_.sumBy(extra.currentDataSource, x => parseFloat(x.upload_2 || "0")), 2).toFixed(2));
		const toShowRole = (role == "RM" || role == "BU") ? role : "AM";
		$("#total-am-projection").parent().parent().children().first().children().last().html(`Total ${toShowRole} projection`);
                if(role == "RM")
			$("#total-am-projection").text(_.round(_.sumBy(extra.currentDataSource, x => parseFloat(x.rm_projection || "0")), 2).toFixed(2));
                else if(role == "BU")
			$("#total-am-projection").text(_.round(_.sumBy(extra.currentDataSource, x => parseFloat(x.bu_projection || "0")), 2).toFixed(2));
		else	
			$("#total-am-projection").text(_.round(_.sumBy(extra.currentDataSource, x => parseFloat(x.am_projection || "0")), 2).toFixed(2));
                $(window).unbind('wheel');
                $(".ant-table-body").animate({ scrollTop: 0 }, 0);
                $("#custom-scrollbar").css({ top: 64 })
                setTimeout(function() {
                    $(window).on("wheel", function(e) {
                        const totalHeight = $(".ant-table-body")[0].scrollHeight - $(".ant-table-body")[0].clientHeight;
                        const currentHeight = $(".ant-table-body").scrollTop();
                        const current = currentHeight + e.originalEvent.deltaY;
                        $(".ant-table-body").animate({ scrollTop: current }, 0);
                        $("#custom-scrollbar").css({ top: 64 + (currentHeight / totalHeight) * (window.innerHeight - 164) })
                    });
                }, 10);
            }
            
            const fetchData = () => {
                fetch("revenue_data_fetch.php")
                    .then(res => res.json())
                    .then(res => {
                        const updatedData = _.map(res.data, x => {
                            const prevDate = new Date(x.month);
                            const newDate = new Date();
                            x["prevMonth"] = (prevDate.getMonth() == newDate.getMonth()) && (prevDate.getYear() == newDate.getYear());
                            return x;
                        });
                        // console.log(updatedData);
                        setFilteredData(res.data);
                        setWholeData(res.data);
                        setData(res.data);
                        const dt = `${MonthNames[currentDate.getMonth()]}-${currentDate.getFullYear()}`;
                        // console.log(dt);
                        let newColumnsToUpdate = JSON.parse(JSON.stringify({}));
                         _.forEach(res.data, x => {
                            if(x.month != dt) return;
                            if(role == "BU")  {
                                if(!x.bu_projection && parseFloat(x.rm_projection) > 0)
                                    _.set(newColumnsToUpdate, `${x.id}.bu_projection`, x.rm_projection)
                            }
                            if(role == "RM")  {
                                if(!x.rm_projection && parseFloat(x.am_projection) > 0)
                                    _.set(newColumnsToUpdate, `${x.id}.rm_projection`, x.am_projection)
                            }

                        });
                        console.log('newColumnsToUpdate');
                        console.log(newColumnsToUpdate);
                        setColumnsToUpdate(newColumnsToUpdate);
                        setEditPermission(res.edit_permission);
                        setHistoryPermission(res.history_permission);
                        setLoading(false);
                        setIsFreezed(res.is_freezed);
                        if(!res.import_permission) {
                            // $("#import-acfa").attr("disabled", true);
                            $("#import-acfa").css({"cursor": "no-drop", "pointer-events": "unset"});
                            $("#import-acfa").removeAttr("onClick");
                            $("#import-acfa").on("click", function (e) { alert("No permission"); e.preventDefault(); });
                        }   
                        if(!res.export_permission) {
                            // $("#export-acfa").attr("disabled", true);
                            $("#export-acfa").css({"cursor": "no-drop", "pointer-events": "unset"});
                            $("#export-acfa").removeAttr("onClick");
                            $("#export-acfa").parent().on("click", function (e) { alert("No permission"); e.preventDefault(); });
                        }
                        $("#total-abp").text(_.round(_.sumBy(res.data, x => x.month == dt ? parseFloat(x.target_amount || "0") : 0), 2).toFixed(2));
                        $("#actuals").text(_.round(_.sumBy(res.data, x => x.month == dt ? parseFloat(x.actual || "0") : 0), 2).toFixed(2));
                        $("#revised-estimate").text(_.round(_.sumBy(res.data, x => x.month == dt ? parseFloat(x.revised_estimate || "0") : 0), 2).toFixed(2));
                        $("#last-month-actuals").text(_.round(_.sumBy(res.data, x => x.month == dt ? parseFloat(x.upload_2 || "0") : 0), 2).toFixed(2));
                        $("#total-am-projection").text(_.round(_.sumBy(res.data, x => x.month == dt ? parseFloat(x.am_projection || "0") : 0), 2).toFixed(2));
			
			const toShowRole = (role == "RM" || role == "BU") ? role : "AM";
           
			$("#total-am-projection").parent().parent().children().first().children().last().html(`Total ${toShowRole} projection`);
			if(role == "RM")
				$("#total-am-projection").text(_.round(_.sumBy(res.data, x => parseFloat(x.rm_projection || "0")), 2).toFixed(2));
                	else if(role == "BU")
				$("#total-am-projection").text(_.round(_.sumBy(res.data, x => parseFloat(x.bu_projection || "0")), 2).toFixed(2));
			else if(role == "AM")	
				$("#total-am-projection").text(_.round(_.sumBy(res.data, x => parseFloat(x.am_projection || "0")), 2).toFixed(2));
                    });
                setColumnsToShow(columns.map(x => _.includes(["month", "ecnc", "category","service","upload_1", "upload_2", "target_amount", "a_v_target_amount", "upload_3", "original_estimate", "original_estimate_voar", "revised_estimate", "revised_estimate_voar"], x.dataIndex) ? null : x.dataIndex).filter(Boolean));

            }
            
            useEffect(() => {
                fetchData();
            }, []);
            
            const filter = (e) => {
                const val = _.lowerCase(e.target.value);
                if(val)
                    setData(
                        wholeData.filter(item => {
                            return _.lowerCase(item.month).startsWith(val) ||
                                _.lowerCase(item.classification).startsWith(val) ||
                                _.lowerCase(item.account).startsWith(val) ||
                                _.lowerCase(item.bu).startsWith(val) ||
                                _.lowerCase(item.profit_center).startsWith(val) ||
                                _.lowerCase(item.payer_code).startsWith(val) ||
                                _.lowerCase(item.client_name).startsWith(val) ||
                                _.lowerCase(item.assumptions).startsWith(val)
                        })
                    );
                else
                    setData(wholeData);
            }
            
            const menu = () => {
                return (
                  <Menu className="pl-2" onClick={(e) => e.preventDefault}>
                    {columns.filter(x => {
                        if(role == "AM")
                            return x.dataIndex != "bu_projection" && x.dataIndex != "rm_projection"
                        else if(role == "RM")
                            return x.dataIndex != "bu_projection" && x.dataIndex != "am_projection"
                        else if(role == "BU")
                            return x.dataIndex != "am_projection" && x.dataIndex != "rm_projection"
                        return x.dataIndex != "id"
                    }).map(column => (
                        <div key={column.dataIndex}>
                            <Checkbox 
                                checked={_.includes(columnToShow, column.dataIndex)}
                                disabled={!_.includes(["month", "ecnc", "category", "service", "upload_1", "upload_2", "target_amount", "a_v_target_amount", "upload_3", "original_estimate", "original_estimate_voar", "revised_estimate", "revised_estimate_voar"], column.dataIndex)}
                                onChange={e => {
                                    if(e.target.checked) 
                                        setColumnsToShow([
                                            ...columnToShow, 
                                            column.dataIndex
                                        ])
                                    else
                                        setColumnsToShow(_.filter(columnToShow, x => {
                                            if(column.dataIndex == "am_estimate")
                                                return x != "id" && x != "am_estimate"
                                            else
                                                return x != column.dataIndex
                                        }))
                                }}
                            >
                                {column.title}
                            </Checkbox>
                        </div>
                    ))}
                  </Menu>
                );
            }
            
            const historyColumns = [
                {
                    title: "Updated By",
                    dataIndex: "modified_by"
                },
                {
                    title: "Updated On",
                    dataIndex: "modified_date"
                },
                {
                    title: "Previous Value",
                    dataIndex: "previous_value"
                },
                {
                    title: "Updated Value",
                    dataIndex: "current_value"
                },
            ]
            // original code
            // const subcolumns = columns.filter(x => {
            //                 if(role == "AM")
            //                     return x.dataIndex != "bu_projection" && x.dataIndex != "rm_projection"
            //                 else if(role == "RM")
            //                     return x.dataIndex != "bu_projection" && x.dataIndex != "am_projection"
            //                 else if(role == "BU")''
            //                     return x.dataIndex != "am_projection" && x.dataIndex != "rm_projection"
            //                 return true
            //             });
                // harshad code
            const subcolumns = columns.filter(x => {
                            if(role == "AM")
                                return x.dataIndex != "bu_projection" && x.dataIndex != "rm_projection"
                            else if(role == "RM")
                                return x.dataIndex != "bu_projection"
                            // else if(role == "BU")''
                            //     return x.dataIndex != "am_projection" && x.dataIndex != "rm_projection"
                            return true
                        });
            return (<div style={{position: "relative"}}>
                <div style={{ width: "20%", float: "right", zIndex: 200 }}> 
                    <Input placeholder="⌕ Search" onChange={filter} style={{ height: 40 }} />
                </div>
                <div style={{float: "right"}}>
                      <button disabled={
                          _.size(_.filter(data, x => ((x.selected && x.prevMonth) || 
                          _.includes(_.keys(columnsToUpdate), x.id)))) == 0
                        }
                        className="btn btn-primary user-btn mr-2"
                        onClick={() => {
                            const filteredData = _.filter(data, x => ((x.selected && x.prevMonth) || _.includes(_.keys(columnsToUpdate), x.id)));
                            Modal.confirm({
                                title: `Want to update ${filteredData.length} rows?`,
                                onOk: () => {
                                    let newData = JSON.parse(JSON.stringify(data));;
                                    _.each(filteredData, item => {
                                        if(!item.prevMonth) return;
                                        let record = {...item, selected: false, am_estimate: item.total_outstanding, revised_estimate: item.total_outstanding};
                                        record["original_estimate"] = isFreezed ? item["original_estimate"] : item.total_outstanding;
                                        const ind = _.findIndex(data, itm => itm.id == record.id);
                                        newData[ind] = record;
                                        updateValueInDB(record.am_estimate, "am_estimate", record.id, true);
                                        updateValueInDB(record.revised_estimate, "revised_estimate", record.id, true);
                                        updateValueInDB(record.original_estimate, "original_estimate", record.id, true);
                                    })
                                    // setData(newData);
                                    updateMultipleValueInDB();
                                    // fetchData();
                                }
                            })
                      }}>
                        Update Values
                      </button>
                      {role == "ADMIN" && <a href="error_log_export.php"><button className="btn btn-primary user-btn mr-2">Export Error Log</button></a>}
                      {<a href="revenue_export"><button className="btn btn-primary user-btn mr-2">Export Revenue</button></a>}
                      {role == "ADMIN" && <a href="sap-dump?upload_revenue=yes"><button className="btn btn-primary user-btn mr-2">Upload revenue file</button></a>}
                      <Dropdown overlay={menu} trigger={['click']}>
                        <button className="btn btn-primary user-btn mr-2">
                            Select Columns
                        </button>
                      </Dropdown>
                      
                     {/* <form method="post" action="exportsaprevenue.php" style={{display: 'inline'}}>
						<input type="submit" id='download-revenue' name="exportsaprevenue" className="btn btn-primary user-btn mr-2" value="Download Revenue SAP Dump" />
					  </form>
    				  <div className="dropbtn btn btn-primary user-btn mr-2" onClick={() => $("#revenueuploadModal").show()} style={{color:'white'}}>Upload Revenue SAP Dump</div>*/}
    				  
                </div>
                <div className="table-wrapper">
                    <Table 
                        size="small" 
                        loading={loading}
                        columns={columnToShow == 'all' ? subcolumns : subcolumns.filter(x => _.includes(columnToShow, x.dataIndex))} 
                        dataSource={data} 
                        rowKey="id"
                        pagination={{
                            defaultPageSize: 50, 
                            showSizeChanger: true, 
                            showQuickJumper: true, 
                            showTotal: (total, range) => <div style={{float: "left"}}>{range[0]}-{range[1]} of {total} items</div>,
                            pageSizeOptions: ['10', '25', '50', '100'],
                            position: ["topLeft", "bottomRight"]
                        }} 
                        onChange={onChange}
                        scroll={{ x: 1300, y: 330 }}
                        //  footer={() => (
                        //     <div style={{paddingBottom: "15px", height: "20px", background: "#fafafa"}}>
                        //         <div style={{float: "left"}}>Total</div>
                        //         <div style={{float: "right", display: "flex"}}>
                        //             <div className="mr-4"><b>Total Outstanding</b> - {_.round(_.sumBy(filteredData, x => parseFloat(x.total_outstanding || "0")), 5)}</div>
                        //             <div className="mr-4"><b>Original Estimate</b> - {_.round(_.sumBy(filteredData, x => parseFloat(x.original_estimate || "0")), 5)}</div>
                        //             <div className="mr-4"><b>Revised Estimate</b> - {_.round(_.sumBy(filteredData, x => parseFloat(x.revised_estimate || "0")), 5)}</div>
                        //             <div className="mr-4"><b>Actual Collection F&A</b> - {_.round(_.sumBy(filteredData, x => parseFloat(x.actual_collection_f_a || "0")), 5)}</div>
                        //             <div className="mr-4"><b>AM Estimate</b> - {_.round(_.sumBy(filteredData, x => parseFloat(x.am_estimate || "0")), 5)}</div>
                        //         </div>
                        //     </div>
                        // )}
                        rowClassName="xyz"
                        expandable={{
                            expandedRowRender: (record) => {
                                console.log(record.history);
                                return <div>
                                    <div className="mb-1">Modified {_.size(record.history)} times.</div>
                                    <Table columns={historyColumns} dataSource={record.history} pagination={true} rowKey="id" />
                                </div>
                            },
                            rowExpandable: record => historyPermission && record.history
                        }}
                    />
                    
                </div>
            </div>
            )
        }
        
        ReactDOM.render(<DataTable />, document.getElementById('mydiv'))
    </script>
    <script type="text/javascript">
        function openFile() {
			$("#doc").click();
			$("#doc").on("change", function() {
				$("#fileUploadFormButton").click();
			})
		}
		function auto_grow(element) {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight)+"px";
        }
        $(document).ready(function() {
            setTimeout(function() {
                $(window).on("wheel", function(e) {
                    const totalHeight = $(".ant-table-body")[0].scrollHeight - $(".ant-table-body")[0].clientHeight;
                    const currentHeight = $(".ant-table-body").scrollTop();
                    current = currentHeight + e.originalEvent.deltaY;
                    $(".ant-table-body").animate({ scrollTop: current }, 0);
                    $("#custom-scrollbar").css({ top: 64 + (currentHeight / totalHeight) * (window.innerHeight - 164) })
                });
            }, 10)
        })
        
        var dragItem = document.querySelector("#custom-scrollbar");
        var container = window;

        var active = false;
        var currentX;
        var currentY;
        var initialX;
        var initialY;
        var xOffset = 0;
        var yOffset = 0;
    
        container.addEventListener("touchstart", dragStart, false);
        container.addEventListener("touchend", dragEnd, false);
        container.addEventListener("touchmove", drag, false);
    
        container.addEventListener("mousedown", dragStart, false);
        container.addEventListener("mouseup", dragEnd, false);
        container.addEventListener("mousemove", drag, false);
    
        function dragStart(e) {
          if (e.type === "touchstart") {
            initialY = e.touches[0].clientY - yOffset;
          } else {
            initialY = e.clientY - yOffset;
          }
          if (e.target === dragItem) {
            active = true;
          }
        }
    
        function dragEnd(e) {
          initialY = currentY;
    
          active = false;
        }
    
        function drag(e) {
          if (active) {
            e.preventDefault();
            if (e.type === "touchmove") {
              currentY = e.touches[0].clientY - initialY;
            } else {
              currentY = e.clientY - initialY;
            }
            yOffset = currentY;
            if(currentY < 64) return;
            if(currentY > window.innerHeight - 100) return;
            setTranslate(currentY, dragItem);
          }
        }
    
        function setTranslate(yPos, el) {
          el.style.top = yPos + "px";
          $(".ant-table-body").animate({ scrollTop: (yPos / (window.innerHeight - 100)) * $(".ant-table-body")[0].scrollHeight }, 0);
        }
    </script>
    <!-- <script>
            $(document).on('click', '.export_revenue_button', function(){
                var column_names = localStorage.getItem('column_names');
                var page='revenue_export.php';
                $.ajax({
                    type: "post",
                    url: page,
                    data: {
                        column_names: column_names
                    },
                    // dataType: 'json',
                    success: function(result) {
                        if(result == 'no_data'){
                            alert("No data available for download");
                            return;
                        }
                        else{
                            window.open(page);
                        }
                    }
                })
            });

    </script> -->
    <?php
    
// 		require_once("./importacfa-revenue.php");
		if(isset($_POST['importsaprevenue'])){
        	require_once("./importsaprevenue.php");
        }
	?>
	
  </body>
</html>
