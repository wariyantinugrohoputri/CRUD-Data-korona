<?php
    $connect = mysqli_connect('localhost', 'root', '', 'ppkm');

    if ($connect->connect_error){
        die("koneksi gagal");
    }else{
    //echo "koneksi berhasil";
    } 
?>