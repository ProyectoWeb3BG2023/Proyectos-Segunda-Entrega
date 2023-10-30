const openModals = document.querySelectorAll('.modalOpen');
const modal = document.querySelector('.modal');
const closeModal = document.querySelector('.modal__close');


openModals.forEach(openModal => {
    openModal.addEventListener('click', (e)=>{
        e.preventDefault();
        modal.classList.add('modal--show');
    });
});

closeModal.addEventListener('click', (e)=>{
    e.preventDefault();
    modal.classList.remove('modal--show');

});