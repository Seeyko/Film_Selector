<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $pagetitle; ?></title>
<link rel="stylesheet" type="text/css" href="./theme.css">
<link rel="stylesheet" type="text/css" href="slick/slick.css" />
<link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />



<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript"
	src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript"
	src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>
</head>
<header>
	<?php require (File::build_path(array('view', 'global', 'nav.php')))?>
</header>
<body>
		<?php
$moviesInPage = array();
// Si $controleur='voiture' et $view='list',
// alors $filepath="/chemin_du_site/view/voiture/list.php"
$filepath = File::build_path(array(
    "view",
    $controller,
    "$view.php"
));
require $filepath;

?>
<script>
var modal = document.getElementById('id01');
var modal2 = document.getElementById('id02');


window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}


function addMovie(action, user_id, movie_id){
	var text = "";
	if(action == 'addFav'){
		text = "Enlever de mes favoris";
		<?php $fav = !$fav;?>
	}
	else if(action == 'removeFav'){
		text = "Ajouter a mes favoris";
		<?php $fav = !$fav;?>
		
	}
	else if(action == 'addSeen'){
		text = "Enlever de mes vu";
		<?php $seen = !$seen;?>
	}
	else if(action == 'removeSeen'){
		text = "Ajouter a mes vu";
		<?php $seen = !$seen;?>		
	}
	else if(action == 'addToSee'){
		text = "Enlever de mes a voir";
		
		<?php $toSee = !$toSee;?>
	}

	else if(action == 'removeToSee'){
		text = "Ajouter a mes a voir";
		<?php $toSee = !$toSee;?>
	}
	else{
		alert('error no : ' + action);
	}

	$.ajax({
        type: "POST",
        url: './function/buttonClick.php',
        data:{action:action, u_id:user_id, m_id:movie_id},
        success:function(html){

        	var btns = document.getElementsByName(action + movie_id);
			var oldaction = action;
			if(action.includes('add')){
				action = action.replace('add', 'remove');
			}else if(action.includes('remove')){
				action = action.replace('remove', 'add');
			}else {
				alert(' error in : ' + action);
			}
			if(btns == null){
				btns = document.getElementsByName(oldaction + movie_id);			
			}

			for(let i = 0; i < btns.length; i++){
				let btn = btns[i];
	        	console.log(btn.getAttribute('onclick').replace(oldaction, action));
				btn.setAttribute('onclick', btn.getAttribute('onclick').replace(oldaction, action));
				btn.setAttribute('name', btn.getAttribute('name').replace(oldaction, action));
				
	        	btn.innerHTML = text;
			}
			
        },
        error:function(html) {
          alert("Erreur veuillez contactez l'admin : \n hello@tomandrieu.com\nAvec les infos suivantes :\n" + html);
        },
   });
	   
}

$(document).ready(function(){
	
	$('.caroussel').slick({
		infinite : true,
		slidesToShow: 5,
		slidesToScroll: 1,		
	    //asNavFor: '.asnavForClass',
		centerMode: true,
		centerPadding: '60px',
		variableWidth: true,
		adaptiveHeight: true,
		dots: true,
		
	})
	$('.carousselBig').slick({
		infinite : true,
		slidesToShow: 5,
		slidesToScroll: 3,		
		variableWidth: true,
		adaptiveHeight: true,
		dots: true,
	})
	$('.carousselBigCompte').slick({
		infinite : true,
		slidesToShow: 5,
		slidesToScroll: 3,		
		variableWidth: true,
		adaptiveHeight: true,
		dots: true,
	})
	
	$('.carousselNoDots').
	slick({
		infinite : true,
		slidesToShow: 5,
		slidesToScroll: 3,		
		variableWidth: true,
		adaptiveHeight: true,
		dots: false,
	})
	
});
</script>
</body>


<footer>
	
	<div class="menuItem">Film Selector by Andrieu Tom - Concept by Yoan Favier</div>
	
</footer>
</html>

