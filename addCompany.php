<?php
@session_start();
$activePage="index";
require 'loginControl.php';
?>
./bank_2830284.png
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Company</title>
    <link rel="icon" type="image/x-icon" href="./public/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  </head>
  <body>
    <?php
    require_once('navbar.php');
    ?>
    <?php
    //!Şirket ekleme kısmı.
if(isset($_POST['form_companyName'])){
  require_once('db.php');
  $companyName = $_POST['form_companyName'];
  $companyEmail = $_POST['form_companyEmail'];
  $companyNumber = $_POST['form_companyNumber'];
  $companyIban = $_POST['form_CompanyIban'];
  $companyAddress = $_POST['form_companyAddress'];
  $userId=$_SESSION['id'];
  $sql = "INSERT INTO companys (companyname,companyemail,companynumber,companyiban,companyaddress,userid) VALUES (:form_companyName,:form_companyEmail,:form_companyNumber,:form_CompanyIban,:form_companyAddress,'$userId')";
  $SORGU = $DB->prepare($sql);
  $SORGU->bindParam(':form_companyName',$companyName);
  $SORGU->bindParam(':form_companyEmail',$companyEmail);
  $SORGU->bindParam(':form_companyNumber',$companyNumber);
  $SORGU->bindParam(':form_CompanyIban',$companyIban);
  $SORGU->bindParam(':form_companyAddress',$companyAddress);
  $SORGU->execute();
  echo '
  <div class="container">
        <div class="row">
      <div class="auto-close alert mt-3 text-center alert-success alert-dismissible fade show" role="alert">
      Your Company has been saved...
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      </div>
      </div>
    ';
}
?>
    <div class="container">
  <div class="row justify-content-center mt-3">
  <div class="col-6">
<form method="POST">
<h1 class='alert alert-primary text-center'>Add Company</h1>
<div class="form-floating mb-3">
  <input type="text" name="form_companyName" class="form-control"required>
  <label>Company Name</label>
</div>
<!-- Veritabanından çekilecek -->
<div class="form-floating mb-3">
  <input type="text"  class="form-control" disabled value="<?php echo $_SESSION['adsoyad'] ?>">
  <label>Authorized Person</label>
</div>
  <div class="form-floating mb-3">
  <input type="email" name="form_companyEmail" class="form-control"required>
  <label>Company Email</label>
</div>
<div class="form-floating mb-3">
  <input type="tel" name="form_companyNumber" maxlength="11" class="form-control"required>
  <label>Company Phone Number</label>
</div>
<div class="form-floating mb-3">
  <input type="text" name="form_CompanyIban" class="form-control"required>
  <label>Company İban</label>
</div>
<div class="form-floating  mb-3">
  <textarea class="form-control" name="form_companyAddress" placeholder="Write Address" required  id="floatingTextarea"></textarea>
  <label for="floatingTextarea">Company Address</label>
</div>

                  <button type="submit" name="submit" class="btn btn-primary mt-2">Save Company</button>  
                  <div class="text-center">
  <a type="button" href="index.php"  class="btn btn-warning mt-2">Back To Home</a>
</div>   	
     </form> 	
     </form>
     <br>
      <br>
     </div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="autoCloseAlert.js"></script>
  </body>
</html>
