<?php 
$barvaborder="C2A244";
if ($pomzalozka==1) $barvaborder="C2A244";
if ($pomzalozka==2) $barvaborder="2462C4";
if ($pomzalozka==7) $barvaborder="6699cc";



if (!$schema_menu2) $schema_menu2=1;


// hlavni Strana
if ($schema_menu2==1){
	$od[0]="O projektu#/o-projektu#O projektu";
	$od[1]="Datab�ze stroj�#/databaze-stroju#Datab�ze stroj�";
	$od[2]="Katalog stroj�#/katalog-stroju#Katalog stroj�";
	$od[3]="Optimalizace sestav#/optimalizace#Optimalizace sestav";
	$od[4]="Diskuzn� f�rum#./diskuzni-forum/viewforum.php?f=50#Diskuzn� f�rum";
	$od[5]="Kontakty#/kontakt#Kontakty";
	$od[6]="Kniha n�v�t�v#/kniha-navstev#Kniha n�v�t�v";
	$od[7]="Ke sta�en�#/ke-stazeni#Ke sta�en�";

}



if ($akt_zal2=="n") {$akt_zal=99999;}

$rt2=0;
$doplrt="";

for ($rt=$rt2;$rt<count($od);$rt++){
	$od2=split("#",$od[$rt]);
	if ($akt_zal==$rt){
		echo "<a href='index.php".$od2[1]."' title='".$od2[2]."'><font color=black><b>".$od2[0]."</b></font></a>"; if ($rt<count($od)-1) echo "&nbsp;&nbsp;&#0183;&nbsp;&nbsp;";
	}
	else {
		echo "<a href='.".$od2[1]."' title='".$od2[2]."'><b>".$od2[0]."</b></a>";if ($rt<count($od)-1) echo "&nbsp;&nbsp;&#0183;&nbsp;&nbsp;";
	}
}
?>