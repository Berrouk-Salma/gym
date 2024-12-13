<?php
// members/afficher_members.php
require_once '../config/database.php';

try {
   $sql = "SELECT * FROM membres ORDER BY nom";
   $stmt = $pdo->query($sql);
   $members = $stmt->fetchAll();
} catch(PDOException $e) {
   $error = "Erreur: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
   <title>Liste des Membres</title>
   <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900">
   <div class="max-w-6xl mx-auto p-6">
       <!-- Header section with title and add button -->
       <div class="flex justify-between items-center mb-6">
           <h2 class="text-white text-2xl">Liste des Membres</h2>
           <a href="ajouter_member.php" 
              class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600 transition-colors">
               + Ajouter un membre
           </a>
       </div>

       <!-- Error message if any -->
       <?php if (isset($error)): ?>
           <div class="bg-red-500 text-white p-4 rounded mb-4">
               <?= $error ?>
           </div>
       <?php endif; ?>

       <!-- Members table -->
       <div class="bg-gray-800 rounded-lg overflow-hidden">
           <table class="min-w-full">
               <thead class="bg-gray-700">
                   <tr>
                       <th class="px-6 py-3 text-left text-white">ID</th>
                       <th class="px-6 py-3 text-left text-white">Nom</th>
                       <th class="px-6 py-3 text-left text-white">Prénom</th>
                       <th class="px-6 py-3 text-left text-white">Email</th>
                       <th class="px-6 py-3 text-left text-white">Téléphone</th>
                       <th class="px-6 py-3 text-left text-white">Actions</th>
                   </tr>
               </thead>
               <tbody class="divide-y divide-gray-700">
                   <?php if(isset($members) && !empty($members)): ?>
                       <?php foreach($members as $member): ?>
                           <tr class="text-gray-300">
                               <td class="px-6 py-4"><?= htmlspecialchars($member['idMembre']) ?></td>
                               <td class="px-6 py-4"><?= htmlspecialchars($member['nom']) ?></td>
                               <td class="px-6 py-4"><?= htmlspecialchars($member['prenom']) ?></td>
                               <td class="px-6 py-4"><?= htmlspecialchars($member['Email']) ?></td>
                               <td class="px-6 py-4"><?= htmlspecialchars($member['telephone']) ?></td>
                               <td class="px-6 py-4">
                                   <a href="modifier_member.php?id=<?= $member['idMembre'] ?>" 
                                      class="text-blue-400 hover:text-blue-300 mr-3">
                                       Modifier
                                   </a>
                                   <a href="supprimer_member.php?id=<?= $member['idMembre'] ?>" 
                                      class="text-red-400 hover:text-red-300"
                                      onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre?')">
                                       Supprimer
                                   </a>
                               </td>
                           </tr>
                       <?php endforeach; ?>
                   <?php else: ?>
                       <tr>
                           <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                               Aucun membre trouvé
                           </td>
                       </tr>
                   <?php endif; ?>
               </tbody>
           </table>
       </div>
   </div>
</body>
</html>