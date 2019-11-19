<?php

require_once 'models/database.php';
require_once 'models/comment/commentDA.php';

class CommentDA
{
    public static function insert_comment($userID, $subredditID, $commentContent)
    {
        $db = Database::getDB();

        date_default_timezone_set("America/Chicago");
        $currentDatetime = date('Y/m/d h:i:s a', time());

        $insertPost = 'INSERT INTO comments(commentID, userID, subredditID, commentContent, commentTime)
                VALUES(:postID, :subredditID, :userID, :postTitle, :postContent, :postTime)';
        $statement = $db->prepare($insertPost);
        $statement->bindValue(':postID', '');
        $statement->bindValue(':subredditID', $subredditID);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':postTitle', $postTitle);
        $statement->bindValue(':postContent', $postContent);
        $statement->bindValue(':postTime', $currentDatetime);
        $statement->execute();
        $statement->closeCursor();
    }
}
