
 <?php  include "header.php";?>
<?php

require "conexion.php";
$email=$emailErr=$passwordErr=$password="";
$suces=false; 
if(!empty($_POST))
{
    $email=securite($_POST['email']);
     $password=securite($_POST['pass']);
    
    $suces=true;
    if(empty($password))
    {
        $passwordErr="Veuillez saisir votre mot de pass";
        $suces=false;
    }
    if(!isEmail($email))
    {
       $emailErr="Veuillez saisir votre email";
        $suces=false; 
    }
    if($suces)
    {
       $db=database::connect();
        $resultat=$db->query("SELECT * FROM utilisateur ");
        
        while($item=$resultat->fetch())
        {
            $testmail=$item['email_uti'];
            $testmdp=$item['password_uti'];
            if(($testmail==$email) && ($testmdp==$password))
            {
                 $_SESSION['client']=array($item['nom_uti'],$item['prenom_uti'],$item['id_uti'],$item['phone_uti'],$item['email_uti'],$item['password_uti'],$item['image_uti']);
                
                echo '<meta http-equiv="Refresh" content="0;url=lesAactivite.php" >';
            }else
            {
               $passwordErr="Veuillez réessayer le mot de passe";
               $emailErr="Veuillez resaisir l'email d'utilisateur";
               $suces=false; 
            }
            
        }
    }
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
        <title>Montpellier Horizon</title>
        <link rel="stylesheet" href="css/login.css" >
        <script src="script/jquery-3.3.1.min.js"></script>
            <script src="script/frame.js"></script>
         <meta charset="UTF-8" >
    </head>
    <body>
       
        
        <div class="formulaire" style="overflow: auto;
                 height: 300px;">
             <form action="login.php" method="POST"  class="inscription">
                <div>
                     <label for="email">Utilisateur:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                     <input type="text" name="email" value="<?php echo $email;?>">
                     <p class="MssgErr"><?php echo $emailErr;?></p>
                </div>
                <div>
                    <label for="pass">&nbsp;&nbsp;Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="password"  name="pass" value="<?php echo $password ?>">
                    <p class="MssgErr"><?php echo $passwordErr ?></p>
                </div>
                <div>
                     <p class="bouton" id="bouto"><input type="submit" value=" se connecter" ></p>
                </div>

                <div>
                     <p class="bouton" id="bouto"><a href="inscription.php">S'inscrire ?</a></p>
                </div>
                  
               
             </form>
        </div>
        
        
         
    </body>
</html>