const memeInput = document.getElementById('meme-input');
const memePreview = document.getElementById('meme-preview');

memeInput.addEventListener('change', () => {
    const file = memeInput.files[0];
    const reader = new FileReader();

    reader.onload = function(event) {
        memePreview.setAttribute('src', event.target.result);
        memePreview.style.display = 'block';
    }

    reader.readAsDataURL(file);
})