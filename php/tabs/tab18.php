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