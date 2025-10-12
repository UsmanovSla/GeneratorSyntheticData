<h1>Analýzy pøípravy staveb</h1>
<?php
$st=$_POST['st'];
if (!$st) $st=$_GET['st'];

	$getclanek = mysql_query("SELECT * FROM `Stavba` where id='".$st."' Limit 0,1",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$nazevst=$clanky['nazev'];
		$strukt=$clanky['struktura'];
	}
	$getclanek2 = mysql_query("SELECT * FROM `Struktura` where id='".$strukt."'",$connect2);
	while ($clanky2 = mysql_fetch_array($getclanek2)){
		$nazevs=$clanky2['nazev'];
	}

?>
<h2>Export rozpoètù: Stavba: <?php echo $nazevst." (<em>".$nazevs."</em>)";?></h2>
<?php


$s=$_POST['s'];
if (!$s) $s=$_GET['s'];

$nazev=$_POST['nazev'];
$kod=$_POST['kod'];

$kod_wbs=$_POST['kod_wbs'];


$druh=$_POST['druh'];
$doplnek=$_POST['doplnek'];

$struktura=$_POST['struktura'];
$datum=$_POST['datum'];
$cena=$_POST['cena'];
$doba=$_POST['doba'];

$ids=$_GET['ids'];
if (!$ids) $ids=$_POST['ids'];



// Vymazavani zaznamu
if ($s==9){
	$getclanek = mysql_query("SELECT * FROM `Rozpocet` where id='".$ids."' Limit 0,1",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$nazev=$clanky['nazev'];
	}
	echo "<h1><font color=red>Opravdu chcete vymazat položku:  ".$nazev." ?</font></h1>";

	echo "<b><a href='analyza-rozpocet?s=901&amp;ids=".$ids."&amp;st=".$st."'>ANO</a>&nbsp;&nbsp;<a href='analyza-rozpocet?st=".$st."'>NE</a></b><br><br>";

}


// Vymazavani zaznamu z tabulky MySQL
if ($s==901){
	if ($lock==0) mysql_query("DELETE FROM `Rozpocet` where id='".$ids."'",$connect2);
	echo "<h1><font color=green>Položka byla úspìšnì vymazána z databáze !</font></h1><hr>";
	$s=0;
}


if ($s==601){
	echo "<h2>Krok 1: Import rozpoètu ze souborù: Upload souboru</h2><br>";
	echo "<form method='post'  enctype='multipart/form-data'>";
	echo "<input type='hidden' name='s' value='401'>";
	echo "<input type='hidden' name='st' value='".$st."'>";
	echo "Soubor: <input type='hidden' name='MAX_FILE_SIZE' value='2000000'><input name='file' type='file'><br>";
	echo "Maximální velikost souboru 2 MB. Jen ve formátu systému SEM (viz. <a href='napoveda.php' target='_blank'>nápovìda</a>) !<br>";
	echo "Nahrávání souboru mùže trvat velice dlouho - v závislosti na rychlosti vašeho pøipojení k internetu !<br>";
	echo "<input name='vlozit' type='submit' value='Importovat'>&nbsp;<input type=button onclick='history.back()' value='Zpìt'></form>";
}

if ($s==401){
	if ($lock==0){


	$chyba=0;
	echo "<h2>Krok 2: Import rozpoètu ze souborù systému: Kontrola</h2><br>";
	$MAX_FILE_SIZE=$_POST['MAX_FILE_SIZE'];
	if (!$_FILES) {
	        $chyb = "Soubor se nepodaøilo nahrát na server.\n";
	        $chyba=1;
	}
	if ($_FILES["file"]["size"]>2000000){
	        $chyb = "Soubor je vìtší než 2 Mb.\n";
	        $chyba=1;
	}
	if ($chyba==1){
		echo "<h1><font color=red>Chyba pøi Importu rozpoètu !</font></h1>";
		echo "<h2>".$chyb."</h2>";
		echo "<center><input type=button onclick='history.back()' value='Zpìt'></center>";
	}else{
		$seed = floor(time()/86400);
		srand($seed);
		$time=Time();
		$rand = Rand();
		$filenameee=MD5($time.$rand);
		$cesta="./import/rozpocet-".$filenameee;
		move_uploaded_file($_FILES['file']['tmp_name'],$cesta);
		include ("./convert/convert-rozpocet-1.php");
		echo "<br><form method='post'  enctype='multipart/form-data'>";
		echo "<input type='hidden' name='s' value='402'>";
		echo "<input type='hidden' name='st' value='".$st."'>";
		echo "<input type='hidden' name='soubor' value='".$cesta."'>";
		echo "<input name='vlozit' type='submit' value='Uložit do databáze'>&nbsp;<input type=button onclick='history.back()' value='Zpìt'></form>";
	}

	
	}

}

