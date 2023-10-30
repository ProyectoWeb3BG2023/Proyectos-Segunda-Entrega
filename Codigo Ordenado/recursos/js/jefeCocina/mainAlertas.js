
// c para cambiar todo esto:
const botonStockFaltante = document.querySelector('#btnStockFaltante');

const botonMeta = document.querySelector('#btnMeta');
// d
const sectionStockFaltante = document.querySelector('#opcionesStockFaltante');

const sectionMeta = document.querySelector('#opcionesMeta');
//   e

function showStockFaltante(){
    sectionStockFaltante.style.display = "block";
    sectionMeta.style.display = "none";
}

function showMeta(){
    sectionStockFaltante.style.display = "none";
    sectionMeta.style.display = "block";
}

 
// g
botonStockFaltante.addEventListener('click', showStockFaltante);

botonMeta.addEventListener('click', showMeta);
