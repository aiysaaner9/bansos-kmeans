<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | SPK Bantuan Sosial</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<style>
*{
font-family:Poppins,sans-serif;
}
body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(135deg,#134E4A,#0F766E);
}
.card{
width:950px;
border:none;
border-radius:20px;
overflow:hidden;
box-shadow:0 15px 40px rgba(0,0,0,.2);
}
.left{
background:white;
padding:60px;
}
.right{
background:#F8FAFC;
display:flex;
justify-content:center;
align-items:center;
}
.right i{
font-size:180px;
color:#0F766E;
opacity:.15;
}
.btn-login{
background:#0F766E;
color:white;
border-radius:10px;
padding:12px;
}
.btn-login:hover{
background:#115E59;
color:white;
}
.form-control{
border-radius:10px;
height:48px;
}
h2{
font-weight:700;
}
</style>
</head>
<body>
<div class="card">
<div class="row g-0">
<div class="col-md-6 left">
<h2>SPK Bantuan Sosial</h2>
<p class="text-muted">
Penentuan Penerima Bantuan Sosial
Menggunakan Algoritma K-Means Clustering
</p>
<form action="login_proses.php" method="POST">
<div class="mb-3">
<label>Username</label>
<input
type="text"
name="username"
class="form-control"
required>
</div>
<div class="mb-4">
<label>Password</label>
<input
type="password"
name="password"
class="form-control"
required>
</div>
<button class="btn btn-login w-100">
<i class="fa fa-right-to-bracket"></i>
Login
</button>
</form>
</div>
<div class="col-md-6 right">
<i class="fa-solid fa-chart-column"></i>
</div>
</div>
</div>
</body>
</html>