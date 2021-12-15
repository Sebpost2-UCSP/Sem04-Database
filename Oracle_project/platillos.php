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
        <form action="platillos.php" method="post">
            <select name="opciones">
                <option value="INSERTAR">INSERTAR</option>
                <option value="ELIMINAR">ELIMINAR</option>
                <option value="VISUALIZAR">VISUALIZAR</option>
                <option value="EDITAR">EDITAR</option>
            </select><BR>
            <h3> nombre :</h3><input type="text" name="nombre">
            <h3> codigo menu :</h3><input type="text" name="codigo_menu">
            <h3> codigo cuerpo :</h3><input type="text" name="codigo_cuerpo">
            <h3> descripcion :</h3><input type="text" name="descripcion">
            <h3> promedio :</h3><input type="text" name="promedio">
            <h3> costo :</h3><input type="text" name="costo">
            <h3> promocion :</h3><input type="text" name="promocion">
            <BR><BR>
            <h4> PARA EDITAR/ELIMINAR </h4>
            <h3> id :</h3><input type="text" name="id">
            <BR><BR>
            <input type="submit" name="EJECUTAR" value="SUBMIT">
            <br><br><a href='index.php'>Volver a home</a>
            <br><br><a href='platillos_excel.php'>exportar</a>

            <?php
            if (isset($_POST['EJECUTAR']) && isset($_POST['opciones']))
            {
                $opciones=$_POST['EJECUTAR'];
                $id=$_POST['id'];
                $nombre=$_POST['nombre'];
                $codme=$_POST['codigo_menu'];
                $codcu=$_POST['codigo_cuerpo'];
                $descripcion=$_POST['descripcion'];
                $promedio=$_POST['promedio'];
                $costo=$_POST['costo'];
                $promocion=$_POST['promocion'];
                echo"<fieldset><legend><h3>RESULTADOS</h3></legend>";

                if ($_POST['opciones']=='INSERTAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="INSERT INTO platillos VALUES('$nombre','$codme','$codcu','$descripcion','$promedio','$costo','$promocion')";
                    $union=oci_parse($conn,$sql);
                    oci_execute($union);
                    echo"DATOS INSERTADOS";
                }

                else if ($_POST['opciones']=='ELIMINAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="DELETE FROM platillos WHERE ID_NOMBRE='$id'";
                    $union=oci_parse($conn,$sql);
                    oci_execute($union);
                    echo "DATOS ELIMINADOS";
                }

                else if ($_POST['opciones']=='VISUALIZAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql = 'SELECT * from platillos';
                    $union = oci_parse($conn, $sql);
                    oci_execute($union);

					while (($pr=oci_fetch_assoc($union))!=false) 
                    {
						echo"<br> ".$pr['ID_NOMBRE']." | ".$pr['COD_MENU']." | ".$pr['COD_CUERPO']." | ".$pr['DESCRIPCION']." | ".$pr['PRMEDIO_CMPRA']." | ".$pr['COSTO']." | ".$pr['PROMOCION'];
                    }
                }

                else if ($_POST['opciones']=='EDITAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="UPDATE platillos SET ID_NOMBRE='$nombre',COD_MENU='$codme',COD_CUERPO='$codcu',DESCRIPCION='$descripcion',PRMEDIO_CMPRA='$promedio',COSTO='$costo',PROMOCION='$promocion' WHERE ID_NOMBRE='$id'";
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