<?php

require_once('models/database.php');
require_once('models/user.php');

class userDA
{
    public static function get_all()
    {
        $db = Database::getDB();

        $queryUsers = 'SELECT * FROM users';
        $statement = $db->prepare($queryUsers);
        $statement->execute();
        $rows = $statement->fetchAll();

        foreach ($rows as $value) {
            $user = new user($value['userID'], $value['username'], $value['email'], $value['password']);
            $users[] = $user;
        }

        $statement->closeCursor();
        return $users;
    }

    public static function insert_user($userID, $username, $email, $password)
    {
        $db = Database::getDB();

        $query = 'INSERT INTO users(userID, username, email, password)
                VALUES(:userID, :username, :email, :password)';
        $statement = $db->prepare($query);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $statement->closeCursor();
    }

    // returns the username if the credentials were correct
    public static function login($username, $password)
    {
        $db = Database::getDB();

        $query = 'SELECT * FROM users WHERE username= :username';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);

        $statement->execute();
        if ($statement->rowCount() === 1) {
            $row = $statement->fetch();
            $id = $row['userID'];
            $username = $row['username'];
            $hashed_pw = $row['password'];
            if (password_verify($password, $hashed_pw)) {
                return $username;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    // gets a singular user from the database
    public static function getUser($username)
    {
        $db = Database::getDB();

        //$queryUser = 'SELECT * FROM users WHERE username like "SamHookstra"';
        $queryUser = 'SELECT * FROM users where username = :username';
        $statement = $db->prepare($queryUser);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $rows = $statement->fetchAll();

        foreach ($rows as $value) {
            $user = new user($value['userID'], $value['username'], $value['email'], $value['password']);
        }

        $statement->closeCursor();
        return $user;
    }

    // check if a username exists in the database
    public static function check_username($username)
    {
        $db = Database::getDB();

        $query = 'SELECT * from users WHERE username= :username';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);

        $error = $statement->execute();
        //if query returns a row then username exists
        if ($statement->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
        $statement->closeCursor();
    }

    // checks if an email exists in the database
    public static function check_email($email)
    {
        $db = Database::getDB();

        $query = 'SELECT * from users WHERE email= :email';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);

        $error = $statement->execute();
        //if query returns a row then email exists
        if ($statement->rowCount() > 0) {
            $error = true;
            return $error;
        } else {
            $error = false;
            return $error;
        }
        $statement->closeCursor();
    }
}
