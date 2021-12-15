<?php
$conn = oci_connect("prueba","prueba","localhost/XE");
$sql = 'SELECT * from platillos';
$union = oci_parse($conn, $sql);
oci_execute($union);

$platillos=array();    
while (($pr=oci_fetch_assoc($union))!=false) 
    {
        $platillos[]=$pr;      
    }

    if (isset($_POST['export']))
            {
                $filename = "platillos.xls";
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
    <form action="platillos_excel.php" method="post">
        <table id="" class="table table-striped table-bordered">
            <tr>
                <th>DNI</th>
                <th>Codigo menu</th>
                <th>Codigo cuerpo</th>
                <th>Descripcion</th>
                <th>Promedio compra</th>
                <th>Costo</th>
                <th>Promocion</th>
            </tr>

    <tbody>

        <?php foreach($platillos as $platillo) { ?>
            <tr>
                <td><?php echo $platillo ['ID_NOMBRE']; ?></td>
                <td><?php echo $platillo ['COD_MENU']; ?></td>
                <td><?php echo $platillo ['COD_CUERPO']; ?></td>
                <td><?php echo $platillo ['DESCRIPCION']; ?></td>
                <td><?php echo $platillo ['PRMEDIO_CMPRA']; ?></td>
                <td><?php echo $platillo ['COSTO']; ?></td>
                <td><?php echo $platillo ['PROMOCION']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
 </table>
    <br><br><input type="submit" name="export" value="EXPORTAR">

    <br><br><a href='platillos.php'>Volver a platillos</a>
