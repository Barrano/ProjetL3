<?php  include "header.php";?>
<?php

require "conexion.php";
$id_uti=$_SESSION['client'][2];


if(!empty($_GET['id_voir']))
{
    $id=$_GET['id_voir'];  
    
   $db=database::connect();
   $resultat=$db->query("DELETE FROM voter WHERE id_acti ='".$id."' && id_uti='".$id_uti."' ");
    
            echo '<meta http-equiv="Refresh" content="0;url=lesAactivite.php" >';
                               
}
                        
?>