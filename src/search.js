$(document).ready(function(){
    $('#search').on("keyup", function(){
      var getName = $(this).val();
     
      $.ajax({
        method: 'POST',
        url: 'searchajax.php',
        data: { name: getName },
        success: function(response) {
             $("#showdata").html(response);
        } 
      });
    });
 });