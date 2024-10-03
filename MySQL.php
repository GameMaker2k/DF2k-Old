<?php
$File1Name = dirname($_SERVER['PHP_SELF'])."/";
$File2Name = $_SERVER['PHP_SELF'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name=="MySQL.php"||$File3Name=="/MySQL.php") {
	require('inc/403.html');
	exit(); }
if($_GET['act']=="gpl"||$_GET['act']=="GPL") {
header('Content-type: text/plain');
require("gpl.txt");
$randgpl = rand(1,10);
if($randgpl<=5) { die(); }
if($randgpl>=6) { exit(); } }
function change_title($new_title) {
$output = ob_get_contents();
ob_end_clean();
$output = preg_replace("/<title>(.*?)<\/title>/", "<title>$new_title</title>", $output);
/* Change Some PHP Settings Fix the &PHPSESSID to &amp;PHPSESSID */
$output = preg_replace("/&PHPSESSID/", "&amp;PHPSESSID", $output);
echo $output;
}
function fix_amp($null) {
$output = ob_get_contents();
ob_end_clean();
/* Change Some PHP Settings Fix the &PHPSESSID to &amp;PHPSESSID */
$output = preg_replace("/&PHPSESSID/", "&amp;PHPSESSID", $output);
echo $output;
}
ob_start();
session_start();
require('./inc/safesql/SafeSQL.class.php');
require('Settings.php');
/* if($Settings['use_iniset']==true) {
Change Some PHP Settings Fix the & to &amp;
ini_set("arg_separator.output","&amp;"); } */
header('Content-type: text/html');
require('./misc/Kernel.php');
require('./misc/Act.php');
if(CheckFiles("install.php")!=true) {
	if($Settings['sqldb']==null) {
		header("Location: install.php"); }
ConnectMysql($Settings['sqlhost'],$Settings['sqluser'],$Settings['sqlpass'],$Settings['sqldb']); }
$safesql =& new SafeSQL_MySQL;
if(CheckFiles("Members.php")==true) {
if($_POST['act']=="loginmember"){
$YourName = stripcslashes(htmlentities($_POST['username'], ENT_QUOTES));
$YourName = preg_replace("/\&amp;#(.*?);/is", "&#$1;", $YourName);
$YourPasswordMD5 = md5($_POST['userpass']);
$YourPassword = sha1($YourPasswordMD5);
$querylog = $safesql->query("select * from ".$Settings['sqltable']."Members where Name = '%s' and Password='%s'", array($YourName,$YourPassword));
$resultlog=mysql_query($querylog);
$numlog=mysql_num_rows($resultlog);
if($numlog>=1) {
$i=0;
$YourIDM=mysql_result($resultlog,$i,"id");
$YourNameM=mysql_result($resultlog,$i,"Name");
$YourPassM=mysql_result($resultlog,$i,"Password");
$YourGroupM=mysql_result($resultlog,$i,"Group");
$YourTimeZoneM=mysql_result($resultlog,$i,"TimeZone");
$NewDay=GMTimeSend(null);
$NewIP=$_SERVER['REMOTE_ADDR'];
$queryup = $safesql->query("update ".$Settings['sqltable']."Members set LastActive=%s,IP='%s' WHERE id=%s", array($NewDay,$NewIP,$YourIDM));
mysql_query($queryup);
session_regenerate_id();
$_SESSION['MemberName']=$YourNameM;
$_SESSION['UserID']=$YourIDM;
$_SESSION['UserTimeZone']=$YourTimeZoneM;
} if($numlog<=0) {
//echo "Password was not right or user not found!! <_< ";
} } }
// Skin Stuff
if($_GET['Skin']!=null) {
if($_GET['Skin']=="../"||$_GET['Skin']=="./") {
$_GET['Skin']="DF2k"; $_SESSION['Skin']="DF2k"; }
if (file_exists("skin/".$_GET['Skin']."/Settings.php")) {
$_SESSION['Skin'] = $_GET['Skin'];
/* The file Skin Exists */ }
else { $_GET['Skin']="DF2k"; $_SESSION['Skin']="DF2k";
/* The file Skin Dose Not Exists */ } }
if($_GET['Skin']==null) { 
if($_SESSION['Skin']!=null) {
$_GET['Skin']=$_SESSION['Skin']; }
if($_SESSION['Skin']==null) {
$_SESSION['Skin']="DF2k";
$_GET['Skin']="DF2k"; } }
$PreSkin['skindir1'] = $_SESSION['Skin'];
$PreSkin['skindir2'] = "skin/".$_SESSION['Skin'];
require("skin/".$_GET['Skin']."/Settings.php");
//if(ini_set()) { ini_set("arg_separator", "&amp;"); }
?>