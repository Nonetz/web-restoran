<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "uas_dpw");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Ambil id makanan dari parameter GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_minuman = $_GET['id'];

    // Query untuk mendapatkan informasi makanan
    $query = "SELECT * FROM minuman WHERE id = $id_minuman";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $minuman = mysqli_fetch_assoc($result);
    } else {
        echo "Makanan tidak ditemukan.";
        exit();
    }
} else {
    echo "ID makanan tidak valid.";
    exit();
}

mysqli_close($koneksi);

// Variabel untuk menyimpan data form
$nama = $telepon = $alamat = $jumlah_pesanan = $metode_pembayaran = "";
$total_bayar = 0;

// Proses jika form pesanan dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $jumlah_pesanan = $_POST['jumlah'];
    $metode_pembayaran = $_POST['metode'];
    $total_bayar = $minuman['harga'] * $jumlah_pesanan;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <style>
        /* CSS untuk tampilan detail pesanan */
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
        p {
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
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group p {
            margin: 5px 0;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #ccc;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-btn:hover {
            background-color: #bbb;
        }
        .thank-you-message {
            margin-top: 80px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Detail Pesanan</h2>
        <div class="food-info">
            <h3><?php echo htmlspecialchars($minuman['nama_minuman']); ?></h3>
            <p>Harga: Rp <?php echo number_format($minuman['harga'], 0, ',', '.'); ?></p>
            <!-- Pastikan path_to_images disesuaikan dengan struktur direktori Anda -->
            <img src="foto minuman/<?php echo htmlspecialchars($minuman['foto']); ?>" alt="Foto <?php echo htmlspecialchars($makanan['nama_minuman']); ?>">
        </div>

        <div>
            <p>Nama: <?php echo htmlspecialchars($nama); ?></p>
            <p>Telepon: <?php echo htmlspecialchars($telepon); ?></p>
            <p>Alamat: <?php echo htmlspecialchars($alamat); ?></p>
            <p>Jumlah Pesanan: <?php echo htmlspecialchars($jumlah_pesanan); ?></p>
            <p>Total Bayar: Rp <?php echo number_format($total_bayar, 0, ',', '.'); ?></p>
            <p>Metode Pembayaran: <?php echo htmlspecialchars($metode_pembayaran); ?></p>
        <div class="thank-you-message">
        <p><strong>Pesanan Anda Sedang Diproses Setelah Pesanan Siap Kami Akan Menghubungi Anda Lewat Nomor Yang Anda Berikan</strong></p>
            <p><strong>Terima Kasih Telah Mengunjungi Kami.</strong></p>
            </div>
        <div class="form-group">
            <a href="minuman.php?id=<?php echo $id_minuman; ?>" class="back-btn">Kembali</a>
            </div>
        </div>
    </div>
</body>
</inuman