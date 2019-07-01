<?php
echo ("<strong>Liste des films populaires (Cette liste est mise a jour a 20h05)</strong>");

$movies = ModelMovie::nbPopularMoviesInDB();

require_once File::build_path(array('view', 'movie', 'carousselBig.php'));

?>
