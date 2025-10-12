<?php
function kontrola ($promenna){
	$promenna = EregI_Replace("<", "&lt;", $promenna);
	$promenna = EregI_Replace(">", "&gt;", $promenna);
	$promenna = EregI_Replace('"', '&quot;', $promenna);
	$promenna = EregI_Replace('\'', '&quot;', $promenna);
//	$promenna=htmlspecialchars($promenna);
return $promenna;
}



$id_v=kontrola($_GET['id_v']);


	$getclanek = mysql_query("SELECT * from model_varianty where id='$id_v'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
		$id_varianty=$clanky['id'];
		$obsluha_id_v=$clanky['obsluha_id'];
		$zakaznik_id_v=$clanky['zakaznik_id'];
		$obsluha_pocet_v=$clanky['obsluha_pocet'];
		$zakaznik_pocet_v=$clanky['zakaznik_pocet'];

		$v1_cas=$clanky['v1_cas'];
		$v2_cas=$clanky['v2_cas'];
		$v3_cas=$clanky['v3_cas'];
		$v4_cas=$clanky['v4_cas'];
		$v5_cas=$clanky['v5_cas'];
		
		$v1_naklad=$clanky['v1_naklad'];
		$v2_naklad=$clanky['v2_naklad'];
		$v3_naklad=$clanky['v3_naklad'];
		$v4_naklad=$clanky['v4_naklad'];
		$v5_naklad=$clanky['v5_naklad'];

		$getclanek2 = mysql_query("SELECT * from model_obsluha where id='$obsluha_id_v'",$connect2);
		while ($clanky2 = mysql_fetch_array($getclanek2)){
			$nazev_obsluha_v=$clanky2['nazev'];
		}
		$getclanek2 = mysql_query("SELECT * from model_zakaznik where id='$zakaznik_id_v'",$connect2);
		while ($clanky2 = mysql_fetch_array($getclanek2)){
			$nazev_zakaznik_v=$clanky2['nazev'];
		}

}

?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Parametr', 'Vliv poruch','Vliv poèasí','Vliv dopravy','Vliv havárie','Vliv èlovìka'],
          ['Nahodilé vlivy',<?php echo $v1_cas;?>,<?php echo $v2_cas;?>,<?php echo $v3_cas;?>,<?php echo $v4_cas;?>,<?php echo $v5_cas;?>]
        ]);

        var options = {
          title: 'Graf prodloužení doby úkolu',
		  vAxis: {title: 'Zmìna èasu, min'}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
	</script>


	
	<?php
		echo "<h1>Varianta ID ".$id_v."</h1>";
		echo "Obsluha: ".$nazev_obsluha_v." (poèet: ".$obsluha_pocet_v.")<br>";
		echo "Zákazník: ".$nazev_zakaznik_v." (poèet: ".$zakaznik_pocet_v.")";
	?>
    <div id="chart_div" style="width: 800px; height: 500px;"></div>

	<hr>
	<em>Google Chart Tools: <a href="https://google-developers.appspot.com/chart/">www :</a></em>