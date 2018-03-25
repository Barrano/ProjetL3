 

<?php  include "header.php";?>
<?php

require "conexion.php";
if(!empty($_GET['id_voir']))
   {
    $id=$_GET['id_voir'];  
   } 
   $db=database::connect();
   $resultat=$db->query('select  id_acti,nom_uti,prenom_uti,phone_uti,nom_acti,image_uti,adresse_acti,date_acti,description_acti
                        from utilisateur,activite
                        where utilisateur.id_uti=activite.id_uti');
   while($item=$resultat->fetch())
   {
       $acti=$item['id_acti'];
       if($acti==$id)
       {
           $nomAnonceur=$item['nom_uti'].''.$item['prenom_uti'];
           $contactAnonceur=$item['phone_uti'];
           $photoAnonceur=$item['image_uti'];
           $nomActivite=$item['nom_acti'];
           $adresseActivite=$item['adresse_acti'];
           $descriprionActivite=$item['description_acti']; 
       }
       
   }database::disconnect();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Montpellier Horizon</title>
        <link rel="stylesheet" href=".css" >
        
        <style>
        body
            {
               background: url("images/imageRcran/imageMontpellier.jpg")  repeat center; 
            }
            label
            {
                color: blue;
                font-size: 20px;
            }
            input
            {
                font-size: 20px;
                border-radius: 10px;
            }
            option
            {
              font-size: 20px;
              border-radius: 10px;
            }
            
            .formulaire
            {

                height: auto;
                width: 660px;
                margin-left: 350px;/* ce la nous a permis de deplacer notre div de gauche vers la droite de 400px*/
                border-radius: 5px;
                border-radius: 5px;
                border: 1px solid #0200F1;
                color: blue;
                 background-color: aliceblue;
                border-radius: 10px;
                font-size: 20px;
                 margin-top: 40px;
            }
            #message
            {
                width: 235px;
                font-size: 20px;
              border-radius: 10px;
            }
            table
            {
                margin-left: 130px;
            }
            
            
           
           
        </style>
    </head>
    <body>  
    <div class="formulaire">
        
             <table>
                 <tr>
                    <td><label>Nom :</label></td>
                     <td> <label class="message" style="color:#000; font-size:20px; font-family:italic;"><?php echo $nomActivite ?></label>
                    </td>
                 </tr>
                 <tr>
                    <td> <label>Adresse activite:</label></td>
                     <td><label class="message" style="color:#000; font-size:20px; font-family:italic;" ><?php echo $adresseActivite ?></label></td>
                 </tr>
                 
                  <tr>
                    <td>  <label>description :</label></td>
                     <td><label class="message" style="color:#000; font-size:20px; font-family:italic;"><?php echo $descriprionActivite ?></label></td>
                 </tr>
             </table>
               <?php
                $db=database::connect();
                $res=$db->query('select nom_uti,prenom_uti,phone_uti,image_uti,utilisateur.id_uti,voter.id_acti,activite.id_acti from voter,utilisateur,activite
                where voter.id_uti=utilisateur.id_uti and voter.id_acti=activite.id_acti');
                echo '<table style="background:white;">';
                echo '<tr>';
                echo '<th>NOM</th>';
                echo '<th>prenom</th>';
                echo '<th>contact</th>';
                echo '<th>image</th>';
                echo '</tr>';
                  $var=0;
                   while($item=$res->fetch())
                   {
                       $id_activote=$item['id_acti'];
                       if($id==$id_activote)
                       {
                           $nomm=$item['nom_uti'];
                           $prenomm=$item['prenom_uti'];
                           $phoneee=$item['phone_uti'];
                           $photo=$item['image_uti'];
                           echo '<tr>';
                           echo '<td>'.$nomm.'</td>';
                           echo '<td>'.$prenomm.'</td>';
                           echo '<td>'.$phoneee.'</td>';
                           echo '<td><img src="images/'.$photo.'"alt="" width="55" height="50"></td>';
                           echo '</tr>';
                           $var=$var+1;
                       }
                   }
               ?>  
                <table>
                  <tr>
                    <td><label><?php echo ' ';?></label></td>
                     <td><label style="color:white;background:blue;">NOMBRES DE PARTICIPANT  <span style="color:red;background:white;">
                     <?php echo $var;?></span></label>
                 </tr>
               </table>
        </div>
    </body>
</html>