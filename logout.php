<?php
session_start();

// Unset semua variabel sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect kembali ke halaman login
header("Location: login.php");
exit();
?>
