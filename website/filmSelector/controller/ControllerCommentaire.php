<?php
session_start();
require_once (File::build_path ( array (
    'model',
    'ModelCommentaire.php'
) ));

class ControllerCommentaire {
    
    public static function create(){
        
        $controller = 'commentaire';
        $view = 'formCommentaire';
        $pagetitle = "Ecrire un commentaire";
        require_once (File::build_path(array(
            'view',
            'global',
            'view.php'
        )));
    }
    public static function created(){
        $movie_id = $_GET['id'];
        $user_id = $_SESSION['id'];
        $com = $_POST['msg'];
        
        $commentaire = ModelCommentaire::createCommentaire($movie_id, $user_id, $com);
            $_GET['id'] = $movie_id;
            unset($_GET['controller']);
            unset($_GET['action']);
            
            ControllerMovie::readMovie();
            return $commentaire;
               
    }
    
    public static function searched(){
        $n = $_POST['name'];
        $persons = ModelPerson::searchPersonByName($n);
        $controller = 'person';
        $view = 'searchByNamePersons';
        $pagetitle = "Liste personnes : $n";
        require_once (File::build_path ( array (
            'view',
            'global',
            'view.php'
        ) ));
    }
}
?>
