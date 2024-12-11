<?php
require_once '../config/db.php';
require_once '../includes/header.php';

$query = "SELECT * FROM activite";
$stmt = $pdo->query($query);
$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-white">Activities</h1>
        <a href="add_activity.php" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded">Add Activity</a>
    </div>
    
    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Start Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">End Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-700">
                <?php foreach($activities as $activity): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo $activity['idActivite']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo $activity['nom']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo $activity['date_Debut']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo $activity['date_fin']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                        <a href="edit_activity.php?id=<?php echo $activity['idActivite']; ?>" class="text-blue-400 hover:text-blue-300 mr-3">Edit</a>
                        <a href="delete_activity.php?id=<?php echo $activity['idActivite']; ?>" class="text-red-400 hover:text-red-300" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>