<?php
	header('content-type: application/json; charset=utf-8');
	header("access-control-allow-origin: *");
	include('/var/www/quebio.ca/misc/dbaminfo.php');
	$path = $_SERVER['DOCUMENT_ROOT'];
	chdir($path);
	define('DRUPAL_ROOT', getcwd());
	require_once './includes/bootstrap.inc';
	drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

	module_load_include('inc', 'profile2_page', 'profile2_page');

	$adminid = $_POST['adminid'];
	$reportid = $_POST['reportid'];


	$account = user_load($adminid); // Load Themporary User with "Administration" Role.
	$profile = profile2_load_by_user($account); // Load The Profile2 Data Associated to The User.
	$nomUtilisateur = field_get_items('profile2', $profile['administration'], 'field_nom_utilisateur');
	$courriel = field_get_items('profile2', $profile['administration'], 'field_courriel');
	$nom = field_get_items('profile2', $profile['administration'], 'field_nom');
	$prenom = field_get_items('profile2', $profile['administration'], 'field_prenom');
	$adresse = field_get_items('profile2', $profile['administration'], 'field_adresse');
	$ville = field_get_items('profile2', $profile['administration'], 'field_ville');
	$code_postal = field_get_items('profile2', $profile['administration'], 'field_code_post');
	$organisation = field_get_items('profile2', $profile['administration'], 'field_nom_de_l_organisation');
	$organisationAddresse = field_get_items('profile2', $profile['administration'], 'field_addresse_d_organisation');
	$fonction = field_get_items('profile2', $profile['administration'], 'field_fonction');
	$organisationVille = field_get_items('profile2', $profile['administration'], 'field_ville_organisation_');
	$organisationCP = field_get_items('profile2', $profile['administration'], 'field_code_postal');
	$secteur = field_get_items('profile2', $profile['administration'], 'field_secteur_d_activite');
	$motivation = field_get_items('profile2', $profile['administration'], 'field_quelle_est_la_motivation_p');


	// Connect to the Database
	$con = mysql_connect($mys_host, $mys_username, $mys_pass) or die('Could Not Connect To The Database.');
	mysql_select_db($mys_base, $con);
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET CHARACTER SET 'utf8'");
	$query = "SELECT Direction, Interne, Externe FROM report WHERE reportid = '$reportid'";
	$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
	$participant = mysql_fetch_row($results);

	//$query = "SELECT objective, limits, define, circonscription, represent, fonction, niveau FROM outil_parameter WHERE r_id = '$reportid'";
	# Modified by Guillaume. define and niveau are missing fields
	$query = "SELECT objective, limits, circonscription, represent, fonction FROM outil_parameter WHERE r_id = '$reportid'";
	$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
	$parameter = mysql_fetch_row($results);

	$avg_impct_size=1;
	$c_names = array();
	$average_impact_levels = array();
	$query = "SELECT c_name, avg(average_impact_level) as average_impact FROM interdependances WHERE r_id = '$reportid' AND average_impact_level IS NOT NULL GROUP BY c_name";  //get the x-axis values for the average impacts high charts
	$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
	while($ob=mysql_fetch_array($results)){
		$c_names[]=$ob['c_name'];
		$average_impact_levels[]=$ob['average_impact'];
		$avg_impct_size++;
	};

	$pot_impct_size=1;
	$potential_impacts = array();
	$pot_c_names = array();
	$query = "SELECT c_name, avg(potential_impact_level) as potential_impact FROM interdependances WHERE r_id = '$reportid' AND potential_impact_level IS NOT NULL GROUP BY c_name";  //get the x-axis values for the average impacts high charts
	$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
	while($ob=mysql_fetch_array($results)){
		$potential_impacts[] = $ob['potential_impact'];
	    //$c_names[] = $ob['c_name'];
		$pot_c_names[] = $ob['c_name'];
		$pot_impct_size++;
	}

	$avg_dep_size=1;
	$avg_deps = array();
	$avg_dep_c_names = array();
	$query = "SELECT c_name, avg(average_dependance_level) as average_dependance FROM interdependances WHERE r_id = '$reportid' AND average_dependance_level IS NOT NULL GROUP BY c_name";  //get the x-axis values for the average impacts high charts
	$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
	while($ob=mysql_fetch_array($results)){
		$avg_deps[] = $ob['average_dependance'];
	    //$c_names[] = $ob['c_name'];
	    $avg_dep_c_names = $ob['c_name'];
		$avg_dep_size++;
	}

	$pot_dep_size=1;
	$potential_deps = array();
	$pot_dep_c_names = array();
	$query = "SELECT c_name, avg(potential_dependance_level) as potential_dependance FROM interdependances WHERE r_id = '$reportid' AND potential_dependance_level IS NOT NULL GROUP BY c_name";  //get the x-axis values for the average impacts high charts
	$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
	while($ob=mysql_fetch_array($results)){
		$potential_deps[] = $ob['potential_dependance'];
	    //$c_names[] = $ob['c_name'];
		$pot_dep_c_names[] = $ob['c_name'];
		$pot_dep_size++;
	}

