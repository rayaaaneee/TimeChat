const usernameHTML = document.getElementById('username-text');
const username = usernameHTML.textContent.length;

// On modifie la valeur de la variable css --length-username 

let html = document.documentElement;

console.log(usernameHTML);
console.log(username);

html.style.setProperty('--length-username', username);