<?php
require_once (File::build_path(array(
        'model',
        'Model.php'
)));

class ModelUser
{

    public $id;

    public $mail;

    public $password;

    public $nom;

    public $prenom;
    
    // La syntaxe ... = NULL signifie que l'argument est optionel
    // Si un argument optionnel n'est pas fourni,
    // alors il prend la valeur par d�faut, NULL dans notre cas
    public function __construct ($id = NULL, $mail = NULL, $password = NULL, $nom = NULL, 
            $prenom = NULL)
    {
        if (! is_null($id)) {
            $this->id = $id;
        }
        
        if (! is_null($mail)) {
            $this->mail = $mail;
        }
        
        if (! is_null($password)) {
            $this->password = $password;
        }
        
        if (! is_null($nom)) {
            $this->nom = $n;
        }
        
        if (! is_null($prenom)) {
            $this->prenom = $p;
        }
    }

    public function get ($p)
    {
        return $this->$p;
    }

    public function set ($p, $v)
    {
        $this->$p = $v;
    }

    public static function getAllUsers ()
    {
        $requete = "SELECT * FROM user";
        $result = Model::$pdo->query($requete);
        
        $result->setFetchMode(PDO::FETCH_CLASS, 'ModelUser');
        $tab_user = $result->fetchAll();
        // print_r($tab_voit);
        
        return $tab_user;
    }
    
    // Affichage
    public function afficher ()
    {
        $login = htmlspecialchars($this->mail);
        $nom = ucfirst(htmlspecialchars($this->nom));
        $prenom = ucfirst(htmlspecialchars($this->prenom));
        echo "<br>Nom : $nom<br>Prenom : $prenom<br>Mail : $login";
    }

    public static function alreadyFavorite ($id, $mid)
    {
        $sql = 'SELECT * FROM user_movies WHERE user_id=:i AND movie_id=:m AND tag=:t;';
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(':i', $id);
        $req_prep->bindParam(':m', $mid);
        $fav = 'fav';
        $req_prep->bindParam(':t', $fav);
        
        try {
            $req_prep->execute();
        } catch (PDOException $e) {
            echo ("Une erreur est survenue veuillez contactez l'administrateur : hello@tomandrieu.com en incluant ce message : <br>");
            echo ($e->getMessage());
        }
        
        $res = $req_prep->fetchAll(PDO::FETCH_OBJ);
        if (! empty($res)) {
            return true;
        } else {
            return false;
        }
    }

    

    public static function getFavoriteMovies ($id)
    {
        $sql = "SELECT movie_id, movie_title, poster_path FROM user_movies WHERE user_id=:i AND tag=:t;";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(":i", $id);
        $fav = 'fav';
        $req_prep->bindParam(':t', $fav);
        $req_prep->execute();
        
        $res = $req_prep->fetchAll(PDO::FETCH_OBJ);
        $movies = array();
        foreach ($res as $m) {
            $mv = new ModelMovie($m->movie_id, $m->movie_title, null, null, null, 
                    null, null, null, $m->poster_path, null);
            array_push($movies, $mv);
        }
        return $movies;
    }

    public static function alreadySeen ($id, $mid)
    {
        $sql = 'SELECT * FROM user_movies WHERE user_id=:i AND movie_id=:m AND tag=:t;';
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(':i', $id);
        $req_prep->bindParam(':m', $mid);
        $seen = 'seen';
        $req_prep->bindParam(':t', $seen);
        
        try {
            $req_prep->execute();
        } catch (PDOException $e) {
            echo ("Une erreur est survenue veuillez contactez l'administrateur : hello@tomandrieu.com en incluant ce message : <br>");
            echo ($e->getMessage());
        }
        
        $res = $req_prep->fetchAll(PDO::FETCH_OBJ);
        if (! empty($res)) {
            return true;
        } else {
            return false;
        }
    }
    public static function addFilmToFavorite ($id, $m)
    {
        
        $sql = 'INSERT INTO user_movies (user_id, movie_id, movie_title, tag, poster_path ) VALUES (:i, :m, :mn, :t, :p);';
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(':i', $id);
        $fav = 'fav';
        $req_prep->bindParam(':t', $fav);
        
        $req_prep->bindParam(':m', $m->id);
        $req_prep->bindParam(':mn', $m->title);
        $req_prep->bindParam(':p', $m->poster);
        try {
            $req_prep->execute();
        } catch (PDOException $e) {
            echo ("Film : $m->title : $m->id ; Une erreur est survenue veuillez contactez l'administrateur<br> : hello@tomandrieu.com <br>en incluant ce message : <br>");
            echo ($e->getMessage());
        }
    }
    
