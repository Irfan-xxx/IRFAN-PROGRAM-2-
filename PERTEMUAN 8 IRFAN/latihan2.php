<html>
<head><title>Contoh Penggunaan UDF</title></head>
<body>
<form method="post">
    Masukkan Bilangan Pertama : <br>
    <input type="text" name="A" size=10> <br>
    Masukkan Bilangan Kedua : <br>
    <input type="text" name="B" size=10> <br>
    <input type="submit" value="hitung">
</form>

<?php
if ($_POST) {
    $A = $_POST["A"];
    $B = $_POST["B"];

    function jumlah($A, $B) {
        return $A + $B;
    }
    function kurang($A, $B) {
        return $A - $B;
    }
    function kali($A, $B) {
        return $A * $B;
    }
    function bagi($A, $B) {
        return $A / $B;
    }

    echo "<br>Bilangan Pertama : $A <br>";
    echo "Bilangan Kedua : $B <br><br>";

    $jumlahbil = jumlah($A, $B);
    printf("Penjumlahan antara %d + %d = %d <br><br>", $A, $B, $jumlahbil);

    $kurangbil = kurang($A, $B);
    printf("Pengurangan antara %d - %d = %d <br><br>", $A, $B, $kurangbil);

    $kalibil = kali($A, $B);
    printf("Perkalian antara %d * %d = %d <br><br>", $A, $B, $kalibil);

    $bagibil = bagi($A, $B);
    printf("Pembagian antara %d / %d = %d <br><br>", $A, $B, $bagibil);
}
?>
</body>
</html>
<!-- Project 8.2 By M IRFAN APRIYANA - 221011450110 -->