<?php
include('../config/gym.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO membres (Prenom, Nom, Email, Telephone) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $firstname, $lastname, $email, $phone);

    if ($stmt->execute()) {
        echo "Membre ajouté avec succès.";
    } else {
        echo "Erreur : " . $conn->error;
    }
}
?>
<form method="POST">
    <input type="text" name="firstname" placeholder="Prénom" required>
    <input type="text" name="lastname" placeholder="Nom" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="phone" placeholder="Téléphone" required>
    <button type="submit">Ajouter</button>
</form>

