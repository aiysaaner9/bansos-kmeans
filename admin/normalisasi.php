<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once "../includes/session.php";
require_once __DIR__ . "/../config/koneksi.php";
/* ===================================
   PROSES NORMALISASI
=================================== */
if(isset($_POST['normalisasi']))
{
    mysqli_query($conn,"
        DELETE FROM tbl_normalisasi
    ");
    $minmax=mysqli_fetch_assoc(mysqli_query($conn,"
        SELECT
        MIN(x1) min_x1,
        MAX(x1) max_x1,
        MIN(x2) min_x2,
        MAX(x2) max_x2,
        MIN(x3) min_x3,
        MAX(x3) max_x3,
        MIN(x4) min_x4,
        MAX(x4) max_x4,
        MIN(x5) min_x5,
        MAX(x5) max_x5
        FROM tbl_hasil_konversi
    "));
    $dataKonversi=mysqli_query($conn,"
        SELECT *
        FROM tbl_hasil_konversi
        ORDER BY id_konversi_hasil ASC
    ");
    while($d=mysqli_fetch_assoc($dataKonversi))
    {
        $n1=($minmax['max_x1']-$minmax['min_x1']==0)
        ?0
        :(($d['x1']-$minmax['min_x1'])/
        ($minmax['max_x1']-$minmax['min_x1']));
        $n2=($minmax['max_x2']-$minmax['min_x2']==0)
        ?0
        :(($d['x2']-$minmax['min_x2'])/
        ($minmax['max_x2']-$minmax['min_x2']));
        $n3=($minmax['max_x3']-$minmax['min_x3']==0)
        ?0
        :(($d['x3']-$minmax['min_x3'])/
        ($minmax['max_x3']-$minmax['min_x3']));
        $n4=($minmax['max_x4']-$minmax['min_x4']==0)
        ?0
        :(($d['x4']-$minmax['min_x4'])/
        ($minmax['max_x4']-$minmax['min_x4']));
        $n5=($minmax['max_x5']-$minmax['min_x5']==0)
        ?0
        :(($d['x5']-$minmax['min_x5'])/
        ($minmax['max_x5']-$minmax['min_x5']));
        mysqli_query($conn,"
            INSERT INTO tbl_normalisasi
            (
                id_calon,
                n1,
                n2,
                n3,
                n4,
                n5
            )VALUES(
                '{$d['id_calon']}',
                '$n1',
                '$n2',
                '$n3',
                '$n4',
                '$n5')");
    }
    header("Location: normalisasi.php?success=1");
    exit;}
/* ===================================
   RESET
=================================== */
if(isset($_POST['reset']))
{


    mysqli_query($conn,"
        DELETE FROM tbl_normalisasi
    ");


    header("Location: normalisasi.php?reset=1");
    exit;


}




/* ===================================
   DATA
=================================== */


$data=mysqli_query($conn,"
SELECT

n.*,

cp.nik,
cp.nama


FROM tbl_normalisasi n


JOIN tbl_calon_penerima cp


ON n.id_calon=cp.id_calon


ORDER BY n.id_normalisasi ASC

");



$total=mysqli_num_rows($data);



include "../includes/header.php";
include "../includes/sidebar.php";


?>



<div class="content">


<div class="d-flex justify-content-between align-items-center mb-4">


<h3 class="title">

<i class="fa-solid fa-chart-line"></i>

Normalisasi Data K-Means

</h3>



<div class="d-flex gap-2">

<form method="POST">


<button

name="normalisasi"

class="btn btn-normalisasi"

onclick="return confirm('Lakukan proses normalisasi?')">


<i class="fa fa-calculator"></i>

Normalisasi


</button>


</form>




<form method="POST">


<button

name="reset"

class="btn btn-reset"

onclick="return confirm('Hapus data normalisasi?')">


<i class="fa fa-trash"></i>

Reset


</button>


</form>


</div>



</div>





<div class="row mb-4">



<div class="col-md-4 mb-3">


<div class="stat-box">


<div class="stat-label">

Jumlah Data

</div>


<div class="stat-value">

<?= $total ?>

</div>


</div>


</div>





<div class="col-md-4 mb-3">


<div class="stat-box">


<div class="stat-label">

Metode

</div>


<div class="stat-value metode">

Min-Max

</div>


</div>


</div>





<div class="col-md-4 mb-3">


<div class="stat-box">


<div class="stat-label">

Range Nilai

</div>


<div class="stat-value">

0 - 1

</div>


</div>


</div>


</div>

<div class="card-custom">


<div class="table-responsive">


<table class="table table-bordered">


<thead>


<tr>

<th>No</th>
<th>NIK</th>
<th>Nama</th>
<th>N1</th>
<th>N2</th>
<th>N3</th>
<th>N4</th>
<th>N5</th>
<th>Tanggal</th>

</tr>


</thead>



<tbody>



<?php if($total > 0): ?>



<?php

$no=1;


while($row=mysqli_fetch_assoc($data)):

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




<td>

<span class="nilai">

<?= number_format($row['n1'],4) ?>

</span>

</td>




<td>

<span class="nilai">

<?= number_format($row['n2'],4) ?>

</span>

</td>




<td>

<span class="nilai">

<?= number_format($row['n3'],4) ?>

</span>

</td>




<td>

<span class="nilai">

<?= number_format($row['n4'],4) ?>

</span>

</td>




<td>

<span class="nilai">

<?= number_format($row['n5'],4) ?>

</span>

</td>



<td>

<?php 

if(isset($row['created_at'])){

echo date(
"d-m-Y",
strtotime($row['created_at'])
);

}else{

echo "-";

}

?>

</td>



</tr>



<?php endwhile; ?>



<?php else: ?>


<tr>


<td colspan="9" class="text-center py-5">


<i class="fa fa-database fa-3x text-secondary"></i>


<br><br>


Belum ada data normalisasi.


<br>


Silakan klik tombol Normalisasi.


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



.btn-normalisasi{

background:#0F766E;

color:white;

border-radius:12px;

padding:10px 18px;

font-weight:600;

border:none;

}



.btn-normalisasi:hover{

background:#115E59;

color:white;

}



.btn-reset{

background:#DC2626;

color:white;

border-radius:12px;

padding:10px 18px;

font-weight:600;

border:none;

}



.btn-reset:hover{

background:#B91C1C;

color:white;

}



.stat-box{

background:#ECFEFF;

border-radius:16px;

padding:20px;

}



.stat-label{

font-size:13px;

color:#64748B;

}



.stat-value{

font-size:28px;

font-weight:700;

color:#0F766E;

}



.metode{

font-size:22px;

}



.table thead th{

background:#0F766E;

color:white;

text-align:center;

}



.table tbody td{

text-align:center;

vertical-align:middle;

font-size:13px;

}



.nilai{

background:#CCFBF1;

color:#115E59;

padding:6px 10px;

border-radius:20px;

font-weight:600;

font-size:12px;

}



</style>







<?php include "../includes/footer.php"; ?>








<?php if(isset($_GET['success'])): ?>


<script>


Swal.fire({

title:"Berhasil!",

text:"Normalisasi berhasil dilakukan.",

icon:"success",

confirmButtonColor:"#0f766e"

});


</script>


<?php endif; ?>






<?php if(isset($_GET['reset'])): ?>


<script>


Swal.fire({

title:"Berhasil!",

text:"Data normalisasi berhasil dihapus.",

icon:"success",

confirmButtonColor:"#0f766e"

});


</script>


<?php endif; ?>