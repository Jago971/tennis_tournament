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
const SURFACES = [
    'lawn',
    'clay',
    'hard'
];
const WEATHERS = [
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

function winner($p1, $p2) {
    $rand_w = WEATHERS[ rand(0, count(WEATHERS)-1) ];
    $rand_s = SURFACES[ rand(0, count(SURFACES)-1) ];
    $p1score = $p1[$rand_w] * $p1[$rand_s];
    $p2score = $p2[$rand_w] * $p2[$rand_s];
    if ($p1score > $p2score) {
        return $p1;
    } else {
        return $p2;
    }
}
function game($arr)
{
    global $players;
    shuffle($arr);
    while (count($arr) > 0) {
        $player1 = array_pop($arr);
        $player2 = array_pop($arr);
        $winners[] = winner($player1, $player2);
    }
    $players = $winners;
}

function roundWinners($arr) {
    foreach ($arr as $player) {
        echo $player['name'] . ' ';
    }
}

game($players);
echo 'Round 1 winners:<br>';
roundWinners($players);
echo '<br><br>';

game($players);
echo 'Round 2 winners:<br>';
roundWinners($players);
echo '<br><br>';

game($players);
echo 'Round 3 winners:<br>';
roundWinners($players);
echo '<br><br>';

game($players);
echo 'Tournament winner:<br>';
roundWinners($players);
echo '<br><br>';