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
V projektu budou pou�it� n�sleduj�c� matematick� metody a teorie:</span></font></p>
<br><br><h1>Teorie hromadn� obsluhy</h1><br>


<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Sou�asn� praxe neumo��uje stavebn�m podnik�m prov�d�t
p�i tvorb� nab�dek podrobn�j�� dlouhotrvaj�c� optimaliza�n� propo�ty. Nab�dka
se zpravidla soust�ed� na cenu zak�zky, kter� mus� odpov�dat situaci na
stavebn�m trhu. Optimaliza�n� kroky se proto prov�d�j� a� po z�sk�n� zak�zky.
Pr�ce bude v�nov�na vytvo�en� technologicko-matematick�ho modelu a nalezen�
metod vedouc�ch k optimalizaci stavebn�ch proces� (minimalizace pracnosti a
n�klad�, spot�eba PHM, doba v�stavby, dopad na �ivotn� prost�ed� atd.) ve speci�ln�m
simula�n�m SW.</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Teorie hromadn� obsluhy neboli teorie front, se zab�v�
zkoum�n�m syst�m� s kan�ly obsluhy, ve kter�ch doch�z� k proces�m tvorby front
a n�sledn� obsluze z�kazn�ky obsluhuj�c�mi centry. Hlavn�m c�lem teorie
hromadn� obsluhy je ur�en� z�konitost�, dle kter�ch syst�m funguje a n�slednou
tvorbu co nejp�esn�j��ho matematick�ho modelu, kter� zohled�uje r�zn�
pravd�podobnostn� vlivy p�sob�c� na cel� proces. Cel� stavebn� proces m��eme
zkoumat jak z pohledu z�kazn�ka, kter� �ek� ve front� a zaj�m� se p�edev��m o
dobu �ek�n� ve front�, tak i z pohledu obsluhuj�c�ch center. �ekaj�c� prvek se
rozhoduje, do jak� fronty se mus� za�adit nebo zda mus� zcela odejit do jin�ho
syst�mu. Z hlediska centra obsluhy je prioritou ur�it vyt�enost kan�l� a pravd�podobnost
poruchy, v�etn� �asu opravy. Centrum obsluhy by m�lo spolehliv� ur�it tak� �as
obsluhy z�kazn�ka, a to vzhledem k sou�asn�mu stavebn�mu �kolu. </span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Ve v�sledku aplikace teorie hromadn� obsluhy by m�l
matematick� model poskytnout �daje ohledn� optim�ln�ho n�vrhu center obsluhy a
z�rove� ur�it po�et z�kazn�k� s p�ehlednut�m k optimaliza�n�m parametr�m.
Parametry, dle kter�ch budeme optimalizovat stavebn� proces, mohou b�t
n�sleduj�c�: �as, po�et poruch, spot�eba pohonn�ch hmot, finan�n� n�klady, dopad
na �ivotn� prost�ed� atd.</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Teorie hromadn� obsluhy vznikla za��tkem 20. stolet�.
Z�klady teorie polo�il d�nsk� matematik Agner Krarup Erlang (1878-1929), kter�
zkoumal rozvoj telefonn�ch �st�eden.</span></font></p>

<p class=JStext style='margin-top:0cm;text-indent:1.0cm'><font size=3
face="Times New Roman"><span style='font-size:12.0pt'>Dle D. G. Kendallu [6] je
mo�n� jak�koliv syst�m teorie hromadn� obsluhy klasifikovat dle n�sleduj�c�ch
kombinac� p�smen a ��slic:</span></font></p>

<p class=JStext align=center style='margin:0cm;margin-bottom:.0001pt;
text-align:center;text-indent:0cm'><font size=2 face="Times New Roman"><span
style='font-size:10.0pt'><img width=642 height=92 id="Obr�zek 3"
src="images/1/image001.jpg" alt="Popis: 1"></span></font></p>

