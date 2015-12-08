<?php
require_once("qrlib.php");
# The text to use in the QR Code. If not value is passed, it uses the current time stamp
$text = !empty($_GET['value'])? str_replace('__','/',$_GET['value']): strtotime('now');
$size = !empty($_GET['size'])? $_GET['size']: 7;

QRcode::png($text,
    $outfile = false,
    $level = QR_ECLEVEL_L,
    $size = $size,
    $margin = 0,
    $saveandprint = false);
?>