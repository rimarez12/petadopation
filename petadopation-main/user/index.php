<?php
include("guard.php");
include("../config.php");

$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$user_id = $_SESSION['user_id'] ?? 0;

$stats = [];
$stats['demandes'] = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM demandes_adoption WHERE user_id = $user_id"))['count'] ?? 0;
$stats['favoris'] = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM favoris WHERE user_id = $user_id"))['count'] ?? 0;
$stats['animaux'] = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM animaux"))['count'] ?? 0;
$stats['annonces'] = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM annonces WHERE statut = 'Acceptée'"))['count'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mon Espace - LALAPA</title>
  <link rel="stylesheet" href="user-style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <nav>
    <div class="nav-container">
      <a href="../index.php" class="brand">
        LALA<span class="accent">PA</span>
      </a>
      <ul class="nav-links">
        <li><a href="index.php" class="active">Mon espace</a></li>
        <li><a href="../pets.php">Animaux</a></li>
        <li><a href="../annonces.php">Annonces</a></li>
        <li><a href="../mes_demandes.php">Mes demandes</a></li>
        <li><a href="favorites.php">Mes favoris</a></li>
        <li><a href="../contact.php">Contact</a></li>
        <?php if($isAdmin): ?>
          <li><a href="../admin/index.php">Admin</a></li>
        <?php endif; ?>
      </ul>
      <button class="logout-btn" onclick="window.location.href='../logout.php'">
        <i class="fas fa-sign-out-alt"></i> Déconnexion
      </button>
    </div>
  </nav>

  <div class="main-content">
    <div class="page-header">
      <h1>Mon Espace</h1>
      <p>Bienvenue, <?php echo htmlspecialchars($_SESSION['nom'] ?? ''); ?>!</p>
    </div>

    <div class="stats-grid">
      <a href="../mes_demandes.php" class="stat-card">
        <div class="stat-card-header">
          <div>
            <div class="stat-card-title">Mes demandes</div>
            <div class="stat-card-value"><?php echo $stats['demandes']; ?></div>
          </div>
          <div class="stat-card-icon icon-purple">
            <i class="fas fa-clipboard-list"></i>
          </div>
        </div>
        <span class="stat-card-link">
          Voir mes demandes <i class="fas fa-arrow-right"></i>
        </span>
      </a>

      <a href="favorites.php" class="stat-card">
        <div class="stat-card-header">
          <div>
            <div class="stat-card-title">Mes favoris</div>
            <div class="stat-card-value"><?php echo $stats['favoris']; ?></div>
          </div>
          <div class="stat-card-icon icon-red">
            <i class="fas fa-heart"></i>
          </div>
        </div>
        <span class="stat-card-link">
          Voir mes favoris <i class="fas fa-arrow-right"></i>
        </span>
      </a>

      <a href="../pets.php" class="stat-card">
        <div class="stat-card-header">
          <div>
            <div class="stat-card-title">Animaux disponibles</div>
            <div class="stat-card-value"><?php echo $stats['animaux']; ?></div>
          </div>
          <div class="stat-card-icon icon-blue">
            <i class="fas fa-paw"></i>
          </div>
        </div>
        <span class="stat-card-link">
          Parcourir <i class="fas fa-arrow-right"></i>
        </span>
      </a>

      <a href="../annonces.php" class="stat-card">
        <div class="stat-card-header">
          <div>
            <div class="stat-card-title">Annonces</div>
            <div class="stat-card-value"><?php echo $stats['annonces']; ?></div>
          </div>
          <div class="stat-card-icon icon-green">
            <i class="fas fa-bullhorn"></i>
          </div>
        </div>
        <span class="stat-card-link">
          Voir les annonces <i class="fas fa-arrow-right"></i>
        </span>
      </a>
    </div>

    <div class="card">
      <h2>Actions rapides</h2>
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
        <a href="../pets.php" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px 25px; border-radius: 8px; text-decoration: none; text-align: center; font-weight: 600; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
          <i class="fas fa-search"></i> Trouver un animal
        </a>
        <a href="../annonces.php" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 15px 25px; border-radius: 8px; text-decoration: none; text-align: center; font-weight: 600; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
          <i class="fas fa-newspaper"></i> Lire les annonces
        </a>
        <a href="../contact.php" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white; padding: 15px 25px; border-radius: 8px; text-decoration: none; text-align: center; font-weight: 600; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
          <i class="fas fa-envelope"></i> Nous contacter
        </a>
      </div>
    </div>
  </div>
</body>
</html>
