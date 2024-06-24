<?php
session_start();

// Inisialisasi variabel error
$username_error = $password_error = "";
$username = $password = "";

// Cek apakah form telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Proses form registrasi
    // Ambil data dari form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validasi input
    if (empty($username)) {
        $username_error = "Username harus diisi";
    }

    if (empty($password)) {
        $password_error = "Password harus diisi";
    }

    // Jika tidak ada error, proses registrasi
    if (empty($username_error) && empty($password_error)) {
        // Simpan data ke database (contoh sederhana, gunakan metode hashing untuk password yang lebih aman)
        // Silakan sesuaikan dengan cara penyimpanan yang lebih aman di lingkungan produksi
        $koneksi = mysqli_connect("localhost", "root", "", "uas_dpw");

        // Periksa koneksi
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal: " . mysqli_connect_error();
            exit();
        }

        // Escape input untuk mencegah SQL Injection
        $username = mysqli_real_escape_string($koneksi, $username);
        $password = mysqli_real_escape_string($koneksi, $password);

        // Hash password (gunakan metode hash yang lebih aman di lingkungan produksi)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Query SQL untuk menyimpan data ke database
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
        if (mysqli_query($koneksi, $query)) {
            // Registrasi berhasil
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            header("Location: dashboard.php"); // Redirect ke halaman dashboard setelah registrasi berhasil
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }

        // Tutup koneksi
        mysqli_close($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('background depan.jpg'); /* Ganti 'background-image.jpg' dengan URL gambar latar belakang Anda */
            background-size: cover; /* Menyesuaikan gambar background agar memenuhi seluruh halaman */
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; /* Menetapkan tinggi body agar sesuai dengan tinggi viewport */
            margin: 0; /* Menghilangkan margin default */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 500px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        button {
            width: 30%;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .login-link {
            text-align: auto;
            margin-top: 10px;
        }

        .login-link a {
            color: blue;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registrasi</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                <span class="error"><?php echo $username_error; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>" required>
                <span class="error"><?php echo $password_error; ?></span>
            </div>
            <button type="submit">Daftar</button>
        </form>
        <div class="login-link">
            <p>Sudah punya akun? <a href="login.php">Login disini</a></p>
        </div>
    </div>
</body>
</html>
