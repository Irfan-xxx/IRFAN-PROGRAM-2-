<?php

include "../config/koneksi.php";

if(isset($_POST['simpan'])){

$no=$_POST['no'];

$nama=$_POST['nama'];

$tgl=$_POST['tgl'];

$hari=$_POST['hari'];

$tgl_datang=$_POST['tgl_datang'];

$jam=$_POST['jam'];

$cek=mysqli_query($conn,"SELECT COUNT(*) jumlah
FROM pendaftaran
WHERE tanggal_kedatangan='$tgl_datang'");

$row=mysqli_fetch_assoc($cek);

if($row['jumlah']>=5){

$tgl_datang=date('Y-m-d',strtotime($tgl_datang.' +1 day'));

}

mysqli_query($conn,"INSERT INTO pendaftaran
VALUES(
NULL,
'$no',
'$nama',
'$tgl',
'$hari',
'$tgl_datang',
'$jam'
)");

header("Location:index.php");

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Tambah</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h3>Tambah Data</h3>

<form method="POST">

<div class="mb-2">

<label>No Daftar</label>

<input type="text" name="no" class="form-control">

</div>

<div class="mb-2">

<label>Nama</label>

<input type="text" name="nama" class="form-control">

</div>

<div class="mb-2">

<label>Tanggal Daftar</label>

<input type="date" name="tgl" class="form-control">

</div>

<div class="mb-2">

<label>Hari</label>

<select name="hari" class="form-control">

<option>Senin</option>

<option>Selasa</option>

<option>Rabu</option>

<option>Kamis</option>

<option>Jumat</option>

</select>

</div>

<div class="mb-2">

<label>Tanggal Kedatangan</label>

<input type="date" name="tgl_datang" class="form-control">

</div>

<div class="mb-2">

<label>Jam</label>

<input type="time" name="jam" class="form-control">

</div>

<button class="btn btn-success" name="simpan">

Simpan

</button>

</form>

</div>

</body>

</html>