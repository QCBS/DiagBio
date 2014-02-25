<?php
	include '/misc/dbaminfo.php';

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
	$nom = field_get_items('profile2', $profile['administration'], 'field_nom');
	$prenom = field_get_items('profile2', $profile['administration'], 'field_prenom');
	$adresse = field_get_items('profile2', $profile['administration'], 'field_adresse');
	$ville = field_get_items('profile2', $profile['administration'], 'field_ville');
	$code_postal = field_get_items('profile2', $profile['administration'], 'field_code_post');
	$organisation = field_get_items('profile2', $profile['administration'], 'field_nom_de_l_organisation');
	$fonction = field_get_items('profile2', $profile['administration'], 'field_fonction');
	$statut = field_get_items('profile2', $profile['administration'], 'field_statut');
	$secteur = field_get_items('profile2', $profile['administration'], 'field_secteur_d_activite');
	$salaries = field_get_items('profile2', $profile['administration'], 'field_salaries');
	$parties_prenantes = field_get_items('profile2', $profile['administration'], 'field_parties_prenantes');

	// Connect to the Database
	$con = mysql_connect('localhost', 'qcbscartographie', 'dsbWVmveVY3Xy4JX') or die('Could Not Connect To The Database.');

	mysql_select_db('qcbscartographie', $con);

	$query = "SELECT Direction, Interne, Externe FROM report WHERE reportid = '$reportid'";
	$results = mysql_query($query) or die('Error Fetching List From Database.');
	$participant = mysql_fetch_row($results);

	$query = "SELECT AVG(IF(c_id BETWEEN 1 AND 6, evaluation, NULL)) as '0',
					 AVG(IF(c_id BETWEEN 7 AND 8, evaluation, NULL)) as '1',
					 AVG(IF(c_id BETWEEN 9 AND 11, evaluation, NULL)) as '2',
					 AVG(IF(c_id BETWEEN 12 AND 13, evaluation, NULL)) as '3',
					 AVG(IF(c_id BETWEEN 14 AND 16, evaluation, NULL)) as '4',
					 AVG(IF(c_id BETWEEN 17 AND 21, evaluation, NULL)) as '5',
					 AVG(IF(c_id BETWEEN 22 AND 24, evaluation, NULL)) as '6',
					 AVG(IF(c_id BETWEEN 25 AND 26, evaluation, NULL)) as '7',
					 AVG(IF(c_id BETWEEN 27 AND 28, evaluation, NULL)) as '8',
					 AVG(IF(c_id BETWEEN 29 AND 30, evaluation, NULL)) as '9'
					 FROM interdependances WHERE r_id = '$reportid'";
	$results = mysql_query($query) or die('Error Fetching List From Database.');
	while($agregeInterdependances[]=mysql_fetch_array($results));

	$query = "SELECT AVG(IF(c_id BETWEEN 1 AND 6, money, NULL)) as '0',
					 AVG(IF(c_id BETWEEN 7 AND 8, money, NULL)) as '1',
					 AVG(IF(c_id BETWEEN 9 AND 11, money, NULL)) as '2',
					 AVG(IF(c_id BETWEEN 12 AND 13, money, NULL)) as '3',
					 AVG(IF(c_id BETWEEN 14 AND 16, money, NULL)) as '4',
					 AVG(IF(c_id BETWEEN 17 AND 21, money, NULL)) as '5',
					 AVG(IF(c_id BETWEEN 22 AND 24, money, NULL)) as '6',
					 AVG(IF(c_id BETWEEN 25 AND 26, money, NULL)) as '7',
					 AVG(IF(c_id BETWEEN 27 AND 28, money, NULL)) as '8',
					 AVG(IF(c_id BETWEEN 29 AND 30, money, NULL)) as '9'
					 FROM interdependances WHERE r_id = '$reportid'";
	$results = mysql_query($query) or die('Error Fetching List From Database.');
	while($agregeMoney[]=mysql_fetch_array($results));

	$query = "SELECT AVG(evaluation), AVG(money), c_id FROM interdependances WHERE r_id = '$reportid' GROUP BY c_id";
	$results = mysql_query($query) or die('Error Fetching List From Database.');
	while($row=mysql_fetch_row($results)){
		$detailInterdependances[$row[2]] = $row[0];
		$detailMoney[$row[2]] = $row[1];
	}

	mysql_close($con);

	$values = array(
		"nom" => $nom[0]['value'],
		"prenom" => $prenom[0]['value'],
		"adresse" => $adresse[0]['value'],
		"ville" => $ville[0]['value'],
		"code_postal" => $code_postal[0]['value'],
		"organisation" => $organisation[0]['value'],
		"fonction" => $fonction[0]['value'],
		"statut" => $statut[0]['value'],
		"secteur" => $secteur[0]['value'],
		"salaries" => $salaries[0]['value'],
		"parties_prenantes" => $parties_prenantes[0]['value'],
		"direction" => $participant[0],
		"interne" => $participant[1],
		"externe" => $participant[2],
		"agrege" => array(
				"interdependances" => $agregeInterdependances[0],
				"money" => $agregeMoney[0]
			),
		"detail" => array(
				"interdependances" => $detailInterdependances,
				"money" => $detailMoney
			)
	);		

	echo(json_encode($values));
?>