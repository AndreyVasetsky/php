let catalog = document.getElementById('catalog');

catalog.addEventListener("click", (e) => {

    if (e.target.tagName === 'IMG') {

        let imgId = e.target.dataset.id;

        console.log("щелчек на картинке");

        document.location.href = `?page=3&id=${imgId}`;
    }

});