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
	if (empty($_SESSION['accion'])) {
		echo'<script type="text/javascript">window.location.href="editar_formulario.php";</script>';	
	}
	if(!empty($_POST['G'])){
		$arreglo="UPDATE `".$_SESSION['accion']."` SET `nombre`='".$_POST['nom']."' WHERE id_".$_SESSION['accion']."=".$_SESSION['id'];
		$mysqli->query($arreglo);
		unset($_SESSION['accion']);
		unset($mysqli);
		echo'<script type="text/javascript">window.location.href="menu.php";</script>';
	}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
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
					if(empty($_POST['id'])){
						$mysqli=new mysqli('localhost','tcisco_tcis3','Jb8374..','tcisco_tcis3');
						$consulta="SELECT * from  `".$_SESSION['accion']."`";
						$resultado=$mysqli->query($consulta);
						$TotReg=mysqli_num_rows($resultado);
						echo '<select style="width: 100%" name="id">';
						echo '<option value="">Selecione tu opción</option>';
						foreach ($resultado as $reg) {
							echo '<option value="'.$reg['id_silo'].'">'.$reg['nombre'].'</option>';
						}
						echo "<input type='submit' value='Buscar' name='B'>";
					}else{
						$consulta="SELECT * from ".$_SESSION['accion']." WHERE id_".$_SESSION['accion']."=".$_POST['id'];
						$resultado=$mysqli->query($consulta);
						$TotReg=mysqli_num_rows($resultado);
						foreach ($resultado as $reg) {
							$_SESSION['id']=$_POST['id'];
						echo '<input type="text" name="nom" value="'.$reg['nombre'].'"">';
					}
					echo "<input type='submit' value='Guardar' name='G'>";
					}
						unset($mysqli);
				?>
				<input type="submit" value="Menu" formaction="editar_formulario.php">
			</form>
		</div>
	</div>
</body>
</html>