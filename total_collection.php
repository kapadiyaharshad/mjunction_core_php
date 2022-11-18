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
		$xr = pg_query($conn,"SELECT DISTINCT (bu) from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND lower(client_name) = any(array$j)");
		$bu_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT account from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND lower(client_name) = any(array$j)");
		$ac_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT profit_center from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND lower(client_name) = any(array$j)");
		$pc_c = pg_num_rows($xr);
		$xr = pg_query($conn,"SELECT DISTINCT client_name from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND lower(client_name) = any(array$j)");
		$cn_c=pg_num_rows($xr);
        $month_query ="SELECT * FROM collection WHERE EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND lower(client_name) = any(array$j)";
        $month_query_result = pg_query($conn,$month_query);
        $arr_users = pg_fetch_all($month_query_result);
        if (pg_num_rows($month_query_result)>0) 
        {
        	while ($row = pg_fetch_assoc($month_query_result)) 
        	{
        		$count_total_outstanding_monthly+=$row['total_outstanding'];
				$count_total_estimate_monthly+=$row['original_estimate'];
				$count_total_collection_monthly+=$row['actual_collection_f_a'];
        	}
        }
        $result_total = pg_query($conn,"SELECT DISTINCT bu, profit_center, sum(total_outstanding::FLOAT) AS total_outstanding, sum(actual_collection_f_a::FLOAT) AS actual_collection_f_a, SUM(cast(coalesce(nullif(original_estimate,''),'0') as FLOAT)) AS original_estimate, MIN(bucket) AS bucket  FROM collection where lower(client_name) = any(array$j) GROUP BY bu, profit_center");
        $arr_users = pg_fetch_all($result_total);
        if (pg_num_rows($result_total)>0) 
        {
        	while ($row = pg_fetch_assoc($result_total)) 
        	{
        		$count_total_outstanding+=$row['total_outstanding'];
				$count_total_estimate+=$row['original_estimate'];
				$count_total_collection+=$row['actual_collection_f_a'];
        		
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
        $accounttype = join(", ", array_map("myfunction", $arr));
        $qyear = date("Y", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
		$qmonth = (int)(date("m", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) ));
		$xr = pg_query($conn,"SELECT DISTINCT (bu) from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND lower(account) = ANY('"."{".$accounttype."}"."')");
		$bu_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT account from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND lower(account) = ANY('"."{".$accounttype."}"."')");
		$ac_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT profit_center from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND lower(account) = ANY('"."{".$accounttype."}"."')");
		$pc_c = pg_num_rows($xr);
		$xr = pg_query($conn,"SELECT DISTINCT client_name from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND lower(account) = ANY('"."{".$accounttype."}"."')");
		$cn_c=pg_num_rows($xr);
        $result = pg_query($conn,"SELECT * FROM collection WHERE EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND lower(account) = ANY('"."{".$accounttype."}"."')");
        if (pg_num_rows($result)>0) 
        {
        	while ($row = pg_fetch_assoc($result)) 
        	{
        		$count_total_outstanding_monthly+=(float)$row['total_outstanding'];
				$count_total_estimate_monthly+=(float)$row['original_estimate'];
				$count_total_collection_monthly+=(float)$row['actual_collection_f_a'];
        	}
        }
        $result_total = pg_query($conn,"SELECT DISTINCT bu, profit_center, sum(total_outstanding::FLOAT) AS total_outstanding, sum(actual_collection_f_a::FLOAT) AS actual_collection_f_a, SUM(cast(coalesce(nullif(original_estimate,''),'0') as FLOAT)) AS original_estimate, MIN(bucket) AS bucket  FROM collection where lower(account) = ANY('"."{".$accounttype."}"."') GROUP BY bu, profit_center");
        $arr_users = pg_fetch_all($result_total);
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
    else if($type == 'BU')
    {
        $result = pg_query($conn,"SELECT * FROM user_account where email='$email'");
        $bu = pg_fetch_all($result)[0]["bu"];
        $qyear = date("Y", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
		$qmonth = (int)(date("m", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) ));
		$xr = pg_query($conn,"SELECT DISTINCT (bu) from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND bu = ANY('"."{".$bu."}"."')");
		$bu_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT account from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND bu = ANY('"."{".$bu."}"."')");
		$ac_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT profit_center from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND bu = ANY('"."{".$bu."}"."')");
		$pc_c = pg_num_rows($xr);
		$xr = pg_query($conn,"SELECT DISTINCT client_name from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND bu = ANY('"."{".$bu."}"."')");
		$cn_c=pg_num_rows($xr);
        $result = pg_query($conn,"SELECT * FROM collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear AND bu = ANY('"."{".$bu."}"."') order by create_date desc nulls last");
        if (pg_num_rows($result)>0) 
        {
        	while ($row = pg_fetch_assoc($result)) 
        	{
        		$count_total_outstanding_monthly+=(float)$row['total_outstanding'];
				$count_total_estimate_monthly+=(float)$row['original_estimate'];
				$count_total_collection_monthly+=(float)$row['actual_collection_f_a'];
        	}
        }
        $result_total = pg_query($conn,"SELECT DISTINCT bu, profit_center, sum(total_outstanding::FLOAT) AS total_outstanding, sum(actual_collection_f_a::FLOAT) AS actual_collection_f_a, SUM(cast(coalesce(nullif(original_estimate,''),'0') as FLOAT)) AS original_estimate, MIN(bucket) AS bucket  FROM collection where bu = ANY('"."{".$bu."}"."') GROUP BY bu, profit_center ");
        $arr_users = pg_fetch_all($result_total);
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
    else if($type == 'CU')
    {
    	$qyear = date("Y", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
		$qmonth = (int)(date("m", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) ));
    	$xr = pg_query($conn,"SELECT DISTINCT (bu) from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear");
		$bu_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT account from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear");
		$ac_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT profit_center from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear");
		$pc_c = pg_num_rows($xr);
		$xr = pg_query($conn,"SELECT DISTINCT client_name from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear");
		$cn_c=pg_num_rows($xr);
        $result = pg_query($conn,"SELECT * FROM collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear order by create_date desc nulls last");
        if (pg_num_rows($result)>0) 
        {
        	while ($row = pg_fetch_assoc($result)) 
        	{
        		$count_total_outstanding_monthly+=(float)$row['total_outstanding'];
				$count_total_estimate_monthly+=(float)$row['original_estimate'];
				$count_total_collection_monthly+=(float)$row['actual_collection_f_a'];
        	}
        }
        $result_total = pg_query($conn,"SELECT DISTINCT bu, profit_center, sum(total_outstanding::FLOAT) AS total_outstanding, sum(actual_collection_f_a::FLOAT) AS actual_collection_f_a, SUM(cast(coalesce(nullif(original_estimate,''),'0') as FLOAT)) AS original_estimate, MIN(bucket) AS bucket  FROM collection GROUP BY bu, profit_center");
        $arr_users = pg_fetch_all($result_total);
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
    else if($type == 'ADMIN')
    {
    	$qyear = date("Y", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
		$qmonth = (int)(date("m", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) ));
		$xr = pg_query($conn,"SELECT DISTINCT (bu) from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear");
		$bu_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT account from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear");
		$ac_c = pg_num_rows($xr);       
		$xr = pg_query($conn,"SELECT DISTINCT profit_center from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear");
		$pc_c = pg_num_rows($xr);
		$xr = pg_query($conn,"SELECT DISTINCT client_name from collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear");
		$cn_c=pg_num_rows($xr);
        $result = pg_query($conn,"SELECT * FROM collection where EXTRACT(MONTH FROM create_date::DATE) = $qmonth AND EXTRACT( YEAR FROM create_date::DATE) = $qyear order by create_date desc nulls last");
        if (pg_num_rows($result)>0) 
        {
        	while ($row = pg_fetch_assoc($result)) 
        	{
        		$count_total_outstanding_monthly+=(float)$row['total_outstanding'];
				$count_total_estimate_monthly+=(float)$row['original_estimate'];
				$count_total_collection_monthly+=(float)$row['actual_collection_f_a'];
        		
        	}
        }
        
        $result_total = pg_query($conn,"SELECT DISTINCT bu, profit_center, sum(total_outstanding::FLOAT) AS total_outstanding, sum(actual_collection_f_a::FLOAT) AS actual_collection_f_a, SUM(cast(coalesce(nullif(original_estimate,''),'0') as FLOAT)) AS original_estimate, MIN(bucket) AS bucket  FROM collection GROUP BY bu, profit_center");
        $arr_users = pg_fetch_all($result_total);
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
		TopBar('summary'); 
		else
		nTopBar('summary');
		echo "<script>console.log('Ok')</script>";
		?>
		<div class="content">
			<div class="cards-wrapper px-4 d-flex">
			    <div class="graph-card  mx-2 p-3 flex-fill">
			        <div><a href="summary"><button style="background-color: transparent;outline: none;border: none;font-size: 25px;"><i class="fa fa-angle-left"></i></button></a></div>
					<div class="card-title">Collection</div>
				    <div class="table-responsive">
    					<table id="userTable" class="">
    						<thead class="mt-2">
    							<th>Buisiness User</th>
    							<th>Profit Center</th>
    							<th>Total Outstanding</th>
    							<th>Total Estimates</th>
    							<th>Actual Collection F & A</th>
    							<th class="d-flex align-items-center">Bucket</th>
    						</thead>
    						<tbody>
    							
    							<?php
    							echo "<script>console.log('HI')</script>";
    							echo "<script>console.log('".json_encode($arr_users)."')</script>";
    							if(!empty($arr_users )) { ?>
    								<?php foreach($arr_users  as $user) { ?>
    									<tr>
    										<td><?php echo $user["bu"]?></td>
    										<td class="text-right"><?php echo $user["profit_center"]?></td>
    										<td class="text-right"><?php echo round( $user["total_outstanding"],2); ?></td>
    										<td class="text-right"><?php echo round( $user['original_estimate'],2); ?></td>
    										<td class="text-right"><?php echo round( $user['actual_collection_f_a'],2); ?></td>
    										<td class="text-right"><?php echo $user['bucket']; ?></td>
    									</tr>
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
	<script>
		$(document).ready(function() {
			$('#userTable2').DataTable();
		});
		$(document).ready(function() {
		let dt = $('#userTable').DataTable( {
			
			"pageLength": 10,
// 			"scrollY":        "500px",
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
					var select = $('<select class="ml-2 mb-2" style="float:right;margin-top: 10px;"></select>')
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
	echo $mioasjd_kjawusl;
	?>
	<?php
	print_r($month_final)
	?>
</body>
</html>
