<?php
session_start();
require_once 'db.php';
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
<div class="row row justify-content-center">
<div class='row justify-content-center text-center'>
  <div class="col-sm-4 col-md-6 col-lg-8">
<h1 class='alert alert-primary mt-2'>Transaction</h1>
</div>
</div>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>UserId</th>
<th>UserName</th>
<th>UserEmail</th>
<th>Total Balance</th>
</tr>
</thead>
<tbody>
</div>

<?php
require_once 'db.php';
$sql = "SELECT * FROM users WHERE userid = :idUser";
$SORGU = $DB->prepare($sql);
$SORGU->bindParam(':idUser', $_GET['idUser']);
$SORGU->execute();
$users = $SORGU->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    echo "
<tr>
<th>{$user['userid']}</th>
<td>{$user['username']}</td>
<td>{$user['useremail']}</td>
<td>{$user['balance']}</td>
</tr>
";
}
?>
</tbody>
</table>
</div>
</div>

<div class="container mt-3">
<div class="row">
<div class="col-6">
    <form method="POST">
  <div class="mb-3">
  <?php
require_once 'db.php';
$sql = "SELECT * FROM users WHERE userid = :idUser";
$SORGU = $DB->prepare($sql);
$SORGU->bindParam(':idUser', $_SESSION['id']);
$SORGU->execute();
$userss = $SORGU->fetchAll(PDO::FETCH_ASSOC);
/* echo '<pre>'; print_r($userss);
die(); */
?>
  <select class="form-select" name="form_selectedaccount"required>
  <option disabled selected value="">Select Account</option>
  <option value="<?php echo $userss[0]['userid']; ?>">
 <?php echo $userss[0]['username']; ?> (Balance:
 <?php echo $userss[0]['balance']; ?> )
  </option>
</select>
</div>
</div>
<div class="col-6">
    <form method="POST">
<div class="input-group mb-3">
  <input type="number" name="amount" placeholder="Write Amount" required class="form-control">
  <span class="input-group-text">₺</span>
</div>
</div>
</div>
<div class="d-grid col-md-2  mx-auto">
            <!--   <a class="btn btn-primary btn-lg" type="submit"  role="button">Add Person
              <i class="bi bi-send"></i>
              </a> -->
              <button type="submit" class="btn btn-success">Transfer Amount</button>
            </div>
</form>
</div>
</div>
</div>
<?php
if (isset($_POST['amount'])) {
    $amount = $_POST['amount'];
    //para gelecek hesap
    //!sorun gönderici alıcı sorunu
    $sql = "SELECT * FROM users WHERE userid = :idUser";
    $SORGU = $DB->prepare($sql);
    $SORGU->bindParam(':idUser', $_GET['idUser']);
    $SORGU->execute();
    $sql1 = $SORGU->fetchAll(PDO::FETCH_ASSOC);
    //para gidecek hesap

    $sql = "SELECT * FROM users WHERE userid = :form_selectedaccount";
    $SORGU = $DB->prepare($sql);
    $SORGU->bindParam(':form_selectedaccount', $_POST['form_selectedaccount']);
    $SORGU->execute();
    $sql2 = $SORGU->fetchAll(PDO::FETCH_ASSOC);

    // constraint to check input of negative value by user
    if (($amount) < 0) {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")'; // showing an alert box.
        echo '</script>';
    }

    /*   // constraint to check insufficient balance.
    else if($amount > $sql2[0]['balance'])
    {
    echo '<script type="text/javascript">';
    echo ' alert("Sorry, Insufficient Balance")';  // showing an alert box.
    echo '</script>';
    } */

    // constraint to check zero values
    else if ($amount == 0) {

        echo "<script type='text/javascript'>";
        echo "alert('Oops! Zero value cannot be transferred')";
        echo "</script>";
    } else {

        // deducting amount from sender's account
        $newbalance = $sql2[0]['balance'] - $amount;
        $sql = "UPDATE users set balance=$newbalance where userid=:form_selectedaccount";
        $SORGU = $DB->prepare($sql);
        $SORGU->bindParam(':form_selectedaccount', $_POST['form_selectedaccount']);
        $SORGU->execute();

        // adding amount to reciever's account
        $newbalance = $sql1[0]['balance'] + $amount;
        $sql = "UPDATE users set balance=$newbalance where userid=:idUser";
        $SORGU = $DB->prepare($sql);
        $SORGU->bindParam(':idUser', $_GET['idUser']);
        $SORGU->execute();

        $sender = $sql2[0]['username'];
        $senderid = $sql2[0]['userid'];

        $receiver = $sql1[0]['username'];
        $receiverid = $sql1[0]['userid'];

        $sql = "INSERT INTO transaction (sender,senderid,reciver,reciverid,balance) VALUES ('$sender','$senderid','$receiver','$receiverid','$amount')";
        $SORGU = $DB->prepare($sql);
        /*   bindparam eksik */
        /* $SORGU->bindParam(':form_name',  $name); */
        $SORGU->execute();
        $sql3 = "SELECT * FROM transaction";
        $SORGU = $DB->prepare($sql3);
        $SORGU->execute();
        $CEVAP = $SORGU->fetchAll(PDO::FETCH_ASSOC);
        /*    echo '<pre>'; print_r($userss);
        die(); */
        if (count($CEVAP) > 1) {
            echo "<script> alert('Transaction Completed');
                                     window.location='selecteduserdetail.php?idUser={$sql1[0]['userid']}';
                           </script>";

        }

        $newbalance = 0;
        $amount = 0;
    }

}
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>


