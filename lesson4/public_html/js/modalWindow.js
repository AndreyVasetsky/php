let modal = document.getElementById('modal');
let modalClose = document.getElementById('modal__close');
let modalContent = document.getElementById('modal__content');
let gallery = document.getElementById('gallery');

gallery.addEventListener("click", (e) => {

    if (e.target.tagName === 'IMG') {

        let cloneEl = e.target.cloneNode();

        modalContent.appendChild(cloneEl);
        modal.style.display = "flex";
    }

});

modalClose.addEventListener("click", () => {

    let currentImg = modalContent.querySelector('img');

    if (currentImg) currentImg.remove();

    modal.style.display = "none";
});
