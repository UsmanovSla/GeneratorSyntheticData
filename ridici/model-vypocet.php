<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL & ~E_NOTICE);

$connect = $connect2;

function doba_skriptu() {
	$casy = explode(" ",microtime());
	return ($casy[0] + $casy[1]);
}
$doba_skriptu_zacatek = doba_skriptu();

echo "<h1>".$titl."</h1>";


function kontrola ($promenna){
//	$promenna = EregI_Replace("<", "&lt;", $promenna);
//	$promenna = EregI_Replace(">", "&gt;", $promenna);
//	$promenna = EregI_Replace('"', '&quot;', $promenna);
//	$promenna = EregI_Replace('\'', '&quot;', $promenna);
//	$promenna=htmlspecialchars($promenna);
return $promenna;
}

function generator_nahodnych_cisel()
{
  list($usec, $sec) = explode(' ', microtime());
  mt_srand((float) $sec + ((float) $usec * 100000));
  return mt_rand(0,1000);
}

function erf($x)
{
        $pi = 3.1415927;
        $a = (8*($pi - 3))/(3*$pi*(4 - $pi));
        $x2 = $x * $x;
        $ax2 = $a * $x2;
        $num = (4/$pi) + $ax2;
        $denom = 1 + $ax2;
        $inner = (-$x2)*$num/$denom;
        $erf2 = 1 - exp($inner);
        return sqrt($erf2);
}


$krok=kontrola($_POST['krok']);
$model=kontrola($_POST['model']);
if (!$model) $model = kontrola($_GET['model']);
if (!$krok) $krok = kontrola($_GET['krok']);
$ukaz_id = kontrola($_GET['ukaz_id']);


$getclanek = mysql_query("SELECT * from model where id='$model' limit 0,1",$connect2);
while ($clanky = mysql_fetch_array($getclanek)){
	$nazev=$clanky['nazev'];
	$doba=$clanky['doba'];
	$zahajeni=$clanky['zahajeni'];
	$smena_prescas=$clanky['smena_prescas'];
	$smena=$clanky['smena'];
	$tyden=$clanky['tyden'];
	$produktivita=$clanky['produktivita'];
	$objem=$clanky['objem'];
	$plocha=$clanky['plocha'];
	$jednotka=$clanky['jednotka'];

	$obsluha=$clanky['obsluha'];
	$zakaznici=$clanky['zakaznici'];

	$kendall_x=$clanky['kendall_x'];
	$kendall_y=$clanky['kendall_y'];
	
	$pocet_iteraci=$clanky['pocet_iteraci'];
	
	$casovy_fond_hod=floor($clanky['casovy_fond_min']/60);
	$casovy_fond_min=$clanky['casovy_fond_min'];

	$variabilni_naklady_stavby=$clanky['variabilni_naklady'];
	$r1=$clanky['r1'];
	$r2=$clanky['r2'];
	$r3=$clanky['r3'];
	$r4=$clanky['r4'];
	$r5=$clanky['r5'];

	$k1_m=$clanky['k1'];
	$k2_m=$clanky['k2'];
	$k3_m=$clanky['k3'];
	$k4_m=$clanky['k4'];
	$k5_m=$clanky['k5'];

	$penale=$clanky['penale'];
	$bonus=$clanky['bonus'];
	$rozptyl_vysledku=$clanky['rozptyl_vysledku'];
	 	

		
	echo "<h1>Název projektu: ".$nazev."</h1>";
	$tydnu=ceil(($doba-$zahajeni)/7/24/3600);

}
echo "<hr>";


if (!$krok) $krok=1;


if (($smena<=0) or ($tyden<1)) {$krok=0;echo "<h1><font color='red'>Chyba! Zadejte pracovní režim!</font></h1>";$viewdalsikrok=0;}

if (($doba-$zahajeni<86400) or (!$doba) or (!$zahajeni)) {$krok=0;echo "<h1><font color='red'>Chyba! Zadejte doby trvání ùkolu!</font></h1>";$viewdalsikrok=0;}

if (($objem<1) or ($plocha<1)) {$krok=0;echo "<h1><font color='red'>Chyba! Zadejte objemy a pøípustné plochy ùkolu!</font></h1>";$viewdalsikrok=0;}

if (($obsluha<1) or ($zakaznici<1)) {$krok=0;echo "<h1><font color='red'>Chyba! Zadejte obsluhované a obsluhující varianty!</font></h1>";$viewdalsikrok=0;}

if ($krok==1){
	echo "<h1>Krok 1: Výpoèet èasového fondu</h1>";
	
	$delka_hod=ceil($tydnu*$tyden*($smena_prescas+$smena));
	$delka_min=$delka_hod*60;
	mysql_query("update model set casovy_fond_min='$delka_min' where id='$model'",$connect2);
?>
<table>
<tr><td class="row2">Zahájení práce:</td><td class="row2"><?php echo date("d.m.Y",$zahajeni);?></td></tr>
<tr><td class="row1">Ukonèení práce:</td><td class="row1"><?php echo date("d.m.Y",$doba);?></td></tr>
<tr><td class="row2">Délka smìny, [h]:</td><td class="row2"><?php echo $smena;?></td></tr>
<tr><td class="row1">Délka pracovního tydne, [dny]:</td><td class="row1"><?php echo $tyden;?></td></tr>
<tr><td class="row2">Pøesèasy za den, [h]:</td><td class="row2"><?php echo $smena_prescas;?></td></tr>
<tr><td class="row1">Požadovaná délka trvání prací, [týdny]:</td><td class="row1"><?php echo $tydnu;?></td></tr>
<tr><td class="row2">Požadovaná délka prací, [h]:</td><td class="row2"><?php echo $delka_hod;?></td></tr>
<tr><td class="row1">Požadovaná délka prací, [min]:</td><td class="row1"><?php echo $delka_min;?></td></tr>
</table><br>
Chyba výsledku získaného pomocí <?php echo $pocet_iteraci;?> historií je úmìrná 1/(<?php echo $pocet_iteraci;?>)^1/2 = <?php echo round(1/sqrt($pocet_iteraci)*100,2);?> %<br>
<?php
	$viewdalsikrok=1;

}

if ($krok==2){
	echo "<h1>Krok 2: Kontrola maximálního poètu strojù (minimální pracovní plocha)</h1>";
	echo "<h2>Maximální disponibilní plocha staveništì: ".number_format($plocha,0,',',' ')." m<sup>2</sup></h2>";
?>
<h1>Obsluhující varianty: </h1>
<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft" width="35px"><font class="name2"><b>Varianta</b></font></td>
<td align="center" class="catLeft" width="300px"><font class="name2"><b>Název stroje</b></font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"><b>Minimální pracovní plocha</b></font></td>
<td align="center" class="catLeft" width="40px"><font class="name2"><b>Disponibilní poèet</b></font></td>
<td align="center" class="catLeft" width="95px"><font class="name2"><b>Maximální možný poèet</b></font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"><b>Status</b></font></td>
</tr>
<?php
	$viewdalsikrok=1;
	$getclanek = mysql_query("SELECT * from model_obsluha where model='$model'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id_v=$clanky['id'];
		$nazev_v=$clanky['nazev'];
		$maximalni_pocet_v=$clanky['maximalni_pocet'];
		$plocha_v=$clanky['plocha'];
		
		$maximalni_mozny_pocet=floor($plocha/$plocha_v);
		
		$maximalni_pocet_v_o=$maximalni_pocet_v;
		
		mysql_query("update model_obsluha set max_mozny_pocet='$maximalni_mozny_pocet' where id='$id_v'",$connect2);
		
		if ($maximalni_mozny_pocet<$maximalni_pocet_v) {$status_v="<font color='red'>Chyba!!!</font>";$viewdalsikrok=0;}
		else $status_v="<font color='green'>V poøádku!!!</font>";
		
		$ii++;
		if ($row==1) $row=2; else $row=1;
		echo "<tr><td align='center' class='row".$row."'>".$ii."</td>";
		echo "<td class='row".$row."'>".$nazev_v."</td>";
		echo "<td align='center' class='row".$row."'>".$plocha_v." m<sup>2</sup></td>";
		echo "<td align='center' class='row".$row."'><b>".$maximalni_pocet_v."</b></td>";
		echo "<td align='center' class='row".$row."'>".$maximalni_mozny_pocet."</td>";
		echo "<td align='center' class='row".$row."'><b>".$status_v."</b></td></tr>";
		
	}
	echo "</table>";
	$ii=0;
?>
<br>
<h1>Obsluhované varianty: </h1>
<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft" width="35px"><font class="name2"><b>Varianta</b></font></td>
<td align="center" class="catLeft" width="300px"><font class="name2"><b>Název stroje</b></font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"><b>Minimální pracovní plocha</b></font></td>
<td align="center" class="catLeft" width="40px"><font class="name2"><b>Disponibilní poèet</b></font></td>
<td align="center" class="catLeft" width="95px"><font class="name2"><b>Maximální možný poèet</b></font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"><b>Status</b></font></td>
</tr>
<?php
	$viewdalsikrok=1;
	$getclanek = mysql_query("SELECT * from model_zakaznik where model='$model'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id_v=$clanky['id'];
		$nazev_v=$clanky['nazev'];
		$maximalni_pocet_v=$clanky['maximalni_pocet'];
		$plocha_v=$clanky['plocha'];
		
		$maximalni_mozny_pocet=floor($plocha/$plocha_v);
		
		mysql_query("update model_zakaznik set max_mozny_pocet='$maximalni_mozny_pocet' where id='$id_v'",$connect2);
		
		if ($maximalni_mozny_pocet<$maximalni_pocet_v_o) {$status_v="<font color='red'>Chyba!!!</font>";$viewdalsikrok=0;}
		else $status_v="<font color='green'>V poøádku!!!</font>";
		
		$ii++;
		if ($row==1) $row=2; else $row=1;
		echo "<tr><td align='center' class='row".$row."'>".$ii."</td>";
		echo "<td class='row".$row."'>".$nazev_v."</td>";
		echo "<td align='center' class='row".$row."'>".$plocha_v." m<sup>2</sup></td>";
		echo "<td align='center' class='row".$row."'><b>".$maximalni_pocet_v."</b></td>";
		echo "<td align='center' class='row".$row."'>".$maximalni_mozny_pocet."</td>";
		echo "<td align='center' class='row".$row."'><b>".$status_v."</b></td></tr>";
		
	}
	echo "</table>";
	
}


