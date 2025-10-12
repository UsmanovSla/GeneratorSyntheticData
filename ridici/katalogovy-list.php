<?php 

$pocetc=50;


function kontrola ($promenna){
	$promenna = EregI_Replace("<", "&lt;", $promenna);
	$promenna = EregI_Replace(">", "&gt;", $promenna);
	$promenna = EregI_Replace('"', '&quot;', $promenna);
	$promenna = EregI_Replace('\'', '&quot;', $promenna);
	$promenna = EregI_Replace(',', '.', $promenna);
//	$promenna=htmlspecialchars($promenna);
//	$promenna=addslashes($promenna);
//	$promenna=quotemeta($promenna);
return $promenna;
}
function kontrolaN ($promenna){
	$promenna = EregI_Replace("<", "&lt;", $promenna);
	$promenna = EregI_Replace(">", "&gt;", $promenna);
	$promenna = EregI_Replace('"', '&quot;', $promenna);
	$promenna = EregI_Replace('\'', '&quot;', $promenna);
//	$promenna=htmlspecialchars($promenna);
//	$promenna=addslashes($promenna);
//	$promenna=quotemeta($promenna);
return $promenna;
}

$sid = kontrola($_GET['sid']);
$sid2 = kontrola($_GET['sid2']);
$nazevsidd="<a href='katalog-stroju' title='Zobrazit celý katalog strojù'>Katalog strojù</a>";

if ($sid){
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_1 where id='$sid'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$nazevsidd=$nazevsidd." : <a href='katalogovy-list?sid=".$sid."' title='Zobrazit katalog strojù: ".$clanky['nazev']."'>".$clanky['nazev']."</a>";
	}
}
if ($sid2){
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_2 where id='$sid2'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$nazevsidd=$nazevsidd." : ".$clanky['nazev'];
	}
}


echo "<h1>$nazevsidd</h1>";

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
if ($razeni=="") $razeni=4;

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
	echo "<h2>Krok 1: Export strojù: Volba formátu</h2><br>";
	echo "<form method='post'  enctype='multipart/form-data'>";
	echo "Formát: <select name='status'><option value='301'>CSV</option><option value='302'>MS EXCEL</option><option value='303'>TXT</option><option value='305'>MS WORD</option></select><br><br>";
	echo "<input name='vlozit' type='submit' value='Exportovat'>&nbsp;<input type=button onclick='history.back()' value='Zpìt'></form>";
}

// EXPORT tabulky - CSV
if ($status==301){

	echo "<h2>Krok 2: Export strojù: Uložit soubor</h2><br>";
	$db=$connect2;
	$tabl="optimalizace_katalog_stroju";
	$tabl2="optimalizace_katalog_stroju";
	$sql="SELECT * FROM `".$tabl."` order by id";
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

	echo "<h1>Soubor exportu (stroje): <a href='".$cesta2."' target='_blank'>Uložit CSV soubor :::</a></h1><br>";

	
	$db=$connect2;
	$tabl="optimalizace_pridavna_zarizeni";
	$tabl2="optimalizace_pridavna_zarizeni";
	$sql="SELECT * FROM `".$tabl."` order by id";
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

	echo "<h1>Soubor exportu (pøídavné zaøízení): <a href='".$cesta2."' target='_blank'>Uložit CSV soubor :::</a></h1><br>";


	$db=$connect2;
	$tabl="optimalizace_skupiny_stroju_1";
	$tabl2="optimalizace_skupiny_stroju_1";
	$sql="SELECT * FROM `".$tabl."` order by id";
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

	echo "<h1>Soubor exportu (skupina 1): <a href='".$cesta2."' target='_blank'>Uložit CSV soubor :::</a></h1><br>";

	$db=$connect2;
	$tabl="optimalizace_skupiny_stroju_2";
	$tabl2="optimalizace_skupiny_stroju_2";
	$sql="SELECT * FROM `".$tabl."` order by id";
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

	echo "<h1>Soubor exportu (skupina 2): <a href='".$cesta2."' target='_blank'>Uložit CSV soubor :::</a></h1><br>";
	
	$db=$connect2;
	$tabl="optimalizace_vyrobce";
	$tabl2="optimalizace_vyrobce";
	$sql="SELECT * FROM `".$tabl."` order by id";
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

	echo "<h1>Soubor exportu (výrobce strojù): <a href='".$cesta2."' target='_blank'>Uložit CSV soubor :::</a></h1><br>";

	echo "<input type=button onclick='history.back()' value='Zpìt'>";

}


// EXPORT tabulky - EXCEL
if ($status==302){

	$tabl="DB";
	$tabl2="DB";

	echo "<h2>Krok 2: Export strojù: Uložit soubor</h2><br>";


	$seed = floor(time()/86400);
	srand($seed);
	$time=Time();
	$rand = Rand();
	$datum=date("Y-m-d",time());
	$filnam=$tabl2."-".$datum."-".MD5($time.$rand).".xls";
	$filnam2=$tabl2."-".$datum."-".MD5($time.$rand);
	$cesta="./export/xls/".$filnam;
	$cesta2="./export/xls/".$filnam2;


$DB_TBLName="optimalizace_katalog_stroju";

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

	echo "<h2>Krok 2: Export strojù: Uložit soubor</h2><br>";



	$db=$connect2;
	$tabl="optimalizace_katalog_stroju";
	$tabl2="optimalizace_katalog_stroju";
	$sql="SELECT * FROM `".$tabl."` order by id";
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

	echo "<h2>Krok 2: Export environmentálních aspektù: Uložit soubor</h2><br>";

	echo "<br><br><img src='./skin/under-construction.gif' width='500' height='125'><br><br>";

	echo "<input type=button onclick='history.back()' value='Zpìt'>";

}

// EXPORT tabulky - DOC
if ($status==305){

	echo "<h2>Krok 2: Export strojù: Uložit soubor</h2><br>";

	$tabl="DB";
	$tabl2="DB";

	$seed = floor(time()/86400);
	srand($seed);
	$time=Time();
	$rand = Rand();
	$datum=date("Y-m-d",time());
	$filnam=$tabl2."-".$datum."-".MD5($time.$rand).".doc";
	$filnam2=$tabl2."-".$datum."-".MD5($time.$rand);
	$cesta="./export/doc/".$filnam;
	$cesta2="./export/doc/".$filnam2;


$DB_TBLName="optimalizace_katalog_stroju";

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
if ($status==4454){
	echo "<h2>Krok 1: Import databáze èinností ze souborù systému CONTEC: Upload souboru</h2><br>";
	echo "<form method='post'  enctype='multipart/form-data'>";
	echo "<input type='hidden' name='status' value='401'>";
	echo "Soubor: <input type='hidden' name='MAX_FILE_SIZE' value='2000000'><input name='file' type='file'><br>";
	echo "Maximální velikost souboru 2 MB. Jen ve formátu systému CONTEC !<br>";
	echo "Nahrávání souboru mùže trvat velice dlouho - v závislosti na rychlosti vašeho pøipojení k internetu !<br>";
	echo "<input name='vlozit' type='submit' value='Importovat'>&nbsp;<input type=button onclick='history.back()' value='Zpìt'></form>";
}

// Import tabulky - Kontrola souboru
if ($status==401){

	$chyba=0;
	echo "<h2>Krok 2: Import databáze èinností ze souborù systému CONTEC: Kontrola</h2><br>";
	$MAX_FILE_SIZE=kontrola($_POST['MAX_FILE_SIZE']);
	if (!$_FILES) {
	        $chyb = "Soubor se nepodaøilo nahrát na server.\n";
	        $chyba=1;
	}
	if ($_FILES["file"]["size"]>2000000){
	        $chyb = "Soubor je vìtší než 2 Mb.\n";
	        $chyba=1;
	}
	if (fmod($_FILES["file"]["size"],198)){
	        $chyb = "Soubor je ve špatném formátù.\n";
	        $chyba=1;
	}
	if ($chyba==1){
		echo "<h1><font color=red>Chyba pøi Importu databáze èinností !</font></h1>";
		echo "<h2>".$chyb."</h2>";
		echo "<center><input type=button onclick='history.back()' value='Zpìt'></center>";
	}else{
		$seed = floor(time()/86400);
		srand($seed);
		$time=Time();
		$rand = Rand();
		$filenameee=MD5($time.$rand);
		$cesta="./import/DB-".$filenameee;
		move_uploaded_file($_FILES['file']['tmp_name'],$cesta);
		include ("./convert/convert-DB-1.php");
		echo "<form method='post'  enctype='multipart/form-data'>";
		echo "<input type='hidden' name='status' value='402'>";
		echo "<input type='hidden' name='soubor' value='".$cesta."'>";
		echo "<input name='vlozit' type='submit' value='Uložit do databáze'>&nbsp;<input type=button onclick='history.back()' value='Zpìt'></form>";
	}
}

// Import tabulky - Ukladani do databaze
if ($status==402){
	$cesta=kontrola($_POST['soubor']);
	include ("./convert/convert-DB-2.php");
	echo "<h2>Krok 3: Import databáze èinností ze souborù systému CONTEC: Zmìna databáze</h2><br>";
	echo "<h1><font color=green>Databáze byla úspìšnì obnovìna !</font></h1><hr>";
	$status=0;
}



// Vyhledavani cinnosti - vysledek
if ($status==501){


	$CisKlic= kontrola($_POST['CisKlic']);
	$typ= kontrola($_POST['typ']);
	$nazev= kontrola($_POST['nazev']);
	$vykon_kW= kontrola($_POST['vykon_kW']);
	$provozni_hmotnost_kg= kontrola($_POST['provozni_hmotnost_kg']);
	$vyrobce= kontrola($_POST['vyrobce']);
	$skupina1= kontrola($_POST['skupina1']);
	$skupina2= kontrola($_POST['skupina2']);
	$cena_stroje= kontrola($_POST['cena_stroje']);
	$naklady_standardni_sazba_kc_hod= kontrola($_POST['naklady_standardni_sazba_kc_hod']);
	$pracovni_vykon_jednotka_hod= kontrola($_POST['pracovni_vykon_jednotka_hod']);
	$pracovni_cyklus_sek= kontrola($_POST['pracovni_cyklus_sek']);

	



	echo "<h1><font color=green>Výsledky vyhledávání...</font></h1><hr>";
	$vyhledavani="";
	if ($CisKlic) $vyhledavani=" id='".$CisKlic."'";
	if ($typ) $vyhledavani=$vyhledavani." and typ like '%".$typ."%'";
	if ($nazev) $vyhledavani=$vyhledavani." and nazev like '%".$nazev."%'";
	if ($vyrobce) $vyhledavani=$vyhledavani." and vyrobce like '%".$vyrobce."%'";

	if ($skupina1) $vyhledavani=$vyhledavani." and skupina1='".$skupina1."'";
	if ($skupina2) $vyhledavani=$vyhledavani." and skupina2='".$skupina2."'";
	
	if ($provozni_hmotnost_kg){
		if ($provozni_hmotnost_kg==1) $vyhledavani=$vyhledavani." and provozni_hmotnost_kg<3000";
		else if ($provozni_hmotnost_kg==2) $vyhledavani=$vyhledavani." and (provozni_hmotnost_kg>=3000 and provozni_hmotnost_kg<10000)";
		else if ($provozni_hmotnost_kg==3) $vyhledavani=$vyhledavani." and (provozni_hmotnost_kg>=10000 and provozni_hmotnost_kg<20000)";
		else $vyhledavani=$vyhledavani." and provozni_hmotnost_kg>=20000";
	}
	
	if ($vykon_kW){
		if ($vykon_kW==1) $vyhledavani=$vyhledavani." and vykon_kW<50";
		else if ($vykon_kW==2) $vyhledavani=$vyhledavani." and (vykon_kW>=50 and vykon_kW<100)";
		else if ($vykon_kW==3) $vyhledavani=$vyhledavani." and (vykon_kW>=100 and vykon_kW<200)";
		else $vyhledavani=$vyhledavani." and vykon_kW>=200";
	}
	
	if ($cena_stroje==1){
		if ($cena_stroje==1) $vyhledavani=$vyhledavani." and cena_stroje<1000000";
		else if ($cena_stroje==2) $vyhledavani=$vyhledavani." and (cena_stroje>=1000000 and cena_stroje<5000000)";
		else if ($cena_stroje==3) $vyhledavani=$vyhledavani." and (cena_stroje>=5000000 and cena_stroje<10000000)";
		else $vyhledavani=$vyhledavani." and cena_stroje>=10000000";
	}

	if ($naklady_standardni_sazba_kc_hod){
		if ($naklady_standardni_sazba_kc_hod==1) $vyhledavani=$vyhledavani." and naklady_standardni_sazba_kc_hod<500";
		else if ($naklady_standardni_sazba_kc_hod==2) $vyhledavani=$vyhledavani." and (naklady_standardni_sazba_kc_hod>=500 and naklady_standardni_sazba_kc_hod<1000)";
		else if ($naklady_standardni_sazba_kc_hod==3) $vyhledavani=$vyhledavani." and (naklady_standardni_sazba_kc_hod>=1000 and naklady_standardni_sazba_kc_hod<2500)";
		else $vyhledavani=$vyhledavani." and naklady_standardni_sazba_kc_hod>=2500";
	}

	if ($pracovni_vykon_jednotka_hod){
		if ($pracovni_vykon_jednotka_hod==1) $vyhledavani=$vyhledavani." and pracovni_vykon_jednotka_hod<10";
		else if ($pracovni_vykon_jednotka_hod==2) $vyhledavani=$vyhledavani." and (pracovni_vykon_jednotka_hod>=10 and pracovni_vykon_jednotka_hod<50)";
		else if ($pracovni_vykon_jednotka_hod==3) $vyhledavani=$vyhledavani." and (pracovni_vykon_jednotka_hod>=50 and pracovni_vykon_jednotka_hod<100)";
		else $vyhledavani=$vyhledavani." and pracovni_vykon_jednotka_hod>=100";
	}

	if ($pracovni_cyklus_sek){
		if ($pracovni_cyklus_sek==1) $vyhledavani=$vyhledavani." and pracovni_cyklus_sek<30";
		else if ($pracovni_cyklus_sek==2) $vyhledavani=$vyhledavani." and (pracovni_cyklus_sek>=30 and pracovni_cyklus_sek<100)";
		else if ($pracovni_cyklus_sek==3) $vyhledavani=$vyhledavani." and (pracovni_cyklus_sek>=100 and pracovni_cyklus_sek<500)";
		else $vyhledavani=$vyhledavani." and pracovni_cyklus_sek>=500";
	}

	
	if (substr($vyhledavani,0,4)==" and") $vyhledavani=substr($vyhledavani,4,strlen($vyhledavani));
	$status=0;
}


// Vyhledavani - formular
if ($status==5){
?>
<form  ACTION='./katalogovy-list' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="501">
<h2><font color="green">Vyhledávání stroje:</font></h2>
<table>
<tr><td class="row2">Èíselný klíè:</td><td class="row2"><input type="text" value="" name="CisKlic" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row1">Typ</td><td class="row1"><input type="text" value="" name="typ" MAXLENGTH="50"  size="20"></td></tr>
<tr><td class="row2"><b>Název stroje:</b></td><td class="row2"><input type="text" value="" name="nazev" MAXLENGTH="50"  size="20"></td></tr>
<tr><td class="row1">Výrobce:</td><td class="row1"><input type="text" value="" name="vyrobce" MAXLENGTH="50"  size="20"></td></tr>

<tr><td class="row2">Sekce 1:</td><td class="row2">
<select name="skupina1"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_1 order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo "<option value='".$clanky['id']."'>".$clanky['nazev']."</option>";
	}
?></select></td></tr>

<tr><td class="row1">Sekce 2:</td><td class="row1">
<select name="skupina2"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_2 order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo "<option value='".$clanky['id']."'>".$clanky['nazev']."</option>";
	}
?></select></td></tr>

<tr><td class="row2">Výkon stroje:</td><td class="row2"><select name="vykon_kW"><option></option><option value="1">do 50 kW</option><option value="2">od 50 kW do 100 kW</option><option value="3">od 100 kW do 200 kW</option><option value="4">nad 200 kW</option></select></td></tr>


<tr><td class="row1">Prázdná provozní hmotnost:</td><td class="row1"><select name="provozni_hmotnost_kg"><option></option><option value="1">do 3 t</option><option value="2">od 3 t do 10 t</option><option value="3">od 10 t do 20 t</option><option value="4">nad 20 t</option></select></td></tr>


<tr><td class="row2">Cena stroje, CZK:</td><td class="row2"><select name="cena_stroje"><option></option><option value="1">do 1 mln. Kè</option><option value="2">od 1 do 5 mln. Kè</option><option value="3">od 5 do 10 mln. Kè</option><option value="4">nad 10 mln. Kè</option></select></td></tr>



<tr><td class="row1">Pronájem stroje:</td><td class="row1"><select name="naklady_standardni_sazba_kc_hod"><option></option><option value="1">do 500,-Kè/h</option><option value="2">od 500 do 1 000,-Kè/h</option><option value="3">od 1 000 do 2 500,-Kè/h</option><option value="4">nad 2 500,-Kè/h</option></select></td></tr>

