<?php

function counter($file) {
    //opens countlog.txt to read the number of hits
    $datei = fopen($file,"r");
    $count = fgets($datei,1000);
    fclose($datei);
    $count=$count+1;

    // opens countlog.txt to change new hit number
    $datei = fopen($file,"wb");
    fwrite($datei, $count);
    fclose($datei);

    return $count;
}
?>