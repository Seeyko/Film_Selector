<?php
echo ("<strong>Liste des films recents (Cette liste est mise a jour tout les jours a 20h05)</strong>");

$movies = ModelMovie::nbUpcomingMoviesInDB();
require File::build_path(array('view', 'movie', 'carousselBig.php'));

?>
