<?php
include("counter.php");

if (getenv("DBHOSTNAME") === false) {
    $dbhostname = 'db.benpiper.host.';
} else {
    $dbhostname = getenv("DBHOSTNAME");
}


$dbip = gethostbyname($dbhostname);
$dbstatus = "NOT CONNECTED";

if ($dbip === $dbhostname) {
    $dbip = "<strong>RESOLUTION FAILED</strong>";
}

//open tcp connection
$fp = fsockopen($dbip, 80, $errno, $errstr, 2);
if($fp) {
    $dbstatus = "<span class=good>CONNECTED</span>";
    fclose($fp);
}

$hits = counter("countlog.txt");
$publicip = file_get_contents('http://169.254.169.254/2016-09-02/meta-data/public-ipv4');

echo "<head><title>$publicip | $hits</title><style>";
include("style.css");
echo "</style></head><body><table>";
echo "<tr><td>Local hostname:</td><td>" . file_get_contents('http://169.254.169.254/2016-09-02/meta-data/local-hostname') . "</td></tr>";
echo "<tr><td>Public hostname:</td><td>" . file_get_contents('http://169.254.169.254/2016-09-02/meta-data/public-hostname') . "</td></tr>";
echo "<tr><td>Public IP:</td><td>$publicip</td></tr>";
echo "<tr><td>Availability zone:</td><td>". file_get_contents('http://169.254.169.254/2016-09-02/meta-data/placement/availability-zone') . "</td></tr>";
echo "<tr><td>Database hostname:</td><td>" . $dbhostname . "</td></tr>";
echo "<tr><td>Database IP:</td><td>$dbip</td></tr>";
echo "<tr><td>Database status:</td><td>$dbstatus</td></tr>";
echo "<tr><td>Client IP:</td><td>" . $_SERVER['REMOTE_ADDR'] . "</td></tr>";
echo "<tr><td>Client hostname:</td><td>" . gethostbyaddr ($_SERVER['REMOTE_ADDR']) . "</td></tr>";
echo "<tr><td>Host headers:</td><td>" . $_SERVER['HTTP_HOST'] . "</td></tr>";
echo "<tr><td>Hits:</td><td><span class=hits>$hits</span></td></tr>";
echo "</table><img src=//c.statcounter.com/11652222/0/0392027f/1/></body>";
?>