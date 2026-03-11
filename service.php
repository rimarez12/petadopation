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
      <a href="index.html" class="brand">
        <h1>LALA<b class="accent">PA</b></h1>
      </a>
      <div class="menu">
        <div class="btn">
          <i class="fas fa-times close-btn"></i>
        </div>
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="ourtram.php">Our Team</a>
        <a href="pets.php">Pets</a>
        <a href="service.php">Service</a>
      </div>

      <button class="btn-2" onclick="window.location.href='contact.html'">
        <p>Contact Us</p>
        <i class="fa-solid fa-circle-arrow-right"></i>
      </button>

      <div class="btn">
        <i class="fas fa-bars menu-btn"></i>
      </div>
    </nav>
    <section class="stories-section">

<h1>Happy Adoption Stories 🐾</h1>

<div class="stories-container">

    <div class="story-card">
        <img src="img/dogsauve.jpg">
        <div class="story-content">
            <h3>Bella's New Life</h3>
            <p>
            Bella était abandonnée dans la rue. Aujourd’hui elle vit
            heureuse avec sa nouvelle famille.
            </p>
        </div>
    </div>

    <div class="story-card">
        <img src="img/catsauve.jpg">
        <div class="story-content">
            <h3>Max Found a Home</h3>
            <p>
            Max a été sauvé par une association et adopté après
            seulement deux semaines.
            </p>
        </div>
    </div>

    <div class="story-card">
        <img src="img/dogsauve2.jpg">
        <div class="story-content">
            <h3>Luna's Journey</h3>
            <p>
            Luna a retrouvé confiance grâce à sa nouvelle famille.
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