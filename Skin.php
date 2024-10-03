<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en-US">
<head>
<title> Skin Picker 2k </title>
<meta http-equiv="content-language" content="en-US">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-15">
<meta name="Generator" content="EditPlus">
<meta name="Author" content="Null">
<meta name="Keywords" content="Null">
<meta name="Description" content="Null">
</head>

<body>
<?php
if ($handle = opendir('./skin/')) {
while (false != ($num = readdir($handle))) {
if ($num != "." && $num != "..") {
if (file_exists("skin/".$num."/Settings.php")) {
include("skin/".$num."/Settings.php");
echo "<a title=\"This skin was made by ".$SkinSet['SkinMaker']."\" href=\"index.php?Skin=".$num."\">".$SkinSet['SkinName']."</a> - <a title=\"".$SkinSet['SkinMaker']."'s Website\" href=\"".$SkinSet['MakerURL']."\">".$SkinSet['SkinMaker']."'s Website.</a><br />\n";
} } } closedir($handle); }
?>
</body>
</html>