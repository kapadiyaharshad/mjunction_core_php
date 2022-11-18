<?php
// session_start();
$conn = OpenCon();
$email=$_COOKIE['email'];
$result = pg_query($conn,"SELECT * FROM user_account where email='$email'");
if(!isset ($_COOKIE["login"])){
     echo "<script>window.location.href = './logout'</script>";  
}
// echo "<pre>";
// print_r($_COOKIE);
if($_COOKIE["remember_me"]!='remember_me' && $_COOKIE["login"]=='login')
{
    if((time() - $_COOKIE["remember_me"]) > 3600) // 3600 = 60 * 60  
    {  
        echo "<script>window.location.href = './logout'</script>";  
    }  
    //not required becasue of alreday data store in cookie with same name time
    // else  
    // {  
    //  	setcookie ("remember_me",time());
    // }  
} 
    
function TopBar($current) {
    $conn = OpenCon();
      $type = strtoupper($_COOKIE["type"]);
      $user_sql = pg_query($conn,"SELECT * FROM permission where account_type='$type'");
      if (pg_num_rows($user_sql)>0) 
      {
	      while ($user_row = pg_fetch_assoc($user_sql)) 
	      {
		      $user_permission=       $user_row['user_permission'];
		      $client_permission=     $user_row['client_permission'];
		      $collection_permission= $user_row['collection_permission'];
		      $revenue_permission=    $user_row['revenue_permission'];
		      $sap_permission=        $user_row['sap_permission'];
		   }
	   }
  echo '
  <style>
  a{
    color:black;
    text-decoration:none;
 }
 .top-bar {
    position: fixed;
    top: 0;
    background: white;
    box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%);
    width:  100vw;
    border-radius: 4px;
    z-index: 100;
    padding: .8rem 1.5rem;
    height: 4rem;
 }

 .toggle-button{
    outline:none;
    border:none;
 }

 .avatar {
    width: 30px;
    height: 30px;
    border-radius: 30px;
 }

 .user-name {
    color: #6E6B7B;
    margin-bottom: -0.2rem;
    text-transform: capitalize;
 }

 .user-type {
    font-size: smaller;
    color: #6E6B7B;
    text-transform: capitalize;
 }

 .nav-link:hover{
    background-image:linear-gradient(to left ,rgb(90, 105, 243,0.2),rgb(121, 133, 242,0.2));
    box-shadow: 0 0 10px 1px rgb(115 103 240 / 30%);
 }
 .navbar {
    width: 16rem;
    height: 90vh;
    background: white;
    position: fixed;
    top: 4rem;
    transition: 0.3s;
    z-index: 50;
    background-image: linear-gradient(to top,rgba(90, 105, 243,0.2),white);

 }
 .navbar-text {
    margin-left: 0.25rem;
 }
 .toggle-button {
    border: none;
    background: transparent;
 }
 .navbar-nav {
    padding: 1rem;
 }
 .navbar-nav > .nav-link {
    text-align: left !important;
    font-size: 1.1em;
    color: #343434;
 }
 .navbar-nav > .nav-link:hover {
    transition: 0.5s;
 }
 .nav-link.active {
    background: linear-gradient(118deg,#7367F0,rgba(115,103,240,.7));
    box-shadow: 0 0 10px 1px rgb(115 103 240 / 70%);
    border-radius: 4px;
    color: white;
 }

 .nav-link.active:hover {
    background: linear-gradient(118deg,#7367F0,rgba(115,103,240,.7));
    box-shadow: 0 0 10px 1px rgb(115 103 240 / 70%);
    border-radius: 4px;
    color: white;
 }


 .dropbtn {
    background-color: transparent;
    color: black;
    font-size: 16px;
    border: none;
 }

 .dropdown {
    position: relative;
    display: inline-block;
 }

 .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    width: 190px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
 }

 .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
 }

 .dropdown-content a:hover {color: #024DBC;}
 .dropdown:hover .dropdown-content {display: block;}



 @media only screen and (max-width: 600px) {
    .navbar {
      margin-left: -18rem;
   }
   .navbar.collapsed {
      margin-left: 0rem !important;
   }
   .user-name {
      margin-bottom: 0px;
      font-size: 0.8em;
   }
   .user-type {
      font-size: 0.6em;
   }
}
</style>		
<div class="top-bar">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-between align-items-center" >
            <a href="index"><img height="40" width="100" src="./components/logo.png"></a>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <a class="nav-link '.($current == 'summary' ? 'active': '').'"  href="index"><i class="fas fa-home pr-1"></i> <span class="navbar-text">Summary</span></a>
        </div>
        ';
    if($collection_permission==1)
    {
     echo '
        <div class="dropdown">
            <button class="dropbtn"><a class="nav-link '.($current == 'collections' ? 'active': '').'"  href="collection-table"><i class="fas fa-sticky-note"></i> <span class="navbar-text">Collections</span></a></button>
            <div class="dropdown-content">
                <a class="nav-link "  href="collection-table"><i class="fas fa-users"></i> <span class="navbar-text">Collection</span></a>
                <a class="nav-link" 	href="collection_review"><i class="fas fa-user-plus"></i> <span class="navbar-text">Collection Review</span></a>
            </div>
        </div>
        
        ';
    }
    if($revenue_permission==1){
    echo '
        <div class="dropdown">
            <button class="dropbtn"><a class="nav-link '.($current == 'revenue' ? 'active': '').'"  href="revenue"><i class="fas fa-coins"></i> <span class="navbar-text">Revenue</span></a></button>
            <div class="dropdown-content">
                <a class="nav-link"  href="revenue"><i class="fas fa-server"></i> <span class="navbar-text">Revenue</span></a>
                <a class="nav-link"  href="abp"><i class="fas fa-users"></i> <span class="navbar-text">ABP</span></a>
                <a class="nav-link"  href="revenue_review"><i class="fas fa-users"></i> <span class="navbar-text">Revenue Review</span></a>
                <a class="nav-link"  href="voar_percentage"><i class="fas fa-users"></i> <span class="navbar-text">VOAR Percentage</span></a>
                
            </div>
        </div>
    ';
    }
    if($sap_permission==1){
    echo '<a class="nav-link '.($current == 'sap-dump' ? 'active': '').'"  href="sap-dump"><i class="fas fa-server"></i> <span class="navbar-text">SAP Dump</span></a>
    ';
    }
    if($client_permission==1){
    echo '
        <div class="dropdown">
            <button class="dropbtn"><a class="nav-link '.($current == 'clients' ? 'active': '').'"  href="clients"><i class="fas fa-users"></i> <span class="navbar-text">Clients</span></a></button>
            <div class="dropdown-content">
                <a class="nav-link "  href="clients"><i class="fas fa-users"></i> <span class="navbar-text">Clients</span></a>
                <a class="nav-link" 	href="add-client"><i class="fas fa-user-plus"></i> <span class="navbar-text">Add Client</span></a>
                <a class="nav-link"  href="add-profit_center"><i class="fas fa-users"></i> <span class="navbar-text">Add Profit Center</span></a>
                <a class="nav-link"  href="add_payer_code"><i class="fas fa-users"></i> <span class="navbar-text">Add Payer Coder</span></a>
            </div>
        </div>';
       	} 
   	if($user_permission==1){
         echo '

        <div class="dropdown">
            <button class="dropbtn"><a class="nav-link '.($current == 'user' ? 'active': '').'"  href="users"><i class="fas fa-user"></i> <span class="navbar-text">Users</span></a></button>
            <div class="dropdown-content">
                <a class="nav-link "  href="users"><i class="fas fa-user"></i><span class="navbar-text">Users</span></a>
                <a class="nav-link "  href="add-user"><i class="fas fa-user-plus"></i><span class="navbar-text">Add User</span></a>
                <a class="nav-link "  href="user-accessibility"><i class="fas fa-clipboard"></i><span class="navbar-text">User Control</span></a>

            </div>
        </div>';
        }
        echo '
        <div class="dropdown">
            <div class="d-flex justify-content-end align-items-center">
                <div class="d-flex flex-column align-items-end pr-3">
                    <div class="user-name font-weight-bolder">'.$_COOKIE["username"].'</div>
                    <div class="user-type">'.$_COOKIE["type"].'</div>
                </div>
                <img class="avatar" src="./images/user-icon.png" />
            </div>
            <div class="dropdown-content">
                <a class="nav-link" href="logout"><i class="fas fa-sign-out-alt pr-1"></i> <span class="navbar-text">Logout</span></a>
            </div>
        </div>
    </div>
</div>';
}
function nTopBar($current) 
{
    $conn = OpenCon();
    $type = strtoupper($_COOKIE["type"]);
    $user_sql = pg_query($conn,"SELECT * FROM permission where account_type='$type'");
    if (pg_num_rows($user_sql)>0) 
    {
	    while ($user_row = pg_fetch_assoc($user_sql)) 
	    {
	     $user_permission=       $user_row['user_permission'];
	     $client_permission=     $user_row['client_permission'];
	     $collection_permission= $user_row['collection_permission'];
	     $revenue_permission=    $user_row['revenue_permission'];
	     $sap_permission=        $user_row['sap_permission'];
	     $view_permission=       $user_row['view_check'];
	  }
	}
   	echo '
   	<style>
   	a{
   		color:black;
   		text-decoration:none;
   	}
   	.top-bar {
   		position: fixed;
   		top: 0;
   		background: white;
   		box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%);
   		width:  100vw;
   		border-radius: 4px;
   		z-index: 100;
   		padding: .8rem 1.5rem;
   		height: 4rem;
   	}

   	.toggle-button{
   		outline:none;
   		border:none;
   	}

   	.avatar {
   		width: 30px;
   		height: 30px;
   		border-radius: 30px;
   	}

   	.user-name {
   		color: #6E6B7B;
   		margin-bottom: -0.2rem;
   		text-transform: capitalize;
   	}

   	.user-type {
   		font-size: smaller;
   		color: #6E6B7B;
   		text-transform: capitalize;
   	}

   	.nav-link:hover{
   		background-image:linear-gradient(to left ,rgb(90, 105, 243,0.2),rgb(121, 133, 242,0.2));
   		box-shadow: 0 0 10px 1px rgb(115 103 240 / 30%);
   	}
   	.navbar {
   		width: 16rem;
   		height: 90vh;
   		background: white;
   		position: fixed;
   		top: 4rem;
   		transition: 0.3s;
   		z-index: 50;
   		background-image: linear-gradient(to top,rgba(90, 105, 243,0.2),white);

   	}
   	.navbar-text {
   		margin-left: 0.25rem;
   	}
   	.toggle-button {
   		border: none;
   		background: transparent;
   	}
   	.navbar-nav {
   		padding: 1rem;
   	}
   	.navbar-nav > .nav-link {
   		text-align: left !important;
   		font-size: 1.1em;
   		color: #343434;
   	}
   	.navbar-nav > .nav-link:hover {
   		transition: 0.5s;
   	}
   	.nav-link.active {
   		background: linear-gradient(118deg,#7367F0,rgba(115,103,240,.7));
   		box-shadow: 0 0 10px 1px rgb(115 103 240 / 70%);
   		border-radius: 4px;
   		color: white;
   	}

   	.nav-link.active:hover {
   		background: linear-gradient(118deg,#7367F0,rgba(115,103,240,.7));
   		box-shadow: 0 0 10px 1px rgb(115 103 240 / 70%);
   		border-radius: 4px;
   		color: white;
   	}


   	.dropbtn {
   		background-color: transparent;
   		color: black;
   		font-size: 16px;
   		border: none;
   	}

   	.dropdown {
   		position: relative;
   		display: inline-block;
   		margin-right:10px;
   	}

   	.dropdown-content {
   		display: none;
   		position: absolute;
   		background-color: #f1f1f1;
   		width: auto;
   		min-width:150px;
   		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
   		z-index: 1;
   	}

   	.dropdown-content a {
   		color: black;
   		padding: 12px 16px;
   		text-decoration: none;
   		display: block;
   	}

   	.dropdown-content a:hover {color: #024DBC;}
   	.dropdown:hover .dropdown-content {display: block;}



   	@media only screen and (max-width: 600px) {
   		.navbar {
   			margin-left: -18rem;
   		}
   		.navbar.collapsed {
   			margin-left: 0rem !important;
   		}
   	}
   	@media only screen and (max-width: 600px) {
   		.user-name {
   			margin-bottom: 0px;
   			font-size: 0.8em;
   		}
   		.user-type {
   			font-size: 0.6em;
   		}
   	}
   	</style>		
<div class="top-bar">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-start">
            <div class="d-flex justify-content-between align-items-center pr-4" >
                <a href="index"><img height="40" width="100" src="./components/logo.png"></a>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <a class="nav-link '.($current == 'summary' ? 'active': '').'"  href="index"><i class="fas fa-home pr-1"></i> <span class="navbar-text">Summary</span></a>
            </div>
       	    ';
            if($view_permission==1)
            {
            if($collection_permission==1){
            echo '
            <a class="nav-link ml-4 '.($current == 'home' ? 'active': '').'"  href="collection-table"><i class="fas fa-server pr-1"></i> <span class="navbar-text">Collection</span></a>
            ';
            }
            if($revenue_permission==1){
            echo '
            <a class="nav-link ml-4 '.($current == 'revenue' ? 'active': '').'"  href="revenue"><i class="fas fa-server"></i> <span class="navbar-text">Revenue</span></a>
            ';
            }
            if($sap_permission==1){
            echo '
            <a class="nav-link ml-4 '.($current == 'sap-dump' ? 'active': '').'" href="sap-dump"><i class="fas fa-server"></i> <span class="navbar-text">SAP Dump</span></a>';
            }
            if($client_permission==1){
            echo '
            <div class="dropdown ml-4">
                <button class="dropbtn"><a class="nav-link '.($current == 'clients' ? 'active': '').'"  href="clients"><i class="fas fa-users"></i> <span class="navbar-text">Clients</span></a></button>
                <div class="dropdown-content">
                    <a class="nav-link "  href="clients"><i class="fas fa-users"></i> <span class="navbar-text">Clients</span></a>
                    <a class="nav-link"  href="add-client"><i class="fas fa-user-plus"></i> <span class="navbar-text">Add Client</span></a>
                </div>
            </div>';
            }
            // if($client_permission==0){
            //     echo '
            //     <div class="dropdown ml-4">
            //         <button class="dropbtn"><a class="nav-link '.($current == 'clients' ? 'active': '').'"  href="clients"><i class="fas fa-users"></i> <span class="navbar-text">Clients</span></a></button>
            //         <div class="dropdown-content">
            //             <a class="nav-link "  href="clients"><i class="fas fa-users"></i> <span class="navbar-text">Clients</span></a>
            //         </div>
            //     </div>';
            //     }
            if($user_permission==1){
            echo '
            <div class="dropdown ml-4">
                <button class="dropbtn"><a class="nav-link '.($current == 'user' ? 'active': '').'"  href="users"><i class="fas fa-user"></i> <span class="navbar-text">Users</span></a></button>
                <div class="dropdown-content">
                    <a class="nav-link "  href="users"><i class="fas fa-user"></i><span class="navbar-text">Users</span></a>
                    <a class="nav-link "  href="add-user"><i class="fas fa-user-plus"></i><span class="navbar-text">Add User</span></a>
                </div>
            </div>';
            }
            }
            echo'
        </div>
        <div class="d-flex justify-content-around">
            <div class="dropdown">
                <div class="d-flex justify-content-end align-items-center">
                    <div class="d-flex flex-column align-items-end pr-3">
                        <div class="user-name font-weight-bolder">'.$_COOKIE["username"].'</div>
                        <div class="user-type">'.$_COOKIE["type"].'</div>
                    </div>
                    <img class="avatar" src="./images/user-icon.png" />
                </div>
                <div class="dropdown-content">
                    <a class="nav-link" href="logout"><i class="fas fa-sign-out-alt pr-1"></i> <span class="navbar-text">Logout</span></a>
                </div>
            </div>
        </div>
    </div>
</div>';
}