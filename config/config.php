<?php
$servername = "localhost";
$username = "root";
$pass = "root";
$dbname = "company_website";

try {
    $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $pass);
} catch (PDOException $connect_error) {
    return [false, "error connecting to database", $connect_error->getMessage()];
}

$sql = "CREATE TABLE if not exists `company_data` (
        `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(30),
        `surname` VARCHAR(30),
        `email` VARCHAR(30),
        `companyName` VARCHAR(50),
        `password` VARCHAR(100),
        `address` VARCHAR(50),
        `city` VARCHAR(20),
        `state` VARCHAR(20),
        `zip` INT(5)
    )";

$connection->exec($sql);
?>