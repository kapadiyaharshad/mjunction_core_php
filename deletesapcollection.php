<?php
include "./database/sql.php";
$conn = OpenCon();
$deleteQuary = "UPDATE import_record SET show = 'no' WHERE id=".$_GET['id'];
pg_query($conn, $deleteQuary);
header('Location: ./sap-dump');
?>