<?php
require_once (File::build_path ( array (
		'model',
		'ModelUtilisateur.php' 
) ));

class ControllerUtilisateur {
    
	
	public static function search(){
	    $controller = 'utilisateur';
	    $view = 'search';
	    $pagetitle = "Recherche d'une personne";
	    
	    require_once (File::build_path ( array (
	        'view',
	        'global',
	        'view.php'
	    ) ));
	}
	public static function searched(){
	    $t = $_POST['name'];
	    echo($t);
	    ModelUtilisateur::searchActorByName($t);
	    require_once (File::build_path ( array (
	        'view',
	        'global',
	        'view.php'
	    ) ));
	}
}
?>
