<?php 
echo "<h1>".$mainlang[6]."</h1>";
?>
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
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
p.JStext, li.JStext, div.JStext
	{mso-style-name:JS_text;
	margin-top:3.0pt;
	margin-right:0cm;
	margin-bottom:3.0pt;
	margin-left:0cm;
	text-align:justify;
	text-indent:17.85pt;
	font-size:10.0pt;
	font-family:"Times New Roman","serif";}
p.JSPopisek, li.JSPopisek, div.JSPopisek
	{mso-style-name:JS_Popisek;
	margin-top:3.0pt;
	margin-right:0cm;
	margin-bottom:3.0pt;
	margin-left:0cm;
	text-align:center;
	font-size:10.0pt;
	font-family:"Times New Roman","serif";
	font-style:italic;}
span.TextbublinyChar
	{mso-style-name:"Text bubliny Char";
	mso-style-link:"Text bubliny";
	font-family:"Tahoma","sans-serif";}
.MsoChpDefault
	{font-family:"Calibri","sans-serif";}
.MsoPapDefault
	{margin-bottom:10.0pt;
	line-height:115%;}
-->
</style>
<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>
V projektu budou pouité následující matematické metody a teorie:</span></font></p>
<br><br><h1>Teorie hromadné obsluhy</h1><br>


<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Souèasná praxe neumoòuje stavebním podnikùm provádìt
pøi tvorbì nabídek podrobnìjší dlouhotrvající optimalizaèní propoèty. Nabídka
se zpravidla soustøedí na cenu zakázky, která musí odpovídat situaci na
stavebním trhu. Optimalizaèní kroky se proto provádìjí a po získání zakázky.
Práce bude vìnována vytvoøení technologicko-matematického modelu a nalezení
metod vedoucích k optimalizaci stavebních procesù (minimalizace pracnosti a
nákladù, spotøeba PHM, doba vıstavby, dopad na ivotní prostøedí atd.) ve speciálním
simulaèním SW.</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Teorie hromadné obsluhy neboli teorie front, se zabıvá
zkoumáním systémù s kanály obsluhy, ve kterıch dochází k procesùm tvorby front
a následné obsluze zákazníky obsluhujícími centry. Hlavním cílem teorie
hromadné obsluhy je urèení zákonitostí, dle kterıch systém funguje a následnou
tvorbu co nejpøesnìjšího matematického modelu, kterı zohledòuje rùzné
pravdìpodobnostní vlivy pùsobící na celı proces. Celı stavební proces mùeme
zkoumat jak z pohledu zákazníka, kterı èeká ve frontì a zajímá se pøedevším o
dobu èekání ve frontì, tak i z pohledu obsluhujících center. Èekající prvek se
rozhoduje, do jaké fronty se musí zaøadit nebo zda musí zcela odejit do jiného
systému. Z hlediska centra obsluhy je prioritou urèit vytíenost kanálù a pravdìpodobnost
poruchy, vèetnì èasu opravy. Centrum obsluhy by mìlo spolehlivì urèit také èas
obsluhy zákazníka, a to vzhledem k souèasnému stavebnímu úkolu. </span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Ve vısledku aplikace teorie hromadné obsluhy by mìl
matematickı model poskytnout údaje ohlednì optimálního návrhu center obsluhy a
zároveò urèit poèet zákazníkù s pøehlednutím k optimalizaèním parametrùm.
Parametry, dle kterıch budeme optimalizovat stavební proces, mohou bıt
následující: èas, poèet poruch, spotøeba pohonnıch hmot, finanèní náklady, dopad
na ivotní prostøedí atd.</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Teorie hromadné obsluhy vznikla zaèátkem 20. století.
Základy teorie poloil dánskı matematik Agner Krarup Erlang (1878-1929), kterı
zkoumal rozvoj telefonních ústøeden.</span></font></p>

