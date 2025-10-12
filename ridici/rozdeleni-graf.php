<?php
function kontrola ($promenna){
	$promenna = EregI_Replace("<", "&lt;", $promenna);
	$promenna = EregI_Replace(">", "&gt;", $promenna);
	$promenna = EregI_Replace('"', '&quot;', $promenna);
	$promenna = EregI_Replace('\'', '&quot;', $promenna);
//	$promenna=htmlspecialchars($promenna);
return $promenna;
}

function erf($x)
{
        $pi = 3.1415927;
        $a = (8*($pi - 3))/(3*$pi*(4 - $pi));
        $x2 = $x * $x;

        $ax2 = $a * $x2;
        $num = (4/$pi) + $ax2;
        $denom = 1 + $ax2;

        $inner = (-$x2)*$num/$denom;
        $erf2 = 1 - exp($inner);

        return sqrt($erf2);
}


$kendall=kontrola($_GET['kendall']);
$lambda=kontrola($_GET['lambda']);
$mi=kontrola($_GET['mi']);

$kendall_x=substr($kendall,0,1);
$kendall_y=substr($kendall,1,1);
$kendall_n=substr($kendall,2,1);

if (!$lambda) $lambda=1;
if (!$mi) $mi=1;

if (!$kendall_x) $kendall_x="M";
if (!$kendall_y) $kendall_y="M";
if (!$kendall_n) $kendall_n="1";

if ($kendall_x=="1") $kendall_x=1;
if ($kendall_x=="2") $kendall_x=2;
if ($kendall_x=="3") $kendall_x=3;
if ($kendall_x=="4") $kendall_x=4;
if ($kendall_x=="5") $kendall_x=5;

if ($kendall_y=="1") $kendall_y=1;
if ($kendall_y=="2") $kendall_y=2;
if ($kendall_y=="3") $kendall_y=3;
if ($kendall_y=="4") $kendall_y=4;
if ($kendall_y=="5") $kendall_y=5;


?>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Time', 'Pøíchod zákazníkù', 'Rozdìlení doby obsluhy'],
<?php
	$lam=$lambda;

