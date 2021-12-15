<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" a href="style.css" />
        <style>
body {
  background-color: lightblue;
}
h1 {
  text-decoration: underline;
  font: italic bold 40px/25px Georgia, serif;
}
h3 {
  font: italic bold 15px/25px Georgia, serif;
}
h4 {
  text-decoration: underline;
  font: italic bold 15px/25px Georgia, serif;
}
input[type=text] {
  width: 40%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 2px ;
  border-radius: 4px;
}

</style>
    </head>

    <body>
        <h1>Base de datos</h1>
        <form action="trabajadores.php" method="post">
            <select name="opciones">
                <option value="INSERTAR">INSERTAR</option>
                <option value="ELIMINAR">ELIMINAR</option>
                <option value="VISUALIZAR">VISUALIZAR</option>
                <option value="EDITAR">EDITAR</option>
            </select><BR>
            <h3> DNI :</h3><input type="text" name="dni">
            <h3> codigo sede :</h3><input type="text" name="codigo_sede">
            <h3> nombre :</h3><input type="text" name="nombre">
            <h3> telefono :</h3><input type="text" name="telefono">
            <h3> asistencias :</h3><input type="text" name="asistencias">
            <h3> fecha de inicio :</h3><input type="text" name="fecha" placeholder=01/01/2021>
            <BR><BR>
            <h4> PARA EDITAR/ELIMINAR </h4>
            <h3> DNI :</h3><input type="text" name="id">
            <BR><BR>
            <input type="submit" name="EJECUTAR" value="SUBMIT">
            <br><br><a href='index.php'>Volver a home</a>
            <br><br><a href='trabajadores_excel.php'>exportar</a>
            <?php
            if (isset($_POST['EJECUTAR']) && isset($_POST['opciones']))
            {
                $opciones=$_POST['EJECUTAR'];
                $id=$_POST['id'];
                $dni=$_POST['dni'];
                $codse=$_POST['codigo_sede'];
                $nombre=$_POST['nombre'];
                $telefono=$_POST['telefono'];
                $asistencias=$_POST['asistencias'];
                $fecha=$_POST['fecha'];
                echo"<fieldset><legend><h3>RESULTADOS</h3></legend>";

                if ($_POST['opciones']=='INSERTAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="INSERT INTO trabajadores ( DNI, COD_SEDE, NOMBRE,  TELEFONO, ASISTENCIAS, FCHA_INICIO ) VALUES('$dni','$codse','$nombre','$telefono','$asistencias',TO_DATE('$fecha', 'DD/MM/YYYY'))";
                    $union=oci_parse($conn,$sql);
                    oci_execute($union);
                    echo"DATOS INSERTADOS";
                }

                else if ($_POST['opciones']=='ELIMINAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="DELETE FROM trabajadores WHERE ID_NOMBRE='$id'";
                    $union=oci_parse($conn,$sql);
                    oci_execute($union);
                    echo "DATOS ELIMINADOS";
                }

                else if ($_POST['opciones']=='VISUALIZAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql = 'SELECT * from trabajadores';
                    $union = oci_parse($conn, $sql);
                    oci_execute($union);

					while (($pr=oci_fetch_assoc($union))!=false) 
                    {
						echo"<br> ".$pr['DNI']." | ".$pr['COD_SEDE']." | ".$pr['NOMBRE']." | ".$pr['TELEFONO']." | ".$pr['ASISTENCIAS']." | ".$pr['FCHA_INICIO'];
                    }
                }

                else if ($_POST['opciones']=='EDITAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="UPDATE trabajadores SET COD_SEDE='$codse',NOMBRE='$nombre',TELEFONO='$telefono',ASISTENCIAS='$asistencias',FCHA_INICIO='$fecha' WHERE DNI='$id'";
                    $union = oci_parse($conn,$sql);
                    oci_execute($union);
                    echo "DATOS EDITADOS";
                }
                

                echo"</fieldset";
            }

            ?>
        </form>
    </body>
</html>