/*	THE FIRST CHART, SHOWING THE AVERAGES OF ALL THE RESPONSES WITH THE ECOLOGICAL SERVICES*/

$se_categories_size = 0;
$se_categories_avgs[] = array();
$count = 1;
while($count < 12){
	$query = "SELECT count( distinct c_id) as se_average FROM interdependances WHERE r_id = '$reportid' AND se_id = '$count'";  //get the x-axis values for the average impacts high charts
	$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
	while($ob=mysql_fetch_array($results)){
	  
	    $se_categories_avgs[] = $ob['se_average'];
		$se_categories_size++;
	}
	$count++;
}

$se_categories[] = array();
$count = 1;
while($count < 12){
	$query = "SELECT se_name FROM services_ecologiques WHERE se_id = '$count'";  //get the x-axis values for the average impacts high charts
	$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
	while($ob=mysql_fetch_array($results)){
  		$se_categories[] = $ob['se_name'];}
  	$count++;
}

$query = "SELECT count(distinct u_id) FROM interdependances WHERE r_id = '$reportid'";  //get the x-axis values for the average impacts high charts
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
$totalPpl = mysql_fetch_row($results);

//MONEY CHART DATA

$count = 1;
$se_money_pos = [];
while ($count < 12) {
	$query = "SELECT count(distinct u_id) as se_money FROM interdependances WHERE r_id = '$reportid' AND se_id = '$count' AND gotMoney = 'Non'";
	$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
	while($ob=mysql_fetch_array($results)){
  		$se_money_pos[] = $ob['se_money'];}
  	$count++;
}  	

$count = 1;
$se_money_neg = [];
while ($count < 12) {
	$query = "SELECT count(distinct u_id) as se_money FROM interdependances WHERE r_id = '$reportid' AND se_id = '$count' AND gotMoney = 'Oui'";
	$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
	while($ob=mysql_fetch_array($results)){
  		$se_money_neg[] = $ob['se_money'];}
  	$count++;
}  	

//for the appendix, the list that has all the data
$list_size = 0;
$list_se_name = array();
$list_c_name = array();
$list_example = array();
$list_dependance = array();
$list_impact = array();
$list_pot_dep = array();
$list_avg_dep = array();
$list_pot_impact = array();
$list_avg_impact = array();
$query = "SELECT se_name, c_name, example, dependance, impact, niveau_impact, niveau_dependance, potential_dependance_level as pot_dep, average_dependance_level as avg_dep, average_impact_level as avg_impact, potential_impact_level as pot_impact FROM interdependances WHERE r_id = '$reportid' ";  
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
while($ob=mysql_fetch_array($results)){
	$list_se_name[] = $ob['se_name'];
	$list_c_name[] = $ob['c_name'];
	$list_example[] = $ob['example'];
	$list_dependance[] = $ob['dependance'];
	$list_impact[] = $ob['impact'];
	$list_pot_dep[] = $ob['pot_dep'];
	$list_avg_dep[] = $ob['avg_dep'];
	$list_avg_impact[] = $ob['avg_impact'];
	$list_pot_impact[] = $ob['pot_impact'];
	$list_niveau_impact[] = $ob['niveau_impact'];
	$list_niveau_dependance[] = $ob['niveau_dependance'];
	$list_size++;
}