<p class=JSPopisek style='margin-bottom:6.0pt;text-indent:1.0cm'><b><i><font
size=3 face="Times New Roman"><span style='font-size:12.0pt;font-weight:bold'>Obr.
1</span></font></i></b><font size=3><span style='font-size:12.0pt'> Klasifikace
teorie front</span></font></p>
<br>
<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>kde A � popisuje vstupn� tok prvk�, B � popisuje
rozd�len� pravd�podobnosti pro dobu obsluhy, C � popisuje po�et linek obsluhy,
D � uv�d� maxim�ln� po�et prvk� syst�mu, E � popisuje discipl�nu fronty
(kone�n�, nekone�n�, FIFO, LIFO atd.).</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Parametry &quot;A&quot; a &quot;B&quot;: Na m�st�
&quot;A&quot; a &quot;B&quot; se mohou vyskytovat symboly: </span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>� M - pro exponenci�ln� rozd�len�</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>� D - pro konstanty (jde o deterministick� intervaly)</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>� E - pro Erlangovo rozd�len� k-t�ho typu</span></font></p>

<p class=JStext style='margin-top:0cm;text-indent:1.0cm'><font size=3
face="Times New Roman"><span style='font-size:12.0pt'>� G - libovoln�
rozd�len�.</span></font></p>

<p class=JStext style='margin-top:0cm;text-indent:1.0cm'><font size=3
face="Times New Roman"><span style='font-size:12.0pt'>Z�kladn� struktura
syst�mu hromadn� obsluhy je zn�zorn�na na obr. 1.</span></font></p>

<p class=JStext style='margin-top:0cm;text-indent:1.0cm'><font size=2
face="Times New Roman">&nbsp;</font></p>

<p class=JStext align=center style='margin:0cm;margin-bottom:.0001pt;
text-align:center;text-indent:0cm'><font size=2 face="Times New Roman"><span
style='font-size:10.0pt'><img width=642 height=233 id="Obr�zek 2"
src="images/1/image002.jpg" alt="Popis: 2"></span></font></p>

<p class=JSPopisek style='margin-bottom:6.0pt;text-indent:1.0cm'><b><i><font
size=3 face="Times New Roman"><span style='font-size:12.0pt;font-weight:bold'>Obr.
2</span></font></i></b><font size=3><span style='font-size:12.0pt'> Z�kladn�
struktura syst�mu hromadn� obsluhy</span></font></p>

<p class=JStext style='margin-top:0cm;text-indent:1.0cm'><font size=3
face="Times New Roman"><span style='font-size:12.0pt'>&nbsp;</span></font></p>

<p class=JStext style='margin-top:0cm;text-indent:1.0cm'><font size=3
face="Times New Roman"><span style='font-size:12.0pt'>Pro optimalizaci
stavebn�ch proces� v�ce vyhovuje uzav�en� syst�m, kde se z�kazn�ci po ur�it�
dob� po ukon�en� obsluhy vracej� zp�t do syst�mu a �ad� se op�t do fronty.
Uzav�en�m procesem rozum�me situaci, kdy zdroj po�adavk� je kone�n�. D�lka
fronty je omezen� a zpracov�n� po�adavk� z�kazn�k� se prov�d� dle zp�sobu FIFO
(first in - first out). Pro maxim�ln� d�lku fronty plat� vztah:</span></font></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0cm;margin-bottom:6.0pt;
margin-left:0cm;text-align:justify;text-indent:1.0cm'><font
size=5><span style='font-size:16.0pt;position:relative;top:3.0pt'><img
width=67 height=19 src="images/1/image004.png"></span></font>��������������������������������������������������������������������������������������������������������������������������������� (1)</p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>P��kladem pou�it� aplikace m��e b�t optimalizace
stavebn�ch stroj� ve stavebn� etap� �zemn� pr�ce�, kde v roli obsluhuj�c�ch
center vystupuj� naklada�e nebo rypadla (po�et C) a v roli z�kazn�k� vstupuj�
do syst�mu n�kladn� auta nebo dumpery (po�et D). Nad�le budeme uva�ovat o
syst�mu, kde D je v�t��, ne� C. Uzav�en� syst�m hromadn� obsluhy je zobrazen na
obr. 3.</span></font></p>

