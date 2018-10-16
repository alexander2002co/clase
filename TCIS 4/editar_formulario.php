<?php
	session_start();
	if (empty($_SESSION['tipo'])) {
		echo'<script type="text/javascript">window.location.href="login.php";</script>';
	}
	if (!empty($_POST['logOut'])) {
		unset($_SESSION['cod_tipusua']);
		echo'<script type="text/javascript">window.location.href="login.php";</script>';
	}
	if (!empty($_POST['silo'])){
		$_SESSION['accion']="silo";
		echo'<script type="text/javascript">window.location.href="editar.php";</script>';	
	}
	if (!empty($_POST['inspec'])){
		$_SESSION['accion']="inspector";
		echo'<script type="text/javascript">window.location.href="editar.php";</script>';
	}
	if (!empty($_POST['produc'])){
		$_SESSION['accion']="producto";
		echo'<script type="text/javascript">window.location.href="editar.php";</script>';
	}
	if (!empty($_POST['silo_G'])){
		$_SESSION['accion']="silo";
		echo'<script type="text/javascript">window.location.href="agregar.php";</script>';
	}
	if (!empty($_POST['inspec_G'])){

		$_SESSION['accion']="inspector";
		echo'<script type="text/javascript">window.location.href="agregar.php";</script>';
	}
	if (!empty($_POST['produc_G'])){
		echo'<script type="text/javascript">window.location.href="agregar.php";</script>';
		$_SESSION['accion']="producto";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>TCIS: MENU</title>
	<link rel="stylesheet" type="text/css" href="css/general.css">
	<link rel="stylesheet" href="rensposive/bootstrap-4.1.3-dist/css/bootstrap.min.css">
</head>
<body>
	<div id="ext" class="container">
		<div id="logo" class="mx-auto">
			<img src="img/TECEEC.png" class="rounded mx-auto d-block" id="logoti">
		</div>
		<div id="login">
			<h1 class="lead" align="center">EDICIÓN</h1>
			<form method="post">
				<input type="submit" class="cam btn btn-secondary" name="silo" value="Editar Silos" formaction="editar_formulario.php"><br><br>
				<input type="submit" class="cam btn btn-secondary" name="produc" value="Editar producto" formaction="editar_formulario.php"> <br><br>
				<input type="submit" class="cam btn btn-secondary" name="silo_G" value="Nuevo Silos" formaction="editar_formulario.php"><br><br>
				<input type="submit" class="cam btn btn-secondary" name="produc_G" value="Nuevo producto" formaction="editar_formulario.php"><br><br>
				<input type="submit" class="cam btn btn-secondary" name="regresar" value="Regresar" formaction="menu.php">
			</form>
		</div>
	</div>
	<script src="rensposive/bootstrap-4.1.3-dist/js/jquery-3.3.1.min.js"></script>
    <script src="rensposive/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
</body>
</html>