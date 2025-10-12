<?php 






$celkem=mysql_result(mysql_query("SELECT count(*) FROM optimalizace_katalog_stroju",$connect2),0);
echo "<h1>".$titl." (".$celkem.")</h1>";
$sid=kontrolah($_GET['sid']);
$m=kontrolah($_GET['m']);
$mm=kontrolah($_GET['mm']);
if ($mm){

$cennik="725 	398950
730	454940
735	545280
740	604480
416	80550
420	87410
430	98500
450	150570
301	32370
301	35700
302	40610
303	45770
303	48080
304	52410
305	60930
305	69430
307	105150
308	112150
308	116860
311	122510
314	147260
315 	157430
319  	159650
320 	226800
320  	175540
321  	169720
324  	231210
324 	295530
328 	256360
329 	233330
330 UHD  	386230
345 UHD  	640740
365 UHD  	666360
385 UHD  	854530
336 	267880
345 	408550
349 	433040
365 	619630
374 	680370
385 	752700
390 	875150
M313 	174990
M315 	198830
M316 	213860
M318 	228980
M322 	263110
120M 	291100
12M 	319740
12M 	319740
140 	333290
247  	43470
257  	48560
277 	62830
287 	64900
297 	74000
259  	51360
279 	70310
289 	73640
299 	76020
770 	583720
772 	682340
773 	791790
775 	909320
AP500 	232390
AP600 	250660
AP1000 	278160
BG260 	278160
AP555 	259990
AP655 	284410
AP1055 	325650
BG2455 	325650
CB14 	29200
CB22 	35430
CB24 	43470
CB32 	47390
CB34 	58530
CB54 	152470
CB64 	203780
CB434 	127000
CC24 	44600
CC34 	59610
CP56 	193270
CP64 	187230
CP76 	230940
CP323 	96180
CP433 	135100
CS54 	135440
CS56 	159090
CS64 	181330
CS74 	211830
CS76 	224040
CS323 	84130
CS423 	112470
CS433 	119750
PM102 	331730
PM200 	599560
PM201 	686830
PS150C 	86060
PS360C 	161180
RM300 	309900
RM500 	489380
216  	30370
226  	32290
236  	35830
242  	36720
246 	39560
252  	40710
256 	43420
262 	40380
272 	52980
272  	71070
939  	113830
953 	222630
963 	287280
973 	399590
D3K 	94210
D4K 	123130
D5K 	140410
D6K 	182540
D6N 	289980
D6T 	358410
D7E 	569920
D7R  	457920
D8T 	674440
D9T 	805970
904 	55450
906 	77000
907 	81140
908 	90250
914 	110950
IT14 	122130
924 	130390
924 	145520
928 	148240
930 	171320
938 	181550
950 	229900
962 	244110
966 	348650
972 	367210
980 	472610
IT38 	215680
IT62 	263740
988 	793420
990 	1285690
992 	1751320
621 	392520
623 	444400
627 	411960
631 	583740
637 	612250
657 	885490";


	$cennik_t=split("\n",$cennik);
	for ($i=0;$i<count($cennik_t);$i++){
		//echo $cennik_t."<br>";
		$cennik_tt=split("\t",$cennik_t[$i]);
		$poisk=trim($cennik_tt[0]);
		$getclanek = mysql_query("SELECT * FROM optimalizace_katalog_stroju where typ like '%".$poisk."%' and cena_stroje_USD='0'",$connect2);
		while ($clanky = mysql_fetch_array($getclanek)){
				$id_s=$clanky['id'];
				mysql_query("update optimalizace_katalog_stroju set cena_stroje_USD='".trim($cennik_tt[1])."',cena_stroje='".round(trim($cennik_tt[1])*19.23)."' where id='$id_s'",$connect2);
				echo $clanky['typ']."/".$cennik_tt[0]." - update optimalizace_katalog_stroju set cena_stroje_USD='".trim($cennik_tt[1])."' where id='$id_s'<br>";
		}
			
	}

}


if (!$sid){
	echo "<table><tr valign='top'><td width='50%'>";
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_1 order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo "<table><tr><td valign='top'><a href='katalogovy-list?sid=".$clanky['id']."' title='Skupina stavební techniky: ".$clanky['nazev']."'><img width='128px' src='skin/images/skupina".$clanky['id'].".png' border='0' title='Skupina stavební techniky: ".$clanky['nazev']."'></a></td><td><h1><a href='katalogovy-list?sid=".$clanky['id']."' title='Skupina stavební techniky: ".$clanky['nazev']."'>".$clanky['nazev']." (".$clanky['pocet'].")</a></h1>";
		if ($m) {
			$celkem=mysql_result(mysql_query("SELECT count(*) FROM optimalizace_katalog_stroju where skupina1=".$clanky['id'],$connect2),0);
			mysql_query("update optimalizace_skupiny_stroju_1 set pocet='$celkem' where id='".$clanky['id']."'",$connect2);
		}
		$getclanek2 = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_2 where skupina1='".$clanky['id']."' order by id",$connect2);
		while ($clanky2 = mysql_fetch_array($getclanek2)){
		
			if ($m) {
				$celkem=mysql_result(mysql_query("SELECT count(*) FROM optimalizace_katalog_stroju where skupina2=".$clanky2['id'],$connect2),0);
				mysql_query("update optimalizace_skupiny_stroju_2 set pocet='$celkem' where id='".$clanky2['id']."'",$connect2);
			}
		
			echo "<a href='katalogovy-list?sid=".$clanky['id']."&amp;sid2=".$clanky2['id']."' title='Skupina stavební techniky: ".$clanky2['nazev']."'>".$clanky2['nazev']." (".$clanky2['pocet'].")</a><br>";
		}
		echo "<br></td></tr></table>";
		$ii++;
		if ($ii==7) echo "</td><td width='50%'>";
	}
	echo "</td></tr></table>";
}else{ ?>
<h2>Omlouváme se za zpùsobené potíže.</h2><br>
<img src="skin/under-construction.gif">
<?php } ?>
