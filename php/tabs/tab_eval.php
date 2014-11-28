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
<form id="the_form" action="formSubmit.php" method="POST" >
<input type="hidden" id="userRole2" name="userRole2" value=<?php echo json_encode($role); ?>>
<div id="evaltabs" style="min-height:500px;">
	<ul>
		<li id="servicetab"><a href="#tab6">Services écologiques</a></li>
		<li id="classificationtab"><a href="#tab7">Classification</a></li>	
		<li id="exampletab"><a href="#tab8">Exemple</a></li>
		<li id="naturetab"><a href="#tab9">Nature d'interdépendance</a></li>
		<li id="qualifytab"><a href="#tab15">Qualifier l’impact</a></li>
		<li id="dependencetab"><a href="#tab11">Qualifier l’interdépendance</a></li>
		<li id="impacttab"><a href="#tab12">Niveau d'impact</a></li>
		<li id="moneytab"><a href="#tab13">Impact monétaire</a></li>
		<li id="risktab"><a href="#tab10">Processus affectés</a></li>
		<li id="sendData"><a href="#tab16">Enregistrer vos données</a></li>
	</ul>
	<div id="tab6">
	<?php include 'tab6.php'; ?>
	</div>
	<div id="tab7">
	<?php include 'tab7.php'; ?>
	</div>
	<div id="tab8">
	<?php include 'tab8.php'; ?>
	</div>
	<div id="tab9">
	<?php include 'tab9.php'; ?>
	</div>
	<div id="tab15" >
	<?php include 'tab15.php'; ?>
	</div>
	<div id="tab11" >
	<?php include 'tab11.php'; ?>
	</div>
	<div id="tab12" >
	<?php include 'tab12.php'; ?>
	</div>
	<div id="tab13" >
	<?php include 'tab13.php'; ?>
	</div>
	<div id="tab10" class="ui-state-hidden">
	<?php include 'tab10.php'; ?>
	</div>
	<div id="tab16" >
	<?php include 'tab16.php';?>
	</div>
</div>	
</form>