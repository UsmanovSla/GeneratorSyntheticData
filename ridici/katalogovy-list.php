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
$nazevsidd="<a href='katalog-stroju' title='Zobrazit cel� katalog stroj�'>Katalog stroj�</a>";

if ($sid){
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_1 where id='$sid'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$nazevsidd=$nazevsidd." : <a href='katalogovy-list?sid=".$sid."' title='Zobrazit katalog stroj�: ".$clanky['nazev']."'>".$clanky['nazev']."</a>";
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
	echo "<h2>Krok 1: Export stroj�: Volba form�tu</h2><br>";
	echo "<form method='post'  enctype='multipart/form-data'>";
	echo "Form�t: <select name='status'><option value='301'>CSV</option><option value='302'>MS EXCEL</option><option value='303'>TXT</option><option value='305'>MS WORD</option></select><br><br>";
	echo "<input name='vlozit' type='submit' value='Exportovat'>&nbsp;<input type=button onclick='history.back()' value='Zp�t'></form>";
}

// EXPORT tabulky - CSV
if ($status==301){

	echo "<h2>Krok 2: Export stroj�: Ulo�it soubor</h2><br>";
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

	echo "<h1>Soubor exportu (stroje): <a href='".$cesta2."' target='_blank'>Ulo�it CSV soubor :::</a></h1><br>";

	
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

	echo "<h1>Soubor exportu (p��davn� za��zen�): <a href='".$cesta2."' target='_blank'>Ulo�it CSV soubor :::</a></h1><br>";


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

	echo "<h1>Soubor exportu (skupina 1): <a href='".$cesta2."' target='_blank'>Ulo�it CSV soubor :::</a></h1><br>";

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

	echo "<h1>Soubor exportu (skupina 2): <a href='".$cesta2."' target='_blank'>Ulo�it CSV soubor :::</a></h1><br>";
	
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

	echo "<h1>Soubor exportu (v�robce stroj�): <a href='".$cesta2."' target='_blank'>Ulo�it CSV soubor :::</a></h1><br>";

	echo "<input type=button onclick='history.back()' value='Zp�t'>";

}


// EXPORT tabulky - EXCEL
if ($status==302){

	$tabl="DB";
	$tabl2="DB";

	echo "<h2>Krok 2: Export stroj�: Ulo�it soubor</h2><br>";


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

	echo "<h1>Soubor exportu: <a href='".$cesta2."' target='_blank'>Ulo�it EXCEL soubor :::</a></h1><br>";

	echo "<input type=button onclick='history.back()' value='Zp�t'>";

}


// EXPORT tabulky - TXT
if ($status==303){

	echo "<h2>Krok 2: Export stroj�: Ulo�it soubor</h2><br>";



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

	echo "<h1>Soubor exportu: <a href='".$cesta2."' target='_blank'>Ulo�it TXT soubor :::</a></h1><br>";

	echo "<input type=button onclick='history.back()' value='Zp�t'>";

}

// EXPORT tabulky - CONTEC
if ($status==304){

	echo "<h2>Krok 2: Export environment�ln�ch aspekt�: Ulo�it soubor</h2><br>";

	echo "<br><br><img src='./skin/under-construction.gif' width='500' height='125'><br><br>";

	echo "<input type=button onclick='history.back()' value='Zp�t'>";

}

// EXPORT tabulky - DOC
if ($status==305){

	echo "<h2>Krok 2: Export stroj�: Ulo�it soubor</h2><br>";

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

	echo "<h1>Soubor exportu: <a href='".$cesta2."' target='_blank'>Ulo�it MS WORD soubor :::</a></h1><br>";

	echo "<input type=button onclick='history.back()' value='Zp�t'>";

}


// Import tabulky - formular
if ($status==4454){
	echo "<h2>Krok 1: Import datab�ze �innost� ze soubor� syst�mu CONTEC: Upload souboru</h2><br>";
	echo "<form method='post'  enctype='multipart/form-data'>";
	echo "<input type='hidden' name='status' value='401'>";
	echo "Soubor: <input type='hidden' name='MAX_FILE_SIZE' value='2000000'><input name='file' type='file'><br>";
	echo "Maxim�ln� velikost souboru 2 MB. Jen ve form�tu syst�mu CONTEC !<br>";
	echo "Nahr�v�n� souboru m��e trvat velice dlouho - v z�vislosti na rychlosti va�eho p�ipojen� k internetu !<br>";
	echo "<input name='vlozit' type='submit' value='Importovat'>&nbsp;<input type=button onclick='history.back()' value='Zp�t'></form>";
}

// Import tabulky - Kontrola souboru
if ($status==401){

	$chyba=0;
	echo "<h2>Krok 2: Import datab�ze �innost� ze soubor� syst�mu CONTEC: Kontrola</h2><br>";
	$MAX_FILE_SIZE=kontrola($_POST['MAX_FILE_SIZE']);
	if (!$_FILES) {
	        $chyb = "Soubor se nepoda�ilo nahr�t na server.\n";
	        $chyba=1;
	}
	if ($_FILES["file"]["size"]>2000000){
	        $chyb = "Soubor je v�t�� ne� 2 Mb.\n";
	        $chyba=1;
	}
	if (fmod($_FILES["file"]["size"],198)){
	        $chyb = "Soubor je ve �patn�m form�t�.\n";
	        $chyba=1;
	}
	if ($chyba==1){
		echo "<h1><font color=red>Chyba p�i Importu datab�ze �innost� !</font></h1>";
		echo "<h2>".$chyb."</h2>";
		echo "<center><input type=button onclick='history.back()' value='Zp�t'></center>";
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
		echo "<input name='vlozit' type='submit' value='Ulo�it do datab�ze'>&nbsp;<input type=button onclick='history.back()' value='Zp�t'></form>";
	}
}

// Import tabulky - Ukladani do databaze
if ($status==402){
	$cesta=kontrola($_POST['soubor']);
	include ("./convert/convert-DB-2.php");
	echo "<h2>Krok 3: Import datab�ze �innost� ze soubor� syst�mu CONTEC: Zm�na datab�ze</h2><br>";
	echo "<h1><font color=green>Datab�ze byla �sp�n� obnov�na !</font></h1><hr>";
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

	



	echo "<h1><font color=green>V�sledky vyhled�v�n�...</font></h1><hr>";
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
<h2><font color="green">Vyhled�v�n� stroje:</font></h2>
<table>
<tr><td class="row2">��seln� kl��:</td><td class="row2"><input type="text" value="" name="CisKlic" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row1">Typ</td><td class="row1"><input type="text" value="" name="typ" MAXLENGTH="50"  size="20"></td></tr>
<tr><td class="row2"><b>N�zev stroje:</b></td><td class="row2"><input type="text" value="" name="nazev" MAXLENGTH="50"  size="20"></td></tr>
<tr><td class="row1">V�robce:</td><td class="row1"><input type="text" value="" name="vyrobce" MAXLENGTH="50"  size="20"></td></tr>

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

<tr><td class="row2">V�kon stroje:</td><td class="row2"><select name="vykon_kW"><option></option><option value="1">do 50 kW</option><option value="2">od 50 kW do 100 kW</option><option value="3">od 100 kW do 200 kW</option><option value="4">nad 200 kW</option></select></td></tr>


<tr><td class="row1">Pr�zdn� provozn� hmotnost:</td><td class="row1"><select name="provozni_hmotnost_kg"><option></option><option value="1">do 3 t</option><option value="2">od 3 t do 10 t</option><option value="3">od 10 t do 20 t</option><option value="4">nad 20 t</option></select></td></tr>


<tr><td class="row2">Cena stroje, CZK:</td><td class="row2"><select name="cena_stroje"><option></option><option value="1">do 1 mln. K�</option><option value="2">od 1 do 5 mln. K�</option><option value="3">od 5 do 10 mln. K�</option><option value="4">nad 10 mln. K�</option></select></td></tr>



<tr><td class="row1">Pron�jem stroje:</td><td class="row1"><select name="naklady_standardni_sazba_kc_hod"><option></option><option value="1">do 500,-K�/h</option><option value="2">od 500 do 1 000,-K�/h</option><option value="3">od 1 000 do 2 500,-K�/h</option><option value="4">nad 2 500,-K�/h</option></select></td></tr>

<tr><td class="row2">Pracovn� v�kon:</td><td class="row2"><select name="pracovni_vykon_jednotka_hod"><option></option><option value="1">do 10 jedn/h</option><option value="2">od 10 do 50 jedn/h</option><option value="3">od 50 do 100 jedn/h</option><option value="4">nad 100 jedn/h</option></select></td></tr>

<tr><td class="row1">Pracovn� cyklus:</td><td class="row1"><select name="pracovni_cyklus_sek"><option></option><option value="1">do 30 sek</option><option value="2">od 30 do 100 sek</option><option value="3">od 100 do 500 sek</option><option value="4">nad 500 sek</option></select></td></tr>


<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Hledat">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zp�t"></td></tr>
<tr><td class="row1" colspan="1"><em>Zobraz� se pouze prvn�ch 50 stroj�...</em></td></tr>
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
		echo "<h1><font color=red>Chyba! N�zev stroje mus� b�t unik�tn�!</font></h1>";
	}
	if (!$nazev) {
		echo "<h1><font color=red>Chyba! N�zev stroje nesm� b�t pr�zdn�!</font></h1>";
		$chyba=1;
	}
	if (!$chyba){ 
	
		$pracovni_vykon_jednotka_hod=$pocet_jednotek/$pracovni_cyklus_sek*3600;
		
		mysql_query("INSERT INTO `optimalizace_katalog_stroju` ( `nazev` , `skupina1` , `skupina2` , `typ` , `druh_prvku` , `vykon_kW` , `provozni_hmotnost_kg` , `delka_cm` , `sirka_cm` , `vyska_cm` , `max_rychlost_km_h` , `provozni_rychlost_km_h` , `stoupavost_stupnu` , `tlak_na_zeminu_kPa` , `pridavne_zarizeni_1` , `pridavne_zarizeni_2` , `pridavne_zarizeni_3` , `pridavne_zarizeni_4` , `pridavne_zarizeni_5` , `dosah_hloubka_cm` , `dosah_vyska_cm` , `dosah_delka_cm` , `polomer_otaceni_cm` , `poznamka` , `spotreba_paliva_hi_ml_hod` , `spotreba_paliva_medium_ml_hod` , `spotreba_paliva_low_ml_hod` , `co2_hi_ml_hod` , `co2_medium_ml_hod` , `co2_low_ml_hod` , `hluk_int` , `hluk_ext` , `naklady_standardni_sazba_kc_hod` , `naklady_prescasova_sazba_kc_hod` , `naklady_na_pouziti_kc` , `cena_stroje` , `pravdepodobnost_poruchy_1000_hod` , `prumerna_doba_opravy_min` , `prumerna_cena_opravy_kc` , `prumerna_doba_sluzby_let`, `minimalni_pracovni_plocha_m2` , `pocet_jednotek` , `jednotka` , `pracovni_vykon_jednotka_hod` , `pracovni_cyklus_sek` , `vyrobce`,`cena_stroje_USD` ) 
VALUES ('$nazev', '$skupina1', '$skupina2', '$typ', '$druh_prvku', '$vykon_kW', '$provozni_hmotnost_kg', '$delka_cm', '$sirka_cm', '$vyska_cm', '$max_rychlost_km_h', '$provozni_rychlost_km_h', '$stoupavost_stupnu', '$tlak_na_zeminu_kPa', '$pridavne_zarizeni_1', '$pridavne_zarizeni_2', '$pridavne_zarizeni_3', '$pridavne_zarizeni_4', '$pridavne_zarizeni_5', '$dosah_hloubka_cm', '$dosah_vyska_cm', '$dosah_delka_cm', '$polomer_otaceni_cm', '$poznamka', '$spotreba_paliva_hi_ml_hod', '$spotreba_paliva_medium_ml_hod', '$spotreba_paliva_low_ml_hod', '$co2_hi_ml_hod', '$co2_medium_ml_hod', '$co2_low_ml_hod', '$hluk_int', '$hluk_ext', '$naklady_standardni_sazba_kc_hod', '$naklady_prescasova_sazba_kc_hod', '$naklady_na_pouziti_kc', '$cena_stroje', '$pravdepodobnost_poruchy_1000_hod', '$prumerna_doba_opravy_min', '$prumerna_cena_opravy_kc', '$prumerna_doba_sluzby_let', '$minimalni_pracovni_plocha_m2', '$pocet_jednotek', '$jednotka', '$pracovni_vykon_jednotka_hod', '$pracovni_cyklus_sek', '$vyrobce','$cena_stroje_USD');",$connect2);

		
		$ide=mysql_insert_id($connect2);

		echo "<h1><font color=green>Nov� katalogov� list stroje (ID: ".$ide.") byl �sp�n� ulo�en do datab�ze !</font></h1><hr>";

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
		$langb[175]="Nahr�v�n� obr�zk� m��e trvat velice dlouho - v z�vislosti na rychlosti va�eho p�ipojen� k internetu!";
		$langb[176]="Nevybrali jste soubor, kter� chcete nahr�t";
		$langb[177]="Soubor se nepoda�ilo nahr�t, kontaktujte pros�m spr�vce serveru";
		$langb[178]="Soubor je v�t�� ne� 4 Mb";
		$langb[179]="Koncovka souboru mus� b�t jedna z";

		$langb[180]="Mal� rozli�en� fotky. Minim�ln� po�adovan� je 400x400";
		$langb[181]="Soubor mus� b�t ve form�tu";
		$langb[182]="Chyba p�i ukl�d�n�! Zkuste to, pros�m, znovu. M��ete se pokusit zm�nit obr�zek v aplikaci Malov�n� nebo IrfanView";

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
   $text = "K122, �VUT v Praze, Fakulta stavebn�";
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
		echo "<input name=\"Submit2\" type=\"button\" onClick=\"history.back()\" value=\"Zp�t...\">";

	}
	else $fotok[$i]=1;
}

		
		$status=0;
	}else 	echo '<center><input type=button onclick="history.back()" value="Zp�t"></center>';

}

