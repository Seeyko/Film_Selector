<?php
// Button fav
$fav = ModelUser::alreadyFavorite($_SESSION['id'], $movie->id);

if (isset($_SESSION['nom'])) {
    if (! $fav) {       
        ?>
<button class="buttonAdd" name='addFav<?php echo($movie->id)?>' onclick="addMovie('addFav', <?php echo($_SESSION['id'])?>, <?php echo($movie->id)?>)" > Ajouter a mes favoris</button>

<?php
    } else { 
        ?>

<button class="buttonAdd" name='removeFav<?php echo($movie->id)?>' onclick="addMovie('removeFav', <?php echo($_SESSION['id'])?>, <?php echo($movie->id)?>)" > Enlever de mes favoris</button>

<?php
    }
}
?>


<?php
// Button deja vu

$seen = ModelUser::alreadySeen($_SESSION['id'], $movie->id);

if (isset($_SESSION['nom'])) {
    if (! $seen) {
        ?>
<button class="buttonAdd" name='addSeen<?php echo($movie->id)?>' onclick="addMovie('addSeen', <?php echo($_SESSION['id'])?>, <?php echo($movie->id)?>)" > Ajouter a mes vu </button>

<?php
    } else {
        ?>
<button class="buttonAdd" name='removeSeen<?php echo($movie->id)?>' onclick="addMovie('removeSeen', <?php echo($_SESSION['id'])?>, <?php echo($movie->id)?>)" > Enlever de mes vu </button>

<?php
    }
}
?>


<?php
// Button deja vu
$toSee = ModelUser::alreadyToSee($_SESSION['id'], $movie->id);

if (isset($_SESSION['nom'])) {
    if (! $toSee) {
        ?>
<button class="buttonAdd" name='addToSee<?php echo($movie->id)?>' onclick="addMovie('addToSee', <?php echo($_SESSION['id'])?>, <?php echo($movie->id)?>)" > Ajouter a mes a voir </button>

<?php
    } else {
        ?>
<button class="buttonAdd" name='removeToSee<?php echo($movie->id)?>' onclick="addMovie('removeToSee', <?php echo($_SESSION['id'])?>, <?php echo($movie->id)?>)"> Enlever de mes a voir </button>


<?php
    }
}
?>