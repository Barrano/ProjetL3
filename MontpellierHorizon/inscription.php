<?php
$nom=$prenom=$phone=$adresse=$email=$password="";
$nomErr=$prenomErr=$phoneErr=$adresseErr=$emailErr=$passwordErr="";
$suces=false;

if($_SERVER['REQUEST_METHOD']=="POST")
{
    $nom=securite($_POST["nom"]);
    $prenom=securite($_POST["prenom"]);
    $phone=securite($_POST["phone"]);
    $adresse=securite($_POST["adresse"]);
    $email=securite($_POST["email"]);
    $password=securite($_POST["pass"]);
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
    /* ----------------------------------xa commence ici la base de donnee---------------------------------*/
    if($suces)
    {
        
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
      <?php include "menu.php"; ?>
      <div class="formulaire"> 
       <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="inscription">
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
                <label for="pass">Password:</label>
                <input type="password" id="pass" name="pass" value="<?php echo $password ?>">
                <p class="MssgErr"><?php echo $passwordErr ?></p>
            </div>
            <input type="submit" value="Valider" class="boutton" >
            <p class="MssgEvoi" style="display:<?php if($suces) echo "block"; else echo "none"; ?>"   > vous etes bien inscrit </p>   
        </form> 
      </div>
    </body>   
</html>