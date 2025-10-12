<?php 
$lock = 1;
if (($userid==2)or($jmeno=="Contec")) $lock=0;

echo "<h1>".$titl."</h1>";
function kontrolavl ($promenna){
	$promenna = EregI_Replace("<", "&lt;", $promenna);
	$promenna = EregI_Replace(">", "&gt;", $promenna);
	$promenna = EregI_Replace('"', '&quot;', $promenna);	
//	$promenna=htmlspecialchars($promenna);
//	$promenna=addslashes($promenna);
//	$promenna=quotemeta($promenna);
return $promenna;
}
$stroj=kontrolavl($_GET['stroj']);
if (!$stroj) $stroj=kontrolavl($_POST['stroj']);

$smmm=kontrolavl($_GET['sm']);
$del=kontrolavl($_GET['del']);
$del2=kontrolavl($_POST['del2']);
$new=kontrolavl($_GET['new']);
$new2=kontrolavl($_POST['new2']);
$sid=kontrolavl($_GET['sid']);
$edit=kontrolavl($_GET['edit']);
$edit2=kontrolavl($_POST['edit2']);
?>
<script type="text/javascript">
function vloz () {
return;
}
function vloz(typ) {
var aktualnipopis = "";
if (typ > 0) {vlozeni = typ;return;}
popis = aktualnipopis + vlozeni;
opener.document.f1.pridavne_zarizeni_<?php echo $smmm;?>.value = popis;
opener.document.f1.pridavne_zarizeni_<?php echo $smmm;?>.focus();
}
</script>
<?php
if ($lock==0) echo '<a href="vlozit-pridavne-zarizeni?sm='.$smmm.'&new=1&stroj='.$stroj.'">Pøidat novou položku :</a>';
?>
<?php

if ($lock==0) {
	if ($new2){
		$stroj=kontrolavl($_POST['stroj']);
		$nazev=kontrolavl($_POST['nazev']);
		$oznaceni=kontrolavl($_POST['oznaceni']);
		$jednotka=kontrolavl($_POST['jednotka']);
		$objem=kontrolavl($_POST['objem']);
		$vykon=kontrolavl($_POST['vykon']);
		$cyklus=$vykon*3600/$objem;
		$poznamka=kontrolavl($_POST['poznamka']);
		if ($nazev) {
			mysql_query("insert into optimalizace_pridavna_zarizeni values('','$stroj','$nazev','$oznaceni','$objem','$jednotka','$cyklus','$poznamka','$vykon')",$connect2);
			echo "<h2>Položka byla úspìšnì vložena do databáze!</h2><hr>";
		}
	}
}

if ($new==1){
?>
<form action="vlozit-pridavne-zarizeni?sm=<?php echo $smmm;?>" METHOD="post" ENCTYPE="multipart/form-data">
<input type="hidden" name="new2" value="1">
<input type="hidden" name="stroj" value="<?php echo $stroj;?>">
<table class="forumline">
<tr><td class="catLeft"><font class="name">Název</font></td><td><input type="text" name="nazev"></td></tr>
<tr><td class="catLeft"><font class="name">Oznaèení</font></td><td><input type="text" name="oznaceni"></td></tr>
<tr><td class="catLeft"><font class="name">Mìrná jednotka</font></td><td><input type="text" name="jednotka"></td></tr>
<tr><td class="catLeft"><font class="name">Poèet jednotek</font></td><td><input type="text" name="objem"></td></tr>
<tr><td class="catLeft"><font class="name">Pracovní výkon</font></td><td><input type="text" name="vykon"></td></tr>
<tr><td class="catLeft"><font class="name">Poznámka</font></td><td><input type="text" name="poznamka"></td></tr>
</table>
<INPUT TYPE="submit" VALUE="Vložit záznam">
</form>
<hr>
<?php
}

?>


<?php

if ($lock==0) {
	if ($edit2){
		$sid=kontrolavl($_POST['sid']);
		$nazev=kontrolavl($_POST['nazev']);
		$oznaceni=kontrolavl($_POST['oznaceni']);
		$jednotka=kontrolavl($_POST['jednotka']);
		$objem=kontrolavl($_POST['objem']);
		$vykon=kontrolavl($_POST['vykon']);
		$cyklus=kontrolavl($_POST['cyklus']);
		$poznamka=kontrolavl($_POST['poznamka']);
		if ($sid) {
			mysql_query("update optimalizace_pridavna_zarizeni set nazev='$nazev',oznaceni='$oznaceni',pocet_jednotek='$objem',jednotka='$jednotka',pracovni_cyklus_sek='$cyklus',poznamka='$poznamka',pracovni_vykon_jednotka_hod='$vykon' where id='$sid'",$connect2);
			echo "<h2>Položka byla úspìšnì zmìnena!</h2><hr>";
		}
	}
}

