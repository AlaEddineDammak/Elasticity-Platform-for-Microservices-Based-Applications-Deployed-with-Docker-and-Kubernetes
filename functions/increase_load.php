<?php

// Vérifie si la demande est une requête POST et si elle contient les données nécessaires
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['increase_load']) && isset($_POST['service_name'])) {
    // Récupère le nom du service
    $serviceName = $_POST['service_name'];
    // Exécute la commande kubectl pour augmenter la charge
    $command = "sudo -u aladin_257 kubectl run -i --tty load-generator --rm --image=busybox:1.28 --restart=Never -- /bin/sh -c \"while sleep 0.01; do wget -q -O- http://$serviceName; done\" &";

        // Notez l'utilisation des guillemets simples à l'intérieur de la chaîne pour protéger l'expression while


    // Exécute la commande et récupère le résultat
    exec($command, $output, $returnValue);

    // Vérifie si la commande s'est exécutée avec succès
    if ($returnValue === 0) {
        // Renvoie une réponse indiquant que l'augmentation de la charge a réussi
        echo 'success';
    } else {
        // Renvoie une réponse indiquant que l'augmentation de la charge a échoué
        echo 'error' . implode("\n", $output);
    }
} else {
    // Renvoie une réponse indiquant que la demande est invalide
    echo 'invalid request';
}

?>
