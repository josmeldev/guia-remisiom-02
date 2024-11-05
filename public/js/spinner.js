$(document).ready(function() {
    var hasError = false;
    var loaded = false;

    // Función para ocultar el spinner y mostrar el mensaje de error
    var hideSpinnerAndShowError = function() {
        $('#loader').fadeOut(); // Ocultar el spinner
        $('#errorMessage').fadeIn(); // Mostrar el mensaje de error
    };

    // Función para ocultar el spinner después de 5 segundos si no hay errores graves
    var hideSpinnerAfter5Seconds = setTimeout(function() {
        if (!hasError) {
            $('#loader').fadeOut();
        }
    }, 5000);

    // Ocultar el spinner y mostrar el mensaje de error después de 10 segundos si hay errores
    var showErrorMessageAfter10Seconds = setTimeout(function() {
        if (!loaded) {
            hideSpinnerAndShowError();
        } else {
            $('#loader').fadeOut();
        }
    }, 10000); // 10 segundos (10000 milisegundos)

    // Ocultar el spinner cuando la página se carga completamente
    $(window).on('load', function() {
        loaded = true;
        clearTimeout(hideSpinnerAfter5Seconds);
        clearTimeout(showErrorMessageAfter10Seconds);
        $('#loader').fadeOut();
    });

    // Manejar clics en el botón de continuar
    $('#continueButton').on('click', function() {
        $('#errorMessage').fadeOut();
    });

    // Manejar errores de carga de recursos
    $(document).ajaxError(function(event, jqxhr, settings, exception) {
        hasError = true;
    });

    // Manejar errores de carga de imágenes
    $('img').on('error', function() {
        hasError = true;
    });
});
