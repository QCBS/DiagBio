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