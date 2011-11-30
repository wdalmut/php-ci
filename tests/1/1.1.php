<?php 

$critics = include '../dataset.php';

$distance = sim_distance($critics["Lisa Rose"], $critics["Gene Seymour"]);
echo $distance . PHP_EOL;

$distance = sim_distance($critics["Michael Phillips"], $critics["Claudia Puig"]);
echo $distance . PHP_EOL;

function sim_distance($person1, $person2)
{
    $keys = array_keys(
        array_merge(
            $person1, 
            $person2
        )
    );
    
    $distance = 0;
    foreach ($keys as $value) {
        $distance += pow(($person1[$value]-$person2[$value]), 2);
    }
    
    $distance = 1/(1+$distance);
    
    return $distance;
}