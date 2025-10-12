<?php


function hexbin($hex)
{
    $bin = '';
    $hex = array_reverse(str_split($hex));
    foreach($hex as $n)
    {
        $n = hexdec($n);
        for($i = 1; $i <= 8; $i <<= 1)
        {
            $bin .= ($i & $n)? '1' : '0';
        }
    }
    return ltrim(strrev($bin));
}


function hextoreal($R){

   if ($R=="000000000000") return "";
   $R1=hexdec(substr($R,0,2));
   $R2=hexdec(substr($R,2,2));
   $R3=hexdec(substr($R,4,2));
   $R4=hexdec(substr($R,6,2));
   $R5=hexdec(substr($R,8,2));
   $R6=hexdec(substr($R,10,2));
   
   $R=substr($R,10,2).substr($R,8,2).substr($R,6,2).substr($R,4,2).substr($R,2,2);

   $e=$R1-128;	
   $mbin =hexbin($R);

//   echo $e." / ".$R." / ".hexdec($R)." / ".$mbin."<hr>";
   if (substr($mbin,0,1)=="0") $znak="1"; else $znak="-1"; 
   $mbin="1".substr($mbin,1,strlen($mbin)-1);
//   echo substr($mbin,0,1)."<hr>";

   
 
   if ($e>0) {$cel=substr($mbin,0,$e);$necel=substr($mbin,$e,strlen($mbin)-$e);}
   if ($e==0) {$cel="0";$necel=$mbin;}
   if ($e<0) {$cel="0";$necel=$mbin;for ($i=0;$i<(abs($e));$i++) $necel="0".$necel;}


//   echo "<hr>".$cel." / ".$necel."<br>";

   $cel=bindec($cel);

   $necel2=sprintf("%s",$necel);
   
   $necel="";

   for ($i=0;$i<strlen($necel2);$i++){
   	$necel=$necel+substr($necel2,$i,1)*pow(2,(-$i-1));
//	echo substr($necel2,$i,1)*pow(2,(-$i-1))."<br>";
   }


   if ((!$cel)and(!$necel))  return "0.00";

   $matreal = $znak*($cel+$necel);
   return $matreal;
}



echo hextoreal("830000000020")."<br>";
echo hextoreal("830000000000")."<br>";
echo hextoreal("820000000040")."<br>";
echo hextoreal("820000000000")."<br>";
echo hextoreal("810000000000")."<br>";
echo hextoreal("800000000040")."<br>";
echo hextoreal("800000000000")."<br>";
echo hextoreal("7F0000000000")."<br>";
echo hextoreal("000000000000")."<br>";
echo hextoreal("7F0000000080")."<br>";
echo hextoreal("800000000080")."<br>";
echo hextoreal("8000000000C0")."<br>";
echo hextoreal("810000000080")."<br>";
echo hextoreal("820000000080")."<br>";
echo hextoreal("8200000000C0")."<br>";
echo hextoreal("830000000080")."<br>";
echo hextoreal("8300000000A0")."<br>";




?>