<?php
$pageTitle = "Beranda";
include "includes/header.php";
?>
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <!-- Tulisan -->
            <div class="col-lg-6">
                <span class="badge hero-badge">
                    Sistem Pendukung Keputusan
                </span>
                <h1 class="hero-title mt-3">
                    Penentuan Penerima
                    <br>
                    <span>Bantuan Sosial</span>
                </h1>
                <p class="hero-text mt-4">
                    Selamat datang di Sistem Pendukung Keputusan Penentuan
                    Penerima Bantuan Sosial.
                    Website ini menyediakan informasi mengenai program
                    bantuan sosial yang dikelola oleh Dinas Sosial serta
                    membantu proses penentuan calon penerima bantuan
                    secara objektif berdasarkan kriteria yang telah
                    ditentukan.
                </p>
                <div class="mt-4">
                    <a href="#tentang" class="btn btn-pelajari">
                        <i class="fa-solid fa-circle-info"></i>
                        Pelajari Lebih Lanjut
                    </a>
                    <a href="auth/login.php" class="btn btn-login">
                        <i class="fa-solid fa-user-lock"></i>
                        Login Admin
                    </a>
                </div>
            </div>
            <!-- Gambar -->
            <div class="col-lg-6 text-center">
                <img src="assets/img/bansos.png"
                     class="img-fluid hero-image">
            </div>
        </div>
    </div>
</div>
<!-- ========================= -->
<section id="tentang" class="py-5">
<div class="container">
    <div class="text-center mb-5">
        <h2 class="section-title">
            Tentang Sistem
        </h2>
        <p class="section-subtitle">
            Sistem informasi yang membantu masyarakat memperoleh informasi
            mengenai bantuan sosial secara mudah, transparan, dan akurat.
        </p>
    </div>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card-custom h-100">
                <div class="icon-box">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h4>
                    Data Penerima
                </h4>
                <p>
                    Menyajikan informasi mengenai proses pendataan calon
                    penerima bantuan sosial secara tertib dan terstruktur.
                </p>
            </div>
        </div>
        <div class="col-md-4 mb-4">

            <div class="card-custom h-100">

                <div class="icon-box">

                    <i class="fa-solid fa-scale-balanced"></i>

                </div>

                <h4>

                    Penilaian Objektif

                </h4>

                <p>

                    Penentuan calon penerima dilakukan berdasarkan
                    kriteria yang telah ditentukan sehingga lebih adil
                    dan transparan.

                </p>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="card-custom h-100">

                <div class="icon-box">

                    <i class="fa-solid fa-shield-heart"></i>

                </div>

                <h4>

                    Pelayanan Masyarakat

                </h4>

                <p>

                    Memberikan akses informasi kepada masyarakat mengenai
                    program bantuan sosial dan proses penyalurannya.

                </p>

            </div>

        </div>

    </div>

</div>

</section>
<!-- ========================= -->
<!-- Jenis Bantuan Sosial -->
<!-- ========================= -->

<section class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="section-title">
                Jenis Bantuan Sosial
            </h2>

            <p class="section-subtitle">
                Program bantuan sosial yang dikelola oleh pemerintah untuk meningkatkan kesejahteraan masyarakat.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-lg-4">

                <div class="card-custom h-100">

                    <div class="icon-box">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>

                    <h4>Program Keluarga Harapan (PKH)</h4>

                    <p>
                        Bantuan sosial bersyarat yang diberikan kepada keluarga
                        miskin yang memenuhi kriteria sesuai ketentuan pemerintah.
                    </p>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="card-custom h-100">

                    <div class="icon-box">
                        <i class="fa-solid fa-basket-shopping"></i>
                    </div>

                    <h4>Bantuan Pangan Non Tunai</h4>

                    <p>
                        Bantuan berupa saldo elektronik yang dapat digunakan
                        untuk membeli kebutuhan pangan di e-warong.
                    </p>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="card-custom h-100">

                    <div class="icon-box">
                        <i class="fa-solid fa-box-open"></i>
                    </div>

                    <h4>Bantuan Sembako</h4>

                    <p>
                        Bantuan pemenuhan kebutuhan pokok bagi masyarakat
                        yang memenuhi persyaratan sesuai kebijakan pemerintah.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ========================= -->
