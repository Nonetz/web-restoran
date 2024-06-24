<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berikan Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('feedback.jpeg');
            background-size: cover;
            background-position: top center;
            background-repeat: no-repeat;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px; /* Ubah margin-bottom dari 5px menjadi 10px untuk memberikan jarak lebih besar */
        }
        input[type="text"],
        textarea {
            width: calc(100% - 22px); /* Lebar textarea dihitung berdasarkan width - 22px untuk menghindari horizontal scroll */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            resize: vertical;
        }
        button {
            padding: 10px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        a {
            display: inline-block;
            padding: 10px 25px;
            background-color: #ccc;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #bbb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Berikan Feedback</h2>
        
        <!-- Form untuk memberikan feedback -->
        <form action="feedback.diterima.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" style="width: 200px;" required><br> <!-- Menggunakan input type="text" untuk username -->
            <label for="feedback">Feedback:</label>
            <textarea id="feedback" name="feedback" rows="4" required></textarea><br>
            <button type="submit">Kirim Feedback</button>
        </form>
        
        <!-- Tombol kembali -->
        <a href="makanan.php">Kembali</a>
    </div>
</body>
</html>
