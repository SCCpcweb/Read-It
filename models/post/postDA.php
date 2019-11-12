<?php

require_once 'models/database.php';
require_once 'models/post/post.php';

class postDA
{
    public static function insert_post($subredditID, $userID, $postTitle, $postContent)
    {
        $db = Database::getDB();

        date_default_timezone_set("America/New_York");

        $query = 'INSERT INTO posts(postID, subredditID, userID, postTitle, postContent, postTime)
                VALUES(:postID, :subredditID, :userID, :postTitle, :postContent, :postTime)';
        $statement = $db->prepare($query);
        $statement->bindValue(':postID', '');
        $statement->bindValue(':subredditID', $subredditID);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':postTitle', $postTitle);
        $statement->bindValue(':postContent', $postContent);
        $statement->bindValue(':postTime', 'NOW()');
        $statement->execute();
        $statement->closeCursor();
    }

    public static function get_posts_for_subreddit($subredditID)
    {
        $db = Database::getDB();

        //$queryUser = 'SELECT * FROM users WHERE username like "SamHookstra"';
        $queryUser = 'SELECT * FROM posts where subredditID = :subredditID';
        $statement = $db->prepare($queryUser);
        $statement->bindValue(':subredditID', $subredditID);
        $statement->execute();
        $rows = $statement->fetchAll();

        foreach ($rows as $value) {
            $post = new post($value['postID'], $value['subredditID'], $value['userID'], $value['postTitle'], $value['postContent'], $value['postTime']);
            $posts[] = $post;
        }

        $statement->closeCursor();
        return $posts;
    }

    public static function get_post($postID)
    {
        $db = Database::getDB();

        //$queryUser = 'SELECT * FROM users WHERE username like "SamHookstra"';
        $queryUser = 'SELECT * FROM posts where postID = :postID';
        $statement = $db->prepare($queryUser);
        $statement->bindValue(':postID', $postID);
        $statement->execute();
        $rows = $statement->fetchAll();

        foreach ($rows as $value) {
            $post = new post($value['postID'], $value['subredditID'], $value['userID'], $value['postTitle'], $value['postContent'], $value['postTime']);
        }

        $statement->closeCursor();
        return $post;
    }
}
