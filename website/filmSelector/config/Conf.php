<?php

class Conf
{
    
    public static $API_KEY = "YOUR TMDB API KEY";

    // La variable debug est un boolean
    private static $debug = true;

    static public function getDebug()
    {
        return self::$debug;
    }

    private static $databases = array(
        'hostname' => '****',
        'database' => '********',
        'login' => '*******',
        'password' => '*******'
    );

    static public function getLogin()
    {
        // en PHP l'indice d'un tableau n'est pas forcement un chiffre.
        return self::$databases['login'];
    }

    static public function getHostname()
    {
        return self::$databases['hostname'];
    }

    static public function getDatabase()
    {
        return self::$databases['database'];
    }

    static public function getPassword()
    {
        return self::$databases['password'];
    }
}
?>

