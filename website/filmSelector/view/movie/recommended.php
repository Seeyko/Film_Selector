<?php
echo ("<strong>Conseil de film a regarder</strong><br><br>");

$movies = $movie->getRecommendations();
require File::build_path(array('view', 'movie', 'carousselBigCompte.php'));

?>
