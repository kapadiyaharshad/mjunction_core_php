<?php
include "./database/sql.php";
// $cookie_data=$_COOKIE;

// if(empty($cookie_data['login'])){
//     echo "<script>window.location.href = './login'</script>";  
// }

$conn = OpenCon();
$month = date('M-Y');
$count = 0;
$revenue_sql = pg_query($conn, "SELECT * FROM revenue_table WHERE month=" . "'$month'");
if (pg_num_rows($revenue_sql) == 0) {
    $sql = pg_query($conn, "SELECT clientname,business_segment,services,business_unit,account_type,category FROM clients");
    if (pg_num_rows($sql) > 0) {
        while ($row = pg_fetch_array($sql)) {
           
            $client_name = $row['clientname'];
            $abp_query = "SELECT a.target_amount FROM abp a LEFT JOIN clients c ON a.client_name = c.clientname  LEFT JOIN abp_vaor a_v ON c.clientname=a_v.client_name WHERE a.client_name=" . "'$client_name'";
            $result = pg_query($conn, $abp_query);
            $row_abp = pg_fetch_assoc($result);
            if($row_abp['target_amount'] && !empty($row_abp['target_amount'])){
                $abp = $row_abp['target_amount'];
            }
            else{
                $abp = 0;
            }
            
            $ec_nc_name = isset($row['business_segment']) ? $row['business_segment'] : '';
            //get vaor percentage
            $bu = isset($row['business_unit']) ? $row['business_unit'] : '';
            $services = isset($row['services']) ? $row['services'] : '';

            $vaor_percentage_query = "SELECT percentage FROM voar_percentage WHERE bu='" . $bu . "' AND services='" . $services . "'";
            $vaor_percentage_result = pg_query($conn, $vaor_percentage_query);
            if (pg_num_rows($vaor_percentage_result) > 0) {
                $row_data = pg_fetch_row($vaor_percentage_result);
                   $voar_percentage = $row_data[0];
            }
            else{
                $voar_percentage = 100;
            }
            $revenue_data_array[] = [
                'month' => $month,
                'ecnc' => $ec_nc_name,
                'category' => isset($row['category']) ? $row['category'] : '',
                'business' => $bu,
                'service' =>  $services,
                'account_type' => isset($row['account_type']) ? $row['account_type'] : '',
                'client_name' => $client_name,
                'voar_percentage' => $voar_percentage,
                'abp' => $abp
            ];
        }
    }
    if (count($revenue_data_array) > 0) {
        foreach ($revenue_data_array as $val) {
            $month = $val['month'];
            $ec_nc_name =  $val['ecnc'];
            $client_category =  $val['category'];
            $client_bu =  $val['business'];
            $client_service =  $val['service'];
            $client_account_type =  $val['account_type'];
            $client_name =  $val['client_name'];
            $voar_percentage = $val['voar_percentage'];
            $abp = $val['abp'];
            $insert_revenue = "
                INSERT INTO revenue_table 
                (month,ecnc,category, business, service, account_type, client_name,voar_percentage,abp)
                VALUES('$month','$ec_nc_name','$client_category','$client_bu','$client_service','$client_account_type','$client_name',$voar_percentage,$abp)";
            $insert = pg_query($conn, $insert_revenue);
            if($insert){
                $count++;
            }
        }
        echo $count." Row(s) has been Inserted..";
    }
} else {
    echo "Data already is there";
}
