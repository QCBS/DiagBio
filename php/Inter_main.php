<?php 
header("Access-Control-Allow-Origin: *");
        	// Include The Drupal Core jQuery UI Libraries.
/*
drupal_add_library('system', 'ui');
drupal_add_library('system', 'ui.accordion');
drupal_add_library('system', 'ui.autocomplete');
drupal_add_library('system', 'ui.button');
drupal_add_library('system', 'ui.datepicker');
drupal_add_library('system', 'ui.dialog');
drupal_add_library('system', 'ui.draggable');
drupal_add_library('system', 'ui.droppable');
drupal_add_library('system', 'ui.mouse');
drupal_add_library('system', 'ui.position');
drupal_add_library('system', 'ui.resizable');
drupal_add_library('system', 'ui.selectable');
drupal_add_library('system', 'ui.slider');
drupal_add_library('system', 'ui.sortable');
drupal_add_library('system', 'ui.tabs');
drupal_add_library('system', 'ui.widget');
*/


// Include The Drupal Profile2 Module to Load Profile2 Related Data.
module_load_include('inc', 'profile2_page', 'profile2_page');
drupal_add_js("http://code.highcharts.com/highcharts.js");
drupal_add_js("http://code.highcharts.com/highcharts-more.js");
drupal_add_js("evaluationbse/js/Inter_main.js");
drupal_add_js("evaluationbse/js/diagbio.map.js");
drupal_add_js('http://maps.google.com/maps/api/js?sensor=false');
drupal_add_css('evaluationbse/css/CSS.css');
drupal_add_js("http://code.highcharts.com/modules/exporting.js");
drupal_add_js("http://code.jquery.com/jquery-migrate-1.2.1.js");
drupal_add_js("https://code.jquery.com/ui/1.10.2/jquery-ui.min.js");

include('Inter_main_php.php');
include('/var/www/quebio.ca/misc/dbaminfo.php');

?>
	<div id="accinfo">
		<input type="hidden" id="userRole" name="userRole" value=<?php echo json_encode($role); ?>>
		<input type="hidden" id="OrgaName" value=<?php echo json_encode($field[0]['value']); ?>>
		<input type="hidden" id="AdminID" value="<?php echo "\"" + $account->uid + "\"";?>">
	</div>
	<div id="tabs" style="min-height:500px;">
		<ul>
			<li id="info"><a href="#tab1">Information</a></li>
			<li id="question"><a href="#tab2">Questions à se poser</a></li>
			<li id="login"><a href="#tab3">Enregistrement/Identification</a></li>
			<li id="admintools"><a href="#tab4">Outils d'administration</a></li>
			<li id="parametertab"><a href="#tab14">Objectif et périmètre</a></li>
			<li id="userview"><a href="#tab5">Évaluations</a></li>
			<li id="infoForUser"><a href="#tab19">Objectifs de l'évaluation</a></li>
			<li id="entreprisetab"><a href="#tab_eval">Analyse de l'entreprise</a></li>
			<!--<li id="viewOpinions"><a href="#tab17">Gestion des données</a></li>
			<li id="adminOpinion"><a href="#tab18">Planification</a></li>-->
		</ul>
		<div id="tab1" class="tabcontent">
		</div>
		<div id="tab2" class="tabcontent">
		</div>
		<div id="tab3">
		<?php include 'tabs/tab3.php' ?>
		</div>
		<div id="tab4" class="tabcontent">
		</div>
		<div id="tab14" class="tabcontent">
		</div>
		<div id="tab5" class="tabcontent">
		</div>
		<div id="tab19" class="tabcontent">
		</div>
		<div id="tab_eval" class="tabcontent">
		</div>
		<div id="tab18" >
		</div>
	<?php 
	mysql_close($con);
	?>
</div>	

<input type="hidden" id="the_report" name="the_report" value=""/>
<input type="hidden" id="the_user" name="the_user" value="<?php echo $user->uid;?>"/>


<!-- Hidden Container To Generate The Highchart Before Exporting it to The Server. -->
<div id="money_ranking" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>
<div id="average_ranking_se" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>
<div id="impacts_avg" style="position:absolute; display:none;width: 800px; height: 800px; margin: 0 auto;"></div>
<div id="impacts_pot" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>
<div id="dependance_avg" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>
<div id="dependance_pot" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>
<div id="money_detail" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>
<div id="Operations" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>
<div id="Operations_par_se" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>