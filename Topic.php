<?php require('Preindex.php'); ?>

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
if(!is_numeric($_GET['ForumID']))
{
$_GET['ForumID']="1";
}
if(!is_numeric($_GET['CatID']))
{
$_GET['CatID']="1";
}
if($_GET['act']=="View"||$_GET['act']==null)
{
require('inc/replys.php');
}
mysql_close();
echo $Endpage;
?>
</body>
</html>
<?php
change_title($Settings['board_name']." - Viewing Topic ".$TopicName);
?>