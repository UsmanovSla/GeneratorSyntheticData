<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head>
<meta http-equiv="Content-Language" content="cs"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title><?php echo $titl; ?></title><meta name="keywords" content="<?php echo $titl2; ?>"><meta name="description" content="<?php echo $titl2; ?>"><link rel="stylesheet" href="./skin/tisk.css"><link rel="shortcut icon" href="./skin/environmental.ico">
</head><body>
<img src="./skin/tisk.png" width="756px" height="67px"><br>
<?php 

require("./db/db.php");


function kontrola ($promenna){
	$promenna = EregI_Replace("<", "&lt;", $promenna);
	$promenna = EregI_Replace(">", "&gt;", $promenna);
	$promenna = EregI_Replace('"', '&quot;', $promenna);
	$promenna = EregI_Replace('\'', '&quot;', $promenna);
//	$promenna=htmlspecialchars($promenna);
return $promenna;
}


$id = kontrola($_GET['id']);


// Karta aspektu - nahled
if ($id){


	$getclanek = mysql_query("SELECT * FROM DbEAs where klic='$id'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$klic=$clanky['klic'];

		$DEAKod=$clanky['DEAKod'];
	
		$DEAAsp1=$clanky['DEAAsp1'];
		$DEAAsp2=$clanky['DEAAsp2'];
		$DEAUtv=$clanky['DEAUtv'];
		$DEAZar=$clanky['DEAZar'];
		$DEAPolut1=$clanky['DEAPolut1'];
		$DEAPolut2=$clanky['DEAPolut2'];
		$DEADopad=$clanky['DEADopad'];

		$DEADopad=str_split($DEADopad);

		$DEALimH=$clanky['DEALimH'];
		$DEAMJ=$clanky['DEAMJ'];
		$DEAPredp=$clanky['DEAPredp'];
		$DEARiz=$clanky['DEARiz'];
		$DEAVyzn=$clanky['DEAVyzn'];
		$DEAVaha=$clanky['DEAVaha'];
		$DEACelk=$clanky['DEACelk'];

		$DEAVyzn=str_split($DEAVyzn);

		$DEAVaha=str_split($DEAVaha);


		$DEADokl=$clanky['DEADokl'];
		$DEAPrev1=$clanky['DEAPrev1'];
		$DEAPrev2=$clanky['DEAPrev2'];
		$DEAOpat1=$clanky['DEAOpat1'];
		$DEAOpat2=$clanky['DEAOpat2'];
		if ($row==1) $row=2;else $row=1;
		$DEAOdp=$clanky['DEAOdp'];

		$DOK=$clanky['DOK'];
		$MNK=$clanky['MNK'];
		$DEACetn=$clanky['DEACetn'];
		$DEANamH=$clanky['DEANamH'];

		$SKLIC=$clanky['SKLIC'];
		$CKLIC=$clanky['CKLIC'];
		$temp_cinnost=$clanky['temp_cinnost'];
	}

?>
<h2>Karta položky dastabáze aspektù:</h2>
<table style="border: 1px solid black" cellspacing="0" cellpadding="2" width="700px">
<tr><td width="50%">
<table width="350px" border="1">
<tr><td colspan="2"><br></td></tr>
<tr><td colspan="2"><b><em>Stavební èinnost:</em></b></td></tr>
<tr><td>Èíselný klíè:</td><td><b><?php echo $CKLIC;?></b>&nbsp;</td></tr>
<tr><td>Zkratka:</td><td><?php echo $SKLIC;?>&nbsp;</td></tr>
<tr><td><b>Název èinnosti:</b></td><td><b><?php echo $temp_cinnost;?></b>&nbsp;</td></tr>
<tr><td colspan="2"><hr></td></tr>
<tr><td colspan="2"><b><em>Environmentální aspekt:</em></b></td></tr>
<tr><td><b>Kód aspektu:</b></td><td><b><?php echo $DEAKod;?></b>&nbsp;</td></tr>
<tr><td><b>Aspekt:</b></td><td><b><?php echo $DEAAsp1;?></b>&nbsp;</td></tr>
<tr><td></td><td><?php echo $DEAAsp2;?>&nbsp;</td></tr>
<tr><td>Útvar HS:</td><td><?php echo $DEAUtv;?>&nbsp;</td></tr>
<tr><td>Zaøízení:</td><td><?php echo $DEAZar;?>&nbsp;</td></tr>
<tr><td>Polutanty:</td><td><?php echo $DEAPolut1;?>&nbsp;</td></tr>
<tr><td></td><td><?php echo $DEAPolut2;?>&nbsp;</td></tr>
<tr><td>Limitní hodnota:</td><td><?php echo $DEALimH;?>&nbsp;</td></tr>
<tr><td>m.j. limit. hodnoty</td><td><?php echo $DEAMJ;?>&nbsp;</td></tr>
<tr><td colspan="2"><br></td></tr>
<tr><td colspan="2"><b><em>Dopad na životní prostøedí:</em></b></td></tr>
<tr><td colspan="2" align="center">
<table>
<tr><td width="200px">&nbsp;&nbsp;èlovìk</td><td width="100px" align="center"><?php if($DEADopad[0]==1) echo "<em>Ano</em>"; else echo "<em>Ne</em>";?></td></tr>
<tr><td>&nbsp;&nbsp;ovzduší</td><td width="100px" align="center"><?php if($DEADopad[1]==1) echo "<em>Ano</em>"; else echo "<em>Ne</em>";?></td></tr>
<tr><td>&nbsp;&nbsp;voda</td><td width="100px" align="center"><?php if($DEADopad[2]==1) echo "<em>Ano</em>"; else echo "<em>Ne</em>";?></td></tr>
<tr><td>&nbsp;&nbsp;pùda</td><td width="100px" align="center"><?php if($DEADopad[3]==1) echo "<em>Ano</em>"; else echo "<em>Ne</em>";?></td></tr>
<tr><td>&nbsp;&nbsp;prac. prostøedí</td><td width="100px" align="center"><?php if($DEADopad[4]==1) echo "<em>Ano</em>"; else echo "<em>Ne</em>";?></td></tr>
<tr><td>&nbsp;&nbsp;jiné</td><td width="100px" align="center"><?php if($DEADopad[5]==1) echo "<em>Ano</em>"; else echo "<em>Ne</em>";?></td></tr>
</table>
</table>
</td><td width="50%">
<table width="350px" border="1">

<tr><td colspan="2"><br></td></tr>
<tr><td>Pøedpis:</td><td><?php echo $DEAPredp;?>&nbsp;</td></tr>
<tr><td>Zpùsob øízení:</td><td><?php echo $DEARiz;?>&nbsp;</td></tr>
<tr><td>Opatøení:</td><td><?php echo $DEAOpat1;?>&nbsp;</td></tr>
<tr><td></td><td><?php echo $DEAOpat2;?>&nbsp;</td></tr>
<tr><td>Odpovìdnost:</td><td><?php echo $DEAOdp;?>&nbsp;</td></tr>
<tr><td>Doklad:</td><td><?php echo $DEADokl;?>&nbsp;</td></tr>
<tr><td>Kontrola:</td><td><?php echo $DEAPrev1;?>&nbsp;</td></tr>
<tr><td>Èetnost:</td><td><?php echo $DEAPrev2;?>&nbsp;</td></tr>
<tr><td colspan="2"><hr></td></tr>
<tr><td colspan="2"><b><em>Významnost:</em></b></td></tr>
<tr><td colspan="2" align="center">
<table>
<tr><td width="300px"><em></em></td><td width="100px"><em>Závažnost</em></td><td width="100px"><em>Váha</em></td></tr>
<tr><td>&nbsp;&nbsp;Soulad s právními požadavky</td><td align="center"><?php echo $DEAVyzn[0];?></td><td align="center"><?php echo $DEAVaha[0];?></td></tr>
<tr><td>&nbsp;&nbsp;Vliv na životní pøostøedí</td><td align="center"><?php echo $DEAVyzn[1];?></td><td align="center"><?php echo $DEAVaha[1];?></td></tr>
<tr><td>&nbsp;&nbsp;Èetnost (pravdìpod.) výskytu</td><td align="center"><?php echo $DEAVyzn[2];?></td><td align="center"><?php echo $DEAVaha[2];?></td></tr>
<tr><td>&nbsp;&nbsp;Doba (trvání) dopadu</td><td align="center"><?php echo $DEAVyzn[3];?></td><td align="center"><?php echo $DEAVaha[3];?></td></tr>
<tr><td>&nbsp;&nbsp;Náklady spojené s dopadem</td><td align="center"><?php echo $DEAVyzn[4];?></td><td align="center"><?php echo $DEAVaha[4];?></td></tr>
<tr><td>&nbsp;&nbsp;Náklady sankèního postíhu</td><td align="center"><?php echo $DEAVyzn[5];?></td><td align="center"><?php echo $DEAVaha[5];?></td></tr>
<tr><td>&nbsp;&nbsp;Pøipomínky veøejnosti</td><td align="center"><?php echo $DEAVyzn[6];?></td><td align="center"><?php echo $DEAVaha[6];?></td></tr>
<tr><td>&nbsp;&nbsp;Stížnosti zamìstnancù</td><td align="center"><?php echo $DEAVyzn[7];?></td><td align="center"><?php echo $DEAVaha[7];?></td></tr>
</table></td></tr>
<tr><td colspan="2"><br></td></tr>
<tr><td>Výsledná významnost aspektu:</td><td><b><?php echo $DEACelk;?></b>&nbsp;</td></tr>
<tr><td>Èetnost mìøení:</td><td><?php echo $DEACetn;?>&nbsp;</td></tr>
<tr><td>Procento dokonèení èinnosti pro 1. kontrolu aspektu:</td><td><?php echo $DOK;?>&nbsp;</td></tr>
<tr><td>Množství mìrných jednotek produktu na 1 kontrolu aspektu:</td><td><?php echo $MNK;?>&nbsp;</td></tr>

</table>
</td></tr></table>
<?php
}else{



$celkem=mysql_result(mysql_query("SELECT count(*) FROM DbEAs",$connect2),0);


?>
Celkem bylo nalezeno <?php echo $celkem;?> položek
<table border="1" style="border: 1px solid black" cellspacing="0" cellpadding="2">
<tr>
<td align="left"><b>Èíslo<br>Kód EA<br>Útvar</b></td>
<td align="left"><b>Název èinnosti<br>Aspekt</b></td>
<td align="left"><b>Zkratka<br>Polutanty</b></td>
<td align="center"><b>Dopad na ŽP<br>èlovìk&nbsp;&nbsp;vzduch&nbsp;&nbsp;voda<br>pùda&nbsp;&nbsp;prostø&nbsp;&nbsp;jiné</b></td>
<td align="left"><b>Doklad<br>Zaøízení<br>Odpovìdnost</b></td>
<td align="right"><b>Èetnost.mìø<br>Limit<br>m.j.</b></td>
<td align="left"><b><br>Pøedpis<br>Zpùsob øízení</b></td>
<td align="center"><b>Závažnost/Váha<br>A&nbsp;&nbsp;B&nbsp;&nbsp;C&nbsp;&nbsp;D<br>E&nbsp;&nbsp;F&nbsp;&nbsp;G&nbsp;&nbsp;H</b></td>
</tr>
<?php

	$getclanek = mysql_query("SELECT * FROM DbEAs Order by DEAKod",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$klic=$clanky['klic'];

		$DEAKod=$clanky['DEAKod'];
	
		$DEAAsp1=$clanky['DEAAsp1'];
		$DEAAsp2=$clanky['DEAAsp2'];
		$DEAUtv=$clanky['DEAUtv'];
		$DEAZar=$clanky['DEAZar'];
		$DEAPolut1=$clanky['DEAPolut1'];
		$DEAPolut2=$clanky['DEAPolut2'];
		$DEADopad=$clanky['DEADopad'];

		$DEADopad=str_split($DEADopad);

		$DEALimH=$clanky['DEALimH'];
		$DEAMJ=$clanky['DEAMJ'];
		$DEAPredp=$clanky['DEAPredp'];
		$DEARiz=$clanky['DEARiz'];
		$DEAVyzn=$clanky['DEAVyzn'];
		$DEAVaha=$clanky['DEAVaha'];
		$DEACelk=$clanky['DEACelk'];

		$DEAVyzn=str_split($DEAVyzn);

		$DEAVaha=str_split($DEAVaha);


		$DEADokl=$clanky['DEADokl'];
		$DEAPrev1=$clanky['DEAPrev1'];
		$DEAPrev2=$clanky['DEAPrev2'];
		$DEAOpat1=$clanky['DEAOpat1'];
		$DEAOpat2=$clanky['DEAOpat2'];
		if ($row==1) $row=2;else $row=1;
		$DEAOdp=$clanky['DEAOdp'];

		$DOK=$clanky['DOK'];
		$MNK=$clanky['MNK'];
		$DEACetn=$clanky['DEACetn'];
		$DEANamH=$clanky['DEANamH'];

		$SKLIC=$clanky['SKLIC'];
		$CKLIC=$clanky['CKLIC'];
		$temp_cinnost=$clanky['temp_cinnost'];
		$EADopadt="";
		$EADopadt2="";
		if ($DEADopad[0]==1) $EADopadt=$EADopadt."+&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; else $EADopadt=$EADopadt."-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		if ($DEADopad[1]==1) $EADopadt=$EADopadt."+&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; else $EADopadt=$EADopadt."-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		if ($DEADopad[2]==1) $EADopadt=$EADopadt."+"; else $EADopadt=$EADopadt."-";
		if ($DEADopad[4]==1) $EADopadt2=$EADopadt2."+&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; else $EADopadt2=$EADopadt2."-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		if ($DEADopad[5]==1) $EADopadt2=$EADopadt2."+&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; else $EADopadt2=$EADopadt2."-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		if ($DEADopad[6]==1) $EADopadt2=$EADopadt2."+"; else $EADopadt2=$EADopadt2."-";

		$vahat=$DEAVyzn[0]."/".$DEAVaha[0]."&nbsp;&nbsp;&nbsp;&nbsp;".$DEAVyzn[1]."/".$DEAVaha[1]."&nbsp;&nbsp;&nbsp;&nbsp;".$DEAVyzn[2]."/".$DEAVaha[2]."&nbsp;&nbsp;&nbsp;&nbsp;".$DEAVyzn[3]."/".$DEAVaha[3]."<br>";
		$vahat=$vahat.$DEAVyzn[4]."/".$DEAVaha[4]."&nbsp;&nbsp;&nbsp;&nbsp;".$DEAVyzn[5]."/".$DEAVaha[5]."&nbsp;&nbsp;&nbsp;&nbsp;".$DEAVyzn[6]."/".$DEAVaha[6]."&nbsp;&nbsp;&nbsp;&nbsp;".$DEAVyzn[7]."/".$DEAVaha[7];


echo '<tr><td align="left">'.$CKLIC.'&nbsp;<br>'.$DEAKod.'&nbsp;<br>'.$DEAUtv.'&nbsp;</td>';
echo '<td align="left">'.$temp_cinnost.'&nbsp;<br>'.$DEAAsp1.'&nbsp;<br>'.$DEAAsp2.'&nbsp;</td>
<td align="left">'.$SKLIC.'&nbsp;<br>'.$DEAPolut1.'&nbsp;<br>'.$DEAPolut2.'&nbsp;</td>
<td align="center"><br>'.$EADopadt.'<br>'.$EADopadt2.'</td>
<td align="left">'.$DEADokl.'<br>'.$DEAZar.'<br>'.$DEAOdp.'</td>

<td align="right">'.$DEACetn.'<br>'.$DEALimH.'<br>'.$DEAMJ.'</td>
<td align="left"><br>'.$DEAPredp.'<br>'.$DEARiz.'</td>
<td align="center">'.$DEACelk.'<br>'.$vahat.'</td>
</tr>';
	}
	echo "</table>";



}


?>
<br><form><input type="button" value="Vytisknout" onclick="window.print();"></form>
<br><br>
Copyright (c) 2010 by www.celysvet.cz. Všechna práva vyhrazena ! Urèeno jen pro osobní využití. Kontaktní e-mail: celysvet@email.cz
</body></html>