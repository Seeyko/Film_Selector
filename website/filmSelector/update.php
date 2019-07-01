<?php
echo("start Require<br>");
require('/home/tomandrikd/www/Site_Film/lib/File.php');

require('/home/tomandrikd/www/Site_Film/model/Model.php');
require('/home/tomandrikd/www/Site_Film/model/ModelMovie.php');
echo("Ok Require<br>");
echo("start setupcoming<br>");

ModelMovie::setUpcomingMoviesInDB();
echo("Ok Upconming<br>");

ModelMovie::setPopularMoviesInDB();
echo("Ok Popular<br>");

echo("<br>done");
?>