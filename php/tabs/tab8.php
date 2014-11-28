<h3><b>Examples</b></h3>

<?php

$query = "SELECT c_id as cnt FROM classification ORDER BY c_id DESC LIMIT 1";
$result = mysql_query($query) or die('Error Fetching List From Database.');
$fetch=mysql_fetch_array($result);
$numOfRows=$fetch['cnt'];

$count=1;
while($count <= $numOfRows)	 //go throguh each classification
{
	echo '<div class="selectExamples" id="example'.$count.'">';
	echo '<ol class="select_example selectables" id="selectable'.$count.'">';

	$query = "SELECT * FROM c_examples WHERE c_id = '$count'";
	$results = mysql_query($query) or die('Error Fetching List From Database.');

	while ($row = mysql_fetch_assoc($results)) //get all the examples with the associated classification and create them as selectables
	{ 
		if( $row['example'] == "aucune example")
		{
			echo 'aucune exemple';
		}
		else
		{
			?>
			<li class="ui-state-default" title="choisissez un de ces exemples" id=<?php echo "\"" . $row['example_id'] . "\""; ?>><?php echo $row['example'];?></li>
			<?php
		}
		
	}

	$count++;  //go to the next example
	echo '</ol>';
	echo  '</div>';
}
?>

<br><br>
<h3><b>Nommez l'interdépendance</b></h3>
<input type="text" name="newExample" id="newExample" style="width: 300px;"><br>
<br><br>
<div id="theFirstGroup"> <!-- div which contains all the HTML element createdz-->
</div>
<div id="divDD" class="centreBTN2">
</div>
<div id="dd_btn" class="centreBTN2">
	<button type="button" id="theExistingExample">Choisir cette exemple</button><br><br>
</div>
<div id="theSecondGroup"> <!-- div which contains all the HTML element created-->

</div>

<div class="centreBTN2">
	<!--<button type="button" id="theNewExample">Inserer un nouvel exemple</button><br><br> button which insert a new interdependance example-->
	<!--<input id="submit" type="submit" value="Enregistrer vos données"> POST BACK-->
	<button type="button" id="LAST_BTN_BACK">Précédent</button>  <!--Go back to tab 3-->
	<button type="button" id="TAB9_BTN_NEXT">Suivant</button> <!--go to tab 9 -->
</div>

<!--Hidden fields which will be passed along with the HTML elements to next PHP script-->
<input type="hidden" id="se_i" name="se_i" value="">
<input type="hidden" id="se_name" name="se_name" value="">
<input type="hidden" id="c_i" name="c_i" value="">
<input type="hidden" id="c_i_val" name="c_i_val" value="">
<input type="hidden" id="chosenExample" name="chosenExample" value="">