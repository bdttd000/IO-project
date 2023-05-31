    const loginForm = document.getElementById('login-form');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const emailInput = document.querySelector('input[name="email"]');
        const passwordInput = document.querySelector('input[name="password"]');

        if (emailInput.value.trim() === '') {
            alert('Wprowadź adres email.');
            return;
        }

        if (passwordInput.value.trim() === '') {
            alert('Wprowadź hasło.');
            return;
        }

        loginForm.submit();
    });