<?php
require 'loginControl.php';
require_once('db.php');

//!Update işlemi için gerekli bilgileri alıp güncelleme işlemi yapıyoruz.
if (isset($_POST['form_companyName'])) {
  // echo "<pre>"; print_r($_POST);
  // echo "<pre>"; print_r($_GET);
//Update bilgileri alıp kaydetme işlemi
$companyName = $_POST['form_companyName'];
$companyEmail = $_POST['form_companyEmail'];
$companyNumber = $_POST['form_companyNumber'];
$companyIban = $_POST['form_CompanyIban'];
$companyAddress = $_POST['form_companyAddress'];
  $id= $_GET['idCompany'];
  //!Companyidye göre günceleme işlemi yapıyoruz.
  $sql = "UPDATE companys SET companyname = :form_companyName, companyemail = :form_companyEmail, companynumber=:form_companyNumber, companyiban=:form_CompanyIban, companyaddress=:form_companyAddress
   WHERE companyid = :idCompany";
  $SORGU = $DB->prepare($sql);

  $SORGU->bindParam(':form_companyName',$companyName);
  $SORGU->bindParam(':form_companyEmail',$companyEmail);
  $SORGU->bindParam(':form_companyNumber',$companyNumber);
  $SORGU->bindParam(':form_CompanyIban',$companyIban);
  $SORGU->bindParam(':form_companyAddress',$companyAddress);
  $SORGU->bindParam(':idCompany',$id);

  // die(date("H:i:s"));
  $SORGU->execute();  
}

$id= $_GET['idCompany'];
//Seçilen idye göre bilgileri getirme
$sql = "SELECT * FROM companys WHERE companyid = :idCompany";
$SORGU = $DB->prepare($sql);
$SORGU->bindParam(':idCompany', $id);
$SORGU->execute();
$companys = $SORGU->fetchAll(PDO::FETCH_ASSOC);
$company  = $companys[0];
// echo "<pre>"; print_r($companys);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Company</title>
    <link rel="icon" type="image/x-icon" href="./public/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  <div class='row text-center'>
      <h1 class='alert alert-primary mt-3'>Update Company</h1>
    </div>
    <div class="container">
  <div class="row">
<!-- İşlem başarılıysa gerçekleştiyse aşağıdaki mesaj görünecektir. -->
    <?php
  if (isset($_POST['form_companyName'])) {
echo '
<div class="alert auto-close text-center alert-success alert-dismissible fade show" role="alert">
Company Updated...
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
';
}
?>
    <div class="col-6">
      <form method="POST">
  <div class="form-floating mb-3">
  <input type="text" name="form_companyName" class="form-control"value='<?php echo $company['companyname'];?>'>
  <label for="ınputName">Company Name</label>
</div>
<div class="form-floating mb-3">
  <input type="text"  class="form-control" disabled value="<?php echo $_SESSION['adsoyad'] ?>">
  <label>Authorized Person</label>
</div>
<div class="form-floating mb-3">
  <input type="email" name="form_companyEmail" class="form-control" value='<?php echo $company['companyemail']?>'>
  <label for="ınputEmail">Company Email</label>
</div>
</div>
<div class="col-6">
<div class="form-floating mb-3">
  <input type="text" name="form_companyNumber" class="form-control" value='<?php echo $company['companynumber']?>'>
  <label for="ınputDegree">Company Phone Number</label>
</div>
<div class="form-floating mb-3">
  <input type="text" name="form_CompanyIban" class="form-control"value='<?php echo $company['companyiban']?>'>
  <label for="ınputUnit">Company İban</label>
</div>
<div class="form-floating mb-4">
  <input type="text" name="form_companyAddress" class="form-control"  value='<?php echo $company['companyaddress']?>'>
  <label for="ınputNumber">Company Address</label>
</div>

</div>
</div>
<div class="d-grid col-md-4  mx-auto">
            <!--   <a class="btn btn-primary btn-lg" type="submit"  role="button">Add Person
              <i class="bi bi-send"></i>
              </a> -->
              <button type="submit" class="btn btn-success">Update Company</button>
              <a href="company.php?idUser=<?php echo $companys[0]['userid']?>" class="btn btn-primary mt-2">See My Company</a>
            </div>
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="autoCloseAlert.js"></script>
  </body>
</html>

 
  
