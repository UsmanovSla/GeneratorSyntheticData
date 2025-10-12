<?php 
echo "<h1>".$titl."</h1>";
?>
Databáze strojù obsahuje pìt tabulek:<br>
1). optimalizace_katalog_stroju - popisuje jednotné položky katalogu strojù<br>
2). optimalizace_pridavna_zarizeni - popisuje pøídavné zaøízení pro urèitý stroj<br>
3). optimalizace_skupiny_stroju_1 - popisuje hlavní rozdelení strojù na skupiny<br>
4). optimalizace_skupiny_stroju_2 - popisuje druhotné rozdelení strojù na skupiny<br>
5). optimalizace_vyrobce - popisuje katalog výrobcù strojù<br>
<br>
<hr>
<br>
<style id="struktura_mysql_18506_Styles">
<!--table
	{mso-displayed-decimal-separator:"\,";
	mso-displayed-thousand-separator:" ";}
.font518506
	{color:black;
	font-size:12.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:238;}
.font618506
	{color:black;
	font-size:14.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:238;}
.font718506
	{color:black;
	font-size:14.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:238;}
.xl6318506
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:238;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl6418506
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:700;
	font-style:italic;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:238;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	background:#B8CCE4;
	mso-pattern:black none;
	white-space:normal;}
.xl6518506
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:238;
	mso-number-format:General;
	text-align:general;
	vertical-align:top;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl6618506
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:238;
	mso-number-format:"\@";
	text-align:general;
	vertical-align:top;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl6718506
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:14.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:238;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
-->
</style>
<table border=0 cellpadding=0 cellspacing=0 width=1050 style='border-collapse:
 collapse;table-layout:fixed;width:788pt'>
 <col class=xl6318506 width=193 style='mso-width-source:userset;mso-width-alt:
 7058;width:145pt'>
 <col class=xl6318506 width=247 style='mso-width-source:userset;mso-width-alt:
 9033;width:185pt'>
 <col class=xl6318506 width=68 style='mso-width-source:userset;mso-width-alt:
 2486;width:51pt'>
 <col class=xl6318506 width=292 style='mso-width-source:userset;mso-width-alt:
 10678;width:219pt'>
 <col class=xl6318506 width=250 style='mso-width-source:userset;mso-width-alt:
 9142;width:188pt'>
 <tr height=29 valign=bottom style='mso-height-source:userset;height:21.75pt'>
  <td colspan=5 height=29 class=xl6718506 width=1050 style='height:21.75pt;
  width:788pt'><font class="font618506" size="4">Tabulka databáze: </font><font
  class="font718506" size="4"><b>optimalizace_katalog_stroju</b></font></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6318506 width=193 style='height:15.0pt;width:145pt'></td>
  <td class=xl6318506 width=247 style='width:185pt'></td>
  <td class=xl6318506 width=68 style='width:51pt'></td>
  <td class=xl6318506 width=292 style='width:219pt'></td>
  <td class=xl6318506 width=250 style='width:188pt'></td>
 </tr>
 <tr height=35 valign=bottom style='mso-height-source:userset;height:26.25pt'>
  <td height=35 class=xl6418506 bgcolor="#B8CCE4" align=center valign=middle
  width=193 style='height:26.25pt;width:145pt'><font class="font518506" size="3"><b><i>Název</i></b></font></td>
  <td class=xl6418506 bgcolor="#B8CCE4" align=center valign=middle width=247
  style='border-left:none;width:185pt'><font class="font518506" size="3"><b><i>Sloupec</i></b></font></td>
  <td class=xl6418506 bgcolor="#B8CCE4" align=center valign=middle width=68
  style='border-left:none;width:51pt'><font class="font518506" size="3"><b><i>Typ</i></b></font></td>
  <td class=xl6418506 bgcolor="#B8CCE4" align=center valign=middle width=292
  style='border-left:none;width:219pt'><font class="font518506" size="3"><b><i>Poznámka</i></b></font></td>
  <td class=xl6418506 bgcolor="#B8CCE4" align=center valign=middle width=250
  style='border-left:none;width:188pt'><font class="font518506" size="3"><b><i>Zdroj
  informace</i></b></font></td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6518506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Identifikaèní èíslo</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>id<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>unikátní oznaèení záznamu databáze strojù</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>vnitøní oznaèení</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6518506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Název stroje</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>nazev<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>char(250)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>vèetnì názvu, typu a oznaèení, napø.: Nakladaè øízený
  smykem CAT 226B/B2</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6518506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>První skupina stroje</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>skupina1<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>viz. tabulka databáze: optimalizace_skupiny_stroju_1</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>optimalizace_skupiny_stroju_1</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6518506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Druhá skupina stroje</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>skupina2<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>viz. tabulka databáze: optimalizace_skupiny_stroju_2</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>optimalizace_skupiny_stroju_2</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6518506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Typ stroje</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>typ<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>char(250)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>oznaèení dle výrobce, napø. CAT 226B/B2</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6518506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Druh prvku</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>druh_prvku<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>char(100)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>oznaèení dle teorie front: obsluhující prvek, zákazník,
  samostatný prvek atd.</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>matematické oznaèení</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6518506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Výkon motoru, [kW]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>vykon_kW<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>výkon motoru dle výrobce [kW] resp. [k]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6518506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Provozní hmotnost, [kg]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>provozni_hmotnost_kg<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>provozní hmotnost dle výrobce [kg] resp. [t]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Délka, [cm]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>delka_cm<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>délka stroje dle výrobce [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Šírka, [cm]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>sirka_cm<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>šíøka stroje dle výrobce [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Výška, [cm]<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>vyska_cm<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>výška stroje dle výrobce [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Maximální rychlost, [km/h]<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>max_rychlost_km_h<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>maximální rychlost pohybu stroje dle výrobce [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Provozní rychlost, [km/h]<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>provozni_rychlost_km_h<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>prùmìrná rychlost pohybu stroje dle výrobce [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Stoupavost, [grad]<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>stoupavost_stupnu<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(3)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>maximální stoupavost stroje dle výrobce [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Tlak na zeminu, [kPa]<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>tlak_na_zeminu_kPa<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>tlak na zeminu [kPa] resp. [MPa]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Pøídavné zaøízeni 1<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>pridavne_zarizeni_1<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>viz. tabulka databáze: optimalizace_pridavna_zarizeni</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>optimalizace_pridavna_zarizeni</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Pøídavné zaøízení 2<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>pridavne_zarizeni_2<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>viz. tabulka databáze: optimalizace_pridavna_zarizeni</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>optimalizace_pridavna_zarizeni</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Pøídavné zaøízení 3<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>pridavne_zarizeni_3<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>viz. tabulka databáze: optimalizace_pridavna_zarizeni</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>optimalizace_pridavna_zarizeni</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Pøídavné zaøízení 4<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>pridavne_zarizeni_4<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>viz. tabulka databáze: optimalizace_pridavna_zarizeni</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>optimalizace_pridavna_zarizeni</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Pøídavné zaøízení 5<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>pridavne_zarizeni_5<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>viz. tabulka databáze: optimalizace_pridavna_zarizeni</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>optimalizace_pridavna_zarizeni</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Dosah hloubka, [cm]<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>dosah_hloubka_cm<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>hloubkový dosah stroje dle výrobce, [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Dosah výška, [cm]<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>dosah_vyska_cm<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>výškový dosah stroje dle výrobce, [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Dosah délka, [cm]<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>dosah_delka_cm<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>dosah stroje na délku dle výrobce, [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Polomìr otáèení, [cm]<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>polomer_otaceni_cm<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>hloubkový dosah stroje dle výrobce, [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Poznámka</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>poznamka<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>char(250)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>vlastní poznámka</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>vnitøní oznaèení</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Spotøeba paliva hi,[ml/hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>spotreba_paliva_hi_ml_hod<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>odhad spotøeby paliva dle výrobce pro maximální vytížení
  stroje (80-100%)</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce + vlastní výpoèet</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Spotøeba paliva medium, [ml/hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>spotreba_paliva_medium_ml_hod<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>odhad spotøeby paliva dle výrobce pro prùmìrné vytížení
  stroje (60-80%)</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>vlastní výpoèet</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Spotøeba paliva low, [ml/hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>spotreba_paliva_low_ml_hod<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>odhad spotøeby paliva dle výrobce pro minimální vytížení
  stroje (40-60%)</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>vlastní výpoèet</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>CO2 hi, [g/hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>co2_hi_ml_hod<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>odhad velikosti CO2 dle výrobce pro maximální vytížení
  stroje (80-100%)</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce + vlastní výpoèet</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>CO2 medium, [g/hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>co2_medium_ml_hod<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>odhad velikosti CO2 dle výrobce pro prùmìrné vytížení
  stroje (80-100%)</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>vlastní výpoèet</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>CO2 low, [g/hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>co2_low_ml_hod<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>odhad velikosti CO2 dle výrobce pro minimální vytížení
  stroje (80-100%)</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>vlastní výpoèet</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Hluk v interiéru, [dB]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>hluk_int<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>hluk stroje v interiéru dle výrobce, [dB]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Hluk v exteriéru, [dB]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>hluk_ext<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>hluk stroje v exteriéru dle výrobce, [dB]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Náklady, standardní sazba, [Kè/hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>naklady_standardni_sazba_kc_hod<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>standardní hodinová sazba pronájmu stroje vèetnì obsluhy
  bez PHM, [Kè/hod]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>ceník pùjèovny strojù (2012 rok)</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Náklady, pøesèasová sazba, [Kè/hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>naklady_prescasova_sazba_kc_hod<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>pøesèasová hodinová sazba pronájmu stroje vèetnì obsluhy
  bez PHM, [Kè/hod]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>ceník pùjèovny strojù (2012 rok)</td>
 </tr>
 <tr height=60 valign=bottom style='height:45.0pt'>
  <td height=60 class=xl6618506 valign=top width=193 style='height:45.0pt;
  border-top:none;width:145pt'>Náklady na použití, [Kè]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>naklady_na_pouziti_kc<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>náklady na celý úkol nebo náklad na použití stroje (pøísun,
  odsun, školení personálu), [Kè]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>ceník pùjèovny strojù (2012 rok)</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Cena stroje, [Kè]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>cena_stroje<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>bigint(10)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>cena stroje dle prodejních katalogù výrobce, [Kè]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>prodejní katalog (2012 rok)</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Pravdìpodobnost poruchy, [poèet poruch/1000 hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>pravdepodobnost_poruchy_1000_hod<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>float<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>prùmìrný poèet poruch stroje bìhem 1000 hodin práce</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>mìøení v terénu + metoda Monte Carlo</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Prùmìrná doba opravy, [min]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>prumerna_doba_opravy_min<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6618506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>prùmìrná doba opravy stroje dle výrobce, [min]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>mìøení v terénu + metoda Monte Carlo</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Prùmìrná cena opravy, [Kè]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>prumerna_cena_opravy_kc<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6618506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>prùmìrná cena opravy stroje dle výrobce, [Kè]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Prùmìrná doba služby, [let]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>prumerna_doba_sluzby_let<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(5)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6618506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>prùmìrná doba služby stroje za podmínky servisu dle
  výrobce, [let]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>odhad výrobce + metoda Monte Carlo</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Minimální pracovní plocha, [m2]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>minimalni_pracovni_plocha_m2<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6618506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>minimální pracovní plocha nutná pro stroj, bez ztráty
  výkonu, [m2]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>technologický model stavby</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Poèet jednotek, [-]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>pocet_jednotek<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>float<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6618506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>poèet jednotek stroje, napø. objem korby, lopaty, délka
  radlice atd. [-]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Jednotka<span style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>jednotka<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>char(50)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6618506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>jednotka stroje, napø. m3,m2,bm, kg atd.</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogový list výrobce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Pracovní výkon, [jednotka/hod]<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>pracovni_vykon_jednotka_hod<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6618506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>pracovní výkon stroje, [jednotka/hod]<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>mìøení v terénu + teorie front</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Pracovní cyklus, [sek]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'> </span>pracovni_cyklus_sek<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6618506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>pracovní cyklus stroje, [sek]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>mìøení v terénu + teorie front</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Výrobce<span style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'> </span>vyrobce<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>char(100)<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>viz. tabulka databáze: optimalizace_vyrobce</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>optimalizace_vyrobce</td>
 </tr>
</table>

<hr>