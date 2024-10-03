<?php require('Preindex.php'); ?>

<link rel="alternate" type="application/rss+xml" title="Board RSS Feed" href="RSS.php?act=BoardFeed&amp;CatID=<?php echo $_GET['id']; ?>" />
<title> <?php echo $Settings['board_name']." (Powered by ".$DF2k.")"; ?> </title>
</head>
<body>
<?php
require('inc/navbar.php');
?>
<ins><br /></ins>
<?php
if(!is_numeric($_GET['id']))
{
$_GET['id']="1";
}
if(!is_numeric($_GET['SubID']))
{
$_GET['SubID']="0";
}
if($_GET['act']=="View"||$_GET['act']==null)
{
require('inc/categorys.php');
}
mysql_close();
echo $Endpage;
?>
</body>
</html>
<?php
echo $Endpage;
fix_amp(null);
?>