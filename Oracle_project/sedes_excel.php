<?php
$conn = oci_connect("prueba","prueba","localhost/XE");
$sql = 'SELECT * from sedes';
$union = oci_parse($conn, $sql);
oci_execute($union);

$sedes=array();    
while (($pr=oci_fetch_assoc($union))!=false) 
    {
        $sedes[]=$pr;      
    }

    if (isset($_POST['export']))
            {
                $filename = "sedes.xls";
                header("Content-Type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=".$filename);               
            }
        oci_close($conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" />
    </head>

<body>
    <form action="sedes_excel.php" method="post">
        <table id="" class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Codigo restaurante</th>
                <th>Codigo direccion</th>
                <th>Nombre</th>
                <th>Aforo</th>
                <th>Telefono</th>
            </tr>

    <tbody>

        <?php foreach($sedes as $sede) { ?>
            <tr>
                <td><?php echo $sede ['ID']; ?></td>
                <td><?php echo $sede ['COD_RSTRANTE']; ?></td>
                <td><?php echo $sede ['COD_DIRECC']; ?></td>
                <td><?php echo $sede ['NOMBRE']; ?></td>
                <td><?php echo $sede ['AFORO']; ?></td>
                <td><?php echo $sede ['TELEFONO']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
 </table>
    <br><br><input type="submit" name="export" value="EXPORTAR">

    <br><br><a href='sedes.php'>Volver a sedes</a>

