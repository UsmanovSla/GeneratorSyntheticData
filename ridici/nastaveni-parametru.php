<?php 
echo "<h1>".$titl."</h1>";



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



$edit=kontrola($_POST['edit']);
if (!$edit) $edit=kontrola($_GET['edit']);

$edit2=kontrola($_POST['edit2']);

$parametr_hodnota=kontrola($_POST['parametr_hodnota']);
$parametr_poznamka=kontrola($_POST['parametr_poznamka']);

//for ($i=1;$i<10001;$i++) echo number_format(1-cos($i/1000*Pi()/2)/3,6,',','')."; ";

if ($edit){

	$getclanek = mysql_query("SELECT * from model_global where id='$edit'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
	
		echo 'Editace parametru: <b>'.$clanky['parametr'].'</b><br>';
		echo '<form  name="form" ACTION="./nastaveni-parametru" METHOD="post" ENCTYPE="multipart/form-data">';
		echo '<input type="hidden" name="edit2" value="'.$edit.'">';
		echo '<em>Hodnota:</em><br><textarea name="parametr_hodnota" cols="40" rows="8">'.$clanky['hodnota'].'</textarea><br>';
		echo '<em>Poznámka:</em><br><textarea name="parametr_poznamka" cols="40" rows="8">'.$clanky['poznamka'].'</textarea><br>';
		echo '<INPUT TYPE="submit" VALUE="Uložit parametr">&nbsp;&nbsp;<input type=button onclick="history.back()" value="Zpìt">';
		echo '</form>';
		echo "<hr>";
if ($edit>1){
	  $body=$clanky['hodnota'];
	  $body=ereg_replace(",",".",trim($body));
	  $x=split("\n",$body);

?>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['x', 'F(x)'],
<?php
	for ($i=0;$i<count($x);$i++) {
		$y=split("; ",$x[$i]);
		echo "[".$y[0].",  ".$y[1]."],";
	}
?>
        ]);

        var options = {
        title: 'Graf distribuèní funkce: <?php echo $clanky['parametr'];?>',
		chartArea: {width: '80%', height: '80%'},
		legend: {position: 'bottom'},
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <div id="chart_div" style="width: 800px; height: 500px;"></div><br>
<?php

}		
	}
}
if (($edit2)and($parametr_hodnota)) mysql_query("update model_global set hodnota='$parametr_hodnota',poznamka='$parametr_poznamka' where id='$edit2'",$connect2);


$lock = 1;
if (($userid==2)or($jmeno=="Contec")) $lock=0;

echo "<table>";
	$getclanek = mysql_query("SELECT * from model_global order by id",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		if ($row==1) $row=2;else $row=1;

		echo '<tr valign="top"><td align="center" class="row'.$row.'">ID '.$clanky['id'].': </td>';
		
		echo '<td align="left" class="row'.$row.'">'.$clanky['parametr'].' </td>';
	
		echo '<td width="450px" align="left" class="row'.$row.'">'.nl2br(substr($clanky['hodnota'],0,200)).' </td>';
	
		if (!$lock) echo '<td align="left" class="row'.$row.'"><a href="nastaveni-parametru?edit='.$clanky['id'].'" title="Editovat parametr">Editovat parametr :</a></td>';
		
		echo '</tr>';
	}

echo "</table>";
?>