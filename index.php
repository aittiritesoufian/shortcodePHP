<?php

$string = "The people are very nice , [event 95,32,65] , the people are very nice , [event 100-250]";
$regex = "/\[(.*?)\]/";
preg_match_all($regex, $string, $matches);
var_dump($matches);
echo "<br><hr>";

echo $string."<br>";

for($i = 0; $i < count($matches[1]); $i++)
{
    $match = $matches[1][$i];
    $array = explode(' ', $match);
    switch ($array[0]) {
    	case 'event':
			$isList = strpos($array[1], ',');
			if($isList != FALSE){
				//list of ids
				$events = explode(',', $array[1]);//liste d'id
				echo "<br>Liste d'id ";
				for ($j=0; $j < count($events); $j++) { 
					echo $events[$j]." ";
				}
				$string = str_replace($matches[0][$i], "New content of a list", $string);
			} else {
				//intervalle d'id
				$events = explode('-', $array[1]);
				echo "<br>Intervalle d'id ";
				echo $events[0]." ";//intervalle de début
				echo $events[1];//intervalle de fin
				$string = str_replace($matches[0][$i], "New content of an interval", $string);
			}
    		break;
    	case 'newsletter':
    		//
    		break;
    	
    	default:
    		# code...
    		break;
    }
}
echo "<br>";
echo $string;