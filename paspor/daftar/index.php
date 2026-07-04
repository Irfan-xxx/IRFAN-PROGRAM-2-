<?php
include "../config/koneksi.php";

if(isset($_POST['simpan'])){

    $no     = mysqli_real_escape_string($conn, $_POST['no']);
    $nama   = mysqli_real_escape_string($conn, $_POST['nama']);
    $tgl    = $_POST['tgl'];
    $hari   = $_POST['hari'];
    $datang = $_POST['datang'];
    $jam    = $_POST['jam'];

    // Cek apakah No. Daftar sudah ada
    $cekNo = mysqli_query($conn,"SELECT * FROM pendaftaran WHERE no_daftar='$no'");

    if(mysqli_num_rows($cekNo) > 0){

        echo "<script>
                alert('No. Daftar sudah digunakan!');
                window.location='index.php';
              </script>";
        exit;
    }

    // Cek jumlah pendaftar pada tanggal yang dipilih
    $cekKuota = mysqli_query($conn,"SELECT COUNT(*) AS jumlah
                                    FROM pendaftaran
                                    WHERE tanggal_kedatangan='$datang'");

    $hasil = mysqli_fetch_assoc($cekKuota);

    // Jika sudah 5 orang
    if($hasil['jumlah'] >= 5){

        echo "<script>
                alert('Maaf, kuota pendaftaran tanggal $datang sudah penuh. Maksimal hanya 5 orang setiap hari.');
                window.location='index.php';
              </script>";
        exit;
    }

    // Simpan data
    $simpan = mysqli_query($conn,"INSERT INTO pendaftaran
    (no_daftar,nama_pemohon,tanggal_daftar,hari,tanggal_kedatangan,jam)
    VALUES
    (
        '$no',
        '$nama',
        '$tgl',
        '$hari',
        '$datang',
        '$jam'
    )");

    if($simpan){

        echo "<script>
                alert('Pendaftaran berhasil disimpan.');
                window.location='index.php';
              </script>";

    }else{

        echo "<script>
                alert('Data gagal disimpan!');
                window.location='index.php';
              </script>";

    }

}
?>
<!DOCTYPE html>
<html>
<head>

<title>Input Pendaftaran</title>

<style>

body{

font-family:Arial;

}

table{

border-collapse:collapse;

width:900px;

}

table,th,td{

border:1px solid black;
padding:6px;

}

input,select{

width:200px;

}

</style>

</head>

<body>

<h3>Input Pendaftaran</h3>

<form method="POST">

<table border="0">

<tr>

<td>No. Daftar</td>

<td>:</td>

<td>

<input type="text"
name="no"
required>

</td>

</tr>

<tr>

<td>Nama Pemohon</td>

<td>:</td>

<td>

<input type="text"
name="nama"
required>

</td>

</tr>

<tr>

<td>Tanggal Daftar</td>

<td>:</td>

<td>

<input type="date"
name="tgl"
required>

</td>

</tr>

<tr>

<td>Hari</td>

<td>:</td>

<td>

<select name="hari">

<option>Senin</option>
<option>Selasa</option>
<option>Rabu</option>
<option>Kamis</option>
<option>Jumat</option>

</select>

</td>

</tr>

<tr>

<td>Tanggal Kedatangan</td>

<td>:</td>

<td>

<input type="date"
name="datang"
required>

</td>

</tr>

<tr>

<td>Jam</td>

<td>:</td>

<td>

<input type="time"
name="jam"
required>

</td>

</tr>

<tr>

<td></td>

<td></td>

<td>

<button
name="simpan">

Simpan

</button>

</td>

</tr>

</table>

</form>

<br>

<b>Data Pendaftar</b>

<br><br>

<table>

<tr>

<th>No. Daftar</th>

<th>Nama Pemohon</th>

<th>Tgl Daftar</th>

<th>Hari</th>

<th>Tanggal</th>

<th>Jam</th>

<th>Action</th>

</tr>

<?php

$data=mysqli_query($conn,"SELECT * FROM pendaftaran");

while($d=mysqli_fetch_array($data)){

?>

<tr>

<td><?= $d['no_daftar']?></td>

<td><?= $d['nama_pemohon']?></td>

<td><?= $d['tanggal_daftar']?></td>

<td><?= $d['hari']?></td>

<td><?= $d['tanggal_kedatangan']?></td>

<td><?= $d['jam']?></td>

<td>

<a href="edit.php?id=<?= $d['id']?>">

Edit

</a>

|

<a href="hapus.php?id=<?= $d['id']?>"
onclick="return confirm('Hapus data?')">

Hapus

</a>

</td>

</tr>

<?php } ?>

</table>

</body>

</html>