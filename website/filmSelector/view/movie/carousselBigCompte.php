<?php
echo ('<div class="carousselBigCompte" id="' . $carrousselID .'">');
foreach ($movies as $movie) {
    $id = $movie->id;

    if ($movie->poster){
        
        
        echo ("<div id='" . $id . "' class='imgCaroussel'>");
        
        echo ("<img src='https://image.tmdb.org/t/p/w500$movie->poster'>");
        echo ("<div class='imgForm' id='button" . $id . "'>");
        if (isset($_SESSION['id'])) {
            require File::build_path(array(
                'view',
                'movie',
                'buttons.php'
            ));
        }
        if ($movie->title) {
            echo ("<button class='desc noClickable'>$movie->title</button>");
        }
        if ($movie->rating) {
            echo ("<button class='desc noClickable'>Note : $movie->rating</button>");
        }
        if ($movie->shortDescription) {
            echo ("<button class='desc noClickable'>Description : $movie->shortDescription</button>");
        }
        echo ("<a  href='" . $movie->getShortCut() . "'><button class='desc'>En savoir plus</button></a>");
        
        echo ("</div>");
        
        echo ("</div>");
    } else {
        echo ("<div class='slide-heading' style='position:absolute;' href='" . $movie->afficherTitleSC() . "'></div>");
    }
}
echo ("</div>");
?>