<?php
@session_start();
require 'loginControl.php';
$activePage="index";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="icon" type="image/x-icon" href="./public/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  </head>
  <body class="bg-light.bg-gradient">
   <!--Ortak navbar -->
  <?php
    require_once('navbar.php');?>
    <?php
   /*  Giriş yapan kullanıcının şirketini göstermek için veritabanından şirket bilgilerini alma */
     require_once('db.php');
$sql = "SELECT * FROM companys WHERE userid = :idUser";
$SORGU = $DB->prepare($sql);
$SORGU->bindParam(':idUser',$_SESSION['id']);
$SORGU->execute();
$companys = $SORGU->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="container">
      <div class="row">
      <h1 class="text-danger text-center mt-3">Customer Cari Version 1</h1>
        <h2 class="text-warning text-center mt-3">Welcome</h2>
        <h3 class="text-info text-center mt-3">Name: <?php echo $_SESSION['adsoyad'] ?></h3>
      </div>
      <!-- Kullanıcı şirket eklemediyse şirket ekleme sayfasını görecek -->
      <?php if ($companys[0]['userid']== null) { ?>
      <div class="card" style="width: 18rem;">
  <img src="./public/img/company.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Company</h5>
    <p class="card-text">Add Company </p>
    <a href="addCompany.php" class="btn btn-primary">Add</a>
  </div>
</div> 
<?php } ?>
  <!-- Kullanıcı şirket eklediyse şirket sayfasını görcek -->
<?php if ($companys[0]['userid']!== null) { ?>
  <h2 class="text-danger text-start mt-3">My Company</h2>
      <div class="card" style="width: 18rem;">
      <a href="company.php?idUser=<?php echo $companys[0]['userid']?>">
  <img src="./public/img/companyPerson.jpg" class="card-img-top" alt="...">
  </a>
  <div class="card-body">
    <h5 class="card-title"><?php echo $companys[0]['companyname']?></h5>
    <p class="card-text"><?php echo $companys[0]['companyaddress']?></p>
    <div class="row">
<!--       Kullanıcı oluşturduğu şirketin bilgilerini görüntüleyebilir ve güncelleyebilir. -->
        <div class="col-6">
    <a href="company.php?idUser=<?php echo $companys[0]['userid']?>" class="btn btn-primary btn-sm">See My Company</a>
    </div>
    <!--Kullanıcı oluşturduğu şirketin üzerinden para işlemleri yapabilir -->
    <div class="col-6">
    <a href="transferAction.php" class="btn btn-danger btn-sm">Balance Transfer Action</a>
    </div>
    </div>
  </div>
</div>
<?php } ?>
    </div>
    <!--Ortak footer -->
    <?php
    require_once('footer.php');?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>