if ($edit==1){

	$getclanek = mysql_query("SELECT * FROM optimalizace_pridavna_zarizeni where id='$sid'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$nazev=$clanky['nazev'];
		$stroj=$clanky['stroj'];
		$objem=$clanky['pocet_jednotek'];
		$jednotka=$clanky['jednotka'];
		$cyklus=$clanky['pracovni_cyklus_sek'];
		$oznaceni=$clanky['oznaceni'];
		$vykon=$clanky['pracovni_vykon_jednotka_hod'];
		$poznamka=$clanky['poznamka'];

	}




?>
<form action="vlozit-pridavne-zarizeni?sm=<?php echo $smmm;?>" METHOD="post" ENCTYPE="multipart/form-data">
<input type="hidden" name="edit2" value="1">
<input type="hidden" name="stroj" value="<?php echo $stroj;?>">
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<table class="forumline">
<tr><td class="catLeft"><font class="name">Název</font></td><td><input type="text" name="nazev" value="<?php echo $nazev;?>"></td></tr>
<tr><td class="catLeft"><font class="name">Oznaèení</font></td><td><input type="text" name="oznaceni" value="<?php echo $oznaceni?>"></td></tr>
<tr><td class="catLeft"><font class="name">Mìrná jednotka</font></td><td><input type="text" name="jednotka" value="<?php echo $jednotka;?>"></td></tr>
<tr><td class="catLeft"><font class="name">Poèet jednotek</font></td><td><input type="text" name="objem" value="<?php echo $objem;?>"></td></tr>
<tr><td class="catLeft"><font class="name">Pracovní výkon</font></td><td><input type="text" name="vykon" value="<?php echo $vykon;?>"></td></tr>
<tr><td class="catLeft"><font class="name">Pracovní cyklus</font></td><td><input type="text" name="cyklus" value="<?php echo $cyklus;?>"></td></tr>
<tr><td class="catLeft"><font class="name">Poznámka</font></td><td><input type="text" name="poznamka" value="<?php echo $poznamka;?>"></td></tr>
</table>
<INPUT TYPE="submit" VALUE="Uložit záznam">
</form>
<hr>
<?php
}

?>



<?php

if ($lock==0) {
	if ($del2){
		$sid=kontrolavl($_POST['sid']);
		if ($sid) {
			mysql_query("delete from optimalizace_pridavna_zarizeni where id='$sid'",$connect2);
			echo "<h2>Položka byla úspìšnì vymazana!</h2><hr>";
		}
	}
}

if ($del==1){


	$getclanek = mysql_query("SELECT * FROM optimalizace_pridavna_zarizeni where id='$sid'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$nazev=$clanky['nazev'];
	}


?>
<form action="vlozit-pridavne-zarizeni?sm=<?php echo $smmm;?>" METHOD="post" ENCTYPE="multipart/form-data">
<input type="hidden" name="del2" value="1">
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<h1>Opravdu chcete vymazat záznam: <?php echo $nazev;?> ?</h1>
<INPUT TYPE="submit" VALUE="Vymazat záznam">
</form>
<hr>
<?php
}

?>

<table class="forumline">
<tr>
<td class="catLeft"><font class="name">ID</font></td>
<td class="catLeft"><font class="name">Název</font></td>
<td class="catLeft"><font class="name">Oznaèení</font></td>
<td class="catLeft"><font class="name">Poèet jednotek</font></td>
<td class="catLeft"><font class="name">Pracovní cyklus</font></td>
<td class="catLeft"><font class="name">Pracovní výkon</font></td>
<td class="catLeft"><font class="name">Poznámka</font></td>
<td class="catLeft"></td>
<?php
if ($lock==0) echo '<td class="catLeft"></td><td class="catLeft"></td>';
?>
</tr>
<?php
$getclanek = mysql_query("SELECT * FROM optimalizace_pridavna_zarizeni where stroj='$stroj' order by pocet_jednotek",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($row==1) $row=2; else $row=1;
		echo '<tr>
		<td class="row$row"><font class="name">'.$clanky['id'].'</font></td>
		<td class="row$row"><font class="name">'.$clanky['nazev'].'</font></td>
		<td class="row$row"><font class="name">'.$clanky['oznaceni'].'</font></td>
		<td class="row$row"><font class="name">'.$clanky['pocet_jednotek'].' '.$clanky['jednotka'].'</font></td>
		<td class="row$row"><font class="name">'.$clanky['pracovni_cyklus_sek'].' sek</font></td>
		<td class="row$row"><font class="name">'.$clanky['pracovni_vykon_jednotka_hod'].' '.$clanky['jednotka'].'/hod</font></td>
		<td class="row$row"><font class="name">'.$clanky['poznamka'].'</font></td>
		<td class="row$row"> <A ONCLICK="vloz(\''.$clanky['id'].'\');" alt=" " HREF="javascript: vloz();javascript:window.close();">Vložit do katalogu</A></td>';
		if ($lock==0) echo '<td class="row$row"> <a href="vlozit-pridavne-zarizeni?sm='.$smmm.'&edit=1&sid='.$clanky['id'].'" target="_blank">Edit</a></td>';
		if ($lock==0) echo '<td class="row$row"> <a href="vlozit-pridavne-zarizeni?sm='.$smmm.'&del=1&sid='.$clanky['id'].'" target="_blank">Del</a></td>';
		echo '</tr>';	
	}
?>
</table>
<a href="javascript:window.close();document.form4.pridavne_zarizeni_<?php echo $smmm;?>.focus();">Zavøít okno</a>