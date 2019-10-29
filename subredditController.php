<?php

require_once 'models/database.php';
require_once 'models/subreddit/subredditDA.php';

$action = filter_input(INPUT_POST, 'action');
if ($action === null) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === null) {
        $action = 'home';
    }
}

switch ($action) {
    case 'viewSubreddit':
        $subredditID = filter_input(INPUT_GET, 'id');
        require 'views/viewSubreddit.php';
        die();
        break;
}
