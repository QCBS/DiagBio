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