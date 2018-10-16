<?php
	session_start();
	$mysqli=new mysqli('localhost','tcisco_tcis3','Jb8374..','tcisco_tcis3');
	if (!empty($_POST['ingresar'])) {
		if (empty($_POST['escotilla'])||empty($_POST['fecha'])||empty($_POST['hora'])||empty($_POST['producto'])) {
			echo'<script type="text/javascript">alert("Datos Faltantes")</script>';
		}else {
	    	$INGRESAR="INSERT INTO `ecotilla`(`id_escotilla`, `tipo_escotilla`, `fecha`, `hora`, `producto`) VALUES (NULL,".$_POST['escotilla'].",'".$_POST['fecha']."','".$_POST['hora']."',".$_POST['producto'].")";
    		if($mysqli->query($INGRESAR)){
		    	echo'<script type="text/javascript">alert("Datos guardados")</script>';
		    }else{
		    	echo'<script type="text/javascript">alert("Ha ocurrido un error 3")</script>';	
		    }	
		}
		
	}else if (empty($_SESSION['tipo'])) {
		echo'<script type="text/javascript">window.location.href="login.php";</script>';
	}
	ini_set('date.timezone','America/Bogota'); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>TCIS: FORMULARIO DE INGRESO</title>
	<link rel="stylesheet" type="text/css" href="css/general.css">
	<link rel="stylesheet" href="rensposive/bootstrap-4.1.3-dist/css/bootstrap.min.css">
</head>
<body>
	<div id="ext" class="container menus w-50 p-3">
		<div id="logo" class="mx-auto">
			<img src="img/TECEEC.png" class="rounded mx-auto d-block" id="logoti">
		</div>
		<h2 id="sup"><marquee style="font-size: 50px;" bgcolor='#97ba20' behaior=alternate>TCIS INSPECTION</marquee></h2>
		<h1 class="lead separa" align="center">Escotilla Buque</h1>
		<form method="post">
		<div class="input-group">
		  <div class="input-group-prepend separa">
		    <span class="input-group-text">Fecha</span>
		  </div>
		  <?php
				echo '<input type="date" aria-label="First name" name="fecha" class="form-control separa" value="'.date("Y-m-d").'">';
				?>
		  <div class="input-group-prepend separa">
		    <span class="input-group-text">Hora</span>
		  </div>
		  <?php
				echo '<input type="time" aria-label="Last name" name="hora" class="form-control separa" value="'.date("h:i:s").'">';
				?>
		</div>
		<h3 class="lead separa separa" align="center">Descarga</h3>
		<div class="input-group mb-3 ">
		  <select class="custom-select" id="inputGroupSelect02" name="producto">
			<option selected value="">Selecciona un campo</option>
			<?php
				$consulta="SELECT * from producto order by id_producto asc";
				$resultado=$mysqli->query($consulta);
				$TotReg=mysqli_num_rows($resultado);
				foreach ($resultado as $reg) {
					echo '<option value="'.$reg['id_producto'].'">'.$reg['nombre'].'</option>';
				}
			?>
		  </select>
		  <div class="input-group-append separa">
		    <label class="input-group-text" for="inputGroupSelect02">Producto</label>
		  </div>
		</div>
		  <div class="input-group mb-3 separa">
		  <select class="custom-select" id="inputGroupSelect02" name="escotilla">
			<option selected value="">Selecciona un campo</option>
			<?php
				$consulta="SELECT * from nom_escotilla order by id_escotilla asc";
				$resultado=$mysqli->query($consulta);
				$TotReg=mysqli_num_rows($resultado);
				foreach ($resultado as $reg) {
					echo '<option value="'.$reg['id_escotilla'].'">'.$reg['nombre'].'</option>';
				}
			?>
		  </select>
		  <div class="input-group-append separa">
		    <label class="input-group-text" for="inputGroupSelect02">Escotilla</label>
		  </div>
		  </div>
		  <div class="btn-group w-100" role="group" aria-label="Basic example">
			<input class="btn btn-primary" type="submit" name="ingresar" value="Gurdar datos" width="auto" height="10">
			<input class="btn btn-secondary" type="submit" name="informe" value="Informe" width="auto" height="10" formaction="informe.php" >
			<input class="btn btn-secondary" type="submit" name="regresar" value="Menu" width="auto" height="10" formaction="menupalermo.php">
		</div>
		</form>
	</div>
</body>
</html>