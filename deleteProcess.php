<?php
include "connection.php";

$idKota = $_GET['id_kab_kota'];
$queryDeleteVaksinasi = mysqli_query($connect,"DELETE FROM VAKSINASI WHERE id_kab_kota=$idKota");
if($queryDeleteVaksinasi){
    $queryDeleteKota = mysqli_query($connect,"DELETE FROM kabupaten_kota WHERE id_kab_kota=$idKota");
    if($queryDeleteKota){
        header("Location: index.php");
    }else{
        echo " eror". $connect->error;
    }
}
