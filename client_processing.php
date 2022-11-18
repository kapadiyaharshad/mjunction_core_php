<?php
include "./database/sql.php";
$params = $columns = $totalRecords = $data = array();
$params = $_REQUEST;
//define index of column
$columns = array(
	0 => 'ID',
	1 => 'Client Name',
	2 => 'Payer Code',
	3 => 'Account Type',
	4 => 'Business Segment',
	5 => 'Business Unit',
	6 => 'Services',
	7 => 'Category',
	8 => 'Profit Center'
);
$where = $sqlTot = $sqlRec = "";
// check search value exist
if (!empty($params['search']['value'])) {
	$where .= " WHERE ";
	// $where .= " ( clientname LIKE UPPER('%" . $params['search']['value'] . "%') "; UPPER(clientname)=UPPER('harshad') 
	// $where .= " OR clientname LIKE LOWER('%" . $params['search']['value'] . "%') ";
	$where .= " (UPPER(clientname)= UPPER('". $params['search']['value'] ."')";
	$where .= " OR LOWER(clientname)= LOWER('". $params['search']['value'] ."')";
	$where .= " OR clientname LIKE '%" . $params['search']['value'] . "%' ";

	$where .= " OR payercode LIKE '%" . $params['search']['value'] . "%' ";

	// $where .= " OR account_type LIKE UPPER('%" . $params['search']['value'] . "%') ";
	// $where .= " OR account_type LIKE LOWER('%" . $params['search']['value'] . "%') ";
	$where .= " OR account_type LIKE '%" . $params['search']['value'] . "%' ";

	// $where .= " OR business_segment LIKE UPPER('%" . $params['search']['value'] . "%') ";
	// $where .= " OR business_segment LIKE LOWER('%" . $params['search']['value'] . "%') ";
	$where .= " OR business_segment LIKE '%" . $params['search']['value'] . "%' ";

	// $where .= " OR business_unit LIKE UPPER('%" . $params['search']['value'] . "%') ";
	// $where .= " OR business_unit LIKE LOWER('%" . $params['search']['value'] . "%') ";
	$where .= " OR business_unit LIKE '%" . $params['search']['value'] . "%' ";

	// $where .= " OR services LIKE UPPER('%" . $params['search']['value'] . "%') ";
	// $where .= " OR services LIKE LOWER('%" . $params['search']['value'] . "%') ";
	$where .= " OR services LIKE '%" . $params['search']['value'] . "%' ";

	// $where .= " OR category LIKE UPPER('%" . $params['search']['value'] . "%') ";
	// $where .= " OR category LIKE LOWER('%" . $params['search']['value'] . "%') ";
	$where .= " OR category LIKE '%" . $params['search']['value'] . "%' ";

	$where .= " OR profit_center LIKE '%" . $params['search']['value'] . "%' )";
}

// getting total number records without any search
$sql = "SELECT id,clientname,payercode,account_type,business_segment,business_unit,services,category,profit_center FROM clients";
$sqlTot .= $sql;
$sqlRec .= $sql;
//concatenate search sql if value exist
if (isset($where) && $where != '') {
	$sqlTot .= $where;
	$sqlRec .= $where;
}
$limit = $params['draw'] * $params['length'];
$offset = $limit - $params['length'];
$sqlRec .= " ORDER BY id LIMIT " . $limit . " OFFSET " . $offset . " ";

//iterate on results row and create new index array of data
$conn = OpenCon();
$clienttot = pg_query($conn, $sqlTot);
$totalRecords = pg_num_rows($clienttot);

$client = pg_query($conn, $sqlRec);
$queryRecords = pg_fetch_all($client);
while ($row = pg_fetch_assoc($client)) {
	$array = [];
	foreach ($row as $value) {
		$array[] = $value;
	}
	$data[] = $array;
}
$json_data = array(
	"draw" => intval($params['draw']),
	"recordsTotal" => intval($totalRecords),
	"recordsFiltered" => intval($totalRecords),
	"data" => $data // total data array
);

echo json_encode($json_data);
