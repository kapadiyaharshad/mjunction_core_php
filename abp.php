<?php
include "./database/sql.php";
include "./components/side-bar.php";
include "./components/top-bar.php";
date_default_timezone_set('Asia/Kolkata');

$conn = OpenCon();
if(isset($_POST["table_name"])){
	$table_name=$_POST["table_name"];
}
else{
	$table_name = 'abp';
}

$abp_percentage = pg_query($conn,"SELECT * FROM ".$table_name." order by id");
$arr_abp = [];
if (pg_num_rows($abp_percentage)>0) 
{
	$arr_abp = pg_fetch_all($abp_percentage);
}
$type=$_COOKIE['type'];
if($type != 'ADMIN'){
	echo "<script>window.location.href = './summary'</script>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>ABP Target</title>
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
	 	tbody tr {
	        background-color: rgba(153, 144, 244, 0.2) !important;
	    }
	    .ant-table-body::-webkit-scrollbar {
            display: none;
        }
	    .ant-table-thead th {
	        background-color: #D8D4F6 !important; 
	    }
	    .ant-table-filter-trigger-container {
	        background-color: #D8D4F6 !important; 
	    }
	    .ant-table-tbody>tr.ant-table-row:hover>td {
	        background: #F5F4FE;
	    }
	    .ant-table-cell-fix-left {
	        background: #F5F4FE;
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
	    table {
	        margin: 12px 0px;
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
	</style>
		<script>
	function deleteVOAR(id) {
		window.location = `./deletevoar?id=${id}`
	}
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
					    <div class="card-title" style='font-size:23px'>Annual Business Plan Target</div>
					   <!-- 	<div class="d-flex justify-content-center">-->
					   <!-- 	     <a href="abp_form"><button class="btn btn-primary user-btn ml-2">Add Target</button></a>-->
					    	     <!--<a href="abp_import"><button class="btn btn-primary user-btn ml-2">Import File</button></a>-->
								<!--<form method="post" action="abp" enctype="multipart/form-data">-->
								<!--	<input type="file" hidden name="doc" id="doc" />-->
								<!--	<input type="button" id="download-users" data-toggle="modal" data-target="#exampleModalCenter" value="Import File" class="btn btn-primary user-btn ml-2" onclick="openFile()" />-->
								<!--	<input type="submit"  name="importabp" id="abpfileUploadFormButton" hidden />-->
								<!--</form>-->
					   <!-- 	     <form method="post" action="exportabp">-->
								<!--	<input type="submit" id="add-users" name="exportabp" class="btn btn-primary user-btn ml-2" value="Download ABP format " />-->
								<!--</form>-->
						  <!--  </div>-->
						</div>
						
						<form method="POST" action="">
						<select name="table_name" onchange="this.form.submit()">
							<option value="abp" <?php if($table_name == 'abp') echo"selected"; ?>>Abp</option>
							<option value="abp_vaor" <?php if($table_name == 'abp_vaor') echo"selected"; ?>>Abp Vaor</option>
						</select>
						</form>
						<div class="d-none" id="page-data"><?= json_encode($arr_abp); ?></div>
						<div id="react-root" />
					</div>
				</div>
			</div>
<?php
	include "./components/footer.php"
?>
		</div>
	</div>
	
	<script type="text/javascript">
		function openFile() {
			$("#doc").click();
			$("#doc").on("change", function() {
				$("#abpfileUploadFormButton").click();
			})
		}
	</script>
	  <script type="text/babel">
		const DataTable = () => {
	    	const { Table, Input, Checkbox, Row, Dropdown, Menu, Button, Modal } = antd;
	    	const { useState } = React;
	
	    	const [data, setData] = useState(JSON.parse($("#page-data").html()));
	    	
	    	const filterList = (column) => {
	            return _.uniqBy(_.map(data, item => ({text: item[column], value: item[column]})), "value")
	        }
	    	
	    	const columns = [
	    		{
	    			title: "ID",
	    			dataIndex: "id",
	    			sorter: (a, b) => a.id - b.id
	    		},
	    		{
	    			title: "Month",
	    			dataIndex: "month",
	    			sorter: (a, b) => new Date(a.month).getTime() - new Date(b.month).getTime(),
	    			filters: filterList("month"),
	    			defaultSortOrder: 'ascend', 
	                onFilter: (value, record) => record.month === value
	    		},
	    		{
	    			title: "Business Unit",
	    			dataIndex: "bu",
	    			sorter: (a, b) => (a.bu || "").localeCompare(b.bu || ""),
	    			filters: filterList("bu"),
	                onFilter: (value, record) => record.bu === value
	    		},
	    		{
	    			title: "Profit Center",
	    			dataIndex: "profit_center",
	    			sorter: (a, b) => (a.profit_center || "").localeCompare(b.profit_center || ""),
	    			filters: filterList("profit_center"),
	                onFilter: (value, record) => record.profit_center === value,
                	align: 'right'
	    		},
	    		{
	    			title: "Payer Code",
	    			dataIndex: "payer_code",
	    			sorter: (a, b) => (a.payer_code || "").localeCompare(b.payer_code || ""),
                	align: 'right'
	    		},
	    		{
	    			title: "Client Name",
	    			// dataIndex: "client_name",
	    			sorter: (a, b) => (a.client_name || "").localeCompare(b.client_name || ""),
					render: (text,row) => 
						<span>{text.client_name.replace(/amp;/ig,'')}</span>

				},
	    		{
	    			title: "Target Amount",
	    			dataIndex: "target_amount",
	    			sorter: (a, b) => parseFloat(a.target_amount) - parseFloat(b.target_amount),
                	align: 'right'
	    		},
	    		{
	    			title: "Created Date",
	    			dataIndex: "created_date",
	    			sorter: (a, b) => (a.created_date || "").localeCompare(b.created_date || ""),
	    		},
	    		{
	    			title: "Last Updated",
	    			dataIndex: "last_updated",
	    			sorter: (a, b) => (a.last_updated || "").localeCompare(b.last_updated || ""),
	    		},
	    		{
	    			title: "Actions",
	    			dataIndex: "id",
	    			render: (id) => {
	    				return <button type="button" class="btn btn-primary edit-btn" onClick={() => window.location = `edit_abp?id=${id}` }  >
							<i class="far fa-edit"></i>
						</button>
	    			}
	    		},
	    	]
	    	
	    	const filter = (e) => {
	            const val = _.lowerCase(e.target.value);
	            if(val)
	        	    setData(
	    	            JSON.parse($("#page-data").html()).filter(item => {
	                        return _.lowerCase(item.bu).startsWith(val) ||
	                            _.lowerCase(item.profit_center).startsWith(val) ||
	                            _.lowerCase(item.payer_code).startsWith(val) ||
	                            _.lowerCase(item.client_name).startsWith(val) ||
	                            _.lowerCase(item.target_amount).startsWith(val)
	                        })
	                    );
	                else
	                    setData(JSON.parse($("#page-data").html()));
	        }
    	
            return (
            	<div>
	            	<div style={{ width: "20%", float: "right", zIndex: 200 }}> 
	                    <Input placeholder=" Search" onChange={filter} style={{ height: 40 }} />
	                </div>
	                <div style={{ float: "right", zIndex: 200, paddingLeft: 10 }}> 
	                	<a href="abp_form"><button className="btn btn-primary user-btn mr-2">Add Target</button></a>
						<a href="sap-dump?abp=yes"><button className="btn btn-primary user-btn mr-2">Import</button></a>
						
						<form method="post" action="exportabp" style={{ display: 'inline' }}>
							<button htmlType="submit" id="add-users" name="exportabp" className="btn btn-primary user-btn mr-2">Download ABP format </button>
						</form>
					</div>
            		<Table 
            			columns={columns} 
            			size="small" 
                        dataSource={data} 
                        rowKey="id"
                        pagination={{
                            defaultPageSize: 50, 
                            showSizeChanger: true, 
                            showTotal: (total, range) => <div style={{float: "left"}}>{range[0]}-{range[1]} of {total} items</div>,
                            pageSizeOptions: ['10', '25', '50', '100'],
                            position: ["topLeft", "bottomRight"]
                        }} 
                    />	
                </div>
            )
        }
        
        ReactDOM.render(<DataTable />, document.getElementById('react-root'))
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function(){
                $("#download-users").on("click", function(e) {
                	e.preventDefault();
        			$("#doc").click();
        			$("#doc").on("change", function() {
        				$("#abpfileUploadFormButton").click();
        			})
                });   
            }, 1000);
        });
    </script>
<?php
// error_reporting(0);
if(isset($_POST['importabp'])){
	require_once("./importabp.php");
}
?>

</body>
</html>
