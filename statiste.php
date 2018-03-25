

<html>
	<head>
		<title>statistique</title>
		<link rel="stylesheet" href="styles/style.css" type="text/css" /> 
        <style>
        body{
                background-image:url("../chartjs/images/acti.jpg");
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            
                }
        </style>
		</head>
		
	<body>
        <?php 
        session_start();
        echo "<link rel='stylesheet' href='../css/menuConecte.css'>";
     
    echo"<p><div class='menuColor'> <img src='../images/imageRcran/logo.PNG' alt='' width='200' height='100' class='logo'>";
    
    //echo"<ul><li style='color:white; text-shadow: 5px 5px 2px red, 0 0 1em blue, 0 0 0.2em blue; font-size:35px;'>BIENVENUE SUR MONTPELLIER HORIZON</li>";
    
   
    //echo"<li style='padding-left:10px;'><a href='menuConecte/propose.php' target='left'><img src='images/imagesIcone/activite.jpg'  title='Toutes Les Activites' alt='' width='130' height='45'></a></li>";
    
    
     echo"<li><a href='../autreActivite.php'>Autre activite</a></li>";
     echo"<li><a href='../sugereActivite.php'>activite montpellier</a></li>";
     echo"<li><a href='../lesAactivite.php' target='header'>Les activites</a></li>";
     echo"<li><a href='../recomandation.php' target='header'>activite recomandee</a></li>";
     echo"<li><a href='../mesActivite.php' target='header'>mes activites</a></li>";
    //Nous avons choisi de ne ^pas mettre les groupes car ils sont compris dans les activités
    echo"<li><a href='../profil.php' target='header'>mon profil</a></li>";
    // echo"<li ><a href='deconexion.php' target='body' ><img src='images/imageRcran/deconexion.png'  title='Deconnexion' alt='' width='40' height='45'></a></li>";
    echo"<li ><a href='../deconexion.php' target='body' >deconnexion</a></li>";
    echo '<li><div class="login"><img src="../images/'.$_SESSION['client'][6].'"alt="" width="40" height="50" style="margin-top:-10px;"></div></li>
    </ul></div></p>';		
     
        ?>
    

	 
			 
			   		<div id="chart-container">
			<canvas id="mycanvas"></canvas>
		</div>
		
<div  class="ht">
		<!-- javascript -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/Chart.min.js"></script>
		<script type="text/javascript" src="js/appstate.js"></script>
       
		<script type="text/javascript" src="js/appstate.js"></script>
   
    </div>
    
    
	</body>
</html>