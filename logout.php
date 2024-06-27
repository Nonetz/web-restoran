<?php
session_start();

// Cek apakah pengguna telah mengkonfirmasi logout
if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
    // Unset semua variabel sesi
    session_unset();

    // Hancurkan sesi
    session_destroy();

    // Redirect kembali ke halaman login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-confirm {
            background-color: #4CAF50;
            color: white;
        }
        .btn-cancel {
            background-color: #f44336;
            color: white;
        }
    </style>
    <script>
        function confirmLogout() {
            var userConfirmed = confirm("Apakah Anda yakin ingin keluar?");
            if (userConfirmed) {
                window.location.href = "logout.php?confirm=yes";
            } else {
                window.location.href = "dashboard.html"; // Ganti dengan halaman tujuan jika pengguna membatalkan
            }
        }

        window.onload = confirmLogout;
    </script>
</head>
<body>
    <div class="container">
        <noscript>
            Anda harus mengaktifkan JavaScript untuk mengkonfirmasi logout.
            <br>
            <a href="logout.php?confirm=yes" class="btn btn-confirm">Klik di sini untuk logout</a> jika JavaScript dinonaktifkan.
        </noscript>
    </div>
</body>
</html>
