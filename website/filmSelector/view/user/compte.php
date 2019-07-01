<?php
$id = $_SESSION['id'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$mail = $_SESSION['mail'];
echo("<br>Nom : $nom<br>Prenom : $prenom<br>Mail : $mail");

$id = $_SESSION['id'];
$favMovies = ModelUser::getFavoriteMovies($id);
//print_r($favMovies);
echo("<br><br>");
require File::build_path(array('view', 'user', 'movieFav.php'));

$id = $_SESSION['id'];

$seenMovies = ModelUser::getSeenMovies($id);
echo("<br><br>");
require File::build_path(array('view', 'user', 'movieSeen.php'));
$id = $_SESSION['id'];

$toSeeMovies = ModelUser::getToSeeMovies($id);

echo("<br><br>");
require File::build_path(array('view', 'user', 'movieToSee.php'));


?>