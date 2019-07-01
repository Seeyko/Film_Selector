<?php
echo ("<strong>Conseil de film a regarder</strong>");
$movies = ModelMovie::getSimilarMovies($movie->id);
require File::build_path(array('view', 'movie', 'carousselBigCompte.php'));

?>