<!DOCTYPE html>
<html>
<head>
    <title>Envoyer un Webhook</title>
</head>
<body>

<h2>Formulaire d'envoi de webhook</h2>

<form action="" method="post">
    <label for="webhook_url">URL du Webhook:</label><br>
    <input type="text" id="webhook_url" name="webhook_url"><br>
    <label for="webhook_name">Nom du Webhook:</label><br>
    <input type="text" id="webhook_name" name="webhook_name"><br>
    <label for="webhook_avatar">URL de l'avatar du Webhook:</label><br>
    <input type="text" id="webhook_avatar" name="webhook_avatar"><br>
    <input type="checkbox" id="embed_checkbox" name="embed_checkbox" onchange="toggleEmbedFields()"> Envoyer en tant qu'embed<br><br>
    <div id="embed_fields" style="display:none;">
        <label for="embed_title">Titre de l'embed:</label><br>
        <input type="text" id="embed_title" name="embed_title"><br>
        <label for="embed_footer">Pied de page de l'embed:</label><br>
        <input type="text" id="embed_footer" name="embed_footer"><br>
        <label for="embed_image_url">URL de l'image de l'embed:</label><br>
        <input type="text" id="embed_image_url" name="embed_image_url"><br>
        <label for="embed_message">Message de l'embed:</label><br>
        <textarea id="embed_message" name="embed_message" rows="4" cols="50"></textarea><br><br>
    </div>
    <label for="message">Message:</label><br>
    <textarea id="message" name="message" rows="4" cols="50"></textarea><br><br>
    <input type="checkbox" id="multiple_checkbox" name="multiple_checkbox"> Envoyer plusieurs fois avec un délai de 2 secondes entre chaque envoi<br><br>
    <input type="submit" value="Envoyer">
</form>

<script>
    function toggleEmbedFields() {
        var embedFields = document.getElementById("embed_fields");
        var embedCheckbox = document.getElementById("embed_checkbox");
        if (embedCheckbox.checked) {
            embedFields.style.display = "block";
        } else {
            embedFields.style.display = "none";
        }
    }
</script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $webhook_url = $_POST['webhook_url'];
    $webhook_name = $_POST['webhook_name'];
    $webhook_avatar = $_POST['webhook_avatar'];
    $message = $_POST['message'];
    $embed_checkbox = isset($_POST['embed_checkbox']) ? $_POST['embed_checkbox'] : '';
    $multiple_checkbox = isset($_POST['multiple_checkbox']) ? $_POST['multiple_checkbox'] : '';

    // Vérifier si l'URL du Webhook est fournie
    if (!empty($webhook_url)) {
        // Vérifier si le nom et l'avatar du webhook sont fournis
        if (!empty($webhook_name) && !empty($webhook_avatar)) {
            // Créer un tableau contenant les données à envoyer
            $data = array(
                'username' => $webhook_name,
                'avatar_url' => $webhook_avatar,
                'content' => $message
            );

            // Si l'utilisateur a coché la case pour envoyer en tant qu'embed
            if ($embed_checkbox) {
                $embed_title = $_POST['embed_title'];
                $embed_footer = $_POST['embed_footer'];
                $embed_image_url = $_POST['embed_image_url'];
                $embed_message = $_POST['embed_message'];

                // Ajouter les données de l'embed au tableau
                $data['embeds'] = array(
                    array(
                        'title' => $embed_title,
                        'footer' => array('text' => $embed_footer),
                        'image' => array('url' => $embed_image_url),
                        'description' => $embed_message
                    )
                );
            }

            // Convertir les données en format JSON
            $payload = json_encode($data);

            // Si l'utilisateur a coché la case pour envoyer plusieurs fois
            if ($multiple_checkbox) {
                // Envoyer le webhook 5 fois avec un délai de 2 secondes entre chaque envoi
                for ($i = 0; $i < 5; $i++) {
                    sendWebhook($webhook_url, $payload);
                    sleep(2); // Attendre 2 secondes
                }
            } else {
                // Envoyer le webhook une seule fois
                sendWebhook($webhook_url, $payload);
            }

            // Afficher un message de confirmation
            echo "<p>Webhook envoyé(s) avec succès!</p>";
        } else {
            // Afficher un message d'erreur si le nom ou l'avatar du webhook est vide
            echo "<p>Veuillez fournir un nom et une URL de l'avatar du webhook.</p>";
        }
    } else {
        // Afficher un message d'erreur si l'URL du Webhook est vide
        echo "<p>Veuillez fournir une URL de Webhook.</p>";
    }
}

function sendWebhook($url, $payload) {
    // Initialiser une session cURL
    $ch = curl_init($url);

    // Configurer les options de cURL
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // Exécuter la requête cURL
    $result = curl_exec($ch);

    // Fermer la session cURL
    curl_close($ch);
}
?>

</body>
</html>
