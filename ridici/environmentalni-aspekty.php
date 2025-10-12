<noscript><div style="width:390px;text-align:center;color: yellow;border-width: 2px; border-style: double; border-color: yellow;background-color: red;"><b>Stránky nebudou správnì fungovat. Pravdìpodobnì máte vypnutý javascript.</b></div><br><br></noscript>
<?php 
echo "<h1>".$mainlang[4]."</h1>";

$pocetc=50;


function kontrola ($promenna){
	$promenna = EregI_Replace("<", "&lt;", $promenna);
	$promenna = EregI_Replace(">", "&gt;", $promenna);
	$promenna = EregI_Replace('"', '&quot;', $promenna);
	$promenna = EregI_Replace('\'', '&quot;', $promenna);
//	$promenna=htmlspecialchars($promenna);
//	$promenna=addslashes($promenna);
//	$promenna=quotemeta($promenna);
return $promenna;
}

$lock = 1;
if (($userid==2)or($jmeno=="Contec")) $lock=0;


$pozice = kontrola($_POST['pozice']);
$status = kontrola($_POST['status']);
$razeni = kontrola($_POST['razeni']);
if (!$status) $status = kontrola($_GET['status']);
if (!$razeni) $razeni = kontrola($_GET['razeni']);
if (!$pozice) $pozice = kontrola($_GET['pozice']);
if ($pozice=="") $pozice=0;
if ($status=="") $status=0;
if ($razeni=="") $razeni=0;

if (($status==1)and($lock==1)) $status=0;
if (($status==101)and($lock==1)) $status=0;

if (($status==4)and($lock==1)) $status=0;
if (($status==401)and($lock==1)) $status=0;
if (($status==402)and($lock==1)) $status=0;

if (($status==3)and($lock==1)) $status=0;
if (($status==301)and($lock==1)) $status=0;
if (($status==302)and($lock==1)) $status=0;
if (($status==303)and($lock==1)) $status=0;
if (($status==304)and($lock==1)) $status=0;
if (($status==305)and($lock==1)) $status=0;


if (($status==6)and($lock==1)) $status=0;
if (($status==601)and($lock==1)) $status=0;

if (($status==8)and($lock==1)) $status=0;
if (($status==801)and($lock==1)) $status=0;

if (($status==9)and($lock==1)) $status=0;
if (($status==901)and($lock==1)) $status=0;



// EXPORT tabulky - formular
if ($status==3){
	echo "<h2>Krok 1: Export databáze environmentálních aspektù: Volba formátu</h2><br>";
	echo "<form method='post'  enctype='multipart/form-data'>";
	echo "Formát: <select name='status'><option value='301'>CSV</option><option value='302'>MS EXCEL</option><option value='303'>TXT</option><option value='304'>CONTEC</option><option value='305'>MS WORD</option></select><br><br>";
	echo "<input name='vlozit' type='submit' value='Exportovat'>&nbsp;<input type=button onclick='history.back()' value='Zpìt'></form>";
}

// EXPORT tabulky - CSV
if ($status==301){

	echo "<h2>Krok 2: Export databáze environmentálních aspektù: Uložit soubor</h2><br>";
	$db=$connect2;
	$tabl="DbEAs";
	$tabl2="DbEAs";
	$sql="SELECT * FROM `DbEAs` order by klic";
	$rsSearchResults = mysql_query($sql, $db);
	$seed = floor(time()/86400);
	srand($seed);
	$time=Time();
	$rand = Rand();
	$datum=date("Y-m-d",time());
	$filnam=$tabl2."-".$datum."-".MD5($time.$rand).".csv";
	$cesta="./export/csv/".$filnam;
	$filnam2=$tabl2."-".$datum."-".MD5($time.$rand);
	$cesta2="./export/csv/".$filnam2;

	$out = '<?php header("Content-type: text/x-csv");header("Content-Disposition: attachment; filename='.$filnam.'");?>';
	$fields = mysql_list_fields('contec',$tabl,$db);
	$columns = mysql_num_fields($fields);	
	for ($i = 0; $i < $columns; $i++) {
		$l=mysql_field_name($fields, $i);
		$out .= '"'.$l.'",';
	}
	$out .="\n";
	while ($l = mysql_fetch_array($rsSearchResults)) {
		for ($i = 0; $i < $columns; $i++) {
			$out .='"'.$l["$i"].'",';
		}
		$out .="\n";
	}
	
	$fp = fopen ($cesta2, "w");
	fwrite($fp,$out, strlen ($out));
	fclose ($fp);

	echo "<h1>Soubor exportu: <a href='".$cesta2."' target='_blank'>Uložit CSV soubor :::</a></h1><br>";

	echo "<input type=button onclick='history.back()' value='Zpìt'>";

}


// EXPORT tabulky - EXCEL
if ($status==302){

	$tabl="DbEAs";
	$tabl2="DbEAs";

	echo "<h2>Krok 2: Export databáze environmentálních aspektù: Uložit soubor</h2><br>";


	$seed = floor(time()/86400);
	srand($seed);
	$time=Time();
	$rand = Rand();
	$datum=date("Y-m-d",time());
	$filnam=$tabl2."-".$datum."-".MD5($time.$rand).".xls";
	$filnam2=$tabl2."-".$datum."-".MD5($time.$rand);
	$cesta="./export/xls/".$filnam;
	$cesta2="./export/xls/".$filnam2;


$DB_TBLName="DbEAs";

$sql = "Select * from $DB_TBLName";

$Use_Title = 1;
$now_date = date('m-d-Y H:i');
$title = "Dump For Table $DB_TBLName from Database $DB_DBName on $now_date";

$result = @mysql_query($sql,$connect2)
	or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());

if (isset($w) && ($w==1))
{
	$file_type = "msword";
	$file_ending = "doc";
}else {
	$file_type = "vnd.ms-excel";
	$file_ending = "xls";
}

	$out = '<?php header("Content-type: text/vnd.ms-excel");header("Content-Disposition: attachment; filename='.$filnam.'");?>';



if (isset($w) && ($w==1)) //check for $w again
{
	if ($Use_Title == 1)
	{
		$out=$out."$title\n\n";
	}
	$sep = "\n"; //new line character

	while($row = mysql_fetch_row($result))
	{
		$schema_insert = "";
		for($j=0; $j<mysql_num_fields($result);$j++)
		{
		$field_name = mysql_field_name($result,$j);
		$schema_insert .= "$field_name:\t";
			if(!isset($row[$j])) {
				$schema_insert .= "NULL".$sep;
				}
			elseif ($row[$j] != "") {
				$schema_insert .= "$row[$j]".$sep;
				}
			else {
				$schema_insert .= "".$sep;
				}
		}
		$schema_insert = str_replace($sep."$", "", $schema_insert);
		$schema_insert .= "\t";
		$schema_insert=str_replace(".",",",$schema_insert);
		$out=$out.trim($schema_insert);
		$out=$out."\n----------------------------------------------------\n";
	}
}else{
	if ($Use_Title == 1)
	{
		$out=$out."$title\n";
	}
	$sep = "\t"; //tabbed character

	for ($i = 0; $i < mysql_num_fields($result); $i++)
	{
		$out=$out.mysql_field_name($result,$i) . "\t";
	}
	$out=$out."\n";

	while($row = mysql_fetch_row($result))
	{
		$schema_insert = "";
		for($j=0; $j<mysql_num_fields($result);$j++)
		{
			if(!isset($row[$j]))
				$schema_insert .= "NULL".$sep;
			elseif ($row[$j] != "")
				$schema_insert .= "$row[$j]".$sep;
			else
				$schema_insert .= "".$sep;
		}
		$schema_insert = str_replace($sep."$", "", $schema_insert);
		$schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
		$schema_insert .= "\t";
		$schema_insert=str_replace(".",",",$schema_insert);
		$out=$out.trim($schema_insert);
		$out=$out."\n";
	}
}


	
	$fp = fopen ($cesta2, "w");
	fwrite($fp,$out, strlen ($out));
	fclose ($fp);

	echo "<h1>Soubor exportu: <a href='".$cesta2."' target='_blank'>Uložit EXCEL soubor :::</a></h1><br>";

	echo "<input type=button onclick='history.back()' value='Zpìt'>";

}


// EXPORT tabulky - TXT
if ($status==303){

	echo "<h2>Krok 2: Export databáze environmentálních aspektù: Uložit soubor</h2><br>";



	$db=$connect2;
	$tabl="DbEAs";
	$tabl2="DbEAs";
	$sql="SELECT * FROM `DbEAs` order by klic";
	$rsSearchResults = mysql_query($sql, $db);
	$seed = floor(time()/86400);
	srand($seed);
	$time=Time();
	$rand = Rand();
	$datum=date("Y-m-d",time());
	$filnam=$tabl2."-".$datum."-".MD5($time.$rand).".txt";
	$filnam2=$tabl2."-".$datum."-".MD5($time.$rand);
	$cesta="./export/txt/".$filnam;
	$cesta2="./export/txt/".$filnam2;

	$out = '<?php header("Content-type: text/html");header("Content-Disposition: attachment; filename='.$filnam.'");?>';



	$fields = mysql_list_fields('contec',$tabl,$db);
	$columns = mysql_num_fields($fields);	
	for ($i = 0; $i < $columns; $i++) {
		$l=mysql_field_name($fields, $i);
		//$out .= '"'.$l.'",';
	}
//	$out .="\n";
	while ($l = mysql_fetch_array($rsSearchResults)) {
		for ($i = 0; $i < $columns; $i++) {
			$out .=$l["$i"].chr(13);
		}
//		$out .="\n";
	}
	
	$fp = fopen ($cesta2, "w");
	fwrite($fp,$out, strlen ($out));
	fclose ($fp);

	echo "<h1>Soubor exportu: <a href='".$cesta2."' target='_blank'>Uložit TXT soubor :::</a></h1><br>";

	echo "<input type=button onclick='history.back()' value='Zpìt'>";

}

// EXPORT tabulky - CONTEC
if ($status==304){

	echo "<h2>Krok 2: Export databáze environmentálních aspektù: Uložit soubor</h2><br>";

	echo "<br><br><img src='./skin/under-construction.gif' width='500' height='125'><br><br>";

	echo "<input type=button onclick='history.back()' value='Zpìt'>";

}

// EXPORT tabulky - DOC
if ($status==305){

	echo "<h2>Krok 2: Export databáze environmentálních aspektù: Uložit soubor</h2><br>";

	$tabl="DbEAs";
	$tabl2="DbEAs";

	$seed = floor(time()/86400);
	srand($seed);
	$time=Time();
	$rand = Rand();
	$datum=date("Y-m-d",time());
	$filnam=$tabl2."-".$datum."-".MD5($time.$rand).".doc";
	$filnam2=$tabl2."-".$datum."-".MD5($time.$rand);
	$cesta="./export/doc/".$filnam;
	$cesta2="./export/doc/".$filnam2;


$DB_TBLName="DbEAs";

$sql = "Select * from $DB_TBLName";

$Use_Title = 1;
$now_date = date('m-d-Y H:i');
$title = "Dump For Table $DB_TBLName from Database $DB_DBName on $now_date";

$result = @mysql_query($sql,$connect2)
	or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());

$w=1;

if (isset($w) && ($w==1))
{
	$file_type = "msword";
	$file_ending = "doc";
}else {
	$file_type = "vnd.ms-excel";
	$file_ending = "xls";
}

	$out = '<?php header("Content-type: text/msword");header("Content-Disposition: attachment; filename='.$filnam.'");?>';



