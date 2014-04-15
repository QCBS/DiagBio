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
drupal_add_js("testing/Jason/js/Inter_main.js");

drupal_add_css('testing/Jason/css/CSS.css');
drupal_add_js("http://code.highcharts.com/modules/exporting.js");

include('Inter_main_php.php');
include('/var/www/quebio.ca/misc/dbaminfo.php');

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
						<li id="parametertab"><a href="#tab14">Objectif et périmètre</a></li>
						<li id="userview"><a href="#tab5">Liste de rapports</a></li>
						<li id="servicetab"><a href="#tab6">Services Écologiques</a></li>
						<li id="classificationtab"><a href="#tab7">Classification</a></li>	
						<li id="entreprisetab"><a href="#tab8">Analysez votre entreprise</a></li>
						<li id="naturetab"><a href="#tab9">Nature dinterdependance</a></li>
						<li id="qualifytab"><a href="#tab15">Qualifier l’interdépendance aux BSE</a></li>
						<li id="dependencetab"><a href="#tab11"></a>Evaluez Votre Interdependance</li>
						<li id="impacttab"><a href="#tab12">Niveau d'Impact</a></li>
						<li id="moneytab"><a href="#tab13">Impact Monétaire</a></li>
						<li id="risktab"><a href="#tab10">Risques et Opportunités</a></li>
					</ul>
					<div id="tab1"> <!-- Raw Information Dump from Philippe Auzel's Excel Documents. -->

					<fieldset class="infoList">
					<ul>
						<li>	Au cours des 50 dernières années, accélération et une extension du déclin des écosystèmes ces 50 dernières</li>
						<li>années, à un rythme inédit dans l’histoire de l’humanité. Si elle n’est pas maîtrisée, cette dégradation mettra en péril</li>
						<li>non seulement la biodiversité mondiale, mais également les activités économiques de la planète.</li>
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
							<b>4. De gérer les communications avec les parties prenantes à l’interne (et externe).</b>
						</div>
					</div>
					<div id="imageTwo">

						<img src="/testing/Jason/images/lightBulb.JPG"/>
						<div style="height:25pxpx; width:150px; background-color:white;">
							<b>3. D’identifier les risques et opportunités qui découlent de votre dépendance à la biodiversité et aux SE.</b>
						</div>
					</div>
					<div id="imageThree">
						<img src="/testing/Jason/images/lightbulbWithFlowers.JPG"/>
						<div style="height:25pxpx; width:150px; background-color:white;">
							<b>2. De trouver des pistes de réflexion pour la prise de décisions stratégiques interne.</b>
						</div>
					</div>
					<div id="imageFour">
						<img src="/testing/Jason/images/bubbles.png"/>
						<div style="height:25pxpx; width:150px; background-color:white;">
							<b>1. De mieux comprendre vos relations à la Biodiversité et aux SE.</b>
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

							<div id="tabs-2">
  								<ul>
    							<li><a href="#example">En savoir plus</a></li>
    							</ul>
							<div id="example"><br>
								Parler de biodiversité, c’est avant tout s’intéresser aux  relations qu’entretiennent les espèces (dont l’espèce humaine), entre<br>
							    elles, et avec les milieux physiques et chimiques. Pour prendre en compte la biodiversité il faut donc s’intéresser aux <br>
							    interactions entre le vivant et le non vivant. La biodiversité ne relève pas uniquement du descriptif, mais bien du fonctionnel <br>
							    et c’est pourquoi elle est si difficile à évaluer.  Ces interdépendances sont difficiles à percevoir, quantifier et mesurer. Par<br>
							    ailleurs, les indicateurs de biodiversité sont souvent évalués à différentes échelles (gènes, espèces, écosystèmes), et donc,<br>
							    très nombreux. C’est pourquoi les scientifiques ont élaborés le concept des « services écologiques » (SE)[1, particulièrement<br>
							    utile pour illustrer l’interdépendance du social et de l’économique avec le monde vivant. Les SE sont les bénéfices que nous<br>
							    retirons du fonctionnement des écosystèmes. Ils sont issus de la biodiversité mais surtout des processus écologiques<br>
							    issus des interactions entre les espèces et dont différents acteurs économiques peuvent retirer des services écologiques.<br>
							</div>
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
							$con = mysql_connect($mys_host, $mys_username, $mys_pass) or die('Could Not Connect To The Database.');
							mysql_select_db($mys_base, $con);
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
					<h3>Choisissez un groupe de services écosystémiques :</h3>

					<ol class="selectables" id="selectable">	
						<?php
						$query = "SELECT * FROM services_ecologiques order by se_id";
						$results = mysql_query($query) or die('Error Fetching List From Database.');
						while ($row = mysql_fetch_assoc($results)) { 

							if($row['se_id'] <= 3 )
							{
								if ($row['se_id'] == 1)
									echo '<h3>Services d’approvisionnement<br></h3>';
							?>
								<li class="ui-state-default" title="choisissez une de ces services écologiques" id=<?php echo "\"" . $row['se_id'] . "\"" .$row['se_name'];?>> <?php echo $row['se_name']?></li>
							<?php
							}
							if($row['se_id'] <= 7 && $row['se_id'] >= 4 ){
								if ($row[se_id] == 4) {
									echo '<h3>Services de régulation<br></h3>';
								}
							?>
								<li class="ui-state-default" title="choisissez une de ces services écologiques" id=<?php echo "\"" . $row['se_id'] . "\"" .$row['se_name'];?>> <?php echo $row['se_name']?></li>
							<?php
							}
							if($row['se_id'] <= 13 && $row['se_id'] > 9 ){
								if ($row[se_id] == 11) {
									echo '<h3>Services culturels<br></h3>';
								}
							?>	
								<li class="ui-state-default" title="choisissez une de ces services écologiques" id=<?php echo "\"" . $row['se_id'] . "\"" .$row['se_name'];?>> <?php echo $row['se_name']?></li>
							<?php
							}
							if($row['se_id'] == 14 ){
							?>
								<br>
								<br>
								<h3>Ressources naturelles<br></h3>
								<li class="ui-state-default" title="choisissez une de ces services écologiques" id=<?php echo "\"" . $row['se_id'] . "\"" .$row['se_name'];?>> <?php echo $row['se_name']?></li>
							<?php
							}
						}
						?>
					</ol>

					<?php    

						$query = "SELECT * FROM services_ecologiques order by se_id";
						$results = mysql_query($query) or die('Error Fetching List From Database.');
						while ($row = mysql_fetch_assoc($results))  //create the information blocks for the ecological services
						{ 
							echo '<fieldset class="infoDivs" id="infoDiv'.$row['se_id'].'">'.'<legend class="font_legend"><strong>Description</strong></legend>'.$row['se_description'].'</fieldset>';
						}

					?>	
					<input type="hidden" id="se_i" name="se_i" value="">

					<div class="centreBTN1">
						<button type="button" id="SE_BTN_BACK">Précédent</button> <!--go back to tab 1-->
						<button type="button" id="SE_BTN_NEXT">Suivant</button> <!--go to tab 3-->
					</div>
				
				</div>
				<div id="tab7">
					<!--10 lists of selectable for differents classification lists-->
					<h3>Choisissez une de ces classifications</h3>
					
				<?php  
						$query = "SELECT * FROM classification WHERE se_id = '$count'";
						$numOfRows = mysql_query($query) or die('Error Fetching List From Database.');
										
						$count=1;
						while($count <= $numOfRows)		//creates the selectble classifications 
						{
									
							echo '<div class="lists" id="list'.$count.'">';
							echo '<ol class="selectable_c" class="selectables" id="selectable'.$count.'">';
							
							$query = "SELECT * FROM classification WHERE se_id = '$count'";
							$results = mysql_query($query) or die('Error Fetching List From Database.');

							while ($row = mysql_fetch_assoc($results)) 
							{ 
								if($row['c_name'] == "Substances nutritionnelles")
								{
									echo '<h4>Ressources naturelles non issues du vivant</h4>'; 
									echo 'Les minéraux, substances nutritionnelles et énergie renouvelable nous sont<br>
									 	  bénéfiques mais ne sont pas issus du vivant et ne peuvent donc pas être <br>
									 	  considérés comme des services écosystémiques. Cependant, ils ont un rôle<br>
									 	  à jouer pour la biodiversité et sont donc à prendre en compte lors de<br>
									 	  l’évaluation.<br><br>';
								}

								if($row['c_name'] == "Énergie non renouvelable abiotique")
								{
									echo '<br><br><h4>Ressources naturelles issues du vivant</h4>';
									echo 'Les ressources naturelles issues du vivant sont le résultat des interactions<br>';
									echo 'entre les différents éléments de la biodiversité et donc du vivant. Par<br>'; 
									echo 'exemple, le pétrole n’est pas en soi un SE, mais plutôt le résultat des<br>';
									echo 'processus de décomposition, de stockage et d’assimilation, propre aux<br>';
									echo 'écosystèmes. Son extraction et la consommation de pétrole font pression<br>';
									echo 'sur le service : régulation de la qualité de l’air. <br><br>';
								}
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
							
						$counter=1;

						while($counter <= $numOfRows)		//creates the descriptions and example blocks
						{
							$query = "SELECT * FROM classification where se_id = $counter ";
							$results = mysql_query($query) or die('Error Fetching List From Database.');
							
							while ($row = mysql_fetch_assoc($results)) 
							{	echo '<div class="infoAndExamples">';
								echo '<div><fieldset class="infoClassDivs" id="infoClassDiv'.$row['c_id'].'"> <legend class="font_legend"><strong>Description</strong></legend>'.$row['c_description'].'</fieldset></div>';  //create the information blocks for the classifications
								echo '<div><fieldset class="classExampleDivs" id="classExampleDiv'.$row['c_id'].'"><legend class="font_legend"><strong>Exemple</strong></legend>'.$row['c_example'].'</fieldset></div>';  //create the class example divs
								echo '</div>';
							}
							$counter++;
						}

					?>


					<br>
					<div class="centreBTN1">
						<button type="button" id="C_BTN_BACK">Précédent</button> <!--Go back to tab 2-->
						<button type="button" id="C_BTN_NEXT">Suivant</button> <!--Go to tab 4-->
					</div>
					<div id="hiddenForSpace"></div>
				</div>

				

				<div id="tab8">
					<form id="the_form" action="http://www.quebio.ca/testing/Jason/php/formSubmit.php" method="get" >

					<h3><b>Choisissez une de ses choix:</b></h3>

					 <?php
					
						$query = "SELECT c_id as cnt FROM classification ORDER BY c_id DESC LIMIT 1";
						$result = mysql_query($query) or die('Error Fetching List From Database.');
						$fetch=mysql_fetch_array($result);
						$numOfRows=$fetch['cnt'];

						$count=1;
						while($count <= $numOfRows)	 //go throguh each classification
						{
							echo '<div class="selectExamples" id="example'.$count.'">';
							echo '<ol class="select_example selectables" id="selectable'.$count.'">';

							$query = "SELECT * FROM c_examples WHERE c_id = '$count'";
							$results = mysql_query($query) or die('Error Fetching List From Database.');

							while ($row = mysql_fetch_assoc($results)) //get all the examples with the associated classification and create them as selectables
							{ 
								if( $row['example'] == "aucune example")
								{
									echo 'aucune exemple';
								}
								else
								{
						?>
								<li class="ui-state-default" title="choisissez une de ces exemples" id=<?php echo "\"" . $row['example_id'] . "\""; ?>><?php echo $row['example'];?></li>
						<?php
								}
								
							}

							$count++;  //go to the next example
							echo '</ol>';
							echo  '</div>';
						}
						?>

						<br><br>
						<h3><b>Ajoutez votre propre exemple:</b></h3>
						 <input type="text" name="newExample" id="newExample" style="width: 300px;"><br>
						 <br><br>
						
						
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
						<!--<button type="button" id="theNewExample">Inserer un nouvel exemple</button><br><br> button which insert a new interdependance example-->
						<!--<input id="submit" type="submit" value="Enregistrer vos données"> POST BACK-->
						<button type="button" id="LAST_BTN_BACK">Précédent</button>  <!--Go back to tab 3-->
						<button type="button" id="TAB9_BTN_NEXT">Suivant</button> <!--go to tab 9 -->
					</div>

					<!--Hidden fields which will be passed along with the HTML elements to next PHP script-->
					<input type="hidden" id="the_report" name="the_report" value=""/>
					<input type="hidden" id="the_user" name="the_user" value="<?php echo $user->uid;?>"/>
					<input type="hidden" id="c_i" name="c_i" value="">
					<input type="hidden" id="chosenExample" name="chosenExample" value="">
			
			</div>

				<div id="tab9">
					
					<div class="infoList">
						<h4>Vous Avez Choisi:</h4> 
						<label class="se_label" for=""></label>
						<label class="c_label" for=""></label>
						<label class="example_label" for=""></label>
					</div>
						<br><br><br>

					<h3>Quelle est la nature de l’interdépendance entre votre organisation et le cas choisit?</h3>
					<h3>Est-ce(Sélectionner 1 ou 2 cases):</h3>
					<!--<?php 
						//$_SESSION['nature_choice'][$counter] = $_GET['nature']
						//$counter++;
					?> -->
					<br>
					<fieldset><legend ><h4>Dépendance</h4></legend>Ce service vous est avantageux, car il sert d’intrant ou offre des<br> 
						conditions propices au bon fonctionnement de votre organisation.</fieldset>

					<?php
						$nature=array("Une dépendance avérée","Une dépendance potentielle");
						$count=1;
						echo '<div id="selectInter'.$count.'">';
						echo '<ol class="selectable_i selectables" id="selectable'.$count.'">';
						while($count <= 2)	 //go through each nature
						{

					?>
							<li class="ui-state-default" title="choisissez une de ces natures d'interdépendance" <?php echo 'id="Nature'.$count.'" value="'.$nature[$count-1].'">'.$nature[$count-1];?></li>
					<?php

							$count++;  //go to the next nature
						}
						echo '</ol>';
						echo  '</div>';
					?>		
					<br>
					<fieldset><legend ><h4>Impact</h4></legend>Votre organisation peut avoir un impact positif ou négatif sur le<br>
					service écosystémique et donc sur la biodiversité. Cet impact<br>
					affecte	la qualité du service en question (et éventuellement sa disponibilité.)</fieldset>

					<?php
						$nature2=array("Un impact avéré", "Un impact potentiel");
						$count=1;
						echo '<div>';
						echo '<ol class="selectable_i2 selectables" id="selectable'.$count.'">';
						while($count <= 2)	 //go through each nature
						{

					?>
							<li class="ui-state-default" title="choisissez une de ces natures d'interdépendance" <?php echo 'id="NatureTwo'.$count.'" value="'.$nature2[$count-1].'">'.$nature2[$count-1];?></li>
					<?php

							$count++;  //go to the next nature
						}
						echo '</ol>';
						echo  '</div>';
					?>		
					<br><br>
					<input type="hidden" id="inter" name="inter" value="">
					<input type="hidden" id="inter2" name="inter2" value="">
					<button type="button" id="TAB9_BTN_BACK">Précédent</button>  <!-- go to tab 8 -->
					<button type="button" id="TAB10_BTN_NEXT">Suivant</button> <!--go to tab 10 -->
				</div>

				<div id="tab10" class="ui-state-hidden">
					
					<div class="infoList">
						<h4>Vous Avez Choisi:</h4> 
						<label class="se_label" for=""></label>
						<label class="c_label" for=""></label>
						<label class="example_label" for=""></label>
						<label class="dependance_label" for=""></label>
						<label class="impact_label" for=""></label>
					</div>
						<br><br><br>

					<?php
						$natures=array("Opérationnel","Règlementaire et juridique","Réputation et image", "Marché et produits", "Financement");
						$count=1;
						echo '<div id="selectNature">';
						echo '<h4>Quel est le processus de votre organisation le plus affecté par cette dépendance ?</h4>';
						echo '<ol class="selectable_n selectables" id="selectableNature'.$count.'">';
						while($count <= 5)	 //go through each choice to turn it into a selectable
						{

					?>
								<li class="ui-state-default" title="choisissez une de ces natures" <?php echo 'id="NatureRisk'.$count.'">'.$natures[$count-1]; ?> </li>
					<?php

							$count++;  //go to the next choice
					
						}
						echo '</ol>';
						echo  '</div>';
						?>
						
						
					<?php
						$natures=array("Opérationnel","Règlementaire et juridique","Réputation et image", "Marché et produits", "Financement");
						$count=1;
						echo '<div id="selectNatureTwo">';
						echo '<h4>Quel est le processus de votre organisation le plus affecté par cette dépendance ?</h4>';
						echo '<ol class="selectable_n2 selectables" id="selectableNatureTwo'.$count.'">';
						while($count <= 5)	 //go through each choice to turn it into a selectable
						{

					?>
								<li class="ui-state-default" title="choisissez une de ces natures" <?php echo 'id="NatureRiskTwo'.$count.'">'.$natures[$count-1]; ?> </li>
					<?php

							$count++;  //go to the next choice
					
						}
						echo '</ol>';
						echo  '</div>';
						?>	
						<br><br>
					<input type="hidden" id="riskOrOpp" name="riskOrOpp" value="">
					<input type="hidden" id="riskOrOpp2" name="riskOrOpp" value="">
					<button type="button" id="LAST_BACK_BTN">Précédent</button>  <!-- go to tab 9 -->
					<button type="button" id="LAST_NEXT_BTN">Suivant</button> <!--go to tab 11 -->
					<br>
					<input id="submit" type="submit" value="Enregistrer vos données">
					<button type="button" id="BTN_RE_SE">Retourner aux services écologiques</button>
					<button type="button" id="BTN_QUIT">Quitter</button>
				</div>

				<div id="tab11" >
					<div class="infoList">
						<h4>Vous Avez Choisi:</h4> 
						<label class="se_label" for=""></label>
						<label class="c_label" for=""></label>
						<label class="example_label" for=""></label>
						<label class="dependance_label" for=""></label>
						<label class="impact_label" for=""></label>
					</div>
						<br><br><br>

					<h3>Evaluez Votre Interdependance</h3>

					<div><fieldset><legend><b>légende</legend>Très faible : votre activité dépend peu du service écosystémique choisi.<br>
					Très forte : Le SE choisi est un facteur clef de vos activités, celles-ci<br>

					<?php 
							$loop=0;
							while($loop < 16)
							{
								echo '&nbsp;';
								$loop++;
							}

					?>

					 en dépendent donc en grande partie.<br>
					 </fieldset></div>

					<select name="slides" id="slides">
				   
				    <?php 
				    	$counting=1;
				    	while($counting <= 5)
				    	{
				    		echo ' <option>'.$counting.'</option>';
				    		$counting++;
				    	}
				    ?>
				     </select>
				   <br><br><br><br><br><br>

				   <div id="displayOption1" class="OptionDivs">Très faible</div>
				   <div id="displayOption2" class="OptionDivs">Faible</div>
				   <div id="displayOption3" class="OptionDivs">Modéré</div>
				   <div id="displayOption4" class="OptionDivs">Forte</div>
				   <div id="displayOption5" class="OptionDivs">Très forte</b></div>

					<div id="slider" style="height:200px;"></div><br>

					<div><fieldset class="exampleForInter"><legend><b>Exemple</b></legend>Si vous construisez un barrage dans une zone naturelle vous avez un impact<br>
					négatif sur le service : « protection des habitats naturels », mais vous <br>
					avez aussi un impact positif sur « la régulation de la qualité de l’air »<br>
					(l’énergie hydraulique étant une alternative aux émissions de GES du pétrole)<br>
					</fieldset></div>
					<br>
					<input type="hidden" id="interdependance" name="interdependance" value="">
					<button type="button" id="TAB11_BTN_BACK">Précédent</button>  <!-- go to tab 10 -->
					<button type="button" id="impact_btn_next">Suivant</button>
				</div>

				<div id="tab12" >
					<div class="infoList">
						<h4>Vous Avez Choisi:</h4> 
						<label class="se_label" for=""></label>
						<label class="c_label" for=""></label>
						<label class="example_label" for=""></label>
						<label class="dependance_label" for=""></label>
						<label class="impact_label" for=""></label>
					</div>
						<br><br><br>

					<h4>Qualifier le niveau d’impact de -5 à +5 :</h4>

					<div><fieldset><legend><b>légende</legend>Un impact négatif (-5 à 0) a un effet néfaste sur le service écosystémique choisi.<br>
					Un impact positif (0 à +5) a un effet avantageux sur le service écosystémique choisi.</b>
				</fieldset></div>
					<select name="impact" id="impact">
				   
				    <?php 
				    	$counting=-5;
				    	while($counting <= 5)  //make the options for the drop down list
				    	{
				    		echo ' <option>'.$counting.'</option>';
				    		$counting++;
				    	}
				    ?>
				 
				  </select>

				  	 <?php 
				    	$counting=1;
				    	while($counting <= 11)  //make the divs that go witht the options
				    	{
				    		$displayCount = $counting-6;
				    		echo '<div id="displayImpact'.$counting.'" class="ImpactDivs"><b>'.$displayCount.'</b></div>';
				    		$counting++;
				    	}
				    ?>

				    <br><br><br><br><br><br>
					<div id="impactSlider" style="height:200px;"></div><br>

					<div ><fieldset class="exampleForInter"><legend><b>Exemple</b></legend>Si la qualité du service ecosystémique choisi venait à être altérée par vous,<br>
					 ou un autre utilisateur et que cela affecte une, ou plusieurs activités<br>
					 de votre organisation au point de ne plus pouvoir l’exercer, alors, la<br>
					 dépendance est très forte. Si cela n’a pas, ou peu, d’effet(s) sur vos<br>
					 activité, alors votre dépendance est faible, voire très faible.</fieldset></div>
					<br>
					<input type="hidden" id="hiddenImpact" name="hiddenImpact" value="">
					<button type="button" id="back_to_money">Précédent</button>
					<button type="button" id="after_impact_btn">Suivant</button>
				</div>
				<div id="tab13" >
					<h3>Bénéficier de ce BSE requiert-il un paiement de votre part?</h3>
				 	<input type="radio" name="money" value="yes"><b>yes<br>
				 	<input type="radio" name="money" value="no">no</b><br>
				 	<br>
				 	<h3>Lequel :</h3>
				 	<input type="radio" name="moneyType" id="moneyType" value="Taxe"><b>Taxe<br>
				 	<input type="radio" name="moneyType" id="moneyType" value="Redevance">Redevance<br>
				 	<input type="radio" name="moneyType" id="moneyType" value="Paiement pour services environnementaux">Paiement pour services environnementaux</b><br>
				 	<input type="radio" name="moneyType" id="moneyType" value=""><b>Autre</b><br>
				 	<input type="text" name="moneyinput" id="moneyinput" style="width:300px;">
				 	<br><br><br>

				 	<input type="hidden" id="gotMoney" name="gotMoney" value="">
				 	<input type="hidden" id="typeOfMoney" name="typeOfMoney" value="">
					<input type="hidden" id="numOfExamples" name="numOfExamples" value="">
					
					<button type="button" id="back_to_impact_btn">Précédent</button>
					<button type="button" id="MONEY_NEXT_BTN">Suivant</button>
				</div>

				<div id="tab14" >
					<h3>Objectif et périmètre</h3>
					<br>
					<h4>Quel est/sont le(s) mandat(s) que votre organisation se donne pour cette évaluation?<br></h4>
					<textarea rows="4" cols="50"></textarea>
					<h4>Définir le périmètre et déterminer les limites de l’évaluation :<br></h4>
					<textarea rows="4" cols="50"></textarea>

					<br><br><br>

					<div id="tabs-3">
  						<ul>
    						<li><a href="#example2">En savoir plus sur le périmètre et déterminer les limites </a></li>
    					</ul>
						<div id="example2"><br>
							<b>L’organisation comme un système :</b> Pour étudier les interdépendances d’une organisation<br>
							avec la biodiversité et les services écosystémiques, il est important de la considérer<br>
							comme un système simplifié. Le système permet de représenter les différentes entités <br>
							de l’organisation, et notamment, les flux économiques de la ou des chaines <br>
							d’approvisionnement (flux de matière, énergie, services, etc.). Le système permet <br>
							également d’identifier les intrants (matière première issue des écosystèmes) et <br>
							sortants (produits/services, profits/pertes, déchets, pollution etc.) et échanges avec<br>
							les parties prenantes externes (clients, fournisseurs, communautés locales, etc.).<br>
							<br>
							<b>Déterminer les limites de chaque évaluation :</b> l’organisation doit se fixer des objectifs<br>
							réalistes : il convient de prendre en compte la taille de l’organisation et la dispersion de<br>
							ses sites. Il serait ambitieux de vouloir faire une évaluation sur toutes les activités de<br>
							l’organisation en une seule fois. Nous privilégions une approche modulaire, qui étudie chaque<br>
							composante géographique du système comme une entité distinctes, Ceci permet de faire <br>
							correspondre une évaluation à chaque entité géographique de l’entreprise. L’organisation <br>
							pourra également choisir un périmètre d’évaluation correspondant à un aspect particulier de <br>
							ses activités.<br>
						</div>
					</div>

					<br><br>

					<h4>Comment souhaitez-vous faire apparaitre spatialement le système définit?<br></h4>
					<input type="radio" name="define" value=""><b>Indiquer manuellement des points sur une carte.</b> L’opération va générer une entrée et une<br>
																		 	  		coordonnée sera associée à cette entrée dans la base de données.<br>
					<input type="radio" name="define" value=""><b>Utiliser des données vectorielles existantes qui sont déjà géo référencées :</b> cours d’eau,<br>
																		 			polygones issus de la télédétection qui ont été classes selon les types d’usages.<br>
					<input type="radio" name="define" value=""><b>Utiliser des relevés de points à partir de GPS ou des relevés effectués a partir d’appareils<br>
					 													 		mobiles comme les téléphones intelligents.</b> Les points sont collectes dans une base de données<br>
					  													 		géo référencée par les participants.<br><br><br>

					<h4>Commencer à réfléchir aux composantes du système (votre organisation)?</h4>
					<input type="radio" name="components" value="">Objectif et fonctions<br>
					<input type="radio" name="components" value="">Intrant / extrant<br>
					<input type="radio" name="components" value="">Sous-systèmes : structurel, culturel et humain, technique et stratégique<br><br>

					<button type="button" id="TAB14_BTN_BACK">Précédent</button>  <!-- go to tab 10 -->
					<button type="button" id="TAB14_CREATE_BTN">Créer le Rapport</button>

				</div>

				<div id="tab15" >
					<h3>Qualifier l’interdépendance aux BSE</h3>
					<h4>Votre impact est-il positif ou négatif ? (Sélectionner une seule réponse)</h4>
					<input type="radio" name="NegOrPos" value="Négatif"><b>Négatif:a un effet néfaste sur le BSE<br>
					<input type="radio" name="NegOrPos" value="Positif"><b>Positif: a un effet avantageux sur le BSE</b><br>
					<input type="hidden" id="qualifyImpact" name="qualifyImpact" value="">
					<br>
					<button type="button" id="TAB10_BTN_BACK">Précédent</button>  <!-- go to tab 9 -->
					<button type="button" id="TAB11_BTN_NEXT">Suivant</button> <!--go to tab 11 -->
				</div>

				</form>

		</div>	
		<!-- Hidden Container To Generate The Highchart Before Exporting it to The Server. -->
		<div id="barchartFull" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>
		<div id="barchartSmall" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>
		<div id="spiderchartFull" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>
		<div id="spiderchartSmall" style="display:none;width: 800px; height: 800px; margin: 0 auto"></div>


