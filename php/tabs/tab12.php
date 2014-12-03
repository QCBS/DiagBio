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