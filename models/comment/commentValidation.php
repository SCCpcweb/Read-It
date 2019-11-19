<?php

require_once 'models/comment/commentDA.php';
require_once 'models/post/postDA.php';
require_once 'models/comment/comment.php';

// user input
$comment = filter_input(INPUT_POST, 'comment');
// trim, stripslashes, htmlspecialchars
$comment = trim($comment);
$comment = stripslashes($comment);
$comment = htmlspecialchars($comment);
// array for comment errors
$commentErrors = [];

if ($comment === '' || $comment === null) {
    array_push($commentErrors, "Must input a comment");
} else if (strlen($comment) > 500) {
    array_push($commentErrors, "Comment must be under 500 characters");
}

// if there are errors go back to the page and display errors
// otherwise add comment to the DB
if (empty($commentErrors)) {
    // $userID, $postID, $subredditID, $commentContent
    commentDA::insert_comment($_SESSION['user']->getUserID(), $_POST['postID'], postDA::get_post($_POST['postID'])->getSubredditID(), $comment);
    header("Location: subredditController.php?action=viewPost&postID=" . $_POST['postID']);
} else {
    $post = postDA::get_post($_POST['postID']);
    include($_SERVER['DOCUMENT_ROOT'] . '/Read-It/views/comments/createCommentForm.php');
}
