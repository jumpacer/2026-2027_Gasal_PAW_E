<?php
require_once("config.php");

if(isset($_GET["tindakan"])){
    switch ($_GET["tindakan"]){
        case "hapus":
            $id = $_GET["id"];
            try{
                $conn->query("DELETE FROM barang where id = '{$id}'");
                header("Location: barang.php?status=berhasil");
            }catch(mysqli_sql_exception){
                header("Location: barang.php?status=gagal");
            }
            break;
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $err = false;
    $kode = $_POST["kode"];
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];
    if(trim($kode) == ""){$err = true;}
    if(trim($nama) == ""){$err = true;}
    if(trim($harga) == "" || $harga<0){$err = true;}
    if(trim($stok) == "" || $stok<0){$err = true;}
    if(!$err){
        $conn->query("
            INSERT INTO barang(kode_barang, nama_barang, harga, stok) 
            VALUES('{$kode}', '{$nama}', '{$harga}', '{$stok}')
        ");
    }
    header("Location: barang.php");
}

$barang = $conn->query("SELECT * FROM barang");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <a href="index.php"  class="btn-head">Home</a>
        <a href="" class="active btn-head">Barang</a>
    </div>
    <br>
    <div class="form-cont">
        <form action="" method="POST">
            <div class="input">
                <label for="kode">Kode Barang</label>
                <input type="text" name="kode" id="kode" class="text">
            </div>
            <br>
            <div class="input">
                <label for="nama">Nama Barang</label>
                <input type="text" name="nama" id="nama" class="text">
            </div>
            <br>
            <div class="input">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="text">
            </div>
            <br>
            <div class="input">
                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" class="text">
            </div>
            <br>
            <div class="input">
                <input type="reset" class="btn-reset">
                <input type="submit" value="Tambah" class="btn-submit">
            </div>
        </form>
    </div>
    <br>
    <?php if(isset($_GET["status"])): ?>
        <?php if($_GET["status"] == "berhasil"): ?>
            <div class="notif berhasil">
                <p>Berhasil Menghapus Data</p>
            </div>
        <?php endif ?>
        <?php if($_GET["status"] == "gagal"): ?>
            <div class="notif error">
                <p>Barang Masih Digunakan</p>
            </div>
        <?php endif ?>
    <?php endif ?>
    <table>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th class="btn-cont">Tindakan</th>
        </tr>
        <?php foreach($barang as $ind=>$row): ?>
        <tr>
            <td><?=$ind+1?></td>
            <td><?=$row["kode_barang"]?></td>
            <td><?=$row["nama_barang"]?></td>
            <td><?=$row["harga"]?></td>
            <td><?=$row["stok"]?></td>
            <td class="btn-cont">
                <a href="barang.php?tindakan=hapus&id=<?=$row["id"]?>" class="btn-hapus">Hapus</a>
            </td>
        </tr>
        <?php endforeach ?>
    </table>
</body>
</html>