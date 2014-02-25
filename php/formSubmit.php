<?php
	include '/misc/dbaminfo.php';

	$path = $_SERVER['DOCUMENT_ROOT'];
	chdir($path);
	define('DRUPAL_ROOT', getcwd());
	require_once './includes/bootstrap.inc';
	drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

	// this file is in progress and it will  be done by 8th of may 2013
	// Connect to the Database
	$con = mysql_connect('localhost', 'qcbscartographie', 'dsbWVmveVY3Xy4JX') or die('Could Not Connect To The Database.');

	mysql_select_db('qcbscartographie', $con);
	mysql_query("SET NAMES 'utf8");
	mysql_query("SET CHARACTER SET 'utf8'");

	// Get Data from Post.
	$newExamples = $_GET['hiddenNewExamples'];
	$existingExamples = $_GET['hiddenExistingExamples'];
	$reportid = $_GET['the_report'];
	$userid = $_GET['the_user'];
	$cid = $_GET['c_i'];

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

	if($newExamples){
		
		for($i = 1; $i<=$newExamples;$i++){

			$example = $_GET['newTheExample'.$i];
			$nature = $_GET['newTheNature'.$i];
			$evalu = $_GET['newTheEvalu'.$i];
			$money = $_GET['newTheMoney'.$i];

			$query = mysql_query("INSERT INTO interdependances VALUES ('$reportid', $userid, $cid, \"" . $example . "\",'$nature', $evalu, $money )");
			
		}

	}

	if($existingExamples){
		
		for($i = 1; $i<=$existingExamples;$i++){
			$example = $_GET['exiTheExample'.$i];
			$nature = $_GET['exiTheNature'.$i];
			$evalu = $_GET['exiTheEvalu'.$i];
			$money = $_GET['exiTheMoney'.$i];	

			$query = mysql_query("INSERT INTO interdependances VALUES ('$reportid', $userid, $cid, \"" . $example . "\",'$nature', $evalu, $money )");
		}
	}

	mysql_close($con);

	$goto = "Location: http://quebio.ca/entreprisebio?reportid=" . $reportid;

	Header( $goto );
?>