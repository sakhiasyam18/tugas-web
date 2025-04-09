<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

// Gunakan prepared statement untuk keamanan
$stmt = $conn->prepare("INSERT INTO siswa (nama, nisn, kelas, tanggal_lahir, alamat, nomor_telepon) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nama, $nisn, $kelas, $tanggal_lahir, $alamat, $nomor_telepon);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
}

$stmt->close();
$conn->close();