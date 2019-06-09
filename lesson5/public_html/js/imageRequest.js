let gallery = document.getElementById('gallery');

gallery.addEventListener("click", (e) => {

    if (e.target.tagName === 'IMG') {

        let imgId = e.target.dataset.id;

        document.location.href = `2.php?imgId=${imgId}`;
    }

});

