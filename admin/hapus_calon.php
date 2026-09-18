<?php
require_once "../includes/session.php";
require_once __DIR__ . "/../config/koneksi.php";
// Hanya superadmin yang boleh menghapus
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'superadmin') {
    echo "<script>
            alert('Anda tidak memiliki hak akses!');
            window.location='calon_penerima.php';
          </script>";
    exit;
}
// Cek ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location='calon_penerima.php';
          </script>";
    exit;
}
$id = (int)$_GET['id'];
// Cek apakah data ada
$cek = mysqli_query($conn, "SELECT * FROM tbl_calon_penerima WHERE id_calon='$id'");
if (mysqli_num_rows($cek) == 0) {
    echo "<script>
            alert('Data tidak ditemukan!');
            window.location='calon_penerima.php';
          </script>";
    exit;
}
// Hapus data
$hapus = mysqli_query($conn, "DELETE FROM tbl_calon_penerima WHERE id_calon='$id'");
if ($hapus) {
    echo "<script>
            alert('Data berhasil dihapus.');
            window.location='calon_penerima.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus data!');
            window.location='calon_penerima.php';
          </script>";
}