// Novy zaznam tabulky - formular
if ($status==1){
?>
<form  name="f1" ACTION='./katalogovy-list?sid=<?php echo $sid;?>&amp;sid2=<?php echo $sid2;?>' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="101">
<h2><font color="green">Vlo�en� nov�ho katalogov�ho listu stroje:</font></h2>
<table>
<tr><td class='row2'>N�zev stroje:</td><td class='row2'><input type='text' value='' name='nazev' MAXLENGTH='50'  size='50'></td><td class='row2'>pozn.: <em>v�etn� n�zvu, typu a ozna�en�, nap�.: Naklada� ��zen� smykem CAT 226B/B2</em></td></tr>
<tr><td class='row1'>Prvn� skupina stroje:</td><td class='row1'>
<select name="skupina1"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_1 order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($clanky['id']==$sid) echo "<option value='".$clanky['id']."' selected='selected'>".$clanky['nazev']."</option>";
		else  echo "<option value='".$clanky['id']."'>".$clanky['nazev']."</option>";
	}
?></select>
</td><td class='row1'>pozn.: <em>viz tabulka datab�ze: optimalizace_skupiny_stroju_1</em>
</td></tr>
<tr><td class='row2'>Druh� skupina stroje:</td><td class='row2'>
<select name="skupina2"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_2 order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($clanky['id']==$sid2) echo "<option value='".$clanky['id']."' selected='selected'>".$clanky['nazev']."</option>";
		else echo "<option value='".$clanky['id']."'>".$clanky['nazev']."</option>";
	}
?></select>
</td><td class='row2'>pozn.: <em>viz tabulka datab�ze: optimalizace_skupiny_stroju_2</em></td></tr>
<tr><td class='row1'>Typ stroje:</td><td class='row1'><input type='text' value='' name='typ' MAXLENGTH='50'  size='50'></td><td class='row1'>pozn.: <em>ozna�en� dle v�robce, nap�. CAT 226B/B2</em></td></tr>
<tr><td class='row2'>Druh prvku:</td><td class='row2'>
<select name="druh_prvku"><option value="1">Obsluhuj�c� prvek</option><option value="2">Obsluhovan� prvek</option><option value="3" selected="selected">Samostatn� prvek</option>
</select></td><td class='row2'>pozn.: <em>ozna�en� dle teorie front: obsluhuj�c� prvek, z�kazn�k, samostatn� prvek atd.</em></td></tr>
<tr><td class='row1'>V�kon motoru, [kW]:</td><td class='row1'><input type='text' value='' name='vykon_kW' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>v�kon motoru dle v�robce [kW] resp. [k]</em></td></tr>
<tr><td class='row2'>Pr�zdn� provozn� hmotnost, [kg]:</td><td class='row2'><input type='text' value='' name='provozni_hmotnost_kg' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>provozn� hmotnost dle v�robce [kg]</em></td></tr>
<tr><td class='row1'>D�lka, [cm]:</td><td class='row1'><input type='text' value='' name='delka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>d�lka stroje dle v�robce [cm]</em></td></tr>
<tr><td class='row2'>��rka, [cm]:</td><td class='row2'><input type='text' value='' name='sirka_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>���ka stroje dle v�robce [cm]</em></td></tr>
<tr><td class='row1'>V��ka, [cm]:</td><td class='row1'><input type='text' value='' name='vyska_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>v��ka stroje dle v�robce [cm]</em></td></tr>
<tr><td class='row2'>Maxim�ln� rychlost, [km/h]:</td><td class='row2'><input type='text' value='' name='max_rychlost_km_h' MAXLENGTH='5'  size='10'></td><td class='row2'>pozn.: <em>maxim�ln� rychlost pohybu stroje dle v�robce [km/h]</em></td></tr>
<tr><td class='row1'>Provozn� rychlost, [km/h]:</td><td class='row1'><input type='text' value='' name='provozni_rychlost_km_h' MAXLENGTH='5'  size='10'></td><td class='row1'>pozn.: <em>pr�m�rn� rychlost pohybu stroje dle v�robce [km/h]</em></td></tr>
<tr><td class='row2'>Stoupavost, [grad]:</td><td class='row2'><input type='text' value='' name='stoupavost_stupnu' MAXLENGTH='50'  size='3'></td><td class='row2'>pozn.: <em>maxim�ln� stoupavost stroje dle v�robce [grad]</em></td></tr>
<tr><td class='row1'>Tlak na zeminu, [kPa]:</td><td class='row1'><input type='text' value='' name='tlak_na_zeminu_kPa' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>tlak na zeminu [kPa]</em></td></tr>
<tr><td class='row1'>Dosah hloubka, [cm]:</td><td class='row1'><input type='text' value='' name='dosah_hloubka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>hloubkov� dosah stroje dle v�robce, [cm]</em></td></tr>
<tr><td class='row2'>Dosah v��ka, [cm]:</td><td class='row2'><input type='text' value='' name='dosah_vyska_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>v��kov� dosah stroje dle v�robce, [cm]</em></td></tr>
<tr><td class='row1'>Dosah d�lka, [cm]:</td><td class='row1'><input type='text' value='' name='dosah_delka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>dosah stroje na d�lku dle v�robce, [cm]</em></td></tr>
<tr><td class='row2'>Polom�r ot��en�, [cm]:</td><td class='row2'><input type='text' value='' name='polomer_otaceni_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>hloubkov� dosah stroje dle v�robce, [cm]</em></td></tr>
<tr><td class='row1'>Pozn�mka:</td><td class='row1'><input type='text' value='' name='poznamka' MAXLENGTH='50'  size='50'></td><td class='row1'>pozn.: <em>vlastn� pozn�mka</em></td></tr>
<tr><td class='row2'>Spot�eba paliva vysok�, [ml/h]:</td><td class='row2'><input type='text' value='' name='spotreba_paliva_hi_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>odhad spot�eby paliva dle v�robce pro maxim�ln� vyt�en� stroje (80-100%)</em></td></tr>
<tr><td class='row1'>Spot�eba paliva st�edn�, [ml/h]:</td><td class='row1'><input type='text' value='' name='spotreba_paliva_medium_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>odhad spot�eby paliva dle v�robce pro pr�m�rn� vyt�en� stroje (60-80%)</em></td></tr>
<tr><td class='row2'>Spot�eba paliva n�zk�, [ml/h]:</td><td class='row2'><input type='text' value='' name='spotreba_paliva_low_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>odhad spot�eby paliva dle v�robce pro minim�ln� vyt�en� stroje (40-60%)</em></td></tr>
<tr><td class='row1'>CO<sub>2</sub> vysok�, [g/h]:</td><td class='row1'><input type='text' value='' name='co2_hi_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>odhad produkce CO<sub>2</sub> dle v�robce pro maxim�ln� vyt�en� stroje (80-100%)</em></td></tr>
<tr><td class='row2'>CO<sub>2</sub> st�edn�, [g/h]:</td><td class='row2'><input type='text' value='' name='co2_medium_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>odhad produkce CO<sub>2</sub> dle v�robce pro pr�m�rn� vyt�en� stroje (80-100%)</em></td></tr>
<tr><td class='row1'>CO<sub>2</sub> n�zk�, [g/h]:</td><td class='row1'><input type='text' value='' name='co2_low_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>odhad produkce CO<sub>2</sub> dle v�robce pro minim�ln� vyt�en� stroje (80-100%)</em></td></tr>
<tr><td class='row2'>Hluk v interi�ru, [dB]:</td><td class='row2'><input type='text' value='' name='hluk_int' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>hluk stroje v interi�ru dle v�robce, [dB]</em></td></tr>
<tr><td class='row1'>Hluk v exteri�ru, [dB]:</td><td class='row1'><input type='text' value='' name='hluk_ext' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>hluk stroje v exteri�ru dle v�robce, [dB]</em></td></tr>
<tr><td class='row2'>N�klady, standardn� sazba, [K�/h]:</td><td class='row2'><input type='text' value='' name='naklady_standardni_sazba_kc_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>standardn� hodinov� sazba pron�jmu stroje v�etn� obsluhy bez PHM, [K�/h]</em></td></tr>
<tr><td class='row1'>N�klady, p�es�asov� sazba, [K�/h]:</td><td class='row1'><input type='text' value='' name='naklady_prescasova_sazba_kc_hod' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>p�es�asov� hodinov� sazba pron�jmu stroje v�etn� obsluhy bez PHM, [K�/h]</em></td></tr>
<tr><td class='row2'>N�klady na pou�it�, [K�]:</td><td class='row2'><input type='text' value='' name='naklady_na_pouziti_kc' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>n�klady na cel� �kol nebo n�klad na pou�it� stroje (p��sun, odsun, �kolen� person�lu), [K�]</em></td></tr>
<tr><td class='row1'>Cena stroje, [K�]:</td><td class='row1'><input type='text' value='' name='cena_stroje' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>cena stroje dle prodejn�ch katalog� v�robce, [K�]</em></td></tr>
<tr><td class='row1'>Cena stroje, [USD]:</td><td class='row1'><input type='text' value='' name='cena_stroje_USD' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>cena stroje dle prodejn�ch katalog� v�robce, [USD]</em></td></tr>
<tr><td class='row2'>Pravd�podobnost poruchy, [po�et poruch/1000 h]:</td><td class='row2'><input type='text' value='' name='pravdepodobnost_poruchy_1000_hod' MAXLENGTH='50'  size='3'></td><td class='row2'>pozn.: <em>pr�m�rn� po�et poruch stroje b�hem 1000 hodin pr�ce</em></td></tr>
<tr><td class='row1'>Pr�m�rn� doba opravy, [min]:</td><td class='row1'><input type='text' value='' name='prumerna_doba_opravy_min' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>pr�m�rn� doba opravy stroje dle v�robce, [min]</em></td></tr>
<tr><td class='row2'>Pr�m�rn� cena opravy, [K�]:</td><td class='row2'><input type='text' value='' name='prumerna_cena_opravy_kc' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>pr�m�rn� cena opravy stroje dle v�robce, [K�]</em></td></tr>
<tr><td class='row1'>Pr�m�rn� doba slu�by, [let]:</td><td class='row1'><input type='text' value='' name='prumerna_doba_sluzby_let' MAXLENGTH='50'  size='3'></td><td class='row1'>pozn.: <em>pr�m�rn� doba slu�by stroje za podm�nky servisu dle v�robce, [let]</em></td></tr>
<tr><td class='row2'>Minim�ln� pracovn� plocha, [m<sup>2</sup>]:</td><td class='row2'><input type='text' value='' name='minimalni_pracovni_plocha_m2' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>minim�ln� pracovn� plocha nutn� pro stroj, bez ztr�ty v�konu, [m<sup>2</sup>]</em></td></tr>
<tr><td class='row1'>Po�et jednotek, [-]:</td><td class='row1'><input type='text' value='' name='pocet_jednotek' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>po�et jednotek stroje, nap�. objem korby, lopaty, d�lka radlice atd. [-]</em></td></tr>
<tr><td class='row2'>Jednotka:</td><td class='row2'><input type='text' value='' name='jednotka' MAXLENGTH='50'  size='20'></td><td class='row2'>pozn.: <em>jednotka stroje, nap�. m<sup>3</sup>,m<sup>2</sup>,bm, kg atd.</em></td></tr>
<tr><td class='row1'>Pracovn� v�kon, [jednotka/h]:</td><td class='row1'><input type='text' value='' name='pracovni_vykon_jednotka_hod' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>pracovn� v�kon stroje, [jednotka/h]  </em></td></tr>
<tr><td class='row2'>Pracovn� cyklus, [s]:</td><td class='row2'><input type='text' value='' name='pracovni_cyklus_sek' MAXLENGTH='50'  size='6'></td><td class='row2'>pozn.: <em>pracovn� cyklus stroje, [sek]</em></td></tr>
<tr><td class='row1'>V�robce:</td><td class='row1'>
<select name="vyrobce"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_vyrobce order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo "<option value='".$clanky['nazev']."'>".$clanky['nazev']."</option>";
	}