//for the list that will have all the potential/average impacts/dependances
$list4and5_se_name = [];
$list4and5_c_name = [];
$list4and5_example = [];
$list4and5_dependance = [];
$list4and5_impact = [];
$list4and5_size = 0;
$query = "SELECT se_name, c_name, example, dependance, impact FROM interdependances WHERE r_id = '$reportid' AND (niveau_dependance = 4 or niveau_dependance = 5 or niveau_impact = 4 or niveau_impact = 5)";  
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
while($ob=mysql_fetch_array($results)){
	if ($ob['dependance'] == 'null') {
		$ob['dependance'] = '';
	}
	if ($ob['impact'] == 'null') {
		$ob['impact'] = '';
	}
	$list4and5_se_name[] = $ob['se_name'];
	$list4and5_c_name[] = $ob['c_name'];
	$list4and5_example[] = $ob['example'];
	$list4and5_dependance[] = $ob['dependance'];
	$list4and5_impact[] = $ob['impact'];
	$list4and5_size++;
}

$query = "SELECT count(distinct example) FROM interdependances WHERE r_id = '$reportid' AND moneyType = 'Taxe'";  //get the x-axis values for the average impacts high charts
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
$taxMoney = mysql_fetch_row($results);

$query = "SELECT count(distinct example) FROM interdependances WHERE r_id = '$reportid' AND moneyType = 'Paiement pour services environnementaux'";  //get the x-axis values for the average impacts high charts
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
$envirMoney = mysql_fetch_row($results);

$query = "SELECT count(distinct example) FROM interdependances WHERE r_id = '$reportid' AND moneyType = 'Redevance'";  //get the x-axis values for the average impacts high charts
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
$redMoney = mysql_fetch_row($results);

$query = "SELECT count(distinct example) FROM interdependances WHERE r_id = '$reportid' AND moneyType != 'Taxe' AND moneyType != 'Redevance' AND moneyType != 'Paiement pour services environnementaux'";  
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
$autreMoney = mysql_fetch_row($results);

$query = "SELECT count(distinct example) FROM interdependances WHERE r_id = '$reportid' AND (process = 'Les finances' or secondProcess = 'Les finances')";  //get the x-axis values for the average impacts high charts
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
$finance_pro = mysql_fetch_row($results);

$query = "SELECT count(distinct example) FROM interdependances WHERE r_id = '$reportid' AND (process = 'La gestion des opérations' or secondProcess = 'La gestion des opérations')";  //get the x-axis values for the average impacts high charts
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
$mar_pro = mysql_fetch_row($results);

$query = "SELECT count(distinct example) FROM interdependances WHERE r_id = '$reportid' AND (process = 'Les opérations quotidiennes' or secondProcess = 'Les opérations quotidiennes')";  //get the x-axis values for the average impacts high charts
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
$rep_pro = mysql_fetch_row($results);

$query = "SELECT count(distinct example) FROM interdependances WHERE r_id = '$reportid' AND (process = 'Les ressources humaines' or secondProcess = 'Les ressources humaines')";  //get the x-axis values for the average impacts high charts
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
$op_pro = mysql_fetch_row($results);

$query = "SELECT count(distinct example) FROM interdependances WHERE r_id = '$reportid' AND (process = 'Le marketing' or secondProcess = 'Le marketing')";  //get the x-axis values for the average impacts high charts
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
$rule_pro = mysql_fetch_row($results);

