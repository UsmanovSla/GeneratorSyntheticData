<?php 
$connect = $connect2;

echo "<h1>".$titl."</h1>";


$pocetc=50;


function kontrola ($promenna){
//	$promenna = EregI_Replace("<", "&lt;", $promenna);
//	$promenna = EregI_Replace(">", "&gt;", $promenna);
//	$promenna = EregI_Replace('"', '&quot;', $promenna);
//	$promenna = EregI_Replace('\'', '&quot;', $promenna);
//	$promenna=htmlspecialchars($promenna);
//	$promenna=addslashes($promenna);
//	$promenna=quotemeta($promenna);
return $promenna;
}


function kontrola2 ($promenna){
//	$promenna = EregI_Replace("<", "&lt;", $promenna);
//	$promenna = EregI_Replace(">", "&gt;", $promenna);
//	$promenna = EregI_Replace('"', '&quot;', $promenna);
//	$promenna = EregI_Replace('\'', '&quot;', $promenna);
//	$promenna = EregI_Replace(",", ".", $promenna);
//	$promenna = EregI_Replace(" ", "", $promenna);
//	$promenna=htmlspecialchars($promenna);
return $promenna;
}

$lock = 1;
if (($userid==2)or($jmeno=="Contec")) $lock=0;



$editobsluha = kontrola($_POST['editobsluha']);
$delobsluha = kontrola($_POST['delobsluha']);
$newobsluha = kontrola($_POST['newobsluha']);

if (!$editobsluha) $editobsluha = kontrola($_GET['editobsluha']);
if (!$delobsluha) $delobsluha = kontrola($_GET['delobsluha']);
if (!$newobsluha) $newobsluha = kontrola($_GET['newobsluha']);



if ($editobsluha) $viewdalsikrok=1;
if ($delobsluha) $viewdalsikrok=1;
if ($newobsluha) $viewdalsikrok=1;

$krok=kontrola($_POST['krok']);
$model=kontrola($_POST['model']);




if (!$model) $model = kontrola($_GET['model']);
if (!$krok) $krok = kontrola($_GET['krok']);




$pozice = kontrola($_POST['pozice']);
$status = kontrola($_POST['status']);
$razeni = kontrola($_POST['razeni']);




if (!$status) $status = kontrola($_GET['status']);
if (!$razeni) $razeni = kontrola($_GET['razeni']);
if (!$pozice) $pozice = kontrola($_GET['pozice']);
if ($pozice=="") $pozice=0;
if ($status=="") $status=0;
if ($razeni=="") $razeni=0;

if (($status==1)and($lock==1)) $status=0;
if (($status==101)and($lock==1)) $status=0;

if (($status==4)and($lock==1)) $status=0;
if (($status==401)and($lock==1)) $status=0;
if (($status==402)and($lock==1)) $status=0;

if (($status==3)and($lock==1)) $status=0;
if (($status==301)and($lock==1)) $status=0;
if (($status==302)and($lock==1)) $status=0;
if (($status==303)and($lock==1)) $status=0;
if (($status==304)and($lock==1)) $status=0;
if (($status==305)and($lock==1)) $status=0;


if (($status==6)and($lock==1)) $status=0;
if (($status==601)and($lock==1)) $status=0;

if (($status==8)and($lock==1)) $status=0;
if (($status==801)and($lock==1)) $status=0;

if (($status==9)and($lock==1)) $status=0;
if (($status==901)and($lock==1)) $status=0;


// EXPORT tabulky - formular
if ($status==3){
}

// EXPORT tabulky - CSV
if ($status==301){


}


// EXPORT tabulky - EXCEL
if ($status==302){


}


// EXPORT tabulky - TXT
if ($status==303){


}

// EXPORT tabulky - CONTEC
if ($status==304){


}

// EXPORT tabulky - DOC
if ($status==305){


}


// Import tabulky - formular
if ($status==4){
}

// Import tabulky - Kontrola souboru
if ($status==401){

}

// Import tabulky - Ukladani do databaze
if ($status==402){
}



// Vyhledavani cinnosti - vysledek
if ($status==501){


}


// Vyhledavani - formular
if ($status==5){
}

// Novy zaznam tabulky -pridani do MySQL
if ($status==101){

	if (!$krok){
		$nazev=kontrola($_POST['nazev']);
		$adresa=kontrola($_POST['adresa']);
		$firma=kontrola($_POST['firma']);
		$osoba=kontrola($_POST['osoba']);
		$poznamka=kontrola($_POST['poznamka']);

		if (!$model){
			$time=time();
			$ip=getenv ("REMOTE_ADDR");
			if ($nazev) {
				mysql_query("INSERT INTO `model` ( `nazev` ,`adresa` ,`firma` ,`osoba` ,`time` ,`ip`,`poznamka`) values ('$nazev','$adresa','$firma','$osoba','$time','$ip','$poznamka');",$connect2);
				$model=MySQL_insert_id($connect2);
				$krok=1;
				$status=1;
			}else $status=0;
		}else{
			if ($nazev) {
				mysql_query("update `model` set nazev='$nazev' ,adresa='$adresa' ,firma='$firma',osoba='$osoba',poznamka='$poznamka' where id='$model';",$connect2);
				$krok=1;
				$status=1;
			}else $status=0;
		}
	}

	
	if (($status==101)and($krok==1)){
		$objem=kontrola2($_POST['objem']);
		$jednotka=kontrola($_POST['jednotka']);
		$doba=kontrola($_POST['doba']);
		$plocha=kontrola2($_POST['plocha']);
		$smena=kontrola2($_POST['smena']);
		$tyden=kontrola2($_POST['tyden']);

		$smena_prescas=kontrola2($_POST['smena_prescas']);
		
		$koeficient_prescasu=kontrola2($_POST['koeficient_prescasu']);
		
		
		$variabilni_naklady=kontrola2($_POST['variabilni_naklady']);
		$bonus=kontrola2($_POST['bonus']);
		$penale=kontrola2($_POST['penale']);
		$rozptyl_vysledku=kontrola2($_POST['rozptyl_vysledku']);

		$produktivita=kontrola2($_POST['produktivita']);
		$zahajeni=kontrola($_POST['zahajeni']);
		$zahajeni2=split("\.",$zahajeni);
		$zahajeni3=mktime(0, 0, 0, $zahajeni2[1], $zahajeni2[0], $zahajeni2[2]);

		$doba2=split("\.",$doba);
		$doba3=mktime(0, 0, 0, $doba2[1], $doba2[0], $doba2[2]);

		mysql_query("update `model` set objem='$objem',jednotka='$jednotka',doba='$doba3',plocha='$plocha',smena='$smena',tyden='$tyden',zahajeni='$zahajeni3', produktivita='$produktivita', variabilni_naklady='$variabilni_naklady', bonus='$bonus', penale='$penale', smena_prescas='$smena_prescas',koeficient_prescasu='$koeficient_prescasu',rozptyl_vysledku='$rozptyl_vysledku' where id='$model';",$connect2);		
		$krok=2;
		$status=1;
	}


	if (($status==101)and($krok==2)){

		$obsluha=mysql_result(mysql_query("SELECT count(*) FROM model_obsluha where model='$model';",$connect2),0);
		$zakaznici=mysql_result(mysql_query("SELECT count(*) FROM model_zakaznik where model='$model';",$connect2),0);
		mysql_query("update `model` set obsluha='$obsluha',zakaznici='$zakaznici' where id='$model';",$connect2);		
		$krok=3;
		$status=1;
	}

	if (($status==101)and($krok==3)){

		$obsluha=mysql_result(mysql_query("SELECT count(*) FROM model_obsluha where model='$model';",$connect2),0);
		$zakaznici=mysql_result(mysql_query("SELECT count(*) FROM model_zakaznik where model='$model';",$connect2),0);
		mysql_query("update `model` set obsluha='$obsluha',zakaznici='$zakaznici' where id='$model';",$connect2);		
		$krok=4;
		$status=1;
	}

	
	if (($status==101)and($krok==4)){
		$kendall_x=kontrola2($_POST['kendall_x']);
		$kendall_y=kontrola2($_POST['kendall_y']);
		$pocet_iteraci=kontrola2($_POST['pocet_iteraci']);
		$k1=kontrola2($_POST['k1']);
		$k2=kontrola2($_POST['k2']);
		$k3=kontrola2($_POST['k3']);
		$k4=kontrola2($_POST['k4']);
		$k5=kontrola2($_POST['k5']);
		
		if ($pocet_iteraci=="-") $pocet_iteraci=1000;
		if ($pocet_iteraci<0) $pocet_iteraci=1000;
		if ($pocet_iteraci>100000) $pocet_iteraci=100000;
		
		if (!$kendall_x) $kendall_x="M";
		if (!$kendall_y) $kendall_y="M";
		
		
		$kk=$k1+$k2+$k3+$k4+$k5;

		if ($kk<=0) {$k1=1;$kk=1;}
		
		$k1=$k1/$kk;
		$k2=$k2/$kk;
		$k3=$k3/$kk;
		$k4=$k4/$kk;
		$k5=1-$k1-$k2-$k3-$k4;
		
		mysql_query("update `model` set k1='$k1',k2='$k2',k3='$k3',k4='$k4',k5='$k5',kendall_x='$kendall_x',kendall_y='$kendall_y',pocet_iteraci='$pocet_iteraci' where id='$model';",$connect2);		
		$krok=5;
		$status=1;
	}
	

	if (($status==101)and($krok==5)){
		$r1=kontrola2($_POST['r1']);
		$r2=kontrola2($_POST['r2']);
		$r3=kontrola2($_POST['r3']);
		$r4=kontrola2($_POST['r4']);
		$r5=kontrola2($_POST['r5']);
		
		
		if ($r1<0) $r1=0;
		if ($r2<0) $r2=0;
		if ($r3<0) $r3=0;
		if ($r4<0) $r4=0;
		if ($r5<0) $r5=0;

		if ($r1>3) $r1=3;
		if ($r2>3) $r2=3;
		if ($r3>3) $r3=3;
		if ($r4>3) $r4=3;
		if ($r5>3) $r5=3;
		
		mysql_query("update `model` set r1='$r1',r2='$r2',r3='$r3',r4='$r4',r5='$r5' where id='$model';",$connect2);		
		$krok=6;
		$status=1;
	}

	
	if ($krok==6){
		echo "<h1><font color=green>Nov� model byl �sp�n� ulo�en do datab�ze !</font></h1><hr>";
		$status=0;
	}


}



