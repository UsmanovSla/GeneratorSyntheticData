<?php
$st=$_POST['st'];
if (!$st) $st=$_GET['st'];


	$getclanek = mysql_query("SELECT * FROM `Struktura` where id='".$st."' Limit 0,1",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$struktura=$clanky['nazev'];
		$koef1=$clanky['koef1'];
		$koef2=$clanky['koef2'];
		$druh=$clanky['druh'];
	}

?>
<h1>Anal�zy p��pravy staveb</h1>
<h2>Editace struktury: <?php echo $struktura;?></h2>
<?php



$s=$_POST['s'];
if (!$s) $s=$_GET['s'];

$nazev=$_POST['nazev'];
$kod1=$_POST['kod1'];
$kod2=$_POST['kod2'];

$kod_wbs=sprintf("%03d",$kod1).".".sprintf("%03d",$kod2);

$uroven=1;
if ($kod2) $uroven=2;

$min=str_replace(",",".",$_POST['min'])*100;
$max=str_replace(",",".",$_POST['max'])*100;



if ($min>10000) $min=10000;
if ($max>10000) $max=10000;
if ($min<0) $min=0;
if ($max<0) $max=0;



$koef1=$_POST['koef1'];
$koef2=$_POST['koef2'];
$druh=$_POST['druh'];

$ids=$_GET['ids'];
if (!$ids) $ids=$_POST['ids'];

if ($koef1>100) $koef1=100;
if ($koef2>100) $koef2=100;
if ($koef1<0) $koef1=0;
if ($koef2<0) $koef2=0;



// Vymazavani zaznamu
if ($s==9){
	$getclanek = mysql_query("SELECT * FROM `Struktura_wbs` where id='".$ids."' Limit 0,1",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$struktura=$clanky['nazev'];
	}
	echo "<h1><font color=red>Opravdu chcete vymazat polo�ku:  ".$struktura." ?</font></h1>";

	echo "<b><a href='analyza-struktura?st=".$st."&amp;s=901&amp;ids=".$ids."'>ANO</a>&nbsp;&nbsp;<a href='analyza-struktura?st=".$st."'>NE</a></b><br><br>";

}


// Vymazavani zaznamu z tabulky MySQL
if ($s==901){
	if ($lock==0) mysql_query("DELETE FROM `Struktura_wbs` where id='".$ids."'",$connect2);
	echo "<h1><font color=green>Polo�ka byla �sp�n� vymaz�na z datab�ze !</font></h1><hr>";
	$s=0;
}


if ($s==1){

	if ($ids) echo "<br><h2>Editace polo�ky struktury:</h2><hr>";
	else echo "<br><h2>Nov� polo�ka struktury:</h2><hr>";




	if ($ids){
		$getclanek = mysql_query("SELECT * FROM `Struktura_wbs` where id='".$ids."' Limit 0,1",$connect2);
		while ($clanky = mysql_fetch_array($getclanek)){
			$nazev=$clanky['nazev'];
			$kod1=$clanky['kod1'];
			$kod2=$clanky['kod2'];

			$min=$clanky['min']/100;
			$max=$clanky['max']/100;

			$koef1=$clanky['koef1'];
			$koef2=$clanky['koef2'];
			$druh=$clanky['druh'];
		}
	}else{
		$getclanek = mysql_query("SELECT * FROM `Struktura` where id='".$st."' Limit 0,1",$connect2);
		while ($clanky = mysql_fetch_array($getclanek)){
			$koef1=$clanky['koef1'];
			$koef2=$clanky['koef2'];
			$druh=$clanky['druh'];
		}
	}

	echo "<form method='post'  enctype='multipart/form-data'>";
	echo "<input type='hidden' name='s' value='2'>";
	echo "<input type='hidden' name='st' value='".$st."'>";
	if ($ids) echo "<input type='hidden' name='ids' value='".$ids."'>";
	echo "N�zev struktury: <input type='text' name='nazev' value='".$nazev."' size='60'><br><br>";

	echo "K�d WBS: ";
	echo "<input type='text' name='kod1' value='".$kod1."' size='5'> . <input type='text' name='kod2' value='".$kod2."' size='5'><br><br>";

	echo "Pod�l n�klad� (MIN %): ";
	echo "<input type='text' name='min' value='".$min."' size='6'> %<br><br>";

	echo "Pod�l n�klad� (MAX %): ";
	echo "<input type='text' name='max' value='".$max."' size='6'> %<br><br>";

	echo "Koeficienty dle Paretova pravidla: ";
	echo "<input type='text' name='koef1' value='".$koef1."' size='3'> % polo�ek tvo�� <input type='text' name='koef2' value='".$koef2."' size='3'> % n�klad�<br><br>";
	echo "Druh n�klad� dle kalkula�n�ho vzorce: <select name='druh'>";
	echo "<option value='1'";if ($druh==1) echo "selected";echo ">H - P��m� materi�l</option>";
	echo "<option value='2'";if ($druh==2) echo "selected";echo ">M - P��m� mzdy</option>";
	echo "<option value='3'";if ($druh==3) echo "selected";echo ">S - Stroje a za��zen�</option>";
	echo "<option value='4'";if ($druh==4) echo "selected";echo ">OPN - Ostatn� p��m� n�klady</option>";
	echo "<option value='5'";if ($druh==5) echo "selected";echo ">RV - Re�ie v�robn�</option>";
	echo "<option value='6'";if ($druh==6) echo "selected";echo ">RS - Re�ie spr�vn�</option>";
	echo "<option value='7'";if ($druh==7) echo "selected";echo ">C - Subdod�vky</option>";
	echo "<option value='8'";if ($druh==8) echo "selected";echo ">Z - Zisk</option>";
	echo "</select><br><br>";
	echo "<input name='vlozit' type='submit' value='Ulo�it'>&nbsp;<input type=button onclick='history.back()' value='Zp�t'></form>";
}




