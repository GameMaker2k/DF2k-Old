<?php
/*if($_GET['act']==null) {
	require('inc/index.html');
}*/
if($_GET['act']=="BoardFeed"||$_GET['act']==null) {
	require('inc/rss/RSS1.php');
}
if($_GET['act']=="CategoryFeed") {
	require('inc/rss/RSS4.php');
}
if($_GET['act']=="TopicFeed") {
	require('inc/rss/RSS2.php');
}
if($_GET['act']=="HelpFeed") {
	require('inc/rss/RSS3.php');
}
?>