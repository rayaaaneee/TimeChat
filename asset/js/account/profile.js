const filename = document.querySelector('.input-container .filename');

fileInput.addEventListener('change', (e) => {
    filename.innerHTML = e.target.files[0].name;
});

const privacyAnimationContainer = document.querySelector('.privacy-animation-container');
const imageTop = privacyAnimationContainer.querySelector('.image-top');
const inputPrivacy = document.querySelector('.privacy-input-container input[type="checkbox"]');

inputPrivacy.addEventListener('change', (e) => {
    /* On rajoute la classe checked au container de l'animation */
    privacyAnimationContainer.classList.add('checked');
    setTimeout(() => {
        privacyAnimationContainer.classList.remove('checked');
    }, 800);

    /* On change l'image en fonction de l'état du checkbox */
    if (e.target.checked) {
        imageTop.src = './asset/img/account/public-top.png';
    } else {
        imageTop.src = './asset/img/account/private-top.png';
    }
});