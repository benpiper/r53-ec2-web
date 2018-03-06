<?php
echo "Hostname: " . gethostname() . "<br>";
echo "Headers: " . get_headers() . "<br>";
echo "Client IP: " . $_SERVER['REMOTE_ADDR'] . "<br>";
include("/counter.php");
//phpinfo();