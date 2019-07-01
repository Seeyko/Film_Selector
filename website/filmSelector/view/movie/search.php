<form method="post" action="./index.php?controller=movie&action=searched">
  <fieldset>
    <legend>Recherche de film :</legend>
    <p>
      
      <label for="title">Titre du film</label> :
      <input type="search" placeholder="Ex : Prisoners" name="title" id="title" required/>
    </p>
    <p>
      <input type="submit" value="Envoyer" />
    </p>
  </fieldset> 
</form>
