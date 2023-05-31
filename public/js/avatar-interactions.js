const avatarInput = document.getElementById('avatar-input');
const avatarPreview = document.getElementById('avatar-preview');
const changeAvatarButton = document.querySelector(".custom-avatar-input button");
const avatarWrapper = document.querySelector(".avatar-wrapper");
const textarea = document.getElementById('edit-profile-textarea');

textarea.addEventListener('input', function(event) {
    textarea.style.height = 'auto';
    textarea.style.height = `${textarea.scrollHeight}px`;
});

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