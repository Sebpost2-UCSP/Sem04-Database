<?php
$conn = oci_connect("prueba","prueba","localhost/XE");
$sql = 'SELECT * from deliveris';
$union = oci_parse($conn, $sql);
oci_execute($union);

$deliveris=array();    
while (($pr=oci_fetch_assoc($union))!=false) 
    {
        $deliveris[]=$pr;      
    }

    if (isset($_POST['export']))
            {
                $filename = "deliveris.xls";
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
    <form action="deliveris_excel.php" method="post">
        <table id="" class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Costo adicional</th>
                <th>Telefono</th>
                <th>Plazo de entrega</th>
            </tr>

    <tbody>

        <?php foreach($deliveris as $deliveri) { ?>
            <tr>
                <td><?php echo $deliveri ['ID']; ?></td>
                <td><?php echo $deliveri ['COSTO_ADCNAL']; ?></td>
                <td><?php echo $deliveri ['TELEFONO']; ?></td>
                <td><?php echo $deliveri ['PLAZO_ENTREGA']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
 </table>
    <br><br><input type="submit" name="export" value="EXPORTAR">

    <br><br><a href='deliveris.php'>Volver a deliveris</a>