// Import tabulky - Ukladani do databaze
if ($s==402){
	if ($lock==0){
		$cesta=$_POST['soubor'];
		include ("./convert/convert-rozpocet-2.php");
	}
	echo "<h1><font color=green>Databáze byla úspìšnì obnovìna !</font></h1><hr>";
	$s=0;
}



if ($s==1){

	if ($ids) echo "<br><h2>Editace položky:</h2><hr>";
	else echo "<br><h2>Nová položka:</h2><hr>";





	if ($ids){
		$getclanek = mysql_query("SELECT * FROM `Rozpocet` where id='".$ids."' Limit 0,1",$connect2);
		while ($clanky = mysql_fetch_array($getclanek)){
			$nazev=$clanky['nazev'];
			$kod=$clanky['kod'];
			$kod_wbs=$clanky['kod_wbs'];
			$datum=$clanky['datum'];
			$doba=$clanky['doba'];
			$cena=$clanky['cena'];
			$struktura=$clanky['struktura'];
			$doplnek=$clanky['doplnek'];
			$stavba=$clanky['stavba'];
			$druh=$clanky['druh'];
		}
	}else{
		$datum=time();

		$getclanek = mysql_query("SELECT * FROM `Stavba` where id='".$st."'",$connect2);
		while ($clanky = mysql_fetch_array($getclanek)){
			$struktura=$clanky['id'];
		}


	}


	echo "<form method='post'  enctype='multipart/form-data'>";
	echo "<input type='hidden' name='s' value='2'>";
	echo "<input type='hidden' name='st' value='".$st."'>";
	echo "<input type='hidden' name='struktura' value='".$struktura."'>";
	if ($ids) echo "<input type='hidden' name='ids' value='".$ids."'>";
	echo "Název položky: <input type='text' name='nazev' value='".$nazev."' size='60'><br><br>";
	echo "Kód položky: <input type='text' name='kod' value='".$kod."' size='6'><br><br>";

	echo "Kód WBS: ";
	echo "<select name='kod_wbs'>";
	$getclanek = mysql_query("SELECT * FROM `Struktura_wbs` where Struktura='".$struktura."' order by kod_wbs",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$ids=$clanky['kod_wbs'];
		$nazevs=$ids." ".$clanky['nazev'];
		$uroven=$clanky['uroven'];
		if ($uroven==2) $nazevs="&nbsp;&nbsp;".$nazevs;
		echo "<option value='".$ids."' ";
		if ($ids==$kod_wbs) echo "selected";
		echo ">".$nazevs."</option>";
	}
	echo "</select><br><br>";

	echo "Datum zahájení: <input type='text' name='datum' value='".date("d.m.Y",$datum)."' size='8'><br><br>";

	echo "Cena [Kè]: <input type='text' name='cena' value='".$cena."' size='10'><br><br>";

	echo "Doba trvání [dní]: <input type='text' name='doba' value='".$doba."' size='10'><br><br>";

	echo "Druh nákladù dle kalkulaèního vzorce: <select name='druh'>";
	echo "<option value='1'";if ($druh==1) echo "selected";echo ">H - Pøímý materiál</option>";
	echo "<option value='2'";if ($druh==2) echo "selected";echo ">M - Pøímé mzdy</option>";
	echo "<option value='3'";if ($druh==3) echo "selected";echo ">S - Stroje a zaøízení</option>";
	echo "<option value='4'";if ($druh==4) echo "selected";echo ">OPN - Ostatní pøímé náklady</option>";
	echo "<option value='5'";if ($druh==5) echo "selected";echo ">RV - Režie výrobní</option>";
	echo "<option value='6'";if ($druh==6) echo "selected";echo ">RS - Režie správní</option>";
	echo "<option value='7'";if ($druh==7) echo "selected";echo ">C - Subdodávky</option>";
	echo "<option value='8'";if ($druh==8) echo "selected";echo ">Z - Zisk</option>";
	echo "</select><br><br>";

	echo "Poznámka: <input type='text' name='doplnek' value='".$doplnek."' size='80'><br><br>";

	echo "<input name='vlozit' type='submit' value='Uložit'>&nbsp;<input type=button onclick='history.back()' value='Zpìt'></form>";
}