<p class=JStext style='margin-top:0cm;text-indent:1.0cm'><font size=3
face="Times New Roman"><span style='font-size:12.0pt'>Dle D. G. Kendallu [6] je
moné jakıkoliv systém teorie hromadné obsluhy klasifikovat dle následujících
kombinací písmen a èíslic:</span></font></p>

<p class=JStext align=center style='margin:0cm;margin-bottom:.0001pt;
text-align:center;text-indent:0cm'><font size=2 face="Times New Roman"><span
style='font-size:10.0pt'><img width=642 height=92 id="Obrázek 3"
src="images/1/image001.jpg" alt="Popis: 1"></span></font></p>

<p class=JSPopisek style='margin-bottom:6.0pt;text-indent:1.0cm'><b><i><font
size=3 face="Times New Roman"><span style='font-size:12.0pt;font-weight:bold'>Obr.
1</span></font></i></b><font size=3><span style='font-size:12.0pt'> Klasifikace
teorie front</span></font></p>
<br>
<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>kde A – popisuje vstupní tok prvkù, B – popisuje
rozdìlení pravdìpodobnosti pro dobu obsluhy, C – popisuje poèet linek obsluhy,
D – uvádí maximální poèet prvkù systému, E – popisuje disciplínu fronty
(koneèná, nekoneèná, FIFO, LIFO atd.).</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Parametry &quot;A&quot; a &quot;B&quot;: Na místì
&quot;A&quot; a &quot;B&quot; se mohou vyskytovat symboly: </span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>• M - pro exponenciální rozdìlení</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>• D - pro konstanty (jde o deterministické intervaly)</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>• E - pro Erlangovo rozdìlení k-tého typu</span></font></p>

<p class=JStext style='margin-top:0cm;text-indent:1.0cm'><font size=3
face="Times New Roman"><span style='font-size:12.0pt'>• G - libovolné
rozdìlení.</span></font></p>

<p class=JStext style='margin-top:0cm;text-indent:1.0cm'><font size=3
face="Times New Roman"><span style='font-size:12.0pt'>Základní struktura
systému hromadné obsluhy je znázornìna na obr. 1.</span></font></p>

<p class=JStext style='margin-top:0cm;text-indent:1.0cm'><font size=2
face="Times New Roman">&nbsp;</font></p>

<p class=JStext align=center style='margin:0cm;margin-bottom:.0001pt;
text-align:center;text-indent:0cm'><font size=2 face="Times New Roman"><span
style='font-size:10.0pt'><img width=642 height=233 id="Obrázek 2"
src="images/1/image002.jpg" alt="Popis: 2"></span></font></p>

<p class=JSPopisek style='margin-bottom:6.0pt;text-indent:1.0cm'><b><i><font
size=3 face="Times New Roman"><span style='font-size:12.0pt;font-weight:bold'>Obr.
2</span></font></i></b><font size=3><span style='font-size:12.0pt'> Základní
struktura systému hromadné obsluhy</span></font></p>

<p class=JStext style='margin-top:0cm;text-indent:1.0cm'><font size=3
face="Times New Roman"><span style='font-size:12.0pt'>&nbsp;</span></font></p>

<p class=JStext style='margin-top:0cm;text-indent:1.0cm'><font size=3
face="Times New Roman"><span style='font-size:12.0pt'>Pro optimalizaci
stavebních procesù více vyhovuje uzavøenı systém, kde se zákazníci po urèité
dobì po ukonèení obsluhy vracejí zpìt do systému a øadí se opìt do fronty.
Uzavøenım procesem rozumíme situaci, kdy zdroj poadavkù je koneènı. Délka
fronty je omezená a zpracování poadavkù zákazníkù se provádí dle zpùsobu FIFO
(first in - first out). Pro maximální délku fronty platí vztah:</span></font></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0cm;margin-bottom:6.0pt;
margin-left:0cm;text-align:justify;text-indent:1.0cm'><font
size=5><span style='font-size:16.0pt;position:relative;top:3.0pt'><img
width=67 height=19 src="images/1/image004.png"></span></font>                                                                                                                                  (1)</p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Pøíkladem pouití aplikace mùe bıt optimalizace
stavebních strojù ve stavební etapì „zemní práce“, kde v roli obsluhujících
center vystupují nakladaèe nebo rypadla (poèet C) a v roli zákazníkù vstupují
do systému nákladní auta nebo dumpery (poèet D). Nadále budeme uvaovat o
systému, kde D je vìtší, ne C. Uzavøenı systém hromadné obsluhy je zobrazen na
obr. 3.</span></font></p>

