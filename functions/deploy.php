<?php

// Vérifier si des fichiers ont été téléchargés
if (isset($_FILES['fileToUpload'])) {
    $uploadsDirectory = '/var/www/html/'; // Répertoire où les fichiers seront téléchargés

    // Vérifier si le répertoire d'uploads existe, sinon le créer
    if (!file_exists($uploadsDirectory)) {
        mkdir($uploadsDirectory, 0777, true);
    }

    $fileCount = count($_FILES['fileToUpload']['name']);

    // Boucler à travers tous les fichiers téléchargés
    for ($i = 0; $i < $fileCount; $i++) {
        $fileName = $_FILES['fileToUpload']['name'][$i];
        $fileTmpName = $_FILES['fileToUpload']['tmp_name'][$i];
        $fileType = $_FILES['fileToUpload']['type'][$i];

        // Vérifier si le fichier est un fichier YAML
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        if ($fileExtension !== 'yaml' && $fileExtension !== 'yml') {
            echo "Seuls les fichiers YAML sont autorisés.";
            continue;
        }

        // Déplacer le fichier téléchargé dans le répertoire d'uploads
        $destination = $uploadsDirectory . $fileName;
        if (!move_uploaded_file($fileTmpName, $destination)) {
            echo "Une erreur s'est produite lors du téléchargement du fichier $fileName.";
            continue;
        }

        // Déployer le fichier YAML avec kubectl apply -f
        $command = "sudo -u aladin_257 kubectl apply -f $destination ";
        $output = shell_exec($command);

        echo "Le fichier $fileName a été téléchargé et déployé avec succès.";
    }
} else {
    echo "Aucun fichier n'a été téléchargé.";
}

// Redirection vers index.php
header("Location: deployer.php");
exit; // Assure que le script s'arrête après la redirection
?>
