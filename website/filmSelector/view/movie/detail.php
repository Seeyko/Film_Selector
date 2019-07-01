<?php 
$movieSelected = $movie;
require File::build_path(array('view', 'movie', 'buttons.php'));

echo("<br><img src='http://image.tmdb.org/t/p/w185/$movie->poster' width='199' height='300' border='0'/><br>");

echo("<b>$movie->title</b><br><br>");
echo("<u>Description: </u>$movie->shortDescription<br><br>");
echo("note : $movie->rating produit par : $movie->director<br>");
echo("Sortie le $movie->released, duree du film : $movie->runtime minutes<br><br>Acteurs :<br><br>");

echo('<div class="carousselBig">');
foreach ($movie->actors as $person){
    if ($person->poster) {
        $id = $person->id;
        echo("<div id='" . $id ."' class='imgCaroussel'>");   
        echo("<div class='imgForm' id='button". $id. "'>");
        if ($person->name) {
            echo ("<button class='desc'>$person->name</button>");
        }
        echo("</div>");
        echo ("<a  href='" . $person->getShortCut() . "'><img src='http://image.tmdb.org/t/p/w500$person->poster'></a>"); 
        echo("</div>");
        
    }else{
        echo("<div class='slide-heading' style='position:absolute;' href='" . $person->afficherNameSC() . "'></div>");       
    }
}
echo("</div></div>");

require(File::build_path(array('view', 'movie', 'recommended.php')));

?>
<a  href="./index.php?action=create&controller=commentaire&id=<?php echo($movieSelected->id);?>&title=<?php echo(urlencode($movieSelected->title));?>">
<button class="buttonAdd">Ajouter un commentaire</button>
 </a>
<?php 

require(File::build_path(array('view', 'commentaire', 'listCommentaireForMovie.php')));
?>