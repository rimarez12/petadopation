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
        <a href="ourteam.php">Our Team</a>
        <a href="pets.php">Pets</a>
        <a href="service.php">Service</a>
      </div>

      <button class="btn-2" onclick="window.location.href='contact.php'">
        <p>Contact Us</p>
        <i class="fa-solid fa-circle-arrow-right"></i>
      </button>

      <div class="btn">
        <i class="fas fa-bars menu-btn"></i>
      </div>
    </nav>
    <section class="team">
    <div class="container">
        <h2 class="team-title">Meet Our Team</h2>

        <div class="team-container">

            <div class="team-card">
                <img src="img/Sarah Ben Ali.jpg" alt="">
                <h3>Malek mili</h3>
                <p>Veterinarian</p>
            </div>

            <div class="team-card">
                <img src="img/Ahmed Trabelsi.jpg" alt="">
                <h3>Houssem kteta</h3>
                <p>Animal Care Specialist</p>
            </div>

            <div class="team-card">
                <img src="img/Leila Mansour.jpg" alt="">
                <h3>Souha othmen</h3>
                <p>Adoption Coordinator</p>
            </div>

            <div class="team-card">
                <img src="img/Youssef Gharbi.jpg" alt="">
                <h3>Oussema ben abdallah</h3>
                <p>Volunteer Manager</p>
            </div>

        </div>
    </div>
</section>
<div class="join-team">
<h3>Want to help animals with us?</h3>
<a href="register.php" class="join-btn">Become a Volunteer</a>
</div>
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