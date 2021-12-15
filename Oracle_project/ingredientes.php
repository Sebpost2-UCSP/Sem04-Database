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
        <form action="ingredientes.php" method="post">
            <select name="opciones">
                <option value="INSERTAR">INSERTAR</option>
                <option value="ELIMINAR">ELIMINAR</option>
                <option value="VISUALIZAR">VISUALIZAR</option>
                <option value="EDITAR">EDITAR</option>
            </select><BR>
            <h3> codigo platillo :</h3><input type="text" name="codigo_platillo">
            <h3> nombre :</h3><input type="text" name="nombre">
            <h3> precio :</h3><input type="text" name="precio">
            <h3> vencimiento :</h3><input type="text" name="vencimiento" placeholder='01/01/2021'>
            <h3> descripcion :</h3><input type="text" name="descripcion">
            <BR><BR>
            <h4> PARA EDITAR/ELIMINAR </h4>
            <h3> id :</h3><input type="text" name="id">
            <BR><BR>
            <input type="submit" name="EJECUTAR" value="SUBMIT">
            <br><br><a href='index.php'>Volver a home</a>
            <br><br><a href='ingredientes_excel.php'>exportar</a>

            <?php
            if (isset($_POST['EJECUTAR']) && isset($_POST['opciones']))
            {
                $opciones=$_POST['EJECUTAR'];
                $id=$_POST['id'];
                $codpl=$_POST['codigo_platillo'];
                $nombre=$_POST['nombre'];
                $precio=$_POST['precio'];
                $vencimiento=$_POST['vencimiento'];
                $descripcion=$_POST['descripcion'];
                echo"<fieldset><legend><h3>RESULTADOS</h3></legend>";

                if ($_POST['opciones']=='INSERTAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="INSERT INTO ingredientes ( COD_PLATILLO,NOMBRE,PRECIO,FCHA_VENCE,DESCRIPCION ) VALUES('$codpl','$nombre','$precio',TO_DATE('$vencimiento', 'DD/MM/YYYY'),'$descripcion')";
                    $union=oci_parse($conn,$sql);
                    oci_execute($union);
                    echo"DATOS INSERTADOS";
                }

                else if ($_POST['opciones']=='ELIMINAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="DELETE FROM ingredientes WHERE id='$id'";
                    $union=oci_parse($conn,$sql);
                    oci_execute($union);
                    echo "DATOS ELIMINADOS";
                }

                else if ($_POST['opciones']=='VISUALIZAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql = 'SELECT * from ingredientes';
                    $union = oci_parse($conn, $sql);
                    oci_execute($union);

					while (($pr=oci_fetch_assoc($union))!=false) 
                    {
						echo"<br> ".$pr['ID']." | ".$pr['COD_PLATILLO']." | ".$pr['NOMBRE']." | ".$pr['PRECIO']." | ".$pr['FCHA_VENCE']." | ".$pr['DESCRIPCION'];
                    }
                }

                else if ($_POST['opciones']=='EDITAR')
                {
                    $conn = oci_connect("prueba","prueba","localhost/XE");
                    $sql="UPDATE ingredientes SET COD_PLATILLO='$codpl',NOMBRE='$nombre',PRECIO='$precio',FCHA_VENCE='$vencimiento',DESCRIPCION='$descripcion' WHERE ID='$id'";
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