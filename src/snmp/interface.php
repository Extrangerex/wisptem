<html>
	<head>
		<title><?php echo $_GET['router']?></title>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script type="text/javascript" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
 crossorigin="anonymous"></script>
 <link rel="stylesheet" href="custom.css"/>
	</head>
	<body>
		<div class='navbar navbar-mod'>
			<div class="navbar-header">
				<div class="navbar-brand">Router Monitoring System</div>
			</div>
			<div class='navbar-right'>
				<img class="logo" src="mtlogo.png"></img>
			</div>
		</div>
		<div class='container container-no-padding'>

			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">
					<?php echo '<h3>'.$_GET['router'].' Router Interfaces</h3>'?>
				</div>
				<div class="col-md-3">
				</div>
			</div>
			<div class='row row-no-padding'>
				
				<div class='col-md-3' id="menu">
					<div class='panel panel-mod-black'>
						<div class='panel-heading'>
							<div class='panel-title'><strong>Menu</strong></div>
						</div>
						<div class="panel-body">
							<ul class='nav nav-pill'>
								<li class='nav-item'><a class='active' href="http://localhost/index.php">Community</a>
								</li>
								<li class='nav-item'><a href="http://localhost/add_community.php">Add Community</a>
								</li>
								<li class='nav-item'><a href='http://localhost/search.php'>Search</a>
								</li>

							</ul>
						</div>
					</div>
				</div>

				<div class='col-md-6'>
							<div class="row">
									<?php
										require_once "InterfaceMonitor.php";
										function table_info($title,$value){
											return "<tr><td><strong>$title</strong></td><td><span class='align-right'>$value</span></td></tr>";
										}
										try{
													$interface = new InterfaceMonitor(new SNMPMonitor($_GET['host'],$_GET['community']));
													$interface->activeInterfacesTable();
										}catch(Exception $e){
											//echo $e->getMessage();
											echo "<h3>Host Unavailable</h3>";
										}
									?>
							</div>
							<div class="row">
									<?php
										error_reporting(0);
										require_once "InterfaceMonitor.php";
										try{
													$interface = new InterfaceMonitor(new SNMPMonitor($_GET['host'],$_GET['community']));
													$interface->errorAndPacketTable();
										}catch(Exception $e){
											//echo $e->getMessage();
											echo "<h3>Host Unavailable</h3>";
										}
									?>
							</div>
				</div>
				
				<div class='col-md-3'>
					<div class='panel panel-mod-black'>
						<div class='panel-heading'>
							<div class='panel-title'><strong>Information</strong></div>
						</div>
						<div class="panel-body">
							<ul class='nav nav-pill'>
						<?php
							require_once 'credentials.php';
							$router = $_GET['router'];
							echo "<ul class='nav nav-pill'>";
							
							$conn = new mysqli($db_host,$db_user,$db_pwd,$db_name);
							$query = "SELECT ip FROM router where name='$router'";
							$result = $conn->query($query);
							
							$data = $result->fetch_assoc();
							$ip = $data['ip'];
							
							echo "<li class='nav-item'><a href='http://localhost/check_router.php?router=$router&community=".$_GET['community']."&host=".long2ip($ip)."'>Identity</a></li>";
							echo "<li class='nav-item'><a class='active' href='http://localhost/interface.php?router=$router&community=".$_GET['community']."&host=".long2ip($ip)."'>Interfaces</a></li>";
							echo "<li class='nav-item'><a href='http://localhost/bandwidth.php?router=$router&community=".$_GET['community']."&host=".long2ip($ip)."'>Bandwidth Usage</a></li>";
							echo "<li class='nav-item'><a href='http://localhost/health.php?router=$router&community=".$_GET['community']."&host=".long2ip($ip)."'>Health</a></li>";
						?>
												<script type="text/javascript">
							setTimeout(function(){
							   window.location.reload(1);
							}, 5000);
						</script>

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
