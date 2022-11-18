<?php
include "./database/sql.php";
if(isset($_POST["rows"]))
{
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	$rows = $_POST["rows"];
	$conn = OpenCon();
	$count = 0;
	foreach ($rows as $id => $row) {
		$count += 1;
		$query = "UPDATE collection SET ";
		$changes = [];
		if(isset($row["actual_collection_f_a"])) {
			$actual_collection_f_a = $row["actual_collection_f_a"];
			array_push($changes, "actual_collection_f_a='$actual_collection_f_a'");
		}
		if(isset($row["am_estimate"])) {
			$am_estimate = $row["am_estimate"];
			array_push($changes, "am_estimate='$am_estimate'");
		}
		if(isset($row["assumptions"])) {
			$assumptions = $row["assumptions"];
			array_push($changes, "assumptions='$assumptions'");
		}
		if(isset($row["revised_estimate"])) {
			$revised_estimate = $row["revised_estimate"];
			array_push($changes, "revised_estimate='$revised_estimate'");
		}
		if(isset($row["original_estimate"])) {
			$original_estimate = $row["original_estimate"];
			array_push($changes, "original_estimate='$original_estimate'");
		}
		if(isset($row["remarks"])) {
			$remarks = $row["remarks"];
			array_push($changes, "remarks='$remarks'");
		}
		$date = date("Y/m/d H:i:s");
		$name=$_COOKIE['username'];
		$checkQuery="SELECT revised_estimate from collection where id=$id";
		$val = pg_query($conn, $checkQuery);
		$prevValue = pg_fetch_all($val)[0]["revised_estimate"];
		if(isset($row["revised_estimate"]) && $prevValue != $row["revised_estimate"]) {
			$trigger_query = "
				INSERT INTO revised_history 
				(modified_by, modified_date, previous_value, current_value, field, meta_id) 
				VALUES ('$name', '$date', (SELECT revised_estimate FROM collection WHERE id=$id), '".$row["revised_estimate"]."', 'revised_estimate', $id)";
			pg_query($conn, $trigger_query);
		}
		$query .= join(", ", $changes)." ,last_modified='$date' ,modified_by='$name' WHERE id=$id";
		pg_query($conn, $query);

	}
	echo $count;
}
else {
	echo "0";
}
?>