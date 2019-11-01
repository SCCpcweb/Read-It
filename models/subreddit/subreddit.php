<?php

class subreddit
{
    private $subredditID, $subredditName, $subredditDescription;

    public function __construct($subredditID, $subredditName, $subredditDescription)
    {
        $this->subredditID = $subredditID;
        $this->subredditName = $subredditName;
        $this->subredditDescription = $subredditDescription;
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
    public function getSubredditDescription()
    {
        return $this->subredditDescription;
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
    public function setSubredditDescription($subredditDescription)
    {
        $this->subredditDescription = $subredditDescription;
    }
}
