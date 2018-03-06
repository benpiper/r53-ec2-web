<?php

//opens countlog.txt
$datei = fopen("./countlog.txt","r+");
//read the number of hits
$count = fgets($datei,1000);
//increment and display count
$count=$count + 1 ;
echo "$count" ;
// write new count
fwrite($datei, $count);
fclose($datei);

?>