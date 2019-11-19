<?php

require_once 'models/database.php';
require_once 'models/comment/commentDA.php';
require_once 'models/comment/comment.php';

class CommentDA
{
    public static function insert_comment($userID, $postID, $subredditID, $commentContent)
    {
        $db = Database::getDB();

        date_default_timezone_set("America/Chicago");
        $currentDatetime = date('Y/m/d h:i:s a', time());

        $insertPost = 'INSERT INTO comments(commentID, userID, postID, subredditID, commentContent, commentTime)
                VALUES(:commentID, :userID, :postID, :subredditID, :commentContent, :commentTime)';
        $statement = $db->prepare($insertPost);
        $statement->bindValue(':commentID', '');
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':postID', $postID);
        $statement->bindValue(':subredditID', $subredditID);
        $statement->bindValue(':commentContent', $commentContent);
        $statement->bindValue(':commentTime', $currentDatetime);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function get_comments_by_postID($postID)
    {
        $db = Database::getDB();

        $query = 'SELECT * FROM comments WHERE postID LIKE :postID';
        $statement = $db->prepare($query);
        $statement->bindValue(':postID', $postID);
        $statement->execute();
        $rows = $statement->fetchAll();
        $comments = [];

        foreach ($rows as $value) {
            $comment = new Comment($value['commentID'], $value['userID'], $value['postID'], $value['subredditID'], $value['commentContent'], $value['commentTime'], $value['rating']);
            array_push($comments, $comment);
        }

        $statement->closeCursor();
        return $comments;
    }
}
