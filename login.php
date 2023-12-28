<?php
$activePage = "login";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="./Public/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  </head>
  <body>
  <?php
require_once 'navbar.php';
?>
<?php
require_once 'db.php';

@session_start();

//! Eğer zaten giriş yapmışsa, index.php'ye yönlendir
if (isset($_SESSION['isLogin'])) {
    // Oturum açmış
    header("location: index.php");
    die();
}
//!form_email post edilmişse
if (isset($_POST['form_email'])) {
    // Form gönderildi
    // 1.DB'na bağlan
    // 2.SQL hazırla ve çalıştır
    // 3.Gelen sonuç 1 satırsa GİRİŞ BAŞARILI değilse, BAŞARISIZ

    //! reCAPTCHA doğrulaması doğrulanmış mı ??
    if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
        echo '
                <div class="container">
            <div class="auto-close alert mt-3 text-center alert-danger alert-dismissible fade show" role="alert">
            reCAPTCHA verification failed, please try again.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            </div>
            ';
    } else {
        $secret = '6LcdnTcpAAAAAL-E3r13ER6Hzraic1HsHl1qLL6D';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        //! Eğer doğrulama başarılı ise
        if ($response->success) {
            //! Eğer boş alan varsa uyarı mesajı
            if (empty($_POST["form_email"]) || empty($_POST["form_password"])) {
                echo '
                <div class="container">
            <div class="auto-close alert mt-3 text-center alert-info alert-dismissible fade show" role="alert">
            Both Fields are required...
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            </div>
            ';
                //! Boş alan yoksa
            } else {
                //! Post edilen verileri değişkenlere atama
                $useremail = $_POST['form_email'];
                $userpassword = $_POST['form_password'];
                //! SQL hazırlama ve çalıştırma
                //! formdan gelen email ile db de varsa
                $sql = "SELECT * FROM users  WHERE useremail = :form_email";
                $SORGU = $DB->prepare($sql);

                $SORGU->bindParam(':form_email', $useremail);

                $SORGU->execute();

                $CEVAP = $SORGU->fetchAll(PDO::FETCH_ASSOC);
                /* var_dump($CEVAP);
                echo "Gelen cevap " .  count($CEVAP) . " adet satırdan oluşuyor";
                die(); */
                //! Gelen sonuç 1 satırsa db de kullanıcı var olduğunu anlarız
                if (count($CEVAP) == 1) {
                    //! Kullanıcının şifresini doğrulama
                    //? posttan gelen ile db den gelen karşılaştırma
                    //? password_verify() fonksiyonu ile
                    if (password_verify($userpassword, $CEVAP[0]['userpassword'])) {
                        //return true;
                        @session_start();
                        $_SESSION['isLogin'] = 1; // Kullanıcı giriş yapmışsa 1 yap
                        $_SESSION['adsoyad'] = $CEVAP[0]['username']; // Kullanıcının adını al
                        $_SESSION['id'] = $CEVAP[0]['userid']; // Kullanıcının ID'sini al
                        $_SESSION['rol'] = $CEVAP[0]['role']; // Kullanıcının ROL'ünü al
                        header("location: index.php");
                        die();
                    } else {
                        //return false;
                        //!Şifreler Eşleşmiyorsa
                        echo '
                  <div class="container">

              <div class="auto-close alert mt-3 text-center alert-danger alert-dismissible fade show" role="alert">
              INCORRECT EMAIL or PASSWORD MATCH!...
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              </div>
              ';

                    }
                } else {
                    //! Kullanıcı yoksa
                    echo '
    <div class="container">
<div class="auto-close alert mt-3 text-center alert-danger alert-dismissible fade show" role="alert">
INCORRECT EMAIL Or PASSWORD!...
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
';
                }
            }
        }
    }
}
?>
    <div class="container">
  <div class="row justify-content-center mt-3">
  <div class="col-6">

<form method="POST">
<h1 class="text-center text-danger">Login</h1>
  <div class="form-floating mb-3">
  <!-- htmlspecialchars kullanıcın girdiği kodları güvenli hale getirir -->
  <input type="email" name="form_email" value="<?php echo isset($_POST['form_email']) ? htmlspecialchars($useremail) : ''; ?>" class="form-control">
  <label>Email</label>
</div>
<!-- <div class="form-floating mb-3">
  <input type="password" name="form_password"class="form-control">
  <label>Password</label>
</div> -->
<div class="input-group mb-3  input-group-lg">
  <input type="password"  name="form_password" class="form-control" id="password" placeholder="Password">
  <span class="input-group-text bg-transparent"><i id="togglePassword" class="bi bi-eye-slash"></i></span>
</div>
<div class="form-floating mb-3">
<div class="g-recaptcha" data-sitekey="6LcdnTcpAAAAAJJcc8mZVAtmOYYMT2URfu4ylB6l"></div>
</div>

                  <button type="submit" name="submit" class="btn btn-primary">Login</button>
     </form>
     </div>
</div>
<div class="row justify-content-end ">
  <div class="col-6 ">
  <h3 class="text-center text-info">User İnformation</h3>
<table class="table  table-striped">
  <thead>
    <tr>
    <th scope="col">#</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>veli@gmail.com</td>
      <td>123</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>ahmet@gmail.com</td>
      <td>123</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>selin@gmail.com</td>
      <td>123</td>
    </tr>
  </tbody>
</table>
</div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./Public/js/hideShow.js"></script>
    <script src="./Public/js/autoCloseAlert.js"></script>
    <script src='https://www.google.com/recaptcha/api.js' async defer ></script>
  </body>
</html>