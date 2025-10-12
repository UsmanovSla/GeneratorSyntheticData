<?php 

//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL & ~E_NOTICE);


$akt_zal="n";
require("./db/db.php");
//require("./db/data.php");


set_time_limit(30);
$ip = getenv ("REMOTE_ADDR");
$ipstr =$ip;


$zacatekx=time();


$denr=Date("d-m-y",$zacatekx);



function kontrolah ($promenna){
//	$promenna = EregI_Replace("<", "&lt;", $promenna);
//	$promenna = EregI_Replace(">", "&gt;", $promenna);
//	$promenna = EregI_Replace('"', '&quot;', $promenna);	
//	$promenna = EregI_Replace('\'', '&quot;', $promenna);
//	$promenna=htmlspecialchars($promenna);
//	$promenna=addslashes($promenna);
//	$promenna=quotemeta($promenna);
return $promenna;
}

function kontrolahh ($promenna){
//	$promenna = EregI_Replace("<", "&lt;", $promenna);
//	$promenna = EregI_Replace(">", "&gt;", $promenna);
//	$promenna = EregI_Replace('"', '&quot;', $promenna);	
//	$promenna = EregI_Replace('\'', '&quot;', $promenna);
//	$promenna=htmlspecialchars($promenna);
return $promenna;
}

$jmeno = kontrolahh($_POST['jmeno']);
$autor2 = kontrolahh($_POST['autor2']);


define('PHPBB_ROOT_PATH', '../diskuzni-forum/');
$phpbb_root_path = '../diskuzni-forum/';
$phpEx = "php";
define('IN_PHPBB', true);
//$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
//$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
//$user->setup('viewforum');

$useridlogging=$user->data['user_id'];
$session_id=$user->data['session_id'];
$jmeno = $user->data['username'];
$useridlog=$useridlogging;
$jmenologin = $jmeno;

error_reporting(0);

if ($useridlog>1)
{
	$u_login_logout = 'ucp.php?mode=logout&amp;redirect=../model&amp;sid=' . $session_id;
	$l_login_logout = 'Odhlášení' . ' ' . $jmenologin . '';
}
else
{
	$u_login_logout = 'ucp.php?mode=login&amp;redirect=../model';
	$l_login_logout = 'Pøihlášení :<br>';
} 

$passworduser=2;
$password="";
$userid="";
$userid3="";
$usernamelog="";
$zme=1;

if ($jmeno=="Anonymous") $jmeno="";
if ($useridlog>1){

$user = mysql_query("SELECT user_password,user_posts,user_id,user_new_privmsg,user_inactive_reason,user_rank  FROM pb_users WHERE user_id='".$useridlogging."' limit 0,1",$connect);
while ($userdata=mysql_fetch_array($user)){
	$userid=$userdata['user_id'];
	$user_new_privmsg=$userdata['user_new_privmsg'];
	$user_inactive_reason=$userdata['user_inactive_reason'];
	if (!$user_inactive_reason) $user_activef=1;
	$user_postsf=$userdata['user_posts'];
	$useridmod=$userdata['user_rank'];
	mysql_query("update pb_users set user_lastvisit='$zacatekx' WHERE user_id='$userid'");

}


$user = mysql_query("SELECT stanice,inzeraty,motiv,zobrazovat_forum2,zobrazovat_forum4,zobrazovat_forum3,zobrazovat_forum,reklama_forum,pocetalb,set_smile,set_avatar,set_photo,set_button,sirka  FROM phpbb_users WHERE user_id='".$useridlogging."' limit 0,1",$connect);
while ($userdata=mysql_fetch_array($user)){

	$barevnymotiv=$userdata['motiv'];
	$set_smile=$userdata['set_smile'];
	$set_avatar=$userdata['set_avatar'];
	$set_photo=$userdata['set_photo'];
	$set_button=$userdata['set_button'];
	$pocetfotoalb=$userdata['pocetalb'];

	$urfviz=$userdata['reklama_forum'];
	$urfdviz=$userdata['zobrazovat_forum'];
	$urfdviz2=$userdata['zobrazovat_forum2'];
	$urfdviz3=$userdata['zobrazovat_forum3'];
	$urfdviz4=$userdata['zobrazovat_forum4'];
	$pocetinzeratu=$userdata['inzeraty'];
	$pocetstanic=$userdata['stanice'];
	$sirkaobrazovky=$userdata['sirka'];
	$koikoi=1;
}
if(!$koikoi) mysql_query("insert into phpbb_users (`user_id`) values ('$userid')");


	$druhmoderatoru=0;
	if ($user_postsf>2499) $druhmoderatoru=1;
	if ($user_postsf>19999) $druhmoderatoru=2;
	if ($userid==2) $druhmoderatoru=3;
	$usernamed=$jmeno;
	$userid3=$userid;
	$usernamelog=$jmeno;
	$passworduser=1;
	$useridlog=$userid;
	$urviz=1;

}




$kod = kontrolah($_POST['kod']);
if (($kod!=$mainlang[1])and($kod!=$mainlang[2])and($kod!=$mainlang[3])) $kod=""; 


if ($titl=="") $titl=$mainlang[0];
if ($titl2=="") $titl2=$mainlang[0];

$cssfile="./skin/main.css";

$lock = 1;
if (($userid==2)or($jmeno=="Contec")) $lock=0;


?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head>
<meta http-equiv="Content-Language" content="cs"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title><?php echo $titl; ?></title><meta name="keywords" content="<?php echo $titl2; ?>"><meta name="description" content="<?php echo $titl2; ?>"><link rel="stylesheet" href="<?php echo $cssfile;?>"><link rel="shortcut icon" href="./skin/model.ico">
</head><body bgcolor="#" text="#" link="#" vlink="#" style='<?php if ($wide!=1) echo "background-image: url(skin/pozadi.jpg);background-repeat: repeat;"; else echo "background-color: white;";?>'><center><div style="width:<?php if ($wide==1) echo "100%";else echo "1000px";?>;position: relative; text-align: left;margin: 0px 0px 0px 0px;background-color: white;height:1000px"><div class="div_main"><div style="background-color:white;">