<p class=JStext align=center style='margin:0cm;margin-bottom:.0001pt;
text-align:center;text-indent:0cm'><font size=2 face="Times New Roman"><span
style='font-size:10.0pt'><img width=642 height=235 id="Obrázek 1"
src="images/1/image005.jpg" alt="Popis: 3"></span></font></p>
<br>
<p class=JSPopisek style='margin-bottom:6.0pt;text-indent:1.0cm'><b><i><font
size=3 face="Times New Roman"><span style='font-size:12.0pt;font-weight:bold'>Obr.
3</span></font></i></b><font size=3><span style='font-size:12.0pt'> Uzavøenı
systém hromadné obsluhy</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>&nbsp;</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Pro kadı stavební proces mùeme urèit èasovou
jednotku dle hloubky pohledu na optimalizaèní matematickı model, napø. minuta,
hodina, smìna, tıden, mìsíc. Pro správnou funkci matematického modelu aplikace
teorie hromadné obsluhy musíme také splnit následující øadu podmínek [5]:</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>a)           vstup prvku do fronty mùe nastat v
jakémkoliv èasovém okamiku;</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>b)           poèet vstupù bìhem èasového intervalu
závisí na délce intervalu a na druhu rozloení vıkonu obsluhujícího centra
(napø. rovnomìrné, „elva“, stupòové, klesající nebo stoupající) a schéma
vıkonu obsluhujícího stroje je dáno parametry stavebního úkolu, urèují se pøed
matematickou simulaci a bìhem matematického modelování se nemìní;</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>c)           pravdìpodobnost, e v intervalu délky dT
nastane více, ne jeden vstup konverguje k nule rychleji ne délka intervalu
dT;</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>d)           prùmìrnı poèet vstupù za èasovou jednotku
je roven Lambda.</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>&nbsp;</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Pro vıpoèet charakteristik systému je tøeba pouit
následující vzorce.</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Intenzitu provozu </span></font><i><font size=4
face=Symbol><span style='font-size:14.0pt;font-family:Symbol;font-style:italic'>r</span></font></i><i><font
size=3><span style='font-size:12.0pt;font-style:italic'>,</span></font></i><font
size=3 face=Symbol><span style='font-size:12.0pt;font-family:Symbol'> </span></font><font
size=3><span style='font-size:12.0pt'>urèíme dle vzorce:</span></font></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0cm;margin-bottom:6.0pt;
margin-left:0cm;text-align:justify;text-indent:1.0cm'><font
size=5><span style='font-size:16.0pt;position:relative;top:14.0pt'><img
width=66 height=44 src="images/1/image006.png"></span></font>,                                                                                                                                 (2)</p>
<br><br>
<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>kde: P je parametr exponenciálního rozdìlení, kterı
charakterizuje dobu, strávenou prvkem mimo obsluhující systém, napø. odvoz
zeminy na skládku a návrat nákladního auta zpìt k obsluhujícímu centru</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>µ je parametr exponenciálního rozdìlení, kterı
charakterizuje dobu, strávenou prvkem bìhem obsluhy, napø. naloení zeminy
nakladaèem na nákladní auto</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>&nbsp;</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Vyjádøení pravdìpodobností funkce P<sub>k</sub> , e v
èasovém intervalu délky T vstoupí do systému <i><span style='font-style:italic'>k=1,…,C</span></i> 
prvkù:</span></font></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0cm;margin-bottom:6.0pt;
margin-left:0cm;text-align:justify;text-indent:1.0cm'><font size=5
face="Times New Roman"><span style='font-size:16.0pt;position:relative;
top:15.0pt'><img width=118 height=52 src="images/1/image007.png">,</span></font>                                                                                                                    (3)</p>
<br><br>
<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>kde P<sub>0</sub> urèíme dle vztahu:</span></font></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0cm;margin-bottom:6.0pt;
margin-left:0cm;text-align:justify;text-indent:1.0cm'><font size=5
face="Times New Roman"><span style='font-size:16.0pt;position:relative;
top:35.0pt'><img width=275 height=72 src="images/1/image008.png"></span></font>                                                                              (4)</p>
<br><br>
<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Dále mùeme snadno vypoèítat další vlastnosti systému:
</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Støední poèet zákazníkù v obsluze: </span></font></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0cm;margin-bottom:6.0pt;
margin-left:0cm;text-align:justify;text-indent:1.0cm'><font size=5
face="Times New Roman"><span style='font-size:16.0pt;position:relative;
top:14.0pt'><img width=109 height=44 src="images/1/image009.png"></span></font>                                                                                                                        (5)</p>
<br><br>
<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Støední poèet zákazníkù ve frontì:</span></font></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0cm;margin-bottom:6.0pt;
margin-left:0cm;text-align:justify;text-indent:1.0cm'><font size=5
face="Times New Roman"><span style='font-size:16.0pt;position:relative;
top:14.0pt'><img width=101 height=45 src="images/1/image010.png"></span></font>                                                                                                                          (6)</p>
<br><br>
<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Støední poèet zákazníku v systému:</span></font></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0cm;margin-bottom:6.0pt;
margin-left:0cm;text-align:justify;text-indent:1.0cm'><font size=5
face="Times New Roman"><span style='font-size:16.0pt;position:relative;
top:3.0pt'><img width=99 height=19 src="images/1/image011.png"></span></font>                                                                                                                          (7)</p>
<br><br>
<p class=JStext style='margin-top:0cm;text-indent:1.0cm'><font size=3
face="Times New Roman"><span style='font-size:12.0pt'>Snadno dokáeme odvodit a
pouít i vzorce pro vıpoèet dalších parametrù systému, a to vyuití systému,
prùmìrnou dobu èekání prvku ve frontì uvnitø i mimo systém obsluhy. Mùeme
zjišovat rùzné pravdìpodobnosti poruch prvku a èasy neèinnosti. Po zahrnutí dalších
parametrù do matematického modelu mùeme vypoèítat i jiné vlastnosti systému,
napø. nákladové charakteristiky, doby trvání stavebních procesu, dopad na
ivotní prostøedí, spotøebu pohonnıch hmot atd. Po zavedení všech zákonitostí
do matematického modelu mùeme provádìt rùzné optimalizaèní úlohy a navrhovat
optimální vıbìr strojních sestav pro urèitı stavební proces dle rùznıch
kritérií.</span></font></p>
<br><br><h1>Metoda Monte Carlo</h1><br>
<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>Monte Carlo je tøída algoritmù pro simulaci systémù. Jde o
stochastické metody pouívající pseudonáhodná èísla. Typicky vyuívány pro
vıpoèet integrálù, zejména vícerozmìrnıch, kde bìné metody nejsou efektivní.
Metoda Monte Carlo má široké vyuití od simulaci experimentù pøes poèítání
urèitıch integrálù a tøeba øešení diferenciálních rovnic. Základní myšlenka
této metody je velice jednoduchá, chceme urèit støední hodnotu velièiny, která
je vısledkem náhodného dìje. Vytvoøí se poèítaèovı model toho dìje a po
probìhnutí dostateèného mnoství simulací se mohou data zpracovat klasickımi
statistickımi metodami, tøeba urèit prùmìr a smìrodatnou odchylku [23].</span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>Metoda Monte Carlo byla formulována ji ve 40. letech 20.
století a svého vyuití se doèkala ještì v prùbìhu druhé svìtové války. Jejím
zakladatelem byl Stanislaw Marcin Ulam a John von Neumann, kteøí v té dobì
pracovali v americké Národní laboratoøi Los Alamos, kde zkoumali chování
neutronù, pøedevším je zajímalo, jaké mnoství neutronù projde rùznımi
materiály (napø. nádrí vody) [24].</span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>Pøesnost a efektivnost celého vıpoètu metodou Monte Carlo
pomocí vıpoèetní techniky je dána tìmito faktory [24]:</span></font></p>

