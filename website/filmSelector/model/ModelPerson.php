<?php
require_once (File::build_path(array(
    'model',
    'Model.php'
)));

class ModelPerson
{
    public $id;
    public $name;
    public $popularity;
    public $movies;
    public $birthday;
    public $deathday;
    public $known_for_department;
    public $gender;
    public $biography;
    public $place_of_birth;
    public $poster;
    
    public function __construct($id, $name, $popularity = NULL, $movies = NULL, $birthday = NULL, $deathday = NULL, $kf = NULL, $gender = NULL, $bio = NULL, $p_birth = NULL, $poster = NULL){
        $this->id = $id;
        $this->name = $name;
        
        if(!is_null($popularity)){
            $this->popularity = $popularity;
        }
        if(!is_null($movies)){
            $this->movies = $movies;
        }
        if(!is_null($birthday)){
            $this->birthday = $birthday;
        }
        if(!is_null($deathday)){
            $this->deathday = $deathday;
        }else{
            $this->deathday = "Unknow";
        }
        if(!is_null($kf)){
            $this->known_for_department = $kf;
        }
        if(!is_null($gender)){
            $this->gender = $gender;
        }
        if(!is_null($bio)){
            $this->biography = $bio;
        }
        if(!is_null($p_birth)){
            $this->place_of_birth = $p_birth;
        }
        if(!is_null($poster)){
            $this->poster = $poster;
        }
        
    }
    
    public function getName(){
        return $this->name;
    }
    public function set($p, $v){
        $this->$p = $v;
    }
    public function get($p){
        return $this->$p;
    }
    public function getShortCut(){
        $lienUrl = "./index.php?controller=person&action=readPerson&id=$this->id";
        return $lienUrl;
    }
    public function afficherShort(){
        echo("<br><li><a href=".$this->getShortCut().">$this->name</a></li>populariter: $this->popularity<br>");
    }
    public function afficherNameSC(){
        echo("<a href=".$this->getShortCut().">$this->name</a>");
    }
    public function getMoviePlayed(){
        $id = $this->id;
        $ide = urlencode($id);
        $url = "https://api.themoviedb.org/3/person/" . $ide . "/movie_credits?api_key=" . Conf::$API_KEY . "&language=fr";
        $json = file_get_contents($url);
        $obj = json_decode($json);
        
        $movies = array();
        foreach ($obj->cast as $mv){
            $id = $mv->id;
            $title = $mv->title;
            $char = $mv->character;
            $poster = $mv->poster_path;
            $m = new ModelMovie($id, $title, null, null, null, null, $char, null, $poster, null );
            array_push($movies, $m);
        }
        return $movies;
    }
    
    public static function getPersonFull($id){
        $ide = urlencode($id);
        $url = "https://api.themoviedb.org/3/person/" . $ide . "?api_key=" . Conf::$API_KEY. "&language=fr";
        $json = file_get_contents($url);
        $obj = json_decode($json);
        
        $name = $obj->name;
        $popularity = $obj->popularity;
        $birthday = $obj->birthday;
        $deathday = $obj->deathday;
        $known_for_department = $obj->known_for_department;
        $gender = $obj->gender;
        $biography = $obj->biography;
        $place_of_birth = $obj->place_of_birth;
        $poster = $obj->profile_path;
        $mv = new ModelPerson($id, $name, $popularity,null, $birthday, $deathday, $known_for_department, $gender, $biography, $place_of_birth, $poster);
        $mv->movies = $mv->getMoviePlayed();
        return $mv;
    }
    public static function searchPersonByName($n)
    {
        $ne = urlencode($n);
        $url = "https://api.themoviedb.org/3/search/person?api_key=" . Conf::$API_KEY . "&language=frS&query=" . $ne . "&page=1&include_adult=false";

        $json = file_get_contents($url);
        $obj = json_decode($json);

        $reslt = $obj->results;
        $persons = array();
        foreach ($reslt as $res) {
            $id = $res->id;
            $name = $res->name;
            $popularity = $res->popularity;
            $arrayMovies = $res->known_for;
            $poster = $res->profile_path;
            $movies = array();

            foreach($arrayMovies as $movie) {
                $m_id = $movie->id;
                $m_title = $movie->title;
                
                $m_poster = $movie->poster_path;
                $m = new ModelMovie($m_id, $m_title, null, null, null, null, null, null, $m_poster, null);
                array_push($movies, $m);
            }

            $person = new ModelPerson($id, $name, $popularity, $movies, null, null, null, null, null, null, $poster);
            array_push($persons, $person);
        }
        return $persons;
    }
}
?>

