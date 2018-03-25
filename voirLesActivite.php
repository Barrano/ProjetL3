<?php  include "header.php";?>
<?php

require "conexion.php";
if(!empty($_GET['id_voir']))
   {
    $id=$_GET['id_voir'];  
   } 
   $db=database::connect();
   $resultat=$db->query('select nom_uti,prenom_uti,phone_uti,nom_acti,image_uti,adresse_acti,date_acti,description_acti
                        from utilisateur,activite
                        where utilisateur.id_uti=activite.id_uti');
   while($item=$resultat->fetch())
   {
       $phone=$item['phone_uti'];
       if($phone==$id)
       {
           $nomAnonceur=$item['nom_uti'].''.$item['prenom_uti'];
           $contactAnonceur=$item['phone_uti'];
           $photoAnonceur=$item['image_uti'];
           $nomActivite=$item['nom_acti'];
           $adresseActivite=$item['adresse_acti'];
           $descriprionActivite=$item['description_acti']; 
       }
       
   }
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
            select
            {
             font-size: 20px;
              border-radius: 10px;
            }
            .MssgErr
            {
            color: red;
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
            #sele
            {
                width: 235px;
            }
             #sele
            {
                
                text-transform: uppercase;
                font-size: 15px;
                text-shadow: 2px 2px 2px black, 0 0 1em blue, 0 0 0.2em blue;
                color: white;
                 background:red;
                border-radius: 7px;
                border:solid #000;
            }
            #sele:hover
            {
                font-size:15px;;
                background:blue;

            }
            .bouton_h2
            {
                text-transform: uppercase;
                font-size: 15px;
                color: green;
                text-align: center;
            }
        </style>
    </head>
    <body>  
<div class="affiche">
     <div class="formulaire">
         <table>
             
           
      
           <div class="diferenteDiv">
            <tr>
                 <td>
                     <label>Nom Anonceur:</label>
                 </td>
                <td>
                     <label class="message" style="color:#000; font-size:20px; font-family:italic;" ><?php echo $nomAnonceur ?></label><br>
                 </td>
             </tr>
             <tr>
                 <td>
                      <label >contact Anonceur:</label>
                 </td>
                <td>
                     <label style="color:#000; font-size:20px; font-family:italic;"><?php echo $contactAnonceur ?></label><br>
                 </td>
             </tr>  
            </div> 
            <div class="diferenteDiv">
            <tr>
                 <td>
                      <label >Photo Anonceur:</label>
                 </td>
                <td>
                      <label><?php echo '<img src="images/'. $photoAnonceur.'"alt="" width="80" height="80">'; ?></label>
                 </td>
             </tr>    
            </div> 
          <div class="diferenteDiv">
             <tr>
                 <td>
                      <label >Activite :</label>
                 </td>
                <td>
                       <label class="message" style="color:#000; font-size:20px; font-family:italic;"><?php echo $nomActivite ?></label>
                 </td>
             </tr>
             <tr>
                 <td>
                       <label >Adresse activite:</label> 
                 </td>
                <td>
                       <label class="message" style="color:#000; font-size:20px; font-family:italic;"><?php echo $adresseActivite ?></label><br><br>
                 </td>
             </tr>
          </div> 
          
          <div class="diferenteDiv">
               <tr>
                 <td>
                        <label >description :</label>
                 </td>
                <td>
                       <label class="message" style="color:#000; font-size:20px; font-family:italic;"><?php echo $descriprionActivite ?></label>
                 </td>
             </tr>
          </div> 
         </table>
     </div> 
 </div>
    
   
    </body>
</html>