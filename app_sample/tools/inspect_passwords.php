<?php
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$db = 'laravel';
$port = 3306;

$mysqli = new mysqli($host, $user, $pass, $db, $port);
if ($mysqli->connect_errno) {
    echo "Connect failed: (".$mysqli->connect_errno.") ".$mysqli->connect_error."\n";
    exit(1);
}

$res = $mysqli->query("SELECT UserID, email, password FROM users LIMIT 20");
if (!$res) {
    echo "Query error: " . $mysqli->error . "\n";
    exit(1);
}

while ($row = $res->fetch_assoc()) {
    $pw = $row['password'] ?? '';
    echo sprintf("%s | len=%d | prefix=%s | sample=%s\n", $row['email'] ?? '(no-email)', strlen($pw), substr($pw,0,4), substr($pw,0,60));
}

$res->free();
$mysqli->close();

echo "Done\n";