?></select> nebo 
<input type='text' value='' name='vyrobce2' MAXLENGTH='50'  size='20'>
</td><td class='row1'>pozn.: <em>viz tabulka datab�ze: optimalizace_vyrobce</em></td></tr>

<tr><td class='row2'>Nahr�t foto stroje:</td><td class='row2'><input name="file" type="file"></td>
</td><td class='row2'>pozn.: <em>jen ve form�tu: JPG, minim�ln� rozli�en� 640x480 pixel�.</em></td></tr>

<tr><td class='row1'>Nahr�t katalogov� list v�robce:</td><td class='row1'><input name="file2" type="file"></td>
</td><td class='row1'>pozn.: <em>jen ve form�tu: PDF.</em></td></tr>

<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Ulo�it">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zp�t"></td></tr>
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
	echo "<h1><font color=green>Stroj byl �sp�n� vymaz�n z datab�ze !</font></h1><hr>";
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
		echo "<h1><font color=red>Chyba ! K�d �innosti nesm� b�t pr�zdn� !</font></h1>";
		$chyba=1;
	}

	if (!$nazev) {
		echo "<h1><font color=red>Chyba! N�zev stroje nesm� b�t pr�zdn�!</font></h1>";
		$chyba=1;
	}
	if (!$chyba){ 
	
		$pracovni_vykon_jednotka_hod=$pocet_jednotek/$pracovni_cyklus_sek*3600;
		
		mysql_query("REPLACE INTO `optimalizace_katalog_stroju` ( `id` ,`nazev` , `skupina1` , `skupina2` , `typ` , `druh_prvku` , `vykon_kW` , `provozni_hmotnost_kg` , `delka_cm` , `sirka_cm` , `vyska_cm` , `max_rychlost_km_h` , `provozni_rychlost_km_h` , `stoupavost_stupnu` , `tlak_na_zeminu_kPa` , `pridavne_zarizeni_1` , `pridavne_zarizeni_2` , `pridavne_zarizeni_3` , `pridavne_zarizeni_4` , `pridavne_zarizeni_5` , `dosah_hloubka_cm` , `dosah_vyska_cm` , `dosah_delka_cm` , `polomer_otaceni_cm` , `poznamka` , `spotreba_paliva_hi_ml_hod` , `spotreba_paliva_medium_ml_hod` , `spotreba_paliva_low_ml_hod` , `co2_hi_ml_hod` , `co2_medium_ml_hod` , `co2_low_ml_hod` , `hluk_int` , `hluk_ext` , `naklady_standardni_sazba_kc_hod` , `naklady_prescasova_sazba_kc_hod` , `naklady_na_pouziti_kc` , `cena_stroje` , `pravdepodobnost_poruchy_1000_hod` , `prumerna_doba_opravy_min` , `prumerna_cena_opravy_kc` , `prumerna_doba_sluzby_let`, `minimalni_pracovni_plocha_m2` , `pocet_jednotek` , `jednotka` , `pracovni_vykon_jednotka_hod` , `pracovni_cyklus_sek` , `vyrobce`,`cena_stroje_USD` ) 
VALUES ('$id','$nazev', '$skupina1', '$skupina2', '$typ', '$druh_prvku', '$vykon_kW', '$provozni_hmotnost_kg', '$delka_cm', '$sirka_cm', '$vyska_cm', '$max_rychlost_km_h', '$provozni_rychlost_km_h', '$stoupavost_stupnu', '$tlak_na_zeminu_kPa', '$pridavne_zarizeni_1', '$pridavne_zarizeni_2', '$pridavne_zarizeni_3', '$pridavne_zarizeni_4', '$pridavne_zarizeni_5', '$dosah_hloubka_cm', '$dosah_vyska_cm', '$dosah_delka_cm', '$polomer_otaceni_cm', '$poznamka', '$spotreba_paliva_hi_ml_hod', '$spotreba_paliva_medium_ml_hod', '$spotreba_paliva_low_ml_hod', '$co2_hi_ml_hod', '$co2_medium_ml_hod', '$co2_low_ml_hod', '$hluk_int', '$hluk_ext', '$naklady_standardni_sazba_kc_hod', '$naklady_prescasova_sazba_kc_hod', '$naklady_na_pouziti_kc', '$cena_stroje', '$pravdepodobnost_poruchy_1000_hod', '$prumerna_doba_opravy_min', '$prumerna_cena_opravy_kc', '$prumerna_doba_sluzby_let', '$minimalni_pracovni_plocha_m2', '$pocet_jednotek', '$jednotka', '$pracovni_vykon_jednotka_hod', '$pracovni_cyklus_sek', '$vyrobce','$cena_stroje_USD');",$connect2);

		
		$ide=$id;

		echo "<h1><font color=green>Zm�ny byly ulo�eny do datab�ze !</font></h1><hr>";

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
		$langb[175]="Nahr�v�n� obr�zk� m��e trvat velice dlouho - v z�vislosti na rychlosti va�eho p�ipojen� k internetu!";
		$langb[176]="Nevybrali jste soubor, kter� chcete nahr�t";
		$langb[177]="Soubor se nepoda�ilo nahr�t, kontaktujte pros�m spr�vce serveru";
		$langb[178]="Soubor je v�t�� ne� 4 Mb";
		$langb[179]="Koncovka souboru mus� b�t jedna z";

		$langb[180]="Mal� rozli�en� fotky. Minim�ln� po�adovan� je 400x400";
		$langb[181]="Soubor mus� b�t ve form�tu";
		$langb[182]="Chyba p�i ukl�d�n�! Zkuste to, pros�m, znovu. M��ete se pokusit zm�nit obr�zek v aplikaci Malov�n� nebo IrfanView";

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

   $text = "K122, �VUT v Praze, Fakulta stavebn�";
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
		echo "<input name=\"Submit2\" type=\"button\" onClick=\"history.back()\" value=\"Zp�t...\">";

	}
	else $fotok[$i]=1;
}

		
		$status=0;



	}else 	echo '<center><input type=button onclick="history.back()" value="Zp�t"></center>';



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
<h2><font color="green">Edit�ce katalogov�ho listu stroje:</font></h2>
<table>
<tr><td class='row1'>ID stroje</td><td class='row1'><b><?php echo $id;?></b></td><td class='row1'></td></tr>
<tr><td class='row2'>N�zev stroje:</td><td class='row2'><input type='text' value='<?php echo $nazev;?>' name='nazev' MAXLENGTH='50'  size='50'></td><td class='row2'>pozn.: <em>v�etn� n�zvu, typu a ozna�en�, nap�.: Naklada� ��zen� smykem CAT 226B/B2</em></td></tr>
<tr><td class='row1'>Prvn� skupina stroje:</td><td class='row1'>
<select name="skupina1"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_1 order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($skupina1==$clanky['id']) echo "<option selected='selected' value='".$clanky['id']."'>".$clanky['nazev']."</option>";
		else  echo "<option value='".$clanky['id']."'>".$clanky['nazev']."</option>";
	}
