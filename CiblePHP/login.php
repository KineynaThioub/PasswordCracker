<?php
session_start();

// --- Configuration ---
$correct_username = "admin";
$correct_password = "a";

// --- Initialisation des variables pour les messages et pré-remplissage ---
$message_type = "";
$message_text = "";
$submitted_username = ""; // Pour garder le nom d'utilisateur pré-rempli en cas d'erreur
$show_login_form = true; // Contrôle l'affichage du formulaire ou du message de succès

// --- Traitement de la soumission du formulaire ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted_username = htmlspecialchars($_POST["username"] ?? '');
    $submitted_password = htmlspecialchars($_POST["password"] ?? '');

    if ($submitted_username === $correct_username && $submitted_password === $correct_password) {
        $message_type = "success";
        $message_text = "Connexion reussie ! Redirection en cours...";
        $show_login_form = false; // Ne plus afficher le formulaire
        
        // Stocker les infos de session AVANT la redirection
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $submitted_username;
        $_SESSION['login_time'] = time();

        // Définir un délai avant la redirection pour que l'utilisateur puisse voir le message
        // Pour le cracker, la redirection est toujours détectable immédiatement
        header("Refresh: 2; URL=dashboard.php"); // Redirige après 2 secondes
        http_response_code(200); // Maintenu pour la détection du cracker basé sur le statut
        exit(); // Important: Arrêter l'exécution du script
    } else {
        $message_type = "error";
        $message_text = "Échec de la connexion. Nom d'utilisateur ou mot de passe incorrect.";
        http_response_code(200); // Pas de redirection en cas d'échec
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification du Système</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #6dd5ed, #2193b0); /* Bleu doux */
            margin: 0;
            color: #333;
            overflow: hidden; /* Pour gérer les animations de fond */
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.95); /* Légèrement transparent */
            padding: 45px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
            box-sizing: border-box;
            text-align: center;
            animation: fadeInScale 0.8s ease-out;
            position: relative;
            z-index: 10;
        }
        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.9) translateY(-20px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 35px;
            font-weight: 700;
            font-size: 2em;
            letter-spacing: -0.5px;
        }
        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 0.95em;
        }
        input[type="text"],
        input[type="password"] {
            width: calc(100% - 24px); /* Padding accounted for */
            padding: 14px 12px;
            border: 1px solid #cddde6;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 1em;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background-color: #f9fcff;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.15);
            outline: none;
        }
        button[type="submit"] {
            width: 100%;
            padding: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.25);
            margin-top: 15px;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.35);
        }
        button[type="submit"]:active {
            transform: translateY(0);
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.25);
        }
        .message {
            margin-top: 30px;
            padding: 18px;
            border-radius: 10px;
            font-weight: 500;
            animation: slideInFade 0.6s ease-out;
            font-size: 1em;
            line-height: 1.4;
        }
        @keyframes slideInFade {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .success {
            background-color: #e6ffed; /* Vert très pâle */
            color: #008744; /* Vert plus foncé */
            border: 1px solid #b2f1cc;
        }
        .error {
            background-color: #ffebe6; /* Rouge très pâle */
            color: #d8000c; /* Rouge plus foncé */
            border: 1px solid #fccbcb;
        }
        .message p {
            margin: 0;
            padding: 0;
        }
        .forgot-password {
            display: block;
            margin-top: 20px;
            font-size: 0.9em;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .forgot-password:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        
        /* Background animations */
        .bubble-container {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 1;
        }
        .bubble {
            position: absolute;
            bottom: -150px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 15s infinite ease-in-out;
            opacity: 0.6;
        }
        .bubble:nth-child(1) { width: 60px; height: 60px; left: 10%; animation-duration: 12s; animation-delay: 0s; }
        .bubble:nth-child(2) { width: 80px; height: 80px; left: 20%; animation-duration: 15s; animation-delay: 2s; }
        .bubble:nth-child(3) { width: 50px; height: 50px; left: 30%; animation-duration: 10s; animation-delay: 4s; }
        .bubble:nth-child(4) { width: 70px; height: 70px; left: 40%; animation-duration: 13s; animation-delay: 1s; }
        .bubble:nth-child(5) { width: 90px; height: 90px; left: 50%; animation-duration: 16s; animation-delay: 3s; }
        .bubble:nth-child(6) { width: 65px; height: 65px; left: 60%; animation-duration: 11s; animation-delay: 5s; }
        .bubble:nth-child(7) { width: 75px; height: 75px; left: 70%; animation-duration: 14s; animation-delay: 0s; }
        .bubble:nth-child(8) { width: 55px; height: 55px; left: 80%; animation-duration: 9s; animation-delay: 2s; }
        .bubble:nth-child(9) { width: 85px; height: 85px; left: 90%; animation-duration: 17s; animation-delay: 4s; }

        @keyframes float {
            0% { transform: translateY(0); opacity: 0.6; }
            50% { transform: translateY(-800px); opacity: 0.4; }
            100% { transform: translateY(-1600px); opacity: 0; }
        }
    </style>
</head>
<body>
    <div class="bubble-container">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>
    
    <div class="login-container">
        <h2>Accès Sécurisé</h2>

        <?php if (!empty($message_text)): ?>
            <div class="message <?php echo $message_type; ?>">
                <p><?php echo $message_text; ?></p>
            </div>
        <?php endif; ?>

        <?php if ($show_login_form): ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" required autocomplete="username"
                           placeholder="Entrez votre nom d'utilisateur"
                           value="<?php echo htmlspecialchars($submitted_username); ?>">
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password"
                           placeholder="Entrez votre mot de passe">
                </div>

                <button type="submit">Connexion</button>
            </form>
            <a href="#" class="forgot-password">Mot de passe oublié ?</a>
        <?php else: // Message de succès seulement ?>
            <p>Vous allez être redirigé vers le tableau de bord...</p>
        <?php endif; ?>
    </div>
</body>
</html>