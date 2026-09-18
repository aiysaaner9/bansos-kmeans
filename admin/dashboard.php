<?php
require_once "../includes/session.php";
require_once __DIR__ . "/../config/koneksi.php";
// =======================
// FUNGSI TOTAL DATA
// =======================
function getTotal($conn, $sql)
{
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        return 0;
    }
    $row = mysqli_fetch_assoc($result);
    return (int)$row['total'];
}
// =======================
// TOTAL DATA
// =======================
$totalCalon = getTotal(
    $conn,
    "SELECT COUNT(*) AS total FROM tbl_calon_penerima"
);
$totalAdmin = getTotal(
    $conn,
    "SELECT COUNT(*) AS total FROM tbl_admin"
);
$totalLayak = getTotal(
    $conn,
    "SELECT COUNT(*) AS total
    FROM tbl_laporan_hasil
    WHERE status_kelayakan='Layak Menerima Bantuan'"
);
$totalTidakLayak = getTotal(
    $conn,
    "SELECT COUNT(*) AS total
    FROM tbl_laporan_hasil
    WHERE status_kelayakan='Tidak Layak Menerima Bantuan'"
);
$totalC1 = getTotal(
    $conn,
    "SELECT COUNT(*) AS total
    FROM tbl_laporan_hasil
    WHERE cluster='C1'"
);
$totalC2 = getTotal(
    $conn,
    "SELECT COUNT(*) AS total
    FROM tbl_laporan_hasil
    WHERE cluster='C2'"
);
include "../includes/header.php";
include "../includes/sidebar.php";
?>
<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="title">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </h3>
    </div>
    <div class="welcome-box">
        <div>
            <h4>
                Selamat Datang,
                <b><?= htmlspecialchars($_SESSION['nama']) ?></b> 👋
            </h4>
            <p>
                Sistem Pendukung Keputusan Penentuan Penerima Bantuan Sosial
                Menggunakan Algoritma <b>K-Means Clustering</b>.
            </p>
        </div>
        <div class="welcome-icon">
            <i class="fa-solid fa-chart-column"></i>
        </div>
    </div>
    <div class="row mt-4">

        <!-- Total Calon -->
        <div class="col-lg-4 col-md-6 mb-4">

            <div class="stat-card">

                <div class="icon bg1">
                    <i class="fa-solid fa-users"></i>
                </div>

                <div>

                    <h2><?= $totalCalon ?></h2>

                    <p>Total Calon Penerima</p>

                </div>

            </div>

        </div>

        <!-- Total Admin -->
        <div class="col-lg-4 col-md-6 mb-4">

            <div class="stat-card">

                <div class="icon bg2">
                    <i class="fa-solid fa-user-shield"></i>
                </div>

                <div>

                    <h2><?= $totalAdmin ?></h2>

                    <p>Total Admin</p>

                </div>

            </div>

        </div>

        <!-- Cluster C1 -->
        <div class="col-lg-4 col-md-6 mb-4">

            <div class="stat-card">

                <div class="icon bg3">
                    <i class="fa-solid fa-layer-group"></i>
                </div>

                <div>

                    <h2><?= $totalC1 ?></h2>

                    <p>Cluster C1</p>

                </div>

            </div>

        </div>
                <!-- Cluster C2 -->
        <div class="col-lg-4 col-md-6 mb-4">

            <div class="stat-card">

                <div class="icon bg4">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>

                <div>

                    <h2><?= $totalC2 ?></h2>

                    <p>Cluster C2</p>

                </div>

            </div>

        </div>

        <!-- Layak -->
        <div class="col-lg-4 col-md-6 mb-4">

            <div class="stat-card">

                <div class="icon bg5">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div>

                    <h2><?= $totalLayak ?></h2>

                    <p>Penerima Layak Menerima Bantuan</p>

                </div>

            </div>

        </div>

        <!-- Tidak Layak -->
        <div class="col-lg-4 col-md-6 mb-4">

            <div class="stat-card">

                <div class="icon bg6">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>

                <div>

                    <h2><?= $totalTidakLayak ?></h2>

                    <p>Tidak Layak Menerima Bantuan</p>

                </div>

            </div>

        </div>

    </div>

    <!-- Informasi Sistem -->
    <div class="card-custom mt-3">

        <h5 class="mb-3">
            <i class="fa-solid fa-circle-info"></i>
            Informasi Sistem
        </h5>

        <p class="mb-2">
            Sistem Pendukung Keputusan ini digunakan untuk membantu proses
            penentuan calon penerima bantuan sosial menggunakan metode
            <strong>K-Means Clustering</strong>.
        </p>

        <p class="mb-0">
            Melalui sistem ini, admin dapat mengelola data calon penerima,
            melakukan proses clustering, melihat hasil analisis, serta
            mencetak laporan hasil penentuan penerima bantuan sosial.
        </p>

    </div>

</div>

<style>

.title{
    color:#134E4A;
    font-weight:700;
}

.welcome-box{
    background:linear-gradient(135deg,#0F766E,#134E4A);
    color:#fff;
    border-radius:20px;
    padding:30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 10px 30px rgba(0,0,0,.12);
}

.welcome-box h4{
    font-weight:700;
    margin-bottom:10px;
}

.welcome-box p{
    margin:0;
    opacity:.95;
}

.welcome-icon{
    font-size:70px;
    opacity:.25;
}

.stat-card{
    background:#fff;
    border-radius:20px;
    padding:22px;
    display:flex;
    align-items:center;
    gap:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    transition:.3s;
    height:100%;
}

.stat-card:hover{
    transform:translateY(-6px);
    box-shadow:0 15px 35px rgba(0,0,0,.12);
}

.stat-card .icon{
    width:70px;
    height:70px;
    border-radius:18px;
    display:flex;
    justify-content:center;
    align-items:center;
    color:#fff;
    font-size:28px;
}

.stat-card h2{
    margin:0;
    font-size:30px;
    font-weight:700;
    color:#134E4A;
}

.stat-card p{
    margin:4px 0 0;
    color:#666;
    font-size:15px;
}
.bg1{
    background:#0F766E;
}

.bg2{
    background:#2563EB;
}

.bg3{
    background:#7C3AED;
}

.bg4{
    background:#F59E0B;
}

.bg5{
    background:#10B981;
}

.bg6{
    background:#EF4444;
}

.card-custom{
    background:#fff;
    border-radius:20px;
    padding:25px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.card-custom h5{
    color:#134E4A;
    font-weight:700;
}

.card-custom p{
    color:#555;
    line-height:1.8;
}

@media(max-width:768px){

    .welcome-box{
        flex-direction:column;
        text-align:center;
        gap:20px;
    }

    .welcome-icon{
        font-size:50px;
    }

    .stat-card{
        text-align:center;
        flex-direction:column;
    }

}
</style>

<?php include "../includes/footer.php"; ?>