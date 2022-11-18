<?php
include "./database/sql.php";
include "./components/top-bar.php";
date_default_timezone_set('Asia/Kolkata');
$conn = OpenCon();
$type=$_COOKIE['type'];
$email=$_COOKIE['email'];
$arr_users = [];
$month=[];
$count_total_outstanding=0;
$count_total_estimate=0;
$count_total_collection=0;
$count_total_outstanding_monthly=0;
$count_total_estimate_monthly=0;
$count_total_collection_monthly=0;
$bu_c=0;
$ac_c=0;
$pc_c=0;
$cn_c=0;
if($type == 'AM')
    {
        $result = pg_query($conn,"SELECT * FROM user_account where email='$email'");
        if (pg_num_rows($result)>0) 
        {
        	while ($row = pg_fetch_assoc($result)) 
        	{
        		$uid=$row['id'];
        	}
        }
        $result = pg_query($conn,"SELECT * FROM clients where account_manager ='$uid'");
        $clientname = array();
        if (pg_num_rows($result)>0) 
        {
        	while ($row = pg_fetch_assoc($result)) 
        	{
        		array_push($clientname, strtolower($row['clientname']));
        		
        	}
        }
        
        $j = json_encode($clientname);
        $j = str_replace('"', "'", $j);
        $qyear = date("Y", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
		$qmonth = (int)(date("m", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) ));
		if(count($clientname) == 0) {
			$bu_c = 0;
			$ac_c = 0;
			$pc_c = 0;
			$cn_c = 0;
		} else {
			$xr = pg_query($conn,"SELECT DISTINCT (bu) from collection where lower(client_name) = any(array$j)");
			$bu_c = pg_num_rows($xr);       
			$xr = pg_query($conn,"SELECT DISTINCT account from collection where lower(client_name) = any(array$j)");
			$ac_c = pg_num_rows($xr);       
			$xr = pg_query($conn,"SELECT DISTINCT profit_center from collection where lower(client_name) = any(array$j)");
			$pc_c = pg_num_rows($xr);
			$xr = pg_query($conn,"SELECT DISTINCT client_name from collection where lower(client_name) = any(array$j)");
			$cn_c=pg_num_rows($xr);
		}
        $month_query ="SELECT * FROM collection WHERE EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND lower(client_name) = any(array$j)";
        $month_query_result = pg_query($conn,$month_query);
		if(!empty($month_query_result)){
        	$arr_users = pg_fetch_all($month_query_result);
		
			if (pg_num_rows($month_query_result)>0) 
			{
				while ($row = pg_fetch_assoc($month_query_result)) 
				{
					$count_total_outstanding_monthly+=(float)$row['total_outstanding'];
					$count_total_estimate_monthly+=(float)$row['original_estimate'];
					$count_total_collection_monthly+=(float)$row['actual_collection_f_a'];
				}
			}
		}
        $result_total = pg_query($conn,"SELECT * FROM collection where lower(client_name) = any(array$j)");
        if(!empty($result_total)){
			if (pg_num_rows($result_total)>0) 
			{
				while ($row = pg_fetch_assoc($result_total)) 
				{
					$count_total_outstanding+=(float)$row['total_outstanding'];
					$count_total_estimate+=(float)$row['original_estimate'];
					$count_total_collection+=(float)$row['actual_collection_f_a'];
					
				}
			}
		}
        $rt=0;
        $revenue_total = pg_query($conn,"SELECT * FROM revenue_table  where lower(client_name) = any(array$j)");
        if(!empty($revenue_total)){
			if (pg_num_rows($revenue_total)>0) 
			{
				while ($row = pg_fetch_assoc($revenue_total)) 
				{
					$rt+=(float)$row['upload_3'];
					
				}
			}
			else{
				$rt = 0;
			}
		}
        
    }
    else if($type == 'RM')
    {
    	
        $result = pg_query($conn,"SELECT * FROM user_account where email='$email'");
        $row = pg_fetch_all($result)[0];
        $arr = explode(", ", $row['accounttype']);
        function myfunction($v) {
          return strtolower(substr($v, 3));
        }
        function myfunction2($v) {
          return strtolower(substr($v, 3));
        }
        $accounttype = join(", ", array_map("myfunction", $arr));
        $accounttype2 = join(", ", array_map("myfunction2", $arr));
        $qyear = date("Y", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
		$qmonth = (int)(date("m", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) ));
		$xr = pg_query($conn,"SELECT DISTINCT (bu) from collection where lower(account) = ANY('"."{".$accounttype."}"."')");
		$bu_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT account from collection where lower(account) = ANY('"."{".$accounttype."}"."')");
		$ac_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT profit_center from collection where lower(account) = ANY('"."{".$accounttype."}"."')");
		$pc_c = pg_num_rows($xr);
		$xr = pg_query($conn,"SELECT DISTINCT client_name from collection where lower(account) = ANY('"."{".$accounttype."}"."')");
		$cn_c=pg_num_rows($xr);
        $result = pg_query($conn,"SELECT * FROM collection WHERE EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND lower(account) = ANY('"."{".$accounttype."}"."')");
        $arr_users = pg_fetch_all($result);
        if (pg_num_rows($result)>0) 
        {
        	while ($row = pg_fetch_assoc($result)) 
        	{
        		$count_total_outstanding_monthly+=(float)$row['total_outstanding'];
				$count_total_estimate_monthly+=(float)$row['original_estimate'];
				$count_total_collection_monthly+=(float)$row['actual_collection_f_a'];
        	}
        }
        $result_total = pg_query($conn,"SELECT * FROM collection where lower(account) = ANY('"."{".$accounttype."}"."')");
        if (pg_num_rows($result_total)>0) 
        {
        	while ($row = pg_fetch_assoc($result_total)) 
        	{
        		$count_total_outstanding+=(float)$row['total_outstanding'];
				$count_total_estimate+=(float)$row['original_estimate'];
				$count_total_collection+=(float)$row['actual_collection_f_a'];
        		
        	}
        }
        $rt=0;
        $revenue_total = pg_query($conn,"SELECT * FROM revenue_table WHERE lower(account_type) = ANY('"."{".$accounttype2."}"."')");
        
        if (pg_num_rows($revenue_total)>0) 
        {
        	while ($row = pg_fetch_assoc($revenue_total)) 
        	{
        		$rt+=(float)$row['upload_3'];
        		
        	}
        }
        else{
        	$rt = 0;
        }
        
    }
    else if($type == 'BU')
    {
        $result = pg_query($conn,"SELECT * FROM user_account where email='$email'");
        $bu = pg_fetch_all($result)[0]["bu"];
        $qyear = date("Y", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
		$qmonth = (int)(date("m", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) ));
		$xr = pg_query($conn,"SELECT DISTINCT (bu) from collection where bu = ANY('"."{".$bu."}"."')");
		$bu_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT account from collection where bu = ANY('"."{".$bu."}"."')");
		$ac_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT profit_center from collection where bu = ANY('"."{".$bu."}"."')");
		$pc_c = pg_num_rows($xr);
		$xr = pg_query($conn,"SELECT DISTINCT client_name from collection where bu = ANY('"."{".$bu."}"."')");
		$cn_c=pg_num_rows($xr);
        $result = pg_query($conn,"SELECT * FROM collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND bu = ANY('"."{".$bu."}"."') order by create_date desc nulls last");
        $arr_users = pg_fetch_all($result);
        if (pg_num_rows($result)>0) 
        {
        	while ($row = pg_fetch_assoc($result)) 
        	{
        		$count_total_outstanding_monthly+=(float)$row['total_outstanding'];
				$count_total_estimate_monthly+=(float)$row['original_estimate'];
				$count_total_collection_monthly+=(float)$row['actual_collection_f_a'];
        	}
        }
        $result_total = pg_query($conn,"SELECT * FROM collection where bu = ANY('"."{".$bu."}"."')");
        if (pg_num_rows($result_total)>0) 
        {
        	while ($row = pg_fetch_assoc($result_total)) 
        	{
        		$count_total_outstanding+=(float)$row['total_outstanding'];
				$count_total_estimate+=(float)$row['original_estimate'];
				$count_total_collection+=(float)$row['actual_collection_f_a'];
        		
        	}
        }
        $rt=0;
        $revenue_total = pg_query($conn,"SELECT * FROM revenue_table where business = ANY('" . "{" . $bu . "}" . "'::text[])");
        if (pg_num_rows($revenue_total)>0) 
        {
        	while ($row = pg_fetch_assoc($revenue_total)) 
        	{
        		$rt+=(float)$row['upload_3'];
        		
        	}
        }
        else{
        	$rt = 0;
        }
        
    }
    else if($type == 'CU')
    {
    	$qyear = date("Y", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
		$qmonth = (int)(date("m", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) ));
    	$xr = pg_query($conn,"SELECT DISTINCT (bu) from collection ");
		$bu_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT account from collection");
		$ac_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT profit_center from collection");
		$pc_c = pg_num_rows($xr);
		$xr = pg_query($conn,"SELECT DISTINCT client_name from collection");
		$cn_c=pg_num_rows($xr);
        $result = pg_query($conn,"SELECT * FROM collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear order by create_date desc nulls last");
        $arr_users = pg_fetch_all($result);
        if (pg_num_rows($result)>0) 
        {
        	while ($row = pg_fetch_assoc($result)) 
        	{
        		$count_total_outstanding_monthly+=(float)$row['total_outstanding'];
				$count_total_estimate_monthly+=(float)$row['original_estimate'];
				$count_total_collection_monthly+=(float)$row['actual_collection_f_a'];
        	}
        }
        $result_total = pg_query($conn,"SELECT * FROM collection");
        if (pg_num_rows($result_total)>0) 
        {
        	while ($row = pg_fetch_assoc($result_total)) 
        	{
        		$count_total_outstanding+=(float)$row['total_outstanding'];
				$count_total_estimate+=(float)$row['original_estimate'];
				$count_total_collection+=(float)$row['actual_collection_f_a'];
        		
        	}
        }
        $rt=0;
        $revenue_total = pg_query($conn,"SELECT * FROM revenue_table");
        if (pg_num_rows($revenue_total)>0) 
        {
        	while ($row = pg_fetch_assoc($revenue_total)) 
        	{
        		$rt+=(float)$row['upload_3'];
        		
        	}
        }
        else{
        	$rt = 0;
        }
    }
    else if($type == 'ADMIN')
    {
    	$qyear = date("Y", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
		$qmonth = (int)(date("m", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) ));
		$xr = pg_query($conn,"SELECT DISTINCT (bu) from collection");
		$bu_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT account from collection");
		$ac_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT profit_center from collection");
		$pc_c = pg_num_rows($xr);
		$xr = pg_query($conn,"SELECT DISTINCT client_name from collection");
		$cn_c=pg_num_rows($xr);
        $result = pg_query($conn,"SELECT * FROM collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear order by create_date desc nulls last");
        $arr_users = pg_fetch_all($result);
        if (pg_num_rows($result)>0) 
        {
        	while ($row = pg_fetch_assoc($result)) 
        	{
        		$count_total_outstanding_monthly+=(float)$row['total_outstanding'];
				$count_total_estimate_monthly+=(float)$row['original_estimate'];
				$count_total_collection_monthly+=(float)$row['actual_collection_f_a'];
        		
        	}
        }
        
        $result_total = pg_query($conn,"SELECT * FROM collection");
        if (pg_num_rows($result_total)>0) 
        {
        	while ($row = pg_fetch_assoc($result_total)) 
        	{
        		$count_total_outstanding+=(float)$row['total_outstanding'];
				$count_total_estimate+=(float)$row['original_estimate'];
				$count_total_collection+=(float)$row['actual_collection_f_a'];
        		
        	}
        }
        $rt=0;
        $revenue_total = pg_query($conn,"SELECT * FROM revenue_table");
        if (pg_num_rows($revenue_total)>0) 
        {
        	while ($row = pg_fetch_assoc($revenue_total)) 
        	{
        		$rt+=(float)$row['upload_3'];
        		
        	}
        }
        else{
        	$rt = 0;
        }
        
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Summary</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- CSS -->
	<link rel="stylesheet" href="./css/index.css">
	<link rel="stylesheet" href="./css/home.css">

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
</head>
<body>
	<div class="container-main">
		<?php 
		$type = strtoupper($_COOKIE["type"]);
		if ("ADMIN" == $type) 
		TopBar('summary'); 
		else
		nTopBar('summary');
		?>
		<div class="content">
			<div class="cards-wrapper px-4 d-flex ">
				
				<div class="graph-card order-card mx-2 p-3 card-hover">
				<iframe width="560" height="360" src="https://datastudio.google.com/embed/reporting/7d936936-a344-4e3b-8712-7dee9763398e/page/p_crre9gfgsc" frameborder="0" style="border:0" allowfullscreen></iframe>
					<!--
					<a href="total_collection">
						<div class="card-title"><b>Collection / Revenue</b></div>
						<div class="cards-wrapper px-4 d-flex">
							<div class=" inside-card mx-2 p-3 flex-fill">
								<div class="card-title">Total Outstanding</div>
								<div class="card-value d-flex justify-content-end"><?= round($count_total_outstanding, 2) ?></div>
							</div>
							<div class="inside-card mx-2 p-3 flex-fill">
								<div class="card-title">Total Estimate</div>
								<div class="card-value d-flex justify-content-end"><?= round($count_total_estimate, 2) ?></div>
							</div>
						</div>
						<div class="cards-wrapper px-4 d-flex mt-4 position-relative">
							<div class="inside-card mx-2 p-3 flex-fill">
								<div class="card-title">Total Collection</div>
								<div class="card-value d-flex justify-content-end"><?= round($count_total_collection, 2) ?></div>
							</div>
							<div class="inside-card mx-2 p-3 flex-fill">
								<div class="card-title">Total Revenue</div>
								<div class="card-value d-flex justify-content-end"><?= round($rt, 2) ?></div>
							</div>
							<div style="position: absolute; right: 0px;bottom:0">
								<img src="https://cdn.freebiesupply.com/logos/large/2x/database-labs-logo-png-transparent.png" style="width: 200px;height:200px; opacity: 0.3" />
							</div>
						</div>
					</a>
					-->
					
				</div>

				<div class="graph-card profit-card mx-2 p-3 card-hover">
				<iframe width="560" height="425" src="https://datastudio.google.com/embed/reporting/c188ed73-c0d0-4aa9-a6d0-defcf1d10906/page/p_53ovo91wsc" frameborder="0" style="border:0" allowfullscreen></iframe>
					<!--
					<a href="my_portfolio">
						<div class="card-title"><b>My Portfolio</b></div>
						<div class="cards-wrapper px-4 d-flex">
							<div class=" inside-card mx-2 p-3 flex-fill">
								<div class="card-title ">Business Unit</div>
								<div class="card-value d-flex justify-content-end"><?= $bu_c?></div>
							</div>
							<div class="inside-card mx-2 p-3 flex-fill">
								<div class="card-title ">Accounts</div>
								<div class="card-value d-flex justify-content-end"><?= $ac_c?></div>
							</div>
						</div>
						<div class="cards-wrapper px-4 d-flex mt-4 position-relative">
							<div class="inside-card mx-2 p-3 flex-fill">
								<div class="card-title ">Profit Centers</div>
								<div class="card-value d-flex justify-content-end"><?= $pc_c?></div>
							</div>
							<div class="inside-card mx-2 p-3 flex-fill">
								<div class="card-title ">Clients</div>
								<div class="card-value d-flex justify-content-end"><?= $cn_c?></div>
							</div>
							<div style="position: absolute; right: 0px;bottom:0">
								<img src="https://www.freeiconspng.com/thumbs/report-icon/call-report-icon-3.png" style="width: 200px;height:200px; opacity: 0.3" />
							</div>
						</div>
					</a>
				-->
				</div>
				<!--<div class="graph-card profit-card mx-2 p-3 card-hover position-relative">-->
				<!--	<a>-->
				<!--		<div class="card-title"><b>Revenues</b></div>-->
				<!--		<div class="cards-wrapper px-4 d-flex">-->
				<!--			<div class=" inside-card mx-2 p-3 flex-fill">-->
				<!--				<div class="card-title"></div>-->
				<!--				<div class="card-value"></div>-->
				<!--			</div>-->
				<!--			<div class="inside-card mx-2 p-3 flex-fill">-->
				<!--				<div class="card-title"></div>-->
				<!--				<div class="card-value"></div>-->
				<!--			</div>-->
				<!--		</div>-->
				<!--		<div class="cards-wrapper px-4 d-flex mt-4 ">-->
				<!--			<div class="inside-card mx-2 p-3 flex-fill">-->
				<!--				<div class="card-title"></div>-->
				<!--				<div class="card-value"></div>-->
				<!--			</div>-->
				<!--			<div class="inside-card mx-2 p-3 flex-fill">-->
				<!--				<div class="card-title"></div>-->
				<!--				<div class="card-value"></div>-->
				<!--			</div>-->
				<!--		</div>-->
				<!--		<div style="position: absolute; right: 0px;bottom:0">-->
				<!--			<img src="https://www.pngkit.com/png/full/68-683776_increase-revenue-increase-revenue-icon.png" style="width: 200px;height:200px; opacity: 0.3" />-->
				<!--		</div>-->
				<!--	</a>-->
				<!--</div>-->
			</div>
		</div>
<?php
	include "./components/footer.php"
?>
	</div>
	<script>
		// $(document).ready(function() {
		// 	$('#userTable').DataTable();
		// });
		$(document).ready(function() {
			$('#userTable2').DataTable();
		});
		$(document).ready(function() {
		let dt = $('#userTable').DataTable( {
			
			"pageLength": 10,
			// "scrollY":        "500px",
			"order": [[ 5, "asc" ]],
			"columnDefs": [ {
			"targets": 5,
			"orderable": false
			} ],
	        // "scrollX":        true,
	        // "scrollCollapse": true,
	        // paging:         true,
	        
			initComplete: function () 
			{
				this.api().columns([5]).every( function () {
					var column = this;
					 //$(column.header() ).on('click', function() {
					 //	select.css("display", "block")
					 //});
					var select = $('<select style=" float:right;margin-top: 10px;"></select>')
					.appendTo( $(column.header() ))
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
						);

						column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
					} );
					select.append( '<option value="">None</option>' )
					column.data().unique().sort().each( function ( d, j ) 
					{
						select.append( '<option value="'+d+'">'+d+'</option>' )
					} );
					 //$(column.header()).append('<i class="fas fa-filter" style="font-size: 9px; margin-left: 2px;" />')
				} );
			}
		} ).columns.adjust().draw();;
	} );
	</script>
	<?php 
	// echo date("Y/M");
	// echo date("Y/m/d h:i:s", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
	// echo (int)(date("m", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) ));
	// echo $mioasjd_kjawusl;
	?>
	<?php
	// echo "SELECT * FROM revenue_table WHERE lower(account_type) = ANY('"."{".$accounttype."}"."')";
	// print_r($month_final)
	?>
</body>
</html>