    public static function RemoveFilmFromFavorite ($id, $mid)
    {
        
        $sql = "DELETE FROM user_movies WHERE  movie_id=:m AND user_id=:i AND tag=:t;";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(":i", $id);
        $req_prep->bindParam(":m", $mid);
        $fav = 'fav';
        $req_prep->bindParam(':t', $fav);
        
        try {
            $req_prep->execute();
        } catch (PDOException $e) {
            echo ("Une erreur est survenue veuillez contactez l'administrateur : hello@tomandrieu.com en incluant ce message : <br>");
            echo ($e->getMessage());
        }
    }
    public static function addFilmToSeen ($id, $m)
    {
        $sql = 'INSERT INTO user_movies (user_id, movie_id, movie_title, tag, poster_path ) VALUES (:i, :m, :mn, :t, :p);';
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(':i', $id);
        $seen = 'seen';
        $req_prep->bindParam(':t', $seen);
        
        $req_prep->bindParam(':m', $m->id);
        $req_prep->bindParam(':mn', $m->title);
        $req_prep->bindParam(':p', $m->poster);
        try {
            $req_prep->execute();
        } catch (PDOException $e) {
            echo ("Film : $m->title : $m->id ; Une erreur est survenue veuillez contactez l'administrateur<br> : hello@tomandrieu.com <br>en incluant ce message : <br>");
            echo ($e->getMessage());
        }
    }

    public static function RemoveFilmFromSeen ($id, $mid)
    {        
        $sql = "DELETE FROM user_movies WHERE  movie_id=:m AND user_id=:i AND tag=:t;";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(":i", $id);
        $req_prep->bindParam(":m", $mid);
        $seen = 'seen';
        $req_prep->bindParam(':t', $seen);
        
        try {
            $req_prep->execute();
        } catch (PDOException $e) {
            echo ("Une erreur est survenue veuillez contactez l'administrateur : hello@tomandrieu.com en incluant ce message : <br>");
            echo ($e->getMessage());
        }
    }

    public static function getSeenMovies ($id)
    {
        $sql = "SELECT movie_id, movie_title, poster_path FROM user_movies WHERE user_id=:i AND tag=:t;";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(":i", $id);
        $seen = 'seen';
        $req_prep->bindParam(':t', $seen);
        
        try {
            $req_prep->execute();
        } catch (PDOException $e) {
            echo ("Une erreur est survenue veuillez contactez l'administrateur : hello@tomandrieu.com en incluant ce message : <br>");
            echo ($e->getMessage());
        }
        
        $res = $req_prep->fetchAll(PDO::FETCH_OBJ);
        $movies = array();
        foreach ($res as $m) {
            $mv = new ModelMovie($m->movie_id, $m->movie_title, null, null, null, 
                    null, null, null, $m->poster_path, null);
            array_push($movies, $mv);
        }
        return $movies;
    }

    public static function alreadyToSee ($id, $mid)
    {
        $sql = 'SELECT * FROM user_movies WHERE user_id=:i AND movie_id=:m AND tag=:t;';
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(':i', $id);
        $req_prep->bindParam(':m', $mid);
        $seen = 'toSee';
        $req_prep->bindParam(':t', $seen);
        
        try {
            $req_prep->execute();
        } catch (PDOException $e) {
            echo ("Une erreur est survenue veuillez contactez l'administrateur : hello@tomandrieu.com en incluant ce message : <br>");
            echo ($e->getMessage());
        }
        
        $res = $req_prep->fetchAll(PDO::FETCH_OBJ);
        if (! empty($res)) {
            return true;
        } else {
            return false;
        }
    }

