<?php
require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    var_dump($_POST);
    $query = "";
    switch($_POST['submit']){
        case "batal":
            header("Location: index.php");
            break;
        case "Update":
            $query = "UPDATE supplier SET nama = '{$_POST['nama']}', telp = '{$_POST['telp']}', alamat = '{$_POST['alamat']}' WHERE id='{$_POST['id']}'";
            break;
        case "Simpan":
            $query = "INSERT INTO supplier(nama, telp, alamat) VALUES ('{$_POST['nama']}', '{$_POST['telp']}', '{$_POST['alamat']}')";
    };

    $result = mysqli_query($db, $query);
    header("Location: index.php"); 
}

?>