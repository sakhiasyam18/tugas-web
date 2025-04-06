<!-- simpan.php -->
<?php
header('Content-Type: application/json');

// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "peserta_didik";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Koneksi gagal: ' . $conn->connect_error]);
    exit();
}

// Ambil data dari form
$nama = $_POST['nama'];
$nisn = $_POST['nisn'];
$kelas = $_POST['kelas'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$alamat = $_POST['alamat'];
$nomor_telepon = $_POST['nomor_telepon'];

// Sanitasi input (untuk keamanan)
$nama = $conn->real_escape_string($nama);
$nisn = $conn->real_escape_string($nisn);
$kelas = $conn->real_escape_string($kelas);
$tanggal_lahir = $conn->real_escape_string($tanggal_lahir);
$alamat = $conn->real_escape_string($alamat);
$nomor_telepon = $conn->real_escape_string($nomor_telepon);

// Query untuk menyimpan data
$sql = "INSERT INTO siswa (nama, nisn, kelas, tanggal_lahir, alamat, nomor_telepon) 
        VALUES ('$nama', '$nisn', '$kelas', '$tanggal_lahir', '$alamat', '$nomor_telepon')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
}

$conn->close();
?>