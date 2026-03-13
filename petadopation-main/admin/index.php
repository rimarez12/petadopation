<?php
include("guard.php");
include("../config.php");

$stats = [];
$stats['associations'] = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM associations"))['count'] ?? 0;
$stats['animaux'] = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM animaux"))['count'] ?? 0;
$stats['demandes'] = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM demandes_adoption"))['count'] ?? 0;
$stats['users'] = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM utilisateurs"))['count'] ?? 0;
$stats['annonces'] = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM annonces"))['count'] ?? 0;
$stats['messages'] = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM messages_contact WHERE lu = 0"))['count'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - LALAPA</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f5f7fa;
      color: #333;
    }

    nav {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      padding: 0;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .nav-container {
      max-width: 1400px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 30px;
    }

    .brand {
      color: white;
      font-size: 28px;
      font-weight: bold;
      text-decoration: none;
      padding: 20px 0;
    }

    .brand .accent {
      color: #ffd700;
    }

    .nav-links {
      display: flex;
      gap: 5px;
      list-style: none;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
      padding: 25px 20px;
      display: block;
      transition: background 0.3s;
      font-weight: 500;
    }

    .nav-links a:hover,
    .nav-links a.active {
      background: rgba(255,255,255,0.2);
    }

    .main-content {
      max-width: 1400px;
      margin: 0 auto;
      padding: 40px 30px;
    }

    .page-header {
      margin-bottom: 40px;
    }

    .page-header h1 {
      font-size: 32px;
      color: #2d3748;
      margin-bottom: 10px;
    }

    .page-header p {
      color: #718096;
      font-size: 16px;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      margin-bottom: 40px;
    }

    .stat-card {
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      transition: transform 0.3s, box-shadow 0.3s;
      cursor: pointer;
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    .stat-card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }

    .stat-card-title {
      font-size: 14px;
      color: #718096;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .stat-card-icon {
      width: 50px;
      height: 50px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      color: white;
    }

    .stat-card-value {
      font-size: 36px;
      font-weight: bold;
      color: #2d3748;
    }

    .stat-card-link {
      margin-top: 15px;
      color: #667eea;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    .stat-card-link:hover {
      gap: 10px;
    }

    .icon-purple { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .icon-blue { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    .icon-green { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
    .icon-orange { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
    .icon-red { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .icon-teal { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }

    .quick-actions {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .quick-actions h2 {
      font-size: 24px;
      color: #2d3748;
      margin-bottom: 20px;
    }

    .action-buttons {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 15px;
    }

    .action-btn {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 15px 25px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.3s, box-shadow 0.3s;
      text-decoration: none;
      display: block;
      text-align: center;
    }

    .action-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }

    @media (max-width: 768px) {
      .nav-links {
        display: none;
      }
      
      .stats-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <nav>
    <div class="nav-container">
      <a href="../index.php" class="brand">
        LALA<span class="accent">PA</span>
      </a>
      <ul class="nav-links">
        <li><a href="index.php" class="active">Dashboard</a></li>
        <li><a href="associations.php">Associations</a></li>
        <li><a href="animals.php">Animaux</a></li>
        <li><a href="requests.php">Demandes</a></li>
        <li><a href="annonces.php">Annonces</a></li>
        <li><a href="messages.php">Messages</a></li>
        <li><a href="users.php">Utilisateurs</a></li>
      </ul>
    </div>
  </nav>

  <div class="main-content">
    <div class="page-header">
      <h1>Admin Dashboard</h1>
      <p>Bienvenue, <?php echo htmlspecialchars($_SESSION['nom']); ?>.</p>
    </div>

    <div class="stats-grid">
      <div class="stat-card" onclick="window.location.href='associations.php'">
        <div class="stat-card-header">
          <div>
            <div class="stat-card-title">Associations</div>
            <div class="stat-card-value"><?php echo $stats['associations']; ?></div>
          </div>
          <div class="stat-card-icon icon-purple">
            <i class="fas fa-building"></i>
          </div>
        </div>
        <a href="associations.php" class="stat-card-link">
          Gérer <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      <div class="stat-card" onclick="window.location.href='animals.php'">
        <div class="stat-card-header">
          <div>
            <div class="stat-card-title">Animaux</div>
            <div class="stat-card-value"><?php echo $stats['animaux']; ?></div>
          </div>
          <div class="stat-card-icon icon-blue">
            <i class="fas fa-paw"></i>
          </div>
        </div>
        <a href="animals.php" class="stat-card-link">
          Gérer <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      <div class="stat-card" onclick="window.location.href='requests.php'">
        <div class="stat-card-header">
          <div>
            <div class="stat-card-title">Demandes</div>
            <div class="stat-card-value"><?php echo $stats['demandes']; ?></div>
          </div>
          <div class="stat-card-icon icon-green">
            <i class="fas fa-clipboard-list"></i>
          </div>
        </div>
        <a href="requests.php" class="stat-card-link">
          Gérer <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      <div class="stat-card" onclick="window.location.href='users.php'">
        <div class="stat-card-header">
          <div>
            <div class="stat-card-title">Utilisateurs</div>
            <div class="stat-card-value"><?php echo $stats['users']; ?></div>
          </div>
          <div class="stat-card-icon icon-orange">
            <i class="fas fa-users"></i>
          </div>
        </div>
        <a href="users.php" class="stat-card-link">
          Gérer <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      <div class="stat-card" onclick="window.location.href='annonces.php'">
        <div class="stat-card-header">
          <div>
            <div class="stat-card-title">Annonces</div>
            <div class="stat-card-value"><?php echo $stats['annonces']; ?></div>
          </div>
          <div class="stat-card-icon icon-red">
            <i class="fas fa-bullhorn"></i>
          </div>
        </div>
        <a href="annonces.php" class="stat-card-link">
          Gérer <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      <div class="stat-card" onclick="window.location.href='messages.php'">
        <div class="stat-card-header">
          <div>
            <div class="stat-card-title">Messages non lus</div>
            <div class="stat-card-value"><?php echo $stats['messages']; ?></div>
          </div>
          <div class="stat-card-icon icon-teal">
            <i class="fas fa-envelope"></i>
          </div>
        </div>
        <a href="messages.php" class="stat-card-link">
          Voir <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>

    <div class="quick-actions">
      <h2>Actions rapides</h2>
      <div class="action-buttons">
        <a href="associations.php" class="action-btn">Gérer les associations</a>
        <a href="animals.php" class="action-btn">Gérer les animaux</a>
        <a href="requests.php" class="action-btn">Gérer les demandes</a>
        <a href="annonces.php" class="action-btn">Gérer les annonces</a>
        <a href="messages.php" class="action-btn">Voir les messages</a>
        <a href="users.php" class="action-btn">Gérer les utilisateurs</a>
      </div>
    </div>
  </div>
</body>
</html>
