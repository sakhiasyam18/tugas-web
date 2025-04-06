// script.js
document.getElementById("dataForm").addEventListener("submit", function (e) {
  e.preventDefault();

  // Ambil nilai dari form
  const nama = document.getElementById("nama").value;
  const nisn = document.getElementById("nisn").value;
  const kelas = document.getElementById("kelas").value;
  const tanggalLahir = document.getElementById("tanggal_lahir").value;
  const alamat = document.getElementById("alamat").value;
  const nomorTelepon = document.getElementById("nomor_telepon").value;

  // Validasi sederhana
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

  // Buat objek FormData untuk dikirim via AJAX
  const formData = new FormData();
  formData.append("nama", nama);
  formData.append("nisn", nisn);
  formData.append("kelas", kelas);
  formData.append("tanggal_lahir", tanggalLahir);
  formData.append("alamat", alamat);
  formData.append("nomor_telepon", nomorTelepon);

  // Kirim data menggunakan AJAX
  fetch("simpan.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Data berhasil disimpan!");
        document.getElementById("dataForm").reset(); // Kosongkan form
      } else {
        alert("Gagal menyimpan data: " + data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("Terjadi kesalahan saat mengirim data.");
    });
});
