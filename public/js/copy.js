document.addEventListener("DOMContentLoaded", function() {
    const botonesCopiarTransportista = document.querySelectorAll('#exampleModal .boton-copiar');
    const botonesCopiarAgricultor = document.querySelectorAll('#ModalRucAgricultor .boton-copiar');
    const mensajeCopiadoTransportista = document.getElementById('copiadoMensajeTransportista');
    const mensajeCopiadoAgricultor = document.getElementById('copiadoMensajeAgricultor');

    botonesCopiarTransportista.forEach(boton => {
        boton.addEventListener('click', function() {
            const fila = this.closest('tr');
            const ruc = fila.querySelector('.ruc-transportista').innerText.trim();
            
            navigator.clipboard.writeText(ruc)
                .then(() => {
                    console.log('RUC de transportista copiado al portapapeles: ' + ruc);
                    mostrarMensajeCopiadoTransportista();
                })
                .catch(err => {
                    console.error('Error al copiar el RUC del transportista: ', err);
                });
        });
    });

    botonesCopiarAgricultor.forEach(boton => {
        boton.addEventListener('click', function() {
            const fila = this.closest('tr');
            const ruc = fila.querySelector('.ruc-agricultor').innerText.trim();
            
            navigator.clipboard.writeText(ruc)
                .then(() => {
                    console.log('RUC de agricultor copiado al portapapeles: ' + ruc);
                    mostrarMensajeCopiadoAgricultor();
                })
                .catch(err => {
                    console.error('Error al copiar el RUC del agricultor: ', err);
                });
        });
    });

    function mostrarMensajeCopiadoTransportista() {
        if (mensajeCopiadoAgricultor.style.display === 'block') {
            mensajeCopiadoAgricultor.style.display = 'none';
        }
        mensajeCopiadoTransportista.style.display = 'block';
        setTimeout(function() {
            mensajeCopiadoTransportista.style.display = 'none';
        }, 1500); // Ocultar el mensaje después de 1.5 segundos
    }

    function mostrarMensajeCopiadoAgricultor() {
        if (mensajeCopiadoTransportista.style.display === 'block') {
            mensajeCopiadoTransportista.style.display = 'none';
        }
        mensajeCopiadoAgricultor.style.display = 'block';
        setTimeout(function() {
            mensajeCopiadoAgricultor.style.display = 'none';
        }, 1500); // Ocultar el mensaje después de 1.5 segundos
    }
});
