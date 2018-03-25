<?php  include "header.php";?>
<?php

require "conexion.php";
$id_uti=$_SESSION['client'][2];


if(!empty($_GET['id_voir']))
{
    $id=$_GET['id_voir'];  
    
   $db=database::connect();
   $resultat=$db->query("DELETE FROM voter WHERE id_acti ='".$id."' && id_uti='".$id_uti."' ");
    
     
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
            if($type_acti=="boite")
            {

                $res=$db->query("select id_uti,boite_n from utilisateur  where id_uti='".$id_uti."' ");
                                           $ligne=$res->fetch();
                                          $boite=$ligne['boite_n'];
                                          $boite=$boite-1;

                      $result=$db->prepare(" UPDATE utilisateur SET boite_n=? where id_uti=? ");

                               $result->execute(array($boite,$id_uti));
            }elseif($type_acti=="restaurant")
            {

                $res=$db->query("select id_uti,restaurant_n from utilisateur  where id_uti='".$id_uti."' ");
                                           $ligne=$res->fetch();
                                          $resto=$ligne['restaurant_n'];
                                          $resto=$resto-1;

                      $result=$db->prepare(" UPDATE utilisateur SET restaurant_n=? where id_uti=? ");

                               $result->execute(array($resto,$id_uti));
            }elseif($type_acti=="plage")
            {

                $res=$db->query("select id_uti,plage_n from utilisateur  where id_uti='".$id_uti."' ");
                                           $ligne=$res->fetch();
                                          $plage=$ligne['plage_n'];
                                          $plage=$plage-1;

                      $result=$db->prepare(" UPDATE utilisateur SET plage_n=? where id_uti=? ");

                               $result->execute(array($plage,$id_uti));
            }else echo '';
    
            echo '<meta http-equiv="Refresh" content="0;url=lesAactivite.php" >';
       }
    
    
   
                               
}
}
                        
?>