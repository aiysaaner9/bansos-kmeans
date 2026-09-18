<?php
require_once "../includes/session.php";
require_once __DIR__ . "/../config/koneksi.php";
// =======================
// CEK ID
// =======================
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location='calon_penerima.php';
          </script>";
    exit;
}
$id = (int) $_GET['id'];
// =======================
// AMBIL DATA
// =======================
$query = mysqli_query($conn, "SELECT * FROM tbl_calon_penerima WHERE id_calon='$id'");

if (mysqli_num_rows($query) == 0) {
    echo "<script>
            alert('Data tidak ditemukan!');
            window.location='calon_penerima.php';
          </script>";
    exit;
}
$data = mysqli_fetch_assoc($query);
// =======================
// UPDATE DATA
// =======================
if (isset($_POST['update'])) {
    $nik                 = trim($_POST['nik']);
    $nama                = trim($_POST['nama']);
    $alamat              = trim($_POST['alamat']);
    $pendapatan          = trim($_POST['pendapatan']);
    $jumlah_tanggungan   = trim($_POST['jumlah_tanggungan']);
    $daya_listrik        = trim($_POST['daya_listrik']);
    $status_rumah        = trim($_POST['status_rumah']);
    $kondisi_rumah       = trim($_POST['kondisi_rumah']);
    // cek nik selain data sendiri
    $cek = mysqli_query($conn,
        "SELECT * FROM tbl_calon_penerima
        WHERE nik='$nik'
        AND id_calon != '$id'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
        alert('NIK sudah digunakan!');
        </script>";
    } else {
        $update = mysqli_query($conn, "
        UPDATE tbl_calon_penerima SET
        nik='$nik',
        nama='$nama',
        alamat='$alamat',
        pendapatan='$pendapatan',
        jumlah_tanggungan='$jumlah_tanggungan',
        daya_listrik='$daya_listrik',
        status_rumah='$status_rumah',
        kondisi_rumah='$kondisi_rumah'
        WHERE id_calon='$id'
        ");
        if ($update) {
            echo "<script>
            alert('Data berhasil diperbarui');
            window.location='calon_penerima.php';
            </script>";
            exit;
        } else {
            echo "<script>
            alert('".mysqli_error($conn)."');
            </script>";
        }
    }
}
include "../includes/header.php";
include "../includes/sidebar.php";
?>
<div class="content">

<div class="container-fluid">

<div class="card shadow border-0 rounded-4">

<div class="card-header text-white" style="background:#0F766E">

<h4 class="mb-0">

<i class="fa-solid fa-user-pen"></i>

Edit Data Calon Penerima

</h4>

</div>

<div class="card-body p-4">

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label class="fw-semibold">NIK</label>

<input
type="text"
name="nik"
class="form-control"
maxlength="16"
required
value="<?= htmlspecialchars($data['nik']) ?>">

</div>

<div class="col-md-6 mb-3">

<label class="fw-semibold">Nama</label>

<input
type="text"
name="nama"
class="form-control"
required
value="<?= htmlspecialchars($data['nama']) ?>">

</div>

<div class="col-12 mb-3">

<label class="fw-semibold">Alamat</label>

<textarea
name="alamat"
rows="3"
class="form-control"
required><?= htmlspecialchars($data['alamat']) ?></textarea>

</div>

<div class="col-md-6 mb-3">

<label class="fw-semibold">Pendapatan</label>

<input
type="number"
name="pendapatan"
class="form-control"
required
value="<?= $data['pendapatan'] ?>">

</div>

<div class="col-md-6 mb-3">

<label class="fw-semibold">Jumlah Tanggungan</label>

<input
type="number"
name="jumlah_tanggungan"
class="form-control"
required
value="<?= $data['jumlah_tanggungan'] ?>">

</div>

<div class="col-md-6 mb-3">

<label class="fw-semibold">Daya Listrik</label>

<select name="daya_listrik" class="form-select" required>

<option value="450 VA" <?= ($data['daya_listrik']=="450 VA") ? "selected" : "" ?>>450 VA</option>

<option value="900 VA" <?= ($data['daya_listrik']=="900 VA") ? "selected" : "" ?>>900 VA</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label class="fw-semibold">Status Rumah</label>

<select name="status_rumah" class="form-select" required>

<option value="Milik Sendiri" <?= ($data['status_rumah']=="Milik Sendiri") ? "selected" : "" ?>>
Milik Sendiri
</option>

<option value="Kontrak" <?= ($data['status_rumah']=="Kontrak") ? "selected" : "" ?>>
Kontrak
</option>

<option value="Bebas Sewa" <?= ($data['status_rumah']=="Bebas Sewa") ? "selected" : "" ?>>
Bebas Sewa
</option>

</select>

</div>

<div class="col-md-12 mb-4">

<label class="fw-semibold">Kondisi Rumah</label>

<select name="kondisi_rumah" class="form-select" required>

<option value="Permanen" <?= ($data['kondisi_rumah']=="Permanen") ? "selected" : "" ?>>
Permanen
</option>

<option value="Semi Permanen" <?= ($data['kondisi_rumah']=="Semi Permanen") ? "selected" : "" ?>>
Semi Permanen
</option>

<option value="Tidak Permanen" <?= ($data['kondisi_rumah']=="Tidak Permanen") ? "selected" : "" ?>>
Tidak Permanen
</option>

</select>

</div>

<div class="d-flex justify-content-end gap-2">

<a href="calon_penerima.php" class="btn btn-secondary">

<i class="fa fa-arrow-left"></i>

Kembali

</a>

<button
type="submit"
name="update"
class="btn btn-success">

<i class="fa fa-save"></i>

Update Data

</button>

</div>

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

label{
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