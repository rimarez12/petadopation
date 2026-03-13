<?php
session_start();

$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <!-- Use for responsiveness -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- link To CSS -->
    <link rel="stylesheet" href="style.css" />
    <!-- link To JS -->
    <script src="index.js" defer></script>
    <!-- For Scroll Reveal -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <!-- For Icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- Link For Gsap -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"
      integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <!-- Link For Gsap - Scroll Trigger -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"
      integrity="sha512-onMTRKJBKz8M1TnqqDuGBlowlH0ohFzMXYRNebz+yOcc5TQr/zAKsthzhuv0hiyUKEiQEQXEynnXCvNTOk50dg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <!-- Link For Lenis - Smooth Scrolling -->
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>
    <!-- Link For Split Type -->
    <script src="https://cdn.jsdelivr.net/npm/split-type@0.3.4/umd/index.min.js"></script>

    <title>Purrfect | Pet Adoption</title>
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
        <a href="service.php">Service</a>
        <a href="pets.php">Pets</a>
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

    <!-- About Section -->
    <section style="padding: 80px 30px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-align: center;">
      <div style="max-width: 800px; margin: 0 auto;">
        <h1 style="font-size: 48px; margin-bottom: 20px;">À Propos de LALAPA</h1>
        <p style="font-size: 20px; line-height: 1.6;">
          Nous sommes une organisation dédiée à la protection et à l'adoption d'animaux abandonnés. 
          Notre mission est de donner une seconde chance à chaque animal en leur trouvant un foyer aimant.
        </p>
      </div>
    </section>

    <!-- Mission Section -->
    <section style="padding: 60px 30px; max-width: 1200px; margin: 0 auto;">
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px; align-items: center;">
        <div>
          <h2 style="font-size: 36px; color: #2d3748; margin-bottom: 20px;">Notre Mission</h2>
          <p style="font-size: 18px; line-height: 1.8; color: #4a5568;">
            Depuis notre création, nous avons sauvé et placé des centaines d'animaux dans des foyers aimants. 
            Nous travaillons avec des associations locales pour offrir les meilleurs soins à nos protégés.
          </p>
          <ul style="margin-top: 20px; font-size: 16px; color: #4a5568; line-height: 2;">
            <li><i class="fas fa-check" style="color: #667eea;"></i> Sauvetage d'animaux abandonnés</li>
            <li><i class="fas fa-check" style="color: #667eea;"></i> Soins vétérinaires complets</li>
            <li><i class="fas fa-check" style="color: #667eea;"></i> Placement responsable</li>
            <li><i class="fas fa-check" style="color: #667eea;"></i> Suivi post-adoption</li>
          </ul>
        </div>
        <div>
          <img src="images/dog1.jpg" alt="Mission" style="width: 100%; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1);">
        </div>
      </div>
    </section>

    <!-- Values Section -->
    <section style="padding: 60px 30px; background: #f5f7fa;">
      <div style="max-width: 1200px; margin: 0 auto;">
        <h2 style="font-size: 36px; color: #2d3748; text-align: center; margin-bottom: 50px;">Nos Valeurs</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
          <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); text-align: center;">
            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
              <i class="fas fa-heart" style="font-size: 28px; color: white;"></i>
            </div>
            <h3 style="font-size: 22px; color: #2d3748; margin-bottom: 15px;">Compassion</h3>
            <p style="color: #718096; line-height: 1.6;">Chaque animal mérite amour et respect</p>
          </div>
          <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); text-align: center;">
            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
              <i class="fas fa-shield-alt" style="font-size: 28px; color: white;"></i>
            </div>
            <h3 style="font-size: 22px; color: #2d3748; margin-bottom: 15px;">Protection</h3>
            <p style="color: #718096; line-height: 1.6;">Sauver et protéger les animaux vulnérables</p>
          </div>
          <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); text-align: center;">
            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
              <i class="fas fa-users" style="font-size: 28px; color: white;"></i>
            </div>
            <h3 style="font-size: 22px; color: #2d3748; margin-bottom: 15px;">Communauté</h3>
            <p style="color: #718096; line-height: 1.6;">Ensemble pour un monde meilleur</p>
          </div>
          <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); text-align: center;">
            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
              <i class="fas fa-handshake" style="font-size: 28px; color: white;"></i>
            </div>
            <h3 style="font-size: 22px; color: #2d3748; margin-bottom: 15px;">Transparence</h3>
            <p style="color: #718096; line-height: 1.6;">Honnêteté et clarté dans toutes nos actions</p>
          </div>
        </div>
      </div>
    </section>

    <!-- STATISTICS -->
    <section class="stats">
      <h2>We Provide with</h2>
      <div class="stat-container">
        <div class="stat">
          <h3>150+</h3>
          <p>Professionals Team</p>
        </div>
        <div class="stat">
          <h3>10+</h3>
          <p>Years of Experience</p>
        </div>
        <div class="stat">
          <h3>120K</h3>
          <p>Projects Delivered</p>
        </div>
        <div class="stat">
          <h3>50K</h3>
          <p>Happy Client</p>
        </div>
      </div>
    </section>

    <footer id="footer">
      <div class="footer-container">
        <div class="footer-links">
          <h2>Quick Links</h2>
          <div class="link-container">
            <div class="links">
              <a href="/">Home</a>
              <a href="index.html#about">About</a>
              <a href="index.html#pets">Pets</a>
            </div>
            <div class="links">
              <a href="/">Requirements</a>
              <a href="index.html#stories">Stories</a>
              <a href="index.html#footer">Contact Us</a>
            </div>
          </div>
        </div>
        <div class="footer-brand">
          <h1>Purr<b class="accent">fect</b></h1>
          <p>Find Your Purrfect Pet Soul Today!</p>
          <div class="socials">
            <a href="/"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="/"><i class="fa-brands fa-tiktok"></i></a>
            <a href="/"><i class="fa-brands fa-twitter"></i></a>
            <a href="/"><i class="fa-brands fa-linkedin-in"></i></a>
          </div>
        </div>
        <div class="footer-contact-info">
          <div class="contact-info-item">
            <i class="fa-regular fa-envelope"></i>
            <p>purrfect@gmail.com</p>
          </div>
          <div class="contact-info-item">
            <i class="fa-solid fa-phone"></i>
            <p>+204-512-5912</p>
          </div>
        </div>
      </div>
      <p class="copyright">All Rights Reserved to <b>Purrfect Org 2024</b></p>
    </footer>
  </body>
</html>