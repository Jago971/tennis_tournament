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
//connect DB XX



$db = new PDO(
    'mysql:host=DB;dbname=tennis_tournament',
    'root',
    'password'
);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
