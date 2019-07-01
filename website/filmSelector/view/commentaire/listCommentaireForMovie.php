<?php 
$tab_coms = ModelCommentaire::getAllCommentaireForMovie($_GET['id']);
if(isset($tab_coms) && !is_null($tab_coms) && !empty($tab_coms)){
    echo("<br>Commentaire pour ce film :<br>");
    foreach ($tab_coms as $com){
        $user = ModelUser::getUserById($com->user_id);
        echo($com->com . " By ");
        echo("<a href='./index.php?controller=user&action=findFriend&id=$com->user_id'>$user->nom $user->prenom</a><br>");
    }
}
?>