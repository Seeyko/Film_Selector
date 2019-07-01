<?php
echo("test");
echo(__DIR__);
require_once '.../model/ModelMovie.php';
echo("test");
ModelMovie::setUpcomingMoviesInDB();
ModelMovie::setPopularMoviesInDB();
echo("testfini");
?>