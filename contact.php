<?php
session_start();

include("config.php");

$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

$messageSuccess = "";
$messageError = "";

if(isset($_POST['send'])){
  $nom = trim($_POST['nom'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $sujet = trim($_POST['sujet'] ?? '');
  $message = trim($_POST['message'] ?? '');
  $user_id = $isLoggedIn ? (int)$_SESSION['user_id'] : null;

  if($nom !== '' && $email !== '' && $message !== ''){
    $stmt = mysqli_prepare($conn, "INSERT INTO messages_contact(user_id, nom, email, sujet, message) VALUES(?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "issss", $user_id, $nom, $email, $sujet, $message);
    if(mysqli_stmt_execute($stmt)){
      $messageSuccess = "Message envoyé.";
    } else {
      $messageError = "Erreur lors de l'envoi.";
    }
  } else {
    $messageError = "Veuillez remplir les champs obligatoires.";
  }
}
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
      <a href="index.php" class="brand">
        <h1>LALA<b class="accent">PA</b></h1>
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
        <a href="contact.php">Contact</a>
        <a href="annonces.php">Annonces</a>
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
        <h1 style="font-size: 48px; margin-bottom: 20px;">Contactez-Nous</h1>
        <p style="font-size: 20px; line-height: 1.6;">
          Une question ? Un projet d'adoption ? Notre équipe est là pour vous aider.
        </p>
      </div>
    </section>

    <!-- Contact Section -->
    <section style="padding: 60px 30px; max-width: 1200px; margin: 0 auto;">
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 40px;">
        
        <!-- Contact Form -->
        <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
          <h2 style="font-size: 28px; color: #2d3748; margin-bottom: 20px;">Envoyez-nous un message</h2>
          
          <?php if($messageSuccess): ?>
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
              <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($messageSuccess); ?>
            </div>
          <?php endif; ?>
          <?php if($messageError): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
              <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($messageError); ?>
            </div>
          <?php endif; ?>

          <form method="POST" style="display: grid; gap: 15px;">
            <div>
              <label style="display: block; color: #4a5568; font-weight: 600; margin-bottom: 5px;">Nom *</label>
              <input name="nom" placeholder="Votre nom" value="<?php echo htmlspecialchars($isLoggedIn ? ($_SESSION['nom'] ?? '') : ''); ?>" required style="width: 100%; padding: 12px 15px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 15px;">
            </div>
            <div>
              <label style="display: block; color: #4a5568; font-weight: 600; margin-bottom: 5px;">Email *</label>
              <input type="email" name="email" placeholder="votre@email.com" required style="width: 100%; padding: 12px 15px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 15px;">
            </div>
            <div>
              <label style="display: block; color: #4a5568; font-weight: 600; margin-bottom: 5px;">Sujet</label>
              <input name="sujet" placeholder="Sujet de votre message" style="width: 100%; padding: 12px 15px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 15px;">
            </div>
            <div>
              <label style="display: block; color: #4a5568; font-weight: 600; margin-bottom: 5px;">Message *</label>
              <textarea name="message" placeholder="Votre message..." rows="6" required style="width: 100%; padding: 12px 15px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 15px; font-family: inherit;"></textarea>
            </div>
            <button name="send" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px 30px; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
              <i class="fas fa-paper-plane"></i> Envoyer le message
            </button>
          </form>
        </div>

        <!-- Contact Info -->
        <div>
          <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin-bottom: 30px;">
            <h2 style="font-size: 28px; color: #2d3748; margin-bottom: 25px;">Informations de contact</h2>
            
            <div style="display: grid; gap: 20px;">
              <div style="display: flex; align-items: start; gap: 15px;">
                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                  <i class="fas fa-envelope" style="font-size: 22px; color: white;"></i>
                </div>
                <div>
                  <h3 style="font-size: 18px; color: #2d3748; margin-bottom: 5px;">Email</h3>
                  <p style="color: #718096;">purrfect@gmail.com</p>
                </div>
              </div>

              <div style="display: flex; align-items: start; gap: 15px;">
                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                  <i class="fas fa-phone" style="font-size: 22px; color: white;"></i>
                </div>
                <div>
                  <h3 style="font-size: 18px; color: #2d3748; margin-bottom: 5px;">Téléphone</h3>
                  <p style="color: #718096;">+216 55 108 240</p>
                </div>
              </div>

              <div style="display: flex; align-items: start; gap: 15px;">
                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                  <i class="fas fa-clock" style="font-size: 22px; color: white;"></i>
                </div>
                <div>
                  <h3 style="font-size: 18px; color: #2d3748; margin-bottom: 5px;">Horaires</h3>
                  <p style="color: #718096;">Lun - Ven: 9h - 18h<br>Sam: 10h - 16h</p>
                </div>
              </div>
            </div>
          </div>

          <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); padding: 30px; border-radius: 12px; color: white; text-align: center;">
            <i class="fas fa-info-circle" style="font-size: 40px; margin-bottom: 15px;"></i>
            <h3 style="font-size: 22px; margin-bottom: 10px;">Besoin d'aide ?</h3>
            <p style="opacity: 0.9; line-height: 1.6;">
              Notre équipe répond généralement sous 24h. Pour les urgences, appelez-nous directement.
            </p>
          </div>
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
              <a href="about.php">About</a>
              <a href="pets.php">Pets</a>
            </div>
            <div class="links">
              <a href="/">Requirements</a>
              <a href="service.php">Service</a>
              <a href="contact.php">Contact Us</a>
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
            <p>purrfect@gmail.com</p>
          </div>
          <div class="contact-info-item">
            <i class="fa-solid fa-phone"></i>
            <p>+21655108240</p>
          </div>
        </div>
      </div>
      <p class="copyright">All Rights Reserved to <b>Purrfect Org 2024</b></p>
    </footer>
  </body>
</html>