<?php
session_start();
require_once (File::build_path ( array (
    'model',
    'ModelUser.php'
) ));

class ControllerUser {
    
    public static function findFriend(){
        $user = ModelUser::getUserById($_GET['id']);
        $controller = 'user';
        $view = 'detail';
        $pagetitle = $user->nom;
        require_once (File::build_path(array(
            'view',
            'global',
            'view.php'
        )));
    }
    public static function read(){
        // $_GET['movie'] = $movie;
        $controller = 'user';
        $view = 'compte';
        $pagetitle = $_SESSION['nom'];
        require_once (File::build_path(array(
            'view',
            'global',
            'view.php'
        )));
    }
    
    public static function deconnect(){
       
        unset( $_SESSION['id']);
        unset( $_SESSION['mail']);
        unset( $_SESSION['nom']);
        unset( $_SESSION['prenom']);
        
        $controller = 'global';
        $view = 'accueil';
        $pagetitle = "Accueil";
        require_once (File::build_path(array(
            'view',
            'global',
            'view.php'
        )));
    }
    public static function connected(){
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        
        $user = ModelUser::connectedUser($mail, $password);
        
        if(!$user){
            echo("<br>L'adresse mail et le mot de passe ne correspondent pas<br>");
            $controller = 'global';
            $view = 'accueil';
            $pagetitle = "Accueil";
            require_once (File::build_path(array(
                'view',
                'global',
                'view.php'
            )));
        }else{
            
            $_SESSION['id'] = $user->get('id');
            $_SESSION['mail'] = $mail;
            $_SESSION['nom'] = $user->get('nom');
            $_SESSION['prenom'] = $user->get('prenom'); 
           
            $controller = 'user';
            $view = 'compte';
            $pagetitle = "Mon compte";
            require_once (File::build_path(array(
                'view',
                'global',
                'view.php'
            )));
        }
    }
    public static function created(){
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        
        $user = ModelUser::createUser($mail, $password, $nom, $prenom);
        if($user){
            $_SESSION['id'] = $user->get('id');
            $_SESSION['mail'] = $mail;
            $_SESSION['nom'] = $user->get('nom');
            $_SESSION['prenom'] = $user->get('prenom');
            
            $controller = 'user';
            $view = 'compte';
            $pagetitle = "Mon compte";
            require_once (File::build_path(array(
                'view',
                'global',
                'view.php'
            )));
            return $user;
        }
        else{
            $controller = 'global';
            $view = 'accueil';
            $pagetitle = "Accueil";
            require_once (File::build_path(array(
                'view',
                'global',
                'view.php'
            )));
        }
       
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
