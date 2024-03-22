<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un lien Lootlabs</title>
</head>
<body>
    <h2>Créer un lien Lootlabs</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="title">Titre :</label><br>
        <input type="text" id="title" name="title" required><br>
        
        <label for="url">URL :</label><br>
        <input type="text" id="url" name="url" required><br>
        
        <label for="number_of_tasks">Nombre de tâches :</label><br>
        <input type="number" id="number_of_tasks" name="number_of_tasks" required><br>
        
        <button type="submit">Créer</button>
    </form>

    <?php
    // API Endpoint
    $url = 'https://be.lootlabs.gg/api/lootlabs/content_locker';

    // Replace 'YOUR_API_TOKEN' with your actual API token
    $api_token = 'c5de330fa8b6c660a1aaaed9741f0157b1054bf479ce4537566d6978e09e4868';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Request body data
        $data = [
            'title' => $_POST['title'],
            'url' => $_POST['url'],
            'tier_id' => 1, // You may adjust this value as needed
            'number_of_tasks' => $_POST['number_of_tasks'],
            'theme' => 5, // You may adjust this value as needed
        ];

        // Initialize cURL session
        $ch = curl_init($url);

        // Set cURL options
        $headers = [
            'Authorization: Bearer ' . $api_token,
            'Content-Type: application/json'
        ];
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL session and get the response
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);
        
        // Print response
        $response_data = json_decode($response, true);
        $loot_url = $response_data['message'][0]['loot_url'];
        echo '<p>URL: ' . $loot_url . '</p>';

    }
    ?>
</body>
</html>
