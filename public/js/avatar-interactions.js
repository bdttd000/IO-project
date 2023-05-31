const avatarInput = document.getElementById('avatar-input');
const avatarPreview = document.getElementById('avatar-preview');
const changeAvatarButton = document.querySelector(".custom-avatar-input button");
const avatarWrapper = document.querySelector(".avatar-wrapper");

changeAvatarButton.addEventListener("click", function(event) {
    event.preventDefault();
    avatarInput.click();
});

avatarInput.addEventListener('change', () => {
    const file = avatarInput.files[0];
    const reader = new FileReader();

    reader.onload = function(event) {
        avatarWrapper.querySelector("img.avatarProfile").src = event.target.result;
        avatarPreview.style.display = 'none';
        avatarWrapper.style.display = "block";
        
    }

    reader.readAsDataURL(file);
});