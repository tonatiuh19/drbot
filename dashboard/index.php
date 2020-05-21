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
	

	$sql = "SELECT name, last_name, number, active, pwd FROM users WHERE email='".$_SESSION['email']."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
						  // output data of each row
		while($row = $result->fetch_assoc()) {
			$name=$row["name"];
			$number=$row["number"];
			$last_name=$row["last_name"];
			$active=$row["active"];
			$pwd = $row["pwd"];
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
						<a class="nav-link" href="appointments/">
							<i class="fas fa-calendar-alt"></i> Mis Citas
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="payments/">
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
						<?php
						
						if ($active == "0") {
								echo '<span class="btn btn-warning"><i class="fas fa-exclamation-circle"></i> Necesitamos tu cedula para activar tu cuenta</span>';
						}
						?>
					</div>

				</div>
			</div>

			<div class="container">
				<div class="row">
					<?php
					
					echo '<div class="col-md-6">';
						
						$folder_path = "user/".$_SESSION['email']."/cedula/";
						if (!file_exists($folder_path) || is_dir_empty($folder_path)) {
							
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
							echo '<h5>Cedula:</h5>';
							
							echo '<table class="table">
							<tbody>';
							foreach(glob('user/'.$_SESSION['email'].'/cedula/*.{jpg,png,pdf}', GLOB_BRACE) as $file) {
								if (preg_match('/(\.jpg|\.png|\.bmp)$/', $file)) {
									echo '<tr>
									<td>';
									echo '<a class="btn btn-light" href="'.$file.'" target="_blank" role="button"><i class="far fa-file-image"></i> '.substr($file, strrpos($file, '/') + 1).'</a><br>';
									echo '</td>';
																			      //echo '<td><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>';
									if ($active == "2") {
										echo "<td><form action=\"delete/\"  method=\"post\">\n";
										echo "  <input type=\"hidden\"  name=\"file\" value=\"".$file."\">\n";
										echo '<button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>';
										echo "</form></td>\n";
									}elseif($active == "0"){
										echo '<td><small class="btn btn-warning btn-sm">En espera de aprobacion</small></td>';
									}elseif ($active == "1") {
										echo '<td><small class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i></small></td>';
									}
									echo '</tr>';
								}else{
									echo '<tr>
									<td>';
									echo '<a class="btn btn-light" href="'.$file.'" target="_blank" role="button"><i class="far fa-file-pdf"></i> '.substr($file, strrpos($file, '/') + 1).'</a><br>';
									echo '</td>';
																			     // echo '<td><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>';
									echo "<td><form action=\"delete/\"  method=\"post\">\n";
									echo "  <input type=\"hidden\"  name=\"file\" value=\"".$file."\">\n";
									echo '<button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>';
									echo "</form></td>\n";
									echo '</tr>';
								}

							}
							echo '</tbody>
							</table>';
						}

						function is_dir_empty($dir) {
							if (!is_readable($dir)) return NULL; 
							return (count(scandir($dir)) == 2);
						}
						?>

					</div>
					<div class="col-md-6">
						<?php
						echo '<h5 class="float-left">Datos:</h5>
						<div class="float-right"><button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#profileEdit">
                  			<span class="fas fa-pencil-alt"></span>
                		</button></div>';
						  echo "<table class=\"table table-borderless\">\n";
			              echo "            <tr>\n";
			              echo "              <th>Nombre:</th>\n";
			              echo "              <td>".$name."</td>\n";
			              echo "            </tr>\n";
			              echo "            <tr>\n";
			              echo "              <th>Apellido:</th>\n";
			              echo "              <td>".$last_name."</td>\n";
			              echo "            </tr>\n";
			              echo "            <tr>\n";
			              echo "              <th>Email:</th>\n";
			              echo "              <td>".$_SESSION['email']."</td>\n";
			              echo "            </tr>\n";
			              echo "            <tr>\n";
			              echo "              <th>Contraseña:</th>\n";
			              echo "              <td>***********</td>\n";
			              echo "            </tr>\n";
			              echo "            <tr>\n";
			              echo "              <th >Telefono:</th>\n";
			              echo "              <td>".$number."</td>\n";


			              echo "            </tr>\n";
			              echo "          </table>      \n";
			              echo '  <div class="modal fade" id="profileEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			                  <div class="modal-dialog modal-lg" role="document">
			                    <div class="modal-content">
			                      <div class="modal-header">
			                        <h5 class="modal-title" id="exampleModalLongTitle">Editar Perfil</h5>
			                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                          <span aria-hidden="true">&times;</span>
			                        </button>
			                      </div>
			                      <div class="modal-body">
			                        <form action="edit_profile.php" method="post" name="myForm" >
			                          <div class="form-group">
			                            <label for="exampleFormControlInput1">Nombre</label>
			                            <input type="text" name="name" class="form-control"  value="'.$name.'" required>
			                          </div>
			                          <div class="form-group">
			                            <label for="exampleFormControlInput1">Apellido</label>
			                            <input type="text" name="last" class="form-control"  value="'.$last_name.'" required>
			                          </div>
			                          <div class="form-group">
			                            <label for="exampleFormControlInput1">Email</label>
			                            <input type="text" name="email" class="form-control"  value="'.$_SESSION['email'].'" required>
			                          </div>
			                          <div class="form-group">
			                            <label for="exampleFormControlInput1">Telefono</label>
			                            <input type="text" name="phone" class="form-control"  value="'.$number.'" required>
			                            <input type="hidden" name="laLeydelMonte" class="form-control"  value="'.$pwd.'" >
			                          </div>
			                          <div class="form-group">
			                            <label for="exampleFormControlInput1">Contraseña</label>
			                            <input type="password" name="pwd" class="form-control" id="text_field1" placeholder="Nueva Contraseña">
			                            <input type="password" name="pwd2" class="form-control" id="text_field2" placeholder="Vuelve a escribir la contraseña">
			                          </div>
			                          <div id="idshowpwd" style="display:none" class="alert alert-danger" role="alert">
			                            Las contraseñas no coinciden
			                          </div>

			                      </div>
			                      <div class="modal-footer">
			                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Atras</button>
			                        <button type="button" id="submit_button" class="btn btn-primary">
			                          Actualizar
			                        </button>
			                        <div class="modal fade bg-dark" id="validatePWD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			                          <div class="modal-dialog " role="document">
			                            <div class="modal-content">
			                              <div class="modal-body">
			                                <div class="form-group">
			                                  <label for="exampleFormControlInput1">Ingresa la contraseña actual:</label>
			                                  <input type="password" name="pwdSq" class="form-control"   required>
			                                </div>

			                              </div>
			                              <div class="modal-footer">
			                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Atras</button>
			                                <button type="submit" class="btn btn-success">Actualizar</button>
			                              </div>
			                            </div>
			                          </div>
			                        </div>
			                        </form>
			                      </div>
			                    </div>
			                  </div>
			                </div>';
						?>
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
