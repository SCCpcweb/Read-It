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
            $subreddit = new subreddit($value['subredditID'], $value['subredditName']);
            $subreddits[] = $subreddit;
        }

        $statement->closeCursor();
        return $subreddits;
    }
}
