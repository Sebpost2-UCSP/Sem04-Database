<?php
$conn = oci_connect("prueba","prueba","localhost/XE");
$sql = 'SELECT * from ingredientes';
$union = oci_parse($conn, $sql);
oci_execute($union);

$ingredientes=array();    
while (($pr=oci_fetch_assoc($union))!=false) 
    {
        $ingredientes[]=$pr;      
    }

    if (isset($_POST['export']))
            {
                $filename = "ingredientes.xls";
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
    <form action="ingredientes_excel.php" method="post">
        <table id="" class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Codigo platillo</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Fecha de vencimiento</th>
                <th>Descripcion</th>
            </tr>

    <tbody>

        <?php foreach($ingredientes as $ingrediente) { ?>
            <tr>
                <td><?php echo $ingrediente ['ID']; ?></td>
                <td><?php echo $ingrediente ['COD_PLATILLO']; ?></td>
                <td><?php echo $ingrediente ['NOMBRE']; ?></td>
                <td><?php echo $ingrediente ['PRECIO']; ?></td>
                <td><?php echo $ingrediente ['FCHA_VENCE']; ?></td>
                <td><?php echo $ingrediente ['DESCRIPCION']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
 </table>
    <br><br><input type="submit" name="export" value="EXPORTAR">

    <br><br><a href='ingredientes.php'>Volver a ingredientes</a>