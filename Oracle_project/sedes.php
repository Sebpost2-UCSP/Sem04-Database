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
        <form action="sedes.php" method="post">
            <select name="opciones">
                <option value="INSERTAR">INSERTAR</option>
                <option value="ELIMINAR">ELIMINAR</option>
                <option value="VISUALIZAR">VISUALIZAR</option>
                <option value="EDITAR">EDITAR</option>
            </select><BR>
            <h3> codigo restaurante :</h3><input type="text" name="codigo_restaurante">
            <h3> codigo direccion :</h3><input type="text" name="codigo_direccion">
            <h3> nombre :</h3><input type="text" name="nombre">
            <h3> aforo :</h3><input type="text" name="aforo">
            <h3> telefono :</h3><input type="text" name="telefono">
            <BR><BR>
            <h4> PARA EDITAR/ELIMINAR </h4>
            <h3> id :</h3><input type="text" name="id">
            <BR><BR>
            <input type="submit" name="EJECUTAR" value="SUBMIT">
            <br><br><a href='index.php'>Volver a home</a>
            <br><br><a href='sedes_excel.php'>exportar</a>

            <?php
            if (isset($_POST['EJECUTAR']) && isset($_POST['opciones']))
            {
                $opciones=$_POST['EJECUTAR'];
                $id=$_POST['id'];
                $codre=$_POST['codigo_restaurante'];
                $coddi=$_POST['codigo_direccion'];
                $nombre=$_POST['nombre'];
                $aforo=$_POST['aforo'];
                $telefono=$_POST['telefono'];
                echo"<fieldset><legend><h3>RESULTADOS</h3></legend>";

                if ($_POST['opciones']=='INSERTAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="INSERT INTO sedes ( COD_RSTRANTE,COD_DIRECC,NOMBRE,AFORO,TELEFONO ) VALUES('$codre','$coddi','$nombre','$aforo','$telefono')";
                    $union=oci_parse($conn,$sql);
                    oci_execute($union);
                    echo"DATOS INSERTADOS";
                }

                else if ($_POST['opciones']=='ELIMINAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="DELETE FROM sedes WHERE id='$id'";
                    $union=oci_parse($conn,$sql);
                    oci_execute($union);
                    echo "DATOS ELIMINADOS";
                }

                else if ($_POST['opciones']=='VISUALIZAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql = 'SELECT * from sedes';
                    $union = oci_parse($conn, $sql);
                    oci_execute($union);

					while (($pr=oci_fetch_assoc($union))!=false) 
                    {
						echo"<br> ".$pr['ID']." | ".$pr['COD_RSTRANTE']." | ".$pr['COD_DIRECC']." | ".$pr['NOMBRE']." | ".$pr['AFORO']." | ".$pr['TELEFONO'];
                    }
                }

                else if ($_POST['opciones']=='EDITAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="UPDATE sedes SET COD_RSTRANTE='$codre',COD_DIRECC='$coddi',NOMBRE='$nombre',AFORO='$aforo',TELEFONO='$telefono' WHERE ID='$id'";
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