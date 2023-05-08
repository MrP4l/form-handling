<?php

$email = checkInput($_POST['email']);
$password = checkInput($_POST['password']);

$login = login($email, $password);

function checkInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);

    return $input;
}

if($login[0]) {
    $_SESSION['status'] = 'success';
    header('Location:privateArea.php');
    die();
} else {
    $_SESSION['status'] = 'error';
    header('Location:privateArea.php');
    die();
}

function login($email, $password) {
    $servername = "localhost";
    $username = "root";
    $pass = "root";
    $dbname = "company_website";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $pass);

        $stmt = $connection->prepare("SELECT * FROM company_data WHERE email = :email AND password = :password");

        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);

        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['email'] = $user['email'];
                $_SESSION['companyName'] = $user['companyName'];
                echo("wewe");
                return [true, "login successful", $user];
            }
        } else {
            echo("porcoschifo");
            return [false, "invalid email or password", null];
        }
    } catch (PDOException $connect_error) {
        return [false, "error connecting to database", $connect_error->getMessage()];
    }
}







?>