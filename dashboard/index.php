<?php
session_start();
require_once('../admin/cn.php');


if (!(isset($_SESSION['email']))){
	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.location.href='../';
		</SCRIPT>");
}else{
	/*$sql = "SELECT name, last_name, number, active FROM users = ".$_SESSION['email']."";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
			  // output data of each row
		while($row = $result->fetch_assoc()) {
			
		}
	} else {
		echo "0 results";
	}*/
	

	$sql = "SELECT name, last_name, number, active FROM users WHERE email='".$_SESSION['email']."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
						  // output data of each row
		while($row = $result->fetch_assoc()) {
			$name=$row["name"];
			$number=$row["number"];
			$last_name=$row["last_name"];
			$active=$row["active"];
		}
	} else {
		echo "0 results";
	}

}
?>
<head>
	<title>Alan AI</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="..//favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="css/dashboard.css">
<link rel="stylesheet" href="css/profile.css">
<link href="../css/fontawesome/css/all.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
	<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"><img src="../img/logo.png" width="22" ></a>
	<ul class="navbar-nav px-3">
		<li class="nav-item text-nowrap">
			<a class="btn btn-link text-light" href=""><i class="fas fa-user-md"></i> <?php echo $name." ".$last_name; ?></a>
			<a class="btn btn-outline-light" data-toggle="tooltip" title="Cerrar sesion" href="../login/end/"><i class="fas fa-power-off"></i></a>
		</li>
	</ul>
</nav>

<div class="container-fluid">
	<div class="row">
		<nav class="col-md-2 d-none d-md-block bg-light sidebar">
			<div class="sidebar-sticky">
				<ul class="nav flex-column">
					<li class="nav-item">
						<a class="nav-link active" href="../dashboard/">
							<i class="fas fa-id-card-alt"></i> Mi perfil
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="campaigns/">
							<i class="fas fa-calendar-alt"></i> Mis Citas
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="orders/">
							<i class="fas fa-wallet"></i> Mis Pagos
						</a>
					</li>
				</ul>
			</div>
		</nav>
		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h2">Perfil</h1>
				<div class="btn-toolbar mb-2 mb-md-0">
					<div class="btn-group mr-2">
						<!--<a href="new-product/" class="btn btn-sm btn-outline-success"><i class="fas fa-plus-square"></i> Producto</a>-->
					</div>

				</div>
			</div>

			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<?php
						$folder_path = "../user/".$_SESSION['email']."/cedula/";
						if (!file_exists($folder_path)) {
							echo '<form method="post" action="update_cedula/" enctype="multipart/form-data">
							<div class="form-group files">
								<label>Adjunta tu cedula a continuación:</label>
								<input type="file" name="fileToUpload" class="form-control" >'; ?>
								<input type="hidden" name="folderId" value="<?php echo $_SESSION["email"]; ?>" id="exampleFormControlFile1">
							<?php echo '
							</div>
							<button type="submit" id="csvfile" class="btn btn-success">Actualizar</button>
						</form>';
						}else{
							foreach(glob('../user/'.$_SESSION['email'].'/cedula/*.{jpg,png,pdf}', GLOB_BRACE) as $file) {
								if (preg_match('/(\.jpg|\.png|\.bmp)$/', $file)) {
									echo '<img class="profile-pic" src="'.$file.'" height="80" width="80"/><br>';
								}else{

								}
							}

						}
						?>
						
					</div>
					<div class="col-md-6">
						b
					</div>
				</div>
			</div>

		</main>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>
