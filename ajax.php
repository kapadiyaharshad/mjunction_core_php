<?php
include "./database/sql.php";
$conn = OpenCon();
date_default_timezone_set('Asia/Kolkata');

if(!empty($_POST['editid']))
{
    $id=$_POST['editid'];
    $sel=pg_query($conn,"select * from static_master_profit_center where id=$id");
    $data=pg_fetch_assoc($sel);
    if($data){
        echo json_encode($data);
    }
}

if(!empty($_POST['pcenter'])&& !empty($_POST['update_profit_center']))
{
    $pcenter = $_POST["pcenter"];
    $sql = pg_query($conn, "SELECT * FROM static_master_profit_center");
    $already = 0;
    $id=$_POST['id'];
    if (pg_num_rows($sql) > 0) {
        while ($row = pg_fetch_assoc($sql)) {
            if ($row["profit_center"] == $_POST["pcenter"]) {
                $already = 1;
            }
        }
    }

    if ($already != 1) {
        $profit_center = $_POST['pcenter'];
        $result = pg_query($conn,"update static_master_profit_center set profit_center=$pcenter where id=$id");
        if ($result) {
       
            echo "updated";
            

        } else {
            echo "wrong"; 
        }
    } else {
        echo "alredy"; 
    }
}
if(!empty($_POST['delid']))
{
    $id=$_POST['delid'];
    if(pg_query($conn,"delete from static_master_profit_center where id=$id")){
        echo "delete";
    }
    else {
        echo "delete";
    }
}
?>