<tr><td class="row2">Pracovní výkon:</td><td class="row2"><select name="pracovni_vykon_jednotka_hod"><option></option><option value="1">do 10 jedn/h</option><option value="2">od 10 do 50 jedn/h</option><option value="3">od 50 do 100 jedn/h</option><option value="4">nad 100 jedn/h</option></select></td></tr>

<tr><td class="row1">Pracovní cyklus:</td><td class="row1"><select name="pracovni_cyklus_sek"><option></option><option value="1">do 30 sek</option><option value="2">od 30 do 100 sek</option><option value="3">od 100 do 500 sek</option><option value="4">nad 500 sek</option></select></td></tr>


<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Hledat">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zpìt"></td></tr>
<tr><td class="row1" colspan="1"><em>Zobrazí se pouze prvních 50 strojù...</em></td></tr>
</table>
</form>
<?php
}


// Novy zaznam tabulky -pridani do MySQL
if ($status==101){


$id=kontrola($_POST['id']);
$nazev=kontrolaN($_POST['nazev']);
$skupina1=kontrola($_POST['skupina1']);
$skupina2=kontrola($_POST['skupina2']);
$typ=kontrola($_POST['typ']);

$druh_prvku=kontrola($_POST['druh_prvku']);
if ($druh_prvku<1) $druh_prvku=1;
if ($druh_prvku>3) $druh_prvku=3;
$vykon_kW=kontrola($_POST['vykon_kW']);
$provozni_hmotnost_kg=kontrola($_POST['provozni_hmotnost_kg']);
$delka_cm=kontrola($_POST['delka_cm']);
$sirka_cm=kontrola($_POST['sirka_cm']);
$vyska_cm=kontrola($_POST['vyska_cm']);
$max_rychlost_km_h=kontrola($_POST['max_rychlost_km_h']);
$provozni_rychlost_km_h=kontrola($_POST['provozni_rychlost_km_h']);
$stoupavost_stupnu=kontrola($_POST['stoupavost_stupnu']);
$tlak_na_zeminu_kPa=kontrola($_POST['tlak_na_zeminu_kPa']);
$pridavne_zarizeni_1=kontrola($_POST['pridavne_zarizeni_1']);
$pridavne_zarizeni_2=kontrola($_POST['pridavne_zarizeni_2']);
$pridavne_zarizeni_3=kontrola($_POST['pridavne_zarizeni_3']);
$pridavne_zarizeni_4=kontrola($_POST['pridavne_zarizeni_4']);
$pridavne_zarizeni_5=kontrola($_POST['pridavne_zarizeni_5']);
$dosah_hloubka_cm=kontrola($_POST['dosah_hloubka_cm']);
$dosah_vyska_cm=kontrola($_POST['dosah_vyska_cm']);
$dosah_delka_cm=kontrola($_POST['dosah_delka_cm']);
$polomer_otaceni_cm=kontrola($_POST['polomer_otaceni_cm']);
$poznamka=kontrolaN($_POST['poznamka']);
$spotreba_paliva_hi_ml_hod=kontrola($_POST['spotreba_paliva_hi_ml_hod']);
$spotreba_paliva_medium_ml_hod=kontrola($_POST['spotreba_paliva_medium_ml_hod']);
$spotreba_paliva_low_ml_hod=kontrola($_POST['spotreba_paliva_low_ml_hod']);
$co2_hi_ml_hod=kontrola($_POST['co2_hi_ml_hod']);
$co2_medium_ml_hod=kontrola($_POST['co2_medium_ml_hod']);
$co2_low_ml_hod=kontrola($_POST['co2_low_ml_hod']);
$hluk_int=kontrola($_POST['hluk_int']);
$hluk_ext=kontrola($_POST['hluk_ext']);
$naklady_standardni_sazba_kc_hod=kontrola($_POST['naklady_standardni_sazba_kc_hod']);
$naklady_prescasova_sazba_kc_hod=kontrola($_POST['naklady_prescasova_sazba_kc_hod']);
$naklady_na_pouziti_kc=kontrola($_POST['naklady_na_pouziti_kc']);
$cena_stroje=kontrola($_POST['cena_stroje']);
$cena_stroje_USD=kontrola($_POST['cena_stroje_USD']);
$pravdepodobnost_poruchy_1000_hod=kontrola($_POST['pravdepodobnost_poruchy_1000_hod']);
$prumerna_doba_opravy_min=kontrola($_POST['prumerna_doba_opravy_min']);
$prumerna_cena_opravy_kc=kontrola($_POST['prumerna_cena_opravy_kc']);
$prumerna_doba_sluzby_let=kontrola($_POST['prumerna_doba_sluzby_let']);
$minimalni_pracovni_plocha_m2=kontrola($_POST['minimalni_pracovni_plocha_m2']);
$pocet_jednotek=kontrola($_POST['pocet_jednotek']);
$jednotka=kontrola($_POST['jednotka']);
$pracovni_vykon_jednotka_hod=kontrola($_POST['pracovni_vykon_jednotka_hod']);
$pracovni_cyklus_sek=kontrola($_POST['pracovni_cyklus_sek']);
$vyrobce=kontrola($_POST['vyrobce2']);
if (!$vyrobce) $vyrobce=kontrola($_POST['vyrobce']);

$CisKlic=$id;



	$chyba=0;
	$chyba=mysql_result(mysql_query("SELECT count(*) FROM optimalizace_katalog_stroju where nazev='".$nazev."'",$connect2),0);

	if ($chyba) {
		echo "<h1><font color=red>Chyba! Název stroje musí být unikátní!</font></h1>";
	}
	if (!$nazev) {
		echo "<h1><font color=red>Chyba! Název stroje nesmí být prázdný!</font></h1>";
		$chyba=1;
	}
	if (!$chyba){ 
	
		$pracovni_vykon_jednotka_hod=$pocet_jednotek/$pracovni_cyklus_sek*3600;
		
		mysql_query("INSERT INTO `optimalizace_katalog_stroju` ( `nazev` , `skupina1` , `skupina2` , `typ` , `druh_prvku` , `vykon_kW` , `provozni_hmotnost_kg` , `delka_cm` , `sirka_cm` , `vyska_cm` , `max_rychlost_km_h` , `provozni_rychlost_km_h` , `stoupavost_stupnu` , `tlak_na_zeminu_kPa` , `pridavne_zarizeni_1` , `pridavne_zarizeni_2` , `pridavne_zarizeni_3` , `pridavne_zarizeni_4` , `pridavne_zarizeni_5` , `dosah_hloubka_cm` , `dosah_vyska_cm` , `dosah_delka_cm` , `polomer_otaceni_cm` , `poznamka` , `spotreba_paliva_hi_ml_hod` , `spotreba_paliva_medium_ml_hod` , `spotreba_paliva_low_ml_hod` , `co2_hi_ml_hod` , `co2_medium_ml_hod` , `co2_low_ml_hod` , `hluk_int` , `hluk_ext` , `naklady_standardni_sazba_kc_hod` , `naklady_prescasova_sazba_kc_hod` , `naklady_na_pouziti_kc` , `cena_stroje` , `pravdepodobnost_poruchy_1000_hod` , `prumerna_doba_opravy_min` , `prumerna_cena_opravy_kc` , `prumerna_doba_sluzby_let`, `minimalni_pracovni_plocha_m2` , `pocet_jednotek` , `jednotka` , `pracovni_vykon_jednotka_hod` , `pracovni_cyklus_sek` , `vyrobce`,`cena_stroje_USD` ) 
VALUES ('$nazev', '$skupina1', '$skupina2', '$typ', '$druh_prvku', '$vykon_kW', '$provozni_hmotnost_kg', '$delka_cm', '$sirka_cm', '$vyska_cm', '$max_rychlost_km_h', '$provozni_rychlost_km_h', '$stoupavost_stupnu', '$tlak_na_zeminu_kPa', '$pridavne_zarizeni_1', '$pridavne_zarizeni_2', '$pridavne_zarizeni_3', '$pridavne_zarizeni_4', '$pridavne_zarizeni_5', '$dosah_hloubka_cm', '$dosah_vyska_cm', '$dosah_delka_cm', '$polomer_otaceni_cm', '$poznamka', '$spotreba_paliva_hi_ml_hod', '$spotreba_paliva_medium_ml_hod', '$spotreba_paliva_low_ml_hod', '$co2_hi_ml_hod', '$co2_medium_ml_hod', '$co2_low_ml_hod', '$hluk_int', '$hluk_ext', '$naklady_standardni_sazba_kc_hod', '$naklady_prescasova_sazba_kc_hod', '$naklady_na_pouziti_kc', '$cena_stroje', '$pravdepodobnost_poruchy_1000_hod', '$prumerna_doba_opravy_min', '$prumerna_cena_opravy_kc', '$prumerna_doba_sluzby_let', '$minimalni_pracovni_plocha_m2', '$pocet_jednotek', '$jednotka', '$pracovni_vykon_jednotka_hod', '$pracovni_cyklus_sek', '$vyrobce','$cena_stroje_USD');",$connect2);

		
		$ide=mysql_insert_id($connect2);

		echo "<h1><font color=green>Nový katalogový list stroje (ID: ".$ide.") byl úspìšnì uložen do databáze !</font></h1><hr>";

		$koncovky = array('pdf');

		$nametemp=$ide;
		
$nazevfi='file2';
if ($_FILES[$nazevfi]['name']){
	$fileat="./katalog/".$ide.".pdf";
	if (in_array(strtolower(pathinfo($_FILES[$nazevfi]["name"], PATHINFO_EXTENSION)), $koncovky)) {
		move_uploaded_file($_FILES[$nazevfi]['tmp_name'],$fileat);
    }
}

$koncovky = array('jpg', 'jpeg');
		
$nazevfi='file';
if ($_FILES[$nazevfi]['name']){
		$fileat = "./photo/temp/".$nametemp.".jpg";


		$velikost=getImageSize($_FILES[$nazevfi]['tmp_name']);
		$width=$velikost[0]; 
		$height=$velikost[1];
		$width1=$velikost[0]; 
		$height1=$velikost[1];
		$druh=$velikost[2];
		$small=0;


		
		if ($width>$height){
			if ($width<400) $small=1;
			if ($height<400) $small=1;
		}else{
			if ($height<400) $small=1;
			if ($width<400) $small=1;
		}
	$i="";
		$langb[174]="Foto";
		$langb[175]="Nahrávání obrázkù mùže trvat velice dlouho - v závislosti na rychlosti vašeho pøipojení k internetu!";
		$langb[176]="Nevybrali jste soubor, který chcete nahrát";
		$langb[177]="Soubor se nepodaøilo nahrát, kontaktujte prosím správce serveru";
		$langb[178]="Soubor je vìtší než 4 Mb";
		$langb[179]="Koncovka souboru musí být jedna z";

		$langb[180]="Malé rozlišení fotky. Minimální požadované je 400x400";
		$langb[181]="Soubor musí být ve formátu";
		$langb[182]="Chyba pøi ukládání! Zkuste to, prosím, znovu. Mùžete se pokusit zmìnit obrázek v aplikaci Malování nebo IrfanView";

    if ($_FILES[$nazevfi]["error"] == UPLOAD_ERR_NO_FILE) {
        $chyb1 = $langb[174]." ".$i.": ".$langb[176].".\n";
        $uspech=5;
    } elseif ($_FILES[$nazevfi]["error"]) {
        $chyb1 = $langb[174]." ".$i.": ".$langb[177].".\n";
        $uspech=5;
    } elseif ($_FILES[$nazevfi]["size"]>6000000) {
        $chyb1 = $langb[174]." ".$i.": ".$langb[178].".\n";
        $uspech=5;
    } elseif (!in_array(strtolower(pathinfo($_FILES[$nazevfi]["name"], PATHINFO_EXTENSION)), $koncovky)) {
        $chyb1 = $langb[174]." ".$i.": ".$langb[179].": " . implode(", ", $koncovky) . ".\n";
        $uspech=5;
    } elseif($small==1){
        $chyb1 = $langb[174]." ".$i.": ".$langb[180].".\n";
        $uspech=5;
    } elseif($druh!=2){
        $chyb1 = $langb[174]." ".$i.": ".$langb[181].": " . implode(", ", $koncovky) . "\n";
        $uspech=5;
    }

	
    if ($chyb2) {$chyb2="<br>".$chyb2;$fotok[$i]=0;}
    else  {


	$cesta=$fileat;
	$cestaN=$fileat;
	$cesta2="./photo/hi/".$i.$nametemp.".jpg";
	$cesta3="./photo/low/".$i.$nametemp.".jpg";
	ini_set('memory_limit','256M');

	
		move_uploaded_file($_FILES[$nazevfi]['tmp_name'],$fileat);
		$fotok[$i]=1;

   if ($width1>$height1){
	   if ($width1>1280) {$width2=1280;$height2=$height1/$width1*1280;}
	   else {$width2=$width1;$height2=$height1;}
   }else{
	   if ($height1>1280) {$height2=1280;$width2=$width1/$height1*1280;}
	   else {$height2=$height1;$width2=$width1;}
   }
	$width2=ceil($width2);
	$height2=ceil($height2);
	
	$fotonazev[$i]=$i.$nametemp;
	$fotoparametry[$i]=$width2."#".$height2;

	
   $vstup=ImageCreateFromjpeg($cesta);
   $vystup=ImageCreatetruecolor($width2,$height2);
   imagecopyresampled($vystup,$vstup,0,0,0,0,$width2,$height2,$width1,$height1);
   $grey = imagecolorallocate($vystup, 128, 128, 128);
   $white= imagecolorallocate($vystup, 255, 255, 255);
   $brown= imagecolorallocate($vystup, 128, 0, 0);
   $text = "K122, ÈVUT v Praze, Fakulta stavební";
   $numbercolor=ImageColorsTotal($vystup);
   imagestring($vystup,4, 5, 5,  $text,$white);
   imagestring($vystup,4, 3, 3,  $text,$brown);

   $text = $nazev;
   imagestring($vystup,4, 5, 20,  $text,$white);
   imagestring($vystup,4, 3, 18,  $text,$brown);

   $blue= imagecolorallocate($vystup, 0, 64, 128);
   $text = "www.celysvet.cz/model";
   imagestring($vystup,4, 5, 35,  $text,$white);
   imagestring($vystup,4, 3, 33,  $text,$blue);

   $kvalitan=90;
   if ($kvalita==1) $kvalitan=90;
   if ($kvalita==2) $kvalitan=90;
   if ($kvalita==3) $kvalitan=90;
   ImageJpeg($vystup,$cesta2,$kvalitan);
   ImageDestroy($vystup);
   

   $vel=$velikost[1]*180/$velikost[0];
   $vel_nahled="150x".ceil($vel);
   $vel_hi=ceil($width2)."x".ceil($height2);

   $vystup=ImageCreatetruecolor(180,$vel);
   imagecopyresampled($vystup,$vstup,0,0,0,0,180,$vel,$velikost[0],$velikost[1]);
   ImageJpeg($vystup,$cesta3,90);

   ImageDestroy($vystup);
   ImageDestroy($vstup);

   if ($numbercolor==1)  { unlink($cesta2);    unlink($cesta3);} 
   $rozmer=filesize($cesta2);

   unlink($cesta); 
   unlink($cestaN); 
		
	
		
	}

	
	
	if ($uspech) {
		$fotok[$i]=0;
		unlink($filea);
		unlink($fileaa);
		unlink($fileat);
		echo "<b>".$langb[182]."<br><br></b>";
		if ($chyb) echo $chyb."<br><br>";
		echo "<input name=\"Submit2\" type=\"button\" onClick=\"history.back()\" value=\"Zpìt...\">";

	}
	else $fotok[$i]=1;
}

		
		$status=0;
	}else 	echo '<center><input type=button onclick="history.back()" value="Zpìt"></center>';

}

// Novy zaznam tabulky - formular
if ($status==1){
?>
<form  name="f1" ACTION='./katalogovy-list?sid=<?php echo $sid;?>&amp;sid2=<?php echo $sid2;?>' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="101">
<h2><font color="green">Vložení nového katalogového listu stroje:</font></h2>
<table>
<tr><td class='row2'>Název stroje:</td><td class='row2'><input type='text' value='' name='nazev' MAXLENGTH='50'  size='50'></td><td class='row2'>pozn.: <em>vèetnì názvu, typu a oznaèení, napø.: Nakladaè øízený smykem CAT 226B/B2</em></td></tr>
<tr><td class='row1'>První skupina stroje:</td><td class='row1'>
<select name="skupina1"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_1 order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($clanky['id']==$sid) echo "<option value='".$clanky['id']."' selected='selected'>".$clanky['nazev']."</option>";
		else  echo "<option value='".$clanky['id']."'>".$clanky['nazev']."</option>";
	}
?></select>
</td><td class='row1'>pozn.: <em>viz tabulka databáze: optimalizace_skupiny_stroju_1</em>
</td></tr>
<tr><td class='row2'>Druhá skupina stroje:</td><td class='row2'>
<select name="skupina2"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_2 order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($clanky['id']==$sid2) echo "<option value='".$clanky['id']."' selected='selected'>".$clanky['nazev']."</option>";
		else echo "<option value='".$clanky['id']."'>".$clanky['nazev']."</option>";
	}
