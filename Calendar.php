<?php require('Preindex.php'); ?>

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
require('inc/calendar.php');
}
mysql_close();
echo $Endpage;
?>
</body>
</html>
<?php
fix_amp(null);
?>