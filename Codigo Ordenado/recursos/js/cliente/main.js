function mostrarOpciones(opcion) {

    var opcionesWeb = document.getElementById("opcionesWeb");
    var opcionesEmpresa = document.getElementById("opcionesEmpresa");
    
    if (opcion === "web") { 
        opcionesWeb.style.display = "block";
        opcionesEmpresa.style.display = "none";

    } else if (opcion === "empresa") {
        opcionesWeb.style.display = "none";
        opcionesEmpresa.style.display = "block";
    }

}
