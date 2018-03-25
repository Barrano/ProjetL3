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
if(!empty($_GET['id_voir']))
{
    $id=$_GET['id_voir'];  
    
   $db=database::connect();
   $resultat=$db->query('select *
                        from utilisateur,activite
                        where utilisateur.id_uti=activite.id_uti');
   
    
    
  //$voter=false;
   while($item=$resultat->fetch())
   {
       $test=$item['id_acti'];
       $type_acti=$item['type_acti'];
       if($test==$id)
       {
           $id_acti=$item['id_acti'];
            $db=database::connect();
            $resulta=$db->query("insert into voter(id_uti,id_acti,nom_persone_vote,contact_persone_vote,image_persone_vote,type_acti) 
            values('".$id_uti."','".$id_acti."','".$nomAnonceur."','".$phone."','".$image."','".$type_acti."')");
            $clik = 1;
           
            if($type_acti=="boite")
            {

                      $res=$db->query("select id_uti,boite_n from utilisateur  where id_uti='".$id_uti."' ");
                                           $ligne=$res->fetch();
                                          $boite=$ligne['boite_n'];
                                          $boite=$boite+1;

                      $result=$db->prepare(" UPDATE utilisateur SET boite_n=? where id_uti=? ");

                               $result->execute(array($boite,$id_uti));
            }
           if($type_acti=="plage")
            {

                      $res=$db->query("select id_uti,plage_n from utilisateur  where id_uti='".$id_uti."' ");
                                           $ligne=$res->fetch();
                                          $plage=$ligne['plage_n'];
                                          $plage=$plage+1;

                      $result=$db->prepare(" UPDATE utilisateur SET plage_n=? where id_uti=? ");

                               $result->execute(array($plage,$id_uti));
            }
           if($type_acti=="restaurant")
            {

                      $res=$db->query("select id_uti,restaurant_n from utilisateur  where id_uti='".$id_uti."' ");
                                           $ligne=$res->fetch();
                                          $resto=$ligne['restaurant_n'];
                                          $resto=$resto+1;

                      $result=$db->prepare(" UPDATE utilisateur SET restaurant_n=? where id_uti=? ");

                               $result->execute(array($resto,$id_uti));
            }
    
    
            echo '<meta http-equiv="Refresh" content="0;url=lesAactivite.php" >';
           
           
         
          
           
          
       
       }
       
   }
                                
}
                        
?>