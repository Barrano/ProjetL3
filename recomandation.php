<?php  include "header.php";?>



<?php
require "conexion.php";
 if (isset($_SESSION['client']))
        {
            $uticone=$_SESSION['client'][2];
            
        }

$db=database::connect();
$res=$db->query("select plage_n, boite_n, restaurant_n from utilisateur where id_uti='".$uticone."' ");
$ligne=$res->fetch();
    $boite=$ligne['boite_n'];
    $plage=$ligne['plage_n'];
     $resto=$ligne['restaurant_n'];

/*
      if($boite>=$plage && $boite>=$resto)
          echo'boite';
        else if($boite<=$plage && $plage>=$resto)
            echo 'plage';
            else
                echo'rest';*/
          

database::disconnect();

?>

<html>
    <head>
        <title>recommandation</title>
        
             
     </head>
        <body>
            <p style="text-align:center;"><label style="text-transform:uppercase;background:white;">Suggestion gerant</label>&nbsp;&nbsp;&nbsp;<a href="recomandationPart.php"style="font-sige:10px;;" target="header">Suggestion participant</a></p>
            <div style=" overflow: auto;
                 height: 390px;width: auto;margin-left:10px;">
                 <?php
        if($boite>=$plage && $boite>=$resto)
        {
            echo '<marquee style="margin-left:500px;margin-right:500px;">on vous suggere des boites</marquee>';
        }elseif($boite<=$plage && $plage>=$resto)
        {
            echo '<marquee style="margin-left:500px;margin-right:500px;">on vous suggere des plages</marquee>';
        }else
        {
            echo '<marquee style="margin-left:500px;margin-right:500px;">on vous suggere des restaurants</marquee>';
        }
            
        
        
        ?>
            <?php
                 if($boite>=$plage && $boite>=$resto)
                 { 
               ?>
                 <div id="boiteNuit" class="">  
                      
                       
                            
                                           <style>
            body
            {
               background: url("images/imageRcran/imageMontpellier.jpg")  repeat center; 
            }
            th
            {
                color: blue;
                font-size: 20px;
            }
            td
            {
                color:#000;
                font-size: 15px;
                padding-right: 20px;
                 border: 1px solid;
            }
            .formulairetableboite
            {

                height: auto;
                width: 850px;
                margin-left: 250px;/* ce la nous a permis de deplacer notre div de gauche vers la droite de 400px*/
                border-radius: 5px;
                border-radius: 5px;
                border: 1px solid #0200F1;
                color: blue;
                 background-color: aliceblue;
                border-radius: 10px;
                font-size: 20px;
                margin-top: 40px;
            }
            .bouton_liste
            {
                
              margin-left: -250px;
            }
            .activite
            {
                margin-left: 250px;
            }
            .boitee
            {
                margin-left: 155px;
            }
        </style>
                         <table class="formulairetableboite">
                               <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>adresse</th>
                                       
                                        <th>choisir</th>
                                    </tr>
                               </thead>
                             <form action="verifiboite.php" methode="GET">
                               <?php
                                   
                                   $db=database::connect();
                                   $res=$db->query("select * from boite_nuit ");
                                   while($ligne=$res->fetch())
                                   {
                                        echo "<tbody>";
                                        echo "<tr>";
                                        echo "<td>".$ligne['nom_boite']."</td>";
                                        echo "<td>".$ligne['adresse_boite']."</td>";
                                        echo '<td><a href="verifiboite.php? id_boite='.$ligne['id_boite'].'">choisir</a></td>';
                                        echo "</tr>";
                                        echo "</tbody>";   
                                   }
                                   database::disconnect();
                                ?>
                                
                            </form>
                         </table>
                     
                    </div>
                     
                <?php
                 }
                
                elseif($boite<=$plage && $plage>=$resto) 
                {
            ?>
                <div id="plage" class="">
                        <bouton class="bouton_liste"> liste des <strong>Plages</strong> suggeres:</bouton>
                    <style>
            body
            {
               background: url("images/imageRcran/imageMontpellier.jpg")  repeat center; 
            }
            th
            {
                color: blue;
                font-size: 20px;
            }
            td
            {
                color:#000;
                font-size: 15px;
                padding-right: 20px;
                 border: 1px solid;
            }
            .formulairetableplage
            {

                height: auto;
                width: 850px;
                margin-left: 250px;/* ce la nous a permis de deplacer notre div de gauche vers la droite de 400px*/
                border-radius: 5px;
                border-radius: 5px;
                border: 1px solid #0200F1;
                color: blue;
                 background-color: aliceblue;
                border-radius: 10px;
                font-size: 20px;
                margin-top: 40px;
            }
            .bouton_liste
            {
                
              margin-left: -250px;
            }
            .activite
            {
                margin-left: 250px;
            }
            .boitee
            {
                margin-left: 155px;
            }
        </style>
                           <table class="formulairetableplage">
                                   <thead>
                                       <tr>
                                        <th>Nom</th>
                                        <th>Adresse</th>
                                        <th>Actions</th>
                                       </tr>
                                   </thead>
                                <form action="verifiPlage.php" methode="GET">    
                               <?php
                                   
                                   $db=database::connect();
                                   $res=$db->query("select * from plage ");
                                   while($ligne=$res->fetch())
                                   {
                                        echo "<tbody>";
                                        echo "<tr>";
                                        echo "<td>".$ligne['nom_plage']."</td>";
                                        echo "<td>".$ligne['description_plage']."</td>";
                                        echo '<td><a href="verifiPlage.php? id_plage='.$ligne['id_plage'].'">choisir</a></td>';
                                        echo "</tr>";
                                        echo "</tbody>";   
                                   }
                                   database::disconnect();
                                ?>
                                
                               </form>
                                     
                            </table>
                    </div>
            <?php
            }
                else
                {
            ?>
            
             <div id="resto" class="">
                        <bouton class="bouton_liste"> liste des <strong>Restaurants</strong> suggeres:</bouton>
            <style>
            body
            {
               background: url("images/imageRcran/imageMontpellier.jpg")  repeat center; 
            }
            th
            {
                color: blue;
                font-size: 20px;
            }
            td
            {
                color:#000;
                font-size: 15px;
                padding-right: 20px;
                 border: 1px solid;
            }
            .formulairetableresto
            {

                height: auto;
                width: 850px;
                margin-left: 250px;/* ce la nous a permis de deplacer notre div de gauche vers la droite de 400px*/
                border-radius: 5px;
                border-radius: 5px;
                border: 1px solid #0200F1;
                color: blue;
                 background-color: aliceblue;
                border-radius: 10px;
                font-size: 20px;
                margin-top: 40px;
            }
            .bouton_liste
            {
                
              margin-left: -250px;
            }
            .activite
            {
                margin-left: 250px;
            }
            .boitee
            {
                margin-left: 155px;
            }
        </style>
                           <table class="formulairetableresto" >
                                   <thead>
                                       <tr>
                                        <th>Nom</th>
                                        <th>adresse</th>
                                        <th>T.restaurant</th>
                                        <th> T.cuisine</th>
                                           <th>choisir</th>
                                       </tr>
                                   </thead>
                               
                                   <form action="verifiResto.php" methode="GET">
                                 <?php
                     
                                       $db=database::connect();
                                       $res=$db->query("select * from restauration ");
                                       while($ligne=$res->fetch())
                                       {
                                            echo "<tbody>";
                                            echo "<tr>";
                                            echo "<td>".$ligne['nom_restaurant']."</td>";
                                            echo "<td>".$ligne['adresse_restaurant']."</td>";
                                            echo "<td>".$ligne['type_restaurant']."</td>";
                                            echo "<td>".$ligne['type_cuisine']."</td>";
                                            echo '<td><a href="verifiResto.php? id_resto='.$ligne['id_restaurant'].'">choisir</a></td>';
                                            echo "</tr>";
                                            echo "</tbody>";   
                                       }
                                       database::disconnect(); 
                                   ?>
                               </form>
                            </table>
                    </div>
            
            <?php
                    
                }
                
            ?>
                </div>
    
    </body>
    
   


</html>