<?php

require_once 'models/database.php';
require_once 'models/subreddit/subredditDA.php';
require_once 'models/post/postDA.php';
require_once 'models/post/post.php';
require_once 'models/user.php';

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
        $posts = postDA::get_posts_for_subreddit($subredditID);
        require 'views/viewSubreddit.php';
        die();
        break;
    case 'createSubredditForm':
        if (empty($_SESSION['username'])) {
            header('Location: index.php?action=signUp');
            break;
            die();
        } else {
            require 'views/createSubredditForm.php';
            die();
            break;
        }
    case 'createSubreddit':
        require 'models/subreddit/subredditValidation.php';
        die();
        break;
    case 'createPost':
        require 'models/postValidation.php';
        die();
        break;
}
