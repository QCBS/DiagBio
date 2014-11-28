<div class="infoList">
	<h4>Vous Avez Choisi:</h4> 
	<label class="se_label" for=""></label>
	<label class="c_label" for=""></label>
	<label class="example_label" for=""></label>
	<label class="dependance_label" for=""></label>
	<label class="impact_label" for=""></label>
</div>
	<br><br><br>

<h3>Évaluez votre interdépendance</h3>

<div><fieldset class="infoList"><legend class="font_legend"><b>légende</legend>Très faible : votre activité dépend peu du service écosystémique choisi.<br>
Très forte : Le SE choisi est un facteur clef de vos activités, celles-ci en dépendent donc en grande partie.<br>
 </fieldset></div>

<select name="slides" id="slides">
<?php 
	$counting=1;
	while($counting <= 5)
	{
		echo ' <option>'.$counting.'</option>';
		$counting++;
	}
?>
 </select>
<br><br><br><br>

<div id="displayOption1" class="OptionDivs">Très faible</div>
<div id="displayOption2" class="OptionDivs">Faible</div>
<div id="displayOption3" class="OptionDivs">Modéré</div>
<div id="displayOption4" class="OptionDivs">Forte</div>
<div id="displayOption5" class="OptionDivs">Très forte</b></div>

<div id="slider" style="height:200px;"></div><br>
<div id="dep_textarea" style="height:200px">
<h5>Votre avis:</h5>
<textarea rows="4" cols="50" id="dep_txt" name="dep_txt">
</textarea>
</div>					
<br>
<input type="hidden" id="interdependancePotential" name="interdependancePotential" value="">
<input type="hidden" id="interdependanceAverage" name="interdependanceAverage" value="">
<input type="hidden" id="niveauDependance" name="niveauDependance" value="">
<button type="button" id="TAB11_BTN_BACK">Précédent</button>  <!-- go to tab 10 -->
<button type="button" id="impact_btn_next">Suivant</button>