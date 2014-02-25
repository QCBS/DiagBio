<?php 
        	// Include The Drupal Core jQuery UI Libraries.
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
drupal_add_library('system', 'ui.progressbar');
drupal_add_library('system', 'ui.resizable');
drupal_add_library('system', 'ui.selectable');
drupal_add_library('system', 'ui.slider');
drupal_add_library('system', 'ui.sortable');
drupal_add_library('system', 'ui.tabs');
drupal_add_library('system', 'ui.widget');

// Include The Drupal Profile2 Module to Load Profile2 Related Data.
module_load_include('inc', 'profile2_page', 'profile2_page');
drupal_add_js("http://code.highcharts.com/highcharts.js");
drupal_add_js("http://code.highcharts.com/highcharts-more.js");
drupal_add_js("http://code.highcharts.com/modules/exporting.js");
drupal_add_js("testing/Jason/js/Inter_main.js");

drupal_add_css('testing/Jason/css/CSS.css');
?>

<?php
			// This is The Default Drupal Login Block Form With The Links to Normal Account Registration Removed.
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

	return $form;
}

function getRole($data){
	if ( $data[6] != null ) {
		return "Administration";
	}
	else
		if ( $data[5] != null ) {
			return "Participant";
		}

		return "Unauthenticated";
	}

	global $user;

			$account = user_load($user->uid); // Load Themporary User with "Administration" Role.
			$role = getRole($account->roles);
			
			if ( $role == "Administration" ){
				$profile = profile2_load_by_user($account); // Load The Profile2 Data Associated to The User.
				$field = field_get_items('profile2', $profile['administration'], 'field_nom_de_l_organisation'); // Get The Organisation Name From the Profile2 Data.
			}
			

