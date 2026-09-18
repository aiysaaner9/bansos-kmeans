<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once "../includes/session.php";
require_once __DIR__."/../config/koneksi.php";
/*=====================================================
        PROSES ITERASI 2
=====================================================*/
if(isset($_POST['proses_iterasi2']))
{
    //hapus hasil iterasi 2 sebelumnya
    mysqli_query($conn,"DELETE FROM tbl_centroid
                        WHERE iterasi='2'");

    mysqli_query($conn,"DELETE FROM tbl_perhitungan_kmeans
                        WHERE iterasi='2'");
    /*
    ============================================
        HITUNG CENTROID BARU DARI ITERASI 1
    ============================================
    */
    $cluster=array();
    $q=mysqli_query($conn,"
    SELECT
        p.cluster,
        n.*
    FROM tbl_perhitungan_kmeans p
    JOIN tbl_normalisasi n
    ON p.id_calon=n.id_calon
    WHERE p.iterasi='1'
    ORDER BY p.cluster, p.id_calon ASC
");
    while($d=mysqli_fetch_assoc($q))
    {
        $c=$d['cluster'];
        $cluster[$c][]=$d;
    }
/*===========================================
        RATA-RATA C1
============================================*/
$jumlahC1 = isset($cluster['C1']) ? count($cluster['C1']) : 0;
$jumlahC2 = isset($cluster['C2']) ? count($cluster['C2']) : 0;
if($jumlahC1==0 || $jumlahC2==0)
{
    die("Cluster kosong. Silahkan ulang proses iterasi 1.");
};
    $totalX1=0;
    $totalX2=0;
    $totalX3=0;
    $totalX4=0;
    $totalX5=0;
    foreach($cluster['C1'] as $r)
    {
        $totalX1+=$r['n1'];
        $totalX2+=$r['n2'];
        $totalX3+=$r['n3'];
        $totalX4+=$r['n4'];
        $totalX5+=$r['n5'];

    }
    $C1=array(
        "x1"=>$totalX1/$jumlahC1,
        "x2"=>$totalX2/$jumlahC1,
        "x3"=>$totalX3/$jumlahC1,
        "x4"=>$totalX4/$jumlahC1,
        "x5"=>$totalX5/$jumlahC1
    );
    /*
    ============================================
        RATA-RATA C2
    ============================================
    */
    $totalX1=0;
    $totalX2=0;
    $totalX3=0;
    $totalX4=0;
    $totalX5=0;
    foreach($cluster['C2'] as $r)
    {
        $totalX1+=$r['n1'];
        $totalX2+=$r['n2'];
        $totalX3+=$r['n3'];
        $totalX4+=$r['n4'];
        $totalX5+=$r['n5'];
    }
    $C2=array(
        "x1"=>$totalX1/$jumlahC2,
        "x2"=>$totalX2/$jumlahC2,
        "x3"=>$totalX3/$jumlahC2,
        "x4"=>$totalX4/$jumlahC2,
        "x5"=>$totalX5/$jumlahC2
    );
/*
============================================
    NORMALISASI LABEL CLUSTER
    C1 = LAYAK
    C2 = TIDAK LAYAK
============================================
*/
$rataC1 =
$C1['x1']+
$C1['x2']+
$C1['x3']+
$C1['x4']+
$C1['x5'];


$rataC2 =
$C2['x1']+
$C2['x2']+
$C2['x3']+
$C2['x4']+
$C2['x5'];



if($rataC1 > $rataC2)
{

    $temp=$C1;
    $C1=$C2;
    $C2=$temp;

}

    /*
    ============================================
        SIMPAN CENTROID BARU
    ============================================
    */

    mysqli_query($conn,"
        INSERT INTO tbl_centroid
        (
            iterasi,
            cluster,
            x1,
            x2,
            x3,
            x4,
            x5
        )
        VALUES
        (
            '2',
            'C1',
            '".$C1['x1']."',
            '".$C1['x2']."',
            '".$C1['x3']."',
            '".$C1['x4']."',
            '".$C1['x5']."'
        )
    ");




    mysqli_query($conn,"
        INSERT INTO tbl_centroid
        (
            iterasi,
            cluster,
            x1,
            x2,
            x3,
            x4,
            x5
        )
        VALUES
        (
            '2',
            'C2',
            '".$C2['x1']."',
            '".$C2['x2']."',
            '".$C2['x3']."',
            '".$C2['x4']."',
            '".$C2['x5']."'
        )
    ");
    /*
    ============================================
        HITUNG EUCLIDEAN ITERASI 2
    ============================================
    */

    $data=mysqli_query($conn,"
        SELECT *
        FROM tbl_normalisasi
        ORDER BY id_normalisasi ASC
    ");

    while($d=mysqli_fetch_assoc($data))
    {

        /*
        ===========================
            JARAK KE C1
        ===========================
        */

        $jarakC1=sqrt(

            pow($d['n1']-$C1['x1'],2)+
            pow($d['n2']-$C1['x2'],2)+
            pow($d['n3']-$C1['x3'],2)+
            pow($d['n4']-$C1['x4'],2)+
            pow($d['n5']-$C1['x5'],2)

        );


        /*
        ===========================
            JARAK KE C2
        ===========================
        */

        $jarakC2=sqrt(

            pow($d['n1']-$C2['x1'],2)+
            pow($d['n2']-$C2['x2'],2)+
            pow($d['n3']-$C2['x3'],2)+
            pow($d['n4']-$C2['x4'],2)+
            pow($d['n5']-$C2['x5'],2)

        );


        /*
        ===========================
            TENTUKAN CLUSTER
        ===========================
        */

        if($jarakC1 <= $jarakC2)
        {
            $cluster="C1";
        }
        else
        {
            $cluster="C2";
        }


        /*
        ===========================
            SIMPAN ITERASI 2
        ===========================
        */

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
                '2',
                '$jarakC1',
                '$jarakC2',
                '$cluster'
            )
        ");

    }


    header("Location: proses_kmeans.php?success=1");
    exit;

}



/*=====================================================
                    RESET
=====================================================*/

if(isset($_POST['reset']))
{

    mysqli_query($conn,"
        DELETE FROM tbl_centroid
        WHERE iterasi='2'
    ");

    mysqli_query($conn,"
        DELETE FROM tbl_perhitungan_kmeans
        WHERE iterasi='2'
    ");

    header("Location: proses_kmeans.php?reset=1");
    exit;

}



/*=====================================================
                DATA TAMPILAN
=====================================================*/

$dataCentroid=mysqli_query($conn,"
    SELECT *
    FROM tbl_centroid
    WHERE iterasi='2'
    ORDER BY cluster
");


$hasil=mysqli_query($conn,"
SELECT

p.*,

cp.nik,

cp.nama

FROM tbl_perhitungan_kmeans p

JOIN tbl_calon_penerima cp

ON p.id_calon=cp.id_calon

WHERE p.iterasi='2'

ORDER BY cp.id_calon ASC

");

$totalHasil=mysqli_num_rows($hasil);


include "../includes/header.php";
include "../includes/sidebar.php";

?>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">

    <h3 class="title">
        <i class="fa-solid fa-arrows-rotate"></i>
        Proses K-Means Iterasi 2
    </h3>

    <div class="d-flex gap-2">

        <form method="POST">

            <button
                name="proses_iterasi2"
                class="btn btn-normalisasi"
                onclick="return confirm('Hitung Iterasi 2?')">

                <i class="fa fa-calculator"></i>

                Proses Iterasi 2

            </button>

        </form>


        <form method="POST">

            <button
                name="reset"
                class="btn btn-reset"
                onclick="return confirm('Reset Iterasi 2 ?')">

                <i class="fa fa-trash"></i>

                Reset

            </button>

        </form>

    </div>

</div>





<div class="card-custom mb-4">

    <h4 class="mb-3">

        <i class="fa fa-crosshairs"></i>

        Centroid Baru (Iterasi 2)

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

            <?php while($c=mysqli_fetch_assoc($dataCentroid)): ?>

                <tr>

                    <td>

                        <?php
                        if($c['cluster']=="C1")
                        {
                            echo '<span class="cluster-c1">C1</span>';
                        }
                        else
                        {
                            echo '<span class="cluster-c2">C2</span>';
                        }
                        ?>

                    </td>

                    <td><?= number_format($c['x1'],4) ?></td>
                    <td><?= number_format($c['x2'],4) ?></td>
                    <td><?= number_format($c['x3'],4) ?></td>
                    <td><?= number_format($c['x4'],4) ?></td>
                    <td><?= number_format($c['x5'],4) ?></td>

                </tr>

            <?php endwhile; ?>

            </tbody>

        </table>

    </div>

</div>






<?php if($totalHasil>0): ?>

<div class="card-custom">

<div class="d-flex justify-content-between align-items-center mb-3">

<h4>

<i class="fa-solid fa-calculator"></i>

Perhitungan Euclidean Distance Iterasi 2

</h4>

<span class="badge bg-success">

Iterasi 2

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

<td><?= $no++ ?></td>

<td><?= htmlspecialchars($r['nik']) ?></td>

<td><?= htmlspecialchars($r['nama']) ?></td>

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

Belum ada hasil Iterasi 2.

<br>

Klik tombol Proses Iterasi 2.

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

text:"Iterasi 2 berhasil dihitung.",

icon:"success",

confirmButtonColor:"#0F766E"

});

</script>

<?php endif; ?>

<?php if(isset($_GET['reset'])): ?>

<script>

Swal.fire({

title:"Berhasil!",

text:"Data Iterasi 2 berhasil dihapus.",

icon:"success",

confirmButtonColor:"#0F766E"

});

</script>

<?php endif; ?>