?></select>
</td><td class='row2'>pozn.: <em>viz tabulka databáze: optimalizace_skupiny_stroju_2</em></td></tr>
<tr><td class='row1'>Typ stroje:</td><td class='row1'><input type='text' value='' name='typ' MAXLENGTH='50'  size='50'></td><td class='row1'>pozn.: <em>oznaèení dle výrobce, napø. CAT 226B/B2</em></td></tr>
<tr><td class='row2'>Druh prvku:</td><td class='row2'>
<select name="druh_prvku"><option value="1">Obsluhující prvek</option><option value="2">Obsluhovaný prvek</option><option value="3" selected="selected">Samostatný prvek</option>
</select></td><td class='row2'>pozn.: <em>oznaèení dle teorie front: obsluhující prvek, zákazník, samostatný prvek atd.</em></td></tr>
<tr><td class='row1'>Výkon motoru, [kW]:</td><td class='row1'><input type='text' value='' name='vykon_kW' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>výkon motoru dle výrobce [kW] resp. [k]</em></td></tr>
<tr><td class='row2'>Prázdná provozní hmotnost, [kg]:</td><td class='row2'><input type='text' value='' name='provozni_hmotnost_kg' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>provozní hmotnost dle výrobce [kg]</em></td></tr>
<tr><td class='row1'>Délka, [cm]:</td><td class='row1'><input type='text' value='' name='delka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>délka stroje dle výrobce [cm]</em></td></tr>
<tr><td class='row2'>Šírka, [cm]:</td><td class='row2'><input type='text' value='' name='sirka_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>šíøka stroje dle výrobce [cm]</em></td></tr>
<tr><td class='row1'>Výška, [cm]:</td><td class='row1'><input type='text' value='' name='vyska_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>výška stroje dle výrobce [cm]</em></td></tr>
<tr><td class='row2'>Maximální rychlost, [km/h]:</td><td class='row2'><input type='text' value='' name='max_rychlost_km_h' MAXLENGTH='5'  size='10'></td><td class='row2'>pozn.: <em>maximální rychlost pohybu stroje dle výrobce [km/h]</em></td></tr>
<tr><td class='row1'>Provozní rychlost, [km/h]:</td><td class='row1'><input type='text' value='' name='provozni_rychlost_km_h' MAXLENGTH='5'  size='10'></td><td class='row1'>pozn.: <em>prùmìrná rychlost pohybu stroje dle výrobce [km/h]</em></td></tr>
<tr><td class='row2'>Stoupavost, [grad]:</td><td class='row2'><input type='text' value='' name='stoupavost_stupnu' MAXLENGTH='50'  size='3'></td><td class='row2'>pozn.: <em>maximální stoupavost stroje dle výrobce [grad]</em></td></tr>
<tr><td class='row1'>Tlak na zeminu, [kPa]:</td><td class='row1'><input type='text' value='' name='tlak_na_zeminu_kPa' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>tlak na zeminu [kPa]</em></td></tr>
<tr><td class='row1'>Dosah hloubka, [cm]:</td><td class='row1'><input type='text' value='' name='dosah_hloubka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>hloubkový dosah stroje dle výrobce, [cm]</em></td></tr>
<tr><td class='row2'>Dosah výška, [cm]:</td><td class='row2'><input type='text' value='' name='dosah_vyska_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>výškový dosah stroje dle výrobce, [cm]</em></td></tr>
<tr><td class='row1'>Dosah délka, [cm]:</td><td class='row1'><input type='text' value='' name='dosah_delka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>dosah stroje na délku dle výrobce, [cm]</em></td></tr>
<tr><td class='row2'>Polomìr otáèení, [cm]:</td><td class='row2'><input type='text' value='' name='polomer_otaceni_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>hloubkový dosah stroje dle výrobce, [cm]</em></td></tr>
<tr><td class='row1'>Poznámka:</td><td class='row1'><input type='text' value='' name='poznamka' MAXLENGTH='50'  size='50'></td><td class='row1'>pozn.: <em>vlastní poznámka</em></td></tr>
<tr><td class='row2'>Spotøeba paliva vysoká, [ml/h]:</td><td class='row2'><input type='text' value='' name='spotreba_paliva_hi_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>odhad spotøeby paliva dle výrobce pro maximální vytížení stroje (80-100%)</em></td></tr>
<tr><td class='row1'>Spotøeba paliva støední, [ml/h]:</td><td class='row1'><input type='text' value='' name='spotreba_paliva_medium_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>odhad spotøeby paliva dle výrobce pro prùmìrné vytížení stroje (60-80%)</em></td></tr>
<tr><td class='row2'>Spotøeba paliva nízká, [ml/h]:</td><td class='row2'><input type='text' value='' name='spotreba_paliva_low_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>odhad spotøeby paliva dle výrobce pro minimální vytížení stroje (40-60%)</em></td></tr>
<tr><td class='row1'>CO<sub>2</sub> vysoká, [g/h]:</td><td class='row1'><input type='text' value='' name='co2_hi_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>odhad produkce CO<sub>2</sub> dle výrobce pro maximální vytížení stroje (80-100%)</em></td></tr>
<tr><td class='row2'>CO<sub>2</sub> støední, [g/h]:</td><td class='row2'><input type='text' value='' name='co2_medium_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>odhad produkce CO<sub>2</sub> dle výrobce pro prùmìrné vytížení stroje (80-100%)</em></td></tr>
<tr><td class='row1'>CO<sub>2</sub> nízká, [g/h]:</td><td class='row1'><input type='text' value='' name='co2_low_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>odhad produkce CO<sub>2</sub> dle výrobce pro minimální vytížení stroje (80-100%)</em></td></tr>
<tr><td class='row2'>Hluk v interiéru, [dB]:</td><td class='row2'><input type='text' value='' name='hluk_int' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>hluk stroje v interiéru dle výrobce, [dB]</em></td></tr>
<tr><td class='row1'>Hluk v exteriéru, [dB]:</td><td class='row1'><input type='text' value='' name='hluk_ext' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>hluk stroje v exteriéru dle výrobce, [dB]</em></td></tr>
<tr><td class='row2'>Náklady, standardní sazba, [Kè/h]:</td><td class='row2'><input type='text' value='' name='naklady_standardni_sazba_kc_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>standardní hodinová sazba pronájmu stroje vèetnì obsluhy bez PHM, [Kè/h]</em></td></tr>
<tr><td class='row1'>Náklady, pøesèasová sazba, [Kè/h]:</td><td class='row1'><input type='text' value='' name='naklady_prescasova_sazba_kc_hod' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>pøesèasová hodinová sazba pronájmu stroje vèetnì obsluhy bez PHM, [Kè/h]</em></td></tr>
<tr><td class='row2'>Náklady na použití, [Kè]:</td><td class='row2'><input type='text' value='' name='naklady_na_pouziti_kc' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>náklady na celý úkol nebo náklad na použití stroje (pøísun, odsun, školení personálu), [Kè]</em></td></tr>
<tr><td class='row1'>Cena stroje, [Kè]:</td><td class='row1'><input type='text' value='' name='cena_stroje' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>cena stroje dle prodejních katalogù výrobce, [Kè]</em></td></tr>
<tr><td class='row1'>Cena stroje, [USD]:</td><td class='row1'><input type='text' value='' name='cena_stroje_USD' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>cena stroje dle prodejních katalogù výrobce, [USD]</em></td></tr>
<tr><td class='row2'>Pravdìpodobnost poruchy, [poèet poruch/1000 h]:</td><td class='row2'><input type='text' value='' name='pravdepodobnost_poruchy_1000_hod' MAXLENGTH='50'  size='3'></td><td class='row2'>pozn.: <em>prùmìrný poèet poruch stroje bìhem 1000 hodin práce</em></td></tr>
<tr><td class='row1'>Prùmìrná doba opravy, [min]:</td><td class='row1'><input type='text' value='' name='prumerna_doba_opravy_min' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>prùmìrná doba opravy stroje dle výrobce, [min]</em></td></tr>
<tr><td class='row2'>Prùmìrná cena opravy, [Kè]:</td><td class='row2'><input type='text' value='' name='prumerna_cena_opravy_kc' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>prùmìrná cena opravy stroje dle výrobce, [Kè]</em></td></tr>
<tr><td class='row1'>Prùmìrná doba služby, [let]:</td><td class='row1'><input type='text' value='' name='prumerna_doba_sluzby_let' MAXLENGTH='50'  size='3'></td><td class='row1'>pozn.: <em>prùmìrná doba služby stroje za podmínky servisu dle výrobce, [let]</em></td></tr>
<tr><td class='row2'>Minimální pracovní plocha, [m<sup>2</sup>]:</td><td class='row2'><input type='text' value='' name='minimalni_pracovni_plocha_m2' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>minimální pracovní plocha nutná pro stroj, bez ztráty výkonu, [m<sup>2</sup>]</em></td></tr>
<tr><td class='row1'>Poèet jednotek, [-]:</td><td class='row1'><input type='text' value='' name='pocet_jednotek' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>poèet jednotek stroje, napø. objem korby, lopaty, délka radlice atd. [-]</em></td></tr>
<tr><td class='row2'>Jednotka:</td><td class='row2'><input type='text' value='' name='jednotka' MAXLENGTH='50'  size='20'></td><td class='row2'>pozn.: <em>jednotka stroje, napø. m<sup>3</sup>,m<sup>2</sup>,bm, kg atd.</em></td></tr>
<tr><td class='row1'>Pracovní výkon, [jednotka/h]:</td><td class='row1'><input type='text' value='' name='pracovni_vykon_jednotka_hod' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>pracovní výkon stroje, [jednotka/h]  </em></td></tr>
<tr><td class='row2'>Pracovní cyklus, [s]:</td><td class='row2'><input type='text' value='' name='pracovni_cyklus_sek' MAXLENGTH='50'  size='6'></td><td class='row2'>pozn.: <em>pracovní cyklus stroje, [sek]</em></td></tr>
<tr><td class='row1'>Výrobce:</td><td class='row1'>
<select name="vyrobce"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_vyrobce order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo "<option value='".$clanky['nazev']."'>".$clanky['nazev']."</option>";
	}
?></select> nebo 
<input type='text' value='' name='vyrobce2' MAXLENGTH='50'  size='20'>
</td><td class='row1'>pozn.: <em>viz tabulka databáze: optimalizace_vyrobce</em></td></tr>

<tr><td class='row2'>Nahrát foto stroje:</td><td class='row2'><input name="file" type="file"></td>
</td><td class='row2'>pozn.: <em>jen ve formátu: JPG, minimální rozlišení 640x480 pixelù.</em></td></tr>

<tr><td class='row1'>Nahrát katalogový list výrobce:</td><td class='row1'><input name="file2" type="file"></td>
</td><td class='row1'>pozn.: <em>jen ve formátu: PDF.</em></td></tr>

<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Uložit">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zpìt"></td></tr>
</table>
</form>
<?php
}


// Vymazavani zaznamu
if ($status==9){
	$id = kontrola($_GET['id']);
	$getclanek = mysql_query("SELECT * FROM `optimalizace_katalog_stroju` where id='".$id."' Limit 0,1",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$CisKlic=$clanky['id'];
		$NazCin=$clanky['nazev'];
		$vyrobce=$clanky['vyrobce'];
	}
	echo "<h1><font color=red>Opravdu chcete vymazat stroj:  ".$id." / ".$NazCin." / ".$vyrobce." ?</font></h1>";

	echo "<b><a href='katalogovy-list?sid=".$sid."&amp;sid2=".$sid2."&amp;status=901&amp;id=".$id."'>ANO</a>&nbsp;&nbsp;<a href='katalogovy-list?sid=".$sid."&amp;sid2=".$sid2."'>NE</a></b><br><br>";

}


// Vymazavani zaznamu z tabulky MySQL
if ($status==901){
	$id = kontrola($_GET['id']);
	mysql_query("DELETE FROM `optimalizace_katalog_stroju` where id='".$id."'",$connect2);
	unlink("./photo/low/".$id.".jpg");
	unlink("./photo/hi/".$id.".jpg");
	unlink("./katalog/".$id.".pdf");
	echo "<h1><font color=green>Stroj byl úspìšnì vymazán z databáze !</font></h1><hr>";
	$status=0;
}

