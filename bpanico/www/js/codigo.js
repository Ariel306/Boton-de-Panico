$(document).ready(function() {
    var refreshId = setInterval( function(){
    $('#recargarss').load('prueba.php');//actualizas el div automaticamente
    }, 10000 );
    });