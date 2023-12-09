<?php
session_start();
require('db.php');
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    

  </head>
  <body>
  <?php require 'navbar.php'; ?>
<div class="container">
<div class="row">
<div class='row justify-content-center text-center'>
  <div class="col-sm-4 col-md-6 col-lg-8">
<h1 class='alert alert-primary mt-2'>Transaction History</h1>
</div>
</div>
<div>
<table id="example" class="table table-bordered table-striped" style="width:100%">
<thead>
<tr>
<th>Process İd</th>
<th>Sender</th>
<th>Reciver</th>
<th>Company Balance</th>
<th>Process Time</th>
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
    $processtime = new DateTime($transaction['processtime']);
    $formattedProcesstime = $processtime->format('d-m-Y H:i:s'); // İstediğiniz formatta tarih ve saat
echo "
<tr>
<th>{$transaction['id']}</th>
<td>{$transaction['sender']}</td>
<td>{$transaction['reciver']}</td>
<td>{$transaction['companybalance']}₺</td>
<td>{$formattedProcesstime}</td>
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

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        dom: 'lBfrtip',
        buttons: {
        buttons: [
          { extend: 'pageLength', className: 'btn-primary'},
            { extend: 'copy', className: 'btn btn-dark'},
            { extend: 'excel', className: 'btn btn-success'},
            { extend: 'csv', className: 'btn btn-danger' },
            { extend: 'pdf', className: 'btn btn-warning' },
            { extend: 'print', className: 'btn btn-secondary' },
            { extend: 'colvis', className: 'btn btn-info' }
        ]
      } 
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
/* buttons: [ 'copy', 'excel','csv', 'pdf', 'colvis' ] */
</script>
  </body>
</html>