// Novy zaznam tabulky - obsluha

if ($status==1010){


	$obsluha=kontrola($_POST['obsluha']);
	$max_pocet=kontrola2($_POST['max_pocet']);
	$obsluhaid=split("-",$obsluha);
	if ($obsluhaid[1])
	$getclanek = mysql_query("SELECT * from optimalizace_pridavna_zarizeni where id='".$obsluhaid[1]."' limit 0,1",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$pracovni_vykon_jednotka_hod=$clanky['pracovni_vykon_jednotka_hod'];
		$pracovni_cyklus_sek=$clanky['pracovni_cyklus_sek'];
		$nazevdopln=$clanky['nazev'];
	}

	$getclanek = mysql_query("SELECT * from optimalizace_katalog_stroju where id='".$obsluhaid[0]."' limit 0,1",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if (!$pracovni_vykon_jednotka_hod) $pracovni_vykon_jednotka_hod=$clanky['pracovni_vykon_jednotka_hod'];
		if (!$pracovni_cyklus_sek) $pracovni_cyklus_sek=$clanky['pracovni_cyklus_sek'];
		
				
		if ($clanky['nazev']){
			if ($nazevdopln) $nazevpoln=$clanky['nazev']." / ".$nazevdopln;
			else $nazevpoln=$clanky['nazev'];
			
			mysql_query("INSERT INTO `model_obsluha` ( `id` , `model` , `nazev` , `vykon` , `cyklus` , `maximalni_pocet` , `plocha` , `VC` , `FC` , `L` , `TL` , `CL` , `SP` , `co2` , `optimalni_pocet` , `vypocet_naklady` , `vypocet_cas` , `vypocet_co2` , `vypocet_spolehlivost` , `vypocet_energie`,`stroj`,`pridavne_zarizeni` ) VALUES ( '', '".$model."', '".$nazevpoln."', '".$pracovni_vykon_jednotka_hod."', '".$pracovni_cyklus_sek."', '".$max_pocet."', '".$clanky['minimalni_pracovni_plocha_m2']."', '".$clanky['naklady_standardni_sazba_kc_hod']."', '".$clanky['naklady_na_pouziti_kc']."', '".$clanky['pravdepodobnost_poruchy_1000_hod']."', '".$clanky['prumerna_doba_opravy_min']."', '".$clanky['prumerna_cena_opravy_kc']."', '".$clanky['spotreba_paliva_medium_ml_hod']."', '".$clanky['co2_medium_ml_hod']."', '', '', '', '', '', '', '".$obsluhaid[0]."', '".$obsluhaid[1]."');",$connect2);
		}
	}
	$status=1;
	$krok=2;
	$viewdalsikrok=0;

}

// Vymazavani zaznamu
if ($status==1020){
	if ($delobsluha) mysql_query("delete from model_obsluha where id='$delobsluha'",$connect2);
	$status=1;
	$krok=2;
	$delobsluha=0;
	$viewdalsikrok=0;
}

// Vymazavani zaznamu
if ($status==1030){
	if ($editobsluha){
		$nazev=kontrola($_POST['nazev']);
		$vykon=kontrola2($_POST['vykon']);
		$cyklus=kontrola2($_POST['cyklus']);
		$plocha=kontrola2($_POST['plocha']);
		$VC=kontrola2($_POST['VC']);
		$FC=kontrola2($_POST['FC']);
		$L=kontrola2($_POST['L']);
		$TL=kontrola2($_POST['TL']);
		$CL=kontrola2($_POST['CL']);
		$SP=kontrola2($_POST['SP']);
		$co2=kontrola2($_POST['co2']);
		$maximalni_pocet =kontrola2($_POST['maximalni_pocet']);

		mysql_query("update model_obsluha set nazev='$nazev',vykon='$vykon',cyklus='$cyklus',plocha='$plocha',VC='$VC',FC='$FC',L='$L',TL='$TL',CL='$CL',SP='$SP',co2='$co2',maximalni_pocet ='$maximalni_pocet' where id='$editobsluha'",$connect2);
		
	}
	$status=1;
	$krok=2;
	$editobsluha=0;
	$viewdalsikrok=0;
}



// Novy zaznam tabulky - obsluha

if ($status==2010){


	$obsluha=kontrola($_POST['obsluha']);
	$max_pocet=kontrola2($_POST['max_pocet']);
	$obsluhaid=split("-",$obsluha);
	if ($obsluhaid[1]){
	$getclanek = mysql_query("SELECT * from optimalizace_pridavna_zarizeni where id='".$obsluhaid[1]."' limit 0,1",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$pracovni_vykon_jednotka_hod=$clanky['pracovni_vykon_jednotka_hod'];
		$pracovni_cyklus_sek=$clanky['pracovni_cyklus_sek'];
		$nazevdopln=$clanky['nazev'];
	}
	}

	$getclanek = mysql_query("SELECT * from optimalizace_katalog_stroju where id='".$obsluhaid[0]."' limit 0,1",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if (!$pracovni_vykon_jednotka_hod) $pracovni_vykon_jednotka_hod=$clanky['pracovni_vykon_jednotka_hod'];
		if (!$pracovni_cyklus_sek) $pracovni_cyklus_sek=$clanky['pracovni_cyklus_sek'];
		
				
		if ($clanky['nazev']){
			if ($nazevdopln) $nazevpoln=$clanky['nazev']." / ".$nazevdopln;
			else $nazevpoln=$clanky['nazev'];
			
			mysql_query("INSERT INTO `model_zakaznik` ( `id` , `model` , `nazev` , `vykon` , `cyklus` , `maximalni_pocet` , `plocha` , `VC` , `FC` , `L` , `TL` , `CL` , `SP` , `co2` , `optimalni_pocet` , `vypocet_naklady` , `vypocet_cas` , `vypocet_co2` , `vypocet_spolehlivost` , `vypocet_energie`,`stroj`,`pridavne_zarizeni` ) VALUES ( '', '".$model."', '".$nazevpoln."', '".$pracovni_vykon_jednotka_hod."', '".$pracovni_cyklus_sek."', '".$max_pocet."', '".$clanky['minimalni_pracovni_plocha_m2']."', '".$clanky['naklady_standardni_sazba_kc_hod']."', '".$clanky['naklady_na_pouziti_kc']."', '".$clanky['pravdepodobnost_poruchy_1000_hod']."', '".$clanky['prumerna_doba_opravy_min']."', '".$clanky['prumerna_cena_opravy_kc']."', '".$clanky['spotreba_paliva_medium_ml_hod']."', '".$clanky['co2_medium_ml_hod']."', '', '', '', '', '', '', '".$obsluhaid[0]."', '".$obsluhaid[1]."');",$connect2);
		}
	}
	$status=1;
	$krok=3;
	$viewdalsikrok=0;

}

// Vymazavani zaznamu
if ($status==2020){
	if ($delobsluha) mysql_query("delete from model_zakaznik where id='$delobsluha'",$connect2);
	$status=1;
	$krok=3;
	$delobsluha=0;
	$viewdalsikrok=0;
}

