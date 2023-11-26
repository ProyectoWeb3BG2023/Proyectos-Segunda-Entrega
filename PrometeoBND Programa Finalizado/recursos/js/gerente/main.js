
function mostrarOpciones(opcion) {

    var opcionesDieta = document.getElementById("opcionesDieta");
    var opcionesPlato = document.getElementById("opcionesPlato");
    var opcionesMenu = document.getElementById("opcionesMenu");
    var opcionesMeta = document.getElementById("opcionesMeta");
    if (opcion === "dieta") {
        opcionesDieta.style.display = "block";
        opcionesPlato.style.display = "none";
        opcionesMenu.style.display = "none";
        opcionesMeta.style.display = "none";
    } else if ( opcion === "plato") {
        opcionesDieta.style.display = "none";
        opcionesPlato.style.display = "block";
        opcionesMenu.style.display = "none";
        opcionesMeta.style.display = "none";
    } else if ( opcion === "menu") {
        opcionesDieta.style.display = "none";
        opcionesPlato.style.display = "none";
        opcionesMenu.style.display = "block";
        opcionesMeta.style.display = "none";
    } else if ( opcion === "meta") {
        opcionesDieta.style.display = "none";
        opcionesPlato.style.display = "none";
        opcionesMenu.style.display = "none";
        opcionesMeta.style.display = "block";
    }
 }

function mostrarOpcionesGestion(opcion) {
    var opcionesStock = document.getElementById("opcionesStock");
    var opcionesPedido = document.getElementById("opcionesPedido");
    if (opcion === "stock") {
        opcionesStock.style.display = "block";
        opcionesPedido.style.display = "none";
    } else {
        opcionesStock.style.display = "none";
        opcionesPedido.style.display = "block";
    } 
}

function mostrarOpcionesAlerta(opcion) {
    var opcionesStockF = document.getElementById("opcionesStockF");
    var opcionesMetas = document.getElementById("opcionesMeta");
    if (opcion === "stockF") {
        opcionesStockF.style.display = "block";
        opcionesMetas.style.display = "none";
    } else {
        opcionesStockF.style.display = "none";
        opcionesMetas.style.display = "block";
    } 
}


