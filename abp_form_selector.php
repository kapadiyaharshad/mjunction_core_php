<?php
    include "./database/sql.php";
    $conn = OpenCon();
    $value = $_POST["value"];
    $type = $_POST["type"];
    $bu = $_POST["bu"];
    if($type == "business_unit")
        $query = "SELECT * FROM clients WHERE $type = '$value'";
    else
        $query = "SELECT * FROM clients WHERE $type = '$value' AND business_unit='$bu'";
    $result = pg_query($conn, $query);
    $data = [];
    while($row = pg_fetch_assoc($result)) {
        array_push($data, $type == "business_unit" ? $row["profit_center"] : [$row["clientname"], $row["payercode"]]);
    }
    echo json_encode($data);
?>