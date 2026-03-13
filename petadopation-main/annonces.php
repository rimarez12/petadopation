<?php
session_start();
include("config.php");

$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

$result = mysqli_query($conn, "SELECT id, titre, contenu, image, date_creation FROM annonces WHERE statut = 'Acceptée' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="style.css" />
<script src="index.js" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
<title>LALAPA | Annonces</title>
</head>
<body>
<nav>
    <img src="img/logo.png" alt="img" width="130px/>
  <a href="index.php" class="brand">
  </a>
  <div class="menu">
    <div class="btn"><i class="fas fa-times close-btn"></i></div>
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="ourteam.php">Our Team</a>
    <a href="pets.php">Pets</a>
    <a href="annonces.php">Annonces</a>
    <a href="service.php">Service</a>
    <a href="contact.php">Contact</a>
    <?php if($isAdmin): ?>
      <a href="admin/index.php">Admin</a>
    <?php endif; ?>
  </div>

  <?php if(!$isLoggedIn): ?>
    <button class="btn-2" onclick="window.location.href='register.php'">
      <p>Register</p>
      <i class="fa-solid fa-circle-arrow-right"></i>
    </button>
    <button class="btn-3" onclick="window.location.href='Login.php'">
      <p>login</p>
    </button>
  <?php else: ?>
    <button class="btn-3" onclick="window.location.href='logout.php'">
      <p>Logout</p>
    </button>
  <?php endif; ?>

  <div class="btn"><i class="fas fa-bars menu-btn"></i></div>
</nav>

<!-- Hero Section -->
<section style="padding: 50px 30px; background: linear-gradient(135deg, #2a4cdf 0%, #5a66e7 100%); color: white; text-align: center;">
  <div style="max-width: 800px; margin: 0 auto;">
    <h1 style="font-size: 48px; margin-bottom: 20px;">Annonces</h1>
    <p style="font-size: 20px; line-height: 1.6;">
      Découvrez nos dernières actualités, événements et informations importantes.
    </p>
  </div>
</section>

<!-- Annonces Section -->
<section style="padding: 60px 30px; max-width: 1200px; margin: 0 auto;">
  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px;">
    <?php if($result && mysqli_num_rows($result) > 0): ?>
      <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div style="background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s, box-shadow 0.3s;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'">
          <?php if(!empty($row['image'])): ?>
            <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="annonce" style="width: 100%; height: 220px; object-fit: cover;">
          <?php else: ?>
            <div style="width: 100%; height: 220px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
              <i class="fas fa-bullhorn" style="font-size: 60px; color: white; opacity: 0.5;"></i>
            </div>
          <?php endif; ?>
          <div style="padding: 25px;">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px; color: #718096; font-size: 14px;">
              <i class="fas fa-calendar-alt"></i>
              <span><?php echo date('d/m/Y', strtotime($row['date_creation'] ?? 'now')); ?></span>
            </div>
            <h3 style="font-size: 22px; color: #2d3748; margin-bottom: 12px; line-height: 1.3;"><?php echo htmlspecialchars($row['titre'] ?? ''); ?></h3>
            <p style="color: #718096; line-height: 1.6; margin-bottom: 20px;"><?php echo htmlspecialchars(mb_strimwidth($row['contenu'] ?? '', 0, 150, '...')); ?></p>
            <a href="annonce.php?id=<?php echo (int)$row['id']; ?>" style="color: #667eea; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: gap 0.3s;" onmouseover="this.style.gap='12px'" onmouseout="this.style.gap='8px'">
              Lire la suite <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
        <i class="fas fa-inbox" style="font-size: 60px; color: #cbd5e0; margin-bottom: 20px;"></i>
        <h3 style="font-size: 24px; color: #4a5568; margin-bottom: 10px;">Aucune annonce disponible</h3>
        <p style="color: #718096;">Revenez bientôt pour découvrir nos actualités !</p>
      </div>
    <?php endif; ?>
  </div>
</section>
</body>
</html>
