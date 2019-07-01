<?php 

class ControllerMain{
    
    public static function files(){
        $name = $_GET['name'];
        $controller = 'projet';
        $view = 'accueil';
        $pagetitle = 'Projets';
        
        require_once File::build_path(array('view', 'projet', 'view.php'));
    }
    
   
}
?>