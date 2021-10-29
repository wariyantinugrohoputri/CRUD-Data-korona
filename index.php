<?php
include "connection.php";

if(isset($_POST['tambahDataTervaksin'])){
  $idKota = $_POST['kota'];
  $totalPendudukTervaksin = $_POST['totalPendudukTervaksin'];
  $jumlahLansiaTervaksin = $_POST['jumlahLansiaTervaksin'];
  if($idKota =="" || $totalPendudukTervaksin =="" || $jumlahLansiaTervaksin==""){
    $error = true;
  }else{
    $getIdVaksinasi = mysqli_query($connect,"SELECT MAX(id_vaksinasi) FROM vaksinasi");
    while($showIdVaksinasi = mysqli_fetch_array($getIdVaksinasi)){
      $idVaksinasi = $showIdVaksinasi['MAX(id_vaksinasi)']+1;
    }
    echo $idVaksinasi;
    echo $idKota;
    $queryInsertDataVaksinasi = mysqli_query($connect,"INSERT INTO vaksinasi(id_vaksinasi,id_kab_kota,jml_total_vaksinasi,jml_lansia_vaksinasi)
                                                        VALUE ('$idVaksinasi','$idKota','$totalPendudukTervaksin','$jumlahLansiaTervaksin')");
    if($queryInsertDataVaksinasi){
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
            <h2>Input Data</h2>
            <div class="row">
              <div class="column-2">
                  <img src="assets/img/vaksin.svg" alt="">
              </div>
              <div class="column-2">
                <h3></h3>
                <!-- form -->
                <form method="POST">
                  <label>Kota/Kabupaten</label>
                  <select name="kota" id="kota" class="dropdown">
                  <?php 
                  $queryDataKota = mysqli_query($connect,"SELECT * FROM kabupaten_kota");
                  while($showDataKota = mysqli_fetch_array($queryDataKota)){
                    $idKota = $showDataKota['id_kab_kota'];
                    $namaKota = $showDataKota['nama_kab_kota'];
                  ?>
                    <option value="<?=$idKota?>"><?= $namaKota;?></option>
                  <?php 
                  } ?>
                  </select>
                  <label>Jumlah Total Tervaksinasi</label>
                  <input placeholder="Total Telah Tervaksin" name="totalPendudukTervaksin" type="text">
                  <label>Jumlah Lansia Tevaksinasi</label>
                  <input  placeholder="Jumlah Lansia telah Tervaksin" name="jumlahLansiaTervaksin" type="text">
                  <a href="index.html">
                    <button class="button button1" name="tambahDataTervaksin">Tambah Data Tervaksinasi</button>
                 </a>  
                </form>
                <!-- end form -->
                <p style="text-align: center;">Daftarkan Kota/Kabupaten Jika Belum Tersedia Dipilihan</p>
                <a href="inputDataKota.php">
                    <button class="button button2" name="tambahProject">Tambah Kota/Kabupaten</button>
                 </a> 
              </div>
            </div>
          </div>
      </section>
      <br>
      <br>
      <section>
        <div class="container">
            <h2>PPKM Information</h2>
            <div class="row">
              <table>
                  <tr>
                      <th class="colT-1">Provinsi</th>
                      <th class="colT-1">Kota/Kabupaten</th>
                      <th class="colT-3">Total Penduduk</th>
                      <th class="colT-1">Jumlah Lansia</th>
                      <th class="colT-1">Total Tevaksinansi</th>
                      <th class="colT-1">Lansia Tevaksinansi</th>
                      <th class="colT-1">Level PPKM</th>
                      <th class="colT-1" style="text-align: center;">Aksi</th>
                  </tr>
                  <?php
                  $queryDataVaksinasi = mysqli_query($connect,"SELECT *
                                                              FROM kabupaten_kota
                                                              JOIN provinsi
                                                              ON kabupaten_kota.id_provinsi = provinsi.id_provinsi
                                                              JOIN vaksinasi
                                                              ON vaksinasi.id_kab_kota= kabupaten_kota.id_kab_kota");
                  while($showDataVaksinasi = mysqli_fetch_array($queryDataVaksinasi)){
                    $provinsi = $showDataVaksinasi['nama_provinsi'];
                    $kota = $showDataVaksinasi['nama_kab_kota'];
                    $totalPenduduk = $showDataVaksinasi['jml_total_penduduk'];
                    $jumlahLansia = $showDataVaksinasi['jml_lansia'];
                    $totalVaksinasi = $showDataVaksinasi['jml_total_vaksinasi'];
                    $jumlahLansiaVaksinasi = $showDataVaksinasi['jml_lansia_vaksinasi'];
                    $persenTotalVaksin = $totalVaksinasi / $totalPenduduk * 100;
                    $persenLansiaVaksin = $jumlahLansiaVaksinasi / $jumlahLansia * 100;

                  if($persenTotalVaksin>=50 && $persenTotalVaksin<70 && $persenLansiaVaksin>=40 && $persenLansiaVaksin<60 ){
                  ?>
                  <tr class="kuning">
                      <td class="colT-1"><?= $provinsi?></td>
                      <td class="colT-1"><?= $kota?></td>
                      <td class="colT-3"><?= $totalPenduduk?></td>
                      <td class="colT-3"><?= $jumlahLansia?></td>
                      <td class="colT-3"><?= $persenTotalVaksin?>%</td>
                      <td class="colT-3"><?= $persenLansiaVaksin?>%</td>
                      <td class="colT-3">2</td>
                      <td class="colT-1">
                      <a <?php echo "href='updateDataVaksinasi.php?id_kab_kota=$showDataVaksinasi[id_kab_kota]'";?>><button class="button buttonEdit">Edit</button></a>
                          <a <?php echo "href='deleteProcess.php?id_kab_kota=$showDataVaksinasi[id_kab_kota]'";?>>
                            <button class="button buttonHapus">Hapus</button>
                        </a>
                      </td>
                  </tr>
                  <?php } else if( $persenTotalVaksin>=70 && $persenLansiaVaksin>=60){?>
                    <tr class="hijau">
                      <td class="colT-1"><?= $provinsi?></td>
                      <td class="colT-1"><?= $kota?></td>
                      <td class="colT-3"><?= $totalPenduduk?></td>
                      <td class="colT-3"><?= $jumlahLansia?></td>
                      <td class="colT-3"><?= $persenTotalVaksin?>%</td>
                      <td class="colT-3"><?= $persenLansiaVaksin?>%</td>
                      <td class="colT-3">1</td>
                      <td class="colT-1">
                      <a <?php echo "href='updateDataVaksinasi.php?id_kab_kota=$showDataVaksinasi[id_kab_kota]'";?>><button class="button buttonEdit">Edit</button></a>
                          <a <?php echo "href='deleteProcess.php?id_kab_kota=$showDataVaksinasi[id_kab_kota]'";?>>
                            <button class="button buttonHapus">Hapus</button>
                        </a>
                      </td>
                  </tr>
                  <?php } else{?>
                    <tr class="merah">
                      <td class="colT-1"><?= $provinsi?></td>
                      <td class="colT-1"><?= $kota?></td>
                      <td class="colT-3"><?= $totalPenduduk?></td>
                      <td class="colT-3"><?= $jumlahLansia?></td>
                      <td class="colT-3"><?= $persenTotalVaksin?>%</td>
                      <td class="colT-3"><?= $persenLansiaVaksin?>%</td>
                      <td class="colT-3">3</td>
                      <td class="colT-1">
                          <a <?php echo "href='updateDataVaksinasi.php?id_kab_kota=$showDataVaksinasi[id_kab_kota]'";?>>
                            <button class="button buttonEdit">Edit</button>
                          </a>
                          <a <?php echo "href='deleteProcess.php?id_kab_kota=$showDataVaksinasi[id_kab_kota]'";?>>
                            <button class="button buttonHapus">Hapus</button>
                        </a>
                      </td>
                  </tr>
                  <?php } ?>
                <?php } ?>
              </table>
            </div>
        </div>
    </section>
    <p>19081010020 Wariyanti Nugroho Putri</p>
</body>
</html>