<?php
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');
include('/var/www/quebio.ca/misc/dbaminfo.php');

$info = $_POST['reportInfo'];
$userid = mysql_real_escape_string($_POST['the_user']);

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
$pdf->SetAutoPageBreak(TRUE, 0);

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

// Set some content to print
$html = <<<EOD
<h3>Rapport: Contexte du diagnostic</h3>
<h4>Le responsable du diagnostic</h4>
<ul>
    <li>Nom: {$info['nom']}</li>
    <li>Prénom: {$info['prenom']}</li>
    <li>Adresse: {$info['adresse']}</li>
    <li>Ville: {$info['ville']}</li>
    <li>Code Postal: {$info['code_postal']}</li>
    <li>Organisation: {$info['organisation']}</li>
    <li>Fonction: {$info['fonction']}</li>
</ul>
<h4>L'organisation</h4>
<ul>
    <li>Nom: {$info['organisation']}</li>
    <li>Statut: {$info['statut']}</li>
    <li>Secteur d'activité: {$info['secteur']}</li>
    <li>Salariés: {$info['salaries']}</li>
</ul>
<h4>Niveau du diagnostic</h4>
<table>
    <tr><td>Niveau</td><td>Participants</td></tr>
    <tr><td>Direction</td><td>{$info['direction']} personne(s)</td></tr>
    <tr><td>Interne</td><td>{$info['interne']} personne(s)</td></tr>
    <tr><td>Externe</td><td>{$info['externe']} personne(s)</td></tr>
</table>
<table>
    <tr>
        <th>Catégories</th>
        <th>Services écosystémiques</th>
        <th>IMPACTS</th>
        <th>DEPENDANCES</th>
        <th>(moyennes)</th>
    </tr>
EOD;

$query = "SELECT * FROM interdependances WHERE u_id = '$userid' GROUP BY se_id";
$results = mysql_query($query) or die('Error Fetching List From Database.');
while ($row = mysql_fetch_assoc($results)) { 
$html .= <<<EOD    
    <tr>
        <td>$row['se_name']</td>
        <td>$row['c_id']</td>
        <td>$row['example']</td>
        <td>$row['dependance']</td>
        <td>$row['impact']</td>
        <td>$row['process']</td>
        <td>$row['secondProcess']</td>
        <td>$row['dependanceLevel']</td>
        <td>$row['impactLevel']</td>
        <td>$row['gotMoney']</td>
        <td>$row['moneyType']</td>
        <td>$row['qualifyImpact']</td>
    </tr>
EOD;
}
mysql_close($con);
$html .= <<<EOD 
</table>

<tcpdf method="AddPage" />
<h3>Rapport: Identifier les interdépendances à la biodiversité et aux services écologiques</h3>
<h4>Liste des interdépendances à la biodiversité et aux services écologiques</h4>
<table>
<tr><td><img src="http://quebio.ca/testing/Jason/php/BF.png" height="350" width="350"></td><td><img src="http://quebio.ca/testing/Jason/php/BS.png" height="350" width="350"></td></tr>
<tr><td><img src="http://quebio.ca/testing/Jason/php/SF.png" height="350" width="350"></td><td><img src="http://quebio.ca/testing/Jason/php/SS.png" height="350" width="350"></td></tr>
</table>

<h5>Rapport généré par <a href="http://www.quebio.ca" style="text-decoration:none;background-color:white;color:black;"><span style="color:blue;">Que</span><span style="color:orange;">bio</span>&nbsp;</a></h5>
EOD;

//  text using writeHTMLCell()
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('rapport.pdf', 'F');

//============================================================+
// END OF FILE
//============================================================+
?>