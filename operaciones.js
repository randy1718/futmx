$(document).ready(function () {
            $('#show').mousedown(function () {
           $('#pass').removeAttr('type');
         }); 
            $('#show').mouseup(function(){
       $('#pass').attr('type','password');
   }); 
 });
 
