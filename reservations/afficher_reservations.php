<?php
// reservations/afficher_reservations.php
require_once '../config/database.php';

// Join query to get all reservation details
$sql = "SELECT 
    r.idReservation,
    m.nom as membre_nom,
    m.prenom as membre_prenom,
    a.nom as activite_nom,
    r.date_reservation,
    r.STATUS
FROM reservation r
JOIN membres m ON r.idMembre = m.idMembre
JOIN activite a ON r.idActivite = a.idActivite
ORDER BY r.date_reservation DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Réservations</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900">
    <div class="max-w-6xl mx-auto p-6">
        <!-- Header section -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-white text-2xl">Liste des Réservations</h2>
            <a href="ajouter_reservation.php" 
               class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600 transition-colors">
                + Ajouter une réservation
            </a>
        </div>

        <!-- Reservations table -->
        <div class="bg-gray-800 rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-white">ID</th>
                        <th class="px-6 py-3 text-left text-white">Membre</th>
                        <th class="px-6 py-3 text-left text-white">Activité</th>
                        <th class="px-6 py-3 text-left text-white">Date</th>
                        <th class="px-6 py-3 text-left text-white">Statut</th>
                        <th class="px-6 py-3 text-left text-white">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php while($reservation = mysqli_fetch_assoc($result)): ?>
                            <tr class="text-gray-300">
                                <td class="px-6 py-4"><?= $reservation['idReservation'] ?></td>
                                <td class="px-6 py-4">
                                    <?= $reservation['membre_nom'] . ' ' . $reservation['membre_prenom'] ?>
                                </td>
                                <td class="px-6 py-4"><?= $reservation['activite_nom'] ?></td>
                                <td class="px-6 py-4"><?= $reservation['date_reservation'] ?></td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-full text-sm 
                                        <?php 
                                            switch($reservation['STATUS']) {
                                                case 'confirme':
                                                    echo 'bg-green-100 text-green-800';
                                                    break;
                                                case 'En attent':
                                                    echo 'bg-yellow-100 text-yellow-800';
                                                    break;
                                                case 'Anuller':
                                                    echo 'bg-red-100 text-red-800';
                                                    break;
                                                default:
                                                    echo 'bg-gray-100 text-gray-800';
                                            }
                                        ?>">
                                        <?= $reservation['STATUS'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="modifier_reservation.php?id=<?= $reservation['idReservation'] ?>" 
                                       class="text-blue-400 hover:text-blue-300 mr-3">
                                        Modifier
                                    </a>
                                    <a href="supprimer_reservation.php?id=<?= $reservation['idReservation'] ?>" 
                                       class="text-red-400 hover:text-red-300"
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation?')">
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                                Aucune réservation trouvée
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>