<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once "../includes/session.php";
require_once __DIR__ . "/../config/koneksi.php";
/* =====================================
   FUNGSI KONVERSI
===================================== */
function konversiDayaListrik($nilai)
{if($nilai=="450 VA"){return 1;}
    elseif($nilai=="900 VA"){return 2;
    }else{return 1;}}
function konversiStatusRumah($nilai)
{if($nilai=="Bebas Sewa"){return 1;}
    elseif($nilai=="Kontrak"){return 2;}
    elseif($nilai=="Milik Sendiri"){return 3;}
    else{return 1;}}
function konversiKondisiRumah($nilai)
{if($nilai=="Tidak Permanen"){return 1;}
    elseif($nilai=="Semi Permanen"){return 2;}
    elseif($nilai=="Permanen"){return 3;}
    else{return 1;}}
/* =====================================
   PROSES KONVERSI
===================================== */
if(isset($_POST['konversi']))
{
    mysqli_query($conn,"
        DELETE FROM tbl_hasil_konversi");
    $query=mysqli_query($conn,"
        SELECT *
        FROM tbl_calon_penerima
        ORDER BY id_calon ASC");
    while($row=mysqli_fetch_assoc($query))
    {
        $x1=$row['pendapatan'];
        $x2=$row['jumlah_tanggungan'];
        $x3=konversiDayaListrik(
            $row['daya_listrik']);
        $x4=konversiStatusRumah(
            $row['status_rumah']);
        $x5=konversiKondisiRumah(
            $row['kondisi_rumah']);
        mysqli_query($conn,"
            INSERT INTO tbl_hasil_konversi
            (
                id_calon,
                x1,
                x2,
                x3,
                x4,
                x5
            )
            VALUES(
                '{$row['id_calon']}',
                '$x1',
                '$x2',
                '$x3',
                '$x4',
                '$x5'
            )");
    }
    header("Location: konversi.php?success=1");
    exit;
}
/* =====================================
   RESET
===================================== */
if(isset($_POST['reset']))
{
    mysqli_query($conn,"
        DELETE FROM tbl_hasil_konversi
    ");
    header("Location: konversi.php?reset=1");
    exit;
}






/* =====================================
   DATA KONVERSI
===================================== */


$data=mysqli_query($conn,"
SELECT

hk.*,

cp.nik,
cp.nama


FROM tbl_hasil_konversi hk


JOIN tbl_calon_penerima cp


ON hk.id_calon=cp.id_calon


ORDER BY hk.id_konversi_hasil ASC

");



$total=mysqli_num_rows($data);




include "../includes/header.php";
include "../includes/sidebar.php";

?>



<div class="content">




<div class="d-flex justify-content-between align-items-center mb-4">


<h3 class="title">

<i class="fa-solid fa-arrow-right-arrow-left"></i>

Konversi Data Calon Penerima

</h3>




<div class="d-flex gap-2">

<form method="POST">


<button

name="konversi"

class="btn btn-konversi"

onclick="return confirm('Konversi seluruh data calon penerima?')">


<i class="fa fa-calculator"></i>

Konversi Data


</button>


</form>




<form method="POST">


<button

name="reset"

class="btn btn-reset"

onclick="return confirm('Hapus seluruh hasil konversi?')">


<i class="fa fa-trash"></i>

Reset


</button>


</form>


</div>


</div>

<div class="row mb-4">


<div class="col-md-4 mb-3">


<div class="stat-card">


<div class="stat-label">

Jumlah Data

</div>


<div class="stat-value">

<?= $total ?>

</div>


</div>


</div>




<div class="col-md-4 mb-3">


<div class="stat-card">


<div class="stat-label">

Jumlah Variabel

</div>


<div class="stat-value">

5

</div>


</div>


</div>




<div class="col-md-4 mb-3">


<div class="stat-card">


<div class="stat-label">

Metode

</div>


<div class="stat-value metode">

K-Means

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
<th>X1 Pendapatan</th>
<th>X2 Tanggungan</th>
<th>X3 Daya Listrik</th>
<th>X4 Status Rumah</th>
<th>X5 Kondisi Rumah</th>
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

<?= $row['x1'] ?>

</span>

</td>




<td>

<span class="nilai">

<?= $row['x2'] ?>

</span>

</td>




<td>

<span class="nilai">

<?= $row['x3'] ?>

</span>

</td>




<td>

<span class="nilai">

<?= $row['x4'] ?>

</span>

</td>




<td>

<span class="nilai">

<?= $row['x5'] ?>

</span>

</td>




<td>


<?php

if(isset($row['created_at']) && $row['created_at']!="")
{

echo date(
"d-m-Y",
strtotime($row['created_at'])
);

}
else
{

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


Belum ada data konversi.


<br>


Silakan klik tombol Konversi Data.


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

padding:25px;

box-shadow:0 10px 30px rgba(0,0,0,.08);

}




.btn-konversi{

background:#0F766E;

color:white;

border-radius:12px;

font-weight:600;

padding:10px 18px;

}



.btn-konversi:hover{

background:#115E59;

color:white;

}



.btn-reset{

background:#DC2626;

color:white;

border-radius:12px;

font-weight:600;

padding:10px 18px;

}



.btn-reset:hover{

background:#B91C1C;

color:white;

}




.stat-card{

background:#ECFEFF;

padding:20px;

border-radius:16px;

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

padding:6px 12px;

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

text:"Data berhasil dikonversi.",

icon:"success",

confirmButtonColor:"#0f766e"

});


</script>


<?php endif; ?>






<?php if(isset($_GET['reset'])): ?>


<script>


Swal.fire({

title:"Berhasil!",

text:"Data konversi berhasil dihapus.",

icon:"success",

confirmButtonColor:"#0f766e"

});


</script>


<?php endif; ?>
