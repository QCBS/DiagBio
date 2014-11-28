<?php
	header('content-type: application/json; charset=utf-8');
	header("access-control-allow-origin: *");
	include('/var/www/quebio.ca/misc/dbaminfo.php');
	$con = mysql_connect($mys_host, $mys_username, $mys_pass) or die('Could Not Connect To The Database.');
	mysql_select_db($mys_base, $con);
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET CHARACTER SET 'utf8'");

	$reportId = $_GET['reportId'];
	$userId = $_GET['userId'];

	$query = "SELECT evalName, orgname FROM report WHERE reportid = '$reportId' AND adminid = '$userId'";
	$result = mysql_query($query) or die('Error Fetching List From Database.');
	$fetch=mysql_fetch_array($result);
	$evalName = $fetch['evalName'];
	$orgname = $fetch['orgname'];

	$query = "SELECT objective, limits, circonscription, represent, perimeter, fonction, function_text, pre_circonscription, niveau1, niveau2,
	niveau3, externe FROM outil_parameter WHERE r_id = '$reportId' AND u_id = '$userId'";
	$result = mysql_query($query) or die('Error Fetching List From Database.');
	$fetch=mysql_fetch_array($result);
	$objective=$fetch['objective'];
	$limits = $fetch['limits'];
	$circonscription = $fetch['circonscription'];
	$represent = $fetch['represent'];
	$perimeter = $fetch['perimeter'];
	$fonction=$fetch['fonction'];
	$function_text = $fetch['function_text'];
	$pre_circonscription = $fetch['pre_circonscription'];
	$niveau1 = $fetch['niveau1'];
	$niveau2 = $fetch['niveau2'];
	$niveau3 = $fetch['niveau3'];
	$externe = $fetch['externe'];
	mysql_close($con);

	$values = array('objective' => $objective,
		'limits' => $limits,
		'circonscription' => $circonscription,
		'represent' => $represent,
		'perimeter' => $perimeter,
		'fonction' => $fonction,
		'function_text' => $function_text,
		'pre_circonscription' => $pre_circonscription,
		'niveau1' => $niveau1,
		'niveau2' => $niveau2,
		'niveau3' => $niveau3,
		'evalName' => $evalName,
		'orgname' => $orgname,
		'externe' => $externe
	);

	echo json_encode($values);
?>