<?php
// Function to execute the minikube service command for the specified service
function executeMinikubeServiceInBackground($serviceName) {
    // Build the command to execute
    $command = 'sudo -u aladin_257 minikube service ' . $serviceName . ' &';

    // Execute the command in the background
    shell_exec($command);
    
    // Return success message
    echo "Command executed in background.";
}

// Check if the service name is provided in the request
if (isset($_POST['service_name'])) {
    // Get the service name from the request
    $serviceName = $_POST['service_name'];

    // Execute the minikube service command for the specified service in background
    executeMinikubeServiceInBackground($serviceName);
} else {
    // If the service name is not provided, return an error message
    echo "Error: Service name not provided in the request.";
}
?>
