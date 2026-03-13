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
        <h1 style="font-size: 48px; margin-bottom: 20px;">Notre Équipe</h1>
        <p style="font-size: 20px; line-height: 1.6;">
          Rencontrez les personnes passionnées qui se dévouent chaque jour pour le bien-être de nos animaux.
        </p>
      </div>
    </section>

    <!-- Team Section -->
    <section style="padding: 60px 30px; max-width: 1200px; margin: 0 auto;">
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
        
        <div style="background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); overflow: hidden; text-align: center; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
          <img src="img/Sarah Ben Ali.jpg" alt="Malek" style="width: 100%; height: 280px; object-fit: cover;">
          <div style="padding: 25px;">
            <h3 style="font-size: 24px; color: #2d3748; margin-bottom: 8px;">Malek Mili</h3>
            <p style="color: #667eea; font-weight: 600; margin-bottom: 15px;"><i class="fas fa-stethoscope"></i> Vétérinaire</p>
            <p style="color: #718096; line-height: 1.6; font-size: 14px;">
              Expert en soins vétérinaires avec 10 ans d'expérience dans le sauvetage d'animaux.
            </p>
          </div>
        </div>

        <div style="background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); overflow: hidden; text-align: center; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
          <img src="img/Ahmed Trabelsi.jpg" alt="Houssem" style="width: 100%; height: 280px; object-fit: cover;">
          <div style="padding: 25px;">
            <h3 style="font-size: 24px; color: #2d3748; margin-bottom: 8px;">Houssem Kteta</h3>
            <p style="color: #43e97b; font-weight: 600; margin-bottom: 15px;"><i class="fas fa-heart"></i> Spécialiste Soins Animaux</p>
            <p style="color: #718096; line-height: 1.6; font-size: 14px;">
              Passionné par le bien-être animal, il assure les soins quotidiens de nos protégés.
            </p>
          </div>
        </div>

        <div style="background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); overflow: hidden; text-align: center; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
          <img src="img/Leila Mansour.jpg" alt="Souha" style="width: 100%; height: 280px; object-fit: cover;">
          <div style="padding: 25px;">
            <h3 style="font-size: 24px; color: #2d3748; margin-bottom: 8px;">Souha Othmen</h3>
            <p style="color: #fa709a; font-weight: 600; margin-bottom: 15px;"><i class="fas fa-users"></i> Coordinatrice Adoptions</p>
            <p style="color: #718096; line-height: 1.6; font-size: 14px;">
              Elle accompagne les familles dans leur projet d'adoption pour garantir le meilleur match.
            </p>
          </div>
        </div>

        <div style="background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); overflow: hidden; text-align: center; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
          <img src="img/Youssef Gharbi.jpg" alt="Oussema" style="width: 100%; height: 280px; object-fit: cover;">
          <div style="padding: 25px;">
            <h3 style="font-size: 24px; color: #2d3748; margin-bottom: 8px;">Oussema Ben Abdallah</h3>
            <p style="color: #4facfe; font-weight: 600; margin-bottom: 15px;"><i class="fas fa-hands-helping"></i> Responsable Bénévoles</p>
            <p style="color: #718096; line-height: 1.6; font-size: 14px;">
              Il coordonne notre équipe de bénévoles dévoués qui font vivre notre mission.
            </p>
          </div>
        </div>

      </div>
    </section>

    <!-- CTA Section -->
    <section style="padding: 80px 30px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); text-align: center;">
      <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: 36px; color: white; margin-bottom: 20px;">Vous voulez aider les animaux avec nous ?</h2>
        <p style="font-size: 18px; color: white; margin-bottom: 30px; opacity: 0.9;">
          Rejoignez notre équipe de bénévoles et faites la différence dans la vie des animaux abandonnés.
        </p>
        <a href="register.php" style="background: white; color: #43e97b; padding: 15px 40px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-block; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
          <i class="fas fa-user-plus"></i> Devenir Bénévole
        </a>
      </div>
    </section>

    <footer id="footer">
      <div class="footer-container">
        <div class="footer-links">
          <h2>Quick Links</h2>
          <div class="link-container">
            <div class="links">
              <a href="/">Home</a>
              <a href="index.php#about">About</a>
              <a href="index.php#pets">Pets</a>
            </div>
            <div class="links">
              <a href="/">Requirements</a>
              <a href="index.php#service">Service</a>
              <a href="index.php#footer">Contact Us</a>
            </div>
          </div>
        </div>
        <div class="footer-brand">
          <h1>LALA<b class="accent">PA</b></h1>
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
            <p>lalapaanimal@gmail.com</p>
          </div>
          <div class="contact-info-item">
            <i class="fa-solid fa-phone"></i>
            <p>+216 55108240</p>
          </div>
        </div>
      </div>
      <p class="copyright">All Rights Reserved to <b>Purrfect Org 2024</b></p>
    </footer>
  </body>
</html>