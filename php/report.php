<?php
header("Access-Control-Allow-Origin: *");
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');
include('/var/www/quebio.ca/misc/dbaminfo.php');

$info = $_POST['reportInfo'];

if($info['represent'] == '')
{
    $info['represent'] = 'aucune';
}


$niveaus = '';  //make the data into presentable data and take out the nulls
$commaCounter = 0;  //lets me know if I have to put commas
if ($info['niveau1'] == '' || $info['niveau1'] == 'null') {
    $niveaus = '';   
}
else
{
     $niveaus = $info['niveau1'];
     $commaCounter++;
}

if ($info['niveau2'] == '' || $info['niveau2'] == 'null') {
   $niveaus .= '';
}
else
{
    if ($commaCounter > 0) {  //is there a word in $niveaus already?
        $niveaus .= ', ';
    }
     $niveaus .= $info['niveau2'];
     $commaCounter++;
}

if ($info['niveau3'] == '' || $info['niveau3'] == 'null') {
   $niveaus .= '';
}
else
{
    if ($commaCounter > 0) {  //is there a word in $niveaus already?
        $niveaus .= ', ';
    }
     $niveaus .= $info['niveau3'];
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('QCBS ');
$pdf->SetTitle('Rapport - ' . $info['nom']);
$pdf->SetSubject('Diagnostic');
$pdf->SetKeywords('Diagnostic, PDF, Contexte, Interdependances, Portrait');

// set default header data
$pdf->SetHeaderData('quebio-harfand.png', PDF_HEADER_LOGO_WIDTH, 'Rapport - ' . $info['organisation'], 'Diagnostic de Votre Entreprise', array(0,64,255), array(0,64,128));
$pdf->setFooterData($tc=array(0,64,0), $lc=array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, 0);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 13, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

//getting data from the database
$con = mysql_connect($mys_host, $mys_username, $mys_pass) or die('Could Not Connect To The Database.');

mysql_select_db($mys_base, $con);
mysql_query("SET NAMES 'utf8");
mysql_query("SET CHARACTER SET 'utf8'");

$title = '<h3>Rapport d’évaluation des interdépendances des organisations aux BSE</h3>
<h4>1. Contexte</h4><br>';

// Set some content to print
$html = <<<EOD
    <div style="border:1px;">
        Nom d’utilisateur/Responsable de l’évaluation: {$info['nomUtilisateur']}<br><br>
        Fonctions dans l’organisation: {$info['fonction']}
    </div><br>
        
    <div style="border:1px;">
        Nom de l'organisation: {$info['organisation']}
    </div><br>

    <div style="width:200px;height:100px;border:1px;">
        Adresse: {$info['organisationAddresse']}<br>
        Ville: {$info['organisationVille']}<br>
        Code Postal: {$info['organisationCP']}<br>
        Courrier électronique: {$info['courriel']}
    </div><br>

    <div style="width:200px;height:100px;border:1px;">
        Motivation principale de l’organisation pour l’évaluation: {$info['motivation']}<br><br>
        Niveau du diagnostic: {$niveaus}
    </div><br>
    
<h4>2. Portrait du système</h4><br>
<div style="border:1px;">
    Secteur d'activité: {$info['secteur']}<br><br>
    Objectifs de l’organisation: {$info['objective']}<br><br>
    Limites de l’évaluation: {$info['limit']}<br><br>
    Circonscription du périmètre d’analyse: {$info['circonscription']}<br><br>
    Représentation du système: {$info['represent']}<br><br>
    Fonction du système: {$info['fonction']}<br><br>
    Description du Fonction du système: {$info['function_text']}
   
</div><br>
<br><br><br><br><br>
<h4>3. Évaluation des interdépendances</h4>

<h5>I.1. Participants</h5>

<table border="1">
    <tr><th>Type de participants</th><th>Catégories</th><th>Nombre</th></tr>
    <tr><td>Directions / gestionnaires responsables</td><td>|</td><td>{$info['direction']} personne(s)</td></tr>
    <tr><td>Interne organisation</td><td>||</td><td>{$info['interne']} personne(s)</td></tr>
    <tr><td>Parties prenantes</td><td>|||</td><td>{$info['externe']} personne(s)</td></tr>
</table><br><br>

<h5>I.2. Les interdépendances / classes de SE (11)</h5>

Graphique : Présente l’importance relative de toutes les interdépendances par rapport
aux 11 classes de services écologiques. La moyenne décrit un niveau d’importance de
la dépendance et l’écart type le niveau de consensus.<br>

<img src="http://quebio.ca/testing/Jason/php/AR.png" height="500" width="500">
<br><br><r><br><br><br><br>
<h5>I.3.1.  Les impacts avérés</h5>

Graphique : Présente l’importance relative des impacts avérés par rapport aux 11
classes de services écologiques. La moyenne décrit un niveau de sévérité de 
l’impact et l’écart type le niveau de consensus.<br>

<img src="http://quebio.ca/testing/Jason/php/BF.png" height="500" width="500">
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>

<h5>I.3.2.  Les impacts potentiels</h5>

Graphique : Présente l’importance relative des impacts potentiels par rapport aux
11 classes de services écologiques. La moyenne décrit un niveau se sévérité 
potentielle de l’impact et l’écart type le niveau de consensus.<br><br>

<img src="http://quebio.ca/testing/Jason/php/BS.png" height="500" width="500">
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br>

<h5>I.3.3.  Les dépendances avérées</h5>

Graphique :
Présente l’importance relative de toutes les dépendances avérées par rapport
aux 11 classes de services écologiques. La moyenne décrit un niveau 
d’importance de la dépendance avérée et l’écart type le niveau de consensus.<br><br>

<img src="http://quebio.ca/testing/Jason/php/SF.png" height="500" width="500">
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br>

<h5>I.3.4.  Les dépendances potentielles</h5>

Graphique : Présente l’importance relative de toutes les dépendances potentielles par rapport
aux 11 classes de services écologiques. La moyenne décrit un niveau d’importance de la 
dépendance potentielle et l’écart type le niveau de consensus.<br><bR>

<img src="http://quebio.ca/testing/Jason/php/SS.png" height="500" width="500">
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br>

<h5>I.4. Les paiements pour bénéficier des BSE</h5>

Graphique : Présente l’importance relative des paiements pour bénéficier des SE par rapport aux
11 classes de services écologiques.<br><br>

<img src="http://quebio.ca/testing/Jason/php/MO.png" height="500" width="500">

<img src="http://quebio.ca/testing/Jason/php/MD.png" height="500" width="500">
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br>

<h5>I.5.    Les fonctions de l’organisation touchés par des interdépendances aux BSE</h5>
En termes de fonction, je propose la liste suivante :<br>
1.   La gestion des opérations<br>
2.   Les finances<br>
3.   Les opérations<br>
4.   Les ressources humaines<br> 
5.   Le marketing (réputation, image, etc.)<br>
6.    Autres à préciser<br><br>

Graphique :<br>
Présente le nombre d’IDBSE qui ont un impact sur les fonctions de l’organisation<br><br>

<img src="http://quebio.ca/testing/Jason/php/OP.png" height="500" width="500"><br>
<br><br><br>
Graphique : Présente l’importance relative de toutes les fonctions de l’organisation
touchées par les interdépendances par rapport aux 11 classes de services écologiques.
Les barres barres vont montrer l’importance relative des opérations touchees dans 
chaque classe de service écologique.<br><br>

<img src="http://quebio.ca/testing/Jason/php/OPS.png" height="800" width="600">
<br>
<h4>4. Les interdépendances aux BSE prioritaires</h4>

<h4>I.5.1. Plan d’action des IDBSE</h4>
Les interdépendances principales sont celles qui ont été identifiées avec des niveaux
d’importance 4 et 5 sur une échelle de 5.<br><br>

Ce sont les Interdépendances avérées prioritaires : pour lesquelles des actions doivent être
identifiées et mises en œuvre dans un plan d’action afin de gérer les conséquences potentielles.
<br><br><br>

<h4>Les impacts avérés</h4>
<table border="1">
    <tr>
        <th>Avis IDs</th>
        <th>Impact IDBSE</th>
        <th>Niveau</th>
        <th>Action pour réduire les impacts</th>
    </tr>
EOD;

if ($info['IA_size'] == '0') {  //NO DATA
    
$html .= <<<EOD
    <tr>
        <td colspan="4" align="center">Aucune données</td>
    </tr>       
EOD;
}

for ($i=0; $i < $info['IA_size']; $i++) { 

$html .= <<<EOD
    <tr>
        <td>{$info['opinion_idsIA'][$i]}</td>
        <td>{$info['examplesIA'][$i]}</td> 
        <td>{$info['potential_avgsIA'][$i]}</td>
        <td>{$info['opinionsIA'][$i]}</td>
    </tr>

EOD;
}

$html .= <<<EOD
  </table>
<br>

<h4>Les dépendances avérées</h4>
<table border="1">
    <tr>
        <th>Ids des commentaires</th>
        <th>Impact IDBSE</th>
        <th>Niveau</th>
        <th>Action pour gérer les dépendances</th>
    </tr>
EOD;

if ($info['DA_size'] == '0') {  //NO DATA
    
$html .= <<<EOD
    <tr>
        <td colspan="4" align="center">Aucune données</td>
    </tr>       
EOD;
}

for ($i=0; $i < $info['DA_size']; $i++) { 

$html .= <<<EOD
    <tr>
        <td>{$info['opinion_idsDA'][$i]}</td>
        <td>{$info['examplesDA'][$i]}</td> 
        <td>{$info['potential_avgsDA'][$i]}</td>
        <td>{$info['opinionsDA'][$i]}</td>
    </tr>

EOD;
}

$html .= <<<EOD
  </table>
<br>

<h4>Alternatives aux paiements pour SE</h4>
<table border="1">
    <tr>
        <th>Alternatives aux paiements pour SE</th>
        <th>Niveau</th>
        <th>Alternative envisagées</th>
    </tr>
EOD;
/*if($info['money_size'] == '0')
{
     $html .= <<<EOD
    <tr>
        <td colspan="4" align="center">Aucune données</td>
    </tr>       
EOD;  
}*/
 
    for ($i=0; $i < $info['money_size']; $i++) { 

    $html .= <<<EOD
        <tr>
            <td>{$info['money_examples'][$i]}</td>
            <td>{$info['levels'][$i]}</td> 
            <td>{$info['payments'][$i]}</td>
        </tr>
EOD;
    }

$html .= <<<EOD
</table>
<br>

<h4>I.5.2. Plan de surveillance des risques IDBSE</h4>

Ce sont les risques d’interdépendances prioritaires : pour lesquelles une surveillance et des
recherches de solution doivent intervenir afin d’éviter que ces interdépendances ne se 
matérialisent et constituent des risques pour l’organisation.

<h4>Les impacts potentiels</h4>
<table border="1">
    <tr>
        <th>Avis IDs</th>
        <th>Impact IDBSE</th>
        <th>Niveau</th>
        <th>Surveillance des risques d’impacts</th>
    </tr>
EOD;
if ($info['IP_size'] == '0') {  //NO DATA
    
$html .= <<<EOD
    <tr>
        <td colspan="4" align="center">Aucune données</td>
    </tr>       
EOD;
}

for ($i=0; $i < $info['IP_size']; $i++) { 

$html .= <<<EOD
    <tr>
        <td>{$info['opinion_idsIP'][$i]}</td>
        <td>{$info['examplesIP'][$i]}</td> 
        <td>{$info['potential_avgsIP'][$i]}</td>
        <td>{$info['opinionsIP'][$i]}</td>
    </tr>

EOD;
}

$html .= <<<EOD
  </table>
<br>
<h4>Les dépendances potentielles</h4>
<table border="1">
    <tr>
        <th>Avis IDs</th>
        <th>Impact IDBSE</th>
        <th>Niveau</th>
        <th>Surveillance des risques de dépendances</th>
    </tr>
EOD;
if ($info['DP_size'] == '0') {  //NO DATA
    
$html .= <<<EOD
    <tr>
        <td colspan="4" align="center">Aucune données</td>
    </tr>       
EOD;
}

for ($i=0; $i < $info['DP_size']; $i++) { 
$html .= <<<EOD
    <tr>
        <td>{$info['opinion_idsDP'][$i]}</td>
        <td>{$info['examplesDP'][$i]}</td> 
        <td>{$info['potential_avgsDP'][$i]}</td>
        <td>{$info['opinionsDP'][$i]}</td>
    </tr>

EOD;
}

$html .= <<<EOD
</table>
<br>
<h4>Alternatives aux paiements pour SE</h4>
<table border="1">
    <tr>
        <th>Alternatives aux paiements pour SE</th>
        <th>Niveau</th>
        <th>Recherche d’alternative pour prévenir</th>
    </tr>
EOD;

for ($i=0; $i < $info['money_size2']; $i++) { 

$html .= <<<EOD
    <tr>    
        <td>{$info['money_examples2'][$i]}</td>
        <td>{$info['levels2'][$i]}</td> 
        <td>{$info['payments2'][$i]}</td>
    </tr>
EOD;
}

$html .= <<<EOD
</table>
<br>

<h4>5. Annexes</h4>

<h5>I.6. Les participants à l’évaluation</h5>

<table border="1">
    <tr><th>Type de participants</th><th>Catégories</th><th>Nom et prénom</th>
    <th>Email</th><th>Téléphone</th></tr>
    <tr><td>Directions / gestionnaires responsables</td><td>|</td>
EOD;

for ($i=0; $i < $info['niveau_size'] ; $i++) { 

    if ($info['groups'][$i] == 'Direction') {
    $html .= <<<EOD
        <td>{$info['names_D'][$i]} {$info['last_names_D'][$i]}</td><td>{$info['emails_D'][$i]}</td><td>{$info['phones_D'][$i]}</td>
EOD;
    }
}
$html .= <<<EOD
    </tr><tr><td>Interne organisation</td><td>||</td>
EOD;
for ($i=0; $i < $info['niveau_size'] ; $i++) { 
    if ($info['groups'][$i] == 'Externe') {
         $html .= <<<EOD
         <td>{$info['names_D'][$i]} {$info['last_names_D'][$i]}</td><td>{$info['emails_D'][$i]}</td><td>{$info['phones_D'][$i]}</td></tr>
EOD;
    }
}
$html .= <<<EOD
    </tr>
    <tr><td>Parties prenantes</td><td>|||</td>
EOD;
for ($i=0; $i < $info['niveau_size'] ; $i++) { 
    if ($info['groups'][$i] == 'Interne') {
         $html .= <<<EOD
         <td>{$info['names_D'][$i]} {$info['last_names_D'][$i]}</td><td>{$info['emails_D'][$i]}</td><td>{$info['phones_D'][$i]}</td></tr>
EOD;
    }
}
$html .= <<<EOD
</tr>
</table>
<br><br>
<h5>I.7. La liste des interdépendances identifiées lors de l’évaluation</h5>                    

<table border="1">
    <tr>
        <th>Classe de service écologique (11)</th>
        <th>Service écologique (40)</th>
        <th>Interdépendance qui a été nommée</th>
        <th>Dépendance</th>
        <th>Impact</th>
        <th>Niveau Dépendance</th>
        <th>Niveau Impact</th>
    </tr>
EOD;

for ($i=0; $i < $info['list_size'] ; $i++) { 

$html .= <<<EOD
    <tr>
        <td>{$info['list_se_name'][$i]}</td>
        <td>{$info['list_c_name'][$i]}</td> 
        <td>{$info['list_example'][$i]}</td>
        <td>{$info['list_dependance'][$i]}</td>
        <td>{$info['list_impact'][$i]}</td>
        <td>{$info['list_niveau_dependance'][$i]}</td>
        <td>{$info['list_niveau_impact'][$i]}</td>
    </tr>

EOD;
}

$html .= <<<EOD

</table>

<h5>Rapport généré par <a href="http://www.quebio.ca" style="text-decoration:none;background-color:white;color:black;"><span style="color:blue;">Que</span><span style="color:orange;">bio</span>&nbsp;</a></h5>

EOD;

mysql_close($con);

// set some text for example

// text using writeHTMLCell() and multicells
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $title, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('rapport.pdf', 'F');

//============================================================+
// END OF FILE
//============================================================+
?>