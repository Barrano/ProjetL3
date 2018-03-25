<?php  include "header.php";?>
<?php
require "conexion.php";

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Montpellier Horizon</title>
        <link rel="stylesheet" href="css">
       
        
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
                 overflow: auto;
                 height: 350px;

                
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
        </style>
    </head>
    <body>
       
        <div class="formulaire"> 
                    <table>
                        <thead>
                          <tr>
                              <th>Annonceur</th>
                              <th>Nom</th>
                              <th>Adresse Activite</th> 
                              <th>Date </th>
                              <th>Type</th>
                               <th>Photo</th>
                              
                              <th width="130">Les actions</th>
                           </tr>
                         </thead>
                        <?php
                        
                        if (isset($_SESSION['client']))
                            {
                                $email=$_SESSION['client'][4];
                                $id_uti=$_SESSION['client'][2];
                            } 
                           
                           $db=database::connect();
                           $resultat=$db->query('select id_acti,email_uti,nom_uti,prenom_uti,phone_uti,nom_acti,image_uti,adresse_acti,date_acti,description_acti,type_acti
                                                from utilisateur,activite
                                                where utilisateur.id_uti=activite.id_uti order by id_acti DESC');
                           while($item=$resultat->fetch())
                           {
                               
                               $acti=$item['id_acti'];
                               $test=$item['email_uti'];
                               if($email!=$test)
                               {
                                   echo '<tbody>';
                               echo '<tr>';
                               echo '<td>'.$item['nom_uti'].' '.$item['prenom_uti'].'</td>';
                              
                               echo '<td>'.$item['nom_acti'].'</td>';
                               echo '<td>'.$item['adresse_acti'].'</td>';
                               echo '<td>'.$item['date_acti'].'</td>';
                                echo '<td>'.$item['type_acti'].'</td>';
                               echo '<td><img src="images/'.$item['image_uti'].'"alt="" width="55" height="50"></td>';
                               
                               echo '<td  style="background:01B0F0;text-align:center;" >';
                               
                                   $resu=$db->query('select id_acti,id_uti from voter where id_acti="'.$acti.'" ');
                                   $liste=$resu->fetch();
                                   
                                      $test1=$liste['id_acti'];
                                       $test2=$liste['id_uti'];
                                       
                                       if(($acti==$test1)and($test2==$id_uti))
                                       {  
                                           echo '<a href="annuler.php? id_voir='.$item['id_acti'].'">
                                           annuler</a>';
                                       } else
                                       {
                                           echo '<a href="voterLesActivite.php? id_voir='.$item['id_acti'].'">
                                           Jy vais</a>'; 
                                       }
                                    
                                  echo '<a href="voirLesActivite.php? id_voir='.$item['phone_uti'].'">voir
                                  </a><br>';
                                   
                                  
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