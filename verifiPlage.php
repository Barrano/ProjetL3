<?php  include "header.php";?>
<?php

require "conexion.php";
$resto=false;
  
   if(!empty($_GET['id_plage']))
   {
    $id=$_GET['id_plage'];
    $resto=true;  
   } 
   if($resto)
    {
    $db=database::connect();
    $statement=$db->prepare('select * from plage where id_plage=?');
    $statement->execute(array($id));
    $item=$statement->fetch();
    $_SESSION['nom_plage']=$item['nom_plage'];
    $_SESSION['description_plage']=$item['description_plage'];
    $nom_plage=$_SESSION['nom_plage'];
    $description_plage=$_SESSION['description_plage'];
    }
    $description=$choix="";
    $descriptionErr=$choixErr=$dateErr="";
 $suces=false;
if(!empty($_POST))
{
    $description=securite($_POST["message"]);
    $date_jour=securite($_POST["date_jour"]);
    $date_moi=securite($_POST["date_moi"]);
    $date_annee=securite($_POST["date_annee"]);
    $heure=securite($_POST["heure"]);
    $minute=securite($_POST["minute"]);
    $seconde=securite($_POST["seconde"]);
    
    
    $nom_plage=$_SESSION['nom_plage'];
    $description_plage=$_SESSION['description_plage'];
    
   
    $date=$date_annee."/".$date_moi."/".$date_jour." ". $heure.":".$minute.":".$seconde;
    
    $suces=true;
     if(empty($description))
    {
        
         $descriptionErr="Veuillez choisir s'il vous plait !";
         $suces=false;
    }
     $datenow=date('Y/m/d H:i:s'); 
    if($date<$datenow)
    {
        $dateErr="desole la date !";
        $suces=false;
    }  
    if($suces)
    {   
        if (isset($_SESSION['client']))
        {
            $email=$_SESSION['client'][4];
            $uticone=$_SESSION['client'][2];
            $mdp=$_SESSION['client'][5];
        }
        $db=database::connect();
         $resu=$db->query("select * from utilisateur");
         while($item=$resu->fetch())
         {
             if($email==$item['email_uti'] and $mdp==$item['password_uti'])
             {    
                    $plage="plage";
                    $id_uti= $item['id_uti'];
                    $db=database::connect();
                    $db=database::connect();
                    $resulta=$db->query("insert into activite(id_uti,nom_acti,adresse_acti,date_acti,description_acti,type_acti) 
                    values('".$id_uti."','".$nom_plage."','".$description_plage."','".$date."','".$description."','".$plage."')");
                 
                        
                                   $res=$db->query("select id_uti,plage_n from utilisateur  where id_uti='".$uticone."' ");
                                   $ligne=$res->fetch();
                                  $plage=$ligne['plage_n'];
                                  $plage=$plage+1;
                 
                 
                 
                     $result=$db->prepare(" UPDATE utilisateur SET plage_n=? where id_uti=? ");
                     
                       $result->execute(array($plage,$uticone)); 
                       database::disconnect();
                    header("location:sugereActivite.php"); 
             }
         } 
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
        <link rel="stylesheet" href="sspose.css" >
        
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
        
        <div class="formulaire">
             <form action="verifiPlage.php" method="POST"  class="inscription">
                <table>
                 <div class="affiche">
                   <tr>
                        <td>
                            <label >nom:</label>  
                        </td>
                       <td> 
                            <label style="color:#000; font-size:15px; font-family:italic;"><?php echo ' '.$nom_plage; ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>adresse:</label>
                        </td>
                       <td> 
                             <label  style="color:#000; font-size:15px; font-family:italic;"><?php echo ' '.$description_plage; ?></label>
                        </td>
                        
                    </tr>
             </div>
                <div class="clean"></div>
                <div>
                  <tr>
                        <td>
                             <label>Date:</label>
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
                             <label for="date_jour">J</label>
                            <select name="date_moi" > 
                             <option>01</option><option>02</option><option>03</option>
                              <option>04</option><option>05</option><option>06</option>
                              <option>07</option><option>08</option><option>09</option>
                              <option>10</option><option>11</option><option>12</option>
                            </select>
                             <label for="date_moi">M</label>
                            <select name="date_annee" > 
                              <option>2018</option><option>2019 </option><option>2020</option>
                              <option>2021</option><option>2022 </option><option> 2023 </option>
                            </select>
                             <label for="date_annee">A</label>
                         </td>
                    </tr> 
                </div>
                 <div>
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
                                 <label for="minute">Mn&nbsp;&nbsp;</label>
                                <select name="seconde" > 
                                    <option>00</option><option>30 </option><option>59</option>
                                </select>
                                <label for="seconde">S</label>
                         </td>
                     </tr> 
                     <tr>
                        <td></td>
                        <td>
                             <p class="MssgErr"><?php echo $dateErr; ?></p>    
                         </td>
                      </tr> 
                </div> 
                <div>
                    
                     <tr>
                        <td><label for="message"> Description:<span class="etoile">*</span></label></td>
                        <td>
                             <textarea id="message" name="message" class="message" value="<?php echo $description  ?>"></textarea> 
                         </td>
                      </tr> 
                     <tr>
                        <td></td>
                        <td>
                             <p class="MssgErr"><?php echo $descriptionErr; ?></p> 
                         </td>
                      </tr> 
                </div>
                <div>
                     <tr>
                        <td></td>
                        <td>
                             <p class="bouton" id="bouto"><input type="submit" value=" Valider" id="sele"></p> 
                         </td>
                      </tr> 
                    
                </div>  
            </table>
           </form>
        </div>
        
    </body>
</html>