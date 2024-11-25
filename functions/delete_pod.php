<?php

// Vérifie si la demande est une requête POST et si elle contient les données nécessaires
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_pod']) && isset($_POST['pod_name'])) {
    // Récupère le nom du pod à supprimer
    $podName = $_POST['pod_name'];

    // Exécute la commande kubectl pour supprimer le pod
    $command = "sudo -u aladin_257 kubectl delete pod $podName --namespace=default";

    // Exécute la commande et récupère le résultat
    exec($command, $output, $returnValue);

    // Vérifie si la commande s'est exécutée avec succès
    if ($returnValue === 0) {
        // Renvoie une réponse indiquant que la suppression a réussi
        echo 'success';
    } else {
        // Renvoie une réponse indiquant que la suppression a échoué
        echo 'error';
    }
} else {
    // Renvoie une réponse indiquant que la demande est invalide
    echo 'invalid request';
}

?>
