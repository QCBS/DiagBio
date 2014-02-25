<?php
include '/misc/dbaminfo.php';

$con = mysql_connect('localhost', 'qcbscartographie', 'dsbWVmveVY3Xy4JX') or die('Could Not Connect To The Database.');

mysql_select_db('qcbscartographie', $con);
mysql_query("SET NAMES 'utf8");
	mysql_query("SET CHARACTER SET 'utf8'");

function parseToXML($htmlStr) 
	{ 
		$xmlStr=str_replace('<','&lt;',$htmlStr); 
		$xmlStr=str_replace('>','&gt;',$xmlStr); 
		$xmlStr=str_replace('"','&quot;',$xmlStr); 
		$xmlStr=str_replace("'",'&#39;',$xmlStr); 
		$xmlStr=str_replace("&",'&amp;',$xmlStr); 
		return $xmlStr; 
	}
if ( $_GET['rid'] )
{
	$reportid = $_GET['rid'];
	$theCid = $_GET['cid'];

	$query = "SELECT DISTINCT(example) FROM interdependances WHERE r_id ='".$reportid."' AND c_id=".$theCid;
	$results = mysql_query($query) or die('Error Fetching List From Database.');

	header("Content-type: text/xml; charset=utf-8");
	echo "<?xml version='1.0' ?>";
	 // Start XML file, echo parent node
	echo '<markers>';
	while ($part=mysql_fetch_array($results)){ 
		echo '<info the_example_name="' . parseToXML($part['example']) .'" />';
	}
	echo '</markers>';  

}
elseif ( $_GET['newRid'] ) {
	$newReport = $_GET['newRid'];

	$query = "SELECT count(*) as theCount FROM report WHERE reportid ='".$newReport."'";
	$results = mysql_query($query) or die('Error Fetching List From Database.');
	$row = mysql_fetch_array($results);

	header("Content-type: text/xml; charset=utf-8");
	echo "<?xml version='1.0' ?>";
	 // Start XML file, echo parent node
	echo '<markers>';
	echo '<info validation="' . parseToXML($row['theCount']) .'" />';
	
	echo '</markers>';  
}


	mysql_close($con);
?>