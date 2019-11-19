<?php

require_once 'models/database.php';
require_once 'models/subreddit/subredditDA.php';
require_once 'models/post/postDA.php';
require_once 'models/post/post.php';
require_once 'models/user.php';
require_once 'models/userDA.php';
require_once 'models/comment/commentDA.php';
require_once 'models/comment/comment.php';

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
    case 'viewSubreddit':
        $users = userDA::get_all();
        $subreddits = subredditDA::get_all();
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
        $subredditID = filter_input(INPUT_POST, 'subredditID');
        $subredditName = filter_input(INPUT_POST, 'subredditName');
        include('views/createPost.php');
        die();
        break;
    case 'viewPost':
        $postID = filter_input(INPUT_GET, 'postID');
        $post = postDA::get_post($postID);
        $comments = commentDA::get_comments_by_subredditID($post->getSubredditID());
        include("views/viewPost.php");
        die();
        break;
    case 'editPost':
        $postID = filter_input(INPUT_POST, 'postID');
        $post = postDA::get_post($postID);
        include 'views/posts/editPost.php';
        die();
        break;
    case 'submitEdit':
        require('models/posts/editPostValidation.php');
        die();
        break;
    case 'postValidation':
        require('models/postValidation.php');
        die();
        break;
    case 'commentValidation':
        require('models/comment/commentValidation.php');
        die();
        break;
    case 'commentForm':
        $postID = filter_input(INPUT_POST, 'postID');
        $post = postDA::get_post($postID);
        include('views/comments/createCommentForm.php');
        die();
        break;
    case 'deletePost':
        require('');
        die();
        break;
}
