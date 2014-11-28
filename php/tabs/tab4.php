<?php
define('DRUPAL_ROOT','/var/www/quebio.ca/');
require_once '/var/www/quebio.ca/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
include('./Inter_main_php.php');
include('/var/www/quebio.ca/misc/dbaminfo.php');
$con = mysql_connect($mys_host, $mys_username, $mys_pass) or die('Could Not Connect To The Database.');
mysql_select_db($mys_base, $con);
mysql_query("SET NAMES 'utf8");
mysql_query("SET CHARACTER SET 'utf8'");
?>

<div style="width: 500px; min-height: 300px; float: left; overflow-y: scroll;">  
	<div id="selectableadmin">
<?php
// Get list of all available services
$query = "SELECT adminid,reportid,evalName,date FROM report WHERE adminid = '$userid' ORDER BY date";
$results = mysql_query($query) or die('Error Fetching List From Database.');

while ($row = mysql_fetch_assoc($results)) { // Display The Proper View Setting.
	if ( $row['Available'] == 0 ){
		$viewability = "évaluation visible par l'administrateur uniquement";
	}
	else{
		$viewability = "évaluation visible par tous les participants";	
	}

	?> 	<!-- Each Report List Item Has its ID as the Report ID Fetched From The Database. -->
	<li class="ui-state-default" style="width: 400px" value=<?php echo "\"" . $row['adminid'] . "\""; ?> id=<?php echo "\"" . $row['reportid'] . "\""; ?>><?php echo $row['evalName']; echo " - "; echo $row['date']; echo " - " . $viewability; ?></li>
<?php
}
?>
	</div>
	<input type="hidden" value="" id="select-resultadmin"> <!-- Stores The Currently Selected Report ID -->
</div>  
<span></span>
<div style="width: 300px; height: 210px; float: left; margin-left: 10px;">
	<h2>Actions possibles:</h2> <!-- All The Buttons That Are Used By The Admin -->
	<button id="create_report" name="create_report" style="margin-bottom: 5px">Création d'une nouvelle évaluation</button>
	<button id="edit_report" name="edit_report" style="margin-bottom: 5px">Voir/Modifier l'évaluation</button>
	<button id="delete_report" name="delete_report" style="margin-bottom: 5px">Supprimer une évaluation</button>
	<button id="view_report" name="view_report" style="margin-bottom: 5px">Générer un rapport</button>
	<button id="viewable_report" name="viewable_report" style="margin-bottom: 5px">Changer la visibilité de l'évaluation</button>
	<br />
	<img id='ajax' src="http://quebio.ca/testing/Jason/ajax-loader.gif" style="visibility:hidden; margin-left: 100px">
</div>

<!-- Text Boxes and Button To Send E-mails -->
<h2>Envoi d'invitations pour participer à une évaluation:</h2>
<input class="text_input_style" type="text" value="" id="recipient">
<p class="help_text_style">Veuillez entrer les adresses courriel des destinataires, séparées par des virgules. (exemple: user@example.com, usager@example.com).</p>
<textarea id="information" row="4" col="50"></textarea>
<p class="help_text_style">Informations additionnelles que vous voulez inclure dans l'invitation.</p>
<button id="submit_email" name="submit_email">Envoyer les invitations</button>