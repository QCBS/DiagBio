<?php
include '/misc/dbaminfo.php';

$SVGBF=$_POST['chartBF'];
$SVGBS=$_POST['chartBS'];
$SVGSF=$_POST['chartSF'];
$SVGSS=$_POST['chartSS'];
file_put_contents('/var/www/quebio.ca/testing/Jason/php/BF.svg', $SVGBF);
file_put_contents('/var/www/quebio.ca/testing/Jason/php/BS.svg', $SVGBS);
file_put_contents('/var/www/quebio.ca/testing/Jason/php/SF.svg', $SVGSF);
file_put_contents('/var/www/quebio.ca/testing/Jason/php/SS.svg', $SVGSS);
$resBF=system('convert /var/www/quebio.ca/testing/Jason/php/BF.svg /var/www/quebio.ca/testing/Jason/php/BF.png');
$resBS=system('convert /var/www/quebio.ca/testing/Jason/php/BS.svg /var/www/quebio.ca/testing/Jason/php/BS.png');
$resBF=system('convert /var/www/quebio.ca/testing/Jason/php/SF.svg /var/www/quebio.ca/testing/Jason/php/SF.png');
$resBS=system('convert /var/www/quebio.ca/testing/Jason/php/SS.svg /var/www/quebio.ca/testing/Jason/php/SS.png');
?>