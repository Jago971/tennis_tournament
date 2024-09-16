<?php
//Tennis tournament

//NEEDS:
//16 players
//each player:
//
//    name - name
//    surface - [lawn, clay, hard]
//    weather - [rain, dry, snow, sunny]

//To do list:

//DB of players and info XXX
//connect DB XXX
//extract player data as array XXX


//----------------------------------------------------------------------------------------------------------------------DECLARE PLAYERS ARRAY
$players = [];
$surfaces = [
    'lawn',
    'clay',
    'hard'
];
$weather = [
    'rain',
    'dry',
    'snow',
    'sunny'
];
//----------------------------------------------------------------------------------------------------------------------CONNECTING TO DB
$db = new PDO(
    'mysql:host=DB;dbname=tennis_tournament',
    'root',
    'password'
);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$query = $db->prepare('SELECT * FROM `players`');

$result = $query->execute();

if ($result) {
    $players = $query->fetchAll();//------------------------------------------------------------------------------------REASSIGN PLAYERS ARRAY
} else {
    echo 'not working';
}

//Tournament function:

//take in players
//take two random players
//decide winner
//move winner to winners, move loser to losers
//repeat until players is empty
//reassign players as winners
//repeat

function playerScore($playerArr, $surface, $weather) {
    $score = $playerArr[$surface] * $playerArr[$weather];
}
function randSurf(&$arr) {
    shuffle($arr);
    return array_pop($arr);
}
function game($arr)
{
    shuffle($arr);
    $player1 = array_pop($arr);
    $player2 = array_pop($arr);

    var_dump($player1);
    echo '<br>';
    var_dump($player2);
}
var_dump($players);
echo '<br>';
game($players);
echo '<br>';
var_dump($players);
