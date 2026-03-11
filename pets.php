<?php
include("config.php");
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
</div>

<button class="btn-2" onclick="window.location.href='contact.php'">
<p>Contact Us</p>
<i class="fa-solid fa-circle-arrow-right"></i>
</button>

<div class="btn">
<i class="fas fa-bars menu-btn"></i>
</div>
</nav>

<!-- Section Pets -->
<section class="pets">

<h2>Pets Available for Adoption</h2>

<div class="pets-container">

<?php

$sql = "SELECT * FROM animaux";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){

?>

<div class="pet-card">

<img src="img/<?php echo $row['image']; ?>" alt="Animal">

<h3><?php echo $row['name']; ?></h3>

<p>Age : <?php echo $row['age']; ?> years</p>

<p><?php echo $row['description']; ?></p>

<!-- bouton adoption -->
<a href="adoption.php?id=<?php echo $row['id']; ?>">
<button>Adopt Me</button>
</a>

<!-- bouton favoris -->
<a href="favoris.php?id=<?php echo $row['id']; ?>">
<button>Add to Favorites</button>
</a>

</div>

<?php } ?>

</div>
</section>
<?php
include("config.php");

$sql = "SELECT * FROM animals";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Pets</title>

<style>

body{
    font-family: Arial;
    background:#f7f7f7;
}

.container{
    width:90%;
    margin:auto;
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:25px;
}

.card{
    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card img{
    width:100%;
    height:200px;
    object-fit:cover;
}

.card-content{
    padding:15px;
}

.card-content h3{
    margin:0;
}

.info{
    display:flex;
    justify-content:space-between;
    color:gray;
    font-size:14px;
}

.btn{
    background:#ff8c8c;
    color:white;
    padding:8px 18px;
    border:none;
    border-radius:20px;
    cursor:pointer;
    margin-top:10px;
}

.btn:hover{
    background:#ff6b6b;
}

</style>
</head>

<body>

<h2 style="text-align:center">Available Pets </h2>

<div class="container">

<?php
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
?>

<div class="card">
    <img src="images/<?php echo $row['image']; ?>">

    <div class="card-content">
        <h3><?php echo $row['name']; ?></h3>

        <div class="info">
            <span><?php echo $row['age']; ?></span>
            <span><?php echo $row['gender']; ?></span>
        </div>

        <button class="btn">Adopt →</button>
    </div>
</div>

<?php
    }
}
?>

</div>

</body>
</html>


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
<a href="#">Requirements</a>
<a href="stories.php">Stories</a>
<a href="contact.php">Contact Us</a>
</div>
</div>
</div>

<div class="footer-brand">
<h1>Purr<b class="accent">fect</b></h1>
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
<p>purrfect@gmail.com</p>
</div>

<div class="contact-info-item">
<i class="fa-solid fa-phone"></i>
<p>+204-512-5912</p>
</div>
</div>

</div>

<p class="copyright">
All Rights Reserved to <b>Purrfect Org 2024</b>
</p>

</footer>

</body>
</html>