// Ukladani zmen do MySQL
if ($status==601){


$id=kontrola($_POST['id']);
$nazev=kontrolaN($_POST['nazev']);
$skupina1=kontrola($_POST['skupina1']);
$skupina2=kontrola($_POST['skupina2']);
$typ=kontrola($_POST['typ']);

$druh_prvku=kontrola($_POST['druh_prvku']);
if ($druh_prvku<1) $druh_prvku=1;
if ($druh_prvku>3) $druh_prvku=3;
$vykon_kW=kontrola($_POST['vykon_kW']);
$provozni_hmotnost_kg=kontrola($_POST['provozni_hmotnost_kg']);
$delka_cm=kontrola($_POST['delka_cm']);
$sirka_cm=kontrola($_POST['sirka_cm']);
$vyska_cm=kontrola($_POST['vyska_cm']);
$max_rychlost_km_h=kontrola($_POST['max_rychlost_km_h']);
$provozni_rychlost_km_h=kontrola($_POST['provozni_rychlost_km_h']);
$stoupavost_stupnu=kontrola($_POST['stoupavost_stupnu']);
$tlak_na_zeminu_kPa=kontrola($_POST['tlak_na_zeminu_kPa']);
$pridavne_zarizeni_1=kontrola($_POST['pridavne_zarizeni_1']);
$pridavne_zarizeni_2=kontrola($_POST['pridavne_zarizeni_2']);
$pridavne_zarizeni_3=kontrola($_POST['pridavne_zarizeni_3']);
$pridavne_zarizeni_4=kontrola($_POST['pridavne_zarizeni_4']);
$pridavne_zarizeni_5=kontrola($_POST['pridavne_zarizeni_5']);
$dosah_hloubka_cm=kontrola($_POST['dosah_hloubka_cm']);
$dosah_vyska_cm=kontrola($_POST['dosah_vyska_cm']);
$dosah_delka_cm=kontrola($_POST['dosah_delka_cm']);
$polomer_otaceni_cm=kontrola($_POST['polomer_otaceni_cm']);
$poznamka=kontrolaN($_POST['poznamka']);
$spotreba_paliva_hi_ml_hod=kontrola($_POST['spotreba_paliva_hi_ml_hod']);
$spotreba_paliva_medium_ml_hod=kontrola($_POST['spotreba_paliva_medium_ml_hod']);
$spotreba_paliva_low_ml_hod=kontrola($_POST['spotreba_paliva_low_ml_hod']);
$co2_hi_ml_hod=kontrola($_POST['co2_hi_ml_hod']);
$co2_medium_ml_hod=kontrola($_POST['co2_medium_ml_hod']);
$co2_low_ml_hod=kontrola($_POST['co2_low_ml_hod']);
$hluk_int=kontrola($_POST['hluk_int']);
$hluk_ext=kontrola($_POST['hluk_ext']);
$naklady_standardni_sazba_kc_hod=kontrola($_POST['naklady_standardni_sazba_kc_hod']);
$naklady_prescasova_sazba_kc_hod=kontrola($_POST['naklady_prescasova_sazba_kc_hod']);
$naklady_na_pouziti_kc=kontrola($_POST['naklady_na_pouziti_kc']);
$cena_stroje=kontrola($_POST['cena_stroje']);
$cena_stroje_USD=kontrola($_POST['cena_stroje_USD']);
$pravdepodobnost_poruchy_1000_hod=kontrola($_POST['pravdepodobnost_poruchy_1000_hod']);
$prumerna_doba_opravy_min=kontrola($_POST['prumerna_doba_opravy_min']);
$prumerna_cena_opravy_kc=kontrola($_POST['prumerna_cena_opravy_kc']);
$prumerna_doba_sluzby_let=kontrola($_POST['prumerna_doba_sluzby_let']);
$minimalni_pracovni_plocha_m2=kontrola($_POST['minimalni_pracovni_plocha_m2']);
$pocet_jednotek=kontrola($_POST['pocet_jednotek']);
$jednotka=kontrola($_POST['jednotka']);
$pracovni_vykon_jednotka_hod=kontrola($_POST['pracovni_vykon_jednotka_hod']);
$pracovni_cyklus_sek=kontrola($_POST['pracovni_cyklus_sek']);
$vyrobce=kontrola($_POST['vyrobce2']);
if (!$vyrobce) $vyrobce=kontrola($_POST['vyrobce']);

$CisKlic=$id;



	$chyba=0;

	if (!$CisKlic) {
		echo "<h1><font color=red>Chyba ! Kód èinnosti nesmí být prázdný !</font></h1>";
		$chyba=1;
	}

	if (!$nazev) {
		echo "<h1><font color=red>Chyba! Název stroje nesmí být prázdný!</font></h1>";
		$chyba=1;
	}
	if (!$chyba){ 
	
		$pracovni_vykon_jednotka_hod=$pocet_jednotek/$pracovni_cyklus_sek*3600;
		
		mysql_query("REPLACE INTO `optimalizace_katalog_stroju` ( `id` ,`nazev` , `skupina1` , `skupina2` , `typ` , `druh_prvku` , `vykon_kW` , `provozni_hmotnost_kg` , `delka_cm` , `sirka_cm` , `vyska_cm` , `max_rychlost_km_h` , `provozni_rychlost_km_h` , `stoupavost_stupnu` , `tlak_na_zeminu_kPa` , `pridavne_zarizeni_1` , `pridavne_zarizeni_2` , `pridavne_zarizeni_3` , `pridavne_zarizeni_4` , `pridavne_zarizeni_5` , `dosah_hloubka_cm` , `dosah_vyska_cm` , `dosah_delka_cm` , `polomer_otaceni_cm` , `poznamka` , `spotreba_paliva_hi_ml_hod` , `spotreba_paliva_medium_ml_hod` , `spotreba_paliva_low_ml_hod` , `co2_hi_ml_hod` , `co2_medium_ml_hod` , `co2_low_ml_hod` , `hluk_int` , `hluk_ext` , `naklady_standardni_sazba_kc_hod` , `naklady_prescasova_sazba_kc_hod` , `naklady_na_pouziti_kc` , `cena_stroje` , `pravdepodobnost_poruchy_1000_hod` , `prumerna_doba_opravy_min` , `prumerna_cena_opravy_kc` , `prumerna_doba_sluzby_let`, `minimalni_pracovni_plocha_m2` , `pocet_jednotek` , `jednotka` , `pracovni_vykon_jednotka_hod` , `pracovni_cyklus_sek` , `vyrobce`,`cena_stroje_USD` ) 
VALUES ('$id','$nazev', '$skupina1', '$skupina2', '$typ', '$druh_prvku', '$vykon_kW', '$provozni_hmotnost_kg', '$delka_cm', '$sirka_cm', '$vyska_cm', '$max_rychlost_km_h', '$provozni_rychlost_km_h', '$stoupavost_stupnu', '$tlak_na_zeminu_kPa', '$pridavne_zarizeni_1', '$pridavne_zarizeni_2', '$pridavne_zarizeni_3', '$pridavne_zarizeni_4', '$pridavne_zarizeni_5', '$dosah_hloubka_cm', '$dosah_vyska_cm', '$dosah_delka_cm', '$polomer_otaceni_cm', '$poznamka', '$spotreba_paliva_hi_ml_hod', '$spotreba_paliva_medium_ml_hod', '$spotreba_paliva_low_ml_hod', '$co2_hi_ml_hod', '$co2_medium_ml_hod', '$co2_low_ml_hod', '$hluk_int', '$hluk_ext', '$naklady_standardni_sazba_kc_hod', '$naklady_prescasova_sazba_kc_hod', '$naklady_na_pouziti_kc', '$cena_stroje', '$pravdepodobnost_poruchy_1000_hod', '$prumerna_doba_opravy_min', '$prumerna_cena_opravy_kc', '$prumerna_doba_sluzby_let', '$minimalni_pracovni_plocha_m2', '$pocet_jednotek', '$jednotka', '$pracovni_vykon_jednotka_hod', '$pracovni_cyklus_sek', '$vyrobce','$cena_stroje_USD');",$connect2);

		
		$ide=$id;

		echo "<h1><font color=green>Zmìny byly uloženy do databáze !</font></h1><hr>";

		$koncovky = array('pdf');

		$nametemp=$ide;
		
$nazevfi='file2';
if ($_FILES[$nazevfi]['name']){
	$fileat="./katalog/".$ide.".pdf";
	if (in_array(strtolower(pathinfo($_FILES[$nazevfi]["name"], PATHINFO_EXTENSION)), $koncovky)) {
		move_uploaded_file($_FILES[$nazevfi]['tmp_name'],$fileat);
    }
}

$koncovky = array('jpg', 'jpeg');
		
$nazevfi='file';
if ($_FILES[$nazevfi]['name']){
		$fileat = "./photo/temp/".$nametemp.".jpg";


		$velikost=getImageSize($_FILES[$nazevfi]['tmp_name']);
		$width=$velikost[0]; 
		$height=$velikost[1];
		$width1=$velikost[0]; 
		$height1=$velikost[1];
		$druh=$velikost[2];
		$small=0;


		
		if ($width>$height){
			if ($width<400) $small=1;
			if ($height<400) $small=1;
		}else{
			if ($height<400) $small=1;
			if ($width<400) $small=1;
		}
	$i="";
		$langb[174]="Foto";
		$langb[175]="Nahrávání obrázkù mùže trvat velice dlouho - v závislosti na rychlosti vašeho pøipojení k internetu!";
		$langb[176]="Nevybrali jste soubor, který chcete nahrát";
		$langb[177]="Soubor se nepodaøilo nahrát, kontaktujte prosím správce serveru";
		$langb[178]="Soubor je vìtší než 4 Mb";
		$langb[179]="Koncovka souboru musí být jedna z";

		$langb[180]="Malé rozlišení fotky. Minimální požadované je 400x400";
		$langb[181]="Soubor musí být ve formátu";
		$langb[182]="Chyba pøi ukládání! Zkuste to, prosím, znovu. Mùžete se pokusit zmìnit obrázek v aplikaci Malování nebo IrfanView";

    if ($_FILES[$nazevfi]["error"] == UPLOAD_ERR_NO_FILE) {
        $chyb1 = $langb[174]." ".$i.": ".$langb[176].".\n";
        $uspech=5;
    } elseif ($_FILES[$nazevfi]["error"]) {
        $chyb1 = $langb[174]." ".$i.": ".$langb[177].".\n";
        $uspech=5;
    } elseif ($_FILES[$nazevfi]["size"]>6000000) {
        $chyb1 = $langb[174]." ".$i.": ".$langb[178].".\n";
        $uspech=5;
    } elseif (!in_array(strtolower(pathinfo($_FILES[$nazevfi]["name"], PATHINFO_EXTENSION)), $koncovky)) {
        $chyb1 = $langb[174]." ".$i.": ".$langb[179].": " . implode(", ", $koncovky) . ".\n";
        $uspech=5;
    } elseif($small==1){
        $chyb1 = $langb[174]." ".$i.": ".$langb[180].".\n";
        $uspech=5;
    } elseif($druh!=2){
        $chyb1 = $langb[174]." ".$i.": ".$langb[181].": " . implode(", ", $koncovky) . "\n";
        $uspech=5;
    }

	
    if ($chyb2) {$chyb2="<br>".$chyb2;$fotok[$i]=0;}
    else  {


	$cesta=$fileat;
	$cestaN=$fileat;
	$cesta2="./photo/hi/".$i.$nametemp.".jpg";
	$cesta3="./photo/low/".$i.$nametemp.".jpg";
	ini_set('memory_limit','128M');

	
		move_uploaded_file($_FILES[$nazevfi]['tmp_name'],$fileat);
		$fotok[$i]=1;

   if ($width1>$height1){
	   if ($width1>1280) {$width2=1280;$height2=$height1/$width1*1280;}
	   else {$width2=$width1;$height2=$height1;}
   }else{
	   if ($height1>1280) {$height2=1280;$width2=$width1/$height1*1280;}
	   else {$height2=$height1;$width2=$width1;}
   }
	$width2=ceil($width2);
	$height2=ceil($height2);
	
	$fotonazev[$i]=$i.$nametemp;
	$fotoparametry[$i]=$width2."#".$height2;

	
   $vstup=ImageCreateFromjpeg($cesta);
   $vystup=ImageCreatetruecolor($width2,$height2);
   imagecopyresampled($vystup,$vstup,0,0,0,0,$width2,$height2,$width1,$height1);
   $grey = imagecolorallocate($vystup, 128, 128, 128);
   $white= imagecolorallocate($vystup, 255, 255, 255);
   $brown= imagecolorallocate($vystup, 128, 0, 0);

   $text = "K122, ÈVUT v Praze, Fakulta stavební";
   $numbercolor=ImageColorsTotal($vystup);
   imagestring($vystup,4, 5, 5,  $text,$white);
   imagestring($vystup,4, 3, 3,  $text,$brown);

   $text = $nazev;
   imagestring($vystup,4, 5, 20,  $text,$white);
   imagestring($vystup,4, 3, 18,  $text,$brown);
   
   $blue= imagecolorallocate($vystup, 0, 64, 128);
   $text = "www.celysvet.cz/model";
   imagestring($vystup,4, 5, 35,  $text,$white);
   imagestring($vystup,4, 3, 33,  $text,$blue);

   
   $kvalitan=90;
   if ($kvalita==1) $kvalitan=90;
   if ($kvalita==2) $kvalitan=90;
   if ($kvalita==3) $kvalitan=90;
   ImageJpeg($vystup,$cesta2,$kvalitan);
   ImageDestroy($vystup);
   

   $vel=$velikost[1]*180/$velikost[0];
   $vel_nahled="150x".ceil($vel);
   $vel_hi=ceil($width2)."x".ceil($height2);

   $vystup=ImageCreatetruecolor(180,$vel);
   imagecopyresampled($vystup,$vstup,0,0,0,0,180,$vel,$velikost[0],$velikost[1]);
   ImageJpeg($vystup,$cesta3,90);

   ImageDestroy($vystup);
   ImageDestroy($vstup);

   if ($numbercolor==1)  { unlink($cesta2);    unlink($cesta3);} 
   $rozmer=filesize($cesta2);

   unlink($cesta); 
   unlink($cestaN); 
		
	
		
	}

	
	
	if ($uspech) {
		$fotok[$i]=0;
		unlink($filea);
		unlink($fileaa);
		unlink($fileat);
		echo "<b>".$langb[182]."<br><br></b>";
		if ($chyb) echo $chyb."<br><br>";
		echo "<input name=\"Submit2\" type=\"button\" onClick=\"history.back()\" value=\"Zpìt...\">";

	}
	else $fotok[$i]=1;
}

		
		$status=0;



	}else 	echo '<center><input type=button onclick="history.back()" value="Zpìt"></center>';



}


// Editace cinnosti - formular
if ($status==6){

	$id = kontrola($_GET['id']);


	$getclanek = mysql_query("SELECT * FROM optimalizace_katalog_stroju where id='$id'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){


$id= $clanky['id'];
$nazev= $clanky['nazev'];
$skupina1= $clanky['skupina1'];
$skupina2= $clanky['skupina2'];
$typ= $clanky['typ'];
$druh_prvku= $clanky['druh_prvku'];
$vykon_kW= $clanky['vykon_kW'];
$provozni_hmotnost_kg= $clanky['provozni_hmotnost_kg'];
$delka_cm= $clanky['delka_cm'];
$sirka_cm= $clanky['sirka_cm'];
$vyska_cm= $clanky['vyska_cm'];
$max_rychlost_km_h= $clanky['max_rychlost_km_h'];
$provozni_rychlost_km_h= $clanky['provozni_rychlost_km_h'];
$stoupavost_stupnu= $clanky['stoupavost_stupnu'];
$tlak_na_zeminu_kPa= $clanky['tlak_na_zeminu_kPa'];
$pridavne_zarizeni_1= $clanky['pridavne_zarizeni_1'];
$pridavne_zarizeni_2= $clanky['pridavne_zarizeni_2'];
$pridavne_zarizeni_3= $clanky['pridavne_zarizeni_3'];
$pridavne_zarizeni_4= $clanky['pridavne_zarizeni_4'];
$pridavne_zarizeni_5= $clanky['pridavne_zarizeni_5'];
$dosah_hloubka_cm= $clanky['dosah_hloubka_cm'];
$dosah_vyska_cm= $clanky['dosah_vyska_cm'];
$dosah_delka_cm= $clanky['dosah_delka_cm'];
$polomer_otaceni_cm= $clanky['polomer_otaceni_cm'];
$poznamka= $clanky['poznamka'];
$spotreba_paliva_hi_ml_hod= $clanky['spotreba_paliva_hi_ml_hod'];
$spotreba_paliva_medium_ml_hod= $clanky['spotreba_paliva_medium_ml_hod'];
$spotreba_paliva_low_ml_hod= $clanky['spotreba_paliva_low_ml_hod'];
$co2_hi_ml_hod= $clanky['co2_hi_ml_hod'];
$co2_medium_ml_hod= $clanky['co2_medium_ml_hod'];
$co2_low_ml_hod= $clanky['co2_low_ml_hod'];
$hluk_int= $clanky['hluk_int'];
$hluk_ext= $clanky['hluk_ext'];
$naklady_standardni_sazba_kc_hod= $clanky['naklady_standardni_sazba_kc_hod'];
$naklady_prescasova_sazba_kc_hod= $clanky['naklady_prescasova_sazba_kc_hod'];
$naklady_na_pouziti_kc= $clanky['naklady_na_pouziti_kc'];
$cena_stroje= $clanky['cena_stroje'];
$cena_stroje_USD=$clanky['cena_stroje_USD'];
$pravdepodobnost_poruchy_1000_hod= $clanky['pravdepodobnost_poruchy_1000_hod'];
$prumerna_doba_opravy_min= $clanky['prumerna_doba_opravy_min'];
$prumerna_cena_opravy_kc= $clanky['prumerna_cena_opravy_kc'];
$prumerna_doba_sluzby_let= $clanky['prumerna_doba_sluzby_let'];
$minimalni_pracovni_plocha_m2= $clanky['minimalni_pracovni_plocha_m2'];
$pocet_jednotek= $clanky['pocet_jednotek'];
$jednotka= $clanky['jednotka'];
$pracovni_vykon_jednotka_hod= $clanky['pracovni_vykon_jednotka_hod'];
$pracovni_cyklus_sek= $clanky['pracovni_cyklus_sek'];
$vyrobce= $clanky['vyrobce'];

		
		if ($row==1) $row=2;else $row=1;

	}



?>
<form name="f1" ACTION='./katalogovy-list?sid=<?php echo $sid;?>&amp;sid2=<?php echo $sid2;?>' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="601">
<input type="hidden" name="id" value="<?php echo $id;?>">
<h2><font color="green">Editáce katalogového listu stroje:</font></h2>
<table>
<tr><td class='row1'>ID stroje</td><td class='row1'><b><?php echo $id;?></b></td><td class='row1'></td></tr>
<tr><td class='row2'>Název stroje:</td><td class='row2'><input type='text' value='<?php echo $nazev;?>' name='nazev' MAXLENGTH='50'  size='50'></td><td class='row2'>pozn.: <em>vèetnì názvu, typu a oznaèení, napø.: Nakladaè øízený smykem CAT 226B/B2</em></td></tr>
<tr><td class='row1'>První skupina stroje:</td><td class='row1'>
<select name="skupina1"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_1 order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($skupina1==$clanky['id']) echo "<option selected='selected' value='".$clanky['id']."'>".$clanky['nazev']."</option>";
		else  echo "<option value='".$clanky['id']."'>".$clanky['nazev']."</option>";
	}
?></select>
</td><td class='row1'>pozn.: <em>viz tabulka databáze: optimalizace_skupiny_stroju_1</em>
</td></tr>
<tr><td class='row2'>Druhá skupina stroje:</td><td class='row2'>
<select name="skupina2"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_2 order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($skupina2==$clanky['id']) echo "<option selected='selected' value='".$clanky['id']."'>".$clanky['nazev']."</option>";
		else  echo "<option value='".$clanky['id']."'>".$clanky['nazev']."</option>";
	}
