<?php

error_reporting(E_ALL);
ini_set('display_errors',1);


require_once "../includes/session.php";
require_once __DIR__ . "/../config/koneksi.php";




/* ============================
   TAMBAH ADMIN
============================ */


if(isset($_POST['tambah']))
{

    $nama=mysqli_real_escape_string(
        $conn,
        $_POST['nama']
    );


    $username=mysqli_real_escape_string(
        $conn,
        $_POST['username']
    );


    $password=password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );


    $role=$_POST['role'];



    $cek=mysqli_query($conn,"
        SELECT id_admin

        FROM tbl_admin

        WHERE username='$username'
    ");



    if(mysqli_num_rows($cek)>0)
    {

        header("Location: kelola_admin.php?error=username");
        exit;

    }




    mysqli_query($conn,"
        INSERT INTO tbl_admin

        (
            nama,
            username,
            password,
            role
        )

        VALUES

        (
            '$nama',
            '$username',
            '$password',
            '$role'
        )

    ");



    header("Location: kelola_admin.php?success=tambah");
    exit;


}





/* ============================
   EDIT ADMIN
============================ */


if(isset($_POST['edit']))
{


$id=$_POST['id_admin'];


$nama=mysqli_real_escape_string(
$conn,
$_POST['nama']
);


$username=mysqli_real_escape_string(
$conn,
$_POST['username']
);


$role=$_POST['role'];




if(!empty($_POST['password']))
{


$password=password_hash(
$_POST['password'],
PASSWORD_DEFAULT
);



mysqli_query($conn,"
UPDATE tbl_admin

SET

nama='$nama',
username='$username',
password='$password',
role='$role'

WHERE id_admin='$id'

");


}
else
{


mysqli_query($conn,"
UPDATE tbl_admin

SET

nama='$nama',
username='$username',
role='$role'

WHERE id_admin='$id'

");


}



header("Location: kelola_admin.php?success=edit");

exit;


}







/* ============================
   HAPUS ADMIN
============================ */


if(isset($_GET['hapus']))
{


$id=$_GET['hapus'];


mysqli_query($conn,"
DELETE FROM tbl_admin

WHERE id_admin='$id'

");


header("Location: kelola_admin.php?success=hapus");

exit;


}







/* ============================
   DATA ADMIN
============================ */


$data=mysqli_query($conn,"
SELECT *

FROM tbl_admin

ORDER BY id_admin DESC
");



$total=mysqli_num_rows($data);



include "../includes/header.php";
include "../includes/sidebar.php";


?>




<div class="content">


<div class="d-flex justify-content-between align-items-center mb-4">


<h3 class="title">

<i class="fa-solid fa-user-shield"></i>

Kelola Admin

</h3>




<button

class="btn btn-tambah"

data-bs-toggle="modal"

data-bs-target="#modalTambah">


<i class="fa fa-plus"></i>

Tambah Admin


</button>



</div>






<div class="card-custom">


<div class="table-responsive">


<table class="table table-bordered">


<thead>


<tr>

<th>No</th>
<th>Nama</th>
<th>Username</th>
<th>Role</th>
<th>Dibuat</th>
<th>Aksi</th>

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

<?= htmlspecialchars($row['nama']) ?>

</td>




<td>

<?= htmlspecialchars($row['username']) ?>

</td>




<td>


<?php if($row['role']=="superadmin"): ?>


<span class="role-admin">

Superadmin

</span>



<?php else: ?>


<span class="role-user">

Stakeholder

</span>



<?php endif; ?>


</td>





<td>


<?php

if(isset($row['created_at']))
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




<td>


<button

class="btn btn-warning btn-sm"

data-bs-toggle="modal"

data-bs-target="#edit<?= $row['id_admin'] ?>">


<i class="fa fa-edit"></i>


</button>





<a

href="?hapus=<?= $row['id_admin'] ?>"

class="btn btn-danger btn-sm"

onclick="return confirm('Hapus admin ini?')">


<i class="fa fa-trash"></i>


</a>



</td>


</tr>






<!-- MODAL EDIT -->


<div class="modal fade"

id="edit<?= $row['id_admin'] ?>">



<div class="modal-dialog">



<div class="modal-content">



<form method="POST">



<div class="modal-header">


<h5 class="modal-title">

Edit Admin

</h5>


<button

type="button"

class="btn-close"

data-bs-dismiss="modal">

</button>


</div>






<div class="modal-body">



<input type="hidden"

name="id_admin"

value="<?= $row['id_admin'] ?>">





<label>

Nama

</label>


<input

type="text"

name="nama"

class="form-control mb-3"

value="<?= htmlspecialchars($row['nama']) ?>"

required>






<label>

Username

</label>


<input

type="text"

name="username"

class="form-control mb-3"

value="<?= htmlspecialchars($row['username']) ?>"

required>






<label>

Password Baru

</label>


<input

type="password"

name="password"

class="form-control mb-3"

placeholder="Kosongkan jika tidak diganti">





<label>

Role

</label>


<select

name="role"

class="form-select">



<option value="superadmin"

<?= $row['role']=="superadmin"?'selected':'' ?>>

Superadmin

</option>



<option value="stakeholder"

<?= $row['role']=="stakeholder"?'selected':'' ?>>

Stakeholder

</option>



</select>




</div>







<div class="modal-footer">


<button

name="edit"

class="btn btn-success">

Simpan

</button>


</div>





</form>


</div>


</div>


</div>





<?php endwhile; ?>





<?php else: ?>



<tr>


<td colspan="6"

class="text-center py-5">


<i class="fa fa-users fa-3x text-secondary"></i>


<br><br>


Belum ada data admin.



</td>


</tr>



<?php endif; ?>



</tbody>


</table>


</div>


</div>







</div>








<!-- MODAL TAMBAH -->


<div class="modal fade"

id="modalTambah">



<div class="modal-dialog">



<div class="modal-content">



<form method="POST">



<div class="modal-header">


<h5 class="modal-title">

Tambah Admin

</h5>


<button

type="button"

class="btn-close"

data-bs-dismiss="modal">

</button>


</div>






<div class="modal-body">



<label>

Nama

</label>


<input

type="text"

name="nama"

class="form-control mb-3"

required>





<label>

Username

</label>


<input

type="text"

name="username"

class="form-control mb-3"

required>






<label>

Password

</label>


<input

type="password"

name="password"

class="form-control mb-3"

required>






<label>

Role

</label>


<select

name="role"

class="form-select">


<option value="stakeholder">

Stakeholder

</option>


<option value="superadmin">

Superadmin

</option>


</select>




</div>






<div class="modal-footer">


<button

name="tambah"

class="btn btn-success">

Simpan

</button>


</div>



</form>



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




.btn-tambah{

background:#0F766E;

color:#fff;

border-radius:12px;

padding:10px 18px;

font-weight:600;

}



.btn-tambah:hover{

background:#115E59;

color:#fff;

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





.role-admin{

background:#DCFCE7;

color:#166534;

padding:7px 12px;

border-radius:20px;

font-weight:600;

font-size:12px;

}




.role-user{

background:#DBEAFE;

color:#1D4ED8;

padding:7px 12px;

border-radius:20px;

font-weight:600;

font-size:12px;

}




.form-control,

.form-select{

border-radius:12px;

}




</style>







<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>







<?php include "../includes/footer.php"; ?>








<?php if(isset($_GET['success'])): ?>


<script>


Swal.fire({

title:"Berhasil!",

text:"Data admin berhasil diproses.",

icon:"success",

confirmButtonColor:"#0f766e"

});


</script>


<?php endif; ?>








<?php if(isset($_GET['error'])): ?>


<script>


Swal.fire({

title:"Gagal!",

text:"Username sudah digunakan.",

icon:"error",

confirmButtonColor:"#dc2626"

});


</script>


<?php endif; ?>