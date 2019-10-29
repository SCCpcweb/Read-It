<?php

class subreddit
{
    private $subredditID, $subredditName;

    public function __construct($subredditID, $subredditName)
    {
        $this->subredditID = $subredditID;
        $this->subredditName = $subredditName;
    }

    // getters
    public function getSubredditID()
    {
        return $this->subredditID;
    }
    public function getSubredditName()
    {
        return $this->subredditName;
    }

    // setters
    public function setSubredditID($subredditID)
    {
        $this->subredditID = $subredditID;
    }
    public function setSubredditName($subredditName)
    {
        $this->subredditName = $subredditName;
    }
}
