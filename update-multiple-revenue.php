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
		$query = "UPDATE revenue_table SET ";
		$changes = [];
		if(isset($row["am_projection"])) {
			$am_projection = $row["am_projection"];
			array_push($changes, "am_projection='$am_projection'");
		}
		if(isset($row["rm_projection"])) {
			$rm_projection = $row["rm_projection"];
			array_push($changes, "rm_projection='$rm_projection'");
		}
		if(isset($row["bu_projection"])) {
			$bu_projection = $row["bu_projection"];
			array_push($changes, "bu_projection='$bu_projection'");
		}
		if(isset($row["revised_estimate"])) {
			$revised_estimate = $row["revised_estimate"];
			array_push($changes, "revised_estimate='$revised_estimate'");
		}
		if(isset($row["original_estimate"])) {
			$original_estimate = $row["original_estimate"];
			array_push($changes, "original_estimate='$original_estimate'");
		}
		if(isset($row["revised_estimate_voar"])) {
			$revised_estimate_voar = $row["revised_estimate_voar"];
			array_push($changes, "revised_estimate_voar='$revised_estimate_voar'");
		}
		if(isset($row["original_estimate_voar"])) {
			$original_estimate_voar = $row["original_estimate_voar"];
			array_push($changes, "original_estimate_voar='$original_estimate_voar'");
		}
		if(isset($row["assumption_am"])) {
			// $assumption_am = $row["assumption_am"];
			$assumption_am = str_replace ("'","\"",$row["assumption_am"]);
			array_push($changes, "assumption_am='$assumption_am'");
		}
		if(isset($row["assumption_rm"])) {
			// $assumption_rm = $row["assumption_rm"];
			$assumption_rm = str_replace ("'","\"",$row["assumption_rm"]);
			array_push($changes, "assumption_rm='$assumption_rm'");
		}
		if(isset($row["assumption_bu"])) {
			// $assumption_bu = $row["assumption_bu"];
			$assumption_bu = str_replace ("'","\"",$row["assumption_bu"]);
			array_push($changes, "assumption_bu='$assumption_bu'");
		}
		$date = date("Y/m/d H:i:s");
		$name=$_COOKIE['username'];
		$checkQuery="SELECT revised_estimate from revenue_table where id=$id";
		$val = pg_query($conn, $checkQuery);
		$prevValue = pg_fetch_all($val)[0]["revised_estimate"];
		if(isset($row["revised_estimate"]) && $prevValue != $row["revised_estimate"]) {
			$trigger_query = "
				INSERT INTO revised_history_revenue 
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