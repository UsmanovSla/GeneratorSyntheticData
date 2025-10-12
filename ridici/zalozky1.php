<?php 
$barvaborder="C2A244";
if ($pomzalozka==1) $barvaborder="C2A244";
if ($pomzalozka==2) $barvaborder="2462C4";
if ($pomzalozka==7) $barvaborder="6699cc";
$od[0]="Domù##Hlavní stránka";



if (!$schema_menu) $schema_menu=1;


// hlavni Strana
if ($schema_menu==1){
	$od[1]="Matematický model#matematicky-model#Matematický model";
	$od[2]="Ekonomický model#ekonomicky-model#Ekonomický model";
	$od[3]="Technologický model#technologicky-model#Technologický model";
	$od[4]="Environmentální model#environmentalni-model#Environmentální model";
	$od[5]="Poèítaèová simulace#simulace#Poèítaèová simulace";
}



if ($akt_zal=="n") {$akt_zal=99999;}

$rt2=0;
$doplrt="";

for ($rt=$rt2;$rt<count($od);$rt++){
	$od2=split("#",$od[$rt]);
	if ($akt_zal==$rt){
		echo "<a href='index.php".$od2[1]."' title='".$od2[2]."'><font color=black><b>".$od2[0]."</b></font></a>"; if ($rt<count($od)-1) echo "&#0183;";
	}
	else {
		echo "<a href='./".$od2[1]."' title='".$od2[2]."'><b>".$od2[0]."</b></a>";if ($rt<count($od)-1) echo "&nbsp;&#0183;&nbsp;";
	}
}
?>