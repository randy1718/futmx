$(document).ready(function(){
$('#capa').on('click',function(){
  document.getElementById('slidebar').classList.toggle('active');  
  document.getElementById('capa').classList.toggle('capa');
 });
 $('#ca').on('click',function(){
  document.getElementById('cambiar_contraseña').style.display="none";  
  document.getElementById('ca').classList.toggle('ca');
 });
});
 