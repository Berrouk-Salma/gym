<?php
// members/ajouter_member.php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $nom = $_POST['nom'];
   $prenom = $_POST['prenom']; 
   $email = $_POST['email'];
   $telephone = $_POST['telephone'];

   $sql = "INSERT INTO membres (nom, prenom, email, telephone) 
           VALUES ('$nom', '$prenom', '$email', '$telephone')";
   
   if(mysqli_query($conn, $sql)) {
       header("Location: afficher_members.php");
       exit();
   } else {
       $error = "Erreur: " . mysqli_error($conn);
   }
}
?>

<!DOCTYPE html>
<html>
<head>
   <title>Ajouter Membre</title>
   <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900">
   <div class="max-w-2xl mx-auto p-6">
       <!-- Return to list button -->
       <a href="afficher_members.php" class="text-pink-500 mb-4 inline-block hover:text-pink-400">
           ← Retour à la liste
       </a>

       <h2 class="text-white text-2xl mb-6">Ajouter un nouveau membre</h2>

       <?php if (isset($error)): ?>
           <div class="bg-red-500 text-white p-4 rounded mb-4">
               <?= $error ?>
           </div>
       <?php endif; ?>

       <form method="POST" class="space-y-4">
           <div>
               <label class="text-gray-300">Nom:</label>
               <input type="text" name="nom" required 
                   class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-pink-500 focus:outline-none">
           </div>
           <div>
               <label class="text-gray-300">Prénom:</label>
               <input type="text" name="prenom" required
                   class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-pink-500 focus:outline-none">
           </div>
           <div>
               <label class="text-gray-300">Email:</label>
               <input type="email" name="email" required
                   class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-pink-500 focus:outline-none">
           </div>
           <div>
               <label class="text-gray-300">Téléphone:</label>
               <input type="text" name="telephone" required
                   class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-pink-500 focus:outline-none">
           </div>
           <button type="submit" 
               class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600 transition-colors">
               Ajouter le membre
           </button>
       </form>
   </div>
</body>
</html>