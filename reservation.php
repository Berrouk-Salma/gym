<?php
require_once '../config/db.php';
require_once '../includes/header.php';

$query = "SELECT r.idReservation, m.nom, m.prenom, a.nom AS activite, 
          r.date_reservation, r.STATUS 
          FROM reservation r 
          JOIN membres m ON r.idMembre = m.idMembre 
          JOIN activite a ON r.idActivite = a.idActivite 
          ORDER BY r.date_reservation";
$stmt = $pdo->query($query);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-white">Reservations</h1>
        <a href="add_reservation.php" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded">Add Reservation</a>
    </div>
    
    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Member</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Activity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-700">
                <?php foreach($reservations as $reservation): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo $reservation['idReservation']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo $reservation['nom'] . ' ' . $reservation['prenom']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo $reservation['activite']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo $reservation['date_reservation']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            <?php echo $reservation['STATUS'] === 'confirme' ? 'bg-green-100 text-green-800' : 
                                ($reservation['STATUS'] === 'En attent' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'); ?>">
                            <?php echo $reservation['STATUS']; ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                        <a href="edit_reservation.php?id=<?php echo $reservation['idReservation']; ?>" class="text-blue-400 hover:text-blue-300 mr-3">Edit</a>
                        <a href="delete_reservation.php?id=<?php echo $reservation['idReservation']; ?>" class="text-red-400 hover:text-red-300" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>