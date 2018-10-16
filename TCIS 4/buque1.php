<?php
	session_start();
	$mysqli=new mysqli('localhost','tcisco_tcis3','Jb8374..','tcisco_tcis3');
	if (!empty($_POST['ingresar'])) {
		if (empty($_POST['maquinaria'])||empty($_POST['escotilla'])||empty($_POST['fecha'])||empty($_POST['hora'])||empty($_POST['hora_in'])||empty($_POST['hora_out'])) {
			echo'<script type="text/javascript">alert("Datos Faltantes")</script>';
		}else {
			$consulta="SELECT `id_maquinaria` FROM `maquinaria` WHERE id_maquinaria=1";
			$resultado=$mysqli->query($consulta);
			$TotReg=mysqli_num_rows($resultado);
		    for ($i=1; !empty($TotReg); $i++) { 
		    	$consulta="SELECT `id_maquinaria` FROM `maquinaria` WHERE id_maquinaria=".$i;
				$resultado=$mysqli->query($consulta);
				$TotReg=mysqli_num_rows($resultado);
				if(empty($TotReg)){
					$i--;
				}
		    }
		    $INGRESAR="INSERT INTO `maquinaria`(`id_maquinaria`, `tipo`, `fecha`, `tiempo`, `tiempo_start`, `tiempo_end`,`inspector`) VALUES (".$i.",".$_POST['maquinaria'].",'".$_POST['fecha']."','".$_POST['hora']."','".$_POST['hora_in']."','".$_POST['hora_out']."',".$_SESSION['id_usuario'].")";
		    if ($mysqli->query($INGRESAR)){
		    	$INGRESAR="UPDATE `ecotilla` SET `fecha`='".$_POST['fecha']."',`hora`='".$_POST['hora']."',`id_inspector`=".$_SESSION['id_usuario'].",`maquinaria`=".$i." WHERE `id_escotilla`=".$_POST['escotilla'];
	    		if($mysqli->query($INGRESAR)){
			    	echo'<script type="text/javascript">alert("Datos guardados")</script>';
			    }else{
			    	echo'<script type="text/javascript">alert("Ha ocurrido un error 3")</script>';	
			    }
			}else{
		        echo'<script type="text/javascript">alert("Ha ocurrido un error 1")</script>';
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
		<h2 id="sup"><marquee style="font-size: 50px;" bgcolor='#97ba20' behaior=alternate>TCIS INSPECTION.</marquee></h2>
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
			  <select class="custom-select" id="inputGroupSelect02" name="escotilla">
				<option selected value="">Selecciona un campo</option>
				<?php
					$consulta="SELECT * from ecotilla order by 	id_escotilla asc";
					$resultado=$mysqli->query($consulta);
					$TotReg=mysqli_num_rows($resultado);
					foreach ($resultado as $reg) {
						$contsulta="SELECT `nombre` FROM `producto` WHERE `id_producto`=".$reg['producto'];
						$resultado=$mysqli->query($contsulta);
						$datos=$resultado->fetch_array();
						$contsulta2="SELECT nombre FROM `nom_escotilla` WHERE `id_escotilla`=".$reg['tipo_escotilla'];
						$resultado2=$mysqli->query($contsulta2);
						$datos2=$resultado2->fetch_array();
						echo '<option value="'.$reg['id_escotilla'].'">'.$datos2[0].' / '.$datos[0].' / '.$reg['fecha'].'</option>';
					}
				?>
			  </select>
			  <div class="input-group-append separa">
			    <label class="input-group-text" for="inputGroupSelect02">Escotilla de donde proviene</label>
			  </div>
			</div>
			<div class="input-group mb-3">
			  <input type="time"  class="form-control" placeholder="Recipient's username" name="hora_in" aria-label="Recipient's username" aria-describedby="basic-addon2">
			  <div class="input-group-append">
			    <span class="input-group-text" id="basic-addon2">Tiempo de Inicio</span>
			  </div>
			</div>
			<div class="input-group mb-3">
			  <input type="time"  class="form-control" placeholder="Recipient's username" name="hora_out" aria-label="Recipient's username" aria-describedby="basic-addon2">
			  <div class="input-group-append">
			    <span class="input-group-text" id="basic-addon2">Tiempo Final</span>
			  </div>
			</div>
			<div class="input-group mb-3 ">
			  <select class="custom-select" id="inputGroupSelect02" name="maquinaria">
				<option selected value="">Selecciona un campo</option>
				<?php
					$consulta="SELECT * from tipo_maquinaria order by nombre asc";
					$resultado=$mysqli->query($consulta);
					$TotReg=mysqli_num_rows($resultado);
					foreach ($resultado as $reg) {
						echo '<option value="'.$reg['id_maquina'].'">'.$reg['nombre'].'</option>';
					}
				?>
			  </select>
			  <div class="input-group-append separa">
			    <label class="input-group-text" for="inputGroupSelect02">Maquinaria Utilizada</label>
			  </div>
			</div>
			<div class="btn-group w-100" role="group" aria-label="Basic example">
				<input class="btn btn-primary" type="submit" name="ingresar" value="Gurdar datos" width="auto" height="10" formaction="buque1.php">
				<input class="btn btn-secondary" type="submit" name="informe" value="Informe" width="auto" height="10" formaction="informe.php" >
				<input class="btn btn-secondary" type="submit" name="regresar" value="Menu" width="auto" height="10" formaction="menupalermo.php">
			</div>
		</form>
	</div>
</body>
</html>