<p class=MsoListParagraphCxSpFirst style='margin-left:2.0cm;text-align:justify;
text-indent:-21.25pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* kvalitou generátoru náhodnıch èísel, resp. pseudonáhodnıch èísel</span></font></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:2.0cm;text-align:justify;
text-indent:-21.25pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* vıbìrem racionálního algoritmu vıpoètu</span></font></p>

<p class=MsoListParagraphCxSpLast style='margin-left:2.0cm;text-align:justify;
text-indent:-21.25pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* kontrolou pøesnosti získaného vısledku</span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>Metoda MC zahrnuje:</span></font></p>

<p class=MsoListParagraphCxSpFirst style='margin-left:2.0cm;text-align:justify;
text-indent:-21.25pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* vytvoøení modelu skuteèného systému, se stejnımi pravdìpodobnostními charakteristikami jako má reálnı systém (vliv náhody - náhodná èísla)</span></font></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:2.0cm;text-align:justify;
text-indent:-21.25pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* model musí zahrnovat veškeré relevantní skuteènosti, podstatnì ovlivòující reálnı systém</span></font></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:2.0cm;text-align:justify;
text-indent:-21.25pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* experimentování s modelem, mnohanásobné zkoumání chování modelu</span></font></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:78.55pt;text-align:justify;
text-indent:-18.0pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>&nbsp;&nbsp;* s pevnım èasovım krokem – sledujeme chování systému
po urèitıch konstantních èasovıch intervalech a zjišujeme, zda došlo ke
zmìnám)</span></font></p>

