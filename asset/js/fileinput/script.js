const img = document.querySelector('.choose-img-container img');
const fileInput = document.querySelector('.input-container input[type="file"]');
const extensionsAllowed = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'ico', 'webp'];

const openFile = () => {
    fileInput.click();
}

fileInput.addEventListener('change', (e) => {
    if (e.target.files.length === 0) return;
    const file = e.target.files[0];
    const extension = file.name.split('.').pop().toLowerCase();
    if (extensionsAllowed.includes(extension)) {
        img.src = URL.createObjectURL(e.target.files[0]);
    }
});