if ($kendall_x>=1) {
	$getclanek = mysql_query("SELECT * from model_global where id='".(4+$kendall_x)."'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
	  $body=$clanky['hodnota'];
	  $body=ereg_replace(",",".",trim($body));
	  $x_v=split("\n",$body);
	}
	for ($i=0;$i<count($x_v);$i++) {
		$y_v=split("; ",$x_v[$i]);
		echo "[".($y_v[0]/$lam).",  ".$y_v[1].",null],";
	}
	echo "[5,1,null],";
	$kendall_xxx=$kendall_x;
	$kendall_x="V".$kendall_x;
}else if ($kendall_x=="G") {
	$x=0;
	for ($i=-5;$i<=5;$i=$i+0.01){
		$x=1/2*(1+erf(($i-1/$lam)/sqrt(2)/(1/$lam)));
		if ($i<1/$lam) echo "[".$i.",".(-$x+1).",null],";
		else echo "[".$i.",".$x.",null],";
	}
}else{
	$x=0;
	for ($i=0;$i<=5;$i=$i+0.01){
		if ($kendall_x=="M") $x=1-exp(-$lam*$i);
		if ($kendall_x=="E") $x=1-exp(-$lam*$i)-exp(-$lam*$i)*$i*$lam;
		if ($kendall_x=="D") if ($i<1/$lam) $x=0; else $x=1;
		echo "[".$i.",  ".$x.",null],";
	}
}
$lam=$mi;
if ($kendall_y>=1) {
	$getclanek = mysql_query("SELECT * from model_global where id='".(4+$kendall_y)."'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
	  $body=$clanky['hodnota'];
	  $body=ereg_replace(",",".",trim($body));
	  $x_v=split("\n",$body);
	}
	for ($i=0;$i<count($x_v);$i++) {
		$y_v=split("; ",$x_v[$i]);
		echo "[".($y_v[0]/$lam).",null,  ".$y_v[1]."],";
	}
	echo "[5,null,1],";
	$kendall_yyy=$kendall_y;
	$kendall_y="V".$kendall_y;
}else if ($kendall_y=="G") {
	$x=0;
	for ($i=-5;$i<=5;$i=$i+0.01){
		$x=1/2*(1+erf(($i-1/$lam)/sqrt(2)/(1/$lam)));
		if ($i<1/$lam) echo "[".$i.",null,".(-$x+1)."],";
		else echo "[".$i.",null,".$x."],";
	}
}else{
	$x=0;
	for ($i=0;$i<=5;$i=$i+0.01){
		if ($kendall_y=="M") $x=1-exp(-$lam*$i);
		if ($kendall_y=="E") $x=1-exp(-$lam*$i)-exp(-$lam*$i)*$i*$lam;
		if ($kendall_y=="D") if ($i<1/$lam) $x=0; else $x=1;
		echo "[".$i.",null,  ".$x."],";
	}
}
?>
        ]);

        var options = {
        title: 'Systém <?php echo $kendall_x."/".$kendall_y."/".$kendall_n;?>',
		chartArea: {width: '80%', height: '80%'},
		legend: {position: 'bottom'},
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
	Graf rozdìlení systému hromadné obsluhy <?php echo $kendall_x."/".$kendall_y."/".$kendall_n;?> (Kendallova klasifikace)
    <div id="chart_div" style="width: 800px; height: 500px;"></div><br>
	


    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data2 = google.visualization.arrayToDataTable([
          ['Time', 'Pøíchod zákazníkù', 'Rozdìlení doby obsluhy'],
<?php
	$lam=$lambda;

if ($kendall_xxx>=1) {
	$getclanek = mysql_query("SELECT * from model_global where id='".(4+$kendall_xxx)."'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
	  $body=$clanky['hodnota'];
	  $body=ereg_replace(",",".",trim($body));
	  $x_v=split("\n",$body);
	}
	for ($i=0;$i<count($x_v);$i++){
		$y_vv=split("; ",$x_v[$i]);
		$y_vx[$i]=$y_vv[0];
		$y_vy[$i]=$y_vv[1];
	}
	for ($i=0;$i<=1000;$i++) $yy[$i]=0;
	for ($i=0;$i<count($x_v);$i++) {
		for ($y=$y_vy[$i];$y<$y_vy[$i+1];$y=$y+0.001){
			if ($y_vy[$i+1]!=$y_vy[$i]) $yy[round($y*1000)]=($y*($y_vx[$i+1]-$y_vx[$i])+$y_vx[$i]*$y_vy[$i+1]-$y_vx[$i+1]*$y_vy[$i])/($y_vy[$i+1]-$y_vy[$i]);
			else $yy[round($y*1000)]=$y_vx[$i+1];
		}
	}
	$yy[0]=0;
	$yy[1000]=5*$lam;
	$previous_y=$yy[0];
	for ($i=0;$i<=1000;$i++){
		if (!$yy[$i]) $yy[$i]=$previous_y;
		$previous_y=$yy[$i];
		echo "[".($yy[$i]/$lam).",".($i/1000).",null],";
	}
	$kendall_x="V".$kendall_xxx;
}else if ($kendall_x=="G") {
	$y=0;
	for ($i=0;$i<=1000;$i++) $yy[$i]=0;
	for ($x=-5;$x<=5;$x=$x+0.001){
		$y=1/2*(1+erf(($x-1/$lam)/sqrt(2)/(1/$lam)));
		if ($x<1/$lam) $y=-$y+1;
		if ($x<0) $yy[round($y*1000)]=0;
		else $yy[round($y*1000)]=$x;
	}
	$previous_y=$yy[0];
	for ($i=0;$i<=1000;$i++){
		if (!$yy[$i]) $yy[$i]=$previous_y;
		$previous_y=$yy[$i];
		echo "[".($yy[$i]).",".($i/1000).",null],";
	}
}else if ($kendall_x=="E") {
	$y=0;
	for ($i=0;$i<=1000;$i++) $yy[$i]=0;
	for ($x=0;$x<=5;$x=$x+0.001){
		$y=1-exp(-$lam*$x)-exp(-$lam*$x)*$x*$lam;
		$yy[round($y*1000)]=$x;
	}
	$previous_y=$yy[0];
	for ($i=0;$i<=1000;$i++){
		if (!$yy[$i]) $yy[$i]=$previous_y;
		$previous_y=$yy[$i];
		echo "[".($yy[$i]).",".($i/1000).",null],";
	}
}else{
	$x=0;
	for ($i=0;$i<=1;$i=$i+0.001){
		if ($kendall_x=="M") $x=-log(1-$i)/$lam;
		if ($kendall_x=="D") $x=1/$lam;
		echo "[".$x.",  ".$i.",null],";
	}
	echo "[5,1,null],";
}
$lam=$mi;
if ($kendall_yyy>=1) {
	$getclanek = mysql_query("SELECT * from model_global where id='".(4+$kendall_yyy)."'",$connect2);
	while ($clanky = mysql_fetch_array($getclanek)){
	  $body=$clanky['hodnota'];
	  $body=ereg_replace(",",".",trim($body));
	  $x_v=split("\n",$body);
	}
	for ($i=0;$i<count($x_v);$i++){
		$y_vv=split("; ",$x_v[$i]);
		$y_vx[$i]=$y_vv[0];
		$y_vy[$i]=$y_vv[1];
	}
	for ($i=0;$i<=1000;$i++) $yy[$i]=0;
	for ($i=0;$i<count($x_v);$i++) {
		for ($y=$y_vy[$i];$y<$y_vy[$i+1];$y=$y+0.001){
			if ($y_vy[$i+1]!=$y_vy[$i]) $yy[round($y*1000)]=($y*($y_vx[$i+1]-$y_vx[$i])+$y_vx[$i]*$y_vy[$i+1]-$y_vx[$i+1]*$y_vy[$i])/($y_vy[$i+1]-$y_vy[$i]);
			else $yy[round($y*1000)]=$y_vx[$i+1];
		}
	}
	$yy[0]=0;
	$yy[1000]=5*$lam;
	$previous_y=$yy[0];
	for ($i=0;$i<=1000;$i++){
		if (!$yy[$i]) $yy[$i]=$previous_y;
		$previous_y=$yy[$i];
		echo "[".($yy[$i]/$lam).",null,".($i/1000)."],";
	}
	$kendall_y="V".$kendall_yyy;
}else if ($kendall_y=="G") {
	$y=0;
	for ($i=0;$i<=1000;$i++) $yy[$i]=0;
	for ($x=-5;$x<=5;$x=$x+0.001){
		$y=1/2*(1+erf(($x-1/$lam)/sqrt(2)/(1/$lam)));
		if ($x<1/$lam) $y=-$y+1;
		if ($x<0) $yy[round($y*1000)]=0;
		else $yy[round($y*1000)]=$x;
	}
	$previous_y=$yy[0];
	for ($i=0;$i<=1000;$i++){
		if (!$yy[$i]) $yy[$i]=$previous_y;
		$previous_y=$yy[$i];
		echo "[".($yy[$i]).",null,".($i/1000)."],";
	}
}else if ($kendall_y=="E") {
	$y=0;
	for ($i=0;$i<=1000;$i++) $yy[$i]=0;
	for ($x=0;$x<=5;$x=$x+0.001){
		$y=1-exp(-$lam*$x)-exp(-$lam*$x)*$x*$lam;
		$yy[round($y*1000)]=$x;
	}
	$previous_y=$yy[0];
	for ($i=0;$i<=1000;$i++){
		if (!$yy[$i]) $yy[$i]=$previous_y;
		$previous_y=$yy[$i];
		echo "[".($yy[$i]).",null,".($i/1000)."],";
	}
}else{
	$x=0;
	for ($i=0;$i<=1;$i=$i+0.001){
		if ($kendall_y=="M") $x=-log(1-$i)/$lam;
		if ($kendall_y=="D") $x=1/$lam;
		echo "[".$x.",null,  ".$i."],";
	}
	echo "[5,null,1],";
}
?>
        ]);

        var options2 = {
        title: 'Systém <?php echo $kendall_x."/".$kendall_y."/".$kendall_n;?>',
		chartArea: {width: '80%', height: '80%'},
		legend: {position: 'bottom'},
        };

        var chart2 = new google.visualization.LineChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options2);
      }
    </script>
	Upravìný pro simulaci graf rozdìlení systému hromadné obsluhy <?php echo $kendall_x."/".$kendall_y."/".$kendall_n;?> (Kendallova klasifikace)
    <div id="chart_div2" style="width: 800px; height: 500px;"></div><br>
	
	
<?php
	echo "Rozdìlení pøíchodu zákazníkù k obsluze (&#956;=".number_format($lambda,2,',',' ')."): ";
	if ($kendall_x=="M") echo "Poissonùv proces pøíchodù (exponenciální rozdìlení doby mezi pøíchody)";
	if ($kendall_x=="E") echo "Erlangovo rozdìlení doby mezi pøíchody";
	if ($kendall_x=="D") echo "Konstatntní doba mezi pøíchody";
	if ($kendall_x=="G") echo "Obecný proces pøíchodù (obecné rozdìlení doby mezi pøíchody)";
	echo "<br><br>Rozdìlení doby obsluhy (&#955;=".number_format($mi,2,',',' ')."): ";
	if ($kendall_y=="M") echo "Exponenciální rozdìlení doby obsluhy";
	if ($kendall_y=="E") echo "Erlangovo rozdìlení doby obsluhy";
	if ($kendall_y=="D") echo "Konstatntní doba obsluhy";
	if ($kendall_y=="G") echo "Obecné rozdìlení doby obsluhy";
?>	
	
	<hr>
	<em>Google Chart Tools: <a href="https://google-developers.appspot.com/chart/">www :</a></em>