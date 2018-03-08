<?php
include("counter.php");

if (getenv("DBHOSTNAME") === false) {
    $dbhostname = 'db.benpiper.host.';
} else {
    $dbhostname = getenv("DBHOSTNAME");
}

$dbip = gethostbyname($dbhostname);
$dbstatus = "NOT CONNECTED";

//open tcp connection
$fp = fsockopen($dbip, 80, $errno, $errstr, 2);
if($fp) {
    $dbstatus = "CONNECTED";
    fclose($fp);
}

$hits = counter("countlog.txt");
$publicip = file_get_contents('http://169.254.169.254/2016-09-02/meta-data/public-ipv4');

echo "<head><title>$publicip | $hits</title><style>";
include("style.css");
echo "</style></head><body><table>";
echo "<tr><td>Local hostname:</td><td>" . file_get_contents('http://169.254.169.254/2016-09-02/meta-data/local-hostname') . "</td></tr><br>";
echo "<tr><td>Public hostname:</td><td>" . file_get_contents('http://169.254.169.254/2016-09-02/meta-data/public-hostname') . "</td></tr><br>";
echo "<tr><td>Public IP:</td><td>$publicip</td></tr><br>";
echo "<tr><td>Availability zone:</td><td>". file_get_contents('http://169.254.169.254/2016-09-02/meta-data/placement/availability-zone') . "</td></tr><br>";
echo "<tr><td>Host headers:</td><td>" . $_SERVER['HTTP_HOST'] . "</td></tr><br>";
echo "<tr><td>Database hostname:</td><td>" . $dbhostname . "</td></tr><br>";
echo "<tr><td>Database IP:</td><td>$dbip</td></tr><br>";
echo "<tr><td>Database status:</td><td>$dbstatus</td></tr><br>";
echo "<tr><td>Client IP:</td><td>" . $_SERVER['REMOTE_ADDR'] . "</td></tr><br>";
echo "<tr><td>Client hostname:</td><td>" . gethostbyaddr ($_SERVER['REMOTE_ADDR']) . "</td></tr><br>";
echo "<tr><td>Hits:</td><td>$hits</td></tr><br>";
echo "</table></body>";
?>