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