if ($krok==3){
	echo "<h1>Krok 3: Kontrola možnosti splnìní úkolu</h1>";
	echo "<h2>Objem úkolu: ".number_format($objem,0,',',' ')." ".$jednotka."</h2>";
	echo "<h2>Èasový fond: ".number_format($casovy_fond_hod,0,',',' ')." h</h2>";
	
?>
<h1>Obsluhující varianty: </h1>
<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft" width="35px"><font class="name2"><b>Varianta</b></font></td>
<td align="center" class="catLeft" width="300px"><font class="name2"><b>Název stroje</b></font></td>
<td align="center" class="catLeft" width="95px"><font class="name2"><b>Teoretická výkonnost stroje</b></font></td>
<td align="center" class="catLeft" width="40px"><font class="name2"><b>Disponibilní poèet</b></font></td>
<td align="center" class="catLeft" width="95px"><font class="name2"><b>Maximální objem sestavy</b></font></td>
<td align="center" class="catLeft" width="65px"><font class="name2"><b>Minimální nutný poèet</b></font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"><b>Status</b></font></td>
</tr>
<?php
	$viewdalsikrok=1;
	$getclanek = mysql_query("SELECT * from model_obsluha where model='$model'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id_v=$clanky['id'];
		$nazev_v=$clanky['nazev'];
		$maximalni_pocet_v=$clanky['maximalni_pocet'];
		$vykon_v=$clanky['vykon']*$produktivita;
		
		$maximalni_objem_sestavy=floor($vykon_v*$maximalni_pocet_v*$casovy_fond_hod);
		
		$nutny_pocet=ceil($objem/$vykon_v/$casovy_fond_hod);
		
		mysql_query("update model_obsluha set nutny_pocet ='$nutny_pocet ' where id='$id_v'",$connect2);
		
		if ($maximalni_pocet_v<$nutny_pocet) {$status_v="<font color='red'>Chyba!!!</font>";$viewdalsikrok=0;}
		else $status_v="<font color='green'>V poøádku!!!</font>";
		
		$ii++;
		if ($row==1) $row=2; else $row=1;
		echo "<tr><td align='center' class='row".$row."'>".$ii."</td>";
		echo "<td class='row".$row."'>".$nazev_v."</td>";
		echo "<td align='center' class='row".$row."'>".$vykon_v." ".$jednotka."/hod</td>";
		echo "<td align='center' class='row".$row."'><b>".$maximalni_pocet_v."</b></td>";
		echo "<td align='center' class='row".$row."'>".number_format($maximalni_objem_sestavy,0,',',' ')." ".$jednotka."</td>";
		echo "<td align='center' class='row".$row."'>".$nutny_pocet."</td>";
		echo "<td align='center' class='row".$row."'><b>".$status_v."</b></td></tr>";
		
	}
	echo "</table>";
	$ii=0;
?>
<br>
<h1>Obsluhované varianty: </h1>
<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft" width="35px"><font class="name2"><b>Varianta</b></font></td>
<td align="center" class="catLeft" width="300px"><font class="name2"><b>Název stroje</b></font></td>
<td align="center" class="catLeft" width="95px"><font class="name2"><b>Teoretická výkonnost stroje</b></font></td>
<td align="center" class="catLeft" width="40px"><font class="name2"><b>Disponibilní poèet</b></font></td>
<td align="center" class="catLeft" width="95px"><font class="name2"><b>Maximální objem sestavy</b></font></td>
<td align="center" class="catLeft" width="65px"><font class="name2"><b>Minimální nutný poèet</b></font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"><b>Status</b></font></td>
</tr>
<?php
	$viewdalsikrok=1;
	$getclanek = mysql_query("SELECT * from model_zakaznik where model='$model'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id_v=$clanky['id'];
		$nazev_v=$clanky['nazev'];
		$maximalni_pocet_v=$clanky['maximalni_pocet'];
		$vykon_v=$clanky['vykon']*$produktivita;
		
		$maximalni_objem_sestavy=floor($vykon_v*$maximalni_pocet_v*$casovy_fond_hod);
		
		$nutny_pocet=ceil($objem/$vykon_v/$casovy_fond_hod);
		
		mysql_query("update model_zakaznik set nutny_pocet ='$nutny_pocet ' where id='$id_v'",$connect2);
		
		if ($maximalni_pocet_v<$nutny_pocet) {$status_v="<font color='red'>Chyba!!!</font>";$viewdalsikrok=0;}
		else $status_v="<font color='green'>V poøádku!!!</font>";
		
		$ii++;
		if ($row==1) $row=2; else $row=1;
		echo "<tr><td align='center' class='row".$row."'>".$ii."</td>";
		echo "<td class='row".$row."'>".$nazev_v."</td>";
		echo "<td align='center' class='row".$row."'>".$vykon_v." ".$jednotka."/hod</td>";
		echo "<td align='center' class='row".$row."'><b>".$maximalni_pocet_v."</b></td>";
		echo "<td align='center' class='row".$row."'>".number_format($maximalni_objem_sestavy,0,',',' ')." ".$jednotka."</td>";
		echo "<td align='center' class='row".$row."'>".$nutny_pocet."</td>";
		echo "<td align='center' class='row".$row."'><b>".$status_v."</b></td></tr>";
		
	}
	echo "</table>";


}
if ($krok==4){
	$stacionarni_pocet=0;
	echo "<h1>Krok 4: Parametry systému hromadné obsluhy</h1>";
	echo "&#955; (lambda) - Intenzita pøíchodu zákazníkù, [prùmìrný poèet pøíchodù/h]<br>";
	echo "&#956; (mí) - Intenzita obsluhy, [obslouží se v prùmìru poèet zákazníkù/h]<br>";
	echo "&#961; (ró) - Intenzita provozu, [-]<br>";
	echo "Podmínka existence stacionárního režímu: <b>&#961; < 1</b><br>";
	echo "<hr>";
	$obs=0;
	$getclanek = mysql_query("SELECT * from model_obsluha where model='$model'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id_obsluha[$obs]=$clanky['id'];
		$nazev_obsluha[$obs]=$clanky['nazev'];
		$maximalni_pocet_obsluha[$obs]=$clanky['maximalni_pocet'];
		$cyklus_obsluha[$obs]=$clanky['cyklus'];
		$vykon_obsluha[$obs]=$clanky['vykon'];
		$nutny_pocet_obsluha[$obs]=$clanky['nutny_pocet'];
		$obs++;
	}

	$zak=0;
	$getclanek = mysql_query("SELECT * from model_zakaznik where model='$model'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id_zakaznik[$zak]=$clanky['id'];
		$nazev_zakaznik[$zak]=$clanky['nazev'];
		$maximalni_pocet_zakaznik[$zak]=$clanky['maximalni_pocet'];
		$cyklus_zakaznik[$zak]=$clanky['cyklus'];
		$vykon_zakaznik[$zak]=$clanky['vykon'];
		$nutny_pocet_zakaznik[$zak]=$clanky['nutny_pocet'];
		$zak++;
	}
	$pocet_kombinaci_celkovy=0;
	$pocet_kombinaci=$zak*$obs;
	$k=0;
	for ($i=0;$i<$zak;$i++){
		for ($j=0;$j<$obs;$j++){
			$pocet_kombinaci_celkovy=$pocet_kombinaci_celkovy+$maximalni_pocet_zakaznik[$i]*$maximalni_pocet_obsluha[$j];
			$krok_obsluha[$k]=$j;
			$krok_zakaznik[$k]=$i;
			$k++;
		}
	}
	mysql_query("delete from model_varianty where model='$model'",$connect2);
	echo "Poèet zkoušených kombinací: <b>".$pocet_kombinaci_celkovy."</b><br>";
	$aktualni_varianta=1;
	for ($i=0;$i<$pocet_kombinaci;$i++){
		echo "<br><b>Kombinace èíslo: ".($i+1)."</b><br>";
			echo "Obsluha: ".$nazev_obsluha[$krok_obsluha[$i]]."<br>";
			echo "Zákazník: ".$nazev_zakaznik[$krok_zakaznik[$i]]."<br>";
			
			
			echo '<table class="forumline" cellspacing="0" cellpadding="2">
			<tr>
			<td align="center" class="catLeft" width="35px"><font class="name2"><b>Varianta</b></font></td>
			<td align="center" class="catLeft" width="50px"><font class="name2"><b>Poèet obsluhy</b></font></td>
			<td align="center" class="catLeft" width="50px"><font class="name2"><b>&#956;</b></font></td>
			<td align="center" class="catLeft" width="50px"><font class="name2"><b>Poèet zákazníkù</b></font></td>
			<td align="center" class="catLeft" width="50px"><font class="name2"><b>&#955;</b></font></td>
			<td align="center" class="catLeft" width="50px"><font class="name2"><b>&#961;</b></font></td>
			<td align="center" class="catLeft" width="50px"><font class="name2"><b>Stacionární</b></font></td>
			<td align="center" class="catLeft" width="50px"><font class="name2"><b>Pøípustná</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Klasifikace</b></font></td>
			<td align="center" class="catLeft" width="150px"><font class="name2"><b>Rozdìlení</b></font></td>
			</tr>';

			for ($ik=0;$ik<$maximalni_pocet_zakaznik[$krok_zakaznik[$i]];$ik++){
				for ($jk=0;$jk<$maximalni_pocet_obsluha[$krok_obsluha[$i]];$jk++){
				
				$mi=$vykon_obsluha[$krok_obsluha[$i]]/$cyklus_zakaznik[$krok_zakaznik[$i]]/$vykon_zakaznik[$krok_zakaznik[$i]]*3600;
				
				$lambda=3600/$cyklus_zakaznik[$krok_zakaznik[$i]]*(1+$ik);
				
				$ro=$lambda/$mi/(1+$jk);
				$pripustne="<font color='red'>Ne</font>";
				if ($ro<1) {
					$stacionarni="<font color='green'>Ano</font>";
					$stacionarni_pocet++;
					
					$obsluha_id=$id_obsluha[$krok_obsluha[$i]];
					$obsluha_pocet=1+$jk;
					$zakaznik_id=$id_zakaznik[$krok_zakaznik[$i]];
					$zakaznik_pocet=1+$ik;
					
										
					if (($obsluha_pocet>=$nutny_pocet_obsluha[$krok_obsluha[$i]]) and ($zakaznik_pocet>=$nutny_pocet_zakaznik[$krok_zakaznik[$i]])){
						mysql_query("INSERT INTO `model_varianty` (`id` ,`model` ,`lambda` ,`mi` ,`ro` ,`obsluha_id` ,`obsluha_pocet` ,`zakaznik_id` ,`zakaznik_pocet`) VALUES ( '' , '$model', '$lambda', '$mi', '$ro', '$obsluha_id', '$obsluha_pocet','$zakaznik_id', '$zakaznik_pocet');",$connect2);
						$pripustne_varianty++;
						$pripustne="<font color='green'>Ano</font>";
					}
					
					
				}else{
					$stacionarni="<font color='red'>Ne</font>";
				}
				$kendall_xxx=$kendall_x;
				$kendall_yyy=$kendall_y;
				if ($kendall_x>=1) {$kendall_x="V".$kendall_x;$graf_ne=1;}
				if ($kendall_y>=1) {$kendall_y="V".$kendall_y;$graf_ne=1;}
				$kendall=$kendall_x."/".$kendall_y."/".(1+$jk);
				$kendall_2=$kendall_xxx.$kendall_yyy.(1+$jk);
				if ($row==1) $row=2; else $row=1;
				echo '<tr>
			<td class="row'.$row.'" align="center"><font class="name2">'.$aktualni_varianta.'</font></td>
			<td class="row'.$row.'" align="center"><font class="name2">'.(1+$jk).'</font></td>
			<td class="row'.$row.'" align="center"><font class="name2">'.number_format($mi,2,',',' ').'</font></td>
			<td class="row'.$row.'" align="center"><font class="name2">'.(1+$ik).'</font></td>
			<td class="row'.$row.'" align="center"><font class="name2">'.number_format($lambda,2,',',' ').'</font></td>
			<td class="row'.$row.'" align="center"><font class="name2"><b>'.number_format($ro,2,',',' ').'</b></font></td>
			<td class="row'.$row.'" align="center"><font class="name2"><b>'.$stacionarni.'</b></font></td>
			<td class="row'.$row.'" align="center"><font class="name2"><b>'.$pripustne.'</b></font></td>
			<td class="row'.$row.'" align="center"><font class="name2">'.$kendall.'</font></td>
			<td class="row'.$row.'" align="center"><font class="name2">';
			echo '<a target="_blank" title="Graf rozdìlení" href="rozdeleni-graf?kendall='.$kendall_2.'&mi='.$mi.'&lambda='.$lambda.'">Graf rozdìlení :</a>';
			echo '</font></td></tr>';
				$aktualni_varianta++;
				}
			}

			echo "</table>";

		
		
		
	}
	echo "<br>Poèet variant se stacionárním režimem: <b>".$stacionarni_pocet."</b><br>";
	echo "<br>Poèet pøípustných variant: <b>".$pripustne_varianty."</b><br>";
	mysql_query("update model set status_max='$pripustne_varianty',status_aktualni='0' where id='$model'",$connect2);
	if ($stacionarni_pocet>0) {
		$viewdalsikrok=1; 
		echo "<br><font color=red>UPOZORNÌNÍ!</font> Výpoèet mùže trvat delší dobu!<br>";
	}else $viewdalsikrok=0;
}


