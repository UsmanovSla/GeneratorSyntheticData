<h1>Analýzy pøípravy staveb</h1>
<h2>Editace rozpoètù: Seznam staveb</h2>
<?php

$s=$_POST['s'];
if (!$s) $s=$_GET['s'];

$nazev=$_POST['nazev'];
$kod=$_POST['kod'];
$firma=$_POST['firma'];
$adresa=$_POST['adresa'];
$osoba=$_POST['osoba'];
$struktura=$_POST['struktura'];

$datum=$_POST['datum'];

$cena=$_POST['cena'];
$doba=$_POST['doba'];


$ids=$_GET['ids'];
if (!$ids) $ids=$_POST['ids'];


// Vymazavani zaznamu
if ($s==9){
	$getclanek = mysql_query("SELECT * FROM `Stavba` where id='".$ids."' Limit 0,1",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$nazev=$clanky['nazev'];
	}
	echo "<h1><font color=red>Opravdu chcete vymazat položku:  ".$nazev." ?</font></h1>";

	echo "<b><a href='analyza-export-rozpoctu?s=901&amp;ids=".$ids."'>ANO</a>&nbsp;&nbsp;<a href='analyza-export-rozpoctu'>NE</a></b><br><br>";

}


// Vymazavani zaznamu z tabulky MySQL
if ($s==901){
	if ($lock==0) mysql_query("DELETE FROM `Stavba` where id='".$ids."'",$connect2);
	echo "<h1><font color=green>Položka byla úspìšnì vymazána z databáze !</font></h1><hr>";
	$s=0;
}


if ($s==1){

	if ($ids) echo "<br><h2>Editace stavby:</h2><hr>";
	else echo "<br><h2>Nová stavba:</h2><hr>";





	if ($ids){
		$getclanek = mysql_query("SELECT * FROM `Stavba` where id='".$ids."' Limit 0,1",$connect2);
		while ($clanky = mysql_fetch_array($getclanek)){
			$nazev=$clanky['nazev'];
			$kod=$clanky['kod'];
			$firma=$clanky['firma'];
			$adresa=$clanky['adresa'];
			$osoba=$clanky['osoba'];
			$struktura=$clanky['struktura'];
			$datum=$clanky['datum'];
			$cena=$clanky['cena'];
			$doba=$clanky['doba'];
		}
	}else{
		$datum=time();

		$getclanek = mysql_query("SELECT * FROM `nastaveni` where id='1'",$connect2);
		while ($clanky = mysql_fetch_array($getclanek)){
			$struktura=$clanky['hodnota'];
		}


	}

	echo "<form method='post'  enctype='multipart/form-data'>";
	echo "<input type='hidden' name='s' value='2'>";
	if ($ids) echo "<input type='hidden' name='ids' value='".$ids."'>";
	echo "Název stavby: <input type='text' name='nazev' value='".$nazev."' size='60'><br><br>";
	echo "Kód stavby: <input type='text' name='kod' value='".$kod."' size='10'><br><br>";

	echo "Firma: <input type='text' name='firma' value='".$firma."' size='60'><br><br>";
	echo "Adresa: <input type='text' name='adresa' value='".$adresa."' size='60'><br><br>";
	echo "Osoba: <input type='text' name='osoba' value='".$osoba."' size='30'><br><br>";

	echo "Struktura WBS: <select name='struktura'>";
	$getclanek = mysql_query("SELECT * FROM `Struktura` order by nazev",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$nazevs=$clanky['nazev'];
		$ids=$clanky['id'];
		echo "<option value='".$ids."' ";
		if ($ids==$struktura) echo "selected";
		echo ">".$nazevs."</option>";
	}
	echo "</select><br><br>";

	echo "Datum zahájení: <input type='text' name='datum' value='".date("d.m.Y",$datum)."' size='8'><br><br>";

	echo "Cena díla [Kè]: <input type='text' name='cena' value='".$cena."' size='10'><br><br>";

	echo "Doba výstavby [dní]: <input type='text' name='doba' value='".$doba."' size='10'><br><br>";



	echo "<input name='vlozit' type='submit' value='Uložit'>&nbsp;<input type=button onclick='history.back()' value='Zpìt'></form>";
}


if ($s==2){
	if ($lock==0) if ($nazev){
		$dd=split("\.",$datum);

		$datumu=mktime(0,0,0,$dd[1],$dd[0],$dd[2]);

		echo "<h1><font color=green>Nová stavba byla úspìšnì uložena do databáze !</font></h1><hr>";
		if ($ids) mysql_query("replace INTO `Stavba` ( `id`,`kod`,`nazev` , `firma` , `adresa` , `osoba`,`struktura`,`datum`,`cena`,`doba`) VALUES ('$ids','$kod', '$nazev', '$firma', '$adresa', '$osoba', '$struktura', '$datumu', '$cena', '$doba');",$connect2);
		else mysql_query("INSERT INTO `Stavba` ( `kod`,`nazev` , `firma` , `adresa` , `osoba`,`struktura`,`datum`,`cena`,`doba`) VALUES ('$kod', '$nazev', '$firma', '$adresa', '$osoba', '$struktura', '$datumu', '$cena', '$doba');",$connect2);
	}
	$s=0;		
}




