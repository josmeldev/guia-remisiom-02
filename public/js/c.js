// Obtener los elementos del formulario y las secciones
var form = document.getElementById("myForm");
var sections = document.querySelectorAll('.section');
var prevBtns = document.querySelectorAll('.prev-btn');
var nextBtns = document.querySelectorAll('.next-btn');
var resetBtn = document.getElementById("resetBtn");
var progressBar = document.getElementById("myProgressBar");
var successMessage = document.getElementById("successMessage");


// Contadores de campos completados por sección
var completedFields = [0, 0, 0];

// Función para mostrar la sección actual y ocultar las demás
function showSection(index) {
  sections.forEach(function(section, i) {
    if (i === index) {
      section.classList.remove('d-none');
    } else {
      section.classList.add('d-none');
    }
  });
}





// Función para manejar el evento de clic en el botón "Next"
function handleNextBtnClick(event) {
  var currentSection = event.target.closest('.section');
  var currentIndex = Array.from(sections).indexOf(currentSection);
  showSection(currentIndex + 1);

  // Actualizar la barra de progreso
  updateProgressBar();
}

// Función para mostrar el mensaje de éxito
function showSuccessMessage() {
    successMessage.classList.remove('d-none');
  }


// Función para manejar el evento de clic en el botón "Prev"
function handlePrevBtnClick(event) {
  var currentSection = event.target.closest('.section');
  var currentIndex = Array.from(sections).indexOf(currentSection);
  showSection(currentIndex - 1);

  // Actualizar la barra de progreso
  updateProgressBar();
}



// Función para actualizar la barra de progreso
function updateProgressBar() {
    var totalCompleted = completedFields.reduce((a, b) => a + b, 0); // Sumar campos completados en todas las secciones
    var totalFields = 0;
    sections.forEach(function(section) {
      totalFields += section.querySelectorAll('input[type="text"], input[type="email"], input[type="date"], select').length;
    });

    var progress = (totalCompleted / totalFields) * 100;
    progressBar.style.width = progress + '%';
    progressBar.innerHTML = progress.toFixed(2) + '%';
  }


// Agregar eventos de clic a los botones "Next" y "Prev"
nextBtns.forEach(function(btn) {
  btn.addEventListener('click', handleNextBtnClick);
});

prevBtns.forEach(function(btn) {
  btn.addEventListener('click', handlePrevBtnClick);
});

// Agregar evento de cambio a los campos de entrada
document.querySelectorAll('input[type="text"], input[type="email"],input[type="date"], select').forEach(function(input) {
  input.addEventListener('change', function(event) {
    var currentSection = event.target.closest('.section');
    var currentIndex = Array.from(sections).indexOf(currentSection);
    if (event.target.value.trim() === '') {
        completedFields[currentIndex] = Math.max(completedFields[currentIndex] - 1, 0); // Restar 1 si el campo está vacío
    } else {
        completedFields[currentIndex] = completedFields[currentIndex] + 1; // Incrementar el contador de campos completados
    }
    updateProgressBar(); // Actualizar la barra de progreso
  });
});

// Agregar evento al envío del formulario
form.addEventListener('submit', function(event) {
  event.preventDefault(); // Evitar el envío del formulario por defecto
  showSuccessMessage(); // Mostrar el mensaje de éxito
});

// Mostrar la primera sección al cargar la página
showSection(0);

function resetProgressBar() {
    completedFields.fill(0); // Restablecer todos los contadores de campos completados
    updateProgressBar(); // Actualizar la barra de progreso
  }
  resetBtn.addEventListener('click', function(event) {
    resetProgressBar(); // Reiniciar la barra de progreso
  });


