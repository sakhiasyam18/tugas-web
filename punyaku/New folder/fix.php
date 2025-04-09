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
    <style>
    body {
        background: linear-gradient(to bottom right, #a1c4fd, #c2e9fb);
        font-family: Arial, Helvetica, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: white;
        padding: 20px;
        border-radius: 18px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        max-width: 500px;
        width: 100%;
    }

    h1 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
        color: #000000;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
        margin-bottom: 15px;
    }

    .form-group label {
        font-size: 16px;
        color: #333;
    }

    .form-group input[type="text"],
    .form-group input[type="tel"],
    .form-group input[type="date"],
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 8px;
        font-size: 14px;
        box-sizing: border-box;
    }

    .form-group textarea {
        height: 80px;
        resize: vertical;
    }

    .buttons {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 20px;
    }

    .buttons input[type="submit"],
    .buttons button {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .buttons input[type="submit"] {
        background-color: #28a745;
        color: white;
    }

    .buttons input[type="submit"]:hover {
        background-color: #218838;
    }

    .buttons button {
        background-color: #6c757d;
        color: white;
    }

    .buttons button:hover {
        background-color: #5a6268;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Form Pengumpulan Data Diri</h1>
        <form id="dataForm">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required>
            </div>

            <div class="form-group">
                <label for="nisn">NISN</label>
                <input type="text" id="nisn" name="nisn" required>
            </div>

            <div class="form-group">
                <label for="kelas">Kelas</label>
                <select id="kelas" name="kelas" required>
                    <option value="" disabled selected>Pilih Kelas</option>
                    <option value="10">Kelas 10</option>
                    <option value="11">Kelas 11</option>
                    <option value="12">Kelas 12</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal-lahir">Tanggal Lahir</label>
                <input type="date" id="tanggal-lahir" name="tanggal_lahir" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" required></textarea>
            </div>

            <div class="form-group">
                <label for="nomor-telepon">Nomor Telepon/HP</label>
                <input type="tel" id="nomor-telepon" name="nomor_telepon" required>
            </div>

            <div class="buttons">
                <input type="submit" value="Kirim Data">
                <a href="2data.php"><button type="button">Lihat Data</button></a>
            </div>
        </form>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("dataForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const nama = document.getElementById("nama").value.trim();
            const nisn = document.getElementById("nisn").value.trim();
            const kelas = document.getElementById("kelas").value.trim();
            const tanggalLahir = document.getElementById("tanggal-lahir").value;
            const alamat = document.getElementById("alamat").value.trim();
            const nomorTelepon = document.getElementById("nomor-telepon").value.trim();
            const formData = new FormData();
            formData.append("nama", nama);
            formData.append("nisn", nisn);
            formData.append("kelas", kelas);
            formData.append("tanggal_lahir", tanggalLahir);
            formData.append("alamat", alamat);
            formData.append("nomor_telepon", nomorTelepon);

            if (!nama || !nisn || !kelas || !tanggalLahir || !alamat || !nomorTelepon) {
                alert("Semua field harus diisi!");
                return;
            }
            if (!/^\d+$/.test(nisn)) {
                alert("NISN harus berupa angka!");
                return;
            }
            if (!/^\d+$/.test(nomorTelepon)) {
                alert("Nomor Telepon harus berupa angka!");
                return;
            }

            fetch("2data.php", {
                    method: "POST",
                    body: formData,
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert("Data berhasil disimpan!");
                        document.getElementById("dataForm").reset();
                    } else {
                        alert("Gagal menyimpan data: " + data.message);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("Terjadi kesalahan saat mengirim data.");
                });
        });
    });
    </script>
</body>

</html>