if ($s==2){
	if ($lock==0) if ($nazev){
		if ($kod2=="") $kod2="0";
		
		echo "<h1><font color=green>Nov� polo�ka struktury byla �sp�n� ulo�ena do datab�ze !</font></h1><hr>";
		if ($ids) mysql_query("replace INTO `Struktura_wbs` ( `id`,`nazev` , `kod_wbs`, `kod1` ,`kod2` ,`Struktura` ,`koef1` , `koef2` ,`uroven` ,`min` ,`max` , `druh`) VALUES ('$ids','$nazev', '$kod_wbs','$kod1','$kod2','$st','$koef1', '$koef2','$uroven','$min','$max', '$druh');",$connect2);
		else mysql_query("INSERT INTO `Struktura_wbs` ( `nazev` , `kod_wbs`, `kod1` ,`kod2` ,`Struktura` ,`koef1` , `koef2` ,`uroven` ,`min` ,`max` , `druh`) VALUES ('$nazev', '$kod_wbs','$kod1','$kod2','$st','$koef1', '$koef2','$uroven','$min','$max', '$druh');",$connect2);
	}
	$s=0;		
}

if ($s==0){
if ($lock==0) {
?>
<a title="P�idat novou polo�ku struktury" href="analyza-struktura?s=1&amp;st=<?php echo $st;?>"><img src='./skin/button/32/new.png' alt='P�idat novou polo�ku struktury :' width='32px' height='32px' border='0'></a>
&nbsp;&nbsp;
<?php } ?>
<a title="Zp�t na hlavn� str�nku" href="analyza-wbs-struktura"><img src='./skin/button/32/sort.png' alt='Zp�t na hlavn� str�nku' width='32px' height='32px' border='0'></a>
<?php
echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"../forum/".$u_login_logout."\" class=\"vlevo\"  title=\"\" >";
if ($lock==0) echo "<img src='./skin/button/32/opened.png' title='Opened' width='32px' height='32px' border='0'>";
if ($lock==1) echo "<img src='./skin/button/32/locked.png' title='Locked' width='32px' height='32px' border='0'>";
echo "</a>";
?>
<table class="forumline" cellspacing="0" cellpadding="2">
<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft" width="50px"><span class='name2'>K�d WBS</span></td>
<td align="center" class="catLeft" width="200px"><span class='name2'>N�zev</span></td>
<td align="center" class="catLeft" width="100px"><span class='name2'>Min n�klady</span></td>
<td align="center" class="catLeft" width="100px"><span class='name2'>Max n�klady</span></td>
<td align="center" class="catLeft" width="150px"><span class='name2'>Koeficienty Pareta</span></td>
<td align="center" class="catLeft" width="150px"><span class='name2'>Druh n�klad�</span></td>
<td align="center" class="catLeft" width="50px"></td>
</tr>
<?php
	$getclanek = mysql_query("SELECT * FROM `Struktura_wbs` where Struktura='".$st."' order by kod_wbs",$connect2);
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
		if ($druh==1) $druhs="H - P��m� materi�l";
		if ($druh==2) $druhs="M - P��m� mzdy";
		if ($druh==3) $druhs="S - Stroje a za��zen�";
		if ($druh==4) $druhs="OPN - Ostatn� p��m� n�klady";
		if ($druh==5) $druhs="RV - Re�ie v�robn�";
		if ($druh==6) $druhs="RS - Re�ie spr�vn�";
		if ($druh==7) $druhs="C - Subdod�vky";
		if ($druh==8) $druhs="Z - Zisk";
		if ($row==1) $row=2;else $row=1;
		echo "<tr><td class='row".$row."' align='center'><span class='name2'>".$kod_wbs."</span></td>";

		if ($uroven==1) echo "<td class='row".$row."'><b><span class='name2'>".$nazev."</span></b></td>";
		else echo "<td class='row".$row."'>&nbsp;&nbsp;&nbsp;<b><em><span class='name2'>".$nazev."</span></em></b></td>";

		echo "<td class='row".$row."' align='center'><b><span class='name2'>".number_format($min,2,',',' ')." %</span></b></td>";

		echo "<td class='row".$row."' align='center'><b><span class='name2'>".number_format($max,2,',',' ')." %</span></b></td>";

		echo "<td class='row".$row."'><span class='name2'>".$koef1."% polo�ek tvo��<br>".$koef2."% n�klad�</span></td>";

		echo "<td class='row".$row."'><span class='name2'>".$druhs."</span></td>";
		echo "<td class='row".$row."'>";
		if ($lock==0) echo "<a href='?st=".$st."&amp;s=1&amp;ids=".$id."' title='Editovat polo�ku'><img src='./skin/button/16/edit.png' alt='Editovat polo�ku' width='16px' height='16px' border='0'></a>&nbsp;";	
		if ($lock==0) echo "<a href='?st=".$st."&amp;s=9&amp;ids=".$id."' title='Vymazat polo�ku'><img src='./skin/button/16/delete.png' alt='Vymazat polo�ku' width='16px' height='16px' border='0'></a>";
		echo "</td>";
		echo "</tr>";
	}
?>
</table>
<?php } ?>