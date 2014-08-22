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
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET CHARACTER SET 'utf8'");
	// Get Data from Post.
	$userRole = $_POST['userRole2'];
	$reportid = mysql_real_escape_string($_POST['the_report']);
	$userid = mysql_real_escape_string($_POST['the_user']);
	$se_i = mysql_real_escape_string($_POST['se_i']);
	$se_name = mysql_real_escape_string($_POST['se_name']);
	$cid = mysql_real_escape_string($_POST['c_i']);
	$c_name = mysql_real_escape_string($_POST['c_i_val']);
	$example = mysql_real_escape_string($_POST['chosenExample']);
	$dependance = mysql_real_escape_string($_POST['inter']);
	$impact = mysql_real_escape_string($_POST['inter2']);
	$process = mysql_real_escape_string($_POST['riskOrOpp']);
	$secondProcess = mysql_real_escape_string($_POST['riskOrOpp2']);
	$averageDependanceLevel = mysql_real_escape_string($_POST['interdependanceAverage']);
	$potentialDependanceLevel = mysql_real_escape_string($_POST['interdependancePotential']);
	$averageImpactLevel = mysql_real_escape_string($_POST['hiddenImpactAverage']);
	$potentialImpactLevel = mysql_real_escape_string($_POST['hiddenImpactPotential']);
	$money  = mysql_real_escape_string($_POST['gotMoney']);
	$moneyType = mysql_real_escape_string($_POST['typeOfMoney']);
	$qualifyImpact = mysql_real_escape_string($_POST['qualifyImpact']);
	$niveauDependance = mysql_real_escape_string($_POST['niveauDependance']);
	$niveauImpact = mysql_real_escape_string($_POST['niveauImpact']);
	$impact_opinion = mysql_real_escape_string($_POST['impact_txt']);
	$dependance_opinion = mysql_real_escape_string($_POST['dep_txt']);

	$account = user_load($userid); // Load Themporary User with "Administration" Role.
	$profile = profile2_load_by_user($account); // Load The Profile2 Data Associated to The User.

	$query = "SELECT count(*) as cnt FROM outil_contact_info where u_id = '$userid'";
	$result = mysql_query($query) or die('Error Fetching List From Database.');
	$fetch=mysql_fetch_array($result);
	$numOfRows=$fetch['cnt'];

if ($userRole == 'Participant' && $numOfRows == 0) {
    $nom = field_get_items('profile2', $profile['participant'], 'field_pnom');
    $prenom = field_get_items('profile2', $profile['participant'], 'field_pprenom'); 
    $couriel = field_get_items('profile2', $profile['participant'], 'field_pcourriel‎ ');    
    $phone = field_get_items('profile2', $profile['participant'], 'field_ptelephone');
    $niveau = field_get_items('profile2', $profile['participant'], 'field_niveau');
    $firstName = $nom[0]['value'];
    $lastName = $prenom[0]['value'];
    $email = $couriel[0]['value'];
    $phoneNum = $phone[0]['value'];
    $groupType = $niveau[0]['value'];

    $query = mysql_query("INSERT INTO outil_contact_info VALUES ( '$userid', '$reportid', '$firstName' , '$lastName', '$email', '$phoneNum', '$groupType')");
}

//INSERT DOES NOT WORK ILL HAVE TO MAKE NEW VARIABLES TO HOLD THOSE VALUES ADN MAKE SURE THE DATA
//WAS DELETED, ONCE THATS DONE WORK ON THE getAdminInfo to show this data on the report:) wooo!!!!
//friday!!!
if ($userRole == 'Administration' && $numOfRows == 0) {
    $nom = field_get_items('profile2', $profile['administration'], 'field_nom');
    $prenom = field_get_items('profile2', $profile['administration'], 'field_prenom'); 
    $couriel = field_get_items('profile2', $profile['administration'], 'field_courriel');    
    $phone = field_get_items('profile2', $profile['administration'], 'field_telephone');
	$firstName = $nom[0]['value'];
    $lastName = $prenom[0]['value'];
    $email = $couriel[0]['value'];
    $phoneNum = $phone[0]['value'];

    $query = mysql_query("INSERT INTO outil_contact_info VALUES ( '$userid', '$reportid', '$firstName' , '$lastName', '$email', '$phoneNum', 'Direction')");
}

