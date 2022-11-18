<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
include "./database/sql.php";
// include "./components/side-bar.php";
include "./components/top-bar.php";
// if ($_COOKIE['check']!='yes') {
// 	echo "<script>window.location.href = './logout.php'</script>";
// }
$type = strtoupper($_COOKIE["type"]);
$email=$_COOKIE['email'];
$conn= OpenCon();
$flag = 0;
if ("ADMIN" == $type) 
{
	echo "<script>window.location.href = './summary'</script>";
}
else if ("AM" == $type) 
{
	echo "<script>window.location.href = './summary'</script>";

}
else if ("RM" == $type) 
{
	echo "<script>window.location.href = './summary'</script>";

}
else if ("BU" == $type) 
{
	echo "<script>window.location.href = './summary'</script>";

}
else if ("CU" == $type) 
{
	echo "<script>window.location.href = './summary'</script>";

}
else{
	echo "<script>window.location.href = './404'</script>";
}
// $conn = OpenCon();
// $result = pg_query($conn, "SELECT * FROM user_account ORDER BY id ASC");
// $arr_users = [];
// if (pg_num_rows($result) > 0) {
// 	$arr_users = pg_fetch_all($result);
// }
?>
<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--	<title>Home</title>-->
<!--	<meta name="viewport" content="width=device-width, initial-scale=1.0">-->

	<!-- CSS -->
<!--	<link rel="stylesheet" href="./css/index.css">-->
<!--	<link rel="stylesheet" href="./css/home.css">-->

	<!-- JS -->
<!--	<script src="./js/main.js"></script>-->

	<!-- Bootstrap -->
<!--	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">-->
<!--	<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>-->

	<!-- jQuery -->
<!--	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>-->

	<!-- Font Awesome -->
<!--	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />-->

	<!-- Data Table  -->
<!--	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> -->
<!--	<script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>-->
<!--</head>-->
<!--<body>-->
<!--	<div class="container-main">-->
		<!-- <?php 
		// SideBar('home'); 
		?> -->
<!--		<?php
// TopBar('home');-->
		 ?>
		<!-- <div class="content">-->
<!--			<div class="cards-wrapper px-4">-->
<!--				<div class="graph-card order-card mx-2 p-3">-->
<!--					<div class="card-title">Collections</div>-->
<!--					<div class="card-value">276k</div>-->
<!--				</div>-->
<!--				<div class="graph-card profit-card mx-2 p-3">-->
<!--					<div class="card-title">Revenues</div>-->
<!--					<div class="card-value">276k</div>-->
<!--				</div>-->
<!--				<div class="graph-card stats-card mx-2 p-3">-->
<!--					<div class="card-title">Statistics</div>-->
<!--					<div class="d-flex justify-content-around flex-wrap">-->
<!--						<div class="d-flex justify-content-center align-items-center stat-item">-->
<!--							<div class="stat-icon stat-blue mr-3">-->
<!--								<i class="fas fa-chart-line"></i>-->
<!--							</div>-->
<!--							<div>-->
<!--								<div class="stat-value">230k</div>-->
<!--								<div class="stat-name">Business Units</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="d-flex justify-content-center align-items-center stat-item">-->
<!--							<div class="stat-icon stat-blue mr-3">-->
<!--								<i class="fas fa-chart-line"></i>-->
<!--							</div>-->
<!--							<div>-->
<!--								<div class="stat-value">230k</div>-->
<!--								<div class="stat-name">Region</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="d-flex justify-content-center align-items-center stat-item">-->
<!--							<div class="stat-icon stat-blue mr-3">-->
<!--								<i class="fas fa-chart-line"></i>-->
<!--							</div>-->
<!--							<div>-->
<!--								<div class="stat-value">230k</div>-->
<!--								<div class="stat-name">Accounts</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="d-flex justify-content-center align-items-center stat-item">-->
<!--							<div class="stat-icon stat-blue mr-3">-->
<!--								<i class="fas fa-chart-line"></i>-->
<!--							</div>-->
<!--							<div>-->
<!--								<div class="stat-value">2k</div>-->
<!--								<div class="stat-name">Business User</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="d-flex justify-content-center align-items-center stat-item">-->
<!--							<div class="stat-icon stat-blue mr-3">-->
<!--								<i class="fas fa-chart-line"></i>-->
<!--							</div>-->
<!--							<div>-->
<!--								<div class="stat-value">2k</div>-->
<!--								<div class="stat-name">Regional Account Manger</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="d-flex justify-content-center align-items-center stat-item">-->
<!--							<div class="stat-icon stat-blue mr-3">-->
<!--								<i class="fas fa-chart-line"></i>-->
<!--							</div>-->
<!--							<div>-->
<!--								<div class="stat-value">2k</div>-->
<!--								<div class="stat-name">Sales</div>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>
	<?php
	// echo $_COOKIE['last_login_timestamp'];
// echo "<br>";
// echo time();
	?>
<!--	<script>-->
<!--		$(document).ready(function() {-->
<!--			$('#userTable').DataTable();-->
<!--		});-->

<!--	</script>-->
<!--</body>-->
<!--</html>-->