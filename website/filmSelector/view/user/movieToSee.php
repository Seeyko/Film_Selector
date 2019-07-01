<?php
echo ("<br><div class='Title'>Film a voir :");

$movies = $toSeeMovies;
$carrousselID = 'toSeeMovies';

require File::build_path(array('view', 'movie', 'carousselBigCompte.php'));

?>