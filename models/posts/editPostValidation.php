<?php

require_once 'models/post/postDA.php';
require_once 'models/user.php';

// user inputs 
$postContent = filter_input(INPUT_POST, 'postContent');

// trim the content
$postContent = $trim($postContent);

// errors array
$postErrors = [];
