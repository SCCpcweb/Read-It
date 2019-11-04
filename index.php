<?php

require_once 'models/userDA.php';
require_once 'models/database.php';
require_once 'models/subreddit/subredditDA.php';

session_start();

$action = filter_input(INPUT_POST, 'action');
if ($action === null) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === null) {
        $action = 'home';
    }
}

switch ($action) {
    case 'home':
        $subreddits = subredditDA::get_all();
        require 'views/home.php';
        die();
        break;
    case 'profile':
        if (empty($_SESSION['username'])) {
            header('Location: index.php?action=signUp');
            break;
            die();
        } else {
            $_SESSION['user'] = userDA::getUser($_SESSION['username']);
            require 'views/profile.php';
            die();
            break;
        }
    case 'signUp':
        require('views/signUpPage.php');
        die();
        break;
    case 'registrationValidation':
        require('models/registrationValidation.php');
        // echo ($username . ', ' . $email . ', ' . $password . ', ' . $passwordVerify);
        die();
        break;
    case 'loginValidation':
        require('models/login/loginValidation.php');
        die();
        break;
    case 'logout':
        session_destroy();
        header('Location: index.php?action=home');
        die();
        break;
    case 'deleteProfile':
        echo 'DELETE THE PROFILE!';
        // session_destroy();
        // header('Location: index.php?action=home');
        die();
        break;
}
