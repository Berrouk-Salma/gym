<?php
require_once 'config/database.php';

//  this is Fetch statistics
try {
    $stats = [
        'total_members' => $pdo->query("SELECT COUNT(*) FROM membres")->fetchColumn(),
        'active_classes' => $pdo->query("SELECT COUNT(*) FROM activite WHERE date_fin >= CURDATE()")->fetchColumn(),
        'total_reservations' => $pdo->query("SELECT COUNT(*) FROM reservation")->fetchColumn(),
        'equipment' => 48
    ];

    // Fetch recent activities
    $recent_activities = $pdo->query("
        SELECT 
            m.nom, m.prenom, m.Email,
            a.nom as activity_name,
            r.date_reservation,
            r.STATUS
        FROM reservation r
        JOIN membres m ON r.idMembre = m.idMembre
        JOIN activite a ON r.idActivite = a.idActivite
        ORDER BY r.date_reservation DESC
        LIMIT 5
    ")->fetchAll();

} catch(PDOException $e) {
    $error = "Erreur: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>FitnessPro - Gym Management</title>
</head>
<body>
    <div class="min-h-screen bg-gray-900">
        <!-- Navigation -->
        <nav class="bg-black/90 border-b border-gray-800">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center justify-between h-16 px-4">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <div class="flex items-center">
                            <svg class="h-8 w-8 text-pink-500" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M4 4h16v16H4V4zm2 2v12h12V6H6zm3 3h6v6H9V9zm1 1v4h4v-4h-4z"/>
                            </svg>
                            <span class="ml-2 text-pink-500 font-bold text-xl">FitnessPro</span>
                        </div>
                    </div>
                    
                    <!-- Navigation Links -->
                    <div class="hidden md:flex flex-1 justify-center">
                        <div class="flex space-x-12">
                            <a href="index.php" class="px-4 py-2 text-pink-500 font-medium border-b-2 border-pink-500">Dashboard</a>
                            <a href="members/afficher_members.php" class="px-4 py-2 text-gray-400 hover:text-gray-200">Members</a>
                            <a href="activities/afficher_activities.php" class="px-4 py-2 text-gray-400 hover:text-gray-200">Activities</a>
                            <a href="reservations/afficher_reservations.php" class="px-4 py-2 text-gray-400 hover:text-gray-200">Reservations</a>
                        </div>
                    </div>

                    <!-- Search Icon -->
                    <div class="flex items-center space-x-4">
                        <button class="p-2 text-gray-400 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <!-- Stats Cards -->
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
                            <p class="text-white text-2xl font-bold"><?= $stats['total_members'] ?></p>
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
                            <h2 class="text-gray-400 text-sm">Active Classes</h2>
                            <p class="text-white text-2xl font-bold"><?= $stats['active_classes'] ?></p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="bg-pink-500/20 rounded-lg p-3">
                            <svg class="h-6 w-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-gray-400 text-sm">Reservations</h2>
                            <p class="text-white text-2xl font-bold"><?= $stats['total_reservations'] ?></p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="bg-pink-500/20 rounded-lg p-3">
                            <svg class="h-6 w-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-gray-400 text-sm">Equipment</h2>
                            <p class="text-white text-2xl font-bold"><?= $stats['equipment'] ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Table -->
            <div class="bg-gray-800 rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-700">
                    <h3 class="text-lg font-medium text-white">Recent Activity</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Member</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Activity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            <?php foreach($recent_activities as $activity): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-full bg-gray-700 flex items-center justify-center">
                                                <span class="text-white"><?= substr($activity['nom'], 0, 1) . substr($activity['prenom'], 0, 1) ?></span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-white"><?= htmlspecialchars($activity['nom'] . ' ' . $activity['prenom']) ?></div>
                                                <div class="text-sm text-gray-400"><?= htmlspecialchars($activity['Email']) ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-white"><?= htmlspecialchars($activity['activity_name']) ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-400"><?= date('d/m/Y H:i', strtotime($activity['date_reservation'])) ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            <?= $activity['STATUS'] === 'confirme' ? 'bg-green-100 text-green-800' : 
                                                ($activity['STATUS'] === 'Anuller' ? 'bg-red-100 text-red-800' : 
                                                'bg-yellow-100 text-yellow-800') ?>">
                                            <?= htmlspecialchars($activity['STATUS']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>