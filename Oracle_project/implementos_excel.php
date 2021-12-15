<?php
$conn = oci_connect("prueba","prueba","localhost/XE");
$sql = 'SELECT * from implementos';
$union = oci_parse($conn, $sql);
oci_execute($union);

$implementos=array();    
while (($pr=oci_fetch_assoc($union))!=false) 
    {
        $implementos[]=$pr;      
    }

    if (isset($_POST['export']))
    {
        $filename = "implementos.xls";
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
    <form action="implementos_excel.php" method="post">
        <table id="" class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Codigo sede</th>
                <th>Costo</th>
                <th>Cantidad</th>
                <th>Nombre</th>
                <th>Fecha de mantenimiento</th>
            </tr>

    <tbody>

        <?php foreach($implementos as $implemento) { ?>
            <tr>
                <td><?php echo $implemento ['ID']; ?></td>
                <td><?php echo $implemento ['COD_SEDE']; ?></td>
                <td><?php echo $implemento ['COSTO']; ?></td>
                <td><?php echo $implemento ['CANTIDAD']; ?></td>
                <td><?php echo $implemento ['NOMBRE']; ?></td>
                <td><?php echo $implemento ['FCHA_MNTNIENTO']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
 </table>
    <br><br><input type="submit" name="export" value="EXPORTAR">

    <br><br><a href='implementos.php'>Volver a implementos</a>
