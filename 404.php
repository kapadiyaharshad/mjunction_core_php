
<!DOCTYPE html>
<html>
<head>
	<title>Revenue</title>
	<!-- CSS -->
	<link rel="stylesheet" href="./css/index.css">
	<link rel="stylesheet" href="./css/collections.css">
	<!-- JS -->
	<script src="./js/main.js"></script>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

	<!-- Data Table  -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> 
	<script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	
	<style type="text/css">
		@import "compass/css3";
 html, body {
	 margin: 0;
	 padding: 0;
	 width: 100%;
	 height: 100%;
}
 @keyframes bob {
	 0% {
		 top: 0;
	}
	 50% {
		 top: 0.2em;
	}
}
 body {
	 background: #aeaec7;
	 vertical-align: middle;
	 text-align: center;
	 transform: translate3d(0, 0, 0);
}
 body:before {
	 content: '';
	 display: inline-block;
	 height: 100%;
	 vertical-align: middle;
	 margin-right: -0.25em;
}
 .scene {
	 display: inline-block;
	 vertical-align: middle;
}
 .text {
	 color: white;
	 font-size: 2em;
	 font-family: helvetica;
	 font-weight: bold;
}
 .sheep {
	 display: inline-block;
	 position: relative;
	 font-size: 1em;
}
 .sheep * {
	 transition: transform 0.3s;
}
 .sheep .top {
	 position: relative;
	 top: 0;
	 animation: bob 1s infinite;
}
 .sheep:hover .head {
	 transform: rotate(0deg);
}
 .sheep:hover .head .eye {
	 width: 1.25em;
	 height: 1.25em;
}
 .sheep:hover .head .eye:before {
	 right: 30%;
}
 .sheep:hover .top {
	 animation-play-state: paused;
}
 .sheep .head {
	 display: inline-block;
	 width: 5em;
	 height: 5em;
	 border-radius: 100%;
	 background: #211e21;
	 vertical-align: middle;
	 position: relative;
	 top: 1em;
	 transform: rotate(30deg);
}
 .sheep .head:before {
	 content: '';
	 display: inline-block;
	 width: 80%;
	 height: 50%;
	 background: #211e21;
	 position: absolute;
	 bottom: 0;
	 right: -10%;
	 border-radius: 50% 40%;
}
 .sheep .head:hover .ear.one, .sheep .head:hover .ear.two {
	 transform: rotate(0deg);
}
 .sheep .head .eye {
	 display: inline-block;
	 width: 1em;
	 height: 1em;
	 border-radius: 100%;
	 background: white;
	 position: absolute;
	 overflow: hidden;
}
 .sheep .head .eye:before {
	 content: '';
	 display: inline-block;
	 background: black;
	 width: 50%;
	 height: 50%;
	 border-radius: 100%;
	 position: absolute;
	 right: 10%;
	 bottom: 10%;
	 transition: all 0.3s;
}
 .sheep .head .eye.one {
	 right: -2%;
	 top: 1.7em;
}
 .sheep .head .eye.two {
	 right: 2.5em;
	 top: 1.7em;
}
 .sheep .head .ear {
	 background: #211e21;
	 width: 50%;
	 height: 30%;
	 border-radius: 100%;
	 position: absolute;
}
 .sheep .head .ear.one {
	 left: -10%;
	 top: 5%;
	 transform: rotate(-30deg);
}
 .sheep .head .ear.two {
	 top: 2%;
	 right: -5%;
	 transform: rotate(20deg);
}
 .sheep .body {
	 display: inline-block;
	 width: 7em;
	 height: 7em;
	 border-radius: 100%;
	 background: white;
	 position: relative;
	 vertical-align: middle;
	 margin-right: -3em;
}
 .sheep .legs {
	 display: inline-block;
	 position: absolute;
	 top: 80%;
	 left: 10%;
	 z-index: -1;
}
 .sheep .legs .leg {
	 display: inline-block;
	 background: #141214;
	 width: 0.5em;
	 height: 2.5em;
	 margin: 0.2em;
}
 .sheep:before {
	 content: '';
	 display: inline-block;
	 position: absolute;
	 top: 112%;
	 width: 100%;
	 height: 10%;
	 border-radius: 100%;
	 background: rgba(0, 0, 0, 0.4);
}
button{
    background-color:#2d3c75; 
	height:50px;
	width:150px;
	border:4px solid white;
	border-radius:25px;color:#fff;    
    transition: 0.5s;
    outline:none !important;
}
/* button:hover{
    color:#53BFE0;
    outline:none;
    background-color: white;
    box-shadow: 5px 5px #55686d;
} */
a{
    text-decoration: none;
    outline:none;
}
 
	</style>
</head>
<body>
	<!--<div class="container-main">-->
			<div class="scene">
			    <!-- <div class="text">404</div>
			  <div class="text">Page Not Found!</div>
			  <br><br> -->
			  <!--<div class="text">DO NOT TOUCH</div>-->
			  <div>
			  <img src="images/404.jpg" alt="404-page" />
			  </div>
			</div>
			
	<!--</div>-->
	<div style='margin-top:-150px;'><a href="login"><button class="butsty" ><b>Go to Login</b></button></a></div>
</body>
</html>