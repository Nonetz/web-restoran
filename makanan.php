<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Menu Makanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('background makanan.jpg');
            background-size: auto;
            background-position: top center;
            background-repeat: no-repeat;
        }

        .container {
            max-width: 800px;
            margin: 100px auto 50px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            overflow: hidden;
            border-radius: 0;
            display: flex;
            justify-content: center;
            height: 50px;
            z-index: 1000;
        }

        .navbar a {
            color: #fff;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
            margin: 0 10px;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: #333;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .food-image {
            max-width: 100px;
            height: auto;
        }

        .options-btn {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 5px;
        }

        .options-btn:hover {
            background-color: #45a049;
        }

        .back-btn {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
            margin-top: 20px;
        }

        .back-btn:hover {
            background-color: #555;
        }
        .logout-link {
            background-color: #f44336;
            border: none;
            color: white;
            padding: 12px 16px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-left: auto; /* Menggeser tombol logout ke pojok kanan */
        }

        .logout-link:hover {
            background-color: #cc0000;
        }

    </style>
</head>
<body>
<div class="navbar">
    <a href="dashboard.html"><i class="fas fa-home"></i> Home</a>
    <a href="makanan.php"><i class="fas fa-utensils"></i> Makanan</a>
    <a href="minuman.php"><i class="fas fa-cocktail"></i> Minuman</a>
    <a href="about.html"><i class="fas fa-info-circle"></i> About</a>
    <a href="kontak.html"><i class="fas fa-envelope"></i> Contact</a>
    <a href="logout.php" class="logout-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>
    <div class="container">
        <h2>Menu Makanan</h2>
        <table>
            <tr>
                <th>Nomor</th>
                <th>Foto</th>
                <th>Nama Makanan</th>
                <th>Harga</th>
                <th>Opsi</th>
            </tr>
            <?php
            // Sambungkan ke database
            $koneksi = mysqli_connect("localhost", "root", "", "uas_dpw");

            // Periksa koneksi
            if (mysqli_connect_errno()) {
                echo "Koneksi database gagal: " . mysqli_connect_error();
                exit();
            }

            // Lakukan kueri SQL untuk mengambil data makanan
            $query = "SELECT * FROM makanan";
            $result = mysqli_query($koneksi, $query);

            // Periksa apakah ada data yang diambil
            if (mysqli_num_rows($result) > 0) {
                // Tampilkan data makanan dalam tabel HTML
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td><img src="foto makanan/' . $row['foto'] . '" alt="' . $row['nama_makanan'] . '" class="food-image"></td>';
                    echo '<td>' . $row['nama_makanan'] . '</td>';
                    echo '<td>Rp ' . number_format($row['harga'], 0, ',', '.') . '</td>';
                    echo '<td>
                            <a href="feedback.php?id=' . $row['id'] . '"><button class="options-btn">Berikan Feedback</button></a>
                            <a href="pesan.makanan.php?id=' . $row['id'] . '"><button class="options-btn">Pesan</button></a>
                          </td>';
                    echo '</tr>';
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada data makanan.</td></tr>";
            }

            // Tutup koneksi ke database
            mysqli_close($koneksi);
            ?>
        </table>
    </div>
</body>
</html>