?></select>
</td><td class='row1'>pozn.: <em>viz tabulka datab�ze: optimalizace_skupiny_stroju_1</em>
</td></tr>
<tr><td class='row2'>Druh� skupina stroje:</td><td class='row2'>
<select name="skupina2"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_2 order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($skupina2==$clanky['id']) echo "<option selected='selected' value='".$clanky['id']."'>".$clanky['nazev']."</option>";
		else  echo "<option value='".$clanky['id']."'>".$clanky['nazev']."</option>";
	}
?></select>
</td><td class='row2'>pozn.: <em>viz tabulka datab�ze: optimalizace_skupiny_stroju_2</em></td></tr>
<tr><td class='row1'>Typ stroje:</td><td class='row1'><input type='text' value='<?php echo $typ;?>' name='typ' MAXLENGTH='50'  size='50'></td><td class='row1'>pozn.: <em>ozna�en� dle v�robce, nap�. CAT 226B/B2</em></td></tr>
<tr><td class='row2'>Druh prvku:</td><td class='row2'>
<select name="druh_prvku"><option value="1" <?php if ($druh_prvku==1) echo "selected='selected'";?>>Obsluhuj�c� prvek</option><option value="2" <?php if ($druh_prvku==2) echo "selected='selected'";?>>Obsluhovan� prvek</option><option value="3"  <?php if ($druh_prvku==3) echo "selected='selected'";?>>Samostatn� prvek</option>
</select></td><td class='row2'>pozn.: <em>ozna�en� dle teorie front: obsluhuj�c� prvek, z�kazn�k, samostatn� prvek atd.</em></td></tr>
<tr><td class='row1'>V�kon motoru, [kW]:</td><td class='row1'><input type='text' value='<?php echo $vykon_kW;?>' name='vykon_kW' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>v�kon motoru dle v�robce [kW] resp. [k]</em></td></tr>
<tr><td class='row2'>Pr�zdn� provozn� hmotnost, [kg]:</td><td class='row2'><input type='text' value='<?php echo $provozni_hmotnost_kg;?>' name='provozni_hmotnost_kg' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>provozn� hmotnost dle v�robce [kg]</em></td></tr>
<tr><td class='row1'>D�lka, [cm]:</td><td class='row1'><input type='text' value='<?php echo $delka_cm;?>' name='delka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>d�lka stroje dle v�robce [cm]</em></td></tr>
<tr><td class='row2'>��rka, [cm]:</td><td class='row2'><input type='text' value='<?php echo $sirka_cm;?>' name='sirka_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>���ka stroje dle v�robce [cm]</em></td></tr>
<tr><td class='row1'>V��ka, [cm]:</td><td class='row1'><input type='text' value='<?php echo $vyska_cm;?>' name='vyska_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>v��ka stroje dle v�robce [cm]</em></td></tr>
<tr><td class='row2'>Maxim�ln� rychlost, [km/h]:</td><td class='row2'><input type='text' value='<?php echo $max_rychlost_km_h;?>' name='max_rychlost_km_h' MAXLENGTH='5'  size='10'></td><td class='row2'>pozn.: <em>maxim�ln� rychlost pohybu stroje dle v�robce [km/h]</em></td></tr>
<tr><td class='row1'>Provozn� rychlost, [km/h]:</td><td class='row1'><input type='text' value='<?php echo $provozni_rychlost_km_h;?>' name='provozni_rychlost_km_h' MAXLENGTH='5'  size='10'></td><td class='row1'>pozn.: <em>pr�m�rn� rychlost pohybu stroje dle v�robce [km/h]</em></td></tr>
<tr><td class='row2'>Stoupavost, [grad]:</td><td class='row2'><input type='text' value='<?php echo $stoupavost_stupnu;?>' name='stoupavost_stupnu' MAXLENGTH='50'  size='3'></td><td class='row2'>pozn.: <em>maxim�ln� stoupavost stroje dle v�robce [grad]</em></td></tr>
<tr><td class='row1'>Tlak na zeminu, [kPa]:</td><td class='row1'><input type='text' value='<?php echo $tlak_na_zeminu_kPa;?>' name='tlak_na_zeminu_kPa' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>tlak na zeminu [kPa]</em></td></tr>
<tr><td class='row2'>P��davn� za��zeni 1:</td><td class='row2'><input type='text' value='<?php echo $pridavne_zarizeni_1;?>' name='pridavne_zarizeni_1' MAXLENGTH='50'  size='5'>
 <a href="vlozit-pridavne-zarizeni?sm=1&stroj=<?php echo $id;?>" target="_blank"><?php if ($pridavne_zarizeni_1) echo 'nahradit';else echo 'vlo�it';?> p��davn� za��zeni:</a>
</td><td class='row2'>pozn.: <em>viz tabulka datab�ze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row1'>P��davn� za��zen� 2:</td><td class='row1'><input type='text' value='<?php echo $pridavne_zarizeni_2;?>' name='pridavne_zarizeni_2' MAXLENGTH='50'  size='5'>
 <a href="vlozit-pridavne-zarizeni?sm=2&stroj=<?php echo $id;?>" target="_blank"><?php if ($pridavne_zarizeni_2) echo 'nahradit';else echo 'vlo�it';?> p��davn� za��zeni:</a>
</td><td class='row1'>pozn.: <em>viz tabulka datab�ze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row2'>P��davn� za��zen� 3:</td><td class='row2'><input type='text' value='<?php echo $pridavne_zarizeni_3;?>' name='pridavne_zarizeni_3' MAXLENGTH='50'  size='5'>
 <a href="vlozit-pridavne-zarizeni?sm=3&stroj=<?php echo $id;?>" target="_blank"><?php if ($pridavne_zarizeni_3) echo 'nahradit';else echo 'vlo�it';?> p��davn� za��zeni:</a>
</td><td class='row2'>pozn.: <em>viz tabulka datab�ze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row1'>P��davn� za��zen� 4:</td><td class='row1'><input type='text' value='<?php echo $pridavne_zarizeni_4;?>' name='pridavne_zarizeni_4' MAXLENGTH='50'  size='5'>
 <a href="vlozit-pridavne-zarizeni?sm=4&stroj=<?php echo $id;?>" target="_blank"><?php if ($pridavne_zarizeni_4) echo 'nahradit';else echo 'vlo�it';?> p��davn� za��zeni:</a>
