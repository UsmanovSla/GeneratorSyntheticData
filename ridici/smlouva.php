<?php
$smlouva_nazev[0]="Smlouva kupní na pozemek (stavbu), smlouva o smlouvì budoucí";
$smlouva_nazev[1]="Smlouva o dílo na zhotovení studie a projektu k územnímu øízení (souhlasu), ev. smlouva na celou PD";
$smlouva_nazev[2]="Smlouva o dílo na zhotovení projektu k stavebnímu povolení";
$smlouva_nazev[3]="Smlouva na zhotovení zadávací PD";
$smlouva_nazev[4]="Smlouva na výkon koordinátora BOZP (mandátní, pracovní)";
$smlouva_nazev[5]="Smlouva o dílo na zhotovení stavby ";
$smlouva_nazev[6]="Smlouva na výkon TDS (mandátní, pøíkazní, pracovní)";

$smlouva_nazev[9]="Smlouva na zhotovení realizaèní PD (pokud není souèástí smlouvy o dílo na stavbu)";
$smlouva_nazev[10]="Tato smlouva je souèástí smlouvy na zhotovení projektu";

$smlouva_nazev[19]="Smlouva o dílo (subdodávka)";

$smlouva_nazev[23]="Smlouva o pronájmu, kupní nebo leasingová";
$smlouva_nazev[24]="Smlouva pracovní";
$smlouva_nazev[25]="Smlouva kupní";
$smlouva_nazev[26]="Smlouva pro výkon poøizovatelské èinnosti (mandátní, pøíkazní)";
$smlouva_nazev[27]="Smlouva na výkon autorizovaného inspektora";
$smlouva_nazev[28]="Smlouva pro výkon poøizovatelské èinnosti (mandátní, pøíkazní)";

$smlouva_nazev[32]="Smlouva na výkon stavbyvedoucího (mandátní, pøíkazní, pracovní)";
$smlouva_nazev[33]="Smlouva o dílo na zhotovení projektu skuteèného stavu";



$smlouva_soubor[0]="smlouva-kupni-na-pozemek";
$smlouva_soubor[1]="smlouva-o-dilo-na-zhotoveni-studie";
$smlouva_soubor[2]="smlouva-o-dilo-na-zhotoveni-projektu";
$smlouva_soubor[3]="smlouva-na-zhotoveni-zadavaci-pd";
$smlouva_soubor[4]="smlouva-na-vykon-koordinatora-bozp";
$smlouva_soubor[5]="smlouva-o-dilo-na-zhotoveni-stavby";
$smlouva_soubor[6]="smlouva-na-vykon-tds";

$smlouva_soubor[9]="smlouva-na-zhotoveni-realizacni-pd";
$smlouva_soubor[10]="tato-smlouva-je-soucasti-smlouvy-na-zhotoveni-projektu";

$smlouva_soubor[19]="smlouva-o-dilo";

$smlouva_soubor[23]="smlouva-o-pronajmu";
$smlouva_soubor[24]="smlouva-pracovni";
$smlouva_soubor[25]="smlouva-kupni";
$smlouva_soubor[26]="smlouva-pro-vykon-porizovatelske-cinnosti";
$smlouva_soubor[27]="smlouva-na-vykon-autorizovaneho-inspektora";
$smlouva_soubor[28]="smlouva-pro-vykon-porizovatelske-cinnosti";

$smlouva_soubor[32]="smlouva-na-vykon-stavbyvedouciho";
$smlouva_soubor[33]="smlouva-o-dilo-na-zhotoveni-projektu-skutecneho-stavu";

$map_area[0]="10, 10, 40, 40";
$map_area[1]="40, 60, 175, 120";
$map_area[2]="190, 55, 410, 95";
$map_area[3]="230, 115, 408, 158";
$map_area[4]="450, 55, 645, 96";
$map_area[5]="450, 103, 645, 147";
$map_area[6]="724, 92, 909, 134";


$map_area[7]="50, 210, 174, 253";
$map_area[8]="207, 180, 367, 253";
$map_area[9]="465, 209, 748, 253";
$map_area[10]="762, 206, 909, 253";


$map_area[11]="266, 300, 410, 336";
$map_area[12]="307, 348, 410, 452";
$map_area[13]="291, 465, 410, 502";
$map_area[14]="265, 524, 410, 553";
$map_area[15]="437, 299, 663, 333";
$map_area[16]="481, 346, 651, 394";
$map_area[17]="481, 407, 651, 443";
$map_area[18]="481, 454, 651, 502";
$map_area[19]="481, 515, 651, 559";
$map_area[20]="723, 298, 909, 335";
$map_area[21]="748, 350, 909, 385";
$map_area[22]="698, 399, 909, 427";
$map_area[23]="739, 439, 909, 468";
$map_area[24]="739, 483, 909, 509";
$map_area[25]="739, 525, 928, 551";

$map_area[26]="41, 590, 175, 668";
$map_area[27]="233, 574, 398, 617";
$map_area[28]="208, 633, 367, 677";
$map_area[29]="693, 566, 877, 599";
$map_area[30]="693, 605, 877, 655";
$map_area[31]="904, 630, 1000, 670";

$map_area[32]="922, 345, 953, 510";
$map_area[33]="960, 185, 992, 510";

?>
<center>
<h1>Multimediální pomùcka Smluvní vztahy ve výstavbì</h1>
<map name="smlouvy">
<?php for($i=0;$i<=33;$i++){
	if ($smlouva_nazev[$i]) echo "<area href='smlouvy/".$smlouva_soubor[$i]."' shape='rect' coords='".$map_area[$i]."' target='_blank' title='".$smlouva_nazev[$i]."'>";
}
?>
</map>
<img src="smlouvy/smlouvy.png" usemap="#smlouvy" width="1001" height="677" border="0">
</center>
<hr>
<p align="left">
<h1>Seznam smluv:</h1>
<?php for($i=0;$i<=33;$i++){
	if ($smlouva_nazev[$i]) echo "<h2><a href='smlouvy/".$smlouva_soubor[$i]."' target='_blank' title='".$smlouva_nazev[$i]."'>".$smlouva_nazev[$i]." :</a></h2>";

	
}
?>
</p>