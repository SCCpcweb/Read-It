<?php

// user inputs
$username = filter_input(INPUT_POST, 'username-signUp');
$email = filter_input(INPUT_POST, 'email-signUp', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password-signUp');
$passwordVerify = filter_input(INPUT_POST, 'password-verify');
$registrationErrors = [];
$passwordErrors = [];



// username validation
$usernameError = false;
if ($username === "" || $username === null) {
    $usernameError = true;
    array_push($registrationErrors, "Username required");
} else if (preg_match('/^[A-Za-z_-][A-Za-z0-9_-]*$/', $username) === 0) {
    $usernameError = true;
    array_push($registrationErrors, "Username must begin with a letter");
} else if (preg_match('/^.{4,30}$/', $username) === 0) {
    $usernameError = true;
    array_push($registrationErrors, "Username must be between 4 and 30 characters");
} else if (!$usernameError) {
    $userExists = userDA::check_username($username);
    //if username error is true then username exists
    if ($userExists === true) {
        array_push($registrationErrors, "Username already exists");
    }
}

// email validation
$emailError = false;
if ($email === false || $email === null) {
    $emailError = true;
    array_push($registrationErrors, "Email required");
} else if (preg_match('(^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$)', $email) === 0) {
    $emailError = true;
    array_push($registrationErrors, "Please enter a valid email address");
} else {
    if (!$emailError) {
        $email_error = userDA::check_email($email);
        //if email error is true then email exists
        if ($email_error === true) {
            array_push($registrationErrors, "Email already exists");
        }
    }
}

// password validation
if ($password === "" || $password === null) {
    array_push($passwordErrors, "Password Required");
    $pw_errors[0] = "Password required";
}
if (preg_match('/^.{10,}$/', $password) === 0) {
    array_push($passwordErrors, "Password must be at least 10 characters");
}
if (preg_match('(.*[A-Z].*)', $password) === 0) {
    array_push($passwordErrors, "Password must contain at least one capital letter");
}
if (preg_match('(.*[a-z].*)', $password) === 0) {
    array_push($passwordErrors, "Password must contain at least one lower case letter");
}
if (preg_match('(.*\d.*)', $password) === 0) {
    array_push($passwordErrors, "Password must contain at least one number");
}
if ($password !== $passwordVerify) {
    array_push($passwordErrors, "Passwords must match");
}

if (!empty($passwordErrors) || !empty($registrationErrors)) {
    include('views/signUpPage.php');
    exit();
}

$options = ['cost' => 11];
$hashedPassword = password_hash($_POST['password-signUp'], PASSWORD_BCRYPT, $options);

// insert user
$users = userDA::insert_user('', $username, $email, $hashedPassword);
$_SESSION['username'] = $username;
header('location: /index.php?action=profile');
