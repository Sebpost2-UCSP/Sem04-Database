<?php
$conn = oci_connect("prueba","prueba","localhost/XE");
$sql = 'SELECT * from managers';
$union = oci_parse($conn, $sql);
oci_execute($union);

$managers=array();    
while (($pr=oci_fetch_assoc($union))!=false) 
    {
        $managers[]=$pr;      
    }

    if (isset($_POST['export']))
            {
                $filename = "managers.xls";
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
    <form action="managers_excel.php" method="post">
        <table id="" class="table table-striped table-bordered">
            <tr>
                <th>DNI</th>
                <th>Codigo sede</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Universidad</th>
                <th>Asistencias</th>
                <th>Fecha de inicio</th>
            </tr>

    <tbody>

        <?php foreach($managers as $manager) { ?>
            <tr>
                <td><?php echo $manager ['DNI']; ?></td>
                <td><?php echo $manager ['COD_SEDE']; ?></td>
                <td><?php echo $manager ['NOMBRE']; ?></td>
                <td><?php echo $manager ['TELEFONO']; ?></td>
                <td><?php echo $manager ['UNIVERSIDAD']; ?></td>
                <td><?php echo $manager ['ASISTENCIAS']; ?></td>
                <td><?php echo $manager ['FCHA_INICIO']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
 </table>
    <br><br><input type="submit" name="export" value="EXPORTAR">

    <br><br><a href='managers.php'>Volver a managers</a>
