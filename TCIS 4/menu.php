<?php
	session_start();
	if (empty($_SESSION['tipo'])||empty($_SESSION['id_usuario'])) {
		echo'<script type="text/javascript">window.location.href="login.php";</script>';
	}
	if (!empty($_POST['logOut'])) {
		unset($_SESSION['cod_tipusua']);
		unset($_SESSION['id_usuario']);
		echo'<script type="text/javascript">window.location.href="login.php";</script>';
	}
	if (!empty($_POST['Stanvager'])) {
		$_SESSION['Proceso']=1;
		echo'<script type="text/javascript">window.location.href="menupalermo.php";</script>';
	}
	if (!empty($_POST['Cielo'])) {
		$_SESSION['Proceso']=2;
		echo'<script type="text/javascript">window.location.href="menupalermo.php";</script>';
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
					if ($_SESSION['tipo']==1) {
						echo "<input type='submit' class='cam btn btn-secondary' name='editar_formulario' formaction='editar_formulario.php' value='Editar Formulario'><br><br>";
					}
				?>
				<input type="submit" class="cam btn btn-secondary" name="Stanvager" value="Peru Buque 1" formaction="menu.php"><br><br>
				<input type="submit" class="cam btn btn-secondary" name="Cielo" value="Peru Buque 2" formaction="menu.php"><br><br>
				<input type="submit" name="logOut" class="cam btn btn-dark" value="LogOut" formaction="login.php"> 
			</form>
		</div>
	</div>
	<script src="rensposive/bootstrap-4.1.3-dist/js/jquery-3.3.1.min.js"></script>
    <script src="rensposive/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
</body>
</html>