<?php
$st=$_GET['st'];
?>
<h1>Nastavení analýzy pøípravy staveb</h1><hr>
<?php


if ($st){
	if ($lock==0) mysql_query("update nastaveni set hodnota='".$st."' where id='1'",$connect2);
	echo "<h1><font color=green>Struktura analýzy byla úspìšnì nastavena !</font></h1><hr>";
}


$getclanek = mysql_query("SELECT * FROM `nastaveni` where id='1'",$connect2);
while ($clanky = mysql_fetch_array($getclanek)){
	$nazevst=$clanky['hodnota'];
}
$getclanek = mysql_query("SELECT * FROM `Struktura` where id='".$nazevst."'",$connect2);
while ($clanky = mysql_fetch_array($getclanek)){
	$nazevstr=$clanky['nazev'];
	$idstr=$clanky['id'];
}

?>
<?php
echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"../forum/".$u_login_logout."\" class=\"vlevo\"  title=\"\" >";
if ($lock==0) echo "<img src='./skin/button/32/opened.png' title='Opened' width='32px' height='32px' border='0'>";
if ($lock==1) echo "<img src='./skin/button/32/locked.png' title='Locked' width='32px' height='32px' border='0'>";
echo "</a>";
?>
<h2>Zvolte porovnávaci strukturu:</h2>
<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft" width="70px"></td>
<td align="center" class="catLeft" width="50px"><span class='name2'>ID</span></td>
<td align="center" class="catLeft" width="250px"><span class='name2'>Název</span></td>
<td align="center" class="catLeft" width="50px"><span class='name2'>Položek</span></td>
<td align="center" class="catLeft" width="100px"><span class='name2'>Koeficienty Pareta</span></td>
<td align="center" class="catLeft" width="150px"><span class='name2'>Druh nákladù</span></td>
<td align="center" class="catLeft" width="50px"></td>
</tr>
<?php
	$getclanek = mysql_query("SELECT * FROM `Struktura` order by nazev",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id=$clanky['id'];
		$nazev=$clanky['nazev'];
		$koef1=$clanky['koef1'];
		$koef2=$clanky['koef2'];
		$druh=$clanky['druh'];


		$polozek=mysql_result(mysql_query("SELECT count(*) FROM Struktura_wbs where Struktura='".$id."'",$connect2),0);

		if ($druh==1) $druhs="H - Pøímý materiál";
		if ($druh==2) $druhs="M - Pøímé mzdy";
		if ($druh==3) $druhs="S - Stroje a zaøízení";
		if ($druh==4) $druhs="OPN - Ostatní pøímé náklady";
		if ($druh==5) $druhs="RV - Režie výrobní";
		if ($druh==6) $druhs="RS - Režie správní";
		if ($druh==7) $druhs="C - Subdodávky";
		if ($druh==8) $druhs="Z - Zisk";
		if ($row==1) $row=2;else $row=1;
		echo "<tr>";
		if ($id==$nazevst) echo "<td class='row".$row."'><img src='./skin/button/ok.png' title='Aktuálnì nastavená struktura WBS' width='24px' height='24px' border='0'></td>";
		else echo "<td class='row".$row."'><a href='?st=".$id."' title='Nastavit strukturu'>nastavit :</a></td>";

		echo "<td class='row".$row."' align='center'><span class='name2'>".$id."</span></td>";
		if ($id==$nazevst) echo "<td class='row".$row."'><b><span class='name2'><font color='green'>".$nazev."</font></span></b></td>";
		else echo "<td class='row".$row."'><b><span class='name2'>".$nazev."</span></b></td>";
		echo "<td class='row".$row."' align='center'><b><span class='name2'>".$polozek."</span></b></td>";
		echo "<td class='row".$row."'><span class='name2'>".$koef1."% položek tvoøí<br>".$koef2."% nákladù</span></td>";
		echo "<td class='row".$row."'><span class='name2'>".$druhs."</span></td>";
		echo "<td class='row".$row."'>";
		echo "<a target='_blank' href='analyza-struktura?st=".$id."' title='Zobrazit položku'><img src='./skin/button/16/view.png' alt='Zobrazit položku' width='16px' height='16px' border='0'></a>&nbsp;";
		echo "<a target='_blank' href='?s=1&amp;ids=".$id."' title='Editovat položku'><img src='./skin/button/16/edit.png' alt='Editovat položku' width='16px' height='16px' border='0'></a>&nbsp;";	
		echo "</td>";
		echo "</tr>";
	}

?>
</table>
<br><hr><br>
<?php
echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"../forum/".$u_login_logout."\" class=\"vlevo\"  title=\"\" >";
if ($lock==0) echo "<img src='./skin/button/32/opened.png' title='Opened' width='32px' height='32px' border='0'>";
if ($lock==1) echo "<img src='./skin/button/32/locked.png' title='Locked' width='32px' height='32px' border='0'>";
echo "</a>";
?>
<h2>Aktuálnì nastavená struktura WBS: <?php echo $nazevstr;?> (<a title="Editovat strukturu" href="analyza-struktura?st=<?php echo $idstr;?>">editovat :</a>)
<table class="forumline" cellspacing="0" cellpadding="2">
<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft" width="50px"><span class='name2'>Kód WBS</span></td>
<td align="center" class="catLeft" width="200px"><span class='name2'>Název</span></td>
<td align="center" class="catLeft" width="100px"><span class='name2'>Min náklady</span></td>
<td align="center" class="catLeft" width="100px"><span class='name2'>Max náklady</span></td>
<td align="center" class="catLeft" width="150px"><span class='name2'>Koeficienty Pareta</span></td>
<td align="center" class="catLeft" width="150px"><span class='name2'>Druh nákladù</span></td>
</tr>
<?php

	$getclanek = mysql_query("SELECT * FROM `Struktura_wbs` where Struktura='".$idstr."' order by kod_wbs",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id=$clanky['id'];
		$nazev=$clanky['nazev'];
		$kod_wbs=$clanky['kod_wbs'];
		$kod1=$clanky['kod1'];
		$kod2=$clanky['kod2'];
		$uroven=$clanky['uroven'];
		$min=$clanky['min']/100;
		$max=$clanky['max']/100;
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
		echo "<tr><td class='row".$row."' align='center'><span class='name2'>".$kod_wbs."</span></td>";

		if ($uroven==1) echo "<td class='row".$row."'><b><span class='name2'>".$nazev."</span></b></td>";
		else echo "<td class='row".$row."'>&nbsp;&nbsp;&nbsp;<b><em><span class='name2'>".$nazev."</span></em></b></td>";

		echo "<td class='row".$row."' align='center'><b><span class='name2'>".$min." %</span></b></td>";

		echo "<td class='row".$row."' align='center'><b><span class='name2'>".$max." %</span></b></td>";

		echo "<td class='row".$row."'><span class='name2'>".$koef1."% položek tvoøí<br>".$koef2."% nákladù</span></td>";

		echo "<td class='row".$row."'><span class='name2'>".$druhs."</span></td>";
		echo "</tr>";
	}
?>
</table>