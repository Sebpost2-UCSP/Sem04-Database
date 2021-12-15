<?php
$conn = oci_connect("prueba","prueba","localhost/XE");
$sql = 'SELECT * from proveedores';
$union = oci_parse($conn, $sql);
oci_execute($union);

$proveedores=array();    
while (($pr=oci_fetch_assoc($union))!=false) 
    {
        $proveedores[]=$pr;      
    }

    if (isset($_POST['export']))
            {
                $filename = "proveedores.xls";
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
    <form action="proveedores_excel.php" method="post">
        <table id="" class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Codigo direccion</th>
                <th>Nombre</th>
                <th>Telefono</th>
            </tr>

    <tbody>

        <?php foreach($proveedores as $proveedor) { ?>
            <tr>
                <td><?php echo $proveedor ['ID']; ?></td>
                <td><?php echo $proveedor ['COD_DIREC']; ?></td>
                <td><?php echo $proveedor ['NOMBRE']; ?></td>
                <td><?php echo $proveedor ['TELEFONO']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
 </table>
    <br><br><input type="submit" name="export" value="EXPORTAR">

    <br><br><a href='proveedores.php'>Volver a proveedores</a>

