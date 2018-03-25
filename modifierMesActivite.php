<?php  include "header.php";?>
<?php
$nomErr=$adresseErr=$descriptionErr=$dateErr=$dateErr=""; 


require "conexion.php";



if(!empty($_GET['id_modifi']))
    {
        $id=$_GET['id_modifi'];
    }
$suces=false;

if(!empty($_POST))
{
    $nom=securite($_POST["nom"]);
    $adresse=securite($_POST["adresse"]);
    $description=securite($_POST["description"]);
    $date=securite($_POST["date"]);
    $suces=true;
    if(empty($nom))
    {
        $nomErr="désolé donnez le nom !";
        $suces=false;
    }
    if(empty($adresse))
    {
        $adresseErr="désolé donnez l'adresse !";
        $suces=false;
    }
    if(empty($description))
    {
        $descriptionErr="désolé vous devez lasser un message !";
        $suces=false;
    }
    if(empty($date))
    {
        $dateErr="désolé donnez la date!";
        $suces=false;
    }
    $datenow=date('Y/m/d H:i:s'); 
    if($date<$datenow)
    {
       $dateErr="désolé la date doit etre supérieur a celle d'aujourd'hui";
        $suces=false;
    }
    $dateSup="2020/01/01 00:00:00";
    if($dateSup<$date)
    {
       $dateErr="désolé la date doit etre inférieur a celle que vous donnez";
        $suces=false; 
    }
    /* ----------------------------------xa commence ici la base de donnee---------------------------------*/
    if($suces)
    {
        $db=database::connect();
       $result=$db->prepare(" UPDATE activite SET nom_acti=?,adresse_acti=?,description_acti=?,date_acti=? where id_acti=? ");
       $result->execute(array($nom,$adresse,$description,$date,$id)); 
       database::disconnect();
       header("location:mesActivite.php");
    }
}else
{
    $db=database::connect();
    $res=$db->query('select id_acti,nom_acti,adresse_acti,description_acti,date_acti from activite ');
    while($item=$res->fetch())
    {
        $id_acti=$item['id_acti'];
        if($id_acti==$id)
        {
            $nom=$item['nom_acti'];
            $adresse=$item['adresse_acti'];
            $description=$item['description_acti'];
            $date=$item['date_acti']; 
        }
}
}
     /* ----------------------------------xa fini ici la base de donnee---------------------------------*/
        
    

    
    
    


function securite($var)
{
    $var=htmlspecialchars($var);
    $var=stripslashes($var);
    $var=trim($var);
    return $var;
}
?>
<!DOCTYPE html>
<html>
  <head>
     <title>Formulaire de modification</title>
     <link rel="stylesheet" type="text/css" href="css">
     <meta charset="utf-8">
      <style>
            body
            {
               background: url("images/imageRcran/imageMontpellier.jpg") repeat center; 
            }
            textarea
            {
              border-radius: 10px;
            }
            label
            {
                color: blue;
                font-size: 20px;
            }
            .MssgErr
            {
              color: red;
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
       <form action="<?php echo 'modifierMesActivite.php? id_modifi='.$id; ?>" method="POST" enctype="multipart/form-data">
           <table>
                <tr>
                    <td><label for="nom">Nom:</label></td>
                    <td><input type="text"  name="nom"  value="<?php echo $nom ?>" style="font-size:20px;"></td>
                </tr> 
               
                <tr>
                    <td></td>
                    <td><span class="MssgErr"><?php echo $nomErr ?></span></td>
                </tr> 
               
                <tr>
                    <td><label for="adresse">Adresse:</label></td>
                    <td><input type="text" id="adresse" name="adresse" value="<?php echo $adresse ?>" style="font-size:20px;"></td>
                </tr>  
               
                <tr>
                    <td></td>
                    <td><span class="MssgErr"><?php echo $adresseErr ?></span></td>
                </tr> 
               
                <tr>
                    <td><label for="date">Date:</label></td>
                    <td><input type="text" id="date" name="date" value="<?php echo $date ?>" style="font-size:20px;"></td>
                </tr> 
               
                <tr>
                    <td></td>
                    <td><span class="MssgErr"><?php echo $dateErr ?></span></td>
                </tr> 
               
                <tr>
                    <td><label for="description">Description:</label></td>
                    <td> <textarea type="text" id="description" name="description" style="font-size:20px; height:120px;" ><?php echo $description ?></textarea></td>
                </tr> 
                
                 <tr>
                     <td></td>
                    <td><p class="MssgErr"><?php echo $descriptionErr ?></p></td>
                 </tr> 
                
                 <tr>
                    <td></td>
                    <td><input type="submit" value="Valider" class="boutton" style="color:blue;width:100%;font-size:20px;"></td>
                 </tr> 
           </table>
        </form> 
          
      </div>
      
    </body>
</html>