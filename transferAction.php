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
    <title>Transfer Actions</title>
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
<!-- table-responsive -->
<div class="table-responsive">
<table class="table table-bordered table-striped ">
<thead>
<tr>
<th>CompanyId</th>
<th>CompanyName</th>
<th>UserName</th>
<th>CompanyEmail</th>
<th>CompanyNumber</th>
<th>Companyİban</th>
<th>CompanyAddress</th>
<th>Action</th>
</tr>
</thead>
<tbody>
</div>

<?php
require_once('db.php');
$sql = "SELECT companys.companyid,companys.companyname,companys.companyemail,companys.companynumber,companys.companyiban,companys.companyaddress,users.username,users.userid
FROM users 
INNER JOIN companys 
ON companys.userid=users.userid ORDER BY companys.companyid;";
$SORGU = $DB->prepare($sql);
$SORGU->execute();
$users = $SORGU->fetchAll(PDO::FETCH_ASSOC);
/* SELECT * FROM users */

foreach ($users as $user) {
 /*  giriş yapan kullanıcı kendi adını görmesin diye */
  if ($user['userid'] != $_SESSION['id']) {
echo "
<tr>
<th>{$user['companyid']}</th>
<td>{$user['companyname']}</td>
<td>{$user['username']}</td>
<td>{$user['companyemail']}</td>
<td>{$user['companynumber']}</td>
<td>{$user['companyiban']}</td>
<td>{$user['companyaddress']}</td>
<td><a href='selectTransferUser.php?idCompany={$user['companyid']}' class='btn btn-success btn-sm'>Action</a></td>
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


