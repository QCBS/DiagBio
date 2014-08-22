<?php
include('/var/www/quebio.ca/misc/dbaminfo.php');
/*	NEED TO FIGURE OUT A WAY TO ADD THE PHONE NUMBER, EMAIL AND NAMES TO THE DATABASE
	//get the account stuff(telephone number, name, last name and email)
	$account = user_load($userid); // Load Themporary User with "Administration" Role.
	$profile = profile2_load_by_user($account); // Load The Profile2 Data Associated to The User.

	$nom = field_get_items('profile2', $profile['participant'], 'field_niveau');
	$prenom = field_get_items('profile2', $profile['participant'], 'field_niveau');	
	$couriel = field_get_items('profile2', $profile['participant'], 'field_niveau');	
	$phone = field_get_items('profile2', $profile['participant'], 'field_niveau');
*/	// Connect to the Database
	$con = mysql_connect($mys_host, $mys_username, $mys_pass) or die('Could Not Connect To The Database.');
	mysql_select_db($mys_base, $con);

	// Are You Switching Viewability?
	if ( $_POST['viewable'] ){
		$reportid = $_POST['reportid'];

		$query = "SELECT * FROM report WHERE reportid = '$reportid'";
		$results = mysql_query($query) or die('Error Fetching List From Database.');
		$row = mysql_fetch_row($results);

		if ( $row[4] == 1){
			$switch = 0;
		}
		else{
			$switch = 1;
		}

		$query = mysql_query("UPDATE report SET Available = '$switch' WHERE reportid = '$reportid'");
		
		if($query){ echo "La permission de lisibilité a été changé avec succès."; }
		else{ echo "Une erreur s'est produite!"; }
	}
	else if ( $_POST['reportid'] ){ // Are You Deleting a Report?
		$reportid = $_POST['reportid'];

		$query = mysql_query("DELETE FROM report WHERE reportid = '$reportid'");
		$query2 = mysql_query("DELETE FROM outil_parameter WHERE r_id = '$reportid'");
		$query3 = mysql_query("DELETE FROM user_ids WHERE r_id = '$reportid'");
		$query4 = mysql_query("DELETE FROM interdependances WHERE r_id = '$reportid'");
		$query5 = mysql_query("DELETE FROM outil_contact_info WHERE r_id = '$reportid'");
		if($query && $query2 && $query3 && $query4 && $query5){ echo "Le rapport a été supprimer avec succès."; }
		else{ echo "Une erreur s'est produite!"; }
	}
	else{ // Creating New Report.
		$orgname = $_POST['orgsname'];
		$reportid = uniqid('QCBS'); // Generate Report ID.
		$adminid =  $_POST['adminid'];
		$userid = $_POST['userid'];
		$evalName = $_POST['nameEval']; 

		$query = mysql_query("INSERT INTO report VALUES ( '$orgname', '$reportid', CURDATE(), '$adminid', 1, 0, 0, 0, '$evalName')");
		$query2 = mysql_query("INSERT INTO user_ids VALUES ( '$userid', '$reportid')");
		if($query && $query2){ echo $reportid; }  //the report was successfully created
		else{ echo "Une erreur s'est produite!"; }
	}

	mysql_close($con);
?>