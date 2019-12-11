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
    case 'viewSubreddit':
        // all registered users
        $users = userDA::get_all();
        $subredditID = filter_input(INPUT_GET, 'id');
        $subreddit = subredditDA::get_board($subredditID);

        // if the user were to input a subredditID that doesn't exist
        if ($subreddit == "none") {
            header("Location: index.php?action=home");
            break;
            die();
        }
        $posts = postDA::get_posts_for_subreddit($subredditID);
        $_SESSION['lastVisitedBoard'] = $subredditID;
        $admins = [];
        $adminUsernames = [];
        $adminIDs = subredditDA::get_subreddit_admins($subredditID);
        // a list of users that can be added as an admin for a board
        $availableUsers = [];
        // get the admins from the DB based on their ID
        foreach ($adminIDs as $admin) {
            $currentAdmin = userDA::getUserByID($admin);
            array_push($admins, $currentAdmin);
            array_push($adminUsernames, $currentAdmin->getUsername());
        }
        // if the user is in the array of admins, do not add them
        foreach ($users as $user) {
            if (!in_array($user->getUsername(), $adminUsernames)) {
                array_push($availableUsers, $user);
            }
        }
        require 'views/subreddits/viewSubreddit.php';
        die();
        break;
    case 'createSubredditForm':
        if (empty($_SESSION['username'])) {
            header('Location: index.php?action=signUp');
            break;
            die();
        } else {
            require 'views/subreddits/createSubredditForm.php';
            die();
            break;
        }
    case 'createSubreddit':
        require 'models/subreddit/subredditValidation.php';
        die();
        break;
    case 'editSubreddit':
        $subreddit = subredditDA::get_board($_GET['subredditID']);
        include("views/subreddits/editSubredditForm.php");
        die();
        break;
    case 'editSubredditValidation':
        $subreddit = subredditDA::get_board($_POST['subredditID']);
        require("models/subreddit/editSubredditValidation.php");
        die();
        break;
    case 'deleteSubreddit':
        $subreddit = subredditDA::get_board($_REQUEST['subredditID']);
        include("views/subreddits/deleteSubredditConfirm.php");
        die();
        break;
    case 'deleteSubredditValidation':
        subredditDA::delete_subreddit($_REQUEST['subredditID'], $_SESSION['user']->getUserID());
        header("Location: index.php?action=home");
        die();
        break;
    case 'createPost':
        $subredditID = filter_input(INPUT_POST, 'subredditID');
        $subredditName = filter_input(INPUT_POST, 'subredditName');
        include('views/createPost.php');
        die();
        break;
    case 'viewPost':
        $post = postDA::get_post($_REQUEST['postID']);
        $subreddit = subredditDA::get_board($post->getSubredditID());
        // get sort order from the request
        // if there is no sortOrder it will default to best
        $sortOrder = "";
        if (empty($_REQUEST['sortOrder'])) {
            $sortOrder = "Best";
        } else {
            $sortOrder = $_REQUEST['sortOrder'];
        }

        // if the user changed the select, it will default to best
        if ($sortOrder == "Best") {
            $comments = commentDA::get_comments_by_postID_desc($post->getPostID());
        } else if ($sortOrder == "Worst") {
            $comments = commentDA::get_comments_by_postID_asc($post->getPostID());
        } else if ($sortOrder == "Latest") {
            $comments = commentDA::get_comments_by_postID_recent($post->getPostID());
        } else {
            $sortOrder = "Best";
            $comments = commentDA::get_comments_by_postID_desc($post->getPostID());
        }

        if (empty($_SESSION['lastVisitedBoard'])) {
            $_SESSION['lastVisitedBoard'] = $subreddit->getSubredditID();
        }
        $adminIDs = subredditDA::get_subreddit_admins($_SESSION['lastVisitedBoard']);
        $admins = [];
        $adminUsernames = [];
        // get the admins from the DB based on their ID
        foreach ($adminIDs as $admin) {
            $currentAdmin = userDA::getUserByID($admin);
            array_push($admins, $currentAdmin);
            array_push($adminUsernames, $currentAdmin->getUsername());
        }
        include("views/viewPost.php");
        die();
        break;
    case 'likePost':
        $hasVoted = postDA::has_liked($_REQUEST['postID'], $_SESSION['user']->getUserID());
        // determines if a user has voted yet or not
        // if not, add the vote to the DB
        if ($hasVoted === false) {
            postDA::like_post($_REQUEST['postID']);
            postDA::add_to_post_likes($_REQUEST['postID'], $_SESSION['user']->getUserID(), 'like');
        } else {
            // if they have, check if the vote was a "like"
            // if it wasn't increment the rating of the post by 1
            $like = postDA::check_likes($_REQUEST['postID'], $_SESSION['user']->getUserID());
            if ($like->getLikeOrDislike() !== 'like') {
                postDA::like_post($_REQUEST['postID']);
                postDA::update_post_likes($_REQUEST['postID'], $_SESSION['user']->getUserID(), 'like');
            }
        }
        header('Location: subredditController.php?action=viewPost&postID=' . $_REQUEST['postID']);
        die();
        break;
    case 'dislikePost':
        $hasVoted = postDA::has_liked($_REQUEST['postID'], $_SESSION['user']->getUserID());
        // determines if a user has voted yet or not
        // if not, add the vote to the DB
        if ($hasVoted === false) {
            postDA::dislike_post($_REQUEST['postID']);
            postDA::add_to_post_likes($_REQUEST['postID'], $_SESSION['user']->getUserID(), 'dislike');
        } else {
            // if they have, check if the vote was a "dislike"
            // if it wasn't decrement the rating of the post by 1
            $like = postDA::check_likes($_REQUEST['postID'], $_SESSION['user']->getUserID());
            if ($like->getLikeOrDislike() !== 'dislike') {
                postDA::dislike_post($_REQUEST['postID']);
                postDA::update_post_likes($_REQUEST['postID'], $_SESSION['user']->getUserID(), 'dislike');
            }
        }

        header('Location: subredditController.php?action=viewPost&postID=' . $_REQUEST['postID']);
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
        require('models/posts/postValidation.php');
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
    case 'addAdmin':
        $adminIDToAdd = $_REQUEST['adminsList'];
        subredditDA::add_subreddit_admin($_SESSION['lastVisitedBoard'], $adminIDToAdd);
        header("Location: subredditController.php?action=viewSubreddit&id=" . $_SESSION['lastVisitedBoard']);
        die();
        break;
    case 'deleteAdmin':
        $adminIDToDelete = $_REQUEST['adminsListDelete'];
        subredditDA::delete_subreddit_admin($_SESSION['lastVisitedBoard'], $adminIDToDelete);
        header("Location: subredditController.php?action=viewSubreddit&id=" . $_SESSION['lastVisitedBoard']);
        die();
        break;
    case 'deletePost':
        // deletes the post and uses the post's subreddit id to redirect the user back
        // to that board
        $post = postDA::get_post($_REQUEST['postID']);
        if ($post === 'No posts found') {
            header("Location: subredditController.php?action=viewSubreddit&id=" . $_SESSION['lastVisitedBoard']);
        } else {
            postDA::delete_post_by_postID($_REQUEST['postID'], $_SESSION['user']->getUserID());
            header("Location: subredditController.php?action=viewSubreddit&id=" . $post->getSubredditID());
        }
        die();
        break;
}