<!-- Kriteria Penilaian -->
<!-- ========================= -->

<section class="py-5">

<div class="container">

<div class="text-center mb-5">

<h2 class="section-title">
Kriteria Penilaian
</h2>

<p class="section-subtitle">

Penentuan calon penerima bantuan sosial dilakukan berdasarkan beberapa
kriteria berikut.

</p>

</div>

<div class="row g-4">

<div class="col-md-6 col-lg-4">

<div class="criteria-card">

<i class="fa-solid fa-wallet"></i>

<h5>Pendapatan</h5>

<p>

Semakin rendah pendapatan,
maka semakin tinggi prioritas
untuk menerima bantuan sosial.

</p>

</div>

</div>

<div class="col-md-6 col-lg-4">

<div class="criteria-card">

<i class="fa-solid fa-children"></i>

<h5>Jumlah Tanggungan</h5>

<p>

Jumlah anggota keluarga yang menjadi tanggungan menjadi salah satu
pertimbangan dalam penilaian.

</p>

</div>

</div>

<div class="col-md-6 col-lg-4">

<div class="criteria-card">

<i class="fa-solid fa-bolt"></i>

<h5>Daya Listrik</h5>

<p>

Besarnya daya listrik rumah
digunakan sebagai indikator
kondisi ekonomi keluarga.

</p>

</div>

</div>

<div class="col-md-6 col-lg-6">

<div class="criteria-card">

<i class="fa-solid fa-house"></i>

<h5>Status Rumah</h5>

<p>

Status kepemilikan rumah menjadi
bagian dari proses penilaian
calon penerima bantuan.

</p>

</div>

</div>

<div class="col-md-6 col-lg-6">

<div class="criteria-card">

<i class="fa-solid fa-house-crack"></i>

<h5>Kondisi Rumah</h5>

<p>

Kondisi fisik rumah digunakan
untuk membantu menentukan
tingkat kelayakan penerima.

</p>

</div>

</div>

</div>

</div>

</section>


<!-- ========================= -->
<!-- Alur -->
<!-- ========================= -->

<section class="alur-section">

<div class="container">

<div class="text-center mb-5">

<h2 class="section-title">

Alur Penentuan Penerima

</h2>

<p class="section-subtitle">

Proses penentuan penerima bantuan sosial dilakukan secara bertahap.

</p>

</div>

<div class="row text-center">

<div class="col">

<div class="step-circle">1</div>

<h5>Pendataan</h5>

<p>Pengumpulan data calon penerima.</p>

</div>

<div class="col">

<div class="step-circle">2</div>

<h5>Verifikasi</h5>

<p>Pemeriksaan kelengkapan data.</p>

</div>

<div class="col">

<div class="step-circle">3</div>

<h5>Penilaian</h5>

<p>Perhitungan berdasarkan kriteria.</p>

</div>

<div class="col">

<div class="step-circle">4</div>

<h5>Penetapan</h5>

<p>Penetapan penerima bantuan sosial.</p>

</div>

</div>

</div>

</section>

<!-- ========================= -->
<!-- CEK BANTUAN -->
<!-- ========================= -->

<section class="py-5">

    <div class="container">

        <div class="cek-bantuan">

            <div class="row align-items-center">

                <div class="col-lg-8">

                    <h2>
                        Cek Status Bantuan Sosial Anda
                    </h2>

                    <p>

                        Masyarakat dapat melakukan pengecekan status penerimaan
                        bantuan sosial berdasarkan data yang telah didaftarkan
                        pada sistem.

                    </p>

                </div>

                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">

                    <a href="warga/cek_bantuan.php" class="btn btn-cek">

                        <i class="fa-solid fa-magnifying-glass"></i>

                        Cek Bantuan

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ========================= -->
<!-- WEBSITE RESMI -->
<!-- ========================= -->