?></select>
</td><td class='row2'>pozn.: <em>viz tabulka databáze: optimalizace_skupiny_stroju_2</em></td></tr>
<tr><td class='row1'>Typ stroje:</td><td class='row1'><input type='text' value='<?php echo $typ;?>' name='typ' MAXLENGTH='50'  size='50'></td><td class='row1'>pozn.: <em>oznaèení dle výrobce, napø. CAT 226B/B2</em></td></tr>
<tr><td class='row2'>Druh prvku:</td><td class='row2'>
<select name="druh_prvku"><option value="1" <?php if ($druh_prvku==1) echo "selected='selected'";?>>Obsluhující prvek</option><option value="2" <?php if ($druh_prvku==2) echo "selected='selected'";?>>Obsluhovaný prvek</option><option value="3"  <?php if ($druh_prvku==3) echo "selected='selected'";?>>Samostatný prvek</option>
</select></td><td class='row2'>pozn.: <em>oznaèení dle teorie front: obsluhující prvek, zákazník, samostatný prvek atd.</em></td></tr>
<tr><td class='row1'>Výkon motoru, [kW]:</td><td class='row1'><input type='text' value='<?php echo $vykon_kW;?>' name='vykon_kW' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>výkon motoru dle výrobce [kW] resp. [k]</em></td></tr>
<tr><td class='row2'>Prázdná provozní hmotnost, [kg]:</td><td class='row2'><input type='text' value='<?php echo $provozni_hmotnost_kg;?>' name='provozni_hmotnost_kg' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>provozní hmotnost dle výrobce [kg]</em></td></tr>
<tr><td class='row1'>Délka, [cm]:</td><td class='row1'><input type='text' value='<?php echo $delka_cm;?>' name='delka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>délka stroje dle výrobce [cm]</em></td></tr>
<tr><td class='row2'>Šírka, [cm]:</td><td class='row2'><input type='text' value='<?php echo $sirka_cm;?>' name='sirka_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>šíøka stroje dle výrobce [cm]</em></td></tr>
<tr><td class='row1'>Výška, [cm]:</td><td class='row1'><input type='text' value='<?php echo $vyska_cm;?>' name='vyska_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>výška stroje dle výrobce [cm]</em></td></tr>
<tr><td class='row2'>Maximální rychlost, [km/h]:</td><td class='row2'><input type='text' value='<?php echo $max_rychlost_km_h;?>' name='max_rychlost_km_h' MAXLENGTH='5'  size='10'></td><td class='row2'>pozn.: <em>maximální rychlost pohybu stroje dle výrobce [km/h]</em></td></tr>
<tr><td class='row1'>Provozní rychlost, [km/h]:</td><td class='row1'><input type='text' value='<?php echo $provozni_rychlost_km_h;?>' name='provozni_rychlost_km_h' MAXLENGTH='5'  size='10'></td><td class='row1'>pozn.: <em>prùmìrná rychlost pohybu stroje dle výrobce [km/h]</em></td></tr>
<tr><td class='row2'>Stoupavost, [grad]:</td><td class='row2'><input type='text' value='<?php echo $stoupavost_stupnu;?>' name='stoupavost_stupnu' MAXLENGTH='50'  size='3'></td><td class='row2'>pozn.: <em>maximální stoupavost stroje dle výrobce [grad]</em></td></tr>
<tr><td class='row1'>Tlak na zeminu, [kPa]:</td><td class='row1'><input type='text' value='<?php echo $tlak_na_zeminu_kPa;?>' name='tlak_na_zeminu_kPa' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>tlak na zeminu [kPa]</em></td></tr>
<tr><td class='row2'>Pøídavné zaøízeni 1:</td><td class='row2'><input type='text' value='<?php echo $pridavne_zarizeni_1;?>' name='pridavne_zarizeni_1' MAXLENGTH='50'  size='5'>
 <a href="vlozit-pridavne-zarizeni?sm=1&stroj=<?php echo $id;?>" target="_blank"><?php if ($pridavne_zarizeni_1) echo 'nahradit';else echo 'vložit';?> pøídavné zaøízeni:</a>
</td><td class='row2'>pozn.: <em>viz tabulka databáze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row1'>Pøídavné zaøízení 2:</td><td class='row1'><input type='text' value='<?php echo $pridavne_zarizeni_2;?>' name='pridavne_zarizeni_2' MAXLENGTH='50'  size='5'>
 <a href="vlozit-pridavne-zarizeni?sm=2&stroj=<?php echo $id;?>" target="_blank"><?php if ($pridavne_zarizeni_2) echo 'nahradit';else echo 'vložit';?> pøídavné zaøízeni:</a>
</td><td class='row1'>pozn.: <em>viz tabulka databáze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row2'>Pøídavné zaøízení 3:</td><td class='row2'><input type='text' value='<?php echo $pridavne_zarizeni_3;?>' name='pridavne_zarizeni_3' MAXLENGTH='50'  size='5'>
 <a href="vlozit-pridavne-zarizeni?sm=3&stroj=<?php echo $id;?>" target="_blank"><?php if ($pridavne_zarizeni_3) echo 'nahradit';else echo 'vložit';?> pøídavné zaøízeni:</a>
</td><td class='row2'>pozn.: <em>viz tabulka databáze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row1'>Pøídavné zaøízení 4:</td><td class='row1'><input type='text' value='<?php echo $pridavne_zarizeni_4;?>' name='pridavne_zarizeni_4' MAXLENGTH='50'  size='5'>
 <a href="vlozit-pridavne-zarizeni?sm=4&stroj=<?php echo $id;?>" target="_blank"><?php if ($pridavne_zarizeni_4) echo 'nahradit';else echo 'vložit';?> pøídavné zaøízeni:</a>
</td><td class='row1'>pozn.: <em>viz tabulka databáze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row2'>Pøídavné zaøízení 5:</td><td class='row2'><input type='text' value='<?php echo $pridavne_zarizeni_5;?>' name='pridavne_zarizeni_5' MAXLENGTH='50'  size='5'>
<a href="vlozit-pridavne-zarizeni?sm=5&stroj=<?php echo $id;?>" target="_blank"><?php if ($pridavne_zarizeni_5) echo 'nahradit';else echo 'vložit';?> pøídavné zaøízeni:</a>
</td><td class='row2'>pozn.: <em>viz tabulka databáze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row1'>Dosah hloubka, [cm]:</td><td class='row1'><input type='text' value='<?php echo $dosah_hloubka_cm;?>' name='dosah_hloubka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>hloubkový dosah stroje dle výrobce, [cm]</em></td></tr>
<tr><td class='row2'>Dosah výška, [cm]:</td><td class='row2'><input type='text' value='<?php echo $dosah_vyska_cm;?>' name='dosah_vyska_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>výškový dosah stroje dle výrobce, [cm]</em></td></tr>
<tr><td class='row1'>Dosah délka, [cm]:</td><td class='row1'><input type='text' value='<?php echo $dosah_delka_cm;?>' name='dosah_delka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>dosah stroje na délku dle výrobce, [cm]</em></td></tr>
<tr><td class='row2'>Polomìr otáèení, [cm]:</td><td class='row2'><input type='text' value='<?php echo $polomer_otaceni_cm;?>' name='polomer_otaceni_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>hloubkový dosah stroje dle výrobce, [cm]</em></td></tr>
<tr><td class='row1'>Poznámka:</td><td class='row1'><input type='text' value='<?php echo $poznamka;?>' name='poznamka' MAXLENGTH='50'  size='50'></td><td class='row1'>pozn.: <em>vlastní poznámka</em></td></tr>
<tr><td class='row2'>Spotøeba paliva vysoká, [ml/h]:</td><td class='row2'><input type='text' value='<?php echo $spotreba_paliva_hi_ml_hod;?>' name='spotreba_paliva_hi_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>odhad spotøeby paliva dle výrobce pro maximální vytížení stroje (80-100%)</em></td></tr>
<tr><td class='row1'>Spotøeba paliva støední, [ml/h]:</td><td class='row1'><input type='text' value='<?php echo $spotreba_paliva_medium_ml_hod;?>' name='spotreba_paliva_medium_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>odhad spotøeby paliva dle výrobce pro prùmìrné vytížení stroje (60-80%)</em></td></tr>
<tr><td class='row2'>Spotøeba paliva nízká, [ml/h]:</td><td class='row2'><input type='text' value='<?php echo $spotreba_paliva_low_ml_hod;?>' name='spotreba_paliva_low_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>odhad spotøeby paliva dle výrobce pro minimální vytížení stroje (40-60%)</em></td></tr>
<tr><td class='row1'>CO<sub>2</sub> vysoká, [g/h]:</td><td class='row1'><input type='text' value='<?php echo $co2_hi_ml_hod;?>' name='co2_hi_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>odhad produkce CO<sub>2</sub> dle výrobce pro maximální vytížení stroje (80-100%)</em></td></tr>
<tr><td class='row2'>CO<sub>2</sub> støední, [g/h]:</td><td class='row2'><input type='text' value='<?php echo $co2_medium_ml_hod;?>' name='co2_medium_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>odhad produkce CO<sub>2</sub> dle výrobce pro prùmìrné vytížení stroje (80-100%)</em></td></tr>
<tr><td class='row1'>CO<sub>2</sub> nízká, [g/h]:</td><td class='row1'><input type='text' value='<?php echo $co2_low_ml_hod;?>' name='co2_low_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>odhad produkce CO<sub>2</sub> dle výrobce pro minimální vytížení stroje (80-100%)</em></td></tr>
<tr><td class='row2'>Hluk v interiéru, [dB]:</td><td class='row2'><input type='text' value='<?php echo $hluk_int;?>' name='hluk_int' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>hluk stroje v interiéru dle výrobce, [dB]</em></td></tr>
<tr><td class='row1'>Hluk v exteriéru, [dB]:</td><td class='row1'><input type='text' value='<?php echo $hluk_ext;?>' name='hluk_ext' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>hluk stroje v exteriéru dle výrobce, [dB]</em></td></tr>
<tr><td class='row2'>Náklady, standardní sazba, [Kè/h]:</td><td class='row2'><input type='text' value='<?php echo $naklady_standardni_sazba_kc_hod;?>' name='naklady_standardni_sazba_kc_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>standardní hodinová sazba pronájmu stroje vèetnì obsluhy bez PHM, [Kè/h]</em></td></tr>
<tr><td class='row1'>Náklady, pøesèasová sazba, [Kè/h]:</td><td class='row1'><input type='text' value='<?php echo $naklady_prescasova_sazba_kc_hod;?>' name='naklady_prescasova_sazba_kc_hod' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>pøesèasová hodinová sazba pronájmu stroje vèetnì obsluhy bez PHM, [Kè/h]</em></td></tr>
<tr><td class='row2'>Náklady na použití, [Kè]:</td><td class='row2'><input type='text' value='<?php echo $naklady_na_pouziti_kc;?>' name='naklady_na_pouziti_kc' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>náklady na celý úkol nebo náklad na použití stroje (pøísun, odsun, školení personálu), [Kè]</em></td></tr>
<tr><td class='row1'>Cena stroje, [Kè]:</td><td class='row1'><input type='text' value='<?php echo $cena_stroje;?>' name='cena_stroje' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>cena stroje dle prodejních katalogù výrobce, [Kè]</em></td></tr>
<tr><td class='row1'>Cena stroje, [USD]:</td><td class='row1'><input type='text' value='<?php echo $cena_stroje_USD;?>' name='cena_stroje_USD' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>cena stroje dle prodejních katalogù výrobce, [USD]</em></td></tr>
<tr><td class='row2'>Pravdìpodobnost poruchy, [poèet poruch/1000 h]:</td><td class='row2'><input type='text' value='<?php echo $pravdepodobnost_poruchy_1000_hod;?>' name='pravdepodobnost_poruchy_1000_hod' MAXLENGTH='50'  size='3'></td><td class='row2'>pozn.: <em>prùmìrný poèet poruch stroje bìhem 1000 hodin práce</em></td></tr>
<tr><td class='row1'>Prùmìrná doba opravy, [min]:</td><td class='row1'><input type='text' value='<?php echo $prumerna_doba_opravy_min;?>' name='prumerna_doba_opravy_min' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>prùmìrná doba opravy stroje dle výrobce, [min]</em></td></tr>
<tr><td class='row2'>Prùmìrná cena opravy, [Kè]:</td><td class='row2'><input type='text' value='<?php echo $prumerna_cena_opravy_kc;?>' name='prumerna_cena_opravy_kc' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>prùmìrná cena opravy stroje dle výrobce, [Kè]</em></td></tr>
<tr><td class='row1'>Prùmìrná doba služby, [let]:</td><td class='row1'><input type='text' value='<?php echo $prumerna_doba_sluzby_let;?>' name='prumerna_doba_sluzby_let' MAXLENGTH='50'  size='3'></td><td class='row1'>pozn.: <em>prùmìrná doba služby stroje za podmínky servisu dle výrobce, [let]</em></td></tr>
<tr><td class='row2'>Minimální pracovní plocha, [m<sup>2</sup>]:</td><td class='row2'><input type='text' value='<?php echo $minimalni_pracovni_plocha_m2;?>' name='minimalni_pracovni_plocha_m2' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>minimální pracovní plocha nutná pro stroj, bez ztráty výkonu, [m<sup>2</sup>]</em></td></tr>
<tr><td class='row1'>Poèet jednotek, [-]:</td><td class='row1'><input type='text' value='<?php echo $pocet_jednotek;?>' name='pocet_jednotek' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>poèet jednotek stroje, napø. objem korby, lopaty, délka radlice atd. [-]</em></td></tr>
<tr><td class='row2'>Jednotka:</td><td class='row2'><input type='text' value='<?php echo $jednotka;?>' name='jednotka' MAXLENGTH='50'  size='20'></td><td class='row2'>pozn.: <em>jednotka stroje, napø. m<sup>3</sup>,m<sup>2</sup>,bm, kg atd.</em></td></tr>
<tr><td class='row1'>Pracovní výkon, [jednotka/h]:</td><td class='row1'><?php echo $pracovni_vykon_jednotka_hod;?></td><td class='row1'>pozn.: <em>pracovní výkon stroje, [jednotka/h]  </em></td></tr>
<tr><td class='row2'>Pracovní cyklus, [s]:</td><td class='row2'><input type='text' value='<?php echo $pracovni_cyklus_sek;?>' name='pracovni_cyklus_sek' MAXLENGTH='50'  size='6'></td><td class='row2'>pozn.: <em>pracovní cyklus stroje, [sek]</em></td></tr>
<tr><td class='row1'>Výrobce:</td><td class='row1'>
<select name="vyrobce"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_vyrobce order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo "<option value='".$clanky['nazev']."'>".$clanky['nazev']."</option>";
	}
?></select> nebo 
<input type='text' value='<?php echo $vyrobce;?>' name='vyrobce2' MAXLENGTH='50'  size='20'>
</td><td class='row1'>pozn.: <em>viz tabulka databáze: optimalizace_vyrobce</em></td></tr>
<?php
if (file_exists("./photo/low/".$id.".jpg")){?>
<tr><td class='row2' colspan='3'><a title='Zvìtšit foto stroje' href='./photo/hi/<?php echo $id;?>.jpg' target='_blank'><img border='0' src='./photo/low/<?php echo $id;?>.jpg' title='Foto stroje'></a></td></tr>
<tr><td class='row2'>Nahrádit foto stroje:</td><td class='row2'><input name="file" type="file"></td>
</td><td class='row2'>pozn.: <em>jen ve formátu: JPG, minimální rozlišení 640x480 pixelù.</em></td></tr>
<?php
}else{
?>
<tr><td class='row2'>Nahrát foto stroje:</td><td class='row2'><input name="file" type="file"></td>
</td><td class='row2'>pozn.: <em>jen ve formátu: JPG, minimální rozlišení 640x480 pixelù.</em></td></tr>
<?php }?>

<?php
if (file_exists("./katalog/".$id.".pdf")){?>
<tr><td class='row2' colspan='3'><a title='Zobrazit katalogový list stroje' href='./katalog/<?php echo $id;?>.pdf' target='_blank'>Katalogový list výrobce:</a></td></tr>
<tr><td class='row2'>Nahrádit katalogový list výrobce:</td><td class='row2'><input name="file2" type="file"></td>
</td><td class='row2'>pozn.: <em>jen ve formátu: PDF.</em></td></tr>
<?php
}else{
?>
<tr><td class='row1'>Nahrát katalogový list výrobce:</td><td class='row1'><input name="file2" type="file"></td>
</td><td class='row1'>pozn.: <em>jen ve formátu: PDF.</em></td></tr>
<?php }?>




<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Uložit zmìny">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zpìt"></td></tr>
</table>
</form>
<?php
}

