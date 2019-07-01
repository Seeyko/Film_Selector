<?php

require './view/movie/popularMovies.php';
require './view/movie/upComingMovies.php';

if(isset($_SESSION['nom'])){
    $toSeeMovies = ModelUser::getToSeeMovies($_SESSION['id']);
    if(!empty($toSeeMovies)){
        require File::build_path(array('view', 'user', 'movieToSee.php'));
    }
}
?>