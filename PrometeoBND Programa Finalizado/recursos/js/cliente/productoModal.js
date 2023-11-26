const openModals = document.querySelectorAll('.modalOpen');
const modal = document.querySelector('.modal');
const closeModal = document.querySelector('.modal__close');


openModals.forEach(openModal => {
    openModal.addEventListener('click', (e) => {
        e.preventDefault();
        const menuId = openModal.getAttribute('data-menu-id'); // Obtén el data-menu-id del elemento

        fetch(`menusModal.php?id=${menuId}`)
            .then(response => response.text()) 
            .then(data => {
                modal.innerHTML = data;
                modal.classList.add('modal--show');
            })
            .catch(error => {
                console.error('Error al cargar los detalles del menú:', error);
            });
    });
});

closeModal.addEventListener('click', (e) => {
    e.preventDefault();
    modal.classList.remove('modal--show');
});