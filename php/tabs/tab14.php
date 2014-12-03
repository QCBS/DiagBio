<h3>Objectif et périmètre</h3>
<br>
<h4>Nom de l'évaluation</h4><input type="text" name="nameEval" id="nameEval"><br>
<h4>Nom de l'organisation qui va être évaluée</h4><input type="text" name="orgEval" id="orgEval"><br>
<h4>Quel(s) est/sont le(s) mandat(s) ou objectif(s) que votre organisation se donne pour cette évaluation ?</h4>
<textarea rows="4" cols="50" id="objectiveText"></textarea>
<h4>Quelles sont, selon vous les limites de cette évaluation ?</h4>
<textarea rows="4" cols="50" id="limitText"></textarea>
<br><br><br>

<div id="tabs-3">
		<ul>
		<li><a href="#example2">Ce qu’il faut savoir</a></li>
	</ul>
	<div id="example2"><b>L’organisation comme un système</b> : Pour étudier les interdépendances d’une organisation avec la biodiversité et les services écosystémiques, il est important de la considérer comme un système simplifié. Le système permet de représenter les différentes entités de l’organisation, et notamment, les flux économiques de la ou des chaines d’approvisionnement (flux de matière, énergie, services, etc.). Le système permet également d’identifier les intrants (matière première issue des écosystèmes) et sortants (produits/services, profits/pertes, déchets, pollution etc.) et échanges avec les parties prenantes externes (clients, fournisseurs, communautés locales, etc.).<br><br>

	<b>Déterminer les limites de chaque évaluation</b> : l’organisation doit se fixer des objectifs réalistes : il convient de prendre en compte la taille de l’organisation et la dispersion de ses sites. Il serait ambitieux de vouloir faire une évaluation sur toutes les activités de l’organisation en une seule fois. Nous privilégions une approche modulaire, qui étudie chaque composante géographique du système comme une entité distinctes, Ceci permet de faire correspondre une évaluation à chaque entité géographique de l’entreprise. L’organisation pourra également choisir un périmètre d’évaluation correspondant à un aspect particulier de ses activités.
	</div>
</div>

<br><br>

<h4>Circonscription du périmètre d’analyse</h4>
<input type="radio" name="cir1" id="cir1" value="Opérationnel"><b>Opérationnel</b>
<select hidden id="sites1">
  <option value="site">Site</option>
  <option value="ensemble site">Ensemble Site</option>
  <option value="groupe">Groupe</option>
</select><br>
<input type="radio" name="cir2" id="cir2" value="Spatial"><b>Spatial</b>
<select hidden id="sites2">
  <option value="province">Province</option>
  <option value="region">Région</option>
  <option value="commune">Commune</option>
  <option value="site">Site</option>
</select><br>
<input type="radio" name="cir3" id="cir3" value="Intrant"><b>Intrant/extrant</b>
<select hidden id="sites3">
  <option value="approvisionnements">Approvisionnements</option>
  <option value="exportations">Exportations</option>
</select><br><br>
<h4>Description</h4>
<textarea rows="4" cols="50" id="sysRep"></textarea><br><br><br>
<h4>Définition des limites spatiales</h4>
<div id="noloc" style="display:none;">Localisation non reconnue!</div>
<p>Double-cliquez sur un node pour pour l'effacer, cliquez-glisser le node pour le déplacer</p>
<button type="button" id="polybut">Ajouter un polygone</button>
<button type="button" id="metabio-clear">Tout effacer</button>
<input type="hidden" name="geography" id="geography">
<div id="map" style="width:800px !important;height:500px !important;margin:10px 0 15px 0;"></div>

<!--
<h4>Comment souhaitez-vous faire apparaitre spatialement le système définit?<br></h4>
<input type="radio" name="define" id="define" value=""><b>Indiquer manuellement des points sur une carte.</b> L’opération va générer une entrée et une<br>
													 	  		coordonnée sera associée à cette entrée dans la base de données.<br>
<input type="radio" name="define" id="define" value=""><b>Utiliser des données vectorielles existantes qui sont déjà géo référencées :</b> cours d’eau,<br>
													 			polygones issus de la télédétection qui ont été classes selon les types d’usages.<br>
<input type="radio" name="define" id="define" value=""><b>Utiliser des relevés de points à partir de GPS ou des relevés effectués a partir d’appareils<br>
 													 		mobiles comme les téléphones intelligents.</b> Les points sont collectes dans une base de données<br>
  													 		géo référencée par les participants.<br><br><br>
-->
<h4>Fonction du système</h4>
<input type="radio" name="sysFunc1" id="sysFunc1" value="principales"><b>Principales <br>
<input type="radio" name="sysFunc2" id="sysFunc2" value="secondaires">Secondaires</b> <br><div hidden id="hidden_text"><br><br>
<h4>Description</h4>
<textarea rows="4" cols="50" id="funcTxt"></textarea><br><br><br>
</div><br><br>
<h4>La portée de l’évaluation</h4>
Le nombre de participants et le niveau d’évaluation vont conditionner la portée du diagnostic et la valeur qui lui sera reconnue autant en interne qu’en externe.<br><br>

<fieldset><legend><b>Niveau d’évaluation</b></legend>
<input type="checkbox" name="niveau1" id="niveau1" value="Direction"><b>Direction<br>
<input type="checkbox" name="niveau2" id="niveau2" value="Interne">Interne<br>
<input type="checkbox" name="niveau3" id="niveau3" value="Externe">Externe<br>
</fieldset>
<div id="hideList" hidden>
<fieldset><legend><b>Si c'est externe : parties prenantes identifiées ?</b></legend>
<input type="radio" name="externe" id="externe1" value="habitants" >Habitants<br>
<input type="radio" name="externe" id="externe2"value="autre organisation" >Autre organisation<br>
<input type="radio" name="externe" id="externe3" value="gouvernement" >Gouvernement/ Etat<br>
<input type="radio" name="externe" id="externe4" value="agence" >Agence de notation<br>
<input type="radio" name="externe" id="externe5" value="ong" >ONG<br>
<input type="radio" name="externe" id="externe6" value="autre" >Autre<br><br>
<input type="text" name="externeInput" id="externeInput" style="width:300px;">
</fieldset>
</div>
<button type="button" id="TAB14_BTN_BACK">Précédent</button>  
<button type="button" id="TAB14_CREATE_BTN">Créer l'évaluation</button>
<input type="hidden" name="firstTime" id="firstTime" value=""> <!-- determines wheterh the user wants to edit or create -->