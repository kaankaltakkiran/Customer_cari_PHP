<?php
//!Para Gelecek hesap
$sql = "SELECT companys.*,users.*
FROM users 
INNER JOIN companys 
ON companys.userid=users.userid WHERE users.userid = :idUser";
$SORGU = $DB->prepare($sql);
$SORGU->bindParam(':idUser', $_GET['idUser']);
$SORGU->execute();
$users = $SORGU->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    echo "
<tr>
<th>{$user['companyid']}</th>
<td>{$user['companyname']}</td>
<td>{$user['username']}</td>
<td>{$user['companyiban']}</td>
<td>{$user['companybalance']}</td>
</tr>
";
}
?>

<?php
  //!!Para gönderecek hesap
$sql = "SELECT companys.*,users.*
FROM users 
INNER JOIN companys 
ON companys.userid=users.userid WHERE users.userid = :idUser";
$SORGU = $DB->prepare($sql);
$SORGU->bindParam(':idUser',$_SESSION['id']);
$SORGU->execute();
$userss = $SORGU->fetchAll(PDO::FETCH_ASSOC);
/*  echo '<pre>'; print_r($userss);
die();  */
?>