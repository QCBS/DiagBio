<?php
	header("Access-Control-Allow-Origin: *");
	include('/var/www/quebio.ca/misc/dbaminfo.php');

	$path = $_SERVER['DOCUMENT_ROOT'];
	chdir($path);
	define('DRUPAL_ROOT', getcwd());
	require_once './includes/bootstrap.inc';
	drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

	$con = mysql_connect($mys_host, $mys_username, $mys_pass) or die('Could Not Connect To The Database.');
	mysql_select_db($mys_base, $con);
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET CHARACTER SET 'utf8'");

	$userid = $_POST['userid'];
	$account = user_load($userid); // Load Themporary User with "Administration" Role.
	$profile = profile2_load_by_user($account); // Load The Profile2 Data Associated to The User.

    $nom = field_get_items('profile2', $profile['administration'], 'field_nom');
    $prenom = field_get_items('profile2', $profile['administration'], 'field_prenom');
    $gender = field_get_items('profile2', $profile['administration'], 'field_sexe'); 
    $courriel = field_get_items('profile2', $profile['administration'], 'field_courriel');  
    //$organisation = field_get_items('profile2', $profile['administration'], 'field_nom_de_l_organisation');
	// Get Details to be Included in The E-mail.
	$to = $_POST['toEmail'];
	$orgname = $_POST['orgname'];
	$additionalInformation = utf8_encode(htmlentities($_POST['information'], ENT_QUOTES, "UTF-8"));
	$reportId = $_POST['reportID'];

	$query="SELECT uid FROM drupal_users WHERE mail=".$_POST['toEmail'];
	$result = mysql_query($query);
	$fetch = mysql_fetch_array($result);
	if($fetch){
		$query="INSERT INTO outil_user_evaluation (u_id, r_id) VALUES ('".$_POST['toEmail']."','".$_POST['reportID']."')";
		$result = mysql_query($query);
	} else{
		$query = "INSERT INTO outil_invitations (email, evaluation_id) VALUES ('".$_POST['toEmail']."','".$_POST['reportID']."')";
		$result = mysql_query($query) or die('Error Fetching List From Database.');
	}
	$query = "SELECT orgname FROM report WHERE adminid = '$userid' AND reportid = '$reportId' ";
	$result = mysql_query($query) or die('Error Fetching List From Database.');
	$fetch=mysql_fetch_array($result);
	$orgsname=$fetch['orgname'];

	mysql_close($con);

	// E-mail Subject.
	$subject = 'Invitation a l\'évaluation de votre entreprise.';

	// E-mail Header Information.
	$headers = "From: " . "info@quebio.ca" . "\r\n";
	$headers .= "Reply-To: ". "info@quebio.ca" . "\r\n";
	$headers .= "CC: Quebio\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=utf-8\r\n";

	// E-mail Body With Information Appended.
	$message .= '<b>'.$gender[0]['value'].' '.$prenom[0]['value'].' '.$nom[0]['value'].', <br><br></b>'; 
	$message .= 'Évalue actuellement les interdépendances aux BSE de l’organisation<br> suivante : '.$orgsname.',<br><br>';
	//$message .= 'Nous pensons que vous pouvez contribuer valablement a cette évaluation<br> qui va concerner <a href=\'http://quebio.ca/entreprisebio/#tab3\'>quebio.ca/entreprisebio</a> <br><br>';
	$message .= 'Votre opinion comme celle des autres parties prenantes va être importante <br>';
	$message .= 'pour identifier des plans d’actions et de surveillance qui devront être mis en <br>';
	$message .= 'œuvre par l’organisation. <br><br>';
	$message .= 'Si vous souhaitez contribuer à cette évaluation, merci de suivre les <br>';
	$message .= 'instructions suivantes : <br><br>';
	$message .= '1) Créer un <a href="http://quebio.ca/bseentreprises/#tab3">compte </a><br><br>';
	$message .= '2) Utilisez ce lien pour nous faire <a href="http://quebio.ca/bseentreprises?reportid=' . $reportId . '"> parvenir votre opinion</a> <br><br>';
	$message .= 'Si vous avez des questions, n’hésitez pas a nous contacter pour de plus<br>';
	$message .= 'amples informations. <br><br>';
	$message .= 'Nous vous remercions pour votre attention et vous assurons de nos<br>';
	$message .= 'sentiments les meilleurs'.$courriel[0]['value'].'. <br><br>';
	$message .=  $gender[0]['value'].' '.$prenom[0]['value'].' '.$nom[0]['value'].'<br>';

	$message .= "<br><br><br>";
	$message .= '<html><body>';
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= "<tr style='background: #eee;'><td><strong>Nom de l'entreprise:</strong> </td><td>" . $orgsname . "</td></tr>";
	$message .= "<tr><td><strong>Lien vers l'évaluation:</strong> </td><td>" . "<a href='http://quebio.ca/bseentreprises?reportid=" . $reportId . "'>Appuyer Ici</a>" . "</td></tr>";
	$message .= "<tr><td><strong>Enregistrement d'un nouveau compte:</strong> </td><td>" . "<a href='http://quebio.ca/bseentreprises/'>Appuyer Ici</a>" . "</td></tr>";$message .= "<tr><td><strong>Additional Information:</strong> </td><td>" . $additionalInformation . "</td></tr>";
	$message .= "</table>";
	$message .= "</body></html>";
	// Send E-mail.
	$email = mail($to, $subject, $message, $headers);

	if ($email)
		echo "Les invitations ont été envoyées avec succès.";
	else
		echo "Une erreur s'est produite (Vérifier le format des adresses courriels).";
?>