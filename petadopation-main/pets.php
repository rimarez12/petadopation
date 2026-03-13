<?php
session_start();
include("config.php");

$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link rel="stylesheet" href="style.css" />
<script src="index.js" defer></script>

<script src="https://unpkg.com/scrollreveal"></script>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

<script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/split-type@0.3.4/umd/index.min.js"></script>

<title>LALAPA | Pets</title>
</head>

<body>

<!-- Navbar -->
<nav>
    <img src="img/logo.png" alt="img" width="130px/>
<a href="index.php" class="brand">

</a>

<div class="menu">
<div class="btn">
<i class="fas fa-times close-btn"></i>
</div>

<a href="index.php">Home</a>
<a href="about.php">About</a>
<a href="ourteam.php">Our Team</a>
<a href="pets.php">Pets</a>
<a href="service.php">Service</a>
<a href="annonces.php">Annonces</a>
<a href="contact.php">Contact</a>
<?php if($isAdmin): ?>
  <a href="admin/index.php">Admin</a>
<?php endif; ?>
<?php if($isLoggedIn): ?>
  <a href="user/index.php">Mon espace</a>
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

<div class="btn">
<i class="fas fa-bars menu-btn"></i>
</div>
</nav>

<!-- Hero Section -->
<section style="padding: 80px 30px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-align: center;">
  <div style="max-width: 800px; margin: 0 auto;">
    <h1 style="font-size: 48px; margin-bottom: 20px;">Nos Animaux à Adopter</h1>
    <p style="font-size: 20px; line-height: 1.6;">
      Trouvez votre compagnon idéal parmi nos adorables animaux qui attendent une famille aimante.
    </p>
  </div>
</section>

<!-- Search Section -->
<section style="padding: 40px 30px 20px; max-width: 1200px; margin: 0 auto;">
  <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); display: flex; gap: 15px; flex-wrap: wrap; align-items: center;">
    <div style="flex: 1; min-width: 250px;">
      <label style="display: block; color: #125ad7; font-weight: 600; margin-bottom: 8px; font-size: 14px;">
        <i class="fas fa-search"></i> Rechercher
      </label>
      <input type="text" id="search-pets" placeholder="Nom, description..." style="width: 100%; padding: 12px 15px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 15px;">
    </div>
    <div style="min-width: 200px;">
      <label style="display: block; color: #0b58dc; font-weight: 600; margin-bottom: 8px; font-size: 14px;">
        <i class="fas fa-filter"></i> Type d'animal
      </label>
      <select id="filter-type" style="width: 100%; padding: 12px 15px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 15px; background: white;">
        <option value="">Tous les types</option>
        <option value="chien">Chien</option>
        <option value="chat">Chat</option>
      </select>
    </div>
  </div>
</section>

<!-- Pets Section -->
<section style="padding: 40px 30px 60px; max-width: 1200px; margin: 0 auto;">
  <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px;" class="pets-container">

<?php

$sql = "SELECT * FROM animaux";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){

?>

<div class="pet-card" 
     data-name="<?php echo strtolower(htmlspecialchars($row['nom'] ?? '')); ?>" 
     data-type="<?php echo strtolower(htmlspecialchars($row['type'] ?? '')); ?>"
     data-description="<?php echo strtolower(htmlspecialchars($row['description'] ?? '')); ?>"
     style="background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.3s, box-shadow 0.3s;"
     onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)'"
     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'">

  <div style="position: relative; overflow: hidden;">
    <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['nom']); ?>" style="width: 100%; height: 250px; object-fit: cover;">
    <div style="position: absolute; top: 15px; right: 15px; background: rgba(254, 254, 254, 0.95); padding: 8px 15px; border-radius: 20px; font-weight: 600; font-size: 13px; color: #667eea; text-transform: capitalize;">
      <i class="fas fa-paw"></i> <?php echo htmlspecialchars($row['type'] ?? 'Animal'); ?>
    </div>
  </div>

  <div style="padding: 10px;">
    <h3 style="font-size: 24px; color: #2d3748; margin-bottom: 10px;"><?php echo htmlspecialchars($row['nom']); ?></h3>
    
    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px; color: #718096; font-size: 14px;">
      <i class="fas fa-birthday-cake"></i>
      <span><?php echo htmlspecialchars($row['age']); ?> ans</span>
    </div>

    <p style="color: #718096; line-height: 1.6; margin-bottom: 20px; font-size: 15px;">
      <?php echo htmlspecialchars(mb_strimwidth($row['description'] ?? '', 0, 100, '...')); ?>
    </p>

    <div style="display: grid; gap: 10px;">
      <a href="adoption.php?id=<?php echo (int)$row['id']; ?>" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; text-align: center; font-weight: 600; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
        <i class="fas fa-heart"></i> Adopter
      </a>
      <a href="favoris.php?id=<?php echo (int)$row['id']; ?>" style="background: white; color: #667eea; padding: 12px 20px; border-radius: 8px; text-decoration: none; text-align: center; font-weight: 600; border: 2px solid #667eea; transition: all 0.3s;" onmouseover="this.style.background='#667eea'; this.style.color='white'" onmouseout="this.style.background='white'; this.style.color='#667eea'">
        <i class="fas fa-star"></i> Favoris
      </a>
    </div>
  </div>

</div>

<?php } ?>

  </div>
</section>
<!-- Footer -->
<footer id="footer">
<div class="footer-container">

<div class="footer-links">
<h2>Quick Links</h2>

<div class="link-container">
<div class="links">
<a href="index.php">Home</a>
<a href="about.php">About</a>
<a href="pets.php">Pets</a>
</div>

<div class="links">
<a href="#">annonces</a>
<a href="service.php">Service</a>
<a href="contact.php">Contact Us</a>
</div>
</div>
</div>

<div class="footer-brand">
<h1>LALA<b class="accent">PA</b></h1>
<p>Find Your Purrfect Pet Soul Today!</p>

<div class="socials">
<a href="#"><i class="fa-brands fa-facebook-f"></i></a>
<a href="#"><i class="fa-brands fa-tiktok"></i></a>
<a href="#"><i class="fa-brands fa-twitter"></i></a>
<a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
</div>
</div>

<div class="footer-contact-info">
<div class="contact-info-item">
<i class="fa-regular fa-envelope"></i>
<p>lalapaanimal@outlook.com</p>
</div>

<div class="contact-info-item">
<i class="fa-solid fa-phone"></i>
<p>+216 55108240</p>
</div>
</div>

</div>

<p class="copyright">
All Rights Reserved to <b>LALAPA Org 2024</b>
</p>

</footer>

<script src="search_pets.js"></script>
</body>
</html>
