document.addEventListener("DOMContentLoaded", function() {
    // Función para manejar la búsqueda
    function manejarBusqueda(inputId, tablaId) {
        const input = document.getElementById(inputId);
        const tabla = document.getElementById(tablaId);
        const rows = tabla.querySelectorAll("tbody tr");

        input.addEventListener("input", function() {
            const textoBusqueda = this.value.toLowerCase().trim();

            rows.forEach(row => {
                const cells = row.querySelectorAll("td");
                let coincide = false;

                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(textoBusqueda)) {
                        coincide = true;
                    }
                });

                if (coincide) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    }

    // Llamar a la función para cada tabla con sus inputs de búsqueda
    manejarBusqueda("busqueda", "tablaPagosPasados");
    manejarBusqueda("busquedaP", "tablaPagosPresentes");
    manejarBusqueda("busquedaF", "tablaPagosFuturos");
});