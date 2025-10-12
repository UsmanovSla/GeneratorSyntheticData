<h1>Analýzy pøípravy staveb</h1>
<?php


$ids=$_GET['ids'];
if (!$ids) $ids=$_POST['ids'];


if ($ids==0){

?>
<h2>Analýza rozpoètu dle kalkulaèního vzorce: Seznam staveb</h2>
<a title="Zpìt na hlavní stránku" href="analyza"><img src='./skin/button/32/sort.png' alt='Zpìt na hlavní stránku' width='32px' height='32px' border='0'></a>
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
		echo "<td class='row".$row."'><span class='name2'><b>".str_replace(" ","&nbsp;",number_format($cena,0,'',' '))."</b></span></td>";



		echo "<td class='row".$row."' align='center'>";
		echo "<a href='analyza-rozpoctu-vzorec?ids=".$id."' title='Analýza rozpoètu dle kalkulaèního vzorce'><img src='./skin/button/16/view.png' alt='Analýza rozpoètu dle kalkulaèního vzorce' width='16px' height='16px' border='0'></a>";
		echo "</td>";
		echo "</tr>";
	}

?>
</table>
<?php } else{ 


	$getclanek = mysql_query("SELECT * FROM `Stavba` where id='".$ids."'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$nazevst=$clanky['nazev'];
		$cena=$clanky['cena'];
		$strukt=$clanky['struktura'];
		$st=$ids;
	}


	$getclanek3 = mysql_query("SELECT * FROM `Struktura` where id='".$strukt."'",$connect2);
	while ($clanky3 = mysql_fetch_array($getclanek3)){
		$koef1=$clanky3['koef1'];
		$koef2=$clanky3['koef2'];
			$min[1]=$clanky3['min_1'];
			$min[2]=$clanky3['min_2'];
			$min[3]=$clanky3['min_3'];
			$min[4]=$clanky3['min_4'];
			$min[5]=$clanky3['min_5'];
			$min[6]=$clanky3['min_6'];
			$min[7]=$clanky3['min_7'];
			$min[8]=$clanky3['min_8'];

			$max[1]=$clanky3['max_1'];
			$max[2]=$clanky3['max_2'];
			$max[3]=$clanky3['max_3'];
			$max[4]=$clanky3['max_4'];
			$max[5]=$clanky3['max_5'];
			$max[6]=$clanky3['max_6'];
			$max[7]=$clanky3['max_7'];
			$max[8]=$clanky3['max_8'];

	}

	$ii=0;
	$cenap=0;

	$pol=mysql_result(mysql_query("SELECT count(*) FROM `Rozpocet` where  stavba='".$st."'",$connect2),0);
	$pol=ceil($pol*$koef1/100);
	$getclanek = mysql_query("SELECT * FROM `Rozpocet` where  stavba='".$st."' order by cena desc limit 0,$pol",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$cenap=$cenap+$clanky['cena'];
		$pareto[$ii]=$clanky['id'];
		$ii++;
	}

	$koef2skut=$cenap/$cena*100;

	$cenacelkem=0;

?>
<h2>Analýza rozpoètu dle kalkulaèního vzorce: Stavba: <?php echo $nazevst;?>. Cena díla: <?php echo str_replace(" ","&nbsp;",number_format($cena,0,'',' '));?>,-Kè</h2>
<h2>Kontrola Paretova pravidla: <?php if (($koef2skut+5>$koef2)&($koef2skut-5<$koef2)) echo "<img width='24px' height='24px' src='skin/button/ok.png'>"; else echo "<img width='24px' height='24px' src='skin/button/wa.png'>"; ?>&nbsp;/&nbsp;<?php echo $koef1."% položek (".$pol.") tvoøí ".number_format($koef2skut,2,',',' ')."% nákladù (dle zadání: ".$koef2."%)";?></h2>
<?php
if ($lock==0) {
?>
<a title="Editace stavby" href="analyza-export-rozpoctu?s=1&ids=<?php echo $st;?>"><img src='./skin/button/32/import.png' alt='Editace stavby :' width='32px' height='32px' border='0'></a>
&nbsp;&nbsp;
<?php } ?>
<a title="Zpìt na hlavní stránku" href="analyza-rozpoctu-vzorec"><img src='./skin/button/32/sort.png' alt='Zpìt na hlavní stránku' width='32px' height='32px' border='0'></a>
<?php
echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"../forum/".$u_login_logout."\" class=\"vlevo\"  title=\"\" >";
if ($lock==0) echo "<img src='./skin/button/32/opened.png' title='Opened' width='32px' height='32px' border='0'>";
if ($lock==1) echo "<img src='./skin/button/32/locked.png' title='Locked' width='32px' height='32px' border='0'>";
echo "</a>";
?>
<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft" width="50px"><span class='name2'>Kód WBS</span></td>
<td align="center" class="catLeft" width="80px"><span class='name2'>ID / Kód</span></td>
<td align="center" class="catLeft" width="300px"><span class='name2'>Název</span></td>
<td align="center" class="catLeft" width="50px"><span class='name2'>Cena,-Kè</span></td>
<td align="center" class="catLeft" width="100px"><span class='name2'>Podíl nákladù,%</span></td>
<td align="center" class="catLeft" width="50px"></td>
<td align="center" class="catLeft" width="100px"><span class='name2'>Podíl dle zadání,%</span></td>
<td align="center" class="catLeft" width="50px"><span class='name2'>Paretovo pravidlo</span></td>
</tr>
<?php



	for ($druhstr=1;$druhstr<9;$druhstr++){

		if ($druhstr==1) $druhs="H - Pøímý materiál";
		if ($druhstr==2) $druhs="M - Pøímé mzdy";
		if ($druhstr==3) $druhs="S - Stroje a zaøízení";
		if ($druhstr==4) $druhs="OPN - Ostatní pøímé náklady";
		if ($druhstr==5) $druhs="RV - Režie výrobní";
		if ($druhstr==6) $druhs="RS - Režie správní";
		if ($druhstr==7) $druhs="C - Subdodávky";
		if ($druhstr==8) $druhs="Z - Zisk";
	
		$nazevstr=$druhs;
		$urovenstr=1;
		$kod_wbsstr="";

		$cenasekce=0;
		$getclanek = mysql_query("SELECT * FROM `Rozpocet` where druh='".$druhstr."' and stavba='".$st."'",$connect2);
		while ($clanky = mysql_fetch_array($getclanek)){
			$cenasekce=$cenasekce+$clanky['cena'];
		}


		$idse=$clanky3['id'];
		$minx=$min[$druhstr];
		$maxx=$max[$druhstr];

		$koefskutec=$cenasekce/$cena*100;

		if ($urovenstr==1) $row=5;else $row=4;

		if ($koefskutec<($minx-0.1)) $dops="<td class='row".$row."' align='right'><img src='skin/button/wa.png' width='24px' height='24px'></td>";
		else if ($koefskutec>($maxx+0.1)) $dops="<td class='row".$row."' align='right'><img src='skin/button/wa2.png' width='24px' height='24px'></td>";
		else $dops="<td class='row".$row."' align='right'><img src='skin/button/ok.png' width='24px' height='24px'></td>";




		echo "<tr><td class='row".$row."' align='center'><span class='name2'><b>".$kod_wbsstr."</b></span></td>";
		echo "<td class='row".$row."'><span class='name2'>".$idse."</span></b></td>";

		if ($urovenstr==1) echo "<td class='row".$row."'><b>".$nazevstr."</b></td>";
		else echo "<td class='row".$row."'>&nbsp;&nbsp;&nbsp;&nbsp;".$nazevstr."</td>";

		echo "<td class='row".$row."' align='right'><span class='name2'><b>".str_replace(" ","&nbsp;",number_format($cenasekce,0,'',' '))."</b></span></td>";
		echo "<td class='row".$row."' align='right'><span class='name2'><b>".str_replace(" ","&nbsp;",number_format($cenasekce/$cena*100,3,',',' '))." %</b></span></td>";

		echo $dops;

		echo "<td class='row".$row."' align='center'><span class='name2'><em>".$minx."%-".$maxx."%</em></span></td>";

		echo "<td class='row".$row."'></td></tr>";


	$row=0;

	$getclanek = mysql_query("SELECT * FROM `Rozpocet` where druh='".$druhstr."' and stavba='".$st."' order by kod_wbs",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id=$clanky['id'];
		$nazev=$clanky['nazev'];
		$kod=$clanky['kod'];
		$kod_wbs=$clanky['kod_wbs'];
		$datum=$clanky['datum'];
		$doba=$clanky['doba'];
		$cenajed=$clanky['cena'];
		$doplnek=$clanky['doplnek'];
		$druh=$clanky['druh'];


		$cenacelkem=$cenacelkem+$cenajed;

		if ($druh==1) $druhs="H - Pøímý materiál";
		if ($druh==2) $druhs="M - Pøímé mzdy";
		if ($druh==3) $druhs="S - Stroje a zaøízení";
		if ($druh==4) $druhs="OPN - Ostatní pøímé náklady";
		if ($druh==5) $druhs="RV - Režie výrobní";
		if ($druh==6) $druhs="RS - Režie správní";
		if ($druh==7) $druhs="C - Subdodávky";
		if ($druh==8) $druhs="Z - Zisk";
		if ($row==1) $row=2;else $row=1;

		echo "<tr><td class='row".$row."' align='center'><span class='name2'>".$kod_wbs."</span></td>";
		echo "<td class='row".$row."'><span class='name2'>".$id." / ".$kod."</span></td>";
		echo "<td class='row".$row."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='name2'>".$nazev."</span></td>";
		echo "<td class='row".$row."' align='right'><span class='name2'><b>".str_replace(" ","&nbsp;",number_format($cenajed,0,'',' '))."</b></span></td>";
		echo "<td class='row".$row."' align='right'><span class='name2'><b>".str_replace(" ","&nbsp;",number_format($cenajed/$cena*100,3,',',' '))." %</b></span></td>";
		$koefskutec=$cenajed/$cena*100;

		echo "<td class='row".$row."' align='right'></td>";
		echo "<td class='row".$row."' align='center'></td>";


		$paretok=0;for ($i=0;$i<count($pareto);$i++) if ($pareto[$i]==$id) $paretok=1;
		if ($paretok) echo "<td class='row".$row."' align='center'><img src='skin/button/ok.png' width='24px' height='24px'></td>";
		else  echo "<td class='row".$row."' align='center'></td>";


		echo "</tr>";
	}
	}


	$cel=mysql_result(mysql_query("SELECT count(*) FROM Rozpocet where druh='0' and stavba='".$st."'",$connect2),0);

	if ($cel){
	echo "<tr><td colspan='8' class='row2'><hr><b>Nezatøídìné do struktury WBS</b></td></tr>";

	$row=1;

	$getclanek = mysql_query("SELECT * FROM `Rozpocet` where druh='0' and stavba='".$st."' order by kod_wbs",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id=$clanky['id'];
		$nazev=$clanky['nazev'];
		$kod=$clanky['kod'];
		$kod_wbs=$clanky['kod_wbs'];
		$datum=$clanky['datum'];
		$doba=$clanky['doba'];
		$cenajed=$clanky['cena'];
		$doplnek=$clanky['doplnek'];
		$druh=$clanky['druh'];


		$cenacelkem=$cenacelkem+$cenajed;
		if ($druh==1) $druhs="H - Pøímý materiál";
		if ($druh==2) $druhs="M - Pøímé mzdy";
		if ($druh==3) $druhs="S - Stroje a zaøízení";
		if ($druh==4) $druhs="OPN - Ostatní pøímé náklady";
		if ($druh==5) $druhs="RV - Režie výrobní";
		if ($druh==6) $druhs="RS - Režie správní";
		if ($druh==7) $druhs="C - Subdodávky";
		if ($druh==8) $druhs="Z - Zisk";
		if ($row==1) $row=2;else $row=1;
		echo "<tr><td class='row".$row."' align='center'><span class='name2'><b>".$kod_wbs."</b></span></td>";
		echo "<td class='row".$row."'><span class='name2'>".$id." / ".$kod."</span></td>";
		echo "<td class='row".$row."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='name2'>".$nazev."</span></td>";
		echo "<td class='row".$row."' align='right'><span class='name2'><b>".str_replace(" ","&nbsp;",number_format($cenajed,0,'',' '))."</b></span></td>";

		echo "<td class='row".$row."' align='right'><span class='name2'><b>".str_replace(" ","&nbsp;",number_format($cenajed/$cena*100,3,',',' '))." %</b></span></td>";

		echo "<td class='row".$row."' align='right'></td>";
		echo "<td class='row".$row."' align='center'></td>";

		$paretok=0;for ($i=0;$i<count($pareto);$i++) if ($pareto[$i]==$id) $paretok=1;
		if ($paretok) echo "<td class='row".$row."' align='center'><img src='skin/button/ok.png' width='24px' height='24px'></td>";
		else  echo "<td class='row".$row."' align='center'></td>";

		echo "</td>";

		echo "</tr>";
	}}

	echo "<tr><td colspan='8' class='row1'><hr><hr></td></tr>";
	echo "<tr><td colspan='4' class='row1' align='right'><b>Celkem: ".str_replace(" ","&nbsp;",number_format($cenacelkem,0,'',' ')).",-Kè</b></td><td colspan='4' class='row1'></td></tr>";

?>
</table>
<?php }  ?>