<?php
session_start();
include("config.php");

$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id <= 0){
    header('Location: annonces.php');
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT id, titre, contenu, image, date_creation FROM annonces WHERE id = ? AND statut = 'Acceptée' LIMIT 1");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$annonce = $res ? mysqli_fetch_assoc($res) : null;

if(!$annonce){
    header('Location: annonces.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="style.css" />
<script src="index.js" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
<title>LALAPA | Annonce</title>
</head>
<body>
<nav>
  <a href="index.php" class="brand">
    <h1>LALA<b class="accent">PA</b></h1>
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
<section style="padding: 60px 30px 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
  <div style="max-width: 900px; margin: 0 auto;">
    <a href="annonces.php" style="color: white; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 20px; opacity: 0.9; transition: opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.9'">
      <i class="fas fa-arrow-left"></i> Retour aux annonces
    </a>
    <h1 style="font-size: 42px; margin-bottom: 15px; line-height: 1.2;"><?php echo htmlspecialchars($annonce['titre'] ?? ''); ?></h1>
    <div style="display: flex; align-items: center; gap: 15px; opacity: 0.9;">
      <span><i class="fas fa-calendar-alt"></i> <?php echo date('d F Y', strtotime($annonce['date_creation'] ?? 'now')); ?></span>
    </div>
  </div>
</section>

<!-- Content Section -->
<section style="padding: 60px 30px; max-width: 900px; margin: 0 auto;">
  <?php if(!empty($annonce['image'])): ?>
    <div style="margin-bottom: 40px;">
      <img src="images/<?php echo htmlspecialchars($annonce['image']); ?>" alt="annonce" style="width: 100%; max-height: 500px; object-fit: cover; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1);">
    </div>
  <?php endif; ?>
  
  <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
    <div style="color: #2d3748; font-size: 18px; line-height: 1.8; white-space: pre-wrap;"><?php echo htmlspecialchars($annonce['contenu'] ?? ''); ?></div>
  </div>

  <div style="margin-top: 40px; text-align: center;">
    <a href="annonces.php" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px 40px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-block; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
      <i class="fas fa-arrow-left"></i> Retour aux annonces
    </a>
  </div>
</section>
</body>
</html>
