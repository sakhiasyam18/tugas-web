<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "uts";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses simpan data jika ada POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $kategori = $_POST['kategori'];

    $stmt = $conn->prepare("INSERT INTO uts (id, judul, pengarang, tahun_terbit, kategori, ) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $id, $judul, $pengarang, $tahun_terbit, $kategori);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta Didik</title>
    <style>
        /* body {
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
    } */

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #000000;
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
            background-color: rgb(0, 180, 60);
            color: white;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        .buttons button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
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
        <h1>Daftar BUKU</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>judul</th>
                    <th>pengarang</th>
                    <th>tahun_terbit</th>
                    <th>kategori</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM siswa";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['judul'] . "</td>";
                        echo "<td>" . $row['pengarang'] . "</td>";
                        echo "<td>" . $row['tahun_terbit'] . "</td>";
                        echo "<td>" . $row['kategori'] . "</td>";
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
            <a href="asli.php"><button>Kembali ke home</button></a>
        </div>
    </div>
</body>

</html>