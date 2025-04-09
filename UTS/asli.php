<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bookshelf App</title>
    <!-- <style>
        .form {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h2 {
            font-weight: 700;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #FBFBFB;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 20px;
            min-height: 100vh;
        }

        main {
            width: 50%;
            background-color: #FFF4D2;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            max-height: 90vh;
        } -->
    </style>

    <!-- Impor script -->
    <script defer src="script.js"></script>
</head>

<body>
    <header>
        <h1>Buku UTS</h1>
    </header>

    <main>
        <section>
            <h2>Tambah Buku Baru</h2>
            <form id="bookForm" data-testid="bookForm">
                <div>
                    <label for="bookFormTitle">Judul</label>
                    <input id="bookFormTitle" type="text" required data-testid="bookFormTitleInput" />
                </div>
                <div>
                    <label for="bookFormAuthor">Penulis</label>
                    <input id="bookFormAuthor" type="text" required data-testid="bookFormAuthorInput" />
                </div>
                <div>
                    <label for="bookFormYear">Tahun</label>
                    <input id="bookFormYear" type="number" required data-testid="bookFormYearInput" />
                </div>

                <div>
                    <label for="bookFormYear">kategori</label>
                    <input id="bookFormYear" type="number" required data-testid="bookFormYearInput" />
                </div>

                <div>
                    <label for="bookFormIsComplete">Selesai dibaca</label>
                    <input id="bookFormIsComplete" type="checkbox" data-testid="bookFormIsCompleteCheckbox" />
                </div>

                <div class="klik">
                    <input type="submit" value="Masukan ke rak">
                    <a href="nyatat.php"><button type="button">tengok buku</button></a>
                </div>

            </form>
        </section>

        <section>
            <h2>Cari Buku</h2>
            <form id="searchBook" data-testid="searchBookForm">
                <label for="searchBookTitle">Judul</label>
                <input id="searchBookTitle" type="text" data-testid="searchBookFormTitleInput"
                    placeholder="Cari berdasarkan judul, penulis, atau tahun..." />
                <button id="searchSubmit" type="submit" data-testid="searchBookFormSubmitButton" class="klik">
                    Cari
                </button>
            </form>
        </section>
    </main>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("bookForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const id = document.getElementById("id").value.trim();
            const nisn = document.getElementById("judul").value.trim();
            const tabun_terbit = document.getElementById("tahun_terbit").value;
            const alamat = document.getElementById("pengarang").value.trim();
            const nomorTelepon = document.getElementById("nomor-telepon").value.trim();
            const formData = new FormData();
            formData.append("id", id);
            formData.append("judul", judul);
            formData.append("tahun_terbit", tahun_terbit);
            formData.append("pengarang", pengarang);
            formData.append("kategori", kategori);

            if (!judul || !Penulis || !tabun_terbit || !alamat || !nomorTelepon) {
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