// Karta stroje - nahled
if ($status==7){

	$id = kontrola($_GET['id']);

	$getclanek = mysql_query("SELECT * FROM optimalizace_katalog_stroju where id='$id'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id= $clanky['id'];
		$nazev= $clanky['nazev'];
		$skupina1= $clanky['skupina1'];
		$skupina2= $clanky['skupina2'];
		$typ= $clanky['typ'];
		$druh_prvku= $clanky['druh_prvku'];
		$vykon_kW= $clanky['vykon_kW'];
		$provozni_hmotnost_kg= $clanky['provozni_hmotnost_kg'];
		$delka_cm= $clanky['delka_cm'];
		$sirka_cm= $clanky['sirka_cm'];
		$vyska_cm= $clanky['vyska_cm'];
		$max_rychlost_km_h= $clanky['max_rychlost_km_h'];
		$provozni_rychlost_km_h= $clanky['provozni_rychlost_km_h'];
		$stoupavost_stupnu= $clanky['stoupavost_stupnu'];
		$tlak_na_zeminu_kPa= $clanky['tlak_na_zeminu_kPa'];
		$pridavne_zarizeni_1= $clanky['pridavne_zarizeni_1'];
		$pridavne_zarizeni_2= $clanky['pridavne_zarizeni_2'];
		$pridavne_zarizeni_3= $clanky['pridavne_zarizeni_3'];
		$pridavne_zarizeni_4= $clanky['pridavne_zarizeni_4'];
		$pridavne_zarizeni_5= $clanky['pridavne_zarizeni_5'];
		$dosah_hloubka_cm= $clanky['dosah_hloubka_cm'];
		$dosah_vyska_cm= $clanky['dosah_vyska_cm'];
		$dosah_delka_cm= $clanky['dosah_delka_cm'];
		$polomer_otaceni_cm= $clanky['polomer_otaceni_cm'];
		$poznamka= $clanky['poznamka'];
		$spotreba_paliva_hi_ml_hod= $clanky['spotreba_paliva_hi_ml_hod'];
		$spotreba_paliva_medium_ml_hod= $clanky['spotreba_paliva_medium_ml_hod'];
		$spotreba_paliva_low_ml_hod= $clanky['spotreba_paliva_low_ml_hod'];
		$co2_hi_ml_hod= $clanky['co2_hi_ml_hod'];
		$co2_medium_ml_hod= $clanky['co2_medium_ml_hod'];
		$co2_low_ml_hod= $clanky['co2_low_ml_hod'];
		$hluk_int= $clanky['hluk_int'];
		$hluk_ext= $clanky['hluk_ext'];
		$naklady_standardni_sazba_kc_hod= $clanky['naklady_standardni_sazba_kc_hod'];
		$naklady_prescasova_sazba_kc_hod= $clanky['naklady_prescasova_sazba_kc_hod'];
		$naklady_na_pouziti_kc= $clanky['naklady_na_pouziti_kc'];
		$cena_stroje= $clanky['cena_stroje'];
		$cena_stroje_USD= $clanky['cena_stroje_USD'];
		$pravdepodobnost_poruchy_1000_hod= $clanky['pravdepodobnost_poruchy_1000_hod'];
		$prumerna_doba_opravy_min= $clanky['prumerna_doba_opravy_min'];
		$prumerna_cena_opravy_kc= $clanky['prumerna_cena_opravy_kc'];
		$prumerna_doba_sluzby_let= $clanky['prumerna_doba_sluzby_let'];
		$minimalni_pracovni_plocha_m2= $clanky['minimalni_pracovni_plocha_m2'];
		$pocet_jednotek= $clanky['pocet_jednotek'];
		
		$jednotka_text=$clanky['jednotka'];
		if ($jednotka_text=="m2") $jednotka_text="m<sup>2</sup>";
		if ($jednotka_text=="m3") $jednotka_text="m<sup>3</sup>";
		$jednotka= $jednotka_text;

		
		$pracovni_vykon_jednotka_hod= $clanky['pracovni_vykon_jednotka_hod'];
		$pracovni_cyklus_sek= $clanky['pracovni_cyklus_sek'];
		$vyrobce= $clanky['vyrobce'];
		if ($row==1) $row=2;else $row=1;
	}

?>
<h2><font color="green">Katalogový list stroje: <?php echo $typ." (ID: ".$id.")";?></font></h2><hr>

<table cellspacing="0" cellpadding="2" width="800px">
<tr valign="top"><td width="400px">
<table width="400px">
<?php
if (file_exists("./photo/low/".$id.".jpg")){?>
<tr><td class='row2' colspan='2'><a title='Zvìtšit foto stroje' href='./photo/hi/<?php echo $id;?>.jpg' target='_blank'><img border='0' src='./photo/low/<?php echo $id;?>.jpg' title='Foto stroje'></a><br>
<a title='Zvìtšit foto stroje' href='./photo/hi/<?php echo $id;?>.jpg' target='_blank'>Zvìtšit foto :</a>
</td></tr>
<?php }?>


<tr><td class='row2'><em>Název stroje:</em></td><td class='row2'><?php echo $nazev;?></td></tr>

<tr><td class='row2'><em>První skupina:</em></td><td class='row2'>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_1 where id='$skupina1'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo '<a href="katalogovy-list?sid='.$skupina1.'" title="Zobrazit celou skupinu">'.$clanky['nazev'].'</a>';
	}
?></td></tr>

<tr><td class='row2'><em>Druhá skupina:</em></td><td class='row2'>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_2 where id='$skupina2'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo '<a href="katalogovy-list?sid='.$skupina1.'&amp;sid2='.$skupina2.'" title="Zobrazit celou skupinu">'.$clanky['nazev'].'</a>';
	}
?></td></tr>


<tr><td class='row2'><em>Typ stroje:</em></td><td class='row2'><?php echo $typ;?></td></tr>
<tr><td class='row2'><em>Druh prvku:</em></td><td class='row2'><?php if ($druh_prvku==1) echo "Obsluhující prvek";?><?php if ($druh_prvku==2) echo "Obsluhovaný prvek";?><?php if ($druh_prvku==3) echo "Samostatný prvek";?></td></tr>

<tr><td class='row2'><em>Výkon motoru:</em></td><td class='row2'><?php echo $vykon_kW;?> kW</td></tr>

<tr><td class='row2'><em>Provozní hmotnost:</em></td><td class='row2'><?php echo number_format($provozni_hmotnost_kg,0,","," ");?> kg</td></tr>
<tr><td class='row2'><em>Délka:</em></td><td class='row2'><?php echo $delka_cm;?> cm</td></tr>
<tr><td class='row2'><em>Šírka:</em></td><td class='row2'><?php echo $sirka_cm;?> cm</td></tr>
<tr><td class='row2'><em>Výška:</em></td><td class='row2'><?php echo $vyska_cm;?> cm</td></tr>
<tr><td class='row2'><em>Maximální rychlost:</em></td><td class='row2'><?php echo $max_rychlost_km_h;?> km/h</td></tr>
<tr><td class='row2'><em>Provozní rychlost:</em></td><td class='row2'><?php echo $provozni_rychlost_km_h;?> km/h</td></tr>
<?php if ($stoupavost_stupnu){?><tr><td class='row2'><em>Stoupavost:</em></td><td class='row2'><?php echo $stoupavost_stupnu;?> grad</td></tr><?php }?>
<?php if ($tlak_na_zeminu_kPa){?><tr><td class='row2'><em>Tlak na zeminu:</em></td><td class='row2'><?php echo $tlak_na_zeminu_kPa;?> kPa</td></tr><?php }?>
<?php if ($pridavne_zarizeni_1){?>
<tr><td class='row2'><em>Pøídavné zaøízeni 1:</em></td><td class='row2'>
<?php 
if ($pridavne_zarizeni_1) {
	$getclanek = mysql_query("SELECT * FROM optimalizace_pridavna_zarizeni where id=$pridavne_zarizeni_1",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
	
		$jednotka_text=$clanky['jednotka'];
		if ($jednotka_text=="m2") $jednotka_text="m<sup>2</sup>";
		if ($jednotka_text=="m3") $jednotka_text="m<sup>3</sup>";
		echo '<font class="name">'.$clanky['nazev'].' / '.$clanky['pocet_jednotek'].' '.$jednotka_text.'<br>'.$clanky['pracovni_vykon_jednotka_hod'].' '.$jednotka_text.'/h</font>';	
	}
}else echo "-";
?>
</td></tr>
<?php }?>
<?php if ($pridavne_zarizeni_2){?>
<tr><td class='row2'><em>Pøídavné zaøízení 2:</em></td><td class='row2'><?php 
if ($pridavne_zarizeni_2) {
	$getclanek = mysql_query("SELECT * FROM optimalizace_pridavna_zarizeni where id=$pridavne_zarizeni_2",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$jednotka_text=$clanky['jednotka'];
		if ($jednotka_text=="m2") $jednotka_text="m<sup>2</sup>";
		if ($jednotka_text=="m3") $jednotka_text="m<sup>3</sup>";
		echo '<font class="name">'.$clanky['nazev'].' / '.$clanky['pocet_jednotek'].' '.$jednotka_text.'<br>'.$clanky['pracovni_vykon_jednotka_hod'].' '.$jednotka_text.'/h</font>';	
	}
}else echo "-";
?>
</td></tr>
<?php }?>
<?php if ($pridavne_zarizeni_3){?>
<tr><td class='row2'><em>Pøídavné zaøízení 3:</em></td><td class='row2'><?php 
if ($pridavne_zarizeni_3) {
	$getclanek = mysql_query("SELECT * FROM optimalizace_pridavna_zarizeni where id=$pridavne_zarizeni_3",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$jednotka_text=$clanky['jednotka'];
		if ($jednotka_text=="m2") $jednotka_text="m<sup>2</sup>";
		if ($jednotka_text=="m3") $jednotka_text="m<sup>3</sup>";
		echo '<font class="name">'.$clanky['nazev'].' / '.$clanky['pocet_jednotek'].' '.$jednotka_text.'<br>'.$clanky['pracovni_vykon_jednotka_hod'].' '.$jednotka_text.'/h</font>';	
	}
}else echo "-";
?>
</td></tr>
<?php }?>
<?php if ($pridavne_zarizeni_4){?>
<tr><td class='row2'><em>Pøídavné zaøízení 4:</em></td><td class='row2'><?php 
if ($pridavne_zarizeni_4) {
	$getclanek = mysql_query("SELECT * FROM optimalizace_pridavna_zarizeni where id=$pridavne_zarizeni_4",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$jednotka_text=$clanky['jednotka'];
		if ($jednotka_text=="m2") $jednotka_text="m<sup>2</sup>";
		if ($jednotka_text=="m3") $jednotka_text="m<sup>3</sup>";
		echo '<font class="name">'.$clanky['nazev'].' / '.$clanky['pocet_jednotek'].' '.$jednotka_text.'<br>'.$clanky['pracovni_vykon_jednotka_hod'].' '.$jednotka_text.'/h</font>';	
	}
}else echo "-";
?>
</td></tr>
<?php }?>
<?php if ($pridavne_zarizeni_5){?>
<tr><td class='row2'><em>Pøídavné zaøízení 5:</em></td><td class='row2'><?php 
if ($pridavne_zarizeni_5) {
	$getclanek = mysql_query("SELECT * FROM optimalizace_pridavna_zarizeni where id=$pridavne_zarizeni_5",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$jednotka_text=$clanky['jednotka'];
		if ($jednotka_text=="m2") $jednotka_text="m<sup>2</sup>";
		if ($jednotka_text=="m3") $jednotka_text="m<sup>3</sup>";
		echo '<font class="name">'.$clanky['nazev'].' / '.$clanky['pocet_jednotek'].' '.$jednotka_text.'<br>'.$clanky['pracovni_vykon_jednotka_hod'].' '.$jednotka_text.'/h</font>';	
	}
}else echo "-";
?></td></tr>
<?php }?>
<?php
if (file_exists("./katalog/".$id.".pdf")){?>
<tr><td class='row2'><br>Ke stažení: </td><td class='row2'><br><a title='Zobrazit katalogový list stroje' href='./katalog/<?php echo $id;?>.pdf' target='_blank'>Katalogový list výrobce :</a></td></tr>
<?php }?>
</table>
</td><td width="400px" valign="top">
<table width="400px">
<?php if ($dosah_hloubka_cm){?><tr><td class='row2'><em>Dosah hloubka:</em></td><td class='row2'><?php echo $dosah_hloubka_cm;?> cm</td></tr><?php }?>
<?php if ($dosah_vyska_cm){?><tr><td class='row2'><em>Dosah výška:</em></td><td class='row2'><?php echo $dosah_vyska_cm;?> cm</td></tr><?php }?>
<?php if ($dosah_delka_cm){?><tr><td class='row2'><em>Dosah délka:</em></td><td class='row2'><?php echo $dosah_delka_cm;?> cm</td></tr><?php }?>
<?php if ($polomer_otaceni_cm){?><tr><td class='row2'><em>Polomìr otáèení:</em></td><td class='row2'><?php echo $polomer_otaceni_cm;?> cm</td></tr><?php }?>
<?php if ($poznamka){?><tr><td class='row2'><em>Poznámka:</em></td><td class='row2'><?php echo $poznamka;?></td></tr><?php }?>
<tr><td class='row2'><em>Spotøeba paliva vysoká:</em></td><td class='row2'><?php echo $spotreba_paliva_hi_ml_hod;?> ml/h</td></tr>
<tr><td class='row2'><em>Spotøeba paliva støední:</em></td><td class='row2'><?php echo $spotreba_paliva_medium_ml_hod;?> ml/h</td></tr>
<tr><td class='row2'><em>Spotøeba paliva nízká:</em></td><td class='row2'><?php echo $spotreba_paliva_low_ml_hod;?> ml/h</td></tr>
<tr><td class='row2'><em>Produkce CO<sub>2</sub> vysoká:</em></td><td class='row2'><?php echo $co2_hi_ml_hod;?> g/h</td></tr>
<tr><td class='row2'><em>Produkce CO<sub>2</sub> støední:</em></td><td class='row2'><?php echo $co2_medium_ml_hod;?> g/h</td></tr>
<tr><td class='row2'><em>Produkce CO<sub>2</sub> nízká:</em></td><td class='row2'><?php echo $co2_low_ml_hod;?> g/h</td></tr>
<?php if ($hluk_int){?><tr><td class='row2'><em>Hluk v interiéru:</em></td><td class='row2'><?php echo $hluk_int;?> dB</td></tr><?php }?>
<?php if ($hluk_ext){?><tr><td class='row2'><em>Hluk v exteriéru:</em></td><td class='row2'><?php echo $hluk_ext;?> dB</td></tr><?php }?>
<tr><td class='row2'><em>Náklady, standardní sazba:</em></td><td class='row2'><?php echo $naklady_standardni_sazba_kc_hod;?> Kè/h</td></tr>
<tr><td class='row2'><em>Náklady, pøesèasová sazba:</em></td><td class='row2'><?php echo $naklady_prescasova_sazba_kc_hod;?> Kè/h</td></tr>
<tr><td class='row2'><em>Náklady na použití:</em></td><td class='row2'><?php echo $naklady_na_pouziti_kc;?> Kè</td></tr>
<tr><td class='row2'><em>Cena stroje:</em></td><td class='row2'><?php echo number_format($cena_stroje,0,","," ");?> Kè</td></tr>
<tr><td class='row2'><em>Cena stroje:</em></td><td class='row2'><?php echo number_format($cena_stroje_USD,0,","," ");?> USD</td></tr>
<?php if ($pravdepodobnost_poruchy_1000_hod){?>
<tr><td class='row2'><em>Pravdìpodobnost poruchy:</em></td><td class='row2'><?php echo $pravdepodobnost_poruchy_1000_hod;?> poèet poruch/1000 h</td></tr>
<tr><td class='row2'><em>Prùmìrná doba opravy:</em></td><td class='row2'><?php echo $prumerna_doba_opravy_min;?> min</td></tr>
<tr><td class='row2'><em>Prùmìrná cena opravy:</em></td><td class='row2'><?php echo $prumerna_cena_opravy_kc;?> Kè</td></tr>
<tr><td class='row2'><em>Prùmìrná doba služby:</em></td><td class='row2'><?php echo $prumerna_doba_sluzby_let;?> let</td></tr>
<?php }?>
<?php if ($minimalni_pracovni_plocha_m2){?><tr><td class='row2'><em>Minimální pracovní plocha:</em></td><td class='row2'><?php echo $minimalni_pracovni_plocha_m2;?> m<sup>2</sup></td></tr><?php }?>
<tr><td class='row2'><em>Poèet jednotek:</em></td><td class='row2'><?php echo $pocet_jednotek;?> <?php echo $jednotka;?></td></tr>
<?php if ($pracovni_cyklus_sek){?><tr><td class='row2'><em>Pracovní cyklus:</em></td><td class='row2'><?php echo $pracovni_cyklus_sek;?> s</td></tr><?php }?>
<tr><td class='row2'><em>Pracovní výkon:</em></td><td class='row2'><?php echo $pracovni_vykon_jednotka_hod;?> <?php echo $jednotka;?>/h</td></tr>
<tr><td class='row2'><em>Produktivita práce:</em></td><td class='row2'><?php echo round(1/$pracovni_vykon_jednotka_hod,6);?> Nh/<?php echo $jednotka;?></td></tr>
<tr><td class='row2'><em>Výrobce:</em></td><td class='row2'><?php echo $vyrobce;?></td></tr>
</table>
</td></tr>

<tr><td class="row1" colspan="2" align="center"><hr><input type=button onclick="history.back()" value="Zpìt"></td></tr>

</table>

<?php
}


