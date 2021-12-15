<?php
$conn = oci_connect("prueba","prueba","localhost/XE");
$sql = 'SELECT * from comensales';
$union = oci_parse($conn, $sql);
oci_execute($union);

$comensales=array();    
while (($pr=oci_fetch_assoc($union))!=false) 
    {
        $comensales[]=$pr;      
    }
    
    if (isset($_POST['export']))
            {
                $filename = "comensales.xls";
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
    <form action="comensales_excel.php" method="post">
        <table id="" class="table table-striped table-bordered">
            <tr>
                <th>DNI</th>
                <th>Codigo direccion</th>
                <th>Nombre</th>
                <th>Apellido</th>
            </tr>

    <tbody>

        <?php foreach($comensales as $comensal) { ?>
            <tr>
                <td><?php echo $comensal ['DNI']; ?></td>
                <td><?php echo $comensal ['COD_DIREC']; ?></td>
                <td><?php echo $comensal ['NOMBRE']; ?></td>
                <td><?php echo $comensal ['APELLIDO']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
 </table>
    <br><br><input type="submit" name="export" value="EXPORTAR">

    <br><br><a href='comensales.php'>Volver a comensales</a>

