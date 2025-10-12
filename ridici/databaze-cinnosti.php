<?php 
echo "<h1>".$mainlang[7]."</h1>";

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
	echo "<h2>Krok 1: Export èinností: Volba formátu</h2><br>";
	echo "<form method='post'  enctype='multipart/form-data'>";
	echo "Formát: <select name='status'><option value='301'>CSV</option><option value='302'>MS EXCEL</option><option value='303'>TXT</option><option value='304'>CONTEC</option><option value='305'>MS WORD</option></select><br><br>";
	echo "<input name='vlozit' type='submit' value='Exportovat'>&nbsp;<input type=button onclick='history.back()' value='Zpìt'></form>";
}

// EXPORT tabulky - CSV
if ($status==301){

	echo "<h2>Krok 2: Export èinností: Uložit soubor</h2><br>";
	$db=$connect2;
	$tabl="DB";
	$tabl2="DB";
	$sql="SELECT * FROM `DB` order by CisKlic";
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

	$tabl="DB";
	$tabl2="DB";

	echo "<h2>Krok 2: Export èinností: Uložit soubor</h2><br>";


	$seed = floor(time()/86400);
	srand($seed);
	$time=Time();
	$rand = Rand();
	$datum=date("Y-m-d",time());
	$filnam=$tabl2."-".$datum."-".MD5($time.$rand).".xls";
	$filnam2=$tabl2."-".$datum."-".MD5($time.$rand);
	$cesta="./export/xls/".$filnam;
	$cesta2="./export/xls/".$filnam2;


$DB_TBLName="DB";

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

	echo "<h2>Krok 2: Export èinností: Uložit soubor</h2><br>";



	$db=$connect2;
	$tabl="DB";
	$tabl2="DB";
	$sql="SELECT * FROM `DB` order by CisKlic";
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

	echo "<h2>Krok 2: Export èinností: Uložit soubor</h2><br>";

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


$DB_TBLName="DB";

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
	$SlovKlic= strtoupper (kontrola($_POST['SlovKlic']));
	$NazCin= strtoupper (kontrola($_POST['NazCin']));
	$MJD= kontrola($_POST['MJD']);
	$NCD= kontrola($_POST['NCD']);
	$ProdD= kontrola($_POST['ProdD']);
	$PracD= kontrola($_POST['PracD']);
	$ProfD= strtoupper (kontrola($_POST['ProfD']));
	$TPD= kontrola($_POST['TPD']);
	$DruhD= kontrola($_POST['DruhD']);



	echo "<h1><font color=green>Výsledky vyhledývaní...</font></h1><hr>";

	if ($CisKlic) $vyhledavani=" CisKlic like '%".$CisKlic."%'";
	if ($SlovKlic) $vyhledavani=$vyhledavani." and SlovKlic like '%".$SlovKlic."%'";
	if ($NazCin) $vyhledavani=$vyhledavani." and NazCin like '%".$NazCin."%'";
	if ($MJD) $vyhledavani=$vyhledavani." and MJD like '%".$MJD."%'";
	if ($NCD) $vyhledavani=$vyhledavani." and NCD like '%".$NCD."%'";
	if ($ProdD) $vyhledavani=$vyhledavani." and ProdD like '%".$ProdD."%'";
	if ($PracD) $vyhledavani=$vyhledavani." and PracD like '%".$PracD."%'";
	if ($ProfD) $vyhledavani=$vyhledavani." and ProfD like '%".$ProfD."%'";
	if ($TPD) $vyhledavani=$vyhledavani." and TPD like '%".$TPD."%'";
	if ($DruhD) $vyhledavani=$vyhledavani." and DruhD like '%".$DruhD."%'";
	if (substr($vyhledavani,0,4)==" and") $vyhledavani=substr($vyhledavani,4,strlen($vyhledavani));
	$status=0;
}


// Vyhledavani - formular
if ($status==5){
?>
<form  ACTION='./databaze-cinnosti' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="501">
<h2><font color="green">Vyhledávaní èinností:</font></h2>
<table>
<tr><td class="row2">Èíselní klíè:</td><td class="row2"><input type="text" value="" name="CisKlic" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row1">Zkratka</td><td class="row1"><input type="text" value="" name="SlovKlic" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row2"><b>Název èinnosti:</b></td><td class="row1"><input type="text" value="" name="NazCin" MAXLENGTH="24"  size="24"></td></tr>
<tr><td class="row1">Mìrná jednotka:</td><td class="row2"><input type="text" value="" name="MJD" MAXLENGTH="4"  size="4"></td></tr>
<tr><td class="row2">Norma èasu:</td><td class="row1"><input type="text" value="" name="NCD" MAXLENGTH="8"  size="8"> Nh/m.j.</td></tr>
<tr><td class="row1">Produktivita:</td><td class="row2"><input type="text" value="" name="ProdD" MAXLENGTH="8"  size="8">  Kè/Nh</td></tr>
<tr><td class="row2">Poèet pracovníku:</td><td class="row1"><input type="text" value="" name="PracD" MAXLENGTH="2"  size="2"></td></tr>
<tr><td class="row1">Profese:</td><td class="row2"><input type="text" value="" name="ProfD" MAXLENGTH="6"  size="6"></td></tr>
<tr><td class="row2">Technologická pøestávka:</td><td class="row1"><input type="text" value="" name="TPD" MAXLENGTH="2"  size="2"> dnù</td></tr>
<tr><td class="row1">Druh èinnosti:</td><td class="row2"><select name="DruhD"><option></option><option value="1">HSV</option><option value="2">PSV</option><option value="3">CIZÍ</option></select></td></tr>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Hledat">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zpìt"></td></tr>
<tr><td class="row1" colspan="2"><em>Zobrazí se pouze prvních 50 èinností.</em></td></tr>
</table>
</form>
<?php
}


