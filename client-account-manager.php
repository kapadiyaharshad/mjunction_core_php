<?php
    include "./database/sql.php";
    $conn=OpenCon();
    $accountType = 'AM-'.$_POST["accountType"];
    $sql = pg_query($conn,"SELECT * FROM user_account where accountType like '%$accountType%' AND desgnation='AM' order by id ASC");
    $arr = [];
    if (pg_num_rows($sql)>0) 
	{
		while ($row = pg_fetch_assoc($sql)) 
		{	$data=[$row['id'], $row['fname'].' '.$row['lname']];
		     array_push($arr, $data);
		}
	}
    echo json_encode($arr);
?>