<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("localhost", "root", "", "final");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta Didik</title>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: rgb(0, 180, 60);
        color: white;
        padding: 8px;
        font-weight: bold;
        font-size: large;
    }

    .buttons {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 20px;
    }

    button {
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        background-color: #6c757d;
        color: white;
    }

    button:hover {
        background-color: #ccc;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Data Peserta Didik</h1>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>NISN</th>
                    <th>Kelas</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Nomor Telepon</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // kalau dipisah itu kan ada koneksi ke database dulu, namun kalau punyaku ini aku gabungin jadi satu file sehingga langsung aja ke ambil data dari table database siswa
                //ini bagian ambil data dari table siswa yang sudah di buat di databasenya
                $sql = "SELECT * FROM siswa";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['nisn'] . "</td>";
                        echo "<td>" . $row['kelas'] . "</td>";
                        echo "<td>" . $row['tanggal_lahir'] . "</td>";
                        echo "<td>" . $row['alamat'] . "</td>";
                        echo "<td>" . $row['nomor_telepon'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Tidak ada data.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
        <div class="buttons">
            <a href="fix.php"><button>Kembali ke Form</button></a>
        </div>
    </div>
</body>

</html>