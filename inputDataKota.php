<?php
include "connection.php";

if(isset($_POST['tambahKota'])){
  $namaKota = $_POST['namaKota'];
  $idProvinsi = $_POST['idProvinsi'];
  $totalPenduduk =$_POST['totalPenduduk'];
  $jumlahLansia=$_POST['jumlahLansia'];
  echo $totalPenduduk;
  if($namaKota=="" || $idProvinsi=="" || $totalPenduduk=="" || $jumlahLansia==""){
    $error = true;
  }else{
    $getIdKota= mysqli_query($connect,"SELECT MAX(id_kab_kota) FROM kabupaten_kota");
    while($showIdKota = mysqli_fetch_array($getIdKota)){
      $idKota = $showIdKota['MAX(id_kab_kota)']+1;
    }
    $queryInsertDataKota = mysqli_query($connect,"INSERT INTO kabupaten_kota(id_kab_kota,id_provinsi,nama_kab_kota,jml_total_penduduk,jml_lansia)
                                                  VALUE ('$idKota','$idProvinsi','$namaKota','$totalPenduduk','$jumlahLansia')");
    if($queryInsertDataKota){
      header("Location: index.php");
    }else{
      echo "error".$connect->error;
    }
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <title>Admin</title>
</head>
<body>
      <section>
        <div class="container">
            <h2>Input Data Kota</h2>
            <div class="row">
              <div class="column-2">
                  <img src="assets/img/vaksin.svg" alt="">
              </div>
              <div class="column-2">
                <h3></h3>
                <!-- form -->
                <form method="POST">
                  <label>Provinsi</label>
                  <select name="idProvinsi" id="kota" class="dropdown">
                    <?php 
                    $queryDataKota = mysqli_query($connect,"SELECT * FROM provinsi");
                    while($showDataKota = mysqli_fetch_array($queryDataKota)){
                      $idProvinsi = $showDataKota['id_provinsi'];
                      $namaProvinsi = $showDataKota['nama_provinsi'];
                    ?>
                        <option value="<?=$idProvinsi?>"><?= $namaProvinsi;?></option>
                    <?php } ?>
                  </select>
                  <label>Nama Kota/Kabupaten</label>
                  <input placeholder="Nama Kabupaten / Kota" name="namaKota" type="text">
                  <label>Total Penduduk</label>
                  <input  placeholder="Total Penduduk" name="totalPenduduk" type="text">
                  <label>Jumlah Lansia</label>
                  <input  placeholder="Jumlah Lansia" name="jumlahLansia" type="text">
                    <button class="button button2" name="tambahKota">Tambah Kota/Kabupaten</button>
                </form>
                <!-- end form -->
              </div>
            </div>
          </div>
      </section>
</body>
</html>