</td><td class='row1'>pozn.: <em>viz tabulka datab�ze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row2'>P��davn� za��zen� 5:</td><td class='row2'><input type='text' value='<?php echo $pridavne_zarizeni_5;?>' name='pridavne_zarizeni_5' MAXLENGTH='50'  size='5'>
<a href="vlozit-pridavne-zarizeni?sm=5&stroj=<?php echo $id;?>" target="_blank"><?php if ($pridavne_zarizeni_5) echo 'nahradit';else echo 'vlo�it';?> p��davn� za��zeni:</a>
</td><td class='row2'>pozn.: <em>viz tabulka datab�ze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row1'>Dosah hloubka, [cm]:</td><td class='row1'><input type='text' value='<?php echo $dosah_hloubka_cm;?>' name='dosah_hloubka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>hloubkov� dosah stroje dle v�robce, [cm]</em></td></tr>
<tr><td class='row2'>Dosah v��ka, [cm]:</td><td class='row2'><input type='text' value='<?php echo $dosah_vyska_cm;?>' name='dosah_vyska_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>v��kov� dosah stroje dle v�robce, [cm]</em></td></tr>
<tr><td class='row1'>Dosah d�lka, [cm]:</td><td class='row1'><input type='text' value='<?php echo $dosah_delka_cm;?>' name='dosah_delka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>dosah stroje na d�lku dle v�robce, [cm]</em></td></tr>
<tr><td class='row2'>Polom�r ot��en�, [cm]:</td><td class='row2'><input type='text' value='<?php echo $polomer_otaceni_cm;?>' name='polomer_otaceni_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>hloubkov� dosah stroje dle v�robce, [cm]</em></td></tr>
<tr><td class='row1'>Pozn�mka:</td><td class='row1'><input type='text' value='<?php echo $poznamka;?>' name='poznamka' MAXLENGTH='50'  size='50'></td><td class='row1'>pozn.: <em>vlastn� pozn�mka</em></td></tr>
<tr><td class='row2'>Spot�eba paliva vysok�, [ml/h]:</td><td class='row2'><input type='text' value='<?php echo $spotreba_paliva_hi_ml_hod;?>' name='spotreba_paliva_hi_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>odhad spot�eby paliva dle v�robce pro maxim�ln� vyt�en� stroje (80-100%)</em></td></tr>
<tr><td class='row1'>Spot�eba paliva st�edn�, [ml/h]:</td><td class='row1'><input type='text' value='<?php echo $spotreba_paliva_medium_ml_hod;?>' name='spotreba_paliva_medium_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>odhad spot�eby paliva dle v�robce pro pr�m�rn� vyt�en� stroje (60-80%)</em></td></tr>
<tr><td class='row2'>Spot�eba paliva n�zk�, [ml/h]:</td><td class='row2'><input type='text' value='<?php echo $spotreba_paliva_low_ml_hod;?>' name='spotreba_paliva_low_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>odhad spot�eby paliva dle v�robce pro minim�ln� vyt�en� stroje (40-60%)</em></td></tr>
<tr><td class='row1'>CO<sub>2</sub> vysok�, [g/h]:</td><td class='row1'><input type='text' value='<?php echo $co2_hi_ml_hod;?>' name='co2_hi_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>odhad produkce CO<sub>2</sub> dle v�robce pro maxim�ln� vyt�en� stroje (80-100%)</em></td></tr>
<tr><td class='row2'>CO<sub>2</sub> st�edn�, [g/h]:</td><td class='row2'><input type='text' value='<?php echo $co2_medium_ml_hod;?>' name='co2_medium_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>odhad produkce CO<sub>2</sub> dle v�robce pro pr�m�rn� vyt�en� stroje (80-100%)</em></td></tr>
<tr><td class='row1'>CO<sub>2</sub> n�zk�, [g/h]:</td><td class='row1'><input type='text' value='<?php echo $co2_low_ml_hod;?>' name='co2_low_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>odhad produkce CO<sub>2</sub> dle v�robce pro minim�ln� vyt�en� stroje (80-100%)</em></td></tr>
<tr><td class='row2'>Hluk v interi�ru, [dB]:</td><td class='row2'><input type='text' value='<?php echo $hluk_int;?>' name='hluk_int' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>hluk stroje v interi�ru dle v�robce, [dB]</em></td></tr>
<tr><td class='row1'>Hluk v exteri�ru, [dB]:</td><td class='row1'><input type='text' value='<?php echo $hluk_ext;?>' name='hluk_ext' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>hluk stroje v exteri�ru dle v�robce, [dB]</em></td></tr>
<tr><td class='row2'>N�klady, standardn� sazba, [K�/h]:</td><td class='row2'><input type='text' value='<?php echo $naklady_standardni_sazba_kc_hod;?>' name='naklady_standardni_sazba_kc_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>standardn� hodinov� sazba pron�jmu stroje v�etn� obsluhy bez PHM, [K�/h]</em></td></tr>
<tr><td class='row1'>N�klady, p�es�asov� sazba, [K�/h]:</td><td class='row1'><input type='text' value='<?php echo $naklady_prescasova_sazba_kc_hod;?>' name='naklady_prescasova_sazba_kc_hod' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>p�es�asov� hodinov� sazba pron�jmu stroje v�etn� obsluhy bez PHM, [K�/h]</em></td></tr>
<tr><td class='row2'>N�klady na pou�it�, [K�]:</td><td class='row2'><input type='text' value='<?php echo $naklady_na_pouziti_kc;?>' name='naklady_na_pouziti_kc' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>n�klady na cel� �kol nebo n�klad na pou�it� stroje (p��sun, odsun, �kolen� person�lu), [K�]</em></td></tr>
<tr><td class='row1'>Cena stroje, [K�]:</td><td class='row1'><input type='text' value='<?php echo $cena_stroje;?>' name='cena_stroje' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>cena stroje dle prodejn�ch katalog� v�robce, [K�]</em></td></tr>
<tr><td class='row1'>Cena stroje, [USD]:</td><td class='row1'><input type='text' value='<?php echo $cena_stroje_USD;?>' name='cena_stroje_USD' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>cena stroje dle prodejn�ch katalog� v�robce, [USD]</em></td></tr>
<tr><td class='row2'>Pravd�podobnost poruchy, [po�et poruch/1000 h]:</td><td class='row2'><input type='text' value='<?php echo $pravdepodobnost_poruchy_1000_hod;?>' name='pravdepodobnost_poruchy_1000_hod' MAXLENGTH='50'  size='3'></td><td class='row2'>pozn.: <em>pr�m�rn� po�et poruch stroje b�hem 1000 hodin pr�ce</em></td></tr>
<tr><td class='row1'>Pr�m�rn� doba opravy, [min]:</td><td class='row1'><input type='text' value='<?php echo $prumerna_doba_opravy_min;?>' name='prumerna_doba_opravy_min' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>pr�m�rn� doba opravy stroje dle v�robce, [min]</em></td></tr>
<tr><td class='row2'>Pr�m�rn� cena opravy, [K�]:</td><td class='row2'><input type='text' value='<?php echo $prumerna_cena_opravy_kc;?>' name='prumerna_cena_opravy_kc' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>pr�m�rn� cena opravy stroje dle v�robce, [K�]</em></td></tr>
<tr><td class='row1'>Pr�m�rn� doba slu�by, [let]:</td><td class='row1'><input type='text' value='<?php echo $prumerna_doba_sluzby_let;?>' name='prumerna_doba_sluzby_let' MAXLENGTH='50'  size='3'></td><td class='row1'>pozn.: <em>pr�m�rn� doba slu�by stroje za podm�nky servisu dle v�robce, [let]</em></td></tr>
<tr><td class='row2'>Minim�ln� pracovn� plocha, [m<sup>2</sup>]:</td><td class='row2'><input type='text' value='<?php echo $minimalni_pracovni_plocha_m2;?>' name='minimalni_pracovni_plocha_m2' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>minim�ln� pracovn� plocha nutn� pro stroj, bez ztr�ty v�konu, [m<sup>2</sup>]</em></td></tr>
<tr><td class='row1'>Po�et jednotek, [-]:</td><td class='row1'><input type='text' value='<?php echo $pocet_jednotek;?>' name='pocet_jednotek' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>po�et jednotek stroje, nap�. objem korby, lopaty, d�lka radlice atd. [-]</em></td></tr>
<tr><td class='row2'>Jednotka:</td><td class='row2'><input type='text' value='<?php echo $jednotka;?>' name='jednotka' MAXLENGTH='50'  size='20'></td><td class='row2'>pozn.: <em>jednotka stroje, nap�. m<sup>3</sup>,m<sup>2</sup>,bm, kg atd.</em></td></tr>
<tr><td class='row1'>Pracovn� v�kon, [jednotka/h]:</td><td class='row1'><?php echo $pracovni_vykon_jednotka_hod;?></td><td class='row1'>pozn.: <em>pracovn� v�kon stroje, [jednotka/h]  </em></td></tr>
<tr><td class='row2'>Pracovn� cyklus, [s]:</td><td class='row2'><input type='text' value='<?php echo $pracovni_cyklus_sek;?>' name='pracovni_cyklus_sek' MAXLENGTH='50'  size='6'></td><td class='row2'>pozn.: <em>pracovn� cyklus stroje, [sek]</em></td></tr>
<tr><td class='row1'>V�robce:</td><td class='row1'>
<select name="vyrobce"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_vyrobce order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo "<option value='".$clanky['nazev']."'>".$clanky['nazev']."</option>";
	}
?></select> nebo 
<input type='text' value='<?php echo $vyrobce;?>' name='vyrobce2' MAXLENGTH='50'  size='20'>
</td><td class='row1'>pozn.: <em>viz tabulka datab�ze: optimalizace_vyrobce</em></td></tr>
<?php
if (file_exists("./photo/low/".$id.".jpg")){?>
<tr><td class='row2' colspan='3'><a title='Zv�t�it foto stroje' href='./photo/hi/<?php echo $id;?>.jpg' target='_blank'><img border='0' src='./photo/low/<?php echo $id;?>.jpg' title='Foto stroje'></a></td></tr>
<tr><td class='row2'>Nahr�dit foto stroje:</td><td class='row2'><input name="file" type="file"></td>
</td><td class='row2'>pozn.: <em>jen ve form�tu: JPG, minim�ln� rozli�en� 640x480 pixel�.</em></td></tr>
<?php
}else{
?>
<tr><td class='row2'>Nahr�t foto stroje:</td><td class='row2'><input name="file" type="file"></td>
</td><td class='row2'>pozn.: <em>jen ve form�tu: JPG, minim�ln� rozli�en� 640x480 pixel�.</em></td></tr>
<?php }?>

<?php
if (file_exists("./katalog/".$id.".pdf")){?>
<tr><td class='row2' colspan='3'><a title='Zobrazit katalogov� list stroje' href='./katalog/<?php echo $id;?>.pdf' target='_blank'>Katalogov� list v�robce:</a></td></tr>
<tr><td class='row2'>Nahr�dit katalogov� list v�robce:</td><td class='row2'><input name="file2" type="file"></td>
</td><td class='row2'>pozn.: <em>jen ve form�tu: PDF.</em></td></tr>
<?php
}else{
?>
<tr><td class='row1'>Nahr�t katalogov� list v�robce:</td><td class='row1'><input name="file2" type="file"></td>
</td><td class='row1'>pozn.: <em>jen ve form�tu: PDF.</em></td></tr>
<?php }?>




<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Ulo�it zm�ny">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zp�t"></td></tr>
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
<h2><font color="green">Katalogov� list stroje: <?php echo $typ." (ID: ".$id.")";?></font></h2><hr>

<table cellspacing="0" cellpadding="2" width="800px">
<tr valign="top"><td width="400px">
<table width="400px">
<?php
if (file_exists("./photo/low/".$id.".jpg")){?>
<tr><td class='row2' colspan='2'><a title='Zv�t�it foto stroje' href='./photo/hi/<?php echo $id;?>.jpg' target='_blank'><img border='0' src='./photo/low/<?php echo $id;?>.jpg' title='Foto stroje'></a><br>
<a title='Zv�t�it foto stroje' href='./photo/hi/<?php echo $id;?>.jpg' target='_blank'>Zv�t�it foto :</a>
</td></tr>
<?php }?>


<tr><td class='row2'><em>N�zev stroje:</em></td><td class='row2'><?php echo $nazev;?></td></tr>

<tr><td class='row2'><em>Prvn� skupina:</em></td><td class='row2'>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_1 where id='$skupina1'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo '<a href="katalogovy-list?sid='.$skupina1.'" title="Zobrazit celou skupinu">'.$clanky['nazev'].'</a>';
	}
?></td></tr>

<tr><td class='row2'><em>Druh� skupina:</em></td><td class='row2'>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_2 where id='$skupina2'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo '<a href="katalogovy-list?sid='.$skupina1.'&amp;sid2='.$skupina2.'" title="Zobrazit celou skupinu">'.$clanky['nazev'].'</a>';
	}
?></td></tr>


<tr><td class='row2'><em>Typ stroje:</em></td><td class='row2'><?php echo $typ;?></td></tr>
<tr><td class='row2'><em>Druh prvku:</em></td><td class='row2'><?php if ($druh_prvku==1) echo "Obsluhuj�c� prvek";?><?php if ($druh_prvku==2) echo "Obsluhovan� prvek";?><?php if ($druh_prvku==3) echo "Samostatn� prvek";?></td></tr>

<tr><td class='row2'><em>V�kon motoru:</em></td><td class='row2'><?php echo $vykon_kW;?> kW</td></tr>

