<?php
$conn = oci_connect("prueba","prueba","localhost/XE");
$sql = 'SELECT * from menus';
$union = oci_parse($conn, $sql);
oci_execute($union);

$menus=array();    
while (($pr=oci_fetch_assoc($union))!=false) 
    {
        $menus[]=$pr;      
    }

    if (isset($_POST['export']))
            {
                $filename = "menus.xls";
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
    <form action="menus_excel.php" method="post">
        <table id="" class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Codigo sede</th>
                <th>Dia</th>
            </tr>

    <tbody>

        <?php foreach($menus as $menu) { ?>
            <tr>
                <td><?php echo $menu ['ID']; ?></td>
                <td><?php echo $menu ['COD_SEDE']; ?></td>
                <td><?php echo $menu ['DIA']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
 </table>
    <br><br><input type="submit" name="export" value="EXPORTAR">

    <br><br><a href='menus.php'>Volver a menus</a>
