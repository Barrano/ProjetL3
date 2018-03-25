<?php 
session_start();

if (isset($_SESSION['client']))
{	   
    echo "<link rel='stylesheet' href='css/menuConecte.css'>";
    echo"<p><div class='menuColor'> <img src='images/imageRcran/logo.PNG' alt='' width='200' height='100' class='logo'>";
    
    echo"<ul><li><a href='groupe.php' target='body'>Mes Groupes</a></li>";
    
   
    echo"<li><a href='menuConecte/information.php' >Mes informations</a></li>";
    echo"<li><a href='menuConecte/activite.php' target='body'>les activites</a></li>";
    echo"<li><a href='menuConecte/propose.php' target='left'>Proposer une activite</a></li>";
     echo"<li><a href='menuConecte/CreerGroup.php' target='body'>Creer un groupe</a></li>";
     echo"<li><a href='menuConecte/recherche.php' target='body'>Recherchez</a></li>";
     echo"<li><a href='deconexion.php' target='body' style='background:none;'><img src='images/imageRcran/deconexion.png'  title='Deconnexion' alt='' width='40' height='45'></a></li>";
    echo '<li><div class="login"><img src="images/'.$_SESSION['client'][6].'"alt="" width="40" height="45"></div></li>
    </ul></div></p>';		
}else
     echo '<meta http-equiv="Refresh" content="0;url=login.php?">';


?>