// Vymazavani zaznamu
if ($status==2030){
	if ($editobsluha){
		$nazev=kontrola($_POST['nazev']);
		$vykon=kontrola2($_POST['vykon']);
		$cyklus=kontrola2($_POST['cyklus']);
		$plocha=kontrola2($_POST['plocha']);
		$VC=kontrola2($_POST['VC']);
		$FC=kontrola2($_POST['FC']);
		$L=kontrola2($_POST['L']);
		$TL=kontrola2($_POST['TL']);
		$CL=kontrola2($_POST['CL']);
		$SP=kontrola2($_POST['SP']);
		$co2=kontrola2($_POST['co2']);
		$maximalni_pocet =kontrola2($_POST['maximalni_pocet']);

		mysql_query("update model_zakaznik set nazev='$nazev',vykon='$vykon',cyklus='$cyklus',plocha='$plocha',VC='$VC',FC='$FC',L='$L',TL='$TL',CL='$CL',SP='$SP',co2='$co2',maximalni_pocet ='$maximalni_pocet' where id='$editobsluha'",$connect2);
		
	}
	$status=1;
	$krok=3;
	$editobsluha=0;
	$viewdalsikrok=0;
}


// Prohlizeni zaznamu tabulky - formular
if ($status==88){

	if ($model){
		$getclanek = mysql_query("SELECT * from model where id='$model' limit 0,1",$connect2);
		while ($clanky = mysql_fetch_array($getclanek)){


			$kendall_x=$clanky['kendall_x'];
			$kendall_y=$clanky['kendall_y'];
			$pocet_iteraci=$clanky['pocet_iteraci'];

			if (!$pocet_iteraci) $pocet_iteracir=1000;
			else if ($pocet_iteraci<0) $pocet_iteracir=1000;
			else if ($pocet_iteraci>100000) $pocet_iteracir=100000;
			else $pocet_iteracir=$pocet_iteraci;
			if (!$kendall_x) $kendall_x="M";
			if (!$kendall_y) $kendall_y="M";

			if ($kendall_x=="M") $kendall_xx="Poisson�v proces p��chod� (exponenci�ln� rozd�len� doby mezi p��chody)";
			if ($kendall_x=="E") $kendall_xx="Erlangovo rozd�len� doby mezi p��chody";
			if ($kendall_x=="D") $kendall_xx="Konstatntn� doba mezi p��chody";
			if ($kendall_x=="G") $kendall_xx="Obecn� proces p��chod� (obecn� rozd�len� doby mezi p��chody)";

			if ($kendall_y=="M") $kendall_yy="Exponenci�ln� rozd�len� doby obsluhy";
			if ($kendall_y=="E") $kendall_yy="Erlangovo rozd�len� doby obsluhy";
			if ($kendall_y=="D") $kendall_yy="Konstatntn� doba obsluhy";
			if ($kendall_y=="G") $kendall_yy="Obecn� rozd�len� doby obsluhy";
			
			
			
			$k1=$clanky['k1'];
			$k2=$clanky['k2'];
			$k3=$clanky['k3'];
			$k4=$clanky['k4'];
			$k5=$clanky['k5'];

			$r1=$clanky['r1'];
			$r2=$clanky['r2'];
			$r3=$clanky['r3'];
			$r4=$clanky['r4'];
			$r5=$clanky['r5'];
			
			if ($r1==0) $r1_u="Bez vlivu";
			if ($r1==1) $r1_u="Mal� vliv";
			if ($r1==2) $r1_u="St�edn� vliv";
			if ($r1==3) $r1_u="Velk� vliv";

			if ($r2==0) $r2_u="Bez vlivu";
			if ($r2==1) $r2_u="Mal� vliv";
			if ($r2==2) $r2_u="St�edn� vliv";
			if ($r2==3) $r2_u="Velk� vliv";

			if ($r3==0) $r3_u="Bez vlivu";
			if ($r3==1) $r3_u="Mal� vliv";
			if ($r3==2) $r3_u="St�edn� vliv";
			if ($r3==3) $r3_u="Velk� vliv";

			if ($r4==0) $r4_u="Bez vlivu";
			if ($r4==1) $r4_u="Mal� vliv";
			if ($r4==2) $r4_u="St�edn� vliv";
			if ($r4==3) $r4_u="Velk� vliv";

			if ($r5==0) $r5_u="Bez vlivu";
			if ($r5==1) $r5_u="Mal� vliv";
			if ($r5==2) $r5_u="St�edn� vliv";
			if ($r5==3) $r5_u="Velk� vliv";

			$nazev=$clanky['nazev'];
			$firma=$clanky['firma'];
			$adresa=$clanky['adresa'];
			$osoba=$clanky['osoba'];
			$zahajenit=$clanky['zahajeni'];
			if (!$zahajenit) $zahajenit=time();

			$dobat=$clanky['doba'];
			if (!$dobat) $dobat=time()+365*24*3600;

			$poznamka=nl2br($clanky['poznamka']);
			$objem=$clanky['objem'];
			$jednotka=$clanky['jednotka'];
			$doba=$clanky['doba'];
			$smena_prescas=$clanky['smena_prescas'];
			$bonus=$clanky['bonus'];
			$rozptyl_vysledku=$clanky['rozptyl_vysledku'];
			$penale=$clanky['penale'];
			$variabilni_naklady=$clanky['variabilni_naklady'];
			$koeficient_prescasu=$clanky['koeficient_prescasu'];
			if (!$koeficient_prescasu) $koeficient_prescasu=1;
			$plocha=$clanky['plocha'];
			$smena=$clanky['smena'];
			if (!$smena) $smena=8;
			$tyden=$clanky['tyden'];
			if (!$tyden) $tyden=5;

			$produktivita=$clanky['produktivita'];
			if (!$produktivita) $produktivita=1;
			
			
		}
	}
?>	
	<h2>Obecn� �daje</h2>
	<table>
	<tr><td class="row2">N�zev objektu:</td><td class="row2"><b><?php echo $nazev;?></b></td></tr>
	<tr><td class="row1">Adresa objektu:</td><td class="row1"><?php echo $adresa;?></td></tr>
	<tr><td class="row2">Developersk� firma:</td><td class="row2"><?php echo $firma;?></td></tr>
	<tr><td class="row1">Zodpov�dn� osoba:</td><td class="row1"><?php echo $osoba;?></td></tr>
	<tr><td class="row2">Pozn�mka:</td><td class="row2"><?php echo $poznamka;?></td></tr>
	</table>
	<hr><h2>Parametry �kolu (dle smlouvy o d�lo)</h2>
	<table>
	<tr><td class="row2">Datum zah�jen� pr�ce:</td><td class="row2"><?php echo date("d.m.Y",$zahajenit);?></td></tr>
	<tr><td class="row1">Datum ukon�en� pr�ce:</td><td class="row1"><?php echo date("d.m.Y",$dobat);?></td></tr>
	<tr><td class="row2">Objem �kolu, [m.j.]:</td><td class="row2"><?php echo $objem;?></td></tr>
	<tr><td class="row1">M�rn� jednotka:</td><td class="row1"><?php echo $jednotka;?></td></tr>
	<tr><td class="row2">Pracovn� plocha, [m<sup>2</sup>]:</td><td class="row2"><?php echo $plocha;?></td></tr>
	<tr><td class="row1">Standardn� sm�na za den, [h]:</td><td class="row1"><?php echo $smena;?></td></tr>
	<tr><td class="row2">P�es�asy za den, [h]:</td><td class="row2"><?php echo $smena_prescas;?></td></tr>
	<tr><td class="row1">Koeficient zv��en� VC za p�es�asy, [-]:</td><td class="row1"><?php echo $koeficient_prescasu;?></td></tr>
	<tr><td class="row2">Po�et pracovn�ch dn� v t�dnu, [dny]:</td><td class="row2"><?php echo $tyden;?></td></tr>
	<tr><td class="row1">Koeficient produktivity, [-]:</td><td class="row1"><?php echo $produktivita;?></td></tr>
	<tr><td class="row2">VC (bez zkouman� soustavy), [K�/den]:</td><td class="row2"><?php echo $variabilni_naklady;?></td></tr>
	<tr><td class="row1">Pen�le za zpo�d�n�, [K�/den]:</td><td class="row1"><?php echo $penale;?></td></tr>
	<tr><td class="row2">Bonus za d��v�j�� ukon�en�, [K�/den]:</td><td class="row2"><?php echo $bonus;?></td></tr>
	<tr><td class="row2">M�ra rozptyl� v�sledk�, [%]:</td><td class="row2"><?php echo $rozptyl_vysledku;?></td></tr>
	</table>
	<hr><h2>Varianty obsluhu�c�ch stroj� (linka obsluhy)</h2>
<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft" width="35px"><font class="name2"><b>N / ID</b></font></td>
<td align="center" class="catLeft" width="200px"><font class="name2"><b>N�zev</b></font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"><b>V�konnost /<br>Cyklus</b></font></td>
<td align="center" class="catLeft" width="40px"><font class="name2"><b>Max. po�et</b></font></td>
<td align="center" class="catLeft" width="50px"><font class="name2"><b>Min. plocha</b></font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"><b>VC /<br>FC</b></font></td>
<td align="center" class="catLeft" width="95px"><font class="name2"><b>L /<br>TL /<br>CL</b></font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"><b>SP /<br>CO<sub>2</sub></b></font></td>
<td align="center" class="catLeft" width="50px"></td>
</tr>

<?php


	$getclanek = mysql_query("SELECT * from model_obsluha where model='$model'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($row==1) $row=2;else $row=1;
		$iddd++;
		echo '<tr><td align="center" class="row'.$row.'"><font class="name2">'.$iddd." /<br>".$clanky['id'].'</font></td>';
		echo '<td align="left" class="row'.$row.'"><font class="name2">'.$clanky['nazev'].'</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['vykon']." [m.j./h] /<br>".$clanky['cyklus'].' [s]</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['maximalni_pocet'].'</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['plocha'].' [m<sup>2</sup>]</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['VC']." [K�/h]/<br>".$clanky['FC'].' [K�]</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['L']." [-/1000h]/<br>".$clanky['TL']." [min]/<br>".$clanky['CL'].' [K�]</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['SP']." [l/h]/<br>".$clanky['co2'].' [g/h]</font></td>';
		echo '<td align="center" class="row'.$row.'">';
	
		echo "<a href='katalogovy-list?status=7&id=".$clanky['stroj']."' target='_blank' title='Prohlednout katalogov� list stroje'><img src='./skin/button/16/view.png' alt='Prohlednout katalogov� list stroje' width='16px' height='16px' border='0'></a>&nbsp;";
		echo '</td></tr>';
	}

echo "</table>";
?>
	
	<hr><h2>Varianty obsluhovan�ch stroj� (z�kazn�k)</h2>
<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft" width="35px"><font class="name2"><b>N / ID</b></font></td>
<td align="center" class="catLeft" width="200px"><font class="name2"><b>N�zev</b></font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"><b>V�konnost /<br>Cyklus</b></font></td>
<td align="center" class="catLeft" width="40px"><font class="name2"><b>Max. po�et</b></font></td>
<td align="center" class="catLeft" width="50px"><font class="name2"><b>Min. plocha</b></font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"><b>VC /<br>FC</b></font></td>
<td align="center" class="catLeft" width="95px"><font class="name2"><b>L /<br>TL /<br>CL</b></font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"><b>SP /<br>CO<sub>2</sub></b></font></td>
<td align="center" class="catLeft" width="50px"></td>
</tr>

<?php


	$getclanek = mysql_query("SELECT * from model_zakaznik where model='$model'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($row==1) $row=2;else $row=1;
		$iddd++;
		echo '<tr><td align="center" class="row'.$row.'"><font class="name2">'.$iddd." /<br>".$clanky['id'].'</font></td>';
		echo '<td align="left" class="row'.$row.'"><font class="name2">'.$clanky['nazev'].'</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['vykon']." [m.j./h] /<br>".$clanky['cyklus'].' [s]</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['maximalni_pocet'].'</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['plocha'].' [m<sup>2</sup>]</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['VC']." [K�/h]/<br>".$clanky['FC'].' [K�]</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['L']." [-/1000h]/<br>".$clanky['TL']." [min]/<br>".$clanky['CL'].' [K�]</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['SP']." [l/h]/<br>".$clanky['co2'].' [g/h]</font></td>';
		echo '<td align="center" class="row'.$row.'">';
	
		echo "<a href='katalogovy-list?status=7&id=".$clanky['stroj']."' target='_blank' title='Prohlednout katalogov� list stroje'><img src='./skin/button/16/view.png' alt='Prohlednout katalogov� list stroje' width='16px' height='16px' border='0'></a>&nbsp;";
		echo '</td></tr>';
	}

echo "</table>";
?>

	<hr><h2>Kendallova klasifikace syst�mu hromadn� obsluhy (X/Y/c)</h2>
	<br>X (typ n�hodn�ho procesu popisuj�c�ho p��chod z�kazn�k� k obsluze):<br><b><?php echo $kendall_xx;?></b>
	<br>Y (typ rozd�len� doby obsluhy):<br><b><?php echo $kendall_yy;?></b>
	<hr><h2>Metoda Monte Carlo</h2>
	<br>Po�et iterac�: J (od 1 000 do 100 000):	<?php echo $pocet_iteracir;?>

	<hr><h2>Optimaliza�n� parametry</h2>

	<table>
	<tr><td class="row2"> K1 (v�ha ekonomick�ho hlediska (n�klady)), [-]:</td><td class="row2"><?php echo $k1;?></td></tr>
	<tr><td class="row1"> K2 (v�ha environment�ln�ho hlediska (produkce CO<sub>2</sub>)), [-]:</td><td class="row1"><?php echo $k2;?></td></tr>
	<tr><td class="row2"> K3 (v�ha hlediska rychlosti spln�n� �kolu (doba spln�n�)), [-]:</td><td class="row2"><?php echo $k3;?></td></tr>
	<tr><td class="row1"> K4 (v�ha hlediska spolehlivosti sestav (po�et poruch, n�klady na opravu)), [-]:</td><td class="row1"><?php echo $k4;?></td></tr>
	<tr><td class="row2"> K5 (v�ha hlediska spot�eby energie), [-]:</td><td class="row2"><?php echo $k5;?></td></tr>
	</table>

	<hr><h2>Nahodil� parametry</h2>
	<table>
	<tr><td class="row2"> R1 (nahodilost poruch), [-]:</td><td class="row2"><?php echo $r1_u;?></td></tr>
	<tr><td class="row1"> R2 (nahodilost po�as�), [-]:</td><td class="row1"><?php echo $r2_u;?></td></tr>
	<tr><td class="row2"> R3 (nahodilost dopravn�ch komplikac�), [-]:</td><td class="row2"><?php echo $r3_u;?></td></tr>
	<tr><td class="row1"> R4 (nahodilost havarijn�ch stav�), [-]:</td><td class="row1"><?php echo $r4_u;?></td></tr>
	<tr><td class="row2"> R5 (nahodilost lidsk�ho faktoru), [-]:</td><td class="row2"><?php echo $r5_u;?></td></tr>
	</table>
	<hr>
	<h2><a href="modelovani?view=2" title="Editace model�">Editace model� :</a></h2><br>


<?php
}

