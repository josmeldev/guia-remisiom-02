$(document).ready(function(){
    $('#toggleTableBtn').click(function(){
        var buttonText = $(this).text();
        if (buttonText.trim() === 'Mostrar Tabla') {
            $(this).html('<i class="fas fa-eye"></i> Ocultar Tabla');
        } else {
            $(this).html('<i class="fas fa-eye"></i> Mostrar Tabla');
        }
    });
});