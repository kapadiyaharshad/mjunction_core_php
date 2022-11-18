<!DOCTYPE html>
<html>
    <head>
	<title>Collection</title>
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
	<!--<link rel="stylesheet" href="./css/collections.css">-->

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
        
        .user-btn:hover {
            border-color: #7367F0 !important;
        	box-shadow: 0 8px 25px -8px #7367f0;
        }
        .edit_input{
            border: 1px solid black !important;
        }
        .edit_input {
            border: 1px solid lightgrey !important;
            background-color: white !important;
        }
        .edit_input:hover {
            border: 1px solid black !important;
        }
        .textarea{
            resize: none;
            overflow: hidden;
        }
        textarea.ant-input{
            /*height: 25px ;*/
            /*min-height: 25px ;*/
            margin-top: 5px !important;
            margin-bottom: 5px !important;
        }   
	    tbody tr {
	        background-color: rgba(153, 144, 244, 0.2) !important;
	    }
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
	    .edit_input{
            border: 1px solid black !important;
            padding: 0px 0px 0px 0px !important;
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
	    .am_estimate_input_box{
	        padding-top: 2.5px !important;
            	padding-bottom: 2.5px !important;
	    }
    </style>
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
		TopBar('collections'); 
		else
		nTopBar('home');
		?>
		<span id="role" data-role="<?= $_COOKIE['type'] ?>" />
		<div class="content">
		        <div id="custom-scroll">
    		        <div id="custom-scrollbar"></div>
		        </div>
			    <div class="graph-card mx-2 mt-5 p-3">
					<div class="d-flex justify-content-around flex-wrap">
						<div class="d-flex justify-content-center align-items-center stat-item" style="color:#7367F0;font-size:20px;font-weight:bold">
						    <i class="fas fa-sticky-note">&nbsp;&nbsp;&nbsp;&nbsp;</i>
							<div class="stat-icon stat-blue mr-3">
								<div style="font-weight:bold" class="stat-name">Collections Details :</div>
							</div>
						</div>
						<div class="d-flex justify-content-center align-items-center stat-item" style="color:lightgrey;">
						    <i class="fas fa-chart-line">&nbsp;&nbsp;&nbsp;&nbsp;</i>
							<div class="stat-icon stat-blue mr-3">
								<div style="font-weight:bold" class="stat-name">Total Outstanding :</div>
								<!--<i class="fas fa-chart-line"></i>-->
							</div>
							<div>
								<div style="font-weight:bold; color:grey; font-size:19px" class="stat-value" id="total-filtered">0.00</div>
								<!--<div class="stat-value">Total: <span id="total-original">100</span></div>-->
							</div>
						</div>
						<div class="d-flex justify-content-center align-items-center stat-item" style="color:lightgrey;">
						    <i class="fas fa-chart-line">&nbsp;&nbsp;&nbsp;&nbsp;</i>
							<div class="stat-icon stat-blue mr-3">
								<div style="font-weight:bold" class="stat-name">Original Estimate :</div>
								<!--<i class="fas fa-chart-line"></i>-->
							</div>
							<div>
							    <div style="font-weight:bold; color:grey; font-size:19px" class="stat-value" id="original-filtered">0.00</div>
							    <!--<div class="stat-value">Total: <span id="original-original">100</span></div>-->
							</div>
						</div>
						<div class="d-flex justify-content-center align-items-center stat-item" style="color:lightgrey;">
						    <i class="fas fa-chart-line">&nbsp;&nbsp;&nbsp;&nbsp;</i>
							<div class="stat-icon stat-blue mr-3">
								<div style="font-weight:bold" class="stat-name">Revised Estimate :</div>
								<!--<i class="fas fa-chart-line"></i>-->
							</div>
							<div>
							    <div style="font-weight:bold; color:grey; font-size:19px" class="stat-value" id="revised-filtered">0.00</div>
							    <!--<div class="stat-value">Total: <span id="revised-original">100</span></div>-->
							</div>
						</div>
						<div class="d-flex justify-content-center align-items-center stat-item" style="color:lightgrey;">
						    <i class="fas fa-chart-line">&nbsp;&nbsp;&nbsp;&nbsp;</i>
							<div class="stat-icon stat-blue mr-3">
								<div style="font-weight:bold" class="stat-name">Actual Collection F & A :</div>
								<!--<i class="fas fa-chart-line"></i>-->
							</div>
							<div>
							    <div style="font-weight:bold; color:grey; font-size:19px" class="stat-value" id="actual-filtered">0</div>
							    <!--<div class="stat-value">Total: <span id="actual-original">100</span></div>-->
							</div>
						</div>
					</div>
				</div>
			<div class="padded">
				<div class="graph-card mx-2 mt-4 p-4">
					<div class="d-flex justify-content-center header-wrapper">
					    <!--<div class="card-title">-->
					        <!--<h2>Collection Details</h2></div>-->
					    	
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
            const [columnsToUpdate, setColumnsToUpdate] = useState({});
            const role = $('#role').data('role');
            
            useEffect(() => {
                console.log(JSON.stringify(columnsToUpdate));
                $(window).unbind('beforeunload');
                $(window).bind('beforeunload', function () {
                    if(!_.isEmpty(columnsToUpdate))
                    return 'please save your setting before leaving the page.';
                });
            }, [columnsToUpdate]);
                
            const filterList = (column, fix=false) => {
                return _.uniqBy(_.map(filteredData, item => ({text: fix ? _.round(item[column], 2).toFixed(2) : item[column], value: item[column]})), x => fix ? _.round(x.value, 2).toFixed(2) : x.value)
            }
            
            const updateMultipleValueInDB=() => {
                $.ajax({
                    type: "POST",
            	    url: './update-multiple-connections.php',
    			    data: { rows: columnsToUpdate },
    			    success:function(html) {
    			        fetchData();
                    	console.log(html);
                	}
            	});
            }
            
            const updateValueInDB=(value, name, id, isCopied = false) => {
                const body = _.set({}, `${id}.${name}`, value);
                if(isCopied) {
                    $.ajax({
                        type: "POST",
                	    url: './update-multiple-connections.php',
        			    data: { rows: body },
        			    success:function(html) {
                    	    console.log(html);
                	    }
            	    });
                } else {
                    Modal.confirm({
                        title: "Update Value?",
                        okButtonProps: { className: "btn btn-primary user-btn" },
                        onOk: () => {
                            $.ajax({
                    		    type: "POST",
                        	    url: './update-multiple-connections.php',
                			    data: { rows: body },
                			    success:function(html) {
                    			    console.log(html);
                    			    setColumnsToUpdate({});
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
                title: 'Classification',
                dataIndex: 'classification',
                sorter: (a, b) => (a.classification || "").localeCompare(b.classification || ""),
                filters: filterList("classification"),
                onFilter: (value, record) => record.classification === value,
                width: 130
              },
              {
                title: 'Account',
                dataIndex: 'account',
                sorter: (a, b) => (a.account || "").localeCompare(b.account || ""),
                filters: filterList("account"),
                onFilter: (value, record) => record.account === value,
                width: 120
              },
              {
                title: 'BU',
                dataIndex: 'bu',
                sorter: (a, b) => (a.bu || "").localeCompare(b.bu || ""),
                filters: filterList("bu"),
                onFilter: (value, record) => record.bu === value,
                width: 100
              },
              {
                title: 'Profit Center',
                dataIndex: 'profit_center',
                sorter: (a, b) => a.profit_center - b.profit_center,
                filters: filterList("profit_center"),
                onFilter: (value, record) => record.profit_center === value,
                width: 150,
                align: 'right'
              },
              {
                title: 'Payer Code',
                dataIndex: 'payer_code',
                sorter: (a, b) => a.payer_code - b.payer_code,
                filters: filterList("payer_code"),
                onFilter: (value, record) => record.payer_code === value,
                width: 150,
                align: 'right'
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
                title: 'Total Outstanding',
                dataIndex: 'total_outstanding',
                sorter: (a, b) => a.total_outstanding - b.total_outstanding,
                filters: filterList("total_outstanding", true),
                onFilter: (value, record) => record.total_outstanding === value,
                render: text => _.round(text, 2).toFixed(2),
                align: "right",
                width: 190
              },              
              {
                title: 'SAP Ref number',
                dataIndex: 'sap_ref_number',
                sorter: (a, b) => (a.sap_ref_number || "").localeCompare(b.sap_ref_number || ""),
                filters: filterList("sap_ref_number"),
                onFilter: (value, record) => record.sap_ref_number === value,
                width: 200
              }, 
              {
                title: 'Invoice Number',
                dataIndex: 'invoice_number',
                sorter: (a, b) => (a.invoice_number || "").localeCompare(b.invoice_number || ""),
                filters: filterList("invoice_number"),
                onFilter: (value, record) => record.invoice_number === value,
                width: 200
              }, 
              {
                title: 'Bucket',
                dataIndex: 'bucket',
                sorter: (a, b) => (a.bucket || "").localeCompare(b.bucket || ""),
                filters: filterList("bucket"),
                onFilter: (value, record) => record.bucket === value,
                width: 100
              },
              {
                title: 'Original Estimate',
                dataIndex: 'original_estimate',
                sorter: (a, b) => a.original_estimate - b.original_estimate,
                width: 160,
                align: "right",
                render: text => text ? _.round(text, 2).toFixed(2) : <div style={{color: "#bababa"}}>0.00</div>
              },
              {
                title: 'Revised Estimate',
                dataIndex: 'revised_estimate',
                sorter: (a, b) => a.revised_estimate - b.revised_estimate,
                width: 160,
                align: "right",
                render: text => text ? _.round(text, 2).toFixed(2) : <div style={{color: "#bababa"}}>0.00</div>
              },                         
              {
                title: 'Actual Collection F & A',
                dataIndex: 'actual_collection_f_a',
                sorter: (a, b) => a.actual_collection_f_a - b.actual_collection_f_a,
                width: 200,
                align: "right",
                render: text => text ? _.round(text, 2).toFixed(2) : <div style={{color: "#bababa"}}>0.00</div>
              },
               {
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
                                            am_estimate: item.total_outstanding < 0 ? 0 : _.round(item.total_outstanding, 2).toFixed(2), 
                                            revised_estimate: item.total_outstanding < 0 ? 0 : _.round(item.total_outstanding, 2).toFixed(2), 
                                            original_estimate: isFreezed ? item.original_estimate : (item.total_outstanding < 0 ? 0 : _.round(item.total_outstanding, 2).toFixed(2) )
                                        };
                                        const ind = _.findIndex(data, itm => itm.id == record.id);
                                        newData[ind] = record;
                                        _.set(newColumnsToUpdate, `${record.id}.am_estimate`, item.total_outstanding < 0 ? 0 : _.round(record.total_outstanding, 2).toFixed(2))
                                        _.set(newColumnsToUpdate, `${record.id}.revised_estimate`, item.total_outstanding < 0 ? 0 : _.round(record.total_outstanding, 2).toFixed(2))
                                        _.set(newColumnsToUpdate, `${record.id}.original_estimate`, isFreezed ? record.original_estimate : (item.total_outstanding < 0 ? 0 : _.round(record.total_outstanding, 2).toFixed(2)))
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
                                        am_estimate: record.total_outstanding < 0 ? 0 : _.round(record.total_outstanding, 2).toFixed(2), 
                                        revised_estimate: record.total_outstanding < 0 ? 0 : _.round(record.total_outstanding, 2).toFixed(2), 
                                        original_estimate: isFreezed ? record.original_estimate : (record.total_outstanding < 0 ? 0 : _.round(record.total_outstanding, 2).toFixed(2) )
                                    };
                                    setData(data.map(item => item.id == record.id ? record : item))
                                    let newColumnsToUpdate = JSON.parse(JSON.stringify(columnsToUpdate));
                                    _.set(newColumnsToUpdate, `${record.id}.am_estimate`, record.total_outstanding < 0 ? 0 : _.round(record.total_outstanding, 2).toFixed(2))
                                    _.set(newColumnsToUpdate, `${record.id}.revised_estimate`, record.total_outstanding < 0 ? 0 : _.round(record.total_outstanding, 2).toFixed(2))
                                    _.set(newColumnsToUpdate, `${record.id}.original_estimate`, isFreezed ? record.original_estimate : (record.total_outstanding < 0 ? 0 : _.round(record.total_outstanding, 2).toFixed(2)))
                                    setColumnsToUpdate(newColumnsToUpdate);
                                }
                                else
                                    setData(data.map(item => item.id == record.id ? ({...item, selected: false}) : item))
                                }} 
                            />
                        </div>
                }
              },
              {
                title: role == "AM" ? 'AM Estimate' : 'RM Estimate',
                dataIndex: 'am_estimate',
                sorter: (a, b) => a.am_estimate - b.am_estimate,
                width: 140,
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
                            style={{ background: 'transparent', border: 'none', color: "black", textAlign: 'right' }}
                            disabled={!editPermission}
                            placeholder="0.00"
                            onChange={e => {
                                const val = e.target.value;
                                if((val.split(".")[1] || "").length > 2 || val < 0 || val > _.round(record.total_outstanding, 2)) {alert('You can not enter value more than Total Outstanding'); return;}
                                record = {...record, am_estimate: val, revised_estimate: val, original_estimate: isFreezed ? record.original_estimate : val }
                                setData(data.map(item => item.id == record.id ? record : item));
                                let newColumnsToUpdate = JSON.parse(JSON.stringify(columnsToUpdate));
                                _.set(newColumnsToUpdate, `${record.id}.am_estimate`, val)
                                _.set(newColumnsToUpdate, `${record.id}.revised_estimate`, val)
                                _.set(newColumnsToUpdate, `${record.id}.original_estimate`, isFreezed ? record.original_estimate : val)
                                setColumnsToUpdate(newColumnsToUpdate);
                            }}
                        />
                    </div>;
                }
              },
              {
                title: 'Assumptions',
                dataIndex: 'assumptions',
                sorter: (a, b) => (a.assumptions || "").localeCompare(b.assumptions || ""),
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
                            disabled={!editPermission}
                            defaultValue={text} 
                            style={{ background: 'transparent', border: 'none',color: "black" }} 
                            onChange={(e) => {
                                const val = e.target.value;
                                let newColumnsToUpdate = JSON.parse(JSON.stringify(columnsToUpdate));
                                _.set(newColumnsToUpdate, `${record.id}.assumptions`, val)
                                setColumnsToUpdate(newColumnsToUpdate);
                            }} />
                    </div>;
                }
              }                      
            ];
            
            function onChange(pagination, filters, sorter, extra) {
                setFilteredData(extra.currentDataSource);
                $("#total-filtered").text(_.round(_.sumBy(extra.currentDataSource, x => parseFloat(x.total_outstanding || "0")), 2).toFixed(2));
                $("#original-filtered").text(_.round(_.sumBy(extra.currentDataSource, x => parseFloat(x.original_estimate || "0")), 2).toFixed(2));
                $("#revised-filtered").text(_.round(_.sumBy(extra.currentDataSource, x => parseFloat(x.revised_estimate || "0")), 2).toFixed(2));
                $("#actual-filtered").text(_.round(_.sumBy(extra.currentDataSource, x => parseFloat(x.actual_collection_f_a || "0")), 2).toFixed(2));
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
                fetch("collection_data_fetch.php")
                    .then(res => res.json())
                    .then(res => {
                        const updatedData = _.map(res.data, x => {
                            const prevDate = new Date(x.month);
                            const newDate = new Date();
                            x["prevMonth"] = (prevDate.getMonth() == newDate.getMonth()) && (prevDate.getYear() == newDate.getYear());
                        })
                        setFilteredData(res.data);
                        setWholeData(res.data);
                        setData(res.data);
                        setEditPermission(res.edit_permission);
                        setHistoryPermission(res.history_permission);
                        setLoading(false);
                        setIsFreezed(res.is_freezed);
                        const dt = `${MonthNames[currentDate.getMonth()]}-${currentDate.getFullYear()}`;
                        setColumnsToUpdate({})
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
                        $("#total-original").text(_.round(_.sumBy(res.data, x => parseFloat(x.total_outstanding || "0")), 2).toFixed(2));
                        $("#original-original").text(_.round(_.sumBy(res.data, x => parseFloat(x.original_estimate || "0")), 2).toFixed(2));
                        $("#revised-original").text(_.round(_.sumBy(res.data, x => parseFloat(x.revised_estimate || "0")), 2).toFixed(2));
                        $("#actual-original").text(_.round(_.sumBy(res.data, x => parseFloat(x.actual_collection_f_a || "0")), 2).toFixed(2));
                        $("#total-filtered").text(_.round(_.sumBy(res.data, x => x.month == dt ? parseFloat(x.total_outstanding || "0") : 0), 2).toFixed(2));
                        // $("#total-filtered").text(_.round(_.sumBy(res.data, x => parseFloat(x.total_outstanding || "0")), 2).toFixed(2));
                        $("#original-filtered").text(_.round(_.sumBy(res.data, x => parseFloat(x.original_estimate || "0")), 2).toFixed(2));
                        $("#revised-filtered").text(_.round(_.sumBy(res.data, x => parseFloat(x.revised_estimate || "0")), 2).toFixed(2));
                        $("#actual-filtered").text(_.round(_.sumBy(res.data, x => parseFloat(x.actual_collection_f_a || "0")), 2).toFixed(2));
                    });
                setColumnsToShow(columns.map(x => _.includes(["month", "classification", "profit_center", "bucket", "original_estimate", "revised_estimate","payer_code","invoice_number"], x.dataIndex) ? null : x.dataIndex).filter(Boolean));
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
                    {columns.filter(x => x.dataIndex != "id").map(column => (
                        <div key={column.dataIndex}>
                            <Checkbox 
                                checked={_.includes(columnToShow, column.dataIndex)}
                                disabled={!_.includes(["month", "classification", "profit_center", "bucket", "original_estimate", "revised_estimate", "payer_code","invoice_number"], column.dataIndex)}
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
            return (<div>
                <div style={{ width: "20%", float: "right", zIndex: 200 }}> 
                    <Input placeholder=" Search" onChange={filter} style={{ height: 40 }} />
                </div>
                
                <div style={{float: "right"}}>
                
                      <button 
                      id='update_values_button'
                      className="btn btn-primary user-btn mr-2" disabled={
                          _.size(_.filter(filteredData, x => ((x.selected && x.prevMonth) || 
                          _.includes(_.keys(columnsToUpdate), x.id)))) == 0
                        }
                        onClick={() => {
                            const filteredData = _.filter(data, x => ((x.selected && x.prevMonth) || _.includes(_.keys(columnsToUpdate), x.id)));
                            Modal.confirm({
                                title: `Want to update ${filteredData.length} rows?`,
                                onOk: () => {
                                    let newData = JSON.parse(JSON.stringify(data));;
                                    _.each(filteredData, item => {
                                        if(!item.prevMonth) return;
                                        if(item.as_estimate || item.revised_estimate || item.original_estimate) {
                                            let record = {...item, selected: false, am_estimate: item.total_outstanding, revised_estimate: item.total_outstanding};
                                            record["original_estimate"] = isFreezed ? item["original_estimate"] : item.total_outstanding;
                                            const ind = _.findIndex(data, itm => itm.id == record.id);
                                            newData[ind] = record;
                                            // updateValueInDB(record.am_estimate, "am_estimate", record.id, true);
                                            // updateValueInDB(record.revised_estimate, "revised_estimate", record.id, true);
                                            // updateValueInDB(record.original_estimate, "original_estimate", record.id, true);
                                        }
                                        if (item.assumptions) {
                                            let record = {...item, selected: false, assumptions: item.assumptions};
                                            const ind = _.findIndex(data, itm => itm.id == record.id);
                                            newData[ind] = record;
                                            // updateValueInDB(record.assumptions, "assumptions", record.id, true);
                                        }
                                    })
                                    // setData(newData);
                                    updateMultipleValueInDB();
                                    // fetchData();
                                }
                            })
                      }}>
                        Update Values
                      </button>
                     
                     {/*  role == "ADMIN" && <a href="collection_review.php"><button className="btn btn-primary user-btn mr-2">Collection Review</button></a>*/}
					  { (<div style={{display: "inline"}}>
					    {/*<form method="post" action="exportacfa.php" style={{display: "inline"}}>
    					 <button htmlType="submit" id="export-acfa" name="exportacfa" className="btn btn-primary user-btn mr-2">Download format</button>
    				    </form>
    					<form method="post" action="collection-table.php" enctype="multipart/form-data" style={{display: "inline"}}>
        					<input type="file" hidden name="doc" id="doc" />
    						<button className="btn btn-primary user-btn mr-2" id="import-acfa" data-toggle="modal" data-target="#exampleModalCenter">Upload Actuals</button>
    					    <input type="submit"  name="import" id="fileUploadFormButton" hidden />
    			        </form>*/
					        
					    }
                            {<a href="collection.php"><button className="btn btn-primary user-btn mr-2">Export Collection</button></a>}
					        {role == "ADMIN" && <a href="sap-dump?upload_collection=yes"><button className="btn btn-primary user-btn mr-2">Upload Collection file</button></a>}
					        <Dropdown overlay={menu} trigger={['click']}>
                                <button className="btn btn-primary user-btn mr-2">
                                    Select Columns
                                </button>
                            </Dropdown>
    			       </div>)}
                </div>
                <div className="table-wrapper">
                    <Table 
                        size="small" 
                        loading={loading}
                        columns={columnToShow == 'all' ? columns : columns.filter(x => _.includes(columnToShow, x.dataIndex))} 
                        dataSource={data} 
                        rowKey="id"
                        pagination={{
                            defaultPageSize: 50, 
                            showSizeChanger: true, 
                            showTotal: (total, range) => <div style={{float: "left"}}>{range[0]}-{range[1]} of {total} items</div>,
                            pageSizeOptions: ['10', '25', '50', '100'],
                            position: ["topLeft", "bottomRight"]
                        }} 
                        onChange={onChange}
                        scroll={{ x: true, y: 350 }}
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
                            expandedRowRender: (record) => { console.log(record);
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
        function auto_grow(element) {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight)+"px";
        }
        $(document).ready(function() 
        {
            setTimeout(function(){
                $("#import-acfa").on("click", function(e) {
                    e.preventDefault();
        			$("#doc").click();
        			$("#doc").on("change", function() {
        				$("#fileUploadFormButton").click();
        			})
                });   
            }, 1000);
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
        $(document).ready(function() 
        {
            setTimeout(function() {
                    $(window).on("wheel", function(e) {
                        const totalHeight = $(".ant-table-body")[0].scrollHeight - $(".ant-table-body")[0].clientHeight;
                        const currentHeight = $(".ant-table-body").scrollTop();
                        const current = currentHeight + e.originalEvent.deltaY;
                        $(".ant-table-body").animate({ scrollTop: current }, 0);
                        $("#custom-scrollbar").css({ top: 64 + (currentHeight / totalHeight) * (window.innerHeight - 164) })
                    });
            }, 10);
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
    <?php
    
		require_once("./importacfa.php");
	?>
  </body>
</html>