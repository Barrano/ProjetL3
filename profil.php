<?php  include "header.php";?>


<?php
require "conexion.php";
//require "chartjs/administrateur.php";
/*if(!empty($_GET['id']))
{
    $id=$_GET['id'];
}*/
if(isset($_SESSION['client']))
{
    $id=$_SESSION['client'][2];
}
$nom=$prenom=$phone=$image=$adresse=$mdp="";
$nomErr=$prenomErr=$phoneErr=$imageErr=$emailErr=$mdpErr=$adresseErr="";




if(!empty($_POST))
{
    $nom              =$_POST['nom'];
    $prenom           =$_POST['prenom'];
    $phone            =$_POST['phone'];
    $adresse          =$_POST['adresse'];
    $mdp              =$_POST['mdp'];
    $image            =$_FILES['image']['name'];
    $imagePath        ='images/'.basename($image);
    $imageExtension   =pathinfo($imagePath,PATHINFO_EXTENSION);
    
    $isSuces=true;
    
    if(empty($nom))
    {
       $nomErr="ce champ est obligatoire";
        $isSuces=false;
    }
     if(empty($prenom))
    {
       $prenomErr="ce champ est obligatoire";
       $isSuces=false;
    }
     if(empty($adresse))
    {
       $adresseErr="ce champ est obligatoire";
       $isSuces=false;
    }
     if(empty($mdp))
    {
       $mdpErr="ce champ est obligatoire";
       $isSuces=false;
    }
    if(!isPhone($phone))
    {
        $phoneErr="Veuillez saisir des chiffres s'il vous plait !";
        $suces=false;
    }
    /*else
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
     }*/
    
     if(empty($image))
    { 
       $isUpdated=false;   
    }else
     {
         $isUpdated=true;   
          $isUpload=true; 
         if($imageExtension!="PNG" && $imageExtension!="jpg" && $imageExtension!="jpeg" && $imageExtension!="gif")
         {
           $imageErr="Cette Image est de type:PNG/JPG/GIF/JPEG merci de resayer";
           $isUpload=false; 
         }
         if(file_exists($imagePath))
         {
           $imageErr="Cette image existe deja merci de resayer";
           $isUpload=false;  
         }
         if($_FILES["image"]["size"]>500000 )
         {
           $imageErr="Cette Image ne doit pas depasser 500KB merci de ressayer";
            $isUpload=false; 
         }
         if($isUpload)
         {
             if(!move_uploaded_file($_FILES["image"]["tmp_name"],$imagePath))
             {
                $imageErr="Il y a eu un problème lors de telechargement";
                $isUpload=false;  
             }
         }
     } 
    
    if(($isSuces && $isUpload && $isUpdated)|| ($isSuces && !$isUpdated))
    {
        $db=database::connect();
        if($isUpdated)
        {
    $result=$db->prepare(" UPDATE utilisateur set nom_uti=?,prenom_uti=?,adresse_uti=?,phone_uti=?,password_uti=?,image_uti=?
            where id_uti=? ");
            $result->execute(array($nom,$prenom,$adresse,$phone,$mdp,$image,$id));
        }
        else
        {
            $result=$db->prepare(" UPDATE utilisateur set nom_uti=?,prenom_uti=?,adresse_uti=?,phone_uti=?,password_uti=?
            where id_uti=? ");
            $result->execute(array($nom,$prenom,$adresse,$phone,$mdp,$id)); 
        }
       
        database::disconnect();
        header("location: lesAactivite.php");
    }
    else if($isUpdated && !$isUpload )
    {
        $db=database::connect();
        $result=$db->prepare(" SELECT image_uti from utilisateur where id_uti=? ");
        $result->execute(array($id));
        $item=$result->fetch();  
        $image=$item['image_uti'];
        database::disconnect();
    }
}
else
{
    $db=database::connect();
     $result=$db->prepare(" SELECT * From utilisateur where id_uti=? ");
     $result->execute(array($id));
    $item=$result->fetch();  
      
    
    $nom              =$item['nom_uti'];
    $prenom           =$item['prenom_uti'];
    $adresse             =$item['adresse_uti'];
    $phone            =$item['phone_uti'];
    $mdp            =$item['password_uti'];
    $image            =$item['image_uti'];
    database::disconnect();
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
      <title>Bonjour</title> 
        <meta charset="UTF-8">
        
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

            }
             p
             {
               color: red;  
             }
            form
            {

                height: auto;
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
             table
             {
                  margin-left: 0px;
             }
             label
            {
                color: blue;
                font-size: 20px;
                text-transform: uppercase;
            }
            input
            {
                font-size: 15px;
                border-radius: 10px;
            }
        </style>
        
    </head>
	<body> 
        <form action="<?php echo 'profil.php? id='.$id; ?>" role="form" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="nom">Nom:</label></td>
                    <td><input type="text" name="nom" placeholder="votre nom" value="<?php echo $nom ;?>"></td>
                    <td rowspan="7">
                           
                        <a href="chartjs/statiste.php">Mes statistiques d'activites</a> 
                        <?php
                             if (isset($_SESSION['client']))
                                    {
                                        $uticone=$_SESSION['client'][2];

                                    }

                            $db=database::connect();
                            $res=$db->query("select plage_n, boite_n, restaurant_n from utilisateur where id_uti='".$uticone."' ");
                            $ligne=$res->fetch();
                            //$_SESSION['l']=;
                                
                                $boitee=$ligne['boite_n']*100;
                                $plagee=$ligne['plage_n']*100;
                                 $restoo=$ligne['restaurant_n']*100;
                                    $som=$boitee+$plagee+$restoo;
                                    if($som !=0)
                                    {
                                        $boite=($boitee/$som)*100;
                                            $plage=($plagee/$som)*100;
                                             $resto=($restoo/$som)*100;  
                                    }else
                                    {
                                        $boite=0;
                                            $plage=0;
                                             $resto=0;  
                                    }

                                        //on modifie les valeurs de la table occurence
                                            $result=$db->query("UPDATE occurrence SET nombre_n='".$boite."' where id_cat='boite'; ");
                                            $result=$db->query("UPDATE occurrence SET nombre_n='".$plage."' where id_cat='plage'; ");
                                            $result=$db->query("UPDATE occurrence SET nombre_n='".$resto."' where id_cat='restaurant'; ");           
                                        


                           ?>   
                    
                    
                    
                    
                    
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><p><?php echo $nomErr; ?></p></td>
                </tr>
                <tr>
                    <td><label for="prenom">Prenom:</label></td>
                    <td><input type="text" name="prenom" placeholder="votre prenom"  value="<?php echo $prenom; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><p><?php echo $prenomErr; ?></p></td>
                </tr>
                
                <tr>
                    <td><label for="phone">Phone:</label></td>
                    <td><input type="text" name="phone" placeholder="votre numero"  value="<?php echo $phone; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><p><?php echo $phoneErr; ?></p></td>
                </tr>
                
                <tr>
                    <td><label for="adresse">Adresse:</label></td>
                    <td><input type="text" name="adresse" placeholder="votre adresse"  value="<?php echo $adresse; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><p><?php echo $adresseErr; ?></p></td>
                </tr>
                <tr>
                    <td><label for="mdp">Password:</label></td>
                    <td><input type="password" name="mdp"   value="<?php echo $mdp; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><p><?php echo $mdpErr; ?></p></td>
                </tr>
                <tr>
                    <td><label for="image">Photo:</label></td>
                    <td><input type="file" name="image"   value="<?php echo $image; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><p><?php echo $imageErr; ?></p></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit"value="Modifier" style="background:blue;text-transform:uppercase;color:red;"></td>
                </tr>
            
         </table>
        </form>
       
        
        
   </body>
</html> 



