<?php 
echo "<h1>".$titl."</h1>";
?>
Datab�ze stroj� obsahuje p�t tabulek:<br>
1). optimalizace_katalog_stroju - popisuje jednotn� polo�ky katalogu stroj�<br>
2). optimalizace_pridavna_zarizeni - popisuje p��davn� za��zen� pro ur�it� stroj<br>
3). optimalizace_skupiny_stroju_1 - popisuje hlavn� rozdelen� stroj� na skupiny<br>
4). optimalizace_skupiny_stroju_2 - popisuje druhotn� rozdelen� stroj� na skupiny<br>
5). optimalizace_vyrobce - popisuje katalog v�robc� stroj�<br>
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
  width:788pt'><font class="font618506" size="4">Tabulka datab�ze: </font><font
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
  width=193 style='height:26.25pt;width:145pt'><font class="font518506" size="3"><b><i>N�zev</i></b></font></td>
  <td class=xl6418506 bgcolor="#B8CCE4" align=center valign=middle width=247
  style='border-left:none;width:185pt'><font class="font518506" size="3"><b><i>Sloupec</i></b></font></td>
  <td class=xl6418506 bgcolor="#B8CCE4" align=center valign=middle width=68
  style='border-left:none;width:51pt'><font class="font518506" size="3"><b><i>Typ</i></b></font></td>
  <td class=xl6418506 bgcolor="#B8CCE4" align=center valign=middle width=292
  style='border-left:none;width:219pt'><font class="font518506" size="3"><b><i>Pozn�mka</i></b></font></td>
  <td class=xl6418506 bgcolor="#B8CCE4" align=center valign=middle width=250
  style='border-left:none;width:188pt'><font class="font518506" size="3"><b><i>Zdroj
  informace</i></b></font></td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6518506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Identifika�n� ��slo</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>id<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>unik�tn� ozna�en� z�znamu datab�ze stroj�</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>vnit�n� ozna�en�</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6518506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>N�zev stroje</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>nazev<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>char(250)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>v�etn� n�zvu, typu a ozna�en�, nap�.: Naklada� ��zen�
  smykem CAT 226B/B2</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6518506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Prvn� skupina stroje</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>skupina1<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>viz. tabulka datab�ze: optimalizace_skupiny_stroju_1</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>optimalizace_skupiny_stroju_1</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6518506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Druh� skupina stroje</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>skupina2<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>viz. tabulka datab�ze: optimalizace_skupiny_stroju_2</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>optimalizace_skupiny_stroju_2</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6518506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Typ stroje</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>typ<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>char(250)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>ozna�en� dle v�robce, nap�. CAT 226B/B2</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6518506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Druh prvku</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>druh_prvku<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>char(100)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>ozna�en� dle teorie front: obsluhuj�c� prvek, z�kazn�k,
  samostatn� prvek atd.</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>matematick� ozna�en�</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6518506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>V�kon motoru, [kW]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>vykon_kW<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>v�kon motoru dle v�robce [kW] resp. [k]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6518506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Provozn� hmotnost, [kg]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>provozni_hmotnost_kg<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>provozn� hmotnost dle v�robce [kg] resp. [t]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>D�lka, [cm]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>delka_cm<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>d�lka stroje dle v�robce [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>��rka, [cm]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>sirka_cm<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>���ka stroje dle v�robce [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>V��ka, [cm]<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>vyska_cm<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>v��ka stroje dle v�robce [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Maxim�ln� rychlost, [km/h]<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>max_rychlost_km_h<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>maxim�ln� rychlost pohybu stroje dle v�robce [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Provozn� rychlost, [km/h]<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>provozni_rychlost_km_h<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>pr�m�rn� rychlost pohybu stroje dle v�robce [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Stoupavost, [grad]<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>stoupavost_stupnu<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(3)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>maxim�ln� stoupavost stroje dle v�robce [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Tlak na zeminu, [kPa]<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>tlak_na_zeminu_kPa<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>tlak na zeminu [kPa] resp. [MPa]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>P��davn� za��zeni 1<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>pridavne_zarizeni_1<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>viz. tabulka datab�ze: optimalizace_pridavna_zarizeni</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>optimalizace_pridavna_zarizeni</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>P��davn� za��zen� 2<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>pridavne_zarizeni_2<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>viz. tabulka datab�ze: optimalizace_pridavna_zarizeni</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>optimalizace_pridavna_zarizeni</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>P��davn� za��zen� 3<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>pridavne_zarizeni_3<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>viz. tabulka datab�ze: optimalizace_pridavna_zarizeni</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>optimalizace_pridavna_zarizeni</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>P��davn� za��zen� 4<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>pridavne_zarizeni_4<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>viz. tabulka datab�ze: optimalizace_pridavna_zarizeni</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>optimalizace_pridavna_zarizeni</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>P��davn� za��zen� 5<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>pridavne_zarizeni_5<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>viz. tabulka datab�ze: optimalizace_pridavna_zarizeni</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>optimalizace_pridavna_zarizeni</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Dosah hloubka, [cm]<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>dosah_hloubka_cm<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>hloubkov� dosah stroje dle v�robce, [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Dosah v��ka, [cm]<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>dosah_vyska_cm<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>v��kov� dosah stroje dle v�robce, [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Dosah d�lka, [cm]<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>dosah_delka_cm<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>dosah stroje na d�lku dle v�robce, [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Polom�r ot��en�, [cm]<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>polomer_otaceni_cm<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>hloubkov� dosah stroje dle v�robce, [cm] resp. [m]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Pozn�mka</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>poznamka<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>char(250)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>vlastn� pozn�mka</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>vnit�n� ozna�en�</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Spot�eba paliva hi,[ml/hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>spotreba_paliva_hi_ml_hod<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>odhad spot�eby paliva dle v�robce pro maxim�ln� vyt�en�
  stroje (80-100%)</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce + vlastn� v�po�et</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Spot�eba paliva medium, [ml/hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>spotreba_paliva_medium_ml_hod<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>odhad spot�eby paliva dle v�robce pro pr�m�rn� vyt�en�
  stroje (60-80%)</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>vlastn� v�po�et</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Spot�eba paliva low, [ml/hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>spotreba_paliva_low_ml_hod<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>odhad spot�eby paliva dle v�robce pro minim�ln� vyt�en�
  stroje (40-60%)</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>vlastn� v�po�et</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>CO2 hi, [g/hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>co2_hi_ml_hod<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>odhad velikosti CO2 dle v�robce pro maxim�ln� vyt�en�
  stroje (80-100%)</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce + vlastn� v�po�et</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>CO2 medium, [g/hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>co2_medium_ml_hod<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>odhad velikosti CO2 dle v�robce pro pr�m�rn� vyt�en�
  stroje (80-100%)</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>vlastn� v�po�et</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>CO2 low, [g/hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>co2_low_ml_hod<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>odhad velikosti CO2 dle v�robce pro minim�ln� vyt�en�
  stroje (80-100%)</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>vlastn� v�po�et</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Hluk v interi�ru, [dB]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>hluk_int<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>hluk stroje v interi�ru dle v�robce, [dB]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Hluk v exteri�ru, [dB]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>hluk_ext<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>hluk stroje v exteri�ru dle v�robce, [dB]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>N�klady, standardn� sazba, [K�/hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>naklady_standardni_sazba_kc_hod<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>standardn� hodinov� sazba pron�jmu stroje v�etn� obsluhy
  bez PHM, [K�/hod]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>cen�k p�j�ovny stroj� (2012 rok)</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>N�klady, p�es�asov� sazba, [K�/hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>naklady_prescasova_sazba_kc_hod<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>p�es�asov� hodinov� sazba pron�jmu stroje v�etn� obsluhy
  bez PHM, [K�/hod]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>cen�k p�j�ovny stroj� (2012 rok)</td>
 </tr>
 <tr height=60 valign=bottom style='height:45.0pt'>
  <td height=60 class=xl6618506 valign=top width=193 style='height:45.0pt;
  border-top:none;width:145pt'>N�klady na pou�it�, [K�]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>naklady_na_pouziti_kc<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>n�klady na cel� �kol nebo n�klad na pou�it� stroje (p��sun,
  odsun, �kolen� person�lu), [K�]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>cen�k p�j�ovny stroj� (2012 rok)</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Cena stroje, [K�]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>cena_stroje<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>bigint(10)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>cena stroje dle prodejn�ch katalog� v�robce, [K�]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>prodejn� katalog (2012 rok)</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Pravd�podobnost poruchy, [po�et poruch/1000 hod]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>pravdepodobnost_poruchy_1000_hod<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>float<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>pr�m�rn� po�et poruch stroje b�hem 1000 hodin pr�ce</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>m��en� v ter�nu + metoda Monte Carlo</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Pr�m�rn� doba opravy, [min]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>prumerna_doba_opravy_min<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6618506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>pr�m�rn� doba opravy stroje dle v�robce, [min]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>m��en� v ter�nu + metoda Monte Carlo</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Pr�m�rn� cena opravy, [K�]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>prumerna_cena_opravy_kc<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6618506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>pr�m�rn� cena opravy stroje dle v�robce, [K�]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Pr�m�rn� doba slu�by, [let]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>prumerna_doba_sluzby_let<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(5)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6618506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>pr�m�rn� doba slu�by stroje za podm�nky servisu dle
  v�robce, [let]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>odhad v�robce + metoda Monte Carlo</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Minim�ln� pracovn� plocha, [m2]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>minimalni_pracovni_plocha_m2<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6618506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>minim�ln� pracovn� plocha nutn� pro stroj, bez ztr�ty
  v�konu, [m2]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>technologick� model stavby</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Po�et jednotek, [-]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>pocet_jednotek<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>float<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6618506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>po�et jednotek stroje, nap�. objem korby, lopaty, d�lka
  radlice atd. [-]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Jednotka<span style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>jednotka<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>char(50)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6618506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>jednotka stroje, nap�. m3,m2,bm, kg atd.</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>katalogov� list v�robce</td>
 </tr>
 <tr height=40 valign=bottom style='height:30.0pt'>
  <td height=40 class=xl6618506 valign=top width=193 style='height:30.0pt;
  border-top:none;width:145pt'>Pracovn� v�kon, [jednotka/hod]<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>pracovni_vykon_jednotka_hod<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(8)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6618506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>pracovn� v�kon stroje, [jednotka/hod]<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>m��en� v ter�nu + teorie front</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>Pracovn� cyklus, [sek]</td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span
  style='mso-spacerun:yes'>�</span>pracovni_cyklus_sek<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>int(6)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6618506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>pracovn� cyklus stroje, [sek]</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>m��en� v ter�nu + teorie front</td>
 </tr>
 <tr height=20 valign=bottom style='height:15.0pt'>
  <td height=20 class=xl6618506 valign=top width=193 style='height:15.0pt;
  border-top:none;width:145pt'>V�robce<span style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=247 style='border-top:none;border-left:
  none;width:185pt'><span style='mso-spacerun:yes'>�</span>vyrobce<span
  style='mso-spacerun:yes'>��</span></td>
  <td class=xl6518506 valign=top width=68 style='border-top:none;border-left:
  none;width:51pt'>char(100)<span style='mso-spacerun:yes'>�</span></td>
  <td class=xl6518506 valign=top width=292 style='border-top:none;border-left:
  none;width:219pt'>viz. tabulka datab�ze: optimalizace_vyrobce</td>
  <td class=xl6518506 valign=top width=250 style='border-top:none;border-left:
  none;width:188pt'>optimalizace_vyrobce</td>
 </tr>
</table>

<hr>