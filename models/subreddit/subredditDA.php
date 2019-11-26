<?php

require_once 'models/database.php';
require_once 'models/subreddit/subreddit.php';
require_once 'models/user.php';

class subredditDA
{
    public static function insert_subreddit($boardName, $boardDescription)
    {
        $db = Database::getDB();

        $query = 'INSERT INTO subreddits(subredditID, subredditName, subredditDescription)
                VALUES(:subredditID, :subredditName, :subredditDescription)';
        $statement = $db->prepare($query);
        $statement->bindValue(':subredditID', '');
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
        }

        $statement->closeCursor();
        return $subreddit;
    }

    public static function update_board($id, $userID, $subredditDescription)
    {
        $db = Database::getDB();

        $querySubreddits = 'UPDATE subreddits s
                            JOIN subredditadmins sa on s.subredditID = sa.subredditID
                            SET subredditDescription = :subredditDescription
                            WHERE s.subredditID = :subredditID
                            AND sa.userID = :userID';
        $statement = $db->prepare($querySubreddits);
        $statement->bindValue(':subredditID', $id);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':subredditDescription', $subredditDescription);
        $statement->execute();

        $statement->closeCursor();;
    }

    public static function add_subreddit_admin($subredditID, $userID)
    {
        $db = Database::getDB();

        $addAdmin = 'INSERT INTO subredditadmins(subredditID, userID) VALUES(:subredditID, :userID)';
        $statement = $db->prepare($addAdmin);
        $statement->bindValue(':subredditID', $subredditID);
        $statement->bindValue(':userID', $userID);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function get_latest_board()
    {
        $db = Database::getDB();

        $query = 'SELECT * FROM subreddits ORDER BY subredditID DESC LIMIT 1';
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $subreddit = '';

        foreach ($rows as $value) {
            $subreddit = new subreddit($value['subredditID'], $value['subredditName'], $value['subredditDescription']);
        }

        $statement->closeCursor();
        return $subreddit;
    }

    public static function get_subreddit_admins($subredditID)
    {
        $db = Database::getDB();

        $query = 'SELECT * FROM subredditadmins WHERE subredditID LIKE :subredditID';
        $statement = $db->prepare($query);
        $statement->bindValue(':subredditID', $subredditID);
        $statement->execute();
        $rows = $statement->fetchAll();
        $admins = [];

        foreach ($rows as $value) {
            array_push($admins, $value['userID']);
        }

        $statement->closeCursor();
        return $admins;
    }
}
