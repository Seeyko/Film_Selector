<?php
echo("<strong>Liste des acteurs avec <u>$n</u> dans leur nom (trier par populariter)</strong><br><br>");

echo('<div class="caroussel">');
foreach ($persons as $name){
    if($name->poster){
        echo ("<div><a  href='" . $name->getShortCut() . "'><img class='imgCaroussel' src='http://image.tmdb.org/t/p/w500$name->poster'></a></div>");
        /*echo('<div class="caroussel_personMovies asnavForClass">');
        foreach ($name as $movie){
            echo('<div>');
            if($movie->rating){
                echo ("<div><a  href='" . $movie->getShortCut() . "'><img src='http://image.tmdb.org/t/p/w500$movie->rating'></a></div>");
            }
            echo('</div>');
        }
        echo("</div>");*/
    }
}
echo("</div>");

?>