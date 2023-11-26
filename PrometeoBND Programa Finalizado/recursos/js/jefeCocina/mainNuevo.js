// a
const botonDieta = document.querySelector('#btnDieta');

const botonPlato = document.querySelector('#btnPlato');

// const botonMenu = document.querySelector('#btnMenu');
// b
const sectionDieta = document.querySelector('#opcionesDieta');

const sectionPlato = document.querySelector('#opcionesPlato');

// const sectionMenu = document.querySelector('#opcionesMenu');

// c

//   e
  function showDieta(){
      sectionDieta.style.display = "block";
      sectionPlato.style.display = "none";
      sectionMenu.style.display = "none";
  }

function showPlato(){
    sectionDieta.style.display = "none";
    sectionPlato.style.display = "block";
    sectionMenu.style.display = "none";
}

// function showMenu(){
//     sectionDieta.style.display = "none";
//     sectionPlato.style.display = "none";
//     sectionMenu.style.display = "block";
// }
// f


 botonDieta.addEventListener('click', showDieta);

 botonPlato.addEventListener('click', showPlato);

//  botonMenu.addEventListener('click', showMenu);
// g

