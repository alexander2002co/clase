<?php
	session_start();
	$mysqli=new mysqli('localhost','root','','tcis3');
	if (!empty($_POST['ingresar'])) {
		if (empty($_POST['arin'])||empty($_POST['placa'])||empty($_POST['fecha'])||empty($_POST['hora'])||empty($_POST['peso'])||empty($_POST['escotilla'])) {
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
					    echo'<script type="text/javascript">alert("Datos guardados")</script>';
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
	<link rel="stylesheet" type="text/css" href="contenido/general.css">
</head>
<body>
	<div id="ext">
		<div id="logo">
			<h2 id="sup"><marquee style="font-size: 50px;" bgcolor='#97ba20' behaior=alternate>TCIS INSPECTION</marquee></h2>
			<img src="contenido/img/TECEEC.png" id="logoti">
			<h1>ARIN</h1>
		</div>
		<div id="cont">
			<form method="post">
				<table>
				<tr>
					<th>
					<?php
					echo '<input type="text" name="fecha" value="'.date("Y-m-d").'"></th><th><input type="text" name="hora" value="'.date("h:i:s").'">';
					?>
					</th>
				</tr>
				<tr>
				<td colspan="2">
				<h3>Descarga</h3>
				</td>
				</tr>
				<tr>
					<td><label>Arin</label></td>
					<td><input type="text" name="arin"></td>
				</tr>
				<tr>
					<td><label>Placa</label></td>
					<td><input type="text"style='text-transform:uppercase'; name="placa"></td>
				</tr>
				<tr>
					<td><label>Peso (KG)</label></td>
					<td><input type="number" min="1" name="peso"></td>
				</tr>
				<tr>
					<td><label>Escotilla de donde<br>proviene</label></td>
					<td>
						<select style="width: 100%" name="escotilla">
							<option value="">Selecciona un campo</option>
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
					</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="ingresar" value="Gurdar datos" width="auto" height="10"></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="informe" value="Informe" width="auto" height="10" formaction="informemaquinaria.php"></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="regresar" value="Menu" width="auto" height="10" formaction="menupalermo.php"></td>
				 </tr>
		</div>
	</div>
</body>
</html>