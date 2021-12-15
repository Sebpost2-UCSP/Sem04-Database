<?php
$conn = oci_connect("prueba","prueba","localhost/XE");
$sql = 'SELECT * from trabajadores';
$union = oci_parse($conn, $sql);
oci_execute($union);

$trabajadores=array();    
while (($pr=oci_fetch_assoc($union))!=false) 
    {
        $trabajadores[]=$pr;      
    }

    if (isset($_POST['export']))
            {
                $filename = "trabajadores.xls";
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
    <form action="trabajadores_excel.php" method="post">
        <table id="" class="table table-striped table-bordered">
            <tr>
                <th>DNI</th>
                <th>Codigo sede</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Asistencias</th>
                <th>Fecha inicio</th>
            </tr>

    <tbody>

        <?php foreach($trabajadores as $trabajos) { ?>
            <tr>
                <td><?php echo $trabajos ['DNI']; ?></td>
                <td><?php echo $trabajos ['COD_SEDE']; ?></td>
                <td><?php echo $trabajos ['NOMBRE']; ?></td>
                <td><?php echo $trabajos ['TELEFONO']; ?></td>
                <td><?php echo $trabajos ['ASISTENCIAS']; ?></td>
                <td><?php echo $trabajos ['FCHA_INICIO']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
 </table>
    <br><br><input type="submit" name="export" value="EXPORTAR">

    <br><br><a href='trabajadores.php'>Volver a trabajadores</a>
