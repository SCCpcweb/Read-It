<?php

class Comment
{
    private $commentID, $userID, $postID, $subredditID, $commentContent, $commentTime, $rating;

    public function __construct($commentID, $userID, $postID, $subredditID, $commentContent, $commentTime, $rating)
    {
        $this->commentID = $commentID;
        $this->userID = $userID;
        $this->postID = $postID;
        $this->subredditID = $subredditID;
        $this->commentContent = $commentContent;
        $this->commentTime = $commentTime;
        $this->rating = $rating;
    }

    // getters 
    public function getCommentID()
    {
        return $this->commentID;
    }
    public function getUserID()
    {
        return $this->userID;
    }
    public function getPostID()
    {
        return $this->postID;
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
    public function getRating()
    {
        return $this->rating;
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
    public function setPostID($postID)
    {
        $this->postID = $postID;
    }
    public function setSubredditID($subredditID)
    {
        $this->subredditID = $subredditID;
    }
    public function setCommentContent($commentContent)
    {
        $this->commentContent = $commentContent;
    }
    public function setCommentTime($commentTime)
    {
        $this->commentTime = $commentTime;
    }
    public function setRating($rating)
    {
        $this->rating = $rating;
    }
}
