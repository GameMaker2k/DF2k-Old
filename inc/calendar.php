<?php
$File1Name = dirname($_SERVER['PHP_SELF'])."/";
$File2Name = $_SERVER['PHP_SELF'];
$File3Name=str_replace($File1Name, null, $File2Name);
if ($File3Name=="calendar.php"||$File3Name=="/calendar.php") {
	require('index.html');
	exit(); }
// Count the Days in this month
$CountDays = GMTimeGet("t",$YourOffSet);
$MyDay = GMTimeGet("d",$YourOffSet);
$MyDay2 = GMTimeGet("dS",$YourOffSet);
$MyDayName = GMTimeGet("l",$YourOffSet);
$MyYear = GMTimeGet("Y",$YourOffSet);
$MyMonth = GMTimeGet("m",$YourOffSet);
$MyMonthName = GMTimeGet("F",$YourOffSet);
$FirstDayThisMouth = date("w", mktime(0, 0, 0, $MyMonth, 1, $MyYear));
$query = $safesql->query("select * from ".$Settings['sqltable']."Events where EventMouth<=%s and EventMouthEnd>=%s and EventYear<=%s and EventYearEnd>=%s", array($MyMonth,$MyMonth,$MyYear,$MyYear));
$result=mysql_query($query);
$num=mysql_num_rows($result);
$is=0;
while ($is < $num) {
$EventID=mysql_result($result,$is,"ID");
$EventUser=mysql_result($result,$is,"UserID");
$EventName=mysql_result($result,$is,"EventName");
$EventText=mysql_result($result,$is,"EventText");
$EventMouth=mysql_result($result,$is,"EventMouth");
$EventMouthEnd=mysql_result($result,$is,"EventMouthEnd");
$EventDay=mysql_result($result,$is,"EventDay");
$EventDayEnd=mysql_result($result,$is,"EventDayEnd");
$EventYear=mysql_result($result,$is,"EventYear");
$EventYearEnd=mysql_result($result,$is,"EventYearEnd");
if ($EventsName[$EventDay] != null) {
	$EventsName[$EventDay] .= ",\n\r<a href=\"#Event.php?act=Event&amp;id=".$EventID."\" style=\"font-size: 9px;\" title=\"View Event ".$EventName.".\">".$EventName."</a>";	 }
if ($EventsName[$EventDay] == null) {
	$EventsName[$EventDay] = "<a href=\"#Event.php?act=Event&amp;id=".$EventID."\" style=\"font-size: 9px;\" title=\"View Event ".$EventName.".\">".$EventName."</a>"; }
if ($EventDay<$EventDayEnd) {
$NextDay = $EventDay+1;
$EventDayEnd = $EventDayEnd+1;
while ($NextDay < $EventDayEnd) {
if ($EventsName[$NextDay] != null) {
	$EventsName[$NextDay] .= ",\n\r<a href=\"#Event.php?act=Event&amp;id=".$EventID."\" style=\"font-size: 9px;\" title=\"View Event ".$EventName.".\">".$EventName."</a>";	 }
if ($EventsName[$NextDay] == null) {
	$EventsName[$NextDay] = "<a href=\"#Event.php?act=Event&amp;id=".$EventID."\" style=\"font-size: 9px;\" title=\"View Event ".$EventName.".\">".$EventName."</a>"; }
$NextDay++; } }
$EventsID[$EventDay] = $EventID;
$is++;
}
$MyDays = array();
$MyDays[] = "Sunday";
$MyDays[] = "Monday";
$MyDays[] = "Tuesday";
$MyDays[] = "Wednesday";
$MyDays[] = "Thursday";
$MyDays[] = "Friday";
$MyDays[] = "Saturday";
$DayNames = "";
foreach ($MyDays as $x => $y) {
    $DayNames .= '<th class="TableRow2" style="width: 12%;">' . $y . '</th>'."\r\n";
}
$WeekDays = "";
$i = $FirstDayThisMouth + 1;
if ($FirstDayThisMouth != "0") {
    $WeekDays .= '<td class="CalRow1" align="center" colspan="' . $FirstDayThisMouth . '">&nbsp;</td>'."\r\n";
}
$Day_i = "1";
$ii = $i;
for ($i; $i <= ($CountDays + $FirstDayThisMouth) ;$i++) {
if ($ii == 8) {
$WeekDays .= "</tr><tr class=\"TableRow3\">"."\r\n";
$ii = 1; }
 if ($MyDay == $Day_i) {
$Extra = 'class="TableRow3"'; }
else {
$Extra = 'class="TableRow2"'; }
if ($Day_i != $_GET['HighligtDay']) {
if ($Day_i != $MyDay) {
$WeekDays .= '<td class="CalRow1" style="height: 60px; vertical-align: top;">' . $Day_i . '<div style="text-align: left;">' . $EventsName[$Day_i] . '</div></td>'."\r\n";	 }	}
if ($Day_i == $MyDay) {
$WeekDays .= '<td style="height: 60px; vertical-align: top;">' . $Day_i . '<div style="text-align: left;">' . $EventsName[$Day_i] . '</div></td>'."\r\n";	 }
$Day_i++;
$ii++;
}
if ((8 - $ii) >= "1") {
$WeekDays .= '<td class="CalRow1" align="center" colspan="' . (8 - $ii) . '">&nbsp;</td>'."\r\n"; } ?>
<table class="Table1" width="100%"><tr class="TableRow1">
<th class="TableRow1" colspan="7">
<span class="textleft">&nbsp;<?php echo "Today is ".$MyDayName." the ".$MyDay2." of ".$MyMonthName.", ".$MyYear; ?></span>
<span class="textright"><?php echo "The time is ".GMTimeGet('g:i a',$YourOffSet); ?>&nbsp;</span>
</th>
</tr><tr class="TableRow2">
<?php echo $DayNames; ?>
</tr><tr class="CalRow1">
<?php echo $WeekDays; ?>
</tr>
<tr class="TableRow4">
<td class="TableRow4" colspan="7">&nbsp;</td>
</tr>
</table>
<ins><br /></ins>