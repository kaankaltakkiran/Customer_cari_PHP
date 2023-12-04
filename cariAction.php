<?php
@session_start();
require 'loginControl.php';

require_once('db.php');

if (isset($_POST['form_selectedcompany'])) {
  ///////////////////////////////////////
  /////////////////////////////////////// GÜNCELLEME İŞLEMİ
  ///////////////////////////////////////
  // echo "<pre>"; print_r($_POST);
  // echo "<pre>"; print_r($_GET);
//Update bilgileri alıp kaydetme işlemi
$selectedCompany = $_POST['form_selectedcompany'];
$debt = $_POST['form_debt'];

  $sql = "UPDATE users SET selectcompany = :form_selectedcompany, userdebt = :form_debt, debtime=:reqdate WHERE userid = :userid";
  $SORGU = $DB->prepare($sql);

  $SORGU->bindParam(':form_selectedcompany',$selectedCompany);
  $SORGU->bindParam(':form_debt',$debt);
  $SORGU->bindParam(':reqdate', date("Y-m-d H:i:s"));
  $SORGU->bindParam(':userid',$_SESSION['id']);
  // die(date("H:i:s"));
  $SORGU->execute();  
}


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cari Action Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  <?php
    require_once('navbar.php');
    ?>
    <div class="container">
  <div class='row text-center'>
      <h1 class='alert alert-primary mt-3'>Cari Action Company</h1>
    </div>
    <div class="container">
  <div class="row justify-content-center">

  
    <?php
  if (isset($_POST['form_selectedcompany'])) {
echo '
<div class="alert auto-close text-center alert-success alert-dismissible fade show" role="alert">
Save Cari Action...
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
';
}
?>
<!-- veritabından companyleri çekme -->
<?php
$SORGU = $DB->prepare("SELECT * FROM companys ORDER BY companyname");
$SORGU->execute();
$companys = $SORGU->fetchAll(PDO::FETCH_ASSOC);

$optionCompanys = "";
foreach ($companys as $company) {
  if ($company['userid'] != $_SESSION['id']) {
  $optionCompanys = $optionCompanys . "<option value='{$company['companyid']}'>{$company['companyname']}</option>";
}
}
?>
    <div class="col-6">
    <form method="POST">
  <div class="mb-3">
  <select class="form-select" name="form_selectedcompany">
  <option disabled selected>Select Company Name</option>
  <?php echo $optionCompanys; ?>
</select>
</div>
<div class="form-floating mb-3">
  <input type="text"  class="form-control" disabled value="<?php echo $_SESSION['adsoyad'] ?>">
  <label>Authorized Person</label>
</div>
<div class="input-group mb-3">
  <input type="text" name="form_debt" placeholder="Write Debt " class="form-control">
  <span class="input-group-text">₺</span>
</div>
</div>
</div>
<div class="d-grid col-md-2  mx-auto">
            <!--   <a class="btn btn-primary btn-lg" type="submit"  role="button">Add Person
              <i class="bi bi-send"></i>
              </a> -->
              <button type="submit" class="btn btn-success">Save Cari Action</button>
            </div>
</form>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="autoCloseAlert.js"></script>
  </body>
</html>

 
  
