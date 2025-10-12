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
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:10.0pt;
	margin-left:0cm;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:10.0pt;
	margin-left:36.0pt;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpFirst, li.MsoListParagraphCxSpFirst, div.MsoListParagraphCxSpFirst
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:36.0pt;
	margin-bottom:.0001pt;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpMiddle, li.MsoListParagraphCxSpMiddle, div.MsoListParagraphCxSpMiddle
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:36.0pt;
	margin-bottom:.0001pt;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpLast, li.MsoListParagraphCxSpLast, div.MsoListParagraphCxSpLast
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:10.0pt;
	margin-left:36.0pt;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
.MsoChpDefault
	{font-family:"Calibri","sans-serif";}
.MsoPapDefault
	{margin-bottom:10.0pt;
	line-height:115%;}
@page WordSection1
	{size:595.3pt 841.9pt;
	margin:70.85pt 70.85pt 70.85pt 70.85pt;}
div.WordSection1
	{page:WordSection1;}
 /* List Definitions */
 ol
	{margin-bottom:0cm;}
ul
	{margin-bottom:0cm;}
-->
</style>

<div class=WordSection1>

<p class=MsoListParagraphCxSpFirst style='text-indent:-18.0pt'>1.<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Parametry
úkolu (dle smlouvy o dílo)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>Q [m.j.] – objem úkolu (<i>pozn.: skuteèný koneèný objem práce
vèetnì koeficientu nakypøení, ztrát atd.</i>)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>M.J. – mìrná jednotka práce</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>D<sub>start</sub> [-] – datum zahájení úkolu dle smlouvy</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>D<sub>end</sub> [-] – datum ukonèení úkolu dle smlouvy</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>S<sub>max</sub> [m2] – maximální možná pracovní plocha</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>T<sub>s</sub> [hod] – délka smìny za den dle èasového planu</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>N<sub>t</sub> [dnù] – poèet pracovních dnù za týden dle èasového
planu</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>T<sub>p</sub> [hod] – délka pøesèasu za den dle èasového planu</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>K<sub>p</sub> [-] – koeficient zvýšení nákladu za pøesèasy</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>V<sub>t</sub> [Kè/den] – variabilní náklady (všechny náklady bez zkoumané strojní sestavy)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>P [Kè/den] – penále na den (za nesplnìní úkolu vèas)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>B [Kè/den] – bonus na den (za døívìjší splnìní úkolu)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>K<sub>p</sub> [-] – obecný koeficient produktivity strojù dle nároèností projektu (pozn.: od 0 do 2; výsledný výkon strojní sestavy se vynásobí Kp)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt'>&nbsp;</p>

