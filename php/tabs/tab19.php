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

if (isset($reportid)){
	$query = "SELECT orgname FROM report WHERE reportid = '$reportid'";
	$result = mysql_query($query) or die('Error Fetching List From Database.');
	$fetch=mysql_fetch_array($result);
	$orgname=$fetch['orgname'];
	$query = "SELECT objective, limits, circonscription, perimeter, represent, fonction, function_text, pre_circonscription FROM outil_parameter WHERE r_id = '$reportid'";
	$result = mysql_query($query) or die('Error Fetching List From Database.');
	$fetch=mysql_fetch_array($result);
	$objective=$fetch['objective'];
	$limits=$fetch['limits'];
	$circonscription=$fetch['circonscription'];
	$represent=$fetch['represent'];
	$fonction=$fetch['fonction'];
	$function_text=$fetch['function_text'];
	$pre_circonscription=$fetch['pre_circonscription'];
	$perimeter=$fetch['perimeter'];
} else{

}
?>	

<div class="centreBTN2">
	<!--<button type="button" id="theNewExample">Inserer un nouvel exemple</button><br><br> button which insert a new interdependance example-->
	<!--<input id="submit" type="submit" value="Enregistrer vos données"> POST BACK-->
	<button type="button" id="TAB19_BTN_BACK">Choisir une autre évaluation</button>  <!--Go back to tab 3-->
	<button type="button" id="TAB19_BTN_NEXT">Commencer cette évaluation</button> <!--go to tab 9 -->
</div>

<fieldset class="infoList"><legend class="font_legend"><b>Nom de l'organisation évaluée</b></legend>
	<?php echo $orgname; ?>
</fieldset>

<fieldset  class="infoList"><legend class="font_legend"><b>Objectif(s)</b></legend>
	<?php echo $objective;  ?>
</fieldset><br>

<fieldset class="infoList"><legend class="font_legend"><b>Limites</b></legend>
	<?php echo $limits; ?>
</fieldset><br>

<fieldset  class="infoList"><legend class="font_legend"><b>Circonscription du périmètre d’analyse: <?php echo $pre_circonscription.', '.$circonscription; ?></b></legend>
	<?php echo $represent;  ?>
</fieldset><br>

<input type="hidden" name="geography1" id="geography1" value='<?php echo $perimeter;?>'>
<div id="map1" style="width:800px !important;height:500px !important;margin:10px 0 15px 0;"></div>        

<fieldset  class="infoList"><legend class="font_legend"><b>fonction: <?php echo $fonction; ?></b></legend>
	<?php echo $function_text;  ?>
</fieldset><br>