<p class=JStext align=center style='margin:0cm;margin-bottom:.0001pt;
text-align:center;text-indent:0cm'><font size=2 face="Times New Roman"><span
style='font-size:10.0pt'><img width=642 height=235 id="Obr�zek 1"
src="images/1/image005.jpg" alt="Popis: 3"></span></font></p>
<br>
<p class=JSPopisek style='margin-bottom:6.0pt;text-indent:1.0cm'><b><i><font
size=3 face="Times New Roman"><span style='font-size:12.0pt;font-weight:bold'>Obr.
3</span></font></i></b><font size=3><span style='font-size:12.0pt'> Uzav�en�
syst�m hromadn� obsluhy</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>&nbsp;</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Pro ka�d� stavebn� proces m��eme ur�it �asovou
jednotku dle hloubky pohledu na optimaliza�n� matematick� model, nap�. minuta,
hodina, sm�na, t�den, m�s�c. Pro spr�vnou funkci matematick�ho modelu aplikace
teorie hromadn� obsluhy mus�me tak� splnit n�sleduj�c� �adu podm�nek [5]:</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>a)���������� vstup prvku do fronty m��e nastat v
jak�mkoliv �asov�m okam�iku;</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>b)���������� po�et vstup� b�hem �asov�ho intervalu
z�vis� na d�lce intervalu a na druhu rozlo�en� v�konu obsluhuj�c�ho centra
(nap�. rovnom�rn�, ��elva�, stup�ov�, klesaj�c� nebo stoupaj�c�) a sch�ma
v�konu obsluhuj�c�ho stroje je d�no parametry stavebn�ho �kolu, ur�uj� se p�ed
matematickou simulaci a b�hem matematick�ho modelov�n� se nem�n�;</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>c)���������� pravd�podobnost, �e v intervalu d�lky dT
nastane v�ce, ne� jeden vstup konverguje k nule rychleji ne� d�lka intervalu
dT;</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>d)���������� pr�m�rn� po�et vstup� za �asovou jednotku
je roven Lambda.</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>&nbsp;</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Pro v�po�et charakteristik syst�mu je t�eba pou�it
n�sleduj�c� vzorce.</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Intenzitu provozu </span></font><i><font size=4
face=Symbol><span style='font-size:14.0pt;font-family:Symbol;font-style:italic'>r</span></font></i><i><font
size=3><span style='font-size:12.0pt;font-style:italic'>,</span></font></i><font
size=3 face=Symbol><span style='font-size:12.0pt;font-family:Symbol'> </span></font><font
size=3><span style='font-size:12.0pt'>ur��me dle vzorce:</span></font></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0cm;margin-bottom:6.0pt;
margin-left:0cm;text-align:justify;text-indent:1.0cm'><font
size=5><span style='font-size:16.0pt;position:relative;top:14.0pt'><img
width=66 height=44 src="images/1/image006.png"></span></font>,�������������������������������������������������������������������������������������������������������������������������������� (2)</p>
<br><br>
<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>kde: P je parametr exponenci�ln�ho rozd�len�, kter�
charakterizuje dobu, str�venou prvkem mimo obsluhuj�c� syst�m, nap�. odvoz
zeminy na skl�dku a n�vrat n�kladn�ho auta zp�t k obsluhuj�c�mu centru</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>� je parametr exponenci�ln�ho rozd�len�, kter�
charakterizuje dobu, str�venou prvkem b�hem obsluhy, nap�. nalo�en� zeminy
naklada�em na n�kladn� auto</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>&nbsp;</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>Vyj�d�en� pravd�podobnost� funkce P<sub>k</sub> , �e v
�asov�m intervalu d�lky T vstoup� do syst�mu <i><span style='font-style:italic'>k=1,�,C</span></i>�
prvk�:</span></font></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0cm;margin-bottom:6.0pt;
margin-left:0cm;text-align:justify;text-indent:1.0cm'><font size=5
face="Times New Roman"><span style='font-size:16.0pt;position:relative;
top:15.0pt'><img width=118 height=52 src="images/1/image007.png">,</span></font>������������������������������������������������������������������������������������������������������������������� (3)</p>
<br><br>
<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>kde P<sub>0</sub> ur��me dle vztahu:</span></font></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0cm;margin-bottom:6.0pt;
margin-left:0cm;text-align:justify;text-indent:1.0cm'><font size=5
face="Times New Roman"><span style='font-size:16.0pt;position:relative;
top:35.0pt'><img width=275 height=72 src="images/1/image008.png"></span></font>����������������������������������������������������������������������������� (4)</p>
<br><br>
<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>D�le m��eme snadno vypo��tat dal�� vlastnosti syst�mu:
</span></font></p>

