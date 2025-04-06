// script.js
document.getElementById('dataForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Ambil nilai dari form
    const nama = document.getElementById('nama').value;
    const nisn = document.getElementById('nisn').value;
    const kelas = document.getElementById('kelas').value;
    const tanggalLahir = document.getElementById('tanggal_lahir').value;
    const alamat = document.getElementById('alamat').value;
    const nomorTelepon = document.getElementById('nomor_telepon').value;

    // Validasi sederhana
    if (!nama || !nisn || !kelas || !tanggalLahir || !alamat || !nomorTelepon) {
        alert('Semua field harus diisi!');
        return;
    }

    if (!/^\d+$/.test(nisn)) {
        alert('NISN harus berupa angka!');
        return;
    }

    if (!/^\d+$/.test(nomorTelepon)) {
        alert('Nomor Telepon harus berupa angka!');
        return;
    }

    // Buat objek FormData untuk dikirim via AJAX
    const formData = new FormData();
    formData.append('nama', nama);
    formData.append('nisn', nisn);
    formData.append('kelas', kelas);
    formData.append('tanggal_lahir', tanggalLahir);
    formData.append('alamat', alamat);
    formData.append('nomor_telepon', nomorTelepon);

    // Kirim data menggunakan AJAX
    fetch('simpan.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Data berhasil disimpan!');
            document.getElementModul 3 - Javascript dan Database - X - index.php
File D:/xampp/htdocs/tugas-web/index.php

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
</html> id="dataForm").reset(); // Kosongkan form
        } else {
            alert('Gagal menyimpan data: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengirim data.');
    });
});