<?php

//opens countlog.txt to read the number of hits
$datei = fopen("countlog.txt","r");
$count = fgets($datei,1000);
fclose($datei);
$count=$count+1;
echo "$count";

// opens countlog.txt to change new hit number
$datei = fopen("countlog.txt","wb");
fwrite($datei, $count);
fclose($datei);

?>