<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>St�edn� po�et z�kazn�k� v obsluze: </span></font></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0cm;margin-bottom:6.0pt;
margin-left:0cm;text-align:justify;text-indent:1.0cm'><font size=5
face="Times New Roman"><span style='font-size:16.0pt;position:relative;
top:14.0pt'><img width=109 height=44 src="images/1/image009.png"></span></font>����������������������������������������������������������������������������������������������������������������������� (5)</p>
<br><br>
<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>St�edn� po�et z�kazn�k� ve front�:</span></font></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0cm;margin-bottom:6.0pt;
margin-left:0cm;text-align:justify;text-indent:1.0cm'><font size=5
face="Times New Roman"><span style='font-size:16.0pt;position:relative;
top:14.0pt'><img width=101 height=45 src="images/1/image010.png"></span></font>������������������������������������������������������������������������������������������������������������������������� (6)</p>
<br><br>
<p class=JStext style='text-indent:1.0cm'><font size=3 face="Times New Roman"><span
style='font-size:12.0pt'>St�edn� po�et z�kazn�ku v syst�mu:</span></font></p>

<p class=MsoNormal style='margin-top:6.0pt;margin-right:0cm;margin-bottom:6.0pt;
margin-left:0cm;text-align:justify;text-indent:1.0cm'><font size=5
face="Times New Roman"><span style='font-size:16.0pt;position:relative;
top:3.0pt'><img width=99 height=19 src="images/1/image011.png"></span></font>������������������������������������������������������������������������������������������������������������������������� (7)</p>
<br><br>
<p class=JStext style='margin-top:0cm;text-indent:1.0cm'><font size=3
face="Times New Roman"><span style='font-size:12.0pt'>Snadno dok�eme odvodit a
pou��t i vzorce pro v�po�et dal��ch parametr� syst�mu, a to vyu�it� syst�mu,
pr�m�rnou dobu �ek�n� prvku ve front� uvnit� i mimo syst�m obsluhy. M��eme
zji��ovat r�zn� pravd�podobnosti poruch prvku a �asy ne�innosti. Po zahrnut� dal��ch
parametr� do matematick�ho modelu m��eme vypo��tat i jin� vlastnosti syst�mu,
nap�. n�kladov� charakteristiky, doby trv�n� stavebn�ch procesu, dopad na
�ivotn� prost�ed�, spot�ebu pohonn�ch hmot atd. Po zaveden� v�ech z�konitost�
do matematick�ho modelu m��eme prov�d�t r�zn� optimaliza�n� �lohy a navrhovat
optim�ln� v�b�r strojn�ch sestav pro ur�it� stavebn� proces dle r�zn�ch
krit�ri�.</span></font></p>
<br><br><h1>Metoda Monte Carlo</h1><br>
<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>Monte Carlo je t��da algoritm� pro simulaci syst�m�. Jde o
stochastick� metody pou��vaj�c� pseudon�hodn� ��sla. Typicky vyu��v�ny pro
v�po�et integr�l�, zejm�na v�cerozm�rn�ch, kde b�n� metody nejsou efektivn�.
Metoda Monte Carlo m� �irok� vyu�it� od simulaci experiment� p�es po��t�n�
ur�it�ch integr�l� a� t�eba �e�en� diferenci�ln�ch rovnic. Z�kladn� my�lenka
t�to metody je velice jednoduch�, chceme ur�it st�edn� hodnotu veli�iny, kter�
je v�sledkem n�hodn�ho d�je. Vytvo�� se po��ta�ov� model toho d�je a po
prob�hnut� dostate�n�ho mno�stv� simulac� se mohou data zpracovat klasick�mi
statistick�mi metodami, t�eba ur�it pr�m�r a sm�rodatnou odchylku [23].</span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>Metoda Monte Carlo byla formulov�na ji� ve 40. letech 20.
stolet� a sv�ho vyu�it� se do�kala je�t� v pr�b�hu druh� sv�tov� v�lky. Jej�m
zakladatelem byl Stanislaw Marcin Ulam a John von Neumann, kte�� v t� dob�
pracovali v americk� N�rodn� laborato�i Los Alamos, kde zkoumali chov�n�
neutron�, p�edev��m je zaj�malo, jak� mno�stv� neutron� projde r�zn�mi
materi�ly (nap�. n�dr�� vody) [24].</span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>P�esnost a efektivnost cel�ho v�po�tu metodou Monte Carlo
pomoc� v�po�etn� techniky je d�na t�mito faktory [24]:</span></font></p>