if ($s==2){
	if ($lock==0) if ($nazev){
		$dd=split("\.",$datum);

		$datumu=mktime(0,0,0,$dd[1],$dd[0],$dd[2]);


		echo "<h1><font color=green>Nová položka byla úspìšnì uložena do databáze !</font></h1><hr>";

		if ($ids) mysql_query("replace INTO `Rozpocet` ( `id`,`kod`,`nazev` ,`kod_wbs`,`datum`,`doba`, `cena` , `struktura` , `druh`,`doplnek`,`stavba`) VALUES ('$ids','$kod','$nazev', '$kod_wbs', '$datumu', '$doba','$cena','$struktura','$druh','$doplnek','$st');",$connect2);
		else mysql_query("INSERT INTO `Rozpocet` (`kod`,`nazev` ,`kod_wbs`,`datum`,`doba`, `cena` , `struktura` , `druh`,`doplnek`,`stavba`) VALUES ('$kod','$nazev', '$kod_wbs', '$datumu', '$doba','$cena','$struktura','$druh','$doplnek','$st');",$connect2);
	}
	$s=0;		
}

if ($s==0){
if ($lock==0) {
?>
<a title="Pøidat novou položku" href="analyza-rozpocet?st=<?php echo $st;?>&amp;s=1"><img src='./skin/button/32/new.png' alt='Pøidat novou položku :' width='32px' height='32px' border='0'></a>
&nbsp;&nbsp;
<?php } ?>
<a href='analyza-rozpocet?st=<?php echo $st;?>&amp;s=601' title='Export èinností'><img src='./skin/button/32/export.png' alt='Export èinností' width='32px' height='32px' border='0'></a>
&nbsp;&nbsp;
<a title="Zpìt na hlavní stránku" href="analyza-export-rozpoctu"><img src='./skin/button/32/sort.png' alt='Zpìt na hlavní stránku' width='32px' height='32px' border='0'></a>
<?php
echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"../forum/".$u_login_logout."\" class=\"vlevo\"  title=\"\" >";
if ($lock==0) echo "<img src='./skin/button/32/opened.png' title='Opened' width='32px' height='32px' border='0'>";
if ($lock==1) echo "<img src='./skin/button/32/locked.png' title='Locked' width='32px' height='32px' border='0'>";
echo "</a>";
?>
<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft" width="50px"><span class='name2'>Kód WBS</span></td>
<td align="center" class="catLeft" width="50px"><span class='name2'>ID / Kód</span></td>
<td align="center" class="catLeft" width="300px"><span class='name2'>Název</span></td>
<td align="center" class="catLeft" width="50px"><span class='name2'>Zahajení</span></td>
<td align="center" class="catLeft" width="50px"><span class='name2'>Trvání,dní</span></td>
<td align="center" class="catLeft" width="50px"><span class='name2'>Cena,Kè</span></td>
<td align="center" class="catLeft" width="150px"><span class='name2'>Druh nákladù</span></td>
<td align="center" class="catLeft" width="150px"><span class='name2'>Pozn.</span></td>
<td align="center" class="catLeft" width="50px"></td>
</tr>
<?php

	$getclanek3 = mysql_query("SELECT * FROM `Struktura_wbs` where struktura='".$strukt."' order by kod_wbs",$connect2);
	while ($clanky3 = mysql_fetch_array($getclanek3)){
	
		$nazevstr=$clanky3['nazev'];
		$urovenstr=$clanky3['uroven'];
		$kod_wbsstr=$clanky3['kod_wbs'];
		if ($urovenstr==1) echo "<tr><td colspan='9' class='row2'>".$kod_wbsstr."&nbsp;&nbsp;<b>".$nazevstr."</b></td></tr>";
		else echo "<tr><td colspan='9' class='row2'>".$kod_wbsstr."&nbsp;&nbsp;&nbsp;&nbsp;<em>".$nazevstr."</em></td></tr>";


	$getclanek = mysql_query("SELECT * FROM `Rozpocet` where kod_wbs='".$kod_wbsstr."' and stavba='".$st."' order by kod_wbs",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id=$clanky['id'];
		$nazev=$clanky['nazev'];
		$kod=$clanky['kod'];
		$kod_wbs=$clanky['kod_wbs'];
		$datum=$clanky['datum'];
		$doba=$clanky['doba'];
		$cena=$clanky['cena'];
		$doplnek=$clanky['doplnek'];
		$druh=$clanky['druh'];



		if ($druh==1) $druhs="H - Pøímý materiál";
		if ($druh==2) $druhs="M - Pøímé mzdy";
		if ($druh==3) $druhs="S - Stroje a zaøízení";
		if ($druh==4) $druhs="OPN - Ostatní pøímé náklady";
		if ($druh==5) $druhs="RV - Režie výrobní";
		if ($druh==6) $druhs="RS - Režie správní";
		if ($druh==7) $druhs="C - Subdodávky";
		if ($druh==8) $druhs="Z - Zisk";
		if ($row==1) $row=2;else $row=1;
		$row=1;

		echo "<tr><td class='row".$row."' align='center'><span class='name2'><b>".$kod_wbs."</b></span></td>";
		echo "<td class='row".$row."'><span class='name2'>".$id."<br>".$kod."</span></b></td>";
		echo "<td class='row".$row."'><b><span class='name2'>".$nazev."</span></b></td>";
		echo "<td class='row".$row."' align='center'><span class='name2'>".date("d.m.Y",$datum)."</span></td>";
		echo "<td class='row".$row."' align='center'><span class='name2'>".$doba."</span></td>";
		echo "<td class='row".$row."'><span class='name2'><b>".str_replace(" ","&nbsp;",number_format($cena,0,'',' '))."</b></span></td>";


		echo "<td class='row".$row."'><span class='name2'>".$druhs."</span></td>";

		if ($doplnek) echo "<td class='row".$row."' align='center'><span class='name2'>".substr($doplnek,0,8)."...</span></td>";
		else echo "<td class='row".$row."' align='center'></td>";

		echo "<td class='row".$row."'>";
		if ($lock==0) echo "<a href='?st=".$st."&amp;s=1&amp;ids=".$id."' title='Editovat položku'><img src='./skin/button/16/edit.png' alt='Editovat položku' width='16px' height='16px' border='0'></a>&nbsp;";	
		if ($lock==0) echo "<a href='?st=".$st."&amp;s=9&amp;ids=".$id."' title='Vymazat položku'><img src='./skin/button/16/delete.png' alt='Vymazat položku' width='16px' height='16px' border='0'></a>";
		echo "</td>";

		echo "</tr>";
	}
	}


	$cel=mysql_result(mysql_query("SELECT count(*) FROM Rozpocet where kod_wbs='' and stavba='".$st."'",$connect2),0);

	if ($cel){
	echo "<tr><td colspan='9' class='row2'><b>Nezatøídìné do struktury WBS</b></td></tr>";

	$getclanek = mysql_query("SELECT * FROM `Rozpocet` where kod_wbs='' and stavba='".$st."' order by kod_wbs",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id=$clanky['id'];
		$nazev=$clanky['nazev'];
		$kod=$clanky['kod'];
		$kod_wbs=$clanky['kod_wbs'];
		$datum=$clanky['datum'];
		$doba=$clanky['doba'];
		$cena=$clanky['cena'];
		$doplnek=$clanky['doplnek'];
		$druh=$clanky['druh'];



		if ($druh==1) $druhs="H - Pøímý materiál";
		if ($druh==2) $druhs="M - Pøímé mzdy";
		if ($druh==3) $druhs="S - Stroje a zaøízení";
		if ($druh==4) $druhs="OPN - Ostatní pøímé náklady";
		if ($druh==5) $druhs="RV - Režie výrobní";
		if ($druh==6) $druhs="RS - Režie správní";
		if ($druh==7) $druhs="C - Subdodávky";
		if ($druh==8) $druhs="Z - Zisk";
		if ($row==1) $row=2;else $row=1;
		$row=1;
		echo "<tr><td class='row".$row."' align='center'><span class='name2'><b>".$kod_wbs."</b></span></td>";
		echo "<td class='row".$row."'><span class='name2'>".$id."<br>".$kod."</span></b></td>";
		echo "<td class='row".$row."'><b><span class='name2'>".$nazev."</span></b></td>";
		echo "<td class='row".$row."' align='center'><span class='name2'>".date("d.m.Y",$datum)."</span></td>";
		echo "<td class='row".$row."' align='center'><span class='name2'>".$doba."</span></td>";
		echo "<td class='row".$row."'><span class='name2'><b>".str_replace(" ","&nbsp;",number_format($cena,0,'',' '))."</b></span></td>";


		echo "<td class='row".$row."'><span class='name2'>".$druhs."</span></td>";

		if ($doplnek) echo "<td class='row".$row."' align='center'><span class='name2'>".substr($doplnek,0,8)."...</span></td>";
		else echo "<td class='row".$row."' align='center'></td>";

		echo "<td class='row".$row."'>";
		if ($lock==0) echo "<a href='?st=".$st."&amp;s=1&amp;ids=".$id."' title='Editovat položku'><img src='./skin/button/16/edit.png' alt='Editovat položku' width='16px' height='16px' border='0'></a>&nbsp;";	
		if ($lock==0) echo "<a href='?st=".$st."&amp;s=9&amp;ids=".$id."' title='Vymazat položku'><img src='./skin/button/16/delete.png' alt='Vymazat položku' width='16px' height='16px' border='0'></a>";
		echo "</td>";

		echo "</tr>";
	}}
?>
</table>
<?php } ?>


