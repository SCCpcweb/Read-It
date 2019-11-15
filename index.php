<?php

require_once 'models/userDA.php';
require_once 'models/database.php';
require_once 'models/subreddit/subredditDA.php';
require_once 'models/user.php';

date_default_timezone_set('America/Chicago');

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
        $users = userDA::get_all();
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
            $user = userDA::getUser($_SESSION['username']);
            $_SESSION['user'] = $user;
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
    case 'viewUser':
        include('views/viewUser.php');
        die();
        break;
    case 'deleteProfile':
        echo 'DELETE THE PROFILE!';
        // session_destroy();
        // header('Location: index.php?action=home');
        die();
        break;
}