<p class=MsoListParagraphCxSpLast style='margin-left:78.55pt;text-align:justify;
text-indent:-18.0pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>&nbsp;&nbsp;* s promìnnım èasovım krokem – generujeme interval,
po kterı v systému nedojde k ádnım zmìnám</span></font></p>

<p class=MsoNormal align=center style='text-align:center;text-indent:42.55pt;
line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:
12.0pt;line-height:150%'><img width=460 height=426 id="Obrázek 1"
src="images/5/image001.jpg"></span></font></p>

<p class=MsoNormal align=center style='text-align:center;text-indent:42.55pt;
line-height:150%'><i><font size=3 face="Times New Roman"><span
style='font-size:12.0pt;line-height:150%;font-style:italic'>Obr.: 3 Schéma
metody Monte Carlo Schéma postupu metody Monte Carlo</span></font></i></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>Øešení problému metodou Monte Carlo mùeme rozdìlit do tøí
krokù [23]:</span></font></p>

<p class=MsoListParagraphCxSpFirst style='margin-left:2.0cm;text-align:justify;
text-indent:-43.1pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* Rozbor problému a návrh modelu - z hlediska øešení
problému se jedná o nejdùleitìjší krok. I kdy je MMC pouitelná prakticky u
všech problémù a její formulace není sloitá, nalezení vhodného postupu mùe
nezkušenému øešiteli dìlat problémy.</span></font></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:2.0cm;text-align:justify;
text-indent:-43.1pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* Generování náhodnıch velièin, jejich transformace
na velièiny s danım pravdìpodobnostním rozdìlením. Rychlost konvergence chyby
vısledku k nulové hodnotì je u MMC rovna pøiblinì pøevrácené hodnotì odmocniny
z poètu realizovanıch pokusù N, z èeho plyne, e nepatøí mezi metody
nejefektivnìjší.</span></font></p>