// Novy zaznam tabulky -pridani do MySQL
if ($status==101){

	$CisKlic= kontrola($_POST['CisKlic']);
	$SlovKlic= strtoupper (kontrola($_POST['SlovKlic']));
	$NazCin= strtoupper (kontrola($_POST['NazCin']));
	$MJD= kontrola($_POST['MJD']);
	$NCD= sprintf ("%01.4f", kontrola($_POST['NCD']));
	$ProdD= sprintf ("%01.2f", kontrola($_POST['ProdD']));
	$PracD= kontrola($_POST['PracD']);
	$ProfD= strtoupper (kontrola($_POST['ProfD']));
	$TPD= kontrola($_POST['TPD']);
	$DruhD= kontrola($_POST['DruhD']);

	$Stroj1= kontrola($_POST['Stroj1']);
	$Stroj2= kontrola($_POST['Stroj2']);
	$Stroj3= kontrola($_POST['Stroj3']);
	$Stroj4= kontrola($_POST['Stroj4']);
	$Stroj5= kontrola($_POST['Stroj5']);
	$Stroj6= kontrola($_POST['Stroj6']);


	$KapNor1= sprintf ("%01.3f", kontrola($_POST['KapNor1']));
	$KapNor2= sprintf ("%01.3f", kontrola($_POST['KapNor2']));
	$KapNor3= sprintf ("%01.3f", kontrola($_POST['KapNor3']));
	$KapNor4= sprintf ("%01.3f", kontrola($_POST['KapNor4']));
	$KapNor5= sprintf ("%01.3f", kontrola($_POST['KapNor5']));
	$KapNor6= sprintf ("%01.3f", kontrola($_POST['KapNor6']));
	$MSpot1= sprintf ("%01.2f", kontrola($_POST['MSpot1']));
	$MSpot2= sprintf ("%01.2f", kontrola($_POST['MSpot2']));
	$MSpot3= sprintf ("%01.2f", kontrola($_POST['MSpot3']));
	$MSpot4= sprintf ("%01.2f", kontrola($_POST['MSpot4']));
	$MSpot5= sprintf ("%01.2f", kontrola($_POST['MSpot5']));
	$MSpot6= sprintf ("%01.2f", kontrola($_POST['MSpot6']));
	$PalD1= kontrola($_POST['PalD1']);
	$PalD2= kontrola($_POST['PalD2']);
	$PalD3= kontrola($_POST['PalD3']);
	$PalD4= kontrola($_POST['PalD4']);
	$PalD5= kontrola($_POST['PalD5']);
	$PalD6= kontrola($_POST['PalD6']);


	$chyba=0;
	$chyba=mysql_result(mysql_query("SELECT count(*) FROM DB where CisKlic='".$CisKlic."'",$connect2),0);

	if ($chyba) {
		echo "<h1><font color=red>Chyba ! Kód èinnosti musí být unikátní !</font></h1>";
	}
	if (!$CisKlic) {
		echo "<h1><font color=red>Chyba ! Kód èinnosti nesmí být prázdný !</font></h1>";
		$chyba=1;
	}
	if (!$NazCin) {
		echo "<h1><font color=red>Chyba ! Název èinnosti nesmí být prázdný !</font></h1>";
		$chyba=1;
	}
	if (!$chyba){ 
		mysql_query("INSERT INTO `DB` ( `CinStatus` , `CisKlic` , `SlovKlic` , `NazCin` , `MJD` , `NCD` , `ProdD` , `PracD` , `ProfD` , `TPD` , `DruhD` , `Stroj1` , `Stroj2` , `Stroj3` , `Stroj4` , `Stroj5` , `Stroj6` , `KapNor1` , `KapNor2` , `KapNor3` , `KapNor4` , `KapNor5` , `KapNor6` , `MSpot1` , `MSpot2` , `MSpot3` , `MSpot4` , `MSpot5` , `MSpot6` , `PalD1` , `PalD2` , `PalD3` , `PalD4` , `PalD5` , `PalD6` ) 
VALUES (
'$CinStatus', '$CisKlic', '$SlovKlic', '$NazCin', '$MJD', '$NCD', '$ProdD', '$PracD', '$ProfD', '$TPD', '$DruhD', '$Stroj1', '$Stroj2', '$Stroj3', '$Stroj4', '$Stroj5', '$Stroj6', '$KapNor1', '$KapNor2', '$KapNor3', '$KapNor4', '$KapNor5', '$KapNor6', '$MSpot1', '$MSpot2', '$MSpot3', '$MSpot4', '$MSpot5', '$MSpot6', '$PalD1', '$PalD2', '$PalD3', '$PalD4', '$PalD5', '$PalD6');",$connect2);
		echo "<h1><font color=green>Nová èinnost byla úspìšnì uložena do databáze !</font></h1><hr>";
		$status=0;
	}else 	echo '<center><input type=button onclick="history.back()" value="Zpìt"></center>';


}

// Novy zaznam tabulky - formular
if ($status==1){
?>
<form  ACTION='./databaze-cinnosti' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="101">
<h2><font color="green">Vložení nové èinnosti:</font></h2>
<table>
<tr><td class="row2">Èíselní klíè:</td><td class="row2"><input type="text" value="" name="CisKlic" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row1">Zkratka</td><td class="row1"><input type="text" value="" name="SlovKlic" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row2"><b>Název èinnosti:</b></td><td class="row2"><input type="text" value="" name="NazCin" MAXLENGTH="24"  size="24"></td></tr>
<tr><td class="row1">Mìrná jednotka:</td><td class="row1"><input type="text" value="" name="MJD" MAXLENGTH="4"  size="4"></td></tr>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row2">Norma èasu:</td><td class="row2"><input type="text" value="" name="NCD" MAXLENGTH="8"  size="8"> Nh/m.j.</td></tr>
<tr><td class="row1">Produktivita:</td><td class="row1"><input type="text" value="" name="ProdD" MAXLENGTH="8"  size="8">  Kè/Nh</td></tr>
<tr><td class="row2">Poèet pracovníku:</td><td class="row2"><input type="text" value="" name="PracD" MAXLENGTH="2"  size="2"></td></tr>
<tr><td class="row1">Profese:</td><td class="row1"><input type="text" value="" name="ProfD" MAXLENGTH="6"  size="6"></td></tr>
<tr><td class="row2">Technologická pøestávka:</td><td class="row2"><input type="text" value="" name="TPD" MAXLENGTH="2"  size="2"> dnù</td></tr>
<tr><td class="row1">Druh èinnosti:</td><td class="row1"><select name="DruhD"><option></option><option value="1">HSV</option><option value="2">PSV</option><option value="3">CIZÍ</option></select></td></tr>
<tr><td class="row1" colspan="2"><br><b>Stroje:</b></td></tr>

<tr><td class="row1" colspan="2"><hr><em>Stroj 1:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="" name="Stroj1" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="" name="KapNor1" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="" name="MSpot1" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD1"><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>


<tr><td class="row1" colspan="2"><hr><em>Stroj 2:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="" name="Stroj2" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="" name="KapNor2" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="" name="MSpot2" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD2"><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>


<tr><td class="row1" colspan="2"><hr><em>Stroj 3:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="" name="Stroj3" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="" name="KapNor3" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="" name="MSpot3" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD3"><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>


<tr><td class="row1" colspan="2"><hr><em>Stroj 4:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="" name="Stroj4" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="" name="KapNor4" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="" name="MSpot4" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD4"><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>


<tr><td class="row1" colspan="2"><hr><em>Stroj 5:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="" name="Stroj5" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="" name="KapNor5" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="" name="MSpot5" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD5"><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>


<tr><td class="row1" colspan="2"><hr><em>Stroj 6:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="" name="Stroj6" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="" name="KapNor6" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="" name="MSpot6" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD6"><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>

<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Uložit">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zpìt"></td></tr>
</table>
</form>
<?php
}


// Vymazavani zaznamu
if ($status==9){
	$id = kontrola($_GET['id']);
	$getclanek = mysql_query("SELECT * FROM `DB` where CisKlic='".$id."' Limit 0,1",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$CisKlic=$clanky['CisKlic'];
		$SlovKlic=$clanky['SlovKlic'];
		$NazCin=$clanky['NazCin'];
	}
	echo "<h1><font color=red>Opravdu chcete vymazat èinnost:  ".$id." / ".$SlovKlic." / ".$NazCin." ?</font></h1>";

	echo "<b><a href='databaze-cinnosti?status=901&amp;id=".$id."'>ANO</a>&nbsp;&nbsp;<a href='databaze-cinnosti'>NE</a></b><br><br>";

}


// Vymazavani zaznamu z tabulky MySQL
if ($status==901){
	$id = kontrola($_GET['id']);
	mysql_query("DELETE FROM `DB` where CisKlic='".$id."'",$connect2);
	echo "<h1><font color=green>Èinnost byla úspìšnì vymazána z databáze !</font></h1><hr>";
	$status=0;
}

// Ukladani zmen do MySQL
if ($status==601){

	$CisKlic= kontrola($_POST['CisKlic']);
	$SlovKlic= strtoupper (kontrola($_POST['SlovKlic']));
	$NazCin= strtoupper (kontrola($_POST['NazCin']));
	$MJD= kontrola($_POST['MJD']);
	$NCD= sprintf ("%01.4f", kontrola($_POST['NCD']));
	$ProdD= sprintf ("%01.2f", kontrola($_POST['ProdD']));
	$PracD= kontrola($_POST['PracD']);
	$ProfD= strtoupper (kontrola($_POST['ProfD']));
	$TPD= kontrola($_POST['TPD']);
	$DruhD= kontrola($_POST['DruhD']);

	$Stroj1= kontrola($_POST['Stroj1']);
	$Stroj2= kontrola($_POST['Stroj2']);
	$Stroj3= kontrola($_POST['Stroj3']);
	$Stroj4= kontrola($_POST['Stroj4']);
	$Stroj5= kontrola($_POST['Stroj5']);
	$Stroj6= kontrola($_POST['Stroj6']);


	$KapNor1= sprintf ("%01.3f", kontrola($_POST['KapNor1']));
	$KapNor2= sprintf ("%01.3f", kontrola($_POST['KapNor2']));
	$KapNor3= sprintf ("%01.3f", kontrola($_POST['KapNor3']));
	$KapNor4= sprintf ("%01.3f", kontrola($_POST['KapNor4']));
	$KapNor5= sprintf ("%01.3f", kontrola($_POST['KapNor5']));
	$KapNor6= sprintf ("%01.3f", kontrola($_POST['KapNor6']));
	$MSpot1= sprintf ("%01.2f", kontrola($_POST['MSpot1']));
	$MSpot2= sprintf ("%01.2f", kontrola($_POST['MSpot2']));
	$MSpot3= sprintf ("%01.2f", kontrola($_POST['MSpot3']));
	$MSpot4= sprintf ("%01.2f", kontrola($_POST['MSpot4']));
	$MSpot5= sprintf ("%01.2f", kontrola($_POST['MSpot5']));
	$MSpot6= sprintf ("%01.2f", kontrola($_POST['MSpot6']));
	$PalD1= kontrola($_POST['PalD1']);
	$PalD2= kontrola($_POST['PalD2']);
	$PalD3= kontrola($_POST['PalD3']);
	$PalD4= kontrola($_POST['PalD4']);
	$PalD5= kontrola($_POST['PalD5']);
	$PalD6= kontrola($_POST['PalD6']);


	$chyba=0;
//	$chyba=mysql_result(mysql_query("SELECT count(*) FROM DB where CisKlic='".$CisKlic."'",$connect2),0);

	if ($chyba) {
		echo "<h1><font color=red>Chyba ! Kód èinnosti musí být unikátní !</font></h1>";
	}
	if (!$CisKlic) {
		echo "<h1><font color=red>Chyba ! Kód èinnosti nesmí být prázdný !</font></h1>";
		$chyba=1;
	}
	if (!$NazCin) {
		echo "<h1><font color=red>Chyba ! Název èinnosti nesmí být prázdný !</font></h1>";
		$chyba=1;
	}
	if (!$chyba){ 
		mysql_query("REPLACE INTO `DB` ( `CinStatus` , `CisKlic` , `SlovKlic` , `NazCin` , `MJD` , `NCD` , `ProdD` , `PracD` , `ProfD` , `TPD` , `DruhD` , `Stroj1` , `Stroj2` , `Stroj3` , `Stroj4` , `Stroj5` , `Stroj6` , `KapNor1` , `KapNor2` , `KapNor3` , `KapNor4` , `KapNor5` , `KapNor6` , `MSpot1` , `MSpot2` , `MSpot3` , `MSpot4` , `MSpot5` , `MSpot6` , `PalD1` , `PalD2` , `PalD3` , `PalD4` , `PalD5` , `PalD6` ) 
VALUES (
'$CinStatus', '$CisKlic', '$SlovKlic', '$NazCin', '$MJD', '$NCD', '$ProdD', '$PracD', '$ProfD', '$TPD', '$DruhD', '$Stroj1', '$Stroj2', '$Stroj3', '$Stroj4', '$Stroj5', '$Stroj6', '$KapNor1', '$KapNor2', '$KapNor3', '$KapNor4', '$KapNor5', '$KapNor6', '$MSpot1', '$MSpot2', '$MSpot3', '$MSpot4', '$MSpot5', '$MSpot6', '$PalD1', '$PalD2', '$PalD3', '$PalD4', '$PalD5', '$PalD6');",$connect2);
		echo "<h1><font color=green>Zmìny èinnsoti byly úspìšnì uloženy do databáze !</font></h1><hr>";
		$status=0;
	}else 	echo '<center><input type=button onclick="history.back()" value="Zpìt"></center>';



}


// Editace cinnosti - formular
if ($status==6){

	$id = kontrola($_GET['id']);


	$getclanek = mysql_query("SELECT * FROM DB where CisKlic='$id'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){


		$CisKlic= $clanky['CisKlic'];
		$SlovKlic= $clanky['SlovKlic'];
		$NazCin= $clanky['NazCin'];
		$MJD= $clanky['MJD'];
		$NCD= number_format($clanky['NCD'],4,","," ");
		$ProdD= number_format($clanky['ProdD'],2,","," ");

		$jedncena=number_format($clanky['NCD']*$clanky['ProdD'],2,","," ");
		$PracD= $clanky['PracD'];
		$ProfD= $clanky['ProfD'];
		$TPD= $clanky['TPD'];
		$DruhD= $clanky['DruhD'];
		$DruhDt= $clanky['DruhD'];
		if ($DruhD==1) $DruhD="HSV";
		if ($DruhD==2) $DruhD="PSV";
		if ($DruhD==3) $DruhD="CIZÍ";

		$Stroj1= $clanky['Stroj1'];
		$Stroj2= $clanky['Stroj2'];
		$Stroj3= $clanky['Stroj3'];
		$Stroj4= $clanky['Stroj4'];
		$Stroj5= $clanky['Stroj5'];
		$Stroj6= $clanky['Stroj6'];
		$KapNor1= number_format($clanky['KapNor1'],3,","," ");
		$KapNor2= number_format($clanky['KapNor2'],3,","," ");
		$KapNor3= number_format($clanky['KapNor3'],3,","," ");
		$KapNor4= number_format($clanky['KapNor4'],3,","," ");
		$KapNor5= number_format($clanky['KapNor5'],3,","," ");
		$KapNor6= number_format($clanky['KapNor6'],3,","," ");
		$MSpot1= number_format($clanky['MSpot1'],2,","," ");
		$MSpot2= number_format($clanky['MSpot2'],2,","," ");
		$MSpot3= number_format($clanky['MSpot3'],2,","," ");
		$MSpot4= number_format($clanky['MSpot4'],2,","," ");
		$MSpot5= number_format($clanky['MSpot5'],2,","," ");
		$MSpot6= number_format($clanky['MSpot6'],2,","," ");
		$PalD1= $clanky['PalD1'];
		$PalD2= $clanky['PalD2'];
		$PalD3= $clanky['PalD3'];
		$PalD4= $clanky['PalD4'];
		$PalD5= $clanky['PalD5'];
		$PalD6= $clanky['PalD6'];

		$PalD1t= $clanky['PalD1'];
		$PalD2t= $clanky['PalD2'];
		$PalD3t= $clanky['PalD3'];
		$PalD4t= $clanky['PalD4'];
		$PalD5t= $clanky['PalD5'];
		$PalD6t= $clanky['PalD6'];

if ($PalD1=="1") $PalD1="Benzín";if ($PalD1=="2") $PalD1="Nafta";if ($PalD1=="3") $PalD1="Elektøina";if ($PalD1=="4") $PalD1="Jiné";
if ($PalD2=="1") $PalD2="Benzín";if ($PalD2=="2") $PalD2="Nafta";if ($PalD2=="3") $PalD2="Elektøina";if ($PalD2=="4") $PalD2="Jiné";
if ($PalD3=="1") $PalD3="Benzín";if ($PalD3=="2") $PalD3="Nafta";if ($PalD3=="3") $PalD3="Elektøina";if ($PalD3=="4") $PalD3="Jiné";
if ($PalD4=="1") $PalD4="Benzín";if ($PalD4=="2") $PalD4="Nafta";if ($PalD4=="3") $PalD4="Elektøina";if ($PalD4=="4") $PalD4="Jiné";
if ($PalD5=="1") $PalD5="Benzín";if ($PalD5=="2") $PalD5="Nafta";if ($PalD5=="3") $PalD5="Elektøina";if ($PalD5=="4") $PalD5="Jiné";
if ($PalD6=="1") $PalD6="Benzín";if ($PalD6=="2") $PalD6="Nafta";if ($PalD6=="3") $PalD6="Elektøina";if ($PalD6=="4") $PalD6="Jiné";

		
		if ($row==1) $row=2;else $row=1;

	}



?>
<form  ACTION='./databaze-cinnosti' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="601">
<input type="hidden" name="CisKlic" value="<?php echo $CisKlic;?>">
<h2><font color="green">Editace èinnosti:</font></h2>
<table>


<tr><td class="row2">Èíselní klíè:</td><td class="row2"><b><?php echo $CisKlic;?></b></td></tr>

<tr><td class="row1">Zkratka</td><td class="row1"><input type="text" value="<?php echo $SlovKlic;?>" name="SlovKlic" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row2"><b>Název èinnosti:</b></td><td class="row2"><input type="text" value="<?php echo $NazCin;?>" name="NazCin" MAXLENGTH="24"  size="24"></td></tr>
<tr><td class="row1">Mìrná jednotka:</td><td class="row1"><input type="text" value="<?php echo $MJD;?>" name="MJD" MAXLENGTH="4"  size="4"></td></tr>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row2">Norma èasu:</td><td class="row2"><input type="text" value="<?php echo $NCD;?>" name="NCD" MAXLENGTH="8"  size="8"> Nh/m.j.</td></tr>
<tr><td class="row1">Produktivita:</td><td class="row1"><input type="text" value="<?php echo $ProdD;?>" name="ProdD" MAXLENGTH="8"  size="8">  Kè/Nh</td></tr>
<tr><td class="row2">Poèet pracovníku:</td><td class="row2"><input type="text" value="<?php echo $PracD;?>" name="PracD" MAXLENGTH="2"  size="2"></td></tr>
<tr><td class="row1">Profese:</td><td class="row1"><input type="text" value="<?php echo $ProfD;?>" name="ProfD" MAXLENGTH="6"  size="6"></td></tr>
<tr><td class="row2">Technologická pøestávka:</td><td class="row2"><input type="text" value="<?php echo $TPD;?>" name="TPD" MAXLENGTH="2"  size="2"> dnù</td></tr>
<tr><td class="row1">Druh èinnosti:</td><td class="row1"><select name="DruhD"><option value="<?php echo $DruhDt;?>"><?php echo $DruhD;?></option><option></option><option value="1">HSV</option><option value="2">PSV</option><option value="3">CIZÍ</option></select></td></tr>
<tr><td class="row1" colspan="2"><br><b>Stroje:</b></td></tr>


<tr><td class="row1" colspan="2"><hr><em>Stroj 1:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="<?php echo $Stroj1;?>" name="Stroj1" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="<?php echo $KapNor1;?>" name="KapNor1" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="<?php echo $MSpot1;?>" name="MSpot1" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD1"><option value="<?php echo $PalD1t;?>"><?php echo $PalD1;?></option><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>


<tr><td class="row1" colspan="2"><hr><em>Stroj 2:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="<?php echo $Stroj2;?>" name="Stroj2" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="<?php echo $KapNor2;?>" name="KapNor2" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="<?php echo $MSpot2;?>" name="MSpot2" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD2"><option value="<?php echo $PalD2t;?>"><?php echo $PalD2;?></option><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>


<tr><td class="row1" colspan="2"><hr><em>Stroj 3:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="<?php echo $Stroj3;?>" name="Stroj3" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="<?php echo $KapNor3;?>" name="KapNor3" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="<?php echo $MSpot3;?>" name="MSpot3" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD3"><option value="<?php echo $PalD3t;?>"><?php echo $PalD3;?></option><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>


<tr><td class="row1" colspan="2"><hr><em>Stroj 4:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="<?php echo $Stroj4;?>" name="Stroj4" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="<?php echo $KapNor4;?>" name="KapNor4" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="<?php echo $MSpot4;?>" name="MSpot4" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD4"><option value="<?php echo $PalD4t;?>"><?php echo $PalD4;?></option><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>


<tr><td class="row1" colspan="2"><hr><em>Stroj 5:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="<?php echo $Stroj5;?>" name="Stroj5" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="<?php echo $KapNor5;?>" name="KapNor5" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="<?php echo $MSpot5;?>" name="MSpot5" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD5"><option value="<?php echo $PalD5t;?>"><?php echo $PalD5;?></option><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>


<tr><td class="row1" colspan="2"><hr><em>Stroj 6:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="<?php echo $Stroj6;?>" name="Stroj6" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="<?php echo $KapNor6;?>" name="KapNor6" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="<?php echo $MSpot6;?>" name="MSpot6" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD6"><option value="<?php echo $PalD6t;?>"><?php echo $PalD6;?></option><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>




<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Uložit zmìny">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zpìt"></td></tr>
</table>
</form>
<?php
}

// Karta cinnosti - nahled
if ($status==7){

	$id = kontrola($_GET['id']);

	$getclanek = mysql_query("SELECT * FROM DB where CisKlic='$id'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){


		$CisKlic= $clanky['CisKlic'];
		$SlovKlic= $clanky['SlovKlic'];
		$NazCin= $clanky['NazCin'];
		$MJD= $clanky['MJD'];
		$NCD= number_format($clanky['NCD'],4,","," ");
		$ProdD= number_format($clanky['ProdD'],2,","," ");

		$jedncena=number_format($clanky['NCD']*$clanky['ProdD'],2,","," ");
		$PracD= $clanky['PracD'];
		$ProfD= $clanky['ProfD'];
		$TPD= $clanky['TPD'];
		$DruhD= $clanky['DruhD'];
		if ($DruhD==1) $DruhD="HSV";
		if ($DruhD==2) $DruhD="PSV";
		if ($DruhD==3) $DruhD="CIZÍ";

		$Stroj1= $clanky['Stroj1'];
		$Stroj2= $clanky['Stroj2'];
		$Stroj3= $clanky['Stroj3'];
		$Stroj4= $clanky['Stroj4'];
		$Stroj5= $clanky['Stroj5'];
		$Stroj6= $clanky['Stroj6'];
		$KapNor1= number_format($clanky['KapNor1'],3,","," ");
		$KapNor2= number_format($clanky['KapNor2'],3,","," ");
		$KapNor3= number_format($clanky['KapNor3'],3,","," ");
		$KapNor4= number_format($clanky['KapNor4'],3,","," ");
		$KapNor5= number_format($clanky['KapNor5'],3,","," ");
		$KapNor6= number_format($clanky['KapNor6'],3,","," ");
		$MSpot1= number_format($clanky['MSpot1'],2,","," ");
		$MSpot2= number_format($clanky['MSpot2'],2,","," ");
		$MSpot3= number_format($clanky['MSpot3'],2,","," ");
		$MSpot4= number_format($clanky['MSpot4'],2,","," ");
		$MSpot5= number_format($clanky['MSpot5'],2,","," ");
		$MSpot6= number_format($clanky['MSpot6'],2,","," ");
		$PalD1= $clanky['PalD1'];
		$PalD2= $clanky['PalD2'];
		$PalD3= $clanky['PalD3'];
		$PalD4= $clanky['PalD4'];
		$PalD5= $clanky['PalD5'];
		$PalD6= $clanky['PalD6'];

if ($PalD1=="1") $PalD1="Benzín";if ($PalD1=="2") $PalD1="Nafta";if ($PalD1=="3") $PalD1="Elektøina";if ($PalD1=="4") $PalD1="Jiné";
if ($PalD2=="1") $PalD2="Benzín";if ($PalD2=="2") $PalD2="Nafta";if ($PalD2=="3") $PalD2="Elektøina";if ($PalD2=="4") $PalD2="Jiné";
if ($PalD3=="1") $PalD3="Benzín";if ($PalD3=="2") $PalD3="Nafta";if ($PalD3=="3") $PalD3="Elektøina";if ($PalD3=="4") $PalD3="Jiné";
if ($PalD4=="1") $PalD4="Benzín";if ($PalD4=="2") $PalD4="Nafta";if ($PalD4=="3") $PalD4="Elektøina";if ($PalD4=="4") $PalD4="Jiné";
if ($PalD5=="1") $PalD5="Benzín";if ($PalD5=="2") $PalD5="Nafta";if ($PalD5=="3") $PalD5="Elektøina";if ($PalD5=="4") $PalD5="Jiné";
if ($PalD6=="1") $PalD6="Benzín";if ($PalD6=="2") $PalD6="Nafta";if ($PalD6=="3") $PalD6="Elektøina";if ($PalD6=="4") $PalD6="Jiné";

	}

?>
<h2><font color="green">Karta èinnosti:</font></h2><hr>

<table cellspacing="0" cellpadding="2" width="800px">
<tr><td width="50%">
<table width="400px">
<tr><td class="row2">Èíselní klíè:</td><td class="row2"><b><?php echo $CisKlic;?></b></td></tr>
<tr><td class="row1">Zkratka:</td><td class="row1"><b><?php echo $SlovKlic;?></b></td></tr>
<tr><td class="row2"><b>Název èinnosti:</b></td><td class="row2"><b><?php echo $NazCin;?></b></td></tr>
<tr><td>Mìrná jednotka:</td><td><?php echo $MJD;?></td></tr>
<tr><td class="row2">Norma èasu:</td><td class="row2"><?php echo $NCD;?> Nh/m.j.</td></tr>
<tr><td>Jednotková cena:</td><td><?php echo $jedncena;?> Kè/m.j.</td></tr>
<tr><td class="row2">Produktivita:</td><td class="row2"><?php echo $ProdD;?> Kè/Nh</td></tr>
<tr><td>Poèet pracovníku:</td><td><?php echo $PracD;?></td></tr>
<tr><td class="row2">Profese:</td><td class="row2"><?php echo $ProfD;?></td></tr>
<tr><td>Technologická pøestávka:</td><td><?php echo $TPD;?> dnù</td></tr>
<tr><td class="row2">Druh èinnosti:</td><td class="row2"><?php echo $DruhD;?></td></tr>
</table>
</td><td width="50%" valign="top">
<table width="400px">
<tr><td colspan="5"><b><em>Stroje:</em></b></td></tr>
<tr><td><font class="name2">Èís.</font></td><td><font class="name2">Název stroje</font></td><td><font class="name2">Kapacitní norma</font></td><td><font class="name2">Mìrná spotøeba</font></td><td><font class="name2">Palívo</font></td></tr>

<tr><td class="row2">1.</em></td><td class="row2"><?php echo $Stroj1;?>&nbsp;</td><td align="center" class="row2"><?php echo $KapNor1;?></td><td align="center" class="row2"><?php echo $MSpot1;?></td><td align="center" class="row2"><?php echo $PalD1;?>&nbsp;</td></tr>


<tr><td>2.</em></td><td><?php echo $Stroj2;?>&nbsp;</td><td align="center"><?php echo $KapNor2;?></td><td align="center"><?php echo $MSpot2;?></td><td align="center"><?php echo $PalD2;?>&nbsp;</td></tr>


<tr><td class="row2">3.</em></td><td class="row2"><?php echo $Stroj3;?>&nbsp;</td><td align="center" class="row2"><?php echo $KapNor3;?></td><td align="center" class="row2"><?php echo $MSpot3;?></td><td align="center" class="row2"><?php echo $PalD3;?>&nbsp;</td></tr>


<tr><td>4.</em></td><td><?php echo $Stroj4;?>&nbsp;</td><td align="center"><?php echo $KapNor4;?></td><td align="center"><?php echo $MSpot4;?></td><td align="center"><?php echo $PalD4;?>&nbsp;</td></tr>


<tr><td class="row2">5.</em></td><td class="row2"><?php echo $Stroj5;?>&nbsp;</td><td align="center" class="row2"><?php echo $KapNor5;?></td><td align="center" class="row2"><?php echo $MSpot5;?></td><td align="center" class="row2"><?php echo $PalD5;?>&nbsp;</td></tr>


<tr><td>6.</em></td><td><?php echo $Stroj6;?>&nbsp;</td><td align="center"><?php echo $KapNor6;?></td><td align="center"><?php echo $MSpot6;?></td><td align="center"><?php echo $PalD6;?>&nbsp;</td></tr>

</table>
</td></tr>

<tr><td class="row1" colspan="2" align="center"><hr><input type=button onclick="history.back()" value="Zpìt"></td></tr>

</table>

<?php
}


// Kopirovani cinnosti - formular
if ($status==8){

	$id = kontrola($_GET['id']);

	$getclanek = mysql_query("SELECT * FROM DB where CisKlic='$id'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){


		$CisKlic= $clanky['CisKlic'];
		$SlovKlic= $clanky['SlovKlic'];
		$NazCin= $clanky['NazCin'];
		$MJD= $clanky['MJD'];
		$NCD= number_format($clanky['NCD'],4,","," ");
		$ProdD= number_format($clanky['ProdD'],2,","," ");

		$jedncena=number_format($clanky['NCD']*$clanky['ProdD'],2,","," ");
		$PracD= $clanky['PracD'];
		$ProfD= $clanky['ProfD'];
		$TPD= $clanky['TPD'];
		$DruhD= $clanky['DruhD'];
		$DruhDt= $clanky['DruhD'];
		if ($DruhD==1) $DruhD="HSV";
		if ($DruhD==2) $DruhD="PSV";
		if ($DruhD==3) $DruhD="CIZÍ";

		$Stroj1= $clanky['Stroj1'];
		$Stroj2= $clanky['Stroj2'];
		$Stroj3= $clanky['Stroj3'];
		$Stroj4= $clanky['Stroj4'];
		$Stroj5= $clanky['Stroj5'];
		$Stroj6= $clanky['Stroj6'];
		$KapNor1= number_format($clanky['KapNor1'],3,","," ");
		$KapNor2= number_format($clanky['KapNor2'],3,","," ");
		$KapNor3= number_format($clanky['KapNor3'],3,","," ");
		$KapNor4= number_format($clanky['KapNor4'],3,","," ");
		$KapNor5= number_format($clanky['KapNor5'],3,","," ");
		$KapNor6= number_format($clanky['KapNor6'],3,","," ");
		$MSpot1= number_format($clanky['MSpot1'],2,","," ");
		$MSpot2= number_format($clanky['MSpot2'],2,","," ");
		$MSpot3= number_format($clanky['MSpot3'],2,","," ");
		$MSpot4= number_format($clanky['MSpot4'],2,","," ");
		$MSpot5= number_format($clanky['MSpot5'],2,","," ");
		$MSpot6= number_format($clanky['MSpot6'],2,","," ");
		$PalD1= $clanky['PalD1'];
		$PalD2= $clanky['PalD2'];
		$PalD3= $clanky['PalD3'];
		$PalD4= $clanky['PalD4'];
		$PalD5= $clanky['PalD5'];
		$PalD6= $clanky['PalD6'];

		$PalD1t= $clanky['PalD1'];
		$PalD2t= $clanky['PalD2'];
		$PalD3t= $clanky['PalD3'];
		$PalD4t= $clanky['PalD4'];
		$PalD5t= $clanky['PalD5'];
		$PalD6t= $clanky['PalD6'];

if ($PalD1=="1") $PalD1="Benzín";if ($PalD1=="2") $PalD1="Nafta";if ($PalD1=="3") $PalD1="Elektøina";if ($PalD1=="4") $PalD1="Jiné";
if ($PalD2=="1") $PalD2="Benzín";if ($PalD2=="2") $PalD2="Nafta";if ($PalD2=="3") $PalD2="Elektøina";if ($PalD2=="4") $PalD2="Jiné";
if ($PalD3=="1") $PalD3="Benzín";if ($PalD3=="2") $PalD3="Nafta";if ($PalD3=="3") $PalD3="Elektøina";if ($PalD3=="4") $PalD3="Jiné";
if ($PalD4=="1") $PalD4="Benzín";if ($PalD4=="2") $PalD4="Nafta";if ($PalD4=="3") $PalD4="Elektøina";if ($PalD4=="4") $PalD4="Jiné";
if ($PalD5=="1") $PalD5="Benzín";if ($PalD5=="2") $PalD5="Nafta";if ($PalD5=="3") $PalD5="Elektøina";if ($PalD5=="4") $PalD5="Jiné";
if ($PalD6=="1") $PalD6="Benzín";if ($PalD6=="2") $PalD6="Nafta";if ($PalD6=="3") $PalD6="Elektøina";if ($PalD6=="4") $PalD6="Jiné";

		
		if ($row==1) $row=2;else $row=1;

	}

?>
<form  ACTION='./databaze-cinnosti' METHOD='post' ENCTYPE='multipart/form-data'>
<input type="hidden" name="status" value="101">
<h2><font color="green">Kopirování èinnosti:</font></h2>
<table>

<tr><td class="row2">Èíselní klíè:</td><td class="row2"><input type="text" value="" name="CisKlic" MAXLENGTH="5"  size="5"></td></tr>

<tr><td class="row1">Zkratka</td><td class="row1"><input type="text" value="<?php echo $SlovKlic;?>" name="SlovKlic" MAXLENGTH="5"  size="5"></td></tr>
<tr><td class="row2"><b>Název èinnosti:</b></td><td class="row2"><input type="text" value="<?php echo $NazCin;?>" name="NazCin" MAXLENGTH="24"  size="24"></td></tr>
<tr><td class="row1">Mìrná jednotka:</td><td class="row1"><input type="text" value="<?php echo $MJD;?>" name="MJD" MAXLENGTH="4"  size="4"></td></tr>
<tr><td class="row1" colspan="2"><br></td></tr>
<tr><td class="row2">Norma èasu:</td><td class="row2"><input type="text" value="<?php echo $NCD;?>" name="NCD" MAXLENGTH="8"  size="8"> Nh/m.j.</td></tr>
<tr><td class="row1">Produktivita:</td><td class="row1"><input type="text" value="<?php echo $ProdD;?>" name="ProdD" MAXLENGTH="8"  size="8">  Kè/Nh</td></tr>
<tr><td class="row2">Poèet pracovníku:</td><td class="row2"><input type="text" value="<?php echo $PracD;?>" name="PracD" MAXLENGTH="2"  size="2"></td></tr>
<tr><td class="row1">Profese:</td><td class="row1"><input type="text" value="<?php echo $ProfD;?>" name="ProfD" MAXLENGTH="6"  size="6"></td></tr>
<tr><td class="row2">Technologická pøestávka:</td><td class="row2"><input type="text" value="<?php echo $TPD;?>" name="TPD" MAXLENGTH="2"  size="2"> dnù</td></tr>
<tr><td class="row1">Druh èinnosti:</td><td class="row1"><select name="DruhD"><option value="<?php echo $DruhDt;?>"><?php echo $DruhD;?></option><option></option><option value="1">HSV</option><option value="2">PSV</option><option value="3">CIZÍ</option></select></td></tr>
<tr><td class="row1" colspan="2"><br><b>Stroje:</b></td></tr>


<tr><td class="row1" colspan="2"><hr><em>Stroj 1:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="<?php echo $Stroj1;?>" name="Stroj1" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="<?php echo $KapNor1;?>" name="KapNor1" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="<?php echo $MSpot1;?>" name="MSpot1" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD1"><option value="<?php echo $PalD1t;?>"><?php echo $PalD1;?></option><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>


<tr><td class="row1" colspan="2"><hr><em>Stroj 2:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="<?php echo $Stroj2;?>" name="Stroj2" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="<?php echo $KapNor2;?>" name="KapNor2" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="<?php echo $MSpot2;?>" name="MSpot2" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD2"><option value="<?php echo $PalD2t;?>"><?php echo $PalD2;?></option><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>


<tr><td class="row1" colspan="2"><hr><em>Stroj 3:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="<?php echo $Stroj3;?>" name="Stroj3" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="<?php echo $KapNor3;?>" name="KapNor3" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="<?php echo $MSpot3;?>" name="MSpot3" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD3"><option value="<?php echo $PalD3t;?>"><?php echo $PalD3;?></option><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>


<tr><td class="row1" colspan="2"><hr><em>Stroj 4:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="<?php echo $Stroj4;?>" name="Stroj4" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="<?php echo $KapNor4;?>" name="KapNor4" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="<?php echo $MSpot4;?>" name="MSpot4" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD4"><option value="<?php echo $PalD4t;?>"><?php echo $PalD4;?></option><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>


<tr><td class="row1" colspan="2"><hr><em>Stroj 5:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="<?php echo $Stroj5;?>" name="Stroj5" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="<?php echo $KapNor5;?>" name="KapNor5" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="<?php echo $MSpot5;?>" name="MSpot5" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD5"><option value="<?php echo $PalD5t;?>"><?php echo $PalD5;?></option><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>


<tr><td class="row1" colspan="2"><hr><em>Stroj 6:</em></td></tr>
<tr><td class="row2">Název stroje:</td><td class="row2"><input type="text" value="<?php echo $Stroj6;?>" name="Stroj6" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Kapacitní norma:</td><td class="row1"><input type="text" value="<?php echo $KapNor6;?>" name="KapNor6" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row2">Mìrná spotøeba:</td><td class="row2"><input type="text" value="<?php echo $MSpot6;?>" name="MSpot6" MAXLENGTH="8"  size="8"></td></tr>
<tr><td class="row1">Palívo:</td><td class="row1"><select name="PalD6"><option value="<?php echo $PalD6t;?>"><?php echo $PalD6;?></option><option></option><option value="1">Benzín</option><option value="2">Nafta</option><option value="3">Elektøina</option><option value="4">Jiné</option></select></td></tr>






<tr><td class="row1" colspan="2" align="center"><hr><INPUT TYPE="submit" VALUE="Uložit èinnsot">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zpìt"></td></tr>
</table>
</form>
<?php
}


// Nahlizeni do tabulky
if ($status==0){

echo "<table><tr valign='middle'><td align='left'><form  ACTION='./databaze-cinnosti' METHOD='post' ENCTYPE='multipart/form-data'>";
if ($lock==0) echo "<a href='?status=1' title='Nová èinnost'><img src='./skin/button/32/new.png' alt='Nová èinnost' width='32px' height='32px' border='0'></a>&nbsp;";
echo "<a href='tisk-cinnosti' title='Tisk èinností' target='_blank'><img src='./skin/button/32/printer.png' alt='Tisk èinností' width='32px' height='32px' border='0'></a>&nbsp;";
if ($lock==0) echo "<a href='?status=3' title='Export èinností'><img src='./skin/button/32/export.png' alt='Export èinností' width='32px' height='32px' border='0'></a>&nbsp;";
if ($lock==0) echo "<a href='?status=4' title='Import èinností'><img src='./skin/button/32/import.png' alt='Import èinností' width='32px' height='32px' border='0'></a>&nbsp;";
echo "<a href='?status=5' title='Hledat èinnost'><img src='./skin/button/32/search.png' alt='Hledat èinnost' width='32px' height='32px' border='0'></a>&nbsp;";
echo "&nbsp;&nbsp;&nbsp;<img src='./skin/button/32/sort.png' alt='Øazení èinností' width='32px' height='32px'>&nbsp;";
echo "<select name='razeni' onChange='submit();'>";
echo "<option value='0'"; if ($razeni==0) echo " selected"; echo ">dle èís. kódu +</option>";
echo "<option value='1'"; if ($razeni==1) echo " selected"; echo ">dle èís. kódu -</option>";
echo "<option value='4'"; if ($razeni==4) echo " selected"; echo ">dle slov. kódu +</option>";
echo "<option value='5'"; if ($razeni==5) echo " selected"; echo ">dle slov. kódu -</option>";
echo "<option value='2'"; if ($razeni==2) echo " selected"; echo ">dle názvu +</option>";
echo "<option value='3'"; if ($razeni==3) echo " selected"; echo ">dle názvu -</option>";
echo "</select>&nbsp;<input type='submit' value='øadit'>";

echo "&nbsp;<a href=\"../forum/".$u_login_logout."\" class=\"vlevo\"  title=\"\" >";
if ($lock==0) echo "&nbsp;&nbsp;&nbsp;&nbsp;<img src='./skin/button/32/opened.png' alt='Opened' width='32px' height='32px' border='0'>";
if ($lock==1) echo "&nbsp;&nbsp;&nbsp;&nbsp;<img src='./skin/button/32/locked.png' alt='Locked' width='32px' height='32px' border='0'>";
echo "</a></form></td></tr></table>";


if ($razeni==0) $razenistr="CisKlic";
if ($razeni==1) $razenistr="CisKlic DESC";
if ($razeni==4) $razenistr="SlovKlic";
if ($razeni==5) $razenistr="SlovKlic DESC";
if ($razeni==2) $razenistr="NazCin";
if ($razeni==3) $razenistr="NazCin DESC";

if (!$vyhledavani) {$celkem=mysql_result(mysql_query("SELECT count(*) FROM DB",$connect2),0);$celkem2=$celkem;}
else  { $celkem=mysql_result(mysql_query("SELECT count(*) FROM DB where ".$vyhledavani,$connect2),0);$celkem2=$celkem;if ($celkem>50) $celkem=50;}

if ($celkem){
?>
<font class="name">Celkem bylo nalezeno <?php echo $celkem2;?> èinností</font>
<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft"><font class="name2"><b>Èís.klíè</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Zkratka</b></font></td>
<td align="center" class="catLeft"></td>
<td align="center" class="catLeft"><font class="name2"><b>Název èinnosti</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>MJ</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Norma èasu</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Produktivita</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Poèet pracovníkù</font></td>
<td align="center" class="catLeft"><font class="name2"><b>Profese</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Technol. pøestavka</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Druh èinnosti</b></font></td>
<td align="center" class="catLeft"><font class="name2"><b>Stroje</b></font></td>
</tr>
<?php

if (!$vyhledavani) $getclanek = mysql_query("SELECT * FROM DB Order by ".$razenistr." Limit $pozice,$pocetc",$connect2);
else  {$getclanek = mysql_query("SELECT * FROM DB where ".$vyhledavani." Order by CisKlic Limit 0,50",$connect2);$celkem=50;}
	while ($clanky = mysql_fetch_array($getclanek)){


		$CisKlic= $clanky['CisKlic'];
		$SlovKlic= $clanky['SlovKlic'];
		$NazCin= $clanky['NazCin'];
		$MJD= $clanky['MJD'];

		$NCD= number_format($clanky['NCD'],4,","," ");
		$ProdD= number_format($clanky['ProdD'],2,","," ");

		$PracD= $clanky['PracD'];
		$ProfD= $clanky['ProfD'];
		$TPD= $clanky['TPD'];
		$DruhD= $clanky['DruhD'];
		if ($DruhD==1) $DruhD="HSV";
		if ($DruhD==2) $DruhD="PSV";
		if ($DruhD==3) $DruhD="CIZÍ";
		$Stroj1= $clanky['Stroj1'];
		if (strlen($Stroj1)>1) $StrojAno="Ano"; else $StrojAno="Ne";
		if ($row==1) $row=2;else $row=1;



echo '<tr><td align="center" class="row'.$row.'"><font class="name2">'.$CisKlic.'</font></td>';
echo '<td align="center" class="row'.$row.'"><font class="name2">'.$SlovKlic.'</font></td>';

echo '<td align="center" class="row'.$row.'">';
echo "<a href='?status=7&amp;id=".$CisKlic."' title='Zobrazit èinnost'><img src='./skin/button/16/view.png' alt='Zobrazit èinnost' width='16px' height='16px' border='0'></a>&nbsp;";
echo "<a href='tisk-cinnosti?id=".$CisKlic."' title='Tisk èinnosti' target='_blank'><img src='./skin/button/16/printer.png' alt='Tisk èinnosti' width='16px' height='16px' border='0'></a>&nbsp;";
if ($lock==0) echo "<br><a href='?status=6&amp;id=".$CisKlic."' title='Editovat èinnost'><img src='./skin/button/16/edit.png' alt='Editovat èinnost' width='16px' height='16px' border='0'></a>&nbsp;";
if ($lock==0) echo "<a href='?status=8&amp;id=".$CisKlic."' title='Kopírovat èinnost'><img src='./skin/button/16/copy.png' alt='Kopírovat èinnost' width='16px' height='16px' border='0'></a>&nbsp;";
if ($lock==0) echo "<a href='?status=9&amp;id=".$CisKlic."' title='Vymazat èinnost'><img src='./skin/button/16/delete.png' alt='Vymazat èinnost' width='16px' height='16px' border='0'></a>&nbsp;";
echo '</td>';


echo '<td align="left" class="row'.$row.'"><font class="name2"><b>'.$NazCin.'</b></font></td>
<td align="center" class="row'.$row.'"><font class="name2">'.$MJD.'</font></td>
<td align="right" class="row'.$row.'"><font class="name2">'.$NCD.' Nh/m.j.</font></td>
<td align="right" class="row'.$row.'"><font class="name2">'.$ProdD.' Kè/Nh</font></td>
<td align="center" class="row'.$row.'"><font class="name2">'.$PracD.'</font></td>
<td align="center" class="row'.$row.'"><font class="name2">'.$ProfD.'</font></td>
<td align="center" class="row'.$row.'"><font class="name2">'.$TPD.' dnù</font></td>
<td align="center" class="row'.$row.'"><font class="name2">'.$DruhD.'</font></td>
<td align="center" class="row'.$row.'"><font class="name2">'.$Stroj1.'</font></td>
</tr>';
	}
	echo "</table>";


if ($celkem>$pocetc){
$roma1="./databaze-cinnosti?pozice=".($pozice-$pocetc)."&amp;razeni=".$razeni;
$roma2="./databaze-cinnosti?pozice=".($pozice+$pocetc)."&amp;razeni=".$razeni;
$roma5="./databaze-cinnosti?pozice=0&amp;razeni=".$razeni;
$roma6="./databaze-cinnosti?pozice=".($pozice-$pocetc*10)."&amp;razeni=".$razeni;
$roma7="./databaze-cinnosti?pozice=".($pozice+$pocetc*20)."&amp;razeni=".$razeni;
$roma8="./databaze-cinnosti?pozice=".($celkem-$celkem%$pocetc)."&amp;razeni=".$razeni;

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
		   $roma3="./databaze-cinnosti?pozice=".$i."&amp;razeni=".$razeni;
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

echo "<h1>Je nám líto. Nebyla nalezena žádná èinnost odpovídající Vašemu zadání.</h1>";

}

}


?>