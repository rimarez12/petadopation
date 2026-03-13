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
    <link rel="stylesheet" href="style.css">
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
        <!-- <h1>LALA<b class="accent">PA</b></h1>
        
      
      </a> -->
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
    <!-- Navbar End -->

    <!-- Hero Page Section -->
    <section class="heropage">
      <div class="hero-headlines">
        
      </div>
    
    </section>
</div>
    <!-- Hero Page Section End -->
    <!-- requirements Section -->
    <section class="requirements" id="requirements">
      <div class="requirements-headlines">
        <h1>Our Process For Adoption</h1>
        <p>Our process is simple and filled with joy every step of the way:</p>

        <div class="r-item-container">
          <!-- r-item #1 -->
          <div class="r-item">
            <div class="r-logo" style="background-color: #3D64AF">
              <i class="fa-regular fa-newspaper"></i>
            </div>
            <h5>Submitting an application</h5>
          </div>

          <!-- r-item #2 -->
          <div class="r-item">
            <div class="r-logo" style="background-color: #3D64AF">
              <i class="fa-solid fa-phone"></i>
            </div>
            <h5>Attending an online interview</h5>
          </div>

          <!-- r-item #3 -->
          <div class="r-item">
            <div class="r-logo" style="background-color: #2f2656">
              <i class="fa-solid fa-paw"></i>
            </div>
            <h5>Meeting the pet in person</h5>
          </div>

          <!-- r-item #4 -->
          <div class="r-item">
            <div class="r-logo" style="background-color: #46c7ff">
              <i class="fa-regular fa-file-zipper"></i>
            </div>
            <h5>Signing an adoption agreement</h5>
          </div>

          <!-- r-item #5 -->
          <div class="r-item">
            <div class="r-logo" style="background-color: #4fffca">
              <i class="fa-solid fa-handshake"></i>
            </div>
            <h5>Congratulations on finding a match!</h5>
          </div>
        </div>
      </div>
      <img src="img/requirements-img.png" alt="img" />
    </section>
    <!-- requirements Section End -->

    <!-- Pets Section -->
    <section class="pets" id="pets">
      <div class="pets-headlines">
        <i class="fa-solid fa-paw"></i>

      </div>
        
        <div class="pet-item">
        
        </div>
      </div>
      <button class="btn-3 btn-pets">
        <p>Find More Pets</p>
        <i class="fa-solid fa-arrow-right-long"></i>
      </button>
    </section>
    <!-- Pets Section End -->

    <!-- About Section -->
    <div class="about" id="about">
      <div class="about-headlines">
        <h1>About Us</h1>
        <p class="reveal-type" data-bg-color="#cccccc" data-fg-color="black">
          LALAPA is not just a
          <b>pet adoption website</b>; it's a haven for both pets in search of
          their forever homes and compassionate individuals ready to welcome
          them with open arms.
        </p>
        <div class="about-info">
          <div class="about-info-item">
            <h5>100+</h5>
            <h6>Saved Pets</h6>
          </div>
          <hr class="about-info-divider" />
          <div class="about-info-item">
            <h5>100%</h5>
            <h6>Adoption Rate</h6>
          </div>
          <hr class="about-info-divider" />
          <div class="about-info-item">
            <h5>5 Star</h5>
            <h6>Community Loved</h6>
          </div>
        </div>
        <button class="btn-3">Get Started</button>
      </div>
      <img src="img/about-img.png" alt="img" />
    </div>
    <!-- About Section End -->

    <!-- Testimonials Section -->
    <div class="testimonials" id="stories">
      <h6>OUR REVIEWS</h6>
      <h1>What People Say</h1>

      <div class="testimony-container">
        <!-- Testimony Item 1 -->
        <div class="testimony-item">
          <div class="testimony-people">
            <div class="testimony-name">
              <img src="img/testimony-image-1.png" alt="img" />
              <div class="testimony-name-item">
                <h4>habiba hamrouni</h4>
                <p>Sir Garfield’s Owner</p>
              </div>
            </div>
            <i class="fa-solid fa-quote-right"></i>
          </div>
          <p class="testimony-text">
            My experience with LALAPA has been nothing short of amazing. After
            losing my previous pet, I was hesitant to open my heart again, but
            Purrfect made the process smooth and comforting.
          </p>
        </div>

        <!-- Testimony Item 2 -->
        <div class="testimony-item">
          <div class="testimony-people">
            <div class="testimony-name">
              <img src="img/testimony-image-2.png" alt="img" />
              <div class="testimony-name-item">
                <h4>ahmed sassi</h4>
                <p>Quacky’s Owner</p>
              </div>
            </div>
            <i class="fa-solid fa-quote-right"></i>
          </div>
          <p class="testimony-text">
            As a long-time advocate for pet adoption, I can confidently say that
            LALAPA goes above and beyond in their mission to find loving homes
            for animals in need.
          </p>
        </div>

        <!-- Testimony Item 3 -->
        <div class="testimony-item">
          <div class="testimony-people">
            <div class="testimony-name">
              <img src="img/testimony-image-3.png" alt="img" />
              <div class="testimony-name-item">
                <h4>Sara mahjoub</h4>
                <p>Ratatuwi’s Owner</p>
              </div>
            </div>
            <i class="fa-solid fa-quote-right"></i>
          </div>
          <p class="testimony-text">
            I'll forever be grateful to LALAPA for bringing my best friend
            into my life. Adopting a pet was a big decision for me, but Purrfect
            made it feel like the most natural choice in the world.
          </p>
        </div>
      </div>
    </div>
    <!-- Testimonials Section End -->

    <!-- Footer Section -->
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
              <a href="index.php#stories">Stories</a>
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
