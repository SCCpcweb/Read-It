<?php

// user inputs
$boardDescription = filter_input(INPUT_POST, 'boardDescription');
// trim any spaces before and after
$boardDescription = trim($boardDescription);
$boardErrors = [];

if ($boardDescription === "" || $boardDescription === null) {
    array_push($boardErrors, "Must enter a board description");
} else if (strlen($boardDescription) > 1500) {
    array_push($boardErrors, "Board description must be less than 1500 characters");
}


if (!empty($boardErrors)) {
    // if there are errors go back to the page
    include("views/subreddits/editSubredditForm.php");
    exit();
} else {
    subredditDA::update_board($subreddit->getSubredditID(), $_SESSION['user']->getUserID(), $boardDescription);
    header("Location: subredditController.php?action=viewSubreddit&id=" . $subreddit->getSubredditID());
}
