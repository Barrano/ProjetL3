<?php

require "conexion.php";


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Montpellier Horizon</title>
        <link rel="stylesheet" href="css/css">
        
        <style>
            body
            {
               background:url("images/imageRcran/imageMontpellier.jpg")  repeat center; 
               
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

                overflow: auto;
                 height: 300px;
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
       <?php include "header.php"; ?>
        <div class="formulaire">
                    <table>
                        <thead>
                          <tr>
                             
                              <th>Nom</th>
                              <th>Adresse Activite</th> 
                              <th>Date</th>
                              <th>Regarder</th>
                               <th>Modifier</th>
                           </tr>
                         </thead>
                        <?php
                        
                        if (isset($_SESSION['client']))
                            {
                                $email=$_SESSION['client'][4];
                                $id_uti=$_SESSION['client'][2];
                            } 
                           
                           $db=database::connect();
                           $resultat=$db->query('select id_acti,email_uti,nom_uti,prenom_uti,phone_uti,nom_acti,adresse_acti,date_acti,description_acti
                                                from utilisateur,activite
                                                where utilisateur.id_uti=activite.id_uti  order by id_acti DESC');
                        
                           while($item=$resultat->fetch())
                           {
                               
                               
                               $test=$item['email_uti'];
                               if($email==$test)
                               {
                                   echo '<tbody>';
                               echo '<tr>';
                               echo '<td>'.$item['nom_acti'].'</td>';
                               echo '<td>'.$item['adresse_acti'].'</td>';
                               echo '<td>'.$item['date_acti'].'</td>';
                               
                               echo '<td  style="background:white;text-align:center;">
                                          <a href="voirMesActivite.php? id_voir='.$item['id_acti'].'">
                                          <img src="images/imagesIcone/voir.png" width="70" height="20">
                                          </a>'; echo '</td>'; 
                                   
                                    
                                   echo '<td style="background:white;text-align:center;">
                                  
                                   <a href="modifierMesActivite.php? id_modifi='.$item['id_acti'].'">
                                   <img src="images/imagesIcone/modifier.png" width="70" height="20">
                                          </a>';
                                   echo '</td>'; 
                                   echo '</tr>';
                                   echo '</tbody>';           
                               }
                               
                           }
                              
                            
                          
                        
                        ?>
                         
                    </table>
         </div>
         
        
    </body>
</html>