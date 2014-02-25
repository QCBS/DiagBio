<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Evaluez l’interdépendance de votre entreprise</title>
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="http://code.highcharts.com/highcharts-more.js"></script>
		<script src="http://code.highcharts.com/modules/exporting.js"></script>
        <?php 
        	// Add jQuery UI elements from Drupal's core.
			drupal_add_library('system', 'ui');

			// OR only include those u need
			drupal_add_library('system', 'ui.accordion');
			drupal_add_library('system', 'ui.autocomplete');
			drupal_add_library('system', 'ui.button');
			drupal_add_library('system', 'ui.datepicker');
			drupal_add_library('system', 'ui.dialog');
			drupal_add_library('system', 'ui.draggable');
			drupal_add_library('system', 'ui.droppable');
			drupal_add_library('system', 'ui.mouse');
			drupal_add_library('system', 'ui.position');
			drupal_add_library('system', 'ui.progressbar');
			drupal_add_library('system', 'ui.resizable');
			drupal_add_library('system', 'ui.selectable');
			drupal_add_library('system', 'ui.slider');
			drupal_add_library('system', 'ui.sortable');
			drupal_add_library('system', 'ui.tabs');
			drupal_add_library('system', 'ui.widget');

			//drupal_add_css('testing/Jason/css/CSS.css');
            module_load_include('inc', 'profile2_page', 'profile2_page');
        ?>

        <style type="text/css">
			#feedback { font-size: 1.4em; }
			#selectable .ui-selecting { background: #FECA40; }
			#selectable .ui-selected { background: #F39814; color: white; }
			#selectable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
			#selectable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.0em; height: auto; }
			#selectable li span { position: absolute; margin-left: -1.3em; }
        	.text_input_style {margin-bottom:0;}
			.help_text_style {margin-top:0; clear:both; font-size: 0.7em}
        </style>

        <!-- Initialize all jQueryUI Elements. -->
        <?php
			$account = user_load(42);
			$profile = profile2_load_by_user($account);
			$field = field_get_items('profile2', $profile['administration'], 'field_nom_de_l_organisation');

			function user_login_bloc($form) {
			  $form['#action'] = url(current_path(), array('query' => drupal_get_destination(), 'external' => FALSE));
			  $form['#id'] = 'user-login-form';
			  $form['#validate'] = user_login_default_validators();
			  $form['#submit'][] = 'user_login_submit';
			  $form['name'] = array(
			    '#type' => 'textfield',
			    '#title' => t('Username'),
			    '#maxlength' => USERNAME_MAX_LENGTH,
			    '#size' => 15,
			    '#required' => TRUE,
			  );
			  $form['pass'] = array(
			    '#type' => 'password',
			    '#title' => t('Password'),
			    '#size' => 15,
			    '#required' => TRUE,
			  );
			  $form['actions'] = array('#type' => 'actions');
			  $form['actions']['submit'] = array(
			    '#type' => 'submit',
			    '#value' => t('Log in'),
			  );
			  $items = array();
			  /*if (variable_get('user_register', USER_REGISTER_VISITORS_ADMINISTRATIVE_APPROVAL)) {
			    $items[] = l(t('Create new account'), 'user/register', array('attributes' => array('title' => t('Create a new user account.'))));
			  }
			  $items[] = l(t('Request new password'), 'user/password', array('attributes' => array('title' => t('Request new password via e-mail.'))));
			  $form['links'] = array('#markup' => theme('item_list', array('items' => $items)));


				<script type="text/javascript" src="testing/JQueryUIPractice/js/Highcharts.js"></script>
		<script type="text/javascript" src="testing/JQueryUIPractice/js/Highcharts-more.js"></script>
        
			  */
			  return $form;
			}
		?>
        <script type="text/javascript">
        	(function ($) {
				$(document).ready(function() {
					$('#buttonlist').buttonset();
					$('#tabs').tabs();
					$("#selectable").selectable({
						selected: function(event, ui) { 
							$(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
							$( ".ui-selected", this ).each(function() {
								document.getElementById('select-result').value = $(this).attr("id");
							});
						},
						unselecting: function(event, ui) {
							$('#selectable .ui-selected').removeClass('ui-selected');
							document.getElementById('select-result').value = null;
						}
					});
					$('#create_report').button().click(function() {
						var organisationName = <?php echo json_encode($field[0]['value']); ?>; // Parse PHP Variable to Javascript.
						$.post("http://quebio.ca/testing/Jason/php/rapport.php", { orgname: organisationName, adminid: <?php echo "\"" + $account->uid + "\"";?>}, function(data) { alert(data); window.location.replace("http://quebio.ca/entreprisebio/#tab4");});
					});
					$('#delete_report').button().click(function() {
						var reportID = document.getElementById('select-result').value;
						var missingFields = "";

						if ( reportID=="" || reportID=="" ){
							missingFields += "No report were selected.\n";
						}
						if ( missingFields=="" ){
							if ( confirm("Are you sure you wish to delete this report?") )
								$.post("http://quebio.ca/testing/Jason/php/rapport.php", { reportid: reportID}, function(data) { alert(data); window.location.replace("http://quebio.ca/entreprisebio/#tab4");});
						}
						else{
							alert(missingFields);
						}
					});
					$('#view_report').button().click(function() {
							$('#container').highcharts({
							    chart: {
							        polar: true,
							        type: 'line'
							    },
							    
							    title: {
							        text: 'Budget vs spending',
							        x: -80
							    },
							    
							    pane: {
							    	size: '80%'
							    },
							    
							    xAxis: {
							        categories: ['Sales', 'Marketing', 'Development', 'Customer Support', 
							                'Information Technology', 'Administration'],
							        tickmarkPlacement: 'on',
							        lineWidth: 0
							    },
							        
							    yAxis: {
							        gridLineInterpolation: 'polygon',
							        lineWidth: 0,
							        min: 0
							    },
							    
							    tooltip: {
							    	shared: true,
							        pointFormat: '<span style="color:{series.color}">{series.name}: <b>${point.y:,.0f}</b><br/>'
							    },
							    
							    legend: {
							        align: 'right',
							        verticalAlign: 'top',
							        y: 100,
							        layout: 'vertical'
							    },
							    
							    series: [{
							        name: 'Allocated Budget',
							        data: [43000, 19000, 60000, 35000, 17000, 10000],
							        pointPlacement: 'on'
							    }, {
							        name: 'Actual Spending',
							        data: [50000, 39000, 42000, 31000, 26000, 14000],
							        pointPlacement: 'on'
							    }]
							
							});

							var chart = $('#container').highcharts()
						    svg = chart.getSVG();
						    data= ({SVGdata: svg})
						    $.ajax({
						     type: 'POST',
						     data: data,
						     url: 'http://quebio.ca/testing/Jason/php/hcexport.php',
						     async: false,
						     success: function(data){
						     	window.location.replace("http://quebio.ca/testing/Jason/php/tcpdf/examples/example_001.php");
						     }
							});
					});
					$('#viewable_report').button().click(function() {
						var reportID = document.getElementById('select-result').value;
						var missingFields = "";

						if ( reportID=="" || reportID=="" ){
							missingFields += "No report were selected.\n";
						}
						if ( missingFields=="" ){
							$.post("http://quebio.ca/testing/Jason/php/rapport.php", { reportid: reportID, viewable: 1}, function(data) { alert(data); window.location.replace("http://quebio.ca/entreprisebio/#tab4");});
						}
						else{
							alert(missingFields);
						}
					});
					$('#submit_email').button().click(function() {
						var emailRecipient = document.getElementById('recipient').value;
						var information = document.getElementById('information').value;
						var reportID = document.getElementById('select-result').value;
						var organisationName = <?php echo json_encode($field[0]['value']); ?>; // Parse PHP Variable to Javascript.
						var missingFields = "";

						if ( emailRecipient=="" || emailRecipient==null){
							missingFields += "E-mail field is empty.\n";
						}
						if ( reportID=="" || reportID=="" ){
							missingFields += "No report were selected.\n";
						}
						if ( missingFields=="" ){
								$.post("http://quebio.ca/testing/Jason/php/email.php", {reportID: reportID, information: information, orgname: organisationName, toEmail: emailRecipient}, function(data) { alert(data); drupal_mail_send(data); });
						}
						else{
							alert(missingFields);
						}
					});
				});
			})(jQuery); 
        </script>
	</head>
	<body>
		<div id="tabs">
			<ul>
				<li><a href="#tab1">Information</a></li>
				<li><a href="#tab2">Questions à se poser</a></li>
				<li><a href="#tab3">Enregistrement/Identification</a></li>
				<li><a href="#tab4">Creation d'un nouveau rapport</a></li>
			</ul>
			<div id="tab1">
				<h3>Objectif de l'outil:</h3>
				<ol>
					<li>Aider les organisations à mieux comprendre leurs relations à la BSE.</li>
					<li>Guider la prise de décisions stratégiques interne.</li>
					<li>Identifier les risques et opportunités.</li>
					<li>Assister les organisations dans leurs communications avec leurs parties prenantes a l’externes.</li>
				</ol>

				<h3>Organisation de l'outil diagnostic:</h3>
				<ul>
					<li>Definir l'objectif et la portee du diagnostic.</li>
					<li>Eatblir le portrait du systeme.</li>
					<li>Identifier les interdendances aux BSE.</li>
					<li>Determiner les interdependances principales de l'organisation aux BSE.</li>
					<li>Definir une strategie interne et externe de l'organisation au regard de son interdependance aux BSE.</li>
					<li>Elaborer un plan de gestion des BSE.</li>
					<li>Suivi des indicateurs.</li>
					<li>Revision du processus.</li>
				</ul>

				<h3>Rapports:</h3>
				<ul>
					<li>Objectif et portee du diagnostic</li>
					<li>Portrait du systeme</li>
					<li>Interdependance BSE</li>
					<li>Responsabilite et dependances BSE principales</li>
					<li>Strategies interne et et externe</li>
					<li>Plan de gestion des dependances BSE principales</li>
				</ul>
				</p>
			</div>
			<div id="tab2">
				<div style="width: 800px;">
					<div style="float: left; width: 400px;">
						<h3>Organisation de l'outil diagnostic:</h3>
						<ul>
							<li>La B&SE a une influence sur les activités de l'entreprise  (intrant, force externe affectant la productivité)</li>
							<li>La B&SE donne lieu a des transactions monétaires associées aux dépendances (chiffre d'affaires / ventes, dépenses)</li>
							<li>Impact de l'organisation sur la disponibilité du SE (quantité, qualité)</li>
							<li>Impact de l'organisation sur la capacité d'autres agents à bénéficier du SE (quantité, qualité)</li>
							<li>Impact sur la biodiversité liés aux interactions de l'organisation avec le SE (continuités écologiques, habitats, espèces - dont diversité génétique) </li>
							<li>Transactions monétaires associees aux impacts</li>
						</ul>
					</div>
					<div style="float: left; width: 400px;">
						<h3>Organisation de l'outil diagnostic:</h3>
						<ul>
							<li>Influence fonctions prioritaires organisations</li>
							<li>Influence fonctions secondaires de l'organisation</li>
							<li>Existance de couts et/ou transactions monetaires pour beneficier de ce SE</li>
							<li>Ce SE apporte un benefice et/ou une transaction monetaire (chiffre affaire)</li>
							<li>Impact sur un SE qui affecte l'organisation</li>
							<li>Impact sur un SE qui affecte les autres agents</li>
							<li>Interactions positives de l'organisation avec le SE </li>
							<li>interactions negatives de l'organisation avec le SE </li>
							<li>Existance de paiement de compensation</li>
						</ul>
					</div>
					<br style="clear: left;" />
				</div>
			</div>
			<div id="tab3">
				<div style="width: 800px;">
					<div style="float: left; width: 400px;">
						<?php
							global $user;
							if ( user_is_logged_in() ){
								print "<h3>Inscription:</h3>";
								print "<a href=\"http://quebio.ca/administration/register\">Creation D'un Compte Administratif</a>";
								print "<br />";
								print "<a href=\"http://quebio.ca/participant/register\">Creation D'un Compte Participant</a>";
							}
						?>
					</div>
					<div style="float: left; width: 400px;">
						<?php
							print(drupal_render(drupal_get_form('user_login_bloc')));
						?>
					</div>
					<br style="clear: left;" />
				</div>
			</div>
			<div id="tab4">
				<div style="width: 500px; height: 200px; float: left; overflow-y: scroll;">  
					<div id="selectable">
						<?php
							$id = $_GET['reportid'];
        					echo $id;
							// Connect to the Database <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
							$con = mysql_connect('localhost', 'qcbscartographie', 'dsbWVmveVY3Xy4JX') or die('Could Not Connect To The Database.');
							mysql_select_db('qcbscartographie', $con);
							mysql_query("SET NAMES 'utf8");
							mysql_query("SET CHARACTER SET 'utf8'");
							// Get list of all available services
							$query = "SELECT * FROM report";
							$results = mysql_query($query) or die('Error Fetching List From Database.');
							mysql_close($con);
							
							// Display List of Services as S
							while ($row = mysql_fetch_assoc($results)) { 
								if ( $row['Available'] == 0 ){
									$viewability = "Report Viewable by Admin Only";
								}
								else{
									$viewability = "Report Viewable by All Users";	
								}

						?>
							<li class="ui-state-default" style="width: 400px" id=<?php echo "\"" . $row['reportid'] . "\""; ?>><?php echo $row['orgname']; echo " - "; echo $row['date']; echo " - " . $viewability; ?></li>
						<?php
							}
						?>
					</div>
					<input type="hidden" value="" id="select-result">
				</div>  
				<span></span>
				<div style="width: 300px; height: 200px; float: left; margin-left: 10px;">
					<h2>Possible Actions:</h2>
					<button id="create_report" name="create_report" style="margin-bottom: 5px">Create New Report</button>
					<button id="delete_report" name="delete_report" style="margin-bottom: 5px">Delete Report</button>
					<button id="view_report" name="view_report" style="margin-bottom: 5px">View Report</button>
					<button id="viewable_report" name="viewable_report" style="margin-bottom: 5px">Change Report Viewability</button>
				</div>

				<h2>Envoie d'invitation pour participer a une evalution:</h2>
				<input class="text_input_style" type="text" value="" id="recipient">
				<p class="help_text_style">Please use comma to specify multiple recipient (Example: user@example.com, anotheruser@example.com).</p>
				<textarea id="information" row="4" col="50"></textarea>
				<p class="help_text_style">Add any additional information you would like to append to the invitations.</p>
				<button id="submit_email" name="submit_email">Send Invites</button>
			</div>
			<div id="container" style="display:none;width: 700px; height: 400px; margin: 0 auto"></div>
			<div id="disp"></div>
	</body>
</html>