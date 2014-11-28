<?php
	define('DRUPAL_ROOT','/var/www/quebio.ca/');
	require_once '/var/www/quebio.ca/includes/bootstrap.inc';
	drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
	include('./Inter_main_php.php');
	include('/var/www/quebio.ca/misc/dbaminfo.php');
	$con = mysql_connect($mys_host, $mys_username, $mys_pass) or die('Could Not Connect To The Database.');
	mysql_select_db($mys_base, $con);
	mysql_query("SET NAMES 'utf8");
	$account = user_load($userid);
	#Dirty check to see if loggind in participant was invited
	$query="SELECT evaluation_id FROM outil_invitations WHERE email='".$account->mail."'";
	$results = mysql_query($query);
	while($fetch=mysql_fetch_assoc($results)) {
		$query="SELECT r_id FROM outil_user_evaluation WHERE u_id=".$userid." AND "."r_id=".$fetch['evaluation_id'];
		$results = mysql_query($query);
		if(!mysql_num_rows($results)){
			$query="INSERT INTO outil_user_evaluation (u_id, r_id) VALUES ($userid, '".$fetch['evaluation_id']."')";
			$results = mysql_query($query);
		}
	}
?>
<div style="width: 800px;">
<div id="selectable0" style="width: 500px; height: 200px; float: left; overflow-y: scroll;">
<?php
	$query = "SELECT * FROM report WHERE reportid IN (SELECT r_id FROM outil_user_evaluation WHERE u_id=".$userid.")";//query statement--->gets the all the reports id
	$results = mysql_query($query) or die('Error Fetching List From Database.');
	while ($row = mysql_fetch_assoc($results)) { // Display The Proper View Setting.
		if ( $row['Available'] == 0 ){
				$viewability = "évaluation visible par l'administrateur seulement";
		}
			else{
				$viewability = "évaluation visible par tous les participants";	
		}
	print "<li class='ui-state-default' style='width: 400px' value='".$row['adminid']."' id='".$row['reportid']."'>".$row['evalName']." - ".$row['date']." - ". $viewability."</li>";
	}
?>
</div>
<div style="float: left; width: 200px; margin-left: 10px;display:none;">
<h3>Numéro de l'évaluation</h3>
<input type="text" id="new_report" name="new_report" style="width: 204px" title="Entrez le nouveau numéro de évaluation" value="">
</div>
</div>
<button type="button" id="NEW_RE_BTN" style="margin:20px 0px 0px 10px;">Répondez à cette évaluation</button>

<!--
<div class="centreBTN3">
<button type="button" id="RE_BTN_NEXT">Suivant</button>
</div>
--­>