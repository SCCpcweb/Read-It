<?php

class PostLike
{
    private $likeID, $postID, $userID, $likeOrDislike;

    public function __construct($likeID, $postID, $userID, $likeOrDislike)
    {
        $this->likeID = $likeID;
        $this->postID = $postID;
        $this->userID = $userID;
        $this->likeOrDislike = $likeOrDislike;
    }

    // getters 
    public function getLikeID()
    {
        return $this->likeID;
    }
    public function getPostID()
    {
        return $this->postID;
    }
    public function getUserID()
    {
        return $this->userID;
    }
    public function getLikeOrDislike()
    {
        return $this->likeOrDislike;
    }

    // setters
    public function setLikeID($likeID)
    {
        $this->likeID = $likeID;
    }
    public function setPostID($postID)
    {
        $this->postID = $postID;
    }
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }
    public function setLikeOrDislike($likeOrDislike)
    {
        $this->likeOrDislike = $likeOrDislike;
    }
}
