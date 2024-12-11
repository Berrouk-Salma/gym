<?php
include('../config/gym.php');

$sql = "SELECT * FROM membres";
$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Prénom</th><th>Nom</th><th>Email</th><th>Téléphone</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";

        echo "<td>{$row['prenom']}</td>";
        echo "<td>{$row['nom']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['telephone']}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Aucun membre trouvé.";
}
?>
