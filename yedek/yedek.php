<?php
require_once('db.php');
$sql = "SELECT * FROM companys ";
$SORGU = $DB->prepare($sql);
$SORGU->execute();
$companys = $SORGU->fetchAll(PDO::FETCH_ASSOC);
/*  echo $companys[0]['userid'];
echo $_SESSION['id'];  */
foreach ($companys as $company) {
  if ($company['userid'] == $_SESSION['id']) {
echo "
<tr>
<th>{$company['companyid']}</th>
<td>{$company['companyname']}</td>
<td>{$company['companyiban']}</td>
<th>{$company['userid']}</th>
<td>{$_SESSION['adsoyad']}</td>
<td>{$company['companydebt']}</td>
<td>{$company['debtime']}</td>
</tr> 
";
}
}
?>