<?php

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
    case 'viewSubreddit':
        $subredditID = filter_input(INPUT_GET, 'id');
        $subreddit = subredditDA::get_board($subredditID);
        require 'views/viewSubreddit.php';
        die();
        break;
    case 'createSubredditForm':
        require 'views/createSubredditForm.php';
        die();
        break;
    case 'createSubreddit':
        echo 'yeet';
        die();
        break;
}
