<?php
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}
setcookie ("remember_me",time() -  10 * 24 * 60 * 60);
setcookie ("login","logout",time() -  10 * 24 * 60 * 60); // 1 day
session_start();
session_destroy();
// $_SESSION['check']='no';
// 	echo '<script type = "text/javascript" >  
//     function preventBack() { window.history.forward(); }  
//     setTimeout("preventBack()", 0);  
//     window.onunload = function () { null };  
//     window.location = "/sales/login"
// </script> ';
header("Location: ./login");
// 	echo "<script>window.location.href = './login'</script>";

?>