$count = 1;
$operation_f = [];
$operation_m = [];
$operation_r = [];
$operation_o = [];
$operation_ru = [];
while ($count < 12) {
	$query = "SELECT count(distinct u_id) as operation_f FROM interdependances WHERE r_id = '$reportid' AND se_id = '$count' AND (process = 'Les finances' or secondProcess = 'Les finances')";
	$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
	$operation_f[] = mysql_fetch_row($results);

	$query = "SELECT count(distinct u_id) as operation_m FROM interdependances WHERE r_id = '$reportid' AND se_id = '$count' AND (process = 'La gestion des opérations' or secondProcess = 'La gestion des opérations')";
	$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
	$operation_m[] = mysql_fetch_row($results);

	$query = "SELECT count(distinct u_id) as operation_r FROM interdependances WHERE r_id = '$reportid' AND se_id = '$count' AND (process = 'Les opérations quotidiennes' or secondProcess = 'Les opérations quotidiennes')";
	$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
	$operation_r[] = mysql_fetch_row($results);

	$query = "SELECT count(distinct u_id) as operation_o FROM interdependances WHERE r_id = '$reportid' AND se_id = '$count' AND (process = 'Les ressources humaines' or secondProcess = 'Les ressources humaines')";
	$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
	$operation_o[] = mysql_fetch_row($results);

	$query = "SELECT count(distinct u_id) as operation_ru FROM interdependances WHERE r_id = '$reportid' AND se_id = '$count' AND (process = 'Le marketing' or secondProcess = 'Le marketing')";
	$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
	$operation_ru[] = mysql_fetch_row($results);

  	$count++;
}  	

$names_D = [];
$last_names_D = [];
$emails_D = [];
$phones_D = [];
$groups = [];
$niveau_size = 0;
$query = "SELECT name, last_name, email, phone, groupType FROM outil_contact_info WHERE r_id = '$reportid'";
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
while($ob=mysql_fetch_array($results)){
	$names_D[] = $ob['name'];
	$last_names_D[] = $ob['last_name'];
	$emails_D[] = $ob['email'];
	$phones_D[] = $ob['phone'];
	$groups[] = $ob['groupType'];
	$niveau_size++;	
}

$examplesIA = [];
$opinionsIA = [];
$potential_avgsIA = [];
$opinion_idsIA = [];
$IA_size = 0;
$paymentsIA = [];
$query = "SELECT example, opinion, opinion_ids, impact_niveau, payment FROM outil_admin_opinions WHERE 
r_id = '$reportid' AND impact = 'Un impact avéré' AND (impact_niveau = 4 OR impact_niveau = 5)";
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
while($ob=mysql_fetch_array($results)){
	$examplesIA[] = $ob['example'];
	$opinionsIA[] = $ob['opinion'];
	$potential_avgsIA[] = $ob['impact_niveau'];
	$opinion_idsIA[] = $ob['opinion_ids'];
	$paymentsIA[] = $ob['payment'];
	$IA_size++;
}

$examplesDA = [];
$opinionsDA = [];
$potential_avgsDA = [];
$opinion_idsDA = [];
$paymentsDA = [];
$DA_size = 0;
$query = "SELECT example, opinion, opinion_ids, dependance_niveau, payment FROM outil_admin_opinions WHERE 
r_id = '$reportid' AND dependance = 'Une dépendance avérée' AND (dependance_niveau = 4 OR dependance_niveau = 5)";
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
while($ob=mysql_fetch_array($results)){
	$examplesDA[] = $ob['example'];
	$opinionsDA[] = $ob['opinion'];
	$potential_avgsDA[] = $ob['dependance_niveau'];
	$opinion_idsDA[] = $ob['opinion_ids'];
	$paymentsDA[] = $ob['payment'];
	$DA_size++;
}


$examplesIP = [];
$opinionsIP = [];
$potential_avgsIP = [];
$opinion_idsIP = [];
$paymentsIP = [];
$IP_size = 0;
$query = "SELECT example, opinion, opinion_ids, impact_niveau, payment FROM outil_admin_opinions WHERE 
r_id = '$reportid' AND impact = 'Un impact potentiel' AND (impact_niveau = 4 OR impact_niveau = 5)";
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
while($ob=mysql_fetch_array($results)){
	$examplesIP[] = $ob['example'];
	$opinionsIP[] = $ob['opinion'];
	$potential_avgsIP[] = $ob['impact_niveau'];
	$opinion_idsIP[] = $ob['opinion_ids'];
	$paymentsIP[] = $ob['payment'];
	$IP_size++;
}