if ($krok==5){
	set_time_limit(300);
	echo "<h1>Krok 5: Simulace a výpoèet (teorie hromadné obsluhy + metoda Monte Carlo)</h1>";
	echo "Èasový fond: ".$casovy_fond_min." min<br>";
	echo "Objem úkolu: ".$objem." m.j.<br>";

	if ($ukaz_id) $viewdalsikrok=0;
	else{
		$viewdalsikrok=1;
		echo '<table class="forumline" cellspacing="0" cellpadding="2">
			<tr>
			<td align="center" class="catLeft" width="20px"><font class="name2"><b>V.</b></font></td>
			<td align="center" class="catLeft" width="200px"><font class="name2"><b>Obsluha</b><br><b>Zákazník</b></font></td>
			<td align="center" class="catLeft" width="70px"><font class="name2"><b>Poèet vstupù, [-]</b></font></td>
			<td align="center" class="catLeft" width="70px"><font class="name2"><b>Prùm. èas vstupù, [min]</b></font></td>
			<td align="center" class="catLeft" width="70px"><font class="name2"><b>Prùm. èas obsluhy, [min]</b></font></td>
			<td align="center" class="catLeft" width="70px"><font class="name2"><b>Prùm. èas èekání, [min]</b></font></td>
			<td align="center" class="catLeft" width="70px"><font class="name2"><b>Prùm. délka fronty</b></font></td>
			<td align="center" class="catLeft" width="70px"><font class="name2"><b>Max. délka fronty</b></font></td>
			<td align="center" class="catLeft" width="70px"><font class="name2"><b>Èas celkový, [min]</b></font></td>
			<td align="center" class="catLeft" width="70px"><font class="name2"><b>Splnìní úkolu</b></font></td>
			<td align="center" class="catLeft" width="70px"><font class="name2"><b>Simulace</b></font></td>
			</tr>
			';
	}

	$celkem_v=mysql_result(mysql_query("SELECT count(*) FROM model_varianty where model='$model'",$connect2),0);
	
	mysql_query("update model set status_max='$celkem_v',status_aktualni='0' where id='$model'",$connect2);
	
	$getclanek = mysql_query("SELECT * from model_varianty where model='$model' limit 0,2000",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$cekani_cas_celkem=0;
		$var++;
		$obsluha_cas_celkem_t=0;
		$id_varianty=$clanky['id'];
		$l_v=$clanky['lambda'];
		$m_v=$clanky['mi'];
		$r_v=$clanky['ro'];
		$fronta_max_ukaz=$clanky['fronta_max'];
		$fronta_max=0;
		$fronta_prumer=0;
		$obsluha_id_v=$clanky['obsluha_id'];
		$obsluha_pocet_v=$clanky['obsluha_pocet'];
		$zakaznik_id_v=$clanky['zakaznik_id'];
		$zakaznik_pocet_v=$clanky['zakaznik_pocet'];
		$getclanek2 = mysql_query("SELECT * from model_obsluha where id='$obsluha_id_v'",$connect2);
		while ($clanky2 = mysql_fetch_array($getclanek2)){
			$nazev_obsluha_v=$clanky2['nazev'];
		}
		$getclanek2 = mysql_query("SELECT * from model_zakaznik where id='$zakaznik_id_v'",$connect2);
		while ($clanky2 = mysql_fetch_array($getclanek2)){
			$nazev_zakaznik_v=$clanky2['nazev'];
			$cyklus_zakaznik_v=$clanky2['cyklus'];
			$vykon_zakaznik_v=$clanky2['vykon'];
			$objem_cyklu_v=$vykon_zakaznik_v*$cyklus_zakaznik_v/3600;
		}
		
		unset($lambda_matice);
		unset($mi_matice);
		
		// Poisonovo + Exponencialni rozdeleni
		if ($kendall_x=="M"){
			for ($i=0;$i<1000;$i++){
				$lambda_matice[$i]=-log(1-$i/1000)/$l_v;
			}
			$lambda_matice[1000]=$lambda_matice[999];
		}
		if ($kendall_y=="M"){
			for ($i=0;$i<1000;$i++){
				$mi_matice[$i]=-log(1-$i/1000)/$m_v;
			}
			$mi_matice[1000]=$mi_matice[999];
		}

		// Erlangovo rozdeleni
		if ($kendall_x=="E"){
			$y=0;
			$lam=$l_v;
			for ($x=0;$x<=5;$x=$x+0.001){
				$y=1-exp(-$lam*$x)-exp(-$lam*$x)*$x*$lam;
				$lambda_matice[round($y*1000)]=$x;
			}
			$previous_y=$lambda_matice[0];
			for ($i=0;$i<1000;$i++){
				if (!$lambda_matice[$i]) $lambda_matice[$i]=$previous_y;
				$previous_y=$lambda_matice[$i];
			}
			$lambda_matice[1000]=$lambda_matice[999];
		}
		if ($kendall_y=="E"){
			$y=0;
			$lam=$m_v;
			for ($x=0;$x<=5;$x=$x+0.001){
				$y=1-exp(-$lam*$x)-exp(-$lam*$x)*$x*$lam;
				$mi_matice[round($y*1000)]=$x;
			}
			$previous_y=$mi_matice[0];
			for ($i=0;$i<1000;$i++){
				if (!$mi_matice[$i]) $mi_matice[$i]=$previous_y;
				$previous_y=$mi_matice[$i];
			}
			$mi_matice[1000]=$mi_matice[999];
		}

		// Konstantni rozdeleni
		if ($kendall_x=="D"){
			$lam=$l_v;
			for ($i=0;$i<=1000;$i++){
				$lambda_matice[$i]=1/$lam;
			}
		}
		if ($kendall_y=="D"){
			$lam=$m_v;
			for ($i=0;$i<=1000;$i++){
				$mi_matice[$i]=1/$lam;
			}
		}

		// Obecne rozdeleni
		if ($kendall_x=="G"){
			$lam=$l_v;
			$y=0;
			for ($x=-5;$x<=5;$x=$x+0.001){
				$y=1/2*(1+erf(($x-1/$lam)/sqrt(2)/(1/$lam)));
				if ($x<1/$lam) $y=-$y+1;
				if ($x<0) $lambda_matice[round($y*1000)]=0;
				else $lambda_matice[round($y*1000)]=$x;
			}
			$lambda_matice[1000]=$lambda_matice[999];
		}
		if ($kendall_y=="G"){
			$lam=$m_v;
			$y=0;
			for ($x=-5;$x<=5;$x=$x+0.001){
				$y=1/2*(1+erf(($x-1/$lam)/sqrt(2)/(1/$lam)));
				if ($x<1/$lam) $y=-$y+1;
				if ($x<0) $mi_matice[round($y*1000)]=0;
				else $mi_matice[round($y*1000)]=$x;
			}
			$mi_matice[1000]=$mi_matice[999];
		}
		// Vlastni rozdeleni
		if ($kendall_x>=1){
			$lam=$l_v;
			$getclanek22 = mysql_query("SELECT * from model_global where id='".strval(4+intval($kendall_x))."'",$connect2);
			while ($clanky22 = mysql_fetch_array($getclanek22)){
				$body=$clanky22['hodnota'];
				$body=ereg_replace(",",".",trim($body));
				$x_v=split("\n",$body);
			}
			for ($i=0;$i<count($x_v);$i++){
				$y_vv=split("; ",$x_v[$i]);
				$y_vx[$i]=$y_vv[0];
				$y_vy[$i]=$y_vv[1];
			}
			for ($i=0;$i<count($x_v);$i++) {
				for ($y=$y_vy[$i];$y<$y_vy[$i+1];$y=$y+0.001){
					if ($y_vy[$i+1]!=$y_vy[$i]) $lambda_matice[round($y*1000)]=($y*($y_vx[$i+1]-$y_vx[$i])+$y_vx[$i]*$y_vy[$i+1]-$y_vx[$i+1]*$y_vy[$i])/($y_vy[$i+1]-$y_vy[$i])/$lam;
					else $lambda_matice[round($y*1000)]=$y_vx[$i+1]/$lam;
				}
			}
			$lambda_matice[0]=0;
			$lambda_matice[1000]=$lambda_matice[999];
		}
		if ($kendall_y>=1){
			$lam=$m_v;
			$getclanek22 = mysql_query("SELECT * from model_global where id='".(4+intval($kendall_y))."'",$connect2);
			while ($clanky22 = mysql_fetch_array($getclanek22)){
				$body=$clanky22['hodnota'];
				$body=ereg_replace(",",".",trim($body));
				$x_v=split("\n",$body);
			}
			for ($i=0;$i<count($x_v);$i++){
				$y_vv=split("; ",$x_v[$i]);
				$y_vx[$i]=$y_vv[0];
				$y_vy[$i]=$y_vv[1];
			}
			for ($i=0;$i<count($x_v);$i++) {
				for ($y=$y_vy[$i];$y<$y_vy[$i+1];$y=$y+0.001){
					if ($y_vy[$i+1]!=$y_vy[$i]) $mi_matice[round($y*1000)]=($y*($y_vx[$i+1]-$y_vx[$i])+$y_vx[$i]*$y_vy[$i+1]-$y_vx[$i+1]*$y_vy[$i])/($y_vy[$i+1]-$y_vy[$i])/$lam;
					else $mi_matice[round($y*1000)]=$y_vx[$i+1]/$lam;
				}
			}
			$mi_matice[0]=0;
			$mi_matice[1000]=$mi_matice[999];
		}
		
		
	if ($ukaz_id==$id_varianty){
		echo "<b>Varianta ID ".$id_varianty."</b><br>";
		echo "Obsluha: ".$nazev_obsluha_v." (poèet: ".$obsluha_pocet_v.")<br>";
		echo "Zákazník: ".$nazev_zakaznik_v." (poèet: ".$zakaznik_pocet_v.")<br>";
		echo '<table class="forumline" cellspacing="0" cellpadding="2">
			<tr>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Èas, [min]</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Vstup, [min]</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Poèet vstupù, [-]</b></font></td>';
		for ($j=0;$j<$obsluha_pocet_v;$j++){
			echo '<td align="center" class="catLeft" width="50px"><font class="name2"><b>Obsluha '.($j+1).'</b></font></td>';
		}
		for ($f=0;$f<=$zakaznik_pocet_v;$f++){
			if ($f<ceil($fronta_max_ukaz)) echo '<td align="center" class="catLeft" width="50px"><font class="name2"><b>Fronta '.($f+1).'</b></font></td>';
		}
		
		echo '<td align="center" class="catLeft" width="100px"><font class="name2"><b>Èekání na obsluhu, [min]</b></font></td><td align="center" class="catLeft" width="100px"><font class="name2"><b>Práce, [m.j.]</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Splnìní, [%]</b></font></td></tr>';
	}
		for ($j=0;$j<$obsluha_pocet_v;$j++)	{$obsluha_cas[$j]=0;$obsluha_cas_celkem[$j]=0;}
		for ($j=0;$j<=$zakznik_pocet_v;$j++)	$fronta[$j]=0;
		
		$pocet_vstupu=0;
		$vstup_cas=0;
		$cas_simulace=0;
		$novy_vstup=0;
		$pocet_iteraci_2=$pocet_iteraci*10;
		$stock_vstup=0;
		$fronta_ano=0;
		$vstup_cas_celkem=0;
		for ($t=1;$t<=$pocet_iteraci_2;$t++){
			if ($novy_vstup<=0){
				$vstup_cas=ceil($lambda_matice[generator_nahodnych_cisel()]*60);
				$obsluha_vstupu_cas=ceil($mi_matice[generator_nahodnych_cisel()]*60);
				$obsluha_cas_celkem_t=$obsluha_cas_celkem_t+$obsluha_vstupu_cas;
				$pocet_vstupu++;
				$novy_vstup=$vstup_cas;
				$stock_vstup=$vstup_cas;
				$objem_prace=($pocet_vstupu+1)*$objem_cyklu_v;
				$splneni_prace=$objem_prace/$objem*100;
				$vstup_cas_celkem=$vstup_cas_celkem+$vstup_cas;
			}
			$novy_vstup--;
			
			

			if (($ukaz_id==$id_varianty)and($t<=1000)){
				if ($row==1) $row=2; else $row=1;
				echo '<tr>
			<td class="row'.$row.'" align="center"><font class="name2">'.$t.'</font></td>
			<td class="row'.$row.'" align="center"><font class="name2">'.$vstup_cas.'/'.$obsluha_vstupu_cas.'</font></td>
			<td class="row'.$row.'" align="center"><font class="name2">'.$pocet_vstupu.'</font></td>';
			}
			
			$velikost_obsluhy=0;
			for ($j=0;$j<$obsluha_pocet_v;$j++){
				if (($fronta_ano) and ($obsluha_cas[$j]==1)){
					$obsluha_cas[$j]=$fronta[0]+1;
					for ($f=0;$f<$zakaznik_pocet_v;$f++){
						$fronta[$f]=$fronta[$f+1];
					}
					$fronta_ano--;
				}
				if ($obsluha_cas[$j]>0) $obsluha_cas[$j]--;
				if ($stock_vstup){
					if ($obsluha_cas[$j]==0){
						$obsluha_cas[$j]=$obsluha_vstupu_cas;
						$stock_vstup=0;
						$obsluha_cas_celkem[$j]=$obsluha_cas_celkem[$j]+$obsluha_vstupu_cas;
					}
				}
				if (($ukaz_id==$id_varianty)and($t<=1000)) echo '<td class="row'.$row.'" align="center"><font class="name2">'.$obsluha_cas[$j].'</font></td>';
				if ($obsluha_cas[$j]) $velikost_obsluhy++;
			}
			$fronta_ano=0;
			for ($f=0;$f<$zakaznik_pocet_v;$f++){
				if ($fronta[$f]) {$fronta_ano++;$cekani_cas_celkem++; if ($fronta_max<$f+1) $fronta_max=$f+1; $fronta_prumer++;}
				if ($stock_vstup){
					if (!$fronta[$f]){
						$fronta[$f]=$obsluha_vstupu_cas;
						$stock_vstup=0;	
					}
				}
				
				if (!$fronta[$f]) $frontaf="";else $frontaf=$fronta[$f];
				if (($ukaz_id==$id_varianty)and($t<=1000)) if ($f<ceil($fronta_max_ukaz)) echo '<td class="row'.$row.'" align="center"><font class="name2">'.$frontaf.'</font></td>';
			}

			
				
			if (($ukaz_id==$id_varianty)and($t<=1000)) {
				echo '<td class="row'.$row.'" align="center"><font class="name2"><b>'.number_format(ceil($cekani_cas),0,',',' ').'</b></font></td><td class="row'.$row.'" align="center"><font class="name2"><b>'.number_format(ceil($objem_prace),0,',',' ').'</b></font></td>
			<td class="row'.$row.'" align="center"><font class="name2"><b>'.number_format($splneni_prace,2,',',' ').'%</b></font></td>
			</tr>';
				$graf_simulace_obsluha[$t]=$velikost_obsluhy;
				$graf_simulace_fronta[$t]=$fronta_ano;
				if ($graf_simulace_fronta[$t]) $graf_simulace_obsluha[$t]=$obsluha_pocet_v;
			}
			$cas_algoritmu=$t;
			if ($pocet_vstupu>$pocet_iteraci) $t=$pocet_iteraci_2;
			if ($splneni_prace>100) $t=$pocet_iteraci_2;
		}
		if ($ukaz_id==$id_varianty){
			echo '</table>';
			echo "Prùmìrný èas mezi vstupy: <b>".number_format($vstup_cas_celkem/$pocet_vstupu,3,',',' ')." </b>min<br>";
			for ($j=0;$j<$obsluha_pocet_v;$j++){
				echo "Prùmìrný èas obsluhy ".($j+1).": <b>".number_format($obsluha_cas_celkem[$j]/$pocet_vstupu,3,',',' ')."</b> min<br>";
				$graf_2=$graf_2+$obsluha_cas_celkem[$j]/$pocet_vstupu;
			}
			$graf_2=$graf_2/$obsluha_pocet_v;
			echo "Prùmìrný èas èekání na obsluhu:<b> ".number_format($cekani_cas_celkem/$pocet_vstupu,3,',',' ')." </b>min<br>";
			
			$graf_1=$vstup_cas_celkem/$pocet_vstupu;
			$graf_3=$cekani_cas_celkem/$pocet_vstupu;
			
			
		}else{
			if (!$ukaz_id){
				if ($row==1) $row=2; else $row=1;
				$cislo_varianty++;
				
				$pocet_vstupu_celkovy=$pocet_vstupu*$objem/$objem_prace;
				$cas_splneni_ukolu=$objem*$cas_algoritmu/$objem_prace+$pocet_vstupu_celkovy*$cekani_cas_celkem/$pocet_vstupu;
				$fronta_prumer=$fronta_prumer/$cas_algoritmu;
				
				if ($cas_splneni_ukolu<=$casovy_fond_min*(1+$rozptyl_vysledku/100)){
					$podminka_splneni="<font color=green><b>Ano</b></font>";
					$pripustne_varianty++;
					mysql_query("update model_varianty set pocet_vstupu='$pocet_vstupu_celkovy',cas_celkem='$cas_splneni_ukolu',cas_vstupu='".number_format($vstup_cas_celkem/$pocet_vstupu,3,'.',' ')."',cas_obsluhy='".number_format($obsluha_cas_celkem_t/$pocet_vstupu,3,'.',' ')."',cas_cekani='".number_format($cekani_cas_celkem/$pocet_vstupu,3,'.',' ')."', fronta_prumer='$fronta_prumer', fronta_max='$fronta_max' where id='$id_varianty'",$connect2);
				}else{
					$podminka_splneni="<font color=red><b>Ne</b></font>";
					mysql_query("delete from model_varianty where id='$id_varianty'",$connect2);
				}
				
				echo '<tr valign="top"><td class="row'.$row.'" align="center"><font class="name2">'.$cislo_varianty.'</font></td>';
				echo '<td class="row'.$row.'"><font class="name2"><font color="blue">'.$nazev_obsluha_v.' (poèet: '.$obsluha_pocet_v.')</font><br>';
				echo '<font color="brown">'.$nazev_zakaznik_v.' (poèet: '.$zakaznik_pocet_v.')</font></font></td>';
				echo '<td class="row'.$row.'" align="center"><font class="name2">'.number_format($pocet_vstupu_celkovy,0,',',' ').'</font></td>';
				echo '<td class="row'.$row.'" align="center"><font class="name2">'.number_format($vstup_cas_celkem/$pocet_vstupu,3,',',' ').'</font></td>';
				echo '<td class="row'.$row.'" align="center"><font class="name2">'.number_format($obsluha_cas_celkem_t/$pocet_vstupu,3,',',' ').'</font></td>';
				echo '<td class="row'.$row.'" align="center"><font class="name2">'.number_format($cekani_cas_celkem/$pocet_vstupu,3,',',' ').'</font></td>';
				echo '<td class="row'.$row.'" align="center"><font class="name2">'.number_format($fronta_prumer,3,',',' ').'</font></td>';
				echo '<td class="row'.$row.'" align="center"><font class="name2">'.$fronta_max.'</font></td>';

				echo '<td class="row'.$row.'" align="center"><font class="name2">'.number_format($cas_splneni_ukolu,0,',',' ').'</font></td>';
				echo '<td class="row'.$row.'" align="center"><font class="name2">'.$podminka_splneni.'</font></td>';
				if ($cas_splneni_ukolu<=$casovy_fond_min*(1+$rozptyl_vysledku/100)) echo '<td class="row'.$row.'" align="center"><font class="name2"><a href="model-vypocet?krok=5&model='.$model.'&ukaz_id='.$id_varianty.'" target="_blank">Simulace :</a></font></td></tr>';
				else  echo '<td class="row'.$row.'" align="center"><font class="name2">-</font></td></tr>';

				
				
				$koef_varianty[$cislo_varianty]=$objem/$cas_splneni_ukolu/$tydnu*$casovy_fond_min;

			}
		}
		
		mysql_query("update model set status_aktualni=status_aktualni+'1' where id='$model'",$connect2);

		
	}
	if (!$ukaz_id) {
		echo "</table>";
		echo "<br>Poèet pøípustných variant: <b>".$pripustne_varianty."</b><br>";
?>
   <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
  
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Týden' <?php for ($i=1;$i<=$cislo_varianty;$i++) echo ",'v".$i."'";?>],
<?php 
		for ($j=ceil($tydnu/3*2);$j<=ceil($tydnu*4/3);$j++){
			echo "[".$j; for ($i=1;$i<=$cislo_varianty;$i++) echo ",".ceil($koef_varianty[$i]*$j); echo ",],";
		}
?>
        ]);

        var options = {
          title: 'Výkonnost sestav',
		  chartArea: {width: '80%', height: '80%'},
		  vAxis: {title: 'Objem, m.j.', baseline: <?php echo $objem;?>,baselineColor:'red'},
		  hAxis: {title: 'Týden', baseline: <?php echo $tydnu;?>,baselineColor:'red'}
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
	<div id="chart_div" style="width: 800px; height: 500px;"></div>
	<br>
	<em>Google Chart Tools: <a href="https://google-developers.appspot.com/chart/">www :</a></em>
<?php	
		
	}else{
?>
	
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Parametr', 'min'],
          ['Prùmìrný èas mezi vstupy, [min]',     <?php echo round($graf_1,3);?>],
          ['Prùmìrný èas obsluhy, [min]',      <?php echo round($graf_2,3);?>],
          ['Prùmìrný èas èekání na obsluhu, [min]',  <?php echo round($graf_3,3);?>],
        ]);

        var options = {
          title: 'Prùmìrné èasy simulace'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
	<div id="chart_div" style="width: 800px; height: 500px;"></div>
	
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data2 = google.visualization.arrayToDataTable([
          ['Èas',  'Obsluha', 'Fronta'],
<?php	$max_value=0;
		for ($i=1;$i<=1000;$i++){
			echo "['".$i."', ".$graf_simulace_obsluha[$i].",".$graf_simulace_fronta[$i]."],";
			if ($max_value<$graf_simulace_fronta[$i]+$graf_simulace_obsluha[$i]) $max_value=$graf_simulace_fronta[$i]+$graf_simulace_obsluha[$i];
		}
?>
        ]);

        var options2 = {
		  chartArea: {width: '100%', height: '80%'},
          title: 'Simulace délky fronty a obsluhy',
          vAxis: {title: 'Délka fronty a obsluhy',format:"#",minValue:0,maxValue:<?php echo $max_value;?>,gridlines: {count: <?php echo ($max_value+1);?>},textPosition:'in'},
		  hAxis: {title: 'Èas, min',textStyle:{fontSize: 10}},
  		  legend: {position: 'top'},
          isStacked: true
        };

        var chart = new google.visualization.SteppedAreaChart(document.getElementById('chart_div2'));
        chart.draw(data2, options2);
      }
    </script>
	
	<div style="width: 800px;overflow-x: auto;overflow-y: none;text-align:left">
    <div id="chart_div2" style="width: 4000px; height: 500px;"></div>
	</div>
	
	
	<em>Google Chart Tools: <a href="https://google-developers.appspot.com/chart/">www :</a></em>
