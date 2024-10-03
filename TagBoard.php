<?php 
require('Preindex.php');
//This is Where You Put The Name of This File and Your Board Name
$filename="TagBoard";
$boardname=$Settings['board_name'];
?>

<title> <?php echo $Settings['board_name']." (Powered by ".$TB2k.")"; ?> </title>
</head>
<body>
<?php
require('inc/navbar.php');
?>
<ins><br /></ins>
<?php
if($_GET['act']=="View"||$_GET['act']==null)
{
require('inc/tagboard.php');
}
mysql_close();
echo $Endpage;
?>
</body>
</html>
<?php
fix_amp(null);
?>