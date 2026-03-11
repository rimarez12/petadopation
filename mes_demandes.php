<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id'])){
    header('Location: Login.php');
    exit;
}

$isLoggedIn = true;
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$user_id = (int)$_SESSION['user_id'];

if(isset($_GET['cancel'])){
    $id = (int)$_GET['cancel'];
    if($id > 0){
        $stmt = mysqli_prepare($conn, "DELETE FROM demandes_adoption WHERE id = ? AND user_id = ?");
        mysqli_stmt_bind_param($stmt, "ii", $id, $user_id);
        mysqli_stmt_execute($stmt);
    }
    header('Location: mes_demandes.php');
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT d.id, d.statut, d.date_demande, a.nom as animal_nom, a.type as animal_type, a.race as animal_race, a.image as animal_image FROM demandes_adoption d LEFT JOIN animaux a ON a.id = d.animal_id WHERE d.user_id = ? ORDER BY d.id DESC");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="style.css" />
<script src="index.js" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
<title>LALAPA | Mes demandes</title>
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
    <a href="mes_demandes.php">Mes demandes</a>
    <a href="service.php">Service</a>
    <a href="contact.php">Contact</a>
    <?php if($isAdmin): ?>
      <a href="admin/index.php">Admin</a>
    <?php endif; ?>
  </div>
  <button class="btn-3" onclick="window.location.href='logout.php'">
    <p>Logout</p>
  </button>
  <div class="btn"><i class="fas fa-bars menu-btn"></i></div>
</nav>

<section style="padding: 30px;">
  <h2>Mes demandes d'adoption</h2>

  <div style="overflow:auto; margin-top: 16px;">
    <table border="1" cellpadding="8" cellspacing="0" style="background: white; border-collapse: collapse; width: 100%; max-width: 1200px;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Animal</th>
          <th>Statut</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php if($res): ?>
        <?php while($row = mysqli_fetch_assoc($res)): ?>
          <tr>
            <td><?php echo (int)$row['id']; ?></td>
            <td><?php echo htmlspecialchars(($row['animal_nom'] ?? '') . (isset($row['animal_type']) && $row['animal_type'] !== '' ? (' (' . $row['animal_type'] . ')') : '')); ?></td>
            <td><?php echo htmlspecialchars($row['statut'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($row['date_demande'] ?? ''); ?></td>
            <td>
              <a href="mes_demandes.php?cancel=<?php echo (int)$row['id']; ?>" onclick="return confirm('Annuler cette demande ?')">Annuler</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</section>
</body>
</html>
