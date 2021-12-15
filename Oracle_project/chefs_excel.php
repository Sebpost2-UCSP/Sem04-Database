<?php
$conn = oci_connect("prueba","prueba","localhost/XE");
$sql = 'SELECT * from chefs';
$union = oci_parse($conn, $sql);
oci_execute($union);

$chefs=array();    
while (($pr=oci_fetch_assoc($union))!=false) 
    {
        $chefs[]=$pr;      
    }

    if (isset($_POST['export']))
    {
        $filename = "chefs.xls";
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
    <form action="chefs_excel.php" method="post">
        <table id="" class="table table-striped table-bordered">
            <tr>
                <th>DNI</th>
                <th>Codigo sede</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Fecha inicio</th>
                <th>Asistencias</th>
                <th>Especialidad</th>
            </tr>

    <tbody>

        <?php foreach($chefs as $chef) { ?>
            <tr>
                <td><?php echo $chef ['DNI']; ?></td>
                <td><?php echo $chef ['COD_SEDE']; ?></td>
                <td><?php echo $chef ['NOMBRE']; ?></td>
                <td><?php echo $chef ['TELEFONO']; ?></td>
                <td><?php echo $chef ['FCHA_INICIO']; ?></td>
                <td><?php echo $chef ['ASISTENCIAS']; ?></td>
                <td><?php echo $chef ['ESPECIALIDAD']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
 </table>
    <br><br><input type="submit" name="export" value="EXPORTAR">

    <br><br><a href='chefs.php'>Volver a chefs</a>

