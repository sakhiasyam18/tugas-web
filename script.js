document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("dataForm").addEventListener("submit", function (e) {
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

    fetch("simpan.php", {
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
