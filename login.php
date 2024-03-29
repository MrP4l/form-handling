<?php

require_once('config/config.php');

$email = "";
$password = "";
$message = "";
$errors = [];

if (isset($_POST['email'])) {
    $email = checkInput($_POST['email']);
    if (filter_var($email, FILTER_VALIDATE_EMAIL) !== $email) {
        $errors[] = "Email is not valid";
    }
} else {
    $errors[] = "Email can't be empty";
}

if (isset($_POST['password'])) {
    $password = checkInput($_POST['password']);
} else {
    $errors[] = "Password is required";
}

function checkInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

try {
    $stmt = $connection->prepare("SELECT * FROM company_data WHERE email = :email");
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['email'] = $user['email'];
            $_SESSION['companyName'] = $user['companyName'];
            $_SESSION['status'] = 'success';
            $message = "Login successfull";
            header('Location:privateArea.php');
            die();
        } else {
            $_SESSION['status'] = 'error'; 
            $errors[] = "Invalid email or password";
            header('Location:index.html');
            die();
        }
    } else {
        $errors[] = "Invalid email or password";
        header('Location:index.html');
        die();
    }
} catch (PDOException $e) {
    $_SESSION['status'] = 'error';
    $_SESSION['errors'] = true;
    header('Location:index.html');
    return [false, "Error saving data", $e->getMessage()];
}
?>