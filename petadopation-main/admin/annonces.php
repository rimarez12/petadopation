<?php
include("guard.php");
include("../config.php");

if(isset($_POST['create'])){
    $titre = trim($_POST['titre'] ?? '');
    $contenu = trim($_POST['contenu'] ?? '');

    $imageName = null;
    if(isset($_FILES['image']) && isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name']){
        $original = basename($_FILES['image']['name']);
        $ext = strtolower(pathinfo($original, PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','webp','gif'];
        if(in_array($ext, $allowed, true)){
            $imageName = uniqid('annonce_', true) . '.' . $ext;
            @mkdir(__DIR__ . '/../images', 0777, true);
            move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../images/' . $imageName);
        }
    }

    if($titre !== '' && $contenu !== ''){
        $stmt = mysqli_prepare($conn, "INSERT INTO annonces(titre, contenu, image) VALUES(?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $titre, $contenu, $imageName);
        mysqli_stmt_execute($stmt);
    }

    header("Location: annonces.php?success=created");
    exit;
}

if(isset($_POST['update'])){
    $id = (int)($_POST['id'] ?? 0);
    $titre = trim($_POST['titre'] ?? '');
    $contenu = trim($_POST['contenu'] ?? '');

    $imageName = $_POST['current_image'] ?? null;
    if(isset($_FILES['image']) && isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name']){
        $original = basename($_FILES['image']['name']);
        $ext = strtolower(pathinfo($original, PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','webp','gif'];
        if(in_array($ext, $allowed, true)){
            $imageName = uniqid('annonce_', true) . '.' . $ext;
            @mkdir(__DIR__ . '/../images', 0777, true);
            move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../images/' . $imageName);
        }
    }

    if($id > 0 && $titre !== '' && $contenu !== ''){
        $stmt = mysqli_prepare($conn, "UPDATE annonces SET titre = ?, contenu = ?, image = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "sssi", $titre, $contenu, $imageName, $id);
        mysqli_stmt_execute($stmt);
    }

    header("Location: annonces.php?success=updated");
    exit;
}

if(isset($_POST['set_status'])){
    $id = (int)($_POST['id'] ?? 0);
    $statut = trim($_POST['statut'] ?? '');
    $allowed = ['En attente', 'Acceptée', 'Refusée'];

    if($id > 0 && in_array($statut, $allowed, true)){
        $stmt = mysqli_prepare($conn, "UPDATE annonces SET statut = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $statut, $id);
        mysqli_stmt_execute($stmt);
    }

    header("Location: annonces.php?success=status_updated");
    exit;
}

if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    if($id > 0){
        $stmt = mysqli_prepare($conn, "DELETE FROM annonces WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    }
    header("Location: annonces.php?success=deleted");
    exit;
}

$edit = null;
if(isset($_GET['edit'])){
    $id = (int)$_GET['edit'];
    if($id > 0){
        $stmt = mysqli_prepare($conn, "SELECT * FROM annonces WHERE id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $edit = $res ? mysqli_fetch_assoc($res) : null;
    }
}

$result = mysqli_query($conn, "SELECT * FROM annonces ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Annonces - Admin LALAPA</title>
  <link rel="stylesheet" href="admin-style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <nav>
    <div class="nav-container">
      <a href="../index.php" class="brand">
        LALA<span class="accent">PA</span>
      </a>
      <ul class="nav-links">
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="associations.php">Associations</a></li>
        <li><a href="animals.php">Animaux</a></li>
        <li><a href="requests.php">Demandes</a></li>
        <li><a href="annonces.php" class="active">Annonces</a></li>
        <li><a href="messages.php">Messages</a></li>
        <li><a href="users.php">Utilisateurs</a></li>
      </ul>
    </div>
  </nav>

  <div class="main-content">
    <div class="page-header">
      <h1>Gérer les annonces</h1>
      <p>Créer, modifier ou valider des annonces</p>
    </div>

    <?php if(isset($_GET['success'])): ?>
      <div class="alert alert-success">
        <?php 
          if($_GET['success'] === 'created') echo 'Annonce créée avec succès!';
          if($_GET['success'] === 'updated') echo 'Annonce modifiée avec succès!';
          if($_GET['success'] === 'status_updated') echo 'Statut mis à jour avec succès!';
          if($_GET['success'] === 'deleted') echo 'Annonce supprimée avec succès!';
        ?>
      </div>
    <?php endif; ?>

    <div class="card">
      <?php if($edit): ?>
        <h2>Modifier l'annonce</h2>
        <form method="POST" enctype="multipart/form-data" class="form-grid">
        <input type="hidden" name="id" value="<?php echo (int)$edit['id']; ?>">
        <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($edit['image'] ?? ''); ?>">
        <input name="titre" placeholder="Titre" value="<?php echo htmlspecialchars($edit['titre'] ?? ''); ?>" required>
        <textarea name="contenu" placeholder="Contenu" rows="6" required><?php echo htmlspecialchars($edit['contenu'] ?? ''); ?></textarea>
        <input type="file" name="image" accept="image/*">
        <div style="display: flex; gap: 10px;">
          <button type="submit" name="update" class="btn-primary">Enregistrer</button>
          <a href="annonces.php" class="btn-secondary">Annuler</a>
        </div>
      </form>
    <?php else: ?>
      <h2>Créer une annonce</h2>
      <form method="POST" enctype="multipart/form-data" class="form-grid">
        <input name="titre" placeholder="Titre" required>
        <textarea name="contenu" placeholder="Contenu" rows="6" required></textarea>
        <input type="file" name="image" accept="image/*">
        <button type="submit" name="create" class="btn-primary">Créer</button>
      </form>
    <?php endif; ?>
    </div>

    <div class="card">
      <h2>Liste des annonces</h2>
      <div class="table-container">
        <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Statut</th>
            <th>Changer statut</th>
            <th>Date</th>
            <th>Image</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php if($result): ?>
          <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?php echo (int)$row['id']; ?></td>
              <td><?php echo htmlspecialchars($row['titre'] ?? ''); ?></td>
              <td>
                <?php 
                  $statut = $row['statut'] ?? 'En attente';
                  $badge_class = 'badge-pending';
                  if($statut === 'Acceptée') $badge_class = 'badge-accepted';
                  if($statut === 'Refusée') $badge_class = 'badge-rejected';
                ?>
                <span class="badge <?php echo $badge_class; ?>"><?php echo htmlspecialchars($statut); ?></span>
              </td>
              <td>
                <form method="POST" style="display:flex; gap: 8px; align-items: center;">
                  <input type="hidden" name="id" value="<?php echo (int)$row['id']; ?>">
                  <select name="statut">
                    <option value="En attente" <?php echo ($row['statut'] ?? '') === 'En attente' ? 'selected' : ''; ?>>En attente</option>
                    <option value="Acceptée" <?php echo ($row['statut'] ?? '') === 'Acceptée' ? 'selected' : ''; ?>>Acceptée</option>
                    <option value="Refusée" <?php echo ($row['statut'] ?? '') === 'Refusée' ? 'selected' : ''; ?>>Refusée</option>
                  </select>
                  <button name="set_status">OK</button>
                </form>
              </td>
              <td><?php echo htmlspecialchars($row['date_creation'] ?? ''); ?></td>
              <td>
                <?php if(!empty($row['image'])): ?>
                  <a href="../images/<?php echo rawurlencode($row['image']); ?>" target="_blank">Voir</a>
                <?php endif; ?>
              </td>
              <td>
                <a href="annonces.php?edit=<?php echo (int)$row['id']; ?>"><i class="fas fa-edit"></i> Modifier</a>
                |
                <a href="annonces.php?delete=<?php echo (int)$row['id']; ?>" onclick="return confirm('Supprimer cette annonce ?')" style="color: #e53e3e;"><i class="fas fa-trash"></i> Supprimer</a>
              </td>
            </tr>
          <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="7" style="text-align: center; padding: 30px; color: #718096;">Aucune annonce trouvée</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
