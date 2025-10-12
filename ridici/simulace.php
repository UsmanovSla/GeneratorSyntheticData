<?php 
echo "<h1>".$titl."</h1>";
?>
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;}
@font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;}
@font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{mso-style-link:"Text bubliny Char";
	margin:0cm;
	margin-bottom:.0001pt;
	font-size:8.0pt;
	font-family:"Tahoma","sans-serif";}
p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:36.0pt;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
p.MsoListParagraphCxSpFirst, li.MsoListParagraphCxSpFirst, div.MsoListParagraphCxSpFirst
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:36.0pt;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
p.MsoListParagraphCxSpMiddle, li.MsoListParagraphCxSpMiddle, div.MsoListParagraphCxSpMiddle
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:36.0pt;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
p.MsoListParagraphCxSpLast, li.MsoListParagraphCxSpLast, div.MsoListParagraphCxSpLast
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:36.0pt;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
span.TextbublinyChar
	{mso-style-name:"Text bubliny Char";
	mso-style-link:"Text bubliny";
	font-family:"Tahoma","sans-serif";}
.MsoChpDefault
	{font-family:"Calibri","sans-serif";}
.MsoPapDefault
	{margin-bottom:10.0pt;
	line-height:115%;}
 /* List Definitions */
 ol
	{margin-bottom:0cm;}
ul
	{margin-bottom:0cm;}
-->
</style>
<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>Pro matematické modelování a simulaci bylo rozhodnuto použit
speciální software [1]. Simulaèní software umožòuje snadné zavedení do modelu
dalších upøesòujících parametrù a koeficientù.</span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>Matematické modelování provedeme na pøíkladu stavební etapy
zemní práce. Na základì výstupu simulace, optimálnì navrhneme pro daný úkol
strojní sestavu (rypadlo) ze tøech možných variant a optimální poèet nákladních
aut pro odvoz zeminy. Rozhodujícím kritériem bude splnìní úkolu za urèitý èas a
minimální finanèní náklady. Objem úkolu je konstantní a nemìní se. Ostatní
stroje: druh nákladních aut (dumper) je pøedem urèený. Poèet kanálù vychází
z&nbsp;geografických podmínek stavby a v&nbsp;našem pøíkladu je pøesnì zadaný a
roven N = 1. Pro zjednodušenost vždycky budeme volit stejný druh rypadel pro
každý kanál.  </span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>Celý matematický model mùžeme rozdìlit na tøi èastí: vstup,
jádro modelu a výstup, viz obr. 1.</span></font></p>

<p class=MsoNormal align=center style='text-align:center;line-height:150%'><font
size=3 face=Arial><span style='font-size:12.0pt;line-height:150%;font-family:
"Arial","sans-serif"'><img width=522 height=443 id="Obrázek 2"
src="images/3/image001.jpg" alt="Popis: Popis: 1.jpg"></span></font></p>

<p class=MsoNormal align=center style='text-align:center;line-height:150%'><a
name="OLE_LINK8"></a><a name="OLE_LINK7"><i><font size=3 face="Times New Roman"><span
style='font-size:12.0pt;line-height:150%;font-style:italic'>Obr. 1 Schéma
matematického modelu v&nbsp;simulaèním softwaru </span></font></i></a><i><span
lang=PT-BR style='font-style:italic'>[1]</span></i></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><i><font size=3 face=Arial><span lang=PT-BR style='font-size:12.0pt;
line-height:150%;font-family:"Arial","sans-serif";font-style:italic'>&nbsp;</span></font></i></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>Matematický model obsahuje nìkolik dùležitých subsystému pro
výpoèet poruch strojù a pro zjištìní ekonomických parametrù systému, viz obr. 2.</span></font></p>

<p class=MsoListParagraph style='text-align:justify;text-indent:42.55pt;
line-height:150%'><font size=3 face=Arial><span style='font-size:12.0pt;
line-height:150%;font-family:"Arial","sans-serif"'>&nbsp;</span></font></p>

<p class=MsoNormal align=center style='text-align:center;line-height:150%'><i><font
size=3 face=Arial><span style='font-size:12.0pt;line-height:150%;font-family:
"Arial","sans-serif";font-style:italic'><img width=605 height=298 id="Obrázek 1"
src="images/3/image002.jpg" alt="Popis: Popis: 2.jpg"></span></font></i></p>

<p class=MsoNormal align=center style='text-align:center;line-height:150%'><i><font
size=3 face="Times New Roman"><span style='font-size:12.0pt;line-height:150%;
font-style:italic'>Obr. 2 Subsystémy matematického modelu v&nbsp;SW [1]</span></font></i></p>

<p class=MsoNormal><font size=3 face="Times New Roman"><span style='font-size:
12.0pt'>&nbsp;</span></font></p>