<?php
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


$pozice2 = kontrola($_GET['pozice2']);
$pozice=$pozice2;
$autor = kontrola($_POST['autor']);
$mail = kontrola($_POST['mail']);
$uniqnumber = kontrola($_POST['uniqnumber']);

$popis = kontrola($_POST['popis']);
$test = kontrola($_POST['test']);


$prom=sprintf("%s","X00000000");
if ($popis!=""){
	$cas = Time();
	$ip = getenv ("REMOTE_ADDR");


	if ($autor=="") $autor="Anonym";

	if ($www=="http://") $www="";
$getclanek = mysql_query("SELECT uniqnumber FROM kniha_navstev where uniqnumber='$uniqnumber'",$connect2);
$celkem=mysql_num_rows($getclanek);
if (!$celkem){	
     	$popis= WordWrap($popis, 90, " ", 1);

	if (($kod=="praha")or($kod=="PRAHA")or($kod=="Praha")) MySQL_Query("INSERT INTO kniha_navstev VALUES ('','$popis', '$autor', '$mail', '', '$cas', '$ip','$uniqnumber','$userid')",$connect2);
}
}
?>
<script type="text/javascript" src="http://www.celysvet.cz/js/java3n.js"></script>
<div style="width:100%;text-align:center"><h1>Kniha návštìv:</h1></div>
<table width="100%">
<tr>
<td align="center">
<font class="name2">Na této stránce uvítáme jakékoli Vaše názory, pøipomínky, pøípadnì i nápady, jak by bylo možné projekt SEM ještì vylepšit.</font>
</td>
</tr>
<tr>
<td align="center">
<A ONCLICK="vloz('smile02');" HREF="javascript: vloz()"><img src="../skin/smile/smile02.gif" border="0" alt=" "></A> &nbsp;
<A ONCLICK="vloz('smile05');" HREF="javascript: vloz()"><img src="../skin/smile/smile05.gif" border="0" alt=" "></A> &nbsp;
<A ONCLICK="vloz('smile13');" HREF="javascript: vloz()"><img src="../skin/smile/smile13.gif" border="0" alt=" "></A> &nbsp;
<A ONCLICK="vloz('smile32');" HREF="javascript: vloz()"><img src="../skin/smile/smile32.gif" border="0" alt=" "></A> &nbsp;
<A ONCLICK="vloz('smile30');" HREF="javascript: vloz()"><img src="../skin/smile/smile30.gif" border="0" alt=" "></A> &nbsp;
<A ONCLICK="vloz('smile33');" HREF="javascript: vloz()"><img src="../skin/smile/smile33.gif" border="0" alt=" "></A> &nbsp;&nbsp;<b><a href="./dalsi_smajliky.php" onclick="window.open('../dalsi_smajliky2.php', '', 'HEIGHT=400,resizable=no,scrollbars=no,WIDTH=300');return false;">další smajlíky ...</a></b>
</td>
</tr>
<?php if ($www=="") $www="http://";
if ($mail=="") $mail="@"; ?>
<tr>
<td align="center" class="name">
<FORM ACTION="./kniha-navstev" METHOD="post" NAME="form2"  ENCTYPE="multipart/form-data">
Jméno: <INPUT TYPE="text" NAME="autor" MAXLENGTH="200"  size="20" VALUE="<?php echo $jmeno; ?>">  E-mail: <INPUT TYPE="text" NAME="mail" MAXLENGTH="200"  size="20" value="<?php echo $email; ?>"><br>
<TEXTAREA NAME="popis" cols="60" rows="4" wrap="virtual"></TEXTAREA><br>
<font class="copyright">Pozn.: Urážlivé pøíspìvky, obsahující sprostá slova, budou vymazány.</font><br>
<noscript><p><em>Antispam: Hlavní mìsto ÈR je:</em><input name="kod" size="5" /></p></noscript><script type="text/javascript">document.write('<input type="hidden" name="kod" value="pr' + 'aha" />');</script>
<input type="hidden" name="uniqnumber" value="<?php echo md5(uniqid(rand()));?>">
<INPUT TYPE="submit" VALUE="Odeslat">
</FORM>
</td>
</tr>
</table>
<?php
if ($pozice=="") $pozice=0;
$celkem=mysql_result(mysql_query("SELECT count(*) FROM kniha_navstev",$connect2),0);
$getclanek = mysql_query("SELECT mail,www,popis,datum,jmeno FROM kniha_navstev Order by id desc Limit $pozice,12",$connect2);
$hl=2;
while ($clanky = mysql_fetch_array($getclanek)){
$popis1=$clanky['popis'];
$www1=$clanky['www'];
if (substr($www1,0,7)!="http://") $www1=sprintf("%s%s","http://",$www1);
if ($www1=="http://") $www1="";
$email1=$clanky['mail'];
$datum1=$clanky['datum'];
$jmeno1=$clanky['jmeno'];
$jmeno1="<A ONCLICK=\"vloz3('[to]".$jmeno1."[/to] ');\" HREF=\"javascript: vloz()\">".$jmeno1."</A>";
if ($hl==1) $hl=2;
else $hl=1;
	$popis1 = NL2BR($popis1);
	$popis1=ereg_replace("\\\\\\\\\&amp;quot;","\"",$popis1);
	$popis1=ereg_replace("\&quot;","\"",$popis1);
	$popis1=ereg_replace("quot;","'",$popis1);
	$popis1=ereg_replace("amp;","",$popis1);
	$popis1=ereg_replace("\quot;","'",$popis1);
	$popis1=ereg_replace("\\\\","/",$popis1);
	$popis1=ereg_replace("////","/",$popis1);
	$popis1=ereg_replace("´´","'",$popis1);
	$popis1 = EregI_Replace("\[to\]", "<img src=\"../skin/smile/sipka.gif\"> <b>", $popis1);
	$popis1 = EregI_Replace("\[/to\]", ":</b>", $popis1);

 	$popis1 = Ereg_Replace("\[www\]http://", "[www\]", $popis1);
	$popis1 = ereg_replace("\[www\]([^<]+)\[/www\]"," <a target='_blank' href='http://\\1'>\\1</a> " , $popis1); 
	$popis1 = EregI_Replace("\[smile", "<img src=\"../skin/smile/smile", $popis1);
	$popis1 = EregI_Replace("\[\]", "()", $popis1);
	$popis1 = EregI_Replace(" \]", ")", $popis1);
	$popis1 = EregI_Replace("\]", ".gif\" border=\"0\" alt=\" \">", $popis1);
	$datum1 = Date("d.m.Y v H:i", $datum1);

$barevnymotiv2="6699cc";
if ($barevnymotiv){
	if ($barevnymotiv==1) $barevnymotiv2="6699cc";
	if ($barevnymotiv==2) $barevnymotiv2="0066bb";
	if ($barevnymotiv==3) $barevnymotiv2="994400";
	if ($barevnymotiv==4) $barevnymotiv2="004400";
	if ($barevnymotiv==5) $barevnymotiv2="ff0099";
	if ($barevnymotiv==6) $barevnymotiv2="773300";
	if ($barevnymotiv==7) $barevnymotiv2="6699cc";
	if ($barevnymotiv==8) $barevnymotiv2="335555";
}else $barevnymotiv="7";

?>
<div style="padding:2px;text-align:left;border:1px solid #<?php echo $barevnymotiv2;?>;width:100%">
<div style="padding:2px;background-image:url(./skin/background.jpg);background-repeat:repeat-x;height:27px;border-bottom:1px solid #<?php echo $barevnymotiv2;?>;">
<font class="name">
<b><?php echo $jmeno1;?></b></font>  
<?php if ($email1){?>
<font class="gensmall">
<noscript><?php $mailbb=split("@",$email1);echo $mailbb[0]."[zavináè]".$mailbb[1];?></noscript><script type="text/javascript">document.write('<?php echo $mailbb[0];?>'+'@'+'<?php echo $mailbb[1];?>');</script></font>
<?php }?>
&nbsp;&nbsp;(<font class="name"><?php echo $datum1;?></font>)
</div><div style="padding:4px;"><font class="gen"><?php echo $popis1;?></font></div></div>
<br>
<?php
}
$pocetc=12;
$roma1="./kniha-navstev?pozice2=".($pozice2-$pocetc);
$roma2="./kniha-navstev?pozice2=".($pozice2+$pocetc);
$roma5="./kniha-navstev?pozice2=0";
$roma6="./kniha-navstev?pozice2=".($pozice2-120);
$roma7="./kniha-navstev?pozice2=".($pozice2+240);
$roma8="./kniha-navstev?pozice2=".($celkem-$celkem%12);

