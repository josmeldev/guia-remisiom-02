function mostrarCamposAdicionales() {
    var metodoPago = document.getElementById("metodo_pago").value;
    var campoNumeroOperacion = document.getElementById("campoNumeroOperacion");
    var tipoPagoElectronicoDiv = document.getElementById("tipoPagoElectronico");
    var campoMonto = document.getElementById("campoMonto");

    // Ocultar todos los campos adicionales
    campoNumeroOperacion.style.display = "none";
    tipoPagoElectronicoDiv.style.display = "none";
    campoMonto.style.display = "none";

    // Mostrar los campos adicionales según el método de pago seleccionado
    if (metodoPago === "Transferencias bancarias" || metodoPago === "Pagos electrónicos") {
        campoNumeroOperacion.style.display = "block";
    }

    if (metodoPago === "Pagos electrónicos") {
        tipoPagoElectronicoDiv.style.display = "block";
    }

    // Mostrar el campo de monto siempre
    campoMonto.style.display = "block";
}


