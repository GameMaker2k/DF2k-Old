<?php require('Preindex.php'); ?>

<link rel="alternate" type="application/rss+xml" title="Forum Topics RSS Feed" href="RSS.php?act=TopicFeed&amp;id=<?php echo $_GET['id']; ?>&amp;CatID=<?php echo $_GET['CatID']; ?>" />
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
if(!is_numeric($_GET['CatID']))
{
$_GET['CatID']="1";
}
if($_GET['act']=="View"||$_GET['act']==null)
{
require('inc/topics.php');
} 
mysql_close();
echo $Endpage;
?>
</body>
</html>
<?php
change_title($Settings['board_name']." - Viewing ".$ForumName." Forum");
?>