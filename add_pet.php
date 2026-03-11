<?php
include("config.php");

if(isset($_POST['add_pet'])){

$nom = $_POST['nom'];
$age = $_POST['age'];
$type = $_POST['type'];
$race = $_POST['race'];
$description = $_POST['description'];

$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

move_uploaded_file($tmp,"images/".$image);

$stmt = mysqli_prepare($conn, "INSERT INTO animaux(nom,age,type,race,description,image) VALUES(?,?,?,?,?,?)");
mysqli_stmt_bind_param($stmt, "sissss", $nom, $age, $type, $race, $description, $image);
mysqli_stmt_execute($stmt);

echo "Animal ajouté";
}
?>

<form method="POST" enctype="multipart/form-data">
<input name="nom" placeholder="Nom">
<input name="age" placeholder="Age">
<input name="type" placeholder="Type">
<input name="race" placeholder="Race">
<textarea name="description"></textarea>
<input type="file" name="image">

<button name="add_pet">Ajouter</button>
</form>
