<?php

class post
{
    private $postID, $subredditID, $userID, $postTitle, $postContent, $postTime;

    public function __construct($postID, $subredditID, $userID, $postTitle, $postContent, $postTime)
    {
        $this->postID = $postID;
        $this->subredditID = $subredditID;
        $this->userID = $userID;
        $this->postTitle = $postTitle;
        $this->postContent = $postContent;
        $this->postTime = $postTime;
    }

    // getters
    public function getPostID()
    {
        return $this->postID;
    }
    public function getSubredditID()
    {
        return $this->subredditID;
    }
    public function getUserID()
    {
        return $this->userID;
    }
    public function getPostTitle()
    {
        return $this->postTitle;
    }
    public function getPostContent()
    {
        return $this->postContent;
    }
    public function getPostTime()
    {
        return $this->postTime;
    }

    // setters
    public function setPostID($postID)
    {
        $this->postID = $postID;
    }
    public function setSubredditID($subredditID)
    {
        $this->subredditID = $subredditID;
    }
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }
    public function setPostTitle($postTitle)
    {
        $this->postTitle = $postTitle;
    }
    public function setPostContent($postContent)
    {
        $this->postContent = $postContent;
    }
    public function setPostTime($postTime)
    {
        $this->postTime = $postTime;
    }
}