$examplesDP = [];
$opinionsDP = [];
$potential_avgsDP = [];
$opinion_idsDP = [];
$paymentsDP = [];
$DP_size = 0; 
$query = "SELECT example, opinion, opinion_ids, dependance_niveau, payment FROM outil_admin_opinions WHERE 
r_id = '$reportid' AND dependance = 'Une dépendance potentielle' AND (dependance_niveau = 4 OR dependance_niveau = 5)";
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);
while($ob=mysql_fetch_array($results)){
	$examplesDP[] = $ob['example'];
	$opinionsDP[] = $ob['opinion'];
	$potential_avgsDP[] = $ob['dependance_niveau'];
	$opinion_idsDP[] = $ob['opinion_ids'];
	$paymentsDP[] = $ob['payment'];
	$DP_size++;
}

//Get the data to fill the money ranking tables
$money_examples = [];
$levels = [];
$payments = [];
$money_size = 0;
$query = "SELECT example, dependance_niveau, payment FROM outil_admin_opinions WHERE 
r_id = '$reportid' AND dependance = 'Une dépendance avérée' AND (dependance_niveau = 5 OR dependance_niveau = 4) GROUP BY example ORDER BY example";
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);				
while ($row = mysql_fetch_assoc($results)) {
	$money_examples[] = $row['example'];
	$levels[] = $row['dependance_niveau'];
	$payments[] = $row['payment'];
	$money_size++;
}

$query = "SELECT example, impact_niveau, payment FROM outil_admin_opinions WHERE 
r_id = '$reportid' AND impact = 'Un impact avéré' AND (impact_niveau = 4  OR impact_niveau = 5) GROUP BY example ORDER BY example";
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);				
while ($row = mysql_fetch_assoc($results)) {
	$money_examples[] = $row['example'];
	$levels[] = $row['impact_niveau'];
	$payments[] = $row['payment'];
	$money_size++;
}

$money_examples2 = [];
$levels2 = [];
$payments2 = [];
$money_size2 = 0;
$query = "SELECT example, dependance_niveau, payment FROM outil_admin_opinions WHERE 
r_id = '$reportid' AND dependance = 'Une dépendance potentielle' AND (dependance_niveau = 5 OR dependance_niveau = 4) GROUP BY example ORDER BY example";
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);				
while ($row = mysql_fetch_assoc($results)) {
	$money_examples2[] = $row['example'];
	$levels2[] = $row['dependance_niveau'];
	$payments2[] = $row['payment'];
	$money_size2++;
}

$query = "SELECT example, impact_niveau, payment FROM outil_admin_opinions WHERE 
r_id = '$reportid' AND impact = 'Un impact potentielle' AND (impact_niveau = 4  OR impact_niveau = 5) GROUP BY example ORDER BY example";
$results = mysql_query($query) or die('Error Fetching List From Database.'.$query);				
while ($row = mysql_fetch_assoc($results)) {
	$money_examples2[] = $row['example'];
	$levels2[] = $row['impact_niveau'];
	$payments2[] = $row['payment'];
	$money_size2++;
}

