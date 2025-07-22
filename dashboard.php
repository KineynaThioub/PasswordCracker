<?php
session_start();

// Vérifier si l'utilisateur est connecté. Si non, rediriger vers la page de login.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

$username = htmlspecialchars($_SESSION['username'] ?? 'Invité');
$login_time = isset($_SESSION['login_time']) ? date('d/m/Y H:i:s', $_SESSION['login_time']) : 'Inconnu';

// Informations sensibles fictives pour l'administrateur
$sensitive_info = [
    'User_IDs_List' => ['U001', 'U002', 'U003', 'U004', 'U005', 'U006', 'U007', 'U008', 'U009', 'U010'],
    'Recent_Login_Attempts_IPs' => [
        '192.168.1.10 (admin - success)',
        '10.0.0.5 (user_a - success)',
        '203.0.113.45 (unknown - failed - 5 attempts)',
        '172.16.0.1 (admin - success)',
        '198.51.100.2 (botnet_ip - failed - 150 attempts)',
    ],
    'System_Health_Metrics' => [
        'CPU Usage: 75%',
        'Memory Usage: 85%',
        'Disk Space: 90% full',
        'Network Latency: 5ms',
    ],
    'Critical_Alerts' => [
        'High CPU usage detected on Server A (Threshold 70%)',
        'Unauthorized access attempt from IP 203.0.113.45 blocked',
        'Database backup failed on 2025-07-20',
    ],
    'Pending_Updates' => [
        'OS Patch (Critical)',
        'Database Engine Update (Recommended)',
    ],
];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur - Accès Sensible</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* Align content to top */
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
            margin: 0;
            padding: 30px 20px; /* Add some padding for better spacing */
            color: #333;
            box-sizing: border-box; /* Include padding in element's total width and height */
        }
        .dashboard-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 900px; /* Larger container for more info */
            box-sizing: border-box;
            text-align: center;
            animation: fadeIn 0.8s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 25px;
            font-weight: 700;
            font-size: 2.2em;
        }
        h3 {
            color: #34495e;
            margin-top: 30px;
            margin-bottom: 15px;
            border-bottom: 2px solid #e0e6ed;
            padding-bottom: 10px;
            font-weight: 600;
            font-size: 1.4em;
        }
        p {
            font-size: 1.05em;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Responsive grid */
            gap: 25px;
            margin-top: 30px;
            text-align: left;
        }
        .info-block {
            background-color: #f8fbfd;
            border: 1px solid #e0e6ed;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }
        .info-block:hover {
            transform: translateY(-5px);
        }
        .info-block ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .info-block ul li {
            margin-bottom: 8px;
            color: #555;
            display: flex;
            align-items: flex-start;
        }
        .info-block ul li strong {
            color: #2c3e50;
            margin-right: 8px;
            min-width: 120px; /* Ensure labels align */
        }
        .info-block ul li:last-child {
            margin-bottom: 0;
        }
        .logout-button {
            display: inline-block;
            margin-top: 40px;
            padding: 12px 28px;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: 0 6px 15px rgba(220, 53, 69, 0.25);
        }
        .logout-button:hover {
            background-color: #c82333;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.35);
        }
        .logout-button:active {
            transform: translateY(0);
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.25);
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Tableau de Bord Administrateur</h2>
        <p>Bienvenue, <strong style="color: #007bff;"><?php echo $username; ?></strong>. Accès aux informations sensibles du système.</p>
        <p>Dernière connexion : <strong><?php echo $login_time; ?></strong></p>

        <h3>Rapports et Statistiques Critiques</h3>
        <div class="info-grid">
            <div class="info-block">
                <h4>Liste des IDs Utilisateurs</h4>
                <ul>
                    <?php foreach ($sensitive_info['User_IDs_List'] as $id): ?>
                        <li><?php echo $id; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="info-block">
                <h4>Tentatives de Connexion Récentes</h4>
                <ul>
                    <?php foreach ($sensitive_info['Recent_Login_Attempts_IPs'] as $attempt): ?>
                        <li><?php echo $attempt; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="info-block">
                <h4>Métriques de Santé du Système</h4>
                <ul>
                    <?php foreach ($sensitive_info['System_Health_Metrics'] as $metric): ?>
                        <li><?php echo $metric; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="info-block">
                <h4>Alertes de Sécurité Critiques</h4>
                <ul>
                    <?php foreach ($sensitive_info['Critical_Alerts'] as $alert): ?>
                        <li><strong style="color: #dc3545;">!</strong> <?php echo $alert; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="info-block">
                <h4>Mises à Jour en Attente</h4>
                <ul>
                    <?php foreach ($sensitive_info['Pending_Updates'] as $update): ?>
                        <li><strong style="color: #ffc107;">&#9888;</strong> <?php echo $update; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="info-block">
                <h4>Configuration Serveur</h4>
                <ul>
                    <li><strong>Version PHP:</strong> 8.2.1</li>
                    <li><strong>Version Apache:</strong> 2.4.58</li>
                    <li><strong>Base de données:</strong> MySQL 8.0.35</li>
                    <li><strong>Statut Firewall:</strong> Actif</li>
                    <li><strong>Certificat SSL:</strong> Valide jusqu'au 2026-01-01</li>
                </ul>
            </div>
        </div>

        <a href="logout.php" class="logout-button">Déconnexion Sécurisée</a>
    </div>
</body>
</html>