?>

			<body>
				<div id="accinfo">
				<input type="hidden" id="userRole" value=<?php echo json_encode($role); ?>>
				<input type="hidden" id="OrgaName" value=<?php echo json_encode($field[0]['value']); ?>>
				<input type="hidden" id="AdminID" value="<?php echo "\"" + $account->uid + "\"";?>">
			</div>
				<div id="tabs">
					<ul>
						<li id="info"><a href="#tab1">Information</a></li>
						<li id="question"><a href="#tab2">Questions à se poser</a></li>
						<li id="login"><a href="#tab3">Enregistrement/Identification</a></li>
						<li id="admintools"><a href="#tab4">Outils d'administration</a></li>
						<li id="userview"><a href="#tab5">Liste de rapports</a></li>
						<li id="servicetab"><a href="#tab6">Services Écologiques</a></li>
						<li id="classificationtab"><a href="#tab7">Classification</a></li>
						<li id="entreprisetab"><a href="#tab8">Analysez votre entreprise</a></li>
					</ul>
					<div id="tab1"> <!-- Raw Information Dump from Philippe Auzel's Excel Documents. -->
						<h3>Objectifs de l'outil:</h3>
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
							<li>Objectif et portée du diagnostic</li>
							<li>Portrait du système</li>
							<li>Interdépendance BSE</li>
							<li>Responsabilités et dépendances BSE principales</li>
							<li>Strategies interne et externe</li>
							<li>Plan de gestion des dépendances BSE principales</li>
						</ul>
					</p>
				</div>
				<div id="tab2"> <!-- Raw Information Dump from Philippe Auzel's Excel Documents. -->
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
								// Display The link For Creating Accounts.
							print "<h3>Inscription:</h3>";
							print "<a href=\"http://quebio.ca/administration/register\">Creation d'un compte administrateur</a>";
							print "<br />";
							print "<a href=\"http://quebio.ca/participant/register\">Creation d'un compte participant</a>";
							?>
						</div>
						<div style="float: left; width: 400px;">
							<?php
							// Display Login Block For Users to Login.
							print(drupal_render(drupal_get_form('user_login_bloc'))); // Get Modfified Login Block Called at The Top of The Script.
							?>
						</div>
						<br style="clear: left;" />
					</div>
				</div>
				<div id="tab4">
					<div style="width: 500px; height: 200px; float: left; overflow-y: scroll;">  
						<div id="selectableadmin">
							<?php
							// Temporary Data -IGNORE
							$id = $_GET['reportid']; // Making Sure The URL Links in The E-mails Were Properly Formated.
							echo $id;
							$con = mysql_connect('localhost', 'qcbscartographie', 'dsbWVmveVY3Xy4JX') or die('Could Not Connect To The Database.');
							mysql_select_db('qcbscartographie', $con);
							mysql_query("SET NAMES 'utf8");
							mysql_query("SET CHARACTER SET 'utf8'");
							// Get list of all available services
							$query = "SELECT * FROM report WHERE adminid = '$user->uid' ORDER BY date";
							$results = mysql_query($query) or die('Error Fetching List From Database.');
							
							// Display List of Services as S
							while ($row = mysql_fetch_assoc($results)) { // Display The Proper View Setting.
								if ( $row['Available'] == 0 ){
									$viewability = "Rapport visible par l'administrateur uniquement";
								}
								else{
									$viewability = "Rapport visible par tous les participants";	
								}

								?> 	<!-- Each Report List Item Has its ID as the Report ID Fetched From The Database. -->
								<li class="ui-state-default" style="width: 400px" value=<?php echo "\"" . $row['adminid'] . "\""; ?> id=<?php echo "\"" . $row['reportid'] . "\""; ?>><?php echo $row['orgname']; echo " - "; echo $row['date']; echo " - " . $viewability; ?></li>
								<?php
							}
							?>
						</div>
						<input type="hidden" value="" id="select-resultadmin"> <!-- Stores The Currently Selected Report ID -->
					</div>  
					<span></span>
					<div style="width: 300px; height: 200px; float: left; margin-left: 10px;">
						<h2>Actions possibles:</h2> <!-- All The Buttons That Are Used By The Admin -->
						<button id="create_report" name="create_report" style="margin-bottom: 5px">Création d'un nouveau rapport</button>
						<button id="delete_report" name="delete_report" style="margin-bottom: 5px">Supprimer un rapport</button>
						<button id="view_report" name="view_report" style="margin-bottom: 5px">Voir le rapport</button>
						<button id="viewable_report" name="viewable_report" style="margin-bottom: 5px">Changer la visibilité du rapport</button>
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
				</div>
				<div id="tab5">
					<div style="width: 800px;">
						<div id="selectable0" style="width: 500px; height: 200px; float: left; overflow-y: scroll;">	
							<?php
							$query = "SELECT * FROM report WHERE reportid IN (SELECT r_id FROM interdependances WHERE u_id=".$user->uid.")";//query statement--->gets the all the reports id
							$results = mysql_query($query) or die('Error Fetching List From Database.');
							
							while ($row = mysql_fetch_assoc($results)) { // Display The Proper View Setting.
								if ( $row['Available'] == 0 ){
									$viewability = "Rapport visible par l'administrateur seulement";
								}
								else{
									$viewability = "Rapport visible par tous les participants";	
								}
								?>
								<!--populating the selectable list with values fetched from database -->
								<li class="ui-state-default" style="width: 400px" value=<?php echo "\"" . $row['adminid'] . "\""; ?> id=<?php echo "\"" . $row['reportid'] . "\""; ?>><?php echo $row['orgname']; echo " - "; echo $row['date']; echo " - " . $viewability; ?></li>
								<?php

							}
							?>
						</div>
						<div style="float: left; width: 200px; margin-left: 10px;">
							<h3>Un nouveau rapport</h3>
							<input type="text" id="new_report" name="new_report" style="width: 204px" title="Entre un nouveau numéro de rapport" value=""/>
						</div>
						<button type="button" id="NEW_RE_BTN">Répondez à ce rapport</button>
						<br style="clear: left;" />
					</div>
					<div class="centreBTN3">
						<button type="button" id="RE_BTN_NEXT">Suivant</button> <!--go to tab 2-->
					</div>
				</div>
				<div id="tab6">	
					<h3>Choisissez un de ces services écologiques</h3>
					<ol id="selectable">
						<?php
						$query = "SELECT * FROM services_ecologiques order by se_id";
						$results = mysql_query($query) or die('Error Fetching List From Database.');
						while ($row = mysql_fetch_assoc($results)) { 
							?>
							<li class="ui-state-default" title="choisissez une de ces services écologiques" id=<?php echo "\"" . $row['se_id'] . "\""; ?>><?php echo $row['se_name'];?></li>
							<?php
						}
						?>
					</ol>	
					<div class="centreBTN1">
						<button type="button" id="SE_BTN_BACK">Précédent</button> <!--go back to tab 1-->
						<button type="button" id="SE_BTN_NEXT">Suivant</button> <!--go to tab 3-->
					</div>
				</div>
				<div id="tab7">
					<h3>Choisissez une de ces classifications</h3>
					<!--10 lists of selectable for differents classification lists-->
					
					
				<?php  
										
						$count=1;
						while($count <= 10)		//creates the 10 selectble classifications of examples
						{
									
							echo '<div id="list'.$count.'">';
							echo '<ol id="selectable'.$count.'">';
						
							$query = "SELECT * FROM classification WHERE se_id = '$count'";
							$results = mysql_query($query) or die('Error Fetching List From Database.');

							while ($row = mysql_fetch_assoc($results)) 
							{ 
				?>
								<li class="ui-state-default" title="choisissez une de ces classifications" id=<?php echo "\"" . $row['c_id'] . "\""; ?>><?php echo $row['c_name'];?></li>
							<?php
							}
							?>
						</ol>
					</div>
					
					
					<?php 
									$count++;
								}
					?>					
					
					
					
					<!--
					<div id="list1">
						<ol id="selectable1">
							<?php
							$query = "SELECT * FROM classification WHERE se_id = 1";
							$results = mysql_query($query) or die('Error Fetching List From Database.');

							while ($row = mysql_fetch_assoc($results)) { 
								?>
								<li class="ui-state-default" title="choisissez une de ces classifications" id=<?php echo "\"" . $row['c_id'] . "\""; ?>><?php echo $row['c_name'];?></li>
								<?php
							}
							?>
						</ol>
					</div>
					<div id="list2">
						<ol id="selectable2">
							<?php
							$query = "SELECT * FROM classification WHERE se_id = 2";
							$results = mysql_query($query) or die('Error Fetching List From Database.');

							while ($row = mysql_fetch_assoc($results)) { 
								?>
								<li class="ui-state-default" title="choisissez une de ces classifications" id=<?php echo "\"" . $row['c_id'] . "\""; ?>><?php echo $row['c_name'];?></li>
								<?php

							}
							?>
						</ol>
					</div>
					<div id="list3">
						<ol id="selectable3">
							<?php
							$query = "SELECT * FROM classification WHERE se_id = 3";
							$results = mysql_query($query) or die('Error Fetching List From Database.');

							while ($row = mysql_fetch_assoc($results)) { 
								?>
								<li class="ui-state-default" title="choisissez une de ces classifications" id=<?php echo "\"" . $row['c_id'] . "\""; ?>><?php echo $row['c_name'];?></li>
								<?php

							}
							?>
						</ol>
					</div>
					<div id="list4">
						<ol id="selectable4">
							<?php
							$query = "SELECT * FROM classification WHERE se_id = 4";
							$results = mysql_query($query) or die('Error Fetching List From Database.');


							while ($row = mysql_fetch_assoc($results)) { 
								?>
								<li class="ui-state-default" title="choisissez une de ces classifications" id=<?php echo "\"" . $row['c_id'] . "\""; ?>><?php echo $row['c_name'];?></li>
								<?php

							}
							?>
						</ol>
					</div>
					<div id="list5">
						<ol id="selectable5">
							<?php
							$query = "SELECT * FROM classification WHERE se_id = 5";
							$results = mysql_query($query) or die('Error Fetching List From Database.');


							while ($row = mysql_fetch_assoc($results)) { 
								?>
								<li class="ui-state-default" title="choisissez une de ces classifications" id=<?php echo "\"" . $row['c_id'] . "\""; ?>><?php echo $row['c_name'];?></li>
								<?php

							}
							?>
						</ol>
					</div>
					<div id="list6">
						<ol id="selectable6">
							<?php
							$query = "SELECT * FROM classification WHERE se_id = 6";
							$results = mysql_query($query) or die('Error Fetching List From Database.');


							while ($row = mysql_fetch_assoc($results)) { 
								?>
								<li class="ui-state-default" title="choisissez une de ces classifications" id=<?php echo "\"" . $row['c_id'] . "\""; ?>><?php echo $row['c_name'];?></li>
								<?php

							}
							?>
						</ol>
					</div>
					<div id="list7">
						<ol id="selectable7">
							<?php
							$query = "SELECT * FROM classification WHERE se_id = 7";
							$results = mysql_query($query) or die('Error Fetching List From Database.');


							while ($row = mysql_fetch_assoc($results)) { 
								?>
								<li class="ui-state-default" title="choisissez une de ces classifications" id=<?php echo "\"" . $row['c_id'] . "\""; ?>><?php echo $row['c_name'];?></li>
								<?php

							}
							?>
						</ol>
					</div>
					<div id="list8">
						<ol id="selectable8">
							<?php
							$query = "SELECT * FROM classification WHERE se_id = 8";
							$results = mysql_query($query) or die('Error Fetching List From Database.');


							while ($row = mysql_fetch_assoc($results)) { 
								?>
								<li class="ui-state-default" title="choisissez une de ces classifications" id=<?php echo "\"" . $row['c_id'] . "\""; ?>><?php echo $row['c_name'];?></li>
								<?php

							}
							?>
						</ol>
					</div>
					<div id="list9">
						<ol id="selectable9">
							<?php
							$query = "SELECT * FROM classification WHERE se_id = 9";
							$results = mysql_query($query) or die('Error Fetching List From Database.');


							while ($row = mysql_fetch_assoc($results)) { 
								?>
								<li class="ui-state-default" title="choisissez une de ces classifications" id=<?php echo "\"" . $row['c_id'] . "\""; ?>><?php echo $row['c_name'];?></li>
								<?php

							}
							?>
						</ol>
					</div>
					<div id="list10">
						<ol id="selectable10">
							<?php
							$query = "SELECT * FROM classification WHERE se_id = 10";
							$results = mysql_query($query) or die('Error Fetching List From Database.');


							while ($row = mysql_fetch_assoc($results)) { 
								?>
								<li class="ui-state-default" title="choisissez une de ces classifications" id=<?php echo "\"" . $row['c_id'] . "\""; ?>><?php echo $row['c_name'];?></li>
								<?php

							}
							?>
						</ol>
					</div>
					-->
					<div class="centreBTN1">
						<button type="button" id="C_BTN_BACK">Précédent</button> <!--Go back to tab 2-->
						<button type="button" id="C_BTN_NEXT">Suivant</button> <!--Go to tab 4-->
					</div>
				</div>
				<div id="tab8">
					<form id="the_form" action="http://www.quebio.ca/testing/Jason/php/formSubmit.php" method="get" >
						<div id="theFirstGroup"> <!-- div which contains all the HTML element createdz-->


						</div>
						<div id="divDD" class="centreBTN2">
						</div>
						<div id="dd_btn" class="centreBTN2">
							<button type="button" id="theExistingExample">Choisir cette exemple</button><br><br>
						</div>

						<?php	
					mysql_close($con); // close the database connection 
					?>	
					<div id="theSecondGroup"> <!-- div which contains all the HTML element created-->

					</div>

					<div class="centreBTN2">
						<button type="button" id="theNewExample">Inserer un nouvel exemple</button><br><br> <!--button which insert a new interdependance example-->
						<input id="submit" type="submit" value="Enregistrer vos données"> <!--POST BACK--><br><br>
						<button type="button" id="LAST_BTN_BACK">Précédent</button>  <!--Go back to tab 3-->
						<button type="button" id="BTN_RE_SE">Retourner aux services écologiques</button>
						<button type="button" id="BTN_QUIT">Quitter</button>
					</div>

					<!--Hidden fields which will be passed along with the HTML elements to next PHP script-->
					<input type="hidden" id="the_report" name="the_report" value=""/>
					<input type="hidden" id="the_user" name="the_user" value="<?php echo $user->uid;?>"/>
					<input type="hidden" id="c_i" name="c_i" value="">
					<input type="hidden" id="hiddenExistingExamples" name="hiddenExistingExamples" value="">
					<input type="hidden" id="hiddenNewExamples" name="hiddenNewExamples" value="">
				</form> 
			</div>
		</div>	
		<!-- Hidden Container To Generate The Highchart Before Exporting it to The Server. -->
		<div id="barchartFull" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>
		<div id="barchartSmall" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>
		<div id="spiderchartFull" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>
		<div id="spiderchartSmall" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>
