<h1>Anal�zy p��pravy staveb</h1>
<h2>Struktura WBS (Work breakdown structure)</h2>
<?php

$s=$_POST['s'];
if (!$s) $s=$_GET['s'];

$struktura=$_POST['struktura'];
$koef1=$_POST['koef1'];
$koef2=$_POST['koef2'];
$druh=$_POST['druh'];

$min_1=$_POST['min_1'];
$min_2=$_POST['min_2'];
$min_3=$_POST['min_3'];
$min_4=$_POST['min_4'];
$min_5=$_POST['min_5'];
$min_6=$_POST['min_6'];
$min_7=$_POST['min_7'];
$min_8=$_POST['min_8'];

$max_1=$_POST['max_1'];
$max_2=$_POST['max_2'];
$max_3=$_POST['max_3'];
$max_4=$_POST['max_4'];
$max_5=$_POST['max_5'];
$max_6=$_POST['max_6'];
$max_7=$_POST['max_7'];
$max_8=$_POST['max_8'];

$ids=$_GET['ids'];
if (!$ids) $ids=$_POST['ids'];

if ($koef1>100) $koef1=100;
if ($koef2>100) $koef2=100;

if ($koef1<0) $koef1=0;
if ($koef2<0) $koef2=0;


// Vymazavani zaznamu
if ($s==9){
	$getclanek = mysql_query("SELECT * FROM `Struktura` where id='".$ids."' Limit 0,1",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$struktura=$clanky['nazev'];
		$koef1=$clanky['koef1'];
		$koef2=$clanky['koef2'];
		$druh=$clanky['druh'];
	}
	echo "<h1><font color=red>Opravdu chcete vymazat polo�ku:  ".$struktura." ?</font></h1>";

	echo "<b><a href='analyza-wbs-struktura?s=901&amp;ids=".$ids."'>ANO</a>&nbsp;&nbsp;<a href='analyza-wbs-struktura'>NE</a></b><br><br>";

}


// Vymazavani zaznamu z tabulky MySQL
if ($s==901){
	if ($lock==0) mysql_query("DELETE FROM `Struktura` where id='".$ids."'",$connect2);
	echo "<h1><font color=green>Polo�ka byla �sp�n� vymaz�na z datab�ze !</font></h1><hr>";
	$s=0;
}


if ($s==1){

	if ($ids) echo "<br><h2>Editace struktury:</h2><hr>";
	else echo "<br><h2>Nov� struktura:</h2><hr>";



	$koef1=25;
	$koef2=75;
	$druh=1;


	if ($ids){
		$getclanek = mysql_query("SELECT * FROM `Struktura` where id='".$ids."' Limit 0,1",$connect2);
		while ($clanky = mysql_fetch_array($getclanek)){
			$struktura=$clanky['nazev'];
			$koef1=$clanky['koef1'];
			$koef2=$clanky['koef2'];
			$druh=$clanky['druh'];
			$min[1]=$clanky['min_1'];
			$min[2]=$clanky['min_2'];
			$min[3]=$clanky['min_3'];
			$min[4]=$clanky['min_4'];
			$min[5]=$clanky['min_5'];
			$min[6]=$clanky['min_6'];
			$min[7]=$clanky['min_7'];
			$min[8]=$clanky['min_8'];

			$max[1]=$clanky['max_1'];
			$max[2]=$clanky['max_2'];
			$max[3]=$clanky['max_3'];
			$max[4]=$clanky['max_4'];
			$max[5]=$clanky['max_5'];
			$max[6]=$clanky['max_6'];
			$max[7]=$clanky['max_7'];
			$max[8]=$clanky['max_8'];
		}
	}

	echo "<form method='post'  enctype='multipart/form-data'>";
	echo "<input type='hidden' name='s' value='2'>";
	if ($ids) echo "<input type='hidden' name='ids' value='".$ids."'>";
	echo "N�zev struktury: <input type='text' name='struktura' value='".$struktura."' size='60'><br><br>";
	echo "Defaultn� koeficienty dle Paretova pravidla: ";
	echo "<input type='text' name='koef1' value='".$koef1."' size='3'> % polo�ek tvo�� <input type='text' name='koef2' value='".$koef2."' size='3'> % n�klad�<br><br>";
	echo "Defaultn� druh n�klad� dle kalkula�n�ho vzorce: <select name='druh'>";
	echo "<option value='1'";if ($druh==1) echo "selected";echo ">H - P��m� materi�l</option>";
	echo "<option value='2'";if ($druh==2) echo "selected";echo ">M - P��m� mzdy</option>";
	echo "<option value='3'";if ($druh==3) echo "selected";echo ">S - Stroje a za��zen�</option>";
	echo "<option value='4'";if ($druh==4) echo "selected";echo ">OPN - Ostatn� p��m� n�klady</option>";
	echo "<option value='5'";if ($druh==5) echo "selected";echo ">RV - Re�ie v�robn�</option>";
	echo "<option value='6'";if ($druh==6) echo "selected";echo ">RS - Re�ie spr�vn�</option>";
	echo "<option value='7'";if ($druh==7) echo "selected";echo ">C - Subdod�vky</option>";
	echo "<option value='8'";if ($druh==8) echo "selected";echo ">Z - Zisk</option>";
	echo "</select><br><br>";

	for ($i=1;$i<=8;$i++) {
		if ($i==1) $druhs="H - P��m� materi�l";
		if ($i==2) $druhs="M - P��m� mzdy";
		if ($i==3) $druhs="S - Stroje a za��zen�";
		if ($i==4) $druhs="OPN - Ostatn� p��m� n�klady";
		if ($i==5) $druhs="RV - Re�ie v�robn�";
		if ($i==6) $druhs="RS - Re�ie spr�vn�";
		if ($i==7) $druhs="C - Subdod�vky";
		if ($i==8) $druhs="Z - Zisk";
		echo $druhs.": od <input type='text' name='min_".$i."' value='".$min[$i]."' size='4'>% do <input type='text' name='max_".$i."' value='".$max[$i]."' size='4'>%<br><br>";
	}


	echo "<input name='vlozit' type='submit' value='Ulo�it'>&nbsp;<input type=button onclick='history.back()' value='Zp�t'></form>";
}




