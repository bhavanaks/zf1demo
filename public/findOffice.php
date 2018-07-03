<?php
/**to fil sub office select box based on any changes in office type*/
$country=intval($_GET['office_id']);
$hostname = "localhost";
$database = "newbank";
$username = "newbank";
$password = "new_bank";
$conn = mysql_connect($hostname, $username, $password) or die(mysql_error());
mysql_select_db($database, $conn);

$quer=mysql_query("SELECT * FROM  ourbank_officenames where (parentoffice_id = '$country') && (recordstatus_id = 3 || recordstatus_id = 1)"); 

?>
<select name='subOffice1'  id="subOffice1" class="txt_put">
<option value=''>Select one</option>
<? while($noticia=mysql_fetch_array($quer)) 
					{ ?>

<option value=<?=$noticia["office_id"]?>><?=$noticia["office_name"]?>(<?=$noticia["office_id"]?>)</option>
<? } ?>
</select><b class="star">*</b>