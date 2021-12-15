


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
        <form action="chefs.php" method="post">
            <select name="opciones">
                <option value="INSERTAR">INSERTAR</option>
                <option value="ELIMINAR">ELIMINAR</option>
                <option value="VISUALIZAR">VISUALIZAR</option>
                <option value="EDITAR">EDITAR</option>
            </select><BR>
            <h3> DNI :</h3><input type="text" name="codigo_DNI">
            <h3> codigo sede :</h3><input type="text" name="codigo_sede">
            <h3> nombre :</h3><input type="text" name="nombre">
            <h3> telefono :</h3><input type="text" name="telefono">
            <h3> fecha de inicio :</h3><input type="text" name="fecha_inicio" placeholder='09/01/2023'>
            <h3> asistencias :</h3><input type="text" name="asistencias">
            <h3> especialidad :</h3><input type="text" name="especialidad">
            <BR><BR>
            <h4> PARA EDITAR/ELIMINAR </h4>
            <h3> id :</h3><input type="text" name="id">
            <BR><BR>
            <input type="submit" name="EJECUTAR" value="SUBMIT">
            <br><br><a href='index.php'>Volver a home</a>
            <br><br><a href='chefs_excel.php'>exportar</a>

            <?php
            if (isset($_POST['EJECUTAR']) && isset($_POST['opciones']))
            {
                $opciones=$_POST['EJECUTAR'];
                $id=$_POST['id'];
                $Dni=$_POST['codigo_DNI'];
                $codse=$_POST['codigo_sede'];
                $nombre=$_POST['nombre'];
                $tel=$_POST['telefono'];
                $fcha=$_POST['fecha_inicio'];
                $asist=$_POST['asistencias'];
                $especialidad=$_POST['especialidad'];
                echo"<fieldset><legend><h3>RESULTADOS</h3></legend>";

                if ($_POST['opciones']=='INSERTAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="INSERT INTO chefs VALUES('$Dni','$codse','$nombre','$tel',TO_DATE('$fcha', 'DD/MM/YYYY'),'$asist','$especialidad')";
                    $union=oci_parse($conn,$sql);
                    oci_execute($union);
                    echo"DATOS INSERTADOS";
                }

                else if ($_POST['opciones']=='ELIMINAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="DELETE FROM chefs WHERE DNI='$id'";
                    $union=oci_parse($conn,$sql);
                    oci_execute($union);
                    echo "DATOS ELIMINADOS";
                }

                else if ($_POST['opciones']=='VISUALIZAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql = 'SELECT * from chefs';
                    $union = oci_parse($conn, $sql);
                    oci_execute($union);

					while (($pr=oci_fetch_assoc($union))!=false) 
                    {
						echo"<br> ".$pr['DNI']." | ".$pr['COD_SEDE']." | ".$pr['NOMBRE']." | ".$pr['TELEFONO']." | ".$pr['FCHA_INICIO']." | ".$pr['ASISTENCIAS']." | ".$pr['ESPECIALIDAD'];
                    }
                }

                else if ($_POST['opciones']=='EDITAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="UPDATE chefs SET COD_DNI='$Dni',COD_SEDE='$codse',NOMBRE='$nombre',TELEFONO='$tel',FCHA_INICIO='$fcha',ASISTENCIAS='$asist',ESPECIALIDAD='$especialidad' WHERE DNI='$id'";
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