mysql_close($con);
//All the data being send to the Report and the charts
	$values = array(
		"money_size" => $money_size,
		"levels" => $levels,
		"money_examples" => $money_examples,
		"payments" => $payments,
		"levels2" => $levels2,
		"money_examples2" => $money_examples2,
		"payments2" => $payments2,
		"money_size2" => $money_size2,
		"opinion_idsIA" => $opinion_idsIA,
		"potential_avgsIA" => $potential_avgsIA,
		"opinionsIA" => $opinionsIA,
		"examplesIA" => $examplesIA,
		"IA_size" => $IA_size,
		"opinion_idsDA" => $opinion_idsDA,
		"potential_avgsDA" => $potential_avgsDA,
		"opinionsDA" => $opinionsDA,
		"examplesDA" => $examplesDA,
		"DA_size" => $DA_size,
		"opinion_idsIP" => $opinion_idsIP,
		"potential_avgsIP" => $potential_avgsIP,
		"opinionsIP" => $opinionsIP,
		"examplesIP" => $examplesIP,
		"IP_size" => $IP_size,
		"opinion_idsDP" => $opinion_idsDP,
		"potential_avgsDP" => $potential_avgsDP,
		"opinionsDP" => $opinionsDP,
		"examplesDP" => $examplesDP,
		"DP_size" => $DP_size,
		"nom" => $nom[0]['value'],
		"nomUtilisateur" => $nomUtilisateur[0]['value'],
		"courriel" => $courriel[0]['value'],
		"prenom" => $prenom[0]['value'],
		"adresse" => $adresse[0]['value'],
		"ville" => $ville[0]['value'],
		"code_postal" => $code_postal[0]['value'],
		"organisation" => $organisation[0]['value'],
		"fonction" => $fonction[0]['value'],
		"secteur" => $secteur[0]['value'],
		"organisationAddresse" => $organisationAddresse[0]['value'],
		"organisationVille" => $organisationVille[0]['value'],
		"organisationCP" => $organisationCP[0]['value'],
		"motivation" => $motivation[0]['value'],
		"direction" => $participant[0],
		"interne" => $participant[1],
		"externe" => $participant[2],
		"objective" => $parameter[0],
		"limit" => $parameter[1],
		//"define" => $parameter[2],
		"circonscription" => $parameter[2],
		"represent" => $parameter[3],
		"fonction" => $parameter[4],
		//"niveau" => $parameter[5],
		"totalPpl" => $totalPpl,
		"se_money_neg" => $se_money_neg,
		"se_money_pos" => $se_money_pos,
		"list_se_name" => $list_se_name,
		"list_c_name" => $list_c_name,
		"list_example" => $list_example,
		"list_dependance" => $list_dependance,
		"list_impact" => $list_impact,
		"list_pot_dep" => $list_pot_dep,
		"list_avg_dep" => $list_avg_dep,
		"list_pot_impact" => $list_pot_impact,
		"list_avg_impact" => $list_avg_impact,
		"list_niveau_dependance" => $list_niveau_dependance,
		"list_niveau_impact" => $list_niveau_impact,
		"list_size" => $list_size,
		"list4and5_se_name" => $list4and5_se_name,
		"list4and5_c_name" => $list4and5_c_name,
		"list4and5_example" => $list4and5_example,
		"list4and5_dependance" => $list4and5_dependance,
		"list4and5_impact" => $list4and5_impact,
		"list4and5_size" => $list4and5_size,
		"taxMoney" => $taxMoney,
		"redMoney" => $redMoney,
		"envirMoney" => $envirMoney,
		"autreMoney" => $autreMoney,
		"finance_pro" => $finance_pro,
		"mar_pro" => $mar_pro,
		"rep_pro" => $rep_pro,
		"op_pro" => $op_pro,
		"rule_pro" => $rule_pro,
		"operation_m" => $operation_m,
		"operation_f" => $operation_f,
		"operation_r" => $operation_r,
		"operation_o" => $operation_o,
		"operation_ru" => $operation_ru,
		"names_D" => $names_D,
		"last_names_D" => $last_names_D,
		"emails_D" => $emails_D,
		"phones_D" => $phones_D,
		"groups" => $groups,
		"niveau_size" => $niveau_size,
		"xaxis" => array( //array for the x axis for the average impacts high chart
				"c_names" => $c_names,
				"c_name_average_impact" => $average_impact_levels,
				"avg_impct_size" => $avg_impct_size,
				"pot_impct_size" => $pot_impct_size,
				"potential_impacts" => $potential_impacts,
				"avg_deps" => $avg_deps,
				"pot_c_names" => $pot_c_names,
				"potential_deps" => $potential_deps,
				"avg_dep_size" => $avg_dep_size,
				"pot_dep_size" => $pot_dep_size,
				"pot_dep_c_names" => $pot_dep_c_names,
				"avg_dep_c_names" => $avg_dep_c_names,
				"se_categories_avgs" => $se_categories_avgs,
				"se_categories" => $se_categories,
				"se_categories_size" => $se_categories_size
				)
	);		
	echo(json_encode($values));
?>