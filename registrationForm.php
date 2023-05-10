<?php

$name = "";
$surname = "";
$email = "";
$companyName = "";
$password = "";
$confirmPassword = "";
$address = "";
$city = "";
$state = "";
$zip = "";

// Validations
$errors = [];
$data = [];

function checkInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

if (isset($_POST["submit"])) {
    // 1. Name - required, alphabets and spaces only
    if (isset($_POST['name'])) {
        $name = checkInput($_POST['name']);
        if (ctype_alpha(str_replace(" ", "", $name)) === false) {
            $errors[] = "Name should contain only alphabets";
        }
    } else {
        $errors[] = "name field cannot be empty";
    }

    // 2. Surname - required, alphabets and spaces only
    if (isset($_POST['surname'])) {
        $surname = checkInput($_POST['surname']);
        if (ctype_alpha(str_replace(" ", "", $surname)) === false) {
            $errors[] = "Surname should contain only alphabets";
        }
    } else {
        $errors[] = "Surname field cannot be empty";
    }

    // 3. Email - required and correct pattern
    if (isset($_POST['email'])) {
        $email = checkInput($_POST['email']);
        if (filter_var($email, FILTER_VALIDATE_EMAIL) !== $email) {
            $errors[] = "Email is not valid";
        }
    } else {
        $errors[] = "Email can't be empty";
    }

    // 4. Company Name - required
    if (isset($_POST['companyName'])) {
        $companyName = checkInput($_POST['companyName']);
    } else {
        $errors[] = "Company name field is required";
    }

    // 5. Password - add the hashing
    if (isset($_POST['password'])) {
        $password = checkInput($_POST['password']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $errors[] = "Password is required";
    }

    // 6. Confirm Password - add the hashing
    if (isset($_POST['confirmPassword'])) {
        $confirmPassword = checkInput($_POST['confirmPassword']);
        if ($password != $confirmPassword) {
            $errors[] = "Password doesn't match";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        }
    } else {
        $errors[] = "Rewrite your password";
    }
        
    // 7. Address
    if (isset($_POST['address'])) {
        $address = checkInput($_POST['address']);
    }

    // 8. City
    if (isset($_POST['city'])) {
        $city = checkInput($_POST['city']);
    }

    // 9. State
    if (isset($_POST['state'])) {
        $state = checkInput($_POST['state']);
        $allowed_regions = ["Italy", "Germany", "England", "Spain"];
        if (!in_array($state, $allowed_regions)) {
            $errors[] = "Select a region from the list";
        }
    }

    // 10.Zip - max 5 numbers and only numeric
    if (isset($_POST['zip'])) {
        $zip = checkInput($_POST['zip']);
        if (!is_numeric($zip) || strlen($zip) > 5) {
            $errors[] = "Zip should contain only numeric characters and be a maximum of 5 digits";
        }
    }
}

$data = [
    "name" => $name,
    "surname" => $surname,
    "email" => $email,
    "companyName" => $companyName,
    "password" => $hashedPassword,
    "address" => $address,
    "city" => $city,
    "state" => $state,
    "zip" => $zip
];

require_once('config/config.php');

try {
    $stmt = $connection->prepare("SELECT COUNT(*) FROM company_data WHERE email = :email");
    $stmt->bindParam(":email", $data['email'], PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    if ($count > 0) {
        return [false, "account already exists", ""];
    }
    $stmt = $connection->prepare("INSERT INTO company_data (name, surname, email, companyName, password, address, city, state, zip) values (:name, :surname, :email, :companyName, :hashedPassword, :address, :city, :state, :zip)");
    $stmt->bindParam(":name", $data['name'], PDO::PARAM_STR);
    $stmt->bindParam(":surname", $data['surname'], PDO::PARAM_STR);
    $stmt->bindParam(":email", $data['email'], PDO::PARAM_STR);
    $stmt->bindParam(":companyName", $data['companyName'], PDO::PARAM_STR);
    $stmt->bindParam(":hashedPassword", $data['password'], PDO::PARAM_STR);
    $stmt->bindParam(":address", $data['address'], PDO::PARAM_STR);
    $stmt->bindParam(":city", $data['city'], PDO::PARAM_STR);
    $stmt->bindParam(":state", $data['state'], PDO::PARAM_STR);
    $stmt->bindParam(":zip", $data['zip'], PDO::PARAM_INT);
    $stmt->execute();
    $_SESSION['status'] = 'success';
    $_SESSION['data'] = $data;
    header('Location:index.php');
    return [true, "Data saved", ""];
} catch (PDOException $e) {
    $_SESSION['status'] = 'error';
    $_SESSION['errors'] = true;
    header('Location:index.php');
    return [false, "Error saving data", $e->getMessage()];
}


