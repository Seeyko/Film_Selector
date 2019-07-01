<?php
require_once (File::build_path ( array (
		'model',
		'ModelPerson.php' 
) ));

class ControllerPerson {
    
    public static function readPerson(){
        $person = ModelPerson::getPersonFull($_GET['id']);
        // $_GET['movie'] = $movie;
        $controller = 'person';
        $view = 'detail';
        $pagetitle = $person->name;
        require_once (File::build_path(array(
            'view',
            'global',
            'view.php'
        )));
        return $person;
    }
    
	public static function search(){
	    $controller = 'person';
	    $view = 'search';
	    $pagetitle = "Recherche d'une personne";
	    
	    require_once (File::build_path ( array (
	        'view',
	        'global',
	        'view.php'
	    ) ));
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