    public static function addFilmToToSee ($id, $m)
    {
        $sql = 'INSERT INTO user_movies (user_id, movie_id, movie_title, tag, poster_path) VALUES (:i, :m, :mn, :t, :p);';
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(':i', $id);
        $req_prep->bindParam(':m', $m->id);
        $req_prep->bindParam(':mn', $m->title);
        $seen = 'toSee';
        $req_prep->bindParam(':t', $seen);
        $req_prep->bindParam(':p', $m->poster);
        
        try {
            $req_prep->execute();
        } catch (PDOException $e) {
            echo ("Film : $m->title : $m->id ; Une erreur est survenue veuillez contactez l'administrateur<br> : hello@tomandrieu.com <br>en incluant ce message : <br>");
            echo ($e->getMessage());
        }
    }

    public static function RemoveFilmFromToSee ($id, $mid)
    {
        
        $sql = "DELETE FROM user_movies WHERE  movie_id=:m AND user_id=:i AND tag=:t;";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(":i", $id);
        $req_prep->bindParam(":m", $mid);
        $seen = 'toSee';
        $req_prep->bindParam(':t', $seen);
        
        try {
            $req_prep->execute();
        } catch (PDOException $e) {
            echo ("Film : $mid ; Une erreur est survenue veuillez contactez l'administrateur<br> : hello@tomandrieu.com <br>en incluant ce message : <br>");
            echo ($e->getMessage());
        }
    }

    public static function getToSeeMovies ($id)
    {
        $sql = "SELECT movie_id, movie_title, poster_path FROM user_movies WHERE user_id=:i AND tag=:t;";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->bindParam(":i", $id);
        $seen = 'toSee';
        $req_prep->bindParam(':t', $seen);
        
        try {
            $req_prep->execute();
        } catch (PDOException $e) {
            echo ("Une erreur est survenue veuillez contactez l'administrateur<br> : hello@tomandrieu.com <br>en incluant ce message : <br>");
            echo ($e->getMessage());
        }
        
        $res = $req_prep->fetchAll(PDO::FETCH_OBJ);
        $movies = array();
        foreach ($res as $m) {
            $mv = new ModelMovie($m->movie_id, $m->movie_title, null, null, null, 
                    null, null, null, $m->poster_path, null);
            array_push($movies, $mv);
        }
        return $movies;
    }

    public static function createUser ($mail, $password, $nom, $prenom)
    {
        $alreadyExist = ModelUser::checkMail($mail);
        if (! $alreadyExist) {
            $sql = 'INSERT INTO user (mail, password, nom, prenom) VALUES (:m, :ps, :n, :p);';
            try {
                
                $req_prep = Model::$pdo->prepare($sql);
            } catch (Exception $e) {
                echo ("<br><br><b>ERREUR Contactez l'administrateur a cette adresse : hello@tomandrieu.com</b> en sp�cifiant l'erreur :<br> ");
                print_r($e);
            }
            
            $pass_hash = password_hash($password, PASSWORD_BCRYPT);
            $req_prep->bindParam(':m', $mail);
            $req_prep->bindParam(':ps', $pass_hash);
            $req_prep->bindParam(':n', $nom);
            $req_prep->bindParam(':p', $prenom);
            
            try {
                $req_prep->execute();
            } catch (Exception $e) {
                echo ("<br><br><b>ERREUR Contactez l'administrateur a cette adresse : hello@tomandrieu.com</b> en sp�cifiant l'erreur :<br> ");
                print_r($e);
            }
            
            $sql = "SELECT * FROM user WHERE mail =:mail";
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->bindParam(':mail', $mail);
            $req_prep->execute();
            
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUser');
            $tab_user = $req_prep->fetch();
            return $tab_user;
        } else {
            echo ("<br><b>Un utilisateur avec cette email existe deja</b>");
        }
    }

    public static function getUserById ($id)
    {
        $sql = "SELECT * from user WHERE id=:i";
        try {
            $req_prep = Model::$pdo->prepare($sql);
        } catch (PDOException $e) {
            echo ("<br><br><b>ERREUR Contactez l'administrateur a cette adresse : hello@tomandrieu.com</b> en sp�cifiant l'erreur :<br> ");
            print_r($e);
        }
        
        $values = array(
                'i' => $id
        );
        try {
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUser');
            $tab_user = $req_prep->fetchAll();
        } catch (PDOException $e) {
            echo ("<br><br><b>ERREUR Contactez l'administrateur a cette adresse : hello@tomandrieu.com</b> en sp�cifiant l'erreur :<br> ");
            print_r($e);
        }
        
        if (empty($tab_user)) {
            return false;
        }
        return $tab_user[0];
    }

    public static function connectedUser ($mail, $password)
    {
        $sql = 'SELECT * from user WHERE mail=:m';
        try {
            $req_prep = Model::$pdo->prepare($sql);
        } catch (PDOException $e) {
            echo ("<br><br><b>ERREUR Contactez l'administrateur a cette adresse : hello@tomandrieu.com</b> en sp�cifiant l'erreur :<br> ");
            print_r($e);
        }
        
        $values = array(
                'm' => $mail
        );
        try {
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUser');
            $user = $req_prep->fetch();
        } catch (PDOException $e) {
            echo ("<br><br><br><b>ERREUR Contactez l'administrateur a cette adresse : <u>hello@tomandrieu.com</u> en sp�cifiant l'erreur :</b><br><br>");
            print_r($e);
        }
        if (! $user) {
            return false;
        } else {
            
            $mdp = $user->password;
            
            if (password_verify($password, $mdp)) {
                return $user;
            } else {
                return false;
            }
        }
    }

    public static function checkMail ($mail)
    {
        $sql = "SELECT * from user WHERE mail=:mail";
        try {
            $req_prep = Model::$pdo->prepare($sql);
        } catch (PDOException $e) {
            echo ("<br><br><b>ERREUR Contactez l'administrateur a cette adresse : hello@tomandrieu.com</b> en sp�cifiant l'erreur :<br> ");
            print_r($e);
        }
        
        $values = array(
                'mail' => $mail
        );
        // On donne les valeurs et on ex�cute la requ�te
        try {
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUser');
            $tab_user = $req_prep->fetchAll();
        } catch (PDOException $e) {
            echo ("<br><br><b>ERREUR Contactez l'administrateur a cette adresse : hello@tomandrieu.com</b> en sp�cifiant l'erreur :<br> ");
            print_r($e);
        }
        
        // On r�cup�re les r�sultats comme pr�c�demment
        
        // Attention, si il n'y a pas de r�sultats, on renvoie false
        if (empty($tab_user)) {
            return false;
        } else {
            return true;
        }
    }

    public static function getId ($mail, $password)
    {
        $sql = "SELECT id from user WHERE mail=:mail AND password=:ps";
        try {
            $req_prep = Model::$pdo->prepare($sql);
        } catch (PDOException $e) {
            echo ("<br><br><b>ERREUR Contactez l'administrateur a cette adresse : hello@tomandrieu.com</b> en sp�cifiant l'erreur :<br> ");
            print_r($e);
        }
        
        $values = array(
                'mail' => $mail,
                'ps' => $password
        );
        // On donne les valeurs et on ex�cute la requ�te
        try {
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUser');
            $tab_user = $req_prep->fetchAll();
        } catch (PDOException $e) {
            echo ("<br><br><b>ERREUR</b> : " . $e->getMessage());
            exit(0);
        }
        
        // On r�cup�re les r�sultats comme pr�c�demment
        
        // Attention, si il n'y a pas de r�sultats, on renvoie false
        if (empty($tab_user)) {
            return false;
        } else {
            return $tab_user[0];
        }
    }
}
?>

