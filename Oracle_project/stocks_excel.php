<?php
$conn = oci_connect("prueba","prueba","localhost/XE");
$sql = 'SELECT * from stocks';
$union = oci_parse($conn, $sql);
oci_execute($union);

$stocks=array();    
while (($pr=oci_fetch_assoc($union))!=false) 
    {
        $stocks[]=$pr;      
    }

    if (isset($_POST['export']))
            {
                $filename = "stocks.xls";
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
    <form action="stocks_excel.php" method="post">
        <table id="" class="table table-striped table-bordered">
            <tr>
                <th>Codigo ingrediente</th>
                <th>Codigo proveedor</th>
                <th>Total</th>
            </tr>

    <tbody>

        <?php foreach($stocks as $stock) { ?>
            <tr>
                <td><?php echo $stock ['COD_INGREDIENTE']; ?></td>
                <td><?php echo $stock ['COD_PROVEEDOR']; ?></td>
                <td><?php echo $stock ['TOTAL']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
 </table>
    <br><br><input type="submit" name="export" value="EXPORTAR">

    <br><br><a href='stocks.php'>Volver a stocks</a>
