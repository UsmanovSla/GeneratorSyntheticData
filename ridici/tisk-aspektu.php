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


	$getclanek = mysql_query("SELECT * FROM ReaRec where EAKod='$id'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$EAKod=$clanky['EAKod'];
	
		$EAAsp1=$clanky['EAAsp1'];
		$EAAsp2=$clanky['EAAsp2'];
		$EAUtv=$clanky['EAUtv'];
		$EAZar=$clanky['EAZar'];
		$EAPolut1=$clanky['EAPolut1'];
		$EAPolut2=$clanky['EAPolut2'];
		$EADopad=$clanky['EADopad'];

		$EADopad=str_split($EADopad);

		$EALimH=$clanky['EALimH'];
		$EAMJ=$clanky['EAMJ'];
		$EAPredp=$clanky['EAPredp'];
		$EARiz=$clanky['EARiz'];
		$EAVyzn=$clanky['EAVyzn'];

		$EAVyzn=str_split($EAVyzn);


		$EADokl=$clanky['EADokl'];
		$EAPrev1=$clanky['EAPrev1'];
		$EAPrev2=$clanky['EAPrev2'];
		$EAOpat1=$clanky['EAOpat1'];
		$EAOpat2=$clanky['EAOpat2'];
		if ($row==1) $row=2;else $row=1;
		$EAOdp=$clanky['EAOdp'];
	}

