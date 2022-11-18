<?php
include "./database/sql.php";
$conn = OpenCon();
pg_query($conn, "DELETE FROM user_account WHERE id=".$_GET['id']);
header('Location: ./users');
?>