if (isset($w) && ($w==1)) //check for $w again
{
	if ($Use_Title == 1)
	{
		$out=$out."$title\n\n";
	}
	$sep = "\n"; //new line character

	while($row = mysql_fetch_row($result))
	{
		$schema_insert = "";
		for($j=0; $j<mysql_num_fields($result);$j++)
		{
		$field_name = mysql_field_name($result,$j);
		$schema_insert .= "$field_name:\t";
			if(!isset($row[$j])) {
				$schema_insert .= "NULL".$sep;
				}
			elseif ($row[$j] != "") {
				$schema_insert .= "$row[$j]".$sep;
				}
			else {
				$schema_insert .= "".$sep;
				}
		}
		$schema_insert = str_replace($sep."$", "", $schema_insert);
		$schema_insert .= "\t";
		$schema_insert=str_replace(".",",",$schema_insert);
		$out=$out.trim($schema_insert);
		$out=$out."\n----------------------------------------------------\n";
	}
}else{
	if ($Use_Title == 1)
	{
		$out=$out."$title\n";
	}
	$sep = "\t"; //tabbed character

	for ($i = 0; $i < mysql_num_fields($result); $i++)
	{
		$out=$out.mysql_field_name($result,$i) . "\t";
	}
	$out=$out."\n";

	while($row = mysql_fetch_row($result))
	{
		$schema_insert = "";
		for($j=0; $j<mysql_num_fields($result);$j++)
		{
			if(!isset($row[$j]))
				$schema_insert .= "NULL".$sep;
			elseif ($row[$j] != "")
				$schema_insert .= "$row[$j]".$sep;
			else
				$schema_insert .= "".$sep;
		}
		$schema_insert = str_replace($sep."$", "", $schema_insert);
		$schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
		$schema_insert .= "\t";
		$schema_insert=str_replace(".",",",$schema_insert);
		$out=$out.trim($schema_insert);
		$out=$out."\n";
	}
}


	
	$fp = fopen ($cesta2, "w");
	fwrite($fp,$out, strlen ($out));
	fclose ($fp);

	echo "<h1>Soubor exportu: <a href='".$cesta2."' target='_blank'>Uložit MS WORD soubor :::</a></h1><br>";

	echo "<input type=button onclick='history.back()' value='Zpìt'>";

}


// Import tabulky - formular
if ($status==4){
	echo "<h2>Krok 1: Import databáze environmentálních aspektù ze souborù systému CONTEC: Upload souboru</h2><br>";
	echo "<form method='post'  enctype='multipart/form-data'>";
	echo "<input type='hidden' name='status' value='401'>";
	echo "Soubor: <input type='hidden' name='MAX_FILE_SIZE' value='1000000'><input name='file' type='file'><br>";
	echo "Maximální velikost souboru 1 MB. Jen ve formátu systému CONTEC !<br>";
	echo "Nahrávání souboru mùže trvat velice dlouho - v závislosti na rychlosti vašeho pøipojení k internetu !<br>";
	echo "<input name='vlozit' type='submit' value='Importovat'>&nbsp;<input type=button onclick='history.back()' value='Zpìt'></form>";
}

// Import tabulky - Kontrola souboru
if ($status==401){

	$chyba=0;
	echo "<h2>Krok 2: Import databáze environmentálních aspektù ze souborù systému CONTEC: Kontrola</h2><br>";
	$MAX_FILE_SIZE=kontrola($_POST['MAX_FILE_SIZE']);
	if (!$_FILES) {
	        $chyb = "Soubor se nepodaøilo nahrát na server.\n";
	        $chyba=1;
	}
	if ($_FILES["file"]["size"]>1000000){
	        $chyb = "Soubor je vìtší než 1 Mb.\n";
	        $chyba=1;
	}
	if (fmod($_FILES["file"]["size"],521)){
	        $chyb = "Soubor je ve špatném formátù.\n";
	        $chyba=1;
	}
	if ($chyba==1){
		echo "<h1><font color=red>Chyba pøi Importu databáze aspektù !</font></h1>";
		echo "<h2>".$chyb."</h2>";
		echo "<center><input type=button onclick='history.back()' value='Zpìt'></center>";
	}else{
		$seed = floor(time()/86400);
		srand($seed);
		$time=Time();
		$rand = Rand();
		$filenameee=MD5($time.$rand);
		$cesta="./import/DbEAs-".$filenameee;
		move_uploaded_file($_FILES['file']['tmp_name'],$cesta);
		include ("./convert/convert-DbEAs-1.php");
		echo "<form method='post'  enctype='multipart/form-data'>";
		echo "<input type='hidden' name='status' value='402'>";
		echo "<input type='hidden' name='soubor' value='".$cesta."'>";
		echo "<input name='vlozit' type='submit' value='Uložit do databáze'>&nbsp;<input type=button onclick='history.back()' value='Zpìt'></form>";
	}
}

// Import tabulky - Ukladani do databaze
if ($status==402){
	$cesta=kontrola($_POST['soubor']);
	include ("./convert/convert-DbEAs-2.php");
	echo "<h2>Krok 3: Import databáze environmentálních aspektù ze souborù systému CONTEC: Zmìna databáze</h2><br>";
	echo "<h1><font color=green>Databáze byla úspìšnì obnovìna !</font></h1><hr>";
	$status=0;
}



// Vyhledavani aspektu - vysledek
if ($status==501){

	$DEAKod=kontrola($_POST['DEAKod']);
	$DEAAsp1=kontrola($_POST['DEAAsp1']);
	$DEAAsp2=kontrola($_POST['DEAAsp2']);
	$DEAUtv=kontrola($_POST['DEAUtv']);
	$DEAZar=kontrola($_POST['DEAZar']);
	$DEAPolut1=kontrola($_POST['DEAPolut1']);
	$DEAPolut2=kontrola($_POST['DEAPolut2']);
	$DEALimH=kontrola($_POST['DEALimH']);
	$DEAMJ=kontrola($_POST['DEAMJ']);
	$DEAOdp=kontrola($_POST['DEAOdp']);
	$DEAPredp=kontrola($_POST['DEAPredp']);
	$DEARiz=kontrola($_POST['DEARiz']);
	$DEADokl=kontrola($_POST['DEADokl']);
	$DEAPrev1=kontrola($_POST['DEAPrev1']);
	$DEAPrev2=kontrola($_POST['DEAPrev2']);
	$DEAOpat1=kontrola($_POST['DEAOpat1']);
	$DEAOpat2=kontrola($_POST['DEAOpat2']);
	$CKLIC= kontrola($_POST['CKLIC']);
	$SKLIC= strtoupper (kontrola($_POST['SKLIC']));
	$DEACelk=kontrola($_POST['DEACelk']);
	$temp_cinnost=strtoupper (kontrola($_POST['temp_cinnost']));

	echo "<h1><font color=green>Výsledky vyhledývaní...</font></h1><hr>";

	if ($DEAKod) $vyhledavani=" DEAKod like '%".$DEAKod."%'";
	if ($temp_cinnost) $vyhledavani=$vyhledavani." and temp_cinnost like '%".$temp_cinnost."%'";
	if ($DEACelk) $vyhledavani=$vyhledavani." and DEACelk like '%".$DEACelk."%'";
	if ($DEAAsp1) $vyhledavani=$vyhledavani." and DEAAsp1 like '%".$DEAAsp1."%'";
	if ($DEAAsp2) $vyhledavani=$vyhledavani." and DEAAsp2 like '%".$DEAAsp2."%'";
	if ($DEAUtv) $vyhledavani=$vyhledavani." and DEAUtv like '%".$DEAUtv."%'";
	if ($DEAZar) $vyhledavani=$vyhledavani." and DEAZar like '%".$DEAZar."%'";
	if ($DEAPolut1) $vyhledavani=$vyhledavani." and DEAPolut1 like '%".$DEAPolut1."%'";
	if ($DEAPolut2) $vyhledavani=$vyhledavani." and DEAPolut2 like '%".$DEAPolut2."%'";
	if ($DEALimH) $vyhledavani=$vyhledavani." and DEALimH like '%".$DEALimH."%'";
	if ($DEAMJ) $vyhledavani=$vyhledavani." and DEAMJ like '%".$DEAMJ."%'";
	if ($DEAOdp) $vyhledavani=$vyhledavani." and DEAOdp like '%".$DEAOdp."%'";
	if ($DEAPredp) $vyhledavani=$vyhledavani." and DEAPredp like '%".$DEAPredp."%'";
	if ($DEARiz) $vyhledavani=$vyhledavani." and DEARiz like '%".$DEARiz."%'";
	if ($DEADokl) $vyhledavani=$vyhledavani." and DEADokl like '%".$DEADokl."%'";
	if ($DEAPrev1) $vyhledavani=$vyhledavani." and DEAPrev1 like '%".$DEAPrev1."%'";
	if ($DEAPrev2) $vyhledavani=$vyhledavani." and DEAPrev2 like '%".$DEAPrev2."%'";
	if ($DEAOpat1) $vyhledavani=$vyhledavani." and DEAOpat1 like '%".$DEAOpat1."%'";
	if ($DEAOpat2) $vyhledavani=$vyhledavani." and DEAOpat2 like '%".$DEAOpat2."%'";
	if ($CKLIC) $vyhledavani=$vyhledavani." and CKLIC like '%".$CKLIC."%'";
	if ($SKLIC) $vyhledavani=$vyhledavani." and SKLIC like '%".$SKLIC."%'";

	if (substr($vyhledavani,0,4)==" and") $vyhledavani=substr($vyhledavani,4,strlen($vyhledavani));
	$status=0;
}


// Vyhledavani - formular
if ($status==5){
?>
<form  ACTION='./environmentalni-aspekty' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="501">
<h2><font color="green">Vyhledávaní položky:</font></h2>
<table>
<tr><td class="row1" colspan="2"><br><b>Environmentální aspekt</b></td></tr>
<tr><td class="row2">Kód aspektu:</td><td class="row2"><input type="text" value="" name="DEAKod" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Název aspektu:</td><td class="row1"><input type="text" value="" name="DEAAsp1" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row1"></td><td class="row1"><input type="text" value="" name="DEAAsp2" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2">Útvar HS:</td><td class="row2"><input type="text" value="" name="DEAUtv" MAXLENGTH="15"  size="15"></td></tr>
<tr><td class="row1">Zaøízení:</td><td class="row1"><input type="text" value="" name="DEAZar" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2">Polutanty:</td><td class="row2"><input type="text" value="" name="DEAPolut1" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2"></td><td class="row2"><input type="text" value="" name="DEAPolut2" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row1">Limitní hodnota:</td><td class="row1"><input type="text" value="" name="DEALimH" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">m.j. limit. hodnoty</td><td class="row2"><input type="text" value="" name="DEAMJ" MAXLENGTH="7"  size="7"></td></tr>
<tr><td class="row1">Pøedpis:</td><td class="row1"><input type="text" value="" name="DEAPredp" MAXLENGTH="31"  size="31"></td></tr>
<tr><td class="row2">Zpùsob øízení:</td><td class="row2"><input type="text" value="" name="DEARiz" MAXLENGTH="31"  size="31"></td></tr>
<tr><td class="row1">Opatøení:</td><td class="row1"><input type="text" value="" name="DEAOpat1" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row1"></td><td class="row1"><input type="text" value="" name="DEAOpat2" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2">Odpovìdnost:</td><td class="row2"><input type="text" value="" name="DEAOdp" MAXLENGTH="19"  size="19"></td></tr>
<tr><td class="row1">Doklad:</td><td class="row1"><input type="text" value="" name="DEADokl" MAXLENGTH="19"  size="19"></td></tr>
<tr><td class="row2">Kontrola:</td><td class="row2"><input type="text" value="" name="DEAPrev1" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row1">Èetnost:</td><td class="row1"><input type="text" value="" name="DEAPrev2" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row1" colspan="2"><hr><b>Stavební èinnost</b></td></tr>
<tr><td class="row2">Èíselní klíè:</td><td class="row2"><input type="text" value="" name="CisKlic" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row1">Zkratka:</td><td class="row1"><input type="text" value="" name="SlovKlic" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row1">Název èinnosti:</td><td class="row1"><input type="text" value="" name="temp_cinnost" MAXLENGTH="25"  size="25"></td></tr>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1"><b>Význam položky:</b></td><td class="row1"><input type="text" value="" name="DEACelk" MAXLENGTH="4"  size="4"></td></tr>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Hledat">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zpìt"></td></tr>
<tr><td class="row1" colspan="2"><em>Zobrazí se pouze prvních 50 aspektù.</em></td></tr>
</table>
</form>
<?php
}


