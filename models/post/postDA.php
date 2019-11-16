<?php

require_once 'models/database.php';
require_once 'models/post/post.php';

class postDA
{
    public static function insert_post($subredditID, $userID, $postTitle, $postContent)
    {
        $db = Database::getDB();

        date_default_timezone_set("America/Chicago");
        $currentDatetime = date('Y/m/d h:i:s a', time());

        $insertPost = 'INSERT INTO posts(postID, subredditID, userID, postTitle, postContent, postTime)
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

    public static function get_posts_for_subreddit($subredditID)
    {
        $db = Database::getDB();

        //$queryUser = 'SELECT * FROM users WHERE username like "SamHookstra"';
        $queryPosts = 'SELECT * FROM posts where subredditID = :subredditID';
        $statement = $db->prepare($queryPosts);
        $statement->bindValue(':subredditID', $subredditID);
        $statement->execute();
        $rows = $statement->fetchAll();
        $posts = [];

        foreach ($rows as $value) {
            $post = new post($value['postID'], $value['subredditID'], $value['userID'], $value['postTitle'], $value['postContent'], $value['postTime'], $value['rating']);
            array_push($posts, $post);
        }

        $statement->closeCursor();
        return $posts;
    }

    public static function get_post($postID)
    {
        $db = Database::getDB();

        //$queryUser = 'SELECT * FROM users WHERE username like "SamHookstra"';
        $queryPost = 'SELECT * FROM posts where postID = :postID';
        $statement = $db->prepare($queryPost);
        $statement->bindValue(':postID', $postID);
        $statement->execute();
        $rows = $statement->fetchAll();

        foreach ($rows as $value) {
            $post = new post($value['postID'], $value['subredditID'], $value['userID'], $value['postTitle'], $value['postContent'], $value['postTime'], $value['rating']);
        }

        $statement->closeCursor();
        return $post;
    }

    public static function update_post($postID, $postContent)
    {
        $db = Database::getDB();

        $updatePost = 'UPDATE posts SET postContent = :postContent, postTime = NOW() WHERE postID LIKE :postID';
        $statement = $db->prepare($updatePost);
        $statement->bindValue(':postID', $postID);
        $statement->bindValue(':postContent', $postContent);
        // $statement->bindValue(':postTime', $currentDatetime);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function delete_post($postID)
    {
        $db = Database::getDB();

        $deletePost = 'DELETE FROM posts WHERE postID LIKE :postID';
        $statement = $db->prepare($deletePost);
        $statement->bindValue(':postID', $postID);
        $statement->execute();
        $statement->closeCursor();
    }
}
