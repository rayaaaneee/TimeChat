const img = document.querySelector('.choose-img-container img');
const fileInput = document.querySelector('.input-container input[type="file"]');

const openFile = () => {
    fileInput.click();
}

fileInput.addEventListener('change', (e) => {
    img.src = URL.createObjectURL(e.target.files[0]);
});