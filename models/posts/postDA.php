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

    public static function delete_post_by_postID($postID, $adminID)
    {
        $db = Database::getDB();

        // potential delete query (kind of)
        // - Select
        // 'SELECT posts.postID, posts.subredditID, sa.userID as "Admin ID" from posts
        // JOIN subredditAdmins sa on posts.userID = sa.userID'

        // - Delete
        // DELETE p from posts p
        // JOIN subredditAdmins sa on p.userid = sa.userid
        // WHERE sa.userid = 1
        // AND p.postID = 34;

        $deletePost = 'DELETE p
                       from posts
                       JOIN subredditAdmins sa on posts.userid = sa.userid
                       WHERE sa.userid = :adminID
                       AND p.postID = :postID';
        $statement = $db->prepare($deletePost);
        $statement->bindValue(':userID', $adminID);
        $statement->bindValue(':postID', $postID);
        $statement->execute();
    }
}
