<?php
include "./database/sql.php";
if(isset($_POST["rows"]))
{
	session_start();
// 	date_default_timezone_set('Asia/Kolkata');
	$rows = $_POST["rows"];
	$conn = OpenCon();
	$count = 0;
	foreach ($rows as $id => $row) {
		$count += 1;
		$query = "UPDATE permission SET ";
		$changes = [];
		if(isset($row["user_permission"]) ) {
			    $user_permission = $row["user_permission"];
			    array_push($changes, "user_permission='$user_permission'");
		}
		if(isset($row["client_permission"])) {
			$client_permission = $row["client_permission"];
			array_push($changes, "client_permission='$client_permission'");
		}
		if(isset($row["collection_permission"])) {
			$collection_permission = $row["collection_permission"];
			array_push($changes, "collection_permission='$collection_permission'");
		}
		if(isset($row["revenue_permission"])) {
			$revenue_permission = $row["revenue_permission"];
			array_push($changes, "revenue_permission='$revenue_permission'");
		}
		if(isset($row["sap_permission"]) ) {
			    $sap_permission = $row["sap_permission"];
			    array_push($changes, "sap_permission='$sap_permission'");
		}
		$query .= join(", ", $changes)." WHERE id=$id";
		pg_query($conn, $query);

	}
	}
else {
	echo "0";
}
?>