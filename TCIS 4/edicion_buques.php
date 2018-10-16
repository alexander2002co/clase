<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
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
				<?php
					if ($_SESSION['tipo']==1) {
						echo "<input type='submit' name='editar_formulario' formaction='editar_formulario.php' value='Editar Formulario'>";
					}
				?>
				<input type="submit" name="informe" value="Edicion Buque  Stanrvac" formaction="editar_formulario.php">
				<input type="submit" name="formulario" value="Edicion de Buque Di Palermo" formaction="menupalermo.php">
				<input type="submit" name="formulario" value="Regresar" formaction="menu.php">
				<input type="submit" name="logOut" value="LogOut" formaction="login.php"> 
			</form>
		</div>
	</div>
</body>
</html>