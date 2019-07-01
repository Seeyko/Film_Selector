<?php
require_once (File::build_path(array(
    'model',
    'Model.php'
)));

class ModelMovie
{

    /**
     * Primary key
     */
    public $id;

    /**
     * Name of the movie
     */
    public $title;

    /**
     * Rating of the movie
     *
     * @Contraints 0 <= score <= 10
     */
    public $rating;

    /**
     * The year the movie has been released
     */
    public $released;

    /**
     * Basic genre
     */
    public $genre;

    /**
     * Director name
     */
    public $director;

    /**
     * List of principal actors
     */
    public $actors;

    /**
     * Short description of the movie
     */
    public $shortDescription;

    /**
     * Poster of the movie
     */
    public $poster;

    /**
     * Runtime in minutes
     */
    public $runtime;

    /**
     * Metascore is considered the rating of a film.
     * Scores are assigned to movie's reviews of large group of the world's most respected critics, and weighted average are applied to summarize their opinions range.
     * The result is shown in single number that captures the essence of critical opinion in one Metascore.
     * Movies will get a Metascore only if at least four critics's reviews are collected.
     * The higher the Metascore, the more positive reviews a movie has.
     *
     * @Contraints 0 <= score <= 100
     */
    public $score;

    // La syntaxe ... = NULL signifie que l'argument est optionel
    // Si un argument optionnel n'est pas fourni,
    // alors il prend la valeur par défaut, NULL dans notre cas
    public function __construct($id = NULL, $title = NULL, $rating = NULL, $released = NULL, $genres = NULL, $director = NULL, $acts = NULL, $desc = NULL, $poster = NULL, $rt = NULL)
    {
        if (! is_null($id)) {
            $this->id = $id;
        }
        if (! is_null($title)) {
            $this->title = $title;
        }
        if (! is_null($rating)) {
            $this->rating = $rating;
        }

        if (! is_null($released)) {
            $this->released = $released;
        }

        if (! is_null($genres)) {
            $this->genre = $genres;
        }
        if (! is_null($director)) {
            $this->director = $director;
        }

        if (! is_null($acts)) {
            $this->actors = $acts;
        }
        if (! is_null($desc)) {
            $this->shortDescription = $desc;
        }
        if (! is_null($poster)) {
            $this->poster = $poster;
        }
        if (! is_null($rt)) {
            $this->runtime = $rt;
        }
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getRelease()
    {
        return $this->released;
    }

    public function getShortCut()
    {
        $lienUrl = "./index.php?controller=movie&action=readMovie&id=$this->id";
        return $lienUrl;
    }

    public function afficherShort()
    {
        echo ("<br><li><a href=" . $this->getShortCut() . ">$this->title</a></li>Note: $this->rating<br>Date de sortie : $this->released");
    }

    public function afficherTitleSC()
    {
        echo ("<a href=" . $this->getShortCut() . ">$this->title</a>");
    }

    public static function getMovieFull($id)
    {
        $ide = urlencode($id);
        $url = "https://api.themoviedb.org/3/movie/" . $ide . "?api_key=" . Conf::$API_KEY . "&language=fr";
        $json = file_get_contents($url);
        $obj = json_decode($json);

        $genres = $obj->genres;
        $languages = $obj->original_language;
        $overview = $obj->overview;
        $poster = $obj->poster_path;
        $prodCompName = $obj->production_companies[0]->name;
        $released = $obj->release_date;
        $revenue = $obj->revenue;
        $runtime = $obj->runtime;
        $title = $obj->title;
        $tagline = $obj->tagline;
        $note = $obj->vote_average;
        $actors = ModelMovie::getCrewName($id);

        $mv = new ModelMovie($id, $title, $note, $released, $genres, $prodCompName, $actors, $overview, $poster, $runtime);
        return $mv;
    }

    public static function getCrewName($id)
    {
        $ide = urlencode($id);
        $url = "https://api.themoviedb.org/3/movie/" . $ide . "/credits?api_key=" . Conf::$API_KEY;
        $json = file_get_contents($url);
        $obj = json_decode($json);

        $cast = $obj->cast;
        $names = array();
        for ($i = 0; $i < count($cast); $i ++) {
            $person = $cast[$i];
            $names[$i] = new ModelPerson($person->id, $person->name, null, $cast[$i]->character, null, null, null, null, null, null, $person->profile_path);
        }
        return $names;
    }

    public static function getCrewId($id)
    {
        $ide = urlencode($id);
        $url = "https://api.themoviedb.org/3/movie/" . $ide . "/credits?api_key=" . Conf::$API_KEY;
        $json = file_get_contents($url);
        $obj = json_decode($json);

        $cast = $obj->cast;
        $ids = array();
        for ($i = 0; $i < count($cast); $i ++) {
            $ids[$i] = $cast[$i]->id;
        }
        return $ids;
    }

    public static function search10_bestMovieByName($t)
    {
        $t = urlencode($t);
        $url = "https://api.themoviedb.org/3/search/movie?api_key=" . Conf::$API_KEY . "&language=fr&query=" . $t . "&include_adult=false";
        $json = file_get_contents($url);
        $obj = json_decode($json);

        $tenBestMovies = array();
        $reslt = $obj->results;
        foreach ($reslt as $movie) {

            $id = $movie->id;
            $title = $movie->title;
            $poster = $movie->poster_path;
            $genre = $movie->genre_ids;
            $rate = $movie->vote_average;
            $r = new ModelMovie($id, $title, $rate, null, $genre, null, null, null, $poster, null);
            array_push($tenBestMovies, $r);
        }
        return $tenBestMovies;
    }

    public function getRecommendations()
    {
        $url = "https://api.themoviedb.org/3/movie/" . $this->id . "/recommendations?api_key=" . Conf::$API_KEY . "&language=fr&page=1";
        $json = file_get_contents($url);
        $obj = json_decode($json);

        $recommendatedMovies = array();
        foreach ($obj->results as $movie) {

            $id = $movie->id;
            $title = $movie->title;
            $poster = $movie->poster_path;
            $genre = $movie->genre_ids;
            $rate = $movie->vote_average;
            $overview = $movie->overview;
            $r = new ModelMovie($id, $title, $rate, null, $genre, null, null, $overview, $poster, null);
            array_push($recommendatedMovies, $r);
        }
        return $recommendatedMovies;
    }

    public static function getSimilarMovies($id)
    {
        $url = "https://api.themoviedb.org/3/movie/" . $id . "/similar?api_key=" . Conf::$API_KEY . "&language=fr";
        $json = file_get_contents($url);
        $obj = json_decode($json);

        $similarMovies = array();

        foreach ($obj->results as $movie) {
            if ($movie->vote_average >= 7) {
                $id = $movie->id;
                $title = $movie->title;
                $poster = $movie->poster_path;
                $genre = $movie->genre_ids;
                $rate = $movie->vote_average;
                $overview = $movie->overview;
                
                $r = new ModelMovie($id, $title, $rate, null, $genre, null, null, $overview, $poster, null);
                array_push($similarMovies, $r);
            }
        }
        return $similarMovies;
    }

    public static function setUpcomingMoviesInDB()
    {
        $movies = ModelMovie::getUpcomingMovies();

        if (count(ModelMovie::nbUpcomingMoviesInDB()) > 0) {
            $deleteAll = 'DELETE FROM upcomingmovies';
            $result = Model::$pdo->query($deleteAll);
        }

        foreach ($movies as $movie) {
            $stmt = Model::$pdo->prepare('INSERT INTO upcomingmovies (id, title, rating, genre, shortDescription, poster) VALUES (:id, :title, :r, :g, :sd, :p)');

            $stmt->bindParam(':id', $movie->id);
            $stmt->bindParam(':title', $movie->title);
            $stmt->bindParam(':r', $movie->rating);
            $strGenre = implode(',', $movie->genre);
            $stmt->bindParam(':g', $strGenre);
            $stmt->bindParam(':p', $movie->poster);
            $stmt->bindParam(':sd', $movie->shortDescription);
            
            $t = $stmt->execute();
        }
    }

    public static function setPopularMoviesInDB()
    {
        $movies = ModelMovie::getPopularMovies();

        if (count(ModelMovie::nbPopularMoviesInDB()) > 0) {
            $deleteAll = 'DELETE FROM popularmovies';
            $result = Model::$pdo->query($deleteAll);
        }

        foreach ($movies as $movie) {
            $stmt = Model::$pdo->prepare('INSERT INTO popularmovies (id, title, rating, genre, shortDescription, poster) VALUES (:id, :title, :r, :g, :sd, :p)');

            $stmt->bindParam(':id', $movie->id);
            $stmt->bindParam(':title', $movie->title);
            $stmt->bindParam(':r', $movie->rating);
            $strGenre = implode(',', $movie->genre);
            $stmt->bindParam(':g', $strGenre);
            $stmt->bindParam(':p', $movie->poster);
            $stmt->bindParam(':sd', $movie->shortDescription);
            
            $t = $stmt->execute();
        }
    }

    public static function nbUpcomingMoviesInDB()
    {
        $requete = "SELECT * FROM upcomingmovies";
        $result = Model::$pdo->query($requete);

        $result->setFetchMode(PDO::FETCH_CLASS, 'ModelMovie');
        $tab_voit = $result->fetchAll();
        return $tab_voit;
    }

    public static function nbPopularMoviesInDB()
    {
        $requete = "SELECT * FROM popularmovies";
        $result = Model::$pdo->query($requete);

        $result->setFetchMode(PDO::FETCH_CLASS, 'ModelMovie');
        $tab_voit = $result->fetchAll();
        return $tab_voit;
    }

    public static function getUpcomingMovies()
    {
        $url = "https://api.themoviedb.org/3/movie/upcoming?api_key=" . Conf::$API_KEY . "&language=fr";
        $json = file_get_contents($url);
        $obj = json_decode($json);

        $movies = array();
        foreach ($obj->results as $movie) {

            $id = $movie->id;
            $title = $movie->title;
            $poster = $movie->poster_path;
            $genre = $movie->genre_ids;
            $rate = $movie->vote_average;
            $desc = $movie->overview;
            $r = new ModelMovie($id, $title, $rate, null, $genre, null, null, $desc, $poster, null);
            array_push($movies, $r);
        }
        return $movies;
    }

    public static function getPopularMovies()
    {
        $url = "https://api.themoviedb.org/3/movie/popular?api_key=" . Conf::$API_KEY . "&language=fr";
        $json = file_get_contents($url);
        $obj = json_decode($json);

        $movies = array();
        foreach ($obj->results as $movie) {
            $id = $movie->id;
            $title = $movie->title;
            $poster = $movie->poster_path;
            $genre = $movie->genre_ids;
            $rate = $movie->vote_average;
            $desc = $movie->overview;
            $r = new ModelMovie($id, $title, $rate, null, $genre, null, null, $desc, $poster, null);
            array_push($movies, $r);
        }
        return $movies;
    }
}
?>

