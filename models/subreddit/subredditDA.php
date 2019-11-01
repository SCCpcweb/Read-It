<?php

require_once 'models/database.php';
require_once 'models/subreddit/subreddit.php';

class subredditDA
{
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
