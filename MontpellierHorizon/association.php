<?php include "header.php"; ?> 

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
            table
            {
                margin-left: 0px;
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
                    
                height: 320px;
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
                    <table>
                        <thead>
                          <tr>
                             
                              <th>Nom</th>
                              <th>Internet</th> 
                              <th>Adresse mail</th>
                              <th>Domaine</th>
                               <th>Adresse</th>
                           </tr>
                         </thead>
                        <?php
                       
                           
                           $db=database::connect();
                           $resultat=$db->query('select B,E,D,F,H from associations'); 
                        
                           while($item=$resultat->fetch())
                           {
                               
                              
                                   echo '<tbody>';
                               echo '<tr>';
                               echo '<td>'.$item['B'].'</td>';
                                echo '<td  style="background:white;text-align:center;">
                                          <a href="'.$item['E'].'" target="blank">'.$item['E'].'
                            
                                          </a>';
                               echo '</td>'; 
                               echo '<td>'.$item['H'].'</td>';
                               echo '<td>'.$item['D'].'</td>';
                                   echo '<td>'.$item['F'].'</td>';
                               
                              
                                   
                                    
                                   echo '</td>'; 
                                   echo '</tr>';
                                   echo '</tbody>';           
                             
                               
                           }
                              
                            
                          
                        
                        ?>
                         
                    </table>
         </div>
         
        
    </body>
</html>