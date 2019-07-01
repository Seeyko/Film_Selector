<?php
require_once (File::build_path(array(
    'model',
    'Model.php'
)));

class ModelCommentaire
{

    public $movie_id;

    public $user_id;
    
    public $com;


    // La syntaxe ... = NULL signifie que l'argument est optionel
    // Si un argument optionnel n'est pas fourni,
    // alors il prend la valeur par d�faut, NULL dans notre cas
    public function __construct($movie_id = NULL, $user_id = NULL, $com = NULL)
    {
        if (! is_null($movie_id)) {
            $this->movie_id = $movie_id;
        }

        if (! is_null($user_id)) {
            $this->user_id = $user_id;
        }

        if (! is_null($com)) {
            $this->com = $com;
        }
    }

    public function get($p)
    {
        return $this->$p;
    }

    public function set($p, $v)
    {
        $this->$p = $v;
    }

    public static function getAllCommentaireForMovie($movie_id)
    {
        try {
            $requete = "SELECT * FROM commentaires WHERE movie_id=:m";
            $req_prep = Model::$pdo->prepare($requete);
            $req_prep->bindParam(':m', $movie_id);
            $req_prep->execute();
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommentaire');
            $tab_com = $req_prep->fetchAll();
            return $tab_com;
            
        } catch (PDOException $e) {
            $controller = 'global';
            $view = 'error';
            $pagetile = 'Erreur';
            $error = $e->getMessage() . "<br>" . $e->getTraceAsString();

            require File::build_path(array(
                'view',
                'global',
                'view.php'
            ));
        }
        return $tab_com;
    }
    
    public static function createCommentaire($movie_id, $user_id, $com)
    {
        try{
            $sql = 'INSERT INTO commentaires (movie_id, user_id, com) VALUES (:m, :u, :c);';
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->bindParam(':m', $movie_id);
            $req_prep->bindParam(':u', $user_id);
            $req_prep->bindParam(':c', $com);
            
            $req_prep->execute();
            return true;
        } catch ( PDOException $e) {
            return false;
        }
        return false;
    }
    
}
?>

