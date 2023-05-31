const hearts = document.getElementsByClassName("meme-favorite-button");

for (const heart of hearts) {
    heart.addEventListener("click", () => {
        const data = heart.dataset.memeId;

        fetch("/favoritesAction", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then((response) => {
            return response.json()
        }).then((result) => {
            heart.style.color = result;
        });
    });
}

