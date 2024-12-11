<?php 
require_once 'config/gym.php';
require_once 'includes/includ.php';
?>

<div class="max-w-7xl mx-auto py-6 px-4">
 
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gray-800 rounded-lg p-6">
            <div class="flex items-center">
                <div class="bg-pink-500/20 rounded-lg p-3">
                    <svg class="h-6 w-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-400 text-sm">Total Members</h2>
                    <?php
                    $stmt = $pdo->query("SELECT COUNT(*) FROM membres");
                    $memberCount = $stmt->fetchColumn();
                    ?>
                    <p class="text-white text-2xl font-bold"><?php echo $memberCount; ?></p>
                </div>
            </div>
        </div>

  
        <div class="bg-gray-800 rounded-lg p-6">
            <div class="flex items-center">
                <div class="bg-pink-500/20 rounded-lg p-3">
                    <svg class="h-6 w-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-400 text-sm">Active Activities</h2>
                    <?php
                    $stmt = $pdo->query("SELECT COUNT(*) FROM activite WHERE Disponiblite = 1");
                    $activityCount = $stmt->fetchColumn();
                    ?>
                    <p class="text-white text-2xl font-bold"><?php echo $activityCount; ?></p>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg p-6">
            <div class="flex items-center">
                <div class="bg-pink-500/20 rounded-lg p-3">
                    <svg class="h-6 w-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-400 text-sm">Today's Reservations</h2>
                    <?php
                    $stmt = $pdo->query("SELECT COUNT(*) FROM reservation WHERE DATE(date_reservation) = CURDATE()");
                    $reservationCount = $stmt->fetchColumn();
                    ?>
                    <p class="text-white text-2xl font-bold"><?php echo $reservationCount; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-800 rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-700">
            <h3 class="text-lg font-medium text-white">Recent Reservations</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Member</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Activity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                    <?php
                    $query = "SELECT r.*, m.nom, m.prenom, a.nom as activity_name 
                             FROM reservation r 
                             JOIN membres m ON r.idMembre = m.idMembre 
                             JOIN activite a ON r.idActivite = a.idActivite 
                             ORDER BY r.date_reservation DESC LIMIT 5";
                    $stmt = $pdo->query($query);
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                            <?php echo htmlspecialchars($row['nom'] . ' ' . $row['prenom']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                            <?php echo htmlspecialchars($row['activity_name']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                            <?php echo htmlspecialchars($row['date_reservation']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                <?php echo $row['STATUS'] === 'confirme' ? 'bg-green-100 text-green-800' : 
                                    ($row['STATUS'] === 'En attent' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'); ?>">
                                <?php echo htmlspecialchars($row['STATUS']); ?>
                            </span>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>