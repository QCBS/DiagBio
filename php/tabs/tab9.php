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