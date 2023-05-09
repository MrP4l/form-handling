<?php

require_once('config.php');

$email = "";
$password = "";

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
            header('Location:privateArea.php');
            return [true, "login successful", $user];
        } else {
            $_SESSION['status'] = 'error'; 
            header('Location:homepage.php');
            return [false, "invalid email or password", null];
        }
    } else {
        var_dump($_SESSION['status'] = 'error');
        header('Location:homepage.php');
        return [false, "invalid email or password", null];
    }
} catch (PDOException $e) {
    $_SESSION['status'] = 'error';
    $_SESSION['errors'] = true;
    header('Location:homepage.php');
    return [false, "error saving data", $e->getMessage()];
}
?>