<?php
$File1Name = dirname($_SERVER['PHP_SELF'])."/";
$File2Name = $_SERVER['PHP_SELF'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name=="categorys.php"||$File3Name=="/categorys.php") {
	require('index.html');
	exit(); }
$prequery = $safesql->query("select * from ".$Settings['sqltable']."Categorys where ID=%s and ShowCategory='Yes' and InSubForum=%s", array($_GET['id'],$_GET['SubID']));
$preresult=mysql_query($prequery);
$prenum=mysql_num_rows($preresult);
$prei=0;
while ($prei < $prenum) {
$CategoryID=mysql_result($preresult,$prei,"ID");
$CategoryName=mysql_result($preresult,$prei,"Name");
$CategoryShow=mysql_result($preresult,$prei,"ShowCategory");
$CategoryDescription=mysql_result($preresult,$prei,"Description");
/*	Toggle Code	*/
$query2 = $safesql->query("select * from ".$Settings['sqltable']."Forums where ShowForum='Yes' and CategoryID='%s' and InSubForum='0' ORDER BY ID", array($CategoryID));
$result2=mysql_query($query2);
$num2=mysql_num_rows($result2);
$i2=0;
$toggle="";
while ($i2 < $num2) {
$ForumID=mysql_result($result2,$i2,"ID");
$i3=$i2+1;
if ($i3!=$num2) {
$toggle=$toggle."toggletag('Forum".$ForumID."'),"; }
if ($i3==$num2) {
$toggle=$toggle."toggletag('Forum".$ForumID."'),"; }
if ($i3==$num2) {
$toggle=$toggle."toggletag('Cat".$CategoryID."'),toggletag('CatEnd');"; }
++$i2; }
?>
<table class="Table1" width="100%">
<tr class="TableRow1">
<td class="TableRow1" colspan="5"><span class="textright"><a href="#Toggle" onclick="<?php echo $toggle; ?>"><?php echo $SkinSet['Toggle']; ?></a></span>
<?php echo $SkinSet['CategoryIcon'] ?><a href="Category.php?id=<?php echo $CategoryID; ?>"><?php echo $CategoryName; ?></a></td>
</tr>
<?php
$query = $safesql->query("select * from ".$Settings['sqltable']."Forums where ShowForum='Yes' and CategoryID='%s' and InSubForum=0 ORDER BY ID", array($CategoryID));
$result=mysql_query($query);
$num=mysql_num_rows($result);
$i=0;
if($num>=1) {
?>
<tr id="Cat<?php echo $CategoryID; ?>" class="TableRow2">
<th class="TableRow2" style="width: 5%">&nbsp;</th>
<th class="TableRow2" style="width: 55%;">Forum</th>
<th class="TableRow2" style="width: 10%">Topics</th>
<th class="TableRow2" style="width: 10%">Posts</th>
<th class="TableRow2" style="width: 20%">Last Topic</th>
</tr>
<?php }
while ($i < $num) {
$ForumID=mysql_result($result,$i,"ID");
$ForumName=mysql_result($result,$i,"Name");
$ForumShow=mysql_result($result,$i,"ShowForum");
$ForumType=mysql_result($result,$i,"ForumType");
$ForumDescription=mysql_result($result,$i,"Description");
unset($LastTopic);
$gltquery="SELECT * FROM ".$Settings['sqltable']."Topics WHERE (CategoryID=".$CategoryID." and ForumID=".$ForumID.") ORDER BY LastUpdate";
$gltresult=mysql_query($gltquery);
$gltnum=mysql_num_rows($gltresult);
if($gltnum>0){
$TopicID=mysql_result($gltresult,$gltnum-1,"ID");
$TopicName=mysql_result($gltresult,$gltnum-1,"TopicName");
$TopicName1 = substr($TopicName,0,15);
if (strlen($TopicName)>12) { $TopicName1 = $TopicName1."..."; }
$UsersID=mysql_result($gltresult,$gltnum-1,"UserID");
$GuestName=mysql_result($gltresult,$gltnum-1,"GuestName");
$UsersName = GetUserName($UsersID,$Settings['sqltable']);
if($UsersName=="Guest") { $UsersName=$GuestName;
if($UsersName==null) { $UsersName="Guest"; } }
$UsersName1 = substr($UsersName,0,18);
if (strlen($UsersName)>15) { $UsersName1 = $UsersName1."...";
$oldtopicname=$TopicName; $oldusername=$UsersName;
$TopicName=$TopicName1; $UsersName=$UsersName1; }
$LastTopic = "Made By: <a href=\"#".$UsersID."\" title=\"".$oldusername."\">".$UsersName."</a><br />\nTopic Name: <a href=\"#\" title=\"".$oldtopicname."\">".$TopicName."</a>"; }
?>
<tr class="TableRow3" id="Forum<?php echo $ForumID; ?>">
<td class="TableRow3"><?php echo $SkinSet['ForumIcon']; ?></td>
<td class="TableRow3"><div class="forumname"><a href="Forum.php?act=View&amp;id=<?php echo $ForumID; ?>&amp;CatID=<?php echo $CategoryID; ?>"><?php echo $ForumName; ?></a></div>
<div class="forumescription"><?php echo $ForumDescription; ?></div></td>
<td class="TableRow3" style="text-align: center;"><?php echo CountTopics($CategoryID,$ForumID,$Settings['sqltable']); ?></td>
<td class="TableRow3" style="text-align: center;"><?php echo CountPosts($CategoryID,$ForumID,$Settings['sqltable']); ?></td>
<td class="TableRow3"><?php echo $LastTopic; ?></td>
</tr>
<?php
++$i; }
if($num>=1) { ?>
<tr id="CatEnd" class="TableRow4">
<td class="TableRow4" colspan="5">&nbsp;</td>
</tr>
<?php } ?>
</table>
<ins><br /></ins>
<?php ++$prei; } ?>