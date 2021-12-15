<?php
$conn = oci_connect("prueba","prueba","localhost/XE");
$sql = 'SELECT * from encbzdo_pedidos';
$union = oci_parse($conn, $sql);
oci_execute($union);

$encbzdo_pedidos=array();    
while (($pr=oci_fetch_assoc($union))!=false) 
    {
        $encbzdo_pedidos[]=$pr;      
    }

    if (isset($_POST['export']))
            {
                $filename = "encbzdo_pedidos.xls";
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
    <form action="encbzdo_pedidos_excel.php" method="post">
        <table id="" class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Codigo dni</th>
                <th>Fecha</th>
                <th>Codigo delivery</th>
            </tr>

    <tbody>

        <?php foreach($encbzdo_pedidos as $encbzdo_pedido) { ?>
            <tr>
                <td><?php echo $encbzdo_pedido ['ID']; ?></td>
                <td><?php echo $encbzdo_pedido ['COD_DNI']; ?></td>
                <td><?php echo $encbzdo_pedido ['FECHA']; ?></td>
                <td><?php echo $encbzdo_pedido ['COD_DELIVERY']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
 </table>
    <br><br><input type="submit" name="export" value="EXPORTAR">

    <br><br><a href='encbzdo_pedidos.php'>Volver a encbzdo_pedidos</a>
