<?php
session_start();

// Inisialisasi variabel
$username = "";
$error_message = "";

// Cek apakah pengguna sudah login, redirect ke dashboard jika sudah
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("Location: dashboard.php");
    exit();
}

// Cek apakah form login telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Koneksi ke database (sesuaikan dengan informasi database Anda)
    $koneksi = mysqli_connect("localhost", "root", "", "uas_dpw");

    // Check koneksi
    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal: " . mysqli_connect_error();
        exit();
    }

    // Escape input untuk mencegah SQL Injection
    $username = mysqli_real_escape_string($koneksi, $username);
    $password = mysqli_real_escape_string($koneksi, $password);

    // Query SQL untuk mencari pengguna berdasarkan username
    $query = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    // Periksa apakah pengguna ditemukan
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        // Verifikasi password
        if (password_verify($password, $hashed_password)) {
            // Password benar, set session
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            // Redirect ke halaman dashboard jika login berhasil
            header("Location: dashboard.php");
            exit();
        } else {
            // Password salah, tampilkan pesan error
            $error_message = "Username atau password salah. Silakan coba lagi.";
        }
    } else {
        // Pengguna tidak ditemukan, tampilkan pesan error
        $error_message = "Username atau password salah. Silakan coba lagi.";
    }

    // Tutup koneksi database
    mysqli_close($koneksi);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('background depan.jpg'); /* Ganti 'background-login.jpg' dengan URL gambar latar belakang Anda */
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

        .welcome-message {
            color: #000; /* Mengubah warna teks menjadi hitam */
            font-size: 30px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5); /* Menambahkan efek bayangan teks */
            margin-bottom: 20px; /* Menambahkan jarak bawah */
        }

        .register-link {
            text-align: auto;
            margin-top: 10px;
        }

        .register-link a {
            color: blue;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome-message">
            <p>Selamat Datang Di DPW Resto</p>
        </div>
        <div class="login-container">
            <h2>Login</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
                <div class="error"><?php echo $error_message; ?></div>
            </form>
            <div class="register-link">
                <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>
            </div>
        </div>
    </div>
</body>
</html>
