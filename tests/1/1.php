<?php 

$xml = simplexml_load_file(dirname(__FILE__) . '/../dataset-1.xml');
$critics = json_decode(json_encode($xml));

$distance = sim_distance($critics, $critics->LisaRose, $critics->GeneSeymour);
echo $distance . PHP_EOL;

$distance = sim_distance($critics, $critics->MichaelPhillips, $critics->ClaudiaPuig);
echo $distance . PHP_EOL;

//TODO: refactor
function sim_distance($critics, $person1, $person2)
{
    $table = array();
    
    foreach ($person1->movie as $movie) {
        $table[$movie->name][0] = $movie->grade;
    }
    
    foreach ($person2->movie as $movie) {
        $table[$movie->name][1] = $movie->grade;
    }
    
    $distance = 0;
    foreach ($table as $key => $value) {
        $distance += pow(($value[0]-$value[1]),2);
    }
    
    $distance = 1/(1+$distance);
    
    return $distance;
}