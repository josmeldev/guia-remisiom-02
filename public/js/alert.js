document.addEventListener("DOMContentLoaded", function() {
    // Obtener el botón de "Consultar" para el agricultor
    var consultarBtnAgricultor = document.getElementById('consultarBtn');

    // Obtener el botón de "Consultar" para el transportista
    var consultarBtnTransportista = document.getElementById('consultarBtnRemTransport');

    // Agregar un evento de clic al botón de "Consultar" del agricultor
    consultarBtnAgricultor.addEventListener('click', function() {
        verificarRuc('rucInput');
    });

    // Agregar un evento de clic al botón de "Consultar" del transportista
    consultarBtnTransportista.addEventListener('click', function() {
        verificarRuc('rucRemTransport');
    });

    // Función para verificar el RUC
    function verificarRuc(inputId) {
        // Obtener el valor del RUC ingresado
        var rucInput = document.getElementById(inputId);
        var rucValue = rucInput.value.trim();

        // Verificar si se ingresó un RUC
        if (rucValue !== '') {
            // Realizar una solicitud AJAX para verificar si el RUC está registrado
            fetch('/verificar-ruc?ruc=' + rucValue)
                .then(response => response.json())
                .then(data => {
                    if (!data.registrado) {
                        // Si el RUC no está registrado, mostrar una alerta al usuario
                        alert('El RUC no está registrado. Por favor, regístrelo antes de continuar.');
                        // Limpiar el campo de entrada y enfocarlo para facilitar la corrección
                        rucInput.value = '';
                        rucInput.focus();
                    }
                })
                .catch(error => {
                    console.error('Error al verificar el RUC:', error);
                });
        } else {
            // Si no se ingresó un RUC, mostrar una alerta al usuario
            alert('Por favor, ingrese un RUC antes de consultar.');
        }
    }
});
