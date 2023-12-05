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
<h1 class='alert alert-primary mt-2'>My Aciton</h1>
</div>
</div>
<?php
//!Silme işlemi
if(isset($_GET['remove'])){
  require('db.php');
  $remove_id = $_GET['remove'];
  $sql = "DELETE FROM companys WHERE companyid = :remove";
  $SORGU = $DB->prepare($sql);
   $SORGU->bindParam(':remove', $remove_id); 
   $SORGU->execute();
   echo '
<div class="alert auto-close text-center alert-success alert-dismissible fade show" role="alert">
Company Deleted...
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
';
  };
?>
<!-- tablo ile personel listeleme -->
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>Company Id</th>
<th>Company Name</th>
<th>Company Iban</th>
<th>User Id</th>
<th>Authorized Person</th>
<th>User Debt</th>
<th>Debt Time</th>
</tr>
</thead>
<tbody>
</div>

<?php
require_once('db.php');
$sql = "SELECT companys.companyid, companys.companyname,companys.companyiban, users.userid,users.username,users.userdebt,users.debtime
FROM companys 
JOIN users ON companys.userid = users.userid  WHERE users.userid= :idUser";
$SORGU = $DB->prepare($sql);
$SORGU->bindParam(':idUser',$_GET['idUser']);
$SORGU->execute();
$companys = $SORGU->fetchAll(PDO::FETCH_ASSOC);
foreach ($companys as $company) {
echo "
<tr>
<th>{$company['companyid']}</th>
<td>{$company['companyname']}</td>
<td>{$company['companyiban']}</td>
<th>{$company['userid']}</th>
<td>{$_SESSION['adsoyad']}</td>
<td>{$company['userdebt']}</td>
<td>{$company['debtime']}</td>
</tr> 
";
}
?>

</tbody>
</table>
</div>
</div>

<a href="index.php" class="btn btn-warning">Back To Home</a>
<div class="text-center">
  <a type="button" href="cariAction.php"  class="btn btn-primary mt-2">Cari Action</a>
</div>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>


