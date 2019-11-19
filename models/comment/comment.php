<?php

class Comment
{
    private $commentID, $userID, $subredditID, $commentContent, $commentTime;

    public function __construct($commentID, $userID, $subredditID, $commentContent, $commentTime)
    {
        $this->$commentID = $commentID;
        $this->$userID = $userID;
        $this->$subredditID = $subredditID;
        $this->$commentContent = $commentContent;
        $this->$commentTime = $commentTime;
    }

    // getters 
    public function getCommentID()
    {
        return $this->commentID;
    }
    public function getuserID()
    {
        return $this->userID;
    }
    public function getSubredditID()
    {
        return $this->subredditID;
    }
    public function getCommentContent()
    {
        return $this->commentContent;
    }
    public function getCommentTime()
    {
        return $this->commentTime;
    }

    // setters
    public function setCommentID($commentID)
    {
        $this->commentID = $commentID;
    }
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }
    public function setSubredditID($subredditID)
    {
        $this->subredditID = $subredditID;
    }
    public function setCommentContent($commentContent)
    {
        $this->commentContent = $commentContent;
    }
    public function set($commentTime)
    {
        $this->commentTime = $commentTime;
    }
}
