document.addEventListener('DOMContentLoaded', function() {
    if (!window.location.pathname.includes('edit-profile')) {
        return;
    }
    const inputUsername = document.getElementById('profile-right-cont-username');
    const inputUsernameBtn = document.getElementById('profile-right-cont-username-btn');
    const inputEmail = document.getElementById('profile-right-cont-email');
    const inputEmailBtn = document.getElementById('profile-right-cont-email-btn');

    function toggleButton(input, button) {
        if (input.value.trim() !== '') {
            button.disabled = false;
            button.classList.remove('disabled-btn');
        } else {
            button.disabled = true;
            button.classList.add('disabled-btn');
        }
    }
    inputUsername.addEventListener('input', () => toggleButton(inputUsername, inputUsernameBtn));
    inputEmail.addEventListener('input', () => toggleButton(inputEmail, inputEmailBtn));

});

document.addEventListener('DOMContentLoaded', ()=> {
    const addProductButton = document.getElementById('profile-right-cont-add-product-button');
    const addProductWindow = document.getElementById('profile-add-good-cont-overlay'); 
    addProductButton.addEventListener('click', function() {
        addProductWindow.style.display = 'block';
    });
});