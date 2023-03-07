const filename = document.querySelector('.input-container .filename');

fileInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    const extension = file.name.split('.').pop().toLowerCase();
    if (extensionsAllowed.includes(extension)) {
        filename.innerHTML = file.name;
    }
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

/* On change l'image de la banniere en fonction des images que rentre l'utilisateur */

const banner = document.querySelector('.active-theme .profile-banner');
const fileInputBanner = document.querySelector('#banner-input');
const changeImgText = document.querySelector('.choose-img-container-banner .browse-files-banner');
const bannernameText = document.querySelector('.choose-img-container-banner .filename');
const buttonSubmitBanner = document.querySelector('.choose-img-container-banner input[type="submit"]');

fileInputBanner.addEventListener('change', (e) => {
    const file = e.target.files[0];
    const extension = file.name.split('.').pop().toLowerCase();

    if (extensionsAllowed.includes(extension)) {
        if (file.name.length > 20) {
            bannernameText.innerHTML = file.name.substring(0, 20) + '...';
        } else {
            bannernameText.innerHTML = file.name;
        }
        buttonSubmitBanner.disabled = false;
        changeImgText.innerHTML = 'Choose banner';
        banner.src = URL.createObjectURL(file);
    }
});

changeImgText.addEventListener('click', () => {
    fileInputBanner.click();
});