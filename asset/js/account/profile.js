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
        imageTop.src = './asset/img/page/account/public-top.png';
    } else {
        imageTop.src = './asset/img/page/account/private-top.png';
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

/* On scroll dans banner-container en X si l'utilisateur clique sur les fleches */

const formContainer = document.querySelector('.theme-form-container');
const bannerContainer = formContainer.querySelector('.banners');
/* Recuperer la largeur du container de la banniere en comptant le scrollable */
const bannerContainerWidth = bannerContainer.scrollWidth - bannerContainer.clientWidth;
const arrows = {
    "left" : formContainer.querySelector('.button-scroll-left'),
    "right" : formContainer.querySelector('.button-scroll-right')
};
var bannerContainerScrollX = 0;
const scrollGap = bannerContainerWidth / 2;

function displayOrHideArrows() {
    if (bannerContainerScrollX === 0) {
        arrows.right.classList.remove('display');
        arrows.right.classList.add('hidden');
    } else {
        arrows.right.classList.remove('hidden');
        arrows.right.classList.add('display');
    }

    if (bannerContainerScrollX === bannerContainerWidth) {
        arrows.left.classList.remove('display');
        arrows.left.classList.add('hidden');
    } else {
        arrows.left.classList.remove('hidden');
        arrows.left.classList.add('display');
    }
}

arrows.left.addEventListener('click', () => {
    if (bannerContainerScrollX + scrollGap > bannerContainerWidth) {
        bannerContainerScrollX = bannerContainerWidth;
    } else {
        bannerContainerScrollX += scrollGap;
    }
    bannerContainer.scroll(bannerContainerScrollX, 0);
    displayOrHideArrows();
});

arrows.right.addEventListener('click', () => {
    if (bannerContainerScrollX - scrollGap < 0) {
        bannerContainerScrollX = 0;
    } else {
        bannerContainerScrollX -= scrollGap;
    }
    bannerContainer.scroll(bannerContainerScrollX, 0);
    displayOrHideArrows();
});