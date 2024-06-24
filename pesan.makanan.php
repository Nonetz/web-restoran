<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "uas_dpw");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Variabel untuk menyimpan data form
$nama = $telepon = $alamat = $jumlah_pesanan = "";
$total_bayar = 0;

// Ambil id makanan dari parameter GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_makanan = $_GET['id'];

    // Query untuk mendapatkan informasi makanan
    $query = "SELECT * FROM makanan WHERE id = $id_makanan";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $makanan = mysqli_fetch_assoc($result);
    } else {
        echo "Makanan tidak ditemukan.";
        exit();
    }
} else {
    echo "ID makanan tidak valid.";
    exit();
}

mysqli_close($koneksi);

// Proses jika form pesanan dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $catatan = $_POST['catatan'];
    $jumlah_pesanan = $_POST['jumlah'];
    $total_bayar = $makanan['harga'] * $jumlah_pesanan;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Makanan</title>
    <style>
        /* CSS untuk tampilan form pesan makanan */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('background restoran.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .container {
            max-width: 500px;
            margin: 100px auto 50px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        .food-info {
            text-align: center;
            margin-bottom: 20px;
        }
        .food-info img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }
        .form-group {
            margin-bottom: 15px;
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            width: 100%;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-group button, .form-group a {
            padding: 10px 3px;
            font-size: 14px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            margin: 5px;
            display: inline-block;
            width: calc(40% - 30px);
            text-align: center;
        }
        .form-group a {
            background-color: #ccc;
            color: #333;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
        .form-group a:hover {
            background-color: #bbb;
        }
        .form-group-buttons {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pesan Makanan</h2>
        <div class="food-info">
            <h3><?php echo htmlspecialchars($makanan['nama_makanan']); ?></h3>
            <p>Harga: Rp <?php echo number_format($makanan['harga'], 0, ',', '.'); ?></p>
            <!-- Pastikan path_to_images disesuaikan dengan struktur direktori Anda -->
            <img src="foto makanan/<?php echo htmlspecialchars($makanan['foto']); ?>" alt="Foto <?php echo htmlspecialchars($makanan['nama_makanan']); ?>">
        </div>

        <form action="detail.makanan.php?id=<?php echo $id_makanan; ?>" method="post">
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" required>
            </div>
            <div class="form-group">
                <label for="telepon">Nomor Telepon:</label>
                <input type="text" id="telepon" name="telepon" value="<?php echo htmlspecialchars($telepon); ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat Pengiriman:</label>
                <textarea id="alamat" name="alamat" rows="4" required><?php echo htmlspecialchars($alamat); ?></textarea>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah Pesanan:</label>
                <input type="number" id="jumlah" name="jumlah" min="1" value="<?php echo htmlspecialchars($jumlah_pesanan); ?>" required>
            </div>
            <div class="form-group">
                <label for="metode">Metode Pembayaran:</label>
                <select id="metode" name="metode" required>
                    <option value="">Silahkan Pilih</option>
                    <option value="COD">Cash On Delivery (COD)</option>
                    <option value="Transfer">Transfer Bank</option>
                </select>
            </div>
            <div class="form-group form-group-buttons">
                <button type="submit">Pesan Sekarang</button>
                <a href="makanan.php" class="back-btn">Kembali</a>
            </div>
        </form>
    </div>
</body>
</akanan