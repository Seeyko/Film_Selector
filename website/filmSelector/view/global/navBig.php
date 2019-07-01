
<nav id="navBig">
	<img class="menuItem" id="accueil"
		onclick="location.href='./index.php'" src='./assets/logo/accueil.png' />

	<div
		onclick="location.href='./index.php?action=search&controller=movie'"
		class="menuItem formButton">Recherche de film</div>
	<div
		onclick="location.href='./index.php?action=search&controller=person'"
		class="menuitem formButton">Recherche d'acteur</div>
		<?php
if (! isset($_SESSION['nom'])) {
    ?>
	<div class="menuItem inscription "
		onclick="document.getElementById('id01').style.display='block'">Inscription</div>
	<div id="id01" class="modal">
		<span onclick="document.getElementById('id01').style.display='none'"
			class="close" title="Close Modal">&times;</span>
		<form method="post" class="modal-content"
			action="./index.php?controller=user&action=created">
			<div class="container">
				<h1>Inscription</h1>
				<p>Remplissez ce formulaire pour vous creer un compte</p>
				<hr>
				<label for="mail"><b>Email</b></label> <input type="text"
					placeholder="Votre email" name="mail" required /> <label
					for="password"><b>Mot de passe</b></label> <input type="password"
					placeholder="Votre mot de passe" name="password" required /> <label
					for="nom"><b>Nom</b></label> <input type="text"
					placeholder="Votre nom" name="nom" required /> <label for="prenom"><b>Prenom</b></label>
				<input type="text" placeholder="Votre prenom" name="prenom" required />

				<p>
					En creeant un compte vous acceptez notre<a href=#
						style="color: dodgerblue">Politique de confidentialite</a>.
				</p>

				<div class="clearfix">
					<button type="button"
						onclick="document.getElementById('id01').style.display='none'"
						class="cancelbtn">Annuler</button>
					<button type="submit" class="signupbtn formButton">M'inscrire</button>
				</div>
			</div>
		</form>
	</div>
	<div class="menuItem inscription"
		onclick="document.getElementById('id02').style.display='block'">Connexion</div>
	<div id="id02" class="modal">
		<span onclick="document.getElementById('id02').style.display='none'"
			class="close" title="Close Modal">&times;</span>
		<form method="post" class="modal-content"
			action="./index.php?controller=user&action=connected">
			<div class="container">
				<h1>Connexion</h1>
				<p>Remplissez ce formulaire pour vous connectez</p>
				<hr>
				<label for="mail"><b>Email</b></label> <input type="text"
					placeholder="Votre email" name="mail" required /> <label
					for="password"><b>Mot de passe</b></label> <input type="password"
					placeholder="Votre mot de passe" name="password" required />

				<div class="clearfix">
					<button type="button"
						onclick="document.getElementById('id02').style.display='none'"
						class="cancelbtn">Annuler</button>
					<button type="submit" class="signupbtn formButton">Connexion</button>
				</div>
			</div>
		</form>
	</div>
	
	<?php 
}
if (isset($_SESSION['nom'])) {
    ?>
    <div
		onclick="location.href='./index.php?action=deconnect&controller=user'"
		class='menuitem inscription'>Deconnexion</div>
	<div onclick="location.href='./index.php?action=read&controller=user'"
		class="menuItem inscription">Compte</div>
		        <?php 
}
?>
	</nav>