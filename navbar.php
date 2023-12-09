<?php
session_start();

?>
<nav class="navbar navbar-expand-lg bg-primary " data-bs-theme="dark">
  <div class="container-fluid ">
    <a class="navbar-brand " href="index.php">Customer Cari</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav">
      <?php if ($_SESSION['isLogin'] == 1) { ?>
        <li class="nav-item">
          <a class="nav-link  <?= ($activePage == 'index') ? 'active':''; ?>" href="index.php">Home</a>
        </li>
          
<?php
require_once('db.php');
$sql = "SELECT * FROM transactions WHERE senderid=:idUser OR reciverid=:idUser";
$SORGU = $DB->prepare($sql);
$SORGU->bindParam(':idUser',$_SESSION['id']);
$SORGU->execute();
$transactions = $SORGU->fetchAll(PDO::FETCH_ASSOC);
/* echo $_SESSION['id'];
 echo $transactions[0]['senderid']; */
 ?>
       <!--  Eğer kullanıcının işlem geçmişi yoksa gösterme -->
        <?php if ($transactions[0]['senderid'] == $_SESSION['id'] || $transactions[0]['reciverid'] == $_SESSION['id']) { ?>
    <li class="nav-item">
        <a class="nav-link <?= ($activePage == 'history') ? 'active' : ''; ?>" href="processHistory.php">Transaction History</a>
    </li>
<?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
        <?php } ?>
        <?php if ($_SESSION['isLogin'] == 0) { ?>
          <li class="nav-item">
          <a class="nav-link  <?= ($activePage == 'register') ? 'active':''; ?>" href="register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  <?= ($activePage == 'login') ? 'active':''; ?>" href="login.php">Login</a>
        </li>
          <?php } ?>
      </ul>
    </div>
  </div>
</nav>
