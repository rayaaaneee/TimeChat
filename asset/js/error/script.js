// Si c'est nul on ne met pas de message d'erreur

let message = document.querySelector('.message-container');
let cross = message.querySelector('.cross-container');

if (message) {
    $crossClicked = false;

    cross.addEventListener('click', () => {
        message.classList.add('fade-out');
        $crossClicked = true;
        setTimeout(() => {
            message.remove();
        }, 200);
    });

    setTimeout(() => {
        if (!$crossClicked) {
            message.classList.add('fade-out');
            setTimeout(() => {
                message.remove();
            }, 200);
        }
    }, 5000);
}