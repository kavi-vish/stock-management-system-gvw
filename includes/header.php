<?php require_once 'php_action/core.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Stock Management System</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

	<!-- custom css -->
	<link rel="stylesheet" href="custom/css/custom.css">

	<!-- DataTables -->
	<link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">

	<!-- file input -->
	<link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">

	<!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
	<!-- jquery ui -->  
	<link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
	<script src="assests/jquery-ui/jquery-ui.min.js"></script>

	<!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>

	<style>
		/* Professional Header Styles */
		.professional-navbar {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			border: none;
			box-shadow: 0 2px 15px rgba(0,0,0,0.1);
			margin-bottom: 0;
			min-height: 70px;
		}

		.professional-navbar .navbar-brand {
			color: #fff;
			font-size: 24px;
			font-weight: 600;
			padding: 25px 15px;
			letter-spacing: 0.5px;
		}

		.professional-navbar .navbar-brand:hover {
			color: #f0f0f0;
		}

		.professional-navbar .navbar-nav > li > a {
			color: rgba(255,255,255,0.9);
			font-weight: 500;
			padding: 25px 18px;
			transition: all 0.3s ease;
			font-size: 14px;
		}

		.professional-navbar .navbar-nav > li > a:hover,
		.professional-navbar .navbar-nav > li > a:focus {
			background-color: rgba(255,255,255,0.15);
			color: #fff;
		}

		.professional-navbar .navbar-nav > .active > a {
			background-color: rgba(255,255,255,0.2);
			color: #fff;
		}

		.professional-navbar .navbar-nav > li > a i {
			margin-right: 6px;
			font-size: 16px;
		}

		.professional-navbar .dropdown-menu {
			border: none;
			box-shadow: 0 5px 20px rgba(0,0,0,0.15);
			border-radius: 4px;
			margin-top: 0;
		}

		.professional-navbar .dropdown-menu > li > a {
			padding: 10px 20px;
			transition: all 0.2s ease;
		}

		.professional-navbar .dropdown-menu > li > a:hover {
			background-color: #667eea;
			color: #fff;
		}

		.professional-navbar .navbar-toggle {
			border-color: rgba(255,255,255,0.3);
			margin-top: 18px;
		}

		.professional-navbar .navbar-toggle:hover,
		.professional-navbar .navbar-toggle:focus {
			background-color: rgba(255,255,255,0.15);
		}

		.professional-navbar .navbar-toggle .icon-bar {
			background-color: #fff;
		}

		.professional-navbar .caret {
			border-top-color: rgba(255,255,255,0.9);
		}

		.professional-navbar .dropdown-menu .divider {
			background-color: #e0e0e0;
		}

		/* Active nav item indicator */
		.professional-navbar .navbar-nav > li.active > a::after {
			content: '';
			position: absolute;
			bottom: 0;
			left: 50%;
			transform: translateX(-50%);
			width: 60%;
			height: 3px;
			background-color: #fff;
		}

		/* Mobile responsive adjustments */
		@media (max-width: 767px) {
			.professional-navbar .navbar-nav {
				margin: 0;
			}
			
			.professional-navbar .navbar-nav > li > a {
				padding: 15px 20px;
			}

			.professional-navbar .navbar-collapse {
				border-top: 1px solid rgba(255,255,255,0.2);
				margin-top: 10px;
			}
		}
	</style>
</head>
<body>

	<nav class="navbar navbar-default navbar-static-top professional-navbar">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">
					<i class="glyphicon glyphicon-th"></i> GVW Stock Management
				</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      

				<ul class="nav navbar-nav navbar-right">        

					<li id="navDashboard"><a href="index.php"><i class="glyphicon glyphicon-list-alt"></i> Dashboard</a></li>        
					
					<li id="navBrand"><a href="brand.php"><i class="glyphicon glyphicon-btc"></i> Brand</a></li>        

					<li id="navCategories"><a href="categories.php"><i class="glyphicon glyphicon-th-list"></i> Category</a></li>        

					<li id="navProduct"><a href="product.php"><i class="glyphicon glyphicon-ruble"></i> Product</a></li>     

					<li class="dropdown" id="navOrder">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="glyphicon glyphicon-shopping-cart"></i> Orders <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">            
							<li id="topNavAddOrder"><a href="orders.php?o=add"><i class="glyphicon glyphicon-plus"></i> Add Orders</a></li>            
							<li id="topNavManageOrder"><a href="orders.php?o=manord"><i class="glyphicon glyphicon-edit"></i> Manage Orders</a></li>            
						</ul>
					</li> 

					<li id="navReport"><a href="report.php"><i class="glyphicon glyphicon-check"></i> Report</a></li>

					<li class="dropdown" id="navSetting">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="glyphicon glyphicon-user"></i> <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">            
							<li id="topNavSetting"><a href="setting.php"><i class="glyphicon glyphicon-wrench"></i> Setting</a></li>            
							<li id="topNavLogout"><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>            
						</ul>
					</li>        
					
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

	<div class="container">