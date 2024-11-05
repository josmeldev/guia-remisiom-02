/-----------------CODIGO DE CONSULTAS MEDIANTE UN BOTON -----------------/
/*CODIGO PARA REALIZAR CONSULTA DE GUIA REMITENTE AGRICULTOR */
$(document).ready(function(){
    $('#consultarBtn').click(function(){
        var ruc = $('#rucInput').val();
        var token = $(this).data('token');
        var apiUrl = 'https://dniruc.apisperu.com/api/v1/ruc/' + ruc + '?token=' + token;

        // Realiza la solicitud AJAX
        $.ajax({
            url: apiUrl,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#razonSocialInput').val(response.razonSocial);
                $('#direccionInput').val(response.direccion);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error al realizar la consulta a la API de RUC');
            }
        });
    });
});



$(document).ready(function(){
    $('#consultarBtnRemTransport').click(function(){
        var ruc = $('#rucRemTransport').val();
        var token = $(this).data('token');
        var apiUrl = 'https://dniruc.apisperu.com/api/v1/ruc/' + ruc + '?token=' + token;

        // Realiza la solicitud AJAX
        $.ajax({
            url: apiUrl,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#razonSocialRemTransport').val(response.razonSocial);
                $('#direccionRemTransport').val(response.direccion);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error al realizar la consulta a la API de RUC');
            }
        });
    });
});




/------------CODIGO DE CONSULTAS AUTOMATICAS -------------/


/* CODIGO JS PARA CONSULTA DE RUC (TRANSPORTISTA)*/
$(document).ready(function(){
    $('#rucDos').on('input', function(){
        var ruc = $(this).val();
        var token = $(this).data('token');
        if(ruc.length === 11){
            var apiUrl = 'https://dniruc.apisperu.com/api/v1/ruc/' + ruc + '?token=' + token;

            $.ajax({
                url: apiUrl,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#razonSocialDos').val(response.razonSocial);
                    $('#direccionDos').val(response.direccion);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error al realizar la consulta a la API de RUC');
                }
            });
        }
    });
});



/* CODIGO JS PARA CONSULTA DE RUC (AGRICULTOR)*/
$(document).ready(function(){
    $('#rucAgricultor').on('input', function(){
        var ruc = $(this).val();
        var token = $(this).data('token');
        if(ruc.length === 11){
            var apiUrl = 'https://dniruc.apisperu.com/api/v1/ruc/' + ruc + '?token=' + token;

            $.ajax({
                url: apiUrl,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#razonSocialAgricultor').val(response.razonSocial);
                    $('#direccionAgricultor').val(response.direccion);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error al realizar la consulta a la API de RUC');
                }
            });
        }
    });
});