<?php
include("counter.php");

$dbhostname = getenv("DBHOSTNAME");
if ($dbhostname !== false) {
    $dbip = gethostbyname($dbhostname);
    $dbstatus = "NOT CONNECTED";

    if ($dbip === $dbhostname) {
        $dbip = "<strong>RESOLUTION FAILED</strong>";
    }

    //open tcp connection
    $fp = fsockopen($dbip, 22, $errno, $errstr, 2);
    if($fp) {
        $dbstatus = "<span class=good>CONNECTED</span>";
        fclose($fp);
    }
}

$hits = counter("countlog.txt");
$publicip = file_get_contents('http://169.254.169.254/2016-09-02/meta-data/public-ipv4');

echo "<head><title>$publicip | Hits: $hits</title><style>";
include("style.css");
echo "</style>";
if (getenv("HEAP_APP_ID") !== false) { include("tracker.php"); }
echo "</head><body><table>";
echo "<tr><td>Local domain name:</td><td>" . file_get_contents('http://169.254.169.254/2016-09-02/meta-data/local-hostname') . "</td></tr>";
echo "<tr><td>Public domain name:</td><td>" . file_get_contents('http://169.254.169.254/2016-09-02/meta-data/public-hostname') . "</td></tr>";
echo "<tr><td>Public IP:</td><td>$publicip</td></tr>";
echo "<tr><td>Availability zone:</td><td>". file_get_contents('http://169.254.169.254/2016-09-02/meta-data/placement/availability-zone') . "</td></tr>";
if ($dbhostname !== false) {
    echo "<tr><td>Database domain name:</td><td>" . $dbhostname . "</td></tr>";
    echo "<tr><td>Database IP:</td><td>$dbip</td></tr>";
    echo "<tr><td>Database status:</td><td>$dbstatus</td></tr>";
}
echo "<tr><td>Client IP:</td><td>" . $_SERVER['REMOTE_ADDR'] . "</td></tr>";
echo "<tr><td>Client domain name:</td><td>" . gethostbyaddr ($_SERVER['REMOTE_ADDR']) . "</td></tr>";
echo "<tr><td>Host header:</td><td>" . $_SERVER['HTTP_HOST'] . "</td></tr>";
echo "<tr><td>Hits:</td><td><span class=hits>$hits</span></td></tr>";
echo "</table>";
if (getenv("HEAP_APP_ID") !== false) { echo "<script>heap.track('DNS Response', {publicip: '$publicip'});</script>"; }
echo "</body>";
?>
