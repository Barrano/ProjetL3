
            
<?php  include "header.php";?>
<?php
require "conexion.php";
if (isset($_SESSION['client']))
{
    $nom=$_SESSION['client'][0];
    $prenom=$_SESSION['client'][1];
    $phone=$_SESSION['client'][3];
    $image=$_SESSION['client'][6];
    $id_uti=$_SESSION['client'][2];
    $nomAnonceur=$nom.' '.$prenom;
} 
$db=database::connect();
$res=$db->query("select plage_n, boite_n, restaurant_n from utilisateur where id_uti='".$id_uti."' ");
$ligne=$res->fetch();
    $boite=$ligne['boite_n'];
    $plage=$ligne['plage_n'];
     $resto=$ligne['restaurant_n'];

                  

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
       <p style="text-align:center;"><a href="recomandation.php"style="font-sige:10px;" target="header">Suggestion gerant  </a>&nbsp;&nbsp;&nbsp;<label style="text-transform:uppercase;background:white;">Suggestion participant</label></p>
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
            
        <div class="formulaire"> 
                    <table>
                        <thead>
                          <tr>
                              <th>Nom Annonceur</th>
                              <th>Nom</th>
                              <th>Adresse Activite</th> 
                              <th>Date Activite</th>
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
                     if($boite>=$plage && $boite>=$resto)
                    {
                         //$boi="boite";
                            $resultat=$db->query('select id_acti,email_uti,nom_uti,prenom_uti,phone_uti,nom_acti,image_uti,adresse_acti,date_acti,description_acti,type_acti
                                                from utilisateur,activite
                                                where utilisateur.id_uti=activite.id_uti and type_acti="boite"  order by id_acti DESC');
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
                        
                    }elseif($boite<=$plage && $plage>=$resto)          
                    {
                         //$boi="boite";
                            $resultat=$db->query('select id_acti,email_uti,nom_uti,prenom_uti,phone_uti,nom_acti,image_uti,adresse_acti,date_acti,description_acti,type_acti
                                                from utilisateur,activite
                                                where utilisateur.id_uti=activite.id_uti and type_acti="plage"  order by id_acti DESC');
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
                        
                    }else
                     {
                         //$boi="boite";
                            $resultat=$db->query('select id_acti,email_uti,nom_uti,prenom_uti,phone_uti,nom_acti,image_uti,adresse_acti,date_acti,description_acti,type_acti
                                                from utilisateur,activite
                                                where utilisateur.id_uti=activite.id_uti and type_acti="restaurant"  order by id_acti DESC');
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
                        
                    }      

                           
                ?>
                         
                    </table>
         </div>
    </body>
</html>

           