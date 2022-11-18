<?php
include "./database/sql.php";
$conn = OpenCon();
pg_query($conn, "DELETE FROM voar_percentage WHERE id=".$_GET['id']);
header('Location: ./voar_percentage');
?>