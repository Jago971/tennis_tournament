<?php
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

function winner($p1, $p2) {//------------------------------------------------------------------Takes in 2 player, decides random weather and surface, returns winner
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
function game($arr)//---takes in $players array, takes 2 players out per iteration and moves winner into winners array. Iterates whilst players are left in players array. reassigns winners to players
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
foreach ($players as $player) {
    $winner = $player['name'];
}

$query = $db->prepare("SELECT `trophies` FROM `players` WHERE `name` = :winner;");
$result = $query->execute([
    'winner' => $winner
]);
if ($result) {
    $playerTrophies = $query->fetch();//------------------------------------------------------------------------------------REASSIGN PLAYERS ARRAY
} else {
    echo 'not working';
}

$query = $db->prepare("UPDATE `players` SET `trophies` = :trophies WHERE `name` = :winner;");
$result = $query->execute([
    'winner' => $winner,
    'trophies' => ($playerTrophies['trophies'] + 1)
]);