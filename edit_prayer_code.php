<?php
include "./database/sql.php";
$conn = OpenCon();
date_default_timezone_set('Asia/Kolkata');

if (!empty($_POST['editid'])) {
    $id = $_POST['editid'];
    $sel = pg_query($conn, "select * from static_master_payer_code where id=$id");
    $data = pg_fetch_assoc($sel);
    if ($data) {
        echo json_encode($data);
    }
}

if (!empty($_POST['payer_code']) && !empty($_POST['update_prayer_code'])) {
    $pcenter = $_POST["payer_code"];
    $sql = pg_query($conn, "SELECT * FROM static_master_payer_code");
    $already = 0;
    $id = $_POST['id'];
    if (pg_num_rows($sql) > 0) {
        while ($row = pg_fetch_assoc($sql)) {
            if ($row["payer_code"] == $_POST["payer_code"]) {
                $already = 1;
            }
        }
    }

    if ($already != 1) {
        $payer_code = $_POST['payer_code'];
        $result = pg_query($conn, "UPDATE static_master_payer_code SET payer_code=$payer_code WHERE id=$id");
        if ($result) {
            echo "updated";
        } else {
            echo "wrong";
        }
    } else {
        echo "alredy";
    }
}
if (!empty($_POST['delid'])) {
    $id = $_POST['delid'];
    if (pg_query($conn, "DELETE FROM static_master_payer_code WHERE id=$id")) {
        echo "delete";
    } else {
        echo "delete";
    }
}