if ($s==0){

if ($lock==0) {
?>
<a title="Pøidat novou stavbu" href="analyza-export-rozpoctu?s=1"><img src='./skin/button/32/new.png' alt='Pøidat novou stavbu :' width='32px' height='32px' border='0'></a>
&nbsp;&nbsp;
<?php } ?>
<a title="Zpìt na hlavní stránku" href="analyza"><img src='./skin/button/32/sort.png' alt='Zpìt na hlavní stránku' width='32px' height='32px' border='0'></a>
<?php
echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"../forum/".$u_login_logout."\" class=\"vlevo\"  title=\"\" >";
if ($lock==0) echo "<img src='./skin/button/32/opened.png' title='Opened' width='32px' height='32px' border='0'>";
if ($lock==1) echo "<img src='./skin/button/32/locked.png' title='Locked' width='32px' height='32px' border='0'>";
echo "</a>";
?>
<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft" width="50px"><span class='name2'>Kód / ID</span></td>
<td align="center" class="catLeft" width="250px"><span class='name2'>Název / Adresa</span></td>
<td align="center" class="catLeft" width="150px"><span class='name2'>Firma / Osoba</span></td>
<td align="center" class="catLeft" width="50px"><span class='name2'>Struktura</span></td>
<td align="center" class="catLeft" width="30px"><span class='name2'>Položek</span></td>
<td align="center" class="catLeft" width="50px"><span class='name2'>Zahajení</span></td>
<td align="center" class="catLeft" width="50px"><span class='name2'>Trvání,dní</span></td>
<td align="center" class="catLeft" width="50px"><span class='name2'>Cena,Kè</span></td>
<td align="center" class="catLeft" width="50px"></td>
</tr>
<?php

		$getclanek = mysql_query("SELECT * FROM `Stavba` order by nazev",$connect2);
		while ($clanky = mysql_fetch_array($getclanek)){
			$id=$clanky['id'];
			$nazev=$clanky['nazev'];
			$kod=$clanky['kod'];
			$firma=$clanky['firma'];
			$adresa=$clanky['adresa'];
			$osoba=$clanky['osoba'];
			$struktura=$clanky['struktura'];
			$datum=$clanky['datum'];
			$cena=$clanky['cena'];
			$doba=$clanky['doba'];


		$polozek=mysql_result(mysql_query("SELECT count(*) FROM Rozpocet where stavba='".$id."'",$connect2),0);


		$getclanek2 = mysql_query("SELECT * FROM `Struktura` where id='".$struktura."'",$connect2);
		while ($clanky2 = mysql_fetch_array($getclanek2)){
			$nazevs=$clanky2['nazev'];
		}

		echo "<tr><td class='row".$row."' align='center'><span class='name2'>".$kod."<br>".$id."</span></td>";
		echo "<td class='row".$row."'><b><span class='name2'>".$nazev."</span></b><br>";
		echo "<span class='name2'>".$adresa."</span></td>";

		echo "<td class='row".$row."'><span class='name2'>".$firma."</span><br>";
		echo "<span class='name2'>".$osoba."</span></td>";



		echo "<td class='row".$row."' align='center'><b><span class='name2'>".substr($nazevs,0,3)."</span></b></td>";

		echo "<td class='row".$row."' align='center'><b><span class='name2'>".$polozek."</span></b></td>";

		echo "<td class='row".$row."' align='center'><span class='name2'>".date("d.m.Y",$datum)."</span></td>";
		echo "<td class='row".$row."' align='center'><span class='name2'>".$doba."</span></td>";
		echo "<td class='row".$row."'><span class='name2'>".str_replace(" ","&nbsp;",number_format($cena,0,'',' '))."</span></td>";



		echo "<td class='row".$row."'>";
		echo "<a href='analyza-rozpocet?st=".$id."' title='Zobrazit položku'><img src='./skin/button/16/view.png' alt='Zobrazit položku' width='16px' height='16px' border='0'></a>&nbsp;";
		if ($lock==0) echo "<a href='?s=1&amp;ids=".$id."' title='Editovat položku'><img src='./skin/button/16/edit.png' alt='Editovat položku' width='16px' height='16px' border='0'></a>&nbsp;";	
		if ($lock==0) echo "<a href='?s=9&amp;ids=".$id."' title='Vymazat položku'><img src='./skin/button/16/delete.png' alt='Vymazat položku' width='16px' height='16px' border='0'></a>";
		echo "</td>";
		echo "</tr>";
	}

?>
</table>
<?php } ?>