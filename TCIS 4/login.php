<?php
	session_start();
	if (!empty($_POST['ingre'])) {
		if ($_POST['usuario']==""||$_POST['clave']=="") {
			echo'<script type="text/javascript">alert("Datos Faltantes")</script>';
		}else {
			$mysqli=new mysqli('localhost','tcisco_tcis3','Jb8374..','tcisco_tcis3');
			$Verificar='SELECT `tipo`,`id_usuario` FROM `usuarios` WHERE `usuario`="'.$_POST['usuario'].'" AND `clave`="'.md5($_POST['clave']).'"';
			$resultado=$mysqli->query($Verificar);
			$datos=$resultado->fetch_array();
			if (!empty($datos)) {
				$_SESSION['tipo']=$datos[0];
				$_SESSION['id_usuario']=$datos[1];
				echo '<script type="text/javascript">alert("Dato Recibido");window.location.href="menu.php";</script>';
			}else {
				echo'<script type="text/javascript">alert("Usuario o Contraseña Incorrecta");window.location.href="login.php";</script>';
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>TCIS: LOGIN</title>
	<link rel="stylesheet" type="text/css" href="css/general.css">
	<link rel="stylesheet" href="rensposive/bootstrap-4.1.3-dist/css/bootstrap.min.css">
</head>
<body>
	<div id="ext" class="container">
		<div id="logo" class="mx-auto">
			<img src="img/TECEEC.png" class="rounded mx-auto d-block" id="logoti">
		</div>
		<div id="login">
			<h1 class="lead" align="center">LOGIN</h1>
			<form method="post">
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="inputGroup-sizing-default">Usuario</span>
				  </div>
				  <input type="text" class="form-control" name="usuario" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
				</div><br>
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="inputGroup-sizing-default">Contraseña</span>
				  </div>
				  <input type="text" class="form-control" name="clave" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
				</div><br>
				<div class="mx-auto">
					<input type="submit" class="tam btn btn-primary btn-lg" name="ingre" value="Ingresar" formaction="login.php">
					<input type="submit" class="tam btn btn-secondary btn-lg" value="Regresar">
				</div>
			</form>
		</div>
	</div>
	<script src="rensposive/bootstrap-4.1.3-dist/js/jquery-3.3.1.min.js"></script>
    <script src="rensposive/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
</body>
</html>