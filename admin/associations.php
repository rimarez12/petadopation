<?php
include("guard.php");
include("../config.php");

$message = "";

if(isset($_POST['create'])){
    $nom = trim($_POST['nom']);
    $adresse = trim($_POST['adresse']);
    $telephone = trim($_POST['telephone']);
    $email = trim($_POST['email']);

    $stmt = mysqli_prepare($conn, "INSERT INTO associations(nom, adresse, telephone, email) VALUES(?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $nom, $adresse, $telephone, $email);
    mysqli_stmt_execute($stmt);

    header("Location: associations.php?success=created");
    exit;
}

if(isset($_POST['update'])){
    $id = (int)($_POST['id'] ?? 0);
    $nom = trim($_POST['nom']);
    $adresse = trim($_POST['adresse']);
    $telephone = trim($_POST['telephone']);
    $email = trim($_POST['email']);

    if($id > 0){
        $stmt = mysqli_prepare($conn, "UPDATE associations SET nom = ?, adresse = ?, telephone = ?, email = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "ssssi", $nom, $adresse, $telephone, $email, $id);
        mysqli_stmt_execute($stmt);
    }

    header("Location: associations.php?success=updated");
    exit;
}

if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    if($id > 0){
        $stmt = mysqli_prepare($conn, "DELETE FROM associations WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    }
    header("Location: associations.php?success=deleted");
    exit;
}

$edit = null;
if(isset($_GET['edit'])){
    $id = (int)$_GET['edit'];
    if($id > 0){
        $stmt = mysqli_prepare($conn, "SELECT * FROM associations WHERE id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $edit = $res ? mysqli_fetch_assoc($res) : null;
    }
}

$result = mysqli_query($conn, "SELECT * FROM associations ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Associations - Admin LALAPA</title>
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
        <li><a href="associations.php" class="active">Associations</a></li>
        <li><a href="animals.php">Animaux</a></li>
        <li><a href="requests.php">Demandes</a></li>
        <li><a href="annonces.php">Annonces</a></li>
        <li><a href="messages.php">Messages</a></li>
        <li><a href="users.php">Utilisateurs</a></li>
      </ul>
    </div>
  </nav>

  <div class="main-content">
    <div class="page-header">
      <h1>Gérer les associations</h1>
      <p>Ajouter, modifier ou supprimer des associations</p>
    </div>

    <?php if(isset($_GET['success'])): ?>
      <div class="alert alert-success">
        <?php 
          if($_GET['success'] === 'created') echo 'Association créée avec succès!';
          if($_GET['success'] === 'updated') echo 'Association modifiée avec succès!';
          if($_GET['success'] === 'deleted') echo 'Association supprimée avec succès!';
        ?>
      </div>
    <?php endif; ?>

    <div class="card">
      <?php if($edit): ?>
        <h2>Modifier l'association</h2>
        <form method="POST" class="form-grid">
          <input type="hidden" name="id" value="<?php echo (int)$edit['id']; ?>">
          <input name="nom" placeholder="Nom" value="<?php echo htmlspecialchars($edit['nom'] ?? ''); ?>" required>
          <input name="adresse" placeholder="Adresse" value="<?php echo htmlspecialchars($edit['adresse'] ?? ''); ?>" required>
          <input name="telephone" placeholder="Téléphone" value="<?php echo htmlspecialchars($edit['telephone'] ?? ''); ?>" required>
          <input name="email" type="email" placeholder="Email" value="<?php echo htmlspecialchars($edit['email'] ?? ''); ?>" required>
          <div style="display: flex; gap: 10px;">
            <button type="submit" name="update" class="btn-primary">Enregistrer</button>
            <a href="associations.php" class="btn-secondary">Annuler</a>
          </div>
        </form>
      <?php else: ?>
        <h2>Ajouter une association</h2>
        <form method="POST" class="form-grid">
          <input name="nom" placeholder="Nom" required>
          <input name="adresse" placeholder="Adresse" required>
          <input name="telephone" placeholder="Téléphone" required>
          <input name="email" type="email" placeholder="Email" required>
          <button type="submit" name="create" class="btn-primary">Ajouter</button>
        </form>
      <?php endif; ?>
    </div>

    <div class="card">
      <h2>Liste des associations</h2>
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nom</th>
              <th>Adresse</th>
              <th>Téléphone</th>
              <th>Email</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php if($result): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?php echo (int)$row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['nom'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($row['adresse'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($row['telephone'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($row['email'] ?? ''); ?></td>
                <td>
                  <a href="associations.php?edit=<?php echo (int)$row['id']; ?>"><i class="fas fa-edit"></i> Modifier</a>
                  |
                  <a href="associations.php?delete=<?php echo (int)$row['id']; ?>" onclick="return confirm('Supprimer cette association ?')" style="color: #e53e3e;"><i class="fas fa-trash"></i> Supprimer</a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="6" style="text-align: center; padding: 30px; color: #718096;">Aucune association trouvée</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
