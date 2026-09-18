<?php
require_once "../includes/session.php";
require_once __DIR__ . "/../config/koneksi.php";
if(isset($_POST['simpan'])){
    $nik = trim($_POST['nik']);
    $nama = trim($_POST['nama']);
    $alamat = trim($_POST['alamat']);
    $pendapatan = str_replace(".","",$_POST['pendapatan']);
    $jumlah_tanggungan = $_POST['jumlah_tanggungan'];
    $daya_listrik = $_POST['daya_listrik'];
    $status_rumah = $_POST['status_rumah'];
    $kondisi_rumah = $_POST['kondisi_rumah'];
    // cek NIK
    $cek = mysqli_query($conn,"SELECT nik FROM tbl_calon_penerima WHERE nik='$nik'");
    if(mysqli_num_rows($cek)>0){
        echo "<script>
        alert('NIK sudah digunakan!');
        window.history.back();
        </script>";
        exit;
    }
    $sql = "INSERT INTO tbl_calon_penerima
    (
        nik,
        nama,
        alamat,
        pendapatan,
        jumlah_tanggungan,
        daya_listrik,
        status_rumah,
        kondisi_rumah
    )
    VALUES(
        '$nik',
        '$nama',
        '$alamat',
        '$pendapatan',
        '$jumlah_tanggungan',
        '$daya_listrik',
        '$status_rumah',
        '$kondisi_rumah'
    )";
    if(mysqli_query($conn,$sql)){

        echo "<script>
        alert('Data berhasil ditambahkan');
        window.location='calon_penerima.php';
        </script>";
        exit;
    }else{
        echo "<script>
        alert('".mysqli_error($conn)."');
        </script>";
    }
}
include "../includes/header.php";
include "../includes/sidebar.php";
?>
<div class="content">
<div class="container-fluid">
<div class="card shadow-lg border-0 rounded-4">
<div class="card-header bg-success text-white rounded-top-4">
<h4 class="mb-0">
<i class="fa-solid fa-user-plus"></i>Tambah Data Calon Penerima</h4>
</div>
<div class="card-body p-4">
<form method="POST">
<div class="row">
<div class="col-md-6 mb-3">
<label>NIK</label>
<input
type="text"
name="nik"
maxlength="16"
class="form-control"
required>
</div>
<div class="col-md-6 mb-3">
<label>Nama Lengkap</label>
<input
type="text"
name="nama"
class="form-control"
required>

</div>

<div class="col-12 mb-3">

<label>Alamat</label>

<textarea
name="alamat"
rows="3"
class="form-control"
required></textarea>

</div>

<div class="col-md-6 mb-3">

<label>Pendapatan</label>

<input
type="number"
name="pendapatan"
class="form-control"
placeholder="Contoh : 1500000"
required>

</div>

<div class="col-md-6 mb-3">

<label>Jumlah Tanggungan</label>

<input
type="number"
name="jumlah_tanggungan"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Daya Listrik</label>

<select
name="daya_listrik"
class="form-select"
required>

<option value="">-- Pilih --</option>

<option value="450 VA">450 VA</option>

<option value="900 VA">900 VA</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Status Rumah</label>

<select
name="status_rumah"
class="form-select"
required>

<option value="">-- Pilih --</option>

<option value="Milik Sendiri">Milik Sendiri</option>

<option value="Kontrak">Kontrak</option>

<option value="Bebas Sewa">Bebas Sewa</option>

</select>

</div>

<div class="col-md-12 mb-4">

<label>Kondisi Rumah</label>

<select
name="kondisi_rumah"
class="form-select"
required>

<option value="">-- Pilih --</option>

<option value="Permanen">Permanen</option>

<option value="Semi Permanen">Semi Permanen</option>

<option value="Tidak Permanen">Tidak Permanen</option>

</select>

</div>

<div class="d-flex justify-content-end gap-2">

<a href="calon_penerima.php"
class="btn btn-secondary">

<i class="fa fa-arrow-left"></i>

Kembali

</a>

<button
type="submit"
name="simpan"
class="btn btn-success">

<i class="fa fa-save"></i>

Simpan Data

</button>

</div>

</form>

</div>

</div>

</div>

</div>

<style>

.card{

border-radius:20px;

}

.card-header{

background:#0F766E!important;

}

label{

font-weight:600;

margin-bottom:6px;

}

.form-control,
.form-select{

border-radius:12px;
padding:10px;

}

.form-control:focus,
.form-select:focus{

border-color:#0F766E;
box-shadow:0 0 0 .2rem rgba(15,118,110,.25);

}

.btn{

border-radius:12px;

padding:10px 20px;

}

</style>

<?php include "../includes/footer.php"; ?>