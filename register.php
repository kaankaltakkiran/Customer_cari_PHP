<?php
$activePage = "register";
?>
<!-- Kullanıcı üye bilgilerini veri tabanına kaydetme -->
<?php
if (isset($_POST['form_email'])) {
    //!Hata mesajlarını göstermek için boş bir dizi
    $errors = array();

    require_once 'db.php';
    $name = $_POST['form_name'];
    $email = $_POST['form_email'];
    $gender = $_POST['form_gender'];
    $password = $_POST['form_password'];
/*  Şifrele hashleme */
    $password = password_hash($password, PASSWORD_DEFAULT);

    //?Kullanıcı var mı yok mu kontrol etme
    $sql = "SELECT * FROM users WHERE useremail = :form_email";
    $SORGU = $DB->prepare($sql);
    $SORGU->bindParam(':form_email', $email);
    $SORGU->execute();
    $isUser = $SORGU->fetch(PDO::FETCH_ASSOC);
    /*  echo '<pre>';
    print_r($kaans);
    die(); */
    //!Eğer kullanıc üye olmuşsa  hata ver
    if ($isUser) {
        $errors[] = "This email is already registered";

        //!Eğer kullanıcı yoksa kaydet
    } else {
        $sql = "INSERT INTO users (username,useremail,usergender,userpassword) VALUES (:form_name,:form_email,:form_gender,'$password')";
        $SORGU = $DB->prepare($sql);
        $SORGU->bindParam(':form_name', $name);
        $SORGU->bindParam(':form_email', $email);
        $SORGU->bindParam(':form_gender', $gender);

        $SORGU->execute();
        //!Kayıt başarılıysa login sayfasına yönlendir
        header("location: login.php");
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="icon" type="image/x-icon" href="./Public/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  </head>
  <body>
    <?php
require_once 'navbar.php';
?>
    <div class="container">
  <div class="row justify-content-center mt-3">
  <div class="col-6">
  <!--   İşlemden sonra login sayfasına yönlendirme -->
<form method="POST">
<h1 class="text-center text-danger">Register</h1>
<?php
//! Hata mesajlarını göster
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo '
    <div class="container">
<div class="auto-close alert mt-3 text-center alert-danger alert-dismissible fade show" role="alert">
' . $error . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
';
    }
}
?>
<div class="form-floating mb-3">
  <input type="text" name="form_name" class="form-control"required>
  <label>Name</label>
</div>
  <div class="form-floating mb-3">
  <input type="email" name="form_email" class="form-control"required>
  <label>Email</label>
</div>
<div class="input-group mb-3  input-group-lg">
  <input type="password"  name="form_password" class="form-control" id="password" placeholder="Password"required>
  <span class="input-group-text bg-transparent"><i id="togglePassword" class="bi bi-eye-slash"></i></span>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="form_gender" value="Male" required >
  <label class="form-check-label" >
  Male
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="form_gender" value="Female" required>
  <label class="form-check-label" >
  Female
  </label>
</div>

                  <button type="submit" name="submit" class="btn btn-primary mt-1">Register</button>
     </form>
     </div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./Public/js/hideShow.js"></script>
    <script src="./Public/js/autoCloseAlert.js"></script>
  </body>
</html>
