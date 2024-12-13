<?php
// activities/afficher_activities.php
require_once '../config/database.php';

$sql = "SELECT * FROM activite ORDER BY date_Debut";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Activités</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900">
    <div class="max-w-6xl mx-auto p-6">
        <!-- Header section with title and add button -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-white text-2xl">Liste des Activités</h2>
            <a href="ajouter_activity.php" 
               class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600 transition-colors">
                + Ajouter une activité
            </a>
        </div>

        <!-- Activities table -->
        <div class="bg-gray-800 rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-white">ID</th>
                        <th class="px-6 py-3 text-left text-white">Nom</th>
                        <th class="px-6 py-3 text-left text-white">Description</th>
                        <th class="px-6 py-3 text-left text-white">Capacité</th>
                        <th class="px-6 py-3 text-left text-white">Date début</th>
                        <th class="px-6 py-3 text-left text-white">Date fin</th>
                        <th class="px-6 py-3 text-left text-white">Disponibilité</th>
                        <th class="px-6 py-3 text-left text-white">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php while($activity = mysqli_fetch_assoc($result)): ?>
                            <tr class="text-gray-300">
                                <td class="px-6 py-4"><?= $activity['idActivite'] ?></td>
                                <td class="px-6 py-4"><?= $activity['nom'] ?></td>
                                <td class="px-6 py-4"><?= $activity['description'] ?></td>
                                <td class="px-6 py-4"><?= $activity['capacite'] ?></td>
                                <td class="px-6 py-4"><?= $activity['date_Debut'] ?></td>
                                <td class="px-6 py-4"><?= $activity['date_fin'] ?></td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-full text-sm <?= $activity['Disponiblite'] > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                        <?= $activity['Disponiblite'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="modifier_activity.php?id=<?= $activity['idActivite'] ?>" 
                                       class="text-blue-400 hover:text-blue-300 mr-3">
                                        Modifier
                                    </a>
                                    <a href="supprimer_activity.php?id=<?= $activity['idActivite'] ?>" 
                                       class="text-red-400 hover:text-red-300"
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette activité?')">
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-400">
                                Aucune activité trouvée
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>