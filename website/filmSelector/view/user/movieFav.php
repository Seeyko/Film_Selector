<?php
echo ("<div class='title'>Film favoris : </div>");
$movies = $favMovies;
$carrousselID = 'favMovies';
require File::build_path(array('view', 'movie', 'carousselBigCompte.php'));
?>