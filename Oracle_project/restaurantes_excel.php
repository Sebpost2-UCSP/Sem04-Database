<?php
$conn = oci_connect("prueba","prueba","localhost/XE");
$sql = 'SELECT * from restaurantes';
$union = oci_parse($conn, $sql);
oci_execute($union);

$restaurantes=array();    
while (($pr=oci_fetch_assoc($union))!=false) 
    {
        $restaurantes[]=$pr;      
    }

    if (isset($_POST['export']))
            {
                $filename = "restaurantes.xls";
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
    <form action="restaurantes_excel.php" method="post">
        <table id="" class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Dueno</th>
                <th>Telefono</th>
            </tr>

    <tbody>

        <?php foreach($restaurantes as $restaurante) { ?>
            <tr>
                <td><?php echo $restaurante ['ID']; ?></td>
                <td><?php echo $restaurante ['DUENO']; ?></td>
                <td><?php echo $restaurante ['TELEFONO']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
 </table>
    <br><br><input type="submit" name="export" value="EXPORTAR">

    <br><br><a href='restaurantes.php'>Volver a restaurantes</a>