<p class=MsoListParagraphCxSpFirst style='margin-left:2.0cm;text-align:justify;
text-indent:-21.25pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* kvalitou gener�toru n�hodn�ch ��sel, resp. pseudon�hodn�ch ��sel</span></font></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:2.0cm;text-align:justify;
text-indent:-21.25pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* v�b�rem racion�ln�ho algoritmu v�po�tu</span></font></p>

<p class=MsoListParagraphCxSpLast style='margin-left:2.0cm;text-align:justify;
text-indent:-21.25pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* kontrolou p�esnosti z�skan�ho v�sledku</span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>Metoda MC zahrnuje:</span></font></p>

<p class=MsoListParagraphCxSpFirst style='margin-left:2.0cm;text-align:justify;
text-indent:-21.25pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* vytvo�en� modelu skute�n�ho syst�mu, se stejn�mi pravd�podobnostn�mi charakteristikami jako m� re�ln� syst�m (vliv n�hody - n�hodn� ��sla)</span></font></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:2.0cm;text-align:justify;
text-indent:-21.25pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* model mus� zahrnovat ve�ker� relevantn� skute�nosti, podstatn� ovliv�uj�c� re�ln� syst�m</span></font></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:2.0cm;text-align:justify;
text-indent:-21.25pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* experimentov�n� s modelem, mnohan�sobn� zkoum�n� chov�n� modelu</span></font></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:78.55pt;text-align:justify;
text-indent:-18.0pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>&nbsp;&nbsp;* s pevn�m �asov�m krokem � sledujeme chov�n� syst�mu
po ur�it�ch konstantn�ch �asov�ch intervalech a zji��ujeme, zda do�lo ke
zm�n�m)</span></font></p>

<p class=MsoListParagraphCxSpLast style='margin-left:78.55pt;text-align:justify;
text-indent:-18.0pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>&nbsp;&nbsp;* s prom�nn�m �asov�m krokem � generujeme interval,
po kter� v syst�mu nedojde k ��dn�m zm�n�m</span></font></p>

<p class=MsoNormal align=center style='text-align:center;text-indent:42.55pt;
line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:
12.0pt;line-height:150%'><img width=460 height=426 id="Obr�zek 1"
src="images/5/image001.jpg"></span></font></p>

<p class=MsoNormal align=center style='text-align:center;text-indent:42.55pt;
line-height:150%'><i><font size=3 face="Times New Roman"><span
style='font-size:12.0pt;line-height:150%;font-style:italic'>Obr.: 3 Sch�ma
metody Monte Carlo Sch�ma postupu metody Monte Carlo</span></font></i></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:42.55pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>�e�en� probl�mu metodou Monte Carlo m��eme rozd�lit do t��
krok� [23]:</span></font></p>

<p class=MsoListParagraphCxSpFirst style='margin-left:2.0cm;text-align:justify;
text-indent:-43.1pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* Rozbor probl�mu a n�vrh modelu - z hlediska �e�en�
probl�mu se jedn� o nejd�le�it�j�� krok. I kdy� je MMC pou�iteln� prakticky u
v�ech probl�m� a jej� formulace nen� slo�it�, nalezen� vhodn�ho postupu m��e
nezku�en�mu �e�iteli d�lat probl�my.</span></font></p>

<p class=MsoListParagraphCxSpMiddle style='margin-left:2.0cm;text-align:justify;
text-indent:-43.1pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* Generov�n� n�hodn�ch veli�in, jejich transformace
na veli�iny s dan�m pravd�podobnostn�m rozd�len�m. Rychlost konvergence chyby
v�sledku k nulov� hodnot� je u MMC rovna p�ibli�n� p�evr�cen� hodnot� odmocniny
z po�tu realizovan�ch pokus� N, z �eho� plyne, �e nepat�� mezi metody
nejefektivn�j��.</span></font></p>

<p class=MsoListParagraphCxSpLast style='margin-left:2.0cm;text-align:justify;
text-indent:-43.1pt;line-height:150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>* Statistick� zpracov�n� v�sledk� - hledan� hodnota
je zpravidla d�na n�kter�m z moment� statistick�ch veli�in, nej�ast�ji st�edn�
hodnotou.</span></font></p>

<p class=MsoNormal><font size=3 face="Times New Roman"><span style='font-size:
12.0pt'>&nbsp;</span></font></p>

