function cambiarTipoFiltro() {
    var filtro = document.getElementById("filtro").value;
    var contenedorFecha = document.getElementById("contenedorFecha");
    var contenedorTexto = document.getElementById("contenedorTexto");

    if (filtro === "fecha") {
        contenedorFecha.style.display = "block";
        contenedorTexto.style.display = "none";
    } else {
        contenedorFecha.style.display = "none";
        contenedorTexto.style.display = "block";
    }
}

function limpiarCampos() {
// Restablecer valores de los campos de filtro
document.getElementById("filtro").selectedIndex = 0;
document.getElementById("fecha").value = "";
document.getElementById("texto").value = "";

// Mostrar todas las filas de la tabla
var tabla = document.getElementById('tablaGuias');
var filas = tabla.getElementsByTagName('tr');
for (var i = 1; i < filas.length; i++) {
    filas[i].style.display = '';
}
}

// Función para realizar el filtrado
document.getElementById('filtro').addEventListener('change', function() {
    cambiarTipoFiltro();
});

document.getElementById('texto').addEventListener('input', function() {
    filtrarTabla();
});

document.getElementById('fecha').addEventListener('input', function() {
    filtrarTabla();
});

function filtrarTabla() {
    var filtro = document.getElementById('filtro').value;
    var valorFiltro = filtro === 'fecha' ? document.getElementById('fecha').value.trim().toLowerCase() : document.getElementById('texto').value.trim().toLowerCase();
    var tabla = document.getElementById('tablaGuias');
    var filas = tabla.getElementsByTagName('tr');

    for (var i = 1; i < filas.length; i++) { // Empezamos desde 1 para omitir la fila de encabezado
        var filaVisible = false;
        var celdas = filas[i].getElementsByTagName('td');
        for (var j = 0; j < celdas.length; j++) {
            var textoCelda = celdas[j].innerText.toLowerCase();
            if (filtro === 'fecha') {
                // Filtrar por fecha si se selecciona el filtro de fecha
                if (textoCelda.includes(valorFiltro)) {
                    filaVisible = true;
                    break;
                }
            } else {
                // Filtrar por texto en caso contrario
                if (textoCelda.includes(valorFiltro)) {
                    filaVisible = true;
                    break;
                }
            }
        }
        // Mostrar u ocultar la fila según el resultado del filtro
        filas[i].style.display = filaVisible ? '' : 'none';
    }
}