<tr><td class='row2'><em>Provozn� hmotnost:</em></td><td class='row2'><?php echo number_format($provozni_hmotnost_kg,0,","," ");?> kg</td></tr>
<tr><td class='row2'><em>D�lka:</em></td><td class='row2'><?php echo $delka_cm;?> cm</td></tr>
<tr><td class='row2'><em>��rka:</em></td><td class='row2'><?php echo $sirka_cm;?> cm</td></tr>
<tr><td class='row2'><em>V��ka:</em></td><td class='row2'><?php echo $vyska_cm;?> cm</td></tr>
<tr><td class='row2'><em>Maxim�ln� rychlost:</em></td><td class='row2'><?php echo $max_rychlost_km_h;?> km/h</td></tr>
<tr><td class='row2'><em>Provozn� rychlost:</em></td><td class='row2'><?php echo $provozni_rychlost_km_h;?> km/h</td></tr>
<?php if ($stoupavost_stupnu){?><tr><td class='row2'><em>Stoupavost:</em></td><td class='row2'><?php echo $stoupavost_stupnu;?> grad</td></tr><?php }?>
<?php if ($tlak_na_zeminu_kPa){?><tr><td class='row2'><em>Tlak na zeminu:</em></td><td class='row2'><?php echo $tlak_na_zeminu_kPa;?> kPa</td></tr><?php }?>
<?php if ($pridavne_zarizeni_1){?>
<tr><td class='row2'><em>P��davn� za��zeni 1:</em></td><td class='row2'>
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
<tr><td class='row2'><em>P��davn� za��zen� 2:</em></td><td class='row2'><?php 
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
<tr><td class='row2'><em>P��davn� za��zen� 3:</em></td><td class='row2'><?php 
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
<tr><td class='row2'><em>P��davn� za��zen� 4:</em></td><td class='row2'><?php 
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
<tr><td class='row2'><em>P��davn� za��zen� 5:</em></td><td class='row2'><?php 
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
<tr><td class='row2'><br>Ke sta�en�: </td><td class='row2'><br><a title='Zobrazit katalogov� list stroje' href='./katalog/<?php echo $id;?>.pdf' target='_blank'>Katalogov� list v�robce :</a></td></tr>
<?php }?>
</table>
</td><td width="400px" valign="top">
<table width="400px">
<?php if ($dosah_hloubka_cm){?><tr><td class='row2'><em>Dosah hloubka:</em></td><td class='row2'><?php echo $dosah_hloubka_cm;?> cm</td></tr><?php }?>
<?php if ($dosah_vyska_cm){?><tr><td class='row2'><em>Dosah v��ka:</em></td><td class='row2'><?php echo $dosah_vyska_cm;?> cm</td></tr><?php }?>
<?php if ($dosah_delka_cm){?><tr><td class='row2'><em>Dosah d�lka:</em></td><td class='row2'><?php echo $dosah_delka_cm;?> cm</td></tr><?php }?>
<?php if ($polomer_otaceni_cm){?><tr><td class='row2'><em>Polom�r ot��en�:</em></td><td class='row2'><?php echo $polomer_otaceni_cm;?> cm</td></tr><?php }?>
<?php if ($poznamka){?><tr><td class='row2'><em>Pozn�mka:</em></td><td class='row2'><?php echo $poznamka;?></td></tr><?php }?>
<tr><td class='row2'><em>Spot�eba paliva vysok�:</em></td><td class='row2'><?php echo $spotreba_paliva_hi_ml_hod;?> ml/h</td></tr>
<tr><td class='row2'><em>Spot�eba paliva st�edn�:</em></td><td class='row2'><?php echo $spotreba_paliva_medium_ml_hod;?> ml/h</td></tr>
<tr><td class='row2'><em>Spot�eba paliva n�zk�:</em></td><td class='row2'><?php echo $spotreba_paliva_low_ml_hod;?> ml/h</td></tr>
<tr><td class='row2'><em>Produkce CO<sub>2</sub> vysok�:</em></td><td class='row2'><?php echo $co2_hi_ml_hod;?> g/h</td></tr>
<tr><td class='row2'><em>Produkce CO<sub>2</sub> st�edn�:</em></td><td class='row2'><?php echo $co2_medium_ml_hod;?> g/h</td></tr>
<tr><td class='row2'><em>Produkce CO<sub>2</sub> n�zk�:</em></td><td class='row2'><?php echo $co2_low_ml_hod;?> g/h</td></tr>
<?php if ($hluk_int){?><tr><td class='row2'><em>Hluk v interi�ru:</em></td><td class='row2'><?php echo $hluk_int;?> dB</td></tr><?php }?>
<?php if ($hluk_ext){?><tr><td class='row2'><em>Hluk v exteri�ru:</em></td><td class='row2'><?php echo $hluk_ext;?> dB</td></tr><?php }?>
<tr><td class='row2'><em>N�klady, standardn� sazba:</em></td><td class='row2'><?php echo $naklady_standardni_sazba_kc_hod;?> K�/h</td></tr>
<tr><td class='row2'><em>N�klady, p�es�asov� sazba:</em></td><td class='row2'><?php echo $naklady_prescasova_sazba_kc_hod;?> K�/h</td></tr>
<tr><td class='row2'><em>N�klady na pou�it�:</em></td><td class='row2'><?php echo $naklady_na_pouziti_kc;?> K�</td></tr>
<tr><td class='row2'><em>Cena stroje:</em></td><td class='row2'><?php echo number_format($cena_stroje,0,","," ");?> K�</td></tr>
<tr><td class='row2'><em>Cena stroje:</em></td><td class='row2'><?php echo number_format($cena_stroje_USD,0,","," ");?> USD</td></tr>
<?php if ($pravdepodobnost_poruchy_1000_hod){?>
<tr><td class='row2'><em>Pravd�podobnost poruchy:</em></td><td class='row2'><?php echo $pravdepodobnost_poruchy_1000_hod;?> po�et poruch/1000 h</td></tr>
<tr><td class='row2'><em>Pr�m�rn� doba opravy:</em></td><td class='row2'><?php echo $prumerna_doba_opravy_min;?> min</td></tr>
<tr><td class='row2'><em>Pr�m�rn� cena opravy:</em></td><td class='row2'><?php echo $prumerna_cena_opravy_kc;?> K�</td></tr>
<tr><td class='row2'><em>Pr�m�rn� doba slu�by:</em></td><td class='row2'><?php echo $prumerna_doba_sluzby_let;?> let</td></tr>
<?php }?>
<?php if ($minimalni_pracovni_plocha_m2){?><tr><td class='row2'><em>Minim�ln� pracovn� plocha:</em></td><td class='row2'><?php echo $minimalni_pracovni_plocha_m2;?> m<sup>2</sup></td></tr><?php }?>
<tr><td class='row2'><em>Po�et jednotek:</em></td><td class='row2'><?php echo $pocet_jednotek;?> <?php echo $jednotka;?></td></tr>
<?php if ($pracovni_cyklus_sek){?><tr><td class='row2'><em>Pracovn� cyklus:</em></td><td class='row2'><?php echo $pracovni_cyklus_sek;?> s</td></tr><?php }?>
<tr><td class='row2'><em>Pracovn� v�kon:</em></td><td class='row2'><?php echo $pracovni_vykon_jednotka_hod;?> <?php echo $jednotka;?>/h</td></tr>
<tr><td class='row2'><em>Produktivita pr�ce:</em></td><td class='row2'><?php echo round(1/$pracovni_vykon_jednotka_hod,6);?> Nh/<?php echo $jednotka;?></td></tr>
<tr><td class='row2'><em>V�robce:</em></td><td class='row2'><?php echo $vyrobce;?></td></tr>
</table>
</td></tr>

<tr><td class="row1" colspan="2" align="center"><hr><input type=button onclick="history.back()" value="Zp�t"></td></tr>

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
<h2><font color="green">Nov� katalogov� list stroje:</font></h2>
<table>
<tr><td class='row2'>N�zev stroje:</td><td class='row2'><input type='text' value='<?php echo $nazev;?>' name='nazev' MAXLENGTH='50'  size='50'></td><td class='row2'>pozn.: <em>v�etn� n�zvu, typu a ozna�en�, nap�.: Naklada� ��zen� smykem CAT 226B/B2</em></td></tr>
<tr><td class='row1'>Prvn� skupina stroje:</td><td class='row1'>
<select name="skupina1"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_1 order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($skupina1==$clanky['id']) echo "<option selected='selected' value='".$clanky['id']."'>".$clanky['nazev']."</option>";
		else  echo "<option value='".$clanky['id']."'>".$clanky['nazev']."</option>";
	}
?></select>
</td><td class='row1'>pozn.: <em>viz tabulka datab�ze: optimalizace_skupiny_stroju_1</em>
</td></tr>
<tr><td class='row2'>Druh� skupina stroje:</td><td class='row2'>
<select name="skupina2"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_skupiny_stroju_2 order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($skupina2==$clanky['id']) echo "<option selected='selected' value='".$clanky['id']."'>".$clanky['nazev']."</option>";
		else  echo "<option value='".$clanky['id']."'>".$clanky['nazev']."</option>";
	}
