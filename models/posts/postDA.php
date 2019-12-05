<?php

require_once 'models/database.php';
require_once 'models/posts/post.php';
require_once 'models/likes/postLike.php';


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

    public static function get_post($postID)
    {
        $db = Database::getDB();

        $queryPost = 'SELECT * FROM posts where postID = :postID';
        $statement = $db->prepare($queryPost);
        $statement->bindValue(':postID', $postID);
        $statement->execute();
        $rows = $statement->fetchAll();

        foreach ($rows as $value) {
            $post = new post($value['postID'], $value['subredditID'], $value['userID'], $value['postTitle'], $value['postContent'], $value['postTime'], $value['rating']);
        }

        $statement->closeCursor();
        if (empty($post)) {
            return 'No posts found';
        } else {
            return $post;
        }
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

    public static function get_all_posts_from_subreddit($id)
    {
        $db = Database::getDB();

        $queryPosts = 'SELECT * FROM subreddits WHERE subredditID = :id';
        $statement = $db->prepare($queryPosts);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $rows = $statement->fetchAll();

        foreach ($rows as $value) {
            $post = new post($value['postID'], $value['subredditID'], $value['userID'], $value['postTitle'], $value['postContent'], $value['postTime'], $value['rating']);
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

    public static function like_post($postID)
    {
        $db = Database::getDB();

        $likePost = 'UPDATE posts
                     SET rating = rating + 1
                     WHERE postID = :postID';
        $statement = $db->prepare($likePost);
        $statement->bindValue(':postID', $postID);
        $statement->execute();
    }

    public static function dislike_post($postID)
    {
        $db = Database::getDB();

        $likePost = 'UPDATE posts
                     SET rating = rating - 1
                     WHERE postID = :postID';
        $statement = $db->prepare($likePost);
        $statement->bindValue(':postID', $postID);
        $statement->execute();
    }

    public static function add_to_post_likes($postID, $userID, $likeOrDislike)
    {
        $db = Database::getDB();

        $query = 'INSERT INTO postlikes(likeID, postID, userID, likeOrDislike)
                                VALUES(:likeID, :postID, :userID, :likeOrDislike)';
        $statement = $db->prepare($query);
        $statement->bindValue(':likeID', '');
        $statement->bindValue(':postID', $postID);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':likeOrDislike', $likeOrDislike);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function update_post_likes($postID, $userID, $likeOrDislike)
    {
        $db = Database::getDB();

        $query = 'UPDATE postlikes
                  set likeOrDislike = :likeOrDislike
                  WHERE postID = :postID
                  AND userID = :userID';
        $statement = $db->prepare($query);
        $statement->bindValue(':postID', $postID);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':likeOrDislike', $likeOrDislike);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function has_liked($postID, $userID)
    {
        $db = Database::getDB();

        $query = 'SELECT *
                  FROM postlikes
                  WHERE userID = :userID
                  AND postID = :postID';
        $statement = $db->prepare($query);
        $statement->bindValue(':postID', $postID);
        $statement->bindValue(':userID', $userID);
        $statement->execute();
        $rows = $statement->fetch();
        $statement->closeCursor();

        if (empty($rows)) {
            return false;
        } else {
            return true;
        }
    }

    public static function check_likes($postID, $userID)
    {
        $db = Database::getDB();

        $query = 'SELECT *
                  FROM postlikes
                  WHERE userID = :userID
                  AND postID = :postID';
        $statement = $db->prepare($query);
        $statement->bindValue(':postID', $postID);
        $statement->bindValue(':userID', $userID);
        $statement->execute();
        $rows = $statement->fetchAll();

        foreach ($rows as $value) {
            $like = new PostLike($value['likeID'], $value['postID'], $value['userID'], $value['likeOrDislike']);
        }

        $statement->closeCursor();

        return $like;
    }
}
