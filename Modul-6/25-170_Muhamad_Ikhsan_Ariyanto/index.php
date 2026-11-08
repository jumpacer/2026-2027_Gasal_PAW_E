<?php 
require_once "config.php";

if(isset($_GET["tindakan"])){
    switch($_GET["tindakan"]){
        case "Tambah":
            $date = date("Y-m-d");
            $pelanggan = $_GET["pelanggan"];
            $conn->query("INSERT INTO transaksi(waktu_transaksi, pelanggan_id, total) VALUES('{$date}', '{$pelanggan}', 0)");
            header("Location: detail.php?id=" . $conn->insert_id);
            break;
        case "hapus":
            $id = $_GET["id"];
            $conn->query("DELETE FROM transaksi WHERE id = '{$id}'");
            header("Location: index.php");
            break;
    }
}

$pelanggan = $conn->query("SELECT id, nama FROM pelanggan");

$data = $conn->query("
    SELECT t.id, p.nama, t.waktu_transaksi, t.total
    FROM transaksi AS t LEFT JOIN pelanggan AS p
    ON t.pelanggan_id = p.id
    ORDER BY t.id desc
");
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
        <a href="" class="active btn-head">Home</a>
        <a href="barang.php" class="btn-head">Barang</a>
    </div>
    <br>
    <div class="form-cont">
        <form action="" method="GET">
            <div class="input">
                <label for="pelanggan">Pelanggan</label>
                <select name="pelanggan" id="pelanggan">
                    <?php foreach($pelanggan as $row): ?>
                    <option value="<?=$row['id']?>"><?=$row['nama']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <br>
            <div class="input">
                <input type="submit" name="tindakan" value="Tambah" class="btn-tambah">
            </div>
        </form>
    </div>
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Waktu Transaksi</th>
            <th>Total</th>
            <th class="btn-cont">Tindakan</th>
        </tr>
        <?php foreach($data as $ind=>$row): ?>
        <tr>
            <td><?=$ind + 1?></td>
            <td><?=$row["nama"]?></td>
            <td><?=$row["waktu_transaksi"]?></td>
            <td><?=$row["total"]?></td>
            <td class="btn-cont">
                <a href="detail.php?id=<?=$row["id"]?>" class="btn-edit">Edit</a>
                <a href="index.php?tindakan=hapus&id=<?=$row["id"]?>" class="btn-hapus">Hapus</a>
            </td>
        </tr>
        <?php endforeach ?>
    </table>
</body>
</html>