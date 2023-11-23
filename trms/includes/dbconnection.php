<?php
// DB credentials.
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'trms_db';

// Establish database connection.
try {
    $dbh = new PDO(
        "mysql:host=$servername;dbname=$dbname",
        $username,
        $password,
        [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]
    );
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>
