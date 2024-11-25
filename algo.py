from kubernetes import client, config
import time

# Charger la configuration Kubernetes
config.load_kube_config()

# Creation d'une instance du Kubernetes API
api_instance = client.AppsV1Api()
api_metrics_instance = client.CustomObjectsApi()

# Récupérer les deploiements
def get_deployments(namespace='default'):
    try:
        deployments = api_instance.list_namespaced_deployment(namespace)
        return deployments.items
    except Exception as e:
        print(f"Error: {e}")
        return []

# Récupérer les pods
def get_pod_metrics(namespace='default'):
    try:
        api_response = api_metrics_instance.list_namespaced_custom_object(
            "metrics.k8s.io", "v1beta1", namespace, "pods")
        return api_response
    except Exception as e:
        print(f"Error: {e}")
        return None

# Récupérer les ressources d'un deploiement (d'aprés le fichier YAML)
def get_pod_resources(deployment_name, namespace='default'):
    try:
        deployment = api_instance.read_namespaced_deployment(deployment_name, namespace)
        pod_spec = deployment.spec.template.spec
        containers = pod_spec.containers

        resources = []
        for container in containers:
            container_resources = {
                'container_name': container.name,
                'resources': {
                    'requests': container.resources.requests,
                    'limits': container.resources.limits
                }
            }
            resources.append(container_resources)

        return resources
    except Exception as e:
        print(f"Error: {e}")
        return None

# Convertir les nanoCore en microCore
def convert_nano_to_micro(input_str):
    try:
        value_str = input_str.rstrip('n')
        value_nano = float(value_str)
        
        # 1m = 1000n
        value_micro = value_nano / 1000000
        
        return value_micro
    except ValueError:
        print("Error: Invalid input. Make sure the input is in the form 'number n'.")
        return None

# Ajout d'un pod 
def scale(deployment_name, namespace='default'):
    max_retries = 5
    retry_delay = 5  # seconds
    retries = 0
    while retries < max_retries :
        try:
            deployment = api_instance.read_namespaced_deployment(deployment_name, namespace)
            deployment.spec.replicas = deployment.spec.replicas +1

            api_instance.patch_namespaced_deployment(
                name=deployment_name,
                namespace=namespace,
                body=deployment
            )
            print(f"Deployment '{deployment_name}' scaled to {deployment.spec.replicas} replicas.")
            break  
        except client.exceptions.ApiException as e:
            if e.status == 409:  # Conflict
                print("Conflict detected, retrying...")
                retries += 1
                time.sleep(retry_delay)
            else:
                print(f"Error scaling deployment: {e}")
                break
    else:
        print(f"Max retries reached. Failed to scale deployment '{deployment_name}'.")

# Suppression d'un pod
def descale(deployment_name, namespace='default'):
    max_retries = 5
    retry_delay = 5  # seconds
    retries = 0
    while retries < max_retries:
        try:
            deployment = api_instance.read_namespaced_deployment(deployment_name, namespace)
            
            # S'assurer qu'il y a au moins un pod
            if deployment.spec.replicas <= 1:
                print(f"Cannot descale deployment '{deployment_name}'. At least one replica must be running.")
                return
            
            # Reduire le nombre de replicas par 1
            deployment.spec.replicas -= 1

            # Update 
            api_instance.patch_namespaced_deployment(
                name=deployment_name,
                namespace=namespace,
                body=deployment
            )
            print(f"Deployment '{deployment_name}' descaled to {deployment.spec.replicas} replicas.")
            break  
        except client.exceptions.ApiException as e:
            if e.status == 409:  # Conflict
                print("Conflict detected, retrying...")
                retries += 1
                time.sleep(retry_delay)
            else:
                print(f"Error descaling deployment: {e}")
                break
    else:
        print(f"Max retries reached. Failed to descale deployment '{deployment_name}'.")

# Fonction qui englobe toutes les précédentes
def visualize():
    max_new_replicas = 10
    deployments = get_deployments(namespace='default')
    for deployment in deployments:
        deployment_name = deployment.metadata.name
        
        pod_metrics = get_pod_metrics(namespace='default')
        pod_resources = get_pod_resources(deployment_name, namespace='default')
        if pod_resources[0]['resources']['requests']!=None :
            print(f"Deployment: {deployment_name}")
            print("Pod Resources:")
            for data in pod_resources:
                cpu = data['resources']['requests']['cpu']
                print(f"CPU: {cpu}") 
            moy = 0
            nb = 0
            print("Pod Metrics:")
            for item in pod_metrics['items']:
                pod_name = item['metadata']['name']
                if pod_name.startswith(deployment_name + '-'):
                    cpu_usage = item['containers'][0]['usage']['cpu']
                    memory_usage = item['containers'][0]['usage']['memory']
                    print(f"Pod: {pod_name} CPU Usage: {convert_nano_to_micro(cpu_usage)}m") 
                    moy += convert_nano_to_micro(cpu_usage)
                    nb += 1
            moy = moy / nb
            print("cpu moy :", moy)
            if moy > (70 / 100) * int(cpu.rstrip('m')):
                
                scale(deployment_name) 
                
                
            if moy < (30 / 100) * int(cpu.rstrip('m')):
                descale(deployment_name)  
            print("=" * 50)

if __name__ == "__main__":
    while True:
        visualize() 
        time.sleep(10)
