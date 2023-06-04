const memeInput = document.getElementById('meme-input');
const memePreview = document.getElementById('meme-preview');
const avatarButton = document.querySelector(".custom-meme-input button");

avatarButton.addEventListener("click", function(event) {
    event.preventDefault();
    memeInput.click();
});

memeInput.addEventListener('change', () => {
    const file = memeInput.files[0];
    const reader = new FileReader();

    reader.onload = function(event) {
        memePreview.setAttribute('src', event.target.result);
        memePreview.style.display = 'block';
    }

    reader.readAsDataURL(file);
});