?>
<h2>Karta aspektu:</h2>
<table style="border: 1px solid black" cellspacing="0" cellpadding="2" width="700px">
<tr><td width="50%">
<table width="350px" border="1">
<tr><td>K�d aspektu:</td><td><b><?php echo $EAKod;?></b></td></tr>
<tr><td><b>Aspekt:</b></td><td><b><?php echo $EAAsp1;?></b></td></tr>
<tr><td></td><td><?php echo $EAAsp2;?></td></tr>
<tr><td>�tvar HS:</td><td><?php echo $EAUtv;?></td></tr>
<tr><td>Za��zen�:</td><td><?php echo $EAZar;?></td></tr>
<tr><td>Polutanty:</td><td><?php echo $EAPolut1;?></td></tr>
<tr><td></td><td><?php echo $EAPolut2;?></td></tr>
<tr><td>Limitn� hodnota:</td><td><?php echo $EALimH;?></td></tr>
<tr><td>m.j. limit. hodnoty</td><td><?php echo $EAMJ;?></td></tr>
<tr><td colspan="2"><br></td></tr>
<tr><td colspan="2"><b><em>Dopad na �ivotn� prost�ed�:</em></b></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�lov�k</td><td><?php if($EADopad[0]==1) echo "<b><em>Ano</em></b>"; else echo "<b><em>Ne</em></b>";?></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ovzdu��</td><td><?php if($EADopad[1]==1) echo "<b><em>Ano</em></b>"; else echo "<b><em>Ne</em></b>";?></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;voda</td><td><?php if($EADopad[2]==1) echo "<b><em>Ano</em></b>"; else echo "<b><em>Ne</em></b>";?></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;p�da</td><td><?php if($EADopad[3]==1) echo "<b><em>Ano</em></b>"; else echo "<b><em>Ne</em></b>";?></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;prac. prost�ed�</td><td><?php if($EADopad[4]==1) echo "<b><em>Ano</em></b>"; else echo "<b><em>Ne</em></b>";?></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;jin�</td><td><?php if($EADopad[5]==1) echo "<b><em>Ano</em></b>"; else echo "<b><em>Ne</em></b>";?></td></tr>
<tr><td colspan="2"><br></td></tr>
</table>
</td><td width="50%">
<table width="350px" border="1">
<tr><td>P�edpis:</td><td><?php echo $EAPredp;?></td></tr>
<tr><td>Zp�sob ��zen�:</td><td><?php echo $EARiz;?></td></tr>
<tr><td>Opat�en�:</td><td><?php echo $EAOpat1;?></td></tr>
<tr><td></td><td><?php echo $EAOpat2;?></td></tr>
<tr><td>Odpov�dnost:</td><td><?php echo $EAOdp;?></td></tr>
<tr><td>Doklad:</td><td><?php echo $EADokl;?></td></tr>
<tr><td>Kontrola:</td><td><?php echo $EAPrev1;?></td></tr>
<tr><td>�etnost:</td><td><?php echo $EAPrev2;?></td></tr>
<tr><td colspan="2"><br></td></tr>
<tr><td colspan="2"><b><em>Krit�ria a ohodnocen� jejich z�va�nosti:</em></b></td></tr>
<tr><td>&nbsp;&nbsp;Soulad s pr�vn�mi po�adavky</td><td><?php echo $EAVyzn[0];?></td></tr>
<tr><td>&nbsp;&nbsp;Vliv na �ivotn� p�ost�ed�</td><td><?php echo $EAVyzn[1];?></td></tr>
<tr><td>&nbsp;&nbsp;�etnost (pravd�pod.) v�skytu</td><td><?php echo $EAVyzn[2];?></td></tr>
<tr><td>&nbsp;&nbsp;Doba (trv�n�) dopadu</td><td><?php echo $EAVyzn[3];?></td></tr>
<tr><td>&nbsp;&nbsp;N�klady spojen� s dopadem</td><td><?php echo $EAVyzn[4];?></td></tr>
<tr><td>&nbsp;&nbsp;N�klady sank�n�ho post�hu</td><td><?php echo $EAVyzn[5];?></td></tr>
<tr><td>&nbsp;&nbsp;P�ipom�nky ve�ejnosti</td><td><?php echo $EAVyzn[6];?></td></tr>
<tr><td>&nbsp;&nbsp;St�nosti zam�stnanc�</td><td><?php echo $EAVyzn[7];?></td></tr>
</table>
</td></tr></table>
<?php
}else{



$celkem=mysql_result(mysql_query("SELECT count(*) FROM ReaRec",$connect2),0);


?>
Celkem bylo nalezeno <?php echo $celkem;?> aspekt�
<table border="1" style="border: 1px solid black" cellspacing="0" cellpadding="2">
<tr>
<td align="center"><b>K�d&nbsp;EA<br>�tvar</b></td>
<td align="center"><b>Aspekt</b></td>
<td align="center"><b>Polutanty</b></td>
<td align="center"><b>Dopad na �P<br>�/vz/vo/p�/pr/j</b></td>
<td align="center"><b>Za��zen�<br>Odpov�dnost</b></td>

<td align="center"><b>Limit<br>m.j.</b></td>
<td align="center"><b>P�edpis<br>Zp�sob ��zen�</b></td>
<td align="center"><b>Z�va�nost<br>A/B/C/D/E/F/G/H</b></td>
<td align="center"><b>Doklad</b></td>
<td align="center"><b>Kontrola<br>�etnost</b></td>
<td align="center"><b>Opat�en�</b></td>
</tr>
<?php

	$getclanek = mysql_query("SELECT * FROM ReaRec Order by EAKod",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$EAKod=$clanky['EAKod'];
	
		$EAAsp1=$clanky['EAAsp1'];
		$EAAsp2=$clanky['EAAsp2'];
		$EAUtv=$clanky['EAUtv'];
		$EAZar=$clanky['EAZar'];
		$EAPolut1=$clanky['EAPolut1'];
		$EAPolut2=$clanky['EAPolut2'];
		$EADopad=$clanky['EADopad'];

		$EADopad=ereg_replace("0","-/",$EADopad);
		$EADopad=ereg_replace("1","+/",$EADopad);
		$EADopad=substr($EADopad,0,strlen($EADopad)-1);

		$EALimH=$clanky['EALimH'];
		$EAMJ=$clanky['EAMJ'];
		$EAPredp=$clanky['EAPredp'];
		$EARiz=$clanky['EARiz'];
		$EAVyzn=$clanky['EAVyzn'];

		$EAVyzn=ereg_replace("1","1/",$EAVyzn);
		$EAVyzn=ereg_replace("2","2/",$EAVyzn);
		$EAVyzn=ereg_replace("3","3/",$EAVyzn);
		$EAVyzn=substr($EAVyzn,0,strlen($EAVyzn)-3);


		$EADokl=$clanky['EADokl'];
		if (!$EADokl) $EADokl="&nbsp;";
		$EAPrev1=$clanky['EAPrev1'];
		$EAPrev2=$clanky['EAPrev2'];
		$EAOpat1=$clanky['EAOpat1'];
		$EAOpat2=$clanky['EAOpat2'];
		if ($row==1) $row=2;else $row=1;
		$EAOdp=$clanky['EAOdp'];

echo '<tr><td align="center">'.$EAKod.'<br>'.$EAUtv.'</td>';
echo '<td align="left"><b>'.$EAAsp1.'<br>'.$EAAsp2.'</b></td>
<td align="left">'.$EAPolut1.'<br>'.$EAPolut2.'</td>
<td align="center">'.$EADopad.'</td>
<td align="left">'.$EAZar.'<br>'.$EAOdp.'</td>
<td align="center">'.$EALimH.'<br>'.$EAMJ.'</td>
<td align="left">'.$EAPredp.'<br>'.$EARiz.'</td>
<td align="center">'.$EAVyzn.'</td>
<td align="left">'.$EADokl.'</td>
<td align="left">'.$EAPrev1.'<br>'.$EAPrev2.'</td>
<td align="left">'.$EAOpat1.'<br>'.$EAOpat2.'</td>
</tr>';
	}
	echo "</table>";



}


?>
<br><form><input type="button" value="Vytisknout" onclick="window.print();"></form>
<br><br>
Copyright (c) 2010 by www.celysvet.cz. V�echna pr�va vyhrazena ! Ur�eno jen pro osobn� vyu�it�. Kontaktn� e-mail: celysvet@email.cz
</body></html>