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

    public static function get_comments_by_postID_asc($postID)
    {
        $db = Database::getDB();

        $query = 'SELECT * FROM comments WHERE postID LIKE :postID ORDER BY rating ASC';
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

    public static function get_comments_by_postID_desc($postID)
    {
        $db = Database::getDB();

        $query = 'SELECT * FROM comments WHERE postID LIKE :postID ORDER BY rating DESC';
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

    public static function get_comments_by_postID_recent($postID)
    {
        $db = Database::getDB();

        $query = 'SELECT * FROM comments WHERE postID LIKE :postID ORDER BY commentTime DESC';
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

    public static function like_comment($commentID)
    {
        $db = Database::getDB();

        $likeComment = 'UPDATE comments
                     SET rating = rating + 1
                     WHERE commentID = :commentID';
        $statement = $db->prepare($likeComment);
        $statement->bindValue(':commentID', $commentID);
        $statement->execute();
    }

    public static function dislike_comment($commentID)
    {
        $db = Database::getDB();

        $dislikeComment = 'UPDATE comments
                     SET rating = rating - 1
                     WHERE commentID = :commentID';
        $statement = $db->prepare($dislikeComment);
        $statement->bindValue(':commentID', $commentID);
        $statement->execute();
    }

    public static function add_to_comment_likes($commentID, $userID, $likeOrDislike)
    {
        $db = Database::getDB();

        $query = 'INSERT INTO commentlikes(likeID, commentID, userID, likeOrDislike)
                                VALUES(:likeID, :commentID, :userID, :likeOrDislike)';
        $statement = $db->prepare($query);
        $statement->bindValue(':likeID', '');
        $statement->bindValue(':commentID', $commentID);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':likeOrDislike', $likeOrDislike);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function update_comment_likes($commentID, $userID, $likeOrDislike)
    {
        $db = Database::getDB();

        $query = 'UPDATE commentlikes
                  set likeOrDislike = :likeOrDislike
                  WHERE commentID = :commentID
                  AND userID = :userID';
        $statement = $db->prepare($query);
        $statement->bindValue(':commentID', $commentID);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':likeOrDislike', $likeOrDislike);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function has_liked($commentID, $userID)
    {
        $db = Database::getDB();

        $query = 'SELECT *
                  FROM commentlikes
                  WHERE userID = :userID
                  AND commentID = :commentID';
        $statement = $db->prepare($query);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':commentID', $commentID);
        $statement->execute();
        $rows = $statement->fetch();
        $statement->closeCursor();

        if (empty($rows)) {
            return false;
        } else {
            return true;
        }
    }

    public static function check_likes($commentID, $userID)
    {
        $db = Database::getDB();

        $query = 'SELECT *
                  FROM commentlikes
                  WHERE userID = :userID
                  AND commentID = :commentID';
        $statement = $db->prepare($query);
        $statement->bindValue(':commentID', $commentID);
        $statement->bindValue(':userID', $userID);
        $statement->execute();
        $rows = $statement->fetchAll();

        foreach ($rows as $value) {
            $like = new PostLike($value['likeID'], $value['commentID'], $value['userID'], $value['likeOrDislike']);
        }

        $statement->closeCursor();

        return $like;
    }

    public static function delete_comment($commentID, $userID)
    {
        $db = Database::getDB();

        $deleteComment = 'DELETE comments
                    FROM comments
                    JOIN subreddits on comments.subredditID = subreddits.subredditID
                    JOIN subredditadmins on subreddits.subredditID = subredditadmins.subredditID
                    WHERE comments.commentID = :commentID
                    AND (subredditAdmins.userid = :userID OR comments.userID = :userID)';

        $statement = $db->prepare($deleteComment);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':commentID', $commentID);
        $statement->execute();
    }
}
