# URL Dynamiques :

// Q : Si l'utilisateur va dans l'url (nous sommes dans le dossier profil) et qu'il tape l'url suivante : http://localhost:8888/profil/{id} (avec {id} un nombre), comment faire pour récupérer l'id de l'utilisateur ?
// R : On va utiliser la superglobale $\_GET pour récupérer l'id de l'utilisateur. On va donc utiliser la fonction filter_input() pour récupérer l'id de l'utilisateur. On va ensuite utiliser la fonction intval() pour convertir la valeur en entier. On va ensuite utiliser la fonction isset() pour vérifier si l'id de l'utilisateur existe. Si l'id de l'utilisateur n'existe pas, on va rediriger l'utilisateur vers la page d'accueil. On va ensuite utiliser la fonction header() pour rediriger l'utilisateur vers la page d'accueil. On va ensuite utiliser la fonction exit() pour arrêter l'exécution du script.
// Q : Quel code correspond à ca ?
// R : <?php
// $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
SW

## Modifier app/verifyPassword.php et changer la valeur de minLength en 8

## Carousel Accueil : Animation du logo clock du temps qui passe

## Ajouter un systeme de noms pour les utilisateurs en plus des @

## Supprimer son compte
