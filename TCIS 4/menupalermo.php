<?php 
	session_start();
	$_SESSION['tipo'];
	header('Content-Type: text/html; charset=utf-8');
	if (empty($_SESSION['tipo'])||empty($_SESSION['id_usuario'])) {
		echo'<script type="text/javascript">window.location.href="login.php";</script>';
	}
	if (!empty($_POST['LogOut'])) {
		unset($_SESSION['tipo']);
		echo'<script type="text/javascript">alert("LogOut");window.location.href="login.php";</script>';
	}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
	<title>TCIS: MENU</title>
	<link rel="stylesheet" type="text/css" href="css/general.css">
	<link rel="stylesheet" href="rensposive/bootstrap-4.1.3-dist/css/bootstrap.min.css">
</head>
<body>
	<div id="ext" class="container menus w-50 p-3">
		<div id="logo" class="mx-auto">
			<img src="img/TECEEC.png" class="rounded mx-auto d-block" id="logoti">
		</div>
		<div id="login">
			<h1 class="lead" align="center">MENU</h1>
			<form method="post">
			   <?php 
				if ($_SESSION['tipo']==1||$_SESSION['tipo']==2) {
					if ($_SESSION['tipo']==1){
						echo "<input type='submit' class='cam btn btn-secondary' value='Ingresar Escotilla' formaction='ingre_escotilla.php'><br><br>";		
					}
				echo "<input class='cam btn btn-secondary' type='submit' value='Buque - Escotilla' formaction='buque1.php'><br><br>";
				echo '<input class="cam btn btn-secondary" type="submit" value="Maquinaria" formaction="maquinaria1.php"><br><br>';
				/*echo '<input type="submit" value="Arin" formaction="arin.php">';*/
				echo '<input class="cam btn btn-secondary" type="submit" value="Silo" formaction="formulario.php"><br><br>';
				}
				?>
			     <input type="submit" class="cam btn btn-secondary" name="informe" value="Informes" formaction="informe.php"><br><br>
				<input type="submit" class="cam btn btn-dark" name="informe" value="Regresar" formaction="menu.php"><br><br>
				 
		</div>
	</div>
	<script src="rensposive/bootstrap-4.1.3-dist/js/jquery-3.3.1.min.js"></script>
    <script src="rensposive/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
</body>
</html>