// Kopirovani listu - formular
if ($status==8){

	$id = kontrola($_GET['id']);
	$getclanek = mysql_query("SELECT * FROM optimalizace_katalog_stroju where id='$id'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){


$nazev= $clanky['nazev'];
$skupina1= $clanky['skupina1'];
$skupina2= $clanky['skupina2'];
$typ= $clanky['typ'];
$druh_prvku= $clanky['druh_prvku'];
$vykon_kW= $clanky['vykon_kW'];
$provozni_hmotnost_kg= $clanky['provozni_hmotnost_kg'];
$delka_cm= $clanky['delka_cm'];
$sirka_cm= $clanky['sirka_cm'];
$vyska_cm= $clanky['vyska_cm'];
$max_rychlost_km_h= $clanky['max_rychlost_km_h'];
$provozni_rychlost_km_h= $clanky['provozni_rychlost_km_h'];
$stoupavost_stupnu= $clanky['stoupavost_stupnu'];
$tlak_na_zeminu_kPa= $clanky['tlak_na_zeminu_kPa'];
$pridavne_zarizeni_1= $clanky['pridavne_zarizeni_1'];
$pridavne_zarizeni_2= $clanky['pridavne_zarizeni_2'];
$pridavne_zarizeni_3= $clanky['pridavne_zarizeni_3'];
$pridavne_zarizeni_4= $clanky['pridavne_zarizeni_4'];
$pridavne_zarizeni_5= $clanky['pridavne_zarizeni_5'];
$dosah_hloubka_cm= $clanky['dosah_hloubka_cm'];
$dosah_vyska_cm= $clanky['dosah_vyska_cm'];
$dosah_delka_cm= $clanky['dosah_delka_cm'];
$polomer_otaceni_cm= $clanky['polomer_otaceni_cm'];
$poznamka= $clanky['poznamka'];
$spotreba_paliva_hi_ml_hod= $clanky['spotreba_paliva_hi_ml_hod'];
$spotreba_paliva_medium_ml_hod= $clanky['spotreba_paliva_medium_ml_hod'];
$spotreba_paliva_low_ml_hod= $clanky['spotreba_paliva_low_ml_hod'];
$co2_hi_ml_hod= $clanky['co2_hi_ml_hod'];
$co2_medium_ml_hod= $clanky['co2_medium_ml_hod'];
$co2_low_ml_hod= $clanky['co2_low_ml_hod'];
$hluk_int= $clanky['hluk_int'];
$hluk_ext= $clanky['hluk_ext'];
$naklady_standardni_sazba_kc_hod= $clanky['naklady_standardni_sazba_kc_hod'];
$naklady_prescasova_sazba_kc_hod= $clanky['naklady_prescasova_sazba_kc_hod'];
$naklady_na_pouziti_kc= $clanky['naklady_na_pouziti_kc'];
$cena_stroje= $clanky['cena_stroje'];
$cena_stroje_USD= $clanky['cena_stroje_USD'];
$pravdepodobnost_poruchy_1000_hod= $clanky['pravdepodobnost_poruchy_1000_hod'];
$prumerna_doba_opravy_min= $clanky['prumerna_doba_opravy_min'];
$prumerna_cena_opravy_kc= $clanky['prumerna_cena_opravy_kc'];
$prumerna_doba_sluzby_let= $clanky['prumerna_doba_sluzby_let'];
$minimalni_pracovni_plocha_m2= $clanky['minimalni_pracovni_plocha_m2'];
$pocet_jednotek= $clanky['pocet_jednotek'];
$jednotka= $clanky['jednotka'];
$pracovni_vykon_jednotka_hod= $clanky['pracovni_vykon_jednotka_hod'];
$pracovni_cyklus_sek= $clanky['pracovni_cyklus_sek'];
$vyrobce= $clanky['vyrobce'];

		
		if ($row==1) $row=2;else $row=1;

	}



?>
<form name="f1" ACTION='./katalogovy-list?sid=<?php echo $sid;?>&amp;sid2=<?php echo $sid2;?>' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="101">
<h2><font color="green">Nový katalogový list stroje:</font></h2>
<table>
<tr><td class='row2'>Název stroje:</td><td class='row2'><input type='text' value='<?php echo $nazev;?>' name='nazev' MAXLENGTH='50'  size='50'></td><td class='row2'>pozn.: <em>vèetnì názvu, typu a oznaèení, napø.: Nakladaè øízený smykem CAT 226B/B2</em></td></tr>
<tr><td class='row1'>První skupina stroje:</td><td class='row1'>
<select name="skupina1"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_1 order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($skupina1==$clanky['id']) echo "<option selected='selected' value='".$clanky['id']."'>".$clanky['nazev']."</option>";
		else  echo "<option value='".$clanky['id']."'>".$clanky['nazev']."</option>";
	}
?></select>
</td><td class='row1'>pozn.: <em>viz tabulka databáze: optimalizace_skupiny_stroju_1</em>
</td></tr>
<tr><td class='row2'>Druhá skupina stroje:</td><td class='row2'>
<select name="skupina2"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_2 order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($skupina2==$clanky['id']) echo "<option selected='selected' value='".$clanky['id']."'>".$clanky['nazev']."</option>";
		else  echo "<option value='".$clanky['id']."'>".$clanky['nazev']."</option>";
	}
?></select>
</td><td class='row2'>pozn.: <em>viz tabulka databáze: optimalizace_skupiny_stroju_2</em></td></tr>
<tr><td class='row1'>Typ stroje:</td><td class='row1'><input type='text' value='<?php echo $typ;?>' name='typ' MAXLENGTH='50'  size='50'></td><td class='row1'>pozn.: <em>oznaèení dle výrobce, napø. CAT 226B/B2</em></td></tr>
<tr><td class='row2'>Druh prvku:</td><td class='row2'>
<select name="druh_prvku"><option value="1" <?php if ($druh_prvku==1) echo "selected='selected'";?>>Obsluhující prvek</option><option value="2" <?php if ($druh_prvku==2) echo "selected='selected'";?>>Obsluhovaný prvek</option><option value="3"  <?php if ($druh_prvku==3) echo "selected='selected'";?>>Samostatný prvek</option>
</select></td><td class='row2'>pozn.: <em>oznaèení dle teorie front: obsluhující prvek, zákazník, samostatný prvek atd.</em></td></tr>
<tr><td class='row1'>Výkon motoru, [kW]:</td><td class='row1'><input type='text' value='<?php echo $vykon_kW;?>' name='vykon_kW' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>výkon motoru dle výrobce [kW] resp. [k]</em></td></tr>
<tr><td class='row2'>Prázdná provozní hmotnost, [kg]:</td><td class='row2'><input type='text' value='<?php echo $provozni_hmotnost_kg;?>' name='provozni_hmotnost_kg' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>provozní hmotnost dle výrobce [kg]</em></td></tr>
<tr><td class='row1'>Délka, [cm]:</td><td class='row1'><input type='text' value='<?php echo $delka_cm;?>' name='delka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>délka stroje dle výrobce [cm]</em></td></tr>
<tr><td class='row2'>Šírka, [cm]:</td><td class='row2'><input type='text' value='<?php echo $sirka_cm;?>' name='sirka_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>šíøka stroje dle výrobce [cm]</em></td></tr>
<tr><td class='row1'>Výška, [cm]:</td><td class='row1'><input type='text' value='<?php echo $vyska_cm;?>' name='vyska_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>výška stroje dle výrobce [cm]</em></td></tr>
<tr><td class='row2'>Maximální rychlost, [km/h]:</td><td class='row2'><input type='text' value='<?php echo $max_rychlost_km_h;?>' name='max_rychlost_km_h' MAXLENGTH='5'  size='10'></td><td class='row2'>pozn.: <em>maximální rychlost pohybu stroje dle výrobce [km/h]</em></td></tr>
<tr><td class='row1'>Provozní rychlost, [km/h]:</td><td class='row1'><input type='text' value='<?php echo $provozni_rychlost_km_h;?>' name='provozni_rychlost_km_h' MAXLENGTH='5'  size='10'></td><td class='row1'>pozn.: <em>prùmìrná rychlost pohybu stroje dle výrobce [km/h]</em></td></tr>
<tr><td class='row2'>Stoupavost, [grad]:</td><td class='row2'><input type='text' value='<?php echo $stoupavost_stupnu;?>' name='stoupavost_stupnu' MAXLENGTH='50'  size='3'></td><td class='row2'>pozn.: <em>maximální stoupavost stroje dle výrobce [grad]</em></td></tr>
<tr><td class='row1'>Tlak na zeminu, [kPa]:</td><td class='row1'><input type='text' value='<?php echo $tlak_na_zeminu_kPa;?>' name='tlak_na_zeminu_kPa' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>tlak na zeminu [kPa]</em></td></tr>
<tr><td class='row2'>Pøídavné zaøízeni 1:</td><td class='row2'><input type='text' value='<?php echo $pridavne_zarizeni_1;?>' name='pridavne_zarizeni_1' MAXLENGTH='50'  size='5'>
 <a href="vlozit-pridavne-zarizeni?sm=1" target="_blank"><?php if ($pridavne_zarizeni_1) echo 'nahradit';else echo 'vložit';?> pøídavné zaøízeni:</a>
</td><td class='row2'>pozn.: <em>viz tabulka databáze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row1'>Pøídavné zaøízení 2:</td><td class='row1'><input type='text' value='<?php echo $pridavne_zarizeni_2;?>' name='pridavne_zarizeni_2' MAXLENGTH='50'  size='5'>
 <a href="vlozit-pridavne-zarizeni?sm=2" target="_blank"><?php if ($pridavne_zarizeni_2) echo 'nahradit';else echo 'vložit';?> pøídavné zaøízeni:</a>
</td><td class='row1'>pozn.: <em>viz tabulka databáze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row2'>Pøídavné zaøízení 3:</td><td class='row2'><input type='text' value='<?php echo $pridavne_zarizeni_3;?>' name='pridavne_zarizeni_3' MAXLENGTH='50'  size='5'>
 <a href="vlozit-pridavne-zarizeni?sm=3" target="_blank"><?php if ($pridavne_zarizeni_3) echo 'nahradit';else echo 'vložit';?> pøídavné zaøízeni:</a>
</td><td class='row2'>pozn.: <em>viz tabulka databáze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row1'>Pøídavné zaøízení 4:</td><td class='row1'><input type='text' value='<?php echo $pridavne_zarizeni_4;?>' name='pridavne_zarizeni_4' MAXLENGTH='50'  size='5'>
 <a href="vlozit-pridavne-zarizeni?sm=4" target="_blank"><?php if ($pridavne_zarizeni_4) echo 'nahradit';else echo 'vložit';?> pøídavné zaøízeni:</a>
</td><td class='row1'>pozn.: <em>viz tabulka databáze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row2'>Pøídavné zaøízení 5:</td><td class='row2'><input type='text' value='<?php echo $pridavne_zarizeni_5;?>' name='pridavne_zarizeni_5' MAXLENGTH='50'  size='5'>
<a href="vlozit-pridavne-zarizeni?sm=5" target="_blank"><?php if ($pridavne_zarizeni_5) echo 'nahradit';else echo 'vložit';?> pøídavné zaøízeni:</a>
</td><td class='row2'>pozn.: <em>viz tabulka databáze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row1'>Dosah hloubka, [cm]:</td><td class='row1'><input type='text' value='<?php echo $dosah_hloubka_cm;?>' name='dosah_hloubka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>hloubkový dosah stroje dle výrobce, [cm]</em></td></tr>
<tr><td class='row2'>Dosah výška, [cm]:</td><td class='row2'><input type='text' value='<?php echo $dosah_vyska_cm;?>' name='dosah_vyska_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>výškový dosah stroje dle výrobce, [cm]</em></td></tr>
<tr><td class='row1'>Dosah délka, [cm]:</td><td class='row1'><input type='text' value='<?php echo $dosah_delka_cm;?>' name='dosah_delka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>dosah stroje na délku dle výrobce, [cm]</em></td></tr>
<tr><td class='row2'>Polomìr otáèení, [cm]:</td><td class='row2'><input type='text' value='<?php echo $polomer_otaceni_cm;?>' name='polomer_otaceni_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>hloubkový dosah stroje dle výrobce, [cm]</em></td></tr>
<tr><td class='row1'>Poznámka:</td><td class='row1'><input type='text' value='<?php echo $poznamka;?>' name='poznamka' MAXLENGTH='50'  size='50'></td><td class='row1'>pozn.: <em>vlastní poznámka</em></td></tr>
<tr><td class='row2'>Spotøeba paliva vysoká, [ml/h]:</td><td class='row2'><input type='text' value='<?php echo $spotreba_paliva_hi_ml_hod;?>' name='spotreba_paliva_hi_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>odhad spotøeby paliva dle výrobce pro maximální vytížení stroje (80-100%)</em></td></tr>
<tr><td class='row1'>Spotøeba paliva støední, [ml/h]:</td><td class='row1'><input type='text' value='<?php echo $spotreba_paliva_medium_ml_hod;?>' name='spotreba_paliva_medium_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>odhad spotøeby paliva dle výrobce pro prùmìrné vytížení stroje (60-80%)</em></td></tr>
<tr><td class='row2'>Spotøeba paliva nízká, [ml/h]:</td><td class='row2'><input type='text' value='<?php echo $spotreba_paliva_low_ml_hod;?>' name='spotreba_paliva_low_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>odhad spotøeby paliva dle výrobce pro minimální vytížení stroje (40-60%)</em></td></tr>
<tr><td class='row1'>CO<sub>2</sub> vysoká, [g/h]:</td><td class='row1'><input type='text' value='<?php echo $co2_hi_ml_hod;?>' name='co2_hi_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>odhad produkce CO<sub>2</sub> dle výrobce pro maximální vytížení stroje (80-100%)</em></td></tr>
<tr><td class='row2'>CO<sub>2</sub> støední, [g/h]:</td><td class='row2'><input type='text' value='<?php echo $co2_medium_ml_hod;?>' name='co2_medium_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>odhad produkce CO<sub>2</sub> dle výrobce pro prùmìrné vytížení stroje (80-100%)</em></td></tr>
<tr><td class='row1'>CO<sub>2</sub> nízká, [g/h]:</td><td class='row1'><input type='text' value='<?php echo $co2_low_ml_hod;?>' name='co2_low_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>odhad produkce CO<sub>2</sub> dle výrobce pro minimální vytížení stroje (80-100%)</em></td></tr>
<tr><td class='row2'>Hluk v interiéru, [dB]:</td><td class='row2'><input type='text' value='<?php echo $hluk_int;?>' name='hluk_int' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>hluk stroje v interiéru dle výrobce, [dB]</em></td></tr>
<tr><td class='row1'>Hluk v exteriéru, [dB]:</td><td class='row1'><input type='text' value='<?php echo $hluk_ext;?>' name='hluk_ext' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>hluk stroje v exteriéru dle výrobce, [dB]</em></td></tr>
<tr><td class='row2'>Náklady, standardní sazba, [Kè/h]:</td><td class='row2'><input type='text' value='<?php echo $naklady_standardni_sazba_kc_hod;?>' name='naklady_standardni_sazba_kc_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>standardní hodinová sazba pronájmu stroje vèetnì obsluhy bez PHM, [Kè/h]</em></td></tr>
<tr><td class='row1'>Náklady, pøesèasová sazba, [Kè/h]:</td><td class='row1'><input type='text' value='<?php echo $naklady_prescasova_sazba_kc_hod;?>' name='naklady_prescasova_sazba_kc_hod' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>pøesèasová hodinová sazba pronájmu stroje vèetnì obsluhy bez PHM, [Kè/h]</em></td></tr>
<tr><td class='row2'>Náklady na použití, [Kè]:</td><td class='row2'><input type='text' value='<?php echo $naklady_na_pouziti_kc;?>' name='naklady_na_pouziti_kc' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>náklady na celý úkol nebo náklad na použití stroje (pøísun, odsun, školení personálu), [Kè]</em></td></tr>
<tr><td class='row1'>Cena stroje, [Kè]:</td><td class='row1'><input type='text' value='<?php echo $cena_stroje;?>' name='cena_stroje' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>cena stroje dle prodejních katalogù výrobce, [Kè]</em></td></tr>
<tr><td class='row1'>Cena stroje, [USD]:</td><td class='row1'><input type='text' value='<?php echo $cena_stroje_USD;?>' name='cena_stroje_USD' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>cena stroje dle prodejních katalogù výrobce, [USD]</em></td></tr>
<tr><td class='row2'>Pravdìpodobnost poruchy, [poèet poruch/1000 h]:</td><td class='row2'><input type='text' value='<?php echo $pravdepodobnost_poruchy_1000_hod;?>' name='pravdepodobnost_poruchy_1000_hod' MAXLENGTH='50'  size='3'></td><td class='row2'>pozn.: <em>prùmìrný poèet poruch stroje bìhem 1000 hodin práce</em></td></tr>
<tr><td class='row1'>Prùmìrná doba opravy, [min]:</td><td class='row1'><input type='text' value='<?php echo $prumerna_doba_opravy_min;?>' name='prumerna_doba_opravy_min' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>prùmìrná doba opravy stroje dle výrobce, [min]</em></td></tr>
<tr><td class='row2'>Prùmìrná cena opravy, [Kè]:</td><td class='row2'><input type='text' value='<?php echo $prumerna_cena_opravy_kc;?>' name='prumerna_cena_opravy_kc' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>prùmìrná cena opravy stroje dle výrobce, [Kè]</em></td></tr>
<tr><td class='row1'>Prùmìrná doba služby, [let]:</td><td class='row1'><input type='text' value='<?php echo $prumerna_doba_sluzby_let;?>' name='prumerna_doba_sluzby_let' MAXLENGTH='50'  size='3'></td><td class='row1'>pozn.: <em>prùmìrná doba služby stroje za podmínky servisu dle výrobce, [let]</em></td></tr>
<tr><td class='row2'>Minimální pracovní plocha, [m<sup>2</sup>]:</td><td class='row2'><input type='text' value='<?php echo $minimalni_pracovni_plocha_m2;?>' name='minimalni_pracovni_plocha_m2' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>minimální pracovní plocha nutná pro stroj, bez ztráty výkonu, [m<sup>2</sup>]</em></td></tr>
<tr><td class='row1'>Poèet jednotek, [-]:</td><td class='row1'><input type='text' value='<?php echo $pocet_jednotek;?>' name='pocet_jednotek' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>poèet jednotek stroje, napø. objem korby, lopaty, délka radlice atd. [-]</em></td></tr>
<tr><td class='row2'>Jednotka:</td><td class='row2'><input type='text' value='<?php echo $jednotka;?>' name='jednotka' MAXLENGTH='50'  size='20'></td><td class='row2'>pozn.: <em>jednotka stroje, napø. m<sup>3</sup>,m<sup>2</sup>,bm, kg atd.</em></td></tr>
<tr><td class='row1'>Pracovní výkon, [jednotka/h]:</td><td class='row1'><?php echo $pracovni_vykon_jednotka_hod;?></td><td class='row1'>pozn.: <em>pracovní výkon stroje, [jednotka/h]  </em></td></tr>
<tr><td class='row2'>Pracovní cyklus, [s]:</td><td class='row2'><input type='text' value='<?php echo $pracovni_cyklus_sek;?>' name='pracovni_cyklus_sek' MAXLENGTH='50'  size='6'></td><td class='row2'>pozn.: <em>pracovní cyklus stroje, [s]</em></td></tr>
<tr><td class='row1'>Výrobce:</td><td class='row1'>
<select name="vyrobce"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_vyrobce order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo "<option value='".$clanky['nazev']."'>".$clanky['nazev']."</option>";
	}
