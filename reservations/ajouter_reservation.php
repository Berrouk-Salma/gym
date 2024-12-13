<?php
// reservations/ajouter_reservation.php
require_once '../config/database.php';

// Get members and activities for dropdowns
$members_sql = "SELECT * FROM membres ORDER BY nom";
$activities_sql = "SELECT * FROM activite ORDER BY nom";

$members_result = mysqli_query($conn, $members_sql);
$activities_result = mysqli_query($conn, $activities_sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idMembre = $_POST['idMembre'];
    $idActivite = $_POST['idActivite'];
    $date_reservation = $_POST['date_reservation'];
    $status = $_POST['status'];

    $sql = "INSERT INTO reservation (idMembre, idActivite, date_reservation, STATUS) 
            VALUES ('$idMembre', '$idActivite', '$date_reservation', '$status')";
    
    if(mysqli_query($conn, $sql)) {
        header("Location: afficher_reservations.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
   <title>Ajouter Réservation</title>
   <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900">
   <div class="max-w-2xl mx-auto p-6">
       <a href="afficher_reservations.php" class="text-pink-500 mb-4 inline-block hover:text-pink-400">
           ← Retour à la liste
       </a>

       <h2 class="text-white text-2xl mb-6">Nouvelle Réservation</h2>

       <?php if (isset($error)): ?>
           <div class="bg-red-500 text-white p-4 rounded mb-4">
               <?= $error ?>
           </div>
       <?php endif; ?>

       <form method="POST" class="space-y-4">
           <div>
               <label class="text-gray-300">Membre:</label>
               <select name="idMembre" required 
                   class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-pink-500 focus:outline-none">
                   <option value="">Sélectionnez un membre</option>
                   <?php while($member = mysqli_fetch_assoc($members_result)): ?>
                       <option value="<?= $member['idMembre'] ?>">
                           <?= $member['nom'] . ' ' . $member['prenom'] ?>
                       </option>
                   <?php endwhile; ?>
               </select>
           </div>

           <div>
               <label class="text-gray-300">Activité:</label>
               <select name="idActivite" required
                   class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-pink-500 focus:outline-none">
                   <option value="">Sélectionnez une activité</option>
                   <?php while($activity = mysqli_fetch_assoc($activities_result)): ?>
                       <option value="<?= $activity['idActivite'] ?>">
                           <?= $activity['nom'] ?> 
                           (Disponible: <?= $activity['Disponiblite'] ?>)
                       </option>
                   <?php endwhile; ?>
               </select>
           </div>

           <div>
               <label class="text-gray-300">Date de réservation:</label>
               <input type="datetime-local" name="date_reservation" required
                   class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-pink-500 focus:outline-none">
           </div>

           <div>
               <label class="text-gray-300">Statut:</label>
               <select name="status" required
                   class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700 focus:border-pink-500 focus:outline-none">
                   <option value="confirme">Confirmé</option>
                   <option value="En attent">En attente</option>
                   <option value="Anuller">Annulé</option>
               </select>
           </div>

           <button type="submit" 
               class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600 transition-colors">
               Créer la réservation
           </button>
       </form>
   </div>
</body>
</html>