<?php
	}
}

if ($krok==6){
	echo "<h1>Krok 6: Nahodilé vlivy (ovlivnìní výkonnosti)</h1>";
	$viewdalsikrok=1;

		$celkem_v=mysql_result(mysql_query("SELECT count(*) FROM model_varianty where model='$model'",$connect2),0);
		echo "<h2>Celkem $celkem_v pracovních sestav</h2>";
		echo "<h2>Prodloužení doby splnìní úkolu a nárùst nákladù</h2>";

		echo '<table class="forumline" cellspacing="0" cellpadding="2">
			<tr>
			<td align="center" class="catLeft" width="50px"><font class="name2"><b>ID</b></font></td>
			<td align="center" class="catLeft" width="200px"><font class="name2"><b>Obsluha</b><br><b>Zákazník</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Vliv poruch</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Vliv poèasí</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Vliv dopravy</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Vliv havárie</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Vliv èlovìka</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Celkový vliv</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Zmìna</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Graf</b></font></td>
			</tr>';


	$getclanek = mysql_query("SELECT * from model_varianty where model='$model'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id_varianty=$clanky['id'];
		$obsluha_id_v=$clanky['obsluha_id'];
		$zakaznik_id_v=$clanky['zakaznik_id'];
		$cas_celkem=$clanky['cas_celkem'];
		$pocet_vstupu=$clanky['pocet_vstupu'];
		$obsluha_pocet=$clanky['obsluha_pocet'];
		$zakaznik_pocet=$clanky['zakaznik_pocet'];
		$cas_vstupu=$clanky['cas_vstupu'];
		$cas_obsluhy=$clanky['cas_obsluhy'];
		$cas_cekani=$clanky['cas_cekani'];
		
		$getclanek2 = mysql_query("SELECT * from model_obsluha where id='$obsluha_id_v'",$connect2);
		while ($clanky2 = mysql_fetch_array($getclanek2)){
			$nazev_obsluha_v=$clanky2['nazev'];
			$VC_obsluha_v=$clanky2['VC'];
			$FC_obsluha_v=$clanky2['FC'];
			$co2_obsluha_v=$clanky2['co2'];
			$SP_obsluha_v=$clanky2['SP'];
			$L_obsluha_v=$clanky2['L'];
			$TL_obsluha_v=$clanky2['TL'];
			$CL_obsluha_v=$clanky2['CL'];
		}
		$getclanek2 = mysql_query("SELECT * from model_zakaznik where id='$zakaznik_id_v'",$connect2);
		while ($clanky2 = mysql_fetch_array($getclanek2)){
			$nazev_zakaznik_v=$clanky2['nazev'];
			$cyklus_zakaznik_v=$clanky2['cyklus'];
			$vykon_zakaznik_v=$clanky2['vykon'];
			$objem_cyklu_v=$vykon_zakaznik_v*$cyklus_zakaznik_v/3600;
			$VC_zakaznik_v=$clanky2['VC'];
			$FC_zakaznik_v=$clanky2['FC'];
			$co2_zakaznik_v=$clanky2['co2'];
			$SP_zakaznik_v=$clanky2['SP'];
			$L_zakaznik_v=$clanky2['L'];
			$TL_zakaznik_v=$clanky2['TL'];
			$CL_zakaznik_v=$clanky2['CL'];
		}
		
		$casovy_fond_min=$casovy_fond_min/$produktivita;
		$cas_celkem_hod=ceil($cas_celkem/60);
		$tydnu_ukolu=$tydnu*$cas_celkem/$casovy_fond_min;
		

		$pocet_poruch_celkem=$cas_celkem_hod/1000*($L_zakaznik_v*$zakaznik_pocet+$L_obsluha_v*$obsluha_pocet);

		$naklady_old=ceil($cas_celkem_hod*($VC_zakaznik_v*$zakaznik_pocet+$VC_obsluha_v*$obsluha_pocet)+$FC_zakaznik_v*$zakaznik_pocet+$FC_obsluha_v*$obsluha_pocet+ceil($tydnu_ukolu*7*$variabilni_naklady_stavby));
		

		// Poruchy
		if ($r1){
			$v1_naklad=ceil($CL_zakaznik_v*$cas_celkem_hod/1000*$L_zakaznik_v*$zakaznik_pocet+$CL_obsluha_v*$cas_celkem_hod/1000*$L_obsluha_v*$obsluha_pocet);
			$v1_cas=ceil($TL_zakaznik_v*$cas_celkem_hod/1000*$L_zakaznik_v*$zakaznik_pocet+$TL_obsluha_v*$cas_celkem_hod/1000*$L_obsluha_v*$obsluha_pocet);
		}else{
			$v1_naklad=0;
			$v1_cas=0;
		}
		
		// pocasi
		$v2_naklad=0;
		$v2_cas=0;
		if ($r2){
			$getclanek2 = mysql_query("SELECT * from model_global where id='4'",$connect2);
			while ($clanky2 = mysql_fetch_array($getclanek2)){
				$model_global_doprava=ereg_replace(",",".",trim($clanky2['hodnota']));
			}
			$model_global_doprava_2=split("\n",$model_global_doprava);
			$model_global_doprava_3=split("; ",$model_global_doprava_2[$r2-1]);
			for ($dd=1;$dd<=12;$dd++) $mesic_dni[$dd]=0;
			for ($dd=$zahajeni;$dd<$doba;$dd=$dd+86400)	$mesic_dni[date("n",$dd)]++;
			$model_global_doprava_4=0;
			$pocet_dni_stavby=ceil(($doba-$zahajeni)/86400);
			for ($dd=1;$dd<=12;$dd++) {$model_global_doprava_4=$model_global_doprava_4+$mesic_dni[$dd]/$pocet_dni_stavby*$model_global_doprava_3[$dd-1]/100;}

			$v2_naklad=$naklady_old*(1-$model_global_doprava_4);
			$v2_cas=$cas_celkem*(1-$model_global_doprava_4);
		}

		// doprava
		$v3_naklad=0;
		$v3_cas=0;
		if ($r3){
			$getclanek2 = mysql_query("SELECT * from model_global where id='1'",$connect2);
			while ($clanky2 = mysql_fetch_array($getclanek2)){
				$model_global_doprava=ereg_replace(",",".",trim($clanky2['hodnota']));
			}
			$model_global_doprava_2=split("\n",$model_global_doprava);
			$model_global_doprava_3=split("; ",$model_global_doprava_2[$r3-1]);
			$model_global_doprava_4=$model_global_doprava_3[0]/100;
			$v3_naklad=$naklady_old*(1-$model_global_doprava_4);
			$v3_cas=$cas_celkem*(1-$model_global_doprava_4);
		}

		// havarie
		$v4_naklad=0;
		$v4_cas=0;
		if ($r4){
			$getclanek2 = mysql_query("SELECT * from model_global where id='2'",$connect2);
			while ($clanky2 = mysql_fetch_array($getclanek2)){
				$model_global_doprava=ereg_replace(",",".",trim($clanky2['hodnota']));
			}
			$model_global_doprava_2=split("\n",$model_global_doprava);
			$model_global_doprava_3=split("; ",$model_global_doprava_2[$r4-1]);
			$pocet_udalosti=floor($cas_celkem/60/$model_global_doprava_3[1]*$model_global_doprava_3[0]);
			$cas_celkem_new=$cas_celkem-$pocet_udalosti*$model_global_doprava_3[2];
			$model_global_doprava_4=$cas_celkem_new/$cas_celkem;
			$v4_naklad=$naklady_old*(1-$model_global_doprava_4);
			$v4_cas=$pocet_udalosti*$model_global_doprava_3[2];
		}

		//clovek
		$v5_naklad=0;
		$v5_cas=0;
		if ($r5){
			$getclanek2 = mysql_query("SELECT * from model_global where id='3'",$connect2);
			while ($clanky2 = mysql_fetch_array($getclanek2)){
				$model_global_doprava=ereg_replace(",",".",trim($clanky2['hodnota']));
			}
			$model_global_doprava_2=split("\n",$model_global_doprava);
			$model_global_doprava_3=split("; ",$model_global_doprava_2[$r4-1]);
			$pocet_udalosti=floor($cas_celkem/60/$model_global_doprava_3[1]*$model_global_doprava_3[0]);
			$cas_celkem_new=$cas_celkem-$pocet_udalosti*$model_global_doprava_3[2];
			$model_global_doprava_4=$cas_celkem_new/$cas_celkem;
			$v5_naklad=$naklady_old*(1-$model_global_doprava_4);
			$v5_cas=$pocet_udalosti*$model_global_doprava_3[2];
		}
		
		
		

		
		$cas_celkem_new=$cas_celkem-$v1_cas-$v2_cas-$v3_cas-$v4_cas-$v5_cas;
		
		$v0_naklad=$v1_naklad+$v2_naklad+$v3_naklad+$v4_naklad+$v5_naklad;
		$v0_cas=$v1_cas+$v2_cas+$v3_cas+$v4_cas+$v5_cas;

		$v0_zmena=number_format(($cas_celkem-$cas_celkem_new)/$cas_celkem*100,2,","," ");
		
		mysql_query("update model_varianty set v1_cas='$v1_cas',v1_naklad='$v1_naklad',v2_cas='$v2_cas',v2_naklad='$v2_naklad',v3_cas='$v3_cas',v3_naklad='$v3_naklad',v4_cas='$v4_cas',v4_naklad='$v4_naklad',v5_cas='$v5_cas',v5_naklad='$v5_naklad' where id='$id_varianty'",$connect2);
		
		
		if ($row==1) $row=2; else $row=1;
		
		echo '<tr valign="top"><td class="row'.$row.'" align="center"><font class="name2">'.$id_varianty.'</font></td>';
		echo '<td class="row'.$row.'"><font class="name2"><font color="blue">'.$nazev_obsluha_v.' (poèet: '.$obsluha_pocet.')</font><br>';
		echo '<font color="brown">'.$nazev_zakaznik_v.' (poèet: '.$zakaznik_pocet.')</font></font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2">'.ceil($v1_cas).' min</font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2">'.ceil($v2_cas).' min</font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2">'.ceil($v3_cas).' min</font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2">'.ceil($v4_cas).' min</font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2">'.ceil($v5_cas).' min</font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2">'.ceil($v0_cas).' min</font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2">'.$v0_zmena.' %</font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2"><a target="_blank" title="Graf nahodilých vlivù" href="nahoda-graf?id_v='.$id_varianty.'">Graf :</a></font></td></tr>';

	}
	echo '</table>';
	$viewdalsikrok=1;
	
}


