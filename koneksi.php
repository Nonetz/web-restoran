<?php
// Lakukan koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "uas_dpw");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}