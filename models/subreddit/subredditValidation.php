<?php

// user inputs
$boardName = filter_input(INPUT_POST, 'boardName');
$boardDescription = filter_input(INPUT_POST, 'boardDescription');
// trim any spaces before and after
$boardName = trim($boardName);
$boardDescription = trim($boardDescription);
$boardErrors = [];

if ($boardName === "" || $boardName === null) {
    array_push($boardErrors, "Must enter a board name");
}
if ($boardDescription === "" || $boardDescription === null) {
    array_push($boardErrors, "Must enter a board description");
}

if (!empty($boardErrors)) {
    // if there are errors go back to the page
    include("views/createSubredditForm.php");
    exit();
} else {
    subredditDA::insert_subreddit($subredditID, $boardName, $boardDescription);
    header("Location: index.php?action=home");
}

echo $boardName . ' ' . $boardDescription;
