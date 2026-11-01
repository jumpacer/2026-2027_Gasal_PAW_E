<?php require_once "config.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <a href="update.php">Tambah</a>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
        <?php
        $syn = "SELECT * FROM supplier";
        $query = mysqli_query($db, $syn);
        foreach($query as $row){
            echo("<tr>");
            foreach($row as $key => $val){
                echo("<td>{$val}</td>");
            }
            echo("<td>");
            echo "<a href='update.php?id=".$row['id']."'>Edit</a>";
            echo "<a href='proses-hapus.php?id=".$row['id']."' onclick=\"return confirm('test?');\">Hapus</a>";
            echo "</td>"; 
            echo("</tr>");
        }
        ?>
    </table>
</body>
</html>