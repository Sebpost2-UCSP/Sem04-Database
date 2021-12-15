<?php
$conn = oci_connect("prueba","prueba","localhost/XE");
$sql = 'SELECT * from direcciones';
$union = oci_parse($conn, $sql);
oci_execute($union);

$direcciones=array();    
while (($pr=oci_fetch_assoc($union))!=false) 
    {
        $direcciones[]=$pr;      
    }

    if (isset($_POST['export']))
            {
                $filename = "direcciones.xls";
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
    <form action="direcciones_excel.php" method="post">
        <table id="" class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Distrito</th>
                <th>Ciudad</th>
                <th>Calle</th>
            </tr>

    <tbody>

        <?php foreach($direcciones as $direccion) { ?>
            <tr>
                <td><?php echo $direccion ['ID']; ?></td>
                <td><?php echo $direccion ['DISTRITO']; ?></td>
                <td><?php echo $direccion ['CIUDAD']; ?></td>
                <td><?php echo $direccion ['CALLE']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
 </table>
    <br><br><input type="submit" name="export" value="EXPORTAR">

    <br><br><a href='direcciones.php'>Volver a direcciones</a>
