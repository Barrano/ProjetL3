 <?php
    require "conexion.php";
    $rechErr="";
?>
<!DOCTYPE html>

<html>
<head>
<meta charset="UTF-8"/>
<link rel="stylesheet" href="css/acceuil.css" type="text/css" />

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<title>Accueil</title>
    <style>
      .ranger
        {
            padding-top: 30px;
        }
       nav
        {
            float: right;
            width: 400px;
            margin-top:-300px;
            border: 0px solid black;

        }

        section
        {
            margin-left: 170px;
            border: 1px solid blue;
        }
         body
            {
               background: url("images/imageRcran/imageMontpellier.jpg")  repeat center; 
            }
    
    </style>

</head>
<body>
    <?php  include "header.php";?>
    <form action="accueil.php" method="post" style="margin-left:530px;">
    <select name="nom">
        <option>Selectionner</option>
        <option>restaurant</option>
        <option>boite</option>
        <option>plage</option>
        <option>autre</option>
        
    </select>
    <input type="submit" value="Rechercher">
    <p><?php echo $rechErr; ?></p>
    
</form>
    <div class="button" style="margin-:530px;">
<!--<div class="right">
<ul id="niv1">

<li><a href="inscription/inscription.html" >Inscription</a></li>
<li><a href="" >Login</a></li>
</ul>

</div>-->
<p class="p3">Horizon! ensemble, partageons <?php echo ' <br>';?> nos meilleures expériences</p>
<p class="p4">Vous proposez ou vous <br>cherchez des activités,<br> &eacutev&eacutenements ou sports &agrave<br> Montpellier? <br> Horizon est fait pour vous!!</p>

</div>
<div class="ranger">
<div class="col-sm-6">



    



<!--<div id="menu">
<ul>
<li><a href="x" >Sport</a>
<ul>
<li><a href="x" >Art martiaux</a></li>
<li><a href="x" >Foot</a></li>
<li><a href="x" >Cyclisme</a></li>
</ul>
</ul>

<ul>
<li><a href="x" >Ev&eacutenement</a>
<ul>
<li><a href="x" >Rondonn&eacutee</a>
<li><a href="x" >Sorties animeaux </a></li>
<li><a href="x" >Trouve ta moiti&eacute</a></li>
<ul>

</li>
</ul>
</div>-->
<div style="margin-left:40px; height:80px;">

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img class="p5" src="images/slider4.jpg" alt="...">
      <div class="carousel-caption">
       <p class="p6">Vous cherchez du sport</p>
      </div>
    </div>
    <div class="item">
      <img class="p5" src="images/slider3.jpg" alt="...">
      <div class="carousel-caption">
        <p class="p6">Vous cherchez des conseils</p>
      </div>
    </div>
    <div class="item">
      <img class="p5" src="images/slider2.jpg" alt="...">
      <div class="carousel-caption">
        <p class="p6">Vous cherchez des &eacutev&eacutenements</p>
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    </div>
</div>


  
   
   
 

</div>
    <nav >
        
     <?php
       echo '<div style="overflow: auto;
                 height:130px;">';
        if(!empty($_POST))
        {
            $rech=$_POST['nom'];
          
            if(empty($rech))
            {
                $rechErr="aucun resultat de votre recherche";
            }else
                
            {               echo '<table border="3" cellspacing="20" width="395" style="text-align:center;">';
                            echo '<tr>';
                            echo '<th width="50" style="text-align:center;" >Type recherché</th>';
                             echo '<th width="50" style="text-align:center;" >Nom </th>';
                            echo '<th style="padding-right:10px;text-align:center;">Description </th>';
                             echo '<th style="text-align:center;">Action</th>';
                            echo '</tr>';
             
                            $db=database::connect();
                           $resultat=$db->query('select type_acti,description_acti,nom_acti
                                                from activite
                                                where   type_acti="'.$rech.'" ');
                           while($item=$resultat->fetch())
                           {
                               echo '<tr>';
                               echo '<td>'.$item['type_acti'].'</td>';
                             echo '<td>'.$item['nom_acti'].'</td>';
                               echo '<td>'.$item['description_acti'].'</td>';
                               echo '<td><a href="login.php">Ouvrir</a></td>';
                               echo '</tr>';
                           }echo '</table>';
                
            }
                          
                               
                              
        }
    echo '</div>';
    ?>
            
        <br>
        <video src="videos/video.mp4" controls width="395"/>
        </nav>
    
</body>
</html>