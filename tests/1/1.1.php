<?php 

$critics = include '../dataset.php';

$distance = sim_distance($critics["Lisa Rose"], $critics["Gene Seymour"]);
echo "Lisa Rose vs Gene Seymour -> " . $distance . PHP_EOL;

$distance = sim_distance($critics["Michael Phillips"], $critics["Claudia Puig"]);
echo "Michael Phillips vs Claudia Puig -> " . $distance . PHP_EOL;

function sim_distance($person1, $person2)
{
    $keys = array_keys(
        array_merge(
            $person1, 
            $person2
        )
    );
    
    $distance = 0;
    $points = array();
    foreach ($keys as $value) {
        
        $first = implode(",", $person1);
        $second = implode(",", $person2);
        
        $point = pow(($person1[$value]-$person2[$value]), 2);
        $points[] = $point;
        
        $distance += $point;
    }
    
    $distance = 1/(1+$distance);
    
    return $distance;
}