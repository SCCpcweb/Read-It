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
} else if (strlen($boardName) > 64) {
    array_push($boardErrors, "Board name must be less than 64 characters");
}
if ($boardDescription === "" || $boardDescription === null) {
    array_push($boardErrors, "Must enter a board description");
} else if (strlen($boardDescription) > 1500) {
    array_push($boardErrors, "Board description must be less than 1500 characters");
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
