<?php 
$barvaborder="C2A244";
if ($pomzalozka==1) $barvaborder="C2A244";
if ($pomzalozka==2) $barvaborder="2462C4";
if ($pomzalozka==7) $barvaborder="6699cc";
$od[0]="Dom�##Hlavn� str�nka";



if (!$schema_menu) $schema_menu=1;


// hlavni Strana
if ($schema_menu==1){
	$od[1]="Matematick� model#matematicky-model#Matematick� model";
	$od[2]="Ekonomick� model#ekonomicky-model#Ekonomick� model";
	$od[3]="Technologick� model#technologicky-model#Technologick� model";
	$od[4]="Environment�ln� model#environmentalni-model#Environment�ln� model";
	$od[5]="Po��ta�ov� simulace#simulace#Po��ta�ov� simulace";
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