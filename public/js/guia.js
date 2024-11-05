const sections = [
    document.getElementById('remitenteSection'),
    document.getElementById('destinatarioSection'),
    document.getElementById('envioSection')
    // Agrega aquí las demás secciones
];
const progressItems = document.querySelectorAll('.progress-item');
let currentSectionIndex = 0;

function showSection(index) {
    if (index >= 0 && index < sections.length) {
        sections[currentSectionIndex].classList.add('hidden');
        sections[index].classList.remove('hidden');
        progressItems[currentSectionIndex].classList.remove('active-progress');
        progressItems[currentSectionIndex].classList.add('completed-progress');
        progressItems[index].classList.add('active-progress');
        currentSectionIndex = index;
        updateProgressBar(); // Actualizar la barra de progreso al cambiar de sección
    }
}

function prevSection() {
    showSection(currentSectionIndex - 1);
}

function nextSection() {
    showSection(currentSectionIndex + 1);
}

// Agrega el resto del código JavaScript aquí...

const form = document.getElementById('guiaRemisionForm');

form.addEventListener('input', function() {
    const inputs = sections[currentSectionIndex].querySelectorAll('input, select, textarea');
    let isSectionValid = true;
    inputs.forEach(input => {
        if (!input.checkValidity()) {
            isSectionValid = false;
        }
    });
    if (isSectionValid && isSectionFullyFilled(currentSectionIndex)) {
        // Verificar si es la última sección
        if (currentSectionIndex === sections.length - 1) {
            showMessage('mensajeExito');
        } else {
            // Mostrar el mensaje correspondiente dependiendo de si la próxima sección está llena
            if (isSectionFullyFilled(currentSectionIndex + 1)) {
                showMessage('mensajeExito');
            } else {
                showMessage('mensajeSiguiente');
            }
            // Pasar a la siguiente sección automáticamente después de 3 segundos
            setTimeout(() => {
                showSection(currentSectionIndex + 1);
            }, 3000);
        }
    } else {
        showMessage('mensajeError');
    }
    updateProgressBar(); // Actualizar la barra de progreso al llenar un campo
});

function isSectionFullyFilled(index) {
    const inputs = sections[index].querySelectorAll('input, select');
    let isFilled = true;
    inputs.forEach(input => {
        if (input.value.trim() === '') {
            isFilled = false;
        }
    });
    return isFilled;
}

function showMessage(id) {
    const mensajeExito = document.getElementById('mensajeExito');
    const mensajeError = document.getElementById('mensajeError');

    // Ocultar ambos mensajes
    mensajeExito.style.display = 'none';
    mensajeError.style.display = 'none';

    if (id === 'mensajeExito') {
        // Mostrar mensaje de éxito
        mensajeExito.style.display = 'block';
        // Añadir clases de animación para la entrada
        mensajeExito.classList.add('animate__animated', 'animate__bounceInDown');

        // Quitar clases de animación después de 1.5 segundos
        setTimeout(() => {
            mensajeExito.classList.remove('animate__animated', 'animate__bounceInDown');
        }, 1500);
    } else if (id === 'mensajeError') {
        // Mostrar mensaje de error
        mensajeError.style.display = 'block';
    }
}

/// Función para calcular el progreso total del formulario
function calcularProgresoTotal() {
    const totalCampos = document.querySelectorAll('#guiaRemisionForm input, #guiaRemisionForm select').length;
    let camposCompletados = 0;

    // Contar el número de campos completados
    document.querySelectorAll('#guiaRemisionForm input, #guiaRemisionForm select').forEach(input => {
        if (input.value.trim() !== '') {
            camposCompletados++;
        }
    });

    // Calcular el progreso total como un porcentaje
    const progresoTotal = (camposCompletados / totalCampos) * 100;

    // Asegurarse de que el progreso total no exceda el 100%
    return Math.round(progresoTotal);
}

// Función para actualizar la barra de progreso
function updateProgressBar() {
    const progresoTotal = calcularProgresoTotal();

    // Actualizar el texto de porcentaje total en la última barra de progreso
    progressItems[sections.length - 1].innerText = `${progresoTotal}%`;

    // Actualizar las barras de progreso individualmente
    progressItems.forEach((item, i) => {
        if (i < sections.length) {
            if (i === currentSectionIndex) {
                item.style.width = `${progresoTotal}%`;
                item.classList.add('active-progress');
            } else if (i < currentSectionIndex) {
                item.style.width = '100%';
                item.classList.add('completed-progress');
            } else {
                item.style.width = '0%';
                item.classList.remove('active-progress');
                item.classList.remove('completed-progress');
            }
        }
    });
}

// Agregar evento input a todos los inputs y selects dentro de las secciones
sections.forEach((section, index) => {
    if (section) {
        const inputs = section.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                updateProgressBar(); // Actualizar la barra de progreso
            });
        });
    }
});

// Un div
document.addEventListener('DOMContentLoaded', function() {
    var toggleButton = document.getElementById('toggleButton');
    var overlayDiv = document.getElementById('overlayDiv');

    toggleButton.addEventListener('click', function(event) {
        event.stopPropagation(); // Evita que el evento se propague al documento
        var buttonRect = toggleButton.getBoundingClientRect();
        overlayDiv.style.top = (buttonRect.top + window.scrollY + toggleButton.offsetHeight) + 'px';
        overlayDiv.style.left = (buttonRect.left + window.scrollX) + 'px';
        if (overlayDiv.style.display === 'block') {
            overlayDiv.style.display = 'none';
        } else {
            overlayDiv.style.display = 'block';
        }
    });

    document.addEventListener('click', function() {
        overlayDiv.style.display = 'none';
    });

    overlayDiv.addEventListener('click', function(event) {
        event.stopPropagation(); // Evita que el evento se propague al documento
    });
});
