<?php

// user inputs
$boardName = filter_input(INPUT_POST, 'boardName');
$boardDescription = filter_input(INPUT_POST, 'boardDescription');

echo $boardName . ' ' . $boardDescription;
