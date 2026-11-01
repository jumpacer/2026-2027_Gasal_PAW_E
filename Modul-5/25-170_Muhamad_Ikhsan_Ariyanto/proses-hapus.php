<?php
include "config.php";

if( isset($_GET['id']) ){
    $id = $_GET['id'];

    $sql = "DELETE FROM supplier WHERE id=$id";
    $query = mysqli_query($db, $sql);
    header('Location: index.php');
}
?>