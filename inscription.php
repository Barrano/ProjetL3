<?php

require "conexion.php";
$nom=$prenom=$phone=$adresse=$email=$password=$mdpc=$image="";
$nomErr=$prenomErr=$phoneErr=$adresseErr=$emailErr=$passwordErr=$mdpcErr=$imageErr="";
$suces=false;

if(!empty($_POST))
{
    $nom=securite($_POST["nom"]);
    $prenom=securite($_POST["prenom"]);
    $phone=securite($_POST["phone"]);
    $adresse=securite($_POST["adresse"]);
    $email=securite($_POST["email"]);
    $password=securite($_POST["pass"]);
    $mdpc=securite($_POST["mdpc"]);
    
    $image=securite($_FILES["image"]["name"]);
    $imagePath='images/'.basename($image);
    $imageExtension=pathinfo($imagePath,PATHINFO_EXTENSION);
    
    $isUpload=false;
    $suces=true;
    
    if(empty($nom))
    {
        $nomErr="Veuillez saisir votre nom s'il vous plait !";
        $suces=false;
    }
     if(empty($prenom))
    {
        $prenomErr="Veuillez saisir votre prenom s'il vous plait !";
         $suces=false;
    }
    
    if(!isPhone($phone))
    {
        $phoneErr="Veuillez saisir des chiffres s'il vous plait !";
        $suces=false;
    }
     if(!isEmail($email))
    {
        $emailErr="Veuillez saisir votre email s'il vous plait !";
         $suces=false;
    }else
     {
         
         $db=database::connect();
         $resu=$db->query("select email_uti from utilisateur ");
         while($ligne=$resu->fetch())
         {
             $test=$ligne['email_uti'];
             if($test==$email)
             {
                 $emailErr="Ce nom utilisateur existe deja !";
                 $suces=false;   
             }
         }
         database::disconnect();
     }
    
    if(empty($adresse))
    {
        $adresseErr="Veuillez saisir votre adresse s'il vous plait !";
        $suces=false;
    }
    
     if(empty($password))
    {
        $passwordErr="Veuillez saisir votre mot de passe s'il vous plait !";
         $suces=false;
    }
    if(empty($mdpc))
    {
        $mdpcErr="Veuillez confirmer le mot de pass s'il vous plait !";
        $suces=false;
    }   
    else
     {
       if($mdpc!=$password)
       {
          $mdpcErr="Le mot de pass sont differents merci de reessayer !";
          $suces=false; 
       }
     }
    if(empty($image))
    {
        $imageErr="Téléchargez une photo de profil s'il vous plait !";
        $suces=false;
    }
        else
        {
            $isUpload=true;
            if($imageExtension!="jpg" && $imageExtension!="png" && $imageExtension!="jpeg" && $imageExtension!="gif" && $imageExtension!="JPG" && $imageExtension!="PNG" && $imageExtension!="JPEG" && $imageExtension!="GIF")
            {
                 $imageErr="Les images autorisées sont de type:png,jpg,jpeg et gif !";
                 $isUpload=false;
            }
            
            if($_FILES["image"]["size"]>500000)
            { 
               $imageErr="Cette Image ne doit pas dépasser 500KB merci de recommencer";
               $isUpload=false; 
            }
            if($isUpload)
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"],$imagePath))
                {
                   $imageErr="Erreur lors de telechargement merci de recommencer !";
                   $isUpload=false;  
                }
            }
        }
    /* ----------------------------------xa commence ici la base de donnee---------------------------------*/
    if($suces && $isUpload)
    {
        $db=database::connect();
        $resulta=$db->prepare(" INSERT into utilisateur (id_uti,nom_uti,prenom_uti,phone_uti,adresse_uti,email_uti,password_uti,image_uti) values(?,?,?,?,?,?,?,?)");
        $resulta->execute(array(null,$nom,$prenom,$phone,$adresse,$email,$password,$image));
        
        $_SESSION['var']=$image;
        header("location: menuConecte.php");
       
    database::disconnect();
    }
     /* ----------------------------------xa fini ici la base de donnee---------------------------------*/
        
    

    
    
    
}
function isPhone($var)
{
    return preg_match("/^[0-9 ]*$/",$var);
}
function isEmail($var)
{
    return filter_var($var,FILTER_VALIDATE_EMAIL);
}

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
     <title>Formulaire d'inscription</title>
     <link rel="stylesheet" type="text/css" href="css/inscription.css">
     <meta charset="utf-8">
  </head>
  <body>
     
     <?php  include "header.php";?>
      <div class="formulaire" style="overflow: auto;
                 height: 300px;"> 
       <form action="inscription.php" method="post" class="inscription" enctype="multipart/form-data">
            <h2>Formulaire d'inscription:</h2>
            <div>
                <label for="nom">Nom:</label>
                <input type="text"  name="nom"  value="<?php echo $nom ?>">
                <p class="MssgErr"><?php echo $nomErr ?></p>
            </div>
            <div>
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo $prenom ?>">
                <p class="MssgErr"><?php echo $prenomErr ?></p>
            </div>
            <div>
                <label for="phone">Téléphone:</label>
                <input type="text" id="telephone"  name="phone" value="<?php echo $phone ?>">
                <p class="MssgErr"><?php echo $phoneErr ?></p>
            </div>
            <div>
                <label for="adresse">Adresse:</label>
                <input type="text" id="adresse" name="adresse" value="<?php echo $adresse ?>">
                <p class="MssgErr"><?php echo $adresseErr ?></p>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="text" id="courriel" name="email" value="<?php echo $email ?>">
                <p class="MssgErr"><?php echo $emailErr ?></p>
            </div>
            <div>
                <label for="pass">Mot de passe:</label>
                <input type="password" id="pass" name="pass" value="<?php echo $password ?>">
                <p class="MssgErr"><?php echo $passwordErr ?></p>
            </div>
           <div>
                <label for="mdpc">Confirmer:</label>
                <input type="password" id="mdpc" name="mdpc" value="<?php echo $mdpc ?>">
                <p class="MssgErr"><?php echo $mdpcErr ?></p>
            </div>
           <div>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" >
                <p class="MssgErr"><?php echo $imageErr ?></p>
            </div>
            <input type="submit" value="Valider" class="boutton" >
            <p class="MssgEvoi" style="display:<?php if($suces) echo "block"; else echo "none"; ?>"   > vous etes bien inscrit </p>   
        </form> 
      </div>
      
    
        
          
          
          
          
          
      
      
    </body>   
</html>