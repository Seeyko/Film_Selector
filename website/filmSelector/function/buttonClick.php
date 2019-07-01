<?php
require ('/home/tomandrikd/www/Site_Film/lib/File.php');

require ('/home/tomandrikd/www/Site_Film/model/Model.php');
require ('/home/tomandrikd/www/Site_Film/model/ModelMovie.php');
require ('/home/tomandrikd/www/Site_Film/model/ModelPerson.php');

require ('/home/tomandrikd/www/Site_Film/model/ModelUser.php');

$action = $_POST['action'];
$u_id = $_POST['u_id'];
$m_id = $_POST['m_id'];

unset($_POST['action']);
unset($_POST['m_id']);
unset($_POST['u_id']);

$movie = ModelMovie::getMovieFull($m_id);
echo("<script>console.log($m_id salut salut);</script>");
switch ($action) {
    case 'addFav':
        ModelUser::addFilmToFavorite($u_id, $movie);
        break;
        
    case 'removeFav':
        ModelUser::removeFilmFromFavorite($u_id, $m_id);
        break;
    case 'addSeen':
        ModelUser::addFilmToSeen($u_id, $movie);
        break;
    case 'removeSeen':
        ModelUser::removeFilmFromSeen($u_id, $m_id);
        break;
    case 'addToSee':
        ModelUser::addFilmToToSee($u_id, $movie);
        break;
    case 'removeToSee':
        ModelUser::removeFilmFromToSee($u_id, $m_id);
        break;
}

?>