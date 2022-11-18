<?php
    include "./database/sql.php";
    include "./components/top-bar.php";
    date_default_timezone_set('Asia/Kolkata');
    // fetching data from collection table
    $conn = OpenCon();
    $type=$_COOKIE['type'];
    $email=$_COOKIE['email'];
    $result = pg_query($conn,"SELECT * FROM permission where account_type='$type'");
    // $editpermission = false;
    // $importpermission= false;
    // $exportpermission=false;
    $isfreezed_query = pg_query($conn, "SELECT * FROM revenue_freeze LIMIT 1");
    $data = pg_fetch_all($isfreezed_query)[0];
    $freeze_by = strtotime($data["freeze_by"]);
    $isfreezed = $data["freeze_or_not"] == "yes" && strtotime(date("Y-m-d H:i:s")) > $freeze_by;
    if (pg_num_rows($result)>0) 
    {
    	while ($row = pg_fetch_assoc($result)) 
    	{
    		$editpermission=$row['edit_check'] == '1';
    		$importpermission = $row['import_check'] == '1';
		    $exportpermission = $row['export_check'] == '1';
    	}
    }
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
        $result = pg_query($conn,"SELECT rt.*, a.target_amount as target_amount FROM revenue_table rt LEFT OUTER JOIN abp a ON rt.month = a.month AND LOWER(rt.client_name) = LOWER(a.client_name) where lower(rt.client_name) = any(array$j) ORDER BY id asc;");
        $arr_collection = pg_fetch_all($result);
        $history_permission = false;
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
        $result = pg_query($conn,"SELECT rt.*, a.target_amount as target_amount FROM revenue_table rt LEFT OUTER JOIN abp a ON rt.month = a.month AND LOWER(rt.client_name) = LOWER(a.client_name)  WHERE lower(rt.account_type) = ANY('"."{".$accounttype."}"."') ORDER BY id asc;");
        $arr_collection = pg_fetch_all($result);
        while($row = pg_fetch_assoc($result)) {
            $history = pg_query($conn, "SELECT * FROM revised_history_revenue where meta_id=".$row["id"]."");
            $row["history"] = pg_fetch_all($history);
            $history_permission = true;
        }
    }
    else if($type == 'BU')
    {
        $result = pg_query($conn,"SELECT * FROM user_account where email='$email'");
        if (pg_num_rows($result)>0) 
        {
        	while ($row = pg_fetch_assoc($result)) 
        	{
        		$bu=$row['bu'];
        	}
        }
        $result = pg_query($conn,"SELECT rt.*, a.target_amount as target_amount FROM revenue_table rt LEFT OUTER JOIN abp a ON rt.month = a.month AND LOWER(rt.client_name) = LOWER(a.client_name) where rt.business = ANY('" . "{" . $bu . "}" . "'::text[]) ORDER BY id asc;");
        // echo "SELECT * FROM collection where bu = ANY('" . "{" . $bu . "}" . "'::text[]) order by create_date desc nulls last";
        $arr_collection = pg_fetch_all($result);
        while($row = pg_fetch_assoc($result)) {
            $history = pg_query($conn, "SELECT * FROM revised_history_revenue where meta_id=".$row["id"]."");
            $row["history"] = pg_fetch_all($history);
            $history_permission = true;
        }
    }
    else if($type == 'CU')
    {
        $result = pg_query($conn,"SELECT rt.*, a.target_amount as target_amount FROM revenue_table rt LEFT OUTER JOIN abp a ON rt.month = a.month AND LOWER(rt.client_name) = LOWER(a.client_name) ORDER BY id asc;");
        $arr_collection = pg_fetch_all($result);
        $history_permission = false;
    }
    else if($type == 'ADMIN')
    {
        $result = pg_query($conn,"SELECT rt.*, a.target_amount as target_amount,a_v.target_amount as a_v_target_amount FROM revenue_table rt LEFT OUTER JOIN abp a ON rt.month = a.month AND LOWER(rt.client_name) = LOWER(a.client_name) LEFT OUTER JOIN abp_vaor a_v ON rt.month = a_v.month AND LOWER(rt.client_name) = LOWER(a_v.client_name) ORDER BY id asc;");
        $arr_collection = [];
        while($row = pg_fetch_assoc($result)) {
            
            $row['assumption_am'] = str_replace ("\"","'",$row["assumption_am"]);
            $row['assumption_rm'] = str_replace ("\"","'",$row["assumption_rm"]);
            $row['assumption_bu'] = str_replace ("\"","'",$row["assumption_bu"]);
            $history = pg_query($conn, "SELECT * FROM revised_history_revenue where meta_id=".$row["id"]."");
            $row["history"] = pg_fetch_all($history);
            array_push($arr_collection, $row);
            $history_permission = true;
            
        }
    }
    $response = array(
        "data" => $arr_collection,
        "edit_permission" => $editpermission,
        "role" => $_COOKIE["type"],
        "import_permission" => $importpermission,
        "export_permission" => $exportpermission,
        "history_permission" => $history_permission,
        "is_freezed" => $isfreezed
    );
    echo json_encode($response);
?>