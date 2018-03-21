<?php  include "header.php";?>
<?php

require "conexion.php";


$nom_lieu=$adresse_lieu=$message="";
$adresse_lieuErr=$messageErr=$nom_lieuErr=$dateErr="";

$adresse_lieuErr_num_rue=$adresse_lieu_rueErr=$adresse_lieu_rue=$adresse_lieu_num_rue="";
$choix="";
$suces=false;

if(!empty($_POST))
{
    $nom_lieu=securite($_POST["nom_lieu"]);
    //$adresse_lieu=securite($_POST["adresse_lieu"]);
    
    $adresse_lieu_rue=securite($_POST["adresse_lieu_rue"]);
    $adresse_lieu_num_rue=securite($_POST["adresse_lieu_num_rue"]);
    
    $message=securite($_POST["message"]);
    $date_jour=securite($_POST["date_jour"]);
    $date_moi=securite($_POST["date_moi"]);
    $date_annee=securite($_POST["date_annee"]);
    $heure=securite($_POST["heure"]);
    $minute=securite($_POST["minute"]);
    $seconde=securite($_POST["seconde"]);
    $quartier=securite($_POST["quartier"]);
    
    
    $date=$date_annee."/".$date_moi."/".$date_jour." ". $heure.":".$minute.":".$seconde;
    
   $adresse_lieu=$adresse_lieu_num_rue." ".$adresse_lieu_rue;
    
    $suces=true;
  
 
        if(empty($nom_lieu))
        {
            $nom_lieuErr="Veuillez saisir le nom du lieu s'il vous plait !";
            $suces=false;
        }
        if(empty($message))
        {
           $messageErr="Veuillez saisir un message s'il vous plait !";
            $suces=false;
        }
        if(empty($adresse_lieu_num_rue))
        {
          $adresse_lieuErr_num_rue="Veuillez saisir le numero de rue s'il vous plait !";
            $suces=false;
        }
    if(empty($adresse_lieu_rue))
        {
          $adresse_lieu_rueErr="Veuillez saisir la rue s'il vous plait !";
            $suces=false;
        }
    
    
    
        /* 
         $db=database::connect();
         $resu=$db->query("SELECT * FROM `table 9` ");
         while($ligne=$resu->fetch())
         {
             $col1=$ligne['numrue'];
             $col2=$ligne['rue'];
             $adresse1=$col1."".$col2; 
             //echo $adresse1;
             if($adresse1 != $adresse_lieu)
             {
                 $adresse_lieuErr="cette adresse n'est pas valide!";
                 $suces=false; 
             }
         }
         database::disconnect();*/
     
        
      
        $datenow=date('Y/m/d H:i:s'); 
        if($date<$datenow)
        {
             $suces=false;
            $dateErr="desole la date !";
        }
        if($suces)
        {
            if (isset($_SESSION['client']))
            {
                $email=$_SESSION['client'][4];
                $mdp=$_SESSION['client'][5];
            }
            $db=database::connect();
             $resu=$db->query("select * from utilisateur");
             while($item=$resu->fetch())
             {
                 if($email==$item['email_uti'] and $mdp==$item['password_uti'])
                 {
                        $autre="autre";
                        $id_uti= $item['id_uti'];
                        $db=database::connect();
                        $resulta=$db->query("insert into activite(id_uti,nom_acti,adresse_acti,date_acti,description_acti,type_acti) 
                        values('".$id_uti."','".$nom_lieu."','".$adresse_lieu."','".$date."','".$message."','".$autre."')");
                        $nom_lieu=$adresse_lieu=$message="";   
                        $db=database::disconnect();
                      
                 }
                
             }
                    
                        $db=database::connect();
                        $resultat=$db->prepare(" INSERT into decoupe_ville (id_decoupe,rue,quartier) values(?,?,?)");
                        $resultat->execute(array(null,$adresse_lieu_rue,$quartier));
        }  
    
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
        <link rel="stylesheet" href="css/ontac.css" >
         <meta charset="utf-8">
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
         
        <div class="formulaire" style="text-align:center;">
             <form action="autreActivite.php" method="POST"  class="inscription">
              <table>
                <tr>
                    <td>
                        <label for="nom_lieu" >Nom:</label>
                    </td>
                    <td>
                       <input type="text" name ="nom_lieu" placeholder="donner le nom de lieu" class="sele" value="<?php echo $nom_lieu  ?>">
                    </td>
                </tr> <br>
                <tr>
                    <td></td>
                     <td><p class="MssgErr"><?php echo $nom_lieuErr; ?></p></td>
                </tr>
                <tr>
                    <td>
                        <label for="adresse_lieu_num_rue">Num rue</label>
                    </td>
                    <td>
                     <input type="text" name ="adresse_lieu_num_rue" placeholder="donner le num rue" id="seleadresse" value="<?php echo $adresse_lieu_num_rue ?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><p class="MssgErr"><?php echo $adresse_lieuErr_num_rue; ?></p></td>  
                </tr> 
                  <tr>
                    <td>
                        <label for="adresse_lieu_rue">La rue</label>
                    </td>
                    <td>
                     <input type="text" name ="adresse_lieu_rue" placeholder="donner la rue" id="seleadresse" value="<?php echo $adresse_lieu_rue ?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><p class="MssgErr"><?php echo $adresse_lieu_rueErr; ?></p></td>
                    
                </tr>
                  
                  
                  
                  
                   <tr>
                    <td>
                        <label>Quartier:&nbsp;&nbsp;</label>
                    </td>
                    <td>
                         <select name="quartier" > 
                          <?php 
                             $db=database::connect();
                             $resu=$db->query("select nom_quartier from quartier");
                             while($item=$resu->fetch())
                             {
                                 echo '<option>';
                                 $nomQuartier=$item['nom_quartier'];
                                 echo $nomQuartier;
                                 echo '</option>';
                             }
                             
                         ?>
                         
                        </select>
                    </td>
                </tr>       
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                <tr>
                    <td>
                        <label>Date:&nbsp;&nbsp;</label>
                    </td>
                    <td>
                         <select name="date_jour" > 
                          <option>01</option><option>02</option><option>03</option>
                          <option>04</option><option>05</option><option>06</option>
                          <option>07</option><option>08</option><option>09</option>
                          <option>10</option><option>11</option><option>12</option>
                          <option>13</option><option>14</option><option>15</option>
                          <option>16</option><option>17</option><option>18</option>
                          <option>19</option><option>20</option><option>21</option>
                          <option>22</option><option>23</option><option>24</option>
                          <option>25</option><option>26</option><option>27</option>
                          <option>28</option><option>29</option><option>30</option>
                        </select>
                        <label for="date_jour">J&nbsp;</label>
                        <select name="date_moi" > 
                          <option>01</option><option>02</option><option>03</option>
                          <option>04</option><option>05</option><option>06</option>
                          <option>07</option><option>08</option><option>09</option>
                          <option>10</option><option>11</option><option>12</option>
                        </select>
                         <label for="date_moi">M&nbsp;</label>
                        <select name="date_annee" > 
                          <option>2018</option><option>2019 </option><option>2020</option>
                          <option>2021</option><option>2022 </option><option> 2023 </option>
                        </select>
                         <label for="date_annee">A</label>
                    </td>
                </tr>       
                <tr>
                    <td>
                         <label>Horaire:</label>
                    </td>
                    <td>
                         <select name="heure" > 
                          <option>01</option><option>02</option><option>03</option>
                          <option>04</option><option>05</option><option>06</option>
                          <option>07</option><option>08</option><option>09</option>
                          <option>10</option><option>11</option><option>12</option>
                          <option>13</option><option>14</option><option>15</option>
                          <option>16</option><option>17</option><option>18</option>
                          <option>19</option><option>20</option><option>21</option>
                          <option>22</option><option>23</option><option>00</option>
                        </select>
                           <label for="heure">H</label>
                        <select name="minute" > 
                          <option>00</option>
                          <option>10</option><option>20</option><option>30</option>
                          <option>40</option><option>50</option><option> 59</option>
                        </select>
                         <label for="minute">Mn&nbsp;&nbsp;&nbsp;</label>
                         <select name="seconde" > 
                            <option>00</option><option>30 </option><option>59</option>
                         </select>
                         <label for="seconde">S</label>
                    </td>
                </tr>  
                <tr>
                    <td></td>
                    <td><p class="MssgErr"><?php echo $dateErr; ?></p></td>   
                </tr> 
                <tr>
                    <td>
                         <label for="message"> Description:&nbsp;<span class="etoile">*</span></label>
                    </td>
                    <td>
                        <textarea id="message" name="message" class="message" value="<?php echo $message  ?>"></textarea>
                    </td>
                </tr>   
                <tr>
                    <td></td>
                    <td><p class="MssgErr"><?php echo $messageErr ?></p></td>  
                </tr>
                <tr>
                    <td></td>
                    <td><p class="bouton" id="bouto"><input type="submit" value=" Valider" id="sele"></p></td>    
                </tr>
                <tr>
                    <td></td>
                    <td> <h2 class="bouton_h2"><?php if($suces) echo 'Activite enregistree!'; ?></h2></td>    
                </tr>     
         </table>
     </form>
  </div>
</body>
</html>