<h3>Choisissez un groupe de services écosystémiques :</h3>
<ol class="selectables" id="selectable">	
	<?php
	mysql_query("SET NAMES 'utf8");
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
				