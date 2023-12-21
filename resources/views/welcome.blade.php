<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }


        .container {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .text-box {
            background-color: rgba(0, 0, 0, 0.7); 
            padding: 28px;
            border-radius: 10px;
            color: #fff; 
            backdrop-filter: blur(10px); 
        }

        .titre {
            font-family: 'Avantgarde', 'TeX Gyre Adventor', 'URW Gothic L', sans-serif;
            color: c40404#;
            font-style: italic;
        }

        .sous-titre {
            font-family: 'Avantgarde', 'TeX Gyre Adventor', 'URW Gothic L', sans-serif;
            font-style: italic;
        }

        .bouton {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #c40404;
            color: #fff; 
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .bouton:hover {
            background-color: #000000;
        }
        body {
            background-image: url("{{ asset('assets/img/quali2.jpg') }}");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
        }
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container">
        <div class="text-box">
            <h1 class="titre">VOTRE PONT VERS LE SUCCÉS</h1>
            <p class="sous-titre">QUALIBRIDGE Consulting</p>
            <a href="login" class="bouton">Connexion</a>
            <a href="https://qualibridge.com/pages/qui-sommes-nous-cabinet-de-conseil/" class="bouton">Qui sommes-nous ?</a>
        </div>
    </div>
</body>
</html>
