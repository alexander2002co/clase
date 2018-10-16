<?php
	session_start();
	$mysqli=new mysqli('localhost','tcisco_tcis3','Jb8374..','tcisco_tcis3');
	if (empty($_SESSION['tipo'])) {
		echo'<script type="text/javascript">window.location.href="login.php";</script>';
	}
	if (!empty($_POST['logOut'])) {
		unset($_SESSION['cod_tipusua']);
		echo'<script type="text/javascript">window.location.href="login.php";</script>';
	}
	if (!empty($_POST['guardar'])) {
		$guardar="INSERT INTO `".$_SESSION['accion']."`(`id_".$_SESSION['accion']."`, `nombre`) VALUES (NULL,'".$_POST['prod']."')";
		$mysqli->query($guardar);
		echo'<script type="text/javascript">window.location.href="menu.php";</script>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>TCIS: MENU</title>
	<link rel="stylesheet" type="text/css" href="contenido/general.css">
</head>
<body>
	<div id="ext">
		<div id="logo">
			<img src="contenido/img/TECEEC.png" id="logoti">
		</div>
		<div id="login">
			<h1>Menu</h1>
			<form method="post">
				<input type="text" name="prod">
				<input type="submit" name="guardar" value="Agregar" formaction="agregar.php"> 
				<input type="submit" name="regresar" value="Menu" formaction="editar_formulario.php"> 
			</form>
		</div>
	</div>
</body>
</html>