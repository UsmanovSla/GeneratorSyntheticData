<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head>
<meta http-equiv="Content-Language" content="cs"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title><?php echo $titl; ?></title><meta name="keywords" content="<?php echo $titl2; ?>"><meta name="description" content="<?php echo $titl2; ?>"><link rel="stylesheet" href="./skin/tisk.css"><link rel="shortcut icon" href="./skin/model.ico">
</head><body>
<img src="./skin/tisk.png" width="700px"><br>
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


$getclanek = mysql_query("SELECT * FROM optimalizace_katalog_stroju where id='$id'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id= $clanky['id'];
		$nazev= $clanky['nazev'];
		$skupina1= $clanky['skupina1'];
		$skupina2= $clanky['skupina2'];
		$typ= $clanky['typ'];
		$druh_prvku= $clanky['druh_prvku'];
		$vykon_kW= $clanky['vykon_kW'];
		$provozni_hmotnost_kg= $clanky['provozni_hmotnost_kg'];
		$delka_cm= $clanky['delka_cm'];
		$sirka_cm= $clanky['sirka_cm'];
		$vyska_cm= $clanky['vyska_cm'];
		$max_rychlost_km_h= $clanky['max_rychlost_km_h'];
		$provozni_rychlost_km_h= $clanky['provozni_rychlost_km_h'];
		$stoupavost_stupnu= $clanky['stoupavost_stupnu'];
		$tlak_na_zeminu_kPa= $clanky['tlak_na_zeminu_kPa'];
		$pridavne_zarizeni_1= $clanky['pridavne_zarizeni_1'];
		$pridavne_zarizeni_2= $clanky['pridavne_zarizeni_2'];
		$pridavne_zarizeni_3= $clanky['pridavne_zarizeni_3'];
		$pridavne_zarizeni_4= $clanky['pridavne_zarizeni_4'];
		$pridavne_zarizeni_5= $clanky['pridavne_zarizeni_5'];
		$dosah_hloubka_cm= $clanky['dosah_hloubka_cm'];
		$dosah_vyska_cm= $clanky['dosah_vyska_cm'];
		$dosah_delka_cm= $clanky['dosah_delka_cm'];
		$polomer_otaceni_cm= $clanky['polomer_otaceni_cm'];
		$poznamka= $clanky['poznamka'];
		$spotreba_paliva_hi_ml_hod= $clanky['spotreba_paliva_hi_ml_hod'];
		$spotreba_paliva_medium_ml_hod= $clanky['spotreba_paliva_medium_ml_hod'];
		$spotreba_paliva_low_ml_hod= $clanky['spotreba_paliva_low_ml_hod'];
		$co2_hi_ml_hod= $clanky['co2_hi_ml_hod'];
		$co2_medium_ml_hod= $clanky['co2_medium_ml_hod'];
		$co2_low_ml_hod= $clanky['co2_low_ml_hod'];
		$hluk_int= $clanky['hluk_int'];
		$hluk_ext= $clanky['hluk_ext'];
		$naklady_standardni_sazba_kc_hod= $clanky['naklady_standardni_sazba_kc_hod'];
		$naklady_prescasova_sazba_kc_hod= $clanky['naklady_prescasova_sazba_kc_hod'];
		$naklady_na_pouziti_kc= $clanky['naklady_na_pouziti_kc'];
		$cena_stroje= $clanky['cena_stroje'];
		$pravdepodobnost_poruchy_1000_hod= $clanky['pravdepodobnost_poruchy_1000_hod'];
		$prumerna_doba_opravy_min= $clanky['prumerna_doba_opravy_min'];
		$prumerna_cena_opravy_kc= $clanky['prumerna_cena_opravy_kc'];
		$prumerna_doba_sluzby_let= $clanky['prumerna_doba_sluzby_let'];
		$minimalni_pracovni_plocha_m2= $clanky['minimalni_pracovni_plocha_m2'];
		$pocet_jednotek= $clanky['pocet_jednotek'];
		$jednotka= $clanky['jednotka'];
		$pracovni_vykon_jednotka_hod= $clanky['pracovni_vykon_jednotka_hod'];
		$pracovni_cyklus_sek= $clanky['pracovni_cyklus_sek'];
		$vyrobce= $clanky['vyrobce'];
		if ($row==1) $row=2;else $row=1;
	}


