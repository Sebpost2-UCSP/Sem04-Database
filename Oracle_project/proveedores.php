


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
        <form action="proveedores.php" method="post">
            <select name="opciones">
                <option value="INSERTAR">INSERTAR</option>
                <option value="ELIMINAR">ELIMINAR</option>
                <option value="VISUALIZAR">VISUALIZAR</option>
                <option value="EDITAR">EDITAR</option>
            </select><BR>
            <h3> Codigo direccion :</h3><input type="text" name="codigo">
            <h3> Nombre :</h3><input type="text" name="nombre">
            <h3> Telefono :</h3><input type="text" name="telefono">
            <BR><BR>
            <h4> PARA EDITAR/ELIMINAR </h4>
            <h3> Id :</h3><input type="text" name="id">
            <BR><BR>
            <input type="submit" name="EJECUTAR" value="SUBMIT">
            <br><br><a href='index.php'>Volver a home</a>
            <br><br><a href='proveedores_excel.php'>exportar</a>
        </form>
    </body>
</html>

            <?php
            if (isset($_POST['EJECUTAR']) && isset($_POST['opciones']))
            {
                $opciones=$_POST['EJECUTAR'];
                $id=$_POST['id'];
                $cod=$_POST['codigo'];
                $nom=$_POST['nombre'];
                $tel=$_POST['telefono'];
                echo"<fieldset><legend><h3>RESULTADOS</h3></legend>";

                if ($_POST['opciones']=='INSERTAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="INSERT INTO proveedores ( COD_DIREC, NOMBRE, TELEFONO ) VALUES('$cod','$nom','$tel')";
                    $union=oci_parse($conn,$sql);
                    oci_execute($union);
                    echo"DATOS INSERTADOS";
                }

                else if ($_POST['opciones']=='ELIMINAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="DELETE FROM proveedores WHERE id='$id'";
                    $union=oci_parse($conn,$sql);
                    oci_execute($union);
                    echo "DATOS ELIMINADOS";
                }

                else if ($_POST['opciones']=='VISUALIZAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql = 'SELECT * from proveedores';
                    $union = oci_parse($conn, $sql);
                    oci_execute($union);

					while (($pr=oci_fetch_assoc($union))!=false) 
                    {
						echo"<br> ".$pr['ID']." | ".$pr['COD_DIREC']." | ".$pr['NOMBRE']." | ".$pr['TELEFONO'];
                    }
                }

                else if ($_POST['opciones']=='EDITAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="UPDATE proveedores SET COD_DIREC='$cod',NOMBRE='$nom',TELEFONO='$tel' WHERE ID='$id'";
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