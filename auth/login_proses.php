<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once __DIR__ . "/../config/koneksi.php";
// cek method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}
// ambil input
$username = trim($_POST['username']);
$password = trim($_POST['password']);
// validasi kosong
if(empty($username) || empty($password)){
    echo "
    <script>
        alert('Username dan Password tidak boleh kosong!');
        window.location='login.php';
    </script>
    ";
    exit;
}
// cari username
$query = "SELECT * FROM tbl_admin WHERE username = ?";
$stmt = mysqli_prepare($conn,$query);
if(!$stmt){
    die("Query error : ".mysqli_error($conn));
}
mysqli_stmt_bind_param(
    $stmt,
    "s",
    $username
);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if(mysqli_num_rows($result) == 1){
    $data = mysqli_fetch_assoc($result);
    // CEK PASSWORD HASH
    if(password_verify($password, $data['password'])){
        // buat session
        $_SESSION['login'] = true;
        $_SESSION['id_admin'] = $data['id_admin'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];
        // redirect berdasarkan role
        if($data['role'] == "superadmin"){
            header("Location: ../admin/dashboard.php");
        }elseif($data['role'] == "stakeholder"){
            header("Location: ../stakeholder/dashboard.php");
        }else{
            echo "
            <script>
            alert('Role tidak dikenali!');
            window.location='login.php';
            </script>
            ";
        }
        exit;}else{echo "
        <script>
            alert('Password salah!');
            window.location='login.php';
        </script>
        ";
        exit;}}else{echo "
    <script>
        alert('Username tidak ditemukan!');
        window.location='login.php';
    </script>
    ";
    exit;}?>
    