<form method="post" action="./index.php?controller=commentaire&action=created&id=<?php echo($_GET['id']);?>">
  <fieldset>
    <legend>Ecrire un commentaire pour le film <?php echo(urldecode($_GET['title']))?> :</legend>
    <p>    
      <label for="msg">Votre Commentaire</label> :
      <textarea id="msg" name="msg"></textarea>   
   </p>
    <p>
      <input type="submit" value="Envoyer" />
    </p>
  </fieldset> 
</form>
