<?php
include '/misc/dbaminfo.php';
	// Connect to the Database
	$con = mysql_connect('localhost', 'qcbscartographie', 'dsbWVmveVY3Xy4JX') or die('Could Not Connect To The Database.');

	mysql_select_db('qcbscartographie', $con);

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

		if($query){ echo "Le rapport a été supprimer avec succès."; }
		else{ echo "Une erreur s'est produite!"; }
	}
	else{ // Creating New Report.
		$orgname = $_POST['orgname'];
		$reportid = uniqid('QCBS'); // Generate Report ID.
		$adminid =  $_POST['adminid'];

		$query = mysql_query("INSERT INTO report VALUES ( '$orgname', '$reportid', CURDATE(), '$adminid', 1, 0, 0, 0)");

		if($query){ echo "Le rapport a été créé avec succès."; }
		else{ echo "Une erreur s'est produite!"; }
	}

	mysql_close($con);
?>