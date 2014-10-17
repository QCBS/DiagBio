<?php 
header("Access-Control-Allow-Origin: *");
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
drupal_add_js("testing/Jason/js/diagbio.map.js");
drupal_add_js('http://maps.google.com/maps/api/js?sensor=false');
drupal_add_css('testing/Jason/css/CSS.css');
drupal_add_js("http://code.highcharts.com/modules/exporting.js");

include('Inter_main_php.php');
include('/var/www/quebio.ca/misc/dbaminfo.php');

?>
			<body>
				<div id="accinfo">
				<input type="hidden" id="userRole" name="userRole" value=<?php echo json_encode($role); ?>>
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
						<li id="userview"><a href="#tab5">Liste d'évaluations</a></li>
						<li id="servicetab"><a href="#tab6">Services Écologiques</a></li>
						<li id="classificationtab"><a href="#tab7">Classification</a></li>	
						<li id="entreprisetab"><a href="#tab8">Analysez votre entreprise</a></li>
						<li id="naturetab"><a href="#tab9">Nature dinterdependance</a></li>
						<li id="qualifytab"><a href="#tab15">Qualifier l’interdépendance aux BSE</a></li>
						<li id="dependencetab"><a href="#tab11">Evaluez Votre Interdependance</a></li>
						<li id="impacttab"><a href="#tab12">Niveau d'Impact</a></li>
						<li id="moneytab"><a href="#tab13">Impact Monétaire</a></li>
						<li id="risktab"><a href="#tab10">Risques et Opportunités</a></li>
						<li id="sendData"><a href="#tab16">Enregistrer vos données</a></li>
						<li id="viewOpinions"><a href="#tab17">Gestion des données</a></li>
						<li id="adminOpinion"><a href="#tab18">Planification</a></li>
						<li id="infoForUser"><a href="#tab19">Why Am I Here?</a></li>
					</ul>
					<div id="tab1"> <!-- Raw Information Dump from Philippe Auzel's Excel Documents. -->

					<fieldset class="infoList">
					<ul>
						<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Au cours des 50 dernières années, on a constaté une accélération du déclin des écosystèmes,</li>
						<li>à un rythme inédit dans l’histoire de l’humanité. Si elle n’est pas maîtrisée, cette dégradation</li> 
						<li>mettra en péril non seulement la biodiversité mondiale, mais également les activités économiques de la planète.</li>					
					</ul>
					</fieldset>

					<fieldset class="infoList"><legend class="font_legend"><b>Objectif de l’outil : Evaluation des interdépendances</b></legend>
							<ul>
								<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Destiné aux <b>organisations</b> qui se préoccupent de leurs <b>interdépendances</b> avec la <b>biodiversité</b>, l’outil vous aidera à
								</li>
	
								</ul>
								<ol>
								<li>
									Mieux comprendre vos relations à la Biodiversité et aux SE.
								</li>
								<li>
									 Trouver des pistes de réflexion pour la prise de décisions stratégiques interne.
								</li>
								<li>
									Identifier les risques et opportunités qui découlent de votre dépendance à la biodiversité et aux SE.
								</li>
								<li>
									 Gérer les communications avec parties prenantes.
								</li>
								</ol>

					</fieldset>

					<div id="imageOne">
						
						<img src="/testing/Jason/images/picWtihPpl.JPG"/>
						<div style="height:25pxpx; width:150px; background-color:white;">
							<b>4. Gérer les communications avec les parties prenantes à l’interne (et externe).</b>
						</div>
					</div>
					<div id="imageTwo">

						<img src="/testing/Jason/images/lightBulb.JPG"/>
						<div style="height:25pxpx; width:150px; background-color:white;">
							<b>3. Identifier les risques et opportunités qui découlent de votre dépendance à la biodiversité et aux SE.</b>
						</div>
					</div>
					<div id="imageThree">
						<img src="/testing/Jason/images/lightbulbWithFlowers.JPG"/>
						<div style="height:25pxpx; width:150px; background-color:white;">
							<b>2. Trouver des pistes de réflexion pour la prise de décisions stratégiques interne.</b>
						</div>
					</div>
					<div id="imageFour">
						<img src="/testing/Jason/images/bubbles.png"/>
						<div style="height:25pxpx; width:150px; background-color:white;">
							<b>1. Mieux comprendre vos relations à la Biodiversité et aux SE.</b>
						</div>
					</div>

					<div id="makeSpace"></div>

					<fieldset class="infoList"><legend class="font_legend"><b>Description de l’outil</b></legend>

							<ul>
								<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Ce outil est avant tout un outil de communication</b>, l’objectif est de comprendre et évaluer les liens de votre organisation</li>
								<li>vis-à-vis de la biodiversité et de communiquer à ce propos avec les parties prenantes de l’organisation. Cette</li>
								<li>approche utilise le référentiel des Services Écosystémiques (SE) qui aborde les questions de biodiversité d’un point</li>
								<li>de vue anthropique, ce qui rend l’exercice accessible à tous. **</li>
								<br>
								<li>Les étapes de l’évaluation sont les suivantes :</li>
								<br>
								<ol>
								<li>Définir l'objectif et la portée du diagnostic.</li>
								<li>Établir le portrait du systeme.</li>
								<li>Identifier les interdendances aux BSE.</li>
								<li>Déterminer les interdependances principales de l'organisation aux BSE.</li>
								<li>Élaborer un plan de gestion des BSE.</li>
								<li>Définir une strategie interne et externe de l'organisation au regard de son interdependance aux BSE.</li>
								<br>
								</ol>
							</ul>

							<div id="tabs-2">
  								<ul>
    							<li><a href="#example">Ce qu’il faut savoir</a></li>
    							</ul>
							<div id="example"><br>
								Parler de biodiversité, c’est avant tout s’intéresser aux  relations qu’entretiennent les espèces (dont l’espèce humaine), entre
							    elles, et avec les milieux physiques et chimiques. Pour prendre en compte la biodiversité il faut donc s’intéresser aux 
							    interactions entre le vivant et le non vivant. La biodiversité ne relève pas uniquement du descriptif, mais bien du fonctionnel 
							    et c’est pourquoi elle est si difficile à évaluer.  Ces interdépendances sont difficiles à percevoir, quantifier et mesurer. Par
							    ailleurs, les indicateurs de biodiversité sont souvent évalués à différentes échelles (gènes, espèces, écosystèmes), et donc,
							    très nombreux. C’est pourquoi les scientifiques ont élaborés le concept des « services écologiques » (SE)[1, particulièrement
							    utile pour illustrer l’interdépendance du social et de l’économique avec le monde vivant. Les SE sont les bénéfices que nous
							    retirons du fonctionnement des écosystèmes. Ils sont issus de la biodiversité mais surtout des processus écologiques
							    issus des interactions entre les espèces et dont différents acteurs économiques peuvent retirer des services écologiques.
							</div>
					</fieldset>
					<!--<iframe src="http://prezi.com/embed/bu9w-01qhpes/?bgcolor=ffffff&amp;lock_to_path=0&amp;autoplay=0&amp;autohide_ctrls=0&amp;features=undefined&amp;disabled_features=undefined" width="550" height="400" frameBorder="0" webkitAllowFullScreen mozAllowFullscreen allowfullscreen></iframe>-->
					<fieldset class="infoList"><legend class="font_legend"><b>évaluations:</b></legend>
						<fieldset><legend class="font_legend"><b>I. L'évaluation va permettre de determiner</b></legend>
						<ul>
							<li>Les interdépendances de l’organisation avec les SE</li>
						</ul>
						</fieldset>
						<fieldset><legend class="font_legend"><b>II. Les interdépendances principales avec les SE vous permettera d'élaborer:</b></legend>
						<ul>
							<li>Des stratégies internes et externes à l’organisation</li>
							<li>Des plans de gestion des dépendances principales et de surveillance des </li>
							<li>interdependances potentielles avec les SE</li>
						</ul>
						</fieldset>
					</fieldset>
					</p>
				</div>

				<div id="tab2"> <!-- Raw Information Dump from Philippe Auzel's Excel Documents. -->

				<fieldset class="infoList"><legend class="font_legend"><b>Ce qu’il faut savoir</b></legend>
								
L’organisation comme un système : Pour étudier les interdépendances d’une organisation avec la biodiversité et les services écosystémiques, il est important de la considérer comme un système simplifié. Le système permet de représenter les différentes entités de l’organisation, et notamment, les flux économiques de la ou des chaines d’approvisionnement (flux de matière, énergie, services, etc.). Le système permet également d’identifier les intrants (matière première issue des écosystèmes) et sortants (produits/services, profits/pertes, déchets, pollution etc.) et échanges avec les parties prenantes externes (clients, fournisseurs, communautés locales, etc.).
<br><br>
Déterminer les limites de chaque évaluation : l’organisation doit se fixer des objectifs réalistes : il convient de prendre en compte la taille de l’organisation et la dispersion de ses sites. Il serait ambitieux de vouloir faire une évaluation sur toutes les activités de l’organisation en une seule fois. Nous privilégions une approche modulaire, qui étudie chaque composante géographique du système comme une entité distinctes, Ceci permet de faire correspondre une évaluation à chaque entité géographique de l’entreprise. L’organisation pourra également choisir un périmètre d’évaluation correspondant à un aspect particulier de ses activités.
				</fieldset>

				<fieldset class="infoList"><legend class="font_legend"><b>Choix du périmètre :</b></legend>
				<ul>				
				<li>La première étape est de définir un périmètre sur lequel portera l’étude. Celui-ci dépend totalement de l’objectif</li>
				<li>de l’étude. Que cherchez-vous à étudier ? Un portait de l’organisation, que ce soit en termes de système ou d’espace </li>
				<li>(site), vous permettra de définir cette question essentielle. Il peut s’agir d’une filiale, d’un segment de l’organisation,</li>
				<li>mais également d’un projet, destiné à un site précis. Par la suite, les autres participants seront amenés à se questionner</li>
				<li>par rapport au même périmètre, amenant une réflexion entre les parties prenantes internes à l’organisation.</li>
				</ul>

				<div class="infoList" id="tabs-4">
  								<ul>
    							<li><a href="#exampleFour">Ce qu’il faut savoir</a></li>
    							</ul>
							<div class="infoList" id="exampleFour"><br>
							
							Considérer le tout comme un système permet de représenter les différentes entités de l’organisation, ainsi que leurs échanges avec les parties prenantes externes (clients, fournisseurs, communautés locales, etc.). Lors de l’évaluation, il est nécessaire de procéder par étapes, car dépendamment de la taille de l’organisation (notamment si ses activités sont diversifiées), l’évaluation pourrait être trop fastidieuse. Il serait très ambitieux de vouloir faire une évaluation sur tous ses aspects en une seule fois. Les données, comme les résultats, seraient difficiles et à obtenir et très complexes à analyser. Fragmenter le système en différentes entités permettra d’y voir plus clair, en faisant correspondre un rapport (une évaluation), à chaque entité de l’entreprise.<br><br>

							L’organisation devra donc choisir un périmètre d’évaluation correspondant à un aspect particulier de ses activités et c’est pourquoi il est important de se questionner en premier lieu sur l’objectif de l’évaluation. Il peut s’agir des éléments de la chaine de valeur comme les fournisseurs, une catégorie de fournisseurs ou de clients, mais également d’une installation, d’un site, etc. Bien entendu, il est plus judicieux de choisir un périmètre représentant une grande importance stratégique pour l’entreprise, ou bien un secteur où les interactions avec les écosystèmes sont les plus susceptibles d’être sources de risques ou opportunités.<br><br>

							À titre d’exemple, BC Hydro a choisi son barrage hydroélectrique de l’île de Vancouver sur le fleuve Campbell comme	périmètre de son audit ESR (Ecosystem Services Review) et Rio Tinto a testé l’évaluation ESR sur une mine de cuivre	en prospection au Pérou, en amont du projet, au stade d’étude de préfaisabilité. (World Ressources Institure 2008).<br>
							</div>

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
				</div>
				<div id="tab5">
					<div style="width: 800px;">
						<div id="selectable0" style="width: 500px; height: 200px; float: left; overflow-y: scroll;">	
							<?php
							$query = "SELECT * FROM report WHERE reportid IN (SELECT r_id FROM user_ids WHERE u_id=".$user->uid.")";//query statement--->gets the all the reports id
							$results = mysql_query($query) or die('Error Fetching List From Database.');
							
							while ($row = mysql_fetch_assoc($results)) { // Display The Proper View Setting.
								if ( $row['Available'] == 0 ){
									$viewability = "évaluation visible par l'administrateur seulement";
								}
								else{
									$viewability = "évaluation visible par tous les participants";	
								}
								?>
								<!--populating the selectable list with values fetched from database -->
								<li class="ui-state-default" style="width: 400px" value=<?php echo "\"" . $row['adminid'] . "\""; ?> id=<?php echo "\"" . $row['reportid'] . "\""; ?>><?php echo $row['evalName']; echo " - "; echo $row['date']; echo " - " . $viewability; ?></li>
								<?php

							}
							?>
						</div>
						<div style="float: left; width: 200px; margin-left: 10px;">
							<h3>Un nouveau évaluation</h3>
							<input type="text" id="new_report" name="new_report" style="width: 204px" title="Entre un nouveau numéro de évaluation" value=""/>
						</div>
						<button type="button" id="NEW_RE_BTN">Répondez à ce évaluation</button>
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
								<li class="ui-state-default" title="choisissez un de ces services écologiques" id=<?php echo "\"" . $row['se_id'] . "\"" .$row['se_name'];?>> <?php echo $row['se_name']?></li>
							<?php
							}
							if($row['se_id'] <= 7 && $row['se_id'] >= 4 ){
								if ($row[se_id] == 4) {
									echo '<h3>Services de régulation<br></h3>';
								}
							?>
								<li class="ui-state-default" title="choisissez un de ces services écologiques" id=<?php echo "\"" . $row['se_id'] . "\"" .$row['se_name'];?>> <?php echo $row['se_name']?></li>
							<?php
							}
							if($row['se_id'] <= 10 && $row['se_id'] > 7 ){
								if ($row[se_id] == 8) {
									echo '<h3>Services culturels<br></h3>';
								}
							?>	
								<li class="ui-state-default" title="choisissez un de ces services écologiques" id=<?php echo "\"" . $row['se_id'] . "\"" .$row['se_name'];?>> <?php echo $row['se_name']?></li>
							<?php
							}
							if($row['se_id'] == 11 ){
							?>
								<br>
								<br>
								<h3>Ressources naturelles<br></h3>
								<li class="ui-state-default" title="choisissez un de ces services écologiques" id=<?php echo "\"" . $row['se_id'] . "\"" .$row['se_name'];?>> <?php echo $row['se_name']?></li>
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
								if($row['c_name'] == "Matières minérales et métalliques")
								{
									echo '<h4>Ressources naturelles non issues du vivant</h4>'; 
									echo 'Les minéraux, substances nutritionnelles et énergie renouvelable nous sont<br>
									 	  bénéfiques mais ne sont pas issus du vivant et ne peuvent donc pas être <br>
									 	  considérés comme des services écosystémiques. Cependant, ils ont un rôle<br>
									 	  à jouer pour la biodiversité et sont donc à prendre en compte lors de<br>
									 	  l’évaluation.<br><br>';
								}

								if($row['c_name'] == "Énergie renouvelable issue du vivant")
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
					<form id="the_form" action="http://www.quebio.ca/testing/Jason/php/formSubmit.php" method="POST" >
					<input type="hidden" id="userRole2" name="userRole2" value=<?php echo json_encode($role); ?>>
				
					<h3><b>Examples</b></h3>

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
						<h3><b>Nommez l'interdépendance</b></h3>
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
					<input type="hidden" id="the_user" name="the_user" value="<?php echo $user->uid;?>"/>
					<input type="hidden" id="se_i" name="se_i" value="">
					<input type="hidden" id="se_name" name="se_name" value="">
					<input type="hidden" id="c_i" name="c_i" value="">
					<input type="hidden" id="c_i_val" name="c_i_val" value="">
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
						$natures=array("Les finances","La gestion des opérations","Les opérations quotidiennes", "Les ressources humaines", "Le marketing");
						$count=1;
						echo '<div id="selectNature">';
						echo '<h4>Quel est le processus de votre organisation le plus affecté par cette dépendance ?</h4>';
						echo '<label class="dependance_label" for=""></label>';
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
						$natures=array("Les finances","La gestion des opérations","Les opérations quotidiennes", "Les ressources humaines", "Le marketing");
						$count=1;
						echo '<div id="selectNatureTwo">';
						echo '<h4>Quel est le processus de votre organisation le plus affecté par cette dépendance ?</h4>';
						echo '<label class="impact_label" for=""></label>';
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
					<input type="hidden" id="riskOrOpp2" name="riskOrOpp2" value="">
					<button type="button" id="LAST_BACK_BTN">Précédent</button>  <!-- go to tab 9 -->
					<button type="button" id="LAST_NEXT_BTN">Suivant</button> <!--go to tab 11 -->
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

					<div><fieldset class="infoList"><legend class="font_legend"><b>légende</legend>Très faible : votre activité dépend peu du service écosystémique choisi.<br>
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
					<div id="dep_textarea" style="height:200px">
					<h5>Votre Avis:</h5>
					<textarea rows="4" cols="50" id="dep_txt" name="dep_txt">
					</textarea>
					</div>					
					<br>
					<input type="hidden" id="interdependancePotential" name="interdependancePotential" value="">
					<input type="hidden" id="interdependanceAverage" name="interdependanceAverage" value="">
					<input type="hidden" id="niveauDependance" name="niveauDependance" value="">
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

					<div><fieldset class="infoList"><legend class="font_legend"><b>légende</legend>Un impact négatif (-5 à 0) a un effet néfaste sur le service écosystémique choisi.<br>
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
				    <div id="impact_textarea">
				    <h5>Votre Avis:</h5>
				    <textarea rows="4" cols="50" id="impact_txt" name="impact_txt">
					</textarea>
				    </div>
				    <br><br><br><br><br><br>
					<div id="impactSlider" style="height:200px;"></div><br>

					<br>
					<input type="hidden" id="hiddenImpactPotential" name="hiddenImpactPotential" value="">
					<input type="hidden" id="hiddenImpactAverage" name="hiddenImpactAverage" value="">
					<input type="hidden" id="niveauImpact" name="niveauImpact" value="">
					<button type="button" id="back_to_money">Précédent</button>
					<button type="button" id="after_impact_btn">Suivant</button>
				</div>
				<div id="tab13" >
						<div class="infoList">
						<h4>Vous Avez Choisi:</h4> 
						<label class="se_label" for=""></label>
						<label class="c_label" for=""></label>
						<label class="example_label" for=""></label>
						<label class="dependance_label" for=""></label>
						<label class="impact_label" for=""></label>
					</div>
						<br><br><br>

					<h3>Bénéficier de ce BSE requiert-il un paiement de votre part?</h3>
				 	<input type="radio" name="money" value="Oui"><b>Oui<br>
				 	<input type="radio" name="money" value="Non">Non</b><br>
				 	<br>
				 	<h3>Si Oui,Lequel :</h3>
				 	<input type="radio" name="moneyType" id="moneyType" value="Taxe" disabled><b>Taxe<br>
				 	<input type="radio" name="moneyType" id="moneyType" value="Redevance" disabled>Redevance<br>
				 	<input type="radio" name="moneyType" id="moneyType" value="Paiement pour services environnementaux" disabled>Paiement pour services environnementaux</b><br>
				 	<input type="radio" name="moneyType" id="moneyType" value="" disabled><b>Autre</b><br>
				 	<input type="text" name="moneyinput" id="moneyinput" style="width:300px;" disabled>
				 	<br><br><br>
				 	<input type="hidden" id="gotMoney" name="gotMoney" value="">
				 	<input type="hidden" id="typeOfMoney" name="typeOfMoney" value="">
					<input type="hidden" id="numOfExamples" name="numOfExamples" value="">
					
					<button type="button" id="back_to_impact_btn">Précédent</button>
				
					<button type="button" id="MONEY_NEXT_BTN">Suivant</button>
				</div>
				
				<div id="tab15" >
				<div class="infoList">
						<h3>Enregistrer vos données</h3>
						<h4>Vous Avez Choisi:</h4> 
						<label class="se_label" for=""></label>
						<label class="c_label" for=""></label>
						<label class="example_label" for=""></label>
						<label class="dependance_label" for=""></label>
						<label class="impact_label" for=""></label>
				</div>
				<br><br><br>

					<h3>Qualifier l’interdépendance aux BSE</h3>
					<h4>Votre impact est-il positif ou négatif ? (Sélectionner une seule réponse)</h4>
					<input type="radio" name="NegOrPos" value="Négatif"><b>Négatif:a un effet néfaste sur le BSE<br>
					<input type="radio" name="NegOrPos" value="Positif"><b>Positif: a un effet avantageux sur le BSE</b><br>
					<br>
					<input type="hidden" id="qualifyImpact" name="qualifyImpact" value="">
					<button type="button" id="TAB10_BTN_BACK">Précédent</button>  <!-- go to tab 9 -->
					<button type="button" id="TAB11_BTN_NEXT">Suivant</button> <!--go to tab 11 -->
				</div>

				<div id="tab16">
					<div class="infoList">
						<h3>Enregistrer vos données</h3>
						<h4>Vous Avez Choisi:</h4> 
						<label class="se_label" for=""></label>
						<label class="c_label" for=""></label>
						<label class="example_label" for=""></label>
						<label class="dependance_label" for=""></label>
						<label class="impact_label" for=""></label>
					</div>
					<br><br><br>
					<button type="button" id="data_back_btn">Précédent</button>  <!-- go to tab 9 -->
					<input id="submit" type="submit" value="Enregistrer vos données">
					<button type="button" id="BTN_RE_SE">Retourner aux services écologiques</button>
					<button type="button" id="BTN_QUIT">Quitter</button>
				</div>

				</form>

				<div id="tab14" >
					<h3>Objectif et périmètre</h3>
					<br>
					<h4>Nom de l'évaluation</h4><input type="text" name="nameEval" id="nameEval"><br>
					<h4>Nom de l'organisation qui va être évaluée</h4><input type="text" name="orgEval" id="orgEval"><br>
					<h4>Quel(s) est/sont le(s) mandat(s) ou objectif(s) que votre organisation se donne pour cette évaluation ?</h4>
					<textarea rows="4" cols="50" id="objectiveText"></textarea>
					<h4>Quelles sont, selon vous les limites de cette évaluation ?</h4>
					<textarea rows="4" cols="50" id="limitText"></textarea>
					<br><br><br>
					
					<div id="tabs-3">
  						<ul>
    						<li><a href="#example2">Ce qu’il faut savoir</a></li>
    					</ul>
						<div id="example2"><b>L’organisation comme un système</b> : Pour étudier les interdépendances d’une organisation avec la biodiversité et les services écosystémiques, il est important de la considérer comme un système simplifié. Le système permet de représenter les différentes entités de l’organisation, et notamment, les flux économiques de la ou des chaines d’approvisionnement (flux de matière, énergie, services, etc.). Le système permet également d’identifier les intrants (matière première issue des écosystèmes) et sortants (produits/services, profits/pertes, déchets, pollution etc.) et échanges avec les parties prenantes externes (clients, fournisseurs, communautés locales, etc.).<br><br>

						<b>Déterminer les limites de chaque évaluation</b> : l’organisation doit se fixer des objectifs réalistes : il convient de prendre en compte la taille de l’organisation et la dispersion de ses sites. Il serait ambitieux de vouloir faire une évaluation sur toutes les activités de l’organisation en une seule fois. Nous privilégions une approche modulaire, qui étudie chaque composante géographique du système comme une entité distinctes, Ceci permet de faire correspondre une évaluation à chaque entité géographique de l’entreprise. L’organisation pourra également choisir un périmètre d’évaluation correspondant à un aspect particulier de ses activités.
						</div>
					</div>

					<br><br>

					<h4>Circonscription du périmètre d’analyse</h4>
					<input type="radio" name="cir1" id="cir1" value="Opérationnel"><b>Opérationnel</b>
					<select hidden id="sites1">
					  <option value="site">Site</option>
					  <option value="ensemble site">Ensemble Site</option>
					  <option value="groupe">Groupe</option>
					</select><br>
					<input type="radio" name="cir2" id="cir2" value="Spatial"><b>Spatial</b>
					<select hidden id="sites2">
					  <option value="province">Province</option>
					  <option value="region">Région</option>
					  <option value="commune">Commune</option>
					  <option value="site">Site</option>
					</select><br>
					<input type="radio" name="cir3" id="cir3" value="Intrant"><b>Intrant/extrant</b>
					<select hidden id="sites3">
					  <option value="approvisionnements">Approvisionnements</option>
					  <option value="exportations">Exportations</option>
				    </select><br><br>
				    <h4>Description</h4>
					<textarea rows="4" cols="50" id="sysRep"></textarea><br><br><br>
					<h4>Définition des limites spatiales</h4>
					<div id="noloc" style="display:none;">Localisation non reconnue!</div>
					<p>Double-cliquez sur un node pour pour l'effacer, cliquez-glisser le node pour le déplacer</p>
			        <button type="button" id="polybut">Ajouter un polygone</button>
			        <button type="button" id="metabio-clear">Tout effacer</button>
			        <input type="hidden" name="geography" id="geography">
			        <div id="map" style="width:800px !important;height:500px !important;margin:10px 0 15px 0;"></div>

					<!--
					<h4>Comment souhaitez-vous faire apparaitre spatialement le système définit?<br></h4>
					<input type="radio" name="define" id="define" value=""><b>Indiquer manuellement des points sur une carte.</b> L’opération va générer une entrée et une<br>
																		 	  		coordonnée sera associée à cette entrée dans la base de données.<br>
					<input type="radio" name="define" id="define" value=""><b>Utiliser des données vectorielles existantes qui sont déjà géo référencées :</b> cours d’eau,<br>
																		 			polygones issus de la télédétection qui ont été classes selon les types d’usages.<br>
					<input type="radio" name="define" id="define" value=""><b>Utiliser des relevés de points à partir de GPS ou des relevés effectués a partir d’appareils<br>
					 													 		mobiles comme les téléphones intelligents.</b> Les points sont collectes dans une base de données<br>
					  													 		géo référencée par les participants.<br><br><br>
					-->
					<h4>Fonction du système</h4>
					<input type="radio" name="sysFunc1" id="sysFunc1" value="principales"><b>Principales <br>
					<input type="radio" name="sysFunc2" id="sysFunc2" value="secondaires">Secondaires</b> <br><div hidden id="hidden_text"><br><br>
					<h4>Description</h4>
					<textarea rows="4" cols="50" id="funcTxt"></textarea><br><br><br>
					</div><br><br>
					<h4>La portée de l’évaluation</h4>
					Le nombre de participants et le niveau d’évaluation vont conditionner la portée du diagnostic et la valeur qui lui sera reconnue autant en interne qu’en externe.<br><br>

					<fieldset><legend><b>Niveau d’évaluation</b></legend>
					<input type="checkbox" name="niveau1" id="niveau1" value="Direction"><b>Direction<br>
					<input type="checkbox" name="niveau2" id="niveau2" value="Interne">Interne<br>
					<input type="checkbox" name="niveau3" id="niveau3" value="Externe">Externe<br>
					</fieldset>
					<div id="hideList" hidden>
					<fieldset><legend><b>Si c'est Externe : parties prenantes identifiées ?</b></legend>
					<input type="radio" name="externe" id="externe1" value="habitants" >Habitants<br>
					<input type="radio" name="externe" id="externe2"value="autre organisation" >Autre organisation<br>
					<input type="radio" name="externe" id="externe3" value="gouvernement" >Gouvernement/ Etat<br>
					<input type="radio" name="externe" id="externe4" value="agence" >Agence de notation<br>
					<input type="radio" name="externe" id="externe5" value="ong" >ONG<br>
					<input type="radio" name="externe" id="externe6" value="autre" >Autre<br><br>
					<input type="text" name="externeInput" id="externeInput" style="width:300px;">
					</fieldset>
					</div>
					<button type="button" id="TAB14_BTN_BACK">Précédent</button>  
					<button type="button" id="TAB14_CREATE_BTN">Créer l'évaluation</button>
					<input type="hidden" name="firstTime" id="firstTime" value=""> <!-- determines wheterh the user wants to edit or create -->
				</div>
		
		<div id="tab17" >
			<?php
			$loop = 0; //number of reports
			$reportids = [];
			$orgs = [];
			$query = "SELECT reportid, evalName FROM report WHERE adminid = $user->uid";
			$results = mysql_query($query) or die('Error Fetching List From Database.');
			while ($row = mysql_fetch_assoc($results)) { 
				$reportids[] = $row['reportid']; 
				$orgs[] = $row['evalName'];
				$loop++;
			}
				
			$counter=0;
			while ($counter < $loop) { //used to make the buttons that will show/hide the tables
				echo '<button type="button" id="show'.$counter.'" value="'.$reportids[$counter].'">Évaluation: '.$orgs[$counter].'</button>';
				$counter++;
			}

			$count = 0;  //number of rows or check boxes in total
			$looper = 0;
			while ($looper < $loop) {  //making all of the tables containing different reports

				echo '<div id="opinions'.$looper.'" hidden>';  //the div that has a certian report, used to hide and show
				echo "<h4>Plan D'action</h4>";
				$query = "SELECT row_id, u_id, example, opinion FROM interdependances WHERE r_id
				= '$reportids[$looper]' AND (average_dependance_level = 4 OR average_dependance_level
				= 5 OR average_impact_level = 4 OR average_impact_level = 5) GROUP BY example ORDER BY u_id ";
				$results = mysql_query($query) or die('Error Fetching List From Database.');
				while ($row = mysql_fetch_assoc($results)) { 
					echo '<table border="1">';
					echo "<tr><th>Effacer</th><th>Ids des Commentaires</th><th>IDBSE</th><th>Commentaires</th></tr>";
					echo '<tr><td><input type="checkbox" name="chk_box_delete_'.$count.'" value="'.$row['row_id'].'"></td>';
					echo '<td>'.$row['u_id'].'</td><td>'.$row['example'].'</td><td>'.$row['opinion'].'</td>';
					echo '</tr></table>';
					$count++;
				}

				echo '<h4>Plans de surveillance</h4>';		
				$query = "SELECT row_id, u_id, example, opinion FROM interdependances WHERE r_id
				= '$reportids[$looper]' AND (potential_dependance_level = 4 OR potential_dependance_level
				= 5 OR potential_impact_level = 4 OR potential_impact_level = 5) GROUP BY example ORDER BY u_id";
				$results = mysql_query($query) or die('Error Fetching List From Database.');
				while ($row = mysql_fetch_assoc($results)) { 
					echo '<table border="1">';
					echo "<tr><th>Effacer</th><th>Ids des Commentaires</th><th>IDBSE</th><th>Commentaires</th></tr>";
					echo '<tr><td><input type="checkbox" name="chk_box_delete_'.$count.'" value="'.$row['row_id'].'"></td>';
					echo '<td>'.$row['u_id'].'</td><td>'.$row['example'].'</td><td>'.$row['opinion'].'</td>';
					echo '</tr></table>';
					$count++;
				}
				echo '</div>';
				
				$looper++;
			}
				
			?>
			<input type="hidden" value="" id="report_selected">
			<input type="hidden" id="numOfOpinions" name="numOfOpinions" value="<?php echo $count;?>">		
			<button type="button" id="delete_opinions">Delete</button>
		</div>

		<div id="tab18">
			<?php
			$counter=0;
			while ($counter < $loop) { //used to make the buttons that will show/hide the tables
				echo '<button type="button" id="showReport'.$counter.'" value="'.$reportids[$counter].'">Évaluation: '.$orgs[$counter].'</button>';
				$counter++;
			}

			$unique_examples = [];
			$count = 0;
			$potentialAvg = [];  //find out whether the example(IDBSE) is average or potential
			$report_ids = [];
			$looper=0;
			while ($looper < $loop) {
				echo '<div id="adminOps'.$looper.'" hidden>';
				echo "<h4>Plan d'Action</h4>";

				$row_ids = [];
				$unique_list = [];
				$unique_size = 0;
				$query = "SELECT r_id, row_id, example FROM interdependances WHERE 
				r_id = '$reportids[$looper]' AND (average_dependance_level = 4 OR average_dependance_level = 5
				OR average_impact_level = 4 OR average_impact_level = 5) GROUP BY example ORDER BY example";
				$results = mysql_query($query) or die('Error Fetching List From Database.');				
				while ($row = mysql_fetch_assoc($results)) {
					$row_ids[] = $row['row_id'];
					$unique_list[] = $row['example'];
					$unique_examples[] = $row['example'];
					$report_ids[] = $row['r_id'];
					$potentialAvg[] = 'avéré';
					$unique_size++;
				}

				$opinion_ids = [];
				$idbses = [];
				$user_opinions = [];
				$size = 0;
				$query = "SELECT u_id, example, opinion FROM interdependances WHERE 
				r_id = '$reportids[$looper]' AND (average_dependance_level = 4 OR average_dependance_level = 5
				OR average_impact_level = 4 OR average_impact_level = 5) ORDER BY example";
				$results = mysql_query($query) or die('Error Fetching List From Database.');
				while ($row = mysql_fetch_assoc($results)) {
					$opinion_ids[] = $row['u_id'];
					$idbses[] = $row['example'];
					$user_opinions[] = $row['opinion'];
					$size++;
				}

				for ($i=0; $i < $unique_size; $i++) {
					echo '<table border="1">'; 
					echo '<tr><th>IDBSE</th><th>Ids des commentaires</th></th><th>Commentaires</th><th>Action</th><th>Alternative envisagées(Paiement)</th></tr>';
							
					for ($j=0; $j < $size ; $j++) { 
						if ($idbses[$j] == $unique_list[$i]) {
							echo '<tr><td>'.$idbses[$j].'</td><td>'.$opinion_ids[$j].'</td><td>'.$user_opinions[$j].'</td>';
						}
					}
					echo '<td><textarea rows="5" cols="30" id="adminFinalOpinion'.$count.'"></textarea></td>';
					echo '<td><textarea rows="5" cols="30" id="adminAltPay'.$count.'"></textarea></td></tr>';
					$count++;
					echo '</table>';
				}

				echo "<h4>Plan de Surveillance</h4>";

				$row_ids = [];
				$unique_list = [];
				$unique_size = 0;
				$query = "SELECT r_id, example, row_id FROM interdependances WHERE 
				r_id = '$reportids[$looper]' AND (potential_dependance_level = 4 OR potential_dependance_level = 5
				OR potential_impact_level = 4 OR potential_impact_level = 5) GROUP BY example ORDER BY example";
				$results = mysql_query($query) or die('Error Fetching List From Database.');				
				while ($row = mysql_fetch_assoc($results)) {
					$unique_list[] = $row['example'];
					$unique_size++;
					$row_ids[] = $row['row_id'];
					$unique_examples[] = $row['example'];
					$report_ids[] = $row['r_id'];
					$potentialAvg[] = 'potentiel';
				}

				$opinion_ids = [];
				$idbses2 = [];
				$user_opinions = [];
				$size = 0;
				$yesNoMoney = [];
				$query = "SELECT u_id, example, opinion, gotMoney FROM interdependances WHERE 
				r_id = '$reportids[$looper]' AND (potential_impact_level = 4 OR potential_impact_level = 5
				OR potential_dependance_level = 4 OR potential_dependance_level = 5) ORDER BY example";
				$results = mysql_query($query) or die('Error Fetching List From Database.');
				while ($row = mysql_fetch_assoc($results)) {
					$opinion_ids[] = $row['u_id'];
					$idbses2[] = $row['example'];
					$user_opinions[] = $row['opinion'];
					$yesNoMoney[] = $row['gotMoney'];
					$size++;
				}

				for ($i=0; $i < $unique_size; $i++) {
					echo '<table border="1">'; 
					echo '<tr><th>IDBSE</th><th>Ids commentaires</th></th><th>Commentaires</th><th>Surveillance</th><th>Recherche d’alternative pour prévenir les paiements pour SE</th></tr>';		
					for ($j=0; $j < $size ; $j++) { 
						if ($idbses2[$j] == $unique_list[$i]) {
							echo '<tr><td>'.$idbses2[$j].'</td><td>'.$opinion_ids[$j].'</td><td>'.$user_opinions[$j].'</td>';
						}
					}
					echo '<td><textarea rows="5" cols="30" id="adminFinalOpinion'.$count.'"></textarea></td>';
					if ($yesNoMoney[$i] == 'Non')
						echo '<td><textarea rows="5" cols="30" id="adminAltPay'.$count.'" disabled></textarea></td></tr>';
					else
						echo '<td><textarea rows="5" cols="30" id="adminAltPay'.$count.'"></textarea></td></tr>';
					$count++;
					echo '</table>';
				}
				echo "</div>";
				$looper++;
				}

				$counter = 0;
				while ($counter < $count) {
					//store these values to send over with ajax(report ids, examples, potential/avg, the distinct ids of users, niveau avg)
					echo '<input type="hidden" value="'.$unique_examples[$counter].'" id="unique_example'.$counter.'">';
					echo '<input type="hidden" value="'.$report_ids[$counter].'" id="report_id'.$counter.'">';
					echo '<input type="hidden" value="'.$potentialAvg[$counter].'" id="potentialAvg'.$counter.'">';
					$counter++;
				}
			?>
			<button type="button" id="insert_adminOp">Insert</button>
			<input type="hidden" value="" id="modify_report">
			<input type="hidden" id="numOfOps" name="numOfOps" value="<?php echo $count;?>">		
		</div>
		
		<div id="tab19">
			<?php 
				$getReportId = $_REQUEST['reportid'];
				$query = "SELECT orgname FROM report WHERE reportid = '$getReportId'";
				$result = mysql_query($query) or die('Error Fetching List From Database.');
				$fetch=mysql_fetch_array($result);
				$orgname=$fetch['orgname'];

				$query = "SELECT objective, limits, circonscription, perimeter, represent, fonction, function_text, pre_circonscription FROM outil_parameter WHERE r_id = '$getReportId'";
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
			?>	
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

		</div>
		<?php 
			mysql_close($con);
		?>
	</div>	
		
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
