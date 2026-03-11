<?php
include("guard.php");
include("../config.php");

$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$user_id = (int)$_SESSION['user_id'];

if(isset($_GET['remove'])){
    $id = (int)$_GET['remove'];
    if($id > 0){
        $stmt = mysqli_prepare($conn, "DELETE FROM favoris WHERE id = ? AND user_id = ?");
        mysqli_stmt_bind_param($stmt, "ii", $id, $user_id);
        mysqli_stmt_execute($stmt);
    }
    header('Location: favorites.php');
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT f.id as fav_id, a.id as animal_id, a.nom, a.age, a.type, a.race, a.description, a.image FROM favoris f INNER JOIN animaux a ON a.id = f.animal_id WHERE f.user_id = ? ORDER BY f.id DESC");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../style.css" />
  <script src="../index.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
  <title>LALAPA | Mes favoris</title>
</head>
<body>
  <nav>
    <a href="../index.php" class="brand">
      <h1>LALA<b class="accent">PA</b></h1>
    </a>
    <div class="menu">
      <a href="index.php">Dashboard</a>
      <a href="../pets.php">Animaux</a>
      <a href="../annonces.php">Annonces</a>
      <a href="../mes_demandes.php">Mes demandes</a>
      <a href="favorites.php">Mes favoris</a>
      <a href="../contact.php">Contacter</a>
      <?php if($isAdmin): ?>
        <a href="../admin/index.php">Admin</a>
      <?php endif; ?>
    </div>

    <button class="btn-3" onclick="window.location.href='../logout.php'">
      <p>Logout</p>
    </button>

    <div class="btn">
      <i class="fas fa-bars menu-btn"></i>
    </div>
  </nav>

  <section style="padding: 30px;">
    <h2>Mes favoris</h2>

    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px; margin-top: 16px;">
      <?php if($res): ?>
        <?php while($row = mysqli_fetch_assoc($res)): ?>
          <div style="background:white; border: 1px solid #ddd; border-radius: 10px; overflow:hidden;">
            <?php if(!empty($row['image'])): ?>
              <img src="../images/<?php echo htmlspecialchars($row['image']); ?>" alt="animal" style="width:100%; height: 180px; object-fit: cover;">
            <?php endif; ?>
            <div style="padding: 14px;">
              <h3 style="margin: 0 0 8px 0;"><?php echo htmlspecialchars($row['nom'] ?? ''); ?></h3>
              <p style="margin: 0 0 10px 0;">
                <?php echo htmlspecialchars((string)($row['type'] ?? '')); ?>
                <?php echo isset($row['race']) && $row['race'] !== '' ? (' - ' . htmlspecialchars($row['race'])) : ''; ?>
              </p>
              <div style="display:flex; gap: 10px;">
                <a href="../adoption.php?id=<?php echo (int)$row['animal_id']; ?>">Adopter</a>
                <a href="favorites.php?remove=<?php echo (int)$row['fav_id']; ?>" onclick="return confirm('Retirer des favoris ?')">Retirer</a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </section>
</body>
</html>
