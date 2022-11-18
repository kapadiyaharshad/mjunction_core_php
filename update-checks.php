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
		if(isset($row["view_check"]) ) {
			    $view_check = $row["view_check"];
			    array_push($changes, "view_check='$view_check'");
		}
		if(isset($row["edit_check"]) ) {
			    $edit_check = $row["edit_check"];
			    array_push($changes, "edit_check='$edit_check'");
		}
		if(isset($row["delete_check"])) {
			$delete_check = $row["delete_check"];
			array_push($changes, "delete_check='$delete_check'");
		}
		if(isset($row["import_check"])) {
			$import_check = $row["import_check"];
			array_push($changes, "import_check='$import_check'");
		}
		if(isset($row["export_check"])) {
			$export_check = $row["export_check"];
			array_push($changes, "export_check='$export_check'");
		}
		$query .= join(", ", $changes)." WHERE id=$id";
		pg_query($conn, $query);

	}
	}
else {
	echo "0";
}
?>