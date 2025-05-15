<?php

$superhero = "Superman";

function revealIdentity() {
    global $superhero;
    $message = "real name is Clark Kent";
    echo "$superhero $message\n";
}

revealIdentity();

function countVisitors() {
    static $visitorCount = 0;
    $visitorCount++;
    echo "Visitor #$visitorCount has arrived!\n";
}

function getDb() {
    static $db;

    if ($db === null) {
        $db = connect();
    }

    return $db;
}

countVisitors();
countVisitors();
countVisitors();