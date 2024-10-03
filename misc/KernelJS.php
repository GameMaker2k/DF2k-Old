<?php
require('Kernel.php');
header('Content-type: application/x-javascript');
?>
<!--
function getid(id) {
itm = document.getElementById(id);
return itm; }

function toggleview(id) {
if (itm.style.display == "none") {
itm.style.display = ""; }
else {
itm.style.display = "none"; } }

function toggletag(id) {
getid(id);
toggleview(id); }

function bgchange(id,color) {
getid(id);
itm.style.backgroundColor = ''+color+''; }

function innerchange(tag,text1,text2) {
usrname = document.getElementsByTagName(tag);
for (var i = 0; i < usrname.length; i++) {
if(usrname[i].innerHTML==text1) {
usrname[i].innerHTML = text2; } } }
//-->