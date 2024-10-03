<?php
$File1Name = dirname($_SERVER['PHP_SELF'])."/";
$File2Name = $_SERVER['PHP_SELF'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name=="login.php"||$File3Name=="/login.php") {
	require('index.html');
	exit(); }
if($_GET['act']=="logout") {
session_unregister(MemberName);
session_unregister(UserID);
session_unregister(UserTimeZone);
session_destroy();
session_unset();
$_SESSION['MemberName']=null;
$_SESSION['UserID']=0;
$_SESSION['UserTimeZone']=0;
session_regenerate_id();
$_GET['act']="login";
}
if($_GET['act']=="login")
{
?>
<tr class="TableRow1">
<td class="TableRow1" colspan="2"><span class="textright"><a href="#Toggle" onclick="<?php echo $toggle; ?>"><?php echo $SkinSet['Toggle']; ?></a>&nbsp;</span>
&nbsp;<a href="Members.php?act=login">Log in</a></td>
</tr>
<tr class="TableRow2">
<th class="TableRow2" style="width: 100%; text-align: left;">&nbsp;Inert your login info: </th>
</tr>
<tr class="TableRow3">
<td class="TableRow3">
<form method="post" action="?act=login_now">
<table style="text-align: left;">
<tr style="text-align: left;">
	<td style="width: 30%;"><label for="username">Enter UserName: </label></td>
	<td style="width: 70%;"><input class="TextBox" id="username" type="text" name="username" /></td>
</tr><tr>
	<td style="width: 30%;"><label for="userpass">Enter Password: </label></td>
	<td style="width: 70%;"><input class="TextBox" id="userpass" type="password" name="userpass" /></td>
</tr></table>
<table style="text-align: left;">
<tr style="text-align: left;">
<td style="width: 100%;">
<input type="hidden" name="act" value="loginmember" style="display: none;" />
<input class="Button" type="submit" value="Log in" />
</td></tr></table>
</form>
</td>
</tr>
<tr class="TableRow4">
<td class="TableRow4" colspan="2">&nbsp;</td>
</tr>
<?php } if($_POST['act']=="loginmember"){?>
<tr class="TableRow1">
<td class="TableRow1" colspan="2"><span class="textright"><a href="#Toggle" onclick="<?php echo $toggle; ?>"><?php echo $SkinSet['Toggle']; ?></a>&nbsp;</span>
&nbsp;<a href="Members.php?act=login">Log in</a></td>
</tr>
<tr class="TableRow2">
<th class="TableRow2" style="width: 100%; text-align: left;">&nbsp;Login Message: </th>
</tr>
<tr class="TableRow3">
<td class="TableRow3">
<table style="width: 100%; height: 25%; text-align: center;">
<?php if($numlog>=1) { ?>
<tr>
	<td><br />Welcome to the Board <?php echo $_SESSION['MemberName']; ?>. ^_^<br />
	Click <a href="index.php?act=View">here</a> to continue to board.<br />&nbsp;</td>
</tr>
<?php } if($numlog<=0) { ?>
<tr>
	<td><br />Password was not right or user not found!! &lt;_&lt;<br />
	Click <a href="Members.php?act=login">here</a> to try again.<br />&nbsp;</td>
</tr>
<?php } ?>
</table>
</tr>
</tr>
<tr class="TableRow4">
<td class="TableRow4" colspan="2">&nbsp;</td>
</tr>
<?php } ?>