if ($s==2){
	if ($lock==0) if ($struktura){
		echo "<h1><font color=green>Nov� struktura byla �sp�n� ulo�ena do datab�ze !</font></h1><hr>";
		if ($ids) mysql_query("replace INTO `Struktura` ( `id`,`nazev` , `koef1` , `koef2` , `druh`,`min_1`,`min_2`,`min_3`,`min_4`,`min_5`,`min_6`,`min_7`,`min_8`,`max_1`,`max_2`,`max_3`,`max_4`,`max_5`,`max_6`,`max_7`,`max_8`) VALUES ('$ids','$struktura', '$koef1', '$koef2', '$druh', '$min_1', '$min_2', '$min_3', '$min_4', '$min_5', '$min_6', '$min_7', '$min_8','$max_1', '$max_2', '$max_3', '$max_4', '$max_5', '$max_6', '$max_7', '$max_8');",$connect2);
		else mysql_query("INSERT INTO `Struktura` ( `nazev` , `koef1` , `koef2` , `druh`,`min_1`,`min_2`,`min_3`,`min_4`,`min_5`,`min_6`,`min_7`,`min_8`,`max_1`,`max_2`,`max_3`,`max_4`,`max_5`,`max_6`,`max_7`,`max_8`) VALUES ('$struktura', '$koef1', '$koef2', '$druh', '$min_1', '$min_2', '$min_3', '$min_4', '$min_5', '$min_6', '$min_7', '$min_8','$max_1', '$max_2', '$max_3', '$max_4', '$max_5', '$max_6', '$max_7', '$max_8');",$connect2);
	}
	$s=0;		
}

if ($s==0){
if ($lock==0) {
?>
<a title="P�idat novou strukturu" href="analyza-wbs-struktura?s=1"><img src='./skin/button/32/new.png' alt='P�idat novou strukturu :' width='32px' height='32px' border='0'></a>
&nbsp;&nbsp;
<?php } ?>
<a title="Zp�t na hlavn� str�nku" href="analyza"><img src='./skin/button/32/sort.png' alt='Zp�t na hlavn� str�nku' width='32px' height='32px' border='0'></a>
<?php
echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"../forum/".$u_login_logout."\" class=\"vlevo\"  title=\"\" >";
if ($lock==0) echo "<img src='./skin/button/32/opened.png' title='Opened' width='32px' height='32px' border='0'>";
if ($lock==1) echo "<img src='./skin/button/32/locked.png' title='Locked' width='32px' height='32px' border='0'>";
echo "</a>";
?>
<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft" width="50px"><span class='name2'>ID</span></td>
<td align="center" class="catLeft" width="300px"><span class='name2'>N�zev</span></td>
<td align="center" class="catLeft" width="50px"><span class='name2'>Polo�ek</span></td>
<td align="center" class="catLeft" width="150px"><span class='name2'>Koeficienty Pareta</span></td>
<td align="center" class="catLeft" width="150px"><span class='name2'>Druh n�klad�</span></td>
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

		if ($druh==1) $druhs="H - P��m� materi�l";
		if ($druh==2) $druhs="M - P��m� mzdy";
		if ($druh==3) $druhs="S - Stroje a za��zen�";
		if ($druh==4) $druhs="OPN - Ostatn� p��m� n�klady";
		if ($druh==5) $druhs="RV - Re�ie v�robn�";
		if ($druh==6) $druhs="RS - Re�ie spr�vn�";
		if ($druh==7) $druhs="C - Subdod�vky";
		if ($druh==8) $druhs="Z - Zisk";
		if ($row==1) $row=2;else $row=1;
		echo "<tr><td class='row".$row."' align='center'><span class='name2'>".$id."</span></td>";
		echo "<td class='row".$row."'><b><span class='name2'>".$nazev."</span></b></td>";
		echo "<td class='row".$row."' align='center'><b><span class='name2'>".$polozek."</span></b></td>";
		echo "<td class='row".$row."'><span class='name2'>".$koef1."% polo�ek tvo��<br>".$koef2."% n�klad�</span></td>";
		echo "<td class='row".$row."'><span class='name2'>".$druhs."</span></td>";
		echo "<td class='row".$row."'>";
		echo "<a href='analyza-struktura?st=".$id."' title='Zobrazit polo�ku'><img src='./skin/button/16/view.png' alt='Zobrazit polo�ku' width='16px' height='16px' border='0'></a>&nbsp;";
		if ($lock==0) echo "<a href='?s=1&amp;ids=".$id."' title='Editovat polo�ku'><img src='./skin/button/16/edit.png' alt='Editovat polo�ku' width='16px' height='16px' border='0'></a>&nbsp;";	
		if ($lock==0) echo "<a href='?s=9&amp;ids=".$id."' title='Vymazat polo�ku'><img src='./skin/button/16/delete.png' alt='Vymazat polo�ku' width='16px' height='16px' border='0'></a>";
		echo "</td>";
		echo "</tr>";
	}
?>
</table>
<?php } ?>


