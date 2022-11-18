<?php
	function SideBar($current) {
		echo '
		<style>
			.title {
				font-size: 1.2em;
				font-weight: bold;
			}
			.nav-link:hover{
				background-image:linear-gradient(to left ,rgb(90, 105, 243,0.2),rgb(121, 133, 242,0.2));
				box-shadow: 0 0 10px 1px rgb(115 103 240 / 30%);
			}
			.sidebar {
				width: 16rem;
				height: 90vh;
				background: white;
				position: fixed;
				top: 4rem;
				transition: 0.3s;
				z-index: 50;
				background-image: linear-gradient(to top,rgba(90, 105, 243,0.2),white);

			}
			.sidebar.collapsed {
				margin-left: -18rem !important;
			}
			.sidebar-text {
				margin-left: 0.25rem;
			}
			.toggle-button {
				border: none;
				background: transparent;
			}
			.sidebar-nav {
				padding: 1rem;
			}
			.sidebar-nav > .nav-link {
				text-align: left !important;
				font-size: 1.1em;
				color: #343434;
			}
			.sidebar-nav > .nav-link:hover {
				transition: 0.5s;
			}
			.sidebar-nav > .active {
				background: linear-gradient(118deg,#7367F0,rgba(115,103,240,.7));
				box-shadow: 0 0 10px 1px rgb(115 103 240 / 70%);
				border-radius: 4px;
				color: white;
			}
			.nav-type-break {
				color:#A6A4B0;
				letter-spacing: 0.01rem;
				text-transform: uppercase;
				font-size: 0.8em;
				font-weight: 500;
				margin: 1% 4%;
				margin-top: 5%;
			}
			@media only screen and (max-width: 600px) {
				.sidebar {
					margin-left: -18rem;
				}
				.sidebar.collapsed {
					margin-left: 0rem !important;
				}
			}
		</style>
		<div class="sidebar">			
			<nav class="nav nav-pills nav-fill flex-column sidebar-nav">
				<a class="nav-link '.($current == 'home' ? 'active': '').'" href="index.php"><i class="fas fa-home pr-1"></i> <span class="sidebar-text">Home</span></a>
				
				
				<div class="nav-type-break">Users</div>
				<a class="nav-link '.($current == 'user' ? 'active': '').'" href="users.php"><i class="fas fa-user"></i> <span class="sidebar-text">Users</span></a>
				<a class="nav-link '.($current == 'add-user' ? 'active': '').'" href="add-user.php"><i class="fas fa-user-plus"></i> <span class="sidebar-text">Add User</span></a>
				<div class="nav-type-break">Clients</div>
				<a class="nav-link '.($current == 'clients' ? 'active': '').'" href="clients.php"><i class="fas fa-users"></i> <span class="sidebar-text">Clients</span></a>
				<a class="nav-link '.($current == 'add-client' ? 'active': '').'" 
				href="add-client.php"><i class="fas fa-user-plus"></i> <span class="sidebar-text">Add Client</span></a>
				<div class="nav-type-break">Others</div>
				<a class="nav-link '.($current == 'sap-dump' ? 'active': '').'" href="sap-dump.php"><i class="fas fa-server"></i> <span class="sidebar-text">SAP Dump</span></a>
				<a class="nav-link '.($current == 'collections' ? 'active': '').'" href="collections.php"><i class="fas fa-sticky-note"></i> <span class="sidebar-text">Collections</span></a>
				<div class="nav-type-break">Logout</div>
				<a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt pr-1"></i> <span class="sidebar-text">Logout</span></a>
			</nav>
		</div>';
	}
?>