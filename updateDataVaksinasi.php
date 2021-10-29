<?php
include "connection.php";

$idKota = $_GET['id_kab_kota'];

if(isset($_POST['editDataTervaksin'])){
  $totalPendudukTervaksin = $_POST['totalPendudukTervaksin'];
  $jumlahLansiaTervaksin = $_POST['jumlahLansiaTervaksin'];
  $namaKota = $_POST['namaKota'];
  $totalPenduduk = $_POST['totalPenduduk'];
  $jumlahLansia = $_POST['jumlahLansia'];
  if($totalPendudukTervaksin =="" || $jumlahLansiaTervaksin==""){
    $error = true;
  }else{
    $queryUpdateDataVaksinasi = mysqli_query($connect,"UPDATE vaksinasi 
                                                       SET jml_total_vaksinasi='$totalPendudukTervaksin',jml_lansia_vaksinasi='$jumlahLansiaTervaksin'
                                                       WHERE id_kab_kota='$idKota'");
    if($queryUpdateDataVaksinasi){
      $queryUpdateDataKota = mysqli_query($connect,"UPDATE kabupaten_kota 
      SET nama_kab_kota='$namaKota',jml_total_penduduk='$totalPenduduk',jml_lansia='$jumlahLansia'
      WHERE id_kab_kota='$idKota'");
      if($queryUpdateDataKota){
        header("Location: index.php");
      }else{
      echo "error".$connect->error;
      }
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
            <h2>Update Data</h2>
            <div class="row">
              <div class="column-2">
                  <img src="assets/img/vaksin.svg" alt="">
              </div>
              <div class="column-2">
                <h3></h3>
                <!-- form -->
                <form method="POST">
                  <?php
                  $queryAlamatKota = mysqli_query($connect,"SELECT *
                                                            FROM kabupaten_kota
                                                            JOIN provinsi
                                                            ON kabupaten_kota.id_provinsi = provinsi.id_provinsi
                                                            JOIN vaksinasi
                                                            ON vaksinasi.id_kab_kota= kabupaten_kota.id_kab_kota
                                                            WHERE kabupaten_kota.id_kab_kota=$idKota");
                  while($showAlamatKota = mysqli_fetch_array($queryAlamatKota)){
                    $namaProvinsi = $showAlamatKota['nama_provinsi'];
                    $namaKota = $showAlamatKota['nama_kab_kota'];
                    $totalPenduduk = $showAlamatKota['jml_total_penduduk'];
                    $jumlahLansia = $showAlamatKota['jml_lansia'];
                    $totalVaksinasi = $showAlamatKota['jml_total_vaksinasi'];
                    $jumlahLansiaVaksinasi = $showAlamatKota['jml_lansia_vaksinasi'];
                  }
                  ?>
                  <h3><?= $namaProvinsi ?> , <?= $namaKota ?></h3>
                  <label>Nama Kota</label>
                  <input placeholder="Total Telah Tervaksin" name="namaKota" type="text" value="<?=$namaKota?>">
                  <label>Total Penduduk</label>
                  <input  placeholder="Total Penduduk" name="totalPenduduk" type="text" value="<?=$totalPenduduk?>">
                  <label>Jumlah Lansia</label>
                  <input  placeholder="Jumlah Lansia" name="jumlahLansia" type="text" value="<?=$jumlahLansia?>">
                  <label>Jumlah Total Tervaksinasi</label>
                  <input placeholder="Total Telah Tervaksin" name="totalPendudukTervaksin" type="text" value="<?=$totalVaksinasi?>">
                  <label>Jumlah Lansia Tevaksinasi</label>
                  <input  placeholder="Jumlah Lansia telah Tervaksin" name="jumlahLansiaTervaksin" type="text" value="<?=$jumlahLansiaVaksinasi?>">
                    <button class="button button1" name="editDataTervaksin">Edit Data Tervaksinasi</button>
                </form>
                <!-- end form -->  
              </div>
            </div>
          </div>
      </section>
</body>
</html>