// Novy zaznam tabulky -pridani do MySQL
if ($status==101){

	$DEAKod=kontrola($_POST['DEAKod']);
	$DEAAsp1=kontrola($_POST['DEAAsp1']);
	$DEAAsp2=kontrola($_POST['DEAAsp2']);
	$DEAUtv=kontrola($_POST['DEAUtv']);
	$DEAZar=kontrola($_POST['DEAZar']);
	$DEAPolut1=kontrola($_POST['DEAPolut1']);
	$DEAPolut2=kontrola($_POST['DEAPolut2']);
	$DEADopad1=kontrola($_POST['DEADopad1']);
	$DEADopad2=kontrola($_POST['DEADopad2']);
	$DEADopad3=kontrola($_POST['DEADopad3']);
	$DEADopad4=kontrola($_POST['DEADopad4']);
	$DEADopad5=kontrola($_POST['DEADopad5']);
	$DEADopad6=kontrola($_POST['DEADopad6']);
	$DEALimH=kontrola($_POST['DEALimH']);
	$DEAMJ=kontrola($_POST['DEAMJ']);
	$DEAOdp=kontrola($_POST['DEAOdp']);
	$DEAPredp=kontrola($_POST['DEAPredp']);
	$DEARiz=kontrola($_POST['DEARiz']);
	$DEAVyzn1=kontrola($_POST['DEAVyzn1']);
	$DEAVyzn2=kontrola($_POST['DEAVyzn2']);
	$DEAVyzn3=kontrola($_POST['DEAVyzn3']);
	$DEAVyzn4=kontrola($_POST['DEAVyzn4']);
	$DEAVyzn5=kontrola($_POST['DEAVyzn5']);
	$DEAVyzn6=kontrola($_POST['DEAVyzn6']);
	$DEAVyzn7=kontrola($_POST['DEAVyzn7']);
	$DEAVyzn8=kontrola($_POST['DEAVyzn8']);

	$DEADokl=kontrola($_POST['DEADokl']);
	$DEAPrev1=kontrola($_POST['DEAPrev1']);
	$DEAPrev2=kontrola($_POST['DEAPrev2']);
	$DEAOpat1=kontrola($_POST['DEAOpat1']);
	$DEAOpat2=kontrola($_POST['DEAOpat2']);

	if ($DEADopad1) $DEADopad1="1";else $DEADopad1="0";
	if ($DEADopad2) $DEADopad2="1";else $DEADopad2="0";
	if ($DEADopad3) $DEADopad3="1";else $DEADopad3="0";
	if ($DEADopad4) $DEADopad4="1";else $DEADopad4="0";
	if ($DEADopad5) $DEADopad5="1";else $DEADopad5="0";
	if ($DEADopad6) $DEADopad6="1";else $DEADopad6="0";

	if (($DEAVyzn1<1)and($DEAVyzn1>3)) $DEAVyzn1=1;
	if (($DEAVyzn2<1)and($DEAVyzn2>3)) $DEAVyzn2=1;
	if (($DEAVyzn3<1)and($DEAVyzn3>3)) $DEAVyzn3=1;
	if (($DEAVyzn4<1)and($DEAVyzn4>3)) $DEAVyzn4=1;
	if (($DEAVyzn5<1)and($DEAVyzn5>3)) $DEAVyzn5=1;
	if (($DEAVyzn6<1)and($DEAVyzn6>3)) $DEAVyzn6=1;
	if (($DEAVyzn7<1)and($DEAVyzn7>3)) $DEAVyzn7=1;
	if (($DEAVyzn8<1)and($DEAVyzn8>3)) $DEAVyzn8=1;

	$DEAVyzn=$DEAVyzn1.$DEAVyzn2.$DEAVyzn3.$DEAVyzn4.$DEAVyzn5.$DEAVyzn6.$DEAVyzn7.$DEAVyzn8;
	$DEADopad=$DEADopad1.$DEADopad2.$DEADopad3.$DEADopad4.$DEADopad5.$DEADopad6;


	$DEALimH=sprintf ("%01.2f", $DEALimH);
	if ($DEALimH==0) $DEALimH="";


	$DEAVaha1=kontrola($_POST['DEAVaha1']);
	$DEAVaha2=kontrola($_POST['DEAVaha2']);
	$DEAVaha3=kontrola($_POST['DEAVaha3']);
	$DEAVaha4=kontrola($_POST['DEAVaha4']);
	$DEAVaha5=kontrola($_POST['DEAVaha5']);
	$DEAVaha6=kontrola($_POST['DEAVaha6']);
	$DEAVaha7=kontrola($_POST['DEAVaha7']);
	$DEAVaha8=kontrola($_POST['DEAVaha8']);

	if (($DEAVaha1<1)and($DEAVaha1>3)) $DEAVaha1=1;
	if (($DEAVaha2<1)and($DEAVaha2>3)) $DEAVaha2=1;
	if (($DEAVaha3<1)and($DEAVaha3>3)) $DEAVaha3=1;
	if (($DEAVaha4<1)and($DEAVaha4>3)) $DEAVaha4=1;
	if (($DEAVaha5<1)and($DEAVaha5>3)) $DEAVaha5=1;
	if (($DEAVaha6<1)and($DEAVaha6>3)) $DEAVaha6=1;
	if (($DEAVaha7<1)and($DEAVaha7>3)) $DEAVaha7=1;
	if (($DEAVaha8<1)and($DEAVaha8>3)) $DEAVaha8=1;

	$DEAVaha=$DEAVaha1.$DEAVaha2.$DEAVaha3.$DEAVaha4.$DEAVaha5.$DEAVaha6.$DEAVaha7.$DEAVaha8;


	$DEACelk=$DEAVaha1*$DEAVyzn1+$DEAVaha2*$DEAVyzn2+$DEAVaha3*$DEAVyzn3+$DEAVaha4*$DEAVyzn4+$DEAVaha5*$DEAVyzn5+$DEAVaha6*$DEAVyzn6+$DEAVaha7*$DEAVyzn7+$DEAVaha8*$DEAVyzn8;
	$DOK=kontrola($_POST['DOK']);
	$MNK=kontrola($_POST['MNK']);
	$DEACetn=kontrola($_POST['DEACetn']);
	$DEANamH=kontrola($_POST['DEANamH']);

	$SKLIC=strtoupper (kontrola($_POST['SKLIC']));
	$CKLIC=strtoupper (kontrola($_POST['CKLIC']));
	$temp_cinnost=strtoupper (kontrola($_POST['temp_cinnost']));


	$chyba=0;

//	$chyba=mysql_result(mysql_query("SELECT count(*) FROM DbEAs where CKLIC='".$CKLIC."' and DEAKod='".$DEAKod."'",$connect2),0);

	if ($chyba) {
		echo "<h1><font color=red>Chyba ! Položka není unikátní !</font></h1>";
	}
	if (!$SKLIC) {
		echo "<h1><font color=red>Chyba ! Kód èinnosti nesmí být prázdný !</font></h1>";
		$chyba=1;
	}
	if (!$DEAKod) {
		echo "<h1><font color=red>Chyba ! Kód aspektu nesmí být prázdný !</font></h1>";
		$chyba=1;
	}
	if (!$chyba){ 
		mysql_query("INSERT INTO `DbEAs` ( `DEAStat` , `DEAKod` , `DEAAsp1` , `DEAAsp2` , `DEAUtv` , `DEAZar` , `DEAPolut1` , `DEAPolut2` , `DEADopad` , `DEALimH` , `DEAMJ` , `DEAOdp` , `DEAPredp` , `DEARiz` , `DEAVyzn` , `DEADokl` , `DEAPrev1` , `DEAPrev2` , `DEAOpat1` , `DEAOpat2` , `DEARes` , `DOK`, `MNK`, `DEAVaha`, `DEACelk`, `DEANamH`, `DEACetn`, `DEARes2`, `CKLIC`, `SKLIC`,`temp_cinnost`) 
VALUES (
'$DEAStat', '$DEAKod', '$DEAAsp1', '$DEAAsp2', '$DEAUtv', '$DEAZar', '$DEAPolut1', '$DEAPolut2', '$DEADopad', '$DEALimH', '$DEAMJ', '$DEAOdp', '$DEAPredp', '$DEARiz', '$DEAVyzn', '$DEADokl', '$DEAPrev1', '$DEAPrev2', '$DEAOpat1', '$DEAOpat2', '$DEARes', '$DOK', '$MNK', '$DEAVaha', '$DEACelk', '$DEANamH', '$DEACetn', '$DEARes2', '$CKLIC', '$SKLIC','$temp_cinnost'
);",$connect2);
		echo "<h1><font color=green>Nová položka byla úspìšnì uložena do databáze !</font></h1><hr>";

		$status=0;
	}else 	echo '<center><input type=button onclick="history.back()" value="Zpìt"></center>';


}

// Novy zaznam tabulky - formular
if ($status==1){
?>
<script type="text/javascript">
function calculate(){
	hodnota=window.document.getElementById("Vaha1").value*window.document.getElementById("Vyzn1").value+window.document.getElementById("Vaha2").value*window.document.getElementById("Vyzn2").value+window.document.getElementById("Vaha3").value*window.document.getElementById("Vyzn3").value+window.document.getElementById("Vaha4").value*window.document.getElementById("Vyzn4").value+window.document.getElementById("Vaha5").value*window.document.getElementById("Vyzn5").value+window.document.getElementById("Vaha6").value*window.document.getElementById("Vyzn6").value+window.document.getElementById("Vaha7").value*window.document.getElementById("Vyzn7").value+window.document.getElementById("Vaha8").value*window.document.getElementById("Vyzn8").value;
	window.document.getElementById("DEACelkS").innerHTML="<b>"+hodnota+"</b>";
	window.document.getElementById("DEACelk").value=hodnota;

}
</script>
<form  name="form4" ACTION='./environmentalni-aspekty' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="101">
<input type="hidden" name="DEACelk" value="">
<h2><font color="green">Vložení nové položky:</font></h2>
<table>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1"><b><em>Environmentalní aspekt:</em></b></td><td class="row1"><a href="vyber-aspektu" target="_blank">Vybrat aspekt :::</a></td></tr>
<tr><td class="row2">Kód aspektu:</td><td class="row2"><input type="text" value="" id="DEAKod" name="DEAKod" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1"><b>Aspekt:</b></td><td class="row1"><input type="text" value="" name="DEAAsp1" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row1"></td><td class="row1"><input type="text" value="" name="DEAAsp2" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2">Útvar HS:</td><td class="row2"><input type="text" value="" name="DEAUtv" MAXLENGTH="15"  size="15"></td></tr>
<tr><td class="row1">Zaøízení:</td><td class="row1"><input type="text" value="" name="DEAZar" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2">Polutanty:</td><td class="row2"><input type="text" value="" name="DEAPolut1" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2"></td><td class="row2"><input type="text" value="" name="DEAPolut2" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row1">Limitní hodnota:</td><td class="row1"><input type="text" value="" name="DEALimH" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">m.j. limit. hodnoty</td><td class="row2"><input type="text" value="" name="DEAMJ" MAXLENGTH="7"  size="7"></td></tr>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1" colspan="2"><b><em>Dopad na životní prostøedí:</em></b></td></tr>
<tr><td class="row2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;èlovìk</td><td class="row2"><input type="checkbox" value="1" name="DEADopad1"></td></tr>
<tr><td class="row1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ovzduší</td><td class="row1"><input type="checkbox" value="1" name="DEADopad2"></td></tr>
<tr><td class="row2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;voda</td><td class="row2"><input type="checkbox" value="1" name="DEADopad3"></td></tr>
<tr><td class="row1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pùda</td><td class="row1"><input type="checkbox" value="1" name="DEADopad4"></td></tr>
<tr><td class="row2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;prac. prostøedí</td><td class="row2"><input type="checkbox" value="1" name="DEADopad5"></td></tr>
<tr><td class="row1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;jiné</td><td class="row1"><input type="checkbox" value="1" name="DEADopad6"></td></tr>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row2">Pøedpis:</td><td class="row2"><input type="text" value="" name="DEAPredp" MAXLENGTH="31"  size="31"></td></tr>
<tr><td class="row1">Zpùsob øízení:</td><td class="row1"><input type="text" value="" name="DEARiz" MAXLENGTH="31"  size="31"></td></tr>
<tr><td class="row2">Opatøení:</td><td class="row2"><input type="text" value="" name="DEAOpat1" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2"></td><td class="row2"><input type="text" value="" name="DEAOpat2" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row1">Odpovìdnost:</td><td class="row1"><input type="text" value="" name="DEAOdp" MAXLENGTH="19"  size="19"></td></tr>
<tr><td class="row2">Doklad:</td><td class="row2"><input type="text" value="" name="DEADokl" MAXLENGTH="19"  size="19"></td></tr>
<tr><td class="row1">Kontrola:</td><td class="row1"><input type="text" value="" name="DEAPrev1" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2">Èetnost:</td><td class="row2"><input type="text" value="" name="DEAPrev2" MAXLENGTH="27"  size="27"></td></tr>

<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1"><b><em>Stavební èinnost:</em></b></td><td class="row1"><a href="vyber-cinnosti" target="_blank">Vybrat èinnost :::</a></td></tr>
<tr><td class="row2">Èíselní klíè:</td><td class="row2"><input type="text" value="" name="CKLIC" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row1">Zkratka</td><td class="row1"><input type="text" value="" name="SKLIC" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row2"><b>Název èinnosti:</b></td><td class="row1"><input type="text" value="" name="temp_cinnost" MAXLENGTH="24"  size="24"></td></tr>

<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1" colspan="2"><b><em>Kritéria a ohodnocení jejich závažnosti:</em></b></td></tr>

<tr><td class="row1" colspan="2" align="center">
<table><tr><td class="row1" width="300px">Kritéria</td><td class="row1" width="100px">Závažnost</td><td class="row1" width="100px">Váha</td></tr>

<tr><td class="row2">&nbsp;&nbsp;Soulad s právními požadavky</td><td class="row2"><select name="DEAVyzn1" onChange="calculate();" id="Vyzn1"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row2"><select name="DEAVaha1" onChange="calculate();" id="Vaha1"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row1">&nbsp;&nbsp;Vliv na životní pøostøedí</td><td class="row1"><select name="DEAVyzn2" onChange="calculate();" id="Vyzn2"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row1"><select name="DEAVaha2" onChange="calculate();" id="Vaha2"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row2">&nbsp;&nbsp;Èetnost (pravdìpod.) výskytu</td><td class="row2"><select name="DEAVyzn3" onChange="calculate();" id="Vyzn3"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row2"><select name="DEAVaha3" onChange="calculate();" id="Vaha3"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row1">&nbsp;&nbsp;Doba (trvání) dopadu</td><td class="row1"><select name="DEAVyzn4" onChange="calculate();" id="Vyzn4"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row1"><select name="DEAVaha4" onChange="calculate();" id="Vaha4"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row2">&nbsp;&nbsp;Náklady spojené s dopadem</td><td class="row2"><select name="DEAVyzn5" onChange="calculate();" id="Vyzn5"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row2"><select name="DEAVaha5" onChange="calculate();" id="Vaha5"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row1">&nbsp;&nbsp;Náklady sankèního postíhu</td><td class="row1"><select name="DEAVyzn6" onChange="calculate();" id="Vyzn6"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row1"><select name="DEAVaha6" onChange="calculate();" id="Vaha6"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row2">&nbsp;&nbsp;Pøipomínky veøejnosti</td><td class="row2"><select name="DEAVyzn7" onChange="calculate();" id="Vyzn7"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row2"><select name="DEAVaha7" onChange="calculate();" id="Vaha7"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row1">&nbsp;&nbsp;Stížnosti zamìstnancù</td><td class="row1"><select name="DEAVyzn8" onChange="calculate();" id="Vyzn8"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row1"><select name="DEAVaha8" onChange="calculate();" id="Vaha8"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>
</table>
</td></tr>


<tr><td class="row2"><b>Výsledná významnost aspektu:</b></td><td class="row2"><span id="DEACelkS"><b>8</b></span></td></tr>
<tr><td class="row1">Èetnost mìøení:</td><td class="row1"><input type="text" value="" name="DEACetn" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row2">Procento dokonèení èinnosti pro 1. kontrolu aspektu:</td><td class="row2"><input type="text" value="" name="DOK" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row1">Množství mìrných jednotek produktu na 1 kontrolu aspektu:</td><td class="row1"><input type="text" value="" name="MNK" MAXLENGTH="5"  size="5"></td></tr>


<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Uložit">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zpìt"></td></tr>
</table>
</form>
<?php
}


// Vymazavani zaznamu
if ($status==9){
	$id = kontrola($_GET['id']);
	$getclanek = mysql_query("SELECT * FROM `DbEAs` where klic='".$id."' Limit 0,1",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$DEAKod=$clanky['DEAKod'];
		$DEAAsp1=$clanky['DEAAsp1'];
		$DEAAsp2=$clanky['DEAAsp2'];
		$CKLIC=$clanky['CKLIC'];
		$SKLIC=$clanky['SKLIC'];
		$temp_cinnosti=$clanky['temp_cinnosti'];
	}
	echo "<h1><font color=red>Opravdu chcete vymazat položku:  ".$DEAKod." / ".$DEAAsp1." / ".$CKLIC." / ".$SKLIC." / ".$temp_cinnosti." ?</font></h1>";

	echo "<b><a href='environmentalni-aspekty?status=901&amp;id=".$id."'>ANO</a>&nbsp;&nbsp;<a href='environmentalni-aspekty'>NE</a></b><br><br>";

}


// Vymazavani zaznamu z tabulky MySQL
if ($status==901){
	$id = kontrola($_GET['id']);
	mysql_query("DELETE FROM `DbEAs` where klic='".$id."'",$connect2);
	echo "<h1><font color=green>Položka byla úspìšnì vymazána z databáze !</font></h1><hr>";
	$status=0;
}

// Ukladani zmen do MySQL
if ($status==601){


	$klic=kontrola($_POST['klic']);

	$DEAKod=kontrola($_POST['DEAKod']);
	$DEAAsp1=kontrola($_POST['DEAAsp1']);
	$DEAAsp2=kontrola($_POST['DEAAsp2']);
	$DEAUtv=kontrola($_POST['DEAUtv']);
	$DEAZar=kontrola($_POST['DEAZar']);
	$DEAPolut1=kontrola($_POST['DEAPolut1']);
	$DEAPolut2=kontrola($_POST['DEAPolut2']);
	$DEADopad1=kontrola($_POST['DEADopad1']);
	$DEADopad2=kontrola($_POST['DEADopad2']);
	$DEADopad3=kontrola($_POST['DEADopad3']);
	$DEADopad4=kontrola($_POST['DEADopad4']);
	$DEADopad5=kontrola($_POST['DEADopad5']);
	$DEADopad6=kontrola($_POST['DEADopad6']);
	$DEALimH=kontrola($_POST['DEALimH']);
	$DEAMJ=kontrola($_POST['DEAMJ']);
	$DEAOdp=kontrola($_POST['DEAOdp']);
	$DEAPredp=kontrola($_POST['DEAPredp']);
	$DEARiz=kontrola($_POST['DEARiz']);
	$DEAVyzn1=kontrola($_POST['DEAVyzn1']);
	$DEAVyzn2=kontrola($_POST['DEAVyzn2']);
	$DEAVyzn3=kontrola($_POST['DEAVyzn3']);
	$DEAVyzn4=kontrola($_POST['DEAVyzn4']);
	$DEAVyzn5=kontrola($_POST['DEAVyzn5']);
	$DEAVyzn6=kontrola($_POST['DEAVyzn6']);
	$DEAVyzn7=kontrola($_POST['DEAVyzn7']);
	$DEAVyzn8=kontrola($_POST['DEAVyzn8']);

	$DEADokl=kontrola($_POST['DEADokl']);
	$DEAPrev1=kontrola($_POST['DEAPrev1']);
	$DEAPrev2=kontrola($_POST['DEAPrev2']);
	$DEAOpat1=kontrola($_POST['DEAOpat1']);
	$DEAOpat2=kontrola($_POST['DEAOpat2']);

	if ($DEADopad1) $DEADopad1="1";else $DEADopad1="0";
	if ($DEADopad2) $DEADopad2="1";else $DEADopad2="0";
	if ($DEADopad3) $DEADopad3="1";else $DEADopad3="0";
	if ($DEADopad4) $DEADopad4="1";else $DEADopad4="0";
	if ($DEADopad5) $DEADopad5="1";else $DEADopad5="0";
	if ($DEADopad6) $DEADopad6="1";else $DEADopad6="0";

	if (($DEAVyzn1<1)and($DEAVyzn1>3)) $DEAVyzn1=1;
	if (($DEAVyzn2<1)and($DEAVyzn2>3)) $DEAVyzn2=1;
	if (($DEAVyzn3<1)and($DEAVyzn3>3)) $DEAVyzn3=1;
	if (($DEAVyzn4<1)and($DEAVyzn4>3)) $DEAVyzn4=1;
	if (($DEAVyzn5<1)and($DEAVyzn5>3)) $DEAVyzn5=1;
	if (($DEAVyzn6<1)and($DEAVyzn6>3)) $DEAVyzn6=1;
	if (($DEAVyzn7<1)and($DEAVyzn7>3)) $DEAVyzn7=1;
	if (($DEAVyzn8<1)and($DEAVyzn8>3)) $DEAVyzn8=1;

	$DEAVyzn=$DEAVyzn1.$DEAVyzn2.$DEAVyzn3.$DEAVyzn4.$DEAVyzn5.$DEAVyzn6.$DEAVyzn7.$DEAVyzn8;
	$DEADopad=$DEADopad1.$DEADopad2.$DEADopad3.$DEADopad4.$DEADopad5.$DEADopad6;


	$DEALimH=sprintf ("%01.2f", $DEALimH);
	if ($DEALimH==0) $DEALimH="";


	$DEAVaha1=kontrola($_POST['DEAVaha1']);
	$DEAVaha2=kontrola($_POST['DEAVaha2']);
	$DEAVaha3=kontrola($_POST['DEAVaha3']);
	$DEAVaha4=kontrola($_POST['DEAVaha4']);
	$DEAVaha5=kontrola($_POST['DEAVaha5']);
	$DEAVaha6=kontrola($_POST['DEAVaha6']);
	$DEAVaha7=kontrola($_POST['DEAVaha7']);
	$DEAVaha8=kontrola($_POST['DEAVaha8']);

	if (($DEAVaha1<1)and($DEAVaha1>3)) $DEAVaha1=1;
	if (($DEAVaha2<1)and($DEAVaha2>3)) $DEAVaha2=1;
	if (($DEAVaha3<1)and($DEAVaha3>3)) $DEAVaha3=1;
	if (($DEAVaha4<1)and($DEAVaha4>3)) $DEAVaha4=1;
	if (($DEAVaha5<1)and($DEAVaha5>3)) $DEAVaha5=1;
	if (($DEAVaha6<1)and($DEAVaha6>3)) $DEAVaha6=1;
	if (($DEAVaha7<1)and($DEAVaha7>3)) $DEAVaha7=1;
	if (($DEAVaha8<1)and($DEAVaha8>3)) $DEAVaha8=1;

	$DEAVaha=$DEAVaha1.$DEAVaha2.$DEAVaha3.$DEAVaha4.$DEAVaha5.$DEAVaha6.$DEAVaha7.$DEAVaha8;


	$DEACelk=$DEAVaha1*$DEAVyzn1+$DEAVaha2*$DEAVyzn2+$DEAVaha3*$DEAVyzn3+$DEAVaha4*$DEAVyzn4+$DEAVaha5*$DEAVyzn5+$DEAVaha6*$DEAVyzn6+$DEAVaha7*$DEAVyzn7+$DEAVaha8*$DEAVyzn8;
	$DOK=kontrola($_POST['DOK']);
	$MNK=kontrola($_POST['MNK']);
	$DEACetn=kontrola($_POST['DEACetn']);
	$DEANamH=kontrola($_POST['DEANamH']);

	$SKLIC=strtoupper (kontrola($_POST['SKLIC']));
	$CKLIC=strtoupper (kontrola($_POST['CKLIC']));
	$temp_cinnost=strtoupper (kontrola($_POST['temp_cinnost']));

	$chyba=0;
	$aspektu=mysql_result(mysql_query("SELECT count(*) FROM DbEAs where klic='".$klic."'",$connect2),0);

	if (!$aspektu) {
		echo "<h1><font color=red>Chyba ! Kód položky nebyl nalezen !</font></h1>";
		$chyba=1;
	}
	if (!$DEAKod) {
		echo "<h1><font color=red>Chyba ! Kód aspektu nesmí být prázdný !</font></h1>";
		$chyba=1;
	}
	if (!$DEAAsp1) {
		echo "<h1><font color=red>Chyba ! Název aspektu nesmí být prázdný !</font></h1>";
		$chyba=1;
	}
	if (!$chyba){ 
		mysql_query("REPLACE INTO `DbEAs` ( `klic`,`DEAStat` , `DEAKod` , `DEAAsp1` , `DEAAsp2` , `DEAUtv` , `DEAZar` , `DEAPolut1` , `DEAPolut2` , `DEADopad` , `DEALimH` , `DEAMJ` , `DEAOdp` , `DEAPredp` , `DEARiz` , `DEAVyzn` , `DEADokl` , `DEAPrev1` , `DEAPrev2` , `DEAOpat1` , `DEAOpat2` , `DEARes` , `DOK`, `MNK`, `DEAVaha`, `DEACelk`, `DEANamH`, `DEACetn`, `DEARes2`, `CKLIC`, `SKLIC`, `temp_cinnost`) 
VALUES ('$klic',
'$DEAStat', '$DEAKod', '$DEAAsp1', '$DEAAsp2', '$DEAUtv', '$DEAZar', '$DEAPolut1', '$DEAPolut2', '$DEADopad', '$DEALimH', '$DEAMJ', '$DEAOdp', '$DEAPredp', '$DEARiz', '$DEAVyzn', '$DEADokl', '$DEAPrev1', '$DEAPrev2', '$DEAOpat1', '$DEAOpat2', '$DEARes', '$DOK', '$MNK', '$DEAVaha', '$DEACelk', '$DEANamH', '$DEACetn', '$DEARes2', '$CKLIC', '$SKLIC', '$temp_cinnost'
);",$connect2);
		echo "<h1><font color=green>Zmìny položky byly úspìšnì uloženy do databáze !</font></h1><hr>";
		$status=0;
	}else 	echo '<center><input type=button onclick="history.back()" value="Zpìt"></center>';


}


// Editace položky - formular
if ($status==6){

	$id = kontrola($_GET['id']);
	$klic = $id;

	$getclanek = mysql_query("SELECT * FROM DbEAs where klic='$id'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){


		$DEAKod=$clanky['DEAKod'];
	
		$DEAAsp1=$clanky['DEAAsp1'];
		$DEAAsp2=$clanky['DEAAsp2'];
		$DEAUtv=$clanky['DEAUtv'];
		$DEAZar=$clanky['DEAZar'];
		$DEAPolut1=$clanky['DEAPolut1'];
		$DEAPolut2=$clanky['DEAPolut2'];
		$DEADopad=$clanky['DEADopad'];

		$DEADopad=str_split($DEADopad);

		$DEALimH=$clanky['DEALimH'];
		$DEAMJ=$clanky['DEAMJ'];
		$DEAPredp=$clanky['DEAPredp'];
		$DEARiz=$clanky['DEARiz'];
		$DEAVyzn=$clanky['DEAVyzn'];
		$DEAVaha=$clanky['DEAVaha'];
		$DEACelk=$clanky['DEACelk'];
		$hodnota=$DEACelk;
		$DEAVyzn=str_split($DEAVyzn);

		$DEAVaha=str_split($DEAVaha);


		$DEADokl=$clanky['DEADokl'];
		$DEAPrev1=$clanky['DEAPrev1'];
		$DEAPrev2=$clanky['DEAPrev2'];
		$DEAOpat1=$clanky['DEAOpat1'];
		$DEAOpat2=$clanky['DEAOpat2'];
		$DEAOdp=$clanky['DEAOdp'];

		$DOK=$clanky['DOK'];
		$MNK=$clanky['MNK'];
		$DEACetn=$clanky['DEACetn'];
		$DEANamH=$clanky['DEANamH'];

		$SKLIC=$clanky['SKLIC'];
		$CKLIC=$clanky['CKLIC'];
		$temp_cinnost=$clanky['temp_cinnost'];
	}

?>
<script type="text/javascript">
function calculate(){
	hodnota=window.document.getElementById("Vaha1").value*window.document.getElementById("Vyzn1").value+window.document.getElementById("Vaha2").value*window.document.getElementById("Vyzn2").value+window.document.getElementById("Vaha3").value*window.document.getElementById("Vyzn3").value+window.document.getElementById("Vaha4").value*window.document.getElementById("Vyzn4").value+window.document.getElementById("Vaha5").value*window.document.getElementById("Vyzn5").value+window.document.getElementById("Vaha6").value*window.document.getElementById("Vyzn6").value+window.document.getElementById("Vaha7").value*window.document.getElementById("Vyzn7").value+window.document.getElementById("Vaha8").value*window.document.getElementById("Vyzn8").value;
	window.document.getElementById("DEACelkS").innerHTML="<b>"+hodnota+"</b>";
	window.document.getElementById("DEACelk").value=hodnota;

}
</script>
<form  name="form4" ACTION='./environmentalni-aspekty' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="601">
<input type="hidden" name="DEACelk" value="<?php echo $DEACelk;?>">
<input type="hidden" name="klic" value="<?php echo $klic;?>">
<h2><font color="green">Editace polžky:</font></h2>
<table>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1"><b><em>Environmentalní aspekt:</em></b></td><td class="row1"><a href="vyber-aspektu" target="_blank">Vybrat aspekt :::</a></td></tr>
<tr><td class="row2">Kód aspektu:</td><td class="row2"><input type="text" value="<?php echo $DEAKod;?>" name="DEAKod" MAXLENGTH="4"  size="4"></td></tr>
<tr><td class="row1"><b>Aspekt:</b></td><td class="row1"><input type="text" value="<?php echo $DEAAsp1;?>" name="DEAAsp1" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row1"></td><td class="row1"><input type="text" value="<?php echo $DEAAsp2;?>" name="DEAAsp2" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2">Útvar HS:</td><td class="row2"><input type="text" value="<?php echo $DEAUtv;?>" name="DEAUtv" MAXLENGTH="15"  size="15"></td></tr>
<tr><td class="row1">Zaøízení:</td><td class="row1"><input type="text" value="<?php echo $DEAZar;?>" name="DEAZar" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2">Polutanty:</td><td class="row2"><input type="text" value="<?php echo $DEAPolut1;?>" name="DEAPolut1" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2"></td><td class="row2"><input type="text" value="<?php echo $DEAPolut2;?>" name="DEAPolut2" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row1">Limitní hodnota:</td><td class="row1"><input type="text" value="<?php echo $DEALimH;?>" name="DEALimH" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">m.j. limit. hodnoty</td><td class="row2"><input type="text" value="<?php echo $DEAMJ;?>" name="DEAMJ" MAXLENGTH="7"  size="7"></td></tr>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1" colspan="2"><b><em>Dopad na životní prostøedí:</em></b></td></tr>
<tr><td class="row2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;èlovìk</td><td class="row2"><input type="checkbox" value="1" name="DEADopad1" <?php if($DEADopad[0]==1) echo ' checked="checked"';?>></td></tr>
<tr><td class="row1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ovzduší</td><td class="row1"><input type="checkbox" value="1" name="DEADopad2" <?php if($DEADopad[1]==1) echo ' checked="checked"';?>></td></tr>
<tr><td class="row2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;voda</td><td class="row2"><input type="checkbox" value="1" name="DEADopad3" <?php if($DEADopad[2]==1) echo ' checked="checked"';?>></td></tr>
<tr><td class="row1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pùda</td><td class="row1"><input type="checkbox" value="1" name="DEADopad4" <?php if($DEADopad[3]==1) echo ' checked="checked"';?>></td></tr>
<tr><td class="row2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;prac. prostøedí</td><td class="row2"><input type="checkbox" value="1" name="DEADopad5" <?php if($DEADopad[4]==1) echo ' checked="checked"';?>></td></tr>
<tr><td class="row1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;jiné</td><td class="row1"><input type="checkbox" value="1" name="DEADopad6" <?php if($DEADopad[5]==1) echo ' checked="checked"';?>></td></tr>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row2">Pøedpis:</td><td class="row2"><input type="text" value="<?php echo $DEAPredp;?>" name="DEAPredp" MAXLENGTH="31"  size="31"></td></tr>
<tr><td class="row1">Zpùsob øízení:</td><td class="row1"><input type="text" value="<?php echo $DEARiz;?>" name="DEARiz" MAXLENGTH="31"  size="31"></td></tr>
<tr><td class="row2">Opatøení:</td><td class="row2"><input type="text" value="<?php echo $DEAOpat1;?>" name="DEAOpat1" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2"></td><td class="row2"><input type="text" value="<?php echo $DEAOpat2;?>" name="DEAOpat2" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row1">Odpovìdnost:</td><td class="row1"><input type="text" value="<?php echo $DEAOdp;?>" name="DEAOdp" MAXLENGTH="19"  size="19"></td></tr>
<tr><td class="row2">Doklad:</td><td class="row2"><input type="text" value="<?php echo $DEADokl;?>" name="DEADokl" MAXLENGTH="19"  size="19"></td></tr>
<tr><td class="row1">Kontrola:</td><td class="row1"><input type="text" value="<?php echo $DEAPrev1;?>" name="DEAPrev1" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2">Èetnost:</td><td class="row2"><input type="text" value="<?php echo $DEAPrev2;?>" name="DEAPrev2" MAXLENGTH="27"  size="27"></td></tr>


<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1"><b><em>Stavební èinnost:</em></b></td><td class="row1"><a href="vyber-cinnosti" target="_blank">Vybrat èinnost :::</a></td></tr>
<tr><td class="row2">Èíselní klíè:</td><td class="row2"><input type="text" value="<?php echo $CKLIC;?>" name="CKLIC" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row1">Zkratka</td><td class="row1"><input type="text" value="<?php echo $SKLIC;?>" name="SKLIC" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row2"><b>Název èinnosti:</b></td><td class="row1"><input type="text" value="<?php echo $temp_cinnost;?>" name="temp_cinnost" MAXLENGTH="24"  size="24"></td></tr>

<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1" colspan="2"><b><em>Kritéria a ohodnocení jejich závažnosti:</em></b></td></tr>

<tr><td class="row1" colspan="2" align="center">
<table><tr><td class="row1" width="300px">Kritéria</td><td class="row1" width="100px">Závažnost</td><td class="row1" width="100px">Váha</td></tr>

<tr><td class="row2">&nbsp;&nbsp;Soulad s právními požadavky</td><td class="row2"><select name="DEAVyzn1" onChange="calculate();" id="Vyzn1"><option value="<?php echo $DEAVyzn[0];?>"><?php echo $DEAVyzn[0];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row2"><select name="DEAVaha1" onChange="calculate();" id="Vaha1"><option value="<?php echo $DEAVaha[0];?>"><?php echo $DEAVaha[0];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row1">&nbsp;&nbsp;Vliv na životní pøostøedí</td><td class="row1"><select name="DEAVyzn2" onChange="calculate();" id="Vyzn2"><option value="<?php echo $DEAVyzn[1];?>"><?php echo $DEAVyzn[1];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row1"><select name="DEAVaha2" onChange="calculate();" id="Vaha2"><option value="<?php echo $DEAVaha[1];?>"><?php echo $DEAVaha[1];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row2">&nbsp;&nbsp;Èetnost (pravdìpod.) výskytu</td><td class="row2"><select name="DEAVyzn3" onChange="calculate();" id="Vyzn3"><option value="<?php echo $DEAVyzn[2];?>"><?php echo $DEAVyzn[2];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row2"><select name="DEAVaha3" onChange="calculate();" id="Vaha3"><option value="<?php echo $DEAVaha[2];?>"><?php echo $DEAVaha[2];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row1">&nbsp;&nbsp;Doba (trvání) dopadu</td><td class="row1"><select name="DEAVyzn4" onChange="calculate();" id="Vyzn4"><option value="<?php echo $DEAVyzn[3];?>"><?php echo $DEAVyzn[3];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row1"><select name="DEAVaha4" onChange="calculate();" id="Vaha4"><option value="<?php echo $DEAVaha[3];?>"><?php echo $DEAVaha[3];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row2">&nbsp;&nbsp;Náklady spojené s dopadem</td><td class="row2"><select name="DEAVyzn5" onChange="calculate();" id="Vyzn5"><option value="<?php echo $DEAVyzn[4];?>"><?php echo $DEAVyzn[4];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row2"><select name="DEAVaha5" onChange="calculate();" id="Vaha5"><option value="<?php echo $DEAVaha[4];?>"><?php echo $DEAVaha[4];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row1">&nbsp;&nbsp;Náklady sankèního postíhu</td><td class="row1"><select name="DEAVyzn6" onChange="calculate();" id="Vyzn6"><option value="<?php echo $DEAVyzn[5];?>"><?php echo $DEAVyzn[5];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row1"><select name="DEAVaha6" onChange="calculate();" id="Vaha6"><option value="<?php echo $DEAVaha[5];?>"><?php echo $DEAVaha[5];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row2">&nbsp;&nbsp;Pøipomínky veøejnosti</td><td class="row2"><select name="DEAVyzn7" onChange="calculate();" id="Vyzn7"><option value="<?php echo $DEAVyzn[6];?>"><?php echo $DEAVyzn[6];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row2"><select name="DEAVaha7" onChange="calculate();" id="Vaha7"><option value="<?php echo $DEAVaha[6];?>"><?php echo $DEAVaha[6];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row1">&nbsp;&nbsp;Stížnosti zamìstnancù</td><td class="row1"><select name="DEAVyzn8" onChange="calculate();" id="Vyzn8"><option value="<?php echo $DEAVyzn[7];?>"><?php echo $DEAVyzn[7];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row1"><select name="DEAVaha8" onChange="calculate();" id="Vaha8"><option value="<?php echo $DEAVaha[7];?>"><?php echo $DEAVaha[7];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>
</table>
</td></tr>


<tr><td class="row2"><b>Výsledná významnost aspektu:</b></td><td class="row2"><span id="DEACelkS"><b><?php echo $hodnota;?></b></span></td></tr>
<tr><td class="row1">Èetnost mìøení:</td><td class="row1"><input type="text" value="<?php echo $DEACetn;?>" name="DEACetn" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row2">Procento dokonèení èinnosti pro 1. kontrolu aspektu:</td><td class="row2"><input type="text" value="<?php echo $DOK;?>" name="DOK" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row1">Množství mìrných jednotek produktu na 1 kontrolu aspektu:</td><td class="row1"><input type="text" value="<?php echo $MNK;?>" name="MNK" MAXLENGTH="5"  size="5"></td></tr>


<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Uložit zmìny">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zpìt"></td></tr>
</table>
</form>
<?php
}

// Karta aspektu - nahled
if ($status==7){

	$id = kontrola($_GET['id']);

	$getclanek = mysql_query("SELECT * FROM DbEAs where klic='$id'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){

		$klic=$clanky['klic'];

		$DEAKod=$clanky['DEAKod'];
	
		$DEAAsp1=$clanky['DEAAsp1'];
		$DEAAsp2=$clanky['DEAAsp2'];
		$DEAUtv=$clanky['DEAUtv'];
		$DEAZar=$clanky['DEAZar'];
		$DEAPolut1=$clanky['DEAPolut1'];
		$DEAPolut2=$clanky['DEAPolut2'];
		$DEADopad=$clanky['DEADopad'];

		$DEADopad=str_split($DEADopad);

		$DEALimH=$clanky['DEALimH'];
		$DEAMJ=$clanky['DEAMJ'];
		$DEAPredp=$clanky['DEAPredp'];
		$DEARiz=$clanky['DEARiz'];
		$DEAVyzn=$clanky['DEAVyzn'];
		$DEAVaha=$clanky['DEAVaha'];
		$DEACelk=$clanky['DEACelk'];

		$DEAVyzn=str_split($DEAVyzn);

		$DEAVaha=str_split($DEAVaha);


		$DEADokl=$clanky['DEADokl'];
		$DEAPrev1=$clanky['DEAPrev1'];
		$DEAPrev2=$clanky['DEAPrev2'];
		$DEAOpat1=$clanky['DEAOpat1'];
		$DEAOpat2=$clanky['DEAOpat2'];
		if ($row==1) $row=2;else $row=1;
		$DEAOdp=$clanky['DEAOdp'];

		$DOK=$clanky['DOK'];
		$MNK=$clanky['MNK'];
		$DEACetn=$clanky['DEACetn'];
		$DEANamH=$clanky['DEANamH'];

		$SKLIC=$clanky['SKLIC'];
		$CKLIC=$clanky['CKLIC'];
		$temp_cinnost=$clanky['temp_cinnost'];

	}

?>
<h2><font color="green">Karta položky dastabáze aspektù:</font></h2><hr>
<table>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1" colspan="2"><b><em>Stavební èinnost:</em></b></td></tr>
<tr><td class="row2">Èíselný klíè:</td><td class="row2"><b><?php echo $CKLIC;?></b></td></tr>
<tr><td class="row1">Zkratka:</td><td class="row1"><?php echo $SKLIC;?></td></tr>
<tr><td class="row2"><b>Název èinnosti:</b></td><td class="row2"><b><?php echo $temp_cinnost;?></b></td></tr>
<tr><td class="row1" colspan="2"><hr></td></tr>
<tr><td class="row1" colspan="2"><b><em>Environmentální aspekt:</em></b></td></tr>
<tr><td class="row2"><b>Kód aspektu:</b></td><td class="row2"><b><?php echo $DEAKod;?></b></td></tr>
<tr><td class="row1"><b>Aspekt:</b></td><td class="row1"><b><?php echo $DEAAsp1;?></b></td></tr>
<tr><td class="row1"></td><td class="row1"><?php echo $DEAAsp2;?></td></tr>
<tr><td class="row2">Útvar HS:</td><td class="row2"><?php echo $DEAUtv;?></td></tr>
<tr><td class="row1">Zaøízení:</td><td class="row1"><?php echo $DEAZar;?></td></tr>
<tr><td class="row2">Polutanty:</td><td class="row2"><?php echo $DEAPolut1;?></td></tr>
<tr><td class="row2"></td><td class="row2"><?php echo $DEAPolut2;?></td></tr>
<tr><td class="row1">Limitní hodnota:</td><td class="row1"><?php echo $DEALimH;?></td></tr>
<tr><td class="row2">m.j. limit. hodnoty</td><td class="row2"><?php echo $DEAMJ;?></td></tr>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1" colspan="2"><b><em>Dopad na životní prostøedí:</em></b></td></tr>
<tr><td class="row1" colspan="2" align="center">
<table>
<tr><td class="row2" width="200px">&nbsp;&nbsp;èlovìk</td><td class="row2" width="100px" align="center"><?php if($DEADopad[0]==1) echo "<em>Ano</em>"; else echo "<em>Ne</em>";?></td></tr>
<tr><td class="row1">&nbsp;&nbsp;ovzduší</td><td class="row1" width="100px" align="center"><?php if($DEADopad[1]==1) echo "<em>Ano</em>"; else echo "<em>Ne</em>";?></td></tr>
<tr><td class="row2">&nbsp;&nbsp;voda</td><td class="row2" width="100px" align="center"><?php if($DEADopad[2]==1) echo "<em>Ano</em>"; else echo "<em>Ne</em>";?></td></tr>
<tr><td class="row1">&nbsp;&nbsp;pùda</td><td class="row1" width="100px" align="center"><?php if($DEADopad[3]==1) echo "<em>Ano</em>"; else echo "<em>Ne</em>";?></td></tr>
<tr><td class="row2">&nbsp;&nbsp;prac. prostøedí</td><td class="row2" width="100px" align="center"><?php if($DEADopad[4]==1) echo "<em>Ano</em>"; else echo "<em>Ne</em>";?></td></tr>
<tr><td class="row1">&nbsp;&nbsp;jiné</td><td class="row1" width="100px" align="center"><?php if($DEADopad[5]==1) echo "<em>Ano</em>"; else echo "<em>Ne</em>";?></td></tr>
</table>
</td></tr>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row2">Pøedpis:</td><td class="row2"><?php echo $DEAPredp;?></td></tr>
<tr><td class="row1">Zpùsob øízení:</td><td class="row1"><?php echo $DEARiz;?></td></tr>
<tr><td class="row2">Opatøení:</td><td class="row2"><?php echo $DEAOpat1;?></td></tr>
<tr><td class="row2"></td><td class="row2"><?php echo $DEAOpat2;?></td></tr>
<tr><td class="row1">Odpovìdnost:</td><td class="row1"><?php echo $DEAOdp;?></td></tr>
<tr><td class="row2">Doklad:</td><td class="row2"><?php echo $DEADokl;?></td></tr>
<tr><td class="row1">Kontrola:</td><td class="row1"><?php echo $DEAPrev1;?></td></tr>
<tr><td class="row2">Èetnost:</td><td class="row2"><?php echo $DEAPrev2;?></td></tr>
<tr><td class="row1" colspan="2"><hr></td></tr>
<tr><td class="row1" colspan="2"><b><em>Významnost:</em></b></td></tr>
<tr><td class="row1" colspan="2" align="center">
<table>
<tr><td class="row1" width="300px"><em></em></td><td class="row1" width="100px"><em>Závažnost</em></td><td class="row1" width="100px"><em>Váha</em></td></tr>
<tr><td class="row2">&nbsp;&nbsp;Soulad s právními požadavky</td><td class="row2" align="center"><?php echo $DEAVyzn[0];?></td><td class="row2" align="center"><?php echo $DEAVaha[0];?></td></tr>
<tr><td class="row1">&nbsp;&nbsp;Vliv na životní pøostøedí</td><td class="row1" align="center"><?php echo $DEAVyzn[1];?></td><td class="row1" align="center"><?php echo $DEAVaha[1];?></td></tr>
<tr><td class="row2">&nbsp;&nbsp;Èetnost (pravdìpod.) výskytu</td><td class="row2" align="center"><?php echo $DEAVyzn[2];?></td><td class="row2" align="center"><?php echo $DEAVaha[2];?></td></tr>
<tr><td class="row1">&nbsp;&nbsp;Doba (trvání) dopadu</td><td class="row1" align="center"><?php echo $DEAVyzn[3];?></td><td class="row1" align="center"><?php echo $DEAVaha[3];?></td></tr>
<tr><td class="row2">&nbsp;&nbsp;Náklady spojené s dopadem</td><td class="row2" align="center"><?php echo $DEAVyzn[4];?></td><td class="row2" align="center"><?php echo $DEAVaha[4];?></td></tr>
<tr><td class="row1">&nbsp;&nbsp;Náklady sankèního postíhu</td><td class="row1" align="center"><?php echo $DEAVyzn[5];?></td><td class="row1" align="center"><?php echo $DEAVaha[5];?></td></tr>
<tr><td class="row2">&nbsp;&nbsp;Pøipomínky veøejnosti</td><td class="row2" align="center"><?php echo $DEAVyzn[6];?></td><td class="row2" align="center"><?php echo $DEAVaha[6];?></td></tr>
<tr><td class="row1">&nbsp;&nbsp;Stížnosti zamìstnancù</td><td class="row1" align="center"><?php echo $DEAVyzn[7];?></td><td class="row1" align="center"><?php echo $DEAVaha[7];?></td></tr>
</table></td></tr>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row2">Výsledná významnost aspektu:</td><td class="row2"><b><?php echo $DEACelk;?></b></td></tr>
<tr><td class="row1">Èetnost mìøení:</td><td class="row1"><?php echo $DEACetn;?></td></tr>
<tr><td class="row2">Procento dokonèení èinnosti pro 1. kontrolu aspektu:</td><td class="row2"><?php echo $DOK;?></td></tr>
<tr><td class="row1">Množství mìrných jednotek produktu na 1 kontrolu aspektu:</td><td class="row1"><?php echo $MNK;?></td></tr>
<tr><td class="row1" colspan="2" align="center"><hr><input type=button onclick="history.back()" value="Zpìt"></td></tr>
</table>
<?php
}


// Kopirovani aspektu - formular
if ($status==8){


	$id = kontrola($_GET['id']);
	$klic = $id;

	$getclanek = mysql_query("SELECT * FROM DbEAs where klic='$id'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){


		$DEAKod=$clanky['DEAKod'];
	
		$DEAAsp1=$clanky['DEAAsp1'];
		$DEAAsp2=$clanky['DEAAsp2'];
		$DEAUtv=$clanky['DEAUtv'];
		$DEAZar=$clanky['DEAZar'];
		$DEAPolut1=$clanky['DEAPolut1'];
		$DEAPolut2=$clanky['DEAPolut2'];
		$DEADopad=$clanky['DEADopad'];

		$DEADopad=str_split($DEADopad);

		$DEALimH=$clanky['DEALimH'];
		$DEAMJ=$clanky['DEAMJ'];
		$DEAPredp=$clanky['DEAPredp'];
		$DEARiz=$clanky['DEARiz'];
		$DEAVyzn=$clanky['DEAVyzn'];
		$DEAVaha=$clanky['DEAVaha'];
		$DEACelk=$clanky['DEACelk'];
		$hodnota=$DEACelk;
		$DEAVyzn=str_split($DEAVyzn);

		$DEAVaha=str_split($DEAVaha);


		$DEADokl=$clanky['DEADokl'];
		$DEAPrev1=$clanky['DEAPrev1'];
		$DEAPrev2=$clanky['DEAPrev2'];
		$DEAOpat1=$clanky['DEAOpat1'];
		$DEAOpat2=$clanky['DEAOpat2'];
		$DEAOdp=$clanky['DEAOdp'];

		$DOK=$clanky['DOK'];
		$MNK=$clanky['MNK'];
		$DEACetn=$clanky['DEACetn'];
		$DEANamH=$clanky['DEANamH'];

		$SKLIC=$clanky['SKLIC'];
		$CKLIC=$clanky['CKLIC'];
		$temp_cinnost=$clanky['temp_cinnost'];
	}

?>
<script type="text/javascript">
function calculate(){
	hodnota=window.document.getElementById("Vaha1").value*window.document.getElementById("Vyzn1").value+window.document.getElementById("Vaha2").value*window.document.getElementById("Vyzn2").value+window.document.getElementById("Vaha3").value*window.document.getElementById("Vyzn3").value+window.document.getElementById("Vaha4").value*window.document.getElementById("Vyzn4").value+window.document.getElementById("Vaha5").value*window.document.getElementById("Vyzn5").value+window.document.getElementById("Vaha6").value*window.document.getElementById("Vyzn6").value+window.document.getElementById("Vaha7").value*window.document.getElementById("Vyzn7").value+window.document.getElementById("Vaha8").value*window.document.getElementById("Vyzn8").value;
	window.document.getElementById("DEACelkS").innerHTML="<b>"+hodnota+"</b>";
	window.document.getElementById("DEACelk").value=hodnota;

}
</script>
<form  name="form4" ACTION='./environmentalni-aspekty' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="101">
<input type="hidden" name="DEACelk" value="<?php echo $DEACelk;?>">
<input type="hidden" name="klic" value="<?php echo $klic;?>">
<h2><font color="green">Kopirování položky:</font></h2>
<table>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1"><b><em>Environmentalní aspekt:</em></b></td><td class="row1"><a href="vyber-aspektu" target="_blank">Vybrat aspekt :::</a></td></tr>
<tr><td class="row2">Kód aspektu:</td><td class="row2"><input type="text" value="<?php echo $DEAKod;?>" name="DEAKod" MAXLENGTH="4"  size="4"></td></tr>
<tr><td class="row1"><b>Aspekt:</b></td><td class="row1"><input type="text" value="<?php echo $DEAAsp1;?>" name="DEAAsp1" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row1"></td><td class="row1"><input type="text" value="<?php echo $DEAAsp2;?>" name="DEAAsp2" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2">Útvar HS:</td><td class="row2"><input type="text" value="<?php echo $DEAUtv;?>" name="DEAUtv" MAXLENGTH="15"  size="15"></td></tr>
<tr><td class="row1">Zaøízení:</td><td class="row1"><input type="text" value="<?php echo $DEAZar;?>" name="DEAZar" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2">Polutanty:</td><td class="row2"><input type="text" value="<?php echo $DEAPolut1;?>" name="DEAPolut1" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2"></td><td class="row2"><input type="text" value="<?php echo $DEAPolut2;?>" name="DEAPolut2" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row1">Limitní hodnota:</td><td class="row1"><input type="text" value="<?php echo $DEALimH;?>" name="DEALimH" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">m.j. limit. hodnoty</td><td class="row2"><input type="text" value="<?php echo $DEAMJ;?>" name="DEAMJ" MAXLENGTH="7"  size="7"></td></tr>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1" colspan="2"><b><em>Dopad na životní prostøedí:</em></b></td></tr>
<tr><td class="row2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;èlovìk</td><td class="row2"><input type="checkbox" value="1" name="DEADopad1" <?php if($DEADopad[0]==1) echo ' checked="checked"';?>></td></tr>
<tr><td class="row1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ovzduší</td><td class="row1"><input type="checkbox" value="1" name="DEADopad2" <?php if($DEADopad[1]==1) echo ' checked="checked"';?>></td></tr>
<tr><td class="row2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;voda</td><td class="row2"><input type="checkbox" value="1" name="DEADopad3" <?php if($DEADopad[2]==1) echo ' checked="checked"';?>></td></tr>
<tr><td class="row1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pùda</td><td class="row1"><input type="checkbox" value="1" name="DEADopad4" <?php if($DEADopad[3]==1) echo ' checked="checked"';?>></td></tr>
<tr><td class="row2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;prac. prostøedí</td><td class="row2"><input type="checkbox" value="1" name="DEADopad5" <?php if($DEADopad[4]==1) echo ' checked="checked"';?>></td></tr>
<tr><td class="row1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;jiné</td><td class="row1"><input type="checkbox" value="1" name="DEADopad6" <?php if($DEADopad[5]==1) echo ' checked="checked"';?>></td></tr>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row2">Pøedpis:</td><td class="row2"><input type="text" value="<?php echo $DEAPredp;?>" name="DEAPredp" MAXLENGTH="31"  size="31"></td></tr>
<tr><td class="row1">Zpùsob øízení:</td><td class="row1"><input type="text" value="<?php echo $DEARiz;?>" name="DEARiz" MAXLENGTH="31"  size="31"></td></tr>
<tr><td class="row2">Opatøení:</td><td class="row2"><input type="text" value="<?php echo $DEAOpat1;?>" name="DEAOpat1" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2"></td><td class="row2"><input type="text" value="<?php echo $DEAOpat2;?>" name="DEAOpat2" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row1">Odpovìdnost:</td><td class="row1"><input type="text" value="<?php echo $DEAOdp;?>" name="DEAOdp" MAXLENGTH="19"  size="19"></td></tr>
<tr><td class="row2">Doklad:</td><td class="row2"><input type="text" value="<?php echo $DEADokl;?>" name="DEADokl" MAXLENGTH="19"  size="19"></td></tr>
<tr><td class="row1">Kontrola:</td><td class="row1"><input type="text" value="<?php echo $DEAPrev1;?>" name="DEAPrev1" MAXLENGTH="27"  size="27"></td></tr>
<tr><td class="row2">Èetnost:</td><td class="row2"><input type="text" value="<?php echo $DEAPrev2;?>" name="DEAPrev2" MAXLENGTH="27"  size="27"></td></tr>


<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1"><b><em>Stavební èinnost:</em></b></td><td class="row1"><a href="vyber-cinnosti" target="_blank">Vybrat èinnost :::</a></td></tr>
<tr><td class="row2">Èíselní klíè:</td><td class="row2"><input type="text" value="<?php echo $CKLIC;?>" name="CKLIC" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row1">Zkratka</td><td class="row1"><input type="text" value="<?php echo $SKLIC;?>" name="SKLIC" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row2"><b>Název èinnosti:</b></td><td class="row1"><input type="text" value="<?php echo $temp_cinnost;?>" name="temp_cinnost" MAXLENGTH="24"  size="24"></td></tr>

<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1" colspan="2"><b><em>Kritéria a ohodnocení jejich závažnosti:</em></b></td></tr>

<tr><td class="row1" colspan="2" align="center">
<table><tr><td class="row1" width="300px">Kritéria</td><td class="row1" width="100px">Závažnost</td><td class="row1" width="100px">Váha</td></tr>

<tr><td class="row2">&nbsp;&nbsp;Soulad s právními požadavky</td><td class="row2"><select name="DEAVyzn1" onChange="calculate();" id="Vyzn1"><option value="<?php echo $DEAVyzn[0];?>"><?php echo $DEAVyzn[0];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row2"><select name="DEAVaha1" onChange="calculate();" id="Vaha1"><option value="<?php echo $DEAVaha[0];?>"><?php echo $DEAVaha[0];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row1">&nbsp;&nbsp;Vliv na životní pøostøedí</td><td class="row1"><select name="DEAVyzn2" onChange="calculate();" id="Vyzn2"><option value="<?php echo $DEAVyzn[1];?>"><?php echo $DEAVyzn[1];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row1"><select name="DEAVaha2" onChange="calculate();" id="Vaha2"><option value="<?php echo $DEAVaha[1];?>"><?php echo $DEAVaha[1];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row2">&nbsp;&nbsp;Èetnost (pravdìpod.) výskytu</td><td class="row2"><select name="DEAVyzn3" onChange="calculate();" id="Vyzn3"><option value="<?php echo $DEAVyzn[2];?>"><?php echo $DEAVyzn[2];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row2"><select name="DEAVaha3" onChange="calculate();" id="Vaha3"><option value="<?php echo $DEAVaha[2];?>"><?php echo $DEAVaha[2];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row1">&nbsp;&nbsp;Doba (trvání) dopadu</td><td class="row1"><select name="DEAVyzn4" onChange="calculate();" id="Vyzn4"><option value="<?php echo $DEAVyzn[3];?>"><?php echo $DEAVyzn[3];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row1"><select name="DEAVaha4" onChange="calculate();" id="Vaha4"><option value="<?php echo $DEAVaha[3];?>"><?php echo $DEAVaha[3];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row2">&nbsp;&nbsp;Náklady spojené s dopadem</td><td class="row2"><select name="DEAVyzn5" onChange="calculate();" id="Vyzn5"><option value="<?php echo $DEAVyzn[4];?>"><?php echo $DEAVyzn[4];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row2"><select name="DEAVaha5" onChange="calculate();" id="Vaha5"><option value="<?php echo $DEAVaha[4];?>"><?php echo $DEAVaha[4];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row1">&nbsp;&nbsp;Náklady sankèního postíhu</td><td class="row1"><select name="DEAVyzn6" onChange="calculate();" id="Vyzn6"><option value="<?php echo $DEAVyzn[5];?>"><?php echo $DEAVyzn[5];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row1"><select name="DEAVaha6" onChange="calculate();" id="Vaha6"><option value="<?php echo $DEAVaha[5];?>"><?php echo $DEAVaha[5];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row2">&nbsp;&nbsp;Pøipomínky veøejnosti</td><td class="row2"><select name="DEAVyzn7" onChange="calculate();" id="Vyzn7"><option value="<?php echo $DEAVyzn[6];?>"><?php echo $DEAVyzn[6];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row2"><select name="DEAVaha7" onChange="calculate();" id="Vaha7"><option value="<?php echo $DEAVaha[6];?>"><?php echo $DEAVaha[6];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>

<tr><td class="row1">&nbsp;&nbsp;Stížnosti zamìstnancù</td><td class="row1"><select name="DEAVyzn8" onChange="calculate();" id="Vyzn8"><option value="<?php echo $DEAVyzn[7];?>"><?php echo $DEAVyzn[7];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td class="row1"><select name="DEAVaha8" onChange="calculate();" id="Vaha8"><option value="<?php echo $DEAVaha[7];?>"><?php echo $DEAVaha[7];?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td></tr>
</table>
</td></tr>


<tr><td class="row2"><b>Výsledná významnost aspektu:</b></td><td class="row2"><span id="DEACelkS"><b><?php echo $hodnota;?></b></span></td></tr>
<tr><td class="row1">Èetnost mìøení:</td><td class="row1"><input type="text" value="<?php echo $DEACetn;?>" name="DEACetn" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row2">Procento dokonèení èinnosti pro 1. kontrolu aspektu:</td><td class="row2"><input type="text" value="<?php echo $DOK;?>" name="DOK" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row1">Množství mìrných jednotek produktu na 1 kontrolu aspektu:</td><td class="row1"><input type="text" value="<?php echo $MNK;?>" name="MNK" MAXLENGTH="5"  size="5"></td></tr>


<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Uložit">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zpìt"></td></tr>
</table>
</form>
<?php
}

// Nahlizeni do tabulky
if ($status==0){

echo "<table><tr valign='middle'><td align='left'><form  ACTION='./environmentalni-aspekty' METHOD='post' ENCTYPE='multipart/form-data'>";
if ($lock==0) echo "<a href='?status=1' title='Nová položka'><img src='./skin/button/32/new.png' alt='Nová položka' width='32px' height='32px' border='0'></a>&nbsp;";
echo "<a href='tisk-databaze-aspektu' title='Tisk databáze aspektù' target='_blank'><img src='./skin/button/32/printer.png' alt='Tisk databáze aspektù' width='32px' height='32px' border='0'></a>&nbsp;";
if ($lock==0) echo "<a href='?status=3' title='Export databáze aspektù'><img src='./skin/button/32/export.png' alt='Export databáze aspektù' width='32px' height='32px' border='0'></a>&nbsp;";
if ($lock==0) echo "<a href='?status=4' title='Import databáze aspektù'><img src='./skin/button/32/import.png' alt='Import databáze aspektù' width='32px' height='32px' border='0'></a>&nbsp;";
echo "<a href='?status=5' title='Hledat aspekt'><img src='./skin/button/32/search.png' alt='Hledat položku' width='32px' height='32px' border='0'></a>&nbsp;";
echo "&nbsp;&nbsp;&nbsp;<img src='./skin/button/32/sort.png' alt='Øazení databáze aspektù' width='32px' height='32px'>&nbsp;";
echo "<select name='razeni' onChange='submit();'>";
echo "<option value='0'"; if ($razeni==0) echo " selected";echo ">dle kódu èinnosti +</option>";
echo "<option value='1'"; if ($razeni==1) echo " selected"; echo ">dle kódu èinnosti -</option>";
echo "<option value='2'"; if ($razeni==2) echo " selected";echo ">dle zkratky èinnosti +</option>";
echo "<option value='3'"; if ($razeni==3) echo " selected"; echo ">dle zkratky èinnosti -</option>";
echo "<option value='4'"; if ($razeni==4) echo " selected";echo ">dle názvu èinnosti +</option>";
echo "<option value='5'"; if ($razeni==5) echo " selected"; echo ">dle názvu èinnosti -</option>";
echo "<option value='6'"; if ($razeni==6) echo " selected";echo ">dle kódu aspektu +</option>";
echo "<option value='7'"; if ($razeni==7) echo " selected"; echo ">dle kódu aspektu -</option>";
echo "<option value='8'"; if ($razeni==8) echo " selected"; echo ">dle názvu aspektu +</option>";
echo "<option value='9'"; if ($razeni==9) echo " selected"; echo ">dle názvu aspektu -</option>";
echo "<option value='10'"; if ($razeni==10) echo " selected";echo ">dle významu +</option>";
echo "<option value='11'"; if ($razeni==11) echo " selected"; echo ">dle významu -</option>";


echo "</select>&nbsp;<input type='submit' value='øadit'>";

echo "&nbsp;<a href=\"../forum/".$u_login_logout."\" class=\"vlevo\"  title=\"\" >";
if ($lock==0) echo "&nbsp;&nbsp;&nbsp;&nbsp;<img src='./skin/button/32/opened.png' alt='Opened' width='32px' height='32px' border='0'>";
if ($lock==1) echo "&nbsp;&nbsp;&nbsp;&nbsp;<img src='./skin/button/32/locked.png' alt='Locked' width='32px' height='32px' border='0'>";
echo "</a></form></td></tr></table>";


if ($razeni==0) $razenistr="CKLIC";
if ($razeni==1) $razenistr="CKLIC DESC";
if ($razeni==2) $razenistr="SKLIC";
if ($razeni==3) $razenistr="SKLIC DESC";
if ($razeni==4) $razenistr="temp_cinnost";
if ($razeni==5) $razenistr="temp_cinnost DESC";
if ($razeni==6) $razenistr="DEAKod";
if ($razeni==7) $razenistr="DEAKod DESC";
if ($razeni==8) $razenistr="DEAAsp1";
if ($razeni==9) $razenistr="DEAAsp1 DESC";
if ($razeni==10) $razenistr="DEACelk";
if ($razeni==11) $razenistr="DEACelk DESC";

if (!$vyhledavani) {$celkem=mysql_result(mysql_query("SELECT count(*) FROM DbEAs",$connect2),0);$celkem2=$celkem;}
else  { $celkem=mysql_result(mysql_query("SELECT count(*) FROM DbEAs where ".$vyhledavani,$connect2),0);$celkem2=$celkem;if ($celkem>50) $celkem=50;}

if ($celkem){
?>
<font class="name">Celkem bylo nalezeno <?php echo $celkem2;?> položek</font>
<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft"></td>
<td align="center" class="catLeft"><font class="name2"><b>Èís.klíè</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Zkratka</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Název èinnosti</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Kód aspektu</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Environmentální aspekt</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Polutanty</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Význam</b></font></td>
</tr>
<?php

if (!$vyhledavani) $getclanek = mysql_query("SELECT * FROM DbEAs Order by ".$razenistr." Limit $pozice,$pocetc",$connect2);
else  {$getclanek = mysql_query("SELECT * FROM DbEAs where ".$vyhledavani." Order by DEAKod Limit 0,50",$connect2);$celkem=50;}
	while ($clanky = mysql_fetch_array($getclanek)){

		$klic=$clanky['klic'];

		$DEAKod=$clanky['DEAKod'];
	
		$DEAAsp1=$clanky['DEAAsp1'];
		$DEAAsp2=$clanky['DEAAsp2'];
		$DEAUtv=$clanky['DEAUtv'];
		$DEAZar=$clanky['DEAZar'];
		$DEAPolut1=$clanky['DEAPolut1'];
		$DEAPolut2=$clanky['DEAPolut2'];
		$DEADopad=$clanky['DEADopad'];

		$DEADopad=ereg_replace("0","-/",$DEADopad);
		$DEADopad=ereg_replace("1","+/",$DEADopad);
		$DEADopad=substr($DEADopad,0,strlen($DEADopad)-1);

		$DEALimH=$clanky['DEALimH'];
		$DEAMJ=$clanky['DEAMJ'];
		$DEAPredp=$clanky['DEAPredp'];
		$DEARiz=$clanky['DEARiz'];
		$DEAVyzn=$clanky['DEAVyzn'];

		$DEAVyzn=ereg_replace("1","1/",$DEAVyzn);
		$DEAVyzn=ereg_replace("2","2/",$DEAVyzn);
		$DEAVyzn=ereg_replace("3","3/",$DEAVyzn);
		$DEAVyzn=substr($DEAVyzn,0,strlen($DEAVyzn)-3);


		$DEADokl=$clanky['DEADokl'];
		$DEAPrev1=$clanky['DEAPrev1'];
		$DEAPrev2=$clanky['DEAPrev2'];
		$DEAOpat1=$clanky['DEAOpat1'];
		$DEAOpat2=$clanky['DEAOpat2'];

		$DEACelk=$clanky['DEACelk'];

		$CKLIC= $clanky['CKLIC'];
		$SKLIC= $clanky['SKLIC'];
		$temp_cinnost= $clanky['temp_cinnost'];


		if ($row==1) $row=2;else $row=1;
		$DEAOdp=$clanky['DEAOdp'];

echo '<tr>';

echo '<td align="center" class="row'.$row.'">';
echo "<a href='?status=7&amp;id=".$klic."' title='Zobrazit položku'><img src='./skin/button/16/view.png' alt='Zobrazit položku' width='16px' height='16px' border='0'></a>&nbsp;";
echo "<a href='tisk-databaze-aspektu?id=".$klic."' title='Tisk položky' target='_blank'><img src='./skin/button/16/printer.png' alt='Tisk položky' width='16px' height='16px' border='0'></a>&nbsp;";
if ($lock==0) echo "<br><a href='?status=6&amp;id=".$klic."' title='Editovat položku'><img src='./skin/button/16/edit.png' alt='Editovat položku' width='16px' height='16px' border='0'></a>&nbsp;";
if ($lock==0) echo "<a href='?status=8&amp;id=".$klic."' title='Kopírovat položku'><img src='./skin/button/16/copy.png' alt='Kopírovat položku' width='16px' height='16px' border='0'></a>&nbsp;";
if ($lock==0) echo "<a href='?status=9&amp;id=".$klic."' title='Vymazat položku'><img src='./skin/button/16/delete.png' alt='Vymazat položku' width='16px' height='16px' border='0'></a>&nbsp;";
echo '</td>';


echo '<td align="center" class="row'.$row.'"><font class="name2"><b>'.$CKLIC.'</b></font></td>
<td align="center" class="row'.$row.'"><font class="name2">'.$SKLIC.'</font></td>
<td align="left" class="row'.$row.'"><b><font class="name2">'.$temp_cinnost.'</font></b></td>
<td align="center" class="row'.$row.'"><font class="name2">'.$DEAKod.'</font></td>
<td align="left" class="row'.$row.'"><b><font class="name2">'.$DEAAsp1.'<br>'.$DEAAsp2.'</b></font></td>
<td align="left" class="row'.$row.'"><font class="name2">'.$DEAPolut1.'<br>'.$DEAPolut2.'</font></td>
<td align="center" class="row'.$row.'"><font class="name2"><b>'.$DEACelk.'</b></font></td>
</tr>';
	}
	echo "</table>";


if ($celkem>$pocetc){
$roma1="./environmentalni-aspekty?pozice=".($pozice-$pocetc)."&amp;razeni=".$razeni;
$roma2="./environmentalni-aspekty?pozice=".($pozice+$pocetc)."&amp;razeni=".$razeni;
$roma5="./environmentalni-aspekty?pozice=0&amp;razeni=".$razeni;
$roma6="./environmentalni-aspekty?pozice=".($pozice-$pocetc*10)."&amp;razeni=".$razeni;
$roma7="./environmentalni-aspekty?pozice=".($pozice+$pocetc*20)."&amp;razeni=".$razeni;
$roma8="./environmentalni-aspekty?pozice=".($celkem-$celkem%$pocetc)."&amp;razeni=".$razeni;

$pozice22=($pozice-$pocetc*10)/$pocetc+1;
$pozice3=($pozice+$pocetc*20)/$pocetc+1;
$pozice4=($celkem-$celkem%$pocetc)/$pocetc+1;

?>
<table width="100%" border="0">
  <tr>
    <td width="20%" align="right" valign="top"><?php if($pozice+1 >= $pocetc){echo("<A HREF=\"./$roma1\"><font color=\"red\"><< pøedchozí <<</font></A>");}?></td>
    <td width="60%" align="center" valign="top">
	<?php 
	      if ($celkem>$pocetc*10-1) $doplnekadr=1;  	
	      if ($pozice<$pocetc*9) {$celkemh=$pocetc*10;$celkemd=0;if ($celkem>$pocetc*10-1) $doplnekadr=1;} else {$celkemh=$pocetc*9+$pozice;if ($celkemh>$celkem) $celkemh=$celkem; $celkemd=$pozice;}	
	      if ($pozice>$pocetc*9-1) echo "<A HREF=\"./".$roma5."\">1...</A>&nbsp;&nbsp;";
	      if ($pozice>$pocetc*19-1) echo "<A HREF=\"./".$roma6."\">".$pozice22."...</A>&nbsp;&nbsp;";
	      if ($celkem<$pocetc*10-1) {$celkemd=0;$celkemh=$celkem;}
              for ($i=$celkemd;$i<$celkemh;$i=$i+$pocetc){
		   $roma3="./environmentalni-aspekty?pozice=".$i."&amp;razeni=".$razeni;
		   if ($celkem<$i+$pocetc) $j=$celkem;
		   else $j=$i+$pocetc;	
		   $roma4=$i/$pocetc+1;
		   if (($pozice>=$i)&&($pozice<$j)) $col="<font color=\"black\"><b>".$roma4."</b></font>";
		   else $col=$roma4;
	           echo(" <A HREF=\"./$roma3\">$col</A> ");	      
	     } 
             if ($pozice+$pocetc*20-1<$celkem) echo "&nbsp;&nbsp;<A HREF=\"./".$roma7."\">".$pozice3."...</A>";
	     else if ($pozice+$pocetc*10-1<$celkem) echo "&nbsp;&nbsp;<A HREF=\"./".$roma8."\">...".$pozice4."</A>";	
	?>
    </td>
    <td width="20%" align="left" valign="top"><?php if($pozice+$pocetc < $celkem){echo("<A HREF=\"./$roma2\"><font color=\"red\">>> další >></font></A>
");}?></td>
 </tr>
</table>
<?php
}}else{

echo "<h1>Je nám líto. Nebyl nalezen žádný záznam odpovídající Vašemu zadání.</h1>";

}

}


?>
