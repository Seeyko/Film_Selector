<?php
echo("<br><br><img src='http://image.tmdb.org/t/p/w185/$person->poster' width='199' height='300' border='0'/><br>");

echo("<br><b>$person->name</b><br><br>");
echo("<br>Biographie : $person->biography <br>");
echo("<br><br>Connu pour: $person->known_for_department<br>");
$sexe;
$gender = $person->gender;
if($gender == 1){
    $sexe = "Femme";
}else if($gender == 2){   
    $sexe = "Homme";
}else{   
    $sexe = "Unknow";
}
echo("Populariter : $person->popularity sexe : $sexe<br>");
echo("Nee le $person->birthday a $person->place_of_birth, mort le : $person->deathday<br><br>Films :<br><br>");

$movies = $person->movies;
require File::build_path(array('view', 'movie', 'carousselBig.php'));

?>