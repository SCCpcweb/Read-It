<?php

require_once 'models/database.php';
require_once 'models/subreddit/subredditDA.php';
require_once 'models/posts/postDA.php';
require_once 'models/posts/post.php';
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

// set all users into the session
// these are used in the "container-sidebar-right" to display all users
$_SESSION['users'] = userDA::get_all();
// retrieve all subreddits from the DB
$subreddits = subredditDA::get_all();

switch ($action) {
    case 'likeComment':
        $hasVoted = CommentDA::has_liked($_REQUEST['commentID'], $_SESSION['user']->getUserID());
        // determines if a user has voted yet or not
        // if not, add the vote to the DB
        if ($hasVoted === false) {
            CommentDA::like_comment($_REQUEST['commentID']);
            CommentDA::add_to_comment_likes($_REQUEST['commentID'], $_SESSION['user']->getUserID(), 'like');
        } else {
            // if they have, check if the vote was a "dislike"
            // if it wasn't decrement the rating of the post by 1
            $like = CommentDA::check_likes($_REQUEST['commentID'], $_SESSION['user']->getUserID());
            if ($like->getLikeOrDislike() !== 'like') {
                CommentDA::like_comment($_REQUEST['commentID']);
                CommentDA::update_comment_likes($_REQUEST['commentID'], $_SESSION['user']->getUserID(), 'like');
            }
        }
        header('Location: subredditController.php?action=viewPost&postID=' . $_REQUEST['postID']);
        die();
        break;
    case 'dislikeComment':
        $hasVoted = CommentDA::has_liked($_REQUEST['commentID'], $_SESSION['user']->getUserID());
        // determines if a user has voted yet or not
        // if not, add the vote to the DB
        // if not, add the vote to the DB
        if ($hasVoted === false) {
            CommentDA::dislike_comment($_REQUEST['commentID']);
            CommentDA::add_to_comment_likes($_REQUEST['commentID'], $_SESSION['user']->getUserID(), 'dislike');
        } else {
            // if they have, check if the vote was a "dislike"
            // if it wasn't decrement the rating of the post by 1
            $like = CommentDA::check_likes($_REQUEST['commentID'], $_SESSION['user']->getUserID());
            if ($like->getLikeOrDislike() !== 'dislike') {
                CommentDA::dislike_comment($_REQUEST['commentID']);
                CommentDA::update_comment_likes($_REQUEST['commentID'], $_SESSION['user']->getUserID(), 'dislike');
            }
        }
        header('Location: subredditController.php?action=viewPost&postID=' . $_REQUEST['postID']);
        die();
        break;
}
