// Actualizar días cuando se cambia el mes o el año
document.getElementById("mes").addEventListener("change", updateDays);
document.getElementById("anio").addEventListener("change", updateDays);

// Actualizar días al cargar la página
updateDays();

// Función para actualizar los días
function updateDays() {
    var year = document.getElementById("anio").value;
    var month = document.getElementById("mes").value;
    var daysInMonth = new Date(year, month, 0).getDate();

    var daysDropdown = document.getElementById("dia");
    daysDropdown.innerHTML = ""; // Limpiar opciones anteriores

    // Agregar nuevas opciones para los días
    for (var i = 1; i <= daysInMonth; i++) {
        var option = document.createElement("option");
        option.text = i;
        option.value = i;
        daysDropdown.add(option);
    }

    // Establecer el valor predeterminado del día en 1
    document.getElementById("dia").value = 1;
}

// Establecer valores predeterminados para la fecha actual
var currentDate = new Date();
document.getElementById("anio").value = currentDate.getFullYear();
document.getElementById("mes").value = currentDate.getMonth() + 1; // Los meses en JavaScript van de 0 a 11
updateDays(); // Actualizar los días para reflejar la fecha actual