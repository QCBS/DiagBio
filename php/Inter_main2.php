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

include 'Inter_main_php.php';
include '/misc/dbaminfo.php';

?>
	<!--<link href="testing/Jason/css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="testing/Jason/js/jquery-1.10.2.js"></script>
	<script src="testing/Jason/js/jquery-ui-1.10.4.custom.js"></script> -->
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
						<li id="naturetab"><a href="#tab9">Nature dinterdependance</a></li>
						<li id="evaltab"><a href="#tab10">Evaluez Votre Interdependance</a></li>
						<li id="moneytab"><a href="#tab11">Impact Monétaire</a></li>
					</ul>
					<div id="tab1"> <!-- Raw Information Dump from Philippe Auzel's Excel Documents. -->

					<fieldset class="infoList">
					<ul>
						<li>Au cours des 50 dernières années, accélération et une extension du déclin des écosystèmes ces 50 dernières années,</li>
						<li> à un rythme inédit dans l’histoire de l’humanité. Si elle n’est pas maîtrisée, cette dégradation mettra en péril </li>
						<li> non seulement la biodiversité mondiale mais également les activités économiques de la planète.</li>
					</ul>
					</fieldset>

					<fieldset class="infoList"><legend class="font_legend"><b>Objectif de l’outil : Evaluation des interdépendances</b></legend>
							<ul>
								<li>
									Destiné aux <b>organisations</b> qui se préoccupent de leurs <b>interdépendances</b> avec la <b>biodiversité</b>, l’outil vous aidera à les
								</li>
								<li>
								<b>évaluer</b>. Adapté aux organisations québécoises, il doit permettre aux organisations (entreprises, municipalités, etc.) :
								</li>
								<br>
								<ol>
								<li>
									De mieux comprendre vos relations à la Biodiversité et aux SE.
								</li>
								<li>
									De trouver des pistes de réflexion pour la prise de décisions stratégiques interne.
								</li>
								<li>
									D’identifier les risques et opportunités qui découlent de votre dépendance à la biodiversité et aux SE.
								</li>
								<li>
									De gérer les communications avec les parties prenantes à l’externe.
								</li>
								</ol>
							</ul>

					</fieldset>

					
					<div id="imageOne">
						
						<img src="/testing/Jason/images/picWtihPpl.JPG"/>
						<div style="height:25pxpx; width:150px; background-color:white;">
							<b>1. De gérer les communications avec les parties prenantes à l’interne (et externe).</b>
						</div>
					</div>
					<div id="imageTwo">

						<img src="/testing/Jason/images/lightBulb.JPG"/>
						<div style="height:25pxpx; width:150px; background-color:white;">
							<b>2. D’identifier les risques et opportunités qui découlent de votre dépendance à la biodiversité et aux SE.</b>
						</div>
					</div>
					<div id="imageThree">
						<img src="/testing/Jason/images/lightbulbWithFlowers.JPG"/>
						<div style="height:25pxpx; width:150px; background-color:white;">
							<b>3. De trouver des pistes de réflexion pour la prise de décisions stratégiques interne.</b>
						</div>
					</div>
					<div id="imageFour">
						<img src="/testing/Jason/images/bubbles.png"/>
						<div style="height:25pxpx; width:150px; background-color:white;">
							<b>4. De mieux comprendre vos relations à la Biodiversité et aux SE.</b>
						</div>
					</div>

					<div id="makeSpace"></div>

					<fieldset class="infoList"><legend class="font_legend"><b>Description de l’outil</b></legend>

							<ul>
								<li><b>Outil de communication</b> avant tout, l’objectif est de l’outil est de comprendre et évaluer les liens de votre organisation</li>
								<li>vis-à-vis de la biodiversité et de communiquer à ce propos avec les parties prenantes internes à l’organisation. Cette</li>
								<li>approche utilise le référentiel des Services Écosystémiques (SE) qui aborde les questions de biodiversité d’un point de</li>
								<li>vue anthropique, ce qui rend l’exercice accessible à tous. **</li>
								<br>
								<li>Les étapes de l’évaluation sont les suivantes :</li>
								<br>
								<ol>
								<li>Definir l'objectif et la portee du diagnostic.</li>
								<li>Eatblir le portrait du systeme.</li>
								<li>Identifier les interdendances aux BSE.</li>
								<li>Determiner les interdependances principales de l'organisation aux BSE.</li>
								<li>Definir une strategie interne et externe de l'organisation au regard de son interdependance aux BSE.</li>
								<li>Elaborer un plan de gestion des BSE.</li>
								<li>Suivi des indicateurs.</li>
								<li>Revision du processus.</li>
								<br>
								</ol>
							</ul>

							<div id="example">**en savoir plus** <br>
							En effet, la biodiversité et ses interdépendances sont complexes à évaluer pour plusieurs raisons : elles sont difficiles à percevoir,<br>
							 quantifier et mesurer. N’ayant pas encore mis au point de référentiel générique pour mesurer l’ensemble des interactions avec l<br>a <br>
							 biodiversité, les indicateurs nécessaires pour leur évaluation peuvent parfois nécessiter des données délicates à obtenir. <br>
							 Par ailleurs, les indicateurs de biodiversité sont souvent évalués à différentes échelles (gènes, espèces, écosystèmes), et donc,<br> 
							 très nombreux. Enfin, les résultats qu’ils permettent d’obtenir sont souvent plus orientés vers la conservation de la biodiversité <br>
							 que sur son intégration au sein même des organisations (Levrel 2007).<br></div>

					</fieldset>

					<fieldset class="infoList"><legend class="font_legend"><b>Rapports:</b></legend>
						<ul>
							<li>Objectif et portée du diagnostic</li>
							<li>Portrait du système</li>
							<li>Interdépendance BSE</li>
							<li>Responsabilités et dépendances BSE principales</li>
							<li>Strategies interne et externe</li>
							<li>Plan de gestion des dépendances BSE principales</li>
						</ul>
						</fieldset>
					</p>
				</div>
				<div id="tab2"> <!-- Raw Information Dump from Philippe Auzel's Excel Documents. -->

				<fieldset class="infoList"><legend class="font_legend"><b>Ce qu’il faut savoir</b></legend>
				<ul>				
					<li>Les organisations sont largement dépendantes de l’exploitation des services écosystémiques. Or, les biens</li>
					<li>et services que génèrent les écosystèmes ne sont pas pris en compte parce que beaucoup sont considérés comme des</li>
					<li>cadeaux de la nature. Le travail des abeilles par exemple, est très peu valorisé alors que toute l’industrie agroalimentaire</li>
					<li>repose sur la pollinisation. Cela peut représenter une menace importante comme depuis quelques années en Californie, où la</li>
					<li>productivité des producteurs d’amandes, d’avocats et de melons est mise en péril en raison d’un brusque déclin de la population</li>
					<li>d’abeilles pollinisatricesi.</li>
					<br>
					<li>Certes, il existe des marchés pour le bois, le blé et les autres produits cultivés, mais il n’y a pas de marché pour la régulation</li>
					<li>de l’eau par exemple. Effectivement, les bénéfices de ce service sont multiples : les systèmes fluviaux apportent de l’eau douce, de</li>
					<li>l’énergie et dessites propices aux loisirs. Les zones humides littorales, elles, filtrent les pollutions, atténuent les effets des</li>
					<li>inondations et sont des sites de reproduction indispensables aux pêcheries.</li>
					<br>
					<li>La quantité et la qualité des SE se dégradent à grande vitesse sous l’effet des activités humaines (15 des 24</li>
					<li>services écosystémiques évalués dans l’étude se sont détériorés au cours du dernier demi-siècle)(ii) et si</li>
					<li>  l’on ne s’en préoccupe pas, les conséquences seront catastrophiques.</li>
				 	<br>
				 	<li>Grâce à l’outil de diagnostic, nous vous proposons d’évaluer :</li>
					<br>
					<ul>
					<li>L’influence des SE sur les activités de l'entreprise (intrant, force externe affectant la productivité)</li>
					<li>Si les SE donnent lieu à des transactions monétaires.</li>
					<li>L’impact de l'organisation sur la disponibilité du SE (quantité, qualité)</li>
					<li>L’impact de l'organisation sur la capacité d'autres agents à bénéficier du SE (quantité, qualité)</li>
					<li>L’impact global sur la biodiversité lié aux interactions de l'organisation avec <br>
						le SE (continuités écologiques, habitats, espèces — dont la diversité génétique)</li>
					<li>La Biodiversité et les SE imposent des transactions monétaires associées aux impacts (externalités négatives)</li>
					</ul>
				</ul>
				</fieldset>


				<fieldset class="infoList"><legend class="font_legend"><b>Choix du périmètre :</b></legend>
				<ul>				
				<li>La première étape est de définir un périmètre sur lequel portera l’étude. Celui-ci dépend totalement de l’objectif</li>
				<li>de l’étude. Que cherchez-vous à étudier ? Un portait de l’organisation, que ce soit en termes de système ou d’espace </li>
				<li>(site), vous permettra de définir cette question essentielle. Il peut s’agir d’une filiale, d’un segment de l’organisation,</li>
				<li>mais également d’un projet, destiné à un site précis.** Par la suite, les autres participants seront amenés à se questionner</li>
				<li>par rapport au même périmètre, amenant une réflexion entre les parties prenantes internes à l’organisation.</li>
				</ul>
				</fieldset>

				<fieldset class="infoList"><legend class="font_legend"><b>Diagnostic :</b></legend>
				<ul>
					<li>Une fois l’auto-évaluation réalisée par les différents membres de l’organisation, celle-ci obtiendra un diagnostic</li>
					 <li>mettant en perspective la perception de ses parties prenantes internes sur la biodiversité, et représentant le portrait</li>
					  <li>du système. Cela permettra d’identifier les risques et opportunités potentiels liés à ses interdépendances avec la biodiversité.</li>
				</ul>
				</fieldset>

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
					<ol class="selectables" id="selectable">
						<?php


						$query = "SELECT * FROM services_ecologiques order by se_id";
						$results = mysql_query($query) or die('Error Fetching List From Database.');
						while ($row = mysql_fetch_assoc($results)) { 
							?>
							<li class="ui-state-default" title="choisissez une de ces services écologiques" id=<?php echo "\"" . $row['se_id'] . "\"" .$row['se_name'];?>> <?php echo $row['se_name']?></li>
							<?php
						}
						?>
					</ol>

					<?php    

						$query = "SELECT * FROM services_ecologiques order by se_id";
						$results = mysql_query($query) or die('Error Fetching List From Database.');
						while ($row = mysql_fetch_assoc($results))  //create the information blocks for the ecological services
						{ 
							echo '<fieldset class="infoDivs" id="infoDiv'.$row['se_id'].'">'.'<legend class="font_legend"><strong>Description:</strong></legend>'.$row['se_description'].'</fieldset>';
						}

					?>	


					<div class="centreBTN1">
						<button type="button" id="SE_BTN_BACK">Précédent</button> <!--go back to tab 1-->
						<button type="button" id="SE_BTN_NEXT">Suivant</button> <!--go to tab 3-->
					</div>
				
				</div>
				<div id="tab7">
					<h3>Choisissez une de ces classifications</h3>
					<!--10 lists of selectable for differents classification lists-->
					
					
				<?php  


						$query = "SELECT * FROM classification WHERE se_id = '$count'";
						$numOfRows = mysql_query($query) or die('Error Fetching List From Database.');
										
						$count=1;
						while($count <= $numOfRows)		//creates the 10 selectble classifications of examples
						{
									
							echo '<div class="lists" id="list'.$count.'">';
							echo '<ol class="selectable_c" class="selectables" id="selectable'.$count.'">';
							
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

							$query = "SELECT * FROM classification where se_id = $count ";
							$results = mysql_query($query) or die('Error Fetching List From Database.');

							while ($row = mysql_fetch_assoc($results)) 
							{ 
								echo '<fieldset class="infoClassDivs" id="infoClassDiv'.$row['c_id'].'"> <legend class="font_legend"><strong>Description:</strong></legend>'.$row['c_description'].'</fieldset>';  //create the information blocks for the classifications
								echo '<fieldset class="classExampleDivs" id="classExampleDiv'.$row['c_id'].'"><legend class="font_legend"><strong>Example:</strong></legend>'.$row['c_example'].'</fieldset>';  //create the class example divs
							}

							$count++;
						}

					?>
					

					
					<div class="centreBTN1">
						<button type="button" id="C_BTN_BACK">Précédent</button> <!--Go back to tab 2-->
						<button type="button" id="C_BTN_NEXT">Suivant</button> <!--Go to tab 4-->
					</div>
					<div id="hiddenForSpace"></div>
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
						<button type="button" id="TAB9_BTN_NEXT">Suivant</button> <!--go to tab 9 -->
					</div>

					<!--Hidden fields which will be passed along with the HTML elements to next PHP script-->
					<input type="hidden" id="the_report" name="the_report" value=""/>
					<input type="hidden" id="the_user" name="the_user" value="<?php echo $user->uid;?>"/>
					<input type="hidden" id="c_i" name="c_i" value="">
					<input type="hidden" id="hiddenExistingExamples" name="hiddenExistingExamples" value="">
					<input type="hidden" id="hiddenNewExamples" name="hiddenNewExamples" value="">
				</form> 
			</div>


				<div id="tab9">
					<h1 style="color:#0B8EB5;"><b>Nature d'interdependance</b></h1>
					<h4 style="color:#0b8eb5">Choisissez la nature de votre exemple</h4>
					<input type="radio" name="nature" value="Dépendance">Dépendance<br>
					<input type="radio" name="nature" value="Opportunité">Opportunité<br>
					<input type="radio" name="nature" value="Atout">Atout<br>
					<input type="radio" name="nature" value="Dimension monétaire">Dimension monétaire<br><br>

					<!-- <?php 
						//$_SESSION['nature_choice'][$counter] = $_GET['nature']
						//$counter++;
					?> -->

					<button type="button" id="TAB9_BTN_BACK">Précédent</button>  <!-- go to tab 8 -->
					<button type="button" id="TAB10_BTN_NEXT">Suivant</button> <!--go to tab 10 -->
				</div>

				<div id="tab10">
					Evaluez Votre Interdependance
					<select name="slides" id="slides">
				    <option>1</option>
				    <option>2</option>
				    <option>3</option>
				    <option>4</option>
				    <option>5</option>
				  </select>
					<div id="slider" style='width:400px;'></div><br>
					
					<button type="button" id="TAB10_BTN_BACK">Précédent</button>  <!-- go to tab 9 -->
					<button type="button" id="TAB11_BTN_NEXT">Suivant</button> <!--go to tab 11 -->
				</div>
				<div id="tab11">
					Impact Monétaire
					<select name="slides" id="slides">
				    <option>1</option>
				    <option>2</option>
				    <option>3</option>
				    <option>4</option>
				    <option>5</option>
				  </select>
					<div id="sliderMoney"></div><br>
					<button type="button" id="TAB11_BTN_BACK">Précédent</button>  <!-- go to tab 10 -->
				</div>

		</div>	
		<!-- Hidden Container To Generate The Highchart Before Exporting it to The Server. -->
		<div id="barchartFull" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>
		<div id="barchartSmall" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>
		<div id="spiderchartFull" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>
		<div id="spiderchartSmall" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>


