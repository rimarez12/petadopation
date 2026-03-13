<?php
include("guard.php");
include("../config.php");

if(isset($_POST['create'])){
    $nom = trim($_POST['nom']);
    $age = isset($_POST['age']) ? (int)$_POST['age'] : null;
    $type = trim($_POST['type']);
    $race = trim($_POST['race']);
    $description = trim($_POST['description']);
    $association_id = isset($_POST['association_id']) && $_POST['association_id'] !== '' ? (int)$_POST['association_id'] : null;

    $imageName = null;
    if(isset($_FILES['image']) && isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name']){
        $original = basename($_FILES['image']['name']);
        $ext = strtolower(pathinfo($original, PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','webp','gif'];
        if(in_array($ext, $allowed, true)){
            $imageName = uniqid('animal_', true) . '.' . $ext;
            @mkdir(__DIR__ . '/../images', 0777, true);
            move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../images/' . $imageName);
        }
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO animaux(nom, age, type, race, description, image, association_id) VALUES(?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sissssi", $nom, $age, $type, $race, $description, $imageName, $association_id);
    mysqli_stmt_execute($stmt);

    header("Location: animals.php?success=created");
    exit;
}

if(isset($_POST['update'])){
    $id = (int)($_POST['id'] ?? 0);
    $nom = trim($_POST['nom']);
    $age = isset($_POST['age']) ? (int)$_POST['age'] : null;
    $type = trim($_POST['type']);
    $race = trim($_POST['race']);
    $description = trim($_POST['description']);
    $association_id = isset($_POST['association_id']) && $_POST['association_id'] !== '' ? (int)$_POST['association_id'] : null;

    $imageName = $_POST['current_image'] ?? null;
    if(isset($_FILES['image']) && isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name']){
        $original = basename($_FILES['image']['name']);
        $ext = strtolower(pathinfo($original, PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','webp','gif'];
        if(in_array($ext, $allowed, true)){
            $imageName = uniqid('animal_', true) . '.' . $ext;
            @mkdir(__DIR__ . '/../images', 0777, true);
            move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../images/' . $imageName);
        }
    }

    if($id > 0){
        $stmt = mysqli_prepare($conn, "UPDATE animaux SET nom = ?, age = ?, type = ?, race = ?, description = ?, image = ?, association_id = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "sissssii", $nom, $age, $type, $race, $description, $imageName, $association_id, $id);
        mysqli_stmt_execute($stmt);
    }

    header("Location: animals.php?success=updated");
    exit;
}

if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    if($id > 0){
        $stmt = mysqli_prepare($conn, "DELETE FROM animaux WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    }
    header("Location: animals.php?success=deleted");
    exit;
}

$edit = null;
if(isset($_GET['edit'])){
    $id = (int)$_GET['edit'];
    if($id > 0){
        $stmt = mysqli_prepare($conn, "SELECT * FROM animaux WHERE id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $edit = $res ? mysqli_fetch_assoc($res) : null;
    }
}

$associations = mysqli_query($conn, "SELECT id, nom FROM associations ORDER BY nom ASC");
$result = mysqli_query($conn, "SELECT a.*, s.nom as association_nom FROM animaux a LEFT JOIN associations s ON s.id = a.association_id ORDER BY a.id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animaux - Admin LALAPA</title>
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
        <li><a href="animals.php" class="active">Animaux</a></li>
        <li><a href="requests.php">Demandes</a></li>
        <li><a href="annonces.php">Annonces</a></li>
        <li><a href="messages.php">Messages</a></li>
        <li><a href="users.php">Utilisateurs</a></li>
      </ul>
    </div>
  </nav>

  <div class="main-content">
    <div class="page-header">
      <h1>Gérer les animaux</h1>
      <p>Ajouter, modifier ou supprimer des animaux</p>
    </div>

    <?php if(isset($_GET['success'])): ?>
      <div class="alert alert-success">
        <?php 
          if($_GET['success'] === 'created') echo 'Animal créé avec succès!';
          if($_GET['success'] === 'updated') echo 'Animal modifié avec succès!';
          if($_GET['success'] === 'deleted') echo 'Animal supprimé avec succès!';
        ?>
      </div>
    <?php endif; ?>

    <div class="card">
      <?php if($edit): ?>
        <?php $associations = mysqli_query($conn, "SELECT id, nom FROM associations ORDER BY nom ASC"); ?>
        <h2>Modifier l'animal</h2>
        <form method="POST" enctype="multipart/form-data" class="form-grid">
        <input type="hidden" name="id" value="<?php echo (int)$edit['id']; ?>">
        <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($edit['image'] ?? ''); ?>">
        <input name="nom" placeholder="Nom" value="<?php echo htmlspecialchars($edit['nom'] ?? ''); ?>" required>
        <input name="age" type="number" placeholder="Age" min="0" value="<?php echo (int)($edit['age'] ?? 0); ?>" required>
        <input name="type" placeholder="Type" value="<?php echo htmlspecialchars($edit['type'] ?? ''); ?>" required>
        <input name="race" placeholder="Race" value="<?php echo htmlspecialchars($edit['race'] ?? ''); ?>" required>
        <textarea name="description" placeholder="Description" rows="4" required><?php echo htmlspecialchars($edit['description'] ?? ''); ?></textarea>
        <select name="association_id">
          <option value="">Association (optionnel)</option>
          <?php if($associations): ?>
            <?php while($a = mysqli_fetch_assoc($associations)): ?>
              <option value="<?php echo (int)$a['id']; ?>" <?php echo (int)($edit['association_id'] ?? 0) === (int)$a['id'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($a['nom'] ?? ''); ?></option>
            <?php endwhile; ?>
          <?php endif; ?>
        </select>
        <input type="file" name="image" accept="image/*">
        <div style="display: flex; gap: 10px;">
          <button type="submit" name="update" class="btn-primary">Enregistrer</button>
          <a href="animals.php" class="btn-secondary">Annuler</a>
        </div>
      </form>
      <?php else: ?>
        <h2>Ajouter un animal</h2>
        <form method="POST" enctype="multipart/form-data" class="form-grid">
        <input name="nom" placeholder="Nom" required>
        <input name="age" type="number" placeholder="Age" min="0" required>
        <input name="type" placeholder="Type" required>
        <input name="race" placeholder="Race" required>
        <textarea name="description" placeholder="Description" rows="4" required></textarea>
        <select name="association_id">
          <option value="">Association (optionnel)</option>
          <?php if($associations): ?>
            <?php while($a = mysqli_fetch_assoc($associations)): ?>
              <option value="<?php echo (int)$a['id']; ?>"><?php echo htmlspecialchars($a['nom'] ?? ''); ?></option>
            <?php endwhile; ?>
          <?php endif; ?>
        </select>
        <input type="file" name="image" accept="image/*">
        <button type="submit" name="create" class="btn-primary">Ajouter</button>
      </form>
      <?php endif; ?>
    </div>

    <div class="card">
      <h2>Liste des animaux</h2>
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nom</th>
              <th>Age</th>
              <th>Type</th>
              <th>Race</th>
              <th>Association</th>
              <th>Image</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php if($result): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?php echo (int)$row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['nom'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars((string)($row['age'] ?? '')); ?></td>
                <td><?php echo htmlspecialchars($row['type'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($row['race'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($row['association_nom'] ?? '-'); ?></td>
                <td>
                  <?php if(!empty($row['image'])): ?>
                    <a href="../images/<?php echo rawurlencode($row['image']); ?>" target="_blank"><i class="fas fa-image"></i> Voir</a>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="animals.php?edit=<?php echo (int)$row['id']; ?>"><i class="fas fa-edit"></i> Modifier</a>
                  |
                  <a href="animals.php?delete=<?php echo (int)$row['id']; ?>" onclick="return confirm('Supprimer cet animal ?')" style="color: #e53e3e;"><i class="fas fa-trash"></i> Supprimer</a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="8" style="text-align: center; padding: 30px; color: #718096;">Aucun animal trouvé</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
