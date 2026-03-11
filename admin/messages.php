<?php
include("guard.php");
include("../config.php");

if(isset($_GET['read'])){
    $id = (int)$_GET['read'];
    if($id > 0){
        $stmt = mysqli_prepare($conn, "UPDATE messages_contact SET lu = 1 WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    }
    header("Location: messages.php");
    exit;
}

if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    if($id > 0){
        $stmt = mysqli_prepare($conn, "DELETE FROM messages_contact WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    }
    header("Location: messages.php");
    exit;
}

$selected = null;
if(isset($_GET['view'])){
    $id = (int)$_GET['view'];
    if($id > 0){
        $stmt = mysqli_prepare($conn, "SELECT m.*, u.nom as user_nom, u.email as user_email FROM messages_contact m LEFT JOIN utilisateurs u ON u.id = m.user_id WHERE m.id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $selected = $res ? mysqli_fetch_assoc($res) : null;

        $stmt2 = mysqli_prepare($conn, "UPDATE messages_contact SET lu = 1 WHERE id = ?");
        mysqli_stmt_bind_param($stmt2, "i", $id);
        mysqli_stmt_execute($stmt2);
    }
}

$result = mysqli_query($conn, "SELECT m.id, m.nom, m.email, m.sujet, m.lu, m.date_message FROM messages_contact m ORDER BY m.id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Messages - Admin LALAPA</title>
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
        <li><a href="messages.php" class="active">Messages</a></li>
        <li><a href="users.php">Utilisateurs</a></li>
      </ul>
    </div>
  </nav>

  <div class="main-content">
    <div class="page-header">
      <h1>Messages de contact</h1>
      <p>Consulter et gérer les messages reçus</p>
    </div>

    <?php if($selected): ?>
      <div style="background: white; padding: 16px; max-width: 900px; border: 1px solid #ddd;">
        <h3><?php echo htmlspecialchars($selected['sujet'] ?? ''); ?></h3>
        <p><b>Nom:</b> <?php echo htmlspecialchars($selected['nom'] ?? ($selected['user_nom'] ?? '')); ?></p>
        <p><b>Email:</b> <?php echo htmlspecialchars($selected['email'] ?? ($selected['user_email'] ?? '')); ?></p>
        <p><b>Date:</b> <?php echo htmlspecialchars($selected['date_message'] ?? ''); ?></p>
        <p style="white-space: pre-wrap;"><?php echo htmlspecialchars($selected['message'] ?? ''); ?></p>
        <div style="margin-top: 10px; display:flex; gap: 10px;">
          <a href="messages.php">Retour</a>
          <a href="messages.php?delete=<?php echo (int)$selected['id']; ?>" onclick="return confirm('Supprimer ce message ?')">Supprimer</a>
        </div>
      </div>
    <?php endif; ?>

    <?php if(isset($_GET['success'])): ?>
      <div class="alert alert-success">
        <?php 
          if($_GET['success'] === 'marked_read') echo 'Message marqué comme lu!';
          if($_GET['success'] === 'deleted') echo 'Message supprimé avec succès!';
        ?>
      </div>
    <?php endif; ?>

    <div class="card">
      <h2>Liste des messages</h2>
      <div class="table-container">
        <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Sujet</th>
            <th>Lu</th>
            <th>Date</th>
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
              <td><?php echo htmlspecialchars($row['sujet'] ?? ''); ?></td>
              <td>
                <?php 
                  $lu = (int)($row['lu'] ?? 0);
                  echo $lu === 1 ? '<span class="badge badge-accepted">Lu</span>' : '<span class="badge badge-pending">Non lu</span>';
                ?>
              </td>
              <td><?php echo htmlspecialchars($row['date_message'] ?? ''); ?></td>
              <td>
                <a href="messages.php?mark_read=<?php echo (int)$row['id']; ?>"><i class="fas fa-check"></i> Marquer lu</a>
                |
                <a href="messages.php?delete=<?php echo (int)$row['id']; ?>" onclick="return confirm('Supprimer ce message ?')" style="color: #e53e3e;"><i class="fas fa-trash"></i> Supprimer</a>
              </td>
            </tr>
          <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="7" style="text-align: center; padding: 30px; color: #718096;">Aucun message trouvé</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
