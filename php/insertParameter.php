<?php
header("access-control-allow-origin: *");
include('/var/www/quebio.ca/misc/dbaminfo.php');
$objectiveText = $_POST['objectiveText'];
$limitText = $_POST['limitText'];
$reportid = $_POST['reportid'];
$userid = $_POST['userid'];
$circonscription = $_POST['cir'];
$represent = $_POST['represent'];
$fonction = $_POST['fonction'];
$perimeter = $_POST['perimeter'];
$pre_circonscription = $_POST['preCir'];
$niveau1 = $_POST['niv1'];
$niveau2 = $_POST['niv2'];
$niveau3 = $_POST['niv3'];
$function_text = $_POST['funcTxt'];
$externe = $_POST['Externe'];
$firstTime = $_POST['createOrEdit'];
$newReportid = $_POST['newReportid'];

$con = mysql_connect($mys_host, $mys_username, $mys_pass) or die('Could Not Connect To The Database.');

mysql_select_db($mys_base, $con);
mysql_query("SET NAMES 'utf8");
mysql_query("SET CHARACTER SET 'utf8'");

if (empty($niveau1)) {
	$niveau1 = 'null';
}

if (empty($niveau2)) {
	$niveau2 = 'null';
}

if (empty($niveau3)) {
	$niveau3 = 'null';
}

if (empty($externe)) {
	$externe = 'null';
}

if ($firstTime === 'no') {
	$q="UPDATE outil_parameter SET objective = '$objectiveText', limits = '$limitText', circonscription = '$circonscription',
	represent = '$represent', perimeter = '$perimeter', fonction = '$fonction', function_text = '$function_text', pre_circonscription = '$pre_circonscription',
	niveau1 = '$niveau1', niveau2 = '$niveau2', niveau3 = '$niveau3', externe = '$externe' WHERE u_id = $userid AND 
	r_id = '$reportid'";
	$query = mysql_query($q) or die('Error updating database for update: '.mysql_error());
}
else
{
	$query = "INSERT INTO outil_parameter (objective, limits, circonscription, represent, perimeter, fonction, function_text, pre_circonscription,
	niveau1, niveau2, niveau3, externe, r_id, u_id) VALUES ('$objectiveText', '$limitText', '$circonscription', '$represent', '$perimeter',
	'$fonction', '$function_text', '$pre_circonscription', '$niveau1', '$niveau2', '$niveau3', '$externe','$newReportid', $userid)";	
	$result = mysql_query($query) or die('Error updating database: '.mysql_error());
}

$goto = "Location: http://quebio.ca/entreprisebio?reportid=" . $reportid;
Header( $goto );

mysql_close($con);
?>