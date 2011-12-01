<?php 
$critics = include '../dataset.php';

$distance = sim_pearson($critics["Lisa Rose"], $critics["Gene Seymour"]);
echo "Lisa Rose vs Gene Seymour -> " . $distance . PHP_EOL;

$distance = sim_pearson($critics["Michael Phillips"], $critics["Claudia Puig"]);
echo "Michael Phillips vs Claudia Puig -> " . $distance . PHP_EOL;

$distance = sim_pearson($critics["Michael Phillips"], $critics["Gene Seymour"]);
echo "Michael Phillips vs Gene Seymour -> " . $distance . PHP_EOL;


function sim_pearson($person1, $person2)
{
    $keys = array_keys(
        array_intersect(
            $person1,
            $person2
        )
    );
    
    $person1 = array_intersect_key($person1, array_combine($keys, range(1, count($keys))));
    $person2 = array_intersect_key($person2, array_combine($keys, range(1, count($keys)))); 
    
    $sum1 = array_sum($person1);
    $sum2 = array_sum($person2);
    
    $sum1Sq = array_sum(array_map(function($n){return $n*$n;}, $person1));
    $sum2Sq = array_sum(array_map(function($n){return $n*$n;}, $person2));

    $pSum = array_sum(array_map(function($n, $m){return $n*$m;}, $person1, $person2));
    
    //Pearson
    $n = count($person1); //Person 1 is filtered on Person 2 and vice-versa (it's the same count)
    $num = $pSum - ($sum1 * $sum2/$n);
    $den = sqrt(($sum1Sq - pow($sum1, 2) / $n) * ($sum2Sq - pow($sum2, 2) / $n));
    
    $r = $num / $den;
    
    return $r;
}