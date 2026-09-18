<?php
require_once "../includes/session.php";
require_once __DIR__ . "/../config/koneksi.php";
$query = "SELECT * FROM tbl_calon_penerima ORDER BY id_calon ASC";
$result = mysqli_query($conn,$query);
if(!$result){
    die(mysqli_error($conn));
}
$totalData = mysqli_num_rows($result);
include "../includes/header.php";
include "../includes/sidebar.php";
?>
<div class="content">
<div class="d-flex justify-content-between align-items-center mb-4">
<h3 class="title">
<i class="fa-solid fa-users"></i>Data Calon Penerima</h3>
<a href="tambah_calon.php" class="btn btn-tambah">
<i class="fa fa-plus"></i>Tambah Data</a>
</div>
<div class="card-custom">
<div class="table-scroll">
<table class="table table-bordered">
<thead>
<tr>
<th width="50">No</th>
<th>NIK</th>
<th>Nama</th>
<th width="250">Alamat</th>
<th>Pendapatan</th>
<th>Tanggungan</th>
<th>Daya Listrik</th>
<th>Status Rumah</th>
<th>Kondisi Rumah</th>
<th width="100">Aksi</th>
</tr>
</thead>
<tbody>
<?php if($totalData > 0): ?>
<?php
$no=1;
while($row=mysqli_fetch_assoc($result)):
?>
<tr>
<td>
<?= $no++ ?>
</td>
<td>
<?= htmlspecialchars($row['nik']) ?>
</td>
<td>
<?= htmlspecialchars($row['nama']) ?>
</td>
<td class="alamat">
<?= htmlspecialchars($row['alamat']) ?>
</td>
<td>
Rp <?= number_format(
$row['pendapatan'],
0,
",",
"."
) ?>
</td>
<td>
<?= $row['jumlah_tanggungan'] ?>
</td>
<td>
<?= $row['daya_listrik'] ?> W
</td>
<td>
<span class="badge-status">
<?= $row['status_rumah'] ?>
</span>
</td>




<td>

<?= $row['kondisi_rumah'] ?>

</td>




<td>


<a href="edit_calon.php?id=<?= $row['id_calon'] ?>"

class="btn btn-warning btn-sm">


<i class="fa fa-edit"></i>


</a>




<a href="hapus_calon.php?id=<?= $row['id_calon'] ?>"

class="btn btn-danger btn-sm"

onclick="return confirm('Yakin ingin menghapus data?')">


<i class="fa fa-trash"></i>


</a>


</td>



</tr>



<?php endwhile; ?>



<?php else: ?>



<tr>


<td colspan="10" class="text-center py-5">


<i class="fa fa-database fa-3x text-secondary"></i>


<br><br>


Belum ada data calon penerima


</td>


</tr>



<?php endif; ?>



</tbody>



</table>



</div>



</div>



</div>





<style>


.title{

color:#134E4A;

font-weight:700;

}




.card-custom{

background:#fff;

border-radius:20px;

box-shadow:0 10px 30px rgba(0,0,0,.08);

padding:25px;

}



/* supaya tabel geser ke samping */

.table-scroll{

width:100%;

overflow-x:auto;

}





.table{

min-width:1200px;

}





.table thead th{

background:#0F766E;

color:white;

text-align:center;

white-space:nowrap;

}





.table tbody td{

text-align:center;

vertical-align:middle;

white-space:nowrap;

}





/* alamat tetap satu baris */

.alamat{

max-width:250px;

overflow:hidden;

text-overflow:ellipsis;

}





.btn-tambah{

background:#0F766E;

color:#fff;

border-radius:12px;

font-weight:600;

padding:10px 18px;

}





.btn-tambah:hover{

background:#115E59;

color:#fff;

}




.badge-status{

background:#CCFBF1;

color:#115E59;

padding:6px 12px;

border-radius:20px;

font-size:12px;

white-space:nowrap;

}



</style>




<?php include "../includes/footer.php"; ?>