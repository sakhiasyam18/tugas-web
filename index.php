<!-- index.php -->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengumpulan Data Diri</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Form Pengumpulan Data Diri</h2>
        <form id="dataForm">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" required>

            <label for="nisn">NISN</label>
            <input type="text" id="nisn" name="nisn" required>

            <label for="kelas">Kelas</label>
            <input type="text" id="kelas" name="kelas" required>

            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>

            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat" required>

            <label for="nomor_telepon">Nomor Telepon/HP</label>
            <input type="text" id="nomor_telepon" name="nomor_telepon" required>

            <div class="buttons">
                <button type="submit" id="kirimBtn">Kirim Data</button>
                <a href="data.php"><button type="button" id="lihatBtn">Lihat Data</button></a>
            </div>
        </form>
    </div>

    <script src="script.js"></script>
</body>

</html>