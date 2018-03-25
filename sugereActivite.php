<?php  include "header.php";?>
<?php
require "conexion.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Montpellier Horizon</title>
        <link rel="stylesheet" href="css/opose.css" >
        
        
        <script src="script/jquery-3.3.1.min.js"></script>
        <script src="script/proposeActivite.js"></script>
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
            .formulaire
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
        
    </head>
    <body>
        <div class="formulaire">
             <div  class="inscription">
                
            <div class="typechoisi">
                    <div class="activite"> 
                       <ul>
                           <li class="type"><label class="menu"  id="radi_boite">Boite:</label></li>
                           <li class="type" ><label class="menu" id="radi_plage">Plage:</label> </li>
                           <li class="type"  ><label class="menu" id="restorant">Restaurant:</label></li>
                          <!-- <li class="type" ><label class="menu" id="sporte">Sport:</label></li> -->
                           <br>
                        </ul>
                    </div>
                    <div id="boiteNuit" class="menu_activite">  
                        <div class="boitee">
                        <bouton class="bouton_liste"> liste des <strong>Boites</strong> suggeres:</bouton>
                         <table>
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
                    </div>
                    <div id="plage" class="menu_activite">
                        <bouton class="bouton_liste"> liste des <strong>Plages</strong> suggeres:</bouton>
                           <table>
                                   <thead>
                                       <tr>
                                        <th>Nom</th>
                                        <th>adresse</th>
                                        <th>actions</th>
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
                   <div id="resto" class="menu_activite">
                        <bouton class="bouton_liste"> liste des <strong>Restaurants</strong> suggeres:</bouton>
                           <table>
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
                <!---
                   <div id="sport" class="menu_activite">
                        <bouton class="bouton_liste" style="color:black;"> liste des <strong>stades</strong> suggeres:</bouton>
                           <table>
                                   <thead>
                                      <tr>
                                        <th>Nom</th>
                                        <th>adresse</th>
                                        <th>choisir</th>
                                        <th>Actions</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                       <tr>
                                        <td>stade de pharma fghhfghfgh</td>
                                        <td>c 258 rue rrfffffffffffdddddjjjjjjjjjjjjjjjjjjjjj</td>
                                      
                                        <td> <a href="voir.ph" >voir</a></td>
                                       </tr>
                                   </tbody>
                            </table>
                    </div>
                -->
             </div>
             </div>
        </div>
        
        
       
    </body>
</html>