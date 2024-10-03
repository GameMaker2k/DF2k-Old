<?php require('Preindex.php'); ?>

<link rel="alternate" type="application/rss+xml" title="Board RSS Feed" href="RSS.php?act=BoardFeed" />
<link rel="alternate" type="application/rss+xml" title="Category RSS Feed" href="RSS.php?act=CategoryFeed&amp;SubID=0" />
<title> <?php echo $Settings['board_name']." (Powered by ".$DF2k.")"; ?> </title>
</head>
<body>
<?php
require('inc/navbar.php');
?>
<ins><br /></ins>
<?php
if($_GET['act']=="View"||$_GET['act']==null)
{
require('inc/boards.php');
}
mysql_close();
echo $Endpage;
?>
</body>
</html>
<?php
fix_amp(null);
?>