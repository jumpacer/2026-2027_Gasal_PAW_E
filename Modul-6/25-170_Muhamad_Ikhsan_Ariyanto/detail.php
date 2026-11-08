<?php
require_once("config.php");

$id = $_GET["id"];

if(isset($_GET["hapus"])){
    $barang = $_GET["hapus"];
    $data = $conn->query("
        SELECT harga, qty FROM transaksi_detail 
        WHERE transaksi_id = '{$id}' AND barang_id = '{$barang}'
    ")->fetch_assoc();
    $conn->query("DELETE FROM transaksi_detail WHERE transaksi_id = '{$id}' AND barang_id = '{$barang}'");
    $conn->query("UPDATE transaksi SET total = total - '{$data['harga']}' WHERE id = '{$id}'");
    $conn->query("UPDATE barang SET stok = stok + '{$data['qty']}' WHERE id = '{$barang}'");
    header("Location: detail.php?id=" . $id);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $err = false;
    $barang = $_POST["barang"];
    $qty = $_POST["qty"];
    if($barang == ""){$err = true;}
    if($qty == "" || $qty < 0){$err = true;}
    if(!$err){
        $stok = $conn->query("SELECT stok FROM barang WHERE id = '{$barang}'")->fetch_column();
        if($qty > $stok){$err = true;}
    }
    if(!$err){
        $harga_barang = $conn->query("SELECT harga FROM barang WHERE id = '{$barang}'")->fetch_column();
        $total = $harga_barang * $qty;
        $conn->query("INSERT INTO transaksi_detail VALUES('{$id}', '{$barang}', '{$total}', '{$qty}');");
        $conn->query("UPDATE transaksi SET total = total + '{$total}' WHERE id = '{$id}'");
        $conn->query("UPDATE barang SET stok = stok - '{$qty}' WHERE id = '{$barang}'");
    }
}

$barang = $conn->query("
    SELECT b.id, b.kode_barang, b.nama_barang, b.stok, EXISTS(
        SELECT 1 FROM transaksi_detail AS d 
        WHERE transaksi_id = '{$id}' AND d.barang_id = b.id
    ) AS ada
    FROM barang AS b
    ORDER BY kode_barang
");
$detail = $conn->query("
    SELECT b.id, b.nama_barang, b.harga as harga_barang, t.qty, t.harga
    FROM transaksi_detail as t LEFT JOIN barang as b
    ON t.barang_id = b.id
    WHERE t.transaksi_id = '{$id}'
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
        <a href="index.php"  class="btn-head">Home</a>
        <a href="barang.php" class="btn-head">Barang</a>
    </div>
    <div class="form-cont">
        <form action="" method="POST">
            <div class="input">
                <label for="barang">Barang </label>
                <select name="barang" id="barang" class="select">
                    <option value="-1" selected>Choose</option>
                    <?php foreach($barang as $row): ?>
                    <option value="<?=$row["id"]?>" <?=$row["ada"] ? "disabled" : ""?>><?="{$row["nama_barang"]} ({$row["kode_barang"]} | {$row["stok"]})"?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <br>
            <div class="input">
                <label for="qty">Jumlah </label>
                <input type="number" name="qty" id="qty" class="text">
            </div>
            <br>
            <div class="input">
                <input type="reset" value="reset" class="btn-reset">
                <input type="submit" value="tambah" class="btn-submit">
            </div>
        </form>
    </div>
    <table>
        <tr>
            <th>No</th>
            <th>Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Tindakan</th>
        </tr>
        <?php foreach($detail as $ind=>$row): ?>
        <tr>
            <td><?=$ind+1?></td>
            <td><?=$row["nama_barang"]?></td>
            <td><?=$row["harga_barang"]?></td>
            <td><?=$row["qty"]?></td>
            <td><?=$row["harga"]?></td>
            <td class="btn-cont"><a href="detail.php?id=<?=$id?>&hapus=<?=$row["id"]?>" class="btn-hapus">Hapus</a></td>
        </tr>
        <?php endforeach ?>
    </table>
</body>
</html>