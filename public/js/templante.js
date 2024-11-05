function toggleMenu() {
    var container = document.querySelector('.contenido');
    container.classList.toggle('menu-open');

    var sidebar = document.querySelector('.sidebar');
    var content = document.querySelector('.content'); // Corregido

    sidebar.classList.toggle('collapsed');
    content.classList.toggle('collapsed');
}


function toggleDropdown() {
  var dropdownMenu = document.getElementById("dropdownMenu");
  var dropdownIcon = document.getElementById("dropdownIcon");

  // Alternar la clase 'show' en el menú desplegable
  dropdownMenu.classList.toggle("show");

  // Alternar la clase 'bi-chevron-up' en el icono de flecha
  dropdownIcon.classList.toggle("bi-chevron-up");
}

$(document).ready(function() {
    // Obtiene la URL actual
    var currentLocation = window.location.href;

    // Itera sobre los enlaces del sidebar
    $('.sidebar a').each(function() {
        // Verifica si la URL del enlace coincide con la URL actual
        if (currentLocation.includes($(this).attr('href'))) {
            // Agrega la clase 'active' al enlace correspondiente
            $(this).addClass('active');
        }
    });
});


var sidebar = document.getElementById("sidebar");

sidebar.addEventListener("mouseenter", function() {
    sidebar.classList.add("show-scrollbar");
});

sidebar.addEventListener("mouseleave", function() {
    sidebar.classList.remove("show-scrollbar");
});


function toggleUserContent() {
    var userContent = document.getElementById("user-content");
    if (userContent.style.display === "none" || userContent.style.display === "") {
        userContent.style.display = "block";
    } else {
        userContent.style.display = "none";
    }
}

function showEmailLink() {
var paragraph = document.querySelector('.second-paragraph');
if (!paragraph.querySelector('a')) {
var emailLink = document.createElement('a');
emailLink.href = 'mailto:' + '{{ Auth::user()->email }}';
emailLink.textContent = 'Enviar correo';
paragraph.appendChild(emailLink);
}
}

function hideEmailLink() {
var paragraph = document.querySelector('.second-paragraph');
var emailLink = paragraph.querySelector('a');
if (emailLink) {
paragraph.removeChild(emailLink);
}
}

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $(document).on('click', 'a[href="{{ route("logout") }}"]', function(e) {
        e.preventDefault();
        $('#logout-form').submit();
    });
});


document.addEventListener('DOMContentLoaded', function() {
var userContent = document.getElementById('user-content');

// Mostrar el elemento cuando se hace clic en algo que lo activa
document.getElementById('activate-user').addEventListener('click', function() {
    userContent.style.display = 'flex';
});




});

// Ocultar el elemento cuando se hace clic fuera de él
document.addEventListener('click', function(event) {
    var userContent = document.getElementById("user-content");
    var button = document.getElementById("togglepro");
    if (userContent.style.display === "block" && !userContent.contains(event.target) && !button.contains(event.target)) {
        userContent.style.display = "none";
    }
});



//Notificaciones


document.addEventListener("DOMContentLoaded", function() {
    var notificationIcon = document.getElementById("notificationIcon");
    var notificationPopup = document.getElementById("notificationPopup");
    var notificationCount = document.getElementById("notificationCount");
    var notificationList = document.getElementById("notificationList");

    notificationIcon.addEventListener("click", function() {
        notificationPopup.classList.toggle("show");
        if (notificationPopup.classList.contains("show")) {
            notificationCount.style.display = "none";
        }
    });

    document.addEventListener("click", function(event) {
        if (!notificationPopup.contains(event.target) && !notificationIcon.contains(event.target)) {
            notificationPopup.classList.remove("show");
        }
    });
});


function borrarNotificacion(element) {
    element.parentElement.remove();
    var notificationList = document.getElementById("notificationList");
    if (notificationList.children.length === 0) {
        var notificationCount = document.getElementById("notificationCount");
        notificationCount.style.display = "block";
        notificationCount.innerText = "0"; // Resetear contador a cero
    }
}

function agregarNotificacion(mensaje) {
    var notificationList = document.getElementById("notificationList");
    var nuevaNotificacion = document.createElement("li");
    nuevaNotificacion.innerHTML = `${mensaje} <button class="btn btn-sm btn-danger ml-2" onclick="borrarNotificacion(this)">Borrar</button>`;
    notificationList.appendChild(nuevaNotificacion);
    var notificationCount = document.getElementById("notificationCount");
    notificationCount.style.display = "block";
    notificationCount.innerText = parseInt(notificationCount.innerText) + 1;
}


function toggleContent() {
    var content = document.getElementById("contes");
    if (content.style.display === "none" || content.style.display === "") {
        content.style.display = "block";
    } else {
        content.style.display = "none";
    }
}

document.addEventListener("click", function(event) {
    var content = document.getElementById("contes");
    var button = document.getElementById("toggleButton");
    if (content.style.display === "block" && !content.contains(event.target) && !button.contains(event.target)) {
        content.style.display = "none";
    }
});


//Other notifications

document.addEventListener("DOMContentLoaded", function() {
    var notificationIcon = document.getElementById("notificationIcon-l");
    var notificationPopup = document.getElementById("notificationPopup-l");
    var notificationCount = document.getElementById("notificationCount-l");
    var notificationList = document.getElementById("notificationList-l");

    notificationIcon.addEventListener("click", function() {
        notificationPopup.classList.toggle("show");
        if (notificationPopup.classList.contains("show")) {
            notificationCount.style.display = "none";
        }
    });

    document.addEventListener("click", function(event) {
        if (!notificationPopup.contains(event.target) && !notificationIcon.contains(event.target)) {
            notificationPopup.classList.remove("show");
        }
    });
});


function borrarNotificacion(element) {
    element.parentElement.remove();
    var notificationList = document.getElementById("notificationList-l");
    if (notificationList.children.length === 0) {
        var notificationCount = document.getElementById("notificationCount-l");
        notificationCount.style.display = "block";
        notificationCount.innerText = "0"; // Resetear contador a cero
    }
}