// Novy zaznam tabulky - formular
if ($status==1){

	if ($model){
		$getclanek = mysql_query("SELECT * from model where id='$model' limit 0,1",$connect2);
		while ($clanky = mysql_fetch_array($getclanek)){

			$k1=$clanky['k1'];
			$k2=$clanky['k2'];
			$k3=$clanky['k3'];
			$k4=$clanky['k4'];
			$k5=$clanky['k5'];

			
			$kendall_x=$clanky['kendall_x'];
			$kendall_y=$clanky['kendall_y'];
			$pocet_iteraci=$clanky['pocet_iteraci'];

			if (!$pocet_iteraci) $pocet_iteracir=1000;
			else if ($pocet_iteraci<0) $pocet_iteracir=1000;
			else if ($pocet_iteraci>100000) $pocet_iteracir=100000;
			else $pocet_iteracir=$pocet_iteraci;
			if (!$kendall_x) $kendall_x="M";
			if (!$kendall_y) $kendall_y="M";
			
			$r1=$clanky['r1'];
			$r2=$clanky['r2'];
			$r3=$clanky['r3'];
			$r4=$clanky['r4'];
			$r5=$clanky['r5'];
			

			$nazev=$clanky['nazev'];
			$firma=$clanky['firma'];
			$adresa=$clanky['adresa'];
			$osoba=$clanky['osoba'];
			$zahajenit=$clanky['zahajeni'];
			if (!$zahajenit) $zahajenit=time();

			$dobat=$clanky['doba'];
			if (!$dobat) $dobat=time()+365*24*3600;

			$poznamka=$clanky['poznamka'];
			$objem=$clanky['objem'];
			$jednotka=$clanky['jednotka'];
			$doba=$clanky['doba'];
			$smena_prescas=$clanky['smena_prescas'];
			$bonus=$clanky['bonus'];
			$rozptyl_vysledku=$clanky['rozptyl_vysledku'];
			$penale=$clanky['penale'];
			$variabilni_naklady=$clanky['variabilni_naklady'];
			$koeficient_prescasu=$clanky['koeficient_prescasu'];
			if (!$koeficient_prescasu) $koeficient_prescasu=1;
			$plocha=$clanky['plocha'];
			$smena=$clanky['smena'];
			if (!$smena) $smena=8;
			$tyden=$clanky['tyden'];
			if (!$tyden) $tyden=5;

			$produktivita=$clanky['produktivita'];
			if (!$produktivita) $produktivita=1;
			
			
		}
	}

?>


<?php if (!$viewdalsikrok){?>
<form  name='form1' ACTION='./modelovani' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="101">
<input type="hidden" name="krok" value="<?php echo $krok;?>">
<input type="hidden" name="model" value="<?php echo $model;?>">
<?php } ?>
<center>
<?php 


if (!$krok){?>
	<h2>Krok 1: Obecn� �daje</h2>
	<table>
	<tr><td class="row2">N�zev objektu:</td><td class="row2"><input type="text" value="<?php echo $nazev;?>" name="nazev" size="100"></td></tr>
	<tr><td class="row1">Adresa objektu:</td><td class="row1"><input type="text" value="<?php echo $adresa;?>" name="adresa" size="100"></td></tr>
	<tr><td class="row2">Developersk� firma:</td><td class="row2"><input type="text" value="<?php echo $firma;?>" name="firma" size="70"></td></tr>
	<tr><td class="row1">Zodpov�dn� osoba:</td><td class="row1"><input type="text" value="<?php echo $osoba;?>" name="osoba" size="70"></td></tr>
	<tr><td class="row2">Pozn�mka:</td><td class="row2"><textarea name="poznamka" rows="6" cols="60"><?php echo $poznamka;?></textarea></td></tr>
	</table>
<?php }?>



<?php if ($krok==1){?>
	<h2>Krok 2: Parametry �kolu (dle smlouvy o d�lo)</h2>

	<table>
	<tr><td class="row2">Datum zah�jen� pr�ce:</td><td class="row2"><input type="text" value="<?php echo date("d.m.Y",$zahajenit);?>" name="zahajeni" size="10"></td></tr>
	<tr><td class="row1">Datum ukon�en� pr�ce:</td><td class="row1"><input type="text" value="<?php echo date("d.m.Y",$dobat);?>" name="doba" size="10"></td></tr>
	<tr><td class="row2">Objem �kolu, [m.j.]:</td><td class="row2"><input type="text" value="<?php echo $objem;?>" name="objem" size="10"></td></tr>
	<tr><td class="row1">M�rn� jednotka:</td><td class="row1"><input type="text" value="<?php echo $jednotka;?>" name="jednotka" size="10"></td></tr>
	<tr><td class="row2">Pracovn� plocha, [m<sup>2</sup>]:</td><td class="row2"><input type="text" value="<?php echo $plocha;?>" name="plocha" size="10"></td></tr>
	<tr><td class="row1">Standardn� sm�na za den, [h]:</td><td class="row1"><input type="text" value="<?php echo $smena;?>" name="smena" size="10"></td></tr>
	<tr><td class="row2">P�es�asy za den, [h]:</td><td class="row2"><input type="text" value="<?php echo $smena_prescas;?>" name="smena_prescas" size="5"></td></tr>
	<tr><td class="row1">Koeficient zv��en� VC za p�es�asy, [-]:</td><td class="row1"><input type="text" value="<?php echo $koeficient_prescasu;?>" name="koeficient_prescasu" size="5"></td></tr>
	<tr><td class="row2">Po�et pracovn�ch dn� v t�dnu, [dny]:</td><td class="row2"><input type="text" value="<?php echo $tyden;?>" name="tyden" size="5"></td></tr>
	<tr><td class="row1">Koeficient produktivity, [-]:</td><td class="row1"><input type="text" value="<?php echo $produktivita;?>" name="produktivita" size="10"></td></tr>
	<tr><td class="row2">VC (bez zkouman� sestavy), [K�/den]:</td><td class="row2"><input type="text" value="<?php echo $variabilni_naklady;?>" name="variabilni_naklady" size="10"></td></tr>
	<tr><td class="row1">Pen�le za zpo�d�n�, [K�/den]:</td><td class="row1"><input type="text" value="<?php echo $penale;?>" name="penale" size="10"></td></tr>
	<tr><td class="row2">Bonus za d��v�j�� ukon�en�, [K�/den]:</td><td class="row2"><input type="text" value="<?php echo $bonus;?>" name="bonus" size="10"></td></tr>
	<tr><td class="row2">M�ra rozptylu v�sledk�, [%]:</td><td class="row2"><input type="text" value="<?php echo $rozptyl_vysledku;?>" name="rozptyl_vysledku" size="5"></td></tr>


	
	</table>
<?php }?>



<?php if ($krok==2){?>
<h2>Krok 3: Varianty obsluhuj�c�ch stroj� (linka obsluhy)</h2>
<?php if ($newobsluha==1){?>

<form  name='form2' ACTION='./modelovani' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="1010">
<input type="hidden" name="krok" value="<?php echo $krok;?>">
<input type="hidden" name="model" value="<?php echo $model;?>">
<h2><font color="green">Vlo�en� nov� obsluhuj�c� varianty:</font></h2>

<table>
<tr><td class="row2">N�zev stroje:</td><td class="row2">
<select name="obsluha">
<?php



	$getclaneks1 = mysql_query("SELECT * from optimalizace_skupiny_stroju_1 order by id",$connect2);
	while ($clankys1 = mysql_fetch_array($getclaneks1)){
		$sk1=$clankys1['id'];
		echo "<option disabled>>&nbsp;".$clankys1['nazev']."</option>";
			
	$getclaneks2 = mysql_query("SELECT * from optimalizace_skupiny_stroju_2 where skupina1='$sk1' order by id",$connect2);
	while ($clankys2 = mysql_fetch_array($getclaneks2)){
		$sk2=$clankys2['id'];
		echo "<option disabled>&nbsp;&nbsp;>&nbsp;".$clankys2['nazev']."</option>";

	$getclanek = mysql_query("SELECT * from optimalizace_katalog_stroju where skupina1='$sk1' and skupina2='$sk2' order by vykon_kW",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo "<option value='".$clanky['id']."-0'>&nbsp;&nbsp;&nbsp;".$clanky['nazev']." | ".$clanky['pracovni_vykon_jednotka_hod']." ".$clanky['jednotka']."/h | ".$clanky['pocet_jednotek']." ".$clanky['jednotka']."</option>";
		
		$pridavne_zarizeni[0]=$clanky['pridavne_zarizeni_1'];
		$pridavne_zarizeni[1]=$clanky['pridavne_zarizeni_2'];
		$pridavne_zarizeni[2]=$clanky['pridavne_zarizeni_3'];
		$pridavne_zarizeni[3]=$clanky['pridavne_zarizeni_4'];
		$pridavne_zarizeni[4]=$clanky['pridavne_zarizeni_5'];
		
		for ($i=0;$i<5;$i++){
			if ($pridavne_zarizeni[$i]){
				$getclanek2 = mysql_query("SELECT * from optimalizace_pridavna_zarizeni where id='".$pridavne_zarizeni[$i]."' order by pocet_jednotek",$connect2);
				while ($clanky2 = mysql_fetch_array($getclanek2)){
					echo "<option value='".$clanky['id']."-".$clanky2['id']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$clanky2['nazev']." | ".$clanky2['pracovni_vykon_jednotka_hod']." ".$clanky2['jednotka']."/h | ".$clanky2['pocet_jednotek']." ".$clanky2['jednotka']."</option>";
				}
			}
		}
		
	}
	}
	}
	$viewdalsikrok=1;
?>
</select>
</td></tr>
<tr><td class="row2">Maxim�ln� disponibiln� po�et jednotek:</td><td class="row2"><input type="text" value="" name="max_pocet" size="10"></td></tr>
	

<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Vlo�it stroj">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zp�t"></td></tr>
</table>
</form>




<?php }else if($editobsluha){


	$getclanek = mysql_query("SELECT * from model_obsluha where id='$editobsluha' limit 0,1",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
?>
<form  name='form2' ACTION='./modelovani' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="1030">
<input type="hidden" name="krok" value="<?php echo $krok;?>">
<input type="hidden" name="model" value="<?php echo $model;?>">
<input type="hidden" name="editobsluha" value="<?php echo $editobsluha;?>">
<h2><font color="green">Editace obsluhuj�c� varianty:</font></h2>
<table>
<tr><td class="row2">N�zev stroje:</td><td class="row2"><input type="text" value="<?php echo $clanky['nazev'];?>" name="nazev" size="50"></td></tr>
<tr><td class="row1">V�konnost stroje, [m.j./h]:</td><td class="row1"><input type="text" value="<?php echo $clanky['vykon'];?>" name="vykon" size="10"></td></tr>
<tr><td class="row2">Pracovn� cyklus, [s]:</td><td class="row2"><input type="text" value="<?php echo $clanky['cyklus'];?>" name="cyklus" size="10"></td></tr>
<tr><td class="row1">Minim�ln� pracovn� plocha, [m<sup>2</sup>]:</td><td class="row1"><input type="text" value="<?php echo $clanky['plocha'];?>" name="plocha" size="10"></td></tr>
<tr><td class="row2">Variabiln� n�klad, [K�/h]:</td><td class="row2"><input type="text" value="<?php echo $clanky['VC'];?>" name="VC" size="10"></td></tr>
<tr><td class="row1">Fixn� n�klad, [K�]:</td><td class="row1"><input type="text" value="<?php echo $clanky['FC'];?>" name="FC" size="10"></td></tr>
<tr><td class="row2">Pravd�podobnost poruchy, [poruch/1000 h]:</td><td class="row2"><input type="text" value="<?php echo $clanky['L'];?>" name="L" size="10"></td></tr>
<tr><td class="row1">Pr�m�rn� doba opravy, [min]:</td><td class="row1"><input type="text" value="<?php echo $clanky['TL'];?>" name="TL" size="10"></td></tr>
<tr><td class="row2">N�klad na odstran�n� poruchy, [K�]:</td><td class="row2"><input type="text" value="<?php echo $clanky['CL'];?>" name="CL" size="10"></td></tr>
<tr><td class="row1">Spot�eba energie, [l/h]:</td><td class="row1"><input type="text" value="<?php echo $clanky['SP'];?>" name="SP" size="10"></td></tr>
<tr><td class="row2">Produkce CO<sub>2</sub>, [g/h]:</td><td class="row2"><input type="text" value="<?php echo $clanky['co2'];?>" name="co2" size="10"></td></tr>
<tr><td class="row1">Maxim�ln� disponibiln� po�et jednotek:</td><td class="row1"><input type="text" value="<?php echo $clanky['maximalni_pocet'];?>" name="maximalni_pocet" size="10"></td></tr>

<tr><td class="row2" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Ulo�it polo�ku">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zp�t"></td></tr>
</table>
</form>
<?php		
	}

	$viewdalsikrok=1;
?>

<?php }else if($delobsluha){
	$viewdalsikrok=1;
?>
Opravdu si p�ejete variantu <?php echo $delobsluha;?> vymazat ? <a href='modelovani?status=1020&model=<?php echo $model;?>&krok=2&delobsluha=<?php echo $delobsluha;?>' title="Vymazat obsluhu <?php echo $delobsluha;?>">Ano</a> <a href='modelovani?status=1&model=<?php echo $model;?>&krok=2' title="Ne">Ne</a>

<?php }else{ ?>



<a href='modelovani?status=1&model=<?php echo $model;?>&krok=2&newobsluha=1' title="P�idat obsluhuj�c� variantu">+ P�idat obsluhuj�c� variantu</a>



<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft" width="35px"><font class="name2"><b>N / ID</b></font></td>
<td align="center" class="catLeft" width="200px"><font class="name2"><b>N�zev</b></font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"><b>V�konnost /<br>Cyklus</b></font></td>
<td align="center" class="catLeft" width="40px"><font class="name2"><b>Max. po�et</b></font></td>
<td align="center" class="catLeft" width="50px"><font class="name2"><b>Min. plocha</b></font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"><b>VC /<br>FC</b></font></td>
<td align="center" class="catLeft" width="95px"><font class="name2"><b>L /<br>TL /<br>CL</b></font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"><b>SP /<br>CO<sub>2</sub></b></font></td>
<td align="center" class="catLeft" width="50px"></td>
</tr>

<?php


	$getclanek = mysql_query("SELECT * from model_obsluha where model='$model'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($row==1) $row=2;else $row=1;
		$iddd++;
		echo '<tr><td align="center" class="row'.$row.'"><font class="name2">'.$iddd." /<br>".$clanky['id'].'</font></td>';
		echo '<td align="left" class="row'.$row.'"><font class="name2">'.$clanky['nazev'].'</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['vykon']." [m.j./h] /<br>".$clanky['cyklus'].' [s]</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['maximalni_pocet'].'</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['plocha'].' [m<sup>2</sup>]</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['VC']." [K�/h]/<br>".$clanky['FC'].' [K�]</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['L']." [-/1000h]/<br>".$clanky['TL']." [min]/<br>".$clanky['CL'].' [K�]</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['SP']." [l/h]/<br>".$clanky['co2'].' [g/h]</font></td>';
		echo '<td align="center" class="row'.$row.'">';


		if ($lock==0) echo "<br><a href='modelovani?status=1&model=".$model."&krok=2&editobsluha=".$clanky['id']."' title='Editovat obsluhuj�c� variantu'><img src='./skin/button/16/edit.png' alt='Editovat obsluhuj�c� variantu' width='16px' height='16px' border='0'></a>&nbsp;";
		if ($lock==0) echo "<a href='modelovani?status=1&model=".$model."&krok=2&delobsluha=".$clanky['id']."' title='Vymazat variantu'><img src='./skin/button/16/delete.png' alt='Vymazat variantu' width='16px' height='16px' border='0'></a>&nbsp;";
		
		echo "<a href='katalogovy-list?status=7&id=".$clanky['stroj']."' target='_blank' title='Prohlednout katalogov� list stroje'><img src='./skin/button/16/view.png' alt='Prohlednout katalogov� list stroje' width='16px' height='16px' border='0'></a>&nbsp;";
		echo '</td></tr>';
	}

echo "</table>";
	
	}
}
?>




<?php if ($krok==3){?>
<h2>Krok 4: Varianty obsluhovan�ch stroj� (z�kazn�k)</h2>
<?php if ($newobsluha==1){?>

<form  name='form2' ACTION='./modelovani' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="2010">
<input type="hidden" name="krok" value="<?php echo $krok;?>">
<input type="hidden" name="model" value="<?php echo $model;?>">
<h2><font color="green">Vlo�en� nov� obsluhovan� varianty:</font></h2>

<table>
<tr><td class="row2">N�zev stroje:</td><td class="row2">
<select name="obsluha">
<?php



	$getclaneks1 = mysql_query("SELECT * from optimalizace_skupiny_stroju_1 order by id",$connect2);
	while ($clankys1 = mysql_fetch_array($getclaneks1)){
		$sk1=$clankys1['id'];
		echo "<option disabled>>&nbsp;".$clankys1['nazev']."</option>";
			
	$getclaneks2 = mysql_query("SELECT * from optimalizace_skupiny_stroju_2 where skupina1='$sk1' order by id",$connect2);
	while ($clankys2 = mysql_fetch_array($getclaneks2)){
		$sk2=$clankys2['id'];
		echo "<option disabled>&nbsp;&nbsp;>&nbsp;".$clankys2['nazev']."</option>";

	$getclanek = mysql_query("SELECT * from optimalizace_katalog_stroju where skupina1='$sk1' and skupina2='$sk2' order by vykon_kW",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo "<option value='".$clanky['id']."-0'>&nbsp;&nbsp;&nbsp;".$clanky['nazev']." | ".$clanky['pracovni_vykon_jednotka_hod']." ".$clanky['jednotka']."/h | ".$clanky['pocet_jednotek']." ".$clanky['jednotka']."</option>";
		
		$pridavne_zarizeni[0]=$clanky['pridavne_zarizeni_1'];
		$pridavne_zarizeni[1]=$clanky['pridavne_zarizeni_2'];
		$pridavne_zarizeni[2]=$clanky['pridavne_zarizeni_3'];
		$pridavne_zarizeni[3]=$clanky['pridavne_zarizeni_4'];
		$pridavne_zarizeni[4]=$clanky['pridavne_zarizeni_5'];
		
		for ($i=0;$i<5;$i++){
			if ($pridavne_zarizeni[$i]){
				$getclanek2 = mysql_query("SELECT * from optimalizace_pridavna_zarizeni where id='".$pridavne_zarizeni[$i]."' order by pocet_jednotek",$connect2);
				while ($clanky2 = mysql_fetch_array($getclanek2)){
					echo "<option value='".$clanky['id']."-".$clanky2['id']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$clanky2['nazev']." | ".$clanky2['pracovni_vykon_jednotka_hod']." ".$clanky2['jednotka']."/h | ".$clanky2['pocet_jednotek']." ".$clanky2['jednotka']."</option>";
				}
			}
		}
		
	}
	}
	}
	$viewdalsikrok=1;
?>
</select>
</td></tr>
<tr><td class="row2">Maxim�ln� disponibiln� po�et jednotek:</td><td class="row2"><input type="text" value="" name="max_pocet" size="10"></td></tr>
	

<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Vlo�it stroj">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zp�t"></td></tr>
</table>
</form>




<?php }else if($editobsluha){


	$getclanek = mysql_query("SELECT * from model_zakaznik where id='$editobsluha' limit 0,1",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
?>
<form  name='form2' ACTION='./modelovani' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="2030">
<input type="hidden" name="krok" value="<?php echo $krok;?>">
<input type="hidden" name="model" value="<?php echo $model;?>">
<input type="hidden" name="editobsluha" value="<?php echo $editobsluha;?>">
<h2><font color="green">Editace obsluhovan� varianty:</font></h2>
<table>
<tr><td class="row2">N�zev stroje:</td><td class="row2"><input type="text" value="<?php echo $clanky['nazev'];?>" name="nazev" size="50"></td></tr>
<tr><td class="row1">V�konnost stroje, [m.j./h]:</td><td class="row1"><input type="text" value="<?php echo $clanky['vykon'];?>" name="vykon" size="10"></td></tr>
<tr><td class="row2">Pracovn� cyklus, [s]:</td><td class="row2"><input type="text" value="<?php echo $clanky['cyklus'];?>" name="cyklus" size="10"></td></tr>
<tr><td class="row1">Minim�ln� pracovn� plocha, [m<sup>2</sup>]:</td><td class="row1"><input type="text" value="<?php echo $clanky['plocha'];?>" name="plocha" size="10"></td></tr>
<tr><td class="row2">Variabiln� n�klad, [K�/h]:</td><td class="row2"><input type="text" value="<?php echo $clanky['VC'];?>" name="VC" size="10"></td></tr>
<tr><td class="row1">Fixn� n�klad, [K�]:</td><td class="row1"><input type="text" value="<?php echo $clanky['FC'];?>" name="FC" size="10"></td></tr>
<tr><td class="row2">Pravd�podobnost poruchy, [poruch/1000 h]:</td><td class="row2"><input type="text" value="<?php echo $clanky['L'];?>" name="L" size="10"></td></tr>
<tr><td class="row1">Pr�m�rn� doba opravy, [min]:</td><td class="row1"><input type="text" value="<?php echo $clanky['TL'];?>" name="TL" size="10"></td></tr>
<tr><td class="row2">N�klad na odstran�n� poruchy, [K�]:</td><td class="row2"><input type="text" value="<?php echo $clanky['CL'];?>" name="CL" size="10"></td></tr>
<tr><td class="row1">Spot�eba energie, [l/h]:</td><td class="row1"><input type="text" value="<?php echo $clanky['SP'];?>" name="SP" size="10"></td></tr>
<tr><td class="row2">Produkce CO<sub>2</sub>, [g/h]:</td><td class="row2"><input type="text" value="<?php echo $clanky['co2'];?>" name="co2" size="10"></td></tr>
<tr><td class="row1">Maxim�ln� disponibiln� po�et jednotek:</td><td class="row1"><input type="text" value="<?php echo $clanky['maximalni_pocet'];?>" name="maximalni_pocet" size="10"></td></tr>

<tr><td class="row2" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Ulo�it polo�ku">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zp�t"></td></tr>
</table>
</form>
<?php		
	}

	$viewdalsikrok=1;
?>

<?php }else if($delobsluha){
	$viewdalsikrok=1;
?>
Opravdu si p�ejete variantu <?php echo $delobsluha;?> vymazat ? <a href='modelovani?status=2020&model=<?php echo $model;?>&krok=3&delobsluha=<?php echo $delobsluha;?>' title="Vymazat z�kazn�ka <?php echo $delobsluha;?>">Ano</a> <a href='modelovani?status=1&model=<?php echo $model;?>&krok=3' title="Ne">Ne</a>

<?php }else{ ?>
<a href='modelovani?status=1&model=<?php echo $model;?>&krok=3&newobsluha=1' title="P�idat obsluhovanou variantu">+ P�idat obsluhovanou variantu</a>




<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft" width="35px"><font class="name2"><b>N / ID</b></font></td>
<td align="center" class="catLeft" width="200px"><font class="name2"><b>N�zev</b></font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"><b>V�konnost /<br>Cyklus</b></font></td>
<td align="center" class="catLeft" width="40px"><font class="name2"><b>Max. po�et</b></font></td>
<td align="center" class="catLeft" width="50px"><font class="name2"><b>Min. plocha</b></font></td>
<td align="center" class="catLeft" width="80px"><font class="name2"><b>VC /<br>FC</b></font></td>
<td align="center" class="catLeft" width="80px"><font class="name2"><b>L /<br>TL /<br>CL</b></font></td>
<td align="center" class="catLeft" width="80px"><font class="name2"><b>SP /<br>CO<sub>2</sub></b></font></td>
<td align="center" class="catLeft" width="70px"></td>
</tr>

<?php


	$getclanek = mysql_query("SELECT * from model_zakaznik where model='$model'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($row==1) $row=2;else $row=1;
		$iddd++;
		echo '<tr><td align="center" class="row'.$row.'"><font class="name2">'.$iddd." /<br>".$clanky['id'].'</font></td>';
		echo '<td align="left" class="row'.$row.'"><font class="name2">'.$clanky['nazev'].'</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['vykon']." [m.j./h] /<br>".$clanky['cyklus'].' [s]</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['maximalni_pocet'].'</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['plocha'].' [m<sup>2</sup>]</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['VC']." [K�/h]/<br>".$clanky['FC'].' [K�]</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['L']." [-/1000h]/<br>".$clanky['TL']." [min]/<br>".$clanky['CL'].' [K�]</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['SP']." [l/h]/<br>".$clanky['co2'].' [g/h]</font></td>';
		echo '<td align="center" class="row'.$row.'">';


		if ($lock==0) echo "<br><a href='modelovani?status=1&model=".$model."&krok=3&editobsluha=".$clanky['id']."' title='Editovat obsluhuj�c� variantu'><img src='./skin/button/16/edit.png' alt='Editovat obsluhuj�c� variantu' width='16px' height='16px' border='0'></a>&nbsp;";
		if ($lock==0) echo "<a href='modelovani?status=1&model=".$model."&krok=3&delobsluha=".$clanky['id']."' title='Vymazat variantu'><img src='./skin/button/16/delete.png' alt='Vymazat variantu' width='16px' height='16px' border='0'></a>&nbsp;";
		
		echo "<a href='katalogovy-list?status=7&id=".$clanky['stroj']."' target='_blank' title='Prohlednout katalogov� list stroje'><img src='./skin/button/16/view.png' alt='Prohlednout katalogov� list stroje' width='16px' height='16px' border='0'></a>&nbsp;";
		echo '</td></tr>';
	}

echo "</table>";
	
	}
}
?>



<?php if ($krok==4){?>
	<h2>Krok 5: Optimaliza�n� a matematick� parametry</h2>
	<br>
	<b>Kendallova klasifikace syst�mu hromadn� obsluhy (X/Y/c)</b>
	<br><br>
	<table>
	<tr><td>
	X (typ n�hodn�ho procesu popisuj�c�ho p��chod z�kazn�k� k obsluze):
	<select name="kendall_x">
	<option value="M" <?php if($kendall_x=="M") echo "selected='selected'";?>>Poisson�v proces p��chod�</option>
	<option value="E" <?php if($kendall_x=="E") echo "selected='selected'";?>>Erlangovo rozd�len� doby mezi p��chody, k=2</option>
	<option value="D" <?php if($kendall_x=="D") echo "selected='selected'";?>>Konstatntn� doba mezi p��chody</option>
	<option value="G" <?php if($kendall_x=="G") echo "selected='selected'";?>>Obecn� proces p��chod�</option>
	<option value="1" <?php if($kendall_x=="1") echo "selected='selected'";?>>Vlastn� rozd�len� 1</option>
	<option value="2" <?php if($kendall_x=="2") echo "selected='selected'";?>>Vlastn� rozd�len� 2</option>
	<option value="3" <?php if($kendall_x=="3") echo "selected='selected'";?>>Vlastn� rozd�len� 3</option>
	<option value="4" <?php if($kendall_x=="4") echo "selected='selected'";?>>Vlastn� rozd�len� 4</option>
	<option value="5" <?php if($kendall_x=="5") echo "selected='selected'";?>>Vlastn� rozd�len� 5</option>
	</select>
	<br><br>
	Y (typ rozd�len� doby obsluhy):
	<select name="kendall_y">
	<option value="M" <?php if($kendall_y=="M") echo "selected='selected'";?>>Exponenci�ln� rozd�len� doby obsluhy</option>
	<option value="E" <?php if($kendall_y=="E") echo "selected='selected'";?>>Erlangovo rozd�len� doby obsluhy, k=2</option>
	<option value="D" <?php if($kendall_y=="D") echo "selected='selected'";?>>Konstatntn� doba obsluhy</option>
	<option value="G" <?php if($kendall_y=="G") echo "selected='selected'";?>>Obecn� rozd�len� doby obsluhy</option>
	<option value="1" <?php if($kendall_y=="1") echo "selected='selected'";?>>Vlastn� rozd�len� 1</option>
	<option value="2" <?php if($kendall_y=="2") echo "selected='selected'";?>>Vlastn� rozd�len� 2</option>
	<option value="3" <?php if($kendall_y=="3") echo "selected='selected'";?>>Vlastn� rozd�len� 3</option>
	<option value="4" <?php if($kendall_y=="4") echo "selected='selected'";?>>Vlastn� rozd�len� 4</option>
	<option value="5" <?php if($kendall_y=="5") echo "selected='selected'";?>>Vlastn� rozd�len� 5</option>
	</select>
	</td></tr></table>
	<br>
	<hr>
	<b>Metoda Monte Carlo:</b><br><br>
	<table><tr><td>
	Po�et iterac�: J (od 1 000 do 100 000): <input type="text" value="<?php echo $pocet_iteracir;?>" name="pocet_iteraci" size="8">
	</td></tr></table>
	
	<hr>
	<b>Optimaliza�n� koeficienty</b>
	<table>
	<tr><td class="row2"> K1 (v�ha ekonomick�ho hlediska (n�klady)), [-]:</td><td class="row2"><input type="text" value="<?php echo $k1;?>" name="k1" size="5"></td></tr>
	<tr><td class="row1"> K2 (v�ha environment�ln�ho hlediska (produkce CO<sub>2</sub>)), [-]:</td><td class="row1"><input type="text" value="<?php echo $k2;?>" name="k2" size="5"></td></tr>
	<tr><td class="row2"> K3 (v�ha hlediska rychlosti spln�n� �kolu (doba spln�n�)), [-]:</td><td class="row2"><input type="text" value="<?php echo $k3;?>" name="k3" size="5"></td></tr>
	<tr><td class="row1"> K4 (v�ha hlediska spolehlivosti sestav (po�et poruch, n�klady na opravu)), [-]:</td><td class="row1"><input type="text" value="<?php echo $k4;?>" name="k4" size="5"></td></tr>
	<tr><td class="row2"> K5 (v�ha hlediska spot�eby energie), [-]:</td><td class="row2"><input type="text" value="<?php echo $k5;?>" name="k5" size="5"></td></tr>
	</table>
<?php }?>


<?php if ($krok==5){?>
	<h2>Krok 6: Nahodil� parametry</h2>

	<table>
	<tr><td class="row2"> R1 (nahodilost poruch):</td><td class="row2">
	<select name="r1">
	<option value="0" <?php if ($r1==0) echo "selected='selected'";?>>Bez vlivu nahodilosti poruch</option>
	<option value="1" <?php if ($r1==1) echo "selected='selected'";?>>Vliv nahodilosti poruch</option>
	</select>
	</td></tr>

	<tr><td class="row1"> R2 (nahodilost po�as�):</td><td class="row1">
	<select name="r2">
	<option value="0" <?php if ($r2==0) echo "selected='selected'";?>>Bez vlivu nahodilosti po�as�</option>
	<option value="1" <?php if ($r2==1) echo "selected='selected'";?>>Mal� vliv nahodilosti po�as�</option>
	<option value="2" <?php if ($r2==2) echo "selected='selected'";?>>St�edn� vliv nahodilosti po�as�</option>
	<option value="3" <?php if ($r2==3) echo "selected='selected'";?>>Velk� vliv nahodilosti po�as�</option>
	</select>
	</td></tr>

	<tr><td class="row2"> R3 (nahodilost dopravn�ch komplikac�):</td><td class="row2">
	<select name="r3">
	<option value="0" <?php if ($r3==0) echo "selected='selected'";?>>Bez vlivu nahodilosti dopravn�ch komplikac�</option>
	<option value="1" <?php if ($r3==1) echo "selected='selected'";?>>Mal� vliv nahodilosti dopravn�ch komplikac�</option>
	<option value="2" <?php if ($r3==2) echo "selected='selected'";?>>St�edn� vliv nahodilosti dopravn�ch komplikac�</option>
	<option value="3" <?php if ($r3==3) echo "selected='selected'";?>>Velk� vliv nahodilosti dopravn�ch komplikac�</option>
	</select>
	</td></tr>
	
	<tr><td class="row1"> R4 (nahodilost havarijn�ch stav�):</td><td class="row1">
	<select name="r4">
	<option value="0" <?php if ($r4==0) echo "selected='selected'";?>>Bez vlivu nahodilosti havarijn�ch stav�</option>
	<option value="1" <?php if ($r4==1) echo "selected='selected'";?>>Mal� vliv nahodilosti havarijn�ch stav�</option>
	<option value="2" <?php if ($r4==2) echo "selected='selected'";?>>St�edn� vliv nahodilosti havarijn�ch stav�</option>
	<option value="3" <?php if ($r4==3) echo "selected='selected'";?>>Velk� vliv nahodilosti havarijn�ch stav�</option>
	</select>
	</td></tr>
	
	<tr><td class="row2"> R5 (nahodilost lidsk�ho faktoru):</td><td class="row2">
	<select name="r5">
	<option value="0" <?php if ($r5==0) echo "selected='selected'";?>>Bez vlivu nahodilosti lidsk�ho faktoru</option>
	<option value="1" <?php if ($r5==1) echo "selected='selected'";?>>Mal� vliv nahodilosti lidsk�ho faktoru</option>
	<option value="2" <?php if ($r5==2) echo "selected='selected'";?>>St�edn� vliv nahodilosti lidsk�ho faktoru</option>
	<option value="3" <?php if ($r5==3) echo "selected='selected'";?>>Velk� vliv nahodilosti lidsk�ho faktoru</option>
	</select>
	</td></tr>
	</table>
<?php }?>


<?if (!$viewdalsikrok){?>
<hr><INPUT TYPE="submit" VALUE="Dal�� krok">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zp�t">
<?php }?>
</center>
<?if (!$viewdalsikrok){?>
</form>
<?php }?>
<?php
}






