<?php

$SVGBF=$_POST['chartBF'];
$SVGBS=$_POST['chartBS'];
$SVGSF=$_POST['chartSF'];
$SVGSS=$_POST['chartSS'];
$SVGAR=$_POST['chartAR'];
$SVGMO=$_POST['chartMO'];
$SVGMD=$_POST['chartMD'];
$SVGOP=$_POST['chartOP'];
$SVGOPS=$_POST['chartOPS'];
file_put_contents('/var/www/quebio.ca/testing/Jason/php/BF.svg', $SVGBF);
file_put_contents('/var/www/quebio.ca/testing/Jason/php/BS.svg', $SVGBS);
file_put_contents('/var/www/quebio.ca/testing/Jason/php/SF.svg', $SVGSF);
file_put_contents('/var/www/quebio.ca/testing/Jason/php/SS.svg', $SVGSS);
file_put_contents('/var/www/quebio.ca/testing/Jason/php/AR.svg', $SVGAR);
file_put_contents('/var/www/quebio.ca/testing/Jason/php/MO.svg', $SVGMO);
file_put_contents('/var/www/quebio.ca/testing/Jason/php/MD.svg', $SVGMD);
file_put_contents('/var/www/quebio.ca/testing/Jason/php/OP.svg', $SVGOP);
file_put_contents('/var/www/quebio.ca/testing/Jason/php/OPS.svg', $SVGOPS);
$resBF=system('convert /var/www/quebio.ca/testing/Jason/php/BF.svg /var/www/quebio.ca/testing/Jason/php/BF.png');
$resBS=system('convert /var/www/quebio.ca/testing/Jason/php/BS.svg /var/www/quebio.ca/testing/Jason/php/BS.png');
$resBF=system('convert /var/www/quebio.ca/testing/Jason/php/SF.svg /var/www/quebio.ca/testing/Jason/php/SF.png');
$resBS=system('convert /var/www/quebio.ca/testing/Jason/php/SS.svg /var/www/quebio.ca/testing/Jason/php/SS.png');
$resBS=system('convert /var/www/quebio.ca/testing/Jason/php/AR.svg /var/www/quebio.ca/testing/Jason/php/AR.png');
$resBS=system('convert /var/www/quebio.ca/testing/Jason/php/MO.svg /var/www/quebio.ca/testing/Jason/php/MO.png');
$resBS=system('convert /var/www/quebio.ca/testing/Jason/php/MD.svg /var/www/quebio.ca/testing/Jason/php/MD.png');
$resBS=system('convert /var/www/quebio.ca/testing/Jason/php/OP.svg /var/www/quebio.ca/testing/Jason/php/OP.png');
$resBS=system('convert /var/www/quebio.ca/testing/Jason/php/OPS.svg /var/www/quebio.ca/testing/Jason/php/OPS.png');
?>