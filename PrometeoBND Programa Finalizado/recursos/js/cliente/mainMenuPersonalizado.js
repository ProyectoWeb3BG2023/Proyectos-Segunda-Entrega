// a
const boton5 = document.querySelector('#btn5');

const boton10 = document.querySelector('#btn10');

const boton20 = document.querySelector('#btn20');
// b
const section5 = document.querySelector('#opciones5');

const section10 = document.querySelector('#opciones10');

const section20 = document.querySelector('#opciones20');

// c

//   e
  function show5(){
      section5.style.display = "block";
      section10.style.display = "none";
      section20.style.display = "none";
  }

function show10(){
    section5.style.display = "none";
    section10.style.display = "block";
    section20.style.display = "none";
}

function show20(){
    section5.style.display = "none";
    section10.style.display = "none";
    section20.style.display = "block";
}
// f


 boton5.addEventListener('click', show5);

 boton10.addEventListener('click', show10);

 boton20.addEventListener('click', show20);
// g

