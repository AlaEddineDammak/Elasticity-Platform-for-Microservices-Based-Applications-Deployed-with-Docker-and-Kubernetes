<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_deployment"])) {
    // Retrieve the deployment name from the POST request
    $deploymentName = $_POST["deployment_name"];

    // Execute the kubectl command to delete the deployment
    $command = "sudo -u aladin_257 kubectl delete deployment $deploymentName --namespace=default";
    exec($command, $output, $returnStatus);

    // Check if the command executed successfully
    if ($returnStatus === 0) {
        // Return success response
        echo "success";
    } else {
        // Return error response
        echo "error";
    }
}
?>
