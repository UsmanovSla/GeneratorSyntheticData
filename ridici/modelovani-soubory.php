<?php 
echo "<h1>".$titl."</h1>";

$lock = 1;
if (($userid==2)or($jmeno=="Contec")) $lock=0;

function kontrola ($promenna){
	$promenna = EregI_Replace("<", "&lt;", $promenna);
	$promenna = EregI_Replace(">", "&gt;", $promenna);
	$promenna = EregI_Replace('"', '&quot;', $promenna);
	$promenna = EregI_Replace('\'', '&quot;', $promenna);
//	$promenna=htmlspecialchars($promenna);
return $promenna;
}


$model=kontrola($_POST['model']);
if (!$model) $model = kontrola($_GET['model']);

$status=kontrola($_POST['status']);
if (!$status) $status = kontrola($_GET['status']);

$getclanek = mysql_query("SELECT * from model where id='$model' limit 0,1",$connect2);
while ($clanky = mysql_fetch_array($getclanek)){
	$nazev=$clanky['nazev'];
	echo "<h1>Název projektu: ".$nazev."</h1>";
}

if ($lock==0) if ($status==9){
	$sid=kontrola($_GET['sid']);
	echo "<h2>Opravdu si pøejete vymazat soubor: <a href='modelovani-soubory?model=".$model."&status=99&sid=".$sid."' title='Opravdu si pøejete vymazat soubor?'>Ano</a> <a href='modelovani-soubory?model=".$model." title='Opravdu si pøejete vymazat soubor?'>Ne</a></h2>";
}

if ($lock==0) if ($status==99){
	$sid=kontrola($_GET['sid']);
	mysql_query("delete from `model_soubor` where sid='$sid'",$connect2);
	$cesta="files/".$sid;
	unlink ($cesta);
	echo "<h2><font color='green'>Soubor byl úspìšnì vymazán!</font></h2><hr>";
	$status=0;
}


if ($lock==0) if ($status==2){

	$nazev=kontrola($_POST['nazev']);
	$popis=kontrola($_POST['popis']);
	$time=time();
	$ip=getenv ("REMOTE_ADDR");
	$seed = floor(time()/86400);
	srand($seed);
	$time=Time();
	$rand = Rand();
	$sid=MD5($time.$rand);
	$velikost=ceil($_FILES["file"]["size"]/1024);
	if ($_FILES["file"]["size"]>10000000){
	        $chyb = "Soubor je vìtší než 10 Mb.\n";
	        $chyba=1;
	}
	$koncovky = array('pdf','doc','docx','xls','jpg','xlsx','ppt','pptx');
	//echo strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
	//echo $_FILES["file"]["name"];
	
	if (in_array(strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION)), $koncovky)) {
		$druh=strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
	}else {
        $chyb = "Soubor je ve špatném formátu.\n";
        $chyba=1;
	}

	if (!$chyba) {
		$sid=$sid.".".$druh;
		mysql_query("INSERT INTO `model_soubor` ( `model` ,`sid` ,`druh` ,`velikost` ,`ip` ,`datum`,`popis`,`nazev`) values ('$model','$sid','$druh','$velikost','$ip','$time','$popis','$nazev');",$connect2);
		$cesta="files/".$sid;
		move_uploaded_file($_FILES['file']['tmp_name'],$cesta);
		echo "<h2><font color='green'>Soubor byl úspìšnì odeslán!</font></h2><hr>";
	}
	else echo "<h2><font color='red'>".$chyb."</font></h2><hr>";
	$status=0;

}

if ($lock==0) if ($status==1){
?>
	<form ACTION='./modelovani-soubory' METHOD='post' ENCTYPE='multipart/form-data'>
	<input type="hidden" name="model" value="<?php echo $model;?>">
	<input type="hidden" name="status" value="2">
	<table>
	<tr><td class='row1'>Název souboru:</td><td class='row1'><input name="nazev" type="text" size="30"></td>
	<tr><td class='row1'>Popis:</td><td class='row1'><input name="popis" type="text" size="50"></td>
	<tr><td class='row2'>Pøiložit soubor (do 10 Mb; *.pdf, *jpg, *doc, *.xls, *.ppt):</td><td class='row2'><input name="file" type="file"></td>
	</table>
	<INPUT TYPE="submit" VALUE="Uložit soubor">
	<form>
<?php
}

if (!$status){

?>
<a href='modelovani-soubory?model=<?php echo $model;?>&status=1' title="Pøiložit k modelu soubor :">+ Pøiložit k modelu soubor</a>

<table class="forumline" cellspacing="0" cellpadding="2">
<tr>
<td align="center" class="catLeft" width="235px"><font class="name2"><b>Název</b><br>Popis</font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"><b>Druh</b></font></td>
<td align="center" class="catLeft" width="40px"><font class="name2"><b>Velikost</b></font></td>
<td align="center" class="catLeft" width="95px"><font class="name2"><b>Datum</b></font></td>
<td align="center" class="catLeft" width="90px"><font class="name2"></font></td>
</tr>
<?php
	$getclanek = mysql_query("SELECT * from model_soubor where model='$model'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$sid=$clanky['sid'];
		$druh=$clanky['druh'];
		$velikost=$clanky['velikost'];
		$nazev=$clanky['nazev'];
		$popis=$clanky['popis'];
		$datum=$clanky['datum'];
		$status="<a href='files/".$clanky['sid']."' target='_blank' title='Stahnout soubor'><img src='./skin/button/16/export.png' alt='Stahnout soubor' width='16px' height='16px' border='0'></a>&nbsp;";
		$status=$status."<a href='modelovani-soubory?model=".$model."&status=9&sid=".$clanky['sid']."' title='Vymazat soubor'><img src='./skin/button/16/delete.png' alt='Vymazat soubor' width='16px' height='16px' border='0'></a>";
		if ($lock==1) $status="";
		if ($row==1) $row=2; else $row=1;
		echo "<tr><td class='row".$row."'><b>".$nazev."</b><br>".$popis."</td>";
		echo "<td class='row".$row."'>".$druh."</td>";
		echo "<td class='row".$row."'>".$velikost." kb</td>";
		echo "<td class='row".$row."'>".date("d.m.Y",$datum)."</td>";
		echo "<td class='row".$row."'>".$status."</td></tr>";
	}
?>
</table>
<?php
}
echo "<hr>";
echo "<h1><a href='modelovani?model=".$model."&status=1'>Editovat model :</a></h1>";
?>