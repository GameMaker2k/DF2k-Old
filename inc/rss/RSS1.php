<?php
$File1Name = dirname($_SERVER['PHP_SELF'])."/";
$File2Name = $_SERVER['PHP_SELF'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name=="RSS1.php"||$File3Name=="/RSS1.php") {
	require('index.html');
	exit(); }
require( 'MySQL.php');
$BoardURL = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."";
$BoardURL = preg_replace("/misc/isxS", "", $BoardURL);
header("Content-type: application/xml");
if ($act=="Download") {
header('Content-Disposition: attachment; filename="'.$Settings['board_name'].'.xml"'); }
if ($_GET['id']==null) {
	$_GET['id']=0; }
echo '<?xml version="1.0" encoding="iso-8859-15"?>'."\n\r";
$safesql =& new SafeSQL_MySQL;
if ($_GET['CatID']==null) {
$query = $safesql->query("select * from ".$Settings['sqltable']."Forums where ShowForum='Yes' and InSubForum=%s ORDER BY ID", array($_GET['id'])); }
if ($_GET['CatID']!=null) {
$query = $safesql->query("select * from ".$Settings['sqltable']."Forums where ShowForum='Yes' and InSubForum=%s and CategoryID=%s ORDER BY ID", array($_GET['id'],$_GET['CatID'])); }
unset($safesql);
$result=mysql_query($query);
$num=mysql_num_rows($result);
$i=0;
while ($i < $num) {
$ForumID=mysql_result($result,$i,"ID");
$CategoryID=mysql_result($result,$i,"CategoryID");
$ForumName=mysql_result($result,$i,"Name");
$ForumShow=mysql_result($result,$i,"ShowForum");
$ForumType=mysql_result($result,$i,"ForumType");
$ForumDescription=mysql_result($result,$i,"Description");
$One = $One.'<rdf:li rdf:resource="'.$BoardURL.$ForumType.'.php?id='.$ForumID.'&amp;CatID='.$CategoryID.'"/>'."\n\r";
$Two = $Two.'<item>'."\n\r".'<title>'.$ForumName.'</title>'."\n\r".'<description>'.$ForumDescription.'</description>'."\n\r".'<link>'.$BoardURL.$ForumType.'.php?id='.$ForumID.'&amp;CatID='.$CategoryID.'</link>'."\n\r".'</item>'."\n\r";
++$i; } ?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
  <channel>
   <title><?php echo $Settings['board_name']; ?></title>
   <description>RSS Feed of the Forums on Board <?php echo $Settings['board_name']; ?></description>
   <link><?php echo $BoardURL; ?></link>
   <language>en-us</language>
   <generator>Edit Plus v2.12</generator>
   <copyright>Game Maker 2k© 2004</copyright>
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