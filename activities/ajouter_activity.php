<?php
// activities/ajouter_activity.php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $nom = $_POST['nom'];
   $description = $_POST['description'];
   $capacite = $_POST['capacite'];
   $date_debut = $_POST['date_debut'];
   $date_fin = $_POST['date_fin'];
   $disponibilite = $_POST['disponibilite'];

   $sql = "INSERT INTO activite (nom, description, capacite, date_Debut, date_fin, Disponiblite) 
           VALUES (:nom, :description, :capacite, :date_debut, :date_fin, :disponibilite)";
   
   try {
       $stmt = $pdo->prepare($sql);
       $stmt->execute([
           'nom' => $nom,
           'description' => $description,
           'capacite' => $capacite,
           'date_debut' => $date_debut,
           'date_fin' => $date_fin,
           'disponibilite' => $disponibilite
       ]);
       $message = "Activité ajoutée avec succès!";
   } catch(PDOException $e) {
       $error = "Erreur: " . $e->getMessage();
   }
}
?>

<!DOCTYPE html>
<html>
<head>
   <title>Ajouter Activité</title>
   <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900">
   <div class="max-w-2xl mx-auto p-6">
       <!-- Return to list button -->
       <a href="afficher_activities.php" class="text-pink-500 mb-4 inline-block hover:text-pink-400">
           ← Retour à la liste
       </a>

       <h2 class="text-white text-2xl mb-6">Ajouter une nouvelle activité</h2>

       <!-- Success/Error Messages -->
       <?php if (isset($message)): ?>
           <div class="bg-green-500 text-white p-4 rounded mb-4">
               <?= $message ?>
           </div>
       <?php endif; ?>

       <?php if (isset($error)): ?>
           <div class="bg-red-500 text-white p-4 rounded mb-4">
               <?= $error ?>
           </div>
       <?php endif; ?>

       <form method="POST" class="space-y-4">
           <div>
               <label class="text-gray-300">Nom de l'activité:</label>
               <input type="text" name="nom" required 
                   class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-pink-500 focus:outline-none">
           </div>

           <div>
               <label class="text-gray-300">Description:</label>
               <textarea name="description" required rows="3"
                   class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-pink-500 focus:outline-none"></textarea>
           </div>

           <div>
               <label class="text-gray-300">Capacité:</label>
               <input type="number" name="capacite" required min="1"
                   class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-pink-500 focus:outline-none">
           </div>

           <div>
               <label class="text-gray-300">Date de début:</label>
               <input type="date" name="date_debut" required
                   class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-pink-500 focus:outline-none">
           </div>

           <div>
               <label class="text-gray-300">Date de fin:</label>
               <input type="date" name="date_fin" required
                   class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-pink-500 focus:outline-none">
           </div>

           <div>
               <label class="text-gray-300">Places disponibles:</label>
               <input type="number" name="disponibilite" required min="0"
                   class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-pink-500 focus:outline-none">
           </div>

           <button type="submit" 
               class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600 transition-colors">
               Ajouter l'activité
           </button>
       </form>
   </div>
</body>
</html>