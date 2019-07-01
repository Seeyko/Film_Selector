<?php
foreach ($tab_v as $v){
    $login = htmlspecialchars($v->get('login'));
    $loginURL = rawurlencode($v->get('login'));

    echo "<p> Utilisateur  " . $login ;
    echo ' | <a href="./index.php?controller=utilisateur&action=read&login=' . $loginURL .'"> Details</a>';
    echo "</p>";
}
?>