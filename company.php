<?php
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

<div class="container">
<div class="row">
<div class='row justify-content-center text-center'>
  <div class="col-sm-4 col-md-6 col-lg-8">
<h1 class='alert alert-primary mt-2'>My Company</h1>
</div>
</div>
<!-- tablo ile personel listeleme -->
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>CompanyId</th>
<th>CompanyName</th>
<th>CompanyEmail</th>
<th>CompanyPhoneNumber</th>
<th>Companyİban</th>
<th>CompanyAddress</th>
</tr>
</thead>
<tbody>
</div>

<?php
require_once('db.php');
$sql = "SELECT * FROM companys WHERE userid = :id";
$SORGU = $DB->prepare($sql);
$SORGU->bindParam(':id',$_GET['id']);
$SORGU->execute();
$companys = $SORGU->fetchAll(PDO::FETCH_ASSOC);

foreach ($companys as $company) {
echo "
<tr>
<th>{$company['companyid']}</th>
<td>{$company['companyname']}</td>
<td>{$company['companyemail']}</td>
<td>{$company['companynumber']}</td>
<td>{$company['companyiban']}</td>
<td>{$company['companyaddress']}</td>
</tr> 
";
}
?>

</tbody>
</table>
</div>
<a href="index.php" class="btn btn-primary">Back To Home</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>


