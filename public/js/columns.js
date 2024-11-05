$(document).ready(function() {
    // Función para mostrar/ocultar columnas según los checkboxes seleccionados
    function toggleColumns() {
        $('.column-checkbox').each(function() {
            var columnId = $(this).val();
            var columnIndex = $('#guia-table th#' + columnId).index(); // Obtener el índice de la columna
            if ($(this).prop('checked')) {
                $('#guia-table th#' + columnId).show(); // Mostrar la cabecera de la columna
                $('#guia-table td:nth-child(' + (columnIndex + 1) + ')').show(); // Mostrar todas las celdas de datos de la columna
            } else {
                $('#guia-table th#' + columnId).hide(); // Ocultar la cabecera de la columna
                $('#guia-table td:nth-child(' + (columnIndex + 1) + ')').hide(); // Ocultar todas las celdas de datos de la columna
            }
        });
    }

    // Función para seleccionar/deseleccionar todos los checkboxes
    $('#select-all-checkbox').change(function() {
        var isChecked = $(this).prop('checked');
        $('.column-checkbox').prop('checked', isChecked);
        toggleColumns(); // Aplicar cambios al seleccionar/deseleccionar todos
    });

    // Llama a la función toggleColumns al cargar la página para mostrar las columnas predeterminadas
    toggleColumns();

    // Asignar la función toggleColumns al evento change de los checkboxes individuales
    $('.column-checkbox').change(function() {
        toggleColumns();
    });
});
