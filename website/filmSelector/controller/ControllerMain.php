<?php 

class ControllerMain{
    
    public static function projet(){
        $controller = 'projet';
        $view = 'accueil';
        $pagetitle = 'Projets';
        
        require_once File::build_path(array('view', 'projet', 'view.php'));
    }
    
    public static function media(){
        $controller = 'media';
        $view = 'accueil';
        $pagetitle = 'Medias';
        
        require_once File::build_path(array('view', 'media', 'view.php'));
    }
}
?>