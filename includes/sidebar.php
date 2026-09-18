<?php
$current = basename($_SERVER['PHP_SELF']);
$role = $_SESSION['role'] ?? '';
// BASE URL PROJECT
$base = "/bansos-kmeans";
?>
<style>
.sidebar{
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100vh;
    background: #0f766e;
    padding-top: 20px;
    overflow-y: auto;
    transition: .3s;
    z-index: 9998;
}
.sidebar .logo{
    text-align:center;
    color:white;
    margin-bottom:30px;
}
.sidebar .logo h4{
    margin:0;
    font-weight:700;
}
.sidebar a{
    display:flex;
    align-items:center;
    gap:12px;
    color:white;
    text-decoration:none;
    padding:14px 22px;
    transition:.3s;
}
.sidebar a:hover{
    background:rgba(255,255,255,.15);
}
.sidebar a.active{
    background:white;
    color:#0f766e;
    font-weight:600;
}
.sidebar i{
    width:20px;
    text-align:center;
}
@media (max-width:768px){
    .sidebar{
        transform:translateX(-100%);
    }
    .sidebar.show{
        transform:translateX(0);
    }
}
</style>
<div class="sidebar" id="sidebar">
<div class="logo">
<h4>
<i class="fa-solid fa-hand-holding-heart"></i>
SPK BANSOS
</h4>
</div>
<!-- DASHBOARD -->
<a href="<?= $base ?>/admin/dashboard.php"
class="<?= ($current == 'dashboard.php') ? 'active' : '' ?>">
<i class="fa fa-home"></i>
<span>Dashboard</span>
</a>
<!-- DATA ADMIN SUPERADMIN -->
<?php if($role == 'superadmin'): ?>
<a href="<?= $base ?>/admin/kelola_admin.php"
class="<?= ($current == 'kelola_admin.php') ? 'active' : '' ?>">
<i class="fa fa-user-shield"></i>
<span>Data Admin</span>
</a>
<?php endif; ?>
<!-- DATA CALON -->
<a href="<?= $base ?>/admin/calon_penerima.php"
class="<?= ($current == 'calon_penerima.php') ? 'active' : '' ?>">
<i class="fa fa-users"></i>
<span>Data Calon</span>
</a>
<!-- KONVERSI -->
<a href="<?= $base ?>/admin/konversi.php"
class="<?= ($current == 'konversi.php') ? 'active' : '' ?>">

<i class="fa fa-repeat"></i>

<span>Konversi</span>

</a>

<!-- NORMALISASI -->

<a href="<?= $base ?>/admin/normalisasi.php"
class="<?= ($current == 'normalisasi.php') ? 'active' : '' ?>">

<i class="fa fa-chart-line"></i>

<span>Normalisasi</span>

</a>

<!-- CENTROID -->

<a href="<?= $base ?>/admin/centroid.php"
class="<?= ($current == 'centroid.php') ? 'active' : '' ?>">

<i class="fa fa-location-dot"></i>

<span>Centroid</span>

</a>

<!-- KMEANS -->

<a href="<?= $base ?>/admin/proses_kmeans.php"
   class="<?= ($current == 'proses_kmeans.php') ? 'active' : '' ?>">

    <i class="fa-solid fa-diagram-project"></i>

    <span>K-Means</span>

</a>

<!-- LAPORAN -->

<a href="<?= $base ?>/admin/laporan.php"
class="<?= ($current == 'laporan.php') ? 'active' : '' ?>">

<i class="fa fa-file"></i>

<span>Laporan</span>

</a>

<!-- LOGOUT -->

<a href="<?= $base ?>/auth/logout.php">

<i class="fa fa-right-from-bracket"></i>

<span>Logout</span>

</a>

</div>