<br>
<br><h1>N�kladov� funkce</h2><b1>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>Te� se
zam���me na popis n�kladov� funkce, kterou budeme optimalizovat. </span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>Funkce
celkov�ch n�klad� [K�]:� </span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='margin-left:35.45pt;text-align:justify;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>TC =� FCL +� FCK�������������������������������������������������������������������������������������� (3)</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>N�klady
na v�robn� faktor [K�/stroj resp. �eta]: </span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>FCL = FC + VC������������������������������������������������������������������������������������������ (4)</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>kde </span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>����������� FC
- fixn� n�klady [K�/v�robn� faktor];</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>����������� VC
- variabiln� n�klady [K�/ v�robn� faktor/jednotka �asu]</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>N�klady
na faktor kapit�lu [K�/jednotka �asu]: </span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>FCK = KC + RC + RE������������������������������������������������������������������������������� (5)</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>kde� </span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>����������� KC
- n�klady na kapit�l (�v�ry) [K�/jednotka �asu];</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>����������� RC
- </span></font>Re�ie (��etnictv�, pron�jem st. bun�k atd.) vzta�en� na celou
stavbu [K�/jednotka �asu];</p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>����������� </span>RE
- </font>Re�ie (��etnictv�, pron�jem st. bun�k atd.) vzta�en� na stavebn� etapu
[K�/jednotka �asu].</p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>N�klady
na v�robn� faktor:</span></font></p>

<p class=MsoNormal style='margin-left:35.45pt;text-align:justify;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>�</span><span style='position:relative;top:10.0pt'><img
width=246 height=43 src="images/6/image001.png"></span>������������������� ���������������������������������� (6)</font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>kde </span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>����������� t
- �asov� jednotka (den; sm�na; hodina);</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>����������� n
- po�et d�l��ch stavebn�ch proces� na kritick� cest� SE;</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>����������� N
- po�et v�robn�ch faktor�, obsazen�ch v i-stavebn�m procesu.</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>N�klady
na faktor kapit�lu: </span></font></p>

<p class=MsoNormal style='text-align:justify;text-indent:35.45pt;line-height:
150%'><font size=3 face="Times New Roman"><span style='font-size:12.0pt;
line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-indent:35.45pt;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%;
position:relative;top:.5pt'><img width=210 height=25
src="images/6/image002.png"></span>����� ����������������������� ����������� ����������� ����������� (7)</font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>&nbsp;</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>����������� N�
matematick� probl�m m� jedno ur�it� omezen�. Skute�n� sestavy v�robn�ch faktor�
mohou b�t jenom celo��seln�. Doba procesu tak� mu�e b�t jenom celo��seln�
(zaokrouhlena nahoru do nejmen�� diskr�tn� �asov� jednotky, kterou pou��v�me ve
v�po�tu). Nem��eme nechat pracovat stroj 10,1 dn�. Budeme muset zaplatit strojn�
sestavu na 11 dn�, co� nebude optim�ln� �e�en�. Pokud ud�l�me jednoduch�
zaokrouhlen� nahoru, ztrat�me optim�ln� �e�en� a dostaneme se mimo optim�ln�
k�ivku minim�ln�ch n�klad�. Ka�dop�dn� �e�en� i po zaokrouhlen� bude lep�� a
ur�en�j��, ne� �e�en� zalo�en� na intuitivn�m odhadu.</span></font></p>

<p class=MsoNormal style='text-align:justify;line-height:150%'><font size=3
face="Times New Roman"><span style='font-size:12.0pt;line-height:150%'>����������� Probl�m
diskr�tn�ho �e�en� se d� vy�e�it s ur�itou chybou, zp�sobem �pravy v�sledk�.
Po�et stroj�/�et se zaokrouhl� na nejbli��� cel� ��slo. Doba trv�n� proces�
z�stane necelo��seln�, ale provede se �prava po�tu stroj�/�et a pracovn�ho
re�imu. Existuje mo�nost nechat pracovat jeden resp. v�ce stroj�/�et s
p�es�asem, co� umo�n� zkr�tit zbytek diskr�tn� �asov� jednotky (vy�aduje
dopl�kov� n�klady na p�es�as a zkr�cen� v�konu).</span></font></p>

<p class=MsoNormal><font size=3 face="Times New Roman"><span style='font-size:
12.0pt'>&nbsp;</span></font></p>