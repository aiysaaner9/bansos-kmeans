<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once "../includes/session.php";
require_once __DIR__."/../config/koneksi.php";
/*====================================================
                GENERATE LAPORAN
====================================================*/
if(isset($_POST['generate']))
{
    mysqli_query($conn,"DELETE FROM tbl_laporan_hasil");
    $data=mysqli_query($conn,"
        SELECT *
        FROM tbl_perhitungan_kmeans
        WHERE iterasi='2'
        ORDER BY id_calon ASC
    ");
    while($d=mysqli_fetch_assoc($data))
    {$cluster = trim(strtoupper($d['cluster']));
        if($cluster=="C1"){$status="Layak Menerima Bantuan";
        }else{$status="Tidak Layak Menerima Bantuan";}
        mysqli_query($conn,"
            INSERT INTO tbl_laporan_hasil
            (
                id_calon,
                id_perhitungan,
                cluster,
                jarak_c1,
                jarak_c2,
                status_kelayakan
            )
            VALUES(
                '".$d['id_calon']."',
                '".$d['id_perhitungan']."',
                '".$d['cluster']."',
                '".$d['jarak_c1']."',
                '".$d['jarak_c2']."',
                '$status')");
    }
    header("Location: laporan.php?success=1");
    exit;
}
/*====================================================
                    RESET
====================================================*/
if(isset($_POST['reset']))
{
    mysqli_query($conn,"
        DELETE FROM tbl_laporan_hasil");
    header("Location: laporan.php?reset=1");
    exit;
}
/*====================================================
                DATA LAPORAN
====================================================*/
$query=mysqli_query($conn,"
SELECT
lh.*,
cp.nik,
cp.nama
FROM tbl_laporan_hasil lh
JOIN tbl_calon_penerima cp
ON lh.id_calon=cp.id_calon
ORDER BY cp.id_calon ASC
");
$total=mysqli_num_rows($query);
/*====================================================
                STATISTIK
====================================================*/
$totalData=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total
FROM tbl_laporan_hasil
"));
$totalLayak=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total
FROM tbl_laporan_hasil
WHERE status_kelayakan='Layak Menerima Bantuan'
"));
$totalTidak=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total
FROM tbl_laporan_hasil
WHERE status_kelayakan='Tidak Layak Menerima Bantuan'
"));
include "../includes/header.php";
include "../includes/sidebar.php";

?>

<div class="content">


<div class="d-flex justify-content-between align-items-center mb-4">

<h3 class="title">

<i class="fa-solid fa-chart-column"></i>

Laporan Hasil Akhir K-Means

</h3>

<div class="d-flex gap-2">

<form method="POST">

<button
name="generate"
class="btn btn-generate"
onclick="return confirm('Generate laporan hasil akhir?')">

<i class="fa fa-refresh"></i>

Generate

</button>

</form>


<form method="POST">

<button
name="reset"
class="btn btn-reset"
onclick="return confirm('Hapus laporan?')">

<i class="fa fa-trash"></i>

Reset

</button>

</form>


<a href="cetak_laporan.php"
target="_blank"
class="btn btn-cetak">

<i class="fa fa-print"></i>

Cetak Laporan

</a>

</div>

</div>




<div class="row mb-4">

<div class="col-md-4">

<div class="stat-box">

<div class="stat-label">

Jumlah Data

</div>

<div class="stat-value">

<?= $totalData['total']; ?>

</div>

</div>

</div>



<div class="col-md-4">

<div class="stat-box">

<div class="stat-label">

Layak Menerima Bantuan

</div>

<div class="stat-value text-success">

<?= $totalLayak['total']; ?>

</div>

</div>

</div>



<div class="col-md-4">

<div class="stat-box">

<div class="stat-label">

Tidak Layak Menerima Bantuan

</div>

<div class="stat-value text-danger">

<?= $totalTidak['total']; ?>

</div>

</div>

</div>

</div>
<div class="card-custom">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4>

            <i class="fa-solid fa-table"></i>

            Data Hasil Akhir Clustering

        </h4>

        <span class="badge bg-success">

            Hasil Akhir (Iterasi 2)

        </span>

    </div>

    <div class="table-responsive">

        <table class="table table-bordered table-hover">

            <thead>

                <tr>

                    <th width="60">No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Cluster</th>
                    <th>Jarak C1</th>
                    <th>Jarak C2</th>
                    <th>Status Kelayakan</th>

                </tr>

            </thead>

            <tbody>

            <?php if($total>0): ?>

            <?php

            $no=1;

            while($row=mysqli_fetch_assoc($query)):

            ?>

            <tr>

                <td><?= $no++; ?></td>

                <td><?= htmlspecialchars($row['nik']); ?></td>

                <td style="text-align:left;">
                    <?= htmlspecialchars($row['nama']); ?>
                </td>

                <td>

                    <?php if($row['cluster']=="C1"): ?>

                        <span class="badge-c1">

                            <?= $row['cluster']; ?>

                        </span>

                    <?php else: ?>

                        <span class="badge-c2">

                            <?= $row['cluster']; ?>

                        </span>

                    <?php endif; ?>

                </td>

                <td>

                    <?= number_format($row['jarak_c1'],6); ?>

                </td>

                <td>

                    <?= number_format($row['jarak_c2'],6); ?>

                </td>

                <td>

                    <?php if($row['status_kelayakan']=="Layak Menerima Bantuan"): ?>

<span class="badge-layak">
    Layak Menerima Bantuan
</span>

<?php else: ?>

<span class="badge-tidak">
    Tidak Layak Menerima Bantuan
</span>

<?php endif; ?>

                </td>

            </tr>

            <?php endwhile; ?>

            <?php else: ?>

            <tr>

                <td colspan="7" class="text-center py-5">

                    <i class="fa fa-database fa-3x text-secondary"></i>

                    <br><br>

                    <strong>Belum ada laporan hasil.</strong>

                    <br>

                    Klik tombol <b>Generate</b> untuk membuat laporan hasil akhir K-Means.

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

.stat-box{
    background:#F8FAFC;
    border-radius:18px;
    padding:25px;
    text-align:center;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.stat-label{
    color:#64748B;
    font-size:14px;
    margin-bottom:8px;
}

.stat-value{
    font-size:30px;
    font-weight:bold;
    color:#0F766E;
}

.btn-generate{
    background:#0F766E;
    color:#fff;
    border:none;
    border-radius:12px;
    padding:10px 18px;
    font-weight:600;
}

.btn-generate:hover{
    background:#115E59;
    color:#fff;
}

.btn-reset{
    background:#DC2626;
    color:#fff;
    border:none;
    border-radius:12px;
    padding:10px 18px;
    font-weight:600;
}

.btn-reset:hover{
    background:#B91C1C;
    color:#fff;
}

.btn-cetak{
    background:#2563EB;
    color:#fff;
    border:none;
    border-radius:12px;
    padding:10px 18px;
    font-weight:600;
}

.btn-cetak:hover{
    background:#1D4ED8;
    color:#fff;
}

.table thead th{
    background:#0F766E;
    color:#fff;
    text-align:center;
    vertical-align:middle;
}

.table tbody td{
    vertical-align:middle;
    text-align:center;
}

.badge-c1{
    background:#DBEAFE;
    color:#1D4ED8;
    padding:7px 15px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

.badge-c2{
    background:#FEF3C7;
    color:#B45309;
    padding:7px 15px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

.badge-layak{
    background:#DCFCE7;
    color:#166534;
    padding:7px 15px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

.badge-tidak{
    background:#FEE2E2;
    color:#991B1B;
    padding:7px 15px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

</style>

<?php include "../includes/footer.php"; ?>


<?php if(isset($_GET['success'])): ?>

<script>

Swal.fire({

    icon:'success',

    title:'Berhasil',

    text:'Laporan hasil akhir berhasil dibuat.',

    confirmButtonColor:'#0F766E'

});

</script>

<?php endif; ?>


<?php if(isset($_GET['reset'])): ?>

<script>

Swal.fire({

    icon:'success',

    title:'Berhasil',

    text:'Laporan berhasil dihapus.',

    confirmButtonColor:'#0F766E'

});

</script>

<?php endif; ?>