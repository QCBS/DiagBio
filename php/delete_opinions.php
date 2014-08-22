<?php
include('/var/www/quebio.ca/misc/dbaminfo.php');

$con = mysql_connect($mys_host, $mys_username, $mys_pass) or die('Could Not Connect To The Database.');
mysql_select_db($mys_base, $con);
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");

$adminid = $_POST['adminid'];
$reportid = $_POST['reportid'];
$row_ids = $_POST['chkdbxs'];

$count = 0;
if (!empty($row_ids)) {

	while ( $count < count($row_ids)) {
		$query = mysql_query("DELETE FROM interdependances WHERE row_id = '$row_ids[$count]'");
		$count++;
	echo json_encode("Rows have been deleted succesully");
	}
}
else
{
	echo json_encode("NO rows to delete!");
}
mysql_close($con);

?>