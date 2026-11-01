<?php
$bname = (isset($_GET['id']))? "Update" : "Simpan";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="proses-update.php" method="POST">
        <?php
        if(isset($_GET['id'])){ 
            echo("<input type='hidden' name='id' value='{$_GET['id']}'>");
        }
        ?>
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama">
        <br>
        <label for="telp">Telp</label>
        <input type="text" id="telp" name="telp">
        <br>
        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" name="alamat">
        <input type="submit" value="<?php echo($bname);?>" name="submit">
        <input type="submit" value="batal" name="submit">
    </form>
</body>
</html>