<?php
session_start();
	function tiempoTranscurridoFechas($fechaInicio,$fechaFin)
{
    $fecha1 = new DateTime($fechaInicio);
    $fecha2 = new DateTime($fechaFin);
    $fecha = $fecha1->diff($fecha2);
    $tiempo = "";
         
    //años
    if($fecha->y > 0)
    {
        $tiempo .= $fecha->y;
             
        if($fecha->y == 1)
            $tiempo .= " año, ";
        else
            $tiempo .= " años, ";
    }
         
    //meses
    if($fecha->m > 0)
    {
        $tiempo .= $fecha->m;
             
        if($fecha->m == 1)
            $tiempo .= " mes, ";
        else
            $tiempo .= " meses, ";
    }
         
    //dias
    if($fecha->d > 0)
    {
        $tiempo .= $fecha->d;
             
        if($fecha->d == 1)
            $tiempo .= " día, ";
        else
            $tiempo .= " días, ";
    }
         
    //horas
    if($fecha->h > 0)
    {
        $tiempo .= $fecha->h;
             
        if($fecha->h == 1)
            $tiempo .= " hora, ";
        else
            $tiempo .= " horas, ";
    }
         
    //minutos
    if($fecha->i > 0)
    {
        $tiempo .= $fecha->i;
             
        if($fecha->i == 1)
            $tiempo .= " minuto";
        else
            $tiempo .= " minutos";
    }
    else if($fecha->i == 0) //segundos
        $tiempo .= $fecha->s." segundos";
         
    return $tiempo;
}
	$mysqli=new mysqli('localhost','tcisco_tcis3','Jb8374..','tcisco_tcis3');
	$mysqli->set_charset("utf8");
	?>
		<table CELLPADDING=1 CELLSPACING=0 align="center">
	<?php
		if (!empty($_POST['silo'])) {
	?>
			<tr><th colspan="10">SILO</th></tr>
			<tr>
				<th>ID</th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Inspector</th>
				<th>Producto</th>
				<th>Arin</th>
				<th>Peso</th>
				<th>Placa</th>
				<th>Silo</th>
				<th>Escotilla</th>
				<!---
				<th>Maquinaria</th>
				<th>Comentarios</th>
				--->
			</tr>
		<?php			
				$consulta_p="SELECT * from descargue order by `id_ingre` asc";
				$resultado=$mysqli->query($consulta_p);
				$TotReg=mysqli_num_rows($resultado);
				foreach ($resultado as $reg) {
				echo "<tr>";
				echo "<td>".$reg['id_ingre']."</td>";
				echo "<td>".$reg['fecha']."</td>";
				echo "<td>".$reg['hora']."</td>";
				$consulta="SELECT `nombre` FROM `usuarios` WHERE `id_usuario`=".$reg['inspector'];
				$resultado=$mysqli->query($consulta);
				$datos=$resultado->fetch_array();
				echo "<td>".$datos[0]."</td>";
				$consulta="SELECT `nombre` FROM `producto` WHERE `id_producto`=".$reg['producto'];
				$resultado=$mysqli->query($consulta);
				$datos=$resultado->fetch_array();
				echo "<td>".$datos[0]."</td>";
				echo "<td>".$reg['arin']."</td>";
				$consulta="SELECT `placa`,`peso_start` FROM `arin` WHERE `id_arin`=".$reg['arin'];
				$resultado=$mysqli->query($consulta);
				$datos=$resultado->fetch_array();
				echo "<td>".$datos[1]."</td>";
				echo "<td>".$datos[0]."</td>";
				$consulta="SELECT `nombre` FROM `silo` WHERE `id_silo`=".$reg['silo'];
				$resultado=$mysqli->query($consulta);
				$datos=$resultado->fetch_array();
				echo "<td>".$datos[0]."</td>";
				$consulta="SELECT `tipo_escotilla`FROM `ecotilla` WHERE `id_escotilla`=".$reg['escotilla'];
				$resultado=$mysqli->query($consulta);
				$datos=$resultado->fetch_array();
				$consulta="SELECT `nombre` FROM `nom_escotilla` WHERE `id_escotilla`=".$datos[0];
				$resultado=$mysqli->query($consulta);
				$datos=$resultado->fetch_array();
				echo "<td>".$datos[0]."</td>";
				/*
				echo "<td>".$reg['maquinaria']."</td>";
				echo "<td>".$reg['comentarios']."</td>";
				*/
				if ($_SESSION['tipo']==1||$_SESSION['tipo']==2||$_SESSION['tipo']==3||$_SESSION['tipo']==4) {
					?>
					 
					<?php
				}
				echo "</tr>";
				$resultado = mysqli_query ($mysqli, $consulta_p) or die (mysql_error ());
				$libros = array();
				while( $rows = mysqli_fetch_assoc($resultado) ) {
					$libros[] = $rows;
				}
				}
				if (strcmp($_POST['silo'],'Exportar a Excel')==0) {
					 if(!empty($libros)) {
					 $filename = "silo_informe.xls";
					 header("Content-Type: application/vnd.ms-excel");
					 header("Content-Disposition: attachment; filename=".$filename);

					 $mostrar_columnas = false;

					 foreach($libros as $libro) {
					 	/*
					 if(!$mostrar_columnas) {
					 echo implode("\t", array_keys($libro)) . "\n";
					 $mostrar_columnas = true;
					 }
					 echo implode("\t", array_values($libro)) . "\n";
					 */
					 }
					 }else{
					 echo 'No hay datos a exportar';
					 }
					 exit;
				}
		}else if(!empty($_POST['maquinaria'])){
	?>
	<tr><th colspan="10">MAQUINARIA</th></tr>
		<tr>
			<th>ID</th>
			<th>Fecha registro</th>
			<th>Hora registro</th>
			<th>Inspector</th>
			<th>tipo</th>
			<th>Producto</th>
			<th>Silo</th>
			<th>Hora Inicial</th>
			<th>Hora final</th>
			<th>Total Horas</th>
		</tr>
		<?php			
				$consulta_p="SELECT * from maquinaria order by `id_maquinaria` asc";
				$resultado=$mysqli->query($consulta_p);
				$TotReg=mysqli_num_rows($resultado);
				foreach ($resultado as $reg) {
					$consulta2="SELECT `silo`,`producto` FROM `descargue` WHERE `maquinaria`=".$reg['id_maquinaria'];
					$resultado2=$mysqli->query($consulta2);
					$datos2=$resultado2->fetch_array();
					if (!empty($datos2)) {
						echo "<tr>";
						echo "<td>".$reg['id_maquinaria']."</td>";
						echo "<td>".$reg['fecha']."</td>";
						echo "<td>".$reg['tiempo']."</td>";
						$consulta="SELECT `nombre` FROM `usuarios` WHERE `id_usuario`=".$reg['inspector'];
						$resultado=$mysqli->query($consulta);
						$datos=$resultado->fetch_array();
						echo "<td>".$datos[0]."</td>";
						$consulta="SELECT `nombre` FROM `tipo_maquinaria` WHERE `id_maquina`=".$reg['tipo'];
						$resultado=$mysqli->query($consulta);
						$datos=$resultado->fetch_array();
						echo "<td>".$datos[0]."</td>";
						$consulta="SELECT `nombre` FROM `producto` WHERE `id_producto`=".$datos2[1];
						$resultado=$mysqli->query($consulta);
						$datos=$resultado->fetch_array();
						echo "<td>".$datos[0]."</td>";
						$consulta="SELECT `nombre` FROM `silo` WHERE `id_silo`=".$datos2[0];
						$resultado=$mysqli->query($consulta);
						$datos=$resultado->fetch_array();
						echo "<td>".$datos[0]."</td>";
						echo "<td>".$reg['tiempo_start']."</td>";
						echo "<td>".$reg['tiempo_end']."</td>";
						$dif=tiempoTranscurridoFechas($reg['tiempo_start'],$reg['tiempo_end']);
						echo "<td>".$dif."</td>";
					}
					echo "</tr>";
					$resultado = mysqli_query ($mysqli, $consulta_p) or die (mysql_error ());
				$libros = array();
				while( $rows = mysqli_fetch_assoc($resultado) ) {
					$libros[] = $rows;
				}
			}
			if (strcmp($_POST['maquinaria'],'Exportar a Excel')==0) {
				 if(!empty($libros)) {
				 $filename = "maquinaria_informe.xls";
				 header("Content-Type: application/vnd.ms-excel");
				 header("Content-Disposition: attachment; filename=".$filename);

				 $mostrar_columnas = false;

				 foreach($libros as $libro) {
				 	/*
				 if(!$mostrar_columnas) {
				 echo implode("\t", array_keys($libro)) . "\n";
				 $mostrar_columnas = true;
				 }
				 echo implode("\t", array_values($libro)) . "\n";
				 */
				 }
				 }else{
				 echo 'No hay datos a exportar';
				 }
				 unset($_POST['maquinaria']);
				 exit;
			}
		}/*else if(!empty($_POST['arin'])){
			?>
			<tr><th colspan="8">ARIN</th></tr>
		<tr>
			<th>ID</th>
			<th>Placa</th>
			<th>Fecha Inicio</th>
			<th>Hora inicio</th>
			<th>Peso inicio</th>
			<th>Fecha final</th>
			<th>Hora final</th>
			<th>Peso final</th>
			<th>Inspector</th>
			<th>Silo</th>
		</tr>
		<?php			
				$consulta="SELECT * from arin order by `id_arin` asc";
				$resultado=$mysqli->query($consulta);
				$TotReg=mysqli_num_rows($resultado);
				foreach ($resultado as $reg) {
				echo "<tr>";
				echo "<td>".$reg['id_arin']."</td>";
				echo "<td>".$reg['placa']."</td>";
				echo "<td>".$reg['fecha_start']."</td>";
				echo "<td>".$reg['hora_start']."</td>";
				echo "<td>".$reg['peso_start']."</td>";
				echo "<td>".$reg['fecha_end']."</td>";
				echo "<td>".$reg['hora_end']."</td>";
				echo "<td>".$reg['peso_end']."</td>";
				$consulta="SELECT `nombre` FROM `usuarios` WHERE `id_usuario`=".$reg['inspector'];
				$resultado=$mysqli->query($consulta);
				$datos=$resultado->fetch_array();
				echo "<td>".$datos[0]."</td>";
				$consulta="SELECT `id_ingre` FROM `descargue` WHERE `arin`=".$reg['id_arin'];
				$resultado=$mysqli->query($consulta);
				$datos=$resultado->fetch_array();
				echo "<td>".$datos[0]."</td>";
			}
		}*/else{
				?>
				<tr><th colspan="9">ESCOTILLA</th></tr>
		<tr>
			<th>ID</th>
			<th>Fecha Registro</th>
			<th>Hora Registro</th>
			<th>Inspector</th>
			<th>Nombre Escotilla</th>
			<th>Producto</th>
			<th>Maquinaria</th>
			<th>Hora de Inicio</th>
			<th>Hora Final</th>
		</tr>
		<?php			
				$consulta_p="SELECT * from ecotilla order by `id_escotilla` asc";
				$resultado=$mysqli->query($consulta_p);
				$TotReg=mysqli_num_rows($resultado);
				foreach ($resultado as $reg) {
				echo "<tr>";
				echo "<td>".$reg['id_escotilla']."</td>";
				echo "<td>".$reg['fecha']."</td>";
				echo "<td>".$reg['hora']."</td>";
				$consulta="SELECT `nombre` FROM `usuarios` WHERE `id_usuario`=".$reg['id_inspector'];
				$resultado=$mysqli->query($consulta);
				$datos=$resultado->fetch_array();
				echo "<td>".$datos[0]."</td>";
				$consulta="SELECT `nombre` FROM `nom_escotilla` WHERE `id_escotilla`=".$reg['tipo_escotilla'];
				$resultado=$mysqli->query($consulta);
				$datos=$resultado->fetch_array();
				echo "<td>".$datos[0]."</td>";
				$consulta="SELECT `nombre` FROM `producto` WHERE `id_producto`=".$reg['producto'];
				$resultado=$mysqli->query($consulta);
				$datos=$resultado->fetch_array();
				echo "<td>".$datos[0]."</td>";
				$consulta="SELECT `tipo`,`tiempo_start`, `tiempo_end` FROM `maquinaria` WHERE `id_maquinaria`=".$reg['maquinaria'];
				$resultado=$mysqli->query($consulta);
				$datos=$resultado->fetch_array();
				$consulta2="SELECT `nombre` FROM `tipo_maquinaria` WHERE `id_maquina`=".$datos[0];
				$resultado2=$mysqli->query($consulta2);
				$datos2=$resultado2->fetch_array();
				echo "<td>".$datos2[0]."</td>";
				echo "<td>".$datos[1]."</td>";
				echo "<td>".$datos[2]."</td>";
			}
			echo "</tr>";
		$resultado = mysqli_query ($mysqli, $consulta_p) or die (mysql_error ());
		$libros = array();
		while( $rows = mysqli_fetch_assoc($resultado) ) {
			$libros[] = $rows;
		}
		if (!empty($_POST['escotilla'])) {
			if (strcmp($_POST['escotilla'],'Exportar a Excel')==0) {
				 if(!empty($libros)) {
				 $filename = "escotilla_informe.xls";
				 header("Content-Type: application/vnd.ms-excel");
				 header("Content-Disposition: attachment; filename=".$filename);

				 $mostrar_columnas = false;

				 foreach($libros as $libro) {
				 	/*
				 if(!$mostrar_columnas) {
				 echo implode("\t", array_keys($libro)) . "\n";
				 $mostrar_columnas = true;
				 }
				 echo implode("\t", array_values($libro)) . "\n";
				 */
				 }
				 }else{
				 echo 'No hay datos a exportar';
				 }
				 unset($_POST['escotilla']);
				 exit;
			}
		}
		}
		echo '<script type="window.location.href="informe.php";</script>';
?>