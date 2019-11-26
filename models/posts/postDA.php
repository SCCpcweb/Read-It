<?php

require_once 'models/database.php';
require_once 'models/posts/post.php';

class postDA
{
    public static function insert_post($postID, $subredditID, $userID, $postTitle, $postContent, $postTime)
    {
        $db = Database::getDB();

        $query = 'INSERT INTO posts(postID, subredditID, userID, postTitle, postContent, postTime)
                                VALUES(:postID, :subredditID, :userID, :postTitle, :postContent, :postTime)';
        $statement = $db->prepare($query);
        $statement->bindValue(':postID', $postID);
        $statement->bindValue(':subredditID', $subredditID);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':postTitle', $postTitle);
        $statement->bindValue(':postContent', $postContent);
        $statement->bindValue(':postTime', $postTime);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function get_all_posts_from_subreddit($id)
    {
        $db = Database::getDB();

        $queryPosts = 'SELECT * FROM subreddits WHERE subredditID = :id';
        $statement = $db->prepare($queryPosts);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $rows = $statement->fetchAll();

        foreach ($rows as $value) {
            $post = new post($value['postID'], $value['subredditID'], $value['userID'], $value['postTitle'], $value['postContent'], $value['postTime']);
            $posts[] = $post;
        }

        $statement->closeCursor();
        return $posts;
    }

    public static function get_post_by_userID($userID)
    {
        $db = Database::getDB();

        $queryPosts = 'SELECT * FROM posts WHERE userID = :userID';
        $statement = $db->prepare($queryPosts);
        $statement->bindValue(':userID', $userID);
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
}
