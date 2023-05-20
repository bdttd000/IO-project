const heart = document.getElementById("meme-favorite-button");

heart.addEventListener("click", () => {
    if (heart.innerHTML == '\u2661') {
        heart.innerHTML = '\u2665';
    } else {
        heart.innerHTML = '\u2661';
        }
});