<p class=MsoListParagraphCxSpMiddle style='text-indent:-18.0pt'>2.<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Parametry
obsluhujícího stroje (dle katalogu strojù) (pozn.: každá zkoumána varianta (maximálnì
do 5-ti variant) bude obsahovat vlastní parametry)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>P [m.j./hod] – prùmìrný pracovní výkon stroje</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>T<sub>c</sub> [sek] – prùmìrná délka pracovního cyklu</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>N<sub>max</sub> [-] – maximální disponibilní poèet jednotek</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><em><span
style='font-family:Symbol;font-style:normal'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></em><em><span style='font-family:"Calibri","sans-serif";
font-style:normal'>S<sub>min</sub> [m2] </span></em>–<em><span
style='font-family:"Calibri","sans-serif";font-style:normal'> minimální
pracovní plocha</span></em></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><em><span
style='font-family:Symbol;font-style:normal'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></em><em><span style='font-family:"Calibri","sans-serif";
font-style:normal'>VC [Kè/hod] </span></em>–<em><span style='font-family:"Calibri","sans-serif";
font-style:normal'> variabilní náklad (odvozený z&nbsp;prùmìru standardní a
pøesèasové sazby za den)</span></em></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><em><span
style='font-family:Symbol;font-style:normal'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></em><em><span style='font-family:"Calibri","sans-serif";
font-style:normal'>FC [Kè] </span></em>–<em><span style='font-family:"Calibri","sans-serif";
font-style:normal'> fixní náklad (náklad na použití)</span></em></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><em><span
style='font-family:Symbol;font-style:normal'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></em><em><span style='font-family:"Calibri","sans-serif";
font-style:normal'>L [poèet poruch/1000 hod] – pravdìpodobnost poruchy</span></em></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><em><span
style='font-family:Symbol;font-style:normal'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></em><em><span style='font-family:"Calibri","sans-serif";
font-style:normal'>T<sub>L</sub> [min] – prùmìrná doba opravy</span></em></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><em><span
style='font-family:Symbol;font-style:normal'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></em><em><span style='font-family:"Calibri","sans-serif";
font-style:normal'>C<sub>L</sub> [Kè] – prùmìrný náklad na odstranìní poruchy</span></em></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><em><span
style='font-family:Symbol;font-style:normal'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></em><em><span style='font-family:"Calibri","sans-serif";
font-style:normal'>Sp [ml/hod] – spotøeba energie (nafta)</span></em></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><em><span
style='font-family:Symbol;font-style:normal'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></em><em><span style='font-family:"Calibri","sans-serif";
font-style:normal'>CO<sub>2</sub> </span></em><em><span lang=EN-US
style='font-family:"Calibri","sans-serif";font-style:normal'>[</span></em><em><span
style='font-family:"Calibri","sans-serif";font-style:normal'>g/hod</span></em><em><span
lang=EN-US style='font-family:"Calibri","sans-serif";font-style:normal'>] </span></em><em><span
style='font-family:"Calibri","sans-serif";font-style:normal'>– produkce CO<sub>2</sub></span></em></p>

<p class=MsoListParagraphCxSpMiddle>&nbsp;</p>

<p class=MsoListParagraphCxSpMiddle style='text-indent:-18.0pt'>3.<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Parametry
obsluhovaného stroje (dle katalogu strojù) (pozn.: každá zkoumána varianta (maximálnì
do 5-ti variant) bude obsahovat vlastní parametry)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>P [m.j./hod] – prùmìrný pracovní výkon stroje</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>T<sub>c</sub> [sek] – prùmìrná délka pracovního cyklu</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>N<sub>max</sub> [-] – maximální disponibilní poèet jednotek</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><em><span
style='font-family:Symbol;font-style:normal'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></em><em><span style='font-family:"Calibri","sans-serif";
font-style:normal'>S<sub>min</sub> [m2] </span></em>–<em><span
style='font-family:"Calibri","sans-serif";font-style:normal'> minimální
pracovní plocha</span></em></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><em><span
style='font-family:Symbol;font-style:normal'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></em><em><span style='font-family:"Calibri","sans-serif";
font-style:normal'>VC [Kè/hod] </span></em>–<em><span style='font-family:"Calibri","sans-serif";
font-style:normal'> variabilní náklad (odvozený z&nbsp;prùmìru standardní a
pøesèasové sazby za den)</span></em></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><em><span
style='font-family:Symbol;font-style:normal'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></em><em><span style='font-family:"Calibri","sans-serif";
font-style:normal'>FC [Kè] </span></em>–<em><span style='font-family:"Calibri","sans-serif";
font-style:normal'> fixní náklad (náklad na použití)</span></em></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><em><span
style='font-family:Symbol;font-style:normal'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></em><em><span style='font-family:"Calibri","sans-serif";
font-style:normal'>L [poèet poruch/1000 hod] – pravdìpodobnost poruchy</span></em></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><em><span
style='font-family:Symbol;font-style:normal'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></em><em><span style='font-family:"Calibri","sans-serif";
font-style:normal'>T<sub>L</sub> [min] – prùmìrná doba opravy</span></em></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><em><span
style='font-family:Symbol;font-style:normal'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></em><em><span style='font-family:"Calibri","sans-serif";
font-style:normal'>C<sub>L</sub> [Kè] – prùmìrný náklad na odstranìní poruchy</span></em></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><em><span
style='font-family:Symbol;font-style:normal'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></em><em><span style='font-family:"Calibri","sans-serif";
font-style:normal'>Sp [ml/hod] – spotøeba energie (nafta)</span></em></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><em><span
style='font-family:Symbol;font-style:normal'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></em><em><span style='font-family:"Calibri","sans-serif";
font-style:normal'>CO<sub>2</sub> </span></em><em><span lang=EN-US
style='font-family:"Calibri","sans-serif";font-style:normal'>[</span></em><em><span
style='font-family:"Calibri","sans-serif";font-style:normal'>g/hod</span></em><em><span
lang=EN-US style='font-family:"Calibri","sans-serif";font-style:normal'>] </span></em><em><span
style='font-family:"Calibri","sans-serif";font-style:normal'>– produkce CO<sub>2</sub></span></em></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt'><em><span
style='font-family:"Calibri","sans-serif";font-style:normal'>&nbsp;</span></em></p>


