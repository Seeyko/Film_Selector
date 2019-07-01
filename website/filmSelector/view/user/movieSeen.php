<?php
echo ("<div class='title'>Film vu : </div>");
$movies = $seenMovies;
$carrousselID = 'seenMovies';

require File::build_path(array('view', 'movie', 'carousselBigCompte.php'));

?>