?>
<h2>Katalogov� list stroje: <?php echo $typ." (ID: ".$id.")";?></h2>
<table style="border: 1px solid black" cellspacing="0" cellpadding="2" width="700px">
<tr><td width="50%">
<table width="350px" border="1">
<?php
if (file_exists("./photo/low/".$id.".jpg")){?>
<tr><td colspan='2'><img border='0' src='./photo/low/<?php echo $id;?>.jpg' title='Foto stroje'></td></tr>
<?php }?>


<tr><td><em>N�zev stroje:</em></td><td><?php echo $nazev;?></td></tr>

<tr><td><em>Prvn� skupina:</em></td><td>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_1 where id='$skupina1'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo $clanky['nazev'];
	}
?></td></tr>

<tr><td><em>Druh� skupina:</em></td><td>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_2 where id='$skupina2'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo $clanky['nazev'];
	}
?></td></tr>


<tr><td><em>Typ stroje:</em></td><td><?php echo $typ;?></td></tr>
<tr><td><em>Druh prvku:</em></td><td><?php if ($druh_prvku==1) echo "Obsluhuj�c� prvek";?><?php if ($druh_prvku==2) echo "Obsluhovan� prvek";?><?php if ($druh_prvku==3) echo "Samostatn� prvek";?></td></tr>

<tr><td><em>V�kon motoru:</em></td><td><?php echo $vykon_kW;?> kW</td></tr>

<tr><td><em>Provozn� hmotnost:</em></td><td><?php echo $provozni_hmotnost_kg;?> t</td></tr>
<tr><td><em>D�lka:</em></td><td><?php echo $delka_cm;?> cm</td></tr>
<tr><td><em>��rka:</em></td><td><?php echo $sirka_cm;?> cm</td></tr>
<tr><td><em>V��ka:</em></td><td><?php echo $vyska_cm;?> cm</td></tr>
<tr><td><em>Maxim�ln� rychlost:</em></td><td><?php echo $max_rychlost_km_h;?> km/h</td></tr>
<tr><td><em>Provozn� rychlost:</em></td><td><?php echo $provozni_rychlost_km_h;?> km/h</td></tr>
<tr><td><em>Stoupavost:</em></td><td><?php echo $stoupavost_stupnu;?> grad</td></tr>
<tr><td><em>Tlak na zeminu:</em></td><td><?php echo $tlak_na_zeminu_kPa;?> kPa</td></tr>

<tr><td><em>P��davn� za��zeni 1:</em></td><td>
<?php 
if ($pridavne_zarizeni_1) {
	$getclanek = mysql_query("SELECT * FROM optimalizace_pridavna_zarizeni where id=$pridavne_zarizeni_1",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo $clanky['nazev'].' / '.$clanky['pracovni_vykon_jednotka_hod'].' '.$clanky['jednotka'].'/hod';	
	}
}else echo "-";
?>
</td></tr>
<tr><td><em>P��davn� za��zen� 2:</em></td><td><?php 
if ($pridavne_zarizeni_2) {
	$getclanek = mysql_query("SELECT * FROM optimalizace_pridavna_zarizeni where id=$pridavne_zarizeni_2",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo $clanky['nazev'].' / '.$clanky['pracovni_vykon_jednotka_hod'].' '.$clanky['jednotka'].'/hod';	
	}
}else echo "-";
?>
</td></tr>
<tr><td><em>P��davn� za��zen� 3:</em></td><td><?php 
if ($pridavne_zarizeni_3) {
	$getclanek = mysql_query("SELECT * FROM optimalizace_pridavna_zarizeni where id=$pridavne_zarizeni_3",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo $clanky['nazev'].' / '.$clanky['pracovni_vykon_jednotka_hod'].' '.$clanky['jednotka'].'/hod';	
	}
}else echo "-";
?>
</td></tr>
<tr><td><em>P��davn� za��zen� 4:</em></td><td><?php 
if ($pridavne_zarizeni_4) {
	$getclanek = mysql_query("SELECT * FROM optimalizace_pridavna_zarizeni where id=$pridavne_zarizeni_4",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo $clanky['nazev'].' / '.$clanky['pracovni_vykon_jednotka_hod'].' '.$clanky['jednotka'].'/hod';	
	}
}else echo "-";
?>
</td></tr>
<tr><td><em>P��davn� za��zen� 5:</em></td><td><?php 
if ($pridavne_zarizeni_5) {
	$getclanek = mysql_query("SELECT * FROM optimalizace_pridavna_zarizeni where id=$pridavne_zarizeni_5",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo $clanky['nazev'].' / '.$clanky['pracovni_vykon_jednotka_hod'].' '.$clanky['jednotka'].'/hod';	
	}
}else echo "-";
?>
</td></tr>