// Vymazavani zaznamu
if ($status==9){
?>
Opravdu si p�ejete model <?php echo $model;?> vymazat ? <a href='modelovani?status=99&model=<?php echo $model;?>' title="Vymazat model <?php echo $model;?>">Ano</a> <a href='modelovani' title="Ne">Ne</a>


<?php
}


// Vymazavani zaznamu
if ($status==99){
	if ($model) mysql_query("delete from model where id='$model'",$connect2);
	if ($model) mysql_query("delete from model_obsluha where model='$model'",$connect2);
	if ($model) mysql_query("delete from model_zakaznik where model='$model'",$connect2);
	$status=0;
	$model=0;
}

// Editace cinnosti - formular
if ($status==6){
}

// Karta cinnosti - nahled
if ($status==7){

}


// Kopirovani cinnosti - formular
if ($status==8){
}


// Nahlizeni do tabulky
if ($status==0){
?>
<a href='modelovani?status=1' target="_blank" title="Vlo�it nov� model :">+ Vlo�it nov� model</a>



<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft"><font class="name2"><b>ID</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>N�zev</b> /<br><b>Adresa</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Osoba</b> /<br><b>Developer</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Vlo�en� /<br>Zah�jen�</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Objem, [m.j]</font></td>
<td align="center" class="catLeft"><font class="name2"><b>Po�et linek obsluhy</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Po�et z�kazn�k�</b></font></td>
<td align="center" class="catLeft" width="110px"><font class="name2"></font></td>
</tr>

<?php

	$getclanek = mysql_query("SELECT * from model order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($row==1) $row=2;else $row=1;
		$iddd++;
		echo '<tr><td align="center" class="row'.$row.'"><font class="name2"><br>'.$clanky['id'].'</font></td>';
		echo '<td align="left" class="row'.$row.'"><font class="name2"><b>'.$clanky['nazev'].'</b>/<br>'.$clanky['adresa'].'</font></td>';
		echo '<td align="left" class="row'.$row.'"><font class="name2">'.$clanky['osoba']."/<br>".$clanky['firma'].'</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.date("d.m.Y",$clanky['time']).'/<br>'.date("d.m.Y",$clanky['zahajeni']).'</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.number_format($clanky['objem'], 0, ',', ' ')." ".$clanky['jednotka'].'</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['obsluha'].'</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$clanky['zakaznici'].'</font></td>';
		echo '<td align="center" class="row'.$row.'">';


		echo "<a href='modelovani?model=".$clanky['id']."&status=88' title='Prohlednout model'><img src='./skin/button/16/view.png' alt='Prohlednout model' width='16px' height='16px' border='0'></a>&nbsp;";

		if ($lock==0) echo "<a href='modelovani?model=".$clanky['id']."&status=1' title='Editovat parametry modelu'><img src='./skin/button/16/edit.png' alt='Editovat parametry modelu' width='16px' height='16px' border='0'></a>&nbsp;";
		if ($lock==0) echo "<a href='modelovani?model=".$clanky['id']."&status=9' title='Vymazat model'><img src='./skin/button/16/delete.png' alt='Vymazat model' width='16px' height='16px' border='0'></a>&nbsp;";

		echo "<a href='modelovani-soubory?model=".$clanky['id']."' title='P�ilo�en� soubory' target='_blank'><img src='./skin/button/16/new.png' alt='P�ilo�en� soubory' width='16px' height='16px' border='0'></a>&nbsp;";

		echo "<a href='model-vypocet?model=".$clanky['id']."' title='Vypo��tat model'><img src='./skin/button/32/sort.png' alt='Vypo��tat model' width='32px' height='32px' border='0'></a>&nbsp;";

		echo '</td></tr>';
	}

echo '</table>';
	

}


?>