<p class=MsoListParagraphCxSpLast style='margin-left:2.0cm;text-align:justify;
text-indent:-43.1pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* Statistické zpracování vısledkù - hledaná hodnota
je zpravidla dána nìkterım z momentù statistickıch velièin, nejèastìji støední
hodnotou.</span></font></p>

<p class=MsoNormal><font size=3 face="Times New Roman"><span style='font-size:
12.0pt'>&nbsp;</span></font></p>

<br>
<br><h1>Nákladová funkce</h2><b1>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>Teï se
zamìøíme na popis nákladové funkce, kterou budeme optimalizovat. </span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>Funkce
celkovıch nákladù [Kè]:  </span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='margin-left:35.45pt;text-align:justify;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>TC =  FCL +  FCK                                                                                       (3)</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>Náklady
na vırobní faktor [Kè/stroj resp. èeta]: </span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>FCL = FC + VC                                                                                           (4)</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>kde </span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>            FC
- fixní náklady [Kè/vırobní faktor];</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>            VC
- variabilní náklady [Kè/ vırobní faktor/jednotka èasu]</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>Náklady
na faktor kapitálu [Kè/jednotka èasu]: </span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>FCK = KC + RC + RE                                                                                (5)</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>kde  </span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>            KC
- náklady na kapitál (úvìry) [Kè/jednotka èasu];</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>            RC
- </span></font>Reie (úèetnictví, pronájem st. bunìk atd.) vztaené na celou
stavbu [Kè/jednotka èasu];</p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>            </span>RE
- </font>Reie (úèetnictví, pronájem st. bunìk atd.) vztaené na stavební etapu
[Kè/jednotka èasu].</p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>Náklady
na vırobní faktor:</span></font></p>

<p class=MsoNormal style='margin-left:35.45pt;text-align:justify;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'> </span><span style='position:relative;top:10.0pt'><img
width=246 height=43 src="images/6/image001.png"></span>                                                       (6)</font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>kde </span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>            t
- èasová jednotka (den; smìna; hodina);</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>            n
- poèet dílèích stavebních procesù na kritické cestì SE;</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>            N
- poèet vırobních faktorù, obsazenıch v i-stavebním procesu.</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>Náklady
na faktor kapitálu: </span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-indent:35.45pt;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%;
position:relative;top:.5pt'><img width=210 height=25
src="images/6/image002.png"></span>                                                                  (7)</font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>            Náš
matematickı problém má jedno urèité omezení. Skuteèné sestavy vırobních faktorù
mohou bıt jenom celoèíselné. Doba procesu také mue bıt jenom celoèíselná
(zaokrouhlena nahoru do nejmenší diskrétní èasové jednotky, kterou pouíváme ve
vıpoètu). Nemùeme nechat pracovat stroj 10,1 dnù. Budeme muset zaplatit strojní
sestavu na 11 dnù, co nebude optimální øešení. Pokud udìláme jednoduché
zaokrouhlení nahoru, ztratíme optimální øešení a dostaneme se mimo optimální
køivku minimálních nákladù. Kadopádnì øešení i po zaokrouhlení bude lepší a
urèenìjší, ne øešení zaloené na intuitivním odhadu.</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>            Problém
diskrétního øešení se dá vyøešit s urèitou chybou, zpùsobem úpravy vısledkù.
Poèet strojù/èet se zaokrouhlí na nejbliší celé èíslo. Doba trvání procesù
zùstane neceloèíselná, ale provede se úprava poètu strojù/èet a pracovního
reimu. Existuje monost nechat pracovat jeden resp. více strojù/èet s
pøesèasem, co umoní zkrátit zbytek diskrétní èasové jednotky (vyaduje
doplòkové náklady na pøesèas a zkrácení vıkonu).</span></font></p>

<p class=MsoNormal><font size=3 face="Times New Roman"><span style='font-size:
12.0pt'>&nbsp;</span></font></p>