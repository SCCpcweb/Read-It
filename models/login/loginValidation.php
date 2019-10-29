<?php
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
$loginErrors = [];

require_once('models/userDA.php');

if ($username === '') {
    array_push($loginErrors, "Must enter a username");
}
if ($password === '') {
    array_push($loginErrors, "Must enter a password");
}

if (!empty($loginErrors)) {
    // if there are erros go back to the page and display them
    include("views/signUpPage.php");
    exit();
} else {
    $login = userDA::login($username, $password);
    if ($login === false || $login === true) {
        array_push($loginErrors, "Whoops. Incorrect credentials");
        include('views/signUpPage.php');
    } else {
        echo $login;
        $_SESSION['username'] = $login;
        header("Location: index.php?action=profile");
    }
}
