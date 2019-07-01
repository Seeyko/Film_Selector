<div class="listFolders">
	<?php 
	   $files = scandir("./Projets");
	   
	   for($i = 2; $i < sizeof($files);$i++){
	       if (!pathinfo($files[$i], PATHINFO_EXTENSION)){
	           echo("<div class='folders'><a href='./index.php?controller=projets&action=files&name=$files[$i]'>$files[$i]</a></div>");   
	       }else{
	           echo("<div class='folders'><a href='./Projets/$files[$i]'>$files[$i]</a></div>");
	           
	       }
	   }
	   
	?>
</div>