if ($krok==7){

		echo "<h1>Krok 7: Výpoèet optimalizaèních parametrù</h1>";
		$celkem_v=mysql_result(mysql_query("SELECT count(*) FROM model_varianty where model='$model'",$connect2),0);
		echo "<h2>Celkem $celkem_v pracovních sestav</h2>";


		echo '<table class="forumline" cellspacing="0" cellpadding="2">
			<tr>
			<td align="center" class="catLeft" width="50px"><font class="name2"><b>ID</b></font></td>
			<td align="center" class="catLeft" width="200px"><font class="name2"><b>Obsluha</b><br><b>Zákazník</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Náklady, [Kè]</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Doba splnìní, [h]</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Produkce CO<sub>2</sub>, [kg]</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Spotøeba energie, [t] </b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Poèet poruch, [-]</b></font></td>
			<td align="center" class="catLeft" width="50px"><font class="name2"><b>Graf</b></font></td>
			</tr>';


	$ik=0;
	$getclanek = mysql_query("SELECT * from model_varianty where model='$model'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id_varianty=$clanky['id'];
		$obsluha_id_v=$clanky['obsluha_id'];
		$zakaznik_id_v=$clanky['zakaznik_id'];
		$cas_celkem=$clanky['cas_celkem'];
		$pocet_vstupu=$clanky['pocet_vstupu'];
		$obsluha_pocet=$clanky['obsluha_pocet'];
		$zakaznik_pocet=$clanky['zakaznik_pocet'];
		$cas_vstupu=$clanky['cas_vstupu'];
		$cas_obsluhy=$clanky['cas_obsluhy'];
		$cas_cekani=$clanky['cas_cekani'];
		
		$getclanek2 = mysql_query("SELECT * from model_obsluha where id='$obsluha_id_v'",$connect2);
		while ($clanky2 = mysql_fetch_array($getclanek2)){
			$nazev_obsluha_v=$clanky2['nazev'];
			$VC_obsluha_v=$clanky2['VC'];
			$FC_obsluha_v=$clanky2['FC'];
			$co2_obsluha_v=$clanky2['co2'];
			$SP_obsluha_v=$clanky2['SP'];
			$L_obsluha_v=$clanky2['L'];
			$TL_obsluha_v=$clanky2['TL'];
			$CL_obsluha_v=$clanky2['CL'];
		}
		$getclanek2 = mysql_query("SELECT * from model_zakaznik where id='$zakaznik_id_v'",$connect2);
		while ($clanky2 = mysql_fetch_array($getclanek2)){
			$nazev_zakaznik_v=$clanky2['nazev'];
			$cyklus_zakaznik_v=$clanky2['cyklus'];
			$vykon_zakaznik_v=$clanky2['vykon'];
			$objem_cyklu_v=$vykon_zakaznik_v*$cyklus_zakaznik_v/3600;
			$VC_zakaznik_v=$clanky2['VC'];
			$FC_zakaznik_v=$clanky2['FC'];
			$co2_zakaznik_v=$clanky2['co2'];
			$SP_zakaznik_v=$clanky2['SP'];
			$L_zakaznik_v=$clanky2['L'];
			$TL_zakaznik_v=$clanky2['TL'];
			$CL_zakaznik_v=$clanky2['CL'];
		}
		
		$casovy_fond_min=$casovy_fond_min/$produktivita;
		$cas_celkem_hod=ceil($cas_celkem/60);
		$tydnu_ukolu=$tydnu*$cas_celkem/$casovy_fond_min;
		$rozdil_doby_splneni=ceil(($tydnu-$tydnu_ukolu)*7);
		
		if ($rozdil_doby_splneni>0) $penale_bonus=-$rozdil_doby_splneni*$bonus;
		else $penale_bonus=-$rozdil_doby_splneni*$penale;
		
		if ($penale_bonus>0) $n_penale_2=$penale_bonus;
		else $n_penale_2=0;
		
		

		$pocet_poruch_celkem=$cas_celkem_hod/1000*($L_zakaznik_v*$zakaznik_pocet+$L_obsluha_v*$obsluha_pocet);
		
		if ($r1==0){
			$cas_poruch_celkem=0;
			$naklady_poruch_celkem=0;
		}else{
			$naklady_poruch_celkem=ceil($CL_zakaznik_v*$cas_celkem_hod/1000*$L_zakaznik_v*$zakaznik_pocet+$CL_obsluha_v*$cas_celkem_hod/1000*$L_obsluha_v*$obsluha_pocet);
			//$cas_poruch_celkem=$TL_zakaznik_v*$cas_celkem_hod/1000*$L_zakaznik_v+$TL_obsluha_v*$cas_celkem_hod/1000*$L_obsluha_v;
		}
		
		
		
		// Náklady
		$k1_hodnota=ceil($cas_celkem_hod*($VC_zakaznik_v*$zakaznik_pocet+$VC_obsluha_v*$obsluha_pocet)+$FC_zakaznik_v*$zakaznik_pocet+$FC_obsluha_v*$obsluha_pocet+ceil($tydnu_ukolu*7*$variabilni_naklady_stavby)+$naklady_poruch_celkem+$penale_bonus);

		// Náklady
		$n_obsluha=$cas_celkem_hod*($VC_obsluha_v*$obsluha_pocet)+$FC_obsluha_v*$obsluha_pocet;
		$n_zakaznik=$cas_celkem_hod*($VC_zakaznik_v*$zakaznik_pocet)+$FC_zakaznik_v*$zakaznik_pocet;
		$n_stavba=ceil($tydnu_ukolu*7*$variabilni_naklady_stavby);
		$n_penale=$n_penale_2;
		$n_poruchy=$naklady_poruch_celkem;
		$n_variabilni=$cas_celkem_hod*($VC_zakaznik_v*$zakaznik_pocet+$VC_obsluha_v*$obsluha_pocet)+ceil($tydnu_ukolu*7*$variabilni_naklady_stavby);
		$n_fixni=$n_penale_2+$naklady_poruch_celkem+$FC_zakaznik_v*$zakaznik_pocet+$FC_obsluha_v*$obsluha_pocet;
		
		mysql_query("update model_varianty set n_obsluha='$n_obsluha',n_zakaznik='$n_zakaznik',n_stavba='$n_stavba',n_penale='$n_penale',n_poruchy='$n_poruchy',n_variabilni='$n_variabilni',n_fixni='$n_fixni' where id='$id_varianty'",$connect2);
		
		// CO2
		$k2_hodnota=ceil($cas_celkem_hod*($co2_zakaznik_v*$zakaznik_pocet+$co2_obsluha_v*$obsluha_pocet));

		// Èas
		$k3_hodnota=ceil($cas_celkem_hod);
		 	
		// Porucha
		$k4_hodnota=ceil($pocet_poruch_celkem);

		// Energie
		$k5_hodnota=ceil($cas_celkem_hod*($SP_zakaznik_v*$zakaznik_pocet+$SP_obsluha_v*$obsluha_pocet));
		
		
		mysql_query("update model_varianty set k1_hodnota='$k1_hodnota',k2_hodnota='$k2_hodnota',k3_hodnota='$k3_hodnota',k4_hodnota='$k4_hodnota',k5_hodnota='$k5_hodnota' where id='$id_varianty'",$connect2);

		
		
		if ($row==1) $row=2; else $row=1;
		
		echo '<tr valign="top"><td class="row'.$row.'" align="center"><font class="name2">'.$id_varianty.'</font></td>';
		echo '<td class="row'.$row.'"><font class="name2"><font color="blue">'.$nazev_obsluha_v.' (poèet: '.$obsluha_pocet.')</font><br>';
		echo '<font color="brown">'.$nazev_zakaznik_v.' (poèet: '.$zakaznik_pocet.')</font></font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2">'.number_format($k1_hodnota,0,',',' ').'</font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2">'.number_format($k3_hodnota,0,',',' ').'</font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2">'.number_format($k2_hodnota/1000,1,',',' ').'</font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2">'.number_format($k5_hodnota/1000,0,',',' ').'</font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2">'.number_format($k4_hodnota,0,',',' ').'</font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2"><a target="_blank" title="Graf nákladù" href="naklady-graf?id_v='.$id_varianty.'">Graf :</a></font></td></tr>';

		$id_hodnota_matice[$ik]=$id_varianty;
		$k3_hodnota_matice[$ik]=$k3_hodnota;
		$k1_hodnota_matice[$ik][$ik]=ceil($k1_hodnota/1000);
		$k2_hodnota_matice[$ik][$ik]=ceil($k2_hodnota/1000);
		$k4_hodnota_matice[$ik][$ik]=$k4_hodnota;
		$k5_hodnota_matice[$ik][$ik]=ceil($k5_hodnota/1000);
		$ik++;
	}
	echo '</table>';
	$viewdalsikrok=1;

	$poradi=$ik;
	$getclanek = mysql_query("SELECT * from model_varianty where model='$model' order by k1_hodnota",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id_varianty=$clanky['id'];
		mysql_query("update model_varianty set k1='$poradi' where id='$id_varianty'",$connect2);
		$poradi--;
	}

	$poradi=$ik;
	$getclanek = mysql_query("SELECT * from model_varianty where model='$model' order by k2_hodnota",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id_varianty=$clanky['id'];
		mysql_query("update model_varianty set k2='$poradi' where id='$id_varianty'",$connect2);
		$poradi--;
	}

	$poradi=$ik;
	$getclanek = mysql_query("SELECT * from model_varianty where model='$model' order by k3_hodnota",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id_varianty=$clanky['id'];
		mysql_query("update model_varianty set k3='$poradi' where id='$id_varianty'",$connect2);
		$poradi--;
	}

	$poradi=$ik;
	$getclanek = mysql_query("SELECT * from model_varianty where model='$model' order by k4_hodnota",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id_varianty=$clanky['id'];
		mysql_query("update model_varianty set k4='$poradi' where id='$id_varianty'",$connect2);
		$poradi--;
	}

	$poradi=$ik;
	$getclanek = mysql_query("SELECT * from model_varianty where model='$model' order by k5_hodnota",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id_varianty=$clanky['id'];
		mysql_query("update model_varianty set k5='$poradi' where id='$id_varianty'",$connect2);
		$poradi--;
	}
	

	$getclanek = mysql_query("SELECT * from model_varianty where model='$model'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id_varianty=$clanky['id'];
		$k1=$clanky['k1'];
		$k2=$clanky['k2'];
		$k3=$clanky['k3'];
		$k4=$clanky['k4'];
		$k5=$clanky['k5'];
		$k0=ceil($k1*$k1_m+$k2*$k2_m+$k3*$k3_m+$k4*$k4_m+$k5*$k5_m);
		
		
		mysql_query("update model_varianty set k0='$k0' where id='$id_varianty'",$connect2);
	}
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

      var data = google.visualization.arrayToDataTable([
          ['Èas, hod' <?php for ($gk=0;$gk<$ik;$gk++) echo ",'ID ".$id_hodnota_matice[$gk]."'";?>],
<?php 
	for ($jk=0;$jk<$ik;$jk++) {
		echo "[ ".$k3_hodnota_matice[$jk];
		for ($gk=0;$gk<$ik;$gk++){ if ($k1_hodnota_matice[$jk][$gk]) echo ",".$k1_hodnota_matice[$jk][$gk]; else echo ",null";}
		echo "],";
	}
?>
        ]);

        var options = {
          title: 'Závislost nákladù na èase',
          hAxis: {title: 'Èas, h',baseline: <?php echo ceil($casovy_fond_min/60);?>,baselineColor:'red'},
          vAxis: {title: 'Náklady, tis. Kè'},
          legend: 'none'
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
      }
    </script>
    <div id="chart_div1" style="width: 800px; height: 500px;"></div>


    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart2);
      function drawChart2() {

      var data2 = google.visualization.arrayToDataTable([
          ['Èas, hod' <?php for ($gk=0;$gk<$ik;$gk++) echo ",'ID ".$id_hodnota_matice[$gk]."'";?>],
<?php 
	for ($jk=0;$jk<$ik;$jk++) {
		echo "[ ".$k3_hodnota_matice[$jk];
		for ($gk=0;$gk<$ik;$gk++){ if ($k2_hodnota_matice[$jk][$gk]) echo ",".$k2_hodnota_matice[$jk][$gk]; else echo ",null";}
		echo "],";
	}
?>
        ]);

        var options2 = {
          title: 'Závislost produkce CO2 na èase',
          hAxis: {title: 'Èas, h',baseline: <?php echo ceil($casovy_fond_min/60);?>,baselineColor:'red'},
          vAxis: {title: 'Produkce CO2, kg/h'},
          legend: 'none'
        };

        var chart2 = new google.visualization.ScatterChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options2);
      }
    </script>
    <div id="chart_div2" style="width: 800px; height: 500px;"></div>


    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart3);
      function drawChart3() {

      var data3 = google.visualization.arrayToDataTable([
          ['Èas, hod' <?php for ($gk=0;$gk<$ik;$gk++) echo ",'ID ".$id_hodnota_matice[$gk]."'";?>],
<?php 
	for ($jk=0;$jk<$ik;$jk++) {
		echo "[ ".$k3_hodnota_matice[$jk];
		for ($gk=0;$gk<$ik;$gk++){ if ($k5_hodnota_matice[$jk][$gk]) echo ",".$k5_hodnota_matice[$jk][$gk]; else echo ",null";}
		echo "],";
	}
?>
        ]);

        var options3 = {
          title: 'Závislost spotøeby energie na èase',
          hAxis: {title: 'Èas, h',baseline: <?php echo ceil($casovy_fond_min/60);?>,baselineColor:'red'},
          vAxis: {title: 'Spotøeba energie, l/h'},
          legend: 'none'
        };

        var chart3 = new google.visualization.ScatterChart(document.getElementById('chart_div3'));
        chart3.draw(data3, options3);
      }
    </script>
    <div id="chart_div3" style="width: 800px; height: 500px;"></div>


    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart4);
      function drawChart4() {

      var data4 = google.visualization.arrayToDataTable([
          ['Èas, hod' <?php for ($gk=0;$gk<$ik;$gk++) echo ",'ID ".$id_hodnota_matice[$gk]."'";?>],
<?php 
	for ($jk=0;$jk<$ik;$jk++) {
		echo "[ ".$k3_hodnota_matice[$jk];
		for ($gk=0;$gk<$ik;$gk++){ if ($k4_hodnota_matice[$jk][$gk]) echo ",".$k4_hodnota_matice[$jk][$gk]; else echo ",null";}
		echo "],";
	}
?>
        ]);

        var options4 = {
          title: 'Závislost poètu poruch na èase',
          hAxis: {title: 'Èas, h',baseline: <?php echo ceil($casovy_fond_min/60);?>,baselineColor:'red'},
          vAxis: {title: 'Poèet poruch'},
          legend: 'none'
        };

        var chart4 = new google.visualization.ScatterChart(document.getElementById('chart_div4'));
        chart4.draw(data4, options4);
      }
    </script>
    <div id="chart_div4" style="width: 800px; height: 500px;"></div>

	<em>Google Chart Tools: <a href="https://google-developers.appspot.com/chart/">www :</a></em>

	