</table>
</td><td width="50%" valign="top">
<table width="350px" border="1">
<tr><td><em>Dosah hloubka:</em></td><td><?php echo $dosah_hloubka_cm;?> cm</td></tr>
<tr><td><em>Dosah v��ka:</em></td><td><?php echo $dosah_vyska_cm;?> cm</td></tr>
<tr><td><em>Dosah d�lka:</em></td><td><?php echo $dosah_delka_cm;?> cm</td></tr>
<tr><td><em>Polom�r ot��en�:</em></td><td><?php echo $polomer_otaceni_cm;?> cm</td></tr>
<tr><td><em>Pozn�mka:</em></td><td><?php echo $poznamka;?></td></tr>
<tr><td><em>Spot�eba paliva vysok�:</em></td><td><?php echo $spotreba_paliva_hi_ml_hod;?> ml/h</td></tr>
<tr><td><em>Spot�eba paliva st�edn�:</em></td><td><?php echo $spotreba_paliva_medium_ml_hod;?> ml/h</td></tr>
<tr><td><em>Spot�eba paliva n�zk�:</em></td><td><?php echo $spotreba_paliva_low_ml_hod;?> ml/h</td></tr>
<tr><td><em>Produkce CO<sub>2</sub> vysok�:</em></td><td><?php echo $co2_hi_ml_hod;?> g/h</td></tr>
<tr><td><em>Produkce CO<sub>2</sub> st�edn�:</em></td><td><?php echo $co2_medium_ml_hod;?> g/h</td></tr>
<tr><td><em>Produkce CO<sub>2</sub> n�zk�:</em></td><td><?php echo $co2_low_ml_hod;?> g/h</td></tr>
<tr><td><em>Hluk v interi�ru:</em></td><td><?php echo $hluk_int;?> dB</td></tr>
<tr><td><em>Hluk v exteri�ru:</em></td><td><?php echo $hluk_ext;?> dB</td></tr>
<tr><td><em>N�klady, standardn� sazba:</em></td><td><?php echo $naklady_standardni_sazba_kc_hod;?> K�/h</td></tr>
<tr><td><em>N�klady, p�es�asov� sazba:</em></td><td><?php echo $naklady_prescasova_sazba_kc_hod;?> K�/h</td></tr>
<tr><td><em>N�klady na pou�it�:</em></td><td><?php echo $naklady_na_pouziti_kc;?> K�</td></tr>
<tr><td><em>Cena stroje:</em></td><td><?php echo $cena_stroje;?> K�</td></tr>
<tr><td><em>Pravd�podobnost poruchy:</em></td><td><?php echo $pravdepodobnost_poruchy_1000_hod;?> po�et poruch/1000 h</td></tr>
<tr><td><em>Pr�m�rn� doba opravy:</em></td><td><?php echo $prumerna_doba_opravy_min;?> min</td></tr>
<tr><td><em>Pr�m�rn� cena opravy:</em></td><td><?php echo $prumerna_cena_opravy_kc;?> K�</td></tr>
<tr><td><em>Pr�m�rn� doba slu�by:</em></td><td><?php echo $prumerna_doba_sluzby_let;?> let</td></tr>
<tr><td><em>Minim�ln� pracovn� plocha:</em></td><td><?php echo $minimalni_pracovni_plocha_m2;?> m<sup>2</sup></td></tr>
<tr><td><em>Po�et jednotek:</em></td><td><?php echo $pocet_jednotek;?> <?php echo $jednotka;?></td></tr>
<tr><td><em>Pracovn� cyklus:</em></td><td><?php echo $pracovni_cyklus_sek;?> s</td></tr>
<tr><td><em>Pracovn� v�kon:</em></td><td><?php echo $pracovni_vykon_jednotka_hod;?> <?php echo $jednotka;?>/h</td></tr>
<tr><td><em>V�robce:</em></td><td><?php echo $vyrobce;?></td></tr>