<section class="py-5 bg-light">

<div class="container">

<div class="text-center mb-5">

<h2 class="section-title">

Website Resmi

</h2>

<p class="section-subtitle">

Informasi mengenai Bantuan Sosial dapat juga diperoleh melalui website resmi pemerintah.

</p>

</div>

<div class="row">

<div class="col-md-6 mb-4">

<div class="website-card">

<i class="fa-solid fa-globe"></i>

<h4>Kementerian Sosial</h4>

<p>

Kunjungi website resmi Kementerian Sosial Republik Indonesia.

</p>
<a href="https://kemensos.go.id"
   target="_blank"
   class="btn btn-login">
    Kunjungi

</a>

</div>

</div>

<div class="col-md-6 mb-4">

<div class="website-card">

<i class="fa-solid fa-circle-check"></i>

<h4>Cek Bansos Nasional</h4>

<p>

Lakukan pengecekan bantuan sosial melalui layanan resmi Kemensos.

</p>

<a href="https://cekbansos.kemensos.go.id"
target="_blank"
class="btn btn-login">

Cek Sekarang

</a>

</div>

</div>

</div>

</div>

</section>

<style>

body{

    background:#F8FAFC;
    font-family:'Poppins',sans-serif;

}

/* HERO */

.hero-section{

    padding:90px 0;
    background:linear-gradient(135deg,#0F766E,#134E4A);
    color:white;
    overflow:hidden;

}

.hero-title{

    font-size:52px;
    font-weight:700;
    line-height:1.3;

}

.hero-title span{

    color:#CCFBF1;

}

.hero-text{

    font-size:16px;
    line-height:32px;
    color:#E2E8F0;

}

.hero-image{

    max-width:480px;

}

.hero-badge{

    background:#CCFBF1;
    color:#115E59;
    padding:10px 18px;
    border-radius:30px;
    font-size:14px;
    font-weight:600;

}

.btn-pelajari{

    background:#fff;
    color:#115E59;
    border-radius:12px;
    padding:12px 24px;
    font-weight:600;
    margin-right:10px;

}

.btn-pelajari:hover{

    background:#CCFBF1;

}

.btn-login{

    background:#14B8A6;
    color:white;
    border-radius:12px;
    padding:12px 24px;
    font-weight:600;

}

.btn-login:hover{

    background:#0D9488;
    color:white;

}

/* SECTION */

.section-title{

    font-weight:700;
    color:#134E4A;

}

.section-subtitle{

    color:#64748B;

}

.card-custom{

    background:#fff;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    padding:35px;
    transition:.3s;

}

.card-custom:hover{

    transform:translateY(-10px);

}

.icon-box{

    width:70px;
    height:70px;
    border-radius:20px;
    background:#CCFBF1;
    display:flex;
    justify-content:center;
    align-items:center;
    margin-bottom:20px;

}

.icon-box i{

    font-size:30px;
    color:#115E59;

}

.card-custom h4{

    color:#134E4A;
    font-weight:600;
    margin-bottom:15px;

}

.card-custom p{

    color:#64748B;
    line-height:30px;

}
/* =======================
   KRITERIA
========================== */

.criteria-card{
    background:#fff;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    padding:30px;
    text-align:center;
    transition:.3s;
    height:100%;
}

.criteria-card:hover{
    transform:translateY(-8px);
}

.criteria-card i{
    font-size:40px;
    color:#0F766E;
    margin-bottom:20px;
}

.criteria-card h5{
    color:#134E4A;
    font-weight:600;
    margin-bottom:15px;
}

.criteria-card p{
    color:#64748B;
    line-height:28px;
}

/* =======================
   ALUR
========================== */

.alur-section{
    background:#F8FAFC;
    padding:80px 0;
}

.step-circle{
    width:70px;
    height:70px;
    border-radius:50%;
    background:#0F766E;
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    margin:0 auto 20px;
    font-size:24px;
    font-weight:700;
}

/* =======================
   CEK BANTUAN
========================== */

.cek-bantuan{
    background:linear-gradient(135deg,#0F766E,#134E4A);
    border-radius:25px;
    color:white;
    padding:50px;
}

.btn-cek{
    background:white;
    color:#115E59;
    border-radius:12px;
    padding:14px 28px;
    font-weight:600;
}

.btn-cek:hover{
    background:#CCFBF1;
    color:#115E59;
}

/* =======================
   WEBSITE
========================== */

.website-card{
    background:white;
    border-radius:20px;
    padding:35px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    text-align:center;
    height:100%;
}

.website-card i{
    font-size:45px;
    color:#0F766E;
    margin-bottom:20px;
}

/* =======================
   FOOTER
========================== */

.footer{
    background:#134E4A;
    color:white;
    padding:60px 0 20px;
}

.footer h4,
.footer h5{
    color:white;
}

.footer p{
    color:#ddd;
}

.footer ul{
    list-style:none;
    padding:0;
}

.footer ul li{
    margin-bottom:10px;
}

.footer ul li a{
    color:white;
    text-decoration:none;
}

.footer ul li a:hover{
    color:#CCFBF1;
}

.footer hr{
    border-color:rgba(255,255,255,.2);
}

/* ===========================
   RESPONSIVE MOBILE
=========================== */

@media (max-width:768px){

    .hero-section{
        padding:60px 0;
        text-align:center;
    }

    .hero-title{
        font-size:34px;
        line-height:1.3;
    }

    .hero-text{
        font-size:15px;
        line-height:28px;
    }

    .hero-image{
        width:80%;
        margin-top:40px;
    }

    .btn-pelajari,
    .btn-login,
    .btn-cek{
        width:100%;
        margin-bottom:12px;
        margin-right:0;
    }

    .card-custom,
    .criteria-card,
    .website-card{
        padding:25px;
    }

    .alur-section .col{
        margin-bottom:35px;
    }

    .step-circle{
        margin-bottom:15px;
    }

    .cek-bantuan{
        padding:30px 20px;
        text-align:center;
    }

    .footer{
        text-align:center;
    }

    .footer .col-lg-6,
    .footer .col-lg-3{
        margin-bottom:30px;
    }

}
</style>

<!-- ========================= -->
<!-- FOOTER -->
<!-- ========================= -->

<footer class="footer">

<div class="container">

<div class="row">

<div class="col-lg-6">

<h4>

Sistem Pendukung Keputusan
Penentuan Penerima Bantuan Sosial

</h4>

<p>

Website ini bertujuan memberikan informasi kepada masyarakat mengenai
program bantuan sosial serta membantu proses penentuan calon penerima
bantuan secara objektif.

</p>

</div>

<div class="col-lg-3">

<h5>Menu</h5>

<ul>

<li><a href="#">Beranda</a></li>

<li><a href="#tentang">Tentang</a></li>

<li><a href="warga/cek_bantuan.php">Lihat Status Bantuan Sosial</a></li>

<li><a href="auth/login.php">Login Admin</a></li>

</ul>

</div>

<div class="col-lg-3">

<h5>Kontak</h5>

<p>

<i class="fa-solid fa-location-dot"></i>

Jl. Salemba Raya No. 28, Jakarta Pusat

</p>

<p>

<i class="fa-solid fa-envelope"></i>

persuratan@kemsos.go.id

</p>

<p>

<i class="fa-solid fa-phone"></i>

08877 171 171

</p>

</div>

</div>

<hr>

<div class="text-center">

© <?= date('Y'); ?>

Sistem Pendukung Keputusan Penentuan Penerima Bantuan Sosial | Putri Rahmawati (22101152610110).

</div>

</div>

</footer>

<?php include "includes/footer.php"; ?>

