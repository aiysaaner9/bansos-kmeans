<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once "../includes/session.php";
require_once __DIR__ . "/../config/koneksi.php";
/* ===================================
   PROSES CENTROID AWAL + ITERASI 1
=================================== */
if(isset($_POST['proses_centroid']))
{
    // hapus hasil iterasi 1 sebelumnya
    mysqli_query($conn,"
        DELETE FROM tbl_centroid
        WHERE iterasi=1
    ");
    mysqli_query($conn,"
        DELETE FROM tbl_perhitungan_kmeans
        WHERE iterasi=1
    ");
    $C1=[

        "x1"=>0,
        "x2"=>1,
        "x3"=>0,
        "x4"=>0.5,
        "x5"=>0

    ];
    $C2=[
        "x1"=>1,
        "x2"=>0.8,
        "x3"=>1,
        "x4"=>0.5,
        "x5"=>1
    ];
    // simpan centroid C1
    mysqli_query($conn,"
        INSERT INTO tbl_centroid
        (
            iterasi,
            cluster,
            x1,
            x2,
            x3,
            x4,
            x5)
        VALUES(
            '1',
            'C1',
            '0',
            '1',
            '0',
            '0.5',
            '0')");
    // simpan centroid C2
    mysqli_query($conn,"
        INSERT INTO tbl_centroid
        (
            iterasi,
            cluster,
            x1,
            x2,
            x3,
            x4,
            x5)
        VALUES(
            '1',
            'C2',
            '1',
            '0.8',
            '1',
            '0.5',
            '1')");
    // ===============================
    // AMBIL DATA NORMALISASI
    // ===============================
    $data=mysqli_query($conn,"
        SELECT *

        FROM tbl_normalisasi

        ORDER BY id_normalisasi ASC
    ");





    while($d=mysqli_fetch_assoc($data))
    {


        // ===============================
        // EUCLIDEAN C1
        // ===============================


        $jarakC1=sqrt(

            pow($d['n1']-$C1['x1'],2)+
            pow($d['n2']-$C1['x2'],2)+
            pow($d['n3']-$C1['x3'],2)+
            pow($d['n4']-$C1['x4'],2)+
            pow($d['n5']-$C1['x5'],2)

        );





        // ===============================
        // EUCLIDEAN C2
        // ===============================


        $jarakC2=sqrt(

            pow($d['n1']-$C2['x1'],2)+
            pow($d['n2']-$C2['x2'],2)+
            pow($d['n3']-$C2['x3'],2)+
            pow($d['n4']-$C2['x4'],2)+
            pow($d['n5']-$C2['x5'],2)

        );





        // ===============================
        // PILIH CLUSTER
        // ===============================


        if($jarakC1 <= $jarakC2)
        {

            $cluster="C1";

        }
        else
        {

            $cluster="C2";

        }





        // ===============================
        // SIMPAN ITERASI 1
        // ===============================


        mysqli_query($conn,"
            INSERT INTO tbl_perhitungan_kmeans

            (
                id_calon,
                iterasi,
                jarak_c1,
                jarak_c2,
                cluster
            )

            VALUES

            (
                '".$d['id_calon']."',
                '1',
                '$jarakC1',
                '$jarakC2',
                '$cluster'
            )

        ");



    }




    header("Location: centroid.php?success=1");
    exit;


}





/* ===================================
   RESET
=================================== */


if(isset($_POST['reset']))
{


    mysqli_query($conn,"
        DELETE FROM tbl_centroid
    ");


    mysqli_query($conn,"
        DELETE FROM tbl_perhitungan_kmeans
    ");



    header("Location: centroid.php?reset=1");

    exit;

}





/* ===================================
   DATA TAMPILAN
=================================== */


$data=mysqli_query($conn,"
SELECT

n.*,

cp.nik,

cp.nama


FROM tbl_normalisasi n


JOIN tbl_calon_penerima cp


ON n.id_calon=cp.id_calon


ORDER BY cp.nama DESC

");



$total=mysqli_num_rows($data);





/* ===================================
   AMBIL HASIL ITERASI 1
=================================== */


$hasil=mysqli_query($conn,"
SELECT

p.*,

cp.nik,

cp.nama


FROM tbl_perhitungan_kmeans p


JOIN tbl_calon_penerima cp


ON p.id_calon=cp.id_calon


WHERE p.iterasi=1


ORDER BY p.id_perhitungan ASC

");



$totalHasil=mysqli_num_rows($hasil);




include "../includes/header.php";
include "../includes/sidebar.php";

?>
<div class="content">


<div class="d-flex justify-content-between align-items-center mb-4">


<h3 class="title">

<i class="fa-solid fa-bullseye"></i>

Centroid Awal K-Means

</h3>



<div class="d-flex gap-2">

<form method="POST">

<button

name="proses_centroid"

class="btn btn-normalisasi"

onclick="return confirm('Hitung centroid awal dan Iterasi 1?')">

<i class="fa fa-calculator"></i>

Proses Iterasi 1

</button>

</form>




<form method="POST">

<button

name="reset"

class="btn btn-reset"

onclick="return confirm('Hapus seluruh proses K-Means?')">

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

Jumlah Cluster

</div>


<div class="stat-value">

2

</div>


</div>

</div>





<div class="col-md-4 mb-3">

<div class="stat-box">

<div class="stat-label">

Metode

</div>


<div class="stat-value metode">

K-Means

</div>


</div>

</div>


</div>








<!-- ===============================
     CENTROID AWAL
================================ -->


<div class="card-custom mb-4">


<h4 class="mb-3">

<i class="fa fa-crosshairs"></i>

Centroid Awal

</h4>



<div class="table-responsive">


<table class="table table-bordered">


<thead>

<tr>

<th>Cluster</th>

<th>X1</th>

<th>X2</th>

<th>X3</th>

<th>X4</th>

<th>X5</th>

</tr>

</thead>



<tbody>


<tr>

<td>

<span class="cluster-c1">

C1

</span>

</td>


<td>0.0000</td>

<td>1.0000</td>

<td>0.0000</td>

<td>0.5000</td>

<td>0.0000</td>


</tr>



<tr>

<td>

<span class="cluster-c2">

C2

</span>

</td>


<td>1.0000</td>

<td>0.8000</td>

<td>1.0000</td>

<td>0.5000</td>

<td>1.0000</td>


</tr>



</tbody>


</table>


</div>


</div>








<!-- ===============================
     HASIL ITERASI 1
================================ -->


<?php if($totalHasil>0): ?>


<div class="card-custom">


<div class="d-flex justify-content-between align-items-center mb-3">


<h4>

<i class="fa-solid fa-calculator"></i>

Perhitungan Euclidean Distance Iterasi 1

</h4>


<span class="badge bg-success">

Iterasi 1

</span>


</div>







<div class="table-responsive">


<table class="table table-bordered">


<thead>


<tr>

<th>No</th>

<th>NIK</th>

<th>Nama</th>

<th>Jarak C1</th>

<th>Jarak C2</th>

<th>Cluster</th>


</tr>


</thead>




<tbody>


<?php


$no=1;


while($r=mysqli_fetch_assoc($hasil)):


?>


<tr>


<td>

<?= $no++ ?>

</td>



<td>

<?= htmlspecialchars($r['nik']) ?>

</td>



<td>

<?= htmlspecialchars($r['nama']) ?>

</td>



<td>

<span class="nilai">

<?= number_format($r['jarak_c1'],6) ?>

</span>

</td>




<td>

<span class="nilai">

<?= number_format($r['jarak_c2'],6) ?>

</span>

</td>





<td>


<?php if($r['cluster']=="C1"): ?>


<span class="cluster-c1">

C1

</span>


<?php else: ?>


<span class="cluster-c2">

C2

</span>


<?php endif; ?>


</td>


</tr>


<?php endwhile; ?>


</tbody>


</table>


</div>


</div>



<?php else: ?>


<div class="card-custom text-center py-5">


<i class="fa fa-database fa-3x text-secondary"></i>


<br><br>


Belum ada hasil Iterasi 1.


<br>


Klik tombol Proses Iterasi 1.


</div>


<?php endif; ?>





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

vertical-align:middle;

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



.cluster-c1{

background:#DBEAFE;

color:#1D4ED8;

padding:8px 15px;

border-radius:20px;

font-weight:700;

}



.cluster-c2{

background:#FEF3C7;

color:#B45309;

padding:8px 15px;

border-radius:20px;

font-weight:700;

}


</style>



</div>



<?php include "../includes/footer.php"; ?>







<?php if(isset($_GET['success'])): ?>


<script>

Swal.fire({

title:"Berhasil!",

text:"Centroid awal dan Iterasi 1 berhasil dihitung.",

icon:"success",

confirmButtonColor:"#0F766E"

});


</script>


<?php endif; ?>






<?php if(isset($_GET['reset'])): ?>


<script>

Swal.fire({

title:"Berhasil!",

text:"Data K-Means berhasil dihapus.",

icon:"success",

confirmButtonColor:"#0F766E"

});


</script>


<?php endif; ?>