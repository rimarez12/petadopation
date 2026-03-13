<?php
include("guard.php");
include("../config.php");

if(isset($_POST['set_active'])){
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $actif = isset($_POST['actif']) ? (int)$_POST['actif'] : 1;
    $actif = $actif === 0 ? 0 : 1;

    if($id > 0){
        $stmt = mysqli_prepare($conn, "UPDATE utilisateurs SET actif = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "ii", $actif, $id);
        mysqli_stmt_execute($stmt);
    }

    header("Location: users.php?success=active_updated");
    exit;
}

if(isset($_POST['set_role'])){
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $role = trim($_POST['role'] ?? 'user');
    $allowed = ['admin', 'user'];

    if($id > 0 && in_array($role, $allowed, true)){
        $stmt = mysqli_prepare($conn, "UPDATE utilisateurs SET role = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $role, $id);
        mysqli_stmt_execute($stmt);

        if(isset($_SESSION['user_id']) && (int)$_SESSION['user_id'] === $id){
            $_SESSION['role'] = $role;
        }
    }

    header("Location: users.php?success=role_updated");
    exit;
}

if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    if($id > 0 && (!isset($_SESSION['user_id']) || (int)$_SESSION['user_id'] !== $id)){
        $stmt = mysqli_prepare($conn, "DELETE FROM utilisateurs WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    }
    header("Location: users.php?success=deleted");
    exit;
}

$result = mysqli_query($conn, "SELECT id, nom, email, role, actif FROM utilisateurs ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Utilisateurs - Admin LALAPA</title>
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
        <li><a href="annonces.php">Annonces</a></li>
        <li><a href="messages.php">Messages</a></li>
        <li><a href="users.php" class="active">Utilisateurs</a></li>
      </ul>
    </div>
  </nav>

  <div class="main-content">
    <div class="page-header">
      <h1>Gérer les utilisateurs</h1>
      <p>Modifier les rôles, activer/désactiver des comptes</p>
    </div>

    <?php if(isset($_GET['success'])): ?>
      <div class="alert alert-success">
        <?php 
          if($_GET['success'] === 'role_updated') echo 'Rôle mis à jour avec succès!';
          if($_GET['success'] === 'active_updated') echo 'Statut mis à jour avec succès!';
          if($_GET['success'] === 'deleted') echo 'Utilisateur supprimé avec succès!';
        ?>
      </div>
    <?php endif; ?>

    <div class="card">
      <h2>Liste des utilisateurs</h2>
      <div class="table-container">
        <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Actif</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php if($result): ?>
          <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?php echo (int)$row['id']; ?></td>
              <td><?php echo htmlspecialchars($row['nom'] ?? ''); ?></td>
              <td><?php echo htmlspecialchars($row['email'] ?? ''); ?></td>
              <td>
                <span class="badge <?php echo ($row['role'] ?? 'user') === 'admin' ? 'badge-admin' : 'badge-user'; ?>">
                  <?php echo htmlspecialchars($row['role'] ?? 'user'); ?>
                </span>
              </td>
              <td>
                <?php 
                  $actif = (int)($row['actif'] ?? 1);
                  echo $actif === 1 ? '<span class="badge badge-accepted">Actif</span>' : '<span class="badge badge-rejected">Inactif</span>';
                ?>
              </td>
              <td>
                <form method="POST" style="display:flex; gap: 8px; align-items: center;">
                  <input type="hidden" name="id" value="<?php echo (int)$row['id']; ?>">
                  <select name="role">
                    <option value="user" <?php echo ($row['role'] ?? '') === 'user' ? 'selected' : ''; ?>>user</option>
                    <option value="admin" <?php echo ($row['role'] ?? '') === 'admin' ? 'selected' : ''; ?>>admin</option>
                  </select>
                  <button name="set_role">Changer</button>
                </form>
              </td>
              <td>
                <form method="POST" style="display:flex; gap: 8px; align-items: center;">
                  <input type="hidden" name="id" value="<?php echo (int)$row['id']; ?>">
                  <select name="actif">
                    <option value="1" <?php echo (int)($row['actif'] ?? 1) === 1 ? 'selected' : ''; ?>>Actif</option>
                    <option value="0" <?php echo (int)($row['actif'] ?? 1) === 0 ? 'selected' : ''; ?>>Inactif</option>
                  </select>
                  <button name="set_active">OK</button>
                </form>
              </td>
              <td>
                <?php if(isset($_SESSION['user_id']) && (int)$_SESSION['user_id'] === (int)$row['id']): ?>
                  (vous)
                <?php else: ?>
                  <a href="users.php?delete=<?php echo (int)$row['id']; ?>" onclick="return confirm('Supprimer cet utilisateur ?')" style="color: #e53e3e;"><i class="fas fa-trash"></i> Supprimer</a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="7" style="text-align: center; padding: 30px; color: #718096;">Aucun utilisateur trouvé</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
