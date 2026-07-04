<?php
include "../config/koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>

<title>Pengurusan Paspor</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>Data Pengurusan Paspor</h2>

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>No</th>

<th>No Daftar</th>

<th>Nama Pemohon</th>

<th>No Antrian</th>

<th>Keterangan</th>

<th>Status</th>

<th>Biaya</th>

</tr>

</thead>

<tbody>

<?php

$no = 1;

$query = mysqli_query($conn,"
SELECT
pendaftaran.no_daftar,
pendaftaran.nama_pemohon,
daftar_ulang.no_antrian,
daftar_ulang.keterangan
FROM daftar_ulang
JOIN pendaftaran
ON daftar_ulang.id_pendaftaran = pendaftaran.id
");

while($d=mysqli_fetch_array($query)){

if($d['keterangan']=="OK"){

$status="DITERIMA";
$biaya="Rp355.000";

}else{

$status="DITOLAK";
$biaya="-";

}

?>

<tr>

<td><?= $no++ ?></td>

<td><?= $d['no_daftar'] ?></td>

<td><?= $d['nama_pemohon'] ?></td>

<td><?= $d['no_antrian'] ?></td>

<td><?= $d['keterangan'] ?></td>

<td>

<?php

if($status=="DITERIMA"){

?>

<span class="badge bg-success">

<?= $status ?>

</span>

<?php

}else{

?>

<span class="badge bg-danger">

<?= $status ?>

</span>

<?php } ?>

</td>

<td><?= $biaya ?></td>

</tr>

<?php } ?>

</tbody>

</table>

<a href="../index.php" class="btn btn-secondary">

Kembali

</a>

</div>

</body>

</html>