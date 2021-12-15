


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
        <form action="restaurantes.php" method="post">
            <select name="opciones">
                <option value="INSERTAR">INSERTAR</option>
                <option value="ELIMINAR">ELIMINAR</option>
                <option value="VISUALIZAR">VISUALIZAR</option>
                <option value="EDITAR">EDITAR</option>
            </select><BR>
            <h3> Dueno :</h3><input type="text" name="Dueno">
            <h3> Telefono :</h3><input type="text" name="Telefono">
            <BR><BR>
            <h4> PARA EDITAR/ELIMINAR </h4>
            <h3> id :</h3><input type="text" name="id">
            <BR><BR>
            <input type="submit" name="EJECUTAR" value="SUBMIT">
            <br><br><a href='index.php'>Volver a home</a>
            <br><br><a href='restaurantes_excel.php'>exportar</a>

            <?php
            if (isset($_POST['EJECUTAR']) && isset($_POST['opciones']))
            {
                $opciones=$_POST['EJECUTAR'];
                $id=$_POST['id'];
                $Dueno=$_POST['Dueno'];
                $Telefono=$_POST['Telefono'];
                echo"<fieldset><legend><h3>RESULTADOS</h3></legend>";

                if ($_POST['opciones']=='INSERTAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="INSERT INTO restaurantes ( DUENO, TELEFONO) VALUES('$Dueno','$Telefono')";
                    $union=oci_parse($conn,$sql);
                    oci_execute($union);
                    echo"DATOS INSERTADOS";
                }

                else if ($_POST['opciones']=='ELIMINAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="DELETE FROM restaurantes WHERE id='$id'";
                    $union=oci_parse($conn,$sql);
                    oci_execute($union);
                    echo "DATOS ELIMINADOS";
                }

                else if ($_POST['opciones']=='VISUALIZAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql = 'SELECT * from restaurantes';
                    $union = oci_parse($conn, $sql);
                    oci_execute($union);

					while (($pr=oci_fetch_assoc($union))!=false) 
                    {
						echo"<br> ".$pr['ID']." | ".$pr['DUENO']." | ".$pr['TELEFONO'];
                    }
                }

                else if ($_POST['opciones']=='EDITAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="UPDATE restaurantes SET DUENO='$Dueno',TELEFONO='$Telefono' WHERE ID='$id'";
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