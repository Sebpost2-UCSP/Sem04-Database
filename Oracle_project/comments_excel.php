<?php
$conn = oci_connect("prueba","prueba","localhost/XE");
$sql = 'SELECT * from comments';
$union = oci_parse($conn, $sql);
oci_execute($union);

$comments=array();    
while (($pr=oci_fetch_assoc($union))!=false) 
    {
        $comments[]=$pr;      
    }


    if (isset($_POST['export']))
    {
        $filename = "comments.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".$filename);
        oci_close($conn);               
    }    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" />
    </head>

<body>
    <form action="comments_excel.php" method="post">
        <table id="" class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Codigo sede</th>
                <th>Calificacion</th>
                <th>Resena</th>
            </tr>

    <tbody>

        <?php foreach($comments as $comment) { ?>
            <tr>
                <td><?php echo $comment ['ID']; ?></td>
                <td><?php echo $comment ['COD_SEDE']; ?></td>
                <td><?php echo $comment ['CALIFICACION']; ?></td>
                <td><?php echo $comment ['RESENA']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
 </table>
    <br><br><input type="submit" name="export" value="EXPORTAR">

    <br><br><a href='comments.php'>Volver a comments</a>

