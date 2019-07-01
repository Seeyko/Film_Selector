<?php
require_once (File::build_path(array(
    'model',
    'ModelMovie.php'
)));
class ControllerMovie
{

    public static function search()
    {
        $controller = 'movie';
        $view = 'search';
        $pagetitle = "Recherche d'un film";
        require_once (File::build_path(array(
            'view',
            'global',
            'view.php'
        )));
    }

    public static function searched()
    {
        $t = $_POST['title'];
        $movies = ModelMovie::search10_bestMovieByName($t);
        $controller = 'movie';
        $view = 'searchByNameMovies';
        $pagetitle = "Liste film : $t";
        require_once (File::build_path(array(
            'view',
            'global',
            'view.php'
        )));
    } 
    public static function readMovie(){
        $movie = ModelMovie::getMovieFull($_GET['id']);
        
        $controller = 'movie';
        $view = 'detail';
        $pagetitle = $movie->getTitle();
        require_once (File::build_path(array(
            'view',
            'global',
            'view.php'
        )));
        return $movie;
    }
    public static function upComingMovies(){        
        $controller = 'movie';
        $view = 'upComingMovies';
        $pagetitle = 'Liste des films qui vont sortir';
        require_once(File::build_path(array(
            'view',
            'global',
            'view.php'
        )));
        return $movies;
    }
    
    public static function popularMovies(){
        $controller = 'movie';
        $view = 'popularMovies';
        $pagetitle = 'Liste des films qui vont sortir';
       
        require_once(File::build_path(array(
            'view',
            'global',
            'view.php'
        )));
        return $movies;
    }
}
?>
