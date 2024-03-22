<!DOCTYPE html>
<html>
<head>
    <title>NoName</title>
</head>
<body>

<h2>Discord Bot message online</h2>

<form action="" method="post">
    <label for="bot_token">Token:</label><br>
    <input type="text" id="bot_token" name="bot_token"><br>
    <label for="channel_id">ChannelID:</label><br>
    <input type="text" id="channel_id" name="channel_id"><br>
    <label for="message">Message:</label><br>
    <textarea id="message" name="message" rows="4" cols="50"></textarea><br><br>
    <input type="submit" value="Envoyer">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $bot_token = $_POST['bot_token'];
    $channel_id = $_POST['channel_id'];
    $message = $_POST['message'];

    // Vérifier si le token du bot et l'ID du channel sont fournis
    if (!empty($bot_token) && !empty($channel_id)) {
        // Créer un tableau contenant les données à envoyer
        $data = array(
            'content' => $message
        );

        // Convertir les données en format JSON
        $payload = json_encode($data);

        // Envoyer le message au channel Discord
        sendDiscordMessage($bot_token, $channel_id, $payload);

        // Afficher un message de confirmation
        echo "<p>Message envoyé avec succès!</p>";
    } else {
        // Afficher un message d'erreur si le token du bot ou l'ID du channel est vide
        echo "<p>Veuillez fournir le token du bot Discord et l'ID du channel.</p>";
    }
}

function sendDiscordMessage($token, $channel_id, $payload) {
    // Initialiser une session cURL
    $ch = curl_init("https://discord.com/api/v9/channels/$channel_id/messages");

    // Configurer les options de cURL
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bot ' . $token,
        'Content-Type: application/json'
    ));

    // Exécuter la requête cURL
    $result = curl_exec($ch);

    // Fermer la session cURL
    curl_close($ch);
}
?>

</body>
</html>
