const addCommentButton = document.querySelector('button[type="submit"]');
const commentInput = document.querySelector('input[name="comment"]');
const commentMemeId = document.querySelector('[data-meme-id]').dataset.memeId;
const template = document.querySelector('#meme-comment');
const commentsSection = document.getElementById('comments-section');

addCommentButton.addEventListener('click', () => {
    if (commentInput.value.length < 1) {
        alert('Komentarz nie może być pusty');
        return;
    }

    const data = [commentMemeId, commentInput.value];
    
    fetch("/validateComment", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then((response) => {
        return response.json()
    }).then((result) => {
        if (!result['commentid']) return;

        const clone = template.content.cloneNode(true);

        const image = clone.querySelector('img');
        const src = result['useravatar'] ?? 'unknown.png';
        image.src = `public/uploads/avatars/${src}`;

        const nickname = clone.querySelector('.comment-user-name > h4');
        nickname.innerHTML = result['usernickname'];

        const date = clone.querySelector('.comment-meme-date > h4');
        date.innerHTML = result['creationdate'];

        const p = clone.querySelector('p');
        p.innerHTML = result['content'];

        commentsSection.appendChild(clone);
    });
})