
// c
const botonStock = document.querySelector('#btnStock');

const botonPedido = document.querySelector('#btnPedido');
// d
const sectionStock = document.querySelector('#opcionesStock');

const sectionPedido = document.querySelector('#opcionesPedido');
//   e

function showStock(){
    sectionStock.style.display = "block";
    sectionPedido.style.display = "none";
}

function showPedido(){
    sectionStock.style.display = "none";
    sectionPedido.style.display = "block";
}

 
// g
botonStock.addEventListener('click', showStock);

botonPedido.addEventListener('click', showPedido);
