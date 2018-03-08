<?php
include("counter.php");

if (getenv("DBHOSTNAME") === false) {
    $dbhostname = 'db.benpiper.host.';
} else {
    $dbhostname = getenv("DBHOSTNAME");
}

echo "Local hostname: " . file_get_contents('http://169.254.169.254/2016-09-02/meta-data/local-hostname') . "<br>";
echo "Public hostname: " . file_get_contents('http://169.254.169.254/2016-09-02/meta-data/public-hostname') . "<br>";
echo "Public IP: " . file_get_contents('http://169.254.169.254/2016-09-02/meta-data/public-ipv4') . "<br>";
echo "Availability zone: ". file_get_contents('http://169.254.169.254/2016-09-02/meta-data/placement/availability-zone') . "<br>";
echo "Host headers: " . $_SERVER['HTTP_HOST'] . "<br>";
echo "Database hostname: " . $dbhostname . "<br>";
echo "Database IP: " . gethostbyname($dbhostname) . "<br>";
echo "Database status: " . file_get_contents("http://$dbhostname") . "<br>";
echo "Client IP: " . $_SERVER['REMOTE_ADDR'] . "<br>";
echo "Client hostname: " . gethostbyaddr ($_SERVER['REMOTE_ADDR']) . "<br>";
echo "Hits: " . counter("countlog.txt");
?>