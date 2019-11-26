<?php

require_once 'models/post/postDA.php';
require_once 'models/user.php';

// user inputs
$postTitle = filter_input(INPUT_POST, 'postTitle');
$postContent = filter_input(INPUT_POST, 'postContent');
// current subreddit
$subredditID = filter_input(INPUT_POST, 'subredditID');
// trim the inputs
$postTitle = trim($postTitle);
$postContent = trim($postContent);
// array of errors
$postErrors = [];

if ($postTitle === "" || $postTitle === null) {
    array_push($postErrors, "Must enter a title");
} else if (strlen($postTitle) > 64) {
    array_push($postErrors, "Post title must be less than 64 characters");
}
if ($postContent === "" || $postContent === null) {
    array_push($postErrors, "Must enter a board description");
} else if (strlen($postContent) > 1500) {
    array_push($postErrors, "Post content must be less than 1500 characters");
}

if (!empty($postErrors)) {
    // if there are errors go back to the page
    $_POST['action'] = 'createPost';
    $_POST['subredditID'] = $subredditID;
    $_POST['subredditName'] = subredditDA::get_board($subredditID)->getSubredditName();
    include('views/createPost.php');
} else {
    postDA::insert_post($subredditID, $_SESSION['user']->getUserID(), $postTitle, $postContent);
    header("Location: subredditController.php?action=viewSubreddit&id=" . $subredditID);
}