echo $firstName.' '.$lastName.' '.$email.' '.$phoneNum.' '.$groupType;
	$query = "SELECT count(*) as cnt FROM interdependances where u_id = '$userid'";
	$result = mysql_query($query) or die('Error Fetching List From Database.');
	$fetch=mysql_fetch_array($result);
	$numOfRows=$fetch['cnt'];
	
	if ( $userRole == "Participant" && $numOfRows == 0){
			$niveau = field_get_items('profile2', $profile['participant'], 'field_niveau');
			echo "Niveau: ".$niveau[0]['value'];
		switch($niveau[0]['value']){
			case "Direction":
				$query = "UPDATE report SET Direction = Direction + 1 WHERE reportid = '$reportid'";
				$updateReport = mysql_query($query) or die('Unable to update report table.');
				break;
			case "Interne":
				$query = "UPDATE report SET Interne = Interne + 1 WHERE reportid = '$reportid'";
				$updateReport = mysql_query($query) or die('Unable to update report table.');
				break;
			case "Externe":
				$query = "UPDATE report SET Externe = Externe + 1 WHERE reportid = '$reportid'";
				$updateReport = mysql_query($query) or die('Unable to update report table.');
				break;
		}
	}
	$opinion = '';

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

	if (empty($averageDependanceLevel)) {
		$averageDependanceLevel = 'null';
	}
	else if($averageDependanceLevel != '')
	{
		$niveauAvgPot = $averageDependanceLevel;	
	}

	if (empty($potentialDependanceLevel)) {
		$potentialDependanceLevel = 'null';
	}
	else if($potentialDependanceLevel != '')
	{
		$niveauAvgPot = $potentialDependanceLevel;	
	}

	if (empty($averageImpactLevel)) {
		$averageImpactLevel = 'null';
	}
	else if($averageImpactLevel != '')
	{
		$niveauAvgPot = $averageImpactLevel;	
	}

	if (empty($potentialImpactLevel)) {
		$potentialImpactLevel = 'null';
	}
	else if($potentialImpactLevel != '')
	{
		$potentialImpactLevel = $potentialImpactLevel;	
	}

	if (empty($moneyType)) {
		$moneyType = 'null';
	}

	if (empty($niveauDependance)) {
		$niveauDependance = 'null';
	}

	if (empty($niveauImpact)) {
		$niveauImpact = 'null';
	}

	if (empty($impact_opinion)) {
		$impact_opinion = 'null';
	}
	else
		$opinion .= $impact_opinion;

	if (empty($dependance_opinion)) {
		$dependance_opinion = 'null';
	}
	else
		$opinion .= $dependance_opinion;

	$query = "INSERT INTO interdependances (r_id, u_id, se_id, se_name, c_id, c_name, example, dependance, impact, process, secondProcess, average_dependance_level, potential_dependance_level, average_impact_level, potential_impact_level, gotMoney, moneyType, qualifyImpact, niveau_impact, niveau_dependance, opinion) VALUES ('$reportid', $userid, '$se_i', '$se_name', '$cid', '$c_name', '$example', '$dependance', '$impact', '$process', '$secondProcess', $averageDependanceLevel, $potentialDependanceLevel, $averageImpactLevel, $potentialImpactLevel, '$money', '$moneyType','$qualifyImpact', $niveauImpact, $niveauDependance, '$opinion')";	
	
	$result = mysql_query($query) or die('Error updating database: '.mysql_error());
	
	mysql_close($con);

	$goto = "Location: http://quebio.ca/entreprisebio?reportid=" . $reportid;

	Header($goto);
?>