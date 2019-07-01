<?php 
$id = $user->id;
$nom = $user->nom;
$prenom = $user->prenom;
$mail = $user->mail;
echo("<br>Nom : $nom<br>Prenom : $prenom<br>Mail : $mail<br><br>");

$favMovies = ModelUser::getFavoriteMovies($user->id);
//print_r($favMovies);
echo("<br><br>");
require File::build_path(array('view', 'user', 'movieFav.php'));


$seenMovies = ModelUser::getSeenMovies($user->id);
echo("<br><br>");
require File::build_path(array('view', 'user', 'movieSeen.php'));
$toSeeMovies = ModelUser::getToSeeMovies($user->id);

echo("<br><br>");
require File::build_path(array('view', 'user', 'movieToSee.php'));

?>