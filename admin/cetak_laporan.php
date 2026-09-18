<?php
require_once "../includes/session.php";
require_once __DIR__ . "/../config/koneksi.php";
/* ======================
   DATA LAPORAN
====================== */
$query = mysqli_query($conn,"
SELECT
    lh.*,
    cp.nik,
    cp.nama,
    cp.alamat,
    cp.pendapatan,
    cp.jumlah_tanggungan,
    cp.daya_listrik,
    cp.status_rumah,
    cp.kondisi_rumah
FROM tbl_laporan_hasil lh
JOIN tbl_calon_penerima cp
ON lh.id_calon = cp.id_calon
ORDER BY cp.id_calon ASC
");
$totalData = mysqli_num_rows($query);
/* ======================
   REKAP
====================== */
$c1 = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM tbl_laporan_hasil
WHERE cluster='C1'
"));
$c2 = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM tbl_laporan_hasil
WHERE cluster='C2'
"));
$layak = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM tbl_laporan_hasil
WHERE status_kelayakan='Layak Menerima Bantuan'
"));
$tidak = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM tbl_laporan_hasil
WHERE status_kelayakan='Tidak Layak Menerima Bantuan'
"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Cetak Laporan Hasil Clustering</title>
<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}
body{
    padding:35px;
    color:#222;
}
.kop{
    display:flex;
    align-items:center;
    border-bottom:4px solid #000;
    padding-bottom:15px;
    margin-bottom:25px;
}
.logo{
    width:90px;
    margin-right:20px;
}
.judul{
    flex:1;
    text-align:center;
}
.judul h2{
    font-size:22px;
}

.judul h3{
    font-size:19px;
    margin-top:5px;
}

.judul p{
    font-size:13px;
    margin-top:5px;
}

.info{
    margin:20px 0;
    font-size:14px;
}

table{
    width:100%;
    border-collapse:collapse;
    font-size:12px;
}

table th{
    background:#0F766E;
    color:#fff;
    border:1px solid #000;
    padding:8px;
}

table td{
    border:1px solid #000;
    padding:6px;
    text-align:center;
}

.statusLayak{
    color:#0f766e;
    font-weight:bold;
}

.statusTidak{
    color:#dc2626;
    font-weight:bold;
}

.rekap{
    width:320px;
    margin-top:25px;
}

.rekap td{
    border:none;
    text-align:left;
    padding:4px;
}

.ttd{
    width:300px;
    float:right;
    text-align:center;
    margin-top:60px;
    font-size:14px;
}

.ttd .nama{
    margin-top:80px;
    font-weight:bold;
    text-decoration:underline;
}

@media print{

    @page{
        size:A4 landscape;
        margin:15mm;
    }

}

</style>

</head>

<body>

<div class="kop">

    <!-- Ganti logo jika ada -->
    <img src="../assets/img/bansos.png" class="logo">

    <div class="judul">

        <h2>DINAS SOSIAL</h2>

        <h3>LAPORAN HASIL CLUSTERING</h3>

        <h3>METODE K-MEANS</h3>

        <p>
            Sistem Pendukung Keputusan Penentuan Penerima Bantuan Sosial
        </p>

    </div>

</div>

<div class="info">

<b>Tanggal Cetak :</b>
<?= date('d F Y') ?>

<br>

<b>Total Data :</b>
<?= $totalData ?> Orang

</div>

<table>

<thead>

<tr>

<th>No</th>

<th>NIK</th>

<th>Nama</th>

<th>Pendapatan</th>

<th>Tanggungan</th>

<th>Cluster</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php
$no=1;
while($row=mysqli_fetch_assoc($query)){
?>
<tr>

    <td><?= $no++ ?></td>

    <td>
        <?= htmlspecialchars($row['nik']) ?>
    </td>

    <td style="text-align:left">
        <?= htmlspecialchars($row['nama']) ?>
    </td>

    <td>
        Rp <?= number_format($row['pendapatan'],0,",",".") ?>
    </td>

    <td>
        <?= $row['jumlah_tanggungan'] ?>
    </td>

    <td>

        <?php if($row['cluster']=="C1"){ ?>

            <strong>C1</strong>

        <?php }else{ ?>

            <strong>C2</strong>

        <?php } ?>

    </td>

    <td>

        <?php if($row['status_kelayakan']=="Layak Menerima Bantuan"){ ?>

            <span class="statusLayak">
                Layak Menerima Bantuan
            </span>

        <?php }else{ ?>

            <span class="statusTidak">
                Tidak Layak Menerima Bantuan
            </span>

        <?php } ?>

    </td>

</tr>

<?php } ?>

</tbody>

</table>

<br><br>

<table class="rekap">

<tr>

<td width="180">
Jumlah Data
</td>

<td>: <?= $totalData ?> Orang</td>

</tr>

<tr>

<td>
Cluster C1
</td>

<td>: <?= $c1['total'] ?> Orang</td>

</tr>

<tr>

<td>
Cluster C2
</td>

<td>: <?= $c2['total'] ?> Orang</td>

</tr>

<tr>

<td>
Layak Menerima Bantuan
</td>

<td>: <?= $layak['total'] ?> Orang</td>

</tr>

<tr>

<td>
Tidak Layak Menerima Bantuan
</td>

<td>: <?= $tidak['total'] ?> Orang</td>

</tr>

</table>
<div class="ttd">

    Bukittinggi, <?= date('d F Y'); ?>

    <br><br>

    Mengetahui,

    <br>

    Administrator

    <br><br><br><br><br>

    <div class="nama">
        _______________________
    </div>

</div>

<script>

window.onload = function(){

    window.print();

}

</script>

</body>
</html>