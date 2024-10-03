<?php require('Preindex.php'); ?>

<title> <?php echo $Settings['board_name']." (Powered by ".$DF2k.")"; ?> </title>
</head>
<body>
<?php
require('inc/navbar.php');
?>

<ins><br /></ins>
<table class="Table1" width="100%">
<?php
if($_GET['act']=="login")
{
require('inc/login.php');
} if($_POST['act']=="loginmember"){
require('inc/login.php');
} if($_GET['act']=="logout") {
require('inc/login.php');
} if($_GET['act']=="signup") {
require('inc/register.php'); 
} if($_GET['act']=="makemember") {
if($_POST['act']=="makemembers") {
require('inc/register.php'); } }
?>
</table>
<ins><br /></ins>
<?php
mysql_close();
echo $Endpage;
?>
</body>
</html>
<?php
fix_amp(null);
?>