<?php
header('content-type: application/json; charset=utf-8');
$userid=$_POST['userid'];
$reportid=$_POST['reportid'];
$html=get_include_contents('tabs/'.$_POST['tab'].'.php',$userid,$reportid);
echo json_encode($html);

function get_include_contents($filename,$userid,$reportid) {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
    return false;
}

?>