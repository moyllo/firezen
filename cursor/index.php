<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NoName</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Honk&display=swap" rel="stylesheet">
    <style>
        /* CSS pour masquer le menu par défaut */
        .menu {
            display: none;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            position: fixed;
            top: 40%;
            left: 38%;
            width: 400px; /* Ajuster la largeur selon vos besoins */
        }

        /* CSS pour la boîte de fermeture */
        .close-button {
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
        }

		a, body {
            cursor: help;
        }

		.custom1 {
              font-family: "Honk", system-ui;
        }
        /* CSS pour la boîte autour des boutons du menu */
        .menu-box {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent pour l'arrière-plan */
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="content">
        <h1 id="clock">Clock</h1>
        <div class="buttons">
            <a href="#" class="button" id="toolsButton">Tools</a>
            <a href="/404" class="button">Soon</a>
            <a href="/contact" class="button">Contact</a>
        </div>
        <!-- Conteneur de la boîte autour des boutons du menu -->
        <div class="menu-box" id="toolsMenuBox">
            <!-- Conteneur du menu -->
            <div class="menu" id="toolsMenu">
                <span class="close-button" id="closeMenuButton" style="color: red; margin-right: 5px; cursor: crosshair;">✖</span>
        		<p class="custom1" style="size: 50%;">Chose your Tools from the list below.</p>
                <a href="/bot/" class="button" style="margin-top: 2%; margin-bottom: 2%; font-family: Luckiest Guy, cursive; font-size: 1.25em;">Bot Sender</a>
                <a href="/webhook/" class="button" style="margin-top: 2%; margin-bottom: 2%; font-family: Luckiest Guy, cursive; font-size: 1.25em;">Webhook</a>
                <a href="/bitcoin/miner/" class="button" style="margin-top: 2%; margin-bottom: 2%; font-family: Luckiest Guy, cursive; font-size: 1.25em;">Bitcoin Miner</a>
        
        <br><p style="font-size: 20px; color: red;">Soon:</p>
                <a href="/404/" class="button" style="margin-top: 2%; margin-bottom: 2%; font-family: Luckiest Guy, cursive; font-size: 1.25em; cursor: not-allowed;">TokenJoiner</a>
                <a href="/404/" class="button" style="margin-top: 2%; margin-bottom: 2%; font-family: Luckiest Guy, cursive; font-size: 1.25em; cursor: not-allowed;">Promo Gen</a>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
        // JavaScript pour afficher ou masquer le menu lors du clic sur "Tools"
        document.getElementById("toolsButton").addEventListener("click", function(event) {
            event.preventDefault(); // Pour empêcher le comportement de lien par défaut
            var menuBox = document.getElementById("toolsMenuBox");
            var menu = document.getElementById("toolsMenu");
            menuBox.style.display = "block";
            menu.style.display = "block";
        });

        // JavaScript pour fermer le menu lors du clic sur la croix
        document.getElementById("closeMenuButton").addEventListener("click", function(event) {
            event.preventDefault(); // Pour empêcher le comportement de lien par défaut
            var menuBox = document.getElementById("toolsMenuBox");
            var menu = document.getElementById("toolsMenu");
            menuBox.style.display = "none";
            menu.style.display = "none";
        });
    </script>
</body>
</html>
