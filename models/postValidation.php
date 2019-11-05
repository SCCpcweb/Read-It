<?php

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
    array_push($postErrors, "Must enter a board name");
} else if (strlen($postTitle) > 64) {
    array_push($postErrors, "Board name must be less than 64 characters");
}
if ($postContent === "" || $postContent === null) {
    array_push($postErrors, "Must enter a board description");
} else if (strlen($postContent) > 1500) {
    array_push($postErrors, "Board description must be less than 1500 characters");
}

if (!empty($postErrors)) {
    // if there are errors go back to the page
    $_SESSION['postErrors'] = $postErrors;
    header("Location: subredditController.php?action=viewSubreddit&id=$subredditID");
} else {
    echo 'yeet';
    // subredditDA::insert_subreddit($subredditID, $boardName, $boardDescription);
    // header("Location: index.php?action=home");
}
