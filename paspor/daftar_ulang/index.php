<?php
include "../config/koneksi.php";

if(isset($_POST['simpan'])){

$id = $_POST['id_pendaftaran'];

$ktp = $_POST['ktp'];
$kk = $_POST['kk'];
$ijazah = $_POST['ijazah'];

if($ktp=="Ya" && $kk=="Ya" && $ijazah=="Ya"){

    $ket="OK";

    $q=mysqli_query($conn,"SELECT MAX(no_antrian) as no FROM daftar_ulang");

    $d=mysqli_fetch_assoc($q);

    if($d['no']==""){

        $antrian="A001";

    }else{

        $angka=substr($d['no'],1);

        $angka++;

        $antrian="A".str_pad($angka,3,"0",STR_PAD_LEFT);

    }

}else{

    $ket="Tidak";

    $antrian="-";

}

mysqli_query($conn,"INSERT INTO daftar_ulang
VALUES(
NULL,
'$id',
'$ktp',
'$kk',
'$ijazah',
'$ket',
'$antrian'
)");

header("Location:index.php");

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Daftar Ulang</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>Daftar Ulang</h2>

<form method="POST">

<hr>

<table class="table table-bordered">

<tr>

<th>No</th>

<th>Nama</th>

<th>KTP</th>

<th>KK</th>

<th>Ijazah</th>

<th>Keterangan</th>

<th>No Antrian</th>

</tr>

<?php

$no=1;

$sql=mysqli_query($conn,"
SELECT
daftar_ulang.*,
pendaftaran.nama_pemohon
FROM daftar_ulang
JOIN pendaftaran
ON daftar_ulang.id_pendaftaran=pendaftaran.id
");

while($d=mysqli_fetch_array($sql)){

?>

<tr>

<td><?= $no++ ?></td>

<td><?= $d['nama_pemohon'] ?></td>

<td><?= $d['ktp'] ?></td>

<td><?= $d['kk'] ?></td>

<td><?= $d['ijazah'] ?></td>

<td><?= $d['keterangan'] ?></td>

<td><?= $d['no_antrian'] ?></td>

</tr>

<?php } ?>

</table>

<label>Pemohon</label>

<select name="id_pendaftaran" class="form-control">

<?php

$data=mysqli_query($conn,"SELECT * FROM pendaftaran");

while($d=mysqli_fetch_array($data)){

?>

<option value="<?= $d['id']?>">

<?= $d['nama_pemohon']?>

</option>

<?php } ?>

</select>

<br>

<label>KTP</label>

<select name="ktp" class="form-control">

<option>Ya</option>

<option>Tidak</option>

</select>

<br>

<label>KK</label>

<select name="kk" class="form-control">

<option>Ya</option>

<option>Tidak</option>

</select>

<br>

<label>Ijazah / Akta</label>

<select name="ijazah" class="form-control">

<option>Ya</option>

<option>Tidak</option>

</select>

<br>

<button class="btn btn-success" name="simpan">

Simpan

</button>

</form>

</div>

</body>

</html>