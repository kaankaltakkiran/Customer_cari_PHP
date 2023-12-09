<?php
session_start();
require_once('db.php');
require 'loginControl.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tekil Ürün Sayfası</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
<?php
require 'navbar.php';
?>
<div class="container">
<div class="row">
<div class='row justify-content-center text-center'>
  <div class="col-sm-4 col-md-6 col-lg-8">
<h1 class='alert alert-primary mt-2'>Transfer Money</h1>
</div>
</div>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>UserId</th>
<th>UserName</th>
<th>UserEmail</th>
<th>Balance</th>
<th>Action</th>
</tr>
</thead>
<tbody>
</div>

<?php
require_once('db.php');
$sql = "SELECT * FROM users";
$SORGU = $DB->prepare($sql);
$SORGU->execute();
$users = $SORGU->fetchAll(PDO::FETCH_ASSOC);
foreach ($users as $user) {
 /*  giriş yapan kullanıcı kendi adını görmesin diye */
  if ($user['userid'] != $_SESSION['id']) {
echo "
<tr>
<th>{$user['userid']}</th>
<td>{$user['username']}</td>
<td>{$user['useremail']}</td>
<td>{$user['balance']}₺</td>
<td><a href='selecteduserdetail.php?idUser={$user['userid']}' class='btn btn-success btn-sm'>Action</a></td>
</tr> 
";
}
}
?>

</tbody>
</table>
</div>
</div>

<a href="index.php" class="btn btn-warning">Back To Home</a> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>


