const registrationForm = document.getElementById('registration-form');
const nicknameInput = document.querySelector('input[name="nickname"]');
const emailInput = document.querySelector('input[name="email"]');
const passwordInput = document.querySelector('input[name="password"]');
const password2Input = document.querySelector('input[name="password2"]');

registrationForm.addEventListener('submit', function(event) {
  event.preventDefault();
  
  if (nicknameInput.value.trim() === '') {
    alert('Proszę wprowadzić nickname.');
    return;
  }
  
  const emailRegex = /^\S+@\S+\.\S+$/;
  if (!emailRegex.test(emailInput.value)) {
    alert('Proszę wprowadzić poprawny adres email.');
    return;
  }
  
  if (passwordInput.value.trim() === '') {
    alert('Proszę wprowadzić hasło.');
    return;
  }

  if (passwordInput.value.length < 6) {
    alert('Hasło musi mieć co najmniej 6 znaków.');
    return;
  }
  
  if (passwordInput.value !== password2Input.value) {
    alert('Podane hasła nie są identyczne.');
    return;
  }
  
  registrationForm.submit();
});

passwordInput.addEventListener('input', function() {
  const password = passwordInput.value;
  
  if (password.length < 6) {
    passwordInput.classList.add('input-error');
  } else {
    passwordInput.classList.remove('input-error');
  }
});

nicknameInput.addEventListener('input', function() {
    const nickname = nicknameInput.value;
    
    if (nickname.length < 3) {
      nicknameInput.classList.add('input-error');
    } else {
      nicknameInput.classList.remove('input-error');
    }
  });
  
  password2Input.addEventListener('input', function() {
    const password = passwordInput.value;
    const password2 = password2Input.value;
    
    if (password2.length < 6 || password !== password2) {
      password2Input.classList.add('input-error');
    } else {
      password2Input.classList.remove('input-error');
    }
  });

  emailInput.addEventListener('input', function() {
    const email = emailInput.value;
    const emailRegex = /^\S+@\S+\.\S+$/;
    
    if (!emailRegex.test(email)) {
      emailInput.classList.add('input-error');
    } else {
      emailInput.classList.remove('input-error');
    }
  });