const allButtons = document.getElementsByClassName('like-button');

if (allButtons) {
    for (const button of allButtons) {
        button.addEventListener('click', () => {
            const data = [button.dataset.likesAction, button.dataset.memeId];
    
            fetch("/likesAction", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then((response) => {
                return response.json()
            }).then((result) => {
                const counter = document.querySelector('h3[data-meme-id="' + data[1] + '"]');
                counter.innerHTML = parseInt(counter.innerHTML) + result;
            });
        })
    }
}