?></select>
</td><td class='row2'>pozn.: <em>viz tabulka datab�ze: optimalizace_skupiny_stroju_2</em></td></tr>
<tr><td class='row1'>Typ stroje:</td><td class='row1'><input type='text' value='<?php echo $typ;?>' name='typ' MAXLENGTH='50'  size='50'></td><td class='row1'>pozn.: <em>ozna�en� dle v�robce, nap�. CAT 226B/B2</em></td></tr>
<tr><td class='row2'>Druh prvku:</td><td class='row2'>
<select name="druh_prvku"><option value="1" <?php if ($druh_prvku==1) echo "selected='selected'";?>>Obsluhuj�c� prvek</option><option value="2" <?php if ($druh_prvku==2) echo "selected='selected'";?>>Obsluhovan� prvek</option><option value="3"  <?php if ($druh_prvku==3) echo "selected='selected'";?>>Samostatn� prvek</option>
</select></td><td class='row2'>pozn.: <em>ozna�en� dle teorie front: obsluhuj�c� prvek, z�kazn�k, samostatn� prvek atd.</em></td></tr>
<tr><td class='row1'>V�kon motoru, [kW]:</td><td class='row1'><input type='text' value='<?php echo $vykon_kW;?>' name='vykon_kW' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>v�kon motoru dle v�robce [kW] resp. [k]</em></td></tr>
<tr><td class='row2'>Pr�zdn� provozn� hmotnost, [kg]:</td><td class='row2'><input type='text' value='<?php echo $provozni_hmotnost_kg;?>' name='provozni_hmotnost_kg' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>provozn� hmotnost dle v�robce [kg]</em></td></tr>
<tr><td class='row1'>D�lka, [cm]:</td><td class='row1'><input type='text' value='<?php echo $delka_cm;?>' name='delka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>d�lka stroje dle v�robce [cm]</em></td></tr>
<tr><td class='row2'>��rka, [cm]:</td><td class='row2'><input type='text' value='<?php echo $sirka_cm;?>' name='sirka_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>���ka stroje dle v�robce [cm]</em></td></tr>
<tr><td class='row1'>V��ka, [cm]:</td><td class='row1'><input type='text' value='<?php echo $vyska_cm;?>' name='vyska_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>v��ka stroje dle v�robce [cm]</em></td></tr>
<tr><td class='row2'>Maxim�ln� rychlost, [km/h]:</td><td class='row2'><input type='text' value='<?php echo $max_rychlost_km_h;?>' name='max_rychlost_km_h' MAXLENGTH='5'  size='10'></td><td class='row2'>pozn.: <em>maxim�ln� rychlost pohybu stroje dle v�robce [km/h]</em></td></tr>
<tr><td class='row1'>Provozn� rychlost, [km/h]:</td><td class='row1'><input type='text' value='<?php echo $provozni_rychlost_km_h;?>' name='provozni_rychlost_km_h' MAXLENGTH='5'  size='10'></td><td class='row1'>pozn.: <em>pr�m�rn� rychlost pohybu stroje dle v�robce [km/h]</em></td></tr>
<tr><td class='row2'>Stoupavost, [grad]:</td><td class='row2'><input type='text' value='<?php echo $stoupavost_stupnu;?>' name='stoupavost_stupnu' MAXLENGTH='50'  size='3'></td><td class='row2'>pozn.: <em>maxim�ln� stoupavost stroje dle v�robce [grad]</em></td></tr>
<tr><td class='row1'>Tlak na zeminu, [kPa]:</td><td class='row1'><input type='text' value='<?php echo $tlak_na_zeminu_kPa;?>' name='tlak_na_zeminu_kPa' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>tlak na zeminu [kPa]</em></td></tr>
<tr><td class='row2'>P��davn� za��zeni 1:</td><td class='row2'><input type='text' value='<?php echo $pridavne_zarizeni_1;?>' name='pridavne_zarizeni_1' MAXLENGTH='50'  size='5'>
 <a href="vlozit-pridavne-zarizeni?sm=1" target="_blank"><?php if ($pridavne_zarizeni_1) echo 'nahradit';else echo 'vlo�it';?> p��davn� za��zeni:</a>
</td><td class='row2'>pozn.: <em>viz tabulka datab�ze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row1'>P��davn� za��zen� 2:</td><td class='row1'><input type='text' value='<?php echo $pridavne_zarizeni_2;?>' name='pridavne_zarizeni_2' MAXLENGTH='50'  size='5'>
 <a href="vlozit-pridavne-zarizeni?sm=2" target="_blank"><?php if ($pridavne_zarizeni_2) echo 'nahradit';else echo 'vlo�it';?> p��davn� za��zeni:</a>
</td><td class='row1'>pozn.: <em>viz tabulka datab�ze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row2'>P��davn� za��zen� 3:</td><td class='row2'><input type='text' value='<?php echo $pridavne_zarizeni_3;?>' name='pridavne_zarizeni_3' MAXLENGTH='50'  size='5'>
 <a href="vlozit-pridavne-zarizeni?sm=3" target="_blank"><?php if ($pridavne_zarizeni_3) echo 'nahradit';else echo 'vlo�it';?> p��davn� za��zeni:</a>
</td><td class='row2'>pozn.: <em>viz tabulka datab�ze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row1'>P��davn� za��zen� 4:</td><td class='row1'><input type='text' value='<?php echo $pridavne_zarizeni_4;?>' name='pridavne_zarizeni_4' MAXLENGTH='50'  size='5'>
 <a href="vlozit-pridavne-zarizeni?sm=4" target="_blank"><?php if ($pridavne_zarizeni_4) echo 'nahradit';else echo 'vlo�it';?> p��davn� za��zeni:</a>
</td><td class='row1'>pozn.: <em>viz tabulka datab�ze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row2'>P��davn� za��zen� 5:</td><td class='row2'><input type='text' value='<?php echo $pridavne_zarizeni_5;?>' name='pridavne_zarizeni_5' MAXLENGTH='50'  size='5'>
<a href="vlozit-pridavne-zarizeni?sm=5" target="_blank"><?php if ($pridavne_zarizeni_5) echo 'nahradit';else echo 'vlo�it';?> p��davn� za��zeni:</a>
</td><td class='row2'>pozn.: <em>viz tabulka datab�ze: optimalizace_pridavna_zarizeni</em></td></tr>
<tr><td class='row1'>Dosah hloubka, [cm]:</td><td class='row1'><input type='text' value='<?php echo $dosah_hloubka_cm;?>' name='dosah_hloubka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>hloubkov� dosah stroje dle v�robce, [cm]</em></td></tr>
<tr><td class='row2'>Dosah v��ka, [cm]:</td><td class='row2'><input type='text' value='<?php echo $dosah_vyska_cm;?>' name='dosah_vyska_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>v��kov� dosah stroje dle v�robce, [cm]</em></td></tr>
<tr><td class='row1'>Dosah d�lka, [cm]:</td><td class='row1'><input type='text' value='<?php echo $dosah_delka_cm;?>' name='dosah_delka_cm' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>dosah stroje na d�lku dle v�robce, [cm]</em></td></tr>
<tr><td class='row2'>Polom�r ot��en�, [cm]:</td><td class='row2'><input type='text' value='<?php echo $polomer_otaceni_cm;?>' name='polomer_otaceni_cm' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>hloubkov� dosah stroje dle v�robce, [cm]</em></td></tr>
<tr><td class='row1'>Pozn�mka:</td><td class='row1'><input type='text' value='<?php echo $poznamka;?>' name='poznamka' MAXLENGTH='50'  size='50'></td><td class='row1'>pozn.: <em>vlastn� pozn�mka</em></td></tr>
<tr><td class='row2'>Spot�eba paliva vysok�, [ml/h]:</td><td class='row2'><input type='text' value='<?php echo $spotreba_paliva_hi_ml_hod;?>' name='spotreba_paliva_hi_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>odhad spot�eby paliva dle v�robce pro maxim�ln� vyt�en� stroje (80-100%)</em></td></tr>
<tr><td class='row1'>Spot�eba paliva st�edn�, [ml/h]:</td><td class='row1'><input type='text' value='<?php echo $spotreba_paliva_medium_ml_hod;?>' name='spotreba_paliva_medium_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>odhad spot�eby paliva dle v�robce pro pr�m�rn� vyt�en� stroje (60-80%)</em></td></tr>
<tr><td class='row2'>Spot�eba paliva n�zk�, [ml/h]:</td><td class='row2'><input type='text' value='<?php echo $spotreba_paliva_low_ml_hod;?>' name='spotreba_paliva_low_ml_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>odhad spot�eby paliva dle v�robce pro minim�ln� vyt�en� stroje (40-60%)</em></td></tr>
<tr><td class='row1'>CO<sub>2</sub> vysok�, [g/h]:</td><td class='row1'><input type='text' value='<?php echo $co2_hi_ml_hod;?>' name='co2_hi_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>odhad produkce CO<sub>2</sub> dle v�robce pro maxim�ln� vyt�en� stroje (80-100%)</em></td></tr>
<tr><td class='row2'>CO<sub>2</sub> st�edn�, [g/h]:</td><td class='row2'><input type='text' value='<?php echo $co2_medium_ml_hod;?>' name='co2_medium_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>odhad produkce CO<sub>2</sub> dle v�robce pro pr�m�rn� vyt�en� stroje (80-100%)</em></td></tr>
<tr><td class='row1'>CO<sub>2</sub> n�zk�, [g/h]:</td><td class='row1'><input type='text' value='<?php echo $co2_low_ml_hod;?>' name='co2_low_ml_hod' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>odhad produkce CO<sub>2</sub> dle v�robce pro minim�ln� vyt�en� stroje (80-100%)</em></td></tr>
<tr><td class='row2'>Hluk v interi�ru, [dB]:</td><td class='row2'><input type='text' value='<?php echo $hluk_int;?>' name='hluk_int' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>hluk stroje v interi�ru dle v�robce, [dB]</em></td></tr>
<tr><td class='row1'>Hluk v exteri�ru, [dB]:</td><td class='row1'><input type='text' value='<?php echo $hluk_ext;?>' name='hluk_ext' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>hluk stroje v exteri�ru dle v�robce, [dB]</em></td></tr>
<tr><td class='row2'>N�klady, standardn� sazba, [K�/h]:</td><td class='row2'><input type='text' value='<?php echo $naklady_standardni_sazba_kc_hod;?>' name='naklady_standardni_sazba_kc_hod' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>standardn� hodinov� sazba pron�jmu stroje v�etn� obsluhy bez PHM, [K�/h]</em></td></tr>
<tr><td class='row1'>N�klady, p�es�asov� sazba, [K�/h]:</td><td class='row1'><input type='text' value='<?php echo $naklady_prescasova_sazba_kc_hod;?>' name='naklady_prescasova_sazba_kc_hod' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>p�es�asov� hodinov� sazba pron�jmu stroje v�etn� obsluhy bez PHM, [K�/h]</em></td></tr>
<tr><td class='row2'>N�klady na pou�it�, [K�]:</td><td class='row2'><input type='text' value='<?php echo $naklady_na_pouziti_kc;?>' name='naklady_na_pouziti_kc' MAXLENGTH='50'  size='8'></td><td class='row2'>pozn.: <em>n�klady na cel� �kol nebo n�klad na pou�it� stroje (p��sun, odsun, �kolen� person�lu), [K�]</em></td></tr>
<tr><td class='row1'>Cena stroje, [K�]:</td><td class='row1'><input type='text' value='<?php echo $cena_stroje;?>' name='cena_stroje' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>cena stroje dle prodejn�ch katalog� v�robce, [K�]</em></td></tr>
<tr><td class='row1'>Cena stroje, [USD]:</td><td class='row1'><input type='text' value='<?php echo $cena_stroje_USD;?>' name='cena_stroje_USD' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>cena stroje dle prodejn�ch katalog� v�robce, [USD]</em></td></tr>
<tr><td class='row2'>Pravd�podobnost poruchy, [po�et poruch/1000 h]:</td><td class='row2'><input type='text' value='<?php echo $pravdepodobnost_poruchy_1000_hod;?>' name='pravdepodobnost_poruchy_1000_hod' MAXLENGTH='50'  size='3'></td><td class='row2'>pozn.: <em>pr�m�rn� po�et poruch stroje b�hem 1000 hodin pr�ce</em></td></tr>
<tr><td class='row1'>Pr�m�rn� doba opravy, [min]:</td><td class='row1'><input type='text' value='<?php echo $prumerna_doba_opravy_min;?>' name='prumerna_doba_opravy_min' MAXLENGTH='50'  size='5'></td><td class='row1'>pozn.: <em>pr�m�rn� doba opravy stroje dle v�robce, [min]</em></td></tr>
<tr><td class='row2'>Pr�m�rn� cena opravy, [K�]:</td><td class='row2'><input type='text' value='<?php echo $prumerna_cena_opravy_kc;?>' name='prumerna_cena_opravy_kc' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>pr�m�rn� cena opravy stroje dle v�robce, [K�]</em></td></tr>
<tr><td class='row1'>Pr�m�rn� doba slu�by, [let]:</td><td class='row1'><input type='text' value='<?php echo $prumerna_doba_sluzby_let;?>' name='prumerna_doba_sluzby_let' MAXLENGTH='50'  size='3'></td><td class='row1'>pozn.: <em>pr�m�rn� doba slu�by stroje za podm�nky servisu dle v�robce, [let]</em></td></tr>
<tr><td class='row2'>Minim�ln� pracovn� plocha, [m<sup>2</sup>]:</td><td class='row2'><input type='text' value='<?php echo $minimalni_pracovni_plocha_m2;?>' name='minimalni_pracovni_plocha_m2' MAXLENGTH='50'  size='5'></td><td class='row2'>pozn.: <em>minim�ln� pracovn� plocha nutn� pro stroj, bez ztr�ty v�konu, [m<sup>2</sup>]</em></td></tr>
<tr><td class='row1'>Po�et jednotek, [-]:</td><td class='row1'><input type='text' value='<?php echo $pocet_jednotek;?>' name='pocet_jednotek' MAXLENGTH='50'  size='8'></td><td class='row1'>pozn.: <em>po�et jednotek stroje, nap�. objem korby, lopaty, d�lka radlice atd. [-]</em></td></tr>
<tr><td class='row2'>Jednotka:</td><td class='row2'><input type='text' value='<?php echo $jednotka;?>' name='jednotka' MAXLENGTH='50'  size='20'></td><td class='row2'>pozn.: <em>jednotka stroje, nap�. m<sup>3</sup>,m<sup>2</sup>,bm, kg atd.</em></td></tr>
<tr><td class='row1'>Pracovn� v�kon, [jednotka/h]:</td><td class='row1'><?php echo $pracovni_vykon_jednotka_hod;?></td><td class='row1'>pozn.: <em>pracovn� v�kon stroje, [jednotka/h]  </em></td></tr>
<tr><td class='row2'>Pracovn� cyklus, [s]:</td><td class='row2'><input type='text' value='<?php echo $pracovni_cyklus_sek;?>' name='pracovni_cyklus_sek' MAXLENGTH='50'  size='6'></td><td class='row2'>pozn.: <em>pracovn� cyklus stroje, [s]</em></td></tr>
<tr><td class='row1'>V�robce:</td><td class='row1'>
<select name="vyrobce"><option></option>
<?php
	$getclanek = mysql_query("SELECT * FROM optimalizace_vyrobce order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		echo "<option value='".$clanky['nazev']."'>".$clanky['nazev']."</option>";
	}
