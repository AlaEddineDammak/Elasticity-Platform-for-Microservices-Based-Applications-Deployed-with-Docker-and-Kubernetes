<?php
// Vérifier si la demande de suppression de service a été envoyée
if (isset($_POST['delete_service']) && $_POST['delete_service'] == true) {
    // Récupérer le nom du service à supprimer depuis la requête
    $serviceName = $_POST['service_name'];

    // Exécuter la commande kubectl pour supprimer le service
    $command = "sudo -u aladin_257 kubectl delete service $serviceName --namespace=default";
    exec($command, $output, $status);

    // Vérifier si la commande a été exécutée avec succès
    if ($status === 0) {
        // Envoyer une réponse de succès
        echo 'success';
    } else {
        // Envoyer une réponse d'échec
        echo 'error';
    }
} else {
    // Envoyer une réponse si la demande de suppression de service n'est pas valide
    echo 'invalid request';
}
?>
