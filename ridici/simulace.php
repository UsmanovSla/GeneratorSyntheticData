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
line-height:150%'>Pro matematick� modelov�n� a simulaci bylo rozhodnuto pou�it
speci�ln� software [1]. Simula�n� software umo��uje snadn� zaveden� do modelu
dal��ch up�es�uj�c�ch parametr� a koeficient�.</span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>Matematick� modelov�n� provedeme na p��kladu stavebn� etapy
zemn� pr�ce. Na z�klad� v�stupu simulace, optim�ln� navrhneme pro dan� �kol
strojn� sestavu (rypadlo) ze t�ech mo�n�ch variant a optim�ln� po�et n�kladn�ch
aut pro odvoz zeminy. Rozhoduj�c�m krit�riem bude spln�n� �kolu za ur�it� �as a
minim�ln� finan�n� n�klady. Objem �kolu je konstantn� a nem�n� se. Ostatn�
stroje: druh n�kladn�ch aut (dumper) je p�edem ur�en�. Po�et kan�l� vych�z�
z&nbsp;geografick�ch podm�nek stavby a v&nbsp;na�em p��kladu je p�esn� zadan� a
roven N = 1. Pro zjednodu�enost v�dycky budeme volit stejn� druh rypadel pro
ka�d� kan�l.� </span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>Cel� matematick� model m��eme rozd�lit na t�i �ast�: vstup,
j�dro modelu a v�stup, viz obr. 1.</span></font></p>

<p class=MsoNormal align=center style='text-align:center;line-height:150%'><font
size=3 face=Arial><span style='font-size:12.0pt;line-height:150%;font-family:
"Arial","sans-serif"'><img width=522 height=443 id="Obr�zek 2"
src="images/3/image001.jpg" alt="Popis: Popis: 1.jpg"></span></font></p>

<p class=MsoNormal align=center style='text-align:center;line-height:150%'><a
name="OLE_LINK8"></a><a name="OLE_LINK7"><i><font size=3 face="Times New Roman"><span
style='font-size:12.0pt;line-height:150%;font-style:italic'>Obr. 1 Sch�ma
matematick�ho modelu v&nbsp;simula�n�m softwaru </span></font></i></a><i><span
lang=PT-BR style='font-style:italic'>[1]</span></i></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><i><font size=3 face=Arial><span lang=PT-BR style='font-size:12.0pt;
line-height:150%;font-family:"Arial","sans-serif";font-style:italic'>&nbsp;</span></font></i></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>Matematick� model obsahuje n�kolik d�le�it�ch subsyst�mu pro
v�po�et poruch stroj� a pro zji�t�n� ekonomick�ch parametr� syst�mu, viz obr. 2.</span></font></p>

<p class=MsoListParagraph style='text-align:justify;text-indent:42.55pt;
line-height:150%'><font size=3 face=Arial><span style='font-size:12.0pt;
line-height:150%;font-family:"Arial","sans-serif"'>&nbsp;</span></font></p>

<p class=MsoNormal align=center style='text-align:center;line-height:150%'><i><font
size=3 face=Arial><span style='font-size:12.0pt;line-height:150%;font-family:
"Arial","sans-serif";font-style:italic'><img width=605 height=298 id="Obr�zek 1"
src="images/3/image002.jpg" alt="Popis: Popis: 2.jpg"></span></font></i></p>

<p class=MsoNormal align=center style='text-align:center;line-height:150%'><i><font
size=3 face="Times New Roman"><span style='font-size:12.0pt;line-height:150%;
font-style:italic'>Obr. 2 Subsyst�my matematick�ho modelu v&nbsp;SW [1]</span></font></i></p>

<p class=MsoNormal><font size=3 face="Times New Roman"><span style='font-size:
12.0pt'>&nbsp;</span></font></p>