<?php

// Vérifie si la demande est une requête POST et si elle contient les données nécessaires
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['decrease_load']) && isset($_POST['service_name'])) {
    // Récupère le nom du service
    $serviceName = $_POST['service_name'];

    // Exécute la commande kubectl pour supprimer le pod générant la charge
    $command = "sudo -u aladin_257 kubectl delete pod -l run=load-generator";

    // Exécute la commande et récupère le résultat
    exec($command, $output, $returnValue);

    // Vérifie si la commande s'est exécutée avec succès
    if ($returnValue === 0) {
        // Renvoie une réponse indiquant que la diminution de la charge a réussi
        echo 'success';
    } else {
        // Renvoie une réponse indiquant que la diminution de la charge a échoué
        echo 'error';
    }
} else {
    // Renvoie une réponse indiquant que la demande est invalide
    echo 'invalid request';
}

?>
