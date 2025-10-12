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

		$n_obsluha=ceil($clanky['n_obsluha']/1000);
		$n_zakaznik=ceil($clanky['n_zakaznik']/1000);
		$n_stavba=ceil($clanky['n_stavba']/1000);
		$n_penale=ceil($clanky['n_penale']/1000);
		$n_poruchy=ceil($clanky['n_poruchy']/1000);
		$n_variabilni=ceil($clanky['n_variabilni']/1000);
		$n_fixni=ceil($clanky['n_fixni']/1000);
		
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
          ['Parametr', 'tis. Kè'],
          ['Náklady na obsluhující prvek, tis. Kè',<?php echo $n_obsluha;?>],
          ['Náklady na obsluhovaný prvek, tis. Kè',<?php echo $n_zakaznik;?>],
          ['Náklady na administrativu, tis. Kè',<?php echo $n_stavba;?>],
          ['Náklady na penále z prodlení, tis. Kè',<?php echo $n_penale;?>],
          ['Náklady na odstranìní poruch, tis. Kè',<?php echo $n_poruchy;?>]
        ]);

        var options = {
          title: 'Graf rozdìlení nákladù dle položek'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
	</script>

    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data2 = google.visualization.arrayToDataTable([
          ['Parametr', 'tis. Kè'],
          ['Náklady variabilní, VC, tis. Kè',<?php echo $n_variabilni;?>],
          ['Náklady fixní, FC, tis. Kè',<?php echo $n_fixni;?>]
        ]);

        var options2 = {
          title: 'Graf rozdìlení nákladù dle struktury'
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options2);
      }
	</script>

	<?php
		echo "<h1>Varianta ID ".$id_v."</h1>";
		echo "Obsluha: ".$nazev_obsluha_v." (poèet: ".$obsluha_pocet_v.")<br>";
		echo "Zákazník: ".$nazev_zakaznik_v." (poèet: ".$zakaznik_pocet_v.")";
	?>
    <div id="chart_div" style="width: 800px; height: 500px;"></div>
    <div id="chart_div2" style="width: 800px; height: 500px;"></div>

	<hr>
	<em>Google Chart Tools: <a href="https://google-developers.appspot.com/chart/">www :</a></em>