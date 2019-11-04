<?php

require_once 'models/database.php';
require_once 'models/subreddit/subreddit.php';

class subredditDA
{
    public static function insert_subreddit($subredditID, $boardName, $boardDescription)
    {
        $db = Database::getDB();

        $query = 'INSERT INTO subreddits(subredditID, subredditName, subredditDescription)
                VALUES(:subredditID, :subredditName, :subredditDescription)';
        $statement = $db->prepare($query);
        $statement->bindValue(':subredditID', $subredditID);
        $statement->bindValue(':subredditName', $boardName);
        $statement->bindValue(':subredditDescription', $boardDescription);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function get_all()
    {
        $db = Database::getDB();

        $querySubreddits = 'SELECT * FROM subreddits';
        $statement = $db->prepare($querySubreddits);
        $statement->execute();
        $rows = $statement->fetchAll();

        foreach ($rows as $value) {
            $subreddit = new subreddit($value['subredditID'], $value['subredditName'], $value['subredditDescription']);
            $subreddits[] = $subreddit;
        }

        $statement->closeCursor();
        return $subreddits;
    }

    public static function get_board($id)
    {
        $db = Database::getDB();

        $querySubreddits = 'SELECT * FROM subreddits where subredditID = :id';
        $statement = $db->prepare($querySubreddits);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $rows = $statement->fetchAll();

        foreach ($rows as $value) {
            $subreddit = new subreddit($value['subredditID'], $value['subredditName'], $value['subredditDescription']);
            $subreddits[] = $subreddit;
        }

        $statement->closeCursor();
        return $subreddits;
    }
}
