$(document).ready(function(){
    $('#capa').on('click',function(){
        document.getElementById('capa').classList.toggle('capa');
        document.getElementById('ae').style.display="none";
        document.getElementById('aj').style.display="none";
        document.getElementById('de').style.display="none";

    });

    document.getElementById('cambiar_foto').style.display="none";
});
