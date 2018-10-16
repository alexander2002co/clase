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
    if (!empty($_POST['cambiar'])) {
        $_SESSION['cod_prod']=$_POST["cambiar"];
        echo'<script type="text/javascript">alert("Editar  "); window.location.href = "formulario.php";</script>';
    }
    if (!empty($_POST['eliminar'])) {
        $borrar="DELETE FROM `formulario` WHERE descargue=".$_POST['eliminar'];
        echo'<script type="text/javascript">alert("'.$_POST['eliminar'].'");</script>';
        $resultado=$mysqli->query($borrar);
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>TCIS:Reporte de Vehiculos</title>
    <link rel="stylesheet" type="text/css" href="contenido/general.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" href="rensposive/bootstrap-4.1.3-dist/css/bootstrap.min.css">
</head>

<body>
    <div id="ext" class="container">
        <div class="row">
            <div class="col">
                <img src="img/TECEEC.png" class="rounded mx-auto d-block" id="logoti">
            </div>
            <div class="col">
                <h1 class="lead display-4" align="center">MENU</h1>
            </div>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item w-25">
                <a class="nav-link active w-100" id="silo-tab" data-toggle="tab" href="#silo" role="tab" aria-controls="silo"
                    aria-selected="true">Silo</a>
            </li>
            <li class="nav-item w-25">
                <a class="nav-link w-100" id="maquinaria-tab" data-toggle="tab" href="#maquinaria" role="tab"
                    aria-controls="maquinaria" aria-selected="false">Maquinaria</a>
            </li>
            <li class="nav-item w-25">
                <a class="nav-link w-100" id="escotilla-tab" data-toggle="tab" href="#escotilla" role="tab"
                    aria-controls="escotilla" aria-selected="false">Escotilla</a>
            </li>
        </ul><br>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="silo" role="tabpanel" aria-labelledby="silo-tab">
                <table class="table">
                    <thead class="thead-dark">
                        <form method="post">
                            <tr>
                                <th colspan="10">SILO</th>
                            </tr>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Inspector</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Arin</th>
                                <th scope="col">Peso</th>
                                <th scope="col">Placa</th>
                                <th scope="col">Silo</th>
                                <th scope="col">Escotilla</th>
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
                echo "<td scope='row'>".$reg['id_ingre']."</td>";
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
                ?>
                            </tbody>
                </table><input type="submit" value="Exportar a Excel" class="tam btn btn-primary btn-lg" name="silo"
                    formaction="descarga_excel.php">
                <input type="submit" value="Regresar" class="tam btn btn-secondary btn-lg" formaction="menupalermo.php">
                </form>
            </div>
            <div class="tab-pane fade" id="maquinaria" role="tabpanel" aria-labelledby="maquinaria-tab">
                <table class="table">
                    <thead class="thead-dark">
                        <form method="post">
                            <tr>
                                <th colspan="10">MAQUINARIA</th>
                            </tr>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Fecha registro</th>
                                <th scope="col">Hora registro</th>
                                <th scope="col">Inspector</th>
                                <th scope="col">tipo</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Silo</th>
                                <th scope="col">Hora Inicial</th>
                                <th scope="col">Hora final</th>
                                <th scope="col">Total Horas</th>
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
                        echo "<td scope='row'>".$reg['id_maquinaria']."</td>";
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
            ?>
                            </tbody>
                </table>
                <input type="submit" value="Exportar a Excel" class="tam btn btn-primary btn-lg" name="maquinaria"
                    formaction="descarga_excel.php">
                <input type="submit" value="Regresar" class="tam btn btn-secondary btn-lg" formaction="menupalermo.php">
                </form>
            </div>
            <div class="tab-pane fade" id="escotilla" role="tabpanel" aria-labelledby="escotilla-tab">
                <table class="table">
                    <thead class="thead-dark">
                        <form method="post">
                            <tr>
                                <th colspan="9">ESCOTILLA</th>
                            </tr>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Fecha Registro</th>
                                <th scope="col">Hora Registro</th>
                                <th scope="col">Inspector</th>
                                <th scope="col">Nombre Escotilla</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Maquinaria</th>
                                <th scope="col">Hora de Inicio</th>
                                <th scope="col">Hora Final</th>
                                <th scope="col">Hora total</th>
                            </tr>
                            <?php           
                $consulta_p="SELECT * from ecotilla order by `id_escotilla` asc";
                $resultado=$mysqli->query($consulta_p);
                $TotReg=mysqli_num_rows($resultado);
                foreach ($resultado as $reg) {
                echo "<tr>";
                echo "<td scope='row'>".$reg['id_escotilla']."</td>";
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
                $dif=tiempoTranscurridoFechas($datos[1],$datos[2]);
                echo "<td>".$dif."</td>";
            }
            echo "</tr>";
        $resultado = mysqli_query ($mysqli, $consulta_p) or die (mysql_error ());
        $libros = array();
        while( $rows = mysqli_fetch_assoc($resultado) ) {
            $libros[] = $rows;
        }
        ?>
                            </tbody>
                </table>
                <input type="submit" value="Exportar a Excel" class="tam btn btn-primary btn-lg" name="escotilla"
                    formaction="descarga_excel.php">
                <input type="submit" value="Regresar" class="tam btn btn-secondary btn-lg" formaction="menupalermo.php">
                </form>
            </div>
        </div>
    </div>
    <script src="rensposive/bootstrap-4.1.3-dist/js/jquery-3.3.1.min.js"></script>
    <script src="rensposive/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
</body>

</html>