<?php
// Periksa apakah ada data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari input username
    $username = htmlspecialchars($_POST['username']);
} else {
    // Jika tidak ada data POST (biasanya pada pengaksesan langsung halaman ini tanpa pengiriman form)
    $username = "Tamu"; // Atur default jika tidak ada username
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Diterima</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('feedback.jpeg');
            background-size: cover;
            background-position: top center;
            background-repeat: no-repeat;
        }
        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 600px;
            width: 80%;
        }
        h2 {
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Feedback Dari <?php echo $username; ?> Sudah Diterima!</h2>
    <p>Terima kasih telah memberikan feedback!</p>
    <p>Saran, kritik, dan masukan dari Anda sangat bermanfaat bagi kami.</p>
    <p>Kami akan terus mengevaluasi diri untuk menjadi lebih baik ke depannya.</p>
    <!-- Tombol kembali -->
    <a href="makanan.php">Kembali</a>
</div>
    </div>
</body>
</html>