<?php
}


if ($krok==8){

		echo "<h1>Krok 8: Výbìr optimální sestavy</h1>";
		$celkem_v=mysql_result(mysql_query("SELECT count(*) FROM model_varianty where model='$model'",$connect2),0);
		echo "<h2>Celkem $celkem_v pracovních sestav</h2>";
		$seradit=kontrola($_POST['seradit']);
		if (!$seradit) $seradit=0;

?>
<form  name='form' ACTION='./model-vypocet' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="krok" value="8">
<input type="hidden" name="model" value="<?php echo $model;?>">
Seøadit sestavy dle <select name="seradit">
<option value='0' <?php if ($seradit==0) echo "selected='selected'";?>>Výsledného hodnocení</option>
<option value='1' <?php if ($seradit==1) echo "selected='selected'";?>>Nákladù</option>
<option value='3' <?php if ($seradit==3) echo "selected='selected'";?>>Doby splnìní</option>
<option value='2' <?php if ($seradit==2) echo "selected='selected'";?>>Produkce CO<sub>2</sub></option>
<option value='5' <?php if ($seradit==5) echo "selected='selected'";?>>Spotøeby energie</option>
<option value='4' <?php if ($seradit==4) echo "selected='selected'";?>>Poètu poruch</option>
</select>
<INPUT TYPE="submit" VALUE="Seøadit sestavy">
</form>
<?php
		echo '<table class="forumline" cellspacing="0" cellpadding="2">
			<tr>
			<td align="center" class="catLeft" width="50px"><font class="name2"><b>ID</b></font></td>
			<td align="center" class="catLeft" width="200px"><font class="name2"><b>Obsluha</b><br><b>Zákazník</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>K1 Náklady</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>K3 Doba splnìní</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>K2 Produkce CO<sub>2</sub></b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>K5 Spotøeba energie</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>K4 Poèet poruch</b></font></td>
			<td align="center" class="catLeft" width="100px"><font class="name2"><b>Výsledné hodnocení</b></font></td>
			</tr>';
	$i=0;

	$getclanek = mysql_query("SELECT * from model_varianty where model='$model' order by k".$seradit." desc",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id_varianty=$clanky['id'];
		$obsluha_id_v=$clanky['obsluha_id'];
		$zakaznik_id_v=$clanky['zakaznik_id'];
		$k1=$clanky['k1'];
		$k2=$clanky['k2'];
		$k3=$clanky['k3'];
		$k4=$clanky['k4'];
		$k5=$clanky['k5'];
		$k0=$clanky['k0'];
		$obsluha_pocet=$clanky['obsluha_pocet'];
		$zakaznik_pocet=$clanky['zakaznik_pocet'];
		
		
		
		$getclanek2 = mysql_query("SELECT * from model_obsluha where id='$obsluha_id_v'",$connect2);
		while ($clanky2 = mysql_fetch_array($getclanek2)){
			$nazev_obsluha_v=$clanky2['nazev'];
		}
		$getclanek2 = mysql_query("SELECT * from model_zakaznik where id='$zakaznik_id_v'",$connect2);
		while ($clanky2 = mysql_fetch_array($getclanek2)){
			$nazev_zakaznik_v=$clanky2['nazev'];
		}
		if ($row==1) $row=2; else $row=1;
		echo '<tr valign="top"><td class="row'.$row.'" align="center"><font class="name2">'.$id_varianty.'</font></td>';
		echo '<td class="row'.$row.'"><font class="name2"><font color="blue">'.$nazev_obsluha_v.' (poèet: '.$obsluha_pocet.')</font><br>';
		echo '<font color="brown">'.$nazev_zakaznik_v.' (poèet: '.$zakaznik_pocet.')</font></font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2">'.number_format($k1/$celkem_v*100,2,',',' ').' %</font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2">'.number_format($k3/$celkem_v*100,2,',',' ').' %</font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2">'.number_format($k2/$celkem_v*100,2,',',' ').' %</font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2">'.number_format($k5/$celkem_v*100,2,',',' ').' %</font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2">'.number_format($k4/$celkem_v*100,2,',',' ').' %</font></td>';
		echo '<td class="row'.$row.'" align="center"><font class="name2"><b>'.number_format($k0/$celkem_v*100,2,',',' ').' %</b></font></td></tr>';
		$id_matice[$i]=$id_varianty;
		$k1_matice[$i]=round($k1/$celkem_v*100,2);
		$k2_matice[$i]=round($k2/$celkem_v*100,2);
		$k3_matice[$i]=round($k3/$celkem_v*100,2);
		$k4_matice[$i]=round($k4/$celkem_v*100,2);
		$k5_matice[$i]=round($k5/$celkem_v*100,2);
		$k0_matice[$i]=round($k0/$celkem_v*100,2);
		$i++;
	}
	
	echo '</table><br>';
?>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        var data = google.visualization.arrayToDataTable([
          ['Varianta', 'K1 Náklady', 'K3 Doba splnìní', 'K2 Produkce CO2', 'K5 Spotøeba energie', 'K4 Poèet poruch', 'Výsledné hodnocení'],
		  
          <?php for ($j=0;$j<$i;$j++) echo "['ID ".$id_matice[$j]."',".$k1_matice[$j].",".$k3_matice[$j].",".$k2_matice[$j].",".$k5_matice[$j].",".$k4_matice[$j].",".$k0_matice[$j]."],";?>
        ]);

        var options = {
          title : 'Hodnocení sestav',
          vAxis: {title: "Hodnocení, %",textStyle:{fontSize: 12}},
          hAxis: {title: "Varianta",textStyle:{fontSize: 10}},
          seriesType: "bars",
          series: {5: {type: "line"}},
		  chartArea: {width: '96%', height: '80%'},
  		  legend: {position: 'top',textStyle:{fontSize: 10}}
		  };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
      google.setOnLoadCallback(drawVisualization);
    </script>
<div style="width: 800px;overflow-x: auto;overflow-y: none;text-align:left">
<div id="chart_div" style="width: 4000px; height: 500px;"></div>
</div>

<em>Google Chart Tools: <a href="https://google-developers.appspot.com/chart/">www :</a></em>
<?php
}

if ($viewdalsikrok){?>

<hr>
<form  name='form' ACTION='./model-vypocet' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="krok" value="<?php echo ($krok+1);?>">
<input type="hidden" name="model" value="<?php echo $model;?>">
<?php
if ($krok!=4){?>
<INPUT TYPE="submit" VALUE="Další krok">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zpìt">
<?php }else{?>
<INPUT onClick="window.open('http://www.celysvet.cz/model/cas-algoritmu?model=<?php echo $model;?>','Èas algoritmu','height=125,width=500,left=300, top=300,resizable=no,scrollbars=no,status=no,location=no,directories=no,menubar=no,toolbar=no');" TYPE="submit" VALUE="Další krok">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zpìt">
<?php }?>
</form>
<?php }
else
	echo "<h1><a href='modelovani?model=".$model."&status=1'>Editovat model :</a></h1>";
	
$doba_skriptu_konec = round(doba_skriptu() - $doba_skriptu_zacatek, 5);
echo "<br><br><em>Doba trvání PHP skriptu: ".$doba_skriptu_konec." sekund</em>";
?>