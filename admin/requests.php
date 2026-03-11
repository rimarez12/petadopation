<?php
include("guard.php");
include("../config.php");

if(isset($_POST['update_status'])){
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $statut = trim($_POST['statut'] ?? '');
    $allowed = ['En attente', 'Acceptée', 'Refusée'];

    if($id > 0 && in_array($statut, $allowed, true)){
        $stmt = mysqli_prepare($conn, "UPDATE demandes_adoption SET statut = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $statut, $id);
        mysqli_stmt_execute($stmt);
    }

    header("Location: requests.php?success=updated");
    exit;
}

if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    if($id > 0){
        $stmt = mysqli_prepare($conn, "DELETE FROM demandes_adoption WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    }
    header("Location: requests.php?success=deleted");
    exit;
}

$result = mysqli_query($conn, "SELECT d.id, d.user_id, d.animal_id, d.statut, d.date_demande, u.nom as user_nom, u.email as user_email, a.nom as animal_nom, a.type as animal_type FROM demandes_adoption d LEFT JOIN utilisateurs u ON u.id = d.user_id LEFT JOIN animaux a ON a.id = d.animal_id ORDER BY d.id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Demandes - Admin LALAPA</title>
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
        <li><a href="requests.php" class="active">Demandes</a></li>
        <li><a href="annonces.php">Annonces</a></li>
        <li><a href="messages.php">Messages</a></li>
        <li><a href="users.php">Utilisateurs</a></li>
      </ul>
    </div>
  </nav>

  <div class="main-content">
    <div class="page-header">
      <h1>Gérer les demandes d'adoption</h1>
      <p>Approuver, refuser ou supprimer des demandes</p>
    </div>

    <?php if(isset($_GET['success'])): ?>
      <div class="alert alert-success">
        <?php 
          if($_GET['success'] === 'updated') echo 'Statut mis à jour avec succès!';
          if($_GET['success'] === 'deleted') echo 'Demande supprimée avec succès!';
        ?>
      </div>
    <?php endif; ?>

    <div class="card">
      <h2>Liste des demandes</h2>
      <div class="table-container">
        <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>Email</th>
            <th>Animal</th>
            <th>Statut</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php if($result): ?>
          <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?php echo (int)$row['id']; ?></td>
              <td>
                <?php 
                  $statut = $row['statut'] ?? 'En attente';
                  $badge_class = 'badge-pending';
                  if($statut === 'Acceptée') $badge_class = 'badge-accepted';
                  if($statut === 'Refusée') $badge_class = 'badge-rejected';
                ?>
                <span class="badge <?php echo $badge_class; ?>"><?php echo htmlspecialchars($statut); ?></span>
              </td>
              <td><?php echo htmlspecialchars($row['user_email'] ?? ''); ?></td>
              <td><?php echo htmlspecialchars(($row['animal_nom'] ?? '') . (isset($row['animal_type']) && $row['animal_type'] !== '' ? (' (' . $row['animal_type'] . ')') : '')); ?></td>
              <td>
                <form method="POST" style="display:flex; gap: 8px; align-items: center;">
                  <input type="hidden" name="id" value="<?php echo (int)$row['id']; ?>">
                  <select name="statut">
                    <option value="En attente" <?php echo ($row['statut'] ?? '') === 'En attente' ? 'selected' : ''; ?>>En attente</option>
                    <option value="Acceptée" <?php echo ($row['statut'] ?? '') === 'Acceptée' ? 'selected' : ''; ?>>Acceptée</option>
                    <option value="Refusée" <?php echo ($row['statut'] ?? '') === 'Refusée' ? 'selected' : ''; ?>>Refusée</option>
                  </select>
                  <button name="update_status">Mettre à jour</button>
                </form>
              </td>
              <td><?php echo htmlspecialchars($row['date_demande'] ?? ''); ?></td>
              <td>
                <a href="requests.php?delete=<?php echo (int)$row['id']; ?>" onclick="return confirm('Supprimer cette demande ?')" style="color: #e53e3e;"><i class="fas fa-trash"></i> Supprimer</a>
              </td>
            </tr>
          <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="7" style="text-align: center; padding: 30px; color: #718096;">Aucune demande trouvée</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
