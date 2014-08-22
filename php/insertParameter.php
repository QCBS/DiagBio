<?php
include('/var/www/quebio.ca/misc/dbaminfo.php');

$objectiveText = $_POST['objectiveText'];
$limitText = $_POST['limitText'];
$defineText = $_POST['defineText'];
$reportid = $_POST['reportid'];
$userid = $_POST['userid'];
$circonscription = $_POST['circonscription'];
$represent = $_POST['represent'];
$fonction = $_POST['fonction'];
$niveau = $_POST['niveau'];

$con = mysql_connect($mys_host, $mys_username, $mys_pass) or die('Could Not Connect To The Database.');

mysql_select_db($mys_base, $con);
mysql_query("SET NAMES 'utf8");
mysql_query("SET CHARACTER SET 'utf8'");

$query = "INSERT INTO outil_parameter (objective, limits, define, circonscription, represent, fonction, niveau, r_id, u_id) VALUES ('$objectiveText', '$limitText', '$defineText', '$circonscription', '$represent', '$fonction', '$niveau', '$reportid', $userid)";	
	echo $query;
	$result = mysql_query($query) or die('Error updating database: '.mysql_error());
	
	mysql_close($con);

	$goto = "Location: http://quebio.ca/entreprisebio?reportid=" . $reportid;

	Header( $goto );
?>