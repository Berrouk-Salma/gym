<?php
// members/afficher_members.php
require_once '../config/database.php';

$sql = "SELECT * FROM membres ORDER BY nom";
$result = mysqli_query($conn, $sql);
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
                   <?php if(mysqli_num_rows($result) > 0): ?>
                       <?php while($member = mysqli_fetch_assoc($result)): ?>
                           <tr class="text-gray-300">
                               <td class="px-6 py-4"><?= $member['idMembre'] ?></td>
                               <td class="px-6 py-4"><?= $member['nom'] ?></td>
                               <td class="px-6 py-4"><?= $member['prenom'] ?></td>
                               <td class="px-6 py-4"><?= $member['Email'] ?></td>
                               <td class="px-6 py-4"><?= $member['telephone'] ?></td>
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
                       <?php endwhile; ?>
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