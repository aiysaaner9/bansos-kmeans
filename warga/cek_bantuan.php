<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once __DIR__ . "/../config/koneksi.php";
$data = null;
$pesan = "";
if(isset($_POST['cek']))
{
    $nik = mysqli_real_escape_string(
        $conn,
        $_POST['nik']
    );
    $query = mysqli_query($conn,"
        SELECT
            cp.nik,
            cp.nama,
            cp.alamat,
            lh.status_kelayakan,
            lh.cluster,
            lh.jarak_c1,
            lh.jarak_c2
        FROM tbl_calon_penerima cp
        LEFT JOIN tbl_laporan_hasil lh
        ON cp.id_calon = lh.id_calon
        WHERE cp.nik='$nik'
        ORDER BY lh.id_laporan DESC
        LIMIT 1
    ");
    if(mysqli_num_rows($query)>0)
    {
        $data = mysqli_fetch_assoc($query);
        if(empty($data['status_kelayakan']))
        {
            $pesan = "Data ditemukan, tetapi hasil seleksi belum tersedia.";
            $data = null;
        }
    }
    else
    {
        $pesan = "Data NIK tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
Cek Status Bantuan
</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
*{
    box-sizing:border-box;
}
body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:#f1f5f9;
}
.wrapper{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:20px;
}
.card-box{
    width:100%;
    max-width:600px;
    background:white;
    padding:35px;
    border-radius:25px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}
.title{
    text-align:center;
    color:#0f766e;
    font-size:28px;
    font-weight:700;
}



.subtitle{

    text-align:center;

    color:#64748b;

    font-size:14px;

    margin-bottom:25px;

}



label{

    font-weight:600;

    color:#334155;

}



.input-nik{

    width:100%;

    padding:14px;

    border-radius:12px;

    border:1px solid #cbd5e1;

    margin-top:8px;

    font-size:15px;

}



.btn-check{


    width:100%;

    margin-top:20px;

    padding:14px;


    background:#0f766e;

    color:white;


    border:none;

    border-radius:12px;


    font-size:16px;

    font-weight:600;


    cursor:pointer;


}



.btn-check:hover{


    background:#115e59;


}



.alert-danger{


    margin-top:20px;

    border-radius:12px;

}





.hasil{


    margin-top:25px;

    background:#ecfeff;

    padding:25px;

    border-radius:18px;


}



.item{

    margin-bottom:15px;

}



.label{

    color:#64748b;

    font-size:13px;

}



.value{

    font-weight:600;

    color:#0f172a;

}



.status{


    display:inline-block;

    padding:10px 18px;

    border-radius:30px;

    font-weight:700;


}



.layak{


    background:#dcfce7;

    color:#166534;


}



.tidak{


    background:#fee2e2;

    color:#991b1b;


}


.footer{

    text-align:center;

    margin-top:25px;

    color:#94a3b8;

    font-size:12px;

}



</style>


</head>



<body>



<div class="wrapper">



<div class="card-box">



<h2 class="title">

Cek Status Bantuan

</h2>



<p class="subtitle">

Masukkan Nomor Induk Kependudukan (NIK) untuk melihat hasil seleksi bantuan.

</p>





<form method="POST">



<label>

Nomor NIK

</label>



<input

type="text"

name="nik"

class="input-nik"

maxlength="16"

placeholder="Contoh: 1376040507120001"

required>



<button

type="submit"

name="cek"

class="btn-check">


🔍 Cek Status Bantuan


</button>



</form>







<?php if($pesan!=""){ ?>


<div class="alert alert-danger">

<?= $pesan ?>

</div>


<?php } ?>


<?php if($data){ ?>



<div class="hasil">



<h5 class="fw-bold mb-4">

📄 Hasil Pencarian

</h5>

<div class="item">

<div class="label">

Nama

</div>

<div class="value">

<?= htmlspecialchars($data['nama']) ?>

</div>

</div>




<div class="item">

<div class="label">

NIK

</div>

<div class="value">

<?= $data['nik'] ?>

</div>

</div>




<div class="item">

<div class="label">

Alamat

</div>

<div class="value">

<?= htmlspecialchars($data['alamat']) ?>

</div>

</div>

<div class="item">


<div class="label">

Status Bantuan

</div>



<br>



<?php if($data['status_kelayakan']=="Layak Menerima Bantuan"){ ?>


<span class="status layak">

✅ LAYAK MENERIMA BANTUAN

</span>



<?php } else { ?>


<span class="status tidak">

❌ TIDAK LAYAK MENERIMA BANTUAN

</span>



<?php } ?>


<?php } ?>


<div class="footer">

Sistem Informasi Seleksi Bantuan Menggunakan K-Means Clustering
</div>
</div>
</div>
</body>
</html>