$pozice22=($pozice2-120)/12+1;
$pozice3=($pozice2+240)/12+1;
$pozice4=($celkem-$celkem%12)/12+1;
?>
<table width="100%" border="0">
  <tr>
    <td width="20%" align="right" valign="top"><?php if($pozice2+1 >= $pocetc){echo("<A HREF=\"./$roma1\"><font color=\"red\"><< pøedchozí <<</font></A>");}?></td>
    <td width="60%" align="center" valign="top">
	<?php 
	      if ($celkem>119) $doplnekadr=1;  	
	      if ($pozice2<108) {$celkemh=120;$celkemd=0;if ($celkem>119) $doplnekadr=1;} else {$celkemh=108+$pozice2;if ($celkemh>$celkem) $celkemh=$celkem; $celkemd=$pozice2;}	
	      if ($pozice2>107) echo "<A HREF=\"./".$roma5."\">1...</A>&nbsp;&nbsp;";
	      if ($pozice2>227) echo "<A HREF=\"./".$roma6."\">".$pozice22."...</A>&nbsp;&nbsp;";
	      if ($celkem<119) {$celkemd=0;$celkemh=$celkem;}
              for ($i=$celkemd;$i<$celkemh;$i=$i+$pocetc){
		   $roma3="./kniha-navstev?pozice2=".$i;
		   if ($celkem<$i+$pocetc) $j=$celkem;
		   else $j=$i+$pocetc;	
		   $roma4=$i/$pocetc+1;
		   if (($pozice2>=$i)&&($pozice2<$j)) $col="<font color=\"black\"><b>".$roma4."</b></font>";
		   else $col=$roma4;
	           echo(" <A HREF=\"./$roma3\">$col</A> ");	      
	     } 
             if ($pozice2+239<$celkem) echo "&nbsp;&nbsp;<A HREF=\"./".$roma7."\">".$pozice3."...</A>";
	     else if ($pozice2+119<$celkem) echo "&nbsp;&nbsp;<A HREF=\"./".$roma8."\">...".$pozice4."</A>";	
	?>
    </td>
    <td width="20%" align="left" valign="top"><?php if($pozice2+$pocetc < $celkem){echo("<A HREF=\"./$roma2\"><font color=\"red\">>> další >></font></A>
");}?></td>
 </tr>
</table>