?></select> nebo 
<input type='text' value='<?php echo $vyrobce;?>' name='vyrobce2' MAXLENGTH='50'  size='20'>
</td><td class='row1'>pozn.: <em>viz tabulka datab�ze: optimalizace_vyrobce</em></td></tr>

<tr><td class='row2'>Nahr�t foto stroje:</td><td class='row2'><input name="file" type="file"></td>
</td><td class='row2'>pozn.: <em>jen ve form�tu: JPG, minim�ln� rozli�en� 640x480 pixel�.</em></td></tr>

<tr><td class='row1'>Nahr�t katalogov� list v�robce:</td><td class='row1'><input name="file2" type="file"></td>
</td><td class='row1'>pozn.: <em>jen ve form�tu: PDF.</em></td></tr>


<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Ulo�it do katalogu">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zp�t"></td></tr>
</table>
</form>
<?php
}


// Nahlizeni do tabulky
if ($status==0){

echo "<table><tr valign='middle'><td align='left'><form  ACTION='./katalogovy-list?sid=".$sid."&amp;sid2=".$sid2."' METHOD='post' ENCTYPE='multipart/form-data'>";
if ($lock==0) echo "<a href='?sid=".$sid."&amp;sid2=".$sid2."&amp;status=1' title='Nov� katalogov� list stroje'><img src='./skin/button/32/new.png' alt='Nov� katalogov� list stroje' width='32px' height='32px' border='0'></a>&nbsp;";
echo "<a href='tisk-katalogu' title='Tisk katalogu' target='_blank'><img src='./skin/button/32/printer.png' alt='Tisk katalogu' width='32px' height='32px' border='0'></a>&nbsp;";
if ($lock==0) echo "<a href='?sid=".$sid."&amp;sid2=".$sid2."&amp;status=3' title='Export katalogu'><img src='./skin/button/32/export.png' alt='Export katalogu' width='32px' height='32px' border='0'></a>&nbsp;";
if ($lock==0) echo "<a href='?sid=".$sid."&amp;sid2=".$sid2."&amp;status=4' title='Import katalogu'><img src='./skin/button/32/import.png' alt='Import katalogu' width='32px' height='32px' border='0'></a>&nbsp;";
echo "<a href='?sid=".$sid."&amp;sid2=".$sid2."&amp;status=5' title='Hledat stroj'><img src='./skin/button/32/search.png' alt='Hledat stroj' width='32px' height='32px' border='0'></a>&nbsp;";
echo "&nbsp;&nbsp;&nbsp;<img src='./skin/button/32/sort.png' alt='�azen� stroj�' width='32px' height='32px'>&nbsp;";
echo "<select name='razeni' onChange='submit();'>";
echo "<option value='10'"; if ($razeni==10) echo " selected"; echo ">dle ��s. k�du +</option>";
echo "<option value='1'"; if ($razeni==1) echo " selected"; echo ">dle ��s. k�du -</option>";
echo "<option value='4'"; if ($razeni==4) echo " selected"; echo ">dle v�konu, kW +</option>";
echo "<option value='5'"; if ($razeni==5) echo " selected"; echo ">dle v�konu, kW -</option>";
echo "<option value='8'"; if ($razeni==8) echo " selected"; echo ">dle pracovn�ho v�konu, m.j. +</option>";
echo "<option value='9'"; if ($razeni==9) echo " selected"; echo ">dle pracovn�ho v�konu, m.j. -</option>";
echo "<option value='6'"; if ($razeni==6) echo " selected"; echo ">dle hmotnosti +</option>";
echo "<option value='7'"; if ($razeni==7) echo " selected"; echo ">dle hmotnosti -</option>";
echo "<option value='2'"; if ($razeni==2) echo " selected"; echo ">dle n�zvu +</option>";
echo "<option value='3'"; if ($razeni==3) echo " selected"; echo ">dle n�zvu -</option>";
echo "</select>&nbsp;<input type='submit' value='�adit'>";

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
<font class="name">Celkem bylo nalezeno stroj�: <?php echo $celkem2;?></font>
<table class="forumline" cellspacing="0" cellpadding="2" width="1024px">
<tr>
<td align="center" class="catLeft"><font class="name2"><b>��s.kl��</b></font></td>
<td align="center" class="catLeft" width="150px"><font class="name2"><b>Typ</b></font></td>
<td align="center" class="catLeft">&nbsp;</td>
<td align="center" class="catLeft" width="250px"><font class="name2"><b>N�zev stroje</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>V�kon, [kW]</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Provozn� hmotnost, [t]</b></font></td>
<td align="center" class="catLeft" width="200px"><font class="name2"><b>Sekce</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Cena stroje, [tis.K�]</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Pron�jem stroje, [K�/h]</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Pracovn� v�kon, [m.j./h]</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Pracovn� objem, [m.j.]</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Pracovn� cyklus, [s]</b></font></td>
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
		echo "<a href='?sid=".$sid."&amp;sid2=".$sid2."&amp;status=7&amp;id=".$CisKlic."' title='Zobrazit katalogov� list stroje'><img src='./skin/button/16/view.png' alt='Zobrazit katalogov� list stroje' width='16px' height='16px' border='0'></a>&nbsp;";
		echo "<a href='tisk-katalogu?id=".$CisKlic."' title='Tisk �innosti' target='_blank'><img src='./skin/button/16/printer.png' alt='Tisk �innosti' width='16px' height='16px' border='0'></a>&nbsp;";
		if ($lock==0) echo "<br><a href='?sid=".$sid."&amp;sid2=".$sid2."&amp;status=6&amp;id=".$CisKlic."' title='Editovat katalogov� list stroje'><img src='./skin/button/16/edit.png' alt='Editovat katalogov� list stroje' width='16px' height='16px' border='0'></a>&nbsp;";
		if ($lock==0) echo "<a href='?sid=".$sid."&amp;sid2=".$sid2."&amp;status=8&amp;id=".$CisKlic."' title='Kop�rovat katalogov� list stroje'><img src='./skin/button/16/copy.png' alt='Kop�rovat katalogov� list stroje' width='16px' height='16px' border='0'></a>&nbsp;";
		if ($lock==0) echo "<a href='?sid=".$sid."&amp;sid2=".$sid2."&amp;status=9&amp;id=".$CisKlic."' title='Vymazat katalogov� list stroje'><img src='./skin/button/16/delete.png' alt='Vymazat katalogov� list stroje' width='16px' height='16px' border='0'></a>&nbsp;";
		echo '</td>';


		echo '<td align="left" class="row'.$row.'"><font class="name2"><a href="?sid='.$sid.'&amp;sid2='.$sid2.'&amp;status=7&amp;id='.$CisKlic.'" title="Zobrazit katalogov� list stroje"><b>'.$nazev.'</b></a></font></td>
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
    <td width="20%" align="right" valign="top"><?php if($pozice+1 >= $pocetc){echo("<A HREF=\"./$roma1\"><font color=\"red\">: p�edchoz�</font></A>");}?></td>
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
    <td width="20%" align="left" valign="top"><?php if($pozice+$pocetc < $celkem){echo("<A HREF=\"./$roma2\"><font color=\"red\">dal�� :</font></A>
");}?></td>
 </tr>
</table>
<?php
}}else{

echo "<h1>Je n�m l�to. Nebyl nalezen ��dn� stroj odpov�daj�c� Va�emu zad�n�.</h1>";
echo "<h1>Omlouv�me se za zp�soben� pot�e.</h1>";


}

}


?>