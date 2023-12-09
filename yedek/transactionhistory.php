<?php
session_start();
require_once('db.php');
require 'loginControl.php';
$activePage="history";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transaction History</title>
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
<h1 class='alert alert-primary mt-2'>Transaction History</h1>
</div>
</div>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>İd</th>
<th>Sender</th>
<th>Reciver</th>
<th>Balance</th>
<th>Processtime</th>
</tr>
</thead>
<tbody>
</div>

<?php
require_once('db.php');
$sql = "SELECT * FROM transaction where senderid = :idUser or reciverid = :idUser";
$SORGU = $DB->prepare($sql);
$SORGU->bindParam(':idUser',$_SESSION['id']);
$SORGU->execute();
$transactions = $SORGU->fetchAll(PDO::FETCH_ASSOC);
foreach ($transactions as $transaction) {
echo "
<tr>
<th>{$transaction['id']}</th>
<td>{$transaction['sender']}</td>
<td>{$transaction['reciver']}</td>
<td>{$transaction['balance']}₺</td>
<td>{$transaction['processtime']}</td>
</tr> 
";
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


