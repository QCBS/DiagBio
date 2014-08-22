<?php
include('/var/www/quebio.ca/misc/dbaminfo.php');

$con = mysql_connect($mys_host, $mys_username, $mys_pass) or die('Could Not Connect To The Database.');
mysql_select_db($mys_base, $con);
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");

$adminid = $_POST['adminid'];
$reportid = $_POST['reportid'];
$examples = $_POST['examples'];
$adminFinalOps = $_POST['adminFinalOpinions'];
$report_ids = $_POST['reportIds'];
$potAvgs = $_POST['potavgs'];
$payments = $_POST['altPay'];

if (empty($adminFinalOps)) {
	echo "Il y aucune plan d'action/surveillance a inserer!";	
}
else{

	$loop = 0;
	while($loop < count($examples))  //either insert the example or update the able if it already exists
	{
		$opinion_user_ids = [];  //get the distinct ids of the users that gave opinions on the specific example
		$query = "SELECT DISTINCT u_id FROM interdependances WHERE r_id = 
		'$report_ids[$loop]' AND example = '$examples[$loop]'";
		$results = mysql_query($query) or die('Error Fetching List From Database.');
		while ($row = mysql_fetch_assoc($results)) {
			$opinion_user_ids[] = $row['u_id'];
		}

		$imploded_opinion_ids = implode(",", $opinion_user_ids);  //the opinions ids are grouped together

		$query = "SELECT example, dependance, avg(niveau_dependance) as niveau_d FROM interdependances WHERE  niveau_dependance IS NOT NULL AND example = '$examples[$loop]' AND r_id = '$report_ids[$loop]' GROUP BY r_id,example";
		$results = mysql_query($query) or die('Error updating database for dependances: '.mysql_error());
		while ($row = mysql_fetch_assoc($results)) {
			$dependance = $row['dependance'];
			$dependance_niveau = $row['niveau_d'];
		}

		$query = "SELECT example, impact, avg(niveau_impact) as niveau_i FROM interdependances WHERE example = '$examples[$loop]' AND r_id = '$report_ids[$loop]' AND niveau_impact IS NOT NULL GROUP BY r_id,example";
		$results = mysql_query($query) or die('Error updating database for impacts: '.mysql_error());
		while ($row = mysql_fetch_assoc($results)) {
			$impact = $row['impact'];
			$impact_niveau = $row['niveau_i'];
		}


		$query = "SELECT example, potAvg FROM outil_admin_opinions WHERE example = '$examples[$loop]' AND r_id = '$report_ids[$loop]'";
		$result = mysql_query($query) or die('Error Fetching List From Database.');
		$fetch=mysql_fetch_array($result);
		$existing_examples=$fetch['example'];
		$potsAndAvgs = $fetch['potAvg'];

		//echo 'Existing Example: '.$existing_examples.' PotsAvgs: '.$potsAndAvgs; //it seemed there were duplicate insertions

		if (empty($impact)) {
			$impact = 'null';
		}

		if (empty($dependance)) {
			$dependance = 'null';
		}

		if (empty($impact_niveau)) {
			$impact_niveau = 'null';
		}

		if (empty($dependance_niveaud)) {
			$dependance_niveau = 'null';
		}

		if (empty($payments[$loop])) {
			$payments[$loop] = 'null';
		}

		if ($examples[$loop] === $existing_examples && $potAvgs[$loop] === $potsAndAvgs) {  //does this example already exist in the table? 
			$query = mysql_query("UPDATE outil_admin_opinions SET opinion = '$adminFinalOps[$loop]',
			opinion_ids = '$imploded_opinion_ids', payment = '$payments[$loop]' WHERE example = '$examples[$loop]' AND r_id ='$report_ids[$loop]' AND potAvg = '$potAvgs[$loop]'") or die('Error updating database for update: '.mysql_error());
		}
		else{
			$query = mysql_query("INSERT INTO outil_admin_opinions VALUES ($adminid, '$report_ids[$loop]','$examples[$loop]', '$adminFinalOps[$loop]', '$potAvgs[$loop]', '$imploded_opinion_ids', '$dependance_niveau', '$impact_niveau', '$dependance', '$impact', '$payments[$loop]')") or die('Error updating database for insert: '.mysql_error());
		}
		$loop++;
	}
	echo "Votre avis est inséré!";
}
mysql_close($con);
?>