</table>
</td></tr></table>
<?php
}else{



$celkem=mysql_result(mysql_query("SELECT count(*) FROM optimalizace_katalog_stroju",$connect2),0);


?>
Celkem bylo nalezeno <?php echo $celkem;?> stroj�
<table border="1" style="border: 1px solid black" cellspacing="0" cellpadding="2">
<tr>
<td align="center"><font class="name2"><b>��s.kl��</b></font></td>
<td align="center" width="150px"><font class="name2"><b>Typ</b></font></td>
<td align="center" width="250px"><font class="name2"><b>N�zev stroje</b></font></td>
<td align="center"><font class="name2"><b>V�kon, [kW]</b></font></td>
<td align="center"><font class="name2"><b>Hmotnost, [t]</b></font></td>
<td align="center" width="200px"><font class="name2"><b>Sekce</b></font></td>
<td align="center"><font class="name2"><b>V�robce</font></td>
<td align="center"><font class="name2"><b>Cena stroje, [tis.K�]</b></font></td>
<td align="center"><font class="name2"><b>Pron�jem stroje, [K�/h]</b></font></td>
<td align="center"><font class="name2"><b>Pracovn� v�kon, [jedn/h]</b></font></td>
<td align="center"><font class="name2"><b>Pracovn� cyklus, [s]</b></font></td>
</tr>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_katalog_stroju Order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){


		$CisKlic= $clanky['id'];
		$typ= $clanky['typ'];
		$nazev= $clanky['nazev'];
		$vykon_kW= $clanky['vykon_kW'];
		$provozni_hmotnost_kg= number_format($clanky['provozni_hmotnost_kg']/1000,2,","," ");
		$vyrobce= $clanky['vyrobce'];
		
		if ($row==1) $row=2;else $row=1;

		$skupina1= $clanky['skupina1'];
		$skupina2= $clanky['skupina2'];
		
		$getclanek2 = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_1 where id='$skupina1'",$connect2);
		while ($clanky2 = mysql_fetch_array($getclanek2)){
			$sekce1=$clanky2['nazev'];
		}
		$getclanek2 = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_2 where id='$skupina2'",$connect2);
		while ($clanky2 = mysql_fetch_array($getclanek2)){
			$sekce2=$clanky2['nazev'];
		}
			
		$cena_stroje= number_format($clanky['cena_stroje']/1000,3,","," ");
		$naklady_standardni_sazba_kc_hod= number_format($clanky['naklady_standardni_sazba_kc_hod'],0,","," ");
		$pracovni_vykon_jednotka_hod=$clanky['naklady_standardni_sazba_kc_hod']." ".$clanky['jednotka']."/hod";
		$pracovni_cyklus_sek=$clanky['pracovni_cyklus_sek'];
		
		echo '<tr><td align="center" class="row'.$row.'"><font class="name2">'.$CisKlic.'</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$typ.'</font></td>';



		echo '<td align="left" class="row'.$row.'"><font class="name2">'.$nazev.'</b></font></td>
		<td align="center" class="row'.$row.'"><font class="name2">'.$vykon_kW.'</font></td>
		<td align="right" class="row'.$row.'"><font class="name2">'.$provozni_hmotnost_kg.'</font></td>
		<td align="left" class="row'.$row.'"><font class="name2">'.$sekce1.'<br>'.$sekce2.'</font></td>
		<td align="center" class="row'.$row.'"><font class="name2">'.$vyrobce.'</font></td>
		<td align="center" class="row'.$row.'"><font class="name2">'.$cena_stroje.'</font></td>
		<td align="center" class="row'.$row.'"><font class="name2">'.$naklady_standardni_sazba_kc_hod.'</font></td>
		<td align="center" class="row'.$row.'"><font class="name2">'.$pracovni_vykon_jednotka_hod.'</font></td>
		<td align="center" class="row'.$row.'"><font class="name2">'.$pracovni_cyklus_sek.'</font></td>
		</tr>';
	}
	echo "</table>";

}


?>
<br><form><input type="button" value="Vytisknout" onclick="window.print();"></form>
<br><br>
Copyright (c) 2011-2012 by FSv, �VUT. V�echna pr�va vyhrazena ! Ur�eno jen pro osobn� vyu�it�. Kontaktn� e-mail: usmanov(zav)seznam.cz
</body></html>