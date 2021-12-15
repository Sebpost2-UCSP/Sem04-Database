<?php
$conn = oci_connect("prueba","prueba","localhost/XE");
$sql = 'SELECT * from crpo_pedidos';
$union = oci_parse($conn, $sql);
oci_execute($union);

$crpo_pedidos=array();    
while (($pr=oci_fetch_assoc($union))!=false) 
    {
        $crpo_pedidos[]=$pr;      
    }

    if (isset($_POST['export']))
            {
                $filename = "crpo_pedidos.xls";
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
    <form action="crpo_pedidos_excel.php" method="post">
        <table id="" class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Codigo encabezado</th>
                <th>Descripcion</th>
                <th>Costo total</th>
                <th>Cantidad</th>
            </tr>

    <tbody>

        <?php foreach($crpo_pedidos as $crpo_pedido) { ?>
            <tr>
                <td><?php echo $crpo_pedido ['ID']; ?></td>
                <td><?php echo $crpo_pedido ['COD_ENCBZADO']; ?></td>
                <td><?php echo $crpo_pedido ['DESCRIPCION']; ?></td>
                <td><?php echo $crpo_pedido ['COSTO_TOTAL']; ?></td>
                <td><?php echo $crpo_pedido ['CANITDAD']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
 </table>
    <br><br><input type="submit" name="export" value="EXPORTAR">

    <br><br><a href='crpo_pedidos.php'>Volver a crpo_pedidos</a>
