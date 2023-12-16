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
    <title>Transaction</title>
    <link rel="icon" type="image/x-icon" href="./public/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
<?php
require 'navbar.php';
?>
<!-- Transfer geçmişi -->
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
<th>Company Id</th>
<th>Company Name</th>
<th>User Name</th>
<th>Company İban</th>
<th>Company Balance</th>
</tr>
</thead>
<tbody>
</div>
<?php
//!Parayı alacak hesap
//!Parayı alacak kişinin idsini get ile aldım
//? Username için inner join kullanmak zorunda kaldım. Çünkü company tablosunda username yok.
$sql = "SELECT companys.companyid,companys.companyname,companys.companyiban,companys.companybalance,users.username
FROM users
INNER JOIN companys
ON companys.userid=users.userid where companys.companyid = :idCompany";
$SORGU = $DB->prepare($sql);
$SORGU->bindParam(':idCompany', $_GET['idCompany']);
$SORGU->execute();
$takeUsers = $SORGU->fetchAll(PDO::FETCH_ASSOC);
//! Giriş yapan kullanıcı ile şirket sahibi aynı değilse yetkilendirme hatası
if ($_GET['idCompany'] != $takeUsers[0]['companyid']) {
    //!Yetkilendirme hatası durumunda bir hata sayfasına yönlendir veya bir hata mesajı göster
    header("Location: authorizationControl.php");
    exit();
}
foreach ($takeUsers as $takeUser) {
    echo "
<tr>
<th>{$takeUser['companyid']}</th>
<td>{$takeUser['companyname']}</td>
<td>{$takeUser['username']}</td>
<td>{$takeUser['companyiban']}</td>
<td>{$takeUser['companybalance']}₺</td>
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

//!Parayı gönderecek hesap
//!Giriş yapan kullanıcının idsini sesiondan aldım
$sql = "SELECT * FROM companys WHERE userid = :idUser";
$SORGU = $DB->prepare($sql);
$SORGU->bindParam(':idUser', $_SESSION['id']);
$SORGU->execute();
$giveUsers = $SORGU->fetchAll(PDO::FETCH_ASSOC);
/* echo '<pre>';
print_r($giveUsers);
die(); */
//! Giriş yapan kullanıcı ile şirket sahibi aynı değilse yetkilendirme hatası
if ($_GET['idCompany'] == $giveUsers[0]['companyid']) {
    //!Yetkilendirme hatası durumunda bir hata sayfasına yönlendir veya bir hata mesajı göster
    header("Location: authorizationControl.php");
    exit();
}
?>
  <select class="form-select" name="form_selectedaccount"required>
  <option disabled selected value="">Select Account</option>
  <option value="<?php echo $giveUsers[0]['userid']; ?>">
 <?php echo $giveUsers[0]['companyname']; ?> (Balance:
 <?php echo $giveUsers[0]['companybalance']; ?> )
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
              <button type="submit" class="btn btn-success">Send Money</button>
            </div>
</form>
</div>
</div>
</div>
<?php
//?Para alma ve gönderme işlemleri
//!sql1=Alıcı hesap
//!sql2=Gönderici hesap
if (isset($_POST['amount'])) {
    $amount = $_POST['amount'];
    /*   SELECT companys.*,users.*
    FROM users
    INNER JOIN companys
    ON companys.userid=users.userid WHERE users.userid = :idUser */

    //!Alıcı hesap
    //!sql1=Alıcı hesap
    $sql = "SELECT * FROM companys WHERE companyid = :idCompany";
    $SORGU = $DB->prepare($sql);
    $SORGU->bindParam(':idCompany', $_GET['idCompany']);
    $SORGU->execute();
    $sql1 = $SORGU->fetchAll(PDO::FETCH_ASSOC);
    /* echo '<pre>'; print_r($sql1);
    die();  */
    /*
    SELECT companys.*,users.*
    FROM users
    INNER JOIN companys
    ON companys.userid=users.userid WHERE users.userid = :form_selectedaccount */
    //!Gönderici hesap
    //!sql2=Gönderici hesap
    $sql = "SELECT * FROM companys WHERE userid = :form_selectedaccount";
    $SORGU = $DB->prepare($sql);
    $SORGU->bindParam(':form_selectedaccount', $_POST['form_selectedaccount']);
    $SORGU->execute();
    $sql2 = $SORGU->fetchAll(PDO::FETCH_ASSOC);
    /*    echo '<pre>'; print_r($sql2);
    die();  */

    //!Girilen para değeri negatifse
    if (($amount) < 0) {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")'; // showing an alert box.
        echo '</script>';
    }
    //!Para kontrolü sonradan düşünülecek
    /*   // constraint to check insufficient balance.
    else if($amount > $sql2[0]['balance'])
    {
    echo '<script type="text/javascript">';
    echo ' alert("Sorry, Insufficient Balance")';  // showing an alert box.
    echo '</script>';
    } */

    //!Girilen para değeri 0 ise
    else if ($amount == 0) {

        echo "<script type='text/javascript'>";
        echo "alert('Oops! Zero value cannot be transferred')";
        echo "</script>";
    } else {

        //!Gönderici hesaptan para azaltma ve günceleme işlemi
        //!Gönderici hesaptan parayı azalt ve veritabanını güncelle
        $newbalance = $sql2[0]['companybalance'] - $amount;
        $sql = "UPDATE companys set companybalance=$newbalance where userid=:form_selectedaccount";
        $SORGU = $DB->prepare($sql);
        $SORGU->bindParam(':form_selectedaccount', $_POST['form_selectedaccount']);
        $SORGU->execute();

        //!Alıcı hesaptan para arttırma ve günceleme işlemi
        //!Gönderici hesaptan parayı al ve veritabanını güncelle
        $newbalance = $sql1[0]['companybalance'] + $amount;
        $sql = "UPDATE companys set companybalance=$newbalance where companyid=:idCompany";
        $SORGU = $DB->prepare($sql);
        $SORGU->bindParam(':idCompany', $_GET['idCompany']);
        $SORGU->execute();
        //!İşlem geçmişi için
        //?sql1=Alıcı hesap
        //?sql2=Gönderici hesap
        //!Alıcı hesap bilgileri
        $sender = $sql2[0]['companyname'];
        $senderid = $sql2[0]['userid'];
        //!Gönderici hesap bilgileri
        $receiver = $sql1[0]['companyname'];
        $receiverid = $sql1[0]['userid'];
        //!İşlem geçmişi için veritabanına ekleme işlemi
        $sql = "INSERT INTO transactions (sender,senderid,reciver,reciverid,companybalance) VALUES ('$sender','$senderid','$receiver','$receiverid','$amount')";
        $SORGU = $DB->prepare($sql);
        $SORGU->execute();
        $sql3 = "SELECT * FROM transactions";
        $SORGU = $DB->prepare($sql3);
        $SORGU->execute();
        $CEVAP = $SORGU->fetchAll(PDO::FETCH_ASSOC);
        //!Eğer işlem başarılıysa
        if (count($CEVAP) > 0) {
            echo "<script> alert('Transaction Completed');
                                     window.location='selectTransferUser.php?idCompany={$sql1[0]['companyid']}';
                           </script>";
        } else {
            echo '<script type="text/javascript">';
            echo ' alert("Transaction Not Completed")';
            echo '</script>';
        }

        $newbalance = 0;
        $amount = 0;
    }

}
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>


