<?php
	ini_set('display_errors');
	include('/var/www/quebio.ca/misc/dbaminfo.php');

	$path = $_SERVER['DOCUMENT_ROOT'];
	chdir($path);
	define('DRUPAL_ROOT', getcwd());
	require_once './includes/bootstrap.inc';
	drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

	// this file is in progress and it will  be done by 8th of may 2014
	// Connect to the Database
	$con = mysql_connect($mys_host, $mys_username, $mys_pass) or die('Could Not Connect To The Database.');

	mysql_select_db($mys_base, $con);
	mysql_query("SET NAMES 'utf8");
	mysql_query("SET CHARACTER SET 'utf8'");
	// Get Data from Post.
	$reportid = mysql_real_escape_string($_POST['the_report']);
	$userid = mysql_real_escape_string($_POST['the_user']);
	$se_i = mysql_real_escape_string($_POST['se_i']);
	$cid = mysql_real_escape_string($_POST['c_i']);
	$example = mysql_real_escape_string($_POST['chosenExample']);
	$dependance = mysql_real_escape_string($_POST['inter']);
	$impact = mysql_real_escape_string($_POST['inter2']);
	$process = mysql_real_escape_string($_POST['riskOrOpp']);
	$secondProcess = mysql_real_escape_string($_POST['riskOrOpp2']);
	$hiddenDependance = mysql_real_escape_string($_POST['interdependance']);
	$hiddenImpact = mysql_real_escape_string($_POST['hiddenImpact']);
	$money  = mysql_real_escape_string($_POST['gotMoney']);
	$moneyType = mysql_real_escape_string($_POST['typeOfMoney']);
	$qualifyImpact = mysql_real_escape_string($_POST['qualifyImpact']);
	
	$account = user_load($userid); // Load Themporary User with "Administration" Role.
	$profile = profile2_load_by_user($account); // Load The Profile2 Data Associated to The User.

	/*if ( $account->roles[5] != undefined ) {
		$niveauf = field_get_items('profile2', $profile['participant'], 'field_niveau');
	}
	else {
		$niveauf = field_get_items('profile2', $profile['administration'], 'field_niveau');
	}

	$niveau = $niveauf[0]['value'];*/

	$query = "SELECT COUNT(*) FROM interdependances WHERE r_id = '$reportid' AND u_id = '$userid'"; // Get Count Of Anwsers for Report
	$result = mysql_query($query) or die('Error Fetching List From Database.');

	$count = mysql_fetch_row($result);

	if ( $count[0] == 0 ){
		switch($niveau){
			case "Direction":
				$query = "UPDATE report SET Direction = Direction + 1 WHERE reportid = '$reportid'";
				$updareReport = mysql_query($query) or die('Unable to update report table.');
				break;
			case "Interne":
				$query = "UPDATE report SET Interne = Interne + 1 WHERE reportid = '$reportid'";
				$updareReport = mysql_query($query) or die('Unable to update report table.');
				break;
			case "Externe":
				$query = "UPDATE report SET Externe = Externe + 1 WHERE reportid = '$reportid'";
				$updareReport = mysql_query($query) or die('Unable to update report table.');
				break;
		}
	}

	if (empty($dependance)) {
		$dependance = 'null';
	}

	if (empty($impact)) {
		$impact = 'null';
	}

	if (empty($process)) {
		$process = 'null';
	}

	if (empty($secondProcess)) {
		$secondProcess = 'null';
	}

	if (empty($qualifyImpact)) {
		$qualifyImpact = 'null';
	}

	if (empty($hiddenDependance)) {
		$hiddenDependance = 'null';
	}

	if (empty($hiddenImpact)) {
		$hiddenImpact = 'null';
	}

	if (empty($moneyType)) {
		$moneyType = 'null';
	}

	$query = "INSERT INTO interdependances (r_id, u_id, se_name, c_id, example, dependance, impact, process, secondProcess, dependanceLevel, impactLevel, gotMoney, moneyType, qualifyImpact) VALUES ('$reportid', $userid, '$se_i', '$cid', '$example', '$dependance', '$impact', '$process', '$secondProcess', $hiddenDependance, $hiddenImpact, '$money', '$moneyType','$qualifyImpact')";	
	echo $query;
	$result = mysql_query($query) or die('Error updating database: '.mysql_error());
	
	mysql_close($con);
	echo "the end";

	$goto = "Location: http://quebio.ca/entreprisebio?reportid=" . $reportid;

	Header( $goto );
?>