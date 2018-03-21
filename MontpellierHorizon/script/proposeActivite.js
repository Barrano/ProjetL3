$(function()
{
  
   $("#boiteNuit").hide();
    $("#plage").hide();
     $("#resto").hide();
    $("#sport").hide();
    
    
   
   
   
   
        $(".type").show(function()
        {  
            
            
            $("#radi_boite").mouseenter(function()
            {
                 $(".type").show();
                $("#plage").hide();
                 $("#resto").hide();
                $("#sport").hide();
                
                 $("#boiteNuit").show(); 
             });
            
            $("#radi_plage").mouseenter(function()
            {
                 $(".type").show();
                $("#boiteNuit").hide(); 
                 $("#plage").show(); 
                 $("#resto").hide();
                $("#sport").hide();
             });
            
            
            $("#restorant").mouseenter(function()
            {
                $("#resto").show();
                $("#boiteNuit").hide();
                $("#plage").hide();
                
              $("#sport").hide();
            });
            
             $("#sporte").mouseenter(function()
            {
                 $("#sport").show();
                $("#resto").hide();
                $("#boiteNuit").hide();
                $("#plage").hide();
                
              
            });
            
            
             $(".choisir").click(function()
            {
                 $("#sport").hide();
                $("#resto").hide();
                $("#boiteNuit").hide();
                $("#plage").hide();
                
              
            });
            
         
           
        }); 
        
    
    
   
        
    
});