<p class=MsoListParagraphCxSpMiddle style='text-indent:-18.0pt'>4.1<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Kendallova klasifikace systému hromadné obsluhy (X/Y/c)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>X (typ náhodného procesu popisujícího pøíchod zákazníkù k obsluze):</p>


<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'><span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M - Poissonùv proces pøíchodù (exponenciální rozdìlení doby mezi pøíchody)<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E - Erlangovo rozdìlení doby mezi pøíchody<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D - Konstatntní doba mezi pøíchody<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;G - Obecný proces pøíchodù (obecné rozdìlení doby mezi pøíchody)<br></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>Y (typ rozdìlení doby obsluhy):</p>
	
<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'><span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M - Exponenciální rozdìlení doby obsluhy<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E - Erlangovo rozdìlení doby obsluhy<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D - Konstatntní doba obsluhy<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;G - Obecný rozdìlení doby obsluhy<br></p>
<br>
<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>J - (poèet iterací metody Monte-Carlo)</p>

<br>	
<p class=MsoListParagraphCxSpMiddle style='text-indent:-18.0pt'>4.2<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Optimalizaèní
koefficienty</p>
	
<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>K<sub>1</sub> [-] – váha ekonomického hlediska (náklady)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>K<sub>2</sub> [-] – váha environmentálního hlediska (produkce CO<sub>2</sub>)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>K<sub>3</sub> [-] – váha hlediska rychlosti splnìní úkolu (doba
splnìní)</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>K<sub>4</sub> [-] – váha hlediska spolehlivosti sestav (poèet
poruch, náklady na opravu)</p>

<p class=MsoListParagraphCxSpLast style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>K<sub>5</sub> [-] – váha hlediska spotøeby energie</p>

<p class=MsoNormal>Pozn.: Souèet všech koeficientù je roven 1,0. Èím je vìtší
koeficient, tím je vìtší význam hlediska.</p>



<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt'><em><span
style='font-family:"Calibri","sans-serif";font-style:normal'>&nbsp;</span></em></p>

<p class=MsoListParagraphCxSpMiddle style='text-indent:-18.0pt'>5.<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Nahodilé
parametry</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>R<sub>1</sub> [-] – nahodilost poruch</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>R<sub>2</sub> [-] – nahodilost poèasí</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>R<sub>3</sub> [-] – nahodilost dopravních komplikací</p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>R<sub>4</sub> [-] – nahodilost havarijních stavù</p>

<p class=MsoListParagraphCxSpLast style='margin-left:72.0pt;text-indent:-18.0pt'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span>R<sub>5</sub> [-] – nahodilost lidského faktorù</p>

<p class=MsoNormal>Pozn.: Velikost koeficientu ovlivòuje produktivitu resp. výkon pracovní sestavy.
</div>

<hr>
<h2>Zpìt na <a href="optimalizace" title="Optimalizace strojiních sestav">Optimalizace strojiních sestav :</a></h2><br>
