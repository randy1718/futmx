$(document).ready(function(){
    $('#capa').on('click',function(){
        document.getElementById('capa').classList.toggle('capa');
        document.getElementById('info').style.display="none";
        document.getElementById('crearCancha').style.display="none";
        document.getElementById('cambiar_foto').style.display="none";

    });

    document.getElementById('cambiar_foto').style.display="none";
});