?></select> nebo 
<input type='text' value='<?php echo $vyrobce;?>' name='vyrobce2' MAXLENGTH='50'  size='20'>
</td><td class='row1'>pozn.: <em>viz tabulka databáze: optimalizace_vyrobce</em></td></tr>

<tr><td class='row2'>Nahrát foto stroje:</td><td class='row2'><input name="file" type="file"></td>
</td><td class='row2'>pozn.: <em>jen ve formátu: JPG, minimální rozlišení 640x480 pixelù.</em></td></tr>

<tr><td class='row1'>Nahrát katalogový list výrobce:</td><td class='row1'><input name="file2" type="file"></td>
</td><td class='row1'>pozn.: <em>jen ve formátu: PDF.</em></td></tr>


<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Uložit do katalogu">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zpìt"></td></tr>
</table>
</form>
<?php
}


// Nahlizeni do tabulky
if ($status==0){

echo "<table><tr valign='middle'><td align='left'><form  ACTION='./katalogovy-list?sid=".$sid."&amp;sid2=".$sid2."' METHOD='post' ENCTYPE='multipart/form-data'>";
if ($lock==0) echo "<a href='?sid=".$sid."&amp;sid2=".$sid2."&amp;status=1' title='Nový katalogový list stroje'><img src='./skin/button/32/new.png' alt='Nový katalogový list stroje' width='32px' height='32px' border='0'></a>&nbsp;";
echo "<a href='tisk-katalogu' title='Tisk katalogu' target='_blank'><img src='./skin/button/32/printer.png' alt='Tisk katalogu' width='32px' height='32px' border='0'></a>&nbsp;";
if ($lock==0) echo "<a href='?sid=".$sid."&amp;sid2=".$sid2."&amp;status=3' title='Export katalogu'><img src='./skin/button/32/export.png' alt='Export katalogu' width='32px' height='32px' border='0'></a>&nbsp;";
if ($lock==0) echo "<a href='?sid=".$sid."&amp;sid2=".$sid2."&amp;status=4' title='Import katalogu'><img src='./skin/button/32/import.png' alt='Import katalogu' width='32px' height='32px' border='0'></a>&nbsp;";
echo "<a href='?sid=".$sid."&amp;sid2=".$sid2."&amp;status=5' title='Hledat stroj'><img src='./skin/button/32/search.png' alt='Hledat stroj' width='32px' height='32px' border='0'></a>&nbsp;";
echo "&nbsp;&nbsp;&nbsp;<img src='./skin/button/32/sort.png' alt='Øazení strojù' width='32px' height='32px'>&nbsp;";
echo "<select name='razeni' onChange='submit();'>";
echo "<option value='10'"; if ($razeni==10) echo " selected"; echo ">dle èís. kódu +</option>";
echo "<option value='1'"; if ($razeni==1) echo " selected"; echo ">dle èís. kódu -</option>";
echo "<option value='4'"; if ($razeni==4) echo " selected"; echo ">dle výkonu, kW +</option>";
echo "<option value='5'"; if ($razeni==5) echo " selected"; echo ">dle výkonu, kW -</option>";
echo "<option value='8'"; if ($razeni==8) echo " selected"; echo ">dle pracovního výkonu, m.j. +</option>";
echo "<option value='9'"; if ($razeni==9) echo " selected"; echo ">dle pracovního výkonu, m.j. -</option>";
echo "<option value='6'"; if ($razeni==6) echo " selected"; echo ">dle hmotnosti +</option>";
echo "<option value='7'"; if ($razeni==7) echo " selected"; echo ">dle hmotnosti -</option>";
echo "<option value='2'"; if ($razeni==2) echo " selected"; echo ">dle názvu +</option>";
echo "<option value='3'"; if ($razeni==3) echo " selected"; echo ">dle názvu -</option>";
echo "</select>&nbsp;<input type='submit' value='øadit'>";

echo "&nbsp;<a href=\"../forum/".$u_login_logout."\" class=\"vlevo\"  title=\"\" >";
if ($lock==0) echo "&nbsp;&nbsp;&nbsp;&nbsp;<img src='./skin/button/32/opened.png' alt='Opened' width='32px' height='32px' border='0'>";
if ($lock==1) echo "&nbsp;&nbsp;&nbsp;&nbsp;<img src='./skin/button/32/locked.png' alt='Locked' width='32px' height='32px' border='0'>";
echo "</a></form></td></tr></table>";


if ($razeni==10) $razenistr="id";
if ($razeni==1) $razenistr="id DESC";
if ($razeni==4) $razenistr="vykon_kW";
if ($razeni==5) $razenistr="vykon_kW DESC";
if ($razeni==8) $razenistr="pracovni_vykon_jednotka_hod";
if ($razeni==9) $razenistr="pracovni_vykon_jednotka_hod DESC";
if ($razeni==2) $razenistr="nazev";
if ($razeni==3) $razenistr="nazev DESC";
if ($razeni==6) $razenistr="provozni_hmotnost_kg";
if ($razeni==7) $razenistr="provozni_hmotnost_kg DESC";





if (($sid)or($sid2)) $poisksql=" where ";
if ($sid) $poisksql=$poisksql." skupina1='".$sid."' ";
if (($sid)and($sid2)) $poisksql=$poisksql." and ";
if ($sid2) $poisksql=$poisksql." skupina2='".$sid2."' ";

if (!$vyhledavani) {$celkem=mysql_result(mysql_query("SELECT count(*) FROM optimalizace_katalog_stroju".$poisksql,$connect2),0);$celkem2=$celkem;}
else  { $celkem=mysql_result(mysql_query("SELECT count(*) FROM optimalizace_katalog_stroju where ".$vyhledavani,$connect2),0);$celkem2=$celkem;if ($celkem>50) $celkem=50;}
//echo "SELECT count(*) FROM optimalizace_katalog_stroju where ".$vyhledavani;
if ($celkem){
?>
<font class="name">Celkem bylo nalezeno strojù: <?php echo $celkem2;?></font>
<table class="forumline" cellspacing="0" cellpadding="2" width="1024px">
<tr>
<td align="center" class="catLeft"><font class="name2"><b>Èís.klíè</b></font></td>
<td align="center" class="catLeft" width="150px"><font class="name2"><b>Typ</b></font></td>
<td align="center" class="catLeft">&nbsp;</td>
<td align="center" class="catLeft" width="250px"><font class="name2"><b>Název stroje</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Výkon, [kW]</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Provozní hmotnost, [t]</b></font></td>
<td align="center" class="catLeft" width="200px"><font class="name2"><b>Sekce</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Cena stroje, [tis.Kè]</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Pronájem stroje, [Kè/h]</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Pracovní výkon, [m.j./h]</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Pracovní objem, [m.j.]</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Pracovní cyklus, [s]</b></font></td>
</tr>
<?php
if (!$vyhledavani) $getclanek = mysql_query("SELECT * FROM optimalizace_katalog_stroju ".$poisksql." Order by ".$razenistr." Limit $pozice,$pocetc",$connect2);
else  {$getclanek = mysql_query("SELECT * FROM optimalizace_katalog_stroju where ".$vyhledavani." Order by id Limit 0,50",$connect2);$celkem=50;}
	while ($clanky = mysql_fetch_array($getclanek)){


		$CisKlic= $clanky['id'];
		$typ= $clanky['typ'];
		$nazev= $clanky['nazev'];
		$vykon_kW= $clanky['vykon_kW'];
		$provozni_hmotnost_kg= number_format($clanky['provozni_hmotnost_kg']/1000,2,","," ");
		$vyrobce= $clanky['vyrobce'];
		
		if ($row==1) $row=2;else $row=1;

		$skupina1= $clanky['skupina1'];
		$skupina2= $clanky['skupina2'];
		
		$getclanek2 = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_1 where id='$skupina1'",$connect2);
		while ($clanky2 = mysql_fetch_array($getclanek2)){
			$sekce1=$clanky2['nazev'];
		}
		$getclanek2 = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_2 where id='$skupina2'",$connect2);
		while ($clanky2 = mysql_fetch_array($getclanek2)){
			$sekce2=$clanky2['nazev'];
		}
		
		$jednotka_text=$clanky['jednotka'];
		if ($jednotka_text=="m2") $jednotka_text="m<sup>2</sup>";
		if ($jednotka_text=="m3") $jednotka_text="m<sup>3</sup>";
		
		$cena_stroje= number_format($clanky['cena_stroje']/1000,0,","," ");
		$naklady_standardni_sazba_kc_hod= number_format($clanky['naklady_standardni_sazba_kc_hod'],0,","," ");
		if ($clanky['pracovni_vykon_jednotka_hod']) $pracovni_vykon_jednotka_hod=round($clanky['pracovni_vykon_jednotka_hod'])." ".$jednotka_text."/h";
		else $pracovni_vykon_jednotka_hod="-";
		
		
		if ($clanky['pocet_jednotek']) $pracovni_objem=$clanky['pocet_jednotek']." ".$jednotka_text;
		else $pracovni_objem="-";
		
		
		$pracovni_cyklus_sek=$clanky['pracovni_cyklus_sek'];
		
		echo '<tr><td align="center" class="row'.$row.'"><font class="name2">'.$CisKlic.'</font></td>';
		echo '<td align="center" class="row'.$row.'"><font class="name2">'.$typ.'</font></td>';

		echo '<td align="center" class="row'.$row.'">';
		echo "<a href='?sid=".$sid."&amp;sid2=".$sid2."&amp;status=7&amp;id=".$CisKlic."' title='Zobrazit katalogový list stroje'><img src='./skin/button/16/view.png' alt='Zobrazit katalogový list stroje' width='16px' height='16px' border='0'></a>&nbsp;";
		echo "<a href='tisk-katalogu?id=".$CisKlic."' title='Tisk èinnosti' target='_blank'><img src='./skin/button/16/printer.png' alt='Tisk èinnosti' width='16px' height='16px' border='0'></a>&nbsp;";
		if ($lock==0) echo "<br><a href='?sid=".$sid."&amp;sid2=".$sid2."&amp;status=6&amp;id=".$CisKlic."' title='Editovat katalogový list stroje'><img src='./skin/button/16/edit.png' alt='Editovat katalogový list stroje' width='16px' height='16px' border='0'></a>&nbsp;";
		if ($lock==0) echo "<a href='?sid=".$sid."&amp;sid2=".$sid2."&amp;status=8&amp;id=".$CisKlic."' title='Kopírovat katalogový list stroje'><img src='./skin/button/16/copy.png' alt='Kopírovat katalogový list stroje' width='16px' height='16px' border='0'></a>&nbsp;";
		if ($lock==0) echo "<a href='?sid=".$sid."&amp;sid2=".$sid2."&amp;status=9&amp;id=".$CisKlic."' title='Vymazat katalogový list stroje'><img src='./skin/button/16/delete.png' alt='Vymazat katalogový list stroje' width='16px' height='16px' border='0'></a>&nbsp;";
		echo '</td>';


		echo '<td align="left" class="row'.$row.'"><font class="name2"><a href="?sid='.$sid.'&amp;sid2='.$sid2.'&amp;status=7&amp;id='.$CisKlic.'" title="Zobrazit katalogový list stroje"><b>'.$nazev.'</b></a></font></td>
		<td align="center" class="row'.$row.'"><font class="name2">'.$vykon_kW.'</font></td>
		<td align="right" class="row'.$row.'"><font class="name2">'.$provozni_hmotnost_kg.'</font></td>
		<td align="left" class="row'.$row.'"><font class="name2"><a href="katalogovy-list?sid='.$skupina1.'" title="Zobrazit celou skupinu">'.$sekce1.'</a><br><a href="katalogovy-list?sid='.$skupina1.'&amp;sid2='.$skupina2.'" title="Zobrazit celou skupinu">'.$sekce2.'</a></font></td>
		<td align="center" class="row'.$row.'"><font class="name2">'.$cena_stroje.'</font></td>
		<td align="center" class="row'.$row.'"><font class="name2">'.$naklady_standardni_sazba_kc_hod.'</font></td>
		<td align="center" class="row'.$row.'"><font class="name2">'.$pracovni_vykon_jednotka_hod.'</font></td>
		<td align="center" class="row'.$row.'"><font class="name2">'.$pracovni_objem.'</font></td>
		<td align="center" class="row'.$row.'"><font class="name2">'.$pracovni_cyklus_sek.'</font></td>
		</tr>';
	}
	echo "</table>";


if ($celkem>$pocetc){
$roma1="./katalogovy-list?sid=".$sid."&amp;sid2=".$sid2."&amp;pozice=".($pozice-$pocetc)."&amp;razeni=".$razeni;
$roma2="./katalogovy-list?sid=".$sid."&amp;sid2=".$sid2."&amp;pozice=".($pozice+$pocetc)."&amp;razeni=".$razeni;
$roma5="./katalogovy-list?sid=".$sid."&amp;sid2=".$sid2."&amp;pozice=0&amp;razeni=".$razeni;
$roma6="./katalogovy-list?sid=".$sid."&amp;sid2=".$sid2."&amp;pozice=".($pozice-$pocetc*10)."&amp;razeni=".$razeni;
$roma7="./katalogovy-list?sid=".$sid."&amp;sid2=".$sid2."&amp;pozice=".($pozice+$pocetc*20)."&amp;razeni=".$razeni;
$roma8="./katalogovy-list?sid=".$sid."&amp;sid2=".$sid2."&amp;pozice=".($celkem-$celkem%$pocetc)."&amp;razeni=".$razeni;

$pozice22=($pozice-$pocetc*10)/$pocetc+1;
$pozice3=($pozice+$pocetc*20)/$pocetc+1;
$pozice4=($celkem-$celkem%$pocetc)/$pocetc+1;

?>
<table width="100%" border="0">
  <tr>
    <td width="20%" align="right" valign="top"><?php if($pozice+1 >= $pocetc){echo("<A HREF=\"./$roma1\"><font color=\"red\">: pøedchozí</font></A>");}?></td>
    <td width="60%" align="center" valign="top">
	<?php 
	      if ($celkem>$pocetc*10-1) $doplnekadr=1;  	
	      if ($pozice<$pocetc*9) {$celkemh=$pocetc*10;$celkemd=0;if ($celkem>$pocetc*10-1) $doplnekadr=1;} else {$celkemh=$pocetc*9+$pozice;if ($celkemh>$celkem) $celkemh=$celkem; $celkemd=$pozice;}	
	      if ($pozice>$pocetc*9-1) echo "<A HREF=\"./".$roma5."\">1...</A>&nbsp;&nbsp;";
	      if ($pozice>$pocetc*19-1) echo "<A HREF=\"./".$roma6."\">".$pozice22."...</A>&nbsp;&nbsp;";
	      if ($celkem<$pocetc*10-1) {$celkemd=0;$celkemh=$celkem;}
              for ($i=$celkemd;$i<$celkemh;$i=$i+$pocetc){
		   $roma3="./katalogovy-list?sid=".$sid."&amp;sid2=".$sid2."&amp;pozice=".$i."&amp;razeni=".$razeni;
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
    <td width="20%" align="left" valign="top"><?php if($pozice+$pocetc < $celkem){echo("<A HREF=\"./$roma2\"><font color=\"red\">další :</font></A>
");}?></td>
 </tr>
</table>
<?php
}}else{

echo "<h1>Je nám líto. Nebyl nalezen žádný stroj odpovídající Vašemu zadání.</h1>";
echo "<h1>Omlouváme se za zpùsobené potíže.</h1>";


}

}


?>