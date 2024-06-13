document.addEventListener('DOMContentLoaded', function () {
    const clickableImages = document.querySelectorAll('.selected-img');
    const displayedImage = document.getElementById('displayed-image');

    clickableImages.forEach(image => {
        image.addEventListener('click', function () {
            displayedImage.src = this.src;
        });
    });
    const audioInput = document.getElementById('Build-audio');
    const audioPreview = document.getElementById('audio-preview');
    const audioSource = audioPreview.querySelector('source');

    audioInput.addEventListener('change', function () {
        const file = audioInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                audioSource.src = e.target.result;
                audioPreview.load();
            };
            reader.readAsDataURL(file);
        }
    });
});

