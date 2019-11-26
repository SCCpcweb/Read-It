<?php
require_once 'models/post/postDA.php';
require_once 'models/user.php';
// user inputs 
$postContent = filter_input(INPUT_POST, 'postContent');
$subredditID = filter_input(INPUT_POST, 'subredditID');
$postID = filter_input(INPUT_POST, 'postID');
// trim the content
$postContent = trim($postContent);

// errors array
$postErrors = [];
if ($postContent === "" || $postContent === null) {
    array_push($postErrors, "Must enter post content");
} else if (strlen($postContent) > 1500) {
    array_push($postErrors, "Post content must be less than 1500 characters");
}

if (!empty($postErrors)) {
    // if there are errors go back to the page
    // $_POST['subredditID'] = $subredditID;
    // $_POST['subredditName'] = subredditDA::get_board($subredditID)->getSubredditName();
    $post = postDA::get_post($postID);
    include('views/posts/editPost.php');
} else {
    postDA::update_post($_POST['postID'], $postContent);
    header("Location: subredditController.php?action=viewSubreddit&id=" . $subredditID);
}
