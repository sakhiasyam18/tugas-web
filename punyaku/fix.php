<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("localhost", "root", "", "final");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// //ini bagian file simpan.php (tidak ada) jadi aku milih jadikan satu dengan disini
// // Koneksi ke database
// $host = "localhost";
// $user = "root";
// $password = "";
// $database = "final";


// Proses simpan data jika ada POST request
// atau istilah nya ambil data dari from 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $nama = $_POST['nama'];
    $nisn = $_POST['nisn'];
    $kelas = $_POST['kelas'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $nomor_telepon = $_POST['nomor_telepon'];

    //ini buat keamanan aja sih alias buat hindari dari sql injection aja 
    // $stmt = $conn->prepare("INSERT INTO siswa (nama, nisn, kelas, tanggal_lahir, alamat, nomor_telepon) VALUES (?, ?, ?, ?, ?, ?)");
    // $stmt->bind_param("ssssss", $nama, $nisn, $kelas, $tanggal_lahir, $alamat, $nomor_telepon);

    //itu ilmu baru aja sih, jadi kalau nggak pakai ya default nya kek gini 
    $sql = "INSERT INTO siswa (nama, nisn, kelas, tanggal_lahir, alamat, nomor_telepon) 
        VALUES ('$nama', '$nisn', '$kelas', '$tanggal_lahir', '$alamat', '$nomor_telepon')";

    if ($conn->query($sql)) {
        echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
    }
    //ini lanjutan nya kalau makai yang tadi

    $conn->close();
    exit();
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengumpulan Data Diri</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(to right, #a1c4fd, #c2e9fb);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 400px;
    }

    h2 {
        text-align: center;
    }

    label {
        display: block;
        margin: 10px 0 5px;
    }

    select,
    input,
    textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 14px;
    }

    textarea {
        min-height: 80px;
        resize: vertical;
    }

    .buttons {
        display: flex;
        justify-content: space-between;
    }

    button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #kirimBtn {
        background-color: #28a745;
        color: white;
    }

    #kirimBtn:hover {
        background-color: #218838;
    }

    #lihatBtn {
        background-color: #6c757d;
        color: white;
    }

    #lihatBtn:hover {
        background-color: #5a6268;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
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
            <select id="kelas" name="kelas" required>
                <option value="" disabled selected>Pilih Kelas</option>
                <option value="10">Kelas 10</option>
                <option value="11">Kelas 11</option>
                <option value="12">Kelas 12</option>
            </select>

            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>

            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" required> </textarea>

            <label for="nomor_telepon">Nomor Telepon/HP</label>
            <input type="text" id="nomor_telepon" name="nomor_telepon" required>

            <div class="buttons">
                <button type="submit" id="kirimBtn">Kirim Data</button>
                <a href="2data.php"><button type="button" id="lihatBtn">Lihat Data</button></a>
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
            const tanggalLahir = document.getElementById("tanggal_lahir").value;
            const alamat = document.getElementById("alamat").value.trim();
            const nomorTelepon = document.getElementById("nomor_telepon").value.trim();

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

            const formData = new FormData();
            formData.append("nama", nama);
            formData.append("nisn", nisn);
            formData.append("kelas", kelas);
            formData.append("tanggal_lahir", tanggalLahir);
            formData.append("alamat", alamat);
            formData.append("nomor_telepon", nomorTelepon);

            fetch("", {
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