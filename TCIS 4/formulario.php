<?php
	session_start();
	$mysqli=new mysqli('localhost','tcisco_tcis3','Jb8374..','tcisco_tcis3');
	if (!empty($_POST['ingresar'])) {
		if (empty($_POST['peso'])||empty($_POST['fecha'])||empty($_POST['hora'])||empty($_POST['silo'])||empty($_POST['escotilla'])||empty($_POST['arin'])) {
			echo'<script type="text/javascript">alert("Datos Faltantes")</script>';
		}else {
			$consulta="SELECT id_arin FROM `arin` WHERE id_arin=".$_POST['arin'];
			$resultado=$mysqli->query($consulta);
			$TotReg=mysqli_num_rows($resultado);
			if ($TotReg==0) {
				$INGRESAR="INSERT INTO `arin`(`id_arin`, `placa`, `fecha_start`, `hora_start`, `peso_start`,`inspector`) VALUES (".$_POST['arin'].",'".strtoupper($_POST['placa'])."','".$_POST['fecha']."','".$_POST['hora']."',".$_POST['peso'].",".$_SESSION['id_usuario'].")";				
				if ($mysqli->query($INGRESAR)){
					$INGRESAR="UPDATE `ecotilla` SET `arin`=".$_POST['arin']." WHERE `id_escotilla`=".$_POST['escotilla'];
				    if ($mysqli->query($INGRESAR)){
						$INGRESAR="UPDATE `arin` SET `fecha_end`='".$_POST['fecha']."',`hora_end`='".$_POST['hora']."',`peso_end`=".$_POST['peso']." WHERE `id_arin`=".$_POST['arin'];
						if ($mysqli->query($INGRESAR)){
							$contsulta="SELECT `peso_start`, `peso_end` FROM `arin` WHERE `id_arin`=".$_POST['arin'];
							$resultado=$mysqli->query($contsulta);
							$datos=$resultado->fetch_array();
							if ($datos[0]<$datos[1]) {
								$observacion="Pesos no coinciden, falta cargamento";
							}else if($datos[0]>$datos[1]){
								$observacion="Pesos no coinciden, Se tiene un peso mayor de llegada";
							}else{
								$observacion="Sin comentarios";
							}
							$consulta='SELECT `producto` FROM `ecotilla` WHERE `id_escotilla`='.$_POST['escotilla'];
							$resultado=$mysqli->query($consulta);
							$datos=$resultado->fetch_array();
							$INGRESAR="INSERT INTO `descargue`(`id_ingre`, `fecha`, `hora`, `inspector`, `producto`, `proceso`, `arin`, `silo`, `comentarios`, `escotilla`) VALUES (NULL,'".$_POST['fecha']."','".$_POST['hora']."',".$_SESSION['id_usuario'].",".$datos[0].",".$_SESSION['Proceso'].",".$_POST['arin'].",".$_POST['silo'].",'".$observacion."',".$_POST['escotilla'].")";
							if($mysqli->query($INGRESAR)){
						    	echo'<script type="text/javascript">alert("Datos guardados")</script>';
						    }else{
						    	echo'<script type="text/javascript">alert("Ha ocurrido un error 4")</script>';
						    }
						}else{
						    echo'<script type="text/javascript">alert("Ha ocurrido un error 3")</script>';
						}
					}else{
				        echo'<script type="text/javascript">alert("Ha ocurrido un error 2")</script>';
				    }
			    }else{
			        echo'<script type="text/javascript">alert("Ha ocurrido un error 1")</script>';
			    }
		    }else{
				echo'<script type="text/javascript">alert("Arin duplicado Intentelo nuevamente")</script>';
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
		<h1 class="lead separa" align="center">Silo</h1>
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
		<div class="input-group mb-3">
		  <input type="text" class="form-control" name="arin" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
		  <div class="input-group-append">
		    <span class="input-group-text" id="basic-addon2">Arin</span>
		  </div>
		</div>
		<div class="input-group mb-3">
		  <input type="text" class="form-control" name="placa" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
		  <div class="input-group-append">
		    <span class="input-group-text" id="basic-addon2">Placa</span>
		  </div>
		</div>
		<div class="input-group mb-3">
		  <input type="text" class="form-control" name="peso" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
		  <div class="input-group-append">
		    <span class="input-group-text" id="basic-addon2">Peso (KG)</span>
		  </div>
		</div>
		<div class="input-group mb-3">
		  <input type="text" class="form-control" name="peso" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
		  <div class="input-group-append">
		    <span class="input-group-text" id="basic-addon2">Peso (KG)</span>
		  </div>
		</div>
		<div class="input-group mb-3 ">
		  <select class="custom-select" id="inputGroupSelect02" name="silo">
			<option selected value="">Selecciona un campo</option>
			<?php
				$consulta="SELECT * from silo order by id_silo asc";
				$resultado=$mysqli->query($consulta);
				$TotReg=mysqli_num_rows($resultado);
				foreach ($resultado as $reg) {
					echo '<option value="'.$reg['id_silo'].'">'.$reg['nombre'].'</option>';
				}
			?>
		  </select>
		  <div class="input-group-append separa">
		    <label class="input-group-text" for="inputGroupSelect02">Silo</label>
		  </div>
		</div>		
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
		    <label class="input-group-text" for="inputGroupSelect02">Escotilla de donde proviene y arin</label>
		  </div>
		</div>
		<div class="btn-group w-100" role="group" aria-label="Basic example">
			<input class="btn btn-primary" type="submit" name="ingresar" value="Gurdar datos" width="auto" height="10" formaction="formulario.php">
			<input class="btn btn-secondary" type="submit" name="informe" value="Informe" width="auto" height="10" formaction="informe.php" >
			<input class="btn btn-secondary" type="submit" name="regresar" value="Menu" width="auto" height="10" formaction="menupalermo.php">
		</div>
	</form>
	</div>
</body>
</html>