<?php
$File1Name = dirname($_SERVER['PHP_SELF'])."/";
$File2Name = $_SERVER['PHP_SELF'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name=="RSS3.php"||$File3Name=="/RSS3.php") {
	require('index.html');
	exit(); }
require( 'MySQL.php');
$BoardURL = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."";
$BoardURL = preg_replace("/misc/isxS", "", $BoardURL);
if ($_GET['id']==null) { $_GET['id']="1"; }
header("Content-type: application/xml");
echo '<?xml version="1.0" encoding="iso-8859-15"?>'."\n\r";
$safesql =& new SafeSQL_MySQL;
$query = $safesql->query("select * from ".$Settings['sqltable']."Help ORDER BY ID", array());
$result=mysql_query($query);
$num=mysql_num_rows($result);
unset($safesql);
$i=0;
while ($i < $num) {
$HelpID=mysql_result($result,$i,"ID");
$HelpName=mysql_result($result,$i,"HelpName");
$HelpText=mysql_result($result,$i,"HelpText");
$One = $One.'<rdf:li rdf:resource="'.$BoardURL.'Help.php?act=Help&amp;id='.$HelpID.'"/>'."\n\r";
$Two = $Two.'<item>'."\n\r".'<title>'.$HelpName.'</title>'."\n\r".'<description>'.$HelpName.'</description>'."\n\r".'<link>'.$BoardURL.'Help.php?act=Help&amp;id='.$HelpID.'</link>'."\n\r".'</item>'."\n\r";
++$i; }
if ($act=="Download") {
header('Content-Disposition: attachment; filename="'.$Settings['board_name'].'.xml"'); } ?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
<channel>
   <title><?php echo $Settings['board_name']; ?> - Help Files</title>
   <description>RSS Feed of the Help Files in Board <?php echo $Settings['board_name']; ?></description>
   <link><?php echo $BoardURL; ?></link>
   <language>en-us</language>
   <generator>Edit Plus v2.12</generator>
   <copyright>Game Maker 2k� 2004</copyright>
   <ttl>120</ttl>
   <doc>http://backend.userland.com/rss</doc>
   <image>
	<url><?php echo $BoardURL; ?>Pics/xml.gif</url>
	<title><?php echo $Settings['board_name']; ?></title>
	<link><?php echo $BoardURL; ?></link>
   </image>
 <?php echo "\n\r".$Two."\n\r"; ?></channel>
</rss>
<?php mysql_close(); ?>