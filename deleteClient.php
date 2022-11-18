<?php
include "./database/sql.php";
$conn = OpenCon();
pg_query($conn, "DELETE FROM clients WHERE id=".$_GET['id']);
header('Location: ./clients');
?>