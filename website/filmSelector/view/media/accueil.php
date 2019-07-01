<div class="listFolders">
	<?php 
	   $files = scandir("./Medias");
	   
	   for($i = 2; $i < sizeof($files);$i++){
	       echo("<div class='folders'><a href='https://tomandrieu.com/Medias/$files[$i]'>$files[$i]</a></div>");    
	   }
	   
	?>
</div>