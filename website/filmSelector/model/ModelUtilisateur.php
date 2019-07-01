<?php
require_once(File::build_path(array('model', 'Model.php')));

class ModelUtilisateur {

  private $login;
  private $nom;
  private $prenom;
  private $password;
  private $mail;
  
  
  // La syntaxe ... = NULL signifie que l'argument est optionel
  // Si un argument optionnel n'est pas fourni,
  //   alors il prend la valeur par défaut, NULL dans notre cas
  public function __construct($i = NULL, $m = NULL, $c = NULL, $pass = NULL, $mail = NULL) {

    if (!is_null($m)){
      $this->nom = $m;
    }
    if (!is_null($c)){
      $this->prenom = $c;
    }
    if (!is_null($i)){
      $this->login = $i;
    }
    if(!is_null($pass)){
        $this->password = $pass;
    }
    if(!is_null($mail)){
        $this->mail = $mail;
    }
  }

  
  public function get($p){
  	return $this->$p;
  }
  public function set($p, $v){
  	$this->$p = $v;
  }

  public static function getAllUtilisateurs(){

    $requete = "SELECT * FROM utilisateur";
    $result = Model::$pdo->query($requete);
 
    // 1. objets standard
    //$tab_result = $result->fetchAll(PDO::FETCH_OBJ);
    //print_r($tab_result);

    //2. objets Utilisateur
    $result->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
    $tab_voit = $result->fetchAll();
    //print_r($tab_voit);
    
    return $tab_voit;
  }
  
  //Affichage
  public function afficher() {
  	$login = htmlspecialchars($this->login);
  	$nom = ucfirst(htmlspecialchars($this->nom));
  	$prenom = ucfirst(htmlspecialchars($this->prenom));
  	
  	$mail = ucfirst(htmlspecialchars($this->mail));
  	echo "Login Utilisateur : $login<br>Nom : $nom<br>Prenom : $prenom<br>Mail: $mail";
  }
  
  public static function getUtilisateurByLogin($login) {
  	$sql = "SELECT * from utilisateur WHERE login=:nom_tag";
  	// Préparation de la requête
  	$req_prep = Model::$pdo->prepare($sql);
  
  	$values = array(
  			"nom_tag" => $login,
  			//nomdutag => valeur, ...
  	);
  	// On donne les valeurs et on exécute la requête
  	$req_prep->execute($values);
  
  	// On récupère les résultats comme précédemment
  	$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
  	$tab_utilisateur = $req_prep->fetchAll();
  	// Attention, si il n'y a pas de résultats, on renvoie false
  	if (empty($tab_utilisateur))return false;
  	
  	return $tab_utilisateur[0];
  }
  
  public static function searchActorByName($n){
      $n = urlencode($n);
      $url = "https://api.themoviedb.org/3/search/person?api_key=". Conf::$API_KEY . "&language=en-US&query=".$n."&page=1&include_adult=false";
      
      $json = file_get_contents($url) ;
      $obj = json_decode($json);
      
      $res = $obj->results[0];
      $id = $res->id;
      $name = $res->name;
      $popularity = $res->popularity;
      $arrayMovies = $res->known_for;
      $movies = array();
      
      for($i = 0; $i < count($arrayMovies); $i++){
          $movies[$i] = $arrayMovies[$i]->title;
      }
      
      $id = $obj->results[0]->id;
      echo("Acteur : $name<br>Populariter: $popularity<br>Filmographie");
      for($i = 0; $i < count($movies); $i++){
